<?php 
	require_once('wiki.php');
	require_once('entry.php');
	
	include 'databaseConnect.php';
	include 'search.php';
		
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$res = $mysqli->query("SELECT * FROM entries WHERE id=$id");
		if(!$res){
			header( 'Location: createEntry.php?error=notExisting') ;
		}else{
			$row = $res->fetch_assoc();
			$title = $row['title'];
			$description = $row['description'];
			$entry = new Entry($id, $title, $description);
			$description = $entry->getDescriptionFormat();
		}
		
	}
	
	include 'showView.php';
?>
