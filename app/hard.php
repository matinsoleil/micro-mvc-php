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
    public $subEntity = array();
    
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
    
    
    
    public function SET_VARIABLE_VALUE($ENTITY,$VARIABLE,$VALUE){
        
        $PATH = $this->ENTITY_TO_PATH($ENTITY);
        
        $PATH_FILE =$PATH.'/'.$VARIABLE.'.json';        
        
        $this->SAVE($PATH_FILE, $VALUE);
        
    }
    
    
    public function DELETE_VARIABLE_VALUE($ENTITY,$VARIABLE){
        
        $PATH = $this->ENTITY_TO_PATH($ENTITY);
        
        $PATH_FILE =$PATH.'/'.$VARIABLE.'.json';        
        
        $this->DELETE($PATH_FILE);
        
    }
    
    
    public function SET_VALUE($VARIABLE,$SUB_ENTITY,$VALUE){  
    
         $string_array = str_replace('.','"]["',$SUB_ENTITY);
   
         eval('$VARIABLE["'.$string_array.'"]=$VALUE;');
                 
         return $VARIABLE;
        
    }
    
  
    
    
    public function GET_VALUE($VARIABLE,$NAME){
        
        $values = $this->VALUE($VARIABLE,$NAME); 
        
     
        
        $VALUE = array();
        
        foreach($values as $key=>$val){

            
            if($key==$NAME){
                
                $VALUE[$key]=$val;
                
            }
  
        } 
        
        
        return $VALUE;
        
    }
    
    
    public function VALUE($VARIABLE){
    
        $this->SUB_ENTITY($VARIABLE);
        
        $subEntities = $this->subEntity;
        
        $this->subEntity=array();
        
        return $subEntities;
        
        
    }
    
    public function SUB_ENTITY($VARIABLE,$KEY=''){
        
        foreach($VARIABLE as $key=>$value){
            
       
            if(is_array($value)){
                if($KEY!=''){
                $_KEY = $KEY.'.'.$key;
                }else{
                $_KEY =$key;    
                }
                $this->subEntity[$_KEY]=$value;
                $this->SUB_ENTITY($value,$_KEY);
            }else{
                
                if($KEY!=''){
                $_KEY = $KEY.'.'.$key;
                }else{
                $_KEY =$key;    
                }
                $this->subEntity[$_KEY]=$value;
                
                
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
    
    public function DELETE($PATH){
        
        
    }
   
   
   
    
       
}
