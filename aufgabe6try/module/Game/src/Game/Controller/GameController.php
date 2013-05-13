<?php
namespace Game\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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