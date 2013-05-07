<fieldset>
	<form action="../Controleurs/lettre.php" method="post"> 
        <b>Ajout:</b><input type="text" name="lettre" />
        <input type="submit" value="Ajouter">
    </form>
</fieldset>

</br>


<TABLE BORDER='1'>
<CAPTION> Liste lettres</CAPTION>
<b><th><u>Lettre</u></th>
	
<th><u></u></th><th><u></u></th></tr></b>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 
foreach($lettres as $lettres)
{
	echo '<tr>';
	if(isset($_GET['edit']) and $_GET['edit']==$lettres['lettreAscii'])
	{
		echo '<th>';
		echo '<form action="../Controleurs/lettre.php" method="post">';
		echo '<input type="hidden" name="oldLettre" value='.$lettres['lettreAscii'].'>';
		echo '<input type="text" name="newLettre" value='.$lettres['lettreAscii'].'>';
		echo '</form>';
		echo '</th>';
	}
	else{
	echo '<th>'.$lettres['lettreAscii'].'</th>';
	}
	echo'<th><a href="../Controleurs/lettre.php?delete='.$lettres['lettreAscii'].'"><img src=\'../Vue/ressources/supprimer.png\' height=\'20\' width=\'20\' ></a></th>'."\n";
	echo'<th><a href="../Controleurs/lettre.php?edit='.$lettres['lettreAscii'].'"><img src=\'../Vue/ressources/edit.png\' height=\'20\' width=\'20\' ></a></th></tr>'."\n";

}
echo "</TABLE>\n </br>";
?>
