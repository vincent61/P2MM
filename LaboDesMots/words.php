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
	//Recuperation des polices dans lesquelles les mots seront cod�s
	//TODO: v�rifier casse? Verifier espaces?

		$polices = explode(';',$_POST['procedes']);
			}
	/*else{
		//si aucune police n'est sp�cifi�e, alors on code dans toutes les polices /!\ r�cup�rer slmt les noms et v�rifier la casse
		$polices= $pm->getAll();
		}*/
	
	
	// il faudrait v�rifier que la casse et les polices sont compatibles, sauf si l'on code le mot dans les 2 casses.
		

	if(isset($_POST['word'])){
		$searchWord = $_POST['word'];
		if(isset($_POST['casse'])){
		//gestion de la casse et transformation au cas o� le mot n'est pas �crit dans la bonne casse
			$casse = $_POST['casse'];
			if($casse == "0"){
				$searchWord = strtoupper($searchWord);
			}
			else
				$searchWord = strtolower($searchWord);
				
		}
	//recherche des mots compatibles dans les polices demand�es
		$dicos =$dm->getAllByCasse($casse);
		$words = $mm->motsCompatibles($searchWord,$dicos,$polices , $casse);
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