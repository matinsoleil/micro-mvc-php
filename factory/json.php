<?php
include('redis.php');
class json extends redis {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){


     $action=$this->net['action']->uri;

     $data = array("id"=>"2","request"=>"true");
     header('Content-Type: application/json');
     echo json_encode($data);


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
}
?>
