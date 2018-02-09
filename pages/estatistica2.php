<?php
	session_start();
?>

<?php
	session_start();
	
	$periodo     = $_POST['Periodo'];
	$sensor      = $_POST['Sensor'];
	
	$temperatura  = $_POST['temperatura'];
	$humidade     = $_POST['humidade'];
	$pluviosidade = $_POST['pluviosidade'];
	
	/*Número de períodos standard desejados*/
	$numberOf 	  = $_POST['numberOf'];
	
	$leituras = array();

	$intervalo = $numberOf;
	$condicoes = "WHERE id_sensor = '".$sensor."'";
	$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
	if (!$conn) 
		echo "ERRO: Nao foi possivel estabelecer ligacao à base de dados";
			
	$query = "set schema 'vinha';";
	pg_exec($conn, $query);
	
	if ($periodo != "-1"){
		if($periodo === "day"){
			$condicoes = $condicoes." AND data_confirmacao>(NOW() - INTERVAL '".$numberOf."DAY')";
			$intervalo = $intervalo." dias";
		}else if ($periodo === "week"){
			$condicoes = $condicoes." AND data_confirmacao>(NOW() - INTERVAL '".$numberOf." WEEK')";
			$intervalo = $intervalo." semanas";
		}else if ($periodo === "month"){
			$condicoes = $condicoes." AND data_confirmacao>(NOW() - INTERVAL '".$numberOf." MONTH')";
			$intervalo = $intervalo." mês";
		}else if ($periodo === "year"){
			$condicoes = $condicoes." AND data_confirmacao>(NOW() - INTERVAL '".$numberOf." YEAR')";
			$intervalo = $intervalo." anos";
		}
	}
	
	//1- Fazer string de colunas necessárias para o gráfico
	$colunas = "date_trunc('minute', data_confirmacao)";
	if ($temperatura)
		$colunas = $colunas.", temperatura";
	if ($humidade)
		$colunas = $colunas.", humidade";
	if ($pluviosidade)
		$colunas = $colunas.", pluviosidade";

	$graphCol = "0";
	$titulo = "Gráfico de "; 
	/*
	CODIFICAÇÃO VARIÁVEL $graphCol
	--
		$graphCol = 1 -> passa temperatura
		$graphCol = 2 -> passa humidade
		$graphCol = 3 -> passa pluviosidade
		$graphCol = 4 -> passa T+H
	*/
	if ($temperatura AND !$humidade AND !$pluviosidade){
		$titulo = $titulo."Temperatura";
		$graphCol = "1"; 
	}
	if (!$temperatura AND $humidade AND !$pluviosidade){
		$titulo = $titulo."Humidade";
		$graphCol = "2"; 
	}
	if (!$temperatura AND !$humidade AND $pluviosidade){
		$titulo = $titulo."Pluviosidade";
		$graphCol = "3"; 
	}
	if ($temperatura AND $humidade AND !$pluviosidade){
		$titulo = $titulo."Temperatura e Humidade";
		$graphCol = "4"; 
	}
	
	$query = "SELECT ".$colunas."
			  FROM info_leituras 
			  ".$condicoes.";";
	
	$result = pg_exec($conn, $query);
	
	while ($row = pg_fetch_row($result)) 
		$leituras[] = $row;
	
	$leiturasString = json_encode($leituras, JSON_NUMERIC_CHECK);
	
?>

