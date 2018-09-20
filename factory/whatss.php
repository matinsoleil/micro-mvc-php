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

if(isset($parammeters['request']['data'])){
$whatss = $parammeters['request']['data'];

$event = $whatss['event'];
$token = $whatss['token'];

if($event=='message'){
$contact = $whatss['contact'];
$Message = $whatss['message'];
if($Message['type']=='chat'){
$Message = $whatss['message'];
$messageText = $Message['body']['text'];
$messageCUID = $Message['cuid'];
$messageUID =  $Message['uid'];
$messageDTM =  $Message['dtm'];
}else{
$messageText = '';
}
if($Message['type']=='image'){
$messageText = '';
$messageCUID = $Message['cuid'];
$messageUID =  $Message['uid'];
$messageDTM =  $Message['dtm'];
$messageText = $Message['body']['caption'];
$messageImageType = $Message['body']['mimetype'];
$messageImageSize = $Message['body']['size'];
$messageImageUrl = $Message['body']['url'];

}else{
$messageImageCaption ='';
$messageImageType = '';
$messageImageSize = '';
$messageImageUrl = '';
$meesageImageThumb = '';
}
}
else{
$messageText = '00';
$messageUID = $whatss['muid'];
$messageCUID = $whatss['cuid'];
}

}else{
$whatss = array('event'=>'none');
}

$this->net['action']->data= array('conversation'=>$messageUID,'message'=>$messageText,'parammeters'=>$parammeters);

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
