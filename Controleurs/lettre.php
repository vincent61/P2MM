<?php
include 'modele/Managers/LettreManager.php';

$lettreManager = new LettreManager($con);

// Gestion des ajouts
if(isset($_POST['lettre'])){
	$lettreManager->add(new Lettre($_POST['lettre']));
}
//Gestion des supression
if(isset($_GET['delete'])){
	$lettreManager->delete(new Lettre($_GET['delete']));
}
//Gestion de l'edition
if(isset($_POST['oldLettre']) and isset($_POST['newLettre'])){
	//$lettreManager->delete(new Lettre($_GET['delete']));
	$lettreManager->update(new Lettre($_POST['oldLettre']),new Lettre($_POST['newLettre']));
}

//Récupération du contenu de la BDD
$lettres = $lettreManager->getAll();

//On inclue la vue
include 'vue/lettre.php'; 
?>