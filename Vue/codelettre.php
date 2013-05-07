<fieldset>
	<form action="../Controleurs/codelettre.php" method="post"> 
        <b>Ajout:</b></br>
        Code: <input type="text" name="code" />
		Type lettre:<input type="text" name="typelettre" />
		Police :
		<select name="listepolice">
		<?php
		foreach($codelettreListePolice as $codelettreListePolice){
		?>
			<option value= <?php echo $codelettreListePolice['police']; ?> > <?php echo $codelettreListePolice['police'];?> </option>
		<?php
		}
		reset($codelettreListePolice);
		?>
		</select>
        
        <input type="submit" value="Ajouter">
    </form>
</fieldset>

</br>


<TABLE BORDER='1'>
<CAPTION> Liste Codes Lettres</CAPTION>
<tr>
<th><u>Code</u></th>
<th><u>Type lettre</u></th>
<th><u>Police</u></th>


<th><u></u></th>
<th><u></u></th>
</tr>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($codelettre as $codelettre)
{
	echo '<tr>';
	if(isset($_GET['edit']) and $_GET['edit']==$codelettre['code'])
	{
		
		echo '<form action="../Controleurs/codelettre.php" method="post">';
		echo '</th>';
		echo '<th>';
		echo '<input type="text" name="newCode" value='.$codelettre['code'].'>';
		echo '</th>';
		echo '<th>';
		echo '<input type="text" name="newTypeLettre" value='.$codelettre['typeLettre'].'>';
		echo '</th>';
		echo '<th>';
		//print_r($codelettreListePolice);
		//echo count($codelettreListePolice);
		
		echo '<select name="newPolice">';
				 
				 
		while ($affichage = mysql_fetch_array($codelettreListePolice))
		{
		 echo '<option value="'.$affichage['police'].'">'.$affichage['police'].'</option>';
		}
/*
		foreach($codelettreListePolice as $codelettreListePolice){
		?>
			<option value=<?php echo $codelettreListePolice['police']; ?>><?php echo $codelettreListePolice['police']; ?></option>
		<?php
		}
		
*/
		echo '</select>';
		
		

		echo '</th>';
		echo '<input type="hidden" name="oldCode" value='.$codelettre['code'].'>';
		echo '<input type="hidden" name="oldTypeLettre" value='.$codelettre['typeLettre'].'>';
		echo '<input type="hidden" name="oldPolice" value='.$codelettre['police'].'>';
		
		
	}
	else{
	echo '<th>'.$codelettre['code'].'</th>';
	echo '<th>'.$codelettre['typeLettre'].'</th>';
	echo '<th>'.$codelettre['police'].'</th>';

	}
	echo'<th><a href="../Controleurs/codelettre.php?delete='.$codelettre['code'].'"><img src=\'../Vue/ressources/supprimer.png\' height=\'20\' width=\'20\' ></a></th>'."\n";
	echo'<th><a href="../Controleurs/codelettre.php?edit='.$codelettre['code'].'"><img src=\'../Vue/ressources/edit.png\' height=\'20\' width=\'20\' ></a></th>'."\n";
	if(isset($_GET['edit']) and $_GET['edit']==$codelettre['code'])
	{
			echo' <th><input type="submit" value="Ajouter"></th>';
			//echo'<a href="../Controleurs/dictionnaire.php?edit='.$codelettre['police'].'"><img src=\'../Vue/ressources/edit.png\' height=\'20\' width=\'20\' ></a><'."\n";
			echo '</form>';
	}
	echo '</tr>';
}

?>

</TABLE>



