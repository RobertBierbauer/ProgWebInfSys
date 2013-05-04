<?php 
	require_once('entry.php');
	require_once('databaseConnect.php');
		
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$db = new DatabaseConnect();
		$entryShow = $db->getEntry($id);
		$links = $db->getLinks($id);
		
		$image = $db->getImage($entryShow->getImage());
		
		$creatorUser = $db->getUser($entryShow->getCreatorId());
		
		if($entryShow->getCreatorId() === $entryShow->getlastModifier()){
			$lastModifier = $creatorUser;
		}
		else{
			$lastModifier = $db->getUser($entryShow->getLastModifier());
		}
		
	}
	
	//no picture
	if($image === 0){
		include 'showView.php';
	}
	//picture on the left side
	elseif($image[1] == 1){
		include 'showImageLeft.php';
	}
	//picture on the right side
	else{
		include 'showImageRight.php';
	}
	
	
?>
