<?php
	session_start();
?>

<html>

<head>
  <title>CameliApp </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\css\paginapessoal.css">
  <link rel="stylesheet" type="text/css" href="..\css\stylesheetExample.css">
 
 <script>
function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
            a_p = "<span>AM</span>";
        } else {
            a_p = "<span>PM</span>";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
     document.getElementById('clock-large').innerHTML=curr_hour + " : " + curr_minute + " : " + curr_second + " " + a_p;
        }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);

</script>

</head>

<body onload="startTime()">
<?php include '../config/init.php'; ?>
 <?php include 'common/header.html'; ?>
 
 <?php

 $user= $_SESSION['name'];

//	1. Estabelecimento da ligacao 'a bdd
$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
			if (!$conn) {
				print "ERRO: Nao foi possivel estabelecer ligacao à base de dados";
				exit;
			}

//  2.  Criacao da query dinamica e echo para debug
$query = "SELECT * FROM vinha.operador WHERE username = '$user'";

//	3. Execucao da query
  $result = pg_exec($conn, $query);
  pg_close($conn);
  $row = pg_fetch_row($result,0); 

 ?>

<div class = "main_page">
	<div class = "Welcome">
	 Welcome <?php echo"" .$row[0]; ?>!
	 <hr>
	</div>
	<div class="User">
		 <img width="135px" height="135px" src="user.png" ></img>
	</div>
	<div class="Info">
	
		<img width="40px" height="40px" src="check.png" ></img>
		<div class="etiqueta"> Nome: </div> 
		<div class="resultado"> <?php echo"" .$row[1]; ?> </div> 
		<p></p>
		<img width="40px" height="40px" src="envelope.png" ></img>
		<div class="etiqueta1"> Email: </div> 
		<div class="resultado1"> <?php echo"" .$row[3]; ?> </div> 	
		<p></p>
		<img width="40px" height="40px" src="lock.png" ></img>
		<div class="etiqueta2"> Password: </div> 
		<div class="resultado2"> <?php echo"" .$row[2]; ?> </div> 
	
	</div>

	<div class="clock">
	<div class="wrapper-clockdate">
		<div id="clock-large"></div>
	</div>
	</div>

</div>

 <?php include 'common/footer.html'; ?>
</body>
</html>