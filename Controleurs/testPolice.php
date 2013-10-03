<?php
include 'modele/managers/PoliceManager.php';


	$pm = new PoliceManager($con);
	$minHaut = $pm->get("min_haut");
	$minHaut->remplirLettresCode();

?>