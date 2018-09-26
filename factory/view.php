<?php

include('cache.php');

class view extends cache {
public $net;
public $url;
public $uri;
    function __construct($net) {
    $this->net=$net;
    $this->url = $this->net['action']->url;
    $this->uri = $this->net['action']->uri;
    $this->startCache();
    $this->render('content');
    }

    function render($entity){

    $html = $this->get_post($this->url.'blockViewDefault',array('nothing'));
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->preserveWhiteSpace = true; // needs to be before loading, to have any effect
    $doc->loadHTML((string)$html);
    $doc->formatOutput = true;
    print $doc->saveHTML();

    }

    function old($entity){

    include('./block/script/default.php');
    include('./block/input/input.php');
    include('./block/grid/default.php');

    }
    public function block(){

    }

    public function scripts(){
    return FALSE;
    }
    public function parameters(){

    return $this->net['action']->parameters;

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

     $fp = fopen('./cache/input.txt', 'w');
     fwrite($fp, $string);
     fclose($fp);

 }

 public function get_post($url,$data){

//Initiate cURL.
$ch = curl_init($url);
//Encode the array into JSON.
$jsonDataEncoded = json_encode($data);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//Execute the request
return curl_exec($ch);

 }



}
?>
