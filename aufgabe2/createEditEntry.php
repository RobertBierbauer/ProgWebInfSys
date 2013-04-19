<!-- View to create or edit entries -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link href="../bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
	<title>Gruppe 1</title>
</head>
<body id="home">
	<?php include "../navbar.html";?>
	<div class="row-fluid">
		<?php include 'entries.php';?>
		<div class="span8">
			<legend>Eintrag erstellen und bearbeiten</legend>
			<?php 
				require_once('entry.php');
				if (isset($_GET['title'])) {
					$wiki = $_SESSION['wiki'];
					$entry = $wiki->getEntry($_GET['title']);
					$title = $entry->getTitle();
					$description = $entry->getDescription();
				}
				
				if(isset($_GET['error'])){
					if($_GET['error'] === 'both'){
						echo '<div class="alert">'.
							 '<strong>Fehler!</strong><br>Titel und Beschreibung eingeben.'.
							 '</div>';
					}
					elseif($_GET['error'] === 'title'){
						echo '<div class="alert">'.
								'<strong>Fehler!</strong><br>Titel eingeben.'.
							 '</div>';
					}else{
						echo '<div class="alert">'.
								'<strong>Fehler!</strong><br>Beschreibung eingeben.'.
							 '</div>';
					}
				}
			?>
			
			<form action="wikiEntry.php" method="POST">
				<label for="title">Titel</label>
				<textarea class="row-fluid title" type="text" rows="1" name="title"><?php if(isset($title)){echo $title;}?></textarea>
				<label>Beschreibung</label>
				<textarea class="row-fluid" rows="3" name="description"><?php if(isset($description)){echo $description;}?></textarea><br>
				<button type="submit" class="btn btn-primary">Speichern</button>
			</form>
		</div>
	</div>
</body>
</html>
