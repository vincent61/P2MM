<?php
include_once 'dbconnect.php';
include_once 'cheminsPerso.php';
<?php include 'Vue/base/header.php'; ?>


//On inclut le contrôleur s'il existe et s'il est spécifié
if (!empty($_GET['page']) && is_file('controleurs/'.$_GET['page'].'.php'))
{
        include 'controleurs/'.$_GET['page'].'.php';
}
else
{
        include 'controleurs/recherche.php';
}


?>