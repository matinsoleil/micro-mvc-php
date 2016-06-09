<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of html
 *
 * @author aromerov
 */
class app_html {
    //put your code here
        //put your code here
    public $core;
    public $data;
    
    public function __construct(app_core $core,app_data $data) {
  
    $this->data= $data;    
    $this->core = $core;    
        
    $this->HTML("DATA");    
        
    }
    
    public function HTML($DATA){
        
        //var_dump($DATA);
        //die('here');
        $doc = new DOMDocument();
 
        
        $content=file_get_contents($this->core->curPageURL().'html/page/default/html.phtml');
         
        $doc->loadHTML($content);
        
        echo $doc->saveHTML();
        
    }
    
}
