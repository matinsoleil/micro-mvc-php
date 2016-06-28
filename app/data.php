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
    public $type;
    
    public function __construct(app_redis $cache,app_hard $hard,app_soft $soft) {
  
 
    $this->cache = $cache;
    $this->hard = $hard;
    $this->soft = $soft;
    
    
    $data =   $this->hard->SCANING('data');

    
    
    //echo "<pre>";
    //var_dump($data);
    //echo "</pre>";
    
    
   // $variables = $this->hard->GET_ENTITY_VALUE('data.default','default');
    

    
    
   // $VALUE=$this->hard->GET_VALUE($variables,'simple');
    
   // echo '<pre>';
   // var_dump($VALUE);
   // echo '</pre>';
    
    // $variables = $this->hard->SET_VALUE($variables,'simple.hard','west');
    
    
     
     //$this->hard->SET_ENTITY_VALUE('data.default','default', $variables);
     
     
     //$this->hard->SET_ENTITY('data.gold.finger.cuper.radio.base');
     
    //$VALUE = array("simple"=>array("golden","silver","fate","cuper"));
    
    //$this->hard->SET_ENTITY_VALUE('data.gold.finger.cuper.radio.base', $VALUE); 
    
    
    $VALUE = $this->hard->GET_ENTITY_VALUE('data.gold.finger.cuper.radio.base');
     
    echo "<pre>";
    var_dump($VALUE);
    echo "</pre>";
    
     //$this->hard->SET_ENTITY('data.silver.coin.spanish');
     
    // $this->hard->DELETE_ENTITY('data.silver');
     
     
    // $this->soft->SET_ENTITY('sun.shine');
     
     
     //$this->soft->SET_ENTITY_VALUE('sun.shine',array('system'=>array("fire"=>"gun","water"=>"plate")),'system');
     
    // $this->soft->DELETE_ENTITY('sun.shine');
     
   $values = $this->soft->GET_ENTITY_VALUE('sun.shine');
     
   
   echo '<pre>';
   var_dump($values);
   echo '</pre>';
   
    }
    
  
    
    
    
    
    //put your code here
}
