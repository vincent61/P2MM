<?php

include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include '../Modele/Managers/DictionnaireManager.php';

$motManager = new MotManager($con);
$dictionnaireManager = new DictionnaireManager($con);

// Gestion des ajouts


if(isset($_POST['mot']) && isset($_POST['casse']) && isset($_POST['dictionnaireListe'])){
	$motManager->add(new Mot($_POST['mot'],$_POST['casse'],$_POST['dictionnaireListe'],$_POST['frequence']));
}

//Gestion des supression
if(isset($_GET['deleteMot']) && isset($_GET['deleteDictionnaire'])){
	$motManager->delete($_GET['deleteMot'],$_GET['deleteDictionnaire']);
}

//Gestion de l'edition
if(isset($_POST['oldMot']) and isset($_POST['newMot'])){
	$motManager->update(new Mot($_POST['oldMot'],$_POST['oldCasse'],$_POST['oldDictionnaire'],$_POST['oldFrequence']),new Mot($_POST['newMot'],$_POST['oldCasse'],$_POST['newDictionnaire'],$_POST['newFrequence']));
}

//Récupération du contenu de la BDD
if(isset($_GET['order']))
{
	$mots = $motManager->getAll($_GET['order']);
}
else
{
	$mots = $motManager->getAll('frequence');
}
$dictionnaires = $dictionnaireManager->getAll('dictionnaire');

//On inclue la vue
include '../Vue/mot.php'; 
?>












