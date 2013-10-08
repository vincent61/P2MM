<div id="wrapper"> 
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
        <?php include 'vue/base/barreLaterale.php';?>
        <div id="content">
          <div class="post">
            <h2 class="title">Dictionnaires</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
              <fieldset >
                <form action="index.php?zone=admin&page=dictionnaire" enctype="multipart/form-data" method="post" onSubmit="return validForm(this)">
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
                  <th><u><a href="index.php?zone=admin&page=dictionnaire&amp;order=dictionnaire"><span TITLE="Trier par Dictionnaires">Dictionnaire</span></u></a></th>
                  <th><u><a href="index.php?zone=admin&page=dictionnaire&amp;order=langue"><span TITLE="Trier par Langues">Langues</span></a></u></th>
                  <th><u><a href="index.php?zone=admin&page=dictionnaire&amp;order=fichierDictionnaire"><span TITLE="Trier par Fichiers">Fichier Dictionnaire</span></a></u></th>
                  <th><u><a href="index.php?zone=admin&page=dictionnaire&amp;order=casse"><span TITLE="Trier par Casses">Casse</span></a></u></th>
                  <th><u><a href="index.php?zone=admin&page=dictionnaire&amp;order=statut"><span TITLE="Trier par Statuts">Statut</span></a></u></th>
                  <th><u></u></th>
                  <th><u></u></th>
                </tr>
                <?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 
foreach($dictionnaire as $dictionnaire)
{?>
                <tr id="ligne_<?php echo $dictionnaire['dictionnaire'];?>">
                  <?php if(isset($_GET['edit']) and $_GET['edit']==$dictionnaire['dictionnaire'])
	{?>
                  <form action="index.php?zone=admin&page=dictionnaire" method="post">
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
                    <th> <?php echo $dictionnaire['statut'] == "noncharge" ? 'Non chargé' : ($dictionnaire['statut'] == "enchargement" ? 'Chargement en cours' : ($dictionnaire['statut'] == "charge" ? 'Chargé': $dictionnaire['statut']))?> </th>
                    <?php }else{ ?>
                    <th><?php echo $dictionnaire['dictionnaire'];?></th>
                    <th><?php echo $dictionnaire['langue'];?></th>
                    <th><?php echo $dictionnaire['fichierDictionnaire'];?></th>
                    <th><?php echo $dictionnaire['casse']=="0" ? 'Majuscule' : 'Minuscule'?></th>
                    <th> <?php echo $dictionnaire['statut'] == "noncharge" ? 'Non chargé' : ($dictionnaire['statut'] == "enchargement" ? 'Chargement en cours' : ($dictionnaire['statut'] == "charge" ? 'Chargé': $dictionnaire['statut']))?> </th>
                    <?php 
	}
	?>
                    <th>
						<form id="supprform<?php echo $dictionnaire['dictionnaire'];?>" method="post" action="index.php?page=dictionnaire">
							<input type="hidden" name="deleteDico" value="<?php echo $dictionnaire['dictionnaire'];?>">
							<a target="blank" onclick="confirmsuppr('<?php echo $dictionnaire['dictionnaire'];?>')"><img title="supprimer" src='vue/ressources/supprimer.png' height='20' width='20' /></a>
						</form>
					</th>
                    <th><a href="index.php?zone=admin&page=dictionnaire&amp;edit=<?php echo $dictionnaire['dictionnaire'];?>"><img title="modifier" src='vue/ressources/edit.png' height='20' width='20' /></a></th>
					
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
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->
<script type="text/javascript" src="functions.js"></script>
<script type="text/javascript" src="script/ajaxdico.js"></script/>
<script type="text/javascript">
function confirmsuppr(dico){
//Supprime le dictionnaire de la bdd en ajax et met à jour le tableau de résultats
	if(confirm("Voulez-vous supprimer le dictionnaire " + dico + "?")){
		$.post(
			"index.php?zone=admin&page=dictionnaire",
			{
				deleteDico: dico
			},
			function(data){
			alert(dico  +" supprimé!");
			$('#ligne_' + dico).remove();
			}
		);
		
	}
	
}

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
</html>
