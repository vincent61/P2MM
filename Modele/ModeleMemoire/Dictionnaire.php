<?php
//include '../Modele/Managers/MotManager.php';
class Dictionnaire{
	
protected $dictionnaire;
protected $langue;
protected $fichierDictionnaire;    
protected $casse;        
	public function __construct($d,$l,$fd,$c){
		$this->dictionnaire = $d;	
		$this->langue = $l;	
		$this->fichierDictionnaire = $fd;
		$this->casse = $c;
	
	}
	public function getDictionnaire(){
		return $this->dictionnaire;
	}
	public function getLangue(){
		return $this->langue;
	}
	public function getFichierDictionnaire(){
		return $this->fichierDictionnaire;
	}
	public function getCasse(){
		return $this->casse;
	}
	
	/*
	public function remplirMotsCode()
  {
	  include '../cheminsPerso.php';
	  include '../dbconnect.php';
	  $motManager = new MotManager($con);
	  $row = 1;
	  // A MODIFIER SELON L'ADRESSE DU SERVEUR.
	  if (($handle = fopen($cheminServer.'P2MM/Fichiers/Dictionnaires/'.$this->getFichierDictionnaire(), "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
			$num = count($data);
			for ($c=0; $c < $num; $c++) {
				echo $data[$c] . "<br />\n";
				$motManager->codage(new Mot($data[$c], 0, 'min_bas'), ("demi_bas"));
			}
		}
		fclose($handle);
	}
  }
  */
}
?>