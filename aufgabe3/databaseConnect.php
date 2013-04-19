<?php

require_once 'entry.php';

class DatabaseConnect{
	
	private $mysqli;
	
	public function __construct(){
		if(!isset($this->mysqli)){
			$this->mysqli = new mysqli("localhost", "root", "new-password", "wiki");
			if ($this->mysqli->connect_errno) {
				echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
			}
		}		
	}
	
	public function insertEntry($title, $text){
		if(mysqli_query($this->mysqli,"INSERT INTO entries(id, title, text) VALUES (NULL, '$title','$text')") === true){
			
			$res = mysqli_query($this->mysqli, "SELECT id FROM entries WHERE title='$title'");				
			$row = $res->fetch_assoc();				
			$id = $row['id'];
			//redirect to the created entry
			header( 'Location: show.php?id='.$id);
		}else{
			header( 'Location: createEntry.php?error=unique') ;
		}
	}
	
	public function getAll(){
		$entries = array();
		$res = mysqli_query($this->mysqli, "SELECT * FROM entries");
		while ($row = $res->fetch_assoc()) {
			$list_id = $row['id'];
			$list_title = $row['title'];
			$list_description = $row['text'];
			//create the new entry
			$entry = new Entry($list_id, $list_title, $list_description);
			array_push($entries, $entry);
		}
		return $entries;
	}
	
	public function getEntry($id){
		$res = mysqli_query($this->mysqli, "SELECT * FROM entries WHERE id=$id");
		if(!$res){
			header( 'Location: createEntry.php?error=notExisting') ;
		}else{
			$row = $res->fetch_assoc();
			$list_id = $row['id'];
			$list_title = $row['title'];
			$list_description = $row['text'];
			$entry = new Entry($list_id, $list_title, $list_description);
			return $entry;
		}
	}
	
	public function editEntry( $id, $title, $description){
		if(mysqli_query($this->mysqli, "UPDATE entries SET title='$title', text='$description' WHERE id=$id") === true){
			echo "Entry updated";			
			//redirect to the created entry
			header( 'Location: show.php?id='.$id);
			
		}else{
			echo "Entry not updated";
			
			header( 'Location: editEntry.php?error=unique&id='.$id);
		}
	}
	
	public function deleteEntry($id){
		if(mysqli_query($this->mysqli, "DELETE FROM entries WHERE id=$id") === true){
			header( 'Location: createEntry.php') ;
		}
	}
	
	public function getIdByTitle($searchTitle){
		$res = mysqli_query($this->mysqli, "SELECT * FROM entries WHERE title='$searchTitle'");
		$row = $res->fetch_assoc();
		$foundId = $row['id'];
		return $foundId;
	}
}


?>