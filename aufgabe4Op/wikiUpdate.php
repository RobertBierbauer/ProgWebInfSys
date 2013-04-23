<?php
require_once('entry.php');
require_once('databaseConnect.php');

//Post method for create and edit an entry
if(isset($_POST['title']) && isset($_POST['text'])){
	
	//check if all fields are set
	if($_POST['title'] == '' || $_POST['text'] == ''){	
		if($_POST['title'] == '' && $_POST['text'] == ''){
			header( 'Location: editEntry.php?error=both') ;
		}	
		elseif($_POST['title'] === ''){
			header( 'Location: editEntry.php?error=title') ;
		}else{
			header( 'Location: editEntry.php?error=text') ;

		}
	}else{
		echo "sdfadsa";
		//Get title and description from post method
		$id = $_POST['id'];
		$title = $_POST['title'];
		$text = $_POST['text'];
		
		$db = new DatabaseConnect();
		$db->editEntry($id, $title, $text);		
	}
	
}

?>