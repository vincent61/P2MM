<?php 
	header("Content-type: text/xml");		   
	print('<?xml version="1.0" encoding="UTF-8"?>');
	print('<words>');

	include_once '../Modele/Managers/MotManager.php';
	include_once '../Modele/Managers/PoliceManager.php';
	include_once '../Modele/Managers/DictionnaireManager.php';
	include_once '../dbconnect.php';
	$pm = new PoliceManager($con);
	$mm = new MotManager($con);
	$dm = new DictionnaireManager($con);

	if(isset($_POST['procedes'])){
	//Recuperation des polices dans lesquelles les mots seront codés

		$polices = explode(';',$_POST['procedes']);
			}
	else{
		//si aucune police n'est spécifiée, alors on code dans toutes les polices /!\ récupérer slmt les noms et vérifier la casse
		$polices= $pm->getAll();
		}
	if(isset($_POST['word'])){
	//recherche des mots compatibles dans les polices demandées
	$casse = 1;
		//$dicos =$dm->getAllByCasse($casse);
		$words = $mm->motsCompatibles($_POST['word'], 0, ['autre_min']);
		foreach($words as $word){
		if(in_array($word['police'], $polices)){
			$mot = $mm->get($word['compatible']);
			$freq = $mot->getFrequence();
			print('<word name="'.$word['compatible'].'" font="'.$word['police'].'" code="'.$word['code'].'" freq="'.$freq.'" />');
			}
			}
	}
		
	print('</words>');

?>