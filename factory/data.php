<?php

require 'vendor/autoload.php';

use MongoDB\Driver\Manager;
use MongoDB\Database;

class data {

    public $config;
    public $mongoDB;
    public $DB;
    public $mongoActive = FALSE;
    public $helper;
    public $network;
    private $host;
    public $database;
    private $node;
    public $limit;
    public $entities = array();
    private $databases = array();
    private $weight = array();
    public $error;

    public function __construct() {
        
        if (isset($_SERVER['SERVER_ADDR'])) {
            $currentHost = $_SERVER['SERVER_ADDR'];
        } else {
            $currentHost = '';
        }
        $getConfig = array(
            "H" => array(
                     "host"=>"127.0.0.1",
                     "port"=>"27017",
                     "database"=>"profesion",
                     "username"=>"general",
                     "password"=>"papa700"
            ),
            "0" => array(
                    "host"=>"ds153123.mlab.com",
                    "port"=>"53123",
                    "database"=>"heroku_6fn1b5km",
                    "username"=>"general",
                    "password"=>"papa700"  
            )
        );
        if ($currentHost == '127.0.0.1') {
            $this->host = $getConfig["H"];
        } else {
            $this->host = $getConfig["0"];
        }
        $this->connection();
    }

    public function connection() {
        if (isset($_SERVER['SERVER_ADDR'])) {
            $currentHost = $_SERVER['SERVER_ADDR'];
        } else {
            $currentHost = '';
        }
        if ($currentHost == '127.0.0.1') {
            $host = $this->host['host'];
            $database = $this->host['database'];
            $this->mongoDB = $database;
            $port = $this->host['port'];
            $username = $this->host['username'];
            $password = $this->host['password'];
            $connecting_string = sprintf('mongodb://%s:%d/%s', $host, $port, $database);
            try {
                $connection = new MongoDB\Driver\Manager($connecting_string, array('username' => $username, 'password' => $password));
                $this->database = $this->host['database'];

                $this->DB = $connection;
                $this->mongoActive = TRUE;
            } catch (Exception $e) {

                $this->mongoActive = FALSE;
                $this->helper = $e;
            }
        } else {
            $host = $this->host['host'];
            $database = $this->host['database'];
            $this->mongoDB = $database;
            $port = $this->host['port'];
            $username = $this->host['username'];
            $password = $this->host['password'];
            $connecting_string = sprintf('mongodb://%s:%d/%s', $host, $port, $database);
            try {
                $connection = new MongoDB\Driver\Manager($connecting_string, array('username' => $username, 'password' => $password));
                $DB = $this->host['database'];
                $this->DB = $connection;
                $this->mongoActive = TRUE;
            } catch (Exception $e) {
                $this->mongoActive = FALSE;
                $this->helper = $e;
            }
        }
    }

    public function DATABASES() {
        if ($this->mongoActive) {
            $dbname = $this->DB;
            $command = new MongoDB\Driver\Command(['listDatabases' => 1]);
            try {
                $cursor = $dbname->executeCommand('admin', $command);
                $response = $cursor->toArray()[0];
                foreach ($response as $DBs) {
                    if (is_array($DBs)) {
                        foreach ($DBs as $dbs) {
                            $this->databases[$dbs->name] = $dbs->sizeOnDisk;
                        }
                    }
                }
            } catch (Exception $e) {
                var_dump($e);
            }
            return $this->databases;
        }
    }

    public function COLLECTIONS($database) {
        try {
            if ($this->mongoActive) {
                $dbname = $this->DB;
                $list = new MongoDB\Driver\Command((['listCollections' => 1]));
                $mlist = $dbname->executeCommand($database, $list);
                $res = $mlist->toArray();
                foreach ($res as $data) {
                    $this->entities[] = $data->name;
                }
            }
            return $this->entities;
        } catch (Error $e) {
            return array("exist" => "false");
        }
    }

    public function GET_INDEX($DATABASE, $ENTITY) {
        $COLLECTION = (new MongoDB\Client)->$DATABASE->$ENTITY;
        foreach ($COLLECTION->listIndexes() as $index) {
            var_dump($index);
        }
    }

    public function ENTITY($entity) {
        
    }

    public function SET($entity, $variables) {
        
    }

    public function GET($collection,$entity, $value) {
        $filter = [$entity=>$value];
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
 $manager = $this->DB;
 $database = $this->host['database'];
$rows = $manager->executeQuery($database.'.'.$collection, $query); // $mongo contains the connection object to MongoDB
 $result = iterator_to_array($rows);
$result = json_decode(json_encode($result), True);
 
 return $result;

    }
    
    
    
   
    
    public function GET_COLLECTIONS(){
        
        
        
        
    }
    
    
    public function SET_COLLECTIONS(){
        
        
        
    }
    
    
    public function GET_VARIABLE(){
        
        
        
    }
    
    
    public function SET_VARIABLE(){
        
        
        
    }
    
    
    
    
    
    
    public function GET_ENTITIES($collection,$attribute){
        
                $filter = ['attribute'=>$attribute];
        $options = [];
        $query = new MongoDB\Driver\Query($filter, $options);
        $manager = $this->DB;
        $database = $this->host['database'];
        $rows = $manager->executeQuery($database.'.'.$collection, $query); // $mongo contains the connection object to MongoDB
        $result = iterator_to_array($rows);
        $result = json_decode(json_encode($result), True);
 
        unset($result[0]['_id']);
        
        return $result[0];
        
        
    }
    
    
    public function GET_VALUES($collection,$variable,$value){
        
       
        
        $filter = ['entity'=>'store'];
        $options = [];
        $query = new MongoDB\Driver\Query($filter, $options);
        $manager = $this->DB;
        $database = $this->host['database'];
        $rows = $manager->executeQuery($database.'.'.$collection, $query); // $mongo contains the connection object to MongoDB
        $result = iterator_to_array($rows);
        $result = json_decode(json_encode($result), True);
 
        
        unset($result[0]['_id']);
        
        return $result[0];
        
        
    }
    
    
    
