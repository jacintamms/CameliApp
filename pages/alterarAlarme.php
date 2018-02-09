
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
	<?php 
		$id = $_GET['id']; 
		
		$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
		if (!$conn) {
			print "ERRO: Nao foi possivel estabelecer ligacao à base de dados";
			exit;
		}
		$query = "SELECT * FROM vinha.alarmes 
				  WHERE idalarme = ".$id;
		$result = pg_exec($conn, $query);
		$row = pg_fetch_row($result, 0);
	?>
	
	<div class = "main_page">
		<div class = "main_page_title">
			<h1> <?php echo "Alterar Alarme - ".$row[8];?></h1>
			<hr>
		</div>
		
		<!-- ERROS! -->
		<?php   If(isset($_GET['error']) && $_GET['error'] == 0){ ?>
			<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
				<p class = "error">Alarme alterado com sucesso!
				<a class="close" href="alterarAlarme.php"  style = "float: right; text-decoration: none; color: #333">X</a></p>
			</div>
		<?php } ?>
		
		<?php   If(isset($_GET['error']) && $_GET['error'] == 3){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Problemas a pedir informação. Contacte o administrador.
				<a class="close" href="alterarAlarme.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 2){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Problemas internos. Contacte o administrador.
				<a class="close" href="alterarAlarme.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 1){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Preencha pelo menos uma unidade e descrição.
				<a class="close" href="alterarAlarme.php"  style = "float: right; text-decoration: none; color: #333;">X</a></p>
			</div>
		<?php } ?>
		
		<div class = "new_alarm">
			<?php include 'forms/editaralarmeform.php';?>
		</div>
		<hr style="margin-bottom: 100px;">


	</div>
	<?php include 'common/footer.html' ?>
</body>

</html>