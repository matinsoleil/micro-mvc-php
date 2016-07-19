<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of control
 *
 * @author aromerov
 */
class app_model {
    //put your code here
    public function __construct($string = '0000000') {
  
    $this->hash = $string;     
    
    $fuzzyString =  '{"data":["AND",{"var1":"value1"},["OR",{"var2":"value2"},{"var3":"value3"}]]}';
    
    $mathString = '{"equation":["+","20","85","6","7","10",["*","23","24","9"]]}';
    
    
    $value = json_decode($mathString,true);

   
    
    
    $result = $this->GET_LOGIC($value['equation']);
    
   
    echo $result;
    echo '<br>';
    
    }
    
    
    public function GET_OPERATOR(){
        
        
        $operators= array(
        'AND'=>'&&',
        'OR'=>'||',
        'NOT' =>'!',
        'XOR'=>'xor',
        'EQUAL'=>'==',
        'IDENTICAL'=>'===',
        'NOT IDENTICAL'=>'!==',
        'NOT EQUAL'=>'!=',
        'GREATER THAN'=>'>',
        'LESS THAN'=>'<',
        'ROOT'=>'SQUARE',    
        'GREATER EQUAL'=>'>=',
        'LESS EQUAL'=>'<=',
        'CONCATENATION'=>'.',
        'CONCATENATION EQUAL'=>'.=',
        'GO'=>'go',    
        '*'=>'*',
        '+'=>'+',
        '-'=>'-',
        '/'=>'/',
        'EXP'=>'**',
        '++'=>'++',
        'IF','if',    
        'THEN'=>'{,}',
        'IS'=>'='    
        );
        
        
         return $operators;
    }
    
    
   
    public function GET_LOGIC($LOGIC)
    {

        $OPERATORS = $this->GET_OPERATOR();
        $RESULT = NULL;
        if(is_array($LOGIC)){
            
            $ELEMENTS = array();
            $OPERATOR ='+';
            
            foreach($LOGIC as $KEY=>$ITEMS){
                
             if(!is_array($ITEMS)){   
             
                 if(array_key_exists($ITEMS,$OPERATORS)){
                     
                     $OPERATOR = $OPERATORS[$ITEMS];
                     
                 }else{
                     
                     $ELEMENTS[]=$ITEMS;
                     
                 }     
             
             
             }else{
                 
                    $ELEMENTS[] = $this->GET_LOGIC($ITEMS);
                 
             }   
                
            }
            
            
            $OPERATORS ='';
            $TOTAL = count($ELEMENTS);
           
            foreach($ELEMENTS as $KEY=>$ELEMENT){
                
                if($KEY==$TOTAL-1){
                $OPERATORS .='$ELEMENTS["'.$KEY.'"]';
                }else{
                $OPERATORS .='$ELEMENTS["'.$KEY.'"]'.$OPERATOR;    
                }
                
            }
            
            
         
            
            eval('$RESULT ='.$OPERATORS.';');
            
            return $RESULT;
            
            
        }
        
        
    }
    
    
    
    
    public function GET_MODELS($ENTITY){
        
        
        
        
        
    }
    
    public function LOAD_MODEL($ENTITY){
        
        
        
    }
    
    
    public function RUN_MODEL($ENTITY){
        
        
        
    }
    
    
    public function GET_MODEL($ENTITY){
        
        
        
    }
    
   public function WAY(){
        
        
        
        
    }

    
    public function IN(){
        
        
    }
   
    
    public function OUT(){
        
        
        
    }
    
    
    
    public function INPUT(){
        
        
        
    }
    
    public function OUTPUT(){
        
        
        
    }
    
    public function ERROR(){
        
        
        
        
        
    }
    
    public function REFERENCE(){
        
        
        
    }
    
    public function SENSOR(){
        
        
        
        
        
    }
    
    
    public function SYSTEM(){
        
        
        
    }

    
    public function CONTROL(){
        
        
        
    }
    
    
    public function CONTROLLER(){
        
        
        
    }
    
    public function OBSERVER(){
        
        
        
    }
    
    
    public function BOX(){
        
        
        
    }
    
    public function RULES(){
        
        
        
    }
    
    
}
