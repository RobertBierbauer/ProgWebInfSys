<!-- View to show all entries -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Gruppe 1</title>
</head>
<body id="home">
	<?php include "../navbar.php";?>
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
					
					<?php
						if($numberAll > 0) {
							echo "<li><a href=?start=$previous><<</a></li>";
							if($currentPage > 5){
								echo "<li><a href=?start=0>1</a></li>";
								echo "<li><a>...</a></li>";
									
							}
							for($i = $firstPage; $i < $range; $i++){
								if($i != ($start/10)){
									echo "<li><a href=?start=".($i*10).">".($i+1)."</a></li>";
								}
								else{
									echo "<li class='active'><a>".($i+1)."</a></li>";
								}
							}
							if($range < $numberPages){
								echo "<li><a>...</a></li>";
								echo "<li><a href=?start=".(($numberPages-1)*10).">".($numberPages)."</a></li>";
							}
							echo "<li><a href=?start=$next>>></a></li>";
						}else{
							echo "<li><p>Keine Eintr&auml;ge vorhanden</p></li>";
						}
					?>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
