<fieldset>
	<form action="../Controleurs/Police.php" method="post"> 
        <b>Ajout:</b></br>
        Police: <input type="text" name="police" />
        Fichier Codes:<input type="file" name="fichierCodes" />
        Casse:<input type="text" name="casse" />

        <input type="submit" value="Ajouter">
    </form>
</fieldset>

</br>

<TABLE BORDER='1'>
<CAPTION> Liste Police</CAPTION>
<tr>
<th><u>Police</u></th>
<th><u>Fichier Code</u></th>
<th><u>Casse</u></th>


<th><u></u></th>
<th><u></u></th>
</tr>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($police as $police)
{
	echo '<tr>';
	if(isset($_GET['edit']) and $_GET['edit']==$police['police'])
	{
		
		echo '<form action="../Controleurs/police.php" method="post">';
		echo '</th>';
		echo '<th>';
		echo '<input type="text" name="newPolice" value='.$police['police'].'>';
		echo '</th>';
		echo '<th>';
		echo '<input type="text" name="newFichierCodes" value='.$police['fichierCode'].'>';
		echo '</th>';
		echo '<th>';
		echo '<input type="text" name="newCasse" value='.$police['casse'].'>';
		echo '</th>';
		echo '<input type="hidden" name="oldPolice" value='.$police['police'].'>';
		echo '<input type="hidden" name="oldFichierCodes" value='.$police['fichierCode'].'>';
		echo '<input type="hidden" name="oldCasse" value='.$police['casse'].'>';
		
		
	}
	else{
	echo '<th>'.$police['police'].'</th>';
	echo '<th>'.$police['fichierCode'].'</th>';
	echo '<th>'.$police['casse'].'</th>';

	}
	echo'<th><a href="../Controleurs/police.php?delete='.$police['police'].'"><img src=\'../Vue/ressources/supprimer.png\' height=\'20\' width=\'20\' ></a></th>'."\n";
	echo'<th><a href="../Controleurs/police.php?edit='.$police['police'].'"><img src=\'../Vue/ressources/edit.png\' height=\'20\' width=\'20\' ></a></th>'."\n";
	if(isset($_GET['edit']) and $_GET['edit']==$police['police'])
	{
			echo' <th><input type="submit" value="Ajouter"></th>';
			//echo'<a href="../Controleurs/dictionnaire.php?edit='.$police['police'].'"><img src=\'../Vue/ressources/edit.png\' height=\'20\' width=\'20\' ></a><'."\n";
			echo '</form>';
	}
	echo '</tr>';
}

?>

</TABLE>



