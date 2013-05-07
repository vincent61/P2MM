<?php 

class CorrespondanceMot{

protected $mot;
protected $motCode;
protected $police;
          
	public function __construct($m, $mc, $p){
	
		 $this->mot = $m;
		 $this->motCode = $mc;
		 $this->police = $p;
		 
	}
	public function getMot(){
		return $this->mot;
	}
	public function getMotCode(){
		return $this->motCode;
	}
	public function getPolice(){
		return $this->police;
	}




}

?>