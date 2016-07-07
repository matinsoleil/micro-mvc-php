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

    
     public function GET_ALL_TYPES(){
         
         
         
       $all_types =  array('constant','boolean','integer','number','null','string','object');
         
       return $all_types;
       
         
     }
     
     
     public function GET_ALL_SUBTYPES(){
         
        $all_subtypes = array('coordenate',
                                'variable',
                                'equation',
                                'matrix',
                               'translate',
                               'language',
                               'hidden',
                               'private',
                               'text',
                               'like',
                               'nick',
                               'id',
                               'entity',
                               'keyword',
                               'description',
                               'status',
                               'points',
                               'name',
                               'bit',
                               'date',
                               'time',
                               'place',
                               'address',
                               'image',
                               'sound',
                               'music',
                               'number',
                               'url',
                               'video',
                               'currency',
                               'color',
                               'measure',
                               'quantity',
                               'distance',
                               'position',
                               'height',
                               'width',
                               'weight',
                               'texture',
                               'ad',
                               'formula',
                               'typography',
                               'password',
                               'hash',
                               'cypher',
                               'comment',
                               'model',
                               'path',
                               'file',
                               'email',
                               'movil',
                               'phone',
                               'region',
                               'block',
                               'html',
                               'tag',
                               'xml'
                            ); 
         
         return $all_subtypes;
     }
     
   
     
     
     public function GET_ALL_IS(){
          $is = array('must',
                      'must not',
                      'required',
                      'shall',
                      'shall not',
                      'should',
                      'should not',
                      'recommended',
                      'may',
                      'optional');
         return $is;
         
     }
     
     public function GET_ALL_WAYS($ENTITY){
         
         $orders = array('to','between','forward','go','top','buttom','left','right','on','in','out','next','side','front','back','over','above','bellow');
       
     }
     
     
     public function GET_TYPE($VARIABLE,$ENTITY){
         
        
     }
     
     
     public function SET_TYPE($TYPE,$VARIABLE,$VALUES,$ENTITY){
         
         
         
     }
     
     public function DELETE_TYPE($VARIABLE,$ENTITY){
         
         
         
     }
     
     
     public function GET_TYPE_VALUES($VARIABLE,$ENTITY){
         
         
         
     }
     
     public function SET_TYPE_VALUES($VARIABLE,$VALUES,$ENTITY){
         
         
         
         
     }
    
}
