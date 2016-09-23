<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of data
 *
 * @author aromerov
 */
class app_data {
    
    public $data;
    public $cache;
    public $hard;
    public $type;
    public $dns;
    public $step;
    public $currentStep='';
    public $sets = array();
    public $key_sets = array();
    public $union = array();
    public $intersection = array();
    public $difference = array();
    public $complement = array();
    public $symetric_difference = array();
    public $cartesian_product = array();
    public $power_set = array();
    public $result_key = array();
    public $result_set = array();
    public $dynamic_sets = array();
    public $static_sets = array();
    public $process_sets = array();
    
    public function __construct(app_redis $cache,app_hard $hard,app_soft $soft,app_model $model,app_type $type,app_load $network,app_dns $dns) {
  
  
    $this->cache = $cache;
    $this->hard = $hard;
    $this->soft = $soft;
    $this->model = $model;
    $this->type = $type;
    $this->network = $network;
    $this->dns = $dns;
    
    
    $this->step = array();

  
    $data =   $this->hard->SCANING('data');

    //echo $this->network->NET['net']['object']['section']->IMAGINE();
    
    //echo "<pre>";
    //var_dump($data);
    //
    //
    //
    //echo "</pre>";
    

  
   
   $getMap = $this->GRAPH('data.model.system.base');
   
   
   
   $this->NODE_ACTION('data.model.system.base',1);
   
   ///echo "<pre>";
   //var_dump($getMap);
   //echo "</pre>";
   
   
   $stepName = '/';
  

   
     
           
            $this->currentStep;

   
  
   
   


   
   
    
    
    
   
    //echo "<pre>";
    //var_dump($this->dynamic_sets['c']);
    //echo "</pre>";
    
    
    //echo "<pre>";
    //var_dump($this->process_sets['c']);
    //echo "</pre>";
    
   
//   echo "<pre>";
//   var_dump($this->step['dynamic']['set']);
//   echo "</pre>";
   
   //$getModel = $this->hard->GET_ENTITY_VALUE($getMap[0]['dynamic']['actions'][0]);
   

   
   $getMath = $this->hard->GET_ENTITY_VALUE('data.model.math.general');
   
  // $getSet = $this->hard->GET_ENTITY_VALUE($getMap[0]['dynamic']['set'][0]);
   
  // $getSpace = $this->hard->GET_ENTITY_VALUE($getMap[0]['dynamic']['space'][0]);
   
   $result = $this->model->GET_LOGIC($getMath['equation']);
   
 
   
   
   
    
   
   

 
    
    
   
   //echo "<pre>";
   //var_dump($this->sets);
   //echo "</pre>";
   
   //$this->model->SET_VARIABLES($getSet);
   
   
//   $union = array();
//   
//   
//   foreach($this->step['dynamic']['set'] as $key=>$set){
//       
//        
//       foreach($set as $key=>$st){
//           
//           if(isset($union[$key])){
//             $before = $union[$key];
//             
//             $after =  array_merge($before,$st);
//             
//            $union[$key] = $after;
//           }else{
//               
//             $union[$key] = $st; 
//               
//               
//           }
//           
//           
//       }
//       
//       
//       
//   }
   
   
   //echo "<pre>";
   //var_dump($union);
   //echo "</pre>";
   
   //$this->model->DIAGRAM($getMap);
    
   
  // $variables_process = $this->model->IN_RULE($getModel['data'],$getSet);
   
   
   //echo "<pre>";
   //var_dump($this->model->false);
   //echo "</pre>";
   
   //echo "<pre>";
   //var_dump($variables_process);
   //echo "</pre>";
    
   // $variables = $this->hard->GET_ENTITY_VALUE('data.default','default');
    

    
    
   // $VALUE=$this->hard->GET_VALUE($variables,'simple');
    
   // echo '<pre>';
   // var_dump($VALUE);
   // echo '</pre>';
    
    // $variables = $this->hard->SET_VALUE($variables,'simple.hard','west');
    
    
     
     //$this->hard->SET_ENTITY_VALUE('data.default','default', $variables);
     
     
     //$this->hard->SET_ENTITY('data.gold.finger.cuper.radio.base');
     
    //$VALUE = array("simple"=>array("golden","silver","fate","cuper"));
    
    //$this->hard->SET_ENTITY_VALUE('data.gold.finger.cuper.radio.base', $VALUE); 
    
    
  //  $VALUE = $this->hard->GET_ENTITY_VALUE('data.gold.finger.cuper.radio.base');
     
    //echo "<pre>";
    //var_dump($VALUE);
    //echo "</pre>";
    
  //  $NEW_VALUE=array('dagger'=>array("simple"=>"oil","hard"=>"carbon"));
    
  //  $this->hard->SET_ENTITY_VALUE('data.gold.finger.cuper.radio.base', $NEW_VALUE);
     //$this->hard->SET_ENTITY('data.silver.coin.spanish');
     
    // $this->hard->DELETE_ENTITY('data.silver');
     
     
    // $this->soft->SET_ENTITY('sun.shine');
   //$_id= $this->strToHex('su.sh.bo');
   
   //$_id= '00000000'.$_id;
   
   //echo strlen($_id);
   
   
     
   //$this->soft->SET_ENTITY_VALUE('sun.shine',array('_id' => new MongoId((string)$_id),"nick"=>"boticelli","data"=>array("text"=>"venus born")),'nick');
     
   //$this->soft->DELETE_ENTITY('sun.shine');
   
   //$this->soft->UPDATE_ENTITY_VALUE()
     
  // $values = $this->soft->GET_ENTITY_VALUE('sun.shine');
     
   
   //echo '<pre>';
   //var_dump($values);
   //echo '</pre>';
   
   
   //$this->soft->SEARCH_IN('sun.shine',array('nick','text'));
   
   //$val = $this->soft->SEARCH('sun.shine','golden');
   
   //echo "<pre>";
   //var_dump($val);
   //echo "</pre>";
   
   
   //$like = $this->soft->SEARCH_LIKE('sun.shine','nick','man');
   
   
   //echo '<br>';
   //var_dump($like);
   //echo '</br>';
   //$val = $this->soft->GET_VALUE($values,'golden');
   
   
   
   //$result=$this->soft->DELETE_VALUE('sun.shine',array('nick'=>'silverhouse'));
   
   //var_dump($result);
   
   
    }
    
    
    public function NODE_ACTION($ENTITY_GRAPH,$NODE){
        
        $getMap =  $this->hard->GET_ENTITY_VALUE($ENTITY_GRAPH);
        
        
        $this->model->SET_VARIABLES($this->dynamic_sets['a']);
         
        $ACTIONS = $getMap[$NODE]['actions'];
        
        foreach($ACTIONS as $ACTION){
            
            $ACTION_IN = $this->hard->GET_ENTITY_VALUE($ACTION);
            
            
               foreach($ACTION_IN as $KEY=>$AXION){
                
               if(isset($this->dynamic_sets[$KEY])){    
               $this->process_sets[$KEY] =  $this->model->IN_RULE($AXION,$this->dynamic_sets[$KEY]);
               } 
               }
          
       
          
                
         
            
        }
      
        
    }
    
    
    public function GRAPH($ENTITY_GRAPH){
        
        
       $getMap =  $this->hard->GET_ENTITY_VALUE($ENTITY_GRAPH);
       
       $result_sets=array();
       
       foreach($getMap as $k=>$nodes){
           
 
            foreach($nodes['input'] as $listen){

               $this->hard->SET_ENTITY_VALUE($listen, $this->dns->listen);
               
           }
           
           
        
           
           
           foreach($nodes['sets'] as $operations){
               
               if(is_string($operations)){
               $operation_sets = $this->hard->GET_ENTITY_VALUE($operations);
               
               foreach($operation_sets as $key=>$operation){
                   
                   
                   $this->dynamic_sets[$key] = $this->RULES_SETS($operation);
                   
                   
               }
               
               }else{
               $operation_sets = $operations;    
               }
           }
           
           
  
           
           
           
           
           
           

           
           
           
       }
       
       
    
    
        return $getMap;
        
        
    }
    
    
    public function RULES_SETS($rules){
        
      
        
        
           $result_set = $this->IN_SET($rules);
           
           
                        
           
           
           return $this->hard->GET_ENTITY_VALUE($result_set);
         
        
    }
    
    
    public function IN_SET($rules){
        
//        echo "<pre>";
//         var_dump($rules);
//        echo "</pre>"; 
        
          $_sets_in_operation = array();
          $type ='union';
          
          foreach($rules as $key=>$instructions){
              
              if($key==0){
                  $type = $instructions;
              }else{
                  if(is_array($instructions)){
                     $_sets_in_operation[$key] = $this->IN_SET($instructions);
                  }else{
                     $_sets_in_operation[$key]=$instructions; 
                  }
              }
              
          }
          
          
          
          
          $this->UPDATE_SETS($_sets_in_operation);
        
                  
          
          if($type=='union'){
  
            
              
              
            $result_sets  =$this->SET_UNION($_sets_in_operation);
              
          }
          
          
          if($type=='difference'){
              
           
              
             $result_sets =$this->SET_DIFFERENCE($_sets_in_operation);
              
          }
          
          
        
          
          return $result_sets;
        
        
    }
    
    
    public function UPDATE_SETS($sets){
       
        foreach($sets as $set){
            
            $this->UPDATE_SET($set);
           
            
        }
        
        
    }
    
    
    
