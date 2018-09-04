<?php
include('data.php');
class entity extends data {
    public $net;
    public $data;
    function __construct($net) {
    $this->net = $net;

    $this->startDataBase();

    $variables=$this->GET_VARIABLE("variable");
    
    
    
               //$this->SET_VARIABLE($entity, $variables);
    
    //$databases = $this->GET_COLLECTION();
    
    $this->net['action']->data = array("master"=>"help");
      
     //array('databases'=>$databases,'soft'=>$this->mongoActive);
    
    

    }
   
}
