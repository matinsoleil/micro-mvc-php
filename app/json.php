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
class app_json {
    
    public $hash;
    public $baseURL;
    public $dataSet = array();
    public $dataVariable = array();
    public $dataValue = array();
    public $files = array();
    public $key = array();
    public $types = array();
    public $pool = array();
    public $lastPool = array();
    
    //put your code here
    public function __construct($string = '0000000') {
  
    }
    
    
    public function getSET($path){
        
        if(!isset($this->dataSet[$path])){
        $this->getDataPath($path);
        }
        
        
        return $this->dataSet[$path];
        
    }
    
    
    public function clearSET($path){
        
        if(isset($this->dataSet[$path])){
        unset($this->dataSet[$path]);
         return TRUE;
        }else{
         return FALSE;   
        }
        
    }
    
    
    public function getDataPath($path) {
        
        
        if (file_exists('./'.$path)) {
       
            $files =  scandir($path);
      
            foreach($files as $file){
                
                if($file!=='.' && $file!=='..'){
       
                if (strpos($file, '.json') !== FALSE){
                    
                    $stringPart ="";
                    
                    $this->files[$file][]=$path;
                    
                    $parts = explode('/',$path);
       
                    foreach($parts as $part){
                        
                        $stringPart .="['".$part."']";
                        
                    }
                    
                    
                    $dataJson = $this->Open($path,$file);
                    
                    
                    $fileName = explode(".",$file);
                   

                    $stringPart = $stringPart."['".$fileName[0]."'] = \$dataJson;";
                    
                    $codeValue = '$this->dataSet'.$stringPart;
                    
                    
                    eval($codeValue);
     
                }else{
                    
       
                    $this->getDataPath($path.'/'.$file);
                    
                    
                }
                    
                
                }
            }
             
        }else{
            echo "NOT";
        }
        
        
    }    
    
    
  public function getDataVariable($path) {
        
        
        if (file_exists('./'.$path)) {
       
            $files =  scandir($path);
      
            foreach($files as $file){
                
                if($file!=='.' && $file!=='..'){
       
                if (strpos($file, '.json') !== FALSE){
                    
                    $stringPart ="";
                    
                    $this->files[$file][]=$path;
                    
                    $parts = explode('/',$path);
       
                    foreach($parts as $part){
                        
                        $stringPart .="['".$part."']";
                        
                    }
                    
                    
                    $dataJson = $this->Open($path,$file);
                    
                    
                    $fileName = explode(".",$file);
                   

                    $stringPart = $stringPart."['".$fileName[0]."'] = \$dataJson;";
                    
                    $codeValue = '$this->dataVariable'.$stringPart;
                    
                    
                    eval($codeValue);
     
                }else{
                    
       
                    $this->getDataPath($path.'/'.$file);
                    
                    
                }
                    
                
                }
            }
             
        }else{
            echo "NOT";
        }
        
        
    }        
    
    public function Open($path,$file){
        
            
         $string = file_get_contents( $path."/".$file);

         $JSON = json_decode($string, true);
         return $JSON;
    
    }
    
    
    public function Type($variable,$VARIABLES=NULL,$POOL=NULL){
        
      if($VARIABLES==NULL){  
      $VARIABLES = $this->getSET('behaivor');
      }
      
      foreach($VARIABLES['variable'] as $KEY_POOL=>$VARIABLES_POOL){
          
       
          
          if(isset($VARIABLES_POOL[$variable])){
              
            
              if($POOL==NULL){
              $this->pool[$variable][]=$KEY_POOL;
              }else{
              $this->pool[$variable][]=$KEY_POOL;    
              }
                      
              echo $VARIABLES_POOL[$variable]['type'];
              
          }
          
          if(is_array($VARIABLES_POOL)){
              
              
              if(isset($VARIABLES_POOL['variable']))
              {
                  
                  
                  //var_dump($VARIABLES_POOL['variable']);
                  
                  $this->Type($variable,$VARIABLES_POOL,$KEY_POOL);
              }
            
              
          }
         
          
      }
     
      
      
      //return $VARIABLES["variable"][$entity][$variable]['type'];
      
   
        
        
    }
    
    
    public function POOL(){
        
        
        
    }
    
    
    public function Variable($SET,$variable){
        
        $this->Get($SET,$variable);
        
        return $this->key[$variable];
        
    }
    
    
    
    public function Get($SET,$variable,$KEY=''){
        
   
      foreach($SET as $key=>$set){
   
             if($key===$variable){
                 
                   $this->key[$variable][] = $KEY;   
                 
             }
             else{
                 
                 if(is_array($set)){
                   if($KEY!==''){  
                   $KEY = $KEY.'.'.$key;  
                   }else{
                   $KEY = $key;    
                   }
                   
                   $this->Get($set,$variable,$KEY);  
                     
                 }
   
             }
          
      }
        
    }
    
    
    public function Write($variable,$value){
        
    }
    
    
}
