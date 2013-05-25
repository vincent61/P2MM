<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Document sans titre</title>
</head>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
function getMotSpectacle(){
 $.ajax({
 type: "POST",
 url: "../Vue/receptionMotSpectacle.php",
 data: {}
 }).done(function( result ) {
 $("#msg").html( result );
 });

}
</script>


<body>
<script language=javascript>
var int=self.setInterval(function(){getMotSpectacle()},1000);
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