﻿<div id="wrapper">
<!-- end #header -->
<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
<script>
function deleteMotSpectacle(mot, cpt){
	 var pos=position["p"+(cpt-1)];
 var posy=position["p"+(cpt-1)]["y"];

 $.ajax({
 type: "POST",
 url: "controleurs/receptionMotSpectacle.php",
 data: {fmot:mot,fcpt:cpt}
 }).done(function( result ) {
// Decalage du tableau des positions pour que les mots ne bouge pas sur le client: Comme un mot est supprimer en base de données, les position sont décaler. pour eviter que tous les mots ne prenne la position du siuvant, on décale les valeurs des positions des mots suivant celui qui vient d'etre supprimé vers la gauche.
for(i=cpt;i<500;i++){
		position["p"+(i-1)]=position["p"+(i)];
	}
position ["p"+(cpt-1)]=pos;
 });

}
</script>

<?php
include 'modele/Managers/MotSpectacleManager.php';
$motSpectacleManager = new MotSpectacleManager($con);
$result = $motSpectacleManager->getAll();

?>
<div id="content" > 
<form action="index.php" target="_blank">
<input type="hidden" name="page" value="ajoutMotSpectacle">
<input type="submit" value="INTERFACE D'AJOUT" />
</form>
  <script> var compteur=0;</script>
  <?php
$cpt=0;
foreach($result as $mots){ 
$cpt++;
 //echo "<p id='p".$cpt."'>".$mots['mot']." <a href='../controleurs/receptionMotSpectacle.php?deleteMot=".$mots['mot']."'><img src='../vue/ressources/supprimeBlanc.png' height='20' width='20' /></a></p>"; 
 echo "<p id='p".$cpt."' draggable=\"true\" ondragstart=\"drag(event)\" ondragend=\"drop(event)\" onClick=\"play(".$cpt.");\" >".$mots['mot']." <a  href='javascript:deleteMotSpectacle(\"".$mots['mot']."\",\"".$cpt."\"); 
'><img src='vue/ressources/supprimeBlanc.png' height='20' width='20'  /></a></p>"; 


 echo "<script>compteur++;</script>";
}
?>
<script>
function drag(ev)
{

}

function drop(ev)
{

	event = event || window.event;
     position[ev.target.id]["x"]=event.clientY-110;
	 position[ev.target.id]["y"]=event.clientX+20;
}

function play(cpt)
{
	mot= document.getElementById('p'+cpt).firstChild.data;
	getMotsSpectacleCompatible(mot,cpt);
}


function getMotsSpectacleCompatible(mot,cpt){
casse=1;
type_recherche=0;
 $.ajax({
 type: "POST",
 url: "index.php?page=interroSpectacle",
 data: {fmot:mot,fcasse:casse,ftype_recherche:type_recherche}
 }).done(function( result) {
	//alert (motsComp[0]["compatible"]);
	//alert(result);
document.getElementById('p'+cpt).firstChild.data=result;
 });

}
</script>

</div>
<div id="msg" ></div>
