<?PHP

	session_start();
	include_once('../config/init.php');
	include_once($BASE_DIR.'database/alarmes.php');
	
////////////////////////////////////////////////////////////////////
		//Erro #11 -> Precisa de dados!
		if((""==trim($_POST['tmax'])) && (""==trim($_POST['tmin'])) && 
		   (""==trim($_POST['hmax'])) && (""==trim($_POST['hmin'])) &&
		   (""==trim($_POST['pmax'])) && (""==trim($_POST['pmin']))   ){
			   
			header("Location: ../pages/Defalarmes.php?error=11");
			exit;
		}
	
		if(""==trim($_POST['descricao'])){
			header("Location: ../pages/Defalarmes.php?error=11");
			exit;
		}

          //Erro #13 -> MAX < MIN!
		if((($_POST['tmax']) < ($_POST['tmin'])) || 
		   (($_POST['hmax']) < ($_POST['hmin'])) ||
		   (($_POST['pmax']) < ($_POST['pmin']))   ){
			   
			header("Location: ../pages/Defalarmes.php?error=13");
			exit;
		}
		
		$colunas = "(aux";
		$valores = "('TRUE'";
		if ($_POST['tmax']==NULL) 
			$tmax="NULL"; 
		else{
			$tmax = $_POST['tmax'];
			$colunas = $colunas.",tmax";
			$valores = $valores.",'".$tmax."'";
		}
			
		if($_POST['tmin']==NULL)
			$tmin="NULL";	
		else{
			$tmin = $_POST['tmin'];	
			$colunas = $colunas.",tmin";
			$valores = $valores.",'".$tmin."'";
		}
		if($_POST['hmax']==NULL)
			$hmax="NULL";
		else{
			$hmax = $_POST['hmax'];
			$colunas = $colunas.",hmax";
			$valores = $valores.",'".$hmax."'";
		}
		
		if($_POST['hmin']==NULL)
			$hmin="NULL";	
		else{
			$hmin = $_POST['hmin'];
			$colunas = $colunas.",hmin";
			$valores = $valores.",'".$hmin."'";
		}
		
		if($_POST['pmax']==NULL)		
			$pmax="NULL";	
		else{
			$pmax = $_POST['pmax'];
			$colunas = $colunas.",pmax";
			$valores = $valores.",'".$pmax."'";
		}
		
		if($_POST['pmin']==NULL)		
			$pmin="NULL";
		else{
			$pmin = $_POST['pmin'];
			$colunas = $colunas.",pmin";
			$valores = $valores.",'".$pmin."'";
		}
		
		if($_POST['descricao']==NULL)		
			$desc="NULL";
		else{
			$desc = $_POST['descricao'];
			$colunas = $colunas.",descricao";
			$valores = $valores.",'".$desc."'";
		}
		
		$colunas = $colunas.")";
		$valores = $valores.")";
        
    


		//Erro #12 -> Não consegue criar alarme. Contactar admin.
		if (!createAlarm($colunas, $valores)){
			header("Location: ../pages/Defalarmes.php?error=12");
			exit;
		}
        


		//Erro #10 -> Alarme criado com sucesso.
		header("Location: ../pages/Defalarmes.php?error=10");
		exit;

        
?>