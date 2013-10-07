<?php
set_time_limit(0);
include_once 'modele/Managers/DictionnaireManager.php';
include_once 'modele/Managers/MotManager.php';
include_once 'dbconnect.php';
include 'admin/codagedico.php';
$dm = new DictionnaireManager($con);
$mm = new MotManager($con);
$acharger = $dm->getAllByStatut('noncharge');// On récupère la liste des dictionnaires non chargés
foreach($acharger as $dico){
	$nomDico = $dico['dictionnaire'];
	echo $nomDico;
	$dm->updateStatut($nomDico, 'enchargement');
	
	codageDico($nomDico, $dm);
	/*$mots = $mm->getAllFromDictionnaire($nomDico); // On récupère les mots contenus dans le dictionnaire
	foreach($mots as $mot){
	echo $mot->getMot();
		$mm->codage($mot);
	}*/
	$dm->updateStatut($nomDico, 'charge');
	$message = "Le remplissage du dictionnaire ".$nomDico. " est terminé\r\n";

	mail('guerryma.utc@gmail.com', 'Résultat Codage', $message);
}
?>