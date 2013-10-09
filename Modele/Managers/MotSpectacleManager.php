<?php
include 'modele/modeleMemoire/MotSpectacle.php';
class MotSpectacleManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);

  }
 
  public function add($mot)
  {
	  if($mot instanceof MotSpectacle){
	    $q = $this->_db->prepare('SELECT mot FROM MotSpectacle WHERE mot = \''.$mot->getMot().'\';');
		$q->execute();
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees['mot'])
		{
			$x=0;//exception "Le Mot existe déja."; Ajouter un try_catch 
		}
	  else{  
    	$this->_db->exec('INSERT INTO MotSpectacle (mot) VALUES (\''.$mot->getMot().'\');');
	  }
	  }
  }
 
  public function delete($mot)
  {
  	$m = (String) $mot;
    $this->_db->exec('DELETE FROM MotSpectacle WHERE mot = \''.$m.'\';');
  }
 
  public function get($mot)
  { 
  $mot = (String) $mot;
    $q = $this->_db->query('SELECT mot FROM MotSpectacle WHERE mot = \''.$mot.'\';');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Mot($donnees['mot']);
  }

   public function getAll()
  { 
	$q = $this->_db->prepare('select * from MotSpectacle order by id');
	$q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }
 
  public function update($oldMot, $newMot)
  {
  	if($oldMot instanceof MotSpectacle && $newMot instanceof MotSpectacle){
	   $this->_db->exec('UPDATE MotSpectacle SET mot = \''.$newMot->getMot().'\' WHERE mot = \''.$oldMot->getMot().'\';');
  	}else
	   throw new Exception('Type reçu erroné.');
  }
 
	public function exist($motParam)
  { 
    $q = $this->_db->prepare('SELECT count(*) AS total FROM MotSpectacle WHERE mot = \''.$motParam->getMot().'\';');
	$q->execute();
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return $donnees['total'];
  }
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
}
?>