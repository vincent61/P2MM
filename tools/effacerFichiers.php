<?php
$dossier_traite = "../Fichiers/Recherches";
  
$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
  
while (false !== ($fichier = readdir($repertoire))) // On lit chaque fichier du répertoire dans la boucle.
{
$chemin = $dossier_traite."/".$fichier; // On définit le chemin du fichier à effacer.
  
// Si le fichier n'est pas un répertoire…
if ($fichier != ".." AND $fichier != "." AND !is_dir($fichier))
       {
       unlink($chemin); // On efface.
       }
}
closedir($repertoire); // Ne pas oublier de fermer le dossier ***EN DEHORS de la boucle*** ! Ce qui évitera à PHP beaucoup de calculs et des problèmes liés à l'ouverture du dossier.
?>