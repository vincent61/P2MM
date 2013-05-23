<?php
include '../Modele/ModeleMemoire/MotCode.php';
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
			echo "Le Mot existe déja.";
		}else{  
		    //echo 'INSERT INTO MotCode( code, police ) VALUES (\''.$motCode->getCode().'\', \''.$motCode->getPolice().'\');';
	    	$this->_db->exec('INSERT INTO MotCode( code, police ) VALUES (\''.$motCode->getCode().'\', \''.$motCode->getPolice().'\')');
		  }
	  }
  }
 
  public function delete($motCode)
  {
  if($motCode instanceof MotCode){
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
    //echo 'SELECT code, police FROM MotCode ORDER BY code';
    $q = $this->_db->prepare('SELECT code, police FROM MotCode ORDER BY code');
	$q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }
 /*
  public function getList()
  {// Serieux soucis de gestion mémoir: taille des array limités
    $dictionnaire = array();
 
    $q = $this->_db->query('SELECT mot FROM Dictionnaire ORDER BY mot');
 
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
     // $dictionnaire[] = new Mot($donnees['mot']);
	  echo $donnees['mot'];
    }
    return $dictionnaire;
  }*/
 
  public function update($motCode, $newMotCode)
  {
  	 if($motCode instanceof MotCode and $newMotCode instanceof MotCode){
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