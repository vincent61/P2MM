<?php

include '../Modele/ModeleMemoire/Mot.php';
//include '../Modele/Managers/LettreManager.php';
//include '../Modele/Managers/MotCodeManager.php';
//include '../Modele/Managers/CorrespondanceLettreManager.php';
//include '../Modele/Managers/CorrespondanceMotManager.php';

class MotManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);

  }
 
  public function add($mot)
  {
	  if($mot instanceof Mot){
	    $q = $this->_db->query('SELECT mot,casse, dictionnaire FROM mot WHERE mot = \''.$mot->getMot().'\'AND dictionnaire = \'' .$mot->getDictionnaire() .'\';');
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees['mot'])
		{
			echo "Le Mot existe déja.";
		}
	  else{  
    	$this->_db->exec('INSERT INTO Mot (mot, casse, dictionnaire) VALUES (\''.$mot->getMot().'\', '.$mot->getCasse().', \''.$mot->getDictionnaire().'\');');
	  }
	  }
  }
 
  public function delete($mot, $dictionnaire)
  {
  	$d = (String) $dictionnaire;
  	$m = (String) $mot;
    $this->_db->exec('DELETE FROM Mot WHERE mot = \''.$m.'\' AND dictionnaire = \'' .$d .'\';');
  }
 
  public function get($mot)
  { 
  $mot = (String) $mot;
    $q = $this->_db->query('SELECT mot,casse, dictionnaire FROM Mot WHERE mot = \''.$mot.'\';');
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Mot($donnees['mot'],$donnees['casse'],$donnees['dictionnaire']);
  }

   public function getAll()
  { 
    $q = $this->_db->query('SELECT mot, casse, dictionnaire FROM mot ;');
    $donnees = $q->fetchAll();
    return $donnees;
  }
 
  public function update($oldMot, $newMot)
  {
  	if($oldMot instanceof Mot && $newMot instanceof Mot){
	   $this->_db->exec('UPDATE Mot SET mot = \''.$newMot->getMot().'\', casse = \''.$newMot->getCasse().'\',dictionnaire = \''.$newMot->getDictionnaire().'\', casse = '.$newMot->getCasse().' WHERE mot = \''.$oldMot->getMot().'\' AND dictionnaire = \'' .$oldMot->getDictionnaire() .'\';');
  	}else
	   throw new Exception('Type reçu erroné.');
  }
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
  
  public function codage(Mot $motParam, $policesParam)
  {
  include '../dbconnect.php';
  $mot= $motParam->getMot();
  
  $lettreManager= new LettreManager($con);
  $correspLetMan = new CorrespondanceLettreManager($con);
  $polices=$policesParam;
  
  //if (is_null($polices))  
  		//$polices= array
		
  /* Code en Python pour les polices  (a adapter en php)
  if args:
			#si des polices sont spécifiées
			for p in args:
				try:
					polices.append(Police.objects.get(police=p, casse=self.casse))
					#on s'assure que la police correspond à la casse du mot
				except Police.DoesNotExist, e:
					print e
		else:
			#si aucun argument, on récupère toutes les polices de la même casse que le mot
			polices= Police.objects.filter(casse=self.casse)
		*/
	
  
  $suite=true;
  $listeResultat=array('');
  for($i=0; $i<strlen($mot); $i++)   // On parcourt chaque lettre du mot initial
	{	
		
	
		//echo $mot[$i];
		if ($suite){       // Interet de suite???
		try                
		{	
			$vraieLettre= $lettreManager->get($mot[$i]);  // La lettre en cours doit correspondre à une lettre existante dans la table Lettre de la BDD
			$codesLettres= $correspLetMan->getCodes($vraieLettre,'demi_bas');  // On récupere les codes auxquels correspond la lettre en cours
			/*foreach($codeslettres as $codelettre)
				{	
					echo ($codeslettre);
				}*/
				
			$nbCodesLettre= count($codesLettres);
			//echo $nbCodeLettre;
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
					/*foreach($listeResultat as $resultat){
						 echo $resultat;   // Verif des resultats contenus ds la liste des resultats
					}*/
			}			
			$j=0;
			$k=0;
			$tailleResultatInter=count($listeResultat);
			/*echo "taille";
			echo $tailleResultatInter;*/
			
			for ($ii=0; $ii<($tailleResultatInter); $ii++)
					{ // Exception div/0
						try {	
								if ($nbCodesLettre==0)
									{
										throw new Exception('Division par zéro.');
									}
								else
									if ($j < $tailleResultatInter/$nbCodesLettre) 
										{
											$j++;    // j est un compteur permettant de parcourir chaque partie identique de la liste de resultats
										}
										/* exemple: On 3 codes qui correspondent à notre lettre. On aura donc auparavant recopié 2 fois la liste des resultats
										On obtient une listeResultat composées de 3 parties identiques. Sur chaque partie, on ajoute 1 code différent de la liste de code.
										*/
									
									else {
											$j=1;
											$k++;   // k est la variable qui permet d'identifier le code dans la liste codesLettres
										}
									
									//print_r (array_values($codesLettres));
									// echo ($codesLettres[$k]['code']);
									$listeResultat[$ii].= ($codesLettres[$k]['code']);
									//echo $listeResultat[$ii]; 
									//echo "<br>";
							 
							} catch (Exception $e) {
								$suite=false;
								echo 'Exception reçue : ',  $e->getMessage(), "\n"; }
							
					}
			
		}
		catch (Exception $e)
		{	
			$suite=false;
			throw new Exception('Lettre n\'existe pas!', 0, $e);
		}
			}
		
  }
  // Ajout des résultats dans la table MotCode
  if ($suite==true)
  {
	  for ($i=0; $i<count($listeResultat); $i++)
	{
		  echo $listeResultat[$i];
		  echo "<br>";
		  $motCode = new MotCode( $listeResultat[$i], "demi_bas");
		  $motCodeManager = new MotCodeManager($con);
		  $motCodeManager->add($motCode);
		  
		  // Ajout de la correspondance Mot - MotCode pour chaque MotCode
		  $correspMot = new CorrespondanceMot($mot, $motCode->getCode(), "demi_bas");
		  $correspMotMan = new CorrespondanceMotManager($con);
		  $correspMotMan->add($correspMot);
	}	  
	}
  else echo "Aucun mot inséré car division par zéro";
 }
}

?>
