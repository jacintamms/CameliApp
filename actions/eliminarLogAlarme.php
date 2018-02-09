
<?php
	session_start();
	include_once('../config/init.php');
	include_once($BASE_DIR.'database/alarmes.php');
	
	if(!isset($_GET['id'])){
		header("Location: ../pages/historyAlarms.php?error=22");
		exit;
	}
	
	$id = $_GET['id'];
    
	if (!deleteFromLog($id)){
		header("Location: ../pages/historyAlarms.php?error=23");
		exit;
	}
	   
	header("Location: ../pages/historyAlarms.php?error=20");
	exit;


?>


