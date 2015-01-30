<?php

include 'conexao.php';
include "ocorrenciaPoste-class.php";

function cadastrarOcorrenciaPostes(ocorrenciaPoste $poste) {
    $query = "insert into ocorrencia_poste (rua, descricao, dt_criacao) values ('" . $poste->getRua() . "',"
            . "'" . $poste->getDescricao() . "', "
            . "'" . $poste->getDt_criado() . "')";
    
    $result = mysql_query($query) or die("Cannot execute query: $query\n");
    
    if (mysql_affected_rows() > 0)
        
        return 1;
    
    else
        
        return 0;
}


?>
