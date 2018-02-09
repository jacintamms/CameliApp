
<script type="text/javascript">

    function validar()
    {

		var formulario = document.myForm

		var evento = formulario.evento.value

		var descricao = formulario.descricao.value

		var data = formulario.date.value

		var prioridade = formulario.prioridade.value

		var submitOK="True"

//colocar menor 0;
	if (evento.length<1 || descricao.length<1 || data.length<1 || prioridade.length<1)
	 	{
		 alert("Por favor preencha todos os campos!")
		 submitOK="False"
 		}

	if (submitOK=="False")
	 	{
		 return false
		}
    }

</script>

<html>
	<head>
		<link rel="stylesheet" type="text/css"  href="../css/stylesheetExample.css">
	</head>

	<body>
		<p> Insira todos parâmetros pedidos para adicionar Eventos. </p>
		<form name="myForm" class="search" action="../actions/acaocalendario.php" onsubmit="return validar()" method="post">
			<p>
				<label> Título</label>
				<input type="text" name="evento" placeholder="Evento - Título" size=35 style="width:320px; height:32px;">
			</p>
			<p></p>
			<p>
				<label style = "vertical-align: top"> Descrição</label>
				<textarea maxlength="280"  placeholder="Limite de 280 carateres" type="text" name="descricao" style="width:320px; height:100px;vertical-align:baseline;"></textarea>
			</p>
			<p>
				<label> Data</label>
				<input type="date" name="date">
			</p>
			<p></p>
			<p>
				<label> Prioridade</label>
				<input type="radio" name="prioridade" value="Alta"> Alta</input><br></br>
				<input type="radio" name="prioridade" value="Medio"> Média</input><br></br>
				<input type="radio" name="prioridade" value="Baixa"> Baixa</input><br></br>
				<input  type='submit' name='Submeter' value='Adicionar'> </input>
			</p>

        </form>
	</body>
</html>
