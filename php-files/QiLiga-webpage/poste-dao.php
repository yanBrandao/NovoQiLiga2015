<?php
	
	include 'conexao.php';
	include "poste-class.php";
	
	function cadastrarPoste(Poste $poste)
	{
			$query = "INSERT INTO postes (latitude,longitude,statusDia,statusNoite) VALUES 
												('".$poste->getLatitude()."', 
													'".$poste->getLongitude()."', '".$poste->getStatusDia()."', 
													'".$poste->getStatusNoite()."')";
				
			$result = mysql_query($query) or die("Cannot execute query: $query\n");
			if(mysql_affected_rows() > 0)
				return 1;
			else
				return 0;		
			
	}

	function consultarPostes()
	{
		$listaPoste = NULL;
		$consulta = "SELECT * FROM postes";
		$pesquisa = mysql_query($consulta);
		while($resultado = mysql_fetch_array($pesquisa)){
			$poste = new Poste($resultado["idPoste"],$resultado["latitude"],$resultado["longitude"],$resultado["statusDia"],$resultado["statusNoite"]);
			$listaPoste[] = $poste;
		}
		return $listaPoste;
	}

	function modificarNumero($numeroPosicao)
	{
		$numero = explode(".",$numeroPosicao);
		$fracao = $numero[1];
		$numerlReal = $numero[0].".".$fracao[0].$fracao[1].$fracao[2].$fracao[3].$fracao[4];
		return $numerlReal;
	}



	function mudarStatusDiaPoste($latitude, $longitude, $status)
	{
		$consulta = "UPDATE postes SET statusDia= '".$status. "' WHERE latitude LIKE '".$latitude."%'"." and longitude  LIKE '" .$longitude."%'";
		$pesquisa = mysql_query($consulta);
		if($pesquisa > 0){
			return true;
		}
		else
			return false;
	}
	
	function mudarStatusOcorrencia($latitude, $longitude)
	{
		$data = explode( "-", $_POST['data']);
		$data_atual = $data[3];
		$data_hora = explode(":", $data_atual);
		$hora = (int) $data_hora[0];
		if($hora >= 6 and $hora <= 17)
		{
			$latitude = modificarNumero($_POST['latitude']);
			$longitude = modificarNumero($_POST['longitude']);
			mudarStatusDiaPoste($latitude,$longitude, 'ON');
		}else
		{
			$latitude = modificarNumero($_POST['latitude']);
			$longitude = modificarNumero($_POST['longitude']);
			mudarStatusNoitePoste($latitude,$longitude, 'OFF');
		}
	}


	function mudarStatusNoitePoste($latitude, $longitude, $status)
	{
		
		$consulta = "UPDATE postes SET statusNoite= '".$status. "' WHERE latitude LIKE '".$latitude."%'"." and longitude  LIKE '" .$longitude."%'";
		$pesquisa = mysql_query($consulta);
		if($pesquisa > 0){
			return true;
		}
		else
			return false;
	}





?>
