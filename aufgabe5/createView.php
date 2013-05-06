<!-- View to create entries -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Gruppe 1</title>
</head>
<body id="home">
	<?php 
		if(!isset($_SESSION)){
			session_start();
		}
		if(!isset($_SESSION['user'])){
			header('Location: loginView.php');
		}
	?>
	<?php include "../navbar.php";?>
	<div class="row-fluid">
		<?php include 'sidebar.php';?>
		<div class="span8">
			<?php echo $error;?>
			<legend>Eintrag erstellen</legend>			
			<form enctype="multipart/form-data" action="wikiEntry.php" method="POST">
				<label for="title">Titel</label>
				<textarea class="row-fluid title" type="text" rows="1" name="title"></textarea>
				<label>Beschreibung</label>
				<textarea class="row-fluid" rows="3" name="text"></textarea>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				<label>Bild:</label>
				<input name="image" type="file"/><br><br>				
				<label>Bildposition (0 für rechts, 1 für links)</label>
				<input name="position" type="text"><br>
				<button type="submit" class="btn btn-primary">Speichern</button>
			</form>
		</div>
	</div>
</body>
</html>
