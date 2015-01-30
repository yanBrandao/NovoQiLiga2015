<?php
	//include 'ocorrencias-dao.php';
	include 'poste-dao.php';
	include 'ocorrencias-dao.php';
	include 'usuario-dao.php';

	$latitude = '-3.042626063464728';
	$longitude = '-59.98364266008139';
	$novaLa = modificarNumero($latitude);;
	$novaLon = modificarNumero($longitude);
	echo $latitude;
	echo "<br>";
	echo $longitude;

	if (mudarStatusDiaPoste($novaLa, $novaLon, 'ON'))	
		echo "<br> OK <br>";
	else
		echo "<br> NAO";

	//echo "hahahahahah";

	/*$idUsuario = 1;
	$result = retornarUsuario($idUsuario);
	echo "<br>";
	echo $result;
	if(strcmp($result, "false"))
		echo $result;
	else
		echo "false";*/

	/*$resultado = consultarNumeroDeOcorrencias($latitude, $longitude);
	if(is_numeric($resultado))
		echo "<br> NNots: ".$resultado;
	else
		echo "NAO EH..."

	//print_r(consultarPostes());



	/*$f = fopen('POST_DATA.txt', 'a');
	fwrite($f, 'Latitude: '.$_POST['latitude']."\r\n");
	fwrite($f, 'Longitude: '.$_POST['longitude']."\r\n");
	fclose($f);*/
	
	
	//echo 'Ocorrencia enviada com sucesso';
	//echo 'nome-SPDATA-idade-SPDATA-país'
?>

