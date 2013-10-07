<?php
include_once 'modele/modeleMemoire/Dictionnaire.php';
class DictionnaireManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);

  }
 
  public function add(Dictionnaire $dictionnaire)
  {
	  if($dictionnaire instanceof Dictionnaire){
	$q = $this->_db->query('SELECT dictionnaire,langue, fichierDictionnaire, casse, statut FROM Dictionnaire WHERE dictionnaire = \''.$dictionnaire->getDictionnaire().'\';');
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees['dictionnaire'])
		{
			echo "Le Dictionnaire existe déja."; // Mettre une exception
		}
	  else{  
    	$this->_db->exec('INSERT INTO Dictionnaire (dictionnaire, langue, fichierDictionnaire, casse) VALUES (\''.$dictionnaire->getDictionnaire().'\', \''.$dictionnaire->getLangue().'\', \''.$dictionnaire->getFichierDictionnaire().'\', '.$dictionnaire->getCasse().');');
	  }
	  }
  }
 
  public function delete($dictionnaire)
  {
	$dictionnaire = (String) $dictionnaire;
	$this->_db->exec('DELETE FROM Mot WHERE dictionnaire = \''.$dictionnaire.'\'');
    $this->_db->exec('DELETE FROM Dictionnaire WHERE dictionnaire = \''.$dictionnaire.'\'');
  }
 
  public function get($dictionnaire)
  { 
  	$dictionnaire = (String) $dictionnaire;
    $q = $this->_db->query('SELECT dictionnaire,langue, fichierDictionnaire, casse, statut FROM Dictionnaire WHERE dictionnaire = \''.$dictionnaire.'\';');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Dictionnaire($donnees['dictionnaire'],$donnees['langue'],$donnees['fichierDictionnaire'],$donnees['casse'],$donnees['statut']);
  }
  
   public function getAll($order='dictionnaire')
  { 
    $q = $this->_db->prepare('SELECT dictionnaire,langue, fichierDictionnaire, casse, statut FROM Dictionnaire order by '.$order.';');
	$q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }

  public function getAllByCasse($casse){
  /**
  * Renvoie tous les dictionnaires dont la casse est $casse (int) 0 pour majuscule 1 pour minuscule
  */
  
  $q = $this->_db->prepare('SELECT dictionnaire FROM Dictionnaire where casse='.$casse.';');
	$q->execute();
    $donnees = $q->fetchAll();
	$result = array();
	foreach($donnees as $d){
	array_push($result, $d['dictionnaire']);
	}
    return $result;
  }
  
  public function getAllByStatut($statut){
  /**
  * Renvoie tous les dictionnaires dont la casse est $statut (str) : charge noncharge ou chargement en cours
  */
  $q = $this->_db->prepare('SELECT dictionnaire FROM Dictionnaire where statut=\''.$statut.'\';');
  $q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }
 
  public function update($oldDico, $newDico)
  {
  	   $this->_db->exec('UPDATE Mot SET dictionnaire = \''.$newDico->getDictionnaire().'\' WHERE dictionnaire = \''.$oldDico->getDictionnaire().'\';');
	   $this->_db->exec('UPDATE Dictionnaire SET dictionnaire = \''.$newDico->getDictionnaire().'\', langue = \''.$newDico->getLangue().'\',fichierDictionnaire = \''.$newDico->getFichierDictionnaire().'\', casse = '.$newDico->getCasse().' WHERE dictionnaire = \''.$oldDico->getDictionnaire().'\';');
  }
  
  public function updateStatut($dicoName, $newStatut)
  {
  	$dico = (String) $dicoName;
  	$stat = (String) $newStatut;
  	$this->_db->exec('UPDATE Dictionnaire SET statut = "'.$stat.'" WHERE dictionnaire = \''.$dico.'\';');
  }
  
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
  
  public function remplirMotsCode($dictionnaire)
  {
	  include 'cheminsPerso.php';
	  $con = $this->_db;
	  $motManager = new MotManager($con);
	  $row = 1;
	  $log = $cheminServer.'error.log';
	  error_log('Codage dico '.$dictionnaire->getDictionnaire(), 3, $log);
	  // A MODIFIER SELON L'ADRESSE DU SERVEUR.
	  if (($handle = fopen($cheminServer.'Fichiers/Dictionnaires/'.$dictionnaire->getFichierDictionnaire(), "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
			$num = count($data);
				$motManager->add(new Mot($data[0], $dictionnaire->getCasse(), $dictionnaire->getDictionnaire(),$data[1]));
				//$motManager->codage(new Mot($data[0], $dictionnaire->getCasse(), $dictionnaire->getDictionnaire(),$data[1]));
			}
		fclose($handle);
	}
  }
  
}

?>