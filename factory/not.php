<?php
class not {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){

     header("HTTP/1.0 404 Not Found");
     $doc = new DOMDocument();
     $doc->loadHTML("<html><body>404 not found<br></body></html>");
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
