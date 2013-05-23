<fieldset>
  <form action="../Controleurs/motscompatibles.php" method="post">
    <b>Determiner la liste des mots compatibles:</b></br>
    Mot:
    <input type="text" name="mot" />
    <input type="submit" value="Chercher" />
  </form>
</fieldset>
</br>
<?php
	if(isset($_POST['mot'])){    // Si l'utilisateur a entr� un mot, on lui affiche la liste des mots compatibles, sinon rien.
?>
<table border='1'>
  <tr class="titre">
    <th><u>Mot Initial</u></th>
    <th><u>Code</u></th>
    <th><u>Police</u></th>
    <th><u>Mots Correspondants</u></th>
  </tr>
  <?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($motsComp as $motComp){ ?>
  <tr>
    <th><?php echo $motComp['initial'];?></th>
    <th><?php echo $motComp['code'];?></th>
    <th><?php echo $motComp['police'];?></th>
    <th><?php 
		//foreach ($motComp['mots'] as $mot)	
					echo $motComp['compatible'] ; ?></th>
    <?php }?>
</tr>
</table>
<?php }
?>
