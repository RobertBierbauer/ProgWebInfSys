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
    		
    		$this->sendEmail($id, $game, 0);

    		return $this->redirect()->toRoute('game', array('action'=>'showcreatedgame', 'id'=>$id));

    	}
    	
    	$result = new JsonModel(array(
    				'replaygame' => $replaygame,
    				'success'=>true,
    		));
    	return $result;
    	
    }
    
    public function showcreatedgameAction(){
    	$id = $this->params('id');
    	$game = new Game();
    	$game->findById($id);
    	$request = $this->getRequest();
    	$result = new JsonModel(array(
    				'game' => $game,
    				'success'=>true,
    		));
    	return $result;
    }
    

    public function joingameAction()
    {
    	
    	$request = $this->getRequest();
    	if($request->isPost()){
    		$data = $request->getPost();
    		$id = $data['id'];
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
    			$this->sendEmail($id, $game, 1);
    			return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
	    	}else{
	    		if($game->player2Choice === '0'){
	    			$result2 = new JsonModel(array(
	    				'game' => $game,
	    				'success'=>true,
		    		));
		    		return $result2;
	    		}else{	    			
	    			return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$id));
	    		}	    		
	    	}
    	}
    	else{
    		$result4 = new JsonModel(array(
    				'success'=>false,
    		));
    		return $result4;
    	}
    	
    }
    
    
    public function showviewresultAction(){
    	$id = $this->params('id');
    	$game = new Game();
    	$game->findById($id);
    	$error = "";
    	$choices = array("1" => "Stein", "2" => "Schere", "3" => "Papier", "4" => "Echse", "5" => "Spock");

    	//determine error
    	if(!$game){
    		$error = "<p>Das Spiel existiert nicht! Bitte hacken Sie keine anderen Spiele!</p>";
    	}
    	else if($game->player2Choice == "0"){
    		$error = "<p>Dein Gegner hat seine Waffe noch nicht gewählt! Komm später wieder!</p>";
    	}
    	
    	$request = $this->getRequest();
    	$result = new JsonModel(array(
    		'result' => true,
	    	'game' => $game,
    		'choices' => $choices,
	    	'success'=>true,
		));
		return $result;
    }
    
    /**
     * This function sends an email
     * @param unknown_type $id the id of the game
     * @param unknown_type $game - the mae with all information
     * @param unknown_type $option 0 if a player is invited, 1 if the game was completed
     */
    public function sendEmail($id, $game, $option){
    	 
    	if($option === 0){
    		$html = 'Hello '.$game->player2Name."!\n".$game->player1Name." challenged you on a game. You can join the game by clicking on the link:\n\n <a href='http://138.232.66.87/aufgabe9/game#joinGame#".$id."'>Join the game</a>";
    	}else{
    		$html = 'Hello '.$game->player1Name."!\n".$game->player2Name." has finished the game. You can check the result by clicking on the link:\n\n <a href='http://138.232.66.87/aufgabe9/game#viewresult#".$id."#player1'>Check the result</a>";
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
    		$mail->setSubject(''.$game->player1Name.' challenged you!');
    	}else{
    		$mail->addTo(''.$game->player1Email, ''.$game->player1Name);
    		$mail->setSubject(''.$game->player2Name.' has completed the game!');
    	}
    	 
    	 
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
