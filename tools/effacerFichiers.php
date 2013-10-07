<?php
$dossier_traite = "../Fichiers/Recherches";
  
$repertoire = opendir($dossier_traite); // On d�finit le r�pertoire dans lequel on souhaite travailler.
  
while (false !== ($fichier = readdir($repertoire))) // On lit chaque fichier du r�pertoire dans la boucle.
{
$chemin = $dossier_traite."/".$fichier; // On d�finit le chemin du fichier � effacer.
  
// Si le fichier n'est pas un r�pertoire�
if ($fichier != ".." AND $fichier != "." AND !is_dir($fichier))
       {
       unlink($chemin); // On efface.
       }
}
closedir($repertoire); // Ne pas oublier de fermer le dossier ***EN DEHORS de la boucle*** ! Ce qui �vitera � PHP beaucoup de calculs et des probl�mes li�s � l'ouverture du dossier.
?>