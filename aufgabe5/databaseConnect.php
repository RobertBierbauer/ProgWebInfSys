<?php

require_once 'entry.php';

class DatabaseConnect{
	
	private $mysqli;
	
	public function __construct(){
		if(!isset($this->mysqli)){
			$this->mysqli = new mysqli("localhost", "root", "pass", "wikiwithuser");
			if ($this->mysqli->connect_errno) {
				echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
			}
		}		
	}
	
	/**
	 * insert a new entry into the database with a certain title and text and show this new entry
	 * @param unknown_type $title the title of the entry
	 * @param unknown_type $text the text of the entry
	 */
	public function insertEntry($title, $text){
		$entry = new Entry("", $title, $text);
		$textparse = $entry->getTextParse();
		if(mysqli_query($this->mysqli,"INSERT INTO entries(id, title, text, textparse) VALUES (NULL, '$title','$text', '$textparse')") === true){
			
			$res = mysqli_query($this->mysqli, "SELECT id FROM entries WHERE title='$title'");				
			$row = $res->fetch_assoc();				
			$id = $row['id'];
			
			$success = $this->insertLinkEntries($id, $entry->getLinkEntries());
			if(!$success){
				header( 'Location: createEntry.php?error=asdf');
			}
			else{
				//redirect to the created entry
				header( 'Location: show.php?id='.$id);
			}
		}else{
			header( 'Location: createEntry.php?error=unique');
		}
	}
	
	/**
	 * insert a new entry into the database  with a certain title and text without linking to the new entry
	 * @param unknown_type $title the title of the new entry
	 * @param unknown_type $text the text of the new entry
	 * @return string success if entry was created and error if creating the entry failed
	 */
	public function insertEntryWithoutLink($title, $text){
		$entry = new Entry("", $title, $text);
		$textparse = $entry->getTextParse();
		if(mysqli_query($this->mysqli,"INSERT INTO entries(id, title, text, textparse) VALUES (NULL, '$title','$text', '$textparse')") === true){
			$res = mysqli_query($this->mysqli, "SELECT id FROM entries WHERE title='$title'");
			$row = $res->fetch_assoc();
			$id = $row['id'];
			$success = $this->insertLinkEntries($id, $entry->getLinkEntries());
			if($success){
				return "success";
			}else{
				return "error";
			}
			
		}
		else{
			return "error";
		}
	}
	
	/**
	 * the the amount of entries in the database
	 * @return number the number of entries in the database
	 */
	public function getNumberEntries(){
		$res = mysqli_query($this->mysqli, "SELECT COUNT(*) as number FROM entries");
		$row = $res->fetch_assoc();
		$number = $row['number'];
		return $number;
	}
	
