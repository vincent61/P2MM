<?php
ignore_user_abort(1); //continue de s'exécuter mais si le navigateur ferme la connexion
set_time_limit(0); // le script peut s'exécuter de façon illimitée

function codageDico($nomDico, $dictionnaireManager){

	//$dictionnaireManager->get($_POST['dictionnaire'])->remplirMotsCode();
	$dico = $dictionnaireManager->get($nomDico);
	$dictionnaireManager->remplirMotsCode($dico);

	$message = "Le remplissage du dictionnaire ".$nomDico. " est terminé\r\n";
	echo $message;
	mail('guerryma.utc@gmail.com', 'Résultat Codage', $message);

}
?>