<?php
$output = shell_exec('crontab -l');
file_put_contents('./tmp/crontab.txt', $output.'* * * * * NEW_CRON'.PHP_EOL);
echo exec('crontab /tmp/crontab.txt');

$output = shell_exec('crontab -l');
echo $output;
?>