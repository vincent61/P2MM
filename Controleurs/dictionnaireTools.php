<?php

include_once '../modele/Managers/DictionnaireManager.php';
include_once '../modele/Managers/LangueManager.php';
$dictionnaireManager = new DictionnaireManager($con);
$langueManager = new LangueManager($con);

	if(isset($_POST['deleteDico'])){
		unlink ($cheminServer.'P2MM/Fichiers/Dictionnaires/'.$dictionnaireManager->get($_POST['deleteDico'])->getFichierDictionnaire());
		$dictionnaireManager->delete($_POST['deleteDico']);
	}

<?