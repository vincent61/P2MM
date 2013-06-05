<?php 
$link = mysql_connect('vinvolcom.fatcowmysql.com', 'lasepa', 'TrDqnp6H'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
echo 'Connected successfully' . PHP_EOL;
mysql_select_db('laseparation'); 

$creation = " CREATE TABLE laseparation.Police
( 
police Varchar(50) Primary key,
fichierCode Varchar(100) NOT NULL,
casse Boolean NOT NULL
);

CREATE TABLE laseparation.Langue
(
langue Varchar(30) Primary key
);

CREATE TABLE laseparation.CodeLettre
(
code Varchar(3) binary,
typeLettre int,
police Varchar(50),
Foreign Key(police)References Police(police) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT pk_CodeLettre PRIMARY KEY (code, police)
);


CREATE TABLE laseparation.Lettre
(
lettreAscii Varchar(1) Primary key
);

CREATE TABLE laseparation.CorrespondanceLettre
(
lettreAscii Varchar(1) binary ,
code Varchar(3) binary,
police Varchar(50),
Foreign Key (lettreAscii) References Lettre(lettreAscii) ON DELETE CASCADE ON UPDATE CASCADE,
Foreign Key (code, police) References CodeLettre(code, police) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT pk_CorrespondanceLettre PRIMARY KEY (lettreAscii,code, police)
);


CREATE TABLE laseparation.MotCode
(
code Varchar(90) binary,
police varchar(50),
Foreign Key(police) References Police(police) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT pk_MotCode PRIMARY KEY(code, police)
);


CREATE TABLE laseparation.Dictionnaire
(
dictionnaire Varchar(50) Primary key,
langue Varchar (50),
fichierDictionnaire Varchar(100) NOT NULL,
casse Boolean NOT NULL,
statut Varchar (20) NOT NULL DEFAULT 'noncharge',
Foreign Key(langue) References Langue(langue) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE laseparation.Mot
(
mot Varchar(30) binary primary key, 
casse Boolean NOT NULL, 
dictionnaire Varchar(50), 
frequence float NOT NULL,
Foreign Key(dictionnaire) References Dictionnaire(dictionnaire) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE laseparation.CorrespondanceMot
(
mot Varchar(30) binary NOT NULL, 
motCode Varchar(90) binary NOT NULL, 
police Varchar(50) NOT NULL,
Foreign Key(mot) References Mot(mot) ON DELETE CASCADE ON UPDATE CASCADE,
Foreign Key(motCode, police) References MotCode(code, police) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT pk_CorrespondanceMot PRIMARY KEY (mot, motCode, police)
);



CREATE TABLE laseparation.MotSpectacle (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`mot` VARCHAR( 30 ) NOT NULL
) ;
";
$tables = mysql_query($creation);
if (!$tables) {
    echo "DB Error, could not list tables" . PHP_EOL;
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
$sql = "SHOW TABLES FROM `laseparation`";
$result = mysql_query($sql);
if (!$result) {
    echo "DB Error, could not list tables" . PHP_EOL;
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]}" . PHP_EOL;
}

mysql_free_result($result);
?>