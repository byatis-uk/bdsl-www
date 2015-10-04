<?php
 $csvFile='csv/hist_award.csv';
 echo " <select class=\"normal\" onchange=\"location = this.options[this.selectedIndex].value;\">\n";
 echo "  <option selected>Select a title...\n";
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
         // declare an array to hold all of the contents of each row, indexed
         $buffer = fgetcsv($fd, 1024);
         // the 6 represents the number of columns in the text file
         for ($i = 0; $i < 6; ++$i){
            if ($i == 0 & $buffer[$i] != '') {
               $aCode = $buffer[$i];
            }
            if ($i == 1) {
               $aName = $buffer[$i];
            }
         }
         if ($buffer[0] != '') {
            echo "  <option class=\"normal\" value=\"archive.php?award=$aCode&season=\">$aName\n";
         }
 }
 fclose ($fd);
 echo " </select>\n";
?>
