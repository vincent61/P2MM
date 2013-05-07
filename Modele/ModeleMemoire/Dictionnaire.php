<?php

class Dictionnaire{
protected $dictionnaire;
protected $langue;
protected $fichierDictionnaire;    
protected $casse;        
	public function __construct($d,$l,$fd,$c){
		$this->dictionnaire = $d;	
		$this->langue = $l;	
		$this->fichierDictionnaire = $fd;
		$this->casse = $c;
	
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
}
?>