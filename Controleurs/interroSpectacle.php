<?php

include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include_once '../Modele/Managers/DictionnaireManager.php';

//Gestion du requêtage de mots

if(isset($_POST['fmot']) && isset($_POST['fcasse']) && isset($_POST['ftype_recherche'])){
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
	array_push($listeDico, $nomDico);
}

foreach ($procedes as $procede)
{	$nomProcede=$procede['police'];
	array_push($listeProcede, $nomProcede);
}
$motsComp= array();
        if (isset($_POST['ftype_recherche'])){
			if (isset($_POST['fcasse'])){
		
			$motsComp = $motManager->motsCompatibles(substr($_POST['fmot'], 0, -1), $listeDico, $listeProcede, $_POST['fcasse'], $_POST['ftype_recherche']);
			$flag=1;
			}
			}
		}
		$tab=array();
		foreach($motsComp as $motComp){ 
		array_push($tab, $motComp);
			//$tata =  $motComp['initial'] ; 
   }
    $alea= rand(2, count($tab)-1);
	echo($tab[$alea]['compatible']);


?>