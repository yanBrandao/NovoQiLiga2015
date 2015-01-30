<?php
	
	include 'poste-dao.php';

	function getAllDataJSON($arrayListPoste)
	{
		$aux = array(
			'postes'=>getListJSON($arrayListPoste));
		return($aux);
	}
	
	function getListJSON($arrayListPoste)
	{
		//$aux = array();
		for($i = 0, $tam = count($arrayListPoste); $i < $tam ; $i++)
		{
			$aux[] = array(
			'idPoste'=>$arrayListPoste[$i]->getId(),
			'latitude'=>$arrayListPoste[$i]->getLatitude(),
			'longitude'=>$arrayListPoste[$i]->getLongitude(),
			'statusDia'=>$arrayListPoste[$i]->getStatusDia(),
			'statusNoite'=>$arrayListPoste[$i]->getStatusNoite(),
		);
		}
		return($aux);
	}


		
	//if(strcmp('get-json', $_POST['method']) == 0)
//	{
		
		//$poste1 = new Poste(1,'-3.041574','-59.983593','OFF','ON');
		//$poste2 = new Poste(1,'-3.041801','-59.983631','OFF','ON');

		$listaPostes = consultarPostes();
		$aux = getAllDataJSON($listaPostes);
		echo json_encode($aux);

//	}
?>