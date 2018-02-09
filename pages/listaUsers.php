<?PHP
	session_start();
	include_once('../config/init.php');
	include_once('../database/users.php');
	
?>


<html>
<header>
	<title> CameliApp </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</header>

<body>
	<?php include 'common/header.html' ?>

	<div class = "main_page">
		<div class = "main_page_title">
			<h1> Lista de Utilizadores </h1>
			<hr>
		</div>
		<div class = "new_alarm">
			<div id="alarme">
			
				<!------------------------Erros-------------------->
				
				<!--Apagar histórico-->
				<?php   If(isset($_GET['error']) && $_GET['error'] == 1){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Erro interno. Contacte o administrador.
						<a class="close" href="historyAlarms.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 2){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Erro de comunicação. Contacte o administrador.
						<a class="close" href="historyAlarms.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 0){ ?>
					<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
						<p class = "error">Utilizador eliminado com sucesso!
						<a class="close" href="listaUsers.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
					</div>
				<?php } ?>
				
			</div>
		</div>
		<div class="edit_alarm">
			<div id="historico">	
			
				<?php
					$result = getUsers();

					echo "<table>";

					/*Acesso em ciclo 'as linhas do resultado para gerar as linhas da tabela*/
					
					echo "<tr>";
						echo "<th>Nome</th><th>Email</th><th>Permissão</th><th>Eliminar</th>";
					echo "</tr>";

				   foreach($result as $linha)
				   {
						if ($linha['nome'] != $_SESSION['nomeUser']){
							if ($linha['permissão'] == FALSE)
								$permissao = "Administrador";
							else 
								$permissao = "Normal";
							echo "<tr>";
								echo "<td>".$linha['nome']."</td><td>".$linha['email']."</td><td>".$permissao."</td><td style='text-align: center'><a href='../actions/eliminarUser.php?user=".$linha['username']."'><img src='../images/erase.png' width='20px' height='20px'></a></td>";
							echo "</tr>";
						}
				   }
					echo "  </table>";
					?>
			</div>
		</div>
		
	</div>
	<?php include 'common/footer.html' ?>
</body>

</html>