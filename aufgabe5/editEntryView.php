<!-- View to edit entries -->
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
			<legend>Eintrag erstellen und bearbeiten</legend>			
			<form action="wikiUpdate.php" method="POST">
				<input type="hidden" name="id" value=<?php echo $entryEdit->getId();?>>
				<label for="title">Titel</label>
				<textarea class="row-fluid title" type="text" rows="1" name="title"><?php echo $entryEdit->getTitle();?></textarea>
				<label>Beschreibung</label>
				<textarea class="row-fluid" rows="3" name="text"><?php echo $entryEdit->getText();?></textarea><br>		
				<button type="submit" class="btn btn-primary">Speichern</button>
			</form>
		</div>
	</div>
</body>
</html>
