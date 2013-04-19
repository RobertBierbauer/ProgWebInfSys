<?php


if(isset($_POST['id'])){
	
	$id = $_POST['id'];
	
	include 'databaseConnect.php';
	
	if($mysqli->query("DELETE FROM entries WHERE id=$id") === true){
		header( 'Location: createEntry.php') ;
	}
}
