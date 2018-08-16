<?php
include('cache.php');
class curl extends cache {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){


     $action=$this->net['action']->parameters;

     $string = json_encode($action, JSON_PRETTY_PRINT);

     $fp = fopen('./cache/input.txt', 'w');
     fwrite($fp, $string);
     fclose($fp);


     $data = array("live"=>"true","id"=>"4");
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
