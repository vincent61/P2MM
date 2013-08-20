<?php 
header("Content-type: text/xml");		   
print('<?xml version="1.0" encoding="UTF-8"?>');
print('<procedes>');
include_once 'modele/Managers/PoliceManager.php';
include_once 'dbconnect.php';
function casse($numCasse){
/**
*fonction retournant la casse de façon lisible à partir du code correspondant
*/
	if($numCasse == 0){
		return 'majuscule';
	}
	else
		return 'minuscule';
	}
$pm = new PoliceManager($con); 
$procedes = $pm->getAll();

foreach($procedes as $police){
//pour chaque procédé, écrit <procede name="nom_de_la_police" casse="casse_de_la_police" />
		        print('<procede name="'.$police['police'].'" casse="'.casse($police['casse']).'" />');  
}
print('</procedes>');

?>