<?php

function getIdByTitle($searchTitle){
	include 'databaseConnect.php';
	$res = $mysqli->query("SELECT * FROM entries WHERE title='$searchTitle'");
	$row = $res->fetch_assoc();
	$foundId = $row['id'];
	return $foundId;
}

?>