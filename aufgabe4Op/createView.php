<!-- View to create entries -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Gruppe 1</title>
</head>
<body id="home">
	<?php include "../navbar.html";?>
	<?php $startTime = microtime();?>
	<div class="row-fluid">
		<?php include 'sidebar.php';?>
		<div class="span8">
			<?php echo $error;?>
			<legend>Eintrag erstellen und bearbeiten</legend>			
			<form action="wikiEntry.php" method="POST">
				<label for="title">Titel</label>
				<textarea class="row-fluid title" type="text" rows="1" name="title"></textarea>
				<label>Beschreibung</label>
				<textarea class="row-fluid" rows="3" name="text"></textarea><br>		
				<button type="submit" class="btn btn-primary">Speichern</button>
			</form>
		</div>
	</div>
	<?php $endTime = microtime(); ?>
	<div class="row-fluid">
		<?php echo "Seitenaufbauzeit: ".($endTime - $startTime);?>
	</div>
</body>
</html>
