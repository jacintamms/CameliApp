<?php
	include_once ("../config/init.php");
	include_once ("../database/sensores.php");	
?>


<html>

<header>
	<title> CameliApp </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
</header>

<body>

	<?php include 'common/header.html'; ?>
    <?php
		$id_localizacao = ($_GET['id_localizacao']);

		$sensores = tabela_sensores($id_localizacao);
	?>
    <div class = "main_page">
		<!------------------------Erros-------------------->
		<?php   If(isset($_GET['error']) && $_GET['error'] == 2){ ?>
			<div class="error" style = "background-color: #FFAAAA; margin: 0 0 10px;color: #333;font-weight: bold; padding: 5px;">
				<p class = "error">Problemas internos. Contacte o administrador.
			</div>
		<?php } ?>
		
		<?php   If(isset($_GET['error']) && $_GET['error'] == 0){ ?>
			<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
				<p class = "error">Sensor apagado com sucesso!
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 10){ ?>
			<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
				<p class = "error">Sensor está agora ativo!
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 20){ ?>
			<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
				<p class = "error">Sensor está agora desativado!
			</div>
		<?php } ?>
		<?php   If(isset($_GET['error']) && $_GET['error'] == 30){ ?>
			<div class="success" style = "background-color: #AAFFAA; margin: 0 0 10px; padding: 5px; color: #333; font-weight: bold;">
				<p class = "error">Novo sensor adicionado!
			</div>
		<?php } ?>
		<div class = "main_page_title">
			<h1> Sensores Zona <?php echo $id_localizacao;?></h1>
			<hr>
		</div>
		<div class = "edit_alarm">
    
			<table>
				<tr>
					<th><b>Localização</b></th>
					<th><b>Sensor</b></th>
					<th><b>Tipo</b></th>
					<th><b>Ativo</b></th>
					<th><b>Coordenadas</b></th>
					<th><b>Nome Casta</b></th>
				</tr>
                <?php if($sensores==NULL) {?>
                        <tr><td colspan="6">Não existem sensores nesta zona</td></tr>
				<?php } 
                else{ ?>
				<?php foreach ($sensores as $sensor) { ?>
				<tr>
					<td>Zona <?php echo $sensor['id_localizacao']; ?></td>
					<td>     <?php echo $sensor['id_sensor']."   <a href='estatistica_avancado2.php?Sensor1=".$sensor['id_sensor']."&Sensor2=-1&Periodo=year&numberOf=1&graph_choice=8'><img src='../images/stats.png' width='20px' height='20px'></a>";      ?> </td>
					<td><?php 
							if ($sensor['tipo']==0)
								   echo "Temperatura/Humidade";
							else
								   echo "Pluviosidade";	
						?>
					</td>
					<td><?php 
							if ($sensor['ativo']==TRUE)
							 {
								echo "<a href='../actions/actiondesativarsensor.php?id_sensor=".$sensor['id_sensor']."&id_localizacao=".$id_localizacao."'><img src='../images/true.png' width='20px' height='20px'></a>";
							 }
							else
							 {
								echo "<a href='../actions/actionativarsensor.php?id_sensor=".$sensor['id_sensor']."&id_localizacao=".$id_localizacao."'><img src='../images/false.png' width='20px' height='20px'></a>";
							 }
							if ($sensor['apagado']==FALSE)
							 {
								echo "<a href='../actions/actionapagarsensor.php?id_sensor=".$sensor['id_sensor']."&id_localizacao=".$id_localizacao."'><img src='../images/erase.png' width='20px' height='20px'></a>";
							 }
					  ?>          
					</td>    
					<td><?php echo $sensor['cordenadas'];?></td>
					<td><?php echo $sensor['nome_casta'];?></td>
				</tr>
				<?php } ?>
                <?php } ?>
			</table>
		  
			<form class="search" action="addsensor.php" style="float:right">
				<p>
				<input type="submit" value="Adicionar Sensor">
				</p>
				<p>
					<input  type="button" value="Voltar" onClick="history.go(-1);return true;"></input>
				</p>
			</form>
				
		</div>

	</div>
	<?php include 'common/footer.html'; ?>
</body>
</html>