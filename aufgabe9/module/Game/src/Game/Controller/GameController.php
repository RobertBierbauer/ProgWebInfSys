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
    		
    		$html = 'Hallo '.$game->player2Name."!\n".$game->player1Name." hat Dich zu einem Spiel herausgefordert. Trete dem Spiel bei:\n\n <a href='http://138.232.66.87/aufgabe9/game/joingame/".$id."'>Spiel beitreten</a>";
    		$bodyPart = new \Zend\Mime\Message();
    		$bodyMessage = new \Zend\Mime\Part($html); 	
    		$bodyMessage->type = 'text/html';
    		$bodyPart->setParts(array($bodyMessage));		
    		
    		$mail = new Message();
    		$mail->setBody($bodyPart);
    		$mail->setFrom('robert.bierbauer@student.uibk.ac.at', ''.$game->player1Name);
    		$mail->addTo(''.$game->player2Email, ''.$game->player2Name);
    		$mail->setSubject(''.$game->player1Name.' hat dich herausgefordert!');
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
    		var_dump($data);
    		$player2Name = $data['player2Name'];
    		$player2Choice = $data['player2Choice'];
    		$player2Message = $data['player2Message'];
    	}else{
    		$id = $this->params('id');
    	}    	
    	$game = new Game();
    	$game->findById($id);
    	 
    	if($game){
	    	if ($request->isPost()) {
	    		$game->setPlayer2Name($player2Name);
		    	$game->setPlayer2Choice($player2Choice);
		    	$game->setPlayer2Message($player2Message);
		    	$game->determineWinner();
    			$game->save();   
			    return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
	    	}else{
	    		if($game->player2Choice === '0'){
	    			return array('id' => $id, 'player1Name' => $game->player1Name, 'player1Message' => $game->player1Message, 'player2Name' => $game->player2Name);
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
    		$error = "<p>Das Spiel existiert nicht! Bitte hacken Sie keine anderen Spiele!</p>";
    	}
    	else if($game->player2Choice == "0"){
    		$error = "<p>Dein Gegner hat seine Waffe noch nicht gewählt! Komm später wieder!</p>";
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
