<?php

include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include_once '../Modele/Managers/DictionnaireManager.php';

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
	$mots = explode(" ", $_POST['mot']);
		foreach($mots as $mot){
		$motsCompUni= array();
        if (isset($_POST['type_recherche'])){
			if (isset($_POST['casse'])){
			$motsCompUni = $motManager->motsCompatibles($mot, $listeDico, $listeProcede, $_POST['casse'], $_POST['type_recherche']);
			//$motsComp=$motsComp+$motsCompUni;
			$motsComp = array_merge($motsComp, $motsCompUni);
			$flag=1;
			}
			}
		}
	}

include '../Vue/recherche.php'; 
?>