<?php
ignore_user_abort(1); //continue de s'exécuter mais si le navigateur ferme la connexion
set_time_limit(0); // le script peut s'exécuter de façon illimitée

	$dictionnaireManager->get($_GET['addMotsCode'])->remplirMotsCode();
	$message = "Le remplissage du dictionnaire ".$_GET['addMotsCode']. " est terminé\r\n";
	echo $message;
	mail('guerryma.utc@gmail.com', 'Résultat Codage', $message);


?>