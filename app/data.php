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
    
    
    //var_dump($value);
    
    $VALUE=$this->hard->GET_VALUE($variables,'simple');
    
    var_dump($VALUE);
    
    
    }
    
  
    
    
    
    
    //put your code here
}
