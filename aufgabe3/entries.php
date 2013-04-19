<?php
require_once('entry.php');
	
require_once('databaseConnect.php');

$db = new DatabaseConnect();
$entries = $db->getAll();	

include 'entriesView.php';
?>
