	<?PHP

	include_once('../config/init.php');
	include_once($BASE_DIR.'database/users.php');
	
	if ("" == trim($_POST['user']) || "" == trim($_POST['password'])) {
		header('Location: ../pages/LoginPage.php?error=2');
		exit;
	}
	$username = strip_tags($_POST['user']);
	$password = strip_tags($_POST['password']);
	
	$linha =  checkLogin($username, $password);
	
	$num_registos = count($linha);

	if ($num_registos > 1){
		
		$_SESSION['name']= $username;
		$_SESSION['nomeUser'] = $linha['nome'];
		
		if($linha['permissão'] == FALSE){
			$_SESSION['autenticado'] = 2;
		}
		elseif ($linha['permissão'] == TRUE) {
			$_SESSION['autenticado'] = 1;
		}
		$_SESSION['success_messages'][] = 'Login Verificado';
		header("Location: ../pages/maps.php");
	}		

	else {
		$_SESSION['error_messages'] = "Nome de Utilizador ou Password Errados";
		
		header("Location: ../pages/LoginPage.php?error=1");
		//exit;
	}
?>

