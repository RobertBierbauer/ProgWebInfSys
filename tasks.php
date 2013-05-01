<!-- View with all tasks given in the Proseminar -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link href="/ProgWebInfSys/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
	<title>Gruppe 1</title>
</head>
<body id="home">
	<?php include 'navbar.php';?>
	<div class=" span12 offset1">
		<h3>Aufgabe1</h3>
		<ul>
			<li>Server aufsetzen und absichern</li>
    		<li>Little-Boxes Kapitel I-IV lesen und verstehen</li>
    		<li>Gruppenwebsite erstellen</li>
		</ul>
		<h3>Aufgabe2</h3>
		<ul>
			<li>Wiki erstellen mittels Session</li>
		</ul>	
		<a href="aufgabe2/createEditEntry.php">Wiki</a>
		<h3>Aufgabe3</h3>
		<ul>
			<li>MySQL-Server & phpMyAdmin installieren</li>
			<li>Datenbankschema f&uuml;r Wiki entwerfen</li>
			<li>Umsetzen des Schemas in MySQL</li>
			<li>Adaption des Wikis</li>
			<ul>
				<li>MySQL als Storage-Backend verwenden</li>
				<li>&Uuml;berpr&uuml;fung von allen Benutzereingaben und Anzeige von Fehlermeldungen</li>
				<li>Sauberes Handling von Sonderzeichen</li>
				<li>Refactoring auf objektorientierte Architektur</li>
			</ul>
		</ul>
		<a href="aufgabe3/createEntry.php">Wiki</a>
		
		<h3>Aufgabe4</h3>
		<ul>
			<li>Paginator</li>
			<li>Suche nach Titel</li>
			<li>Linkliste - wer link auf mich</li>
			<li>Generator f&uuml;r 10.000 Eintr&auml;ge</li>
			<li>Datenbank Optimierungen</li>
		</ul>
		<a href="aufgabe4/createEntry.php">Wiki</a>
		<a href="aufgabe4Op/createEntry.php">Wiki Optimiert</a>
		
		<h3>Aufgabe5</h3>
		<ul>
			<li>user-friendly URLs</li>
			<li>Bilder-Upload</li>
			<li>Usermanagement</li>
		</ul>
		<a href="aufgabe5/createEntry.php">Wiki</a>
	</div>
</body>
</html>