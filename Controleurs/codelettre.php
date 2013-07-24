<?php
include '../dbconnect.php';
include '../modele/Managers/CodeLettreManager.php';
include '../modele/Managers/PoliceManager.php';

$codeLettreManager = new CodeLettreManager($con);
$policeManager = new PoliceManager($con);

// Gestion des ajouts


if(isset($_POST['code']) && isset($_POST['typelettre']) && isset($_POST['policeListe'])){
	$codeLettreManager->add(new CodeLettre($_POST['code'],$_POST['typelettre'],$_POST['policeListe']));
}

//Gestion des supression
if(isset($_GET['deleteCode']) && isset($_GET['deletePolice'])){
	$codeLettreManager->delete($_GET['deleteCode'],$_GET['deletePolice']);
}

//Gestion de l'edition
if(isset($_POST['oldCode']) and isset($_POST['newCode'])){
	$codeLettreManager->update(new CodeLettre($_POST['oldCode'],$_POST['oldTypeLettre'],$_POST['oldPolice']),new CodeLettre($_POST['newCode'],$_POST['newTypeLettre'],$_POST['newPolice']));
}

//Récupération du contenu de la BDD
$codelettre = $codeLettreManager->getAll();
$polices = $policeManager->getAll();

//On inclue la vue
include '../vue/codelettre.php'; 
?>












