
<?php

	session_start();
	include_once('../config/init.php');
	include_once($BASE_DIR.'database/events.php');
	
	#Erro #4-> Not enough info

	if (!$_POST['evento'] || !$_POST['descricao'] || !$_POST['date'] || !$_POST['prioridade']) {
		header("Location: ../pages/dashboard.php?error=4");
		exit;
	}
	
	
    $titulo = $_POST['evento'];
    $descricao = $_POST['descricao'];
    $data = $_POST['date'];
    $prioridade = $_POST['prioridade'];
	
	#Erro #2 -> Merda grossa
	if (!createEvent($titulo, $descricao, $data, $prioridade)){
		header("Location:../pages/dashboard.php?error=2");
		exit;
	}

   header("Location:../pages/dashboard.php?error=0");

?>
