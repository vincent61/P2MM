<?php include "base/header.php"; ?>
<div id="wrapper"> 
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
        <?php include 'base/barreLaterale.php';?>
        <div id="content">
          <div class="post">
            <h2 class="title">Espace de Recherche</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
              <div class="menuRech"> <a href="#recherche"> Recherche </a> <a href="#resultats"> Résultats </a> </div>
              <div id="recherche">
                <fieldset>
                  <?php include "../Controleurs/recherche.php"; ?>
				  <form action="recherche.php" method="post">
                    <p><b>Determiner la liste des mots compatibles:</b></p></br>
					<p>Mot:
                    <input type="text" name="mot" />
					</p>
					<p>
					<input type="radio" name="casse" value="1" checked="checked"/>
                    Minuscule
                    <input type="radio" name="casse" value="0" />
                    Majuscule
					</p>
					<p>
                    <input type="radio" name="type_recherche" value="0" checked="checked"/>
                    Toutes les réponses
                    <input type="radio" name="type_recherche" value="1" />
                    Seulement 1 mot / code
					<input type="radio" name="type_recherche" value="2" />
                    Seulement plus de 1 mot / code
					</p>
					<p>Dictionnaires :<!-- Par défaut, tous les dictionnaires sont cochés directement -->
					</br>
		<?php 
					foreach ($dicos as $dico)
					echo "<input type='checkbox' name='".$dico['dictionnaire']."' size='1' checked>".$dico['dictionnaire']."<br />";
		?>
                    
                  </p>
				  <p>
					<label for="download">Télécharger les résultats</label>
					<input type="checkbox" name="download"/>
				</p>
				  <p>
                    <input type="submit" value="Chercher" /></br>
                  </p></form>
                </fieldset>
                </br>
              </div>
              <div id="resultats">
                <?php
				
				if(isset($_POST['mot']) && isset($_POST['type_recherche'])){    // Si l'utilisateur a entré un mot, on lui affiche la liste des mots compatibles, sinon rien.
				
			?>
                <table border='1'>
                  <caption>
                  Liste des Mots Compatibles
                  </caption>
                  <tr class="titre">
                    <th><u>Mot Initial</u></th>
                    <th><u>Code</u></th>
                    <th><u>Police</u></th>
                    <th><u>Dictionnaire</u></th>
                    <th><u>Mots Correspondants</u></th>
                  </tr>
                  <?php
			// on fait une boucle qui va faire un tour pour chaque enregistrement 
		if ($_POST['mot']!=NULL)
			foreach($motsComp as $motComp){ ?>
                  <tr >
                    <th><?php echo $motComp['initial'];?></th>
                    <th><?php echo $motComp['code'];?></th>
                    <th><?php echo $motComp['police'];?></th>
                    <th><?php echo $motComp['dictionnaire'];?></th>
                    <th><?php 
					//foreach ($motComp['mots'] as $mot)	
					echo $motComp['compatible'] ; ?></th>
                    <?php  }?>
                </tr>
                </table>
                <?php }
			?>
              </div>
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