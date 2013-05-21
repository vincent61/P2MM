<?php 
class Mot{

protected $mot;
protected $casse;
protected $dictionnaire;
protected $frequence;
          
	public function __construct($m, $c, $d, $f){
			
		 $this->casse = $c;
		 
		 if($c==0){//mot en majuscule
			$m = strtoupper((string)$m);
		 }
		 else{
			$m = strtolower((string)$m);
		 }
		 
		 $this->mot = $m;
		 $this->dictionnaire = $d;
		 $this->frequence = $f;
		 
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
	public function getFrequence(){
		return $this->frequence;
	}
}
?>
