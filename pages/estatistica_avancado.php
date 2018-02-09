<?php
	session_start();
	include_once('../config/init.php');
	include_once('../database/stats.php');
?>

<html>
	<head>
		<title> CameliApp </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
		<script src="../javascript/print.js"></script>
		
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
			
			<article class = "grafico">
				<p class = "text_for_div">
					Por favor, insira informação no menu da esquerda para gerar o gráfico.
					
					<div class = "edit_alarm" id = "print-content">
						<hr>
						<?php
							$result = getTableInfo();

							/*Acesso em ciclo 'as linhas do resultado para gerar as linhas da tabela*/
							//$num_linhas = pg_numrows($result);
							//$i = 0;
							
							echo "<table>";			
							echo "<tr>";
								echo "<th>Nome casta</th><th>Sensor</th><th>Temp. Máxima</th><th>Temp. Mínima</th><th>Temp. Média</th><th>Humd. Máxima</th><th>Humd. Mínima</th><th>Humd. Média</th>";
							echo "</tr>";
							
							foreach($result as $row) {
								
								echo "<tr>";
									echo "<td>".$row['nome_casta']."</td><td>".$row['id_sensor']."</td><td>".$row['tmax']."</td><td>".$row['tmin']."</td><td>".$row['tavg']."</td><td>".$row['hmax']."</td><td>".$row['hmin']."</td><td>".$row['havg']."</td>";
								echo "</tr>";
							}
							echo "</table>";
						?>	
							
					</div>
					<input type="button" value="Print page" id="botao" onclick="printDiv('print-content')" style="margin-top:-5%"/>	
				</p>
			</article>
		
		</div>
		
		<?php include 'common/footer.html' ?>
	</body>
</html>