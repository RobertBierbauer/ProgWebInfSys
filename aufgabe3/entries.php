<?php
require_once('wiki.php');
require_once('entry.php');
	
include 'databaseConnect.php';
	
$res = $mysqli->query("SELECT * FROM entries");
	
$wiki = new Wiki();
while ($row = $res->fetch_assoc()) {
	$list_id = $row['id'];
	$list_title = $row['title'];
	$list_description = $row['description'];
	//create the new entry
	$entry = new Entry($list_id, $list_title, $list_description);
	$wiki->addEntry($entry);
}

$entries = $wiki->getEntries();

include 'entriesView.php';
?>
