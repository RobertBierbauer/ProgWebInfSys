<?php
$error = '';

if(isset($_GET['error'])){
	if($_GET['error'] === 'both'){
		$error = '<div class="alert">'.
				'<strong>Fehler!</strong><br>Benutzername und Passwort eingeben.'.
				'</div>';
	}
	elseif($_GET['error'] === 'username'){
		$error = '<div class="alert">'.
				'<strong>Fehler!</strong><br>Benutzername eingeben.'.
				'</div>';
	}elseif($_GET['error'] === 'password'){
		$error = '<div class="alert">'.
				'<strong>Fehler!</strong><br>Passwort eingeben.'.
				'</div>';
	}elseif($_GET['error'] === 'wrongPassword'){
		$error = '<div class="alert">'.
				'<strong>Fehler!</strong><br>Passwort ist nicht korrekt.'.
				'</div>';
	}
}
?>
