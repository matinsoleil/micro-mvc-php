<?php
include('data.php');
class get extends data {
    public $net;
    public $data;
    function __construct($net) {
    $this->net = $net;
    
    $this->startDataBase();

    $parameters=$this->net['action']->parameters;
    
    $totalParameters= 0;
 
    
    $type = $parameters['type'];
    
   
    if($type=='POST'){
        
  
       
    }elseif($type=='GET'){
      
        
    $totalParameters =count($parameters['request']);
    
   
   
    $_value = array();
    


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
    $_result = array();
     
     foreach ($_value as $val) {
         
          $result=$this->GET_EAV($val['collection:default'],$val['entity:default'],$val['attribute:default']); 
     
          array_push($_result,$result);
          
          
     }
    
      
    }

    }
    
 
    
    //$variables=$this->GET_VARIABLE("variable");
    

    
    //$result = $this->GET_EAV($collection, $entity, $attribute);
    
    //$result = $this->SET_VARIABLE('number','Number','number');
    
  
   //$result = $this->GET_VARIABLE('number');
    
  
    //$databases = $this->GET_COLLECTION();
     
     $this->net['action']->data = array("eav"=>$_result,"parammeters"=>$parameters);

     //array('databases'=>$databases,'soft'=>$this->mongoActive);

    }
   
}
