<?php

class CodeLettre{

protected $code;
protected $typeLettre;
protected $police;
          
public function __construct($c, $t, $p){
		
 $this->code = $c;
 $this->typeLettre = $t;
 $this->police = $p;
}

public function getCode(){
	return $this->code;
}

public function getTypeLettre(){
	return $this->typeLettre;
}

public function getPolice(){
	return $this->police;
}
}

?>
