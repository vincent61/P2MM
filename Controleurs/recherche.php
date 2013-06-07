<?php

include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include_once '../Modele/Managers/DictionnaireManager.php';
include_once '../cheminsPerso.php';

//$mot = new Mot('baba', 0, 'min_bas', 0);
$flag=0;
$motManager=new MotManager($con);
$dicoManager= new DictionnaireManager($con);
$dicos= $dicoManager->getAll('dictionnaire'); // récupération de tous les noms des dictionnaires présents en base
$policeManager= new PoliceManager($con);
$procedes = $policeManager->getAll();

$listeDico= array(); // liste contenant les dictionnaires passés en paramètres par l'utilisateur (cochés dans la checkbox)
$listeProcede= array();
$motsComp= array();

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
	
if(isset($_POST['mot'])){
	
        if (isset($_POST['type_recherche'])){ 
			if (isset($_POST['casse'])){
				$mots = explode(" ", $_POST['mot']);
				foreach($mots as $mot){
					$motsCompUni= array();
					$motsCompUni = $motManager->motsCompatibles($mot, $listeDico, $listeProcede, $_POST['casse'], $_POST['type_recherche']);
					//$motsComp=$motsComp+$motsCompUni;
					$motsComp = array_merge($motsComp, $motsCompUni);
					$flag=1;
				}
			
				//écriture dans le fichier csv: on note uniquement les valeurs du tableau clé=>valeur
		$cheminFichier = '/Fichiers/Recherches/recherche_'.microtime().'.csv';

		$fichierResultats = fopen($cheminServer.'P2MM'.$cheminFichier, 'w');		
		foreach ($motsComp as $results) {
			fputcsv($fichierResultats, array_values($results), ';');
}
			}
			fclose($fichierResultats);
		}
	}

include '../Vue/recherche.php'; 
?>