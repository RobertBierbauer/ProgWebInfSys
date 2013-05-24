<?php
namespace Game\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Game\Model\Game;
use Game\Form\CreateGameForm;
use Game\Form\JoinGameForm;
use Game\Form\ViewResultForm;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class GameController extends AbstractActionController
{
	protected $gameTable;
	
    public function indexAction()
    {
    	
    	
    	return new ViewModel(array(
    			'highscore' => $this->getGameTable()->getHighscore(),    			
    	));
    }

    public function creategameAction()
    {    	
    	$request = $this->getRequest();
    	$replaygame = null;
    	if($this->params('id')){
    		$replaygame = $this->getGameTable()->getGame($this->params('id'));    		
    	}
    	if ($request->isPost()) {
    		$game = new Game();

    		$game->exchangeArray($request->getPost());
    		$id = $this->getGameTable()->saveGame($game);
    		
    		$html = 'Hello '.$game->player2Name."!\n".$game->player1Name." challenged you on a game. You can join the game by clicking on the link:\n\n <a href='http://138.232.66.87/aufgabe7/game/joingame/".$id."'>Join the game</a>";
    		$bodyPart = new \Zend\Mime\Message();
    		$bodyMessage = new \Zend\Mime\Part($html); 	
    		$bodyMessage->type = 'text/html';
    		$bodyPart->setParts(array($bodyMessage));		
    		
    		$mail = new Message();
    		$mail->setBody($bodyPart);
    		$mail->setFrom('robert.bierbauer@student.uibk.ac.at', ''.$game->player1Name);
    		$mail->addTo(''.$game->player2Email, ''.$game->player2Name);
    		$mail->setSubject(''.$game->player1Name.' challenged you!');
    		$mail->setEncoding('UTF-8');
    		
    		$transport = new SmtpTransport();
			$options   = new SmtpOptions(array(
			    'name'              => 'smtp.uibk.ac.at',
			    'host'              => 'smtp.uibk.ac.at',
			));
			$transport->setOptions($options);
   			$transport->send($mail);

    		return $this->redirect()->toRoute('game', array('action'=>'showcreatedgame', 'id'=>$id));

    	}
    	
    	$viewModel = new ViewModel(array(
    			'replaygame' => $replaygame,
    	));
    	//disable the layout on an ajax request
    	$viewModel->setTerminal($request->isXmlHttpRequest());
    	return $viewModel;
    	
    }
    
    public function showcreatedgameAction(){
    	$id = $this->params('id');
    	$game = $this->getGameTable()->getGame($id);
    	
    	$request = $this->getRequest();
    	$viewModel =  new ViewModel(array(
    			'id' => $id,
    			'game' => $game,
    		));
    	$viewModel->setTerminal($request->isXmlHttpRequest());
    	return $viewModel;
    }
    
    public function selectjoingameAction(){
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$request = $request->getPost();
    		$id = $request['id'];
    		$game = $this->getGameTable()->getGame($id);
    		if(!$game){
    			return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
    		}
    		elseif($this->getGameTable()->gameCompleted($game)){
    			return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
    		}
    		else{    			
    			return $this->redirect()->toRoute('game', array('action'=>'joingame', 'id'=>$id));
    		}
    	}
    }

    public function joingameAction()
    {
    	$request = $this->getRequest();
    	if($request->isPost()){
    		$data = $request->getPost();
    		$id = $data['id'];
    	}else{
    		$id = $this->params('id');
    	}    	
    	$game = $this->getGameTable()->getGame($id);
    	if($game){
	    	if ($request->isPost()) {
	    		$joinGame = new Game();
		    	$joinGame->exchangeArray($request->getPost());
			    
		    	var_dump($game->player2Choice);
				
		    	//determine winner
		    	$player1Choice = $game->player1Choice;
		    	$player2Choice = $joinGame->player2Choice;

		    	if($player1Choice == $player2Choice){
		    		$joinGame->setWinner(0);
		    	}
		    	else if( ($player1Choice == "1" && ($player2Choice == "3" || $player2Choice == "5")) ||
		    			($player1Choice == "2" && ($player2Choice == "1" || $player2Choice == "5")) ||
		    			($player1Choice == "3" && ($player2Choice == "2" || $player2Choice == "4")) ||
		    			($player1Choice == "4" && ($player2Choice == "1" || $player2Choice == "3")) ||
		    			($player1Choice == "5" && ($player2Choice == "4" || $player2Choice == "2"))){
		    		$joinGame->setWinner(2);
		    	}
		    	else{
		    		$joinGame->setWinner(1);
		    	}

		    	$this->getGameTable()->completeGame($joinGame);
		    	return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
	    	}else{
	    		if($game->player2Choice === '0'){
	    			return array('id' => $id);
	    		}else{
	    			return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
	    		}	    		
	    	}
    	}
    	else{
    		return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
    	}
    }
    
    public function viewresultAction()
    {
    	$form = new ViewResultForm();
    	$form->get('submit')->setValue('View Result');
    	 
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$game = new Game();
    		$form->setInputFilter($game->getViewResultFilter());
    		$form->setData($request->getPost());
    		 
    		if ($form->isValid()) {
    			$game->exchangeArray($form->getData());    			 
    			return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$game->id));
    		}
    	}
    	return array('form' => $form);
    }
    
    public function showviewresultAction(){
    	$game = $this->getGameTable()->getGame($this->params('id'));
    	$error = "";
    	$choices = array("1" => "Rock", "2" => "Scissors", "3" => "Paper", "4" => "Lizard", "5" => "Spock");

    	//determine error
    	if(!$game){
    		$error = "<p>The game does not exist! Please don't try to hack other games</p>";
    	}
    	else if($game->player2Choice == "0"){
    		$error = "<p>Sorry Bro! Your friend did not yet make his choice!</p>";
    	}
    	
    	$request = $this->getRequest();
    	$viewModel = new ViewModel(array(
    			'game'=> $game,
    			'error' => $error,
    			'choices' => $choices));
    	$viewModel->setTerminal($request->isXmlHttpRequest());
    	return $viewModel;
    }
    
    public function getGameTable()
    {
    	if (!$this->gameTable) {
    		$sm = $this->getServiceLocator();
    		$this->gameTable = $sm->get('Game\Model\GameTable');
    	}
    	return $this->gameTable;
    }
}