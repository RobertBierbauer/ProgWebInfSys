<?php
require_once('user.php');
require_once('databaseConnect.php');

//Post method for create and edit an entry
if(isset($_POST['username']) && isset($_POST['password'])){

	//check if all fields are set
	if($_POST['username'] == '' || $_POST['password'] == ''){
		if($_POST['username'] == '' && $_POST['password'] == ''){
			header( 'Location: loginView.php?error=both') ;
		}
		elseif($_POST['username'] === ''){
			header( 'Location: loginView.php?error=username') ;
		}else{
			header( 'Location: loginView.php?error=password') ;

		}
	}else{

		//Get title and description from post method
		$username = $_POST['username'];
		$password = $_POST['password'];

		$db = new DatabaseConnect();
		$userId = $db->login($username, $password);
		if($userId === -1){
			echo "wrongPassword";
			header( 'Location: loginView.php?error=wrongPassword') ;
		}
		else{
			if(!isset($_SESSION)){
				session_start();
			}
			$_SESSION['user'] = $userId;
			echo "login";
			header( 'Location: entries.php') ;
		}
	}

}

?>