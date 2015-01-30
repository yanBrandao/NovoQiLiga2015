<?php

class Gamification
{
	private $idGame;
	private $idUsuario;
	private $latitude;
	private $longitude;

	function __construct($idUsuario, $latitude, $longitude)
	{
		$this->idUsuario = $idUsuario;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
	}

	function getIdUsuario()
	{
		return $this->idUsuario;
	}
	function setIdusuario($idUsuario)
	{
		$this->idUsuario = $idUsuario;
	}

	function getIdGame()
	{
		return $this->idGame;
	}
	function setIdGame($idGame)
	{
		$this->idGame = $idGame;
	}
	
	function getLatitude()
	{
		return $this->latitude;
	}
	function setLatitude($latitude)
	{
		$this->latitude = $latitude;
	}

	function getLongitude()
	{
		return $this->longitude;
	}
	function setLongitude($longitude)
	{
		$this->longitude = $longitude;
	}
}

?>