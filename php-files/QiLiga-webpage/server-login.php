<?php
	
	include 'usuario-dao.php';

	//$result = consultarUsuario($_GET['login'],$_GET['senha']);
	$result = consultarUsuario($_POST['login'], $_POST['senha']);
	if (strcmp($result, "false"))
		echo $result;
	else
		echo 'false';

?>