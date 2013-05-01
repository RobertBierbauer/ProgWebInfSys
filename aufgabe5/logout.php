<?php
if(!isset($_SESSION)){
	session_start();
}
if(isset($_SESSION['user'])){
  	unset($_SESSION['user']);
  	header( 'Location: entries.php') ;
}
else{
	header( 'Location: entries.php') ;
}

?>