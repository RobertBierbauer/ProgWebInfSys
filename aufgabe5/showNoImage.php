

<p><?php echo $entryShow->getTextParse();?></p>
<p>Eintr&auml;ge mit Link auf diesen Artikel:</p>
<ul>
	<?php 
	for($i = 0; $i < count($links); $i+=2){
		echo "<li><a href=?id=".$links[$i].">".$links[($i+1)]."</a></li>";
	}
			
	?>
</ul>
			
<p>Erzeugt von <?php echo $creatorUser->getUsername()?> am <?php echo $entryShow->getCreateDate()?></p>
<p>Zuletzt bearbeitet von <?php echo $lastModifier->getUsername()?> am <?php echo $entryShow->getLastModifyDate()?></p>
<div class="row-fluid">
	<div class="span2">
		<a class='btn btn-primary' href='editEntry.php?id=<?php echo $entryShow->getId() ?>'>Bearbeiten</a>
	</div>
	<div class="span2">
		<form action="wikiDelete.php" method="POST">
			<input type="hidden" name="id" value=<?php echo $entryShow->getId() ?>>
			<button type="submit" class="btn btn-danger">L&ouml;schen</button>
		</form>
	</div>
</div>