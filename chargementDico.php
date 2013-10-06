<?php
set_time_limit(0);
include_once 'modele/Managers/DictionnaireManager.php';
include_once 'modele/Managers/MotManager.php';
include_once 'dbconnect.php';
echo "je suis la";
$dm = new DictionnaireManager($con);
$mm = new MotManager($con);
$acharger = $dm->getAllByStatut('noncharge');// On r�cup�re la liste des dictionnaires non charg�s
foreach($acharger as $dico){
	$nomDico = $dico['dictionnaire'];
	echo $nomDico;
	$dm->updateStatut($nomDico, 'enchargement');
	include 'admin/codagedico.php';
	codageDico($nomDico, $dm);
	/*$mots = $mm->getAllFromDictionnaire($nomDico); // On r�cup�re les mots contenus dans le dictionnaire
	foreach($mots as $mot){
	echo $mot->getMot();
		$mm->codage($mot);
	}*/
	$dm->updateStatut($nomDico, 'charge');
	$message = "Le remplissage du dictionnaire ".$nomDico. " est termin�\r\n";

	mail('guerryma.utc@gmail.com', 'R�sultat Codage', $message);
}
?>