<fieldset>
	<form action="../Controleurs/codelettre.php" method="post"> 
        <b>Ajout:</b></br>
        Code: <input type="text" name="code" />
		Type lettre:<input type="text" name="typelettre" />
		Police :
        <SELECT name="policeListe" size="1">
        <?php 
			foreach ($polices as $police)
				echo '<OPTION>'. $police['police'];
		?>
    	</SELECT>
        
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

foreach($codelettre as $codelettre){ ?>
	<tr>
	<?php if(isset($_GET['editCode']) and isset($_GET['editPolice'])and $_GET['editCode']==$codelettre['code'] and $_GET['editPolice']==$codelettre['police']){ ?>
		
		<form action="../Controleurs/codelettre.php" method="post">
		</th>
		<th>
		<input type="text" name="newCode" value=<?php echo $codelettre['code'];?>>
		</th>
		<th>
		<input type="text" name="newTypeLettre" value=<?php echo $codelettre['typeLettre'];?>>
		</th>
		<th>
        <SELECT name="newPolice" size="1">
        <?php 
		foreach ($polices as $police)
		{
			echo '<OPTION';
			if($police['police'] == $codelettre['police'])
			{
				echo ' selected';
			}
			echo '>'.$police['police'];
		}
		?>
    	</SELECT>
		</th>
		<input type="hidden" name="oldCode" value=<?php echo $codelettre['code'];?>>
		<input type="hidden" name="oldTypeLettre" value=<?php echo $codelettre['typeLettre'];?>>
		<input type="hidden" name="oldPolice" value=<?php echo $codelettre['police'];?>>
		
	<?php }else{?>
	<th><?php echo $codelettre['code'];?></th>
	<th><?php echo $codelettre['typeLettre'];?></th>
	<th><?php echo $codelettre['police'];?></th>

	<?php }?>
	<th><a href="../Controleurs/codelettre.php?deleteCode=<?php echo $codelettre['code'];?>&deletePolice=<?php echo $codelettre['police'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' ></a></th>
	<th><a href="../Controleurs/codelettre.php?editCode=<?php echo $codelettre['code'];?>&editPolice=<?php echo $codelettre['police'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' ></a></th>
	<?php if(isset($_GET['editCode']) and isset($_GET['editPolice'])and $_GET['editCode']==$codelettre['code'] and $_GET['editPolice']==$codelettre['police']){?>
			<th><input type="submit" value="Ajouter"></th>
			</form>
	<?php }?>
	</tr>
<?php }?>

</TABLE>



