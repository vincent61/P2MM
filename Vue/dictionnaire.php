<fieldset>
	<form action="../Controleurs/dictionnaire.php" method="post"> 
        <b>Ajout:</b></br>
        Nom: <input type="text" name="dictionnaire" />
        Langue:
        <SELECT name="langue" size="1">
        <?php 
		foreach ($langues as $langue)
		echo '<OPTION>'. $langue['langue'];?>
    	</SELECT>
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
{?>
	<tr>
	<?php if(isset($_GET['edit']) and $_GET['edit']==$dictionnaire['dictionnaire'])
	{?>
		
		<form action="../Controleurs/dictionnaire.php" method="post">
		</th>
		<th>
		<input type="text" name="newDictionnaire" value=<?php echo $dictionnaire['dictionnaire'];?>>
		</th>
		<th>
        <SELECT name="newLangue" size="1">
        <?php 
		foreach ($langues as $langue)
		{
			echo '<OPTION';
			if($langue['langue'] == $dictionnaire['langue'])
			{
				echo ' selected';
			}
			echo '>'.$langue['langue'];
		}
		?>
    	</SELECT>
		</th>
		<th>
		<input type="text" name="newFichierDictionnaire" value=<?php echo $dictionnaire['fichierDictionnaire'];?>>
		</th>
		<th>
		<input type="text" name="newCasse" value=<?php echo $dictionnaire['casse'];?>>
		</th>
		<input type="hidden" name="oldDictionnaire" value=<?php echo $dictionnaire['dictionnaire'];?>>
		<input type="hidden" name="oldLangue" value=<?php echo $dictionnaire['langue'];?>>
		<input type="hidden" name="oldFichierDictionnaire" value=<?php echo $dictionnaire['fichierDictionnaire'];?>>
		<input type="hidden" name="oldCasse" value=<?php echo $dictionnaire['casse'];?>>
	<?php 	
		
	}
	else{
		?>
	<th><?php echo $dictionnaire['dictionnaire'];?></th>
	<th><?php echo $dictionnaire['langue'];?></th>
	<th><?php echo $dictionnaire['fichierDictionnaire'];?></th>
	<th><?php echo $dictionnaire['casse'];?></th>
<?php 
	}
	?>
	<th><a href="../Controleurs/dictionnaire.php?delete=<?php echo $dictionnaire['dictionnaire'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' ></a></th>
	<th><a href="../Controleurs/dictionnaire.php?edit=<?php echo $dictionnaire['dictionnaire'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' ></a></th>
	<?php 
    if(isset($_GET['edit']) and $_GET['edit']==$dictionnaire['dictionnaire'])
	{?>
			<th><input type="submit" value="Modifier"></th>
			</form>
	<?php }?>
	</tr>
<?php }?>
</TABLE>


<?php  
//$dictionnaireManager->testParser();
?>


