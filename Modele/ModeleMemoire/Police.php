<?php

class Police{
	
protected $police;
protected $fichierCodes;    
protected $casse;        
	public function __construct($p,$f,$c){
		$this->police = $p;	
		$this->fichierCodes = $f;
		$this->casse = $c;
	
	}
	public function getPolice(){
		return $this->police;
	}
	public function getFichierCodes(){
		return $this->fichierCodes;
	}
	public function getCasse(){
		return $this->casse;
	}
}
?>












