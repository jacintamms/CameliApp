<!DOCTYPE html>
<?php
	session_start();
	/*	$conn = pg_connect("host=db.fe.up.pt dbname=ee08160 user=ee08160 password=seai");
	if (!$conn)
		echo "ERRO: Nao foi possivel estabelecer ligacao à base de dados";

	$query = "set schema 'vinha';";
	pg_exec($conn, $query);*/
?>

<?php

	include_once ("../database/alarmes.php");
    include_once ("../database/events.php");
?>

<html>
	<head>
		<title> CameliApp</title>
        <meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/stylesheetExample.css">

	</head>

	<body>
		<?php 
			include '../config/init.php';
			include 'common/header.html'; 
		?>
        
        <?php

		$alarmes = tabela_alarmes();
	?>
        <?php

		$agendas = tabela_agendas();
	?>
			<div class = "main_page" style="height:100%; width:100%">
	

			
				<div class = "main_page_title">
					<h1> Mosteiro de Landim </h1>
					<hr>
				</div>
				
				<div class="display_alarm" style="width:20%; float:left; margin-left:0%; margin-right:1%;">
                
                    <table style="font-size:9px;">
                <tr>
                <th colspan="3"><b>ALARMES</b></th>
                </tr>
				<tr>
					<th><b>Sensor</b></th>
					<th><b>Descrição</b></th>
					<th><b>Data Alarme</b></th>
				</tr>
                <?php if($alarmes==NULL) {?>
                        <tr><td colspan="5">Não existem alarmes do sistema</td></tr>
				<?php } 
                else{ ?>
				<?php foreach ($alarmes as $alarme) { ?>
				<tr>
					<td><?php echo $alarme['id_sensor']; ?></td>
                    <td><?php echo $alarme['descricao']; ?></td>
                    <td><?php echo $alarme['data_alarme']; ?></td>
                </tr>
                    <?php } ?>
                    <?php } ?>
                    </table>
                </div>
                
                <div class="display_alarm" style="width:15%; float:left; margin-right:12%;">
                
                    <table style="font-size:9px;">
                <tr>
                <th colspan="5"><b>AGENDA</b></th>
                </tr>
				<tr>
					<th><b>Evento</b></th>
					<th><b>Título</b></th>
					<th><b>Descrição</b></th>
                    <th><b>Data</b></th>
					<th><b>Prioridade</b></th>
				</tr>
                <?php if($agendas==NULL) {?>
                        <tr><td colspan="5">Não existem eventos agendados</td></tr>
				<?php } 
                else{ ?>
				<?php foreach ($agendas as $agenda) { ?>
                
                
                <tr>
					<td><?php echo $agenda['id_evento']; ?></td>
                    <td><?php echo $agenda['titulo']; ?></td>
                    <td><?php echo $agenda['descricao']; ?></td>
                    <td><?php echo $agenda['data']; ?></td>
                    <td><?php echo $agenda['prioridade']; ?></td>
                </tr>
                    <?php } ?>
                    <?php } ?>
                    </table>
                </div>
				
				
	 			<div id="map" style="margin-left:3%;">

						<script>
							var map;
							function initMap() {
								map = new google.maps.Map(document.getElementById('map'), {
									center: {lat: 41.380085, lng:  -8.462702},
									zoom: 17,
									scrollwheel:false,
									draggable:false,
									disableDefaultUI: true,
									disableDoubleClickZoom: true,
									mapTypeId:google.maps.MapTypeId.SATELLITE
								});
								 //                ZONA 1            //

								var zona = {lat: 41.380414, lng: -8.462741};
								var contentString = 'Zona 1 <div><a href="zona1.php?id_localizacao=1"><font color="green">Info Sensores</font></a><br><b>Casta: </b> Loureiro</div>';
								var infowindow = new google.maps.InfoWindow({
									content: contentString
								});
								var marker = new google.maps.Marker({
									position: zona,
									map: map,
									title: 'Zona 1'
								});
								
								marker.addListener('click', function() {
									infowindow.open(map, marker);
								});

								  //                  ZONA 2              //

								var zona2 = {lat: 41.379310, lng: -8.463177};
								var contentString2 = 'Zona 2 <div><a href="zona1.php?id_localizacao=2"><font color="green">Info Sensores</font></a><br><b>Casta: </b> Trajadura</div>';
								var infowindow2 = new google.maps.InfoWindow({
									content: contentString2
								});
								var marker2 = new google.maps.Marker({
									position: zona2,
									map: map,
									title: 'Zona 2'
								});
								marker2.addListener('click', function() {
									infowindow2.open(map, marker2);
								});

								  //                  ZONA 3              //

								var zona3 = {lat: 41.380837, lng: -8.461454};
								var contentString3 = 'Zona 3 <div><a href="zona1.php?id_localizacao=3"><font color="green">Info Sensores</font></a><br><b>Casta: </b> Pedernã</div>';
								var infowindow3 = new google.maps.InfoWindow({
									content: contentString3
								});
								var marker3 = new google.maps.Marker({
									position: zona3,
									map: map,
									title: 'Zona 3'
								});
								marker3.addListener('click', function() {
									infowindow3.open(map, marker3);
								});
							}
						</script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB95suoVLm6bW60M6UnoFU_Nsz-2J9CsMM&callback=initMap"
						async defer></script>

				</div>					
			</div>

		<?php include 'common/footer.html'; ?>
	</body>
</html>
