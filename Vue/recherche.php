<?php include "base/header.php"; ?>
<body>
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
                                <menu id="menuRech">
                                    <a href="#recherche"> Recherche </a>
                                    <a href="#resultats"> Résultats </a> 
                                </menu>
                           <div id="recherche">
			<fieldset>
			<form action="../Controleurs/recherche.php" method="post"> 
			<b>Determiner la liste des mots compatibles:</b></br>
			Mot: <input type="text" name="mot" />
			<input type="submit" value="Chercher">
			</form>
			</fieldset>
			</br>
			</div>
			
			<div id="resultats">
			<?php
				if(isset($_POST['mot'])){    // Si l'utilisateur a entré un mot, on lui affiche la liste des mots compatibles, sinon rien.
			?>

			<TABLE BORDER='1'>
			<CAPTION> Liste des Mots Compatibles</CAPTION>
			<tr>
			<th><u>Mot Initial</u></th>
			<th><u>Code</u></th>
			<th><u>Police</u></th>
			<th><u>Mots Correspondants</u></th>
			</tr>

			<?php
			// on fait une boucle qui va faire un tour pour chaque enregistrement 

			foreach($motsComp as $motComp){ ?>
				<tr><th><?php echo $motComp['initial'];?></th>	
					<th><?php echo $motComp['code'];?></th>
					<th><?php echo $motComp['police'];?></th>
					<th><?php 
					//foreach ($motComp['mots'] as $mot)	
								echo $motComp['compatible'] ; ?></th>		

			<?php }?>
			</TABLE>
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