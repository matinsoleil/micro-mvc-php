<?php
include('data.php');
class entity extends data {
    public $net;
    public $data;
    function __construct($net) {
    $this->net = $net;

    $this->startDataBase();

    //$variables=$this->GET_VARIABLE("variable");
    
    $values=array('value:default'=>'sample','value:standard'=>'sample');
    
    $collection='variable';
    $entity='sample';
    $attribute='sample';
    
    //$result=$this->SET_EAV($collection, $entity, $attribute, $values);
    
    //$result = $this->GET_EAV($collection, $entity, $attribute);
    
    //$result = $this->SET_VARIABLE('number','Number','number');
    
  
   // $number = $this->GET_VARIABLE('number');
    
    
    
    
    //$databases = $this->GET_COLLECTION();
    
    
    
    $this->net['action']->data = array("number"=>$result);
    
    
    
     //array('databases'=>$databases,'soft'=>$this->mongoActive);
    
    

    }
   
}
