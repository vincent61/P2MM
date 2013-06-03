<?php
include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include_once '../Modele/Managers/DictionnaireManager.php';

//$mot = new Mot('baba', 0, 'min_bas', 0);
$flag=0;
$motManager=new MotManager($con);
$dicoManager= new DictionnaireManager($con);
$dicos= $dicoManager->getAll('dictionnaire'); // r�cup�ration de tous les noms des dictionnaires pr�sents en base
$listeDico= array(); // liste contenant les dictionnaires pass�s en param�tres par l'utilisateur (coch�s dans la checkbox)
$motsComp= array();

foreach ($dicos as $dico)
{	$nomDico=$dico['dictionnaire'];
	if (isset($_POST[$nomDico]))
		array_push($listeDico, $nomDico);
	}
	

if(isset($_POST['mot'])){
	$mots = explode(" ", $_POST['mot']);
		foreach($mots as $mot){
		$motsCompUni= array();
        if (isset($_POST['type_recherche'])){
			if (isset($_POST['casse'])){
			$motsCompUni = $motManager->motsCompatibles($mot, $_POST['type_recherche'], $listeDico, $_POST['casse']);
			$motsComp=$motsComp+$motsCompUni;
			$flag=1;
			}
			}
		}
	}

//include '../Vue/recherche.php'; 
?>