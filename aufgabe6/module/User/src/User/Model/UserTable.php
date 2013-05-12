<?php

namespace User\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

class UserTable extends AbstractTableGateway{
	
	protected $table = 'user';
	
	public function __construct(Adapter $_adapter){
		$this->adapter = $_adapter;
	}
	
	private function checkUserByName($username) {
		$row = $this->select(array('username' => $username))->current();
		if (!$row){
			return false;
		}
		
		return true;
	}
	
	public function createUser($username, $password, $email) {
		//prevent sql injections
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		$email = mysql_real_escape_string($email);
		
		if(checkUserByName($username)){
			return false;
		}
		
		$hashedPassword = hash('sha256', $username . $password);
		
		$data = array(
					'username' => $username,
					'password' => $hashedPassword,
					'email' => $email,
				);
		
		if (!$this->insert($data)){
				return false;
		}
		return true;
	}
}