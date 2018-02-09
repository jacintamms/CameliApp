<?PHP

	include_once('../config/init.php');

	$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
	if (!$conn) {
		header("Location: ../pages/pessoal.php?error=1");
		exit;
	}
	
	$user = $_GET['user'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
		
	$query = "UPDATE vinha.operador 
			  SET nome='".$nome."', email='".$email."'
			  WHERE username = '".$user."';";	
	/*Execucao da query */
	$result = pg_exec($conn, $query);
	if (!$result){
		header("Location: ../pages/pessoal.php?error=2");
		exit;
	}
	//	5. Fecho da conexao 'a bdd
	
	pg_close($conn);
		
	header("Location: ../pages/pessoal.php?error=0");

?>