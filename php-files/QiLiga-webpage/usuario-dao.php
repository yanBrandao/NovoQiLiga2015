<?php
	
	include 'conexao.php';
	include "usuario-class.php";
	
	function cadastrarUsuario(Usuario $usuario)
	{
			$query = "INSERT INTO usuarios (nome, email, codManausE, senha) VALUES 
												('".$usuario->getNome()."', 
													'".$usuario->getEmail()."', '".$usuario->getCodmanausenergia()."', 
													'".$usuario->getSenha()."')";
				
			$result = mysql_query($query) or die("Cannot execute query: $query\n");
			if(mysql_affected_rows() > 0)
				return 1;
			else
				return 0;		
			
	}

	function consultarUsuario($login, $senha)
	{
		
		$consulta = "SELECT * FROM usuarios WHERE email = '".$login."' and senha = '" .$senha."'";
		$pesquisa = mysql_query($consulta);
		if($resultado = mysql_fetch_array($pesquisa))
			return $resultado['idUsuario'];
			//return $cliente = new Cliente($resultado["id"],$resultado["nome"],$resultado["sobrenome"],$resultado["sexo"],$resultado["email"],$resultado["nome"]);
		else
			return "false";
	} 

	function retornarUsuario($idUsuario)
	{
		
		$consulta = "SELECT * FROM usuarios WHERE idUsuario = '".$idUsuario."'";
		$pesquisa = mysql_query($consulta);
		if($resultado = mysql_fetch_array($pesquisa))
			return $resultado['nome'];
			//return $cliente = new Cliente($resultado["id"],$resultado["nome"],$resultado["sobrenome"],$resultado["sexo"],$resultado["email"],$resultado["nome"]);
		else
			return 'false';
	} 



?>
