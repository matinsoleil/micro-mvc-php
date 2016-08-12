<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

header('ETag:"123456789"');

include('./app/load.php');

$LOAD = new app_load();


$CORE = new app_core();

$CACHE = new app_redis();


$HARD = new app_hard();

$SOFT = new app_soft();

$MODEL = new app_model();

$TYPE = new app_type();


$NETWORK = new app_load(0);


$DATA = new app_data($CACHE,$HARD,$SOFT,$MODEL,$TYPE,$NETWORK);






$ACTION = new app_action($CORE,$DATA);







?>
