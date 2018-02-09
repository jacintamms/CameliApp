<?php
	session_start();
?>

<html>

<head>
  <title>CameliApp </title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
  <script src="../javascript/main.js"></script>

</head>

<body>

 <?php include 'common/header.html'; ?>
 
 <?php
	$user= $_SESSION['name'];

	$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
	if (!$conn) {
		print "ERRO: Nao foi possivel estabelecer ligacao à base de dados";
		exit;
	}
	$query = "SELECT * FROM vinha.operador WHERE username = '$user'";

	//	3. Execucao da query
	$result = pg_exec($conn, $query);
	pg_close($conn);
	$row = pg_fetch_row($result,0); 
?>

 	<div class = "main_page">
		<div class = "main_page_title">
			<h1> <?php echo $row[1];?></h1>
			<hr>
		</div>
		
		<!-- Mostrar erros/ sucessos aqui -->
		<?php   If(isset($_GET['error']) && $_GET['error'] == 1){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 10px;color: #333;font-weight: bold; height: 20px; text-align: center;">
				<p class = "error">Erro de ligação ao servidor. Volte mais tarde.
				<a class="close" href="pessoal.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 2){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 10px;color: #333; font-weight: bold; height: 20px; text-align: center;">
				<p class = "error">Problemas internos. Contacte o administrador.
				<a class="close" href="pessoal.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 0){ ?>
			<div class="success" style = "background-color: #AAFFAA; padding: 10px; color: #333; font-weight: bold;">
				<p class = "error">Alterações feitas com sucesso!
				<a class="close" href="pessoal.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
			</div>
		<?php } ?>
		
		<!--------------------------------------------->
		<div class = "user">
			<img width="300px" height="300px" src="..\images\user.png" ></img>	
		</div>
		<div class = "other_info">
			<p> <b>User: </b><?php echo $row[0];?></p>
			<p> <b>Email: </b><?php echo $row[3];?></p>
		</div>
		<div class = "some_buttons" style = "text-align:right">
			<?php if ($_SESSION['autenticado'] == 2):?>
				<a href="listaUsers.php">
					<input style = "margin-top: 20px;" type="button" value = "Ver Utilizadores"></input>
				</a>
			<?php endif; ?>
			<br>
			<a href="mudarInfoPessoal.php">
				<input style = "margin-top: 20px;" type="button" value = "Mudar Info. Pessoal"></input>
			</a>
			<br></br>
			<a href="mudarPassword.php">
				<input style = "margin-top: 5px; margin-bottom:20px" type="button" value = "Mudar Password"></input>
			</a>
		</div>
		<hr>
	</div>
 <?php include 'common/footer.html'; ?>
</body>
</html>