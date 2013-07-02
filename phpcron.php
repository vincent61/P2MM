<?php $output = shell_exec('crontab -l');
echo $output;
?>