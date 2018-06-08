<?php
class factory
{
public $entity;
public $net;
public $set=array();
function __construct($net,$entity) {
$this->net=$net;
$entities = explode('.',$entity);
foreach($entities as $key=>$entity){
include('./factory/'.$entity.'.php');
$this->set[$key]=$entity;
eval('$this->'.$entity.'= new '.$entity.'($net);');
}

$this->follow();

}

function follow(){



}

}
?>
