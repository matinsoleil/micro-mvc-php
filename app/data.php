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
     
    //echo "<pre>";
    //var_dump($VALUE);
    //echo "</pre>";
    
    $NEW_VALUE=array('dagger'=>array("simple"=>"oil","hard"=>"carbon"));
    
    $this->hard->SET_ENTITY_VALUE('data.gold.finger.cuper.radio.base', $NEW_VALUE);
     //$this->hard->SET_ENTITY('data.silver.coin.spanish');
     
    // $this->hard->DELETE_ENTITY('data.silver');
     
     
    // $this->soft->SET_ENTITY('sun.shine');
   $_id= $this->strToHex('su.sh.ni');
   
   $_id= '00000000'.$_id;
   
   echo strlen($_id);
   
   
     
   $this->soft->SET_ENTITY_VALUE('sun.shine',array('_id' => new MongoId((string)$_id),"nick"=>"Joehn","data"=>array("text"=>"notre dame of paris")),'nick');
     
   //$this->soft->DELETE_ENTITY('sun.shine');
   
   //$this->soft->UPDATE_ENTITY_VALUE()
     
   //$values = $this->soft->GET_ENTITY_VALUE('sun.shine');
     
   
   //echo '<pre>';
   //var_dump($values);
   //echo '</pre>';
   
   
   
   //$val = $this->soft->GET_VALUE($values,'golden');
   
   
   
   //echo "<pre>";
   //var_dump($val);
   //echo "</pre>";
   
   
   
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
