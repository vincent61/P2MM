<?php include "base/header.php"; ?>
<div id="wrapper"> 
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
        <?php include 'base/barreLaterale.php';?>
        <div id="content">
          <div class="post">
            <h2 class="title">Dictionnaires</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
              <fieldset >
                <form action="../Controleurs/dictionnaire.php" enctype="multipart/form-data" method="post" onSubmit="return validForm(this)">
                  <b>Ajout:</b></br>
                  <p>Nom:
                    <input type="text" name="dictionnaire" />
                  </p>
                  <p> Langue:
                    <select name="langue" size="1">
                      <?php 
		foreach ($langues as $langue)
		echo '<OPTION>'. $langue['langue'];?>
                    </select>
                  </p>
                  <p>Fichier Dictionnaire:
                    <input type="file" accept=".csv" name="fichierDictionnaire" />
                  </p>
                  <p>Casse:
                    <input type="radio" name="casse" value="0" />
                    Majuscule
                    <input type="radio" name="casse" value="1" />
                    Minuscule </p>
                  <p>
                    <input type="submit" value="Ajouter" />
                  </p>
                </form>
              </fieldset>
              <table border='1'>
                <tr class="titre">
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
                    <td></th></td>
                    <th> <input type="text" name="newDictionnaire" value="<?php echo $dictionnaire['dictionnaire'];?>" />
                    </th>
                    <th> <select name="newLangue" size="1">
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
                      </select>
                    </th>
                    <th> <?php echo $dictionnaire['fichierDictionnaire'];?> </th>
                    <th> <?php echo $dictionnaire['casse']=="0" ? 'Majuscule' : 'Minuscule'?> </th>
                    <input type="hidden" name="oldDictionnaire" value="<?php echo $dictionnaire['dictionnaire'];?>" />
                    <input type="hidden" name="oldLangue" value="<?php echo $dictionnaire['langue'];?>" />
                    <input type="hidden" name="oldFichierDictionnaire" value="<?php echo $dictionnaire['fichierDictionnaire'];?>" />
                    <input type="hidden" name="oldCasse" value="<?php echo $dictionnaire['casse'];?>" />
                    <?php }else{ ?>
                    <th><?php echo $dictionnaire['dictionnaire'];?></th>
                    <th><?php echo $dictionnaire['langue'];?></th>
                    <th><?php echo $dictionnaire['fichierDictionnaire'];?></th>
                    <th><?php echo $dictionnaire['casse']=="0" ? 'Majuscule' : 'Minuscule'?></th>
                    <?php 
	}
	?>
                    <th><a href="../Controleurs/dictionnaire.php?delete=<?php echo $dictionnaire['dictionnaire'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' /></a></th>
                    <th><a href="../Controleurs/dictionnaire.php?edit=<?php echo $dictionnaire['dictionnaire'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' /></a></th>
                    <th><a href="../Controleurs/dictionnaire.php?addMotsCode=<?php echo $dictionnaire['dictionnaire'];?>"><img src='../Vue/ressources/arrow.png' height='20' width='20' /></a></th>
                    <?php 
    if(isset($_GET['edit']) and $_GET['edit']==$dictionnaire['dictionnaire'])
	{?>
                    <th><input type="submit" value="Modifier" /></th>
                  </form>
                  <?php }?>
                </tr>
                <?php }?>
              </table>
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
<?php include "base/footer.html"; ?>
</html>
