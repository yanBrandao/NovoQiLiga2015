<?php
	
	include 'ocorrencias-dao.php';

	function modificarNumero($numeroPosicao)
	{
		$numero = explode(".",$numeroPosicao);
		$fracao = $numero[1];
		$numerlReal = $numero[0].".".$fracao[0].$fracao[1].$fracao[2].$fracao[3].$fracao[4].$fracao[5];
		return $numerlReal;
	}

	function getAllDataJSON($arrayListOcorrencia)
	{
		$aux = array(
			'ocorrencias'=>getListJSON($arrayListOcorrencia));
		return($aux);
	}
	
	function getListJSON($arrayListOcorrencia)
	{
		//$aux = array();
		for($i = 0, $tam = count($arrayListOcorrencia); $i < $tam ; $i++)
		{
			$aux[] = array(
			'idOcorrencia'=>$arrayListOcorrencia[$i]->getIdOcorrencia(),
			'ruaPoste'=>$arrayListOcorrencia[$i]->getRuaPoste(),
			'NNotificacoes'=>$arrayListOcorrencia[$i]->getNNotificacoes(),
			'status'=>$arrayListOcorrencia[$i]->getStatus(),
			'situacao'=>$arrayListOcorrencia[$i]->getSituacao(),
			'latitude'=>modificarNumero($arrayListOcorrencia[$i]->getLatitude()),
			'longitude'=>modificarNumero($arrayListOcorrencia[$i]->getLongitude()),
		);
		}
		return($aux);
	}


		
	//if(strcmp('get-json', $_POST['method']) == 0)
//	{
		
		//$poste1 = new Poste(1,'-3.041574','-59.983593','OFF','ON');
		//$poste2 = new Poste(1,'-3.041801','-59.983631','OFF','ON');

		$listaOcorrencias = consultarTodasOcorrencias();
		$aux = getAllDataJSON($listaOcorrencias);
		echo json_encode($aux);

//	}
?>