<?php
//en cours (non achevé, non testé)
include '../Modele/ModeleMemoire/CorrespondanceMot.php';

class CorrespondanceMotManager{
	private $_db; // Instance de db
 
	public function __construct($db){
		$this->setDb($db);
	}
 
	public function add($cor){
	   if($cor instanceof CorrespondanceMot){
	   	$q = $this->_db->query('SELECT * FROM CorrespondanceMot WHERE mot = \''.$cor->getMot().'\' AND police= \''.$cor->getPolice().'\' AND motCode= \''.$cor->getMotCode() .'\';');
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees['mot']){
			echo "La correpondance Mot-Code existe déja.";
		}
		else{
		  $this->_db->exec('INSERT INTO CorrespondanceMot VALUES (\''.$cor->getMot().'\',\''.$cor->getMotCode().'\',\''.$cor->getPolice().'\');');
		  }
		}
		else{
					throw new Exception('Type reçu erroné');
		}
	}

 
  public function delete($cor)
  {
	if($cor instanceof CorrespondanceMot){
    $this->_db->exec('DELETE FROM CorrespondanceMot WHERE mot = \''.$cor->getMot().'\' and motCode = \''.$cor->getMotCode().'\' and police = \''.$cor->getPolice().'\'');
	}
	else{
		throw new Exception('Type reçu erroné');
	}
  }
 
  public function get($mot,$motCode,$police)
  { 
	$mot = (String) $mot;
	$motCode = (String) $motCode;
	$police = (String) $police;
	$q = $this->_db->query('SELECT mot, motCode, police FROM CorrespondanceMot WHERE mot = \''.$mot.'\' and motCode = \''.$motCode.'\' and police= \''.$police.'\';');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new CorrespondanceMot($donnees['mot'],$donnees['motCode'],$donnees['police']);
  }
  
  public function update($cor, $newCor)
  {
	if($cor instanceof CorrespondanceMot){

	   $this->_db->exec('UPDATE CorrespondanceMot SET mot = \''.$newCor->getMot().'\', motCode = \''.$newCor->getMotCode().'\', police = \''.$newCor->getPolice().
	   '\'WHERE mot = \''.$cor->getMot().'\' AND motCode = \''.$cor->getMotCode().'\' AND police = \''.$cor->getPolice().'\';');
	   }
	 else{
		throw new Exception('Type reçu erroné');
	 }
  }
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
}

?>
	
