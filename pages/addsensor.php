<?php
	include_once('../config/init.php');
	include_once ("../database/functions.php");	
?>

<html>

<!-- Vai bucar ficheitos de estilo e bootstrap -->

<head>
		<title> CameliApp </title>
		<meta name="viewport" content="initial-scale=1.0">
        <meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
	
</head>


<body>

<?php include 'common/header.html'; ?>
   
<div class = "main_page">    
	<div class = "main_page_title">
		<h1> Adicionar Sensor </h1>
		<hr>
	</div>
	<div class="editar_alarme">
		<br>
		<form class="search" action='../actions/actionnovosensor.php' method='POST' >
			<p>
				<label>Tipo Sensor:</label>
				<select name="tipo">
					<option value="0">Temperatura/Humidade</option>
					<option value="1">Pluviosidade</option>
				</select>
			</p>
			<p>
				<label>Ativo:</label>
				<label>Sim 
					<input type="radio" name="ativo" value="TRUE" checked> 
					<br><br>Não 
					<input type="radio" name="ativo" value="FALSE">
				</label>
			</p>
			<p>
				<label>Zona:</label>
				<select name="id_localizacao">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
			</p>
			<br></br>
			<input type="submit" value="Adicionar">
		</form>

	   <br> 
	<form class="search" action="maps.php">
	  
	  <input type="submit" value="Voltar ao mapa">
	</form>
	<hr>
	</div>
	</div>
	
<?php include 'common/footer.html' ?>

</body>
</html>