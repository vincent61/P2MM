﻿<?php


if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) { 

ini_set("auto_detect_line_endings", true);
include_once 'modele/Managers/DictionnaireManager.php';
include_once 'modele/Managers/LangueManager.php';
$dictionnaireManager = new DictionnaireManager($con);
$langueManager = new LangueManager($con);

// Upload du dictionnaire et ajout dans la BDD
if(isset($_POST['dictionnaire']) && $_POST['dictionnaire'] != '' && isset($_POST['langue']) && $_POST['langue']!= '' && isset($_FILES['fichierDictionnaire']['name'])&& $_FILES['fichierDictionnaire']['name']!= '' && isset($_POST['casse']) && $_POST['casse']!=''){  
	if ($_FILES['fichierDictionnaire']['error']) {     
			  switch ($_FILES['fichierDictionnaire']['error']){     
					   case 1: // UPLOAD_ERR_INI_SIZE     
					   echo"Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";     
					   break;     
					   case 2: // UPLOAD_ERR_FORM_SIZE     
					   echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !"; 
					   break;     
					   case 3: // UPLOAD_ERR_PARTIAL     
					   echo "L'envoi du fichier a été interrompu pendant le transfert !";     
					   break;     
					   case 4: // UPLOAD_ERR_NO_FILE     
					   echo "Le fichier que vous avez envoyé a une taille nulle !"; 
					   break;     
		}     
	}
	else {     
	 // $_FILES['nom_du_fichier']['error'] vaut 0 soit UPLOAD_ERR_OK     
	 // ce qui signifie qu'il n'y a eu aucune erreur  
		if ((isset($_FILES['fichierDictionnaire']['tmp_name'])&&($_FILES['fichierDictionnaire']['error'] == UPLOAD_ERR_OK))) {   
			if(substr($_FILES['fichierDictionnaire']['name'], -3, 3)=='csv'){  
				$chemin_destination = $cheminServer.'Fichiers/Dictionnaires/'; 
				//Pour assurer un nom de fichier unique, on le renomme avec le nom (unique) du dictionnaire
				$_FILES['fichierDictionnaire']['name'] = $_POST['dictionnaire'].".csv";
				move_uploaded_file($_FILES['fichierDictionnaire']['tmp_name'], $chemin_destination.$_FILES['fichierDictionnaire']['name']);     
				// Gestion des ajouts
				$dictionnaireManager->add(new Dictionnaire($_POST['dictionnaire'],$_POST['langue'],$_FILES['fichierDictionnaire']['name'],$_POST['casse']));			
				//le codage est géré par la tache cron

			} 
			else
			 {
				echo 'Le fichier choisi n\'est pas un CSV';
			 }
		 }
	} 
}



//Gestion des supression
if(isset($_POST['deleteDico'])){
	unlink ($cheminServer.'Fichiers/Dictionnaires/'.$dictionnaireManager->get($_POST['deleteDico'])->getFichierDictionnaire());
	$dictionnaireManager->delete($_POST['deleteDico']);
}

//Gestion de l'edition 
if(isset($_POST['oldDictionnaire']) and isset($_POST['newDictionnaire'])){
//Le nom du fichier doit etre le meme que celui du dictionnaire pour éviter d'écraser un fichier existant. Ne pas autoriser le changement de nom du fichier.
	$nomFichier = $_POST['newDictionnaire'].'.csv';
	$chemin_destination = $cheminServer.'Fichiers/Dictionnaires/';
	$dictionnaireManager->update(new Dictionnaire($_POST['oldDictionnaire'],$_POST['oldLangue'],$_POST['oldFichierDictionnaire'],$_POST['oldCasse']),new Dictionnaire($_POST['newDictionnaire'],$_POST['newLangue'],$nomFichier,$_POST['oldCasse']));
	//attention gestion des erreurs: le renommage ne doit se faire que si l'update a été réussi
	rename($chemin_destination.$_POST['oldFichierDictionnaire'], $chemin_destination.$nomFichier);
	}

//Récupération du contenu de la BDD
if(isset($_POST['order']))
{
	$dictionnaire = $dictionnaireManager->getAll($_POST['order']);
}
else
{
	$dictionnaire = $dictionnaireManager->getAll('dictionnaire');
}
$langues = $langueManager->getAll();
//On inclue la vue

  

include 'vue/dictionnaire.php'; 
}
else include "accesinterdit.php";
?></em></em>