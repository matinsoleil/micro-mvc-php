<?php
include('data.php');

class show extends data
{
public $entity;
public $net;
public $data;
public $attribute;
public $variable;
public $show;

function __construct($net) {
$this->net = $net;
$this->startDataBase();
$urls = $this->read();
var_dump($urls);
die();
$this->net['action']->data=array("urls"=>$urls);
$this->entity="match";
}


public function read($entity='url.cron'){

    $entity=str_replace('.','/',$entity);
    $str=file_get_contents("./".$entity.".json");
    $this->show=json_decode($str,true);
    return $this->show;
}


function setCollection(){}
function getCollection(){}
function popCollection(){}
function pushCollection(){}
function mergeCollection(){}
function shardCollection(){}
function getVariable(){}
function setVariable(){}
function getEntity(){}
function setEntity(){}
}

?>
