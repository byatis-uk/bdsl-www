<?php
   $localTime=time();
   $localTime=$localTime - (60 * 60 * 1);
   $chkDay = date("j",$localTime);
   $chkMonth = date("n",$localTime);
   // process csv file
   $fd = fopen ('csv/ukholiday.csv', "r");
   // initialize a loop to go through each line of the file
   while (!feof ($fd)) {
      // declare an array to hold all of the contents of each row, indexed
      $buffer = fgetcsv($fd, 4096);
      // the 10 represents the number of columns in the text file
      for ($i = 0; $i < 10; ++$i){
         if ($i == 0){ $holDay = $buffer[$i]; }
         if ($i == 1){ $holMonth = $buffer[$i]; }
         if ($i == 2){ $holAlt = $buffer[$i]; }
         if ($i == 3){ $holLink = $buffer[$i]; }
         if ($i == 4){ $holGifL = $buffer[$i]; }
         if ($i == 5){ $holGifHL = $buffer[$i]; }
         if ($i == 6){ $holGifWL = $buffer[$i]; }
         if ($i == 7){ $holGifR = $buffer[$i]; }
         if ($i == 8){ $holGifHR = $buffer[$i]; }
         if ($i == 9){ $holGifWR = $buffer[$i]; }
      }
      if ($chkDay == $holDay & $chkMonth == $holMonth){
         if ($holGifL != ""){
            echo "      <img src=\"/resource/$holGifL\" hspace=\"10\" border=\"0\" align=\"left\" alt=\"$holAlt\" height=\"$holGifHL\" width=\"$holGifWL\">\n";
         }
         if ($holGifR != ""){
            echo "      <img src=\"/resource/$holGifR\" hspace=\"10\" border=\"0\" align=\"right\" alt=\"$holAlt\" height=\"$holGifHR\" width=\"$holGifWR\">\n";
         }
      }
   }
   fclose ($fd);
?>