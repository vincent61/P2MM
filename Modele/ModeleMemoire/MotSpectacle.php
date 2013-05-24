<?php 
class MotSpectacle{
protected $mot;

          
	public function __construct($m){
		 $this->mot = $m;
	}
	public function getMot(){
		return $this->mot;
	}
}
?>