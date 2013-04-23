<!-- View show an entry from the wiki -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link href="../bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
	<title>Gruppe 1</title>
</head>
<body id="home">
	<div class="row-fluid">
		<?php $startTime = microtime();?>
		<?php include "../navbar.html";?>
		<?php include 'sidebar.php';?>		
		<div class="span8">
			<legend><?php echo $entryShow->getTitle();?></legend>
			<p><?php echo $entryShow->getTextFormat();?></p>
			<p>Eintr&auml;ge mit Link auf diesen Artikel:</p>
			<ul>
			<?php 
			for($i = 0; $i < count($links); $i+=2){
				echo "<li><a href=?id=".$links[$i].">".$links[($i+1)]."</a></li>";
			}
			
			?>
			</ul>
			<div class="row-fluid">
			<div class="span1">
				<a class='btn btn-primary' href='editEntry.php?id=<?php echo $entryShow->getId() ?>'>Bearbeiten</a>
			</div>
			<div class="span1">
				<form action="wikiDelete.php" method="POST">
					<input type="hidden" name="id" value=<?php echo $entryShow->getId() ?>>
					<button type="submit" class="btn btn-danger">L&ouml;schen</button>
				</form>
			</div>
			</div>
		</div>
		<?php $endTime = microtime(); ?>
		<div class="row-fluid">
			<?php echo "Seitenaufbauzeit: ".($endTime - $startTime);?>
		</div>
	</div>
</body>
</html>
