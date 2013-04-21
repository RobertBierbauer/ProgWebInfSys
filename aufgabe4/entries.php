<?php
require_once('entry.php');
	
require_once('databaseConnect.php');

$db = new DatabaseConnect();
$number = $db->getNumberEntries();

require_once 'pagination.php';

$entries = $db->getAllLimit($start);

	

include 'entriesView.php';
?>
