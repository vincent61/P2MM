<?php
include '../dbconnect.php';
include '../Modele/Managers/CodeLettreManager.php';

$codeLettreManager = new CodeLettreManager($con);

// Gestion des ajouts
if(isset($_POST['code']) && isset($_POST['typelettre']) && isset($_POST['listepolice'])){
	$codeLettreManager->add(new CodeLettre($_POST['code'],$_POST['typelettre'],$_POST['listepolice']));
}

//Gestion des supression
if(isset($_GET['delete'])){
	$codeLettreManager->delete($_GET['delete']);
}

//Gestion de l'edition
if(isset($_POST['oldCode']) and isset($_POST['newCode'])){
	$codeLettreManager->update(new CodeLettre($_POST['oldCode'],$_POST['oldTypeLettre'],$_POST['oldPolice']),new CodeLettre($_POST['newCode'],$_POST['newTypeLettre'],$_POST['newPolice']));
}

//Récupération du contenu de la BDD
$codelettre = $codeLettreManager->getAll();
$codelettreListePolice = $codeLettreManager->getListePolice();

//On inclue la vue
include '../Vue/codelettre.php'; 
?>












