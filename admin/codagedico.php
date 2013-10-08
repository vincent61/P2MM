<?php
//ignore_user_abort(1); //continue de s'ex�cuter mais si le navigateur ferme la connexion
set_time_limit(0); // le script peut s'ex�cuter de fa�on illimit�e

function codageDico($nomDico, $dictionnaireManager, $lettre=null){

	echo "Codage dico lettre : ".$lettre."<br>";
	$dico = $dictionnaireManager->get($nomDico);
	$dictionnaireManager->updateStatut($nomDico, "enchargement");
	//ajouter un try-catch et mail d'erreur en cas de probl�me. + s'assurer de la fin su script
	try{
	$dictionnaireManager->remplirMotsCode($dico, $lettre);
	}
	catch(Exception $e){
			$dictionnaireManager->updateStatut($nomDico, "erreur");
			mail('combinalisons@gmail.com', 'Exception lors du Codage de '.$nomDico, $e->getMessage());

	}
	if ($lettre !== null && strtolower($lettre) !== 'z'){
		$lettre = strtolower($lettre);
		echo "nouveau statut : ".chr(ord($lettre) + 1)."<br>";
		$dictionnaireManager->updateStatut($nomDico, chr(ord($lettre) + 1) );
		}
	else{
		$dictionnaireManager->updateStatut($nomDico, "charge");
		$message = "Le remplissage du dictionnaire ".$nomDico. " est termin�\r\n";
		mail('combinalisons@gmail.com', 'R�sultat Codage', $message);
		}

	
}
?>