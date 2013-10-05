<?php
include_once 'modele/Managers/DictionnaireManager.php';
include_once 'modele/Managers/MotManager.php';
include_once 'dbconnect.php';
echo "je suis la";
$dm = new DictionnaireManager($con);

$acharger = $dm->getAllByStatut("noncharge");
var_dump($acharger);
?>