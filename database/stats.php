<?php
	function getSensors(){
		global $conn;
		
		$stmt = $conn->prepare("SELECT id_sensor, id_casta, nome_casta
                                FROM vinha.sensor JOIN vinha.localizacao USING (id_localizacao) 
									              JOIN vinha.casta USING (id_casta)
						        WHERE ativo = TRUE AND apagado = FALSE
                                ORDER BY id_casta, id_sensor");
		
		$stmt->execute();
		
		return $stmt->fetchAll();
		
	}
	
	function getTableInfo(){
		global $conn;
		
		$query = "SELECT id_sensor, trunc(max(temperatura)*100)/100 AS tmax, trunc(max(humidade)*100)/100 AS hmax, 
									trunc(min(temperatura)*100)/100 AS tmin, trunc(min(humidade)*100)/100 AS hmin, 
									trunc(avg(temperatura)*100)/100 AS tavg, trunc(avg(humidade)*100)/100 AS havg, 
						 nome_casta
				  FROM info_leituras JOIN sensor USING(id_sensor)
									 JOIN localizacao USING(id_localizacao)
									 JOIN casta USING(id_casta)
				  GROUP BY id_sensor, id_localizacao, nome_casta
				  ORDER BY id_sensor";
									  
		$stmt = $conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt->fetchAll();
	}
	
	function getDataForGraph($query){
		/*Query feita em estatistica_avancado2.php - não repete código para formar título*/
		global $conn;
		
		$stmt = $conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt->fetchAll();
	}