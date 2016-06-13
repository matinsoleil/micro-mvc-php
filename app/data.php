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
    
    public function __construct(app_redis $cache,app_json $json) {
  
    $this->data = $json;
    $this->cache = $cache;
    
    

    $this->getData('css');

    
    $this->Write('css',array('new.css')); 
    
    }
    
    public function getData($variable,$ENTITY='default.main'){
        
        
    $entity = 'data';
    

    
    //$TYPES = $this->data->TYPE($variable,$ENTITY);
    
    
    
    
    //echo "<pre>";
    //var_dump($TYPES[$NUM]);
    //echo "</pre>";
    
    
    $VARIALBLES = $this->data->VARIABLE($variable,$ENTITY);
    
    
    //echo "<pre>";
    //var_dump($VARIALBLES[$ENTITY]);
    //echo "</pre>";
    
    
    
    
    
    
    }
    
    
    public function Write($variable,$value,$ENTITY='default.main',$ENTITY_TYPE='variable.base'){
        
        
        $this->data->WRITE($variable, $value,$ENTITY,$ENTITY_TYPE);
        
        
        
    }
    
    
    
    
    //put your code here
}
