<?php

	include_once('../config/init.php');
	include_once('../database/sensores.php');  
	
	if (!isset($_GET['id_localizacao']) || !isset($_GET['id_sensor'])){
		echo "<script>location.href='../pages/zona1.php?id_localizacao=".$id_localizacao."&error=2';</script>";
		exit;
	}
	
	$id_localizacao=($_GET['id_localizacao']);
	$id_sensor=($_GET['id_sensor']);
	
	if(!desativar_sensor($id_sensor)){
		echo "<script>location.href='../pages/zona1.php?id_localizacao=".$id_localizacao."&error=2';</script>";
		exit;
	}


	echo "<script>location.href='../pages/zona1.php?id_localizacao=".$id_localizacao."&error=20';</script>"; 
	exit;
?>