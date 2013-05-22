<?php include "base/header.php"; ?>
<script type="text/javascript" src="/P2MM/functions.js" ></script>
<script type="text/javascript">
function validForm(form){
	var valid = true;
	var msg = "Saisir : \n";
	var displayPopUp = false;

	if (trim(form.elements['dictionnaire'].value) == ""){
		valid = false;
		msg = msg + "- Nom dictionnaire\n";
		displayPopUp = true;
	}

	if (trim(form.elements['fichierDictionnaire'].value) == ""){
		valid = false;
		msg = msg + "- Fichier dictionnaire\n";
		displayPopUp = true;
	}else{
	    var validExts = new Array(".csv");
	    var fileExt = form.elements['fichierDictionnaire'].value;
	    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));

	    if (validExts.indexOf(fileExt) < 0) {
	      alert("- Type de fichier sélectionné invalide, le type de fichier accepté est csv.");
	      valid = false;
	    }
	}

	if (checkRadioButton(form.elements['casse']) == false){
		valid = false;
		msg = msg + "- Casse\n";
		displayPopUp = true;
	}
	
	if (displayPopUp == true) alert(msg);
	return valid;
}

</script>

<div class="tbox1">
<div class="box-style box-style01">
<div class="content">
<fieldset >
	<form action="../Controleurs/dictionnaire.php" enctype="multipart/form-data" method="post" onSubmit="return validForm(this)"> 
        <b>Ajout:</b></br>
        Nom: <input type="text" name="dictionnaire" />
        Langue:
        <SELECT name="langue" size="1">
        <?php 
		foreach ($langues as $langue)
		echo '<OPTION>'. $langue['langue'];?>
    	</SELECT>
        Fichier Dictionnaire:<input type="file" accept=".csv" name="fichierDictionnaire" />
        Casse:<input type="radio" name="casse" value="0">Majuscule
        <input type="radio" name="casse" value="1">Minuscule
        <input type="submit" value="Ajouter">
    </form>
</fieldset>
</div>
</div>
</div>
<TABLE BORDER='1'>
<CAPTION> Liste Dictionnaires</CAPTION>
<tr>
<th><u>Dictionnaires</u></th>
<th><u>Langue</u></th>
<th><u>Fichier Dictionnaire</u></th>
<th><u>Casse</u></th>


<th><u></u></th>
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
		<?php echo $dictionnaire['fichierDictionnaire'];?>
		</th>
		<th>
		<?php echo $dictionnaire['casse'];?>
		</th>
		<input type="hidden" name="oldDictionnaire" value=<?php echo $dictionnaire['dictionnaire'];?>>
		<input type="hidden" name="oldLangue" value=<?php echo $dictionnaire['langue'];?>>
		<input type="hidden" name="oldFichierDictionnaire" value=<?php echo $dictionnaire['fichierDictionnaire'];?>>
		<input type="hidden" name="oldCasse" value=<?php echo $dictionnaire['casse'];?>>
	<?php }else{ ?>
		<th><?php echo $dictionnaire['dictionnaire'];?></th>
		<th><?php echo $dictionnaire['langue'];?></th>
		<th><?php echo $dictionnaire['fichierDictionnaire'];?></th>
		<th><?php echo $dictionnaire['casse'];?></th>
<?php 
	}
	?>																							
	<th><a href="../Controleurs/dictionnaire.php?delete=<?php echo $dictionnaire['dictionnaire'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' ></a></th>
	<th><a href="../Controleurs/dictionnaire.php?edit=<?php echo $dictionnaire['dictionnaire'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' ></a></th>
   	<th><a href="../Controleurs/dictionnaire.php?addMotsCode=<?php echo $dictionnaire['dictionnaire'];?>"><img src='../Vue/ressources/arrow.png' height='20' width='20' ></a></th>
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
?>


