<?php
 $pageTitle = 'Alleys';
 include ('pageheader.php');
 echo "  <h3>Alleys</h3><br>\n";
 echo "  <table class=\"border\">\n";
 $mapCode = '';
 $csvFile = 'csv/listalley.csv';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 4096);
    // the 9 represents the number of columns in the text file
    for ($i = 0; $i < 9; ++$i){
       if ($i == 0){ $code = $buffer[$i]; }
       if ($i == 1){ $name = $buffer[$i]; }
       if ($i == 2){ $phone = $buffer[$i]; }
       if ($i == 4){
          $address = str_replace('<br>',', ',$buffer[$i]);
          $address = str_replace('<BR>',', ',$address);
       }
       if ($i == 6){ $map = $buffer[$i]; }
       if ($i == 7){ $aRecord = $buffer[$i]; }
       if ($i == 8){ $email = $buffer[$i]; }
    }
    ++$fCnt;
    if ($fCnt == 1){
    }
    if ($code != ''){
       echo "   <tr>\n";
       echo "    <td nowrap class=\"normal\"><a href=\"alley.php?alley=$code&amp;name=$name\" title=\"Show details for $name alley\">$name</a></td>\n";
       echo "    <td nowrap class=\"normal\">$phone</td>\n";
       if ($email != ''){
          $shortName = str_replace(' ','',$name);
          $email = "<a href=\"emcontact.php?name=$shortName\" title=\"Send email to $name Alley\"><img src=\"resource/mailto.gif\" alt=\"Send email to $name Alley\" class=\"link\"></a>";
       }
       echo "    <td nowrap class=\"normal\">$email</td>\n";
       echo "    <td nowrap class=\"normal\">$address</td>\n";
       echo "   </tr>\n";
    }
 }
 fclose ($fd);
 echo "  </table>\n";
 include ('pagefooter.php');
?>
