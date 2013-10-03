<div id="wrapper"> 
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
        <div id="sidebar">
		<ul>
			<li>
				<p><img class = "logo" src="vue/ressources/petitLogo.png" width="151" height="151" alt="" /></p>
			</li>
		</ul>
        </div>
        
        <div id="content">
          <div class="post">
            <h2 class="title">Espace de Recherche</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
              <div class="menuRech"> <a href="#recherche"> Recherche </a> <a href="#resultats"> Résultats </a> </div>
              
			  <div id="recherche">
                <fieldset> 
				  <form action="index.php?page=recherche" method="post">
                    <p><b>Determiner la liste des mots compatibles:</b></p></br>
					<p>Mot:
                    <input type="text" name="mot" />
					</p>
					<p>Fichier:
                    <input type="file" accept=".txt" name="fichier" id="fichier"/>
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
					<ul id="rechercheDicoProcede">
					<li><b>Dictionnaires :</b><!-- Par défaut, tous les dictionnaires sont cochés directement -->
					</br>
					<?php 
								foreach ($dicos as $dico)
								echo "<input type='checkbox' name='".$dico['dictionnaire']."' size='1' checked>".$dico['dictionnaire']."<br />";
					?>
                 </li> 
                <li><b>Procédés :</b><!-- Par défaut, tous les procedes sont cochés directement -->
					</br>
					<?php 
								foreach ($procedes as $procede)
								echo "<input type='checkbox' name='".$procede['police']."' size='1' checked>".$procede['police']."<br />";
					?>		
                  </li></ul>
				  <p>
                    <input type="submit" value="Chercher" /></br>
                  </p></form>
                </fieldset>
                </br>
              </div>
			  
              <div id="resultats">
                <?php
				
				if(((isset($_POST['mot'])||(isset($_FILES['fichier']))) && isset($_POST['type_recherche'])) || isset($motsComp)) {    // Si l'utilisateur a entré un mot, on lui affiche la liste des mots compatibles, sinon rien.
				
			?>
			<!--lien vers le fichier généré-->
			<form action="<?php echo $csvFileName ?>" method="get">
				<input type="submit" value="Télecharger les résultats" />
			</form>
			
                <table border='1'>
                  <caption>
                  Liste des Mots Compatibles
                  </caption>
                  <tr class="titre">
                    <!--  <th><u>Mot Initial</u></th> -->
                    <th><u>Mot Initial</u></th>
                    <th><u>Code</u></th>
                    <th><u>Police</u></th>
                    <th><u>Dictionnaire</u></th>

                    
                    <form id="sortmotCorr" action="index.php?page=recherche.php" method="post">
					    <th><a href="#resultats" onclick="document.getElementById('sortmotCorr').submit();"><span style="color : #000066;text-decoration:underline;">Mots Correspondants</span></a></th>
					    <input type="hidden" name="results" value="<?php echo $resultsSerialized; ?>" />
					    <input type="hidden" name="sortField" value="motCorr" />
					    <input type="hidden" name="nameOfCsvFile" value="<?php echo $csvFileName; ?>" />
					</form>
                    
                    <form id="sortFreq" action="index.php?page=recherche" method="post">
					    <th><a href="#resultats" onclick="document.getElementById('sortFreq').submit();"><span style="color : #000066;text-decoration:underline;">Fréquence</span></a></th>
					    <input type="hidden" name="results" value="<?php echo $resultsSerialized;?>" />
					    <input type="hidden" name="sortField" value="frequence" />
					     <input type="hidden" name="nameOfCsvFile" value="<?php echo $csvFileName; ?>" />
					</form>
					
                  </tr>
                  <?php
			// on fait une boucle qui va faire un tour pour chaque enregistrement 
		    foreach($motsComp as $motComp){ ?>
                  <tr >
                    <th><?php echo $motComp['initial'];?></th>
                    <th><?php echo $motComp['code'];?></th>
                    <th><?php echo $motComp['police'];?></th>
                    <th><?php echo $motComp['dictionnaire'];?></th>
                    <th><?php 
					//foreach ($motComp['mots'] as $mot)	
					echo $motComp['compatible'] ; ?></th>
                    <th><?php echo $motComp['frequence'];?></th>
                    <?php  }?>
                </tr>
                </table>
                <?php }?>
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
</html>