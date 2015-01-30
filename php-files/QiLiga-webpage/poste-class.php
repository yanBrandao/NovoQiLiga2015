<?php

class Poste
{
		private $id;
		private $latitude;
		private $longitude;
		private $statusDia;
		private $statusNoite;
		
		function __construct($id, $latitude,$longitude, $statusDia, $statusNoite)
		{
			$this->id = $id;
			$this->latitude = $latitude;
			$this->longitude = $longitude;
			$this->statusDia = $statusDia;
			$this->statusNoite = $statusNoite;
		}

		
		function getId() {
			return $this->id;
		}
		function setId($id) {
			$this->id = $$id;
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
		function getStatusDia() {
			return $this->statusDia;
		}
		function setStatusDia($statusDia) {
			$this->statusDia = $statusDia;
		}
		function getStatusNoite() {
			return $this->statusNoite;
		}
		function setStatusNoite($statusNoite) {
			$this->statusNoite = $statusNoite;
		}

		
		
}

?>