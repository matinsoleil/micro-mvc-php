<?php

class action{

 public $URL;
 public $url;
 public $host;
 public $uri;
 public $data = array();
 public $parameters = array();
 public $ip;
 public $entity;

 public function getUrl (){

 $this->URL = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

 $_URL=  explode('?',$this->URL);

 $this->url = $_URL[0];

 $this->host = $_SERVER['HTTP_HOST'];

 $uri = $_SERVER['REQUEST_URI'];
 $uri= ltrim($uri, '/');
 $_uri= explode('?',$uri);
 $this->uri = $_uri[0];
 $this->parameters= $this->data();
 $this->ip=$this->getIP();
 }
 public function writeUrl(){}
 public function readUrl(){}
 public function redirect(){}
 public function getIP()
 {
   $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

   return $ipaddress;
 }

public function direct($url){


$map=array(array('id'=>'','model'=>'','view'=>''),array('id'=>'','model'=>'','view'=>''));

return array('id'=>'','model'=>'','view'=>'');
}

 public function data(){

   $method = $_SERVER['REQUEST_METHOD'];
   $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

 switch ($method) {
  case 'PUT':
    return array("type"=>"PUT","request"=>$request);
    break;
  case 'POST':
    return array("type"=>"POST","request"=>$_POST);
    break;
  case 'GET':
    return array("type"=>"GET","request"=>$_GET);
    break;
  case 'DELETE':
    return array("type"=>"DELETE","request"=>$request);
    break;
  default:
    return array("type"=>"GET","request"=>$request);
    break;
}
}
}
?>
