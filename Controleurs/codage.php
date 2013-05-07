<?php
include '../dbconnect.php';
include '../Modele/Managers/MotManager.php';

$mot= new Mot("mot", 0, "min_bas");
$motManager= new MotManager($con);

$motManager->codage(new Mot('aaac', 0, 'min_bas'), ("demi_bas"));


?>