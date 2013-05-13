<fieldset>
	<form action="../Controleurs/Police.php" enctype="multipart/form-data" method="post"> 
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

foreach($police as $police){ ?>
	<tr>
	<?php if(isset($_GET['edit']) and $_GET['edit']==$police['police']){?>
		
		<form action="../Controleurs/police.php" method="post">
		</th>
		<th>
		<input type="text" name="newPolice" value=<?php echo $police['police'];?>>
		</th>
		<th>
		<input type="text" name="newFichierCodes" value=<?php echo $police['fichierCode'];?>>
		</th>
		<th>
		<input type="text" name="newCasse" value=<?php echo $police['casse'];?>>
		</th>
		<input type="hidden" name="oldPolice" value=<?php echo $police['police'];?>>
		<input type="hidden" name="oldFichierCodes" value=<?php echo $police['fichierCode'];?>>
		<input type="hidden" name="oldCasse" value=<?php echo $police['casse'];?>>
		
		
	<?php }else{ ?>
		<th><?php echo $police['police'];?></th>
		<th><?php echo $police['fichierCode'];?></th>
		<th><?php echo $police['casse'];?></th>
	<?php }?>
	<th><a href="../Controleurs/police.php?delete=<?php echo $police['police'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' ></a></th>
	<th><a href="../Controleurs/police.php?edit=<?php echo $police['police'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' ></a></th>
	<?php if(isset($_GET['edit']) and $_GET['edit']==$police['police']){?>
			<th><input type="submit" value="Ajouter"></th>
			</form>
	<?php } ?>
	</tr>
<?php }?>

</TABLE>



