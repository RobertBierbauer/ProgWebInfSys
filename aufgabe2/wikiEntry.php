<?php

require_once('wiki.php');
require_once('entry.php');



session_start();
if (!isset($_SESSION['start'])) {
	$_SESSION['start'] = time();
	$_SESSION['wiki'] = new Wiki();
}

//Post method for create and edit an entry
if(isset($_POST['title']) && isset($_POST['description'])){
	
	if($_POST['title'] == '' || $_POST['description'] == ''){	
		if($_POST['title'] == '' && $_POST['description'] == ''){
			header( 'Location: createEditEntry.php?error=both') ;
		}	
		elseif($_POST['title'] === ''){
			header( 'Location: createEditEntry.php?error=title') ;
		}else{
			header( 'Location: createEditEntry.php?error=description') ;

		}
	}else{
	
		//Get title and description from post method
		$title = $_POST['title'];
		$description = $_POST['description'];
		
		//create the new entry
		$entry = new Entry($title, $description);	
		
		//store entry in the wiki and write the wiki back in the session
		$wiki = $_SESSION['wiki'];
		$wiki->addEntry($entry);
		$_SESSION['wiki'] = $wiki->getClass();	
	
		//redirect to the created entry
		header( 'Location: show.php?title='.$title) ;
	}
	
}

//Get method for removing an entry
if(isset($_GET['remove'])){
	$title = $_GET['remove'];
	$wiki = $_SESSION['wiki'];
	$wiki->deleteEntry($title);
	$_SESSION['wiki'] = $wiki->getClass();

	//redirect to the create entry view
	header( 'Location: createEditEntry.php') ;
}

?>