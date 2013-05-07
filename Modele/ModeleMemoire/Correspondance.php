<?php

class Correspondance{
protected $lettreAscii;
protected $codeNum;          
public function __construct($la,$mc){
	$this->lettreAscii = $la;	
 	$this->codeNum = $mc;
}
public function lettreAscii(){
	return $this->lettreAscii;
}
public function codeNum(){
	return $this->codeNum;
}
}
?>