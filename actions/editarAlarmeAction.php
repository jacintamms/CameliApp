<?PHP

	session_start();
	include_once('../config/init.php');
	include_once($BASE_DIR.'database/alarmes.php');
	
	// ERROR #2 -> Faltam dados, Falar com admin.
	if (!isset($_GET['id'])){
		header("Location: ../pages/Defalarmes.php?error=2");
		exit;
	}

	$id = $_GET['id'];
	
	//ERROR #1 -> Faltam dados. Preencher
	if((""==trim($_POST['tmax'])) && (""==trim($_POST['tmin'])) && 
	   (""==trim($_POST['hmax'])) && (""==trim($_POST['hmin'])) &&
	   (""==trim($_POST['pmax'])) && (""==trim($_POST['pmin']))   ){
		   
		header("Location: ../pages/Defalarmes.php?error=1");
		exit;
	}
	
	if(""==trim($_POST['descricao'])){
		header("Location: ../pages/Defalarmes.php?error=1");
		exit;
	}

    //Erro #13 -> MAX < MIN!
		if((($_POST['tmax']) < ($_POST['tmin'])) || 
		   (($_POST['hmax']) < ($_POST['hmin'])) ||
		   (($_POST['pmax']) < ($_POST['pmin']))   ){
			   
			header("Location: ../pages/Defalarmes.php?error=13");
			exit;
		}
	
	
////////////////////////////////////////////////////////////////////
		$colunas = "aux = TRUE";
		if ($_POST['tmax']==NULL) {
			$tmax="NULL";
			$colunas = $colunas.",tmax = NULL";
		}
		else{
			$tmax = $_POST['tmax'];
			$colunas = $colunas.",tmax = ".$tmax;
		}
			
		if($_POST['tmin']==NULL){
			$tmin="NULL";	
			$colunas = $colunas.",tmin = NULL";
		}
		else{
			$tmin = $_POST['tmin'];	
			$colunas = $colunas.",tmin = ".$tmin;
		}
		if($_POST['hmax']==NULL){
			$hmax="NULL";
			$colunas = $colunas.",hmax = NULL";
		}
		else{
			$hmax = $_POST['hmax'];
			$colunas = $colunas.",hmax = ".$hmax;
		}
		
		if($_POST['hmin']==NULL){
			$hmin="NULL";	
			$colunas = $colunas.",hmin = NULL";
		}
		else{
			$hmin = $_POST['hmin'];
			$colunas = $colunas.",hmin = ".$hmin;
		}
		
		if($_POST['pmax']==NULL){
			$colunas = $colunas.",pmax = NULL";
			$pmax="NULL";	
		}
		else{
			$pmax = $_POST['pmax'];
			$colunas = $colunas.", pmax = ".$pmax;
		}
		
		if($_POST['pmin']==NULL){		
			$pmin="NULL";
			$colunas = $colunas.",pmin = NULL";
		}
		else{
			$pmin = $_POST['pmin'];
			$colunas = $colunas.", pmin = ".$pmin;
		}
		
		if($_POST['descricao']==NULL){
			$colunas = $colunas.",descricao = NULL";
			$desc="NULL";
		}
		else{
			$desc = $_POST['descricao'];
			$colunas = $colunas.", descricao = '".$desc."'";
		}
		
		if(!editAlarm($colunas, $id)){
			header("Location: ../pages/alterarAlarme.php?id=".$id."&error=3");
			exit;
		}
		
		header("Location: ../pages/alterarAlarme.php?id=".$id."&error=0");
		exit;
?>