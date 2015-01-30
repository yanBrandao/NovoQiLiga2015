<?php
include "poste-dao.php";

	$p = new Poste(0, $_POST['latitude'], $_POST['longitude'], 'OFF', 'ON');
	
	if (cadastrarPoste($p))
		echo 'Poste cadastrado com sucesso';
		else
			echo 'shit';

?>