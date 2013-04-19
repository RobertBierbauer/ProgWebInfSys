<!-- View show an entry from the wiki -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link href="../bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
	<title>Gruppe 1</title>
</head>
<body id="home">
	<?php include "../navbar.html";?>
	<?php 
		require_once('wiki.php');
		require_once('entry.php');
				
		if(!isset($_SESSION)){
			session_start();
		}
		if(isset($_GET['title'])) {
			$wiki = $_SESSION['wiki'];
			$entry = $wiki->getEntry($_GET['title']);
			$title = $entry->getTitle();
			$description = $entry->getDescriptionFormat();
		}
	?>
	<div class="row-fluid">
		<?php include 'entries.php';?>
		<div class="span8">
			<legend><?php if(isset($title)){echo $title;}?></legend>
			<p><?php if(isset($description)){echo $description;}?></p>
			<?php
				echo "<a class='btn btn-primary' href='createEditEntry.php?title=".$entry->getTitle()."'>Bearbeiten</a>";
				echo " <a class='btn btn-danger' href='wikiEntry.php?remove=".$title."'>L&ouml;schen</a>";
			 ?>
		</div>
	</div>
</body>
</html>