<!doctype html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7" lang="en"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title>La separation</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="description" content="">
  <meta name="HandheldFriendly" content="True">

<style type="text/css">
body { background: #191510; color: #F1E9F0; }

::selection {
background: #F2F;
color: #FFF;
}

</style>

</head>
<body>

<h1>la séparation</h1>
<pre>DB: 
<?php 
$link = mysql_connect('vinvolcom.fatcowmysql.com', 'lasepa', 'TrDqnp6H'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
echo 'Connected successfully' . PHP_EOL;
mysql_select_db('laseparation'); 


$sql = "SHOW TABLES FROM `laseparation`";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables" . PHP_EOL;
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]}" . PHP_EOL;
}

mysql_free_result($result);

?> </pre> 