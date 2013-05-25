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
position[j]=pos;
}
</script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
function getMotSpectacle(){
 $.ajax({
 type: "POST",
 url: "../Vue/receptionMotSpectacle.php",
 data: {}
 }).done(function( result ) {
 $("#msg").html( result );
for(i=1;i<compteur+1;i++)
	{
	//var x=document.getElementById('nbElements');
	 // alert(x.innerHTML);
	
	var x=document.getElementById("p"+i);
	  //alert(x.innerHTML);
	var element=document.getElementById("p"+i);
	 element.style.position = "fixed";
	  element.style.top = position[i]["x"]+"px" ;
	  element.style.left = position[i]["y"]+"px";
	  element.style.fontSize =position[i]["font"]+"px";
	 element.style.color = "black";
	}

 });

}
</script>

<body>
<script language=javascript>
var int=self.setInterval(function(){getMotSpectacle()},50);
</script>
<input type="button" name="submit" id="submit" value="submit" onClick = "getMotSpectacle()" />
<?php
include '../dbconnect.php';
include '../Modele/Managers/MotSpectacleManager.php';
$motSpectacleManager = new MotSpectacleManager($con);
//Gestion des supression
if(isset($_GET['deleteMot'])){
	$motSpectacleManager->delete($_GET['deleteMot']);
}


$mots = $motSpectacleManager->getAll('frequence');
//include '../Vue/receptionMotSpectacle.php';

?>
<div id="msg"></div>
</body>
</html>