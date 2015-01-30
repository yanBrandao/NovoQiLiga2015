<?php
//string json contendo os dados de um funcionário
$json_str[] = '{"nome":"Jason Jones", "idade":38, "sexo": "M"}';
$json_str[] = '{"nome":"yan", "idade": 12, "sexo": "M"}';

//faz o parsing na string, gerando um objeto PHP
$obj[] = json_decode($json_str);

//imprime o conteúdo do objeto 
echo "nome: $obj->nome<br>"; 
echo "idade: $obj->idade<br>"; 
echo "sexo: $obj->sexo<br>"; 
?> 

