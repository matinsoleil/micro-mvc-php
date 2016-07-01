<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rest
 *
 * @author aromerov
 */
class app_type {
    //put your code here
    
     public function __construct($string = '0000000') {
  
    $this->hash = $string;     
    
    }

    
     public function GET_ALL_TYPES($ENTITY){
         
         
         
         
         
     }
     
     
     public function GET_TYPE($VARIABLE,$ENTITY){
         
        
     }
     
     
     public function SET_TYPE($TYPE,$VARIABLE,$VALUES,$ENTITY){
         
         
         
     }
     
     public function DELETE_SET_TYPE($VARIABLE,$ENTITY){
         
         
         
     }
     
     
     public function GET_TYPE_VALUES($VARIABLE,$ENTITY){
         
         
         
     }
     
     public function SET_TYPE_VALUES($VARIABLE,$VALUES,$ENTITY){
         
         
         
         
     }
    
}
