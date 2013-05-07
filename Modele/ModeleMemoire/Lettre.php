<?php

class Lettre{
protected $lettreAscii;
public function __construct($l){
	$this->lettreAscii = $l;	
}
public function getLettreAscii(){
	return $this->lettreAscii;
}

}
?>