<html>
	<head>
		<title> CameliApp </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
		<script src="../javascript/print.js"></script>
		<!--Load the AJAX API-->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"> </script>
		<script type="text/javascript">
		


		  // Load the Visualization API and the corechart package.
		  //google.charts.load('current', {'packages':['corechart']});
		   google.charts.load('current', {'packages':['line', 'corechart']});

		  // Set a callback to run when the Google Visualization API is loaded.
		  google.charts.setOnLoadCallback(drawChart);

		  // Callback that creates and populates a data table,
		  // instantiates the pie chart, passes in the data and
		  // draws it.
		  function drawChart() {
			var jsonData  = <?=$leiturasString ?>;
			var grafCol   = <?=$graphCol ?>;
			//var grafTitle = <?=$titulo ?>;
			//console.log(jsonData);
			console.log(grafCol);
			//console.log(grafTitle);
			// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Data');
			if (grafCol == "1")
				data.addColumn('number', 'Temperatura (ºC)');
			if (grafCol == "2")
				data.addColumn('number', 'Humidade (%)');
			if (grafCol == "3")
				data.addColumn('number', 'Pluviosidade (%)');
			if (grafCol == "4"){
				data.addColumn('number', 'Temperatura (ºC)');
				data.addColumn('number', 'Humidade (%)');
			}
			data.addRows(jsonData);

			var options = {
				//'title': 'TRUQUES DO KRALJ'
				//'width': 900,
				//'height': 600
				
			};
			if (grafCol == "4")
				var options = {
				//	'title': 'Whatever Bro',
					//'width': 900,
				//	'height': 600,
					series:{
						0: {axis: 'Temps'},
						1: {axis: 'Hmdd'}
					},
					axes:{
						y:{
							Temps: {label: 'Temperatura (ºC)'},
							Hmdd: {label: 'Humidade (%)'}
						}
					}
				};
			
			var chartDiv = document.getElementById('graf_div');
			function drawMaterialChart() {
				var materialChart = new google.charts.Line(chartDiv);
				materialChart.draw(data, options);
			}
			

			// Instantiate and draw our chart, passing in some options.
			//var chart = new google.visualization.LineChart(document.getElementById('graf_div'));
			//chart.draw(data, options);
			drawMaterialChart();
			
		}
		</script>
		
	</head>
	
	<body>
		<?php include 'common/header.html'; ?>
		
		<div class = "main_page">
			
			<div class = "main_page_title">
				<h1> Estatística </h1>
				<hr>
			</div>
			
			<nav class = "search_bar">
				<form method='post' action='estatistica2.php'>
					
					<p> Sensor </p>
					<select name="Sensor">
						<option value="-1" selected> -- Escolher Sensor -- </option>
						<?php 
							$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
							if (!$conn) 
								echo "ERRO: Nao foi possivel estabelecer ligacao à base de dados";
									
							$query = "set schema 'vinha';";
							pg_exec($conn, $query);
							$query = "SELECT id_sensor, id_casta, nome_casta
                                      FROM sensor JOIN localizacao USING (id_localizacao) 
												  JOIN casta USING (id_casta)
									  WHERE ativo = TRUE AND apagado = FALSE
                                      ORDER BY id_casta, id_sensor";
							$result = pg_exec($conn, $query);
							
							$num_linhas = pg_numrows($result);
							$i = 0;
							$id_casta = 1;
							$id_casta_anterior = -1;
							
							while ($i < $num_linhas){
								$linha = pg_fetch_row($result, $i);
								$id_casta = $linha[1];
								
								if ($id_casta <> $id_casta_anterior){
									echo "<option disabled = \"disabled\">--Casta ".$linha[2]."--</option>";
								}								
								$id_casta_anterior = $id_casta;
								echo "<option value=\"".$linha[0]."\">".$linha[0]."</option>";
								$i++;
							}
						?>		
					</select>
					<br>
					
					<p> Período </p>
				
					<select name="Periodo">
						<option value="-1" selected> -- Escolher Período -- </option>
						<option value="day">   Dia    </option>
						<option value="week">  Semana </option>
						<option value="month"> Mês    </option>
						<option value="year">  Ano    </option>
					</select>
					<p></p>
					<p></p>
					<label>Quantidade<input type = 'number' name='numberOf' value='1'></input></label>
					<br>
					<p></p>
					<input type='hidden' name='temperatura' value = '0'></input>
					<input type='hidden' name='humidade' value = '0'></input>
					<input type='hidden' name='pluviosidade' value = '0'></input><br>	
					<label> Temperatura  <input type='checkbox' name='temperatura'  value = '1'></input> </label>
					<p></p>
					<label> Humidade     <input type='checkbox' name='humidade'  value = '1'>   </input> </label>
					<p></p>
					<label> Pluviosidade <input type='checkbox' name='pluviosidade' value = '1'>   </input> </label>
							
					<hr>		
					<br>
					<input type='submit' value='Pesquisar' float="right" ></input>
				</form>
			</nav> 
			

			<div id="chart_div">
				<div id="chart_div_title">
					<h2>
						<?php 
								echo $titulo;
						?>
					</h2>
				</div>
				<?php if (count($leituras)>0): ?>
					<div id="graf_div"></div>
				<?php elseif (count($leituras) == 0): ?>
					<p class = "text_for_div"> Não existe informação suficiente para cumprir o seu pedido. </p>
				<?php endif; ?>
				<input type="button" value="Imprimir PDF" id="botao" onclick="printDiv('chart_div')" style="margin-top:15px; float: right;"/>	
			</div>
			
			
		
		</div>
		
		<?php include 'common/footer.html' ?>
	</body>
</html>