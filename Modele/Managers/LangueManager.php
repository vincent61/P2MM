<?php
include '../Modele/ModeleMemoire/Langue.php';

class LangueManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);
  }
 
  public function add($langue)
  {
	if($langue instanceof Langue){
		$this->_db->exec('INSERT INTO Langue VALUES (\''.$langue->getLangue().'\');');
	}
	else
		throw new Exception('Type reçu erroné.');
  }
 
  public function delete($langue)
  {
	if($langue instanceof Langue){
		$this->_db->exec('DELETE FROM Langue WHERE langue = \''.$langue->getLangue().'\';');
	}
	else
		throw new Exception('Type reçu erroné.');
  }
 
  public function get($langue)
  { 
	$l = (String) $langue;
    $q = $this->_db->query('SELECT langue FROM Langue WHERE langue = \''.$langue.'\'');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Langue($donnees['langue']);
  }
  
  public function getAll()
  { 
    $q=$this->_db->prepare("SELECT * FROM Langue order by langue");
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

  public function update($oldLangue, $newLangue)
  {
	if($oldLangue instanceof Langue and $newLangue instanceof Langue){
	   $this->_db->exec('UPDATE Langue SET langue = \''.$newLangue->getLangue().'\' WHERE langue = \''.$oldLangue->getLangue().'\';');
	}
	else
		throw new Exception('Type reçu erroné.');
  }
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
}
?>