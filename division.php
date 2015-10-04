<?php
 $div = $_GET["div"];
 $pageTitle='Division '.$div;
 include ('pageheader.php');
 $divDesc = 'Division '.$div;
 if ($div == 'P'){ $divDesc = 'Premier Division'; }
 $csvList = 'csv/listdiv.csv';
 $fCnt=0;
 // process list file
 $fd = fopen ("$csvList", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 4096);
    // the 6 represents the number of columns in csv/listdiv.csv
    for ($i = 0; $i < 6; ++$i){
       if ($i == 0){ $id = $buffer[$i]; }
       if ($i == 1){ $name = $buffer[$i]; }
       if ($i == 2){ $results = $buffer[$i]; }
       if ($i == 3){ $address = $buffer[$i]; }
       if ($i == 4){ $phone = $buffer[$i]; }
       if ($i == 5){ $dcsv = $buffer[$i]; }
    }
    if ($id == $div){
       $nameH = $name;
       $resultsH = $results;
       $addressH = $address;
       $phoneH = $phone;
       $csvH = $dcsv;
    }
 }
 fclose ($fd);
 echo "  <h3>$divDesc</h3>\n";
 echo "  <p class=\"normal\"><i>Results Secretary:</i><br><b>$resultsH</b><br>$addressH<br>$phoneH<br><br></p>\n";
 echo "  <table class=\"border\">\n";
 $csvFile = 'csv/d'.$csvH.'.csv';
 // process division file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 4096);
    // the 9 represents the number of columns in csv/d:$csvH.csv
    for ($i = 0; $i < 9; ++$i){
       if ($i == 0) { $tid = $buffer[$i]; }
       if ($i == 1) { $tname = $buffer[$i]; }
       if ($i == 2) { $talley = $buffer[$i]; }
       if ($i == 3) { $tnight = $buffer[$i]; }
       if ($i == 4) { $tcapt = $buffer[$i]; }
       if ($i == 5) { $tphone = $buffer[$i]; }
       if ($i == 6) { $tcsv = $buffer[$i]; }
       if ($i == 8) { $temail = $buffer[$i]; }
    }
    ++$fCnt;
    if ($fCnt == 1){
       echo "   <tr>\n";
       echo "    <td nowrap class=\"hdr\">No</td>\n";
       echo "    <td nowrap class=\"hdr\">Team Name</td>\n";
       echo "    <td nowrap class=\"hdr\">Home Alley</td>\n";
       echo "    <td nowrap class=\"hdr\">Home Night</td>\n";
       echo "    <td nowrap class=\"hdr\">Captain</td>\n";
       echo "    <td nowrap class=\"hdr\">Phone</td>\n";
       echo "    <td nowrap class=\"hdr\">Email</td>\n";
       echo "   </tr>\n";
    }
    if ($tid != ''){
       echo "   <tr>\n";
       echo "    <td nowrap class=\"normal\">$tid</td>\n";
       list($part1, $part2) = split(' ', $tname);
       if ($part1 != '***'){
          echo "    <td nowrap class=\"normal\"><a href=\"team.php?div=$div&amp;team=$tcsv\" title=\"Show details for $tname\">$tname</a></td>\n";
       }
       else {
          echo "    <td nowrap class=\"normal\">$tname</td>\n";
       }
       echo "    <td nowrap class=\"normal\">$talley</td>\n";
       echo "    <td nowrap class=\"normal\">$tnight</td>\n";
       echo "    <td nowrap class=\"normal\">$tcapt</td>\n";
       echo "    <td nowrap class=\"normal\">$tphone</td>\n";
       echo "    <td nowrap class=\"noalign\">$temail</td>\n";
       echo "   </tr>\n";
    }
 }
 fclose ($fd);
 echo "  </table>\n";
 include ('pagefooter.php');
?>
