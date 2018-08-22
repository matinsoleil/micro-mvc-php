<?php
include('data.php');
class entity extends data {
    public $net;
    public $data;
    function __construct($net) {
    $this->net = $net;

    $this->startDataBase();

    //$databases = $this->GET_COLLECTION();
    
    $this->net['action']->data = array();
      
     //array('databases'=>$databases,'soft'=>$this->mongoActive);
    
    

    }
   
}
