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
						<h2 class="title">Mots Codes</h2>
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
							<fieldset>
	<form action="../Controleurs/motcode.php" method="post" onSubmit="return validForm(this)"> 
        <b>Ajout:</b></br>
        <p>Code: <input type="text" name="code" /></p>
		<p>Police :
        <SELECT name="policeListe" size="1">
        <?php 
			foreach ($polices as $police)
				echo '<OPTION>'. $police['police'];
		?>
    	</SELECT></p>
        
        <p><input type="submit" value="Ajouter"></p>
    </form>
</fieldset>

</br>


<TABLE BORDER='1'>
<tr class="titre">
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



