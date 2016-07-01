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
class app_soft {
    
    public $hash;
    public $mongoDB;
    public $DB;
    public $mongoActive = FALSE;
    public $helper;
    
    //put your code here
    public function __construct($string = '0000000') {
  
    $this->hash = $string;     
    
    $this->connection();
 
    
    }
    
     /*
     * 
     *
     *
     */

    public function connection() {


        if (isset($_SERVER['SERVER_ADDR'])) {
            $currentHost = $_SERVER['SERVER_ADDR'];
        } else {
            $currentHost = '';
        }

        if ($currentHost == '127.0.0.1') {

            $host = '127.0.0.1';
            $database = 'general';
            $this->mongoDB = $database;
            $port = '27017';
            //$username = 'adrian';
            $username='general';
            $password = 'ak540zthe900';

            $connecting_string = sprintf('mongodb://%s:%d/%s', $host, $port, $database);
            try{
            $connection = new MongoClient($connecting_string, array('username' => $username, 'password' => $password));
            
            $this->DB = $connection->selectDB('general');
            $this->mongoActive = TRUE;
            }catch(Exception $e){
                $this->mongoActive = FALSE;
                $this->helper=$e;
            }
        } else {

# get the mongo db name out of the env
// $mongo_url = parse_url(getenv("MONGO_URL"));
//$dbname = str_replace("/", "", $mongo_url["path"]);

            $host = 'ds057224.mongolab.com';
            $database = 'heroku_91nxcxtf';
            $this->mongoDB = $database;
            $port = '57224';
            $username = 'general';
            $password = 'ak540zthe900';

            $connecting_string = sprintf('mongodb://%s:%d/%s', $host, $port, $database);
            
             try{
            $connection = new MongoClient($connecting_string, array('username' => $username, 'password' => $password));
            $this->DB = $connection->selectDB('heroku_91nxcxtf');
            $this->mongoActive = TRUE;
             }catch(Exception $e){
             $this->mongoActive = FALSE;    
             $this->helper=$e;   
             }
        }
    }
    
    
    public function GET_ENTITIES() {
        if($this->mongoActive){
        $dbname = $this->DB;
        $collections = $dbname->getCollectionNames();
        return $collections;
        }else{
        return array();    
        }
    }
    
    
  
    public function SET_ENTITY($ENTITY,$INDEX=FALSE){
       
        $db = $this->DB;
        
        $newCollection = $db->createCollection(
         $ENTITY,
          array(
             "autoIndexId" =>$INDEX
               )
          );
        
        
        
    }
    
    
    public function DELETE_ENTITY($ENTITY){
        
        $db = $this->DB;
        
        $collection = $db->$ENTITY;
        
        $response = $collection->drop();
        
        var_dump($response);
        
    }

    
    
     public function SET_ENTITY_VALUE($ENTITY,$VALUE,$SECURE_INDEX){
        
         
         
         
        $db = $this->DB;
        $collection = $db->$ENTITY;

        $indexes = $this->checkIndex($ENTITY);

        if (count($indexes) == 0) {

            $log = $collection->ensureIndex(array($SECURE_INDEX => 1), array('unique' => TRUE, 'dropDups' => TRUE));
//var_dump($log);
        }



        
            try {
                $collection->insert($VALUE);
            } catch (MongoCursorException $e) {
//var_dump($e);
                echo "no se puede guardar dos veces";
            }
        
         
         
         
         
     }
     
     
     
     public function GET_ENTITY_VALUE($ENTITY){
         
        if($this->mongoActive){ 
        $db = $this->DB;

        $collectionObject = $db->selectCollection($ENTITY)->find();

        $result = $this->encodeCollection($collectionObject);
        
        return $result;
        }else{
        return array();    
        }  
         
         
         
     }
     
     
      public function encodeCollection($collectionObject){
        
        $structureArray = array();
        
        foreach($collectionObject as $object){
            
            $structureArray[]=$object;
            
        }
        
        return $structureArray;
        
    }
     
     
    public function checkIndex($collection) {
        if($this->mongoActive){ 
        $indexSet = array();
        $dbname = $this->DB;
        $collection = $dbname->selectCollection($collection);

        $indexes = $collection->getIndexInfo();

        foreach ($indexes as $key => $index) {

            $nameIndex = $index['name'];

            $name_code = explode('_', $nameIndex);

            if ($name_code[0] == '') {
                $name = 'id';
                $indexSet[] = 'id';
            } else {
                $name = $name_code[0];
                $indexSet[] = $name;
            }
        }
        return $indexSet;
        }else{
        return array();   
        }
    }
    
    
    
