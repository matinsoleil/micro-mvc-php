<?php

include('redis.php');

class view extends redis {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    $this->startCache();
    }
    function render($entity){


     $action=$this->net['action']->uri;

     $doc = new DOMDocument();
     $entity = $this->net['model']->entity;
     $doc->loadHTML("<html><body>Help Test ".$entity."<br></body></html>");
     echo $doc->saveHTML();

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
