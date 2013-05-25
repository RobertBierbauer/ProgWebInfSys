<?php
namespace Game\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Game\Model\Game;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\View\Model\JsonModel;

class GameController extends AbstractActionController
{	
    public function indexAction()
    {
    	
    	$highscore = new Game();
    	$highscore = $highscore->getHighscore();
    	
    	if($this->getRequest()->isXmlHttpRequest()){
    		
    		$result = new JsonModel(array(
    				'highscore' => $highscore,
    				'success'=>true,
    		));
    		 
    		return $result;
    	}else{
    		return new ViewModel(array(
    				'highscore' => $highscore,
    		));
    	}
    	
    	
    }

    public function creategameAction()
    {    	
    	$request = $this->getRequest();
    	$replaygame = null;
    	if($this->params('id')){
    		$replaygame = new Game();
    		$replaygame->findById($this->params('id'));    		
    	}
    	if ($request->isPost()) {
    		$game = new Game();
    		$game->exchangeArray($request->getPost());
    		$game->save();
    		$id = $game->id;
    		
    		$html = 'Hello '.$game->player2Name."!\n".$game->player1Name." challenged you on a game. You can join the game by clicking on the link:\n\n <a href='http://138.232.66.87/aufgabe8/game/joingame/".$id."'>Join the game</a>";
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
    	$game = new Game();
    	$game->findById($id);
    	$request = $this->getRequest();
    	$viewModel =  new ViewModel(array(
    			'id' => $id,
    			'game' => $game,
    		));
    	$viewModel->setTerminal($request->isXmlHttpRequest());
    	return $viewModel;
    }
    

    public function joingameAction()
    {
    	$request = $this->getRequest();
    	if($request->isPost()){
    		$data = $request->getPost();
    		var_dump($data);
    		$id = $data['id'];
    		$player2Choice = $data['player2Choice'];
    		$player2Message = $data['player2Message'];
    	}else{
    		$id = $this->params('id');
    	}    	
    	$game = new Game();
    	$game->findById($id);
    	 
    	if($game){
	    	if ($request->isPost()) {
	    		
		    	$game->setPlayer2Choice($player2Choice);
		    	$game->setPlayer2Message($player2Message);
		    	$game->determineWinner();
    			$game->save();   
			    return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
	    	}else{
	    		if($game->player2Choice === '0'){
	    			return array('id' => $id, 'player1Name' => $game->player1Name, 'player1Message' => $game->player1Message);
	    		}else{	    			
	    			return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
	    		}	    		
	    	}
    	}
    	else{
    		return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
    	}
    }
    
    
    public function showviewresultAction(){
    	$id = $this->params('id');
    	$game = new Game();
    	$game->findById($id);
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
}
