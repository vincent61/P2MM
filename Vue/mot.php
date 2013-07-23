<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<script type="text/javascript">

function validForm(form){
	var valid = true;
	var msg = "Saisir : \n\n";
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

	if (trim(form.elements['frequence'].value) == ""){
		valid = false;
		msg = msg + "- Fréquence\n";
		displayPopUp = true;
	}
	
	if (displayPopUp == true) alert(msg);
	return valid;
}

</script>
<?php include "base/header.php"; ?>
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
                <form action="../controleurs/mot.php" method="post" onsubmit="return validForm(this)">
                  <b>Ajout:</b></br>
                  </p>
                  <p>Mot:
                    <input type="text" name="mot" />
                  </p>
                  <p>Casse:
                    <input type="radio" name="casse" value="0" />
                    Majuscule
                    <input type="radio" name="casse" value="1" />
                    Minuscule</p>
                  <p>Dictionnaire:
                    <select name="dictionnaireListe" size="1">
                      <?php 
			foreach ($dictionnaires as $dictionnaire)
				echo '<OPTION>'. $dictionnaire['dictionnaire'];
		?>
                    </select>
                  </p>
                  <p> Frequence:
                    <input type="text" name="frequence" />
                  </p>
                  <p>
                    <input type="submit" value="Ajouter" />
                  </p>
                </form>
              </fieldset>
              </br>
              <div style="text-align: center;">Nombre de mots dans la base : <?php echo $numberOfWords; ?></div>
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
<script type="text/javascript" src="../functions.js" ></script>
<?php include "base/footer.html"; ?>
</html>