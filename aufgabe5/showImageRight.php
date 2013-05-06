
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
			<div class="span8">
				<?php include 'showNoImage.php'?>
			</div>
			<?php echo "<div class='span3'><img src='".str_replace("\\", "/", dirname($_SERVER['SCRIPT_NAME']))."/upload/image".$image[0]."'></div>"; ?>
		</div>
	</div>
</body>
</html>

