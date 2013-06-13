<?php

include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include_once '../Modele/Managers/DictionnaireManager.php';
include_once '../cheminsPerso.php';

//$mot = new Mot('baba', 0, 'min_bas', 0);
$flag=0;
$motManager=new MotManager($con);
$dicoManager= new DictionnaireManager($con);
$dicos= $dicoManager->getAll(); // récupération de tous les noms des dictionnaires présents en base
$policeManager= new PoliceManager($con);
$procedes = $policeManager->getAll();

$listeDico= array(); // liste contenant les dictionnaires passés en paramètres par l'utilisateur (cochés dans la checkbox)
$listeProcede= array();


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

	// Obtient une liste de colonnes pour préparer le tri
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

	
if(isset($_POST['mot']) && isset($_POST['type_recherche'])){
		$motsComp= array();
		$resultsSerialized = NULL;
        if (isset($_POST['type_recherche'])){ 
				if (isset($_POST['casse'])){
					$mots = explode(" ", $_POST['mot']);
					foreach($mots as $mot){
						$motsCompUni= array();
						$motsCompUni = $motManager->motsCompatibles($mot, $listeDico, $listeProcede, $_POST['casse'], $_POST['type_recherche']);
						//print_r (array_values($listeDico));
	
						$motsComp = array_merge($motsComp, $motsCompUni);
						$flag=1;
					}
				}
				
		}		

		// Obtient une liste de colonnes pour préparer le tri
		foreach ($motsComp as $key => $row) {
			$motInit[$key]  = $row['initial'];
			$comp[$key] = $row['compatible'];
			$freq[$key] = $row['frequence'];
		}	
		array_multisort($motInit, SORT_ASC,$freq, SORT_DESC, $motsComp);
		$resultsSerialized = urlencode(serialize($motsComp));
		
		
		//écriture dans le fichier csv: on note uniquement les valeurs du tableau clé=>valeur
		$cheminFichierBase = '/Fichiers/Recherches/recherche_'.microtime();
		$cheminFichier = $cheminFichierBase.'.csv';
		$cheminFichierPhp = $cheminFichierBase.'.php';
		
		$csvFileName = $cheminFichierBase.'.php';
		
		$phpCode= "<?php
		header('Content-disposition: attachment; filename=\'recherche_p2mm.csv\'');
		header('Content-type: application/pdf');
		readfile('".$cheminServer.'P2MM'.$cheminFichier."');
		?>"; //changer avec chemins relatifs?
		
		$handle = fopen($cheminServer.'P2MM'.$cheminFichierPhp, 'w');
		fwrite($handle, $phpCode);
		fclose($handle);
		$fichierResultats = fopen($cheminServer.'P2MM'.$cheminFichier, 'w');		
		foreach ($motsComp as $results) {
			fputcsv($fichierResultats, array_values($results), ';');
		}
		fclose($fichierResultats);	
			
		

}

include '../Vue/recherche.php'; 
?>