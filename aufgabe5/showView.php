<!-- View show an entry from the wiki -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Gruppe 1</title>
</head>
<body id="home">
	<div class="row-fluid">
		<?php include "../navbar.php";?>
		<?php include 'sidebar.php';?>		
		<div class="span8">
			<legend><?php echo $entryShow->getTitle();?></legend>
			<?php include 'showNoImage.php'?>
		</div>
	</div>
</body>
</html>
