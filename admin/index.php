<?php

/*session_unset ();  
// On d�truit notre session
session_destroy (); */

if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) { 
 
include 'vue/admin.php';}
else {

include "accesinterdit.php";
};
?>