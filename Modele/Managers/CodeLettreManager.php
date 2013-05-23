<?php
include '../Modele/ModeleMemoire/CodeLettre.php';

class CodeLettreManager{
	private $_db; // Instance de db
 
  public function __construct($db)
  {
    $this->setDb($db);
  }
 
  public function add($codeLettre)
  {
	if($codeLettre instanceof CodeLettre){
	$q = $this->_db->query('SELECT code FROM CodeLettre WHERE code = \''.$codeLettre->getCode().'\' AND police = \'' .$codeLettre->getPolice() .'\';');
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		if($donnees['code'])
		{
			echo "Le codeLettre existe déja.";
		}
		else{
			$this->_db->exec('INSERT INTO CodeLettre(code, typeLettre, police) VALUES (\''.$codeLettre->getCode().'\', '.$codeLettre->getTypeLettre().', \''.$codeLettre->getPolice().'\');');
		}
	}
	else
		throw new Exception('Type reçu erroné.');
  }
 
  public function delete($cd, $pol)
  {
	$code = (String) $cd;
	$police = (String) $pol;
	$this->_db->exec('DELETE FROM CodeLettre WHERE code = \''.$code.'\' AND police = \'' .$police.'\';');
  }
 
  public function get($code, $police)
  { 
	$c = (String) $code;
	$p = (String) $police;
	$q = $this->_db->query('SELECT * FROM CodeLettre WHERE code = \''.$c.'\' AND police = \'' .$p .'\';');
	$donnees = $q->fetch(PDO::FETCH_ASSOC);
	return new CodeLettre($donnees['code'], $donnees['typeLettre'], $donnees['police']);
  }

  public function getListePolice()
  { 
	$q = $this->_db->prepare('SELECT * FROM police order by police;');
	$q->execute();
	$donnees = $q->fetchAll();
	//echo $donnees['police'];
	return $donnees;
  }
  
 
  public function update($codeLettre, $newCodeLettre)
  {  
	if($codeLettre instanceof CodeLettre && $newCodeLettre instanceof CodeLettre){
		$this->_db->exec('UPDATE CodeLettre SET code = \''.$newCodeLettre->getCode().'\', typeLettre = \''.$newCodeLettre->getTypeLettre().'\', police = \''.$newCodeLettre->getPolice().'\' WHERE code = \''.$codeLettre->getCode().'\' AND police = \'' .$codeLettre->getPolice() .'\';');
	}else
	   throw new Exception('Type reçu erroné.');
  }
 
     public function getAll()
  {
    $q=$this->_db->prepare("SELECT code, typeLettre, police FROM CodeLettre ORDER BY  'code'");
	$q->execute();
    $donnees = $q->fetchAll();
    return $donnees;
  }
 
  public function setDb($db)
  {
    $this->_db = $db;
  }
}
?>