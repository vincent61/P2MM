﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Mot Spectacle</title>
</head>
<script>
//Au chargement de la page, le client génère la grille de placement des 1000 mots à venir (si tenté que 1000 mots vienne).
var position=new Array;
for (j=0;j<1000;j++){
var pos=new Array;
pos["x"]=Math.floor((Math.random()*500)+100);;
pos["y"]=Math.floor((Math.random()*1000)+50);
pos["font"]=Math.floor((Math.random()*100)+10);
position["p"+j]=pos;
}
</script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
function getMotsSpectacle(){
 $.ajax({
 type: "POST",
 url: "index.php?page=receptionMotSpectacle",
 data: {}
 }).done(function( result ) {
 $("#msg").html( result );
for(i=1;i<compteur+1;i++)
	{
	//On selectionne chaque mot affiché dans la fenêtre	
	var element=document.getElementById("p"+i);
	// On les replace en fonction de l'endroit donné par le client.
	 element.style.position = "fixed";
	  element.style.top = position["p"+i]["x"]+"px" ;
	  element.style.left = position["p"+i]["y"]+"px";
	  element.style.fontSize =position["p"+i]["font"]+"px";
	 element.style.color = "white";
	  element.style.fontFamily = "Demibas_2010";
	  //alert(element.style.fontFamily);
	}
 });

}


</script>

<body>
<script language=javascript>
var int=self.setInterval(function(){getMotsSpectacle()},1000);
//getMotsSpectacle();
</script>
<?php
include 'modele/Managers/MotSpectacleManager.php';
$motSpectacleManager = new MotSpectacleManager($con);
//Gestion des supression
if(isset($_POST['fmot']) && isset($_POST['fcpt'])){
	$motSpectacleManager->delete($_POST['fmot']);
}


$mots = $motSpectacleManager->getAll('frequence');



?>
<div id="msg"></div>
</body>
</html>