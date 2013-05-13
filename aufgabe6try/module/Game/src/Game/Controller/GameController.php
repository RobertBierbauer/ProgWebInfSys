<?php
namespace Game\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Game\Model\Game;
use Game\Form\CreateGameForm;

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
    		$form->setInputFilter($game->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$game->exchangeArray($form->getData());
    			$this->getGameTable()->saveGame($game);
    	
    			// Redirect to list of albums
    			return $this->redirect()->toRoute('game');
    		}
    	}
    	return array('form' => $form);
    }

    public function joingameAction()
    {
    }

    public function viewresultAction()
    {
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