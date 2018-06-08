<?php

$parameters= $this->getNet('parameters');




if(isset($parameters['request'])){
foreach($parameters['request'] as $key=>$param){
var_dump($key);
var_dump($param);


}
}

echo "whats app";

?>
