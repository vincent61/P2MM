<script type="text/javascript" src="/P2MM/functions.js" ></script>

<script type="text/javascript">

function validForm(form){
	var valid = true;
	var msg = "Saisir : \n";
	var displayPopUp = false;

	if (trim(form.elements['code'].value) == ""){
		valid = false;
		msg = msg + "- Code\n";
		displayPopUp = true;
	}

	if (displayPopUp == true) alert(msg);
	return valid;
}

</script>

<fieldset>
	<form action="../Controleurs/motcode.php" method="post" onsubmit="return validForm(this)"> 
        <b>Ajout:</b></br>
        Code: <input type="text" name="code" />
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
<CAPTION> Liste Mot codes</CAPTION>
<tr>
<th><u>Code</u></th>
<th><u>Police</u></th>


<th><u></u></th>
<th><u></u></th>
</tr>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($motCodes as $motCodes){ ?>
	<tr>
	<?php if(isset($_GET['editCode']) and isset($_GET['editPolice'])and $_GET['editCode']==$motCodes['code'] and $_GET['editPolice']==$motCodes['police']){?>
		
		<form action="../Controleurs/motcode.php" method="post">
		</th>
		<th>
		<input type="text" name="newCode" value=<?php echo $motCodes['code'];?>>
		</th>
		<th>
        <SELECT name="newPolice" size="1">
        <?php 
		foreach ($polices as $police)
		{
			echo '<OPTION';
			if($police['police'] == $motCodes['police'])
			{
				echo ' selected';
			}
			echo '>'.$police['police'];
		}
		?>
    	</SELECT>
		</th>
		<input type="hidden" name="oldCode" value=<?php echo $motCodes['code'];?>>
		<input type="hidden" name="oldPolice" value=<?php echo $motCodes['police'];?>>
		
	<?php }else{?>
	<th><?php echo $motCodes['code'];?></th>
	<th><?php echo $motCodes['police'];?></th>

	<?php }?>
	<th><a href="../Controleurs/motcode.php?deleteCode=<?php echo $motCodes['code'];?>&deletePolice=<?php echo $motCodes['police'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' ></a></th>
	<th><a href="../Controleurs/motcode.php?editCode=<?php echo $motCodes['code'];?>&editPolice=<?php echo $motCodes['police'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' ></a></th>
	<?php if(isset($_GET['editCode']) and isset($_GET['editPolice'])and $_GET['editCode']==$motCodes['code'] and $_GET['editPolice']==$motCodes['police']){?>
			<th><input type="submit" value="Ajouter"></th>
			</form>
	<?php }?>
	</tr>
<?php }?>

</TABLE>



