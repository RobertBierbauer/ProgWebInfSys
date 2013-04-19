<?php

require_once('wiki.php');
require_once('entry.php');

//Post method for create and edit an entry
if(isset($_POST['title']) && isset($_POST['description'])){
	
	//check if all fields are set
	if($_POST['title'] == '' || $_POST['description'] == ''){	
		if($_POST['title'] == '' && $_POST['description'] == ''){
			header( 'Location: editEntry.php?error=both') ;
		}	
		elseif($_POST['title'] === ''){
			header( 'Location: editEntry.php?error=title') ;
		}else{
			header( 'Location: editEntry.php?error=description') ;

		}
	}else{
		
		//Get title and description from post method
		$id = $_POST['id'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		
		include 'databaseConnect.php';
		
		if($mysqli->query("UPDATE entries SET title='$title',description='$description' WHERE id=$id") === true){
			echo "Entry updated";			
			
			//redirect to the created entry
			header( 'Location: show.php?id='.$id);
			
		}else{
			echo "Entry not updated";
			
			header( 'Location: editEntry.php?error=unique&id='.$id);
		}
		
	
		
		
	}
	
}

?>