<?php

require_once('wiki.php');
require_once('entry.php');

//Post method for create and edit an entry
if(isset($_POST['title']) && isset($_POST['description'])){
	
	//check if all fields are set
	if($_POST['title'] == '' || $_POST['description'] == ''){	
		if($_POST['title'] == '' && $_POST['description'] == ''){
			header( 'Location: createEntry.php?error=both') ;
		}	
		elseif($_POST['title'] === ''){
			header( 'Location: createEntry.php?error=title') ;
		}else{
			header( 'Location: createEntry.php?error=description') ;

		}
	}else{
		
		//Get title and description from post method
		$title = $_POST['title'];
		$description = $_POST['description'];
		
		include 'databaseConnect.php';
		
		if($mysqli->query("INSERT INTO entries(id, title, description) VALUES (NULL, '$title','$description')") === true){
			echo "Entry added";			

			$res = $mysqli->query("SELECT id FROM entries WHERE title='$title'");
			
			$row = $res->fetch_assoc();
			
			$id = $row['id'];
			
			//create the new entry
			$entry = new Entry($id, $title, $description);
			
			//redirect to the created entry
			header( 'Location: show.php?id='.$entry->getId());
			
		}else{
			echo "Entry not added";
			
			header( 'Location: createEntry.php?error=unique') ;
		}
		
	
		
		
	}
	
}

?>