<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

header('ETag:"123456789"');

foreach (glob("./*/*.php") as $filename)
{
include $filename;
}


$CORE = new app_core();

$CACHE = new app_redis();


$HARD = new app_hard();

$SOFT = new app_soft();

$MODEL = new app_model();

$DATA = new app_data($CACHE,$HARD,$SOFT);





$HTML = new app_html($CORE,$DATA);







?>
