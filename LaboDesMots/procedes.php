<?php 
header("Content-type: text/xml");		   
print('<?xml version="1.0" encoding="UTF-8"?>');
print('<procedes>');
include_once '../Modele/Managers/PoliceManager.php';
include_once '../dbconnect.php';
function casse($numCasse){
	if($numCasse == 0){
		return 'majuscule';
	}
	else
		return 'minuscule';
	}
$pm = new PoliceManager($con); 
$procedes = $pm->getAll();

foreach($procedes as $police){
		        print('<procede name="'.$police['police'].'" casse="'.casse($police['casse']).'" />');  
}
print('</procedes>');

?>