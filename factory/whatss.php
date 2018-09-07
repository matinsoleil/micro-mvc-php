<?php
include('data.php');

class whatss extends data
{
public $entity;
public $net;
public $data;

function __construct($net) {
$this->net = $net;
$parammeters = $this->net['action']->parameters;


$this->net['action']->data= array('parammeter'=>$parammeters);

$this->entity="";
}
function Service($quest){


}


function Mind(){


}


function State(){


}

function Status(){

}

function Calification(){


}

function Decision(){


}

function Answer(){

}


function Question(){


}

public function get_get($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result = curl_exec($ch);
curl_close($ch);
return json_decode($result);

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
