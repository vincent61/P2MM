<?php
include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include_once '../Modele/Managers/DictionnaireManager.php';

//$mot = new Mot('baba', 0, 'min_bas', 0);
$motManager=new MotManager($con);
$dicoManager= new DictionnaireManager($con);
$dicos= $dicoManager->getAll('dictionnaire'); // r�cup�ration de tous les noms des dictionnaires pr�sents en base

if(isset($_POST['mot'])){
	$motsComp = $motManager->motsCompatibles($_POST['mot']);
	}

include '../Vue/recherche.php'; 
?>