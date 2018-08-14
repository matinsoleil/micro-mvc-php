<?php
include('redis.php');
class api extends redis {
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
     $this->check();


    }
    public function check(){

	$urls= array(
	"https://www.consejomexcardio.org/",
	"https://www.consejomexcardio.org/Historia",
	"https://www.consejomexcardio.org/Cursos",
	"https://www.consejomexcardio.org/Regulacion",
	"https://www.consejomexcardio.org/Certificacion",
	"https://www.consejomexcardio.org/Directorio",
	"https://www.consejomexcardio.org/Avisos",
	"https://www.consejomexcardio.org/Contacto"
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
