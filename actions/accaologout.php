<?php   
	
	include_once('../../config/init.php');
	
	session_start();
	
    setcookie(session_name(), '', 100);
	session_unset();
	session_destroy(); //destroy the session
	$_SESSION = array();
	header("Location: ../pages/LoginPage.php"); 

?>