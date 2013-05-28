<?php
ignore_user_abort(1); //continue de s'exécuter mais si le navigateur ferme la connexion
set_time_limit(0); // le script peut s'exécuter de façon illimitée

function codageMotsPolice($policeManager, $nomPolice,$connexion){

	include_once '../Modele/Managers/MotManager.php';

	$motManager = new MotManager($connexion);
	
	$mots = $motManager->getAll('frequence');
	$police=$policeManager->get($nomPolice);
	
	foreach($mots as $mots){
		if($mots['casse'] == $police->getCasse())
			$motManager->codage(new Mot($mots['mot'], $mots['casse'], $mots['dictionnaire'], $mots['frequence']), array($police));
	}

	$message = "Le codage des mots dans la police ".$nomPolice. " est terminé\r\n";
	//echo $message;
	mail('danyferreira.utc@gmail.com', 'Résultat Codage Mots', $message);
	//mail('guerryma.utc@gmail.com', 'Résultat Codage', $message);

}
?>