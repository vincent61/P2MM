<?php
include '../dbconnect.php';
include '../Modele/Managers/MotSpectacleManager.php';
$motSpectacleManager = new MotSpectacleManager($con);
$result = $motSpectacleManager->getAll();

?>
 <table border='1'>
                <tr class="titre">
                  <th><a href="../Controleurs/mot.php?order=mot"><u>Mot</u></a></th>
                  <th><u></u></th>
                </tr>
                <?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($result as $mots){ ?>
     <tr>
     <th><?php echo $mots['mot'];?></th>
     <th><a href="../Controleurs/receptionMotSpectacle.php?deleteMot=<?php echo $mots['mot'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' /></a></th>
   </tr>
   <?php }
   ?>
</table>