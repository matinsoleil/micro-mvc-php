<?php
include('cache.php');
class api extends cache {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    }
    function render($entity){

     $action=$this->net['action']->uri;
     $data = array("id"=>"2","request"=>"true");
     header('Content-Type: application/json');
     echo json_encode($data);


    }
    public function check(){

	$urls= array(

	);

      foreach($urls as $url){
        $this->CURL($url);
      }

    }

    public function CURL($URL){

$ch = curl_init($URL);
$fp = fopen("./cache/temporal.txt", "w");
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);

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
