<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of load
 *
 * @author aromerov
 */
class app_load {
    
     public $NET = array();
    
     public function __construct($origin=1) {
    
    if($origin==1){     
    foreach (glob("./*/*.php") as $filename)
    {
        
        if (!strpos($filename, 'load.php') !== false) {
            include $filename;
        }
    }

    }else{
        
        $data ='net.object.section';
        
        $this->LoadConfiguration($data);
        
        
        
         $dataClass = str_replace('.','_',$data);
        
        eval('$action= new '.$dataClass.';');
        
        $this->NET['net']['object']['section'] = $action;
        
    }
     
    
    }
    
     public function LoadConfiguration($data){
         
         
         
         $_data = str_replace('.','/',$data);
         
         
         $filename = './'.$_data.'.php';
            
         include $filename;
        
    
         
         
         
     }
    //put your code here
}

