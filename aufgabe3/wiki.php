<?php

require_once('entry.php');

class Wiki{

	private $entries;

	public function __construct(){
		if(!isset($this->entries)){
			$this->entries = array();
		}		
	}

	public function addEntry($entry){
		$trimmed = trim($entry->getTitle());
		$this->entries[$trimmed] = $entry;
	}

	public function deleteEntry($title){
		$trimmed = trim($title);
		unset($this->entries[$trimmed]);
	}
	
	public function getEntry($title){
		return $this->entries[$title];
	}

	public function getEntries(){
		return $this->entries;
	}
	
	public function getClass(){
		return $this;
	}

}