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
	<?php include "../navbar.html";?>
	<div class="row-fluid">
		<?php include 'sidebar.php';?>
		<div class="span8">
			<?php echo $error;?>
			<legend>Eintrag erstellen und bearbeiten</legend>			
			<form enctype="multipart/form-data" action="wikiUpdate.php" method="POST">
				<input type="hidden" name="id" value=<?php echo $entryEdit->getId();?>>
				<input type="hidden" name="imageId" value=<?php echo $entryEdit->getImage()?>>
				<label for="title">Titel</label>
				<textarea class="row-fluid title" type="text" rows="1" name="title"><?php echo $entryEdit->getTitle();?></textarea>
				<label>Beschreibung</label>
				<textarea class="row-fluid" rows="3" name="text"><?php echo $entryEdit->getText();?></textarea><br>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				<?php 
					if($image != 0){
						echo "<label>Aktuelles Bild</label>";
						echo "<img style='width: 260px; height: 180px;' src='upload/image".$image[0]."'><br><br>"; 
					}
				?>
				<label>Bild:</label>
				<input name="image" type="file"/><br><br>				
				<label>Bildposition (0 für rechts, 1 für links)</label>
				<input name="position" type="text" value=<?php echo $image[1];?>><br>	
				<button type="submit" class="btn btn-primary">Speichern</button>
			</form>
		</div>
	</div>
</body>
</html>
