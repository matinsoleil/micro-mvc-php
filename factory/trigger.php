<?php
include('data.php');

class trigger extends data
{
public $entity;
public $net;
public $data;

function __construct($net) {
$this->net = $net;
$this->net['action']->data=array("id"=>"1","response"=>"true");
$this->entity="match";
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
