<?php 
include 'modele/Managers/MotSpectacleManager.php';

$motSpectacleManager = new MotSpectacleManager($con);
// Gestion des ajouts
if(isset($_POST['mot']) ){
	$motSpectacleManager->add(new MotSpectacle($_POST['mot']));
}



//Récupération du contenu de la BDD

	$mots = $motSpectacleManager->getAll();

include "vue/ajoutMotSpectacle.php";
?>
</body>
</html>