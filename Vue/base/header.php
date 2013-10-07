<!DOCTYPE html>
<html>
<body>
<head>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Séparation</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="vue/base/style.css" rel="stylesheet" type="text/css" media="screen" />
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<script src="jQuery.js"></script>

</head>
<body>
<div id="menu-wrapper">
  <div id="menu">
  <ul>
    <li class="current_page_item"> <a href="index.php?page=recherche">Recherche</a></li>
    
	<?php if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
		?>
		<li><a href="index.php?zone=admin">Admin</a></li>
		<?php
		} 
		else {
 ?>
	<li><a href="authentification.php">Admin</a></li>
	<?php }
    ?>
    <li><a href="index.php?page=receptionMotSpectacle">Spectacle</a></li>
	<li><a href="deconnexion.php">Deconnexion</a></li>
    </div>
  </ul>
  <!-- end #menu --> 
</div>
<div id="header-wrapper">
  <div id="header">
    <div id="logo">
    <h1> </h1>
    <p> </p>
    <p><img class = "titreHaut" src="vue/ressources/titreHaut.png" width="331" height="34" alt="" /></p>
       <p><img class = "titreBas" src="vue/ressources/titreBas.png" width="331" height="34" alt="" /></p>
      <!--<h1><a href="#">Séparation</a></h1>-->
      <p>Procédé inventé par Pierre Fourny</p>
    </div>
  </div>
</div>
