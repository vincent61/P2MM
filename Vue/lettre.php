<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
                <form action="../Controleurs/lettre.php" method="post" onsubmit="return validForm(this)">
                  <b>Ajout:</b>
                  <p>
                    <input type="text" name="lettre" />
                    <input type="submit" value="Ajouter" />
                  </p>
                  <p>&nbsp;                </p>
                </form>
              </fieldset>
              </br>
              <table border='1'>
                <b>
                <tr class="titre">
                  <th><u>Lettre</u></th>
                  <th><u></u></th>
                  <th><u></u></th>
                </tr>
                </b>
                <?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 
foreach($lettres as $lettres){ ?>
                <tr>
                  <?php if(isset($_GET['edit']) and $_GET['edit']==$lettres['lettreAscii']) {?>
                  <th> <form action="../Controleurs/lettre.php" method="post">
                      <input type="hidden" name="oldLettre" value="<?php echo $lettres['lettreAscii'];?>" />
                      <input type="text" name="newLettre" value="<?php echo $lettres['lettreAscii'];?>" />
                    </form>
                  </th>
                  <?php }else{ ?>
                  <th> <?php echo $lettres['lettreAscii'];?> </th>
                  <?php } ?>
                  <th><a href="../Controleurs/lettre.php?delete=<?php echo $lettres['lettreAscii'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' /></a></th>
                  <th><a href="../Controleurs/lettre.php?edit=<?php echo $lettres['lettreAscii'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' /></a></th>
                </tr>
                <?php } ?>
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
<script type="text/javascript" src="../functions.js" ></script>
<?php include "base/footer.html"; ?>
</html>