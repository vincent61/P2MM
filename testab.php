<?php

if(connection_aborted()){
$cron_file = 'test_filename.txt';
// Create the file
touch($cron_file); 
}


?>