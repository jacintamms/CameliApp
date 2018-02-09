<?PHP
	session_start();
	include_once('../config/init.php');
	include_once($BASE_DIR.'database/alarmes.php');
?>
<?php  
	
	//Error 1 -> Passagem de dados inválida. Contactar admin
	if (!isset($_GET['id'])){
		header("Location: ../pages/Defalarmes.php?error=1");
		exit;
	}
	
	$id = $_GET['id'];
	
	//Erro 2 -> Erro de query/ligação à BD. Contactar admin
	if(!deleteAlarm($id)){
		header("Location: ../pages/Defalarmes.php?erro=2");
		exit;
	}
	
	header("Location: ../pages/Defalarmes.php?error=0");
	exit;
	
?> 
