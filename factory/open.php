<?php
include('data.php');
require 'vendor/autoload.php';
class open extends data
{
public $entity;
public $net;
public $data;
public $attribute;
public $variable;

function __construct($net) {

    $this->startDataBase();
    
$this->net = $net;

$mongo = $this->CLIENT();

//$dataBase=$mongo->macrocomer->store->insertOne(array("user"=>"11111","id"=>"11111"));

//var_dump($dataBase);

//die();
$storage = new OAuth2\Storage\Mongo($mongo);

$client_id = "user.admin.user";
$client_secret= "111111111111";
$redirect_uri = "redirect";
$storage->setClientDetails($client_id, $client_secret, $redirect_uri);
//die();


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
