<?php
include('data.php');

class observer extends data
{
public $entity;
public $net;
function __construct($net) {
$this->net = $net;
$this->entity="match";
$attribute = $this->net['system']->attribute;

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
