<?php
class system {
    public $system;
    public $net;
    function __construct($net) {
    $this->net=$net;
    $this->start();
    }
    function start(){
    $data=$this->read('data.system');



    foreach($data as $key=>$box){

         foreach($box as $key=>$pieze){
            // var_dump($key);
         }

    }
    }

    function read($entity){

    $entity=str_replace('.','/',$entity);
    $str=file_get_contents("./".$entity.".json");

    $this->system=json_decode($str,true);

    return $this->system;
    }
}
?>
