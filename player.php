<?php
 $team = $_GET["team"];
 $pageTitle='Registered Players';
 if ($team != '') { $pageTitle .= ' - '.$team;}
 include ('pageheader.php');
 $teamcsv = preg_replace("/[^a-zA-Z0-9]/", "", $team);
 $pteamcsv = 'player/'.$teamcsv.'.csv';
 echo "<h3>Registered Players</h3><br>\n";
 echo "<table class=\"border\" width=\"100%\">\n";
 echo " <form action=\"player.php\">\n";
 echo " <tr>\n";
 echo "  <td class=\"title\" colspan=\"6\">\n";
 echo "   <select class=\"normal\" onchange=\"location = this.options[this.selectedIndex].value;\">\n";
 echo "   <option class=\"normal\" value=\"player.php\">Select team...\n";
 $teamCsv='csv/listteam.csv';
 $fd = fopen ("$teamCsv", "r");
 while (!feof ($fd)) {
     $buffer = fgetcsv($fd, 1024);
     // the 1 represents the first column in the csv file
     for ($i = 0; $i < 1; ++$i){
        if ($i == 0) {
           $pCsv = 'player/' . preg_replace("/[^a-zA-Z0-9]/", "", $buffer[$i]) . '.csv';
           if (file_exists($pCsv) and $buffer[$i] == $team and $buffer[$i] != ''){
              echo "    <option class=\"normal\" selected value=\"player.php?team=$buffer[$i]\">$buffer[$i]\n";
           }
           elseif (file_exists($pCsv) and $buffer[$i] != $team and $buffer[$i] != '') {
              echo "    <option class=\"normal\" value=\"player.php?team=$buffer[$i]\">$buffer[$i]\n";
           }
        }
     }
  }
fclose ($fd);
echo "   </select>\n";
echo "   (not necessarily available for all teams)\n";
echo "   </td>\n";
echo "  </tr>\n";
echo "</form>\n";
if ($team != '') {
   $listFile = 'csv/listteam.csv';
   $fd = fopen ("$listFile", "r");
   while (!feof ($fd)) {
      $buffer = fgetcsv($fd, 1024);
      for ($i = 0; $i < 9; ++$i){
         if ($i == 0){ $lName = $buffer[$i]; }
         if ($i == 1){ $lAlley = $buffer[$i]; }
         if ($i == 2){ $lNight = $buffer[$i]; }
         if ($i == 3){ $lDiv = $buffer[$i]; }
         if ($i == 5){ $lCapt = $buffer[$i]; }
         if ($i == 6){ $lPhone = $buffer[$i]; }
      }
      if ($lName == $team){
          $capt = $lCapt;
          $tel = $lPhone;
          $alley = $lAlley;
          $night = $lNight;
          $divid = $lDiv;
          $div = 'Division '.$lDiv;
          if ($lDiv == 'P') { $div = 'Premier Division'; }
      }
   }
   fclose ($fd);
   if ($tel == '') { $tel = 'n/a'; }
   $alleyAbbrev = preg_replace("/[^a-zA-Z0-9]/", "", $alley);
   echo "   <tr><td class=\"normal\" colspan=\"5\" nowrap><h3><a href=\"team.php?div=$divid&team=$teamcsv\" title=\"Show details for $team\">$team</a></h3></td></tr>\n";
   echo "   <tr><td class=\"normal\" colspan=\"5\" nowrap><a href=\"division.php?div=$divid\" title=\"Show details for $div\">$div</a>&nbsp;|&nbsp;<sup>Capt</sup> $capt&nbsp;|&nbsp;<sup>Tel</sup> $tel&nbsp;|&nbsp;<sup>Alley</sup> <a href=\"alley.php?alley=$alleyAbbrev&amp;name=$alley\" title=\"Show details for $alley alley\">$alley</a>&nbsp;|&nbsp;<sup>Night</sup> $night</td></tr>\n";
}
if ($team =='') {
   echo "   <tr><td class=\"normal\" colspan=\"5\"><b>select a team from the dropdown list above</b></td></tr>\n";
}
 echo " <tr>\n";
 echo "  <td class=\"title\" valign=\"bottom\" width=\"2%\"></td>\n";
 echo "  <td class=\"title\" valign=\"bottom\" width=\"40%\">Name</td>\n";
 echo "  <td class=\"titlecenter\" valign=\"bottom\" width=\"4%\">M/F</td>\n";
 echo "  <td class=\"titlecenter\" valign=\"bottom\" width=\"12%\">Date<br>Registered</td>\n";
 echo "  <td class=\"title\" valign=\"bottom\" width=\"42%\">Note</td>\n";
 echo " </tr>\n";
 $row=0;
 if (file_exists($pteamcsv)) {
    $fd = fopen ("$pteamcsv", "r");
       while (!feof ($fd)) {
       $buffer = fgetcsv($fd, 1024);
       ++$row;
       $testData=0;
       for ($i = 0; $i < 4; ++$i){
          if ($buffer[0] == '') {$testData = 1;}
          if ($i == 0 & $testData == 0){
             echo "    <tr><td class=\"titlecenter\" width=\"2%\">$row</td>\n";
             echo "    <td class=\"normal\" width=\"40%\">$buffer[$i]</td>\n";
          }
          if ($i == 1 & $testData == 0){
             echo "    <td class=\"normalcenter\" width=\"4%\">$buffer[$i]</td>\n";
          }
          if ($i == 2 & $testData == 0){
             $bits = explode('/',$buffer[$i]);
             $buffer[$i]=strtotime($bits[1].'/'.$bits[0].'/'.$bits[2]);
             $buffer[$i]=date('d/m/Y',$buffer[$i]);
             echo "    <td class=\"normalcenter\" width=\"12%\">$buffer[$i]</td>\n";
          }
          if ($i == 3 & $testData == 0){
             echo "    <td class=\"normal\" width=\"42%\" nowrap>$buffer[$i]</td></tr>\n";
          }
      }
    }
    fclose ($fd);
 }
 echo " <tr>\n";
 if ($team =='') {
    echo "  <td class=\"titlecenter\" colspan=\"5\"></td></tr>\n";
 }
 else {
    $lastUpdate="updated: " . date ("d/m/Y", filemtime($pteamcsv));
    echo "   <td class=\"title\" colspan=\"2\">$lastUpdate</td>\n";
    echo "   <td class=\"titleright\" colspan=\"3\"><img src=\"resource/pdf.gif\" alt=\"pdf\" border=\"0\"> <a href=\"regd_players.php?team=$team\" target=\"blank\" title=\"players list as PDF\">players list as PDF</a></td></tr>\n";
 }
 echo " </tr>\n";
 echo "</table>\n";
 include ('pagefooter.php');
?>
