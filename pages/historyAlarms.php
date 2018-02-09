<?PHP
	session_start();
	include_once('../config/init.php');
	include_once('../database/alarmes.php');
	$page_size = 20;
	$total = AlarmLogCount();
	$page = isset($_GET['page'])?$_GET['page']:0;
	$total = $total['count'];
	
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
			<h1> Histórico de Alarmes </h1>
			<hr>
		</div>
		<div class = "new_alarm">
			<div id="alarme">
			
				<!------------------------Erros-------------------->
				
				<!--Apagar histórico-->
				<?php   If(isset($_GET['error']) && $_GET['error'] == 22){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Erro interno. Contacte o administrador.
						<a class="close" href="historyAlarms.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 23){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Erro de comunicação. Contacte o administrador.
						<a class="close" href="historyAlarms.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 20){ ?>
					<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
						<p class = "error">Operação efetuada com sucesso!
						<a class="close" href="historyAlarms.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
					</div>
				<?php } ?>
				
			</div>
		</div>
		<div class="edit_alarm">
			<div id="historico">	
					<?php include 'forms/historicoalarmeform.php';?>
			</div>
		</div>
		<div id="pagination">
			<?php if ($page != 0){
				echo "<a href='historyAlarms.php?page=".($page-1)."' style='color:black'><i class='fa fa-arrow-left'></i>  </a>";
			}
			echo " ".($page+1)." / ".ceil($total/$page_size)." ";					
			if (($page + 1) * $page_size < $total){
				echo "<a href='historyAlarms.php?page=".($page+1)."' style='color:black'><i class='fa fa-arrow-right'></i></a>";
			} ?>	
		</div>	
	</div>
	<?php include 'common/footer.html' ?>
</body>

</html>
