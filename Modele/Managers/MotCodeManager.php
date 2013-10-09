<?php
include_once 'cheminsPerso.php';
include_once $cheminServer.'modele/modeleMemoire/MotCode.php';
class MotCodeManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);

  }
 
  public function add($motCode)
  {
  	  if($motCode instanceof MotCode){
	    $q = $this->_db->prepare('SELECT code, police FROM motcode WHERE code = \''.$motCode->getCode().'\'AND police = \'' .$motCode->getPolice() .'\';');
		$q->execute();
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees['code'])
		{
			//exception "Le Mot existe déja."; exception ou ignorer
			$x = 0; //instruction pour conserver le "if"
		}else{  
		    
			$this->_db->exec('INSERT INTO MotCode( code, police ) VALUES (\''.$motCode->getCode().'\', \''.$motCode->getPolice().'\')');
		  }
	  }
  }
 
  public function delete($motCode)
  {
  if($motCode instanceof MotCode){
  	$this->_db->exec('DELETE FROM CorrespondanceMot WHERE motCode = \''.$motCode->getCode().'\' AND police = \''.$motCode->getPolice().'\';');
    $this->_db->exec('DELETE FROM MotCode WHERE code = \''.$motCode->getCode().'\' AND police = \''.$motCode->getPolice().'\';');
	}
	else{
		throw new Exception('Type reçu erroné.');
	}
  }
 
  public function get($code, $police)
  { 
  	$c = (String) $code;
  	$p = (String) $police;

    $q = $this->_db->query('SELECT * FROM motcode WHERE code = \''.$c.'\' AND police= \''.$p .'\';');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new MotCode($donnees['code'], $donnees['police']);
  }
  
   public function getAll()
  { 
     $q = $this->_db->prepare('SELECT code, police FROM MotCode ORDER BY code');
	$q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }
 
  public function update($motCode, $newMotCode)
  {
  	 if($motCode instanceof MotCode and $newMotCode instanceof MotCode){
  	   $this->_db->exec('UPDATE CorrespondanceMot SET motCode = \''.$newMotCode->getCode().'\', police=\''.$newMotCode->getPolice().'\' WHERE motCode = \''.$motCode->getCode().'\'AND police = \''.$motCode->getPolice().'\';');
	   $this->_db->exec('UPDATE MotCode SET code = \''.$newMotCode->getCode().'\', police=\''.$newMotCode->getPolice().'\' WHERE code = \''.$motCode->getCode().'\'AND police = \''.$motCode->getPolice().'\';');
	   }
	else{
		throw new Exception('Type reçu erroné.');
	}
  }
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
}
?>