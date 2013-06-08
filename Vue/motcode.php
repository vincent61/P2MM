<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
                <form action="../Controleurs/motcode.php" method="post" onsubmit="return validForm(this)">
                  <b>Ajout:</b></br>
                  <p>Code:
                    <input type="text" name="code" />
                  </p>
                  <p>Police :
                    <select name="policeListe" size="1">
                      <?php 
			foreach ($polices as $police)
				echo '<OPTION>'. $police['police'];
		?>
                    </select>
                  </p>
                  <p>
                    <input type="submit" value="Ajouter" />
                  </p>
                </form>
              </fieldset>
              </br>
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
