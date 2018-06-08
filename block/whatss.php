<?php

$parameters= $this->getNet('parameters');


$string="";

if(isset($parameters['request'])){
foreach($parameters['request'] as $key=>$param){

if(is_array($param)){

foreach($param as $k=>$value){
$string = $string.'\n'.$k.'::'.$value;
}

}
else{
$string = $string.'\n'.$key.':'.$param;
}


}
}
if($string!=''){
file_put_contents('./data/request.txt', $string);
}




?>

<form action="https://www.waboxapp.com/api/send/chat" id="send" method="get" >

<span>
<p>token</p>
<input name="token" value="" />
<br>
<p>uid</p>
<input name="uid" value="" />
<br>
<p>custom uid</p>
<input name="custom_uiid" value="" />
<br>
</span>
<br>
<span>
<p>Numero</p>
<input name="to" value="" />
</span>
<br>
<span>
<p>Mensaje</p>
<input name="text" value="" />
</span>
<br>

<input type="submit" value="enviar"  >


</form>
