<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function createAction(){
    	$request = $this->getRequest();
    	$response = $this->getResponse();
    	if ($request->isPost()) {
    		$request_data = $request->getPost();
    		$username = $request_data['username'];
    		$password = $request_data['password'];
    		$email = $request_data['email'];
    		
    		if (!$this->getUserTable()->createUser($username, $password, $email))
    			$response->setContent(\Zend\Json\Json::encode(array('response' => false)));
    		else {
    			$response->setContent(\Zend\Json\Json::encode(array('response' => true)));
    		}
    	}
    	return $response;
    }
    
    public function removeAction(){
    	 
    }
    
    public function updateAction(){
    	 
    }
    
    protected $userTable;
    public function getUserTable() {
    	if (!$this->userTable) {
    		$sm = $this->getServiceLocator();
    		$this->userTable = $sm->get('User\Model\UserTable');
    	}
    	return $this->userTable;
    }
}
