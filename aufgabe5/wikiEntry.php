<?php
require_once('entry.php');
require_once('databaseConnect.php');

//Post method for create and edit an entry
if(isset($_POST['title']) && isset($_POST['text'])){
	
	//check if all fields are set
	if($_POST['title'] == '' || $_POST['text'] == ''){	
		if($_POST['title'] == '' && $_POST['text'] == ''){
			header( 'Location: createEntry.php?error=both') ;
		}	
		elseif($_POST['title'] === ''){
			header( 'Location: createEntry.php?error=title') ;
		}else{
			header( 'Location: createEntry.php?error=text') ;

		}
	}else{
		
		$db = new DatabaseConnect();
		
		//Get title and description from post method
		$title = $_POST['title'];
		$text = $_POST['text'];
		
		
		if(isset($_FILES["image"]) && $_FILES["image"]["name"] !== ''){
			define ('SITE_ROOT', realpath(dirname(__FILE__)));
			
			if(isset($_POST['position']) && $_POST['position'] !== ''){
				$position = $_POST['position'];
				if($position != 0 || $position != 1){
					$position = 1;
				}
			}else{
				$position = 1;
			}
			
			echo "Position".$position;
			
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$name = $_FILES["image"]["name"];
			$type = $_FILES["image"]["type"];
			$size = $_FILES["image"]["size"];
			echo $size;
			$tmp = explode(".", $name);
			$extension = end($tmp);
			if ((($_FILES["image"]["type"] == "image/gif")
					|| ($type == "image/jpeg")
					|| ($type == "image/jpg")
					|| ($type == "image/pjpeg")
					|| ($type == "image/x-png")
					|| ($type == "image/png"))
					&& ($size < 8000000)
					&& in_array($extension, $allowedExts))
			{
				$nextId = $db->getLastId()+1;
				$newname = SITE_ROOT."/upload/image".$nextId.".png";
				if (!file_exists($newname)) {
					if ((move_uploaded_file($_FILES['image']['tmp_name'],$newname))) {
						echo "It's done! Saved file: ".$newname;
						if($db->insertImage($name, $nextId.".png", $position)){
							$db->insertEntry($title, $text, $nextId);
						}					
					}else{
						echo "An error occurred during file upload!";
					}
				}
			}else{
				echo "Invalid file";
			}
		}else{
			echo "kein Bild";
			$db->insertEntry($title, $text, NULL);
		}

		
		
			
	}
	
}

?>