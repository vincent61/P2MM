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

	var value = trim(form.elements['typelettre'].value);
	
	if (value == ""){
		valid = false;
		msg = msg + "- Type lettre\n";
		displayPopUp = true;
	}else{
		if (value != parseFloat(value)){
			valid = false;
			alert("Le code saisie n'est pas un nombre!");
		}
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
        <?php include 'vue/base/barreLaterale.php';?>
        <div id="content">
          <div class="post">
            <h2 class="title">Codes Lettres</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
              <fieldset>
                <form action="index.php?page=codelettre" method="post" onsubmit="return validForm(this)">
                  <b>Ajout:</b></br>
                  <p>Code:
                    <input type="text" name="code" />
                  </p>
                  <p>Type lettre:
                    <input type="text" name="typelettre" />
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
              <table border='1'>
                <tr class="titre">
                  <th><u>Code</u></th>
                  <th><u>Type lettre</u></th>
                  <th><u>Police</u></th>
                  <th><u></u></th>
                  <th><u></u></th>
                </tr>
                <?php
// on fait une boucle qui va faire un tour pour chaque enregistrement 

foreach($codelettre as $codelettre){ ?>
                <tr>
                  <?php if(isset($_GET['editCode']) and isset($_GET['editPolice'])and $_GET['editCode']==$codelettre['code'] and $_GET['editPolice']==$codelettre['police']){ ?>
                  <form action="index.php?page=codelettre" method="post">
                    <td></th></td>
                    <th> <input type="text" name="newCode" value="<?php echo $codelettre['code'];?>" />
                    </th>
                    <th> <input type="text" name="newTypeLettre" value="<?php echo $codelettre['typeLettre'];?>" />
                    </th>
                    <th> <select name="newPolice" size="1">
                        <?php 
		foreach ($polices as $police)
		{
			echo '<OPTION';
			if($police['police'] == $codelettre['police'])
			{
				echo ' selected';
			}
			echo '>'.$police['police'];
		}
		?>
                      </select>
                    </th>
                    <input type="hidden" name="oldCode" value="<?php echo $codelettre['code'];?>" />
                    <input type="hidden" name="oldTypeLettre" value="<?php echo $codelettre['typeLettre'];?>" />
                    <input type="hidden" name="oldPolice" value="<?php echo $codelettre['police'];?>" />
                    <?php }else{?>
                    <th><?php echo $codelettre['code'];?></th>
                    <th><?php echo $codelettre['typeLettre'];?></th>
                    <th><?php echo $codelettre['police'];?></th>
                    <?php }?>
                    <th><a href="index.php?page=codelettre&amp;deleteCode=<?php echo $codelettre['code'];?>&amp;deletePolice=<?php echo $codelettre['police'];?>"><img src='vue/ressources/supprimer.png' height='20' width='20' /></a></th>
                    <th><a href="index.php?page=codelettre&amp;editCode=<?php echo $codelettre['code'];?>&amp;editPolice=<?php echo $codelettre['police'];?>"><img src='vue/ressources/edit.png' height='20' width='20' /></a></th>
                    <?php if(isset($_GET['editCode']) and isset($_GET['editPolice'])and $_GET['editCode']==$codelettre['code'] and $_GET['editPolice']==$codelettre['police']){?>
                    <th><input type="submit" value="Ajouter" /></th>
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
<script type="text/javascript" src="functions.js" ></script>