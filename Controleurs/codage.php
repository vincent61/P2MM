<?php
include 'modele/Managers/MotManager.php';

$mot= new Mot("mot", 0, "min_bas");
$motManager= new MotManager($con);
$pol=array('demi_bas','demi_haut');
$mot = new Mot('daba', 0, 'min_bas');
$motManager->codage($mot, $pol);
?>