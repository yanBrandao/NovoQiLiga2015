<?php
include 'ocorrenciaPoste-dao.php';

$poste = new ocorrenciaPoste($_POST['rua'], $_POST['descricao'], $_POST['dt_criacao']);

if (cadastrarOcorrenciaPostes($poste)):
    
    echo 'true';

else:
    
    echo 'false';

endif;

?>