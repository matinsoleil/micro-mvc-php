<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

foreach (glob("./*/*.php") as $filename)
{
include $filename;
}


$CORE = new app_core();

$CACHE = new app_redis();

$JSON = new app_json();


$JSON->getDataPath('data');


$HTML = new app_html($CORE);

$JSON->dataSet;





?>
