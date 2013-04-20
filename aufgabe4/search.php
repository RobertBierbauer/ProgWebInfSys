<?php

require_once('databaseConnect.php');

if(isset($_GET['search'])){

	$search = $_GET['search'];

	$db = new DatabaseConnect();
	$number = $db->getNumberSearch($search);
	
	require_once 'pagination.php';
	
	$entries = $db->searchEntry($search, $start, $end);
	
	include 'searchView.php';
}

?>
