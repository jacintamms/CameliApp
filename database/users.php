<?php
	function checkLogin($username, $password) {
		global $conn;
		
		$stmt = $conn->prepare("SELECT * 
							    FROM vinha.operador 
							    WHERE username = ? AND 
								      password = ? AND 
								      apagado = FALSE;");			  

		$stmt->execute(array($username, $password));
		
		return $stmt->fetch();
	}
	
	function checkUser($username, $email){
		global $conn;
		
		$stmt = $conn->prepare("SELECT * 
								FROM vinha.operador
								WHERE username = ? AND 
								      email = ?;");
		$stmt->execute(array($username, $email));
		
		return $stmt->fetch();
	}
	
	function changePassword($username, $email, $password){
		global $conn;
		
		$stmt = $conn->prepare("UPDATE vinha.operador 
								SET password= ?
								WHERE username = ? AND email = ? ;");
		
		$stmt->execute(array($password, $username, $email));
		
		return $stmt->fetch();
	}
	
	function getUsers(){
		global $conn;
		
		$stmt = $conn->prepare("SELECT username, nome, email, permissão 
								FROM vinha.operador
								WHERE apagado = 'FALSE'");
		
		$stmt->execute();
		
		return $stmt->fetchAll();
	}
	
	function eliminarUser($user){
		global $conn;
		$stmt = $conn->prepare("UPDATE operador
							   SET apagado = 'TRUE'
			                   WHERE username = ?;");
		
		return $stmt->execute(array($user));
	}
	
	function adicionarUser($nome, $username, $email, $permissao, $password){
		global $conn;
		$stmt = $conn->prepare("INSERT INTO operador (username, email, password, nome, permissão)
								VALUES (?,?,?,?,?)");
		
		return $stmt->execute(array($username, $email, $password, $nome, $permissao));
	}
?>