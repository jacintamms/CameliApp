<?php

	include_once('../config/init.php');
	include_once('../database/sensores.php');  

	if (!isset($_POST['tipo']) || !isset($_POST['ativo']) || !isset($_POST['id_localizacao'])){
		echo "<script>location.href='../pages/zona1.php?id_localizacao=".$id_localizacao."&error=2';</script>";
		exit;
	}
	
    $tipo = ($_POST['tipo']);
	$ativo = ($_POST['ativo']);
	$id_localizacao = ($_POST['id_localizacao']);
	
	if(!novo_sensor($tipo, $ativo, $id_localizacao)){
		echo "<script>location.href='../pages/zona1.php?id_localizacao=".$id_localizacao."&error=2';</script>";
		exit;
	}

	echo "<script>location.href='../pages/zona1.php?id_localizacao=".$id_localizacao."&error=30';</script>"; 
	exit;
?>