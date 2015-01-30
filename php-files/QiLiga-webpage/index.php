<?php include('banco.class.php');
	session_start();
	$banco = new Banco();
	$login = $_POST['inputEmail'];
	$senha = $_POST['inputPassword'];

	
	// store session data
	$_SESSION['usuario']=$login;
	
	if($login!="" or $senha!=""){
		$ret = $banco->verifica_login($login,$senha);
		if($ret == 1){
			header("LOCATION: home.php");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>QiPrest - QiLiga</title>
		<meta http-equiv="Content-Language" content="English" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<div id="wrap">
			<div id="header">
				<h1><a href="#">Sistema-Web QiLiga</a></h1>
			</div>

			<div class="alert alert-info alert-dismissable">
				<h3 id="cor">Login</h3>
				<form class="form-horizontal" method="post" action="index.php">
				  <div class="control-group">
				    <label class="control-label" for="inputEmail">Email</label>
				    <div class="controls">
				      <input type="text" placeholder="Email" name="inputEmail" maxlength="50">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="inputPassword">Senha</label>
				    <div class="controls">
				      <input type="password" placeholder="Senha" name="inputPassword" maxlength="50">
				    </div>
				  </div>
				  <div class="control-group">
				    <div class="controls">
				      <label class="checkbox">
				        <input type="checkbox"> Lembre-se de mim
				      </label>
				      <button type="submit" class="btn">Entrar!</button>
				    </div>
				  </div>
				</form>
			</div>

			<div class="middle">
				
				<h2>Sobre o QiLiga</h2>
					QiLiga se destaca por ser singular no mercado unindo os conceitos de mapas e coleta de informação em tempo real, tornando possível a solução de problemas de iluminação pública de forma interativa e inteligente.
			</div>

			
			<div class="right">
				
					
			</div>

			<div id="clear"></div>
		</div>

	</body>
</html>

