<?php

	function deleteAlarm($id){
		global $conn;
		
		$stmt = $conn->prepare("DELETE FROM vinha.alarmes
								WHERE idalarme = ?;");			  

		return $stmt->execute(array($id));
	}
	
	function createAlarm($colunas, $valores){
		global $conn;
		
		$query = "INSERT INTO vinha.alarmes ".$colunas." VALUES ".$valores.";";
		$stmt = $conn->prepare($query);
		
		return $stmt->execute();
	}
	
	function editAlarm($colunas, $id){
		global $conn;
		
		$query = "UPDATE vinha.alarmes
				  SET ".$colunas."
                  WHERE idalarme = '".$id."'";
		
		$stmt = $conn->prepare($query);
		
		return $stmt->execute();
	}
	
	function deleteFromLog($id){
		global $conn;
	  
		$stmt = $conn->prepare("UPDATE vinha.logalarmes 
						SET apagado='True' 
						WHERE id= ?;");
		
		return $stmt->execute(array($id));
	}
	
	function AlarmLogCount(){
		global $conn;
		
		$stmt = $conn->prepare("SELECT COUNT(*) AS count
								FROM vinha.logalarmes
								WHERE apagado = 'FALSE' OR apagado IS NULL");
		
		$stmt->execute();
		
		return $stmt->fetch();
	}
	
	function getAlarms(){
		
		global $conn, $page, $page_size;
		
		$query =  "SELECT * 
		           FROM vinha.logalarmes 
				   WHERE apagado = 'FALSE' OR apagado IS NULL 
				   ORDER by data_alarme DESC 
				   LIMIT ".$page_size." OFFSET ".$page * $page_size.";";
		
		$stmt = $conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt->fetchAll();
	}

function tabela_alarmes()
{
	global $conn;
		
	$stmt= $conn->prepare("select id_sensor, descricao, data_alarme
                        from logalarmes
                        where data_alarme = (select max(data_alarme) from logalarmes as l where l.descricao = logalarmes.descricao)
						Order by data_alarme DESC");	

	$stmt->execute();	
    
	return $stmt->fetchAll();	
} 
?>