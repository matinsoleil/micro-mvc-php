<?php
include('data.php');
require 'vendor/autoload.php';
class closed extends data
{
public $entity;
public $net;
public $data;
public $attribute;
public $variable;

function __construct($net) {

$this->net = $net;

$this->net['action']->data=array("closed"=>"true","response"=>"true");

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
