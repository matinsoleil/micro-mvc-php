<?php
include('data.php');
class entity extends data {
    public $net;
    public $data;
    function __construct($net) {
    $this->net = $net;

    $this->startDataBase();

    $parameters=$this->net['action']->parameters;
    
    $_value = array();
    
    $values= $parameters['request'];
    
    $attribute='default';
    $entity = 'default';
    $collection = 'default';
            
    
    
    foreach($values as $key=>$value){
        
        $k = explode(':',$key);
        
        $n= $k[0];
        
        if($k[1]=='collection' && $k[2]=='attribute'){
         
            $attribute=$value;
         
        }elseif($k[1]=='collection' && $k[2]=='name'){
            
            $collection= $value;
            
        }elseif($k[1]=='collection' && $k[2]=='entity'){
            
            $entity=$value;
            
        }else{

        $v= $k[1].':'.$k[2];
        
        $_value[$n][$v]=$value;
  
        }
        
    }
    

    
    //$variables=$this->GET_VARIABLE("variable");
    
    $values=array('value:default'=>'sample','value:standard'=>'sample');
    
    $collection='variable';
    $entity='sample';
    $attribute='sample';
    $result = array();
    //$result=$this->SET_EAV($collection, $entity, $attribute, $values);
    
    //$result = $this->GET_EAV($collection, $entity, $attribute);
    
    //$result = $this->SET_VARIABLE('number','Number','number');
    
  
   //$result = $this->GET_VARIABLE('number');
    
    
    
    
    //$databases = $this->GET_COLLECTION();
    
    
    
    $this->net['action']->data = array("eav"=>$_value,"parammeters"=>$parameters);
    
    
    
     //array('databases'=>$databases,'soft'=>$this->mongoActive);
    
    

    }
   
}
