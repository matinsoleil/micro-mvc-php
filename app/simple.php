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
                echo "NOT ENTITY";
             $ENTITY_TYPE = str_replace('.','/',$ENTITY_TYPE);
             
             $objectValues = $this->OPEN('./'.$ENTITY_TYPE.'/'.$ENTITY_TYPE_VALUE.'.json');
    
          
             
             
             $ENTITY_PATH = str_replace('.','/',$ENTITY);
             
             $ENTITY_PATH = './'.$ENTITY_PATH;
             
             echo $ENTITY_PATH;
             echo "<br>";
             
             $IS = $this->IS_DEEP($ENTITY_PATH);
             
             if($IS){
             
                $HW_DEEP = $this->DEEP($ENTITY,$ENTITY_TYPE,$ENTITY_TYPE_VALUE);
             
                 echo "<pre>";
                 var_dump($HW_DEEP);
                 echo "</pre>";
             }
            }else{
                 echo "FALSE";
                 return FALSE;
            }
        
    }
    
    
    public function UNSHARD($UNSHARD,$LAST=''){
        
        
        
        
    }
    
    
    public function CHECK_ENTITY($ENTITY,$ENTITY_TYPE,$ENTITY_TYPE_VALUE){
        
        
        $ENTITY_TYPE = str_replace('.','/',$ENTITY_TYPE);
 
        
       $objectValues =  $this->OPEN('./'.$ENTITY_TYPE.'/'.$ENTITY_TYPE_VALUE.'.json');
        
       if(isset($objectValues[$ENTITY])){
           return TRUE;
       }else{
           return FALSE;
       }
        
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
 
        
    $objectValues =  $this->OPEN('./'.$ENTITY_TYPE.'/'.$ENTITY_TYPE_VALUE.'.json');
        
    echo '<pre>';  
    var_dump($objectValues);
    echo '</pre>';
    echo '<br>';
    
    
    $ENTITY_PATH = str_replace('.','/',$ENTITY);
   
    $SCAN = $this->SCAN_ENTITY($ENTITY_PATH);       
    
    
    var_dump($SCAN);
   
           
     return array();
       
        
        
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
    
    public function _DELETE_ENTITY($PATH){
        
        if(is_dir($PATH)){
        rmdir($PATH);
        return TRUE;
        }else{
        return FALSE;    
        }
    }
    
    
    public function SCAN_ENTITY($PATH){
        
        $this->SCAN($PATH);
        
        $SCAN = $this->scan;
        
     
        $this->SCAN_VALUES($SCAN);
        
        
        
        
        return $SCAN;
        
        $this->scan = array();
        
    }
    
    
    
    public function SCAN($PATH){
        
               
    $FILES = scandir($PATH);
    
    foreach($FILES as $file){
        
        if(is_dir($PATH.'/'.$file)){
            if( $file !== "." && $file !== ".."){
                
                 $PATH_NEXT=$PATH."/".$file;
                
                 $_ENTITY = str_replace('/','.',$PATH_NEXT);
                 
                 $this->scan[$_ENTITY]=1;
                
                 $this->SCAN_ENTITY($PATH_NEXT);
                
            }
        }
        
    }
  
    }
   
   public function SCAN_VALUES($PATH){
       
       foreach($SCAN as $entities){
           
           var_dump($entities);
           echo "<br>";
           
       }
       
       
   } 
    
    
}
