﻿<script type="text/javascript">

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

<div id="wrapper"> 
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
        <?php include 'base/barreLaterale.php';?>
        <div id="content">
          <div class="post">
            <h2 class="title">Langues</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
              <fieldset>
                <form action="index.php?zone=admin&page=langue" method="post" onsubmit="return validForm(this)">
                  <b>Ajout:
                  <p></b>
                    <input type="text" name="langue" />
                    <input type="submit" value="Ajouter" />
                  </p>
                </form>
              </fieldset>
              </br>
              <table border='1'>
                <b>
                <tr class="titre">
                  <th><u>Langue</u></th>
                  <th><u></u></th>
                  <th><u></u></th>
                </tr>
                </b>
                <?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 
foreach($langues as $langues){ ?>
                <tr>
                  <?php if(isset($_GET['edit']) and $_GET['edit']==$langues['langue']){?>
                  <th> <form action="index.php?zone=admin&page=langue" method="post">
                      <input type="hidden" name="oldLangue" value="<?php echo $langues['langue']; ?>" />
                      <input type="text" name="newLangue" value="<?php echo $langues['langue']; ?>" />
                    </form>
                  </th>
                  <?php }else{ ?>
                  <th> <?php echo $langues['langue']; ?> </th>
                  <?php } ?>
                  <th><a href="index.php?zone=admin&page=langue&amp;delete=<?php echo $langues['langue']; ?>"><img src='vue/ressources/supprimer.png' height='20' width='20' /></a></th>
                  <th><a href="index.php?zone=admin&page=langue&amp;edit=<?php echo $langues['langue'];?>"><img src='vue/ressources/edit.png' height='20' width='20' /></a></th>
                </tr>
                <?php }  ?>
              </table>
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
<script type="text/javascript" src="functions.js" ></script>
