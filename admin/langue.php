<?php


if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) { 

include 'modele/Managers/LangueManager.php';

$langueManager = new LangueManager($con);

// Gestion des ajouts
if(isset($_POST['langue'])){
	$langueManager->add(new Langue($_POST['langue']));
}
//Gestion des supression
if(isset($_GET['delete'])){
	$langueManager->delete(new Langue($_GET['delete']));
}
//Gestion de l'edition
if(isset($_POST['oldLangue']) and isset($_POST['newLangue'])){
	$langueManager->update(new Langue($_POST['oldLangue']),new Langue($_POST['newLangue']));
}

//Récupération du contenu de la BDD
$langues = $langueManager->getAll();

//On inclue la vue
include 'vue/langue.php'; 
}
else include "accesinterdit.php";
?>