<?php
include('cache.php');
class write extends cache {
public $net;
    function __construct($net) {
    $this->net=$net;
     $this->render('content');
    }
    function render($entity){

     $action=$this->net['action']->uri;
     $data =  $this->net['action']->data;
     header('Content-Type: application/json');
     echo json_encode($data,JSON_PRETTY_PRINT);
     $this->log();

    }
    public function block($entity){

    }
    public function getNet($entity){

    $net = (array) $this->net;

    if(isset($net[$entity])){

    return $net[$entity];
    }else{
    return array('error'=>'fail');
    }

    }

     public function log(){

     $action=$this->net['action']->parameters;

     $string = json_encode($action, JSON_PRETTY_PRINT);

     $fp = fopen('./cache/chat.txt', 'w');
     fwrite($fp, $string);
     fclose($fp);

 }
}
?>
