<?php
	session_start();
?>

<html>

<head>
  <script type="text/javascript" src="java-dashboard.js"></script>
  <title>CameliApp</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Latest compiled and minified CSS -->

  <!-- Ficheros Extra -->
 <!-- <script type="text/javascript" src="uscript.js"></script> -->
  <script type="text/javascript" src="../javascript/uscript.js"></script>
	<script type="text/javascript" src="../javascript/uscript.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/uestilo.css">
  <link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">

</head>

<body>
 <!-- - - - - - - - - - - - - - Cabeçalho- - - - - - - - - - - - - - -->
 <?php include 'common/header.html'; ?>

  <div class="main_page">
	<div class="main_page_title">
		<h1> Adicionar Utilizadores </h1>
		<hr>
	</div>
	<div class="new_alarm" id = "adicionar">
		<!------------------------Erros-------------------->
		<!--Eliminar Alarmez-->
		<?php   If(isset($_GET['error']) && $_GET['error'] == 2){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Impossível criar utilizador. Problemas internos. Contacte o administrador.
				<a class="close" href="OperadorPage.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 1){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Faltam campos. Preencha todos.
				<a class="close" href="OperadorPage.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 0){ ?>
			<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
				<p class = "error">Utilizador adicionado com sucesso!
				<a class="close" href="OperadorPage.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
			</div>
		<?php } ?>
	
		<h3> Novo Utilizador </h3>
          
		<!-- formulario novo utilizador -->
        <form class="search" method="post" action="../actions/actionAddUser.php" >
            <p> Preencha todos os campos do utilizador a adicionar</p>
			<br> </br>
            <p>
			<label> Nome: </label>   
			<input type="text" placeholder="Escreva o seu nome" name="nome" size=35 style="width:280px; height:32px">
            </p>
            <p>
				<label>	Username: </label>
                <input type="text" placeholder="Username" name="nomeuser" size=35 style="width:280px; height:32px">
            </p>
            <p>
                <label> E-mail: </label>
                <input type="text" placeholder="Email" name="email" size=35 style="width:280px; height:32px">
            </p>
            <p>
				<label> Password: </label>
                <input type="password" placeholder="Password" name="password" size=35 style="width:280px; height:32px">
            </p>
			<p>
				<label> Permissão:</label>
				<input type="radio" name="tipo" value="0"> Administrador</input><br></br>
				<input type="radio" name="tipo" value="1" checked = "checked"> Normal</input><br></br>
			</p>
            </p>
			<br></br>
			<br></br>
                <input type="submit" class="registro" name="submit" value="Registrar"></input>
                      
        </form>
    </div>
	
	</div> <!-- fim de margem -->

<!-- - - - - - - - - - - - - - Rodapé - - - - - - - - - - - - - - -->
<?php include 'common/footer.html'; ?>

</body>



</html>