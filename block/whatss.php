<?php

$parameters= $this->getNet('parameters');


foreach($_POST as $parammeter){

echo $parammeter.' ';



}

if(isset($parameters['request'])){
foreach($parameters['request'] as $key=>$param){

echo $param.' ';


}
}

echo "whats app";

?>
