<?php
	
	session_start();
	
	if (!isset($_SESSION['autenticado']))
		$_SESSION['autenticado'] = 0; //0 - Não tem o Login feito, 1 - Tem login feito como cliente, 2 - Tem login feito como admin
	
	if(!isset($_SESSION['nomeUser']))
		$_SESSION['nomeUser'] = null;
	
	if(!isset($_SESSION['error_messages']))
		$_SESSION['error_messages'][] = "";
		

	/*if(!isset($_SESSION['form_values']))
		$_SESSION['form_values'] = "";
	
	if(!isset($_SESSION['success_messages']))
		$_SESSION['success_messages'][]= "";*/
	
	$conn = new PDO('pgsql:host=db.fe.up.pt;dbname=ee08160', 'ee08160', 'seai');
	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare('SET SCHEMA \'vinha\'');
	$stmt->execute();

	$BASE_DIR = dirname(__DIR__).'/';
//	$BASE_URL = 'https://gnomo.fe.up.pt/~ee12014/CameliApp_V12/';

	
?>