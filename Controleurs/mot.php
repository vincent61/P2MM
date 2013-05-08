<?php

include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include '../Modele/Managers/DictionnaireManager.php';

$motManager = new MotManager($con);
$dictionnaireManager = new DictionnaireManager($con);

// Gestion des ajouts


if(isset($_POST['mot']) && isset($_POST['casse']) && isset($_POST['dictionnaireListe'])){
	$motManager->add(new Mot($_POST['mot'],$_POST['casse'],$_POST['dictionnaireListe']));
}

//Gestion des supression
if(isset($_GET['deleteMot']) && isset($_GET['deleteDictionnaire'])){
	$motManager->delete($_GET['deleteMot'],$_GET['deleteDictionnaire']);
}

//Gestion de l'edition
if(isset($_POST['oldMot']) and isset($_POST['newMot'])){
	$motManager->update(new Mot($_POST['oldMot'],$_POST['oldCasse'],$_POST['oldDictionnaire']),new Mot($_POST['newMot'],$_POST['newCasse'],$_POST['newDictionnaire']));
}

//Récupération du contenu de la BDD
$mots = $motManager->getAll();
$dictionnaires = $dictionnaireManager->getAll();

//On inclue la vue
include '../Vue/mot.php'; 
?>












