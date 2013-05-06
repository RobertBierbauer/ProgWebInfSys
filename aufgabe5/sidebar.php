<!-- Sidebar -->
<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Erstellen</li>
			<li><a href="<?php echo  str_replace("\\", "/", dirname($_SERVER['SCRIPT_NAME']));?>/createEntry.php">Wikieintrag erstellen</a></li>
			<li class="nav-header">Wiki Eintr&auml;ge</li>
			<br>
			<div class="input-append">
				<form action="search.php" method="GET">
			    	<input class="span8" name="search" type="text">
			    	<button type="submit" class="btn" type="button">Suchen</button>
			    </form>
		    </div>
		    <li><a href="<?php echo  str_replace("\\", "/", dirname($_SERVER['SCRIPT_NAME']));?>/entries.php">Alle Eintr&auml;ge anzeigen</a></li>
		    <li><a href="<?php echo  str_replace("\\", "/", dirname($_SERVER['SCRIPT_NAME']));?>/generator.php">Zuf&auml;llige Eintr&auml;ge generieren</a></li>
		    <?php 
				if(!isset($_SESSION)){
					session_start();
				}
				if(!isset($_SESSION['user'])){
					echo '<a href="loginView.php">Login</a>';
				}
				else{
					echo '<a href="logout.php">Logout</a>';
				}
			?>
		</ul>
	</div>
</div>
