<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title> Recherche de Combinaisons </title>
	</head>

	<body>
		<?php include "base/header.html"; ?>
		<?php include "base/navBar.html"; ?>
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
		
		<menu id="menuRech">
			<a href="#recherche"> Recherche </a>
			<a href="#resultats"> Résultats </a> 
		</menu>

		<?php include "base/footer.html"; ?>
	</body>
</html>