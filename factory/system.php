<?php
class system {
    public $system;
    public $net;
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
     foreach($attributes as $attribute){

     //   var_dump($attribute);

     }
     }


    }

    function read($entity){

    $entity=str_replace('.','/',$entity);
    $str=file_get_contents("./".$entity.".json");

    $this->system=json_decode($str,true);

    return $this->system;
    }

    function listen(){

    }

}
?>
