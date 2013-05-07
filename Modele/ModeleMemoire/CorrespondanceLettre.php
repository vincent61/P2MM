<?php

class CorrespondanceLettre{
protected $lettreAscii;
protected $code;      
protected $police;
    
public function __construct($la,$c, $p){
	$this->lettreAscii = $la;	
 	$this->code = $c;
	$this->police = $p;
}
public function getLettreAscii(){
	return $this->lettreAscii;
}
public function getCode(){
	return $this->code;
}
public function getPolice(){
		return $this->police;
	}
}
?>