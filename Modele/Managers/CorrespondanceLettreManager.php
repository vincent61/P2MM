﻿<?php
include 'cheminsPerso.php';
include_once $cheminServer.'modele/modeleMemoire/CorrespondanceLettre.php';
include_once $cheminServer.'modele/Managers/CodeLettreManager.php';
include_once $cheminServer.'modele/Managers/LettreManager.php';


class CorrespondanceLettreManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(CorrespondanceLettre $cor)
  {
	  if($cor instanceof CorrespondanceLettre){
			$q = $this->_db->prepare('SELECT * FROM CorrespondanceLettre WHERE lettreAscii = \''.$cor->getLettreAscii().'\' AND police= \''.$cor->getPolice().'\' AND code= \''.$cor->getCode() .'\';');
			$q->execute();
			$donnees = $q->fetch(PDO::FETCH_ASSOC);
			if($donnees['lettreAscii']){
				$x=0; // instruction pour remplir le "if"
						//Créer un try/catch avec une exception
			}
			else{
			  $this->_db->exec('INSERT INTO CorrespondanceLettre VALUES (\''.$cor->getLettreAscii().'\',\''.$cor->getCode().'\',\''.$cor->getPolice().'\');');
			  }
			}
			else{
						throw new Exception('Type reçu erroné');
			}
		
      
  }
  public function addCombinaison($lettre, $codeLettre){
  //cette fonction se charge d'ajouter une nouvelle lettre dans la BDD, ainsi que le code et la correspondance associés
	  if($lettre instanceof Lettre and $codeLettre instanceof CodeLettre ){
		  
		  $clm = new CodeLettreManager($this->_db);
		  $lm = new LettreManager($this->_db);
		  
		  $cor = new CorrespondanceLettre($lettre->getLettreAscii(), $codeLettre->getCode(), $codeLettre->getPolice() );
		  
		  $lm->add($lettre);
		  $clm->add($codeLettre);
		  $this->add($cor);
	  
	}
	else{
		throw new Exception('Type reçu erroné');
	}
	
 }
  public function delete(CorrespondanceLettre $cor)
  {
	if($cor instanceof CorrespondanceLettre){
    $this->_db->exec('DELETE FROM CorrespondanceLettre WHERE lettreAscii = \''.$cor->getLettreAscii().'\' and code = \''.$cor->getCode().'\' and police = \''.$cor->getPolice().'\'');
	}
	else{
		throw new Exception('Type reçu erroné');
	}
  }
 
  public function get($lettreAscii,$code, $police)
  { 
  $lettreAscii = (String) $lettreAscii;
  $code = (String) $code;
  $police = (String) $police;
  $q = $this->_db->query('SELECT lettreAscii, code, police FROM CorrespondanceLettre WHERE lettreAscii = \''.$lettreAscii.'\' and code = \''.$code.'\' and police= \''.$police.'\';');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new CorrespondanceLettre($donnees['lettreAscii'],$donnees['code'],$donnees['police']);
  }

  public function getCodes($lettreAsciiParam, $police)
  { 
  $lettreAscii = (String) $lettreAsciiParam->getLettreAscii();
  $police = (String) $police;
  $q = $this->_db->prepare('SELECT code FROM CorrespondanceLettre WHERE lettreAscii = \''.$lettreAscii.'\' and police= \''.$police.'\';');
	$q->execute();
	$donnees = $q->fetchAll();
	return $donnees;
  }
 
  public function update($cor, $newCor)
  {
  if($cor instanceof CorrespondanceLettre and $newCor instanceof CorrespondanceLettre){
	   $this->_db->exec('UPDATE CorrespondanceLettre SET lettreAscii = \''.$newCor->getLettreAscii().'\', code = \''.$newCor->getCode().'\', police = \''.$newCor->getPolice().
	   '\'WHERE lettreAscii = \''.$cor->getLettreAscii().'\' AND code = \''.$cor->getCode().'\' AND police = \''.$cor->getPolice().'\';');
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