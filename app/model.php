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
    
    
    public $rule = array();
    
    public function __construct($string = '0000000') {
  
    $this->hash = $string;    
    
    $this->rule =array();

    
    }
    
    

    
    
    public function SET_VARIABLES($variables,$key=''){
     
        
        foreach($variables as $variable=>$value){
            
            
           if(is_numeric($variable)){
              
           eval('if(!isset($this->'.$key.')){  $this->'.$key.'['.$variable.']=$value; }');    
               
           }else{
                 
           eval('if(!isset($this->'.$variable.')){  $this->'.$variable.'=$value;  }');
            
           }
       
           
           
           if(is_array($value)){
               
               $this->SET_VARIABLES($value,$variable);
               
           }
//               
//               
//               
           }
            
            
        }
        
        
    
    
    
    public function DIAGRAM($diagram){
        
        
        foreach($diagram as $steps){
            
            //echo "<pre>";
            //var_dump($steps['dynamic']);
            //echo "</pre>";
            
            echo "<pre>";
            var_dump($steps['state']);
            echo "</pre>";
            
            //echo "<pre>";
            //var_dump($steps['static']);
            //echo "</pre>";
            
            
        }
        
        
        
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
    

    
    
       public function IN_RULE($RULE,$VARIABLES){
           
           $_VARIABLES=array();
           
           $result=$this->RULE($RULE,$VARIABLES);
           
           
          foreach($VARIABLES as $variable=>$value){
              
              if(!is_array($value)){
                
                   if(!is_numeric($value)){
                       $value = "'".$value."'";
                   }
               
              eval('$'.$variable.'='.$value.';');
              }else{
                  
               $this->TO_CODE($value);
                  
              eval('$'.$variable.'=$value;');

              }
              
          }
 
           //echo $result;

           
           eval($result);
 
           $_set_value = FALSE;
           
     
           foreach($VARIABLES as $variable=>$value){
              
               eval('if(isset($this->'.$variable.')){ $_set_value = TRUE;}else{ $_set_value = FALSE; }');
              
               eval('if($_set_value==TRUE){ $_VARIABLES["'.$variable.'"]= $this->'.$variable.';  }');
              
               
               
           }
           
           

          return $_VARIABLES; 
        
        
      }  
      
    public function TO_CODE($variables){
        
        $this->TO_STRING($variables);
        
        
    }  
    
    public function TO_STRING($variables,$key_set=''){
        
           //echo "<pre>";
           //var_dump($variables);
           //echo "</pre>";
        
         foreach($variables as $key=>$value){

               if(is_string($value)){
                   
                 
                  
                   if(!is_numeric($key)){
                   eval("$".$key."='".$value."';");
                  
                   }else{
                  
                   eval('if(!isset($'.$key_set.')){ $'.$key_set.'= array(); }');    
                       
                   eval("$".$key_set."[".$key."]='".$value."';");
                 
                   }
                   
               }else{
                   
                        
                   
                       foreach($value as $k=>$v){
                          
                          eval('if(!isset($'.$key.')){ $'.$key.'= array(); }'); 
                       
                          eval('$'.$key.'["'.$k.'"]=$v;');
                           
                       }
                       
             
      
                       $this->TO_STRING($value,$key);
                   
               }              
             
         }
        
    }
    
    
    public function RULE($RULE,$variables){
        

       
        $Sentence='';
       
        $CurrentRule='';
               
        foreach($RULE as $key=>$rule){
        
           if(is_string($rule)){
               
             
               
               if($rule=='IF'){
               $Sentence .= 'if(';
               $CurrentRule = $rule;
               }elseif($rule=='THEN'){
               
               $CurrentRule = $rule;    
               }
               elseif($rule=='IS EQUAL'){
                   
               $CurrentRule = '=';    
               }
               elseif($rule=='EQUAL'){
                   
               $CurrentRule = '==';    
               }elseif($rule=='GREATER THAN'){
                
               $CurrentRule ='>';     
               }
               elseif($rule=='AND'){
               $CurrentRule ='AND';
               $Sentence .=$rule.'';
              
               }
               elseif($rule=='OR'){
               $CurrentRule ='OR';
               $Sentence .=$rule.'';
              
               }               
               else{
                
                 
                   
               $Sentence .= $rule;
               }
               
               if(isset($variables[$rule])){
                   
                   if(is_numeric($rule)){
                   $rule = $variables[$rule];
                   }else{
                   $rule = '$this->'.$rule;    
                   }
                   
               }else{
                  
                   $rule = '$this->'.$rule;
                  
               }
               
               $RULE[$key] = $rule;
               
           }else{
               
                $Sentence .= $this->RULE($rule,$variables);
                
                $RULE[$key] = $this->RULE($rule,$variables);
               
           }   
            
            
        }
        
        
        if($CurrentRule=='IF'){
            $Sentence .= '){';
        }elseif($CurrentRule=='THEN'){
            
            
            
               
            $total = count($RULE)-1;

            
            $final = count($RULE) -1;
            
            $_SENTENCE='';
            
            for($i=1;$i<=$total;$i++){
                
                  if($i==1){
                  $_SENTENCE .=$RULE[$i];
                  }else{
                  $_SENTENCE .=$RULE[$i].';';    
                  }
            }
            
            
        
          
            
            $Sentence = $_SENTENCE.'}';
            
        }elseif($CurrentRule=='=='){
           
          
            
            $total = count($RULE) - 2;

            
            $final = count($RULE) -1;
            
            
            for($i=1;$i<=$total;$i++){
             
                $Sentence = $RULE[$i].'==';
                
            }
            
              $Sentence .= $RULE[$final];
            
            
            $Sentence = ' '.$Sentence;
        }elseif($CurrentRule=='='){
           
          
            
            $total = count($RULE) - 2;

            
            $final = count($RULE) -1;
            
            
            for($i=1;$i<=$total;$i++){
             
                $Sentence = $RULE[$i].'=';
                
            }
            
              $Sentence .= $RULE[$final];
            
            
            $Sentence = ' '.$Sentence;
        }
        elseif($CurrentRule=='>'){
            
                      $total = count($RULE) - 1;

            
            $final = count($RULE) -1;
            
            $Sentence ='';
            
            for($i=1;$i<=$total;$i++){
             
              
                if($i==$total){
                $Sentence .= $RULE[$i];    
                }else{
                $Sentence .= $RULE[$i].' >';
                }
                
            }
            
               
            
            
                      
            
    
            
            
        }elseif($CurrentRule=='AND'){
            
            $total = count($RULE) - 1;

            
            $final = count($RULE) -1;
            
            $Sentence ='';
            
            for($i=1;$i<=$total;$i++){
             
              
                if($i==$total){
                $Sentence .= $RULE[$i];    
                }else{
                $Sentence .= $RULE[$i].' &&';
                }
                
            }
            
               
            
            
            $Sentence = '('.$Sentence.')';
            
              
        }elseif($CurrentRule=='OR'){
            
         $total = count($RULE) - 1;

            
            $final = count($RULE) -1;
            
            $Sentence ='';
            
            for($i=1;$i<=$total;$i++){
             
             
                if($i==$total){
                $Sentence .= $RULE[$i];    
                }else{
                $Sentence .= $RULE[$i].' ||';
                }
                
            }
            
               
            
            
            $Sentence = '('.$Sentence.')';           
            
              
        }
                
    
        
        return $Sentence;
        
        
        
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
            
            
          
        
            echo "<br>";
            echo "IO:".$OPERATORS;
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
            
            if($OPERATORS==''){
               $OPERATORS .='NULL'; 
            }
            
            echo '$RESULT ='.$OPERATORS.';';
            echo "<br>";
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
