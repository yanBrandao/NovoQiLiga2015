<?php

class Usuario {

	private $idUsuario;
	private $nome;
	private $codmanausenergia;
	private $email;
	private $senha;


	function __construct( $idUsuario,  $nome, $email, $codmanausenergia,
			$senha) {
		$this->idUsuario = $idUsuario;
		$this->nome = $nome;
		$this->codmanausenergia = $codmanausenergia;
		$this->email = $email;
		$this->senha = $senha;
	}



	function  getId() {
		return $this->idUsuario;
	}

	function setId( $idUsuario) {
		$this->idUsuario = $idUsuario;
	}

	function getNome() {
		return $this->nome;
	}

	function setNome( $nome) {
		$this->nome = $nome;
	}

	function getCodmanausenergia() {
		return $this->codmanausenergia;
	}

	function setCodmanausenergia( $codmanausenergia) {
		$this->codmanausenergia = $codmanausenergia;
	}

	function getEmail() {
		return $this->email;
	}

	function setEmail( $email) {
		$this->email = $email;
	}

	function getSenha() {
		return $this->senha;
	}

	function setSenha( $senha) {
		$this->senha = $senha;
	}
	
}



?>