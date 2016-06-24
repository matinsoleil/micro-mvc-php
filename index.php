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

$JSON = new app_json();

$HARD = new app_hard();


$DATA = new app_data($CACHE,$JSON,$HARD);





$HTML = new app_html($CORE,$DATA);







?>
