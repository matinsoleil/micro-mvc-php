<?php
include('data.php');
class entity extends data {
    public $net;
    public $data;
    function __construct($net) {
    $this->net = $net;

    $this->startDataBase();

    $this->GET_VARIABLE();
    
    //$databases = $this->GET_COLLECTION();
    
    $this->net['action']->data = array("master"=>"help");
      
     //array('databases'=>$databases,'soft'=>$this->mongoActive);
    
    

    }
   
}
