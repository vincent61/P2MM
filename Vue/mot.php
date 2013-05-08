<fieldset>
	<form action="../Controleurs/mot.php" method="post"> 
        <b>Ajout:</b></br>
        Mot: <input type="text" name="mot" />
		Casse:<input type="text" name="casse" />
		Dictionnaire:
        <SELECT name="dictionnaireListe" size="1">
        <?php 
			foreach ($dictionnaires as $dictionnaire)
				echo '<OPTION>'. $dictionnaire['dictionnaire'];
		?>
    	</SELECT>
        
        <input type="submit" value="Ajouter">
    </form>
</fieldset>

</br>


<TABLE BORDER='1'>
<CAPTION> Liste Mots</CAPTION>
<tr>
<th><u>Mot</u></th>
<th><u>Casse</u></th>
<th><u>Dictionnaire</u></th>


<th><u></u></th>
<th><u></u></th>
</tr>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($mots as $mots){ ?>
	<tr>
	<?php if(isset($_GET['editMot']) and isset($_GET['editDictionnaire'])and $_GET['editMot']==$mots['mot'] and $_GET['editDictionnaire']==$mots['dictionnaire']){?>
		
		<form action="../Controleurs/mot.php" method="post">
		</th>
		<th>
		<input type="text" name="newMot" value=<?php echo $mots['mot'];?>>
		</th>
		<th>
		<input type="text" name="newCasse" value=<?php echo $mots['casse'];?>>
		</th>
		<th>
        <SELECT name="newDictionnaire" size="1">
        <?php 
		foreach ($dictionnaires as $dictionnaire)
		{
			echo '<OPTION';
			if($dictionnaire['dictionnaire'] == $mots['dictionnaire'])
			{
				echo ' selected';
			}
			echo '>'.$dictionnaire['dictionnaire'];
		}
		?>
    	</SELECT>
		</th>
		<input type="hidden" name="oldMot" value=<?php echo $mots['mot'];?>>
		<input type="hidden" name="oldCasse" value=<?php echo $mots['casse'];?>>
		<input type="hidden" name="oldDictionnaire" value=<?php echo $mots['dictionnaire'];?>>
		
	<?php }else{?>
	<th><?php echo $mots['mot'];?></th>
	<th><?php echo $mots['casse'];?></th>
	<th><?php echo $mots['dictionnaire'];?></th>

	<?php }?>
	<th><a href="../Controleurs/mot.php?deleteMot=<?php echo $mots['mot'];?>&deleteDictionnaire=<?php echo $mots['dictionnaire'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' ></a></th>
	<th><a href="../Controleurs/mot.php?editMot=<?php echo $mots['mot'];?>&editDictionnaire=<?php echo $mots['dictionnaire'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' ></a></th>
	<?php if(isset($_GET['editMot']) and isset($_GET['editDictionnaire'])and $_GET['editMot']==$mots['mot'] and $_GET['editDictionnaire']==$mots['dictionnaire']){?>
			<th><input type="submit" value="Ajouter"></th>
			</form>
	<?php }?>
	</tr>
<?php }?>

</TABLE>



