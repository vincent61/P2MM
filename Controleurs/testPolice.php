<?php
include '../dbconnect.php';
include '../Modele/Managers/PoliceManager.php';


	$pm = new PoliceManager($con);
	$minHaut = $pm->get("min_haut");
	$minHaut->remplirLettresCode();

?>