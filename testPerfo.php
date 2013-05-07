<?php
include 'dbconnect.php';
?>
<form action="testPerfo.php" method="post">
  <p>Votre mot :
    <input type="text" name="nom" />
  </p>
  <p>
    <input type="submit" value="OK" />
  </p>
</form>
<?php
if(isset($_POST['nom'])) 
{ 	
$nom = $_POST['nom']; 
	for ($i=0;$i<100;$i++)
	{
		$resultats=$con->query("SELECT * FROM Dictionnaire where mot='".$nom."'");
		$resultats->setFetchMode(PDO::FETCH_OBJ); // on dit qu'on veut que le résultat soit récupérable sous forme d'objet		
		while( $result = $resultats->fetch() ) 
		{
			$motRecupere=$result->mot;
			$resultats->closeCursor(); // on ferme le curseur des résultats
		}
	} 
	echo "Mot trouve dans le dictionnaire : ".$motRecupere.".<br /> Dictionnaire parcouru 100 fois<br />";
}
else 
{ 
	echo "Mot non trouve!"; 
} 