    public function UPDATE_SET($ENTITY){
        
        
      
        
         $_LISTEN_SET = $this->dns->listen;
        
     
         
         $ENTITY_POST = str_replace('.','_',$ENTITY);
         
         
         if(isset($_LISTEN_SET[$ENTITY_POST])){
             
              $_SET = $this->hard->GET_ENTITY_VALUE($ENTITY);
              
              $_UPDATE_SET = $_LISTEN_SET[$ENTITY_POST];
                                 
             
              $this->IN_VALUE($_UPDATE_SET,$_SET);
              
         }
        
        
    }
    
    
    public function IN_VALUE($SET_UPDATE,$SET){
        
        
           
        
          
        

           echo "<pre>";
           var_dump($SET);
           echo "</pre>";           
        
    }
    
    
    
    public function SET_UNION($sets){
    

        
        $union = array();
        
        $sets_union = array();
        
        $result_set = array();
        
    
        
        foreach($sets as $set){
            
            $sets_union[] =  $this->hard->GET_ENTITY_VALUE($set);
            
        }  
        
        $this->KEY_SET($sets_union);  
        
           foreach($this->key_sets as $set_key){
              
             $keys = explode('.',$set_key);
              
          
             $value= $keys[0];
             
             array_shift($keys);
              
             
             $real_set_key = implode('.',$keys);
             
  
             
             
             if(!isset($this->union[$real_set_key])){
             $this->union[$real_set_key]= 1;
             }else{
             $this->union[$real_set_key]= 1 + $this->union[$real_set_key];
             }
             
          }
          
         foreach($this->union as $keys=>$uni){
              
            
                 $this->result_key[]=$keys;
             
              
          }
 
          
          foreach($sets_union as $key=>$set_in_union){
              
              
                     foreach($this->result_key as $result){
                         
                                      $shards = explode('.',$result);
                
                $in_operation ='';
                
                foreach($shards as $shard){
                    
                   $in_operation .='["'.$shard.'"]';
                    
                    
                }
                     
                     eval('if(isset($sets_union["'.$key.'"]'.$in_operation.')){  $result_set'.$in_operation.'  =$sets_union["'.$key.'"]'.$in_operation.';  }');
           
                
                
                     }
              
          }
          
          
 
          
          $this->hard->SET_ENTITY_VALUE('data.default.union', $result_set);
          
           return 'data.default.union';
          
    }
    
    
    
    
    
