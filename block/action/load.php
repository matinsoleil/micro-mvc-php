<?php

require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client("mongodb://localhost:27017");

$handle = fopen("./history/TESSEN.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
       $LINE = explode(']',$line);
       if(isset($LINE['1'])){

      $TAGS = $LINE['1'];

          $TAG  = explode(':',$TAGS);



        $TG = str_replace(array('Salvador Pérez','Aldo Angulo','Miguel Cruz','Andrea Ramírez'),'support',$TAG[0]);


        if(isset($TAG['1'])){
        echo $TAG['1'];
        }
        }
         echo "<br>";
    }

    fclose($handle);
} else {
    // error opening the file.
}

?>
