<?php
include('cache.php');
class input extends cache {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){


       $action=$this->net['action']->uri;

        preg_match_all('/((?:^|[A-Z])[a-z]+)/',$action,$matches);

        $Path =  implode('/',$matches[0]);

        $path =  strtolower($Path);

       if(file_exists('./'.$path.'.php')){

        include('./'.$path.'.php');

       }else{
        include('./block/box/default.php');
       }

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