    public function SET_DIFFERENCE($sets){
        
        
          $difference =  array();
          $sets_differences = array();         
          $sets_keys = array();
          $result_set = array();
          
                 foreach($sets as $set){
                           
                       $sets_differences[] = $this->hard->GET_ENTITY_VALUE($set);  
       
                 }
          
          
          $this->KEY_SET($sets_differences);
 
       
          
          foreach($this->key_sets as $set_key){
              
             $keys = explode('.',$set_key);
              
          
             $value= $keys[0];
             
             array_shift($keys);
              
             
             $real_set_key = implode('.',$keys);
             
  
             
             
             if(!isset($this->difference[$real_set_key])){
             $this->difference[$real_set_key]= 1;
             }else{
             $this->difference[$real_set_key]= 1 + $this->difference[$real_set_key];
             }
             
          }
          
          
         
          foreach($this->difference as $keys=>$diff){
              
              if($diff==1){
                 $this->result_key[]=$keys;
              }
              
          }
          
          
       
      
          
          
          foreach($sets_differences as $key=>$set_in_difference){
              
              foreach($this->result_key as $result){
                  
                $shards = explode('.',$result);
                
                $in_operation ='';
                
                foreach($shards as $shard){
                    
                   $in_operation .='["'.$shard.'"]';
                    
                    
                }
                
                
                eval('if(isset($sets_differences["'.$key.'"]'.$in_operation.')){  $result_set'.$in_operation.'  =$sets_differences["'.$key.'"]'.$in_operation.';  }');
           
                
                  
              }
              
            
          }
          

          
          $this->hard->SET_ENTITY_VALUE('data.default.difference', $result_set);
          
       
                 
                 
          return 'data.default.difference';
          
    }
    
    
    
    
    
    
    public function KEY_SET($sets_differences,$KEY=''){
        
                 //echo "<pre>";
                 //var_dump($sets_differences);
                 //echo "</pre>";
        
                 foreach($sets_differences as $key=>$differences){
              
                     
                    
                    
                   if(is_array($differences)){
                       
                       if($KEY===''){
                       $this->KEY_SET($differences,$key);
                       }
                       else{
                        $this->KEY_SET($differences,$KEY.'.'.$key);    
                       }
                       
                   }else{
                       if($KEY===''){
                       $this->key_sets[] = $key;
                       
                       }else{
                       $this->key_sets[]= $KEY.'.'.$key;
                    
                       }
                       
                   }
                     
                     
                     //echo "<pre>";   
                     //var_dump($differences);
                     //echo "</pre>";
                  
              
                  }

        
    }
    
  
    public function strToHex($string)
    {
    $hex='';
    for ($i=0; $i < strlen($string); $i++)
    {
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
    }
    
    public function hexToStr($hex)
{
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2)
    {
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}


public function _encode_string_array ($stringArray) {
    $s = strtr(base64_encode(addslashes(gzcompress(serialize($stringArray),9))), '+/=', '-_,');
    return $s;
}

public function _decode_string_array ($stringArray) {
    $s = unserialize(gzuncompress(stripslashes(base64_decode(strtr($stringArray, '-_,', '+/=')))));
    return $s;
}


public function check_diff_multi($array1, $array2){
    $result = array();
    foreach($array1 as $key => $val) {
        if(array_key_exists($key,$array2)){
            if(is_array($val) && is_array($array2[$key]) && !empty($val)){
                $result[$key] = $this->check_diff_multi($val, $array2[$key]);
            }
        } else {
            $result[$key] = $val;
        }
    }
    return $result;
}
    //put your code here
}
