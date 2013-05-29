<?php
ignore_user_abort(1); //continue de s'ex�cuter mais si le navigateur ferme la connexion
set_time_limit(0); // le script peut s'ex�cuter de fa�on illimit�e

function codageMotsPolice($policeManager, $nomPolice,$connexion){

	include_once '../Modele/Managers/MotManager.php';

	$motManager = new MotManager($connexion);
	
	$mots = $motManager->getAll('frequence');
	$police=$policeManager->get($nomPolice);
	
	foreach($mots as $mot){
		if($mot['casse'] == $police->getCasse())
			$motManager->codage(new Mot($mot['mot'], $mot['casse'], $mot['dictionnaire'], $mot['frequence']), array($nomPolice));
	}

	$message = "Le codage des mots dans la police ".$nomPolice. " est termin�\r\n";
	//echo $message;
	//mail('danyferreira.utc@gmail.com', 'R�sultat Codage Mots', $message);
	mail('guerryma.utc@gmail.com', 'R�sultat Codage Mots ', $message);

}
?>