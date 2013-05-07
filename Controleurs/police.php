<?php
include '../dbconnect.php';
include '../Modele/Managers/PoliceManager.php';

$policeManager = new PoliceManager($con);

// Gestion des ajouts
if(isset($_POST['police'])){
	$policeManager->add(new Police($_POST['police'],$_POST['fichierCodes'],$_POST['casse']));
}

//Gestion des supression
if(isset($_GET['delete'])){
	$policeManager->delete($_GET['delete']);
}

//Gestion de l'edition
if(isset($_POST['oldPolice']) and isset($_POST['newPolice'])){
	$policeManager->update(new Police($_POST['oldPolice'],$_POST['oldFichierCodes'],$_POST['oldCasse']),new Police($_POST['newPolice'],$_POST['newFichierCodes'],$_POST['newCasse']));
}

//Récupération du contenu de la BDD
$police = $policeManager->getAll();

//On inclue la vue
include '../Vue/police.php'; 
?>












