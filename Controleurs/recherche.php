<?php

include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include_once '../Modele/Managers/DictionnaireManager.php';
include_once '../cheminsPerso.php';

//$mot = new Mot('baba', 0, 'min_bas', 0);
$flag=0;
$motManager=new MotManager($con);
$dicoManager= new DictionnaireManager($con);
$dicos= $dicoManager->getAll('dictionnaire'); // r�cup�ration de tous les noms des dictionnaires pr�sents en base
$policeManager= new PoliceManager($con);
$procedes = $policeManager->getAll();

$listeDico= array(); // liste contenant les dictionnaires pass�s en param�tres par l'utilisateur (coch�s dans la checkbox)
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
	
if(isset($_POST['mot']) && isset($_POST['type_recherche'])){
	
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
			
				//�criture dans le fichier csv: on note uniquement les valeurs du tableau cl�=>valeur
		$cheminFichierBase = '/Fichiers/Recherches/recherche_'.microtime();
		$cheminFichier = $cheminFichierBase.'.csv';
		$cheminFichierPhp = $cheminFichierBase.'.php';
		
	$phpCode= "<?php
header('Content-disposition: attachment; filename=".$cheminFichier."');
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
			}
			fclose($fichierResultats);
		}
		
		// Obtient une liste de colonnes pour pr�parer le tri
foreach ($motsComp as $key => $row) {
	$motInit[$key]  = $row['initial'];
	$pol[$key] = $row['police'];
	$dico[$key]  = $row['dictionnaire'];
	$comp[$key] = $row['compatible'];
	$freq[$key] = $row['frequence'];
}	

if(isset($_GET['order']))
{
	switch ($_GET['order']) {
	    case "motInit":
	        array_multisort($motInit, SORT_ASC,$freq, SORT_DESC, $motsComp);
	        break;
	    case "police":
	        array_multisort($pol, SORT_ASC,$freq, SORT_DESC, $motsComp);
	        break;
	    case "dictionnaire":
	        array_multisort($dico, SORT_ASC,$freq, SORT_DESC, $motsComp);
	        break;
	    case "motCorr":
	        array_multisort($comp, SORT_ASC,$freq, SORT_DESC, $motsComp);
	        break;
	    default:
        	array_multisort($freq, SORT_DESC, $motsComp);
	}
}else
{
	//array_multisort($freq, SORT_DESC, $motsComp);
	array_multisort($comp, SORT_ASC,$freq, SORT_DESC, $motsComp);
}
	}



include '../Vue/recherche.php'; 
?>