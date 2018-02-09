<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
	</head>
	
	<body>
		<p> Insira os parâmetros desejados para o alarme. </p>
		<p> No caso de não querer que o seu alarme contemple algum dos factores, simplesmente não o preencha. </p>
		<form class="search" action=<?php echo"../actions/editarAlarmeAction.php?id=".$row[0].""?> method="post">

		<p>
			<label> Temperatura máxima [ºC] </label>
			<input type="text" name="tmax" value="<?php echo $row[2];?>" size=35 style="width:280px; height:32px"> 
		</p>
	
		<p>
			<label> Temperatura mínima [ºC] </label>
			<input type="text" name="tmin" value="<?php echo $row[3];?>" size=35 style="width:280px; height:32px"> 
		</p>
		
		<p>
			<label> Humidade máxima [%] </label>
			<input type="text" name="hmax" value="<?php echo $row[4];?>" size=35 style="width:280px; height:32px">
		</p>
		
		<p>
			<label> Humidade mínima [%] </label>
			<input type="text" name="hmin" value="<?php echo $row[5];?>" size=35 style="width:280px; height:32px">
		</p>
	
		<p>
			<label> Pluviosidade máxima </label>
			<input type="text" name="pmax" value="<?php echo $row[6];?>" size=35 style="width:280px; height:32px">
		</p>
		
		<p>
			<label> Pluviosidade mínima </label>
			<input type="text" name="pmin" value="<?php echo $row[7];?>" size=35 style="width:280px; height:32px">
		</p>
	
		<p>
			<label> Descrição </label>
			<input type="text" name="descricao" value="<?php echo $row[8];?>" size=35 style="width:280px; height:32px">
		</p>
		<br></br>
		<br></br>
		<input type="submit" name="inserir" value="Alterar Alarme"> </input>	
		</form>
	</body>
</html>