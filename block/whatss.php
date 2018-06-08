<?php

$parameters= $this->getNet('parameters');


if(isset($parameters['request'])){
foreach($parameters['request'] as $key=>$param){

echo $param.' ';


}
}

echo "whats app";

?>