    public function GET_VALUE($VARIABLE,$NAME){
        
        $values = $this->VALUE($VARIABLE,$NAME); 
        
     
        $VALUE = array();
        
        foreach($values as $key=>$val){

            
            if (strpos($key,$NAME) !== false) {
                
                $VALUE[$key]=$val;
                
            }
  
        } 
        
        
        return $VALUE;
        
    }
    
    
    public function SET_VALUE($VARIABLE,$SUB_ENTITY,$VALUE){
            
            
         $string_array = str_replace('.','"]["',$SUB_ENTITY);
   
         eval('$VARIABLE["'.$string_array.'"]=$VALUE;');
                 
         return $VARIABLE;
            
        
    }
    
    
    public function VALUE($VARIABLE){
    
        $this->SUB_ENTITY($VARIABLE);
        
        $subEntities = $this->subEntity;
        
        $this->subEntity=array();
        
        return $subEntities;
        
        
    }
    
    
   public function SUB_ENTITY($VARIABLE,$KEY=''){
        
        foreach($VARIABLE as $key=>$value){
            
       
            if(is_array($value)){
                if($KEY!=''){
                $_KEY = $KEY.'.'.$key;
                }else{
                $_KEY =$key;    
                }
                $this->subEntity[$_KEY]=$value;
                $this->SUB_ENTITY($value,$_KEY);
            }else{
                
                if($KEY!=''){
                $_KEY = $KEY.'.'.$key;
                }else{
                $_KEY =$key;    
                }
                $this->subEntity[$_KEY]=$value;
                
                
            }
            
        }
        
        
        
    }
    
    
    public function SEARCH($ENTITY, $searchWord, $limit = 1) {
        
        $result = array();
        $db = $this->DB;
        
        
        $collection = $db->$ENTITY;

$cursor = $collection->find(
    array(
        '$text' => array('$search' => "golden")
    )
);
        

       foreach($cursor as $field){
           
           $result[] = $field;
           
       }
  
       
       return $result;


    
    }
    
    
    public function SEARCH_IN($ENTITY,$FIELDS=array('text','nick')){
        
        //db.deals.ensureIndex({ name: "text", description : "text", category : "text" });
        
         $db = $this->DB;
         
         
         $collection = $db->$ENTITY;
         
         $ENSURE = array();
         
         foreach($FIELDS as $FIELD){
             
             $ENSURE[$FIELD]='text';
         }
         
        
        $ENSURE = $collection->ensureIndex($ENSURE);
     
        
        
    }
    
    
    public function SEARCH_LIKE($ENTITY, $index, $like) {
        $dbname = $this->DB;

        $result =array();
        
        $collection = $dbname->selectCollection($ENTITY);

        $regularExpression = array($index => new MongoRegex("/" . $like . "/i"));

        $cursor = $collection->find($regularExpression);

        
        
          foreach($cursor as $field){
           
           $result[] = $field;
           
       }
  
       
       return $result;
        
        
    }
    
    
        public function DELETE_VALUE($ENTITY, $data) {

        $dbname = $this->DB;
        $collection = $dbname->selectCollection($ENTITY);

        foreach ($data as $index => $value) {

            $find = $collection->find(array($index => array('$in' => array($value))));
            $counter = 0;
            foreach ($find as $found) {
                $counter++;
            }
            if ($counter != 0) {
                try {
                    $collection->remove(array($index => $value));
                } catch (MongoCursorException $e) {
                    echo $this->translate("No puedo Borrar porque no existe");
                }
            } else {
                return FALSE;
            }
        }
    }
       
}
