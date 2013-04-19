
<!-- Sidebar with all Entries -->
<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Erstellen</li>
			<li><a href="createEditEntry.php">Wikieintrag erstellen</a></li>
			<li class="nav-header">Eintr&auml;ge</li>
			<?php
			require_once('wiki.php');
			require_once('entry.php');
			if(!isset($_SESSION)){
				session_start();
			}
			if (isset($_SESSION['start'])) {
				$wiki = $_SESSION['wiki'];
				
				$entries = $wiki->getEntries();
				foreach($entries as $entry){
					echo "<li><a href='show.php?title=".$entry->getTitle()."'>".$entry->getTitle()."</a></li>";
				}
				
			}
			?>
		</ul>
	</div>
</div>
