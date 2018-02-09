<?php
	session_start();
	include_once('../config/init.php');
	include_once('../database/stats.php');
	
	$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
	if (!$conn) 
		echo "ERRO: Nao foi possivel estabelecer ligacao à base de dados";
			
	$query = "set schema 'vinha';";
	pg_exec($conn, $query);
	
	//$periodo = $_POST['Periodo'];
	$periodo = $_GET['Periodo'];
	if (isset($_GET['Sensor1']))
		//$sensor1 = $_POST['Sensor1'];
		$sensor1 = $_GET['Sensor1'];
	else 
		$sensor1 = 0;
	if (isset($_GET['Sensor2']))
		//$sensor2 = $_POST['Sensor2'];
		$sensor2 = $_GET['Sensor2'];
	else 
		$sensor2 = 0;
	//$choice  = $_POST['graph_choice'];
	$choice  = $_GET['graph_choice'];
		
	/*Número de períodos standard desejados*/
	//$numberOf 	  = $_POST['numberOf'];
	$numberOf 	  = $_GET['numberOf'];
	$dG = 0;
	$titulo = "Gráfico de "; 
	if ($sensor1 <= 0 || $sensor2 <= 0){
		
		$leituras = array();

		$intervalo = $numberOf;
		$condicoes = "";
		
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
		$titulo = "Gráfico de "; 
		$colunas = "";
		
		if ($choice == 1){
			$colunas = $colunas.", temperatura";
			$titulo = $titulo."temperatura";
		}
		elseif ($choice == 2){
			$colunas = $colunas.", humidade";
			$titulo = $titulo."humidade";
		}
		elseif ($choice == 3){
			$colunas = $colunas.", pluviosidade";
			$titulo = $titulo."pluviosidade";
		}
		elseif ($choice == 4){
			$colunas = $colunas.", MAX(temperatura)-MIN(temperatura) AS amplitude";
			$titulo = $titulo."Amplitude Térmica Diária";
		}
		elseif ($choice == 5){
			$colunas = $colunas.", MAX(temperatura) AS maxDiario";
			$titulo = $titulo."Temperatura Máxima Diária";
		}
		elseif ($choice == 6){
			$colunas = $colunas.", MIN(temperatura) AS minDiario";
			$titulo = $titulo."Temperatura Mínima Diária";
		}
		elseif ($choice == 7){
			$colunas = $colunas.", AVG(temperatura) AS avgDiaria";
			$titulo = $titulo."Temperatura Média Diária";
		}
		elseif ($choice == 8){
			$colunas = $colunas.", temperatura, humidade";
			$titulo = $titulo."Temperatura e Humidade";
		}
		
		if ($sensor1 > 0){
			$condicoes = "WHERE id_sensor = '".$sensor1."'".$condicoes;
			$titulo = $titulo." do Sensor ".$sensor1;
		}
		if ($sensor2 > 0){
			$condicoes = "WHERE id_sensor = '".$sensor2."'".$condicoes;
			$titulo = $titulo." do Sensor ".$sensor2;
		}
		if ($choice == 3){
			$condicoes = $condicoes." AND pluviosidade IS NOT NULL";
		}
		
		if ($choice == 1 || $choice == 2 || $choice == 3 || $choice == 8){
			$query = "SELECT data_confirmacao AS data".$colunas."
				  FROM vinha.info_leituras 
				  ".$condicoes."
				   ORDER BY data;";		
		}
		
		if ($choice == 4 || $choice == 5 || $choice == 6 || $choice == 7){
			$query = "SELECT DATE(data_confirmacao) AS data".$colunas."
				  FROM vinha.info_leituras 
				  ".$condicoes."
				   GROUP BY DATE(data_confirmacao)
				   ORDER BY data;";	
		}
	}
	else{
		$dG = 1;
		$query = "SELECT info_leituras.data_confirmacao, info_leituras.parametro, subquery.parametro
				  FROM vinha.info_leituras, (SELECT data_confirmacao, parametro
											 FROM vinha.info_leituras
											 WHERE id_sensor = ".$sensor2.") subquery
				  WHERE subquery.data_confirmacao = info_leituras.data_confirmacao AND id_sensor = ".$sensor1."
				  ORDER BY info_leituras.data_confirmacao;";
		
		if ($choice == 1){
			$query = str_replace("parametro", "temperatura", $query);
			$titulo = $titulo."temperatura dos sensores ".$sensor1." e ".$sensor2;
		}
		if ($choice == 2){
			$query = str_replace("parametro", "humidade", $query);
			$titulo = $titulo."humidade dos sensores ".$sensor1." e ".$sensor2;
		}
		if ($choice == 3){
			$query = "SELECT info_leituras.data_confirmacao, info_leituras.pluviosidade, subquery.pluviosidade
				  FROM vinha.info_leituras, (SELECT data_confirmacao, pluviosidade
											 FROM vinha.info_leituras
											 WHERE id_sensor = ".$sensor2.") subquery
				  WHERE subquery.data_confirmacao = info_leituras.data_confirmacao AND id_sensor = ".$sensor1." AND info_leituras.pluviosidade IS NOT NULL
				  ORDER BY info_leituras.data_confirmacao;";
			$titulo = $titulo."pluviosidade dos sensores ".$sensor1." e ".$sensor2;
		}
		if ($choice == 4){
			$query = "SELECT DATE(info_leituras.data_confirmacao) AS data, MAX(info_leituras.temperatura)-MIN(info_leituras.temperatura) AS amplitude1, subquery.amplitude2

					  FROM vinha.info_leituras, (SELECT DATE(data_confirmacao) AS data2, MAX(temperatura) - MIN(temperatura) AS amplitude2
                           FROM info_leituras
                           WHERE id_sensor = ".$sensor2."
                           GROUP BY data2) subquery

				      WHERE id_sensor = ".$sensor1." AND data2 = DATE(info_leituras.data_confirmacao) 
                      GROUP BY DATE(info_leituras.data_confirmacao), subquery.amplitude2
                      ORDER BY data;";
			$titulo = $titulo."amplitude térmica dos sensores ".$sensor1." e ".$sensor2;
		}
		
		if ($choice == 5){
			$query = "SELECT DATE(info_leituras.data_confirmacao) AS data, MAX(info_leituras.temperatura) as max1, subquery.max2

					  FROM vinha.info_leituras, (SELECT DATE(data_confirmacao) AS data2, MAX(temperatura)AS max2
                           FROM info_leituras
                           WHERE id_sensor = ".$sensor2."
                           GROUP BY data2) subquery

				      WHERE id_sensor = ".$sensor1." AND data2 = DATE(info_leituras.data_confirmacao)
                      GROUP BY DATE(info_leituras.data_confirmacao), subquery.max2
                      ORDER BY data;";
			$titulo = $titulo."temperatura máxima dos sensores ".$sensor1." e ".$sensor2;
		}
		
		if ($choice == 6){
			$query = "SELECT DATE(info_leituras.data_confirmacao) AS data, MIN(info_leituras.temperatura) AS min1, subquery.min2

					  FROM vinha.info_leituras, (SELECT DATE(data_confirmacao) AS data2, MIN(temperatura) AS min2
                           FROM info_leituras
                           WHERE id_sensor = ".$sensor2."
                           GROUP BY data2) subquery

				      WHERE id_sensor = ".$sensor1." AND data2 = DATE(info_leituras.data_confirmacao)
                      GROUP BY DATE(info_leituras.data_confirmacao), subquery.min2
                      ORDER BY data;";
			$titulo = $titulo."temperatura mínima dos sensores ".$sensor1." e ".$sensor2;
		}
		
		if ($choice == 7){
			$query = "SELECT DATE(info_leituras.data_confirmacao) AS data, AVG(info_leituras.temperatura) AS avg1, subquery.avg2

					  FROM vinha.info_leituras, (SELECT DATE(data_confirmacao) AS data2,AVG(temperatura) AS avg2
                           FROM info_leituras
                           WHERE id_sensor = ".$sensor2."
                           GROUP BY data2) subquery

				      WHERE id_sensor = ".$sensor1." AND data2 = DATE(info_leituras.data_confirmacao)
                      GROUP BY DATE(info_leituras.data_confirmacao), subquery.avg2
                      ORDER BY data;";
			$titulo = $titulo."temperatura média dos sensores ".$sensor1." e ".$sensor2;
		}
		
	}

	//echo $query;
	$result1 = pg_exec($conn, $query);

	while ($row = pg_fetch_row($result1)) 
		$leituras1[] = $row;
		
	$leiturasString1 = json_encode($leituras1, JSON_NUMERIC_CHECK);
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
		 var grafCol   = <?=$choice ?>; 
		 if (grafCol == "3")
			 google.charts.load('current', {'packages':['bar']});
		 else
		   google.charts.load('current', {'packages':['line', 'corechart']});
		   

		  // Set a callback to run when the Google Visualization API is loaded.
		  google.charts.setOnLoadCallback(drawChart);

		  // Callback that creates and populates a data table,
		  // instantiates the pie chart, passes in the data and
		  // draws it.
		  function drawChart() {
			var jsonData  = <?=$leiturasString1 ?>;
			var grafCol   = <?=$choice ?>;
			var doubleGraph = <?=$dG ?>;
			
			console.log(jsonData);
			console.log(grafCol);
			
			// Create the data table.
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Data');
			if (grafCol == "1"){
				data.addColumn('number', 'Temperatura (ºC)');
				if (doubleGraph){ data.addColumn('number', 'Temperatura 2(ºC)');}
			}
			if (grafCol == "2"){
				data.addColumn('number', 'Humidade (%)');
				if (doubleGraph) data.addColumn('number', 'Humidade 2(%)');
			}
			if (grafCol == "3"){
				data.addColumn('number', 'Pluviosidade (mm)');
				if (doubleGraph) data.addColumn('number', 'Pluviosidade 2(mm)');
			}
			if (grafCol == "4"){
				data.addColumn('number', 'Amplitude Térmica (ºC)');
				if (doubleGraph) data.addColumn('number', 'Amplitude Térmica 2(ºC)');
			}
			if (grafCol == "5"){
				data.addColumn('number', 'Máximo Diário (ºC)');
				if (doubleGraph) data.addColumn('number', 'Máximo Diário 2(ºC)');
			}
			if (grafCol == "6"){
				data.addColumn('number', 'Mínimo Diário (ºC)');
				if (doubleGraph) data.addColumn('number', 'Mínimo Diário 2(ºC)');
			}
			if (grafCol == "7"){
				data.addColumn('number', 'Média Diária (ºC)');
				if (doubleGraph) data.addColumn('number', 'Média Diária 2(ºC)');
			}
			if (grafCol == "8"){
				data.addColumn('number', 'Temperatura (ºC)');
				data.addColumn('number', 'Humidade (%)');
			}
			
			data.addRows(jsonData);
			
			
			if (grafCol == "3")
				var options = {bars: 'vertical'};
			else 
				var options = {};
			
			
			if (grafCol == "8")
				var options = {
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
				if (grafCol == "3")
					var materialChart = new google.charts.Bar(chartDiv);
				else
					var materialChart = new google.charts.Line(chartDiv);
				materialChart.draw(data, options);
			}
			drawMaterialChart();
		}
		</script>
	</head>
	
	<body>
		<?php include 'common/header.html'; ?>
		
		<div class = "main_page">
			
			<div class = "main_page_title">
				<h1> Estatísticas </h1>
				<hr>
			</div>
			
			<nav class = "search_bar">
				<form method='get' action='estatistica_avancado2.php'>
					
					<p> Sensor #1 </p>
					<select name="Sensor1">
						<option value="-1" selected> -- Escolher Sensor -- </option>
						<?php 
							$result = getSensors();
							$num_linhas = count($result);
							$i = 0;
							$id_casta = 1;
							$id_casta_anterior = -1;
							
							foreach ($result as $linha){
								$id_casta = $linha['id_casta'];
								
								if ($id_casta <> $id_casta_anterior){
									echo "<option disabled = \"disabled\">--Casta ".$linha['nome_casta']."--</option>";
								}								
								$id_casta_anterior = $id_casta;
								echo "<option value=\"".$linha['id_sensor']."\">".$linha['id_sensor']."</option>";
							}
						?>		
					</select>
					<p> Sensor #2 </p>
					<select name="Sensor2">
						<option value="-1" selected> -- Escolher Sensor -- </option>
						<?php 
							$result = getSensors();
							$num_linhas = count($result);
							$id_casta = 1;
							$id_casta_anterior = -1;
							
							foreach ($result as $linha){
								$id_casta = $linha['id_casta'];
								
								if ($id_casta <> $id_casta_anterior){
									echo "<option disabled = \"disabled\">--Casta ".$linha['nome_casta']."--</option>";
								}								
								$id_casta_anterior = $id_casta;
								echo "<option value=\"".$linha['id_sensor']."\">".$linha['id_sensor']."</option>";
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
					<!--<input type='hidden' name='temperatura' value = '0'></input>
					<input type='hidden' name='humidade' value = '0'></input>
					<input type='hidden' name='pluviosidade' value = '0'></input>
					<input type='hidden' name='amp_termica' value = '0'></input>
					<input type='hidden' name='max_dia' value = '0'></input>
					<input type='hidden' name='min_dia' value = '0'></input>
					<input type='hidden' name='avg_dia' value = '0'></input>--><br>	
					<label> Temperatura  <input type='radio' name='graph_choice'  value = '1'></input> </label>
					<p></p>
					<label> Humidade     <input type='radio' name='graph_choice'  value = '2'>   </input> </label>
					<p></p>
					<label> Temperatura e Humidade <input type='radio' name='graph_choice' value = '8'>   </input> </label>
					<p></p>
					<label> Pluviosidade <input type='radio' name='graph_choice' value = '3'>   </input> </label>
					<p></p>
					<label> Amplitude Térmica <input type='radio' name='graph_choice' value = '4'>   </input> </label>
					<p></p>
					<label> Máximos Diários <input type='radio' name='graph_choice' value = '5'>   </input> </label>
					<p></p>
					<label> Mínimos Diários <input type='radio' name='graph_choice' value = '6'>   </input> </label>
					<p></p>
					<label> Média Diária <input type='radio' name='graph_choice' value = '7'>   </input> </label>
							
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
				<?php if (count($leituras1)>0): ?>
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