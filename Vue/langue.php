<fieldset>
	<form action="../Controleurs/langue.php" method="post"> 
        <b>Ajout:</b><input type="text" name="langue" />
        <input type="submit" value="Ajouter">
    </form>
</fieldset>

</br>


<TABLE BORDER='1'>
<CAPTION> Liste langues</CAPTION>
<b><th><u>Langue</u></th>
	
<th><u></u></th><th><u></u></th></tr></b>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 
foreach($langues as $langues)
{
	echo '<tr>';
	if(isset($_GET['edit']) and $_GET['edit']==$langues['langue'])
	{
		echo '<th>';
		echo '<form action="../Controleurs/langue.php" method="post">';
		echo '<input type="hidden" name="oldLangue" value='.$langues['langue'].'>';
		echo '<input type="text" name="newLangue" value='.$langues['langue'].'>';
		echo '</form>';
		echo '</th>';
	}
	else{
	echo '<th>'.$langues['langue'].'</th>';
	}
	echo'<th><a href="../Controleurs/langue.php?delete='.$langues['langue'].'"><img src=\'../Vue/ressources/supprimer.png\' height=\'20\' width=\'20\' ></a></th>'."\n";
	echo'<th><a href="../Controleurs/langue.php?edit='.$langues['langue'].'"><img src=\'../Vue/ressources/edit.png\' height=\'20\' width=\'20\' ></a></th></tr>'."\n";

}
echo "</TABLE>\n </br>";
?>
