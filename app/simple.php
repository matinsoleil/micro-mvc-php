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
class app_simple {
    
    public $hash;
    public $scan=array();
    
    //put your code here
    public function __construct($string = '0000000') {
  
    $this->hash = $string;     
        
    }
    
    
    
    public function READ_ENTITY_VALUE($ENTITY,$ENTITY_VALUE,$ENTITY_TYPE='behaivor.entities',$ENTITY_TYPE_VALUE='base'){
        
        $IS = $this->CHECK_ENTITY_VALUE($ENTITY, $ENTITY_VALUE,$ENTITY_TYPE, $ENTITY_TYPE_VALUE);
        
        if($IS==TRUE){
 
            
                   $PATH =str_replace(".","/",$ENTITY);
        
                   $PATH = $PATH.'/'.$ENTITY_VALUE.'.json';
                   
                   
                   $VALUE = $this->OPEN($PATH); 
           
                   return $VALUE;        
            
            
        }else{
                   return array();
        }
        
    }
    
    
    public function WRITE_ENTITY_VALUE($ENTITY,$ENTITY_VALUE='default',$VALUE=array("default"=>array("default")),$ENTITY_TYPE='behaivor.entities',$ENTITY_TYPE_VALUE='base'){
        
     
    $IS = $this->CHECK_ENTITY($ENTITY, $ENTITY_TYPE, $ENTITY_TYPE_VALUE);     
    
    if($IS==TRUE){
        
        $PATH =str_replace(".","/",$ENTITY);
        
        $PATH = $PATH.'/'.$ENTITY_VALUE.'.json';
        
        $this->SAVE($PATH,$VALUE);
        
        
        $PATH_ENTITY = str_replace(".","/",$ENTITY_TYPE);
    
        $PATH_ENTITY = './'.$PATH_ENTITY.'/'.$ENTITY_TYPE_VALUE.'.json';
    
        $dataEntity = $this->OPEN($PATH_ENTITY);
        
        
        if(!in_array($ENTITY_VALUE,$dataEntity[$ENTITY])){
        
        array_push($dataEntity[$ENTITY],$ENTITY_VALUE);
         $this->SAVE($PATH_ENTITY,$dataEntity); 
        }
        

        return TRUE;
    }else{
        
        return FALSE;
    }    
    
    
        
    }
    
    
    
    public function WRITE_ENTITY($ENTITY,$ENTITY_TYPE='behaivor.entities',$ENTITY_TYPE_VALUE='base'){
     
    $IS=$this->CHECK_ENTITY($ENTITY,$ENTITY_TYPE,$ENTITY_TYPE_VALUE);  
     
    if($IS==FALSE){
        
    $shardEntity = explode(".",$ENTITY);
    
    $SHARD = array();
    
    $shard ='';    
    
    foreach($shardEntity as $subEntity){
        
     $shard .='["'.$subEntity.'"]';   
        
        
    }
    

    eval('$SHARD'.$shard.'=1;');

    
    $this->SHARD($SHARD);
    
    
    $PATH = str_replace(".","/",$ENTITY_TYPE);
    
    $PATH = './'.$PATH.'/'.$ENTITY_TYPE_VALUE.'.json';
    
    $dataEntity = $this->OPEN($PATH);
    
    $newEntity = $ENTITY;
 
    
    $dataEntity[$newEntity]=array('default');

    
    $this->SAVE($PATH,$dataEntity);
    
    
    return array("write"=>TRUE,"check"=>TRUE);
    
    }else{
     
    return array("write"=>FALSE,"check"=>TRUE);    
    }    

            
      
        
    }
    
    
    public function SHARD($SHARD,$LAST=''){
        
        foreach($SHARD as $key=>$shard){
            
            
            if(is_array($shard)){
                
                $LAST = $LAST."/".$key;
                
                $Directory = $LAST;
                     
                if(!file_exists(".".$Directory)){
                    
                     mkdir(".".$Directory, 0777);   
                }
                    
                
                $this->SHARD($shard,$LAST);
                
            }else{
                
               
                 $Directory = $LAST."/".$key;
                  mkdir(".".$Directory, 0777);  
                
                 
                $CONTENT=array("default"=>array("default"));
                $this->SAVE(".".$Directory."/default.json",$CONTENT);
                
            }
            
            
        }
        
        
    }
    
    
    public function DELETE_ENTITY($ENTITY,$ENTITY_TYPE='behaivor.entities',$ENTITY_TYPE_VALUE='base'){
        
         
        
            $IS_ENTITY = $this->CHECK_ENTITY($ENTITY,$ENTITY_TYPE,$ENTITY_TYPE_VALUE);
        
            if($IS_ENTITY){
                
             $ENTITY_TYPE = str_replace('.','/',$ENTITY_TYPE);
             
             $objectValues = $this->OPEN('./'.$ENTITY_TYPE.'/'.$ENTITY_TYPE_VALUE.'.json');
    
          
             
             
             $ENTITY_PATH = str_replace('.','/',$ENTITY);
             
             $ENTITY_PATH = './'.$ENTITY_PATH;
             
     
             
             $IS = $this->IS_DEEP($ENTITY_PATH);
             
             if($IS){
             
                $DEEP_FILES = $this->DEEP($ENTITY,$ENTITY_TYPE,$ENTITY_TYPE_VALUE);
             
           
                $ALL = FALSE;
           
                
                foreach($DEEP_FILES as $KEY=>$FILES){
                    
                       $_PATH = str_replace('.','/',$KEY);
                       
                       $_PATH = './'.$_PATH;
                   
                     foreach($FILES as $FILE){
                         
                         
                         $_PATH_FILE = $_PATH.'/'.$FILE;
                        
                         //echo $_PATH_FILE;
                         //echo '<br>';
                      $this->_DELETE($_PATH_FILE);
                         
                     }
                   
                      $ALL =  $this->_DELETE_ENTITY($_PATH);
                     
                      $this->UN_CHECK_ENTITY($ENTITY, $ENTITY_TYPE, $ENTITY_TYPE_VALUE);
                }
                
               
                
                
                 
             }
            }else{
                 echo "FALSE";
                 return FALSE;
            }
        
    }
    
    
    public function UN_CHECK_ENTITY($ENTITY,$ENTITY_TYPE='behaivor.entities',$ENTITY_TYPE_VALUE='base'){
        
      $ENTITY_TYPE = str_replace('.','/',$ENTITY_TYPE);
  
      $_PATH_ENTITY_TYPE_VALUE = './'.$ENTITY_TYPE.'/'.$ENTITY_TYPE_VALUE.'.json';
      
      $objectValues =  $this->OPEN($_PATH_ENTITY_TYPE_VALUE);        
        
      
      foreach($objectValues as $key=>$value){
          
        if (strpos($key,$ENTITY) !== false) {
           unset($objectValues[$key]);
        
        }
          
      }
      
      $this->SAVE( $_PATH_ENTITY_TYPE_VALUE,$objectValues);
        
        
    }
    
    
    public function CHECK_ENTITY($ENTITY,$ENTITY_TYPE,$ENTITY_TYPE_VALUE){
               
       $ENTITY_TYPE = str_replace('.','/',$ENTITY_TYPE);
       $CHECK = FALSE;
       $objectValues =  $this->OPEN('./'.$ENTITY_TYPE.'/'.$ENTITY_TYPE_VALUE.'.json');
        
       foreach($objectValues as $key=>$value){
           
           if (strpos($key, $ENTITY) !== false) {
                  $CHECK = TRUE;
                  break;
             }
           
           
       }
       
       return $CHECK;
       
        
    }
    
