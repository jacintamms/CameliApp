<?php
	session_start();
?>

<html>

<head>
  <title>CameliApp  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">

</head>

	<body>

	<div class = "main_page">
		<div class = "main_page_title">
			<h1> Mudança de Password </h1>
			<hr>
		</div>
		
		<!-- Mostrar erros/ sucessos aqui -->
		<?php   If(isset($_GET['error']) && $_GET['error'] == 2){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Problemas internos. Contacte o administrador.
				<a class="close" href="mudarPassword.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 3){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Passwords devem coincidir.
				<a class="close" href="mudarPassword.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 4){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Faltam dados.
				<a class="close" href="mudarPassword.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 5){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Combinação nome de utilizador - email não encontrada.
				<a class="close" href="mudarPassword.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 0){ ?>
			<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
				<p class = "error">Alterações feitas com sucesso!
				<a class="close" href="mudarPassword.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
			</div>
		<?php } ?>
		
	<!--------------------------------------------->
		<div class = "other_info" style="margin-bottom:130px">
			<form class="search" method="post" action="../actions/actionChangePassword.php">
				<p>
					<label> Username: </label>
					<input type = "text" name = "username"></input>
				</p>
				<p>
					<label> Email: </label>
					<input type = "text" name = "email"></input>
				</p>
				<p>
					<label> Password Nova: </label>
					<input type = "password" name = "password_nova"> </input>
				</p>
				<p>
					<label> Repita Password Nova </label>
					<input type = "password" name = "rpt_password_nova"> </input>
				</p>
					
				<input type = "submit" style = "margin-bottom:0px" value = "Alterar" ></input>
				<br></br>
				<input  type="button" value="Voltar" onClick="history.go(-1);return true;" >
			</form>
		</div>
		
		<hr style="margin-top:200px">
	</div>
	 <?php include 'common/footer.html'; ?>
	</body>
</html>