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
    public $dataValue = array();
    public $files = array();
    public $key = array();
    
    //put your code here
    public function __construct($string = '0000000') {
  
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
    
    
    public function Open($path,$file){
        
            
         $string = file_get_contents( $path."/".$file);

         $JSON = json_decode($string, true);
         return $JSON;
    
    }
    
    
    public function Type($variable){
        
        
        
        
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
