<?php include('banco.class.php');
	$id = $_GET['idOcorrencia'];
	$banco = new Banco();
	$ret = $banco->update($id);
	echo $ret;
	if($ret == 1){
		header("LOCATION: home.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>QiPrest</title>
		<meta http-equiv="Content-Language" content="English" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
	</head>
	<body>
		<div id="wrap">
			<div id="header">
				<h1><a href="#">Sistema QiLiga</a></h1>
			</div>

			<div class="alert alert-info alert-dismissable">
				<h3 id="cor">Ocorrências</h3>
				<br>
				<table class="table table-bordered">
					<tr>
				    	<td id="caquinha"><b>ID</b></td>
				    	<td id="caquinha"><b>Latitude</b></td>
				    	<td id="caquinha"><b>Longitude</b></td>
				    	<td id="caquinha"><b>Notificações</b></td>
				    	<td id="caquinha"><b>Situação</b></td>
						<td id="caquinha"><b>Data de Crianção</b></td>				    	
						<td id="caquinha"><b>Status</b></td>
						<td id="caquinha"><b>Rua</b></td>
						<td id="caquinha"><b>Verificação</b></td>
					</tr>

				<?php
					// Conexão ao banco
					$link = mysql_connect('localhost','root','root');
					 
					// Seleciona o Banco de dados através da conexão acima 
					$conexao = mysql_select_db('QiLiga',$link); if($conexao){
					 
					$sql = "SELECT idOcorrencia,latitude,Longitude,NNotificacoes,situacao,dataCriacao,status,ruaPoste FROM ocorrencias";
					 
					$consulta = mysql_query($sql);
					 			 
					// Armazena os dados da consulta em um array associativo
					 $i = 0;
					while($registro = mysql_fetch_assoc($consulta)){
						$i++;
						echo '<tr>';
						 
						echo '<td id="fundocentro">'.$registro["idOcorrencia"].'</td>';
						 
						echo '<td id="fundocentro">'.$registro["latitude"].'</td>';
						 
						echo '<td id="fundocentro">'.$registro["Longitude"].'</td>';

						echo '<td id="fundocentro">'.$registro["NNotificacoes"].'</td>';
						 
						echo '<td id="fundocentro">'.$registro["situacao"].'</td>';

						echo '<td id="fundocentro">'.$registro["dataCriacao"].'</td>';

						echo '<td id="fundocentro">'.$registro["status"].'</td>';

						echo '<td id="fundocentro">'.$registro["ruaPoste"].'</td>';
						
						?>
							<td id="fundo" text-align="center">
								<a href="home.php?idOcorrencia=<?php echo $registro['idOcorrencia'];?>" class="btn btn-success" type="button"><b>Confirmar</b></button>
							</td>
						
						<?php
						echo '</tr>';
					 
					}
					 
					echo '</table>';
					 
					}
					 
					?>		
			</div>

			<div id="clear"></div>
		</div>

		
	</body>
	
</html>
