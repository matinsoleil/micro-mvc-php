<?php
include('data.php');

class model extends data
{
public $entity;
public $net;
public $data;
public $attribute;
public $variable;

function __construct($net) {
$this->net = $net;
$this->startDataBase();
$this->entity=array("entity"=>array("system"=>array("attribute"=>array("version"=>array("name"=>"factory","num"=>"0.0")))));
$this->net['action']->data=array("id"=>"2","response"=>"true");
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
