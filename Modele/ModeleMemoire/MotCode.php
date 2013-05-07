<?php

class MotCode{

	protected $code;       
	protected $police;   
	public function __construct($c, $p){
			
	 $this->code = $c;
	 $this->police = $p;
	}
	public function getCode(){
		return $this->code;
	}
	public function getPolice(){
		return $this->police;
	}

}

?>