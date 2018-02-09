<html>
    <head>
        <title>CameliApp </title>
        <meta charset="utf-8">
 
        <link rel="stylesheet" type="text/css" href="..\css\Login.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="../javascript/main.js"></script>
    </head>

    <body>
		<?php include_once('../config/init.php');?>
        <div class="body"></div>
		<div class="grad"></div>
        <div class="logo">
            <img width="175px" height="275px" src="..\images\VinhaLogo.png" style="margin-left:82px"></img>
        </div>
		
		<div class="header">
			<div>Cameli<span>APP</span></div>
		</div>
		<br>
		
		<form class="login" method="post" action="../actions/accaologin.php">
		
			<!-- MENSAGENS DE ERRO/SUCESSO -->
			<!-- Styles estão definidos aqui porque não estava a reconher div quando feitos no ficheiro CSS - para mais tarde investigar -->
				
			<?php   If(isset($_GET['error']) && $_GET['error'] == 1){ ?>
				<div class="error" style = "margin: 10px;color: red;font-weight: bold; height: 20px; text-align: center; vertical-align: middle;">
					<p class = "error">Username ou Password Inválidos
					<a class="close" href="LoginPage.php"  style = "float: right; text-decoration: none; color: red;">X</a></p>
				</div>
			<?php } ?>
			<?php   If(isset($_GET['error']) && $_GET['error'] == 2){ ?>
				<div class="error" style = "margin: 10px;color: red;font-weight: bold; height: 20px; text-align: center; vertical-align: middle;">
					<p class = "error">Campos Vazios
					<a class="close" href="LoginPage.php"  style = "float: right; text-decoration: none; color: red;">X</a></p>
				</div>
			<?php } ?>
				
			<input type="text" placeholder="username" name="user"><br>
			<input type="password"  placeholder="password" name="password"><br>
			<input type="submit"  value="Login">
			
			<a href="mudarPassword.php">
				<input type="button" class="forgot" value="Esqueci-me da password">
			</a>
			
		</form>
       
    </body>
</html>