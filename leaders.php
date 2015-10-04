<?php
 echo "\n   <!-- begin leaders php -->\n";
 echo "      <table class=\"border\">\n";
 $csvFile = 'csv-tables/tableP.csv';
 $div = 'P';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
   // declare an array to hold all of the contents of each row, indexed
   $buffer = fgetcsv($fd, 4096);
   // the 7 represents the number of columns in the text file
   for ($i = 0; $i < 7; ++$i){
      if ($i == 0){ $fld0 = $buffer[$i]; }
      if ($i == 1){ $fld1 = $buffer[$i]; }
      if ($i == 2){ $fld2 = $buffer[$i]; }
      if ($i == 3){ $fld3 = $buffer[$i]; }
      if ($i == 4){ $fld4 = $buffer[$i]; }
      if ($i == 5){ $fld5 = $buffer[$i]; }
      if ($i == 6){ $fld6 = $buffer[$i]; }
   }
   ++$fCnt;
   if ($fCnt == 3) {
      echo "       <tr>\n";
      echo "        <td nowrap class=\"hdrsmall\" colspan=\"2\">Division Leaders</td>\n";
      echo "        <td nowrap class=\"hdrsmall\">$fld1</td>\n";
      echo "        <td nowrap class=\"hdrsmall\">$fld2</td>\n";
      echo "        <td nowrap class=\"hdrsmall\">$fld3</td>\n";
      echo "        <td nowrap class=\"hdrsmall\">$fld4</td>\n";
      echo "        <td nowrap class=\"hdrsmall\">$fld5</td>\n";
      echo "        <td nowrap class=\"hdrsmall\">$fld6</td>\n";
      echo "       </tr>\n";
   }
   if ($fCnt == 4) {
      $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
      $outFld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
      $outFld1 = $fld1;
      $outFld2 = $fld2;
      $outFld3 = $fld3;
      $outFld4 = $fld4;
      $outFld5 = $fld5;
      $points = $fld5;
      $outFld6 = $fld6;
   }
   if ($fCnt == 5) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
   }
   if ($fCnt == 6) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
      }
   }
   if ($fCnt == 7) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
      }
      echo "       <tr>\n";
      echo "        <td nowrap class=\"normalcenter\"><a href=\"table.php?div=P\" title=\"&raquo; open Premier Division table and results page\">Prem</a></td>\n";
      echo "        <td nowrap class=\"normal\">$outFld0</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld1</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld2</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld3</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld4</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld5</td>\n";
      echo "        <td nowrap class=\"normal\">$outFld6</td>\n";
      echo "       </tr>\n";
   }
 }
 fclose ($fd);
 $csvFile = 'csv-tables/table1.csv';
 $div = '1';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
   // declare an array to hold all of the contents of each row, indexed
   $buffer = fgetcsv($fd, 4096);
   // the 7 represents the number of columns in the text file
   for ($i = 0; $i < 7; ++$i){
      if ($i == 0){ $fld0 = $buffer[$i]; }
      if ($i == 1){ $fld1 = $buffer[$i]; }
      if ($i == 2){ $fld2 = $buffer[$i]; }
      if ($i == 3){ $fld3 = $buffer[$i]; }
      if ($i == 4){ $fld4 = $buffer[$i]; }
      if ($i == 5){ $fld5 = $buffer[$i]; }
      if ($i == 6){ $fld6 = $buffer[$i]; }
   }
   ++$fCnt;
   if ($fCnt == 4) {
      $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
      $outFld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
      $outFld1 = $fld1;
      $outFld2 = $fld2;
      $outFld3 = $fld3;
      $outFld4 = $fld4;
      $outFld5 = $fld5;
      $points = $fld5;
      $outFld6 = $fld6;
   }
   if ($fCnt == 5) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
   }
   if ($fCnt == 6) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
      }
   }
   if ($fCnt == 7) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
      }
      echo "       <tr>\n";
      echo "        <td nowrap class=\"normalcenter\"><a href=\"table.php?div=1\" title=\"&raquo; open Division 1 table and results page\">Div 1</a></td>\n";
      echo "        <td nowrap class=\"normal\">$outFld0</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld1</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld2</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld3</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld4</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld5</td>\n";
      echo "        <td nowrap class=\"normal\">$outFld6</td>\n";
      echo "       </tr>\n";
   }
 }
 fclose ($fd);
 $csvFile = 'csv-tables/table2.csv';
 $div = '2';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
   // declare an array to hold all of the contents of each row, indexed
   $buffer = fgetcsv($fd, 4096);
   // the 7 represents the number of columns in the text file
   for ($i = 0; $i < 7; ++$i){
      if ($i == 0){ $fld0 = $buffer[$i]; }
      if ($i == 1){ $fld1 = $buffer[$i]; }
      if ($i == 2){ $fld2 = $buffer[$i]; }
      if ($i == 3){ $fld3 = $buffer[$i]; }
      if ($i == 4){ $fld4 = $buffer[$i]; }
      if ($i == 5){ $fld5 = $buffer[$i]; }
      if ($i == 6){ $fld6 = $buffer[$i]; }
   }
   ++$fCnt;
   if ($fCnt == 4) {
      $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
      $outFld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
      $outFld1 = $fld1;
      $outFld2 = $fld2;
      $outFld3 = $fld3;
      $outFld4 = $fld4;
      $outFld5 = $fld5;
      $points = $fld5;
      $outFld6 = $fld6;
   }
   if ($fCnt == 5) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
   }
   if ($fCnt == 6) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
      }
   }
   if ($fCnt == 7) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
      }
      echo "       <tr>\n";
      echo "        <td nowrap class=\"normalcenter\"><a href=\"table.php?div=2\" title=\"&raquo; open Division 2 table and results page\">Div 2</a></td>\n";
      echo "        <td nowrap class=\"normal\">$outFld0</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld1</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld2</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld3</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld4</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld5</td>\n";
      echo "        <td nowrap class=\"normal\">$outFld6</td>\n";
      echo "       </tr>\n";
   }
 }
 fclose ($fd);
 $csvFile = 'csv-tables/table3.csv';
 $div = '3';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
   // declare an array to hold all of the contents of each row, indexed
   $buffer = fgetcsv($fd, 4096);
   // the 7 represents the number of columns in the text file
   for ($i = 0; $i < 7; ++$i){
      if ($i == 0){ $fld0 = $buffer[$i]; }
      if ($i == 1){ $fld1 = $buffer[$i]; }
      if ($i == 2){ $fld2 = $buffer[$i]; }
      if ($i == 3){ $fld3 = $buffer[$i]; }
      if ($i == 4){ $fld4 = $buffer[$i]; }
      if ($i == 5){ $fld5 = $buffer[$i]; }
      if ($i == 6){ $fld6 = $buffer[$i]; }
   }
   ++$fCnt;
   if ($fCnt == 4) {
      $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
      $outFld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
      $outFld1 = $fld1;
      $outFld2 = $fld2;
      $outFld3 = $fld3;
      $outFld4 = $fld4;
      $outFld5 = $fld5;
      $points = $fld5;
      $outFld6 = $fld6;
   }
   if ($fCnt == 5) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
   }
   if ($fCnt == 6) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
      }
   }
   if ($fCnt == 7) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
      }
      echo "       <tr>\n";
      echo "        <td nowrap class=\"normalcenter\"><a href=\"table.php?div=3\" title=\"&raquo; open Division 3 table and results page\">Div 3</a></td>\n";
      echo "        <td nowrap class=\"normal\">$outFld0</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld1</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld2</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld3</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld4</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld5</td>\n";
      echo "        <td nowrap class=\"normal\">$outFld6</td>\n";
      echo "       </tr>\n";
   }
 }
 fclose ($fd);
 $csvFile = 'csv-tables/table4.csv';
 $div = '4';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
   // declare an array to hold all of the contents of each row, indexed
   $buffer = fgetcsv($fd, 4096);
   // the 7 represents the number of columns in the text file
   for ($i = 0; $i < 7; ++$i){
      if ($i == 0){ $fld0 = $buffer[$i]; }
      if ($i == 1){ $fld1 = $buffer[$i]; }
      if ($i == 2){ $fld2 = $buffer[$i]; }
      if ($i == 3){ $fld3 = $buffer[$i]; }
      if ($i == 4){ $fld4 = $buffer[$i]; }
      if ($i == 5){ $fld5 = $buffer[$i]; }
      if ($i == 6){ $fld6 = $buffer[$i]; }
   }
   ++$fCnt;
   if ($fCnt == 4) {
      $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
      $outFld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
      $outFld1 = $fld1;
      $outFld2 = $fld2;
      $outFld3 = $fld3;
      $outFld4 = $fld4;
      $outFld5 = $fld5;
      $points = $fld5;
      $outFld6 = $fld6;
   }
   if ($fCnt == 5) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
   }
   if ($fCnt == 6) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
      }
   }
   if ($fCnt == 7) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
      }
      echo "       <tr>\n";
      echo "        <td nowrap class=\"normalcenter\"><a href=\"table.php?div=4\" title=\"&raquo; open Division 4 table and results page\">Div 4</a></td>\n";
      echo "        <td nowrap class=\"normal\">$outFld0</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld1</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld2</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld3</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld4</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld5</td>\n";
      echo "        <td nowrap class=\"normal\">$outFld6</td>\n";
      echo "       </tr>\n";
   }
 }
 fclose ($fd);
 $csvFile = 'csv-tables/table5.csv';
 $div = '5';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
   // declare an array to hold all of the contents of each row, indexed
   $buffer = fgetcsv($fd, 4096);
   // the 7 represents the number of columns in the text file
   for ($i = 0; $i < 7; ++$i){
      if ($i == 0){ $fld0 = $buffer[$i]; }
      if ($i == 1){ $fld1 = $buffer[$i]; }
      if ($i == 2){ $fld2 = $buffer[$i]; }
      if ($i == 3){ $fld3 = $buffer[$i]; }
      if ($i == 4){ $fld4 = $buffer[$i]; }
      if ($i == 5){ $fld5 = $buffer[$i]; }
      if ($i == 6){ $fld6 = $buffer[$i]; }
   }
   ++$fCnt;
   if ($fCnt == 4) {
      $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
      $outFld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
      $outFld1 = $fld1;
      $outFld2 = $fld2;
      $outFld3 = $fld3;
      $outFld4 = $fld4;
      $outFld5 = $fld5;
      $points = $fld5;
      $outFld6 = $fld6;
   }
   if ($fCnt == 5) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
   }
   if ($fCnt == 6) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
      }
   }
   if ($fCnt == 7) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
      }
      echo "       <tr>\n";
      echo "        <td nowrap class=\"normalcenter\"><a href=\"table.php?div=5\" title=\"&raquo; open Division 5 table and results page\">Div 5</a></td>\n";
      echo "        <td nowrap class=\"normal\">$outFld0</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld1</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld2</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld3</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld4</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld5</td>\n";
      echo "        <td nowrap class=\"normal\">$outFld6</td>\n";
      echo "       </tr>\n";
   }
 }
 fclose ($fd);
 $csvFile = 'csv-tables/table6.csv';
 $div = '6';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
   // declare an array to hold all of the contents of each row, indexed
   $buffer = fgetcsv($fd, 4096);
   // the 7 represents the number of columns in the text file
   for ($i = 0; $i < 7; ++$i){
      if ($i == 0){ $fld0 = $buffer[$i]; }
      if ($i == 1){ $fld1 = $buffer[$i]; }
      if ($i == 2){ $fld2 = $buffer[$i]; }
      if ($i == 3){ $fld3 = $buffer[$i]; }
      if ($i == 4){ $fld4 = $buffer[$i]; }
      if ($i == 5){ $fld5 = $buffer[$i]; }
      if ($i == 6){ $fld6 = $buffer[$i]; }
   }
   ++$fCnt;
   if ($fCnt == 4) {
      $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
      $outFld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
      $outFld1 = $fld1;
      $outFld2 = $fld2;
      $outFld3 = $fld3;
      $outFld4 = $fld4;
      $outFld5 = $fld5;
      $points = $fld5;
      $outFld6 = $fld6;
   }
   if ($fCnt == 5) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
   }
   if ($fCnt == 6) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
         $points = $fld5;
      }
   }
   if ($fCnt == 7) {
      if ($fld5 == $points) {
         $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
         $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">&nbsp;$fld0&nbsp;</a>";
         $outFld0 = $outFld0 . '<br>' . $fld0;
         $outFld1 = $outFld1 . '<br>' . $fld1;
         $outFld2 = $outFld2 . '<br>' . $fld2;
         $outFld3 = $outFld3 . '<br>' . $fld3;
         $outFld4 = $outFld4 . '<br>' . $fld4;
         $outFld5 = $outFld5 . '<br>' . $fld5;
         $outFld6 = $outFld6 . '<br>' . $fld6;
      }
      echo "       <tr>\n";
      echo "        <td nowrap class=\"normalcenter\"><a href=\"table.php?div=6\" title=\"&raquo; open Division 6 table and results page\">Div 6</a></td>\n";
      echo "        <td nowrap class=\"normal\">$outFld0</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld1</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld2</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld3</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld4</td>\n";
      echo "        <td nowrap class=\"normalcenter\">$outFld5</td>\n";
      echo "        <td nowrap class=\"normal\">$outFld6</td>\n";
      echo "       </tr>\n";
   }
 }
 fclose ($fd);
 echo "      </table>\n";
 echo "      <!-- end leaders php -->\n\n";
?>
