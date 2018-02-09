<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">
	</head>
	
	<body>
		<form class="search" action="../actions/novoalarme.php" method="post">
		<p> Insira os parâmetros desejados para o alarme. </p>
		<p> No caso de não querer que o seu alarme contemple algum dos factores, simplesmente não o preencha. </p>
		<br></br>
		<p><input type="number" name="tmax" placeholder="Temperatura máxima ºC" size=35 style="width:280px; height:32px"></input></p>
		<br></br>
		<p><input type="number" name="tmin" placeholder="Temperatura mínima ºC" size=35 style="width:280px; height:32px"></input></p>
		<br></br>
		<p><input type="number" name="hmax" placeholder="Humidade máxima %" size=35 style="width:280px; height:32px"></input></p>
		<br></br>
		<p><input type="number" name="hmin" placeholder="Humidade mínima %" size=35 style="width:280px; height:32px"></input></p>
		<br></br>
		<p><input type="number" name="pmax" placeholder="Pluviosidade máxima mm" size=35 style="width:280px; height:32px"></input></p>
		<br></br>
		<p><input type="number" name="pmin" placeholder="Pluviosidade mínima mm" size=35 style="width:280px; height:32px"></input></p>
		<br></br>
		<p><input type="text" name="descricao" placeholder="Descrição" size=35 style="width:280px; height:32px"></input></p>
		<br></br>
		<br></br>
		<input type="submit" name="inserir" value="Inserir Alarme"> </input>	
		</form>
	</body>
</html>