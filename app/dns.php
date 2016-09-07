<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of json
 *
 * @author aromerov
 */
class app_dns {
    
   public $hash;
    public $action;
    public $isRest;
    public $lastUrl;
    public $parameters=array();
    public $longParameters=array();
    public $ip;
    public $session;
    public $baseURL;
    public $currentURL;
    public $listen = array();
    public $format;
   
    
    //put your code here
    public function __construct($string='') {
  
    $this->hash = $string;     
    
    $this->Action();
    
    $this->Listen();
    
    
    }
           /*
     * Get TRUE Request and Set Parameters;
     * 
     * 
     */

    public function Action() {
         
        $this->ip = $this->getIpClient();

        if ($this->action == '') {
          
            $urlstring = $_SERVER['REQUEST_URI'];
       
            if (strpos($urlstring, '?type=rest') !== false) {
                $this->isRest = 1;
            } else {
                $this->isRest = 0;
            }

            if (strpos($urlstring, '?') !== false) {
                $this->clearURL = 0;
                $fullURL = explode('?', $urlstring);
                $urlstring = $fullURL[0];
                $parameterFull = explode('&', $fullURL[1]);
                foreach ($parameterFull as $key => $parameter) {
                    if (strpos($parameter, '=') !== false) {
                        
                        $parameterData = explode('=', $parameter);
                        
                        $this->parameters[$parameterData[0]] = $parameterData[1];
                    } else {
                       
                        $this->longParameters[$key] = $parameter;
                    }
                }
            } else {
                $this->clearURL = 1;
            }

            $urlstring = substr($urlstring, 1);
            
            if ($urlstring == '') {
         
                $urlstring = '/';
            }
         
            $this->action = $urlstring;
            

           

        } else {
            
            $urlstring = $this->action;
        }
  
        return $urlstring;
    }

    /*
     * Get Current Ip Client
     * 
     * @return string ip adress
     */

    public function getIpClient() {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $this->ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }
        return $this->ip;
    }
    
    
    public function LISTEN(){
        
    
        
        foreach($_GET as $key=>$value){
            
            if($this->IS_JSON($value)){
                
                $_GET[$key] =  json_decode($value);
                
            }
            
            if($key=='format'){
                
                if($value=='json'){
                   
                    $this->format = 'json';
                    
                }else{
                    $this->format = 'html';
                }
                
            }
            
            
        }
        
        
       $this->listen = $_GET;
        
        
    }
    
    
    public function STRING_TO_JSON(){
        
        
        
    }
    
    public function UPDATE(){
        
        
        
    }
    
    
    public function SEARCH(){
    
        
    }
    
    public function RELATED(){
        
        
        
    }
    
    public function SECURITY(){
        
        
        
    }
    
    public function IS_JSON($string) {
     json_decode($string);
     return (json_last_error() == JSON_ERROR_NONE);
   }
 
       
}
