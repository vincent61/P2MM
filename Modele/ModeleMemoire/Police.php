<?php
include '../Modele/Managers/CorrespondanceLettreManager.php';

class Police{
	
protected $police;
protected $fichierCodes;    
protected $casse;        
	public function __construct($p,$f,$c){
		$this->police = $p;	
		$this->fichierCodes = $f;
		$this->casse = $c;
	
	}
	public function getPolice(){
		return $this->police;
	}
	public function getFichierCodes(){
		return $this->fichierCodes;
	}
	public function getCasse(){
		return $this->casse;
	}

	public function remplirLettresCode()
  {
	  include '../cheminsPerso.php';
	  include '../dbconnect.php';
	  $clManager = new CorrespondanceLettreManager($con);
	  // A MODIFIER SELON L'ADRESSE DU SERVEUR.
	  if (($handle = fopen($cheminServer.'P2MM/Fichiers/Polices/'.$this->getFichierCodes(), "r")) !== FALSE) {
		while (($ligneCorrespondance = fgets($handle)) !== FALSE) {
			$correspondances = explode(":", $ligneCorrespondance);
			$lettre = $correspondances[0];
			$l = new Lettre($lettre);
			$codesArray = explode(",", $correspondances[1]);
			$code = array_pop($codesArray);
			$i = 0;
			while($code !==NULL){
				$code = array_pop($codesArray);
				$c = new CodeLettre($code, $i, $this->getPolice());
				$clManager->addCombinaison($l, $c);
				$i++;
			}
		
			}
		
		fclose($handle);
		}
		
	}
  
  
}
?>












