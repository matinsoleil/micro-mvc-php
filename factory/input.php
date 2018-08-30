<?php
include('cache.php');
class input extends cache {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){


       $action=$this->net['action']->uri;


        preg_match_all('/((?:^|[A-Z])[a-z]+)/',$action,$matches);

        $Path =  implode('/',$matches[0]);

        $path =  strtolower($Path);

       if(file_exists('./'.$path.'.php')){

        include('./'.$path.'.php');

       }else{
        include('./block/box/default.php');
       }

    }
    public function parameters(){

      return $this->net['action']->parameters;

    }
    public function getNet($entity){

    $net = (array) $this->net;

    if(isset($net[$entity])){

    return $net[$entity];
    }else{
    return array('error'=>'fail');
    }

    }
    
    public function EAV($data){
      
      $reservoir =array("entity","attribute","value","label","input","output","type","category","group","rwx","visibility","region","task","states","state","in");   
      
      $states=array();  
        
      $entity_attribute_value = array(
       "entity"=>$entity,
       "attribute"=>$attribute,
       "value"=>$value,
       "label:en:us"=>$labelEnglish,
       "label:es:mx"=>$labelSpanish,
       "input"=>$input,
       "output"=>$output,
       "type"=>$type,
       "category"=>$category,
       "group"=>$group,
       "rwx"=>$rwx,
       "visibility"=>$visibility,   
       "region"=>$region,
       "task"=>$task,
       "states"=>$states,
       "state"=>$state,
       "in"=>$in            
        );
      
      
     $eav= array(
       "e"=>$entity,
       "a"=>$attribute,
       "v"=>$value,
       "en:us"=>$labelEnglish,
       "es:mx"=>$labelSpanish,
       "i"=>$input,
       "o"=>$output,
       "t"=>$type,
       "c"=>$category,
       "g"=>$group,
       "x"=>$rwx,
       "y"=>$visibility,   
       "r"=>$region,
       "k"=>$task,
       "st"=>$states,
       "s"=>$state,
       "n"=>$in            
        );
        
        
    }
    
    public function GET_ATTRIBUTE(){
        
        
        
    }
    
    public function GET_STATES(){
        
        
    }
    
    public function GET_INPUT(){
        
        
    }
    
    public function GET_OUTPUT(){
        
        
    }
    
}
?>
