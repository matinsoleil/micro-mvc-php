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
    public $simple;
    
    public function __construct(app_redis $cache,app_json $json,app_simple $simple) {
  
    $this->data = $json;
    $this->cache = $cache;
    $this->simple = $simple;
    
    
    
    $this->simple->WRITE_ENTITY('data.heaven.enter.numbers');
    
    
    $this->simple->WRITE_ENTITY_VALUE('data.heaven.enter.numbers','como');

    //$this->getData('css');

    $VALUE = $this->simple->READ_ENTITY_VALUE('data.heaven.enter.numbers','como');
    
    //var_dump($VALUE);
    
    
    
    $this->simple->DELETE_ENTITY('data.heaven.enter');
    
    //$this->Write('css',array('simple.css',"grand.css")); 
    
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
    
    
    public function Write($variable,$value,$ENTITY='default.theme.summer.summer',$ENTITY_TYPE='variable.macro.variable.master.variable.macros'){
        
        
        $this->data->WRITE($variable, $value,$ENTITY,$ENTITY_TYPE);
        
        
        
    }
    
    
    
    
    //put your code here
}
