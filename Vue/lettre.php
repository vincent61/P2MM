<script type="text/javascript" src="/P2MM/functions.js" ></script>

<script type="text/javascript">

function validForm(form){
	var valid = true;
	var msg = "Saisir : \n";
	var displayPopUp = false;

	if (trim(form.elements['lettre'].value) == ""){
		valid = false;
		msg = msg + "- Lettre";
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
						<h2 class="title">Lettres</h2>
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
							<fieldset>
	<form action="../Controleurs/lettre.php" method="post" onSubmit="return validForm(this)"> 
        <b>Ajout:</b><input type="text" name="lettre" />
        <input type="submit" value="Ajouter">
    </form>
</fieldset>

</br>


<TABLE BORDER='1'>
<CAPTION> Liste lettres</CAPTION>
<b>
	<th><u>Lettre</u></th>
	<th><u></u></th>
	<th><u></u></th></tr>
</b>

<?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 
foreach($lettres as $lettres){ ?>
	<tr>
	
	<?php if(isset($_GET['edit']) and $_GET['edit']==$lettres['lettreAscii']) {?>
		<th>
		<form action="../Controleurs/lettre.php" method="post">
		<input type="hidden" name="oldLettre" value=<?php echo $lettres['lettreAscii'];?> >
		<input type="text" name="newLettre" value=<?php echo $lettres['lettreAscii'];?>>
		</form>
		</th>
	<?php }else{ ?>
		<th>
			<?php echo $lettres['lettreAscii'];?>
		</th>
	<?php } ?>
	<th><a href="../Controleurs/lettre.php?delete=<?php echo $lettres['lettreAscii'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' ></a></th>
	<th><a href="../Controleurs/lettre.php?edit=<?php echo $lettres['lettreAscii'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' ></a></th></tr>
<?php } ?>
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