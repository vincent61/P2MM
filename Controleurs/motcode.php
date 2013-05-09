﻿<?php

include '../dbconnect.php';
include '../Modele/Managers/MotCodeManager.php';
include '../Modele/Managers/PoliceManager.php';

$motCodeManager = new MotCodeManager($con);
$policeManager = new PoliceManager($con);

// Gestion des ajouts


if(isset($_POST['code']) && isset($_POST['policeListe'])){
	$motCodeManager->add(new MotCode($_POST['code'],$_POST['policeListe']));
}

//Gestion des supression
if(isset($_GET['deleteCode']) && isset($_GET['deletePolice'])){
	$motCodeManager->delete(new MotCode($_GET['deleteCode'],$_GET['deletePolice']));
}

//Gestion de l'edition
if(isset($_POST['oldCode']) and isset($_POST['newCode'])){
	$motCodeManager->update(new MotCode($_POST['oldCode'],$_POST['oldPolice']),new MotCode($_POST['newCode'],$_POST['newPolice']));
}

//Récupération du contenu de la BDD
$motCodes = $motCodeManager->getAll();
$polices = $policeManager->getAll();

//On inclue la vue
include '../Vue/motcode.php'; 
?>











