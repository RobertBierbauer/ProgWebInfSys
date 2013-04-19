<?php 	
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
	}elseif($_GET['error'] === 'notExisting'){
		$error = '<div class="alert">'.
				 	'<strong>Fehler!</strong><br>Artikel existiert nicht. M&ouml;chtest du ihn erstellen?'.
				 '</div>';
	}
}

include 'createView.php';
?>
