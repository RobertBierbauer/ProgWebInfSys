<!-- Sidebar with all Entries -->
<div class="span3">
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Erstellen</li>
			<li><a href="createEntry.php">Wikieintrag erstellen</a></li>
			<li class="nav-header">Eintr&auml;ge</li>
			<?php
			foreach($entries as $entry){
				echo "<li><a href='show.php?id=".$entry->getId()."'>".$entry->getTitle()."</a></li>";
			}
			?>
		</ul>
	</div>
</div>