<!DOCTYPE html>
<?php include "base/header.php"; ?>
<div id="wrapper"> 
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
        <?php include 'base/barreLaterale.php';?>
        <div id="content">
          <div class="post">
            <h2 class="title">Polices</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
              <fieldset>
                <form action="../Controleurs/police.php" enctype="multipart/form-data" method="post" onsubmit="return validForm(this)">
                  <b>Ajout:</b></br>
                  <p>Police:
                    <input type="text" name="police" />
                  </p>
                  <p> Fichier Codes:
                    <input type="file" name="fichierCodes" accept=".txt"/>
                  </p>
                  <p> Casse:
                    <input type="radio" name="casse" value="0" />
                    Majuscule
                    <input type="radio" name="casse" value="1" />
                    Minuscule</p>
                  <p>
                    <input type="submit" value="Ajouter" />
                  </p>
                </form>
              </fieldset>
              </br>
              <table border='1'>
                <tr class="titre">
                  <th><u>Police</u></th>
                  <th><u>Fichier Code</u></th>
                  <th><u>Casse</u></th>
                  <th><u></u></th>
                  <th><u></u></th>
                </tr>
                <?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($police as $police){ ?>
                <tr id="ligne_<?php echo $police['police'];?>">
                  <?php if(isset($_GET['edit']) and $_GET['edit']==$police['police']){?>
                  <form action="../Controleurs/police.php" method="post">
                    <td>  </th></td>
                    <th> <input type="text" name="newPolice" value="<?php echo $police['police'];?>" />
                    </th>
                    <th> <?php echo $police['fichierCode'];?> </th>
                    <th> <?php echo $police['casse']=="0" ? 'Majuscule' : 'Minuscule'?> </th>
                    <input type="hidden" name="oldPolice" value="<?php echo $police['police'];?>" />
                    <input type="hidden" name="oldFichierCodes" value="<?php echo $police['fichierCode'];?>" />
                    <input type="hidden" name="oldCasse" value="<?php echo $police['casse'];?>" />
                    <?php }else{ ?>
                    <th><?php echo $police['police'];?></th>
                    <th><?php echo $police['fichierCode'];?></th>
                    <th><?php echo $police['casse']=="0" ? 'Majuscule' : 'Minuscule'?></th>
                    <?php }?>
                    <!--<th><a href="../Controleurs/police.php?delete=<?php echo $police['police'];?>"><img src='../Vue/ressources/supprimer.png' height='20' width='20' /></a></th>
					-->
					<th>
						<form id="supprform<?php echo $police['police'];?>" method="post" action="../Controleurs/police.php">
							<input type="hidden" name="deletePolice" value="<?php echo $police['police'];?>">
							<a target="blank" onclick="confirmsuppr('<?php echo $police['police'];?>')"><img title="supprimer" src='../Vue/ressources/supprimer.png' height='20' width='20' /></a>
						</form>
					</th>
					
                    <th><a href="../Controleurs/police.php?edit=<?php echo $police['police'];?>"><img src='../Vue/ressources/edit.png' height='20' width='20' /></a></th>
                    <?php if(isset($_GET['edit']) and $_GET['edit']==$police['police']){?>
                    <th><input type="submit" value="Ajouter" /></th>
                  </form>
                  <?php } ?>
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
<script type="text/javascript" src="../functions.js" ></script>
<script type="text/javascript">

function confirmsuppr(police){
//Supprime la police de la bdd en ajax et met à jour le tableau de résultats

	if(confirm("Voulez-vous supprimer la police" + police + "?")){
		$.post(
			"../Controleurs/police.php",
			{
				deletePolice: police
			},
			function(data){
			alert(police  +" supprimée!");
			$('#ligne_' + police).remove();
			}
		);
		
	}
	
}

function validForm(form){
	var valid = true;
	var msg = "Saisir : \n";
	var displayPopUp = false;

	if (trim(form.elements['police'].value) == ""){
		valid = false;
		msg = msg + "- Nom police\n";
		displayPopUp = true;
	}

	if (trim(form.elements['fichierCodes'].value) == ""){
		valid = false;
		msg = msg + "- Fichier codes\n";
		displayPopUp = true;
	}else{
	    var validExts = new Array(".txt");
	    var fileExt = form.elements['fichierCodes'].value;
	    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));

	    if (validExts.indexOf(fileExt) < 0) {
	      alert("Type de fichier sélectionné invalide, le type de fichier accepté est txt.");
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