    public function GET_ATTRIBUTES($collection,$entity){
        
        
        $filter = ['entity'=>$entity];
        $options = [];
        $query = new MongoDB\Driver\Query($filter, $options);
        $manager = $this->DB;
        $database = $this->host['database'];
        $rows = $manager->executeQuery($database.'.'.$collection, $query); // $mongo contains the connection object to MongoDB
        $result = iterator_to_array($rows);
        $result = json_decode(json_encode($result), True);
 
        unset($result[0]['_id']);
        
        return $result[0];
        
        
    }
    
    public function EAV($collection,$entity,$attribute){
        
        
        $filter = ['attribute'=>$attribute,'entity'=>$entity];
        $options = [];
        $query = new MongoDB\Driver\Query($filter, $options);
        $manager = $this->DB;
        $database = $this->host['database'];
        $rows = $manager->executeQuery($database.'.'.$collection, $query); // $mongo contains the connection object to MongoDB
        $result = iterator_to_array($rows);
        $result = json_decode(json_encode($result), True);
 
        unset($result[0]['_id']);
        
        return $result[0];
        
        
    }
    
    
    public function GET_AND($collection,$entities){
        
 // $filter = ['$and'=>array(array('state'=>'Distrito Federal'),array($entity=>$value))];
        
         $filter = ['$and'=>$entities];
        
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
 $manager = $this->DB;
 $database = $this->host['database'];
$rows = $manager->executeQuery($database.'.'.$collection, $query); // $mongo contains the connection object to MongoDB
 $result = iterator_to_array($rows);
$result = json_decode(json_encode($result), True);
 
 return $result;
        
    }
    
    

    public function COLLECTION($entity) {
        $result = array("error" => "TRUE");
        $manager = $this->DB;
        $collections = $this->COLLECTIONS($this->host["database"]);
        if (in_array($entity, $collections)) {
            $query = new MongoDB\Driver\Query([], []);
            $database = $this->host['database'];
            $rows = $manager->executeQuery($database . "." . $entity, $query);
            $result = iterator_to_array($rows);
            $result = json_decode(json_encode($result), True);
            if (count($result) == 0) {
                $result = array("error" => "empty");
            }
            return $result;
        } else {
            if ($this->mongoActive) {
// $command = new MongoDB\Driver\Command([
//  "create" => $entity
//  ]);
// $result = $manager->executeCommand("veterinarica", $command);
// $result = array("error"=>"created");
            }
            return $result;
        }
    }

    public function PUSH($collectionId, $entities = array()) {
        $response = array();
        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);
        foreach ($entities as $entity) {
            $bulk->insert($entity);
        }
        $manager = $this->DB;
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        try {
            $result = $manager->executeBulkWrite($this->host['database'] . '.' . $collectionId, $bulk, $writeConcern);
        } catch (MongoDB\Driver\Exception\BulkWriteException $e) {
            $result = $e->getWriteResult();
            if ($writeConcernError = $result->getWriteConcernError()) {
                return $this->ERROR($writeConcernError);
            }
            foreach ($result->getWriteErrors() as $writeError) {
                $this->ERROR($writeError);
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            $this->ERROR($e->getMessage());
            exit;
        }
        $response["result"] = $result->getInsertedCount();
        $response["total"] = $result->getModifiedCount();
        return $response;
    }

    public function POP($collectionId, $entitiesIds = array()) {
        $pop = null;
        $filter = array();
        $options = [];
        $manager = $this->DB;
        foreach ($entitiesIds as $ids) {
            $filter = ['id' => $ids];
            $query = new MongoDB\Driver\Query($filter, $options);
            $database = $this->host['database'];
            $rows = $manager->executeQuery($database . "." . $collectionId, $query); // $mongo contains the connection object to MongoDB
            $array = json_decode(json_encode($rows), True);
            foreach ($rows as $r) {
                $pop[] = json_decode(json_encode($r), True);
            }
        }
        return $pop;
    }

    public function SEARCH($collectionId, $variable = "word", $like, $num, $page) {
       
        $like = str_replace(array('/'), array('.'), $like);
        $limit = $num;
        $skip = ($page - 1) * $limit;
        $manager = $this->DB;
        $database = $this->host['database'];
        $regex = new MongoDB\BSON\Regex($like, 'i');
        $filter = array($variable => $regex);
        $options = ["sort" => array($variable => 1), "skip" => $skip, "limit" => $limit];
        $query = new MongoDB\Driver\Query($filter, $options);
        
        $rows = $manager->executeQuery($database . "." . $collectionId, $query); // $mongo contains the connection object to MongoDB
        $rows = iterator_to_array($rows);
        $command = new \MongoDB\Driver\Command(['count' => $collectionId, 'query' => $filter]);
        $total = $manager->executeCommand($database, $command);
     
        $total = iterator_to_array($total);
        $total = (array) $total[0];
        $total["page"] = $page;
        $total["limit"] = $limit;
        $total["search"] = $like;
        $total["variable"] = $variable;
        $total = (object) $total;
        array_unshift($rows, $total);
        $total = json_decode(json_encode($rows), True);
        return $total;
    }

}

