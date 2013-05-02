<?php


class User{
	
	private $id;
	private $username;
	private $password;
	
	public function __construct($id, $username, $password=""){
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
	}
	
	public function getUserId(){
		return $this->id;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	
	
}