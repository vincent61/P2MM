<?php
ignore_user_abort(1); //continue de s'ex�cuter mais si le navigateur ferme la connexion
set_time_limit(0); // le script peut s'ex�cuter de fa�on illimit�e

function codageDico($nomDico, $dictionnaireManager){

	//$dictionnaireManager->get($_POST['dictionnaire'])->remplirMotsCode();
	$dictionnaireManager->get($nomDico)->remplirMotsCode();

	$message = "Le remplissage du dictionnaire ".$nomDico. " est termin�\r\n";
	echo $message;
	mail('guerryma.utc@gmail.com', 'R�sultat Codage', $message);

}
?>