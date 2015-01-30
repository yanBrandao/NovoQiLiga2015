<?php
	
	include 'conexao.php';
	include "ocorrencia-class.php";
	
	function cadastrarOcorrencia(Ocorrencia $ocorrencia)
	{
			$query = "INSERT INTO ocorrencias (latitude,longitude,NNotificacoes,situacao, dataCriacao, status,ruaPoste) VALUES 
												('".$ocorrencia->getLatitude()."', 
													'".$ocorrencia->getLongitude()."', '".$ocorrencia->getNNotificacoes()."', 
													'".$ocorrencia->getSituacao()."',
													'".$ocorrencia->getDataCriacao()."',
													'".$ocorrencia->getStatus()."', 
													'".$ocorrencia->getRuaPoste()."')";
				
			$result = mysql_query($query) or die("Cannot execute query: $query\n");
			if(mysql_affected_rows() > 0)
				return 1;
			else
				return 0;		
			
	}

	function consultarOcorrencia($latitude, $longitude)
	{
		
		$consulta = "SELECT * FROM ocorrencias WHERE latitude = '".$latitude."' and longitude = '" .$longitude."'";
		$pesquisa = mysql_query($consulta);
		if($resultado = mysql_fetch_array($pesquisa))
			return true;
			//return $cliente = new Cliente($resultado["id"],$resultado["nome"],$resultado["sobrenome"],$resultado["sexo"],$resultado["email"],$resultado["nome"]);
		else
			return false;
	}

	function consultarTodasOcorrencias()
	{
		$listaOcorrencia = NULL;
		$consulta = "SELECT * FROM ocorrencias";
		$pesquisa = mysql_query($consulta);
		while($resultado = mysql_fetch_array($pesquisa))
		{
			$ocorrencia = new Ocorrencia($resultado["latitude"],$resultado["longitude"],$resultado["NNotificacoes"],
				$resultado["status"],$resultado["ruaPoste"],$resultado["situacao"],$resultado["dataCriacao"]);
			$ocorrencia->setIdOCorrencia($resultado["idOcorrencia"]);

			$listaOcorrencia[] = $ocorrencia;
		}

		return $listaOcorrencia;
		
	}

	function consultarNumeroDeOcorrencias($latitude, $longitude)
	{
		
		$consulta = "SELECT * FROM ocorrencias WHERE latitude = '".$latitude."' and longitude = '" .$longitude."'";
		$pesquisa = mysql_query($consulta);
		if($resultado = mysql_fetch_array($pesquisa))
			return $resultado['NNotificacoes'];
			//return $cliente = new Cliente($resultado["id"],$resultado["nome"],$resultado["sobrenome"],$resultado["sexo"],$resultado["email"],$resultado["nome"]);
		else
			return -1;
	}

	function updateNotificacoes($latitude, $longitude, $NNotificacoes)
	{
		
		$consulta = "UPDATE ocorrencias SET NNotificacoes= '".$NNotificacoes. "' WHERE latitude = '".$latitude."'"." and longitude  = '" .$longitude."'";
		$pesquisa = mysql_query($consulta);
		if(mysql_affected_rows()){
			return true;
		}
		else
			return false;
	}
	
	function updateStatus($latitude, $longitude, $status)
	{
		
		$consulta = "UPDATE ocorrencias SET status= '".$status. "' WHERE latitude = '".$latitude."'"." and longitude  = '" .$longitude."'";
		$pesquisa = mysql_query($consulta);
		if(mysql_affected_rows()){
			return true;
		}
		else
			return false;
	}

?>

