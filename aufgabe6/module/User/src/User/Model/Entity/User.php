<?php

namespace User\Model\Entity;

class User{
	
	protected $userId;
	protected $username;
	protected $password;
	protected $email;
	
	public function __construct($_id, $_username, $_password="", $_email){
		$userId = $_id;
		$username = $_username;
		$password = $_password;
		$email = $_email;
	}
	
	public function getUserID(){
		return $this->userId;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function getEmail(){
		return $this->email;
	}
}