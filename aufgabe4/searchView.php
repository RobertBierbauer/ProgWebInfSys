<!-- View to show all entries -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link href="../bootstrap.css" rel="stylesheet" type="text/css"	media="screen" />
	<title>Gruppe 1</title>
</head>
<body id="home">
	<?php include "../navbar.html";?>
	<div class="row-fluid">
		<?php include 'sidebar.php';?>
		<div class="span8">
			<legend>Eintr&auml;ge</legend>
			<table class="table table-hover">
				<tbody>			
					<?php
					foreach($entries as $entry){
						echo "<tr><td><a href='show.php?id=".$entry->getId()."'>".$entry->getTitle()."</a></td></tr>";
					}			
					?>
				</tbody>
			</table>
			<div class="pagination pagination-centered">
				<ul>
					<li><a href="?start=<?php echo $previous?>&search=<?php echo $search?>"><<</a></li>
					<?php 
					for($i = 0; $i < $numberPages; $i++){
						echo "<li><a href='?start=".($i*10)."&search=".$search."'>".($i+1)."</a></li>";
					}			
					?>
					<li><a href="?start=<?php echo $next?>&search=<?php echo $search?>">>></a></li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
