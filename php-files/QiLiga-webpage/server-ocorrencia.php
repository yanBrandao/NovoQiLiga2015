<?php
	
	include 'ocorrencias-dao.php';
	include 'gamification-dao.php';
	include 'poste-dao.php';


	$idUsuario = (int) $_POST['idUsuario'];
	if (consultarOcorrencia($_POST['latitude'], $_POST['longitude']))
	{
		// Se existir a consulta, verificiar se este usuário já realizou está ocorrência,
		// caso contrário incrementar o número de ocorrências.
		if(consultarGamification($_POST['idUsuario'], $_POST['latitude'], $_POST['longitude']))
			echo 'Desculpe, mas você já fez está ocorrência.';
		else
		{
			$numeroN = consultarNumeroDeOcorrencias($_POST['latitude'],$_POST['longitude']);
			if($numeroN > 0)
			{
				//echo "NUM: ".$numeroN;
				$nNotificacoes = $numeroN + 1;
			}else{
				$nNotificacoes = (int) $_POST['nNotificacoes'];
			}

			updateNotificacoes($_POST['latitude'],$_POST['longitude'], $nNotificacoes);

			$status = "";
			if($nNotificacoes <= 7)
			{
				$status = "Baixo";
				updateStatus($_POST['latitude'],$_POST['longitude'], $status);
			}
			else if($nNotificacoes >= 8 and $nNotificacoes <= 12)
			{
				$status = "Médio";
				updateStatus($_POST['latitude'],$_POST['longitude'], $status);
			}				
			else
			{
				$status = "Crítico";
				updateStatus($_POST['latitude'],$_POST['longitude'], $status);
				
			}

			$gamification = new Gamification($_POST['idUsuario'],$_POST['latitude'],$_POST['longitude']);
			if (cadastrarGamification($gamification))
				echo 'Ocorrência enviada com sucesso. :D';
			else
				echo 'Erro ao cadastrar!';
		}
	}
	else
	{
		//Ocorrência não encontrada, então cadastrar.
		$nNotificacoes = (int) $_POST['nNotificacoes'];
		$ocorrencia = new Ocorrencia($_POST['latitude'],$_POST['longitude'],$nNotificacoes,$_POST['status'],$_POST['ruaPoste'], $_POST['situacao'], $_POST['data']);
		if (cadastrarOcorrencia($ocorrencia))
		{	

			$gamification = new Gamification($_POST['idUsuario'],$_POST['latitude'],$_POST['longitude']);
			if (cadastrarGamification($gamification))
			{
				$data = explode( "-", $_POST['data']);
				$data_atual = $data[3];
				$data_hora = explode(":", $data_atual);
				$hora = (int) $data_hora[0];
				//echo "Lat: ".$_POST['latitude']." Long: ".$_POST['longitude']."Hora: $hora\n";
				if($hora >= 6 and $hora <= 17)
				{
					$latitude = modificarNumero($_POST['latitude']);
					$longitude = modificarNumero($_POST['longitude']);
					//$latitude = $_POST['latitude'];
					//$longitude = $_POST['longitude'];
					if (mudarStatusDiaPoste($latitude,$longitude, 'ON'))
						echo 'Ocorrência enviada com sucesso! ON';
					else
						echo 'Erro ao cadastrar!1';	
				}
				else
				{
					$latitude = modificarNumero($_POST['latitude']);
					$longitude = modificarNumero($_POST['longitude']);
					if (mudarStatusNoitePoste($latitude,$longitude, 'OFF'))
						echo 'Ocorrência enviada com sucesso! OFF';
					else
						echo 'Erro ao cadastrar!2';
				}

			}
			else
				echo 'Erro ao cadastrar!';
		}
		else
			echo 'Erro ao cadastrar!';	
}

?>