<?PHP
	include_once('../config/init.php');
	include_once($BASE_DIR.'database/users.php');
	
	#Erro #4-> Not enough info

	if (!$_POST['username'] || !$_POST['password_nova'] || !$_POST['rpt_password_nova'] || !$_POST['email']) {
		header("Location: ../pages/mudarPassword.php?error=4");
		exit;
	}
	
	$user = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password_nova'];
	$rpt_password = $_POST['rpt_password_nova'];
	
	/*Erro #5 -> User não existe */
	$result = checkUser($user, $email);
	if (count($result)<=1){
		header("Location: ../pages/mudarPassword.php?error=5");
		exit;
	}
	
	/*Erro #3 -> Passwords inseridas de forma errada*/
	if ($password != $rpt_password){
		header ("Location: ../pages/mudarPassword.php?error=3");
		exit;
	}
	
	#Erro 2 -> MERDOU! 
	$result = changePassword($user, $email, $password);
	if (!$result){
		header("Location: ../pages/mudarPassword.php?error=2");
		exit;
	}
	
	//	5. Fecho da conexao 'a bdd
	pg_close($conn);
	
	header("Location: ../pages/mudarPassword.php?error=0");
	
?>