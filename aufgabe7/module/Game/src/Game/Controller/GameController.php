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
    		
    		$this->sendEmail($id, $game, 0);

    		return $this->redirect()->toRoute('game', array('action'=>'showcreatedgame', 'id'=>$id));

    	}
    	return new ViewModel(array(
    			'replaygame' => $replaygame,
    	));
    }
    
    public function showcreatedgameAction(){
    	$id = $this->params('id');
    	$game = $this->getGameTable()->getGame($id);
    	return new ViewModel(array(
    			'id' => $id,
    			'game' => $game,
    		));
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
    	$id = $this->params('id');
    	$game = $this->getGameTable()->getGame($id);
    	if($game){
	    	$request = $this->getRequest();
	    	if ($request->isPost()) {
	    		$joinGame = new Game();
		    	$joinGame->exchangeArray($request->getPost());
			    $joinGame->setID($id);
			    
			    
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
			    
			    $this->sendEmail($id, $game, 1);
			    
			    return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$this->params('id')));
	    	}
    	}
    	else{
    		return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$this->params('id')));
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
    	return new ViewModel(array(
    			'game'=> $game,
    			'error' => $error,
    			'choices' => $choices));
    }
    
    public function getGameTable()
    {
    	if (!$this->gameTable) {
    		$sm = $this->getServiceLocator();
    		$this->gameTable = $sm->get('Game\Model\GameTable');
    	}
    	return $this->gameTable;
    }
    
    /**
     * This function sends an email 
     * @param unknown_type $id the id of the game
     * @param unknown_type $game - the mae with all information
     * @param unknown_type $option 0 if a player is invited, 1 if the game was completed
     */
    public function sendEmail($id, $game, $option){
    	
    	if($option === 0){
    		$html = 'Hello '.$game->player2Name."!\n".$game->player1Name." challenged you on a game. You can join the game by clicking on the link:\n\n <a href='http://138.232.66.87/aufgabe7/game/joingame/".$id."'>Join the game</a>";
    	}else{
    		$html = 'Hello '.$game->player1Name."!\n".$game->player2Name." has finished the game. You can check the result by clicking on the link:\n\n <a href='http://138.232.66.87/aufgabe7/game/viewresult/".$id."'>Check the result</a>";
    	}
    	
    	$bodyPart = new \Zend\Mime\Message();
    	$bodyMessage = new \Zend\Mime\Part($html);
    	$bodyMessage->type = 'text/html';
    	$bodyPart->setParts(array($bodyMessage));
    	
    	$mail = new Message();
    	$mail->setBody($bodyPart);
    	$mail->setFrom('robert.bierbauer@student.uibk.ac.at', ''.$game->player1Name);
    	if($option === 0){
    		$mail->addTo(''.$game->player2Email, ''.$game->player2Name);
    	}else{
    		$mail->addTo(''.$game->player1Email, ''.$game->player1Name);
    	}
    	
    	$mail->setSubject(''.$game->player1Name.' challenged you!');
    	$mail->setEncoding('UTF-8');
    	
    	$transport = new SmtpTransport();
    	$options   = new SmtpOptions(array(
    			'name'              => 'smtp.uibk.ac.at',
    			'host'              => 'smtp.uibk.ac.at',
    	));
    	$transport->setOptions($options);
    	$transport->send($mail);
    }
}