<head>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Séparation</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="../Vue/base/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="menu-wrapper">
  <div id="menu">
  <ul>
    <li class="current_page_item"> <a href="../Vue/recherche.php">Recherche</a></li>
    <li><a href="../Vue/admin.php">Admin</a></li>
    <li><a href="../Controleurs/receptionMotSpectacle.php">Spectacle</a></li>
    </div>
  </ul>
  <!-- end #menu --> 
</div>
</div>
<div id="wrapper">
<!-- end #header -->

<?php
include '../dbconnect.php';
include '../Modele/Managers/MotSpectacleManager.php';
$motSpectacleManager = new MotSpectacleManager($con);
$result = $motSpectacleManager->getAll();

?>
<div id="content"> 
<form action="../Controleurs/ajoutMotSpectacle.php" target="_blank">
<input type="submit" value="INTERFACE D'AJOUT" />
</form>
  <script> var compteur=0;</script>
  <?php
$cpt=0;
foreach($result as $mots){ 
$cpt++;
 echo "<p id='p".$cpt."'>".$mots['mot']." <a href='../Controleurs/receptionMotSpectacle.php?deleteMot=".$mots['mot']."'><img src='../Vue/ressources/supprimeBlanc.png' height='20' width='20' /></a></p>"; 
 echo "<script>compteur++;</script>";
}
?>
</div>
</html>
