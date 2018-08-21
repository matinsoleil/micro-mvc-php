<?php

include('cache.php');

class view extends cache {
public $net;
    function __construct($net) {
    $this->net=$net;
    $this->render('content');
    $this->startCache();
    }
    function render($entity){

   
     $this->log();   
        

     $entity = $this->net['model']->entity;
     
    
      
        
     $action=$this->net['action']->uri;

     $doc = new DOMDocument();
    
     $doc->validateOnParse = true; 
     $doc->loadHTML(
             "<html id='html' >"
             . "<head id='head' >"
             . "<script src='./js/react.development.js'></script>
                <script src='./js/react-dom.development.js'></script>
                <script src='./js/babel.min.js'></script>
                <script src='./js/prop-types.min.js'></script>"
             . "</head>"
             . "<body id='body' >"
             . "<div id='root'></div>"
             . "</body>"
             . "</html>"
             
             );
     
     $doc->preserveWhiteSpace = false;
     
    
     $body = $doc->getElementById("body");
    
     
     
     
     echo $doc->saveHTML();

    }
    public function block(){

        $content=$this->get_post('http://macrocomer.mx/blockInputInput?block=true',array("master","combo"));
        
        $block = new DOMDocument();
        
        $block->validateOnParse = true; 
        $block->loadHTML($content);
        $block->preserveWhiteSpace = false;
        
        $block->getElementById('input');
        
        

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
curl_exec($ch);
     
 }
}
?>
