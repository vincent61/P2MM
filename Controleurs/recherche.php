<?php
include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include_once '../Modele/Managers/DictionnaireManager.php';

//$mot = new Mot('baba', 0, 'min_bas', 0);
$flag=0;
$motManager=new MotManager($con);
$dicoManager= new DictionnaireManager($con);
$dicos= $dicoManager->getAll('dictionnaire'); // récupération de tous les noms des dictionnaires présents en base
$listeDico= array(); // liste contenant les dictionnaires passés en paramètres par l'utilisateur (cochés dans la checkbox)
$motsComp= array();

foreach ($dicos as $dico)
{	$nomDico=$dico['dictionnaire'];
	if (isset($_POST[$nomDico]))
		array_push($listeDico, $nomDico);
	}
	

if(isset($_POST['mot'])){
	if (isset($_POST['type_recherche'])){
	$motsComp = $motManager->motsCompatibles($_POST['mot'], $_POST['type_recherche'], $listeDico);
	$flag=1;
	}}

//include '../Vue/recherche.php'; 
?>