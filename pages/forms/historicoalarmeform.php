<?php 
	include_once('../config/init.php');
	include_once('../database/alarmes.php');
	
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
		
	</head>

	<body>
    <?php
        $result = getAlarms();

        echo "<table>";

 
		echo "<tr>";
			echo "<th>Sensor</th><th>Descriçao</th><th>Data</th><th>Temperatura</th><th>Humidade</th><th>Pluviosidade</th><th>Eliminar</th>";
		echo "</tr>";
		
		foreach($result as $linha)
	   {
		 //$linha = pg_fetch_row($result, $i);
			echo "<tr>";
			if(!$linha['apagado'] || $linha['apagado'] == FALSE){
				echo "<td>".$linha['id_sensor']."</td><td>".$linha['descricao']."</td><td>".$linha['data_alarme']."</td><td>".$linha['temperatura']."</td><td>".$linha['humidade']."</td><td>".$linha['pluviosidade']."</td><td style='text-align: center'><a href='../actions/eliminarLogAlarme.php?id=".$linha['id']."'><img src='../images/erase.png' width='20px' height='20px'></a></td>";
			}
			echo "</tr>";
	   }
	   echo "  </table>";
?>