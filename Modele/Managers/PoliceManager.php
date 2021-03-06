﻿<?php			 
include_once 'cheminsPerso.php';
include_once $cheminServer.'modele/modeleMemoire/Police.php';
include_once $cheminServer.'modele/Managers/CorrespondanceLettreManager.php';

class PoliceManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);
	
  }
 
 public function setDb($db)
  {
    $this->_db = $db;
  }
  public function getDb(){
		return $this->_db;
  }
  
  public function add(Police $police)
  { 
	if($police instanceof Police){
		$q = $this->_db->query('SELECT police FROM Police WHERE police = \''.$police->getPolice().'\';');
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees['police'])
		{
			$x=0; // Exception "La police existe déja."; // Ajouter un try/catch
		}
		else{
		$this->_db->exec('INSERT INTO Police VALUES (\''.$police->getPolice().'\',\''.$police->getFichierCodes().'\',\''.$police->getCasse().'\');');
		//si insetion réussie:
		$this->remplirLettresCodes($police);
		}
	}
	else
		throw new Exception('Type reçu erroné.');
  }
 
  public function delete($police)
  {
	$policeString = (String) $police;
	$this->_db->exec('DELETE FROM CodeLettre WHERE police = \''.$policeString.'\';');
	$this->_db->exec('DELETE FROM MotCode WHERE police = \''.$policeString.'\';');
	$this->_db->exec('DELETE FROM Police WHERE police = \''.$policeString.'\';');
	

  }
 
  public function get($nomPolice)
  { 
	$l = (String) $nomPolice;
    $q = $this->_db->query('SELECT police, fichierCode,casse FROM Police WHERE police = \''.$nomPolice.'\';');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Police($donnees['police'],$donnees['fichierCode'],$donnees['casse']);
  }
  
 
  public function update($oldPolice, $newPolice)
  {
	if($oldPolice instanceof Police and $newPolice instanceof Police){
	    $this->_db->exec('UPDATE CodeLettre SET police = \''.$newPolice->getPolice().'\' WHERE police = \''.$oldPolice->getPolice().'\'');
	    $this->_db->exec('UPDATE MotCode SET police = \''.$newPolice->getPolice().'\' WHERE police = \''.$oldPolice->getPolice().'\'');
		$this->_db->exec('UPDATE Police SET police = \''.$newPolice->getPolice().'\', fichierCode = \''.$newPolice->getFichierCodes().'\', casse = '.$newPolice->getCasse().' WHERE police = \''.$oldPolice->getPolice().'\'');
	}else
		throw new Exception('Type reçu erroné.');
  }
 
  
  
    public function getAll()
  { 
    $q=$this->_db->prepare("SELECT * FROM Police order by police");
	$q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }
  
  public function getAllCasse($casse)
  //vérifier que casse est bien un int
  { 
    $q=$this->_db->prepare('SELECT police FROM Police WHERE casse = '.$casse.' order by police');
	$q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }
  
  public function remplirLettresCodes(Police $police)
  {
	  include 'cheminsPerso.php';

	  $clManager = new CorrespondanceLettreManager($this->getDb());
	  if (($handle = fopen($cheminServer.'Fichiers/Polices/'.$police->getFichierCodes(), "r")) !== FALSE) {
		while (($ligneCorrespondance = fgets($handle)) !== FALSE) {
			if($police->getCasse() ==0){
				//si on traite des majuscules, la ligne est transformée également
				$ligneCorrespondance = strtoupper((string)$ligneCorrespondance);
			}
			else{
				$ligneCorrespondance = strtolower((string)$ligneCorrespondance);
			
			}

			$correspondances = explode(":", $ligneCorrespondance);
			$lettre = $correspondances[0];
			$l = new Lettre($lettre);
			$codesArray = explode(",", $correspondances[1]);			
			$i = 0;
			while(($code = array_pop($codesArray)) !==NULL){
				
				$c = new CodeLettre(trim($code), $i, $police->getPolice());
				$clManager->addCombinaison($l, $c);
				$i++;
			}	
			}
		fclose($handle);
		}		
	}
}
?>