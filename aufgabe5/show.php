<?php 
	require_once('entry.php');
	require_once('databaseConnect.php');
		
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$db = new DatabaseConnect();
		$entryShow = $db->getEntry($id);		
		$links = $db->getLinks($id);
		
		$creatorUser = $db->getUser($entryShow->getCreatorId());
		
		if($entryShow->getCreatorId() === $entryShow->getlastModifier()){
			$lastModifier = $creatorUser;
		}
		else{
			$lastModifier = $db->getUser($entryShow->getLastModifier());
		}
	}
	
	include 'showView.php';
?>
