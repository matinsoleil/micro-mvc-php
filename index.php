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

$TYPE = new app_type();


$DATA = new app_data($CACHE,$HARD,$SOFT,$MODEL,$TYPE);





$ACTION = new app_action($CORE,$DATA);







?>
