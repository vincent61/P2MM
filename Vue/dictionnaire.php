<fieldset>
	<form action="../Controleurs/dictionnaire.php" method="post"> 
        <b>Ajout:</b></br>
        Nom: <input type="text" name="dictionnaire" />
        Langue:<input type="text" name="langue" />
        Fichier Dictionnaire:<input type="file" name="fichierDictionnaire" />
        Casse:<input type="text" name="casse" />

        <input type="submit" value="Ajouter">
    </form>
</fieldset>

</br>

<TABLE BORDER='1'>
<CAPTION> Liste Dictionnaires</CAPTION>
<tr>
<th><u>Dictionnaires</u></th>
<th><u>Langue</u></th>
<th><u>Fichier Dictionnaire</u></th>
<th><u>Casse</u></th>


<th><u></u></th>
<th><u></u></th>
</tr>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 
foreach($dictionnaire as $dictionnaire)
{
	echo '<tr>';
	if(isset($_GET['edit']) and $_GET['edit']==$dictionnaire['dictionnaire'])
	{
		
		echo '<form action="../Controleurs/dictionnaire.php" method="post">';
		echo '</th>';
		echo '<th>';
		echo '<input type="text" name="newDictionnaire" value='.$dictionnaire['dictionnaire'].'>';
		echo '</th>';
		echo '<th>';
		echo '<input type="text" name="newLangue" value='.$dictionnaire['langue'].'>';
		echo '</th>';
		echo '<th>';
		echo '<input type="text" name="newFichierDictionnaire" value='.$dictionnaire['fichierDictionnaire'].'>';
		echo '</th>';
		echo '<th>';
		echo '<input type="text" name="newCasse" value='.$dictionnaire['casse'].'>';
		echo '</th>';
		echo '<input type="hidden" name="oldDictionnaire" value='.$dictionnaire['dictionnaire'].'>';
		echo '<input type="hidden" name="oldLangue" value='.$dictionnaire['langue'].'>';
		echo '<input type="hidden" name="oldFichierDictionnaire" value='.$dictionnaire['fichierDictionnaire'].'>';
		echo '<input type="hidden" name="oldCasse" value='.$dictionnaire['casse'].'>';
		
		
	}
	else{
	echo '<th>'.$dictionnaire['dictionnaire'].'</th>';
	echo '<th>'.$dictionnaire['langue'].'</th>';
	echo '<th>'.$dictionnaire['fichierDictionnaire'].'</th>';
	echo '<th>'.$dictionnaire['casse'].'</th>';

	}
	echo'<th><a href="../Controleurs/dictionnaire.php?delete='.$dictionnaire['dictionnaire'].'"><img src=\'../Vue/ressources/supprimer.png\' height=\'20\' width=\'20\' ></a></th>'."\n";
	echo'<th><a href="../Controleurs/dictionnaire.php?edit='.$dictionnaire['dictionnaire'].'"><img src=\'../Vue/ressources/edit.png\' height=\'20\' width=\'20\' ></a></th>'."\n";
	if(isset($_GET['edit']) and $_GET['edit']==$dictionnaire['dictionnaire'])
	{
			echo' <th><input type="submit" value="Ajouter"></th>';
			//echo'<a href="../Controleurs/dictionnaire.php?edit='.$dictionnaire['dictionnaire'].'"><img src=\'../Vue/ressources/edit.png\' height=\'20\' width=\'20\' ></a><'."\n";
			echo '</form>';
	}
	echo '</tr>';
}
?>
</TABLE>



