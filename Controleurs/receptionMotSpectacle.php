<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Document sans titre</title>
</head>
<script>
var position=new Array;
for (j=0;j<1000;j++){
var pos=new Array;
pos["x"]=Math.floor((Math.random()*500)+50);;
pos["y"]=Math.floor((Math.random()*800)+100);
pos["font"]=Math.floor((Math.random()*100)+10);
position["p"+j]=pos;
}
</script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
function getMotsSpectacle(){
 $.ajax({
 type: "POST",
 url: "../Vue/receptionMotSpectacle.php",
 data: {}
 }).done(function( result ) {
 $("#msg").html( result );
for(i=1;i<compteur+1;i++)
	{
	var x=document.getElementById("p"+i);
	  //alert(x.innerHTML);
	var element=document.getElementById("p"+i);
	 element.style.position = "fixed";
	  element.style.top = position["p"+i]["x"]+"px" ;
	  element.style.left = position["p"+i]["y"]+"px";
	  element.style.fontSize =position["p"+i]["font"]+"px";
	 element.style.color = "white";
	}
 });

}


</script>

<body>
<script language=javascript>
var int=self.setInterval(function(){getMotsSpectacle()},50);
</script>
<?php
include '../dbconnect.php';
include '../Modele/Managers/MotSpectacleManager.php';
$motSpectacleManager = new MotSpectacleManager($con);
//Gestion des supression
if(isset($_POST['fmot']) &&isset($_POST['fcpt'])){
/*	echo "<script>";
	echo "var cpt=".$_POST['fcpt']." ;";
	echo "alert (cpt);";
	echo "for(i=cpt;i<100;i++)";
	echo " {";
	echo "	 position[\"p\"+i]=position[\"p\"+i+1];";
	echo " }";
	
	echo "</script>";*/
	
	$motSpectacleManager->delete($_POST['fmot']);
}
if(isset($_GET['deleteMot'])){
	$motSpectacleManager->delete($_GET['deleteMot']);
}


$mots = $motSpectacleManager->getAll('frequence');
//include '../Vue/receptionMotSpectacle.php';

?>
<div id="msg"></div>
</body>
</html>