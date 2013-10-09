<?php

if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) { 
 
include 'vue/admin.php';}
else {

include "accesinterdit.php";
};
?>