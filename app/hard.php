<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of json
 *
 * @author aromerov
 */
class app_hard {
    
    public $hash;
    public $scan=array();
    public $data=array();
    public $value = array();
    
    //put your code here
    public function __construct($string = '0000000') {
  
    $this->hash = $string;     
        
    }
    
    
    public function ENTITY_TO_PATH($ENTITY){
        
        
        $PATH = str_replace('.','/',$ENTITY);
        
        $PATH = './'.$PATH;
        
        return $PATH;
        
    }
    
    
    public function GET_VARIABLE_VALUE($ENTITY,$VARIABLE){
        
        $PATH = $this->ENTITY_TO_PATH($ENTITY);
        
        $PATH_FILE =$PATH.'/'.$VARIABLE.'.json';
        
        $VALUE = $this->OPEN($PATH_FILE);
        
        return $VALUE;
    }
    
    
    public function GET_VALUE($VARIABLE,$NAME){
        
        $this->VALUE($VARIABLE,$NAME);    
        
        $VALUE = $this->value;
        
        $this->value = array();
        
        return $VALUE;
        
    }
    
    
    public function VALUE($VARIABLE,$NAME){
    
        foreach($VARIABLE as $KEY=>$VAR){
            
            if($KEY==$NAME){
               
                $value = $this->value;
                
                array_push($value,$VAR);
                
                $this->value=$value;
                
            }
            
            if(is_array($VAR)){
                $this->VALUE($VAR,$NAME);
            }
            
        }
        
    }
    
    
    public function SCANING($PATH){
        
    $this->SCAN($PATH);
    
    $SCANING= $this->scan;
    
    $this->scan = array();
    
    return $SCANING;
    
    }
    
    
    public function SCAN($PATH){  
               
    $FILES = scandir($PATH);
    
    $_IN_FILES = array();
    
    foreach($FILES as $file){
        
        if(is_dir($PATH.'/'.$file)){
            
          
            if( $file !== "." && $file !== ".."){
                
                 $PATH_NEXT=$PATH."/".$file;
                
                 $_ENTITY = str_replace('/','.',$PATH_NEXT);
                 
                 $this->scan[$_ENTITY]=1;
                
                 $this->SCAN_ENTITY($PATH_NEXT);
                
            }
        }else{
            
           $_PATH = str_replace('/','.',$PATH);
          
                if(isset($this->scan[$_PATH])){
                     $files = $this->scan[$_PATH];
                     
                     if(is_array($files)){
                         
                         array_push($files,$file);
                         $this->scan[$_PATH]=$files;
                         
                     }else{
                        $this->scan[$_PATH]=array($file); 
                     }
                     
                    
                }else{
                    $this->scan[$_PATH]=array($file);
                }        
        }
        
    }
  
      
    
    } 
    
    
    public function SCAN_ENTITY($PATH){
        
        $this->SCAN($PATH); 
        
        $SCAN = $this->scan;
          
        $SCAN_VALUES = $this->SCAN_VALUES($SCAN);
 
        return $SCAN_VALUES;
      
    }
    
    
    public function SCAN_VALUES($SCAN){
       
       $_IN_SCAN = array();
       
       
       foreach($SCAN as $key=>$entities){
           
   
            $PATH = str_replace(".","/",$key);
            $FILES = scandir('./'.$PATH);
     
            
            $files = array();
          foreach($FILES as $file){    
              if(!is_dir($PATH.'/'.$file)){
                   if( $file !== "." && $file !== ".."){
            
               array_push($files,$file);
                
                    }
              }
                
          }
            
          $_IN_SCAN[$key]=$files;
    
       }
       
       
       return $_IN_SCAN;
       
   } 
   
   
    public function OPEN($PATH){
        
    if(file_exists($PATH))    
    {
    $string = file_get_contents($PATH);
    $JSON = json_decode($string, true);
    return $JSON;
    }else{
    return array();    
    }
    }
    
    
    public function SAVE($PATH,$ARRAY){
        
    $CONTENT = json_encode($ARRAY,JSON_PRETTY_PRINT);        
    file_put_contents($PATH, $CONTENT);
        
    }
   
   
   
    
       
}
