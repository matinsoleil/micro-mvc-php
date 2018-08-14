<?php
class view {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){


     $action=$this->net['action']->uri;

     $doc = new DOMDocument();

     $doc->loadHTML("<html><body>Help Test<br></body></html>");
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
