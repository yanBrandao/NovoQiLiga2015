<?php
class Banco{
	
	public function open(){
		$conecta = mysql_connect("localhost", "root", "root"); 
		mysql_select_db("QiLiga", $conecta) or print(mysql_error()); 
		echo "<br>"."Conexão e Seleção OK!"; 
		return $conecta; 
	}

	public function close(){
		mysql_close($conecta);
	}

	public function update($id){
		mysql_connect("localhost", "root", "root");
		mysql_select_db("QiLiga");
		//$string =  "UPDATE  ocorrencias SET situacao ='resolvido' WHERE  idOcorrencia ='$id'";
		$consulta = "SELECT * FROM ocorrencias WHERE idOcorrencia = ".$id;
		$pesquisa = mysql_query($consulta);
		
		$string_post = "UPDATE postes SET statusDia='OFF', statusNoite='ON' WHERE latitude LIKE '".$pesquisa["latitude"]."%'"." and longitude  LIKE '" .$pesquisa["longitude"]."%'";
		$string = "DELETE FROM ocorrencias WHERE idOcorrencia='$id'";
		$rs = mysql_query($string);
		$rs = mysql_query($string_post);
		
		$count=mysql_num_rows($rs);

		if($rs==1)
		{
			return 1;
		}else{
			return 0;
		}
	}
	
	public function verifica_login($login,$senha){
		mysql_connect("localhost", "root", "root");
		mysql_select_db("QiLiga");
		//echo "Login: ".$login."<br />Senha: ".$senha."<br />";
		
		$string = "SELECT * FROM usuarios WHERE email='$login' AND senha='$senha'";
		$rs = mysql_query($string);
	
		
		//echo "String: ".$string."<br />";
		//echo $rs."<br />";
		$vet = mysql_fetch_array($rs);
		//print_r($vet);

		$count=mysql_num_rows($rs);

		//echo $count."<br />";
		if($count==1)
		{
			return 1;
		}else{
			return 0;
		}
	}
}

?>
