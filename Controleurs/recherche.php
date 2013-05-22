<?php
include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';


//$mot = new Mot('baba', 0, 'min_bas', 0);
$motManager=new MotManager($con);

if(isset($_POST['mot'])){
	$motsComp = $motManager->motsCompatibles($_POST['mot']);
	}

include '../Vue/recherche.php'; 
?>