    public function CHECK_ENTITY_VALUE($ENTITY,$ENTITY_VALUE,$ENTITY_TYPE='behaivor.entities',$ENTITY_TYPE_VALUE='base'){
               
       $ENTITY_TYPE = str_replace('.','/',$ENTITY_TYPE);
    
       $objectValues =  $this->OPEN('./'.$ENTITY_TYPE.'/'.$ENTITY_TYPE_VALUE.'.json');
        
       $objectValues[$ENTITY];
      
        if(in_array($ENTITY_VALUE,$objectValues[$ENTITY])){
            
            return TRUE;
            
        }else{
            
            return FALSE;
        }   
        
    }
    
    
    public function DEEP($ENTITY,$ENTITY_TYPE='behaivor.entities',$ENTITY_TYPE_VALUE='base'){
              
    $ENTITY_TYPE = str_replace('.','/',$ENTITY_TYPE);
         
    $ENTITY_VALUES =  $this->OPEN('./'.$ENTITY_TYPE.'/'.$ENTITY_TYPE_VALUE.'.json');
       
    $ENTITY_PATH = str_replace('.','/',$ENTITY);
   
    $SCAN = $this->SCAN_ENTITY($ENTITY_PATH);       
            
    return $SCAN;
         
    }
    
    
    
    public function IS_DEEP($PATH) {
    $result = false;
    if($dh = opendir($PATH)) {
        while(!$result && ($file = readdir($dh)) !== false) {
     
           if(is_dir($PATH.'/'.$file)){
           
               $result = $file !== "." && $file !== "..";
           }else{
               $result = false;
           }
            
        }

        closedir($dh);
    }

    return $result;
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
    
    
    public function _DELETE($PATH){
        
        if(file_exists($PATH)){ 
        unlink($PATH);
        return TRUE;
        }else{
        return FALSE;    
        }
    }
    

    
    public function _DELETE_ENTITY($PATH) {
    
     if(is_dir($PATH)){    
    foreach(scandir($PATH) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$PATH/$file")) $this->_DELETE_ENTITY("$PATH/$file");
        else unlink("$PATH/$file");
    }
    
    rmdir($PATH);
    return TRUE;
     }else{
    return FALSE;     
     }
    
}
    
    
    
    public function SCAN_ENTITY($PATH){
        
        $this->SCAN($PATH); 
        
        $SCAN = $this->scan;
          
        $SCAN_VALUES = $this->SCAN_VALUES($SCAN);
 
        return $SCAN_VALUES;
      
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
    
       
}
