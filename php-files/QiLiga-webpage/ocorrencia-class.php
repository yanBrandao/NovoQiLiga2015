<?php

class Ocorrencia
{
		private $idOcorrencia;
		private $latitude;
		private $longitude;
		private $nNotificacoes;
		private $status;
		private $ruaPoste;
		private $situacao;
		private $dataCriacao;
		
		function __construct($latitude, $longitude, $nNotificacoes, $status, $ruaPoste, $situacao, $dataCriacao)
		{
			$this->latitude = $latitude;
			$this->longitude = $longitude;
			$this->nNotificacoes = $nNotificacoes;
			$this->status = $status;
			$this->ruaPoste = $ruaPoste;
			$this->situacao = $situacao;
			$this->dataCriacao = $dataCriacao;
		}

	
		function getIdOcorrencia() {
			return $this->idOcorrencia;
		}
		function setIdOCorrencia($idOcorrencia) {
			$this->idOcorrencia = $idOcorrencia;
		}
		function getLatitude() {
			return $this->latitude;
		}
		function setLatitude($latitude) {
			$this->latitude = $latitude;
		}
		function getLongitude() {
			return $this->longitude;
		}
		function setLongitude($longitude) {
			$this->longitude = $longitude;
		}
		function getNNotificacoes() {
			return $this->nNotificacoes;
		}
		function setNNotificacoes($nNotificacoes) {
			$this->nNotificacoes = $nNotificacoes;
		}
		function getStatus() {
			return $this->status;
		}
		function setStatus($status) {
			$this->status = $status;
		}
		function getRuaPoste() {
			return $this->ruaPoste;
		}
		function setRuaPoste($ruaPoste) {
			$this->ruaPoste = $ruaPoste;
		}

		function getSituacao() {
			return $this->situacao;
		}
		function setSituacao ($situacao) {
			$this->situacao = $situacao;
		}
		function getDataCriacao() {
			return $this->dataCriacao;
		}
		
		


}

?>