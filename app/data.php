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
    public $dns;
    public $step;
    public $currentStep='';
            
    public function __construct(app_redis $cache,app_hard $hard,app_soft $soft,app_model $model,app_type $type,app_load $network,app_dns $dns) {
  
  
    $this->cache = $cache;
    $this->hard = $hard;
    $this->soft = $soft;
    $this->model = $model;
    $this->type = $type;
    $this->network = $network;
    $this->dns = $dns;
    
    
    $this->step = array();
  
    $data =   $this->hard->SCANING('data');

    
    
    
    
    
    //echo $this->network->NET['net']['object']['section']->IMAGINE();
    
    
    
    
    
    //echo "<pre>";
    //var_dump($data);
    //
    //
    //
    //echo "</pre>";
    

    
   $getMap = $this->hard->GET_ENTITY_VALUE('data.model.system.base'); 
  
   $stepName = '/';
  
   foreach($getMap as $key=>$step){
     
    foreach($step['state']['name'] as $name){
   
        if($this->dns->action==$name){
           
            $this->currentStep=$key;
            break;
        }      
    }          
       
   }
   
   
   if($this->currentStep==''){
       
      $this->step = $getMap[0];
       
   }else{
      $this->step = $getMap[$this->currentStep];
       
   }
   
   
 
 
   
   foreach($this->step['state'] as $key=>$properties){
       
      
        foreach($properties as $key=>$propertie){
            
           
            $this->step['state'][$key]= $propertie;
            
            
        }
   
       
   }
   
   foreach($this->step['dynamic'] as $key=>$actions){
       
        foreach($actions as $num=>$action){
            
              $this->step['dynamic'][$key][$num] = $this->hard->GET_ENTITY_VALUE($action);
            
        }
       
   }
   
   
   foreach($this->step['static'] as $key=>$statics){
       
        foreach($statics as $num=>$static){
            
              $this->step['static'][$key][$num] = $this->hard->GET_ENTITY_VALUE($static);
        }
       
   }
   
   
   echo "<pre>";
   var_dump($this->step['dynamic']['set']);
   echo "</pre>";
   
   $getModel = $this->hard->GET_ENTITY_VALUE($getMap[0]['dynamic']['actions'][0]);
   

   
   $getMath = $this->hard->GET_ENTITY_VALUE('data.model.math.general');
   
   $getSet = $this->hard->GET_ENTITY_VALUE($getMap[0]['dynamic']['set'][0]);
   
   $getSpace = $this->hard->GET_ENTITY_VALUE($getMap[0]['dynamic']['space'][0]);
   
   $result = $this->model->GET_LOGIC($getMath['equation']);
   
 
   
   
   $this->model->SET_VARIABLES($getSet);
   
   
   
   
   
   
   
   
   //$this->model->DIAGRAM($getMap);
    
   
   $variables_process = $this->model->IN_RULE($getModel['data'],$getSet);
   
   
   //echo "<pre>";
   //var_dump($this->model->false);
   //echo "</pre>";
   
   //echo "<pre>";
   //var_dump($variables_process);
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
    
    
  //  $VALUE = $this->hard->GET_ENTITY_VALUE('data.gold.finger.cuper.radio.base');
     
    //echo "<pre>";
    //var_dump($VALUE);
    //echo "</pre>";
    
  //  $NEW_VALUE=array('dagger'=>array("simple"=>"oil","hard"=>"carbon"));
    
  //  $this->hard->SET_ENTITY_VALUE('data.gold.finger.cuper.radio.base', $NEW_VALUE);
     //$this->hard->SET_ENTITY('data.silver.coin.spanish');
     
    // $this->hard->DELETE_ENTITY('data.silver');
     
     
    // $this->soft->SET_ENTITY('sun.shine');
   //$_id= $this->strToHex('su.sh.bo');
   
   //$_id= '00000000'.$_id;
   
   //echo strlen($_id);
   
   
     
   //$this->soft->SET_ENTITY_VALUE('sun.shine',array('_id' => new MongoId((string)$_id),"nick"=>"boticelli","data"=>array("text"=>"venus born")),'nick');
     
   //$this->soft->DELETE_ENTITY('sun.shine');
   
   //$this->soft->UPDATE_ENTITY_VALUE()
     
  // $values = $this->soft->GET_ENTITY_VALUE('sun.shine');
     
   
   //echo '<pre>';
   //var_dump($values);
   //echo '</pre>';
   
   
   //$this->soft->SEARCH_IN('sun.shine',array('nick','text'));
   
   //$val = $this->soft->SEARCH('sun.shine','golden');
   
   //echo "<pre>";
   //var_dump($val);
   //echo "</pre>";
   
   
   //$like = $this->soft->SEARCH_LIKE('sun.shine','nick','man');
   
   
   //echo '<br>';
   //var_dump($like);
   //echo '</br>';
   //$val = $this->soft->GET_VALUE($values,'golden');
   
   
   
   //$result=$this->soft->DELETE_VALUE('sun.shine',array('nick'=>'silverhouse'));
   
   //var_dump($result);
   
   
    }
    
  
    public function strToHex($string)
    {
    $hex='';
    for ($i=0; $i < strlen($string); $i++)
    {
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
    }
    
    public function hexToStr($hex)
{
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2)
    {
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}


public function _encode_string_array ($stringArray) {
    $s = strtr(base64_encode(addslashes(gzcompress(serialize($stringArray),9))), '+/=', '-_,');
    return $s;
}

public function _decode_string_array ($stringArray) {
    $s = unserialize(gzuncompress(stripslashes(base64_decode(strtr($stringArray, '-_,', '+/=')))));
    return $s;
}
    
    //put your code here
}
