<?php
require_once('entry.php');
require_once('databaseConnect.php');

//Post method for create and edit an entry
if(isset($_POST['title']) && isset($_POST['text'])){
	
	//check if all fields are set
	if($_POST['title'] == '' || $_POST['text'] == ''){	
		if($_POST['title'] == '' && $_POST['text'] == ''){
			header( 'Location: createEntry.php?error=both') ;
		}	
		elseif($_POST['title'] === ''){
			header( 'Location: createEntry.php?error=title') ;
		}else{
			header( 'Location: createEntry.php?error=text') ;

		}
	}else{
		
		//Get title and description from post method
		$title = $_POST['title'];
		$text = $_POST['text'];
		
		$db = new DatabaseConnect();
		$db->insertEntry($title, $text);		
	}
	
}

?>