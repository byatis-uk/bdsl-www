<?php
 $alley = $_GET["alley"];
 $name = $_GET["name"];
 $pageTitle = $name.' Alley';
 $alleyName = $name;
 include ('pageheader.php');
 echo "<h3>$name Alley</h3><br>\n";
 echo "<table valign=\"top\">\n";
 echo " <tr>\n";
 echo "  <td align=\"left\" valign=\"top\">\n";
 echo "   <table class=\"border\">\n";
 $mmOld='';
 $csvFile = 'csv/a'.$alley.'.csv';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 4096);
    // the 5 represents the number of columns in the text file
    for ($i = 0; $i < 5; ++$i){
       if ($i == 0){ $week = $buffer[$i]; }
       if ($i == 1){
          $date = $buffer[$i];
          list($fDay, $fMonth, $fYear) = split(" ", $date);
       }
       if ($i == 2){ $day = $buffer[$i]; }
       if ($i == 3){ $team = $buffer[$i]; }
       if ($i == 4){ $div = $buffer[$i]; }
    }
    ++$fCnt;
    if ($fCnt == 1){
       echo "    <tr>\n";
       echo "     <td nowrap class=\"hdrsmall\" colspan=\"5\">Fixtures</td>\n";
       echo "    </tr>\n";
       echo "    <tr>\n";
       echo "     <td nowrap class=\"title\">$week</td>\n";
       echo "     <td nowrap class=\"title\">$date</td>\n";
       echo "     <td nowrap class=\"title\">$day</td>\n";
       echo "     <td nowrap class=\"title\">$team</td>\n";
       echo "     <td nowrap class=\"title\">Div</td>\n";
       echo "    </tr>\n";
    }
    if ($fMonth == 'Jan' and $mmOld == 'Dec'){
       echo "   <tr>\n";
       echo "    <td nowrap colspan=\"6\" class=\"titlecenter\"><img src=\"blank.gif\"></td>\n";
       echo "   </tr>\n";
    }
    if ($week != '' and $fCnt != 1){
       echo "    <tr>\n";
       echo "     <td nowrap class=\"normalcenter\">$week</td>\n";
       echo "     <td nowrap class=\"normalcenter\">$date</td>\n";
       echo "     <td nowrap class=\"normal\">$day</td>\n";
       echo "     <td nowrap class=\"normal\">$team</td>\n";
       echo "     <td nowrap class=\"normalcenter\">$div</td>\n";
       echo "    </tr>\n";
    }
    $mmOld = $fMonth;
 }
 fclose ($fd);
 echo "    <tr>\n";
 echo "     <td nowrap class=\"titlecenter\" colspan=\"5\"><img src=\"blank.gif\"></td>\n";
 echo "    </tr>\n";
 echo "    <tr>\n";
 echo "    </tr>\n";
 echo "   </table>\n";
 echo "  </td>\n";
 echo "  <td align=\"right\" valign=\"top\">\n";
 echo "   <table class=\"border\">\n";
 $csvFile = 'csv/listalley.csv';
 $fCnt=0;
 // process csv file
 $mapEmail = "";
 $fd = fopen ("$csvFile", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 4096);
    // the 9 represents the number of columns in the csv file
    for ($i = 0; $i < 9; ++$i){
       if ($i == 0){ $code = $buffer[$i]; }
       if ($i == 1){ $name = $buffer[$i]; }
       if ($i == 2){ $phone = $buffer[$i]; }
       if ($i == 4){ $address = $buffer[$i]; }
       if ($i == 5){ $www = $buffer[$i]; }
       if ($i == 6){ $map = $buffer[$i]; }
       if ($i == 7){ $aRecord = $buffer[$i]; }
       if ($i == 8){ $email = $buffer[$i]; }
    }
    ++$fCnt;
    if ($code != ''){
       if ($alley == $code) {
          $mapCode = $map;
          $mapName = $name;
          $mapPhone = $phone;
          $mapAddress = $address;
          $www = '&nbsp;';
          $mapWww = $www;
          $alleyRec = $aRecord;
          $mapEmail = $email;
       };
    }
 }
 fclose ($fd);
 echo "    <tr>\n";
 echo "     <td nowrap class=\"hdrsmall\" colspan=\"3\">Location</td>\n";
 echo "    </tr>\n";
 echo "    <tr>\n";
 echo "     <td nowrap class=\"normal\" colspan=\"3\">$mapAddress<br>Tel: $mapPhone\n";
            if ($mapEmail != ''){
             $shortName = str_replace(' ','',$mapName);
 echo "      <a href=\"emcontact.php?name=$shortName\" title=\"Send email to $mapName Alley\"><img src=\"resource/mailto.gif\" alt=\"Send email to $mapName Alley\" class=\"link\"></a>";
            }
 echo "     </td>\n";
 echo "    </tr>\n";
 echo "    <tr>\n";
 echo "     <td colspan=\"3\"><iframe width=\"300\" height=\"300\" frameborder=\"0\" scrolling=\"NO\" marginheight=\"0\" marginwidth=\"0\" src=\"$mapCode\"></iframe></td>\n";
 echo "    </tr>\n";
 echo "    <tr>\n";
 if ($alleyRec != ''){
    $alleyRec = '<br>Alley record: '.$alleyRec;
 };
 echo "     <td nowrap class=\"normal\" colspan=\"3\">$alleyRec<br><br></td>\n";
 echo "    </tr>\n";
 echo "    <tr>\n";
 echo "     <td nowrap class=\"hdrsmall\" colspan=\"3\">Home Teams</td>\n";
 echo "    </tr>\n";
 echo "    <tr>\n";
 echo "     <td nowrap class=\"title\">Team</td>\n";
 echo "     <td nowrap class=\"title\">Day</td>\n";
 echo "     <td nowrap class=\"titlecenter\">Div</td>\n";
 echo "    </tr>\n";
 $csvFile = 'csv/listteam.csv';
 $fCnt=0;
 $fd = fopen ("$csvFile", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 1024);
    // the 5 represents the number of columns in the csv file
    for ($i = 0; $i < 5; ++$i){
       if ($i == 0){
          $tName = $buffer[$i];
          $tAbbrevName = preg_replace("/[^a-zA-Z0-9]/", "", $tName);
       }
       if ($i == 1){ $aName = $buffer[$i]; }
       if ($i == 2){ $tNight = $buffer[$i]; }
       if ($i == 3){ $tDiv = $buffer[$i]; }
    }
    ++$fCnt;
    if ($tName != ''){
       if ($mapName == $aName) {
          echo "    <tr>\n";
          echo "     <td nowrap class=\"normal\"><a href=\"team.php?div=$tDiv&amp;team=$tAbbrevName\" title=\"Show fixtures for $tName\">$tName</a></td>\n";
          echo "     <td nowrap class=\"normal\">$tNight</td>\n";
          echo "     <td nowrap class=\"normalcenter\">$tDiv</td>\n";
          echo "    </tr>\n";
       };
    }
 }
 fclose ($fd);
 echo "    <tr>\n";
 echo "     <td nowrap class=\"titlecenter\" colspan=\"3\"><img src=\"blank.gif\"></td>\n";
 echo "    </tr>\n";
 echo "   </table>\n";
 echo "   <br><table class=\"border\" align=\"left\">\n";
 echo "   <tr><td class=\"normal\"><a href=\"csv/a$alley.csv\" title=\"Download fixtures for $alleyName in a csv file: Right-click and Save as...\" target=\"_blank\"><img border=0 src=\"resource/excel.gif\"> fixtures list (in csv format)</a></td></tr>\n";
 echo "   <tr><td class=\"normal\"><a href=\"alleyprint.php?alley=$alley&name=$alleyName\" title=\"Opens a new page for printing\" target=\"_blank\"><img border=0 src=\"resource/print.gif\"> printable fixtures list (in a new window/tab)</a></td></tr>\n";
 echo "   </table>\n";
 echo "  </td>\n";
 echo " </tr>\n";
 echo "</table>\n";
 include ('pagefooter.php');
?>
