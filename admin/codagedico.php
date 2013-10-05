<?php
ignore_user_abort(1); //continue de s'ex�cuter mais si le navigateur ferme la connexion
set_time_limit(0); // le script peut s'ex�cuter de fa�on illimit�e

function codageDico($nomDico, $dictionnaireManager){


	$dico = $dictionnaireManager->get($nomDico);
	//$dictionnaireManager->updateStatut($nomDico, "enchargement");
	//ajouter un try-catch et mail d'erreur en cas de probl�me. + s'assurer de la fin su script
	try{
	$dictionnaireManager->remplirMotsCode($dico);
	}
	catch(Exception $e){
			$dictionnaireManager->updateStatut($nomDico, "Erreur Chargement");
			mail('guerryma.utc@gmail.com', 'Exception lors du Codage de '.$nomDico, $e->getMessage());

	}
	//$dictionnaireManager->updateStatut($nomDico, "charge");

	$message = "Le remplissage du dictionnaire ".$nomDico. " est termin�\r\n";
	mail('guerryma.utc@gmail.com', 'R�sultat Codage', $message);
}
?>