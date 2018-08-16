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
 public $module;
 public $notfound;
 public $input;

 public function getUrl (){

 $this->URL = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

 $_URL=  explode('?',$this->URL);

 if(isset($_URL)){
 $this->url = $_URL[0];
 }

 $this->host = $_SERVER['HTTP_HOST'];

 $uri = $_SERVER['REQUEST_URI'];
 $uri= ltrim($uri, '/');
 $_uri= explode('?',$uri);

 if(isset($_uri[0])){
 $this->uri = $_uri[0];
 }

 if(isset($_uri[1])){
     $_input = $_uri[1];
     $match=explode('=',$_input);

 }else{
     $match= array();
 }



 $this->input = $match;
 $this->parameters= $this->data();
 $this->ip=$this->getIP();
 }

public function reservado($uri){
$reserv = array("data","factory","eav","entity","cache","history","attribute","block","js","style","lib","url","vendor","nbproject");
if(in_array($uri,$reserv)){
 http_response_code(404);
 include('404.php');
 die();
}

}
 public function readUrl(){}
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

public function rewrite($url){

$urls=$this->read('url.rewrite');

if(is_array($urls)){
foreach($urls as $key=>$value){

   if($value["id"]==$url){
   $this->module = $value;
   }
   if($value["id"]=="404"){
   $this->notfound = $value;
   }

                   }
}

if($this->module!=NULL){
return $this->module;
}else{
return $this->notfound;
}

}

public function read($entity){

    $entity=str_replace('.','/',$entity);
    $str=file_get_contents("./".$entity.".json");
    $this->system=json_decode($str,true);
    return $this->system;

}

public function write($entity,$object){

    $entity=str_replace('.','/',$entity);
    $pathFile="./".$entity.".json";
    $file = fopen($pathFile,"w");
    $string = json_encode($object,JSON_PRETTY_PRINT);
    fwrite($file,$string);
    fclose($file);
}


 public function redirect($url,$permanent = false){

    if (headers_sent() === false)
    {
    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();

 }

 public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
 }

 public function cookie($uri){

            if($uri=='admin'){
                if (session_status() == PHP_SESSION_NONE) {
                session_start();
                $cookie_name = "key";
                $key = $this->generateRandomString(12);
                setcookie($cookie_name,$key,NULL, "/"); // 86400 = 1 day
                $_SESSION['key'] = $key;
                }
            }else{
                if (session_status() == PHP_SESSION_NONE) {
                session_start();
                $cookie_name = "key";
                $key = $this->generateRandomString(12);
                setcookie($cookie_name,$key,NULL, "/"); // 86400 = 1 day
                $_SESSION['key'] = $key;
                }

            }
}


 public function data(){

   $method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

$post = file_get_contents('php://input');

 switch ($method) {
  case 'PUT':
    return array("type"=>"PUT","request"=>$request);
    break;
  case 'POST':
    return array("type"=>"POST","request"=>array('body'=>$post,'parameters'=>$this->input));
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
