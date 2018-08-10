<?php
class factory
{
public $entity;
public $net=array();
public $set=array();
public $action;
function __construct($action,$entity) {


$this->net['action']=$action;

$entities = explode('.',$entity);
foreach($entities as $key=>$entity){
include('./factory/'.$entity.'.php');
$this->set[$key]=$entity;
eval('$this->net["'.$entity.'"]= new '.$entity.'($this->net);');
}

$this->follow();

}

function follow(){



}

}
?>
