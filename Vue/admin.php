<?php
// Ne doit plus servir qu'à appeler une vue !!!! 
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title> Espace d'administration </title>
	</head>

	<body>
		<? include "base/header.html"; ?>
        <? include "base/navBar.html"; ?>
        <p><a href="Controleurs/lettre.php">Lettre</a></p>
        <p><a href="Controleurs/dictionnaire.php">Dictionnaire</a></p>
        <p><a href="Controleurs/police.php">Police</a></p>
        <p><a href="Controleurs/langue.php">Langues</a></p>
        <p><a href="Controleurs/codelettre.php">Code lettre</a></p>
        <p><a href="Controleurs/mot.php">Mot</a></p>
        <p><a href="Controleurs/motcode.php">Mot codes</a></p>
        <? include "base/footer.html"; ?>
	</body>
</html>