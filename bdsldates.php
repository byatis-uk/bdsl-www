<?php
   $fd = fopen ('csv/bdslseason.txt', "r");
   $bdslSeason = fgets($fd, 1024);
   fclose ($fd);
   
   $fd = fopen ('csv/bdslbankhols.txt', "r");
   $bdslBankHols = fgets($fd, 1024);
   fclose ($fd);   
?>