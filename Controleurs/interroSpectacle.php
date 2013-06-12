<?php

include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';
include_once '../Modele/Managers/DictionnaireManager.php';

//Gestion du requêtage de mots

if(isset($_POST['fmot']) && isset($_POST['fcasse']) && isset($_POST['ftype_recherche'])){
$flag=0;
$motManager=new MotManager($con);
$dicoManager= new DictionnaireManager($con);
$dicos= $dicoManager->getAll('dictionnaire'); // récupération de tous les noms des dictionnaires présents en base
$policeManager= new PoliceManager($con);
$procedes = $policeManager->getAll();
$motsComp= array();
		//$motsCompUni= array();
        if (isset($_POST['ftype_recherche'])){
			if (isset($_POST['fcasse'])){
			//$motsCompUni = $motManager->motsCompatibles($_POST['fmot'], $dicos, $procedes, $_POST['fcasse'], $_POST['ftype_recherche']);
			//$motsComp = array_merge($motsComp, $motsCompUni);
			$motsComp = $motManager->motsCompatibles($_POST['fmot'], $dicos, $procedes, $_POST['fcasse'], $_POST['ftype_recherche']);

			$flag=1;
			}
			}
		}
		$tata = "tata";
		/*foreach($motsComp as $motComp){ 
			$tata =  $motComp['compatible'] ; 
   }*/
   		//echo($motsComp[0]['compatible']);
		echo($tata);


?>