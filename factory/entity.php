<?php
include('data.php');
class entity extends data {
    public $net;
    public $data;
    function __construct($net) {
    $this->net = $net;
    
    $this->startDataBase();

    $parameters=$this->net['action']->parameters;
    
     $_value= array();
    
    $totalParameters= 0;
 
    
    $type = $parameters['type'];
    
   
    if($type=='POST'){
        
       $parameter = $parameters['request']['parameters'];
       $body =  $parameters['request']['body'];
       $object = $parameters['request']['object'];
       $parameters['request']['data'];
       
        $totalParameters = count($parameters['request']['parameters']);
        
       
    }elseif($type=='GET'){
        $totalParameters = count($parameters['request']);
        
      if($totalParameters!=0){
    
    $values= $parameters['request'];

    foreach($values as $key=>$value){
        
        $k = explode(':',$key);

        $n = $k[0];  
        if(isset($k[1]) && isset($k[2])){
        $v= $k[1].':'.$k[2];
  
        $_value[$n][$v]=$value;
        }elseif(isset($k[1])){
        $v = $k[1];    
         $_value[$n][$v]=$value;      
        }
        
    }
    
     $collection = 'default';

     
     $result=$this->SET_EAV($collection,$_value); 
     
     
      
    }
        
    }else{
        
        $_value= array();
        
    }
    
    
    $this->net['action']->data = array("eav"=>$_value,"parameters"=>$parameters);
 
    




    //$variables=$this->GET_VARIABLE("variable");
    

    
    //$result = $this->GET_EAV($collection, $entity, $attribute);
    
    //$result = $this->SET_VARIABLE('number','Number','number');
    
  
   //$result = $this->GET_VARIABLE('number');
    
  
    //$databases = $this->GET_COLLECTION();

 

     //array('databases'=>$databases,'soft'=>$this->mongoActive);

    }
   
}
