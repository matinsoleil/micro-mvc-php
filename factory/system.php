<?php
class system {
    public $system;
    public $net;
    public $src;
    public $attribute;
    public $data= array();
    function __construct($net) {
    $this->net=$net;
    $this->start();
    }
    function start(){

     $parameters  =  $this->net['action']->parameters;

     $inputAttributes = $parameters["request"];

     $inputType = $parameters["type"];

     $defaultAttribute = $this->read('attribute.default');
     $systemAttribute =  $this->read('attribute.system');

     $attributes = array_merge($defaultAttribute,$systemAttribute);

     if(is_array($attributes)){
     foreach($attributes as $key=> $attribute){

      if(isset($attribute['src'])){
         include($attribute['src'].".php");
         eval('$src= new '.$attribute['src'].'();');
          $value =$src->src();
          $attributes[$key]['value'] = $value;
         }
       }
     }

    $this->attribute=$attributes;

    }

    function read($entity){

    $entity=str_replace('.','/',$entity);
    $str=file_get_contents("./".$entity.".json");

    $this->system=json_decode($str,true);

    return $this->system;
    }

    function exist($entity){
    $entity=str_replace('.','/',$entity);
    $pathFile= "./".$entity.".json";

    if(file_exists($pathFile)){
    return true;
    }else{
    return false;
    }
    }

    function listen(){

    }

}
?>
