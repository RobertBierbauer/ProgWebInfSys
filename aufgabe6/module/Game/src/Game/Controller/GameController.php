<?php
namespace Game\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Game\Model\Game;
use Game\Form\CreateGameForm;
use Game\Form\JoinGameForm;
use Game\Form\ViewResultForm;

class GameController extends AbstractActionController
{
	protected $gameTable;
	
    public function indexAction()
    {
    	return new ViewModel(array(
    			'games' => $this->getGameTable()->fetchAll(),
    	));
    }

    public function creategameAction()
    {
    	$form = new CreateGameForm();
    	$form->get('submit')->setValue('Create');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$game = new Game();
    		$form->setInputFilter($game->getCreateInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$game->exchangeArray($form->getData());
    			$id = $this->getGameTable()->saveGame($game);

    			return $this->redirect()->toRoute('game', array('action'=>'showcreatedgame', 'id'=>$id));
    		}
    	}
    	return array('form' => $form);
    }
    
    public function showcreatedgameAction(){
    	
    	return new ViewModel(array(
    			'id'=> $this->params('id')));
    }
    

    public function joingameAction()
    {
    	$form = new JoinGameForm();
    	$form->get('submit')->setValue('Join');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$game = new Game();
    		$form->setInputFilter($game->getJoinInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$game->exchangeArray($form->getData());
    			if($game->player2Choice == "0"){
	    			$this->getGameTable()->completeGame($game);
	    	
	    			return $this->redirect()->toRoute('game', array('action'=>'showviewresult', 'id'=>$game->id));
    			}
    		}
    	}
    	return array('form' => $form);
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
    	//determine error
    	$error = "";
    	if($this->layout->error != ""){
    		$error = $this->layout->error;
    	}
    	$winner="";
    	$choices = array("1" => "Rock", "2" => "Scissors", "3" => "Paper", "4" => "Lizard", "5" => "Spock");

    	if(!$game){
    		$error = "<p>The game does not exist! Please don't try to hack other games</p>";
    	}
    	else if($game->player2Choice == "0"){
    		$error = "<p>Sorry Bro! Your friend did not yet make his choice!</p>";
    	}
    	else{
	    	$player1Choice = $game->player1Choice;
	    	$player2Choice = $game->player2Choice;
	    	//determine winner
	    	
	    	if($player1Choice == $player2Choice){
	    		$winner = 0;
	    	}    	
	    	else if( ($player1Choice == "1" && ($player2Choice == "3" || $player2Choice == "5")) || 
	    			 ($player1Choice == "2" && ($player2Choice == "1" || $player2Choice == "5")) || 
	    			 ($player1Choice == "3" && ($player2Choice == "2" || $player2Choice == "4")) || 
	    			 ($player1Choice == "4" && ($player2Choice == "1" || $player2Choice == "3")) ||
	    			 ($player1Choice == "5" && ($player2Choice == "4" || $player2Choice == "2"))){
	    		$winner = 2;
	    	}
	    	else{
	    		$winner = 1;
	    	}
    	}
    	return new ViewModel(array(
    			'game'=> $game,
    			'error' => $error,
    			'winner' => $winner,
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
}