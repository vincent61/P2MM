<?php
include_once 'modele/Managers/MotManager.php';
class Dictionnaire{
	
	protected $dictionnaire;
	protected $langue;
	protected $fichierDictionnaire;    
	protected $casse;        
	protected $statut;   

	public function __construct($d,$l,$fd,$c, $s="noncharge"){
		$this->dictionnaire = $d;	
		$this->langue = $l;	
		$this->fichierDictionnaire = $fd;
		$this->casse = $c;
		$this->statut = $s;
	}
	public function getDictionnaire(){
		return $this->dictionnaire;
	}
	public function getLangue(){
		return $this->langue;
	}
	public function getFichierDictionnaire(){
		return $this->fichierDictionnaire;
	}
	public function getCasse(){
		return $this->casse;
	}	
	
	public function getStatut(){
		return $this->statut;
	}	
 
}
?>