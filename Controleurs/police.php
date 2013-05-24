<?php
include '../dbconnect.php';
include '../cheminsPerso.php';
include '../Modele/Managers/PoliceManager.php';

$policeManager = new PoliceManager($con);

// Gestion des ajouts
if(isset($_POST['police']) && $_POST['police']!=''&& isset($_FILES['fichierCodes']['name'])&& $_FILES['fichierCodes']['name']!= '' && isset($_POST['casse'])&& $_POST['casse']!=''){
//if(isset($_POST['police'])){
echo "isset ok";
	if ($_FILES['fichierCodes']['error']) {     
				  switch ($_FILES['fichierCodes']['error']){     
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
		if ((isset($_FILES['fichierCodes']['tmp_name'])&&($_FILES['fichierCodes']['error'] == UPLOAD_ERR_OK))) {   
			if(substr($_FILES['fichierCodes']['name'], -3, 3)=='txt'){  
				$chemin_destination = $cheminServer.'P2MM/Fichiers/Polices/';
				//Pour assurer un nom de fichier unique, on le renomme avec le nom (unique) de la POlice
				$_FILES['fichierCodes']['name'] = $_POST['police'].".txt";
				move_uploaded_file($_FILES['fichierCodes']['tmp_name'], $chemin_destination.$_FILES['fichierCodes']['name']);     
				// Gestion des ajouts
				$policeManager->add(new Police($_POST['police'],$_FILES['fichierCodes']['name'],$_POST['casse']));
			} 
			else
			 {
				echo 'Le fichier choisi n\'est pas un TXT';
			 }
		 }
}
	
}

//Gestion des supression
if(isset($_GET['delete'])){
	unlink ($cheminServer.'P2MM/Fichiers/Polices/'.$policeManager->get($_GET['delete'])->getFichierCodes());
	$policeManager->delete($_GET['delete']);

}

//Gestion de l'edition
if(isset($_POST['oldPolice']) and isset($_POST['newPolice'])){
	//Le nom du fichier doit etre le meme que celui de la police pour éviter d'écraser un fichier existant. Ne pas autoriser le changement de nom du fichier.
	$nomFichier = $_POST['newPolice'].'.txt';
	$chemin_destination = $cheminServer.'P2MM/Fichiers/Polices/';
	//renomme le fichier de codes avec le nouveau nom spécifié
	$policeManager->update(new Police($_POST['oldPolice'],$_POST['oldFichierCodes'],$_POST['oldCasse']),new Police($_POST['newPolice'],$nomFichier,$_POST['oldCasse']));
	//attention gestion des erreurs: le renommage ne doit se faire que si l'update a été réussi
	rename($chemin_destination.$_POST['oldFichierCodes'], $chemin_destination.$nomFichier);
			
}

//Récupération du contenu de la BDD
$police = $policeManager->getAll();

//On inclue la vue
include '../Vue/police.php'; 
?>












