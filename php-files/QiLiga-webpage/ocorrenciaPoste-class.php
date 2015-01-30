<?php

class ocorrenciaPoste {

    private $id;
    private $rua;
    private $descricao;
    private $dt_criado;

    function __construct($rua, $descricao, $dt_criado) {
        $this->rua = $rua;
        $this->descricao = $descricao;
        $this->dt_criado = $dt_criado;
    }
    
    function getId() {
        return $this->id;
    }

    function getRua() {
        return $this->rua;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getDt_criado() {
        return $this->dt_criado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setDt_criado($dt_criado) {
        $this->dt_criado = $dt_criado;
    }
}

?>