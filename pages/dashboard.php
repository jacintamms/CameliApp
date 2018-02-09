<html>
<header>

		<?php
				session_start();
		?>

		<title> CameliApp </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
</header>

<body>
	<?php include '../config/init.php'; ?>
	<?php include 'common/header.html' ?>

	<div class = "main_page">

		<div class = "main_page_title">
			<h1> Agenda </h1>
			<hr>
		</div>
		<div class = "new_event">
			<div id="evento">
				<!------------------------Erros-------------------->
				<?php   If(isset($_GET['error']) && $_GET['error'] == 2){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Problemas internos. Contacte o administrador.
						<a class="close" href="dashboard.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 4){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Preencha todos os campos
						<a class="close" href="dashboard.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 0){ ?>
					<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
						<p class = "error">Evento adicionado com sucesso!
						<a class="close" href="dashboard.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 12){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Erro interno. Contacte o administrador.
						<a class="close" href="dashboard.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 11){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Faltam campos. Contacte o administrador.
						<a class="close" href="dashboard.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 10){ ?>
					<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
						<p class = "error">Evento eliminado com sucesso!
						<a class="close" href="dashboard.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
					</div>
				<?php } ?>
				<!--------------------------------------------------->
				<h3> Novo Evento</h3>
				<?php include 'forms/novoeventoform.php';?>
				<hr>
			</div>
		</div>
		
		<!-- ******* DATA de HOje em JavaScript e PHP ****** QUANDO for para apagar isto basta retirar este comentário -->
									 <!-- DATA DE HOJE -->
		<?php
			$datahoje = date('Y-m-d');
		 ?>
 <!-- ****************************************************************************************************************	-->
		<div class = "edit_alarm">
			<div id="listafutura">
				<!------------------------Erros-------------------->
				
				<!--------------------------------------------------->
				<h3> Lista de Eventos Agendados</h3>
				<?php include 'forms/eventosexistentesform.php';?>
				<hr>
			</div>
		</div>

		<div class = "edit_alarm">
			<div id="listapassada">
				<h3> Lista de Eventos Passados</h3>
				<?php include 'forms/eventospassadosform.php';?>
			</div>
		</div>

	</div>

	<?php include 'common/footer.html' ?>

</body>


</html>