	/**
	 * get an amount of entries from a certain position
	 * @param number $start the position of the first entry to take from the database
	 * @return multitype: an array of entries
	 */
	public function getAllLimit($start){
		$entries = array();
		
		$res = mysqli_query($this->mysqli, "SELECT * FROM entries LIMIT $start, 10");
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
	
	/**
	 * get an entry with a specified ID
	 * @param number $id the ID of the entry
	 * @return Entry the entry
	 */
	public function getEntry($id){
		$res = mysqli_query($this->mysqli, "SELECT * FROM entries WHERE id=$id");
		if(!$res){
			header( 'Location: createEntry.php?error=notExisting') ;
		}else{
			$row = $res->fetch_assoc();
			$list_id = $row['id'];
			$list_title = $row['title'];
			$list_description = $row['text'];
			$list_renderText = $row['textparse'];
			$entry = new Entry($list_id, $list_title, $list_description, $list_renderText);
			return $entry;
		}
	}
	
	/**
	 * save the new title and text a modified entry
	 * @param int $id the ID of the modified entry
	 * @param string $title the new title
	 * @param string $text the new text
	 */
	public function editEntry( $id, $title, $text){
		$entry = new Entry("", $title, $text);
		$textparse = $entry->getTextParse();
		if(mysqli_query($this->mysqli, "UPDATE entries SET title='$title', text='$text', textparse='$textparse' WHERE id=$id") === true){
			if(mysqli_query($this->mysqli, "DELETE FROM linklist WHERE fromID=$id") === true){
				$success = $this->insertLinkEntries($id, $entry->getLinkEntries());
				if($success){
					echo "Entry updated";
					//redirect to the created entry
					header( 'Location: show.php?id='.$id);
				}
			}			
		}else{
			echo "Entry not updated";
			
			header( 'Location: editEntry.php?error=unique&id='.$id);
		}
	}
	
	/**
	 * deletes an entry with a specified ID
	 * @param int $id the ID of the entry, which will be deleted
	 */
	public function deleteEntry($id){
		if(mysqli_query($this->mysqli, "DELETE FROM entries WHERE id=$id") === true){
			header( 'Location: createEntry.php') ;
		}
	}
	
	/**
	 * returns the ID of an entry with a specified title
	 * @param string $searchTitle the title of the entry
	 * @return number the ID of the entry
	 */
	public function getIdByTitle($searchTitle){
		$res = mysqli_query($this->mysqli, "SELECT * FROM entries WHERE title='$searchTitle'");
		$row = $res->fetch_assoc();
		$foundId = $row['id'];
		return $foundId;
	}
	
	/**
	 * returns the number of entries in the database, which contain a certain search term
	 * @param unknown_type $search the search term the user was looking for
	 * @return unknown the amount of entries containing the search term
	 */
	public function getNumberSearch($search){
		$res = mysqli_query($this->mysqli, "SELECT COUNT(*) as number FROM entries WHERE title LIKE '%$search%'");
		$row = $res->fetch_assoc();
		$number = $row['number'];
		return $number;
	}
	
	/**
	 * returns a specified amount of random entries from the database
	 * @param unknown_type $limit the amount of entries
	 * @return multitype: the array of random entries
	 */
	public function getRandomFromDatabase($limit){
		$found = array();
		$res = mysqli_query($this->mysqli, "SELECT * , id * RAND( ) FROM entries ORDER BY id * RAND( )  LIMIT $limit");
		while($row = $res->fetch_assoc()){
			$random_title = $row['title'];
			//create the new entry
			array_push($found, $random_title);
		}
		return $found;
	}
	
	/**
	 *
	 * get an amount of entries from a certain position with a certin search term
	 * @param string $search the search term the user was looking for
	 * @param number $start the position of the first entry to take from the database
	 * @return multitype: an array of entries
	 */
	public function searchEntry($search, $start){
		$found = array();
		$res = mysqli_query($this->mysqli, "SELECT * FROM entries WHERE title LIKE '%$search%' LIMIT $start, 10");
		while($row = $res->fetch_assoc()){
			$list_id = $row['id'];
			$list_title = $row['title'];
			$list_description = $row['text'];
			//create the new entry
			$entry = new Entry($list_id, $list_title, $list_description);
			array_push($found, $entry);
		}
		return $found;		
	}
	
	/**
	 * inserts all entries which link a certain entry in their text
	 * @param unknown_type $id the ID of the enry which is linked by other entries
	 */
	public function insertLinkEntries($id, $linkEntries){
		$success = true;
		$idFrom = $id;
		foreach($linkEntries as $title){
			$res = mysqli_query($this->mysqli, "SELECT id FROM entries WHERE title = '$title'");
			$row = $res->fetch_assoc();
			$idTo = $row['id'];
			if($idTo != ''){
				if(mysqli_query($this->mysqli,"INSERT INTO linklist(id, toId, fromId) VALUES (NULL, '$idTo','$idFrom')") !== true){
					$success = false;
				}
			}
			
		}
		return $success;
	}
	
	/**
	 * Get all Articles which link on a certain article
	 * @param $id of the article
	 * @return multitype: array with all links
	 */
	public function getLinks($id){
		$links = array();
		$res = mysqli_query($this->mysqli, "SELECT fromId FROM linklist WHERE toID=$id");		
		while($row = $res->fetch_assoc()){
			$list_id = $row['fromId'];
			array_push($links, $list_id);
			$res2 = mysqli_query($this->mysqli, "SELECT title FROM entries WHERE id=$list_id");
			$row2 = $res2->fetch_assoc();
			$list_title = $row2['title'];
			array_push($links, $list_title);
		}
		return $links;
	}
	
	public function createUser($username, $password){
		$hashedPassword = hash('sha256', $username . $password);
		if(mysqli_query($this->mysqli,"INSERT INTO user(id, username, password) VALUES (NULL, '".$username."','".$hashedPassword."')") !== true){
			return -1;
		}
		else{
			return $this->mysqli->insert_id;
		}
	}
	
	public function login($username, $password){
		$res = mysqli_query($this->mysqli, "SELECT * FROM user WHERE username='$username'");
		if($res !== false){
			$row = $res->fetch_assoc();
			$userId = $row['id'];
			$hashedPassword = hash('sha256', $username . $password);
			$storedPassword = $row['password'];
			if($hashedPassword !== $storedPassword){
				return -1;
			}
			else{
				return $userId;
			}
		}
		else{
			return $this->createUser($username, $password);
		}
	}
}


?>
