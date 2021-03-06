<?php

include_once 'modele/Managers/MotManager.php';
include_once 'modele/Managers/DictionnaireManager.php';
include_once 'cheminsPerso.php';

$flag=0;
$motManager=new MotManager($con);
$dicoManager= new DictionnaireManager($con);
$dicos= $dicoManager->getAll(); // r�cup�ration de tous les noms des dictionnaires pr�sents en base
$policeManager= new PoliceManager($con);
$procedes = $policeManager->getAll();

$listeDico= array(); // liste contenant les dictionnaires pass�s en param�tres par l'utilisateur (coch�s dans la checkbox)
$listeProcede= array();

$motsTab = array();  // tableau dans lequel on stocke les mots contenus dans le fichier
$test=1;

foreach ($dicos as $dico)
{	$nomDico=$dico['dictionnaire'];
	if (isset($_POST[$nomDico]))
		array_push($listeDico, $nomDico);
}

foreach ($procedes as $procede)
{	$nomProcede=$procede['police'];
	if (isset($_POST[$nomProcede]))
		array_push($listeProcede, $nomProcede);
}
	
if (isset($_POST['results'])) {
	$resultsSerialized = $_POST['results'];
}

if (isset($_POST['nameOfCsvFile'])) {
	$csvFileName = $_POST['nameOfCsvFile'];
}

if(isset($_POST['sortField']))
{
	$motsComp = unserialize(urldecode($resultsSerialized));

	// Obtient une liste de colonnes pour pr�parer le tri
	foreach ($motsComp as $key => $row) {
		$motInit[$key]  = $row['initial'];
		$comp[$key] = $row['compatible'];
		$freq[$key] = $row['frequence'];
	}	
	
	switch ($_POST['sortField']) {
	    case "frequence":
	        array_multisort($motInit, SORT_ASC,$freq, SORT_DESC, $motsComp);
	        break;
	    case "motCorr":
	        array_multisort($motInit, SORT_ASC,$comp, SORT_ASC, $motsComp);
	        break;
	    default:
        	array_multisort($motInit, SORT_ASC,$freq, SORT_DESC, $motsComp);
	}
	
	$resultsSerialized = urlencode(serialize($motsComp));
}

if(isset($_FILES['fichier'])){
	if ($_FILES['fichier']['error']) {     
			  switch ($_FILES['fichier']['error']){     
					   case 1: // UPLOAD_ERR_INI_SIZE     
					   echo"Le fichier d�passe la limite autoris�e par le serveur (fichier php.ini) !";     
					   break;     
					   case 2: // UPLOAD_ERR_FORM_SIZE     
					   echo "Le fichier d�passe la limite autoris�e dans le formulaire HTML !"; 
					   break;     
					   case 3: // UPLOAD_ERR_PARTIAL     
					   echo "L'envoi du fichier a �t� interrompu pendant le transfert !";     
					   break;     
					   case 4: // UPLOAD_ERR_NO_FILE     
					   echo ""; 
					   break;     
		}     
	}
	else {     
	 // $_FILES['nom_du_fichier']['error'] vaut 0 soit UPLOAD_ERR_OK     
	 // ce qui signifie qu'il n'y a eu aucune erreur  
		if ((isset($_FILES['fichier']['tmp_name'])&&($_FILES['fichier']['error'] == UPLOAD_ERR_OK))) {   
			if(substr($_FILES['fichier']['name'], -3, 3)=='txt'){  
				$chemin_destination = $cheminServer.'Fichiers/Recherches/'; 
				//Pour assurer un nom de fichier unique, on le renomme avec le nom (unique) du dictionnaire
				move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin_destination.$_FILES['fichier']['name']);     
				// Gestion des ajouts
				
				$data = file_get_contents($chemin_destination.$_FILES['fichier']['name']); // extraction des donn�es TXT dans la variable $data
				$tab=explode("\n", $data);
				//echo count($tab);
				$motsTab = array();
				
				for($i=0; $i<(count($tab)-1); $i++)
				{	array_push($motsTab, substr($tab[$i],0,-1));	
								
				}
			//if ($tab[count($tab)] != NULL)
			array_push($motsTab, $tab[count($tab)-1]);	
			} 
			else
			 {
				echo 'Le fichier choisi n\'est pas un TXT';
			 }
		 }
	} 
	
}

