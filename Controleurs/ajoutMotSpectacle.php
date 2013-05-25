<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Document sans titre</title>
</head>
<body>
<?php 
include '../dbconnect.php';
include '../Modele/Managers/MotSpectacleManager.php';

$motSpectacleManager = new MotSpectacleManager($con);
// Gestion des ajouts
if(isset($_POST['mot']) ){
	$motSpectacleManager->add(new MotSpectacle($_POST['mot']));
}



//Récupération du contenu de la BDD
if(isset($_GET['order']))
{
	$mots = $motSpectacleManager->getAll();
}
else
{
	$mots = $motSpectacleManager->getAll('frequence');
}

include "../Vue/ajoutMotSpectacle.php";
?>
</body>
</html>