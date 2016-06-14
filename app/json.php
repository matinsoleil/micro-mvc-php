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
    public $type = array();
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
        
        $MEDIUM = explode('/',$path);
        
        $SET=$MEDIUM[0];
        
        
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
    
    public function Open($path,$file=NULL){
        
         if($file!=NULL){   
         $string = file_get_contents( $path."/".$file);
         }else{
          $string = file_get_contents( $path);
         }
         
         $JSON = json_decode($string, true);
         return $JSON;
    
    }
    
    
    
     
      
      
      //return $VARIABLES["variable"][$entity][$variable]['type'];
      
   
        
        
    
    
    
    public function TYPE($variable,$ENTITY){
    $TYPE = array();    
    $entity = 'behaivor';
    
    $SET = $this->getSET($entity);
   
    $variablesTypes = $this->Variables($entity,$SET,$variable);
    
    
    foreach($variablesTypes as $key=>$variableType){
        
       $pathType = explode('.',$variableType);
       
       $PATH='';
       
       
       foreach($pathType as $path){
           
       $PATH .='["'.$path.'"]';    
           
       }
       
 
     
       eval('$TYPE["'.$variableType.'"]=$SET'.$PATH.'["'.$variable.'"];');

       
    }
    
   
    
    $types = array();
    
  
    
    foreach($TYPE as $entities=>$type){
        
        
       foreach($type['entity'] as $typeEntity){
           
          if($typeEntity==$ENTITY){
             $types[$entities]=$type;
          }
           
       }
        
       
        
    }
    

    
    return $types;
        
    }
    
    
    public function VARIABLE($variable,$ENTITY){
        
        $entity = 'data';
        
        $VARIABLE = array();
        
        $SET = $this->getSET($entity);
   
  
        
        $setVariables = $this->Variables($entity,$SET,$variable);
        
        
        
        foreach($setVariables as $variables){
            
         
            
            if($variables==$ENTITY){
            
            $setEntity =  explode(".",$variables);
            
            $PATH='';
           
            foreach($setEntity as $set){
               
            $PATH .= '["'.$set.'"]';
               
            }
            eval('$VARIABLE["'.$ENTITY.'"]=$SET'.$PATH.'["'.$variable.'"];');
            
            }
           
           
            
        }
    
        
        return $VARIABLE;
       
    }
    
    
    public function Variables($entity,$SET,$variable){
        
        $this->Get($entity,$SET,$variable);
        
        return $this->key[$entity][$variable];
        
    }
    
  
    
    
    public function Get($entity,$SET,$variable,$KEY=''){
        
   
      foreach($SET as $key=>$set){
   
             if($key===$variable){
                 
                   $this->key[$entity][$variable][] = $KEY;   
                 
             }
             else{
                 
                 if(is_array($set)){
                   if($KEY!==''){  
                   $KEYS = $KEY.'.'.$key;
                   $this->Get($entity,$set,$variable,$KEYS);
                   }else{
                   $this->Get($entity,$set,$variable,$key);
                   
                   }
                   
                     
                   
                 }
   
             }
          
      }
        $KEY='';
    }
    
    
    public function WRITE($variable,$value,$ENTITY,$ENTITY_TYPE){
        
     
        
       $types = $this->TYPE($variable, $ENTITY);
        
       
       if($types[$ENTITY_TYPE]['type']=='multiselect'){
       
        $VALID = $this->MULTISELECT($ENTITY_TYPE,$types[$ENTITY_TYPE],$variable,$value);  
        
        if($VALID){
            
            
           $VARIABLE =  $this->VARIABLE($variable, $ENTITY);
            
           echo "<pre>";
           var_dump($VARIABLE);
           echo "</pre>";
           
           echo "<pre>";
           var_dump($ENTITY);
           echo "</pre>";
           
           
           foreach($this->files as $key=>$file){
               
               $entity_hard = str_replace('/','.',$file);
               
               
               foreach($entity_hard as $hard){
                  
                   $stringHard = $hard.'.'.$key;
                   $stringHard = str_replace(".json","",$stringHard);
            
                   
                   
                   $FULLENTITY = "data.".$ENTITY;
                   
                   
                   if (strpos($FULLENTITY, $stringHard) !== false) {
                      echo $stringHard;
                      echo "<br>";
                    }
                   
                  
               }
               
           }
           
        }
           
       }
        
    }
    
    
    
    public function MULTISELECT($ENTITY_TYPE,$ENTITY_VALUE,$variable,$VALUE){
        
        $valueIS = FALSE;
        

        
        $valueIN = array();
        $INvalue = array();
        
        if(is_array($VALUE)){

               foreach($VALUE as $value){
                
                  if(in_array($value,$ENTITY_VALUE['values'])){
                     $INvalue[]=$value;
                  }else{
                     $valueIN[]=$value; 
                  }  
               }
           
        }else{
            return FALSE;
        }
        
  
        
        if(count($valueIN)!==0){
        if($ENTITY_VALUE['write']=='TRUE'){
        
           
          
          $PATH = "behaivor/".str_replace(".","/",$ENTITY_TYPE).'.json';
           
           
       
            $contentJSON =$this->Open($PATH);
            
            foreach($valueIN as $inval){
                
                array_push($contentJSON[$variable]['values'],$inval);
            }
            
           
           $this->SAVE($PATH,$contentJSON);
           
            
           return TRUE; 
            
            
        }else{
             
           return FALSE; 
        }
        
      

        }else{
         
               if(count($INvalue)!==0){
              
               return TRUE;  
               }else{
               return FALSE;   
              }
            
        }
      
        
        
    }
    
    
    public function SAVE($PATH,$ARRAY){
        
       
        
     $CONTENT = json_encode($ARRAY,JSON_PRETTY_PRINT);
        
        
        
     file_put_contents($PATH, $CONTENT);
        
        
    }
    
   
    
    

    
}
