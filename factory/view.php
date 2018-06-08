<?php
class view {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){

     if(1==2){
     $doc = new DOMDocument();

     $doc->loadHTML("<html><body>Test<br></body></html>");
     echo $doc->saveHTML();
       }else{

        include('./block/'.$entity.'.php');
     }
    }
    public function block($entity){


    }
}
?>
