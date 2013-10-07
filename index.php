<?php

session_start();

include_once 'dbconnect.php';
include 'cheminsPerso.php';
include_once 'vue/base/header.php';


//On inclut le contrôleur s'il existe et s'il est spécifié
if (!empty($_GET['page']) && $_GET['page'] == 'receptionMotSpectacle')
{
		include 'vue/receptionMotSpectacle.php';
}
else if(!empty($_GET['zone']) && $_GET['zone'] == "admin" ){
	if(!empty($_GET['page']) && is_file('admin/'.$_GET['page'].'.php')){
		
		    include 'admin/'.$_GET['page'].'.php';
			}
	else{
		include 'admin/index.php';
	}
}

else if (!empty($_GET['page']) && is_file('controleurs/'.$_GET['page'].'.php'))
{
        include 'controleurs/'.$_GET['page'].'.php';
}
else
{
        include 'controleurs/recherche.php';
}

include "vue/base/footer.html";
?>