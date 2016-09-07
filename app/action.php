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
class app_action {
    //put your code here
        //put your code here
    public $core;
    public $data;
    
    public function __construct(app_core $core,app_data $data) {
  
    $this->data= $data;    
    $this->core = $core;  
    
    
    
    if($this->data->dns->format=='json'){    
    $this->JSON($this->data->step);
    }else{
    $this->HTML($this->data->step);    
    }    
        
    }
    
    public function HTML($DATA){
        
        //var_dump($DATA);
        //die('here');
        $doc = new DOMDocument();
 
        
        $content=file_get_contents($this->core->curPageURL().'html/page/default/html.phtml');
         
        $doc->loadHTML($content);
        
        echo $doc->saveHTML();
        
    }
    
    
    public function JSON($DATA){
        
        header('Content-Type: application/json');
        
       
        echo json_encode($DATA,JSON_PRETTY_PRINT);
        
    }
    
}
