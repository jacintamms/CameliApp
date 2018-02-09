
<?PHP
	session_start();
?>


<html>
<header>
	<title> CameliApp </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
</header>

<body>
	<?php include 'common/header.html' ?>

	<div class = "main_page">
		<div class = "main_page_title">
			<h1> Alarmes </h1>
			<hr>
		</div>
		<div class = "new_alarm">
			<div id="alarme">
			
				<!------------------------Erros-------------------->
				<!--Eliminar Alarmez-->
				<?php   If(isset($_GET['error']) && $_GET['error'] == 2){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Impossível eliminar alarme. Problemas internos. Contacte o administrador.
						<a class="close" href="Defalarmes.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 1){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Faltam campos. Contacte o administrador.
						<a class="close" href="Defalarmes.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 0){ ?>
					<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
						<p class = "error">Alarme apagado com sucesso!
						<a class="close" href="Defalarmes.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
					</div>
				<?php } ?>
				
				<!--Criar Alarme-->
				<?php   If(isset($_GET['error']) && $_GET['error'] == 12){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Erro interno. Contacte o administrador.
						<a class="close" href="Defalarmes.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 11){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Precisa de preencher pelo menos um campo e a descrição.
						<a class="close" href="Defalarmes.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
				<?php   If(isset($_GET['error']) && $_GET['error'] == 13){ ?>
					<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
						<p class = "error">Dados de temperarura, humidade e pluviosidade máxima e mínima incoerentes!
						<a class="close" href="Defalarmes.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
					</div>
				<?php } ?>
                <?php   If(isset($_GET['error']) && $_GET['error'] == 10){ ?>
					<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
						<p class = "error">Alarme adicionado com sucesso!
						<a class="close" href="Defalarmes.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
					</div>
				<?php } ?>
                
				
				<?php if ($_SESSION['autenticado'] == 2): ?>
					<h3> Novo Alarme </h3>
					<?php include 'forms/novoalarmeform.php';?>
				<?php endif; ?>
		</div>
		</div>
		<div class = "edit_alarm">
			<div id="editar">
			<?php if ($_SESSION['autenticado'] == 2): ?>
				<hr>
				<h3>Editar Alarme</h3>
			<!--Faz mais sentido mostrar todos do que andar a procurar por um factor-->

				<?php
					//Isto devia ser só um php
					$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
					if (!$conn) {
						print "ERRO: Nao foi possivel estabelecer ligacao à base de dados";
						exit;
					}
					$query = "Select * FROM vinha.alarmes ";

					$result = pg_exec($conn, $query);

					/*Acesso em ciclo 'as linhas do resultado para gerar as linhas da tabela*/
					$num_linhas = pg_numrows($result);
					if ($num_linhas == 0){
						echo "<p> Não existe nenhum alarme registado no sistema. </p>";
					}
					$i = 0;

					echo "<table>";
					echo "<tr>";
						echo "<th>Descrição</th><th>Alterar</th><th>Eliminar</th>";
					echo "</tr>";
					while ($i < $num_linhas) {
						$row = pg_fetch_row($result, $i);

						echo "<tr>";
							echo "<td>".$row[8]."</td><td style='text-align:center'><a href='alterarAlarme.php?id=".$row[0]."'><img src='../images/change.png' width='20px' height='20px'></a></td><td style='text-align:center'><a href='../actions/eliminarAlarme.php?id=".$row[0]."'><img src='../images/erase.png' width='20px' height='20px'></a></td>";
						echo "</tr>";

						$i++;
					}
					echo "</table>";
				?>
				<hr>
			<?php endif; ?>

			</div>
   </div>
	
	</div>
	<?php include 'common/footer.html' ?>
</body>

</html>
