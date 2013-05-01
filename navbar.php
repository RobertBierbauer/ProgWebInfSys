<!-- Navbar -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link href="/ProgWebInfSys/css/bootstrap.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="http://code.jquery.com/jquery.js"></script>
	<script language="JavaScript" src="/ProgWebInfSys/js/bootstrap.js"></script>
</head>
<div class="row-fluid">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<a class="brand" href="/ProgWebInfSys/index.php">Gruppe 1</a>
			<ul class="nav">
				<li><a href="/ProgWebInfSys/tasks.php">Aufgaben</a></li>
			</ul>
			<div class="pull-right">
			<?php 
				if(!isset($_SESSION)){
					session_start();
				}
				if(!isset($_SESSION['user'])){
					echo '<a class="brand" href="/ProgWebInfSys/aufgabe5/loginView.php">Login</a>';
				}
				else{
					echo '<a class="brand" href="/ProgWebInfSys/aufgabe5/logout.php">Logout</a>';
				}
			?>
				
			</div>
		</div>
	</div>
	
</div>