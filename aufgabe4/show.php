<?php 
	require_once('entry.php');
	require_once('databaseConnect.php');
		
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$db = new DatabaseConnect();
		$entryShow = $db->getEntry($id);
	}
	
	include 'showView.php';
?>
