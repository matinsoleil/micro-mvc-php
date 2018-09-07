<?php
include('data.php');
class entity extends data {
    public $net;
    public $data;
    function __construct($net) {
    $this->net = $net;

    $this->startDataBase();

    $parameters=$this->net['action']->parameters;
    
    $totalParameters = count($parameters['request']);

   
    $_value = array();
    
   
    
    $attribute='';
    $entity = '';
    $collection = '';
    $full = 0;        
    
    if($totalParameters!=0){
    
    $values= $parameters['request'];
    
   
        
    foreach($values as $key=>$value){
        
        $k = explode(':',$key);
        
        
     
        
    

        $n = $k[0];    
        $v= $k[1].':'.$k[2];
  
        $_value[$n][$v]=$value;
 
   
        
       
           
    
 
    
 

        
     
       
    
        
    }
    
     $collection = 'default';

     $result=$this->SET_EAV($collection,$_value); 
    
    
    }

    
   
    
    //$variables=$this->GET_VARIABLE("variable");
    

    
    //$result = $this->GET_EAV($collection, $entity, $attribute);
    
    //$result = $this->SET_VARIABLE('number','Number','number');
    
  
   //$result = $this->GET_VARIABLE('number');
    
  
    //$databases = $this->GET_COLLECTION();

     $this->net['action']->data = array("eav"=>$_value,"parammeters"=>$parameters);

     //array('databases'=>$databases,'soft'=>$this->mongoActive);

    }
   
}
