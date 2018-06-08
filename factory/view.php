<?php
class view {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){

      $net = (array) $this->net;



     if($net['uri']==""){
     $doc = new DOMDocument();

     $doc->loadHTML("<html><body>Test<br></body></html>");
     echo $doc->saveHTML();
       }elseif($net['uri']=="whatss"){

        include('./block/whatss.php');

     }else{
        include('./block/'.$entity.'.php');
     }
    }
    public function block($entity){


    }
}
?>
