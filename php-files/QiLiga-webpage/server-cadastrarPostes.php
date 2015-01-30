<?php
	
	include 'poste-dao.php';


	$poste1 = new Poste(0, '-3.041574', '-59.983593', 'OFF', 'ON');
	$poste2 = new Poste(0, '-3.041801', '-59.983631', 'OFF', 'ON');
	$poste3 = new Poste(0, '-3.042103', '-59.983618', 'OFF', 'ON');
	$poste4 = new Poste(0, '-3.042360', '-59.983621', 'OFF', 'ON');
	$poste5 = new Poste(0, '-3.042626', '-59.983643', 'OFF', 'ON');

	if (cadastrarPoste($poste1))
		echo 'Poste cadastrado com sucesso';
	if (cadastrarPoste($poste2))
		echo 'Poste cadastrado com sucesso';
	if (cadastrarPoste($poste3))
		echo 'Poste cadastrado com sucesso';
	if (cadastrarPoste($poste4))
		echo 'Poste cadastrado com sucesso';
	if (cadastrarPoste($poste5))
		echo 'Poste cadastrado com sucesso';
	
	
//	}
	


	/*$f = fopen('POST_DATA.txt', 'a');
	fwrite($f, 'Latitude: '.$_POST['latitude']."\r\n");
	fwrite($f, 'Longitude: '.$_POST['longitude']."\r\n");
	fclose($f);*/
	
	
	//echo 'Ocorrencia enviada com sucesso';
	//echo 'nome-SPDATA-idade-SPDATA-país'
?>