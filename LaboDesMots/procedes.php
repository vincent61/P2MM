<?php include_once '../Modele/Managers/PoliceManager.php';
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

include_once 'procedes_xml.php';

?>