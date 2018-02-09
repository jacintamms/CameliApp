<?PHP
	session_start();
	include_once('../config/init.php');
	include_once('../database/users.php');
?>
<?php  

	if (!isset($_GET['user'])){
		header("Location: ../pages/listaUsers.php?error=1");
		exit();
	}
			
	$user = $_GET['user'];
	
	global $conn;
		
	$result = eliminarUser($user);
	
	if (!$result){
		header("Location: ../pages/listaUsers.php?error=2");
		exit();
	}
	
	header("Location: ../pages/listaUsers.php?error=0");
	
?> 
