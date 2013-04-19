<?php

require_once('wiki.php');
require_once('entry.php');

include 'databaseConnect.php';

$error = '';

if(isset($_GET['error'])){
	if($_GET['error'] === 'both'){
		$error = '<div class="alert">'.
				'<strong>Fehler!</strong><br>Titel und Beschreibung eingeben.'.
				'</div>';
	}
	elseif($_GET['error'] === 'title'){
		$error = '<div class="alert">'.
				'<strong>Fehler!</strong><br>Titel eingeben.'.
				'</div>';
	}elseif($_GET['error'] === 'description'){
		$error = '<div class="alert">'.
				'<strong>Fehler!</strong><br>Beschreibung eingeben.'.
				'</div>';
	}elseif($_GET['error'] === 'unique'){
		$error = '<div class="alert">'.
				'<strong>Fehler!</strong><br>Titel existiert bereits.'.
				'</div>';
	}
}

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$res = $mysqli->query("SELECT * FROM entries WHERE id=$id");
	$row = $res->fetch_assoc();
	$title = $row['title'];
	$description = $row['description'];
}

include 'editEntryView.php';

?>