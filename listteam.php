<?php
 $teamCsv='csv/listteam.csv';
 echo "<form action=\"\">\n";
 echo " <select class=\"normal\" onchange=\"location = this.options[this.selectedIndex].value;\">\n";
 echo "  <option selected>Find a team...\n";
 $fd = fopen ("$teamCsv", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 1024);
    // the 5 represents the number of columns in the text file
    for ($i = 0; $i < 5; ++$i){
       if ($i == 0 & $buffer[$i] != '') {
          $listTeam = $buffer[$i];
          $listAbbTeam = preg_replace("/[^a-zA-Z0-9]/", "", $listTeam);
       }
       if ($i == 3) {
          $listDiv = $buffer[$i];
       }
    }
    if ($buffer[0] != '') {
       echo "  <option class=\"normal\" value=\"team.php?div=$listDiv&amp;team=$listAbbTeam\">$listTeam\n";
    }
 }
 fclose ($fd);
 echo " </select>\n";
 echo " </form>\n";?>
