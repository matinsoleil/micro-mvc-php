<?php
include('data.php');

class variable extends data
{
public $entity;
public $net;
function __construct($net) {
$this->net = $net;
$this->startDataBase();
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
