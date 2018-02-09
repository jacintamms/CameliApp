<?php

	function createEvent($titulo, $descricao, $data, $prioridade){
		global $conn;
		
		$stmt = $conn->prepare("INSERT INTO vinha.eventos (titulo,descricao,data,prioridade)
								VALUES ( ?, ?, ?, ?)");
		
		return $stmt->execute(array($titulo, $descricao, $data, $prioridade));
	}
	
	function deleteEvent($id) {
		global $conn;
		
		$stmt = $conn->prepare("DELETE FROM vinha.eventos
								WHERE id_evento = ?");			  

		return $stmt->execute(array($id));
	}
	
	function getPastEvents($data){
		global $conn;
		
		$query = "SELECT * FROM vinha.eventos 
				  WHERE data <= '".$data."'::date 
				  ORDER BY data ASC";
		$stmt = $conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt->fetchAll();
	}
	
	function getFutureEvents($data){
		global $conn;
		
		$query = "SELECT * FROM vinha.eventos 
				  WHERE data > '".$data."'::date 
				  ORDER BY data ASC";
								
		$stmt = $conn->prepare($query);
		
		$stmt->execute();
		
		return $stmt->fetchAll();
	}

function tabela_agendas()
{
	global $conn;
		
	$stmt= $conn->prepare("SELECT id_evento, titulo, descricao, data, prioridade
							FROM vinha.eventos
							WHERE data > clock_timestamp()
							order by prioridade='Baixa',prioridade='Media',prioridade='Alta',data ASC
                        ");	

	$stmt->execute();	
    
	return $stmt->fetchAll();	
} 

?>