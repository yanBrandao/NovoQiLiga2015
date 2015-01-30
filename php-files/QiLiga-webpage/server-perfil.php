<?php

	include 'usuario-dao.php';
	include 'gamification-dao.php';

	$idUsuario = (String) $_POST['idUsuario'];
	//$idUsuario = 1;
	$result = retornarUsuario($idUsuario);
	if(strcmp($result, "false"))
	{
		$pontos = contabilizarPontuacao($idUsuario);
		echo $result.".".$pontos;	

	}
	else
		echo "false";
?>

