 <meta http-equiv="refresh" content="1" >
 <table border='1'>
                <tr class="titre">
                  <th><a href="../Controleurs/mot.php?order=mot"><u>Mot</u></a></th>
                  <th><u></u></th>
                </tr>
                <?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($mots as $mots){ ?>
     <tr>
     <th><?php echo $mots['mot'];?></th>
     <th><a href="../Controleurs/receptionMotSpectacle.php?deleteMot=<?php echo $mots['mot'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' /></a></th>
   </tr>
   <?php }?>
</table>