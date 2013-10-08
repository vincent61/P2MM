<?php
include 'cheminsPerso.php';
include $cheminServer.'admin/codagedico.php';
include_once $cheminServer.'modele/Managers/DictionnaireManager.php';
include_once $cheminServer.'modele/Managers/MotManager.php';
include_once $cheminServer.'dbconnect.php';
$dm = new DictionnaireManager($con);
$mm = new MotManager($con);
/*
Ancienne version
$acharger = $dm->getAllByStatut('noncharge');// On récupère la liste des dictionnaires non chargés
foreach($acharger as $dico){
	$nomDico = $dico['dictionnaire'];
	$dm->updateStatut($nomDico, 'enchargement');
	
	codageDico($nomDico, $dm);
	/*$mots = $mm->getAllFromDictionnaire($nomDico); // On récupère les mots contenus dans le dictionnaire
	foreach($mots as $mot){
	echo $mot->getMot();
		$mm->codage($mot);
	}*/
	
//}*/

/* Algorithme de remplissage
1/ rechercher tous les dicos dont le statut est différent de chargé
2/ Pour chacun de ces dicos, on ne va coder qu'une seule lettre. Et changer le statut. 
	=> Regarder le statut. Ne coder que les mots dont la première lettre est le statut. (modification de codageDico.
	=> Changer le statut par la lettre suivante dans l'alphabet
	=> Si le statut était "z", changer par "chargé" et envoyer le mail
*/
$acharger = $dm->getAllLoading();// On récupère la liste des dictionnaires non chargés
foreach($acharger as $dico){
	$nomDico = $dico['dictionnaire'];
	$statut = $dico['statut'];
	echo "nom dico ".$nomDico;
	
	if ($statut !== "enchargement" && $statut !== "erreur" ){
		if($statut == "noncharge"){
			$statut = 'a';
		}
		echo "<br>statut : ".$statut;
		codageDico($nomDico, $dm, $statut);
	}

}

?>