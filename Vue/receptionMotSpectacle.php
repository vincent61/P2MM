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
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
function deleteMotSpectacle(mot, cpt){
	 var pos=position["p"+(cpt-1)];
 var posy=position["p"+(cpt-1)]["y"];

 $.ajax({
 type: "POST",
 url: "../Controleurs/receptionMotSpectacle.php",
 data: {fmot:mot,fcpt:cpt}
 }).done(function( result ) {
//alert  (position["p"+(cpt+1)]["x"]+" "+position["p"+(cpt+1)]["y"]);

for(i=cpt;i<500;i++){
		position["p"+(i-1)]=position["p"+(i)];
	}
//alert  (position["p"+(cpt)]["x"]+" "+position["p"+(cpt)]["y"]);
position ["p"+(cpt-1)]=pos;

	//alert('hehe');
 });

}
</script>

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
 //echo "<p id='p".$cpt."'>".$mots['mot']." <a href='../Controleurs/receptionMotSpectacle.php?deleteMot=".$mots['mot']."'><img src='../Vue/ressources/supprimeBlanc.png' height='20' width='20' /></a></p>"; 
 echo "<p id='p".$cpt."'>".$mots['mot']." <a href='javascript:deleteMotSpectacle(\"".$mots['mot']."\",\"".$cpt."\");
'><img src='../Vue/ressources/supprimeBlanc.png' height='20' width='20' /></a></p>"; 


 echo "<script>compteur++;</script>";
}
?>
</div>
<div id="msg"></div>

</html>