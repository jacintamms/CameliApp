<?php

function tabela_sensores($id_localizacao)
{
	global $conn;
		
	$stmt= $conn->prepare("SELECT  *
							FROM sensor JOIN localizacao USING (id_localizacao)
                                        JOIN casta USING (id_casta)
                            WHERE apagado='FALSE' AND id_localizacao=?
                            ORDER BY id_sensor ASC");	

	$stmt->execute(array($id_localizacao));	
    
	return $stmt->fetchAll();	
} 

function novo_sensor($tipo, $ativo, $id_localizacao)
{
	global $conn;
		
	$stmt= $conn->prepare("INSERT INTO sensor (tipo, ativo, id_localizacao)						 
										VALUES (?, ?, ?)");
    
	print($query);
	
	$stmt->execute(array($tipo, $ativo, $id_localizacao));	
	return $stmt->fetchAll();				
}

function ativar_sensor($id_sensor)
	{
		global $conn;
		$stmt = $conn->prepare("UPDATE sensor
										SET ativo='TRUE'
										WHERE id_sensor=?
                                        ");
					
		$stmt->execute(array($id_sensor));		
		return $stmt->fetchAll();
    }

function desativar_sensor($id_sensor)
{
	global $conn;
		
	$stmt= $conn->prepare("UPDATE sensor
                                    SET ativo='FALSE'
                                    WHERE id_sensor=?
                                    ");
					
	$stmt->execute(array($id_sensor));
    return $stmt->fetchAll();
}

function apagar_sensor($id_sensor)
	{
		global $conn;
		$stmt = $conn->prepare("UPDATE sensor
										SET apagado='TRUE'
										WHERE id_sensor=?
                                        ");
					
		return $stmt->execute(array($id_sensor));		
    }


function tabela_zonas()
{
	global $conn;
		
	$stmt= $conn->prepare("SELECT  id_localizacao
										FROM localizacao
                                        ORDER BY id_localizacao ASC
                                        ");					
	$stmt->execute();	
    
	return $stmt->fetchAll();	
} 

?>