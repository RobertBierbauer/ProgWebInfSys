<!-- View with all tasks given in the Proseminar -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
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
		<p>Fehlende Features: Keine! </p>
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
		<p>Fehlende Features: Keine! </p>
		<a href="aufgabe3/createEntry.php">Wiki</a>
		
		<h3>Aufgabe4</h3>
		<ul>
			<li>Paginator</li>
			<li>Suche nach Titel</li>
			<li>Linkliste - wer link auf mich</li>
			<li>Generator f&uuml;r 10.000 Eintr&auml;ge</li>
			<li>Datenbank Optimierungen</li>
		</ul>
		<p>Fehlende Features: Keine! </p>
		<a href="aufgabe4/createEntry.php">Wiki</a></br>
		<a href="aufgabe4Op/createEntry.php">Wiki Optimiert</a>
		
		<h3>Aufgabe5</h3>
		<ul>
			<li>user-friendly URLs</li>
			<li>Bilder-Upload</li>
			<li>Usermanagement</li>
		</ul>
		
		<p>Fehlende Features: Keine! </p>
		<a href="aufgabe5/createEntry.php">Wiki</a>
		
		<h3>Aufgabe 6</h3>
		<ul>
			<li>Rock-paper-scissors-lizard-Spock</li>
			<li>Realisieren mit:</li>
			<ul>			
				<li>Zend Framework 2</li>
				<li>MVC Pattern</li>
				<li>Datenbankabstraktion von ZF2</li>
			</ul>
		</ul>
		<p>Fehlende Features: Keine! </p>
		<a href="aufgabe6/public/game">Rock Paper Scissors Lizard Spock</a>
		
		<h3>Aufgabe 7</h3>
		<ul>
			<li>Rock-paper-scissors-lizard-Spock Extended</li>
			<li>ZF DB-Abstraktion</li>
			<li>/game -> public Ordner (kein public in URL sichtbar)</li>
			<li>Email Versand, ZF, SMTP: smtp.uibk.ac.at</li>
			<ul>			
				<li>Einladung</li>
				<li>Resultat</li>
			</ul>
			<li>Revanche starten nach Spiel</li>
			<li>HFormular&uuml;berpr&uuml;fung mit JavaScript ohne JS-lib!</li>
			<li>Usability: Erkl&auml;rungen, Waffen-Auswahl &uuml;ber Bilder, CSS/Design</li>
			<li>Wiedererkennung per Cookie -> Vorausf&uuml;llen der eigenen Daten</li>
			<li>Testspiele: 10 Personen -> Feedback sammeln und dokumentieren</li>
		</ul>
		<p>Fehlende Features: Keine! </p>
		<a href="aufgabe7/game">Rock Paper Scissors Lizard Spock Extended</a>

		<h3>Aufgabe 8</h3>
		<ul>
			<li>Single Page Application (kein Reload der Seite) mit jQuery</li>
			<li>HTML wird nicht mehr vom Server dynamisch generiert</li>
			<li>Anzeige der Highscores mit automatischen Reload (alle 30 Sekunden) in der Single Page Application</li>
			<li>Gesamte Kommunikation mit dem Server &uuml;ber AJAX (jQuery)</li>
			<li>Installation MongoDB am Server</li>
			<li>Adaptierung Speicherung der Spiele von MySQL nach MongoDB</li>
			<li>Eingabe von Textnachrichten: beide Spieler k&ouml;nnen bei jedem Zug eine Textnachricht f&uuml;r den anderen Spieler setzen. Die zwei Nachrichten sollen jeweils zusammen mit dem Spiel in der DB gespeichert werden. </li>
		</ul>
		<p>Fehlende Features: Keine! </p>
		<a href="aufgabe8/game">Rock Paper Scissors Lizard Spock Single Page App + MongoDB</a>
		
		<h3>Aufgabe 9</h3>
		<ul>
			<li>Single Page App mit nur einer index.html</li>
			<li>Client-Routen �ber Anchor #</li>
			<li>User-Tests (min. 5 Benutzer_innen, Feedback protokollieren)</li>
			<li>Usabilityverbesserungen, im besonderen:</li>
			<ul>
				<li>Feedback bei AJAX (Loading, Sending, etc...)</li>
				<li>Beschreibung zu Spiel Ablauf (Emails + Web)</li>
				<li>Einfache Sprache
			</ul>
		</ul>
		<p>Fehlende Features: Keine! </p>
		<a href="aufgabe9/game">Rock Paper Scissors Lizard Spock Single Page App + MongoDB userfriendly</a><br>
		<a href="/Feedback.html">User Feedback zu Aufgabe 9</a>
		
		<h3>Aufgabe 10</h3>
		<ul>
			<li>Installation Node.js am Server</li>
			<li>Entwicklung Web-Chat-Systems mit Node.js und Socket.IO</li>
		</ul>
		<p>Fehlende Features: Keine! </p>
		<a href=":9000">Chat room</a>
		<br><br><br>
	</div>
</body>
</html>
