<?php
 $team = $_GET["team"];
 $teamcsv = preg_replace("/[^a-zA-Z0-9]/", "", $team);
 echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
 echo "<html>\n";
 echo "<head>\n";
 echo " <title>$team - Registered Players</title>\n";
 echo " <meta http-equiv=\"pragma\" content=\"no-cache\">\n";
 echo " <meta http-equiv=\"cache-control\" content=\"no-cache\">\n";
 echo " <meta http-equiv=\"expires\" content=\"0\">\n";
 echo "</head>\n";
 echo "<body>\n";
 echo "<table align=\"left\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">\n";
 // set fonts
 $tdFontS='style="font-family: Verdana; font-size: 60%"';
 $tdFontL='style="font-family: Verdana; font-size: 70%"';
 // team csv files
 $pteamcsv = 'player/p'.$teamcsv.'.csv';
 $hteamcsv = 'csv/ht'.$teamcsv.'.csv';
 echo " <tr><td $tdFontL align=\"center\" colspan=\"6\"><b>$team</b><br>Registered Players</td></tr>\n";
 if (file_exists($hteamcsv) and $team != '') {
    $fd = fopen ("$hteamcsv", "r");
    $hrow=1;
    // initialize a loop to go through each line of the file
    while (!feof ($fd) & $hrow < 2) {
       // declare an array to hold all of the contents of each row, indexed
       $buffer = fgetcsv($fd, 1024);
       // the 5 represents the number of columns in the text file
       for ($i = 0; $i < 5; ++$i){
           if ($i == 0) { $div = $buffer[$i]; }
           if ($i == 1) { $capt = $buffer[$i]; }
           if ($i == 2) { $tel = $buffer[$i]; }
           if ($i == 3) { $alley = $buffer[$i]; }
           if ($i == 4) { $night = $buffer[$i]; }
       }
       ++$hrow;
    }
    fclose ($fd);
    if ($tel == '') { $tel = 'n/a'; }
    echo " <tr>\n";
    echo "   <td $tdFontS colspan=\"6\" nowrap>$div&nbsp;|&nbsp;<sup>Capt</sup> $capt&nbsp;|&nbsp;<sup>Tel</sup> $tel&nbsp;|&nbsp;<sup>Alley</sup> $alley&nbsp;|&nbsp;<sup>Night</sup> $night</td></tr>\n";
    echo " </tr>\n";
 }
 echo " <tr>\n";
 echo "  <td $tdFontS valign=\"bottom\">&nbsp;</td>\n";
 echo "  <td $tdFontS valign=\"bottom\"><b>Forename</b></td>\n";
 echo "  <td $tdFontS valign=\"bottom\"><b>Surname</b></td>\n";
 echo "  <td $tdFontS align=\"center\" valign=\"bottom\"><b>M/F</b></td>\n";
 echo "  <td $tdFontS align=\"center\" valign=\"bottom\"><b>Date<br>Registered</b></td>\n";
 echo "  <td $tdFontS valign=\"bottom\"><b>Comments</b></td>\n";
 echo " </tr>\n";
 $row=0;
 if (file_exists($pteamcsv)) {
    $fd = fopen ("$pteamcsv", "r");
    // initialize a loop to go through each line of the file
    while (!feof ($fd)) {
       // declare an array to hold all of the contents of each row, indexed
       $buffer = fgetcsv($fd, 1024);
       // the 5 represents the number of columns in the text file
       ++$row;
       $testData=0;
       for ($i = 0; $i < 5; ++$i){
          if ($buffer[0] != '') {
             if ($buffer[$i] == '') {$buffer[$i] = '&nbsp;';}
             if ($i == 0){
                echo " <tr>\n";
                echo "  <td $tdFontL align=\"center\">$row</td>\n";
                echo "  <td $tdFontL>$buffer[$i]</td>\n";
             }
             if ($i == 1){
                echo "  <td $tdFontL>$buffer[$i]</td>\n";
             }
             if ($i == 2){
                echo "  <td $tdFontL align=\"center\">$buffer[$i]</td>\n";
             }
             if ($i == 3){
                echo "  <td $tdFontL align=\"center\">$buffer[$i]</td>\n";
             }
             if ($i == 4){
                echo "  <td $tdFontL>$buffer[$i]</td>\n";
                echo " </tr>\n";
            }
         }
      }
    }
    fclose ($fd);
 }
 // fill to row 26 if empty
 if ($row < 26){
    while ($row < 26) {
       ++$row;
       echo " <tr>\n";
       echo "  <td $tdFontL align=\"center\">$row</td>\n";
       echo "  <td $tdFontL>&nbsp;</td>\n";
       echo "  <td $tdFontL>&nbsp;</td>\n";
       echo "  <td $tdFontL>&nbsp;</td>\n";
       echo "  <td $tdFontL>&nbsp;</td>\n";
       echo "  <td $tdFontL>&nbsp;</td>\n";
       echo " </tr>\n";
    }
 }
 $localTime=time();
 // 1&1 server time is GMT + 1 hour, so an take hour off!
 $localTime=$localTime - (60 * 60 * 1);
 $thisDay = date("d",$localTime);
 $thisMonth = date("m",$localTime);
 $thisYear = date("Y",$localTime);
 $today = $thisDay.'/'.$thisMonth.'/'.$thisYear ;
 echo " <tr><td $tdFontS align=\"right\" colspan=\"6\">as at $today</td></tr>\n";
 echo "</table>\n";
?>