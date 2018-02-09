<?PHP
	session_start();
	include_once('../config/init.php');
	include_once($BASE_DIR.'database/events.php');
?>
<?php
	
	// Erro #1 -> Falta de Parâmetros - Neste caso, contactar admin
	if(!isset($_GET['id'])){
		header("Location: ../pages/dashboard.php?error=11");
		exit;
	}

	$id = $_GET['id'];
	
	// Erro #2 -> Query à BD falhou - Contactar admin
	if (!deleteEvent($id)){
		header("Location: ../pages/dashboard.php?error=12");
		exit;
	}
	
	// Erro #0 -> SUCCESS!
	header("Location: ../pages/dashboard.php?error=10");
	exit;

?>
