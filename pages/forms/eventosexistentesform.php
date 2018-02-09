<?php
	session_start();
	include_once('../config/init.php');
	include_once('../database/events.php');
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
	</head>

	<body>
		<?php
			$result = getFutureEvents($datahoje);
			
			if (count($result) == 0)
				echo "<p class='text_for_div'> Não existem eventos agendados. </p>";
			
			if (count($result) > 0){
				echo "<table>";

				echo "<tr>";
					echo "<th>Evento</th><th>Descriçao</th><th>Data</th><th>Prioridade</th><th>Eliminar</th>";
				echo "</tr>";

				foreach($result as $linha){
					echo "<tr>";
						echo "<td>".$linha['titulo']."</td><td>".$linha['descricao']."</td><td>".$linha['data']."</td><td>".$linha['prioridade']."</td><td style='text-align:center'><a href='../actions/eliminarEvento.php?id=".$linha['id_evento']."'><img src='../images/erase.png' width='20px' height='20px'></a></td>";
					echo "</tr>";
			   }
			   
				echo "</table>";
			}
		?>
	</body>
</html>
