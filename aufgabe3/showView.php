<!-- View show an entry from the wiki -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link href="../bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
	<title>Gruppe 1</title>
</head>
<body id="home">
	<div class="row-fluid">
		<?php include "../navbar.php";?>
		<?php include 'entries.php';?>		
		<div class="span8">
			<legend><?php echo $entryShow->getTitle();?></legend>
			<p><?php echo $entryShow->getTextFormat();?></p>
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
	</div>
</body>
</html>
