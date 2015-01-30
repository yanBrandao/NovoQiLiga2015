<?php
	
	include 'usuario-dao.php';

	$usuario = new Usuario(0,$_POST['nome'], $_POST['email'],$_POST['codigoManausE'],$_POST['senha']);
	/*$usuario.setNome($_POST['nome']);
	$usuario.setEmail($_POST['email']);
	$usuario.setCodmanausenergia($_POST['codigoManausE']);
	$usuario.setSenha($_POST['senha']);*/
	
	if (cadastrarUsuario($usuario))
		echo 'true';
	else
		echo 'false';

	


?>