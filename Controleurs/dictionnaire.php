<?php
include '../dbconnect.php';
include '../Modele/Managers/DictionnaireManager.php';
include '../Modele/Managers/LangueManager.php';


$dictionnaireManager = new DictionnaireManager($con);
$langueManager = new LangueManager($con);

// Gestion des ajouts
if(isset($_POST['dictionnaire'])){
	$dictionnaireManager->add(new Dictionnaire($_POST['dictionnaire'],$_POST['langue'],$_POST['fichierDictionnaire'],$_POST['casse']));
}

//Gestion des supression
if(isset($_GET['delete'])){
	$dictionnaireManager->delete($_GET['delete']);
}

//Gestion de l'edition
if(isset($_POST['oldDictionnaire']) and isset($_POST['newDictionnaire'])){
	$dictionnaireManager->update(new Dictionnaire($_POST['oldDictionnaire'],$_POST['oldLangue'],$_POST['oldFichierDictionnaire'],$_POST['oldCasse']),new Dictionnaire($_POST['newDictionnaire'],$_POST['newLangue'],$_POST['newFichierDictionnaire'],$_POST['newCasse']));
}

//Récupération du contenu de la BDD
$dictionnaire = $dictionnaireManager->getAll();
$langues = $langueManager->getAll();
//On inclue la vue
include '../Vue/dictionnaire.php'; 
?>