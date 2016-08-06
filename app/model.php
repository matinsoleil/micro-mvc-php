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
    
    $this->rule =array();
    
    $variables=array('var1'=>'11','var2'=>'23','var3'=>'87','var4'=>'100','var5'=>'33','var6'=>'66');
    
    
    
    $fuzzyString = '{"data":["AND",{"var1":"11"},["OR",{"var2":"23"},{"var3":"87"}]]}';
    
    
    $fuzzy = '{"data":["THEN",["IF",["AND",["EQUAL","var1","var3"],["GREATER THAN","var5","var6"]]],["EQUAL","var2","var4"]]}';
    
    
    $simple = '{"data":["THEN",["IF",["TRUE"]],["EQUAL","var1","var2"],["GREATER THAN","var3","var4"]]}';
    
    
    $mathString = '{"equation":["+","20","85","6","7","10",["*","23","24","9"]]}';
    
    
    //$value = json_decode($mathString,true);

    $value = json_decode($fuzzyString,true);
  
    //$result = $this->GET_LOGIC($value['equation']);
    
    $result = $this->GET_FUZZY($value['data']);
    
     var_dump($result);
    
    $rule = json_decode($simple,true);
    
    
    $this->RULE($rule['data']);
   
     echo "<pre>";
     var_dump($this->rule);
     echo "</pre>";
   
    echo "<br>";
    echo "<br>";
    
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
        'THEN'=>'THEN',
        'IS'=>'=',
        'IF'=>'IF',
        'TRUE'=>'TRUE'    
        );
        
        
        return $operators;
    }
    
    
    public function RULE($RULE){
        
        foreach($RULE as $rule){
            
           
          
            
               if(is_string($rule)){
                   $this->rule[] = $rule;
               }else{
                   $this->rule[] = $rule;
                   
               }
               
        }
        
        
        $shardRule = $this->rule;
        
        
        foreach($shardRule as $key=>$rls){
            
            if($key==0){
            //Tipe of Rule
                if($rls=='THEN'){
                
                        
                    
                }
            
            }{
                
                
                
            }
            
        }
        
        
    }
    
    
    public function GET_RULE($RULE){
        
        //var_dump($RULE);
        
        $variables=array('var1'=>'11','var2'=>'23','var3'=>'87','var4'=>'100','var5'=>'33','var6'=>'66');
    
        
        $_RULES = array();
        
        $THENS = array();
        
        $CONDITIONS = array();
        
        $ACTIONS= array();
        
        $VALUES = array();
       
        $ELEMENTS = array();
        
        $OPERATOR = "OR";
        
        $OPERATORS = $this->GET_OPERATOR();
        
        
        
        foreach($RULE as $key=>$rule){
            
            if(is_string($rule)){
            if(array_key_exists($rule,$OPERATORS)){
                
               //echo $rule;
               //echo "<br>";
                $OPERATOR = $OPERATORS[$rule];
           
          
                
            }else{
                
         
       
                
              
               
                 $value = $variables[$rule];
              
               
                
              
                
                $ELEMENTS[]=$value;
                
            }
            }else{
              
                
                $ELEMENTS[]= $this->GET_RULE($rule);
              
            }
        
            
        }
        
        
                    $OPERATORS ='';
            $TOTAL = count($ELEMENTS);
           
            foreach($ELEMENTS as $KEY=>$ELEMENT){

                if($OPERATOR=='IF' || $OPERATOR=='THEN'){
                 
                   
                    
               
                     
                 $OPERATORS .=$OPERATOR.'$ELEMENTS["'.$KEY.'"]';    
                  
                 
                 
                }else{
                   
                    if($KEY==$TOTAL-1){
                    
                       $OPERATORS .='$ELEMENTS["'.$KEY.'"]';
                    
                    
                    }else{
                        
                        $OPERATORS .='$ELEMENTS["'.$KEY.'"]'.$OPERATOR;
                        
                    }
                }
                
            }
            
            
            if (strpos($OPERATORS, 'THEN') !== false) {
                
        
            
            $THEN = explode('THEN',$OPERATORS);
          
            
            $OPERATORS =  'if('.$THEN[1].'){'.$THEN[2].'}';
            
            }
        
            echo "<br>";
            echo $OPERATORS;
            echo "<br>";
            echo "<br>";
            

        
        
        return "TRUE";
        
        
    }
    
    
    public function GET_FUZZY($LOGIC){
        
        $variables=array('var1'=>'11','var2'=>'21','var3'=>'81');
        
        $OPERATORS = $this->GET_OPERATOR();
      
        $RESULT = NULL;
         
            $ELEMENTS = array();
        
        if(is_array($LOGIC)){
            
           
            $OPERATOR ='&&';
            
           foreach($LOGIC as $KEY=>$ITEMS){
               
              
             
               
               
                
                   if(is_array($ITEMS)){
                
                       $EVALUATION = $this->GET_FUZZY($ITEMS);
                           $ELEMENTS[] = $EVALUATION;
                   
                   }else{
                    
                     if(array_key_exists($ITEMS,$OPERATORS)){
                       
                         $OPERATOR = $OPERATORS[$ITEMS];
                    }else{   
                       
                       
                    if(is_string($KEY)){
                        
                        
                      
                       
                        if($variables[$KEY]==$ITEMS){
                            $ELEMENTS[] = 1;
                        
                        }else{
                            $ELEMENTS[] = 0;
                          
                        }
                        
                        
                        
                    }
                    
                    }
                    
                  
                       
                    
                       
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
