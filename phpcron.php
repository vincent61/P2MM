<?php
/*$output = shell_exec('crontab -l');
file_put_contents('./tmp/crontab.txt', $output.'* * * * * NEW_CRON'.PHP_EOL);
echo exec('crontab /tmp/crontab.txt');

$output = shell_exec('crontab -l');
echo $output;*/
$cron_file = 'cron_filename.txt';
// Create the file
touch($cron_file); 
// Make it writable
chmod($cron_file, 0777); 
// Save the cron
//file_put_contents($cron_file, 'MAILTO=guerrymaeva@gmail.com'.PHP_EOL); 
file_put_contents($cron_file, '08 22 4 7 * touch machin.txt >/dev/null'.PHP_EOL, FILE_APPEND); 
// Install the cron
echo "toto";
echo exec('crontab cron_filename.txt');
echo shell_exec('crontab -l');
?>