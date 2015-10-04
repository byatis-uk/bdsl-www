<?php
 // returns $thisSeason (e.g. 2014/2015)
 $txtS = 'csv/bdslseason.txt'; 
 $fd = fopen ("$txtS", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 256);
	for ($i = 0; $i < 1; ++$i){
       if ($i == 0 && $buffer[$i] != ''){ $thisSeason = $buffer[$i]; }
    }
 }
?>