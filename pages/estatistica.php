<?php
	session_start();
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
			
			<article class = "grafico" >
				<p class = "text_for_div">
					Por favor, insira informação no menu da esquerda para gerar o gráfico.
					
					<div class = "edit_alarm" id="print-content">
						<hr>
						<?php
							//Isto devia ser só um php
							$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
							if (!$conn) {
								print "ERRO: Nao foi possivel estabelecer ligacao à base de dados";
								exit;
							}
							$query = "SELECT id_sensor, trunc(max(temperatura)*100)/100 , trunc(max(humidade)*100)/100, 
														trunc(min(temperatura)*100)/100 , trunc(min(humidade)*100)/100, 
														trunc(avg(temperatura)*100)/100 , trunc(avg(humidade)*100)/100, 
											 nome_casta
									  FROM info_leituras JOIN sensor USING(id_sensor)
														 JOIN localizacao USING(id_localizacao)
														 JOIN casta USING(id_casta)
									  GROUP BY id_sensor, id_localizacao, nome_casta
								      ORDER BY id_sensor";

							$result = pg_exec($conn, $query);

							/*Acesso em ciclo 'as linhas do resultado para gerar as linhas da tabela*/
							$num_linhas = pg_numrows($result);
							$i = 0;
							
							echo "<table>";			
							echo "<tr>";
								echo "<th>Nome casta</th><th>Sensor</th><th>Temp. Máxima</th><th>Temp. Mínima</th><th>Temp. Média</th><th>Humd. Máxima</th><th>Humd. Mínima</th><th>Humd. Média</th>";
							echo "</tr>";
							while ($i < $num_linhas) {
								$row = pg_fetch_row($result, $i);

								echo "<tr>";
									echo "<td>".$row[7]."</td><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[3]."</td><td>".$row[5]."</td><td>".$row[2]."</td><td>".$row[4]."</td><td>".$row[6]."</td>";
								echo "</tr>";

								$i++;
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