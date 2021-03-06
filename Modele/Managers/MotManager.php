﻿<?php
include_once 'cheminsPerso.php';
include_once $cheminServer.'modele/modeleMemoire/Mot.php';
include_once $cheminServer.'modele/Managers/PoliceManager.php';
include_once $cheminServer.'modele/Managers/MotCodeManager.php';
include_once $cheminServer.'modele/Managers/CorrespondanceMotManager.php';

class MotManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);

  }
 
  public function add($mot)
  {
	  if($mot instanceof Mot){
	    $q = $this->_db->prepare('SELECT mot,casse, dictionnaire FROM mot WHERE mot = \''.$mot->getMot().'\'AND dictionnaire = \'' .$mot->getDictionnaire() .'\';');
		$q->execute();
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees['mot'])
		{
			//exception "Le Mot ".$mot->getMot()." existe déja."; Mettre une exception
			$x =0; // instruction pour garder le "if"
		}
	  else{  
    	$this->_db->exec('INSERT INTO Mot (mot, casse, dictionnaire,frequence) VALUES (\''.$mot->getMot().'\', '.$mot->getCasse().', \''.$mot->getDictionnaire().'\', \''.$mot->getFrequence().'\');');
		$this->codage($mot);
	  }
	  }
  }
 
  public function delete($mot, $dictionnaire)
  {
  	$d = (String) $dictionnaire;
  	$m = (String) $mot;
  	$this->_db->exec('DELETE FROM CorrespondanceMot WHERE mot = \''.$m.'\';');
    $this->_db->exec('DELETE FROM Mot WHERE mot = \''.$m.'\' AND dictionnaire = \'' .$d .'\';');
  }
 
  public function get($mot)
  { 
  $mot = (String) $mot;
    $q = $this->_db->query('SELECT mot,casse, dictionnaire,frequence FROM Mot WHERE mot = \''.$mot.'\';');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Mot($donnees['mot'],$donnees['casse'],$donnees['dictionnaire'],$donnees['frequence']);
  }
  
  public function getNumberOfWords()
  { 
    $req = $this->_db->query('SELECT COUNT(*) AS nb FROM Mot ;');
    $donnees = $req->fetch(PDO::FETCH_ASSOC);
    return $donnees['nb'];
  }

   public function getAll($order)
  { 
  if ($order=='frequence')
    $q = $this->_db->prepare('select * from Mot order by '.$order.' desc;');
	else
	    $q = $this->_db->prepare('select * from Mot order by '.$order.' asc;');
	$q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }
  
   public function getAllByCasse($casse)
  { /**
  * Renvoie la liste des mots dont la casse est l'entier spécifié en paramètre.
  */

    $q = $this->_db->prepare('select * from Mot where casse='.$casse.';');
	
	$q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }
  public function getAllFromDictionnaire($dico){
  /**
  * Renvoie la liste des mots faisant partie du dictionnaire $dico.
  */
    $q = $this->_db->prepare('select * from Mot where dictionnaire='.$dico.';');
	$q->execute();
    $donnees = $q->fetchAll();
	
	//On retourne une liste d'instance de Mots
	$result = array();
	foreach($donnees as $mot){
		$m = new Mot($donnees['mot'],$donnees['casse'],$donnees['dictionnaire'],$donnees['frequence']);
		array_push($result, $m);
	}
    return $result;
  }
  
  
 
  public function update($oldMot, $newMot)
  {
  	if($oldMot instanceof Mot && $newMot instanceof Mot){
  	   $this->_db->exec('UPDATE CorrespondanceMot SET mot = \''.$newMot->getMot().'\' WHERE mot = \''.$oldMot->getMot().'\';');
	   $this->_db->exec('UPDATE Mot SET mot = \''.$newMot->getMot().'\', casse = \''.$newMot->getCasse().'\',dictionnaire = \''.$newMot->getDictionnaire().'\', casse = \''.$newMot->getCasse().'\', frequence = \''.$newMot->getFrequence().'\' WHERE mot = \''.$oldMot->getMot().'\' AND dictionnaire = \'' .$oldMot->getDictionnaire() .'\' AND frequence = \'' .$oldMot->getFrequence() .'\';');
  	}else
	   throw new Exception('Type reçu erroné.');
  }
 
	public function exist($motParam)
  { 
    $q = $this->_db->prepare('SELECT count(*) AS total FROM Mot WHERE mot = \''.$motParam->getMot().'\' AND casse = \''.$motParam->getCasse().'\';');
	$q->execute();
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return $donnees['total'];
  }
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
  
  public function codage(Mot $motParam, array $policesParam=NULL)
  {

  $con = $this->_db;
  $mot= $motParam->getMot();
  
  $lettreManager= new LettreManager($con);
  $correspLetMan = new CorrespondanceLettreManager($con);
  $policesManager= new PoliceManager($con);
  $policetab= array();
  $inc=0;
 
  if (!$this->exist($motParam)>0)  // si le mot n'existe pas dans la BDD, on l'ajoute à la table Mot
		{	$this->add($motParam);
			
		}
	
  if (is_null($policesParam))  // Si aucune police spécifiée, on code le mot dans toutes les polices existantes correspondantes à la casse du mot
  		{	$polices=$policesManager->getAllCasse((int)$motParam->getCasse());
			foreach($polices as $pol)
			{			$policetab[$inc]=$pol[0];
						$inc++;		
			}	
		}
	else	// On prend les polices passées en parametre et on vérifie que la police correspond à la casse du mot (sinon on ne code pas dans la police qui pose problème)
		{	$incc=0;
			$policesTotal=$policesManager->getAllCasse($motParam->getCasse());
			
			foreach($policesTotal as $policesTot)
				{ 
					$polices[$incc]=$policesTot[0];
					$incc++;
				}
			
			foreach ($policesParam as $pol)
			{if (in_array($pol,$polices))
				{	$policetab[$inc]=$pol;
					$inc++;}
				}
		}	
  
  // Codage du mot dans toutes les polices determinées
  foreach($policetab as $pol)
  {
	$listeResultat=array('');
	$suite=true;
	$correspMotMan = new CorrespondanceMotManager($con);
	
	// Si mot déjà codé dans la police alors stop
	if ($correspMotMan->existCorrespMot($mot,$pol) > 0)
		{	
			$suite = false;
		}
	
	if ($suite) // si mot n'a pas été codé dans la police
	{	

		for($i=0; $i<strlen($mot); $i++)   // On parcourt chaque lettre du mot initial
		{				
			if ($suite)
		{       	
			try {
				$vraieLettre= $lettreManager->get($mot[$i]);  // La lettre en cours doit correspondre à une lettre existante dans la table Lettre de la BDD
								
				$codesLettres= $correspLetMan->getCodes($vraieLettre, $pol);  // On récupere les codes auxquels correspond la lettre en cours
			
				$nbCodesLettre= count($codesLettres);
				$tailleResultatIni = count ($listeResultat);
				
				if($nbCodesLettre > 1)   // Si la lettre en cours de codage a au moins 2 codes, on duplique le tableau de résultats
				{
					for ($ii=0; $ii<($nbCodesLettre-1); $ii++)
						{
							for ($r=0; $r<$tailleResultatIni; $r++)
							{
								array_push($listeResultat, $listeResultat[$r]);
							}
						}
						
				}			
				$j=0;
				$k=0;
				$tailleResultatInter=count($listeResultat);
				
				for ($ii=0; $ii<($tailleResultatInter); $ii++)
						{ // Exception div/0
								
									
									if ($nbCodesLettre>0)
									{
										if ($j < $tailleResultatInter/$nbCodesLettre) 
											{
												$j++;    // j est un compteur permettant de parcourir chaque partie identique de la liste de resultats
											}
											/* exemple: On 3 codes qui correspondent à notre lettre. On aura donc auparavant recopié 2 fois la liste des resultats
											On obtient une listeResultat composées de 3 parties identiques. Sur chaque partie, on ajoute 1 code différent de la liste de code.
											*/
										
										else{
												$j=1;
												$k++;   // k est la variable qui permet d'identifier le code dans la liste codesLettres
											}
										
										
										$listeResultat[$ii].= ($codesLettres[$k]['code']);
										}
								 
								}
								
				} catch (Exception $e) 
								{
									$suite=false;
									echo 'Exception reçue : ',  $e->getMessage(), "\n"; 
								}
		}
		}
	} 
  // Ajout des résultats dans la table MotCode
  if ($suite==true)
  {
	  for ($i=0; $i<count($listeResultat); $i++)
	{

		  $motCode = new MotCode( $listeResultat[$i], $pol);
		  $motCodeManager = new MotCodeManager($con);
		  $motCodeManager->add($motCode);
		  
		  // Ajout de la correspondance Mot - MotCode pour chaque MotCode
		  //Si le mot codé contient des codes différents pour la même vraie lettre, alors la correspondance n'est pas gardée
		  $combinaisonValide = true;
		  for ($x=0; $x<strlen($mot); $x++){
			  if ($combinaisonValide == true) {
					$indices = array();//Ce tableau contient la liste des positions d'une lettre donnée dans un mot
					$lettre = $mot[$x];
					array_push($indices, $x);
					for ($j=$x; $j<strlen($mot); $j++ ){
						if ($mot[$j] == $lettre){
								array_push($indices, $j);
							}
					if (count($indices) > 1){
						for ($l=0; $l<count($indices); $l++){
							$mc = $motCode->getCode();
							if ($mc[$indices[0]] != $mc[$indices[$l]]){
								$combinaisonValide = false;
							}
						}
					}
				}
			}
		  }
		  if ($combinaisonValide == true) {
			  $correspMot = new CorrespondanceMot($mot, $motCode->getCode(), $pol);
			  $correspMotMan = new CorrespondanceMotManager($con);
			  $correspMotMan->add($correspMot);
	}	  
  }
 }
 }
 }
 
 
 public function motsCompatibles($motParam, $dicos, $procedes, $casse, $typeRecherche=0){ // prend en parametre un mot (type string), le type de la recherche (1mot/code..), et les dicos et procédés dans lesquels on recherche les mots compatibles
		//include '../dbconnect.php';
		$result = array(); 
		// tableau : [{"code": mot_code.code, "police": mot_code.police, "mots": [liste des vrais mots compatibles pour ce code et cette police]},{}...]
		
		//$motManager= new MotManager($con);
		$con = $this->_db;		
		if ($casse==1) // si le mot est en minuscule
				$motP = new Mot($motParam, $casse, "defaut_min", 1);
				else $motP = new Mot($motParam, $casse, "defaut_maj", 1);
		$this->codage($motP);
		
		if ($casse==0)
			$motParam=strtoupper($motParam);
			else $motParam=strtolower($motParam);
		
		$corrMotManager = new CorrespondanceMotManager($con);
		$motsCodes= $corrMotManager->getAllCodes($motParam); // retourne tous les Mots codes correspondants au mot donné
		
		
		
		foreach ($motsCodes as $motCode)
			{
			if (in_array($motCode[1], $procedes))  // si le motCode est obtenu par un procede dans la liste des parametres, on traite ce mot
			{
				$motsComp= $corrMotManager->getAllMotsExcept($motCode[0], $motCode[1], $casse); // Retourne tous les mots correspondants au motCode, à la police donnée, et à la casse du mot initial 
				if ($motsComp)
			{	$suite=0;
				
				switch ($typeRecherche){   // En fonction du type de la recherche (0=tous les mots --- 1=1mot/code --- 2=+de 1mot/code)
					case 0: $suite=1; // on prend tous les mots
					break;
					
					case 1:
						if (count($motsComp)==1)
							$suite=1;
						else $suite=0;
					break;
					
					case 2: 
						if (count($motsComp)>1)
							$suite=1;
						else $suite=0;
					break;
					
					default: $suite=0;
				}
				if	($suite==1){
						foreach ($motsComp as $comp)	
						{	
							if (in_array($comp['dico'], $dicos))
							{
							$ligne = array ("initial" => $motParam, "code" => $motCode[0], "police" => $motCode[1], "compatible" => $comp['mo'],"dictionnaire" => $comp['dico'],"frequence" => $comp['freq']);
							array_push($result, $ligne);}
						}
					}
			}}
			}
		return $result;
 }
}

?>