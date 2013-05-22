<script type="text/javascript" src="/P2MM/functions.js" ></script>
<script type="text/javascript">

function validForm(form){
	var valid = true;
	var msg = "Saisir : \n";
	var displayPopUp = false;

	if (trim(form.elements['mot'].value) == ""){
		valid = false;
		msg = msg + "- Mot\n";
		displayPopUp = true;
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

<?php include "base/header.php"; ?>
<body>
<div id="wrapper"> 
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
			<?php include 'base/barreLaterale.php';?>
				<div id="content">
					<div class="post">
						<h2 class="title">Mots</h2>
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
							<fieldset>
	<form action="../Controleurs/mot.php" method="post" onSubmit="return validForm(this)"> 
        <b>Ajout:</b></br>
        Mot: <input type="text" name="mot" />
		Casse:<input type="radio" name="casse" value="0">Majuscule
        <input type="radio" name="casse" value="1">Minuscule
		Dictionnaire:
        <SELECT name="dictionnaireListe" size="1">
        <?php 
			foreach ($dictionnaires as $dictionnaire)
				echo '<OPTION>'. $dictionnaire['dictionnaire'];
		?>
    	</SELECT>
        Frequence: 
        <input type="text" name="frequence" />
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
<th><u>Frequence</u></th>

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
		<?php echo $mots['casse']=="0" ? 'Majuscule' : 'Minuscule'?>
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
        <th>
        	<input type="text" name="newFrequence" value=<?php echo $mots['frequence'];?>>
		</th>
		<input type="hidden" name="oldMot" value=<?php echo $mots['mot'];?>>
		<input type="hidden" name="oldCasse" value=<?php echo $mots['casse'];?>>
		<input type="hidden" name="oldDictionnaire" value=<?php echo $mots['dictionnaire'];?>>
		<input type="hidden" name="oldFrequence" value=<?php echo $mots['frequence'];?>>

	<?php }else{?>
	<th><?php echo $mots['mot'];?></th>
	<th><?php echo $mots['casse']=="0" ? 'Majuscule' : 'Minuscule'?></th>
	<th><?php echo $mots['dictionnaire'];?></th>
    <th><?php echo $mots['frequence'];?></th>


	<?php }?>
	<th><a href="../Controleurs/mot.php?deleteMot=<?php echo $mots['mot'];?>&deleteDictionnaire=<?php echo $mots['dictionnaire'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' ></a></th>
	<th><a href="../Controleurs/mot.php?editMot=<?php echo $mots['mot'];?>&editDictionnaire=<?php echo $mots['dictionnaire'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' ></a></th>
	<?php if(isset($_GET['editMot']) and isset($_GET['editDictionnaire'])and $_GET['editMot']==$mots['mot'] and $_GET['editDictionnaire']==$mots['dictionnaire']){?>
			<th><input type="submit" value="Modifier"></th>
			</form>
	<?php }?>
	</tr>
<?php }?>

</TABLE>

					</div>
					</div>
				</div>
				<!-- end #content -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page --> 
</div>
<?php include "base/footer.html"; ?>
</html>