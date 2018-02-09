<?php

session_start();
include_once('../config/init.php');
include_once('../database/users.php');

//   2. Adicionar utilizador

    if (""==trim($_POST['email']) || ""==trim($_POST['password']) || ""==trim($_POST['nome']) || ""==trim($_POST['tipo']) || ""==trim($_POST['nomeuser'])){
		header("Location: ../pages/OperadorPage.php?error=1");
		exit;
	}
	
	$email = $_POST["email"];
	$pass = $_POST["password"];
	$nome = $_POST["nome"];
	$permissao = $_POST["tipo"];
	$usN = $_POST["nomeuser"];
	
	$result = adicionarUser($nome, $usN, $email, $permissao, $pass);
	
	if (!$result){
		header("Location: ../pages/OperadorPage.php?error=2");
		exit;
	}
	
	header("Location: ../pages/OperadorPage.php?error=0");

?>