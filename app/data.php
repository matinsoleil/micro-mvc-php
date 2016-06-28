<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of data
 *
 * @author aromerov
 */
class app_data {
    
    public $data;
    public $cache;
    public $hard;
    
    public function __construct(app_redis $cache,app_json $json,app_hard $hard) {
  
    $this->data = $json;
    $this->cache = $cache;
    $this->hard = $hard;
    
    
    
    $data =   $this->hard->SCANING('data');

    
    
    //echo "<pre>";
    //var_dump($data);
    //echo "</pre>";
    
    
    $variables = $this->hard->GET_VARIABLE_VALUE('data.default','default');
    

    
    
    $VALUE=$this->hard->GET_VALUE($variables,'simple');
    
    echo '<pre>';
    var_dump($VALUE);
    echo '</pre>';
    
     $variables = $this->hard->SET_VALUE($variables,'simple.hard','west');
    
    
     
     $this->hard->SET_VARIABLE_VALUE('data.default','default', $variables);
     
     
     $this->hard->SET_ENTITY('data.gold');
     
     //$this->hard->SET_ENTITY('data.silver.coin.spanish');
     
     $this->hard->DELETE_ENTITY('data.silver');
     
     
    }
    
  
    
    
    
    
    //put your code here
}
