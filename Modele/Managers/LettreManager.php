<?php
include_once 'cheminsPerso.php';
include_once $cheminServer.'modele/modeleMemoire/Lettre.php';
class LettreManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);
  }
 
  public function add($lettre)
  {
	if($lettre instanceof Lettre){
		$this->_db->exec('INSERT INTO Lettre VALUES (\''.$lettre->getLettreAscii().'\');');
	}
	else
		throw new Exception('Type reçu erroné.');
  }
 
  public function delete($lettre)
  {
	if($lettre instanceof Lettre){
		$this->_db->exec('DELETE FROM CorrespondanceLettre WHERE lettreAscii = \''.$lettre->getLettreAscii().'\';');
		$this->_db->exec('DELETE FROM Lettre WHERE lettreAscii = \''.$lettre->getLettreAscii().'\';');
	}
	else
		throw new Exception('Type reçu erroné.');
  }
 
  public function get($lettre)
  { 
	$l = (String) $lettre;
    $q = $this->_db->query('SELECT lettreAscii, count(*) as total FROM Lettre WHERE lettreAscii = \''.$lettre.'\'');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
	if ($donnees['total']==0)
		throw new Exception('Lettre n\'existe pas.');
    return new Lettre($donnees['lettreAscii']);
  }
  
  public function getAll()
  { 
    $q=$this->_db->prepare("SELECT * FROM Lettre order by lettreAscii");
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

  public function update($oldLettre, $newLettre)
  {
	if($oldLettre instanceof Lettre and $newLettre instanceof Lettre){
	   $this->_db->exec('UPDATE CorrespondanceLettre SET lettreAscii = \''.$newLettre->getLettreAscii().'\' WHERE lettreAscii = \''.$oldLettre->getLettreAscii().'\';');
	   $this->_db->exec('UPDATE Lettre SET lettreAscii = \''.$newLettre->getLettreAscii().'\' WHERE lettreAscii = \''.$oldLettre->getLettreAscii().'\';');
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