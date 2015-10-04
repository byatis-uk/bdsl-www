<?php 
 // not under source control
 
 include ('bdsldates.php'); 
 $yearA = substr($bdslSeason,0,4);
 $yearB = $yearA + 1;
 
 $teamA = $_POST["teamA"];
 $teamB = $_POST["teamB"];
 if ($teamA == ""){
    $teamA = $_GET["teamA"];
    $teamB = $_GET["teamB"];
 }
 $alleyA = $_POST["alleyA"];
 $month = $_POST["selMonth"];
 
 $listTeamCsv='csv/listteam.csv';
 $listAlleyCsv='csv/listalley.csv';

 echo "<h3>Fixture Arranger</h3><br>\n";
 echo "<form action=\"checker.php\" method=\"post\">\n";
 echo "<table class=\"border\">\n";
 echo " <tr>\n";
 echo "  <td class=\"title\">Select your team:</td>\n";
 echo "  <td class=\"title\">Select your opponents:</td>\n";
 echo "  <td class=\"title\">Select preferred alley:</td>\n";
 echo "  <td class=\"title\">Select month:</td>\n";
 echo " </tr>\n";
 echo " <tr>\n";
 echo "  <td>\n";
 echo "   <select class=\"normal\" name=\"teamA\">\n";
 
 $fd = fopen ("$listTeamCsv", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 1024);
    for ($i = 0; $i < 10; ++$i){
       if ($i == 0 and $buffer[$i] == $teamA and $buffer[$i] != ''){
          echo "    <option selected value=\"$buffer[$i]\">$buffer[$i]\n";
       }
       elseif ($i == 0 and $buffer[$i] != $teamA and $buffer[$i] != '') {
          echo "    <option value=\"$buffer[$i]\">$buffer[$i]\n";
       }
    }
 }
 fclose ($fd);
 
 echo "   </select>\n";
 echo "  </td>\n";
 echo "  <td>\n";
 echo "   <select class=\"normal\" name=\"teamB\">\n";
 
 $fd = fopen ("$listTeamCsv", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 4096);
    for ($i = 0; $i < 10; ++$i){
       if ($i == 0 and $buffer[$i] == $teamB and $buffer[$i] != ''){
          echo "    <option selected value=\"$buffer[$i]\">$buffer[$i]\n";
       }
       elseif ($i == 0 and $buffer[$i] != $teamB and $buffer[$i] != '') {
          echo "    <option value=\"$buffer[$i]\">$buffer[$i]\n";
       }
    }
 }
 fclose ($fd);

 echo "   </select>\n";
 echo "  </td>\n";
 echo "  <td>\n";
 echo "   <select class=\"normal\" name=\"alleyA\">\n";

  $fd = fopen ("$listAlleyCsv", "r");
  while (!feof ($fd)) {
     $buffer = fgetcsv($fd, 4096);
     for ($i = 0; $i < 9; ++$i){
        if ($i == 1 and $buffer[$i] == $alleyA and $buffer[$i] != ''){
           echo "    <option selected value=\"$buffer[$i]\">$buffer[$i]\n";
        }
        elseif ($i == 1 and $buffer[$i] != $alleyA and $buffer[$i] != ''){
           echo "    <option value=\"$buffer[$i]\">$buffer[$i]\n";
        }
     }
  }
  fclose ($fd);
 
 echo "   </select>\n";
 echo "  </td>\n";

 if ($month == ''){
    $localTime=time();
    $localTime=$localTime - (60 * 60 * 1);
    $selMonth = date("M",$localTime);
 }
 else {
    list($selMonth, $selYear) = split(' ',$month);
 }
 
 echo "  <td>\n";
 echo "   <select class=\"normal\" name=\"selMonth\">\n";
 if ($selMonth == 'Sep'){ 
    echo "    <option selected value=\"Sep $yearA\">September\n";
 }
 else {
    echo "    <option value=\"Sep $yearA\">September\n";
 }                        
 if ($selMonth == 'Oct'){
    echo "    <option selected value=\"Oct $yearA\">October\n";
 }
 else {
    echo "    <option value=\"Oct $yearA\">October\n";
 }                        
 if ($selMonth == 'Nov'){
    echo "    <option selected value=\"Nov $yearA\">November\n";
 }
 else {
    echo "    <option value=\"Nov $yearA\">November\n";
 }
 if ($selMonth == 'Dec'){
    echo "    <option selected value=\"Dec $yearA\">December\n";
 }
 else {
    echo "    <option value=\"Dec $yearA\">December\n";
 }
 if ($selMonth == 'Jan'){
    echo "    <option selected value=\"Jan $yearB\">January\n";
 }
 else {
    echo "    <option value=\"Jan $yearB\">January\n";
 }                        
 if ($selMonth == 'Feb'){
    echo "    <option selected value=\"Feb $yearB\">February\n";
 }
 else {
    echo "    <option value=\"Feb $yearB\">February\n";
 }
 if ($selMonth == 'Mar'){
    echo "    <option selected value=\"Mar $yearB\">March\n";
 }
 else {
    echo "    <option value=\"Mar $yearB\">March\n";
 }
 if ($selMonth == 'Apr'){
    echo "    <option selected value=\"Apr $yearB\">April\n";
 }
 else {
    echo "    <option value=\"Apr $yearB\">April\n";
 }

 echo "   </select>\n";
 echo "   <input type=submit value=\"Search\">\n";
 echo "  </td></tr></table>\n";
 echo "</form>\n";
 ?>
