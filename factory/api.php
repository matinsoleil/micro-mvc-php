<?php
include('cache.php');
class api extends cache {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){

     $action=$this->net['action']->uri;
     $data = $this->net['action']->api;
     header('Content-Type: application/json');
     echo json_encode($data, JSON_PRETTY_PRINT);

    }
    public function setEvent(){}
    public function getEvent(){}
    public function observer(){}
    public function trigger(){}
    public function getNet($entity){
    $net = (array) $this->net;
    if(isset($net[$entity])){
    return $net[$entity];
    }else{
    return array('error'=>'fail');
    }
   }
}
?>
