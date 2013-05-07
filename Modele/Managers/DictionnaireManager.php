<?php
include '../Modele/ModeleMemoire/Dictionnaire.php';
class DictionnaireManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);

  }
 
  public function add(Dictionnaire $dictionnaire)
  {
	  if($dictionnaire instanceof Dictionnaire){
	$q = $this->_db->query('SELECT dictionnaire,langue, fichierDictionnaire, casse FROM Dictionnaire WHERE dictionnaire = \''.$dictionnaire->getDictionnaire().'\';');
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees['dictionnaire'])
		{
			echo "Le Dictionnaire existe déja.";
		}
	  else{  
    	$this->_db->exec('INSERT INTO Dictionnaire (dictionnaire, langue, fichierDictionnaire, casse) VALUES (\''.$dictionnaire->getDictionnaire().'\', \''.$dictionnaire->getLangue().'\', \''.$dictionnaire->getFichierDictionnaire().'\', '.$dictionnaire->getCasse().');');
	  }
	  }
  }
 
  public function delete($dictionnaire)
  {
	$dictionnaire = (String) $dictionnaire;
    $this->_db->exec('DELETE FROM Dictionnaire WHERE dictionnaire = \''.$dictionnaire.'\'');
  }
 
  public function get($dictionnaire)
  { 
  $dictionnaire = (String) $dictionnaire;
    $q = $this->_db->query('SELECT dictionnaire,langue, fichierDictionnaire, casse FROM Dictionnaire WHERE dictionnaire = \''.$dictionnaire.'\';');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Dictionnaire($donnees['dictionnaire'],$donnees['langue'],$donnees['fichierDictionnaire'],$donnees['casse']);
  }
  
   public function getAll()
  { 
    $q = $this->_db->query('SELECT dictionnaire,langue, fichierDictionnaire, casse FROM Dictionnaire ;');
    $donnees = $q->fetchAll();
    return $donnees;
  }

 
  public function update($oldDico, $newDico)
  {
	  echo 'UPDATE Dictionnaire SET dictionnaire = \''.$newDico->getDictionnaire().'\', langue = \''.$newDico->getLangue().'\',fichierDictionnaire = \''.$newDico->getFichierDictionnaire().'\', casse = '.$newDico->getCasse().' WHERE dictionnaire = \''.$oldDico->getDictionnaire().'\';';
	   $this->_db->exec('UPDATE Dictionnaire SET dictionnaire = \''.$newDico->getDictionnaire().'\', langue = \''.$newDico->getLangue().'\',fichierDictionnaire = \''.$newDico->getFichierDictionnaire().'\', casse = '.$newDico->getCasse().' WHERE dictionnaire = \''.$oldDico->getDictionnaire().'\';');
  }
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
}

?>
	
