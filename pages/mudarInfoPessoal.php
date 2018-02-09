<?php
	session_start();
?>

<html>

<head>
  <title>CameliApp </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">

</head>

	<body>

	 <?php include 'common/header.html'; ?>
	 
	 <?php

	 $user= $_SESSION['name'];

	//	1. Estabelecimento da ligacao 'a bdd
	$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
				if (!$conn) {
					print "ERRO: Nao foi possivel estabelecer ligacao à base de dados";
					exit;
				}

	//  2.  Criacao da query dinamica e echo para debug
	$query = "SELECT * FROM vinha.operador WHERE username = '$user'";

	//	3. Execucao da query
	  $result = pg_exec($conn, $query);
	  pg_close($conn);
	  $row = pg_fetch_row($result,0); 

	 ?>

		<div class = "main_page">
			<div class = "main_page_title">
				<h1> Mudança de informação pessoal</h1>
				<hr>
			</div>
			<div class = "other_info">
				<form class="search" method="post" action="../actions/actionChangePersonalInfo.php?user=<?php echo $row[0]; ?>">
					<p>
						<label> Nome: </label>
						<input type = "text" value = "<?php echo $row[1]; ?>" name = "nome"></input>
					</p>
					<p>
						<label> Email: </label>
						<input type = "text" value = "<?php echo $row[3]; ?>" name = "email"></input>
					</p>
					<input type = "submit" value = "Alterar" ></input>
					
				</form>
			</div>
			<div class = "some_buttons">
				<p>
					<a href="mudarPassword.php">
						<input type = "button" value = "Mudar Password"></input>
					</a>
				</p>
				<p>
					<input  type="button" value="Voltar" onClick="history.go(-1);return true;"></input>
				</p>
			</div>
			
			<hr>
		</div>
	 <?php include 'common/footer.html'; ?>
	</body>
</html>