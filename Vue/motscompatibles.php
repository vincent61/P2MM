<fieldset>
	<form action="../Controleurs/motscompatibles.php" method="post"> 
        <b>Determiner la liste des mots compatibles:</b></br>
        Mot: <input type="text" name="mot" />
		<input type="submit" value="Chercher">
    </form>
</fieldset>

</br>

<?php
	if(isset($_POST['mot'])){    // Si l'utilisateur a entré un mot, on lui affiche la liste des mots compatibles, sinon rien.
?>

<TABLE BORDER='1'>
<CAPTION> Liste des Mots Compatibles</CAPTION>
<tr>
<th><u>Code</u></th>
<th><u>Police</u></th>
<th><u>Mots Correspondants</u></th>

</tr>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($motsComp as $motComp){ ?>
	<tr>	
		<th><?php echo $motComp['code'];?></th>
		<th><?php echo $motComp['police'];?></th>
		<th><?php 
		foreach ($motComp['mots'] as $mot)	
					{echo $mot ; echo " ";} ?></th>		

<?php }?>


</TABLE>

<?php }
?>


