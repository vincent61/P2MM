<script type="text/javascript" src="/P2MM/functions.js" ></script>

<script type="text/javascript">

function validForm(form){
	var valid = true;
	var msg = "Saisir : \n";
	var displayPopUp = false;

	if (trim(form.elements['langue'].value) == ""){
		valid = false;
		msg = msg + "- Langue";
		displayPopUp = true;
	}

	if (displayPopUp == true) alert(msg);
	return valid;
}

</script>


<fieldset>
	<form action="../Controleurs/langue.php" method="post" onsubmit="return validForm(this)"> 
        <b>Ajout:</b><input type="text" name="langue" />
        <input type="submit" value="Ajouter">
    </form>
</fieldset>

</br>

<TABLE BORDER='1'>
<CAPTION> Liste langues</CAPTION>
<b>
	<th><u>Langue</u></th>	
	<th><u></u></th>
	<th><u></u></th></tr>
</b>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 
foreach($langues as $langues){ ?>
	<tr>
		<?php if(isset($_GET['edit']) and $_GET['edit']==$langues['langue']){?>
			<th>
				<form action="../Controleurs/langue.php" method="post">
				<input type="hidden" name="oldLangue" value=<?php echo $langues['langue']; ?>>
				<input type="text" name="newLangue" value=<?php echo $langues['langue']; ?>>
				</form>
			</th>
		<?php }else{ ?>
			<th> <?php echo $langues['langue']; ?> </th>
		<?php } ?>
		<th><a href="../Controleurs/langue.php?delete=<?php echo $langues['langue']; ?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' ></a></th>
		<th><a href="../Controleurs/langue.php?edit=<?php echo $langues['langue'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' ></a></th>
	</tr>
<?php }  ?>
</TABLE> 
</br>
