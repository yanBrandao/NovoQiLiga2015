<?php
	
	//include 'conexao.php';
	include "gamification-class.php";
	
	function cadastrarGamification(Gamification $gamification)
	{
			$query = "INSERT INTO gamifications (idUsuario,latitude,longitude) VALUES 
												('".$gamification->getIdUsuario()."', '".$gamification->getLatitude()."', 
													'".$gamification->getLongitude()."')";
				
			$result = mysql_query($query) or die("Cannot execute query: $query\n");
			if(mysql_affected_rows() > 0)
				return 1;
			else
				return 0;		
			
	}

	function consultarGamification($idUsuario, $latitude, $longitude)
	{
		
		$consulta = "SELECT * FROM gamifications WHERE idUsuario = ".$idUsuario." and latitude = '".$latitude."' and longitude = '" .$longitude."'";
		$pesquisa = mysql_query($consulta);
		if($resultado = mysql_fetch_array($pesquisa))
			return true;
			//return $cliente = new Cliente($resultado["id"],$resultado["nome"],$resultado["sobrenome"],$resultado["sexo"],$resultado["email"],$resultado["nome"]);
		else
			return false;
	} 

	function contabilizarPontuacao($idUsuario)
	{
		$consulta = "SELECT * FROM gamifications WHERE idUsuario = ".$idUsuario;
		$pesquisa = mysql_query($consulta);
		if($resultado = mysql_fetch_array($pesquisa))
			return mysql_affected_rows();
		else
			return 0;
	}

	



?>