if(isset($_POST['mot']) ||  isset($_FILES['fichier'])) {
		if (isset($_POST['type_recherche'])){
		$motsComp= array();
		$resultsSerialized = NULL;
        if (isset($_POST['type_recherche'])){ 
				if (isset($_POST['casse'])){
				
					if ((isset($_POST['mot']))&&($_POST['mot']!=NULL)){
					$mots = explode(" ", $_POST['mot']);
					if ($_POST['casse']!=2){  // Si le choix de la casse est UNIQUEMENT majuscule OU minuscule
					foreach($mots as $mot){
						$motsCompUni= array();
						
						$motsCompUni = $motManager->motsCompatibles($mot, $listeDico, $listeProcede, $_POST['casse'], $_POST['type_recherche']);
						//print_r (array_values($listeDico));
	
						$motsComp = array_merge($motsComp, $motsCompUni);
						$flag=1;
					}}
					else {   // On veut les r�sultats de mots compatibles en majuscule ET minuscule
						foreach($mots as $mot){
						$motsCompUni= array();
						$motsCompUni = $motManager->motsCompatibles($mot, $listeDico, $listeProcede, 0, $_POST['type_recherche']);
						$motsComp = array_merge($motsComp, $motsCompUni);
						$flag=1;
					}
						
						foreach($mots as $mot){
						$motsCompUni= array();
						$motsCompUni = $motManager->motsCompatibles($mot, $listeDico, $listeProcede, 1, $_POST['type_recherche']);
						$motsComp = array_merge($motsComp, $motsCompUni);
						$flag=1;
					}
					
						}
					
					}}
					
					if (isset($_FILES['fichier'])) {
					if ($_POST['casse']!=2){
					foreach($motsTab as $motT){
						if (($motT!=NULL)&&($test==1)){
						$motsCompUni= array();
						$motsCompUni = $motManager->motsCompatibles($motT, $listeDico, $listeProcede, $_POST['casse'], $_POST['type_recherche']);
						$motsComp = array_merge($motsComp, $motsCompUni);
						$flag=1;} else $test=0; //stop la boucle
					}
					} else
						{
						foreach($motsTab as $motT){
						if (($motT!=NULL)&&($test==1)){
						$motsCompUni= array();
						$motsCompUni = $motManager->motsCompatibles($motT, $listeDico, $listeProcede, 0, $_POST['type_recherche']);
						$motsComp = array_merge($motsComp, $motsCompUni);
						$flag=1;} else $test=0; //stop la boucle
					}
					$test=1;
					foreach($motsTab as $motT){
						if (($motT!=NULL)&&($test==1)){
						$motsCompUni= array();
						$motsCompUni = $motManager->motsCompatibles($motT, $listeDico, $listeProcede, 1, $_POST['type_recherche']);
						$motsComp = array_merge($motsComp, $motsCompUni);
						$flag=1;} else $test=0; //stop la boucle
					}
					}
					
					
				}
				
		}		

		// Obtient une liste de colonnes pour pr�parer le tri
		foreach ($motsComp as $key => $row) {
			$motInit[$key]  = $row['initial'];
			$comp[$key] = $row['compatible'];
			$freq[$key] = $row['frequence'];
		}	
		array_multisort($motInit, SORT_ASC,$freq, SORT_DESC, $motsComp);
		$resultsSerialized = urlencode(serialize($motsComp));
		
		
		//�criture dans le fichier csv: on note uniquement les valeurs du tableau cl�=>valeur
		$cheminFichierBase = 'Fichiers/Recherches/recherche_'.microtime();
		$cheminFichier = $cheminFichierBase.'.csv';
		$cheminFichierPhp = $cheminFichierBase.'.php';
		
		$csvFileName = $cheminFichierBase.'.php';
		
		$phpCode= "<?php
		header('Content-disposition: attachment; filename=\'recherche_p2mm.csv\'');
		header('Content-type: application/pdf');
		readfile('".$cheminServer.$cheminFichier."');
		?>"; //changer avec chemins relatifs?
		
		$handle = fopen($cheminServer.$cheminFichierPhp, 'w');
		fwrite($handle, $phpCode);
		fclose($handle);
		$fichierResultats = fopen($cheminServer.$cheminFichier, 'w');		
		foreach ($motsComp as $results) {
			fputcsv($fichierResultats, array_values($results), ';');
		}
		fclose($fichierResultats);	
			
	}
}

include 'vue/recherche.php'; 
?>