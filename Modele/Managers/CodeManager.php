<?php
include 'modele/modeleMemoire/Code.php';
class CodeManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);
  }
 
  public function add($code)
  {
	if($code instanceof Code)
		$this->_db->exec('INSERT INTO Code SET mot = \''.$mot->getCode().'\'');
	else
		throw new Exception('Type reçu erroné.');
  }
 
  public function delete($code)
  {
	if($code instanceof Code)
		$this->_db->exec('DELETE FROM Code WHERE mot = \''.$mot->getCode().'\'');
	else
		throw new Exception('Type reçu erroné.');
  }
 
  public function get($code)
  { 
	$c = (String) $code;
	$q = $this->_db->query('SELECT code FROM Code WHERE code = \''.$c.'\'');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new MotSpectacle($donnees['code']);
  }

 
  public function update($code, $newCode)
  {
	if($code instanceof Code)
	   $this->_db->exec('UPDATE Code SET code = \''.$newCode.'\' WHERE code = \''.$mot->getCode().'\'');
	else
	   throw new Exception('Type reçu erroné.');
  }
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
}

?>
	
