<?php 

class Mot{

protected $mot;
protected $casse;
protected $dictionnaire;
          
	public function __construct($m, $c, $d){
			
		 $this->casse = $c;
		 
		 if($c==0){//mot en majuscule
			$m = strtoupper((string)$m);
		 }
		 else{
			$m = strtolower((string)$m);
		 }
		 
		 $this->mot = $m;
		 $this->dictionnaire = $d;
		 
	}
	public function getMot(){
		return $this->mot;
	}
	public function getCasse(){
		return $this->casse;
	}
	public function getDictionnaire(){
		return $this->dictionnaire;
	}




}

?>
