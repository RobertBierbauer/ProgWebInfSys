<?php


if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['user'])){
	header('Location: loginView.php');
}

require_once('databaseConnect.php');

if(isset($_POST['id'])){
	
	$id = $_POST['id'];
	
	$db = new DatabaseConnect();
	$db->deleteEntry($id);
}
?>