<?php
 include ('bdsldates.php');
 $div = $_GET["div"];
 $team = $_GET["team"];
 $localTime=time();
 $localTime=$localTime - (60 * 60 * 1);
 $thisDay = date("d",$localTime);
 $thisMonth = date("m",$localTime);
 $thisYear = date("Y",$localTime);
 $embold='N';
 if ($div == 'P'){
    $divCsv = 'csv/dPremierDivision.csv';
    $divName = 'Premier Division';
 }
 else {
    $divCsv = 'csv/dDivision'.$div.'.csv';
    $divName = 'Division '.$div;
 }
 $fCnt=0;
 if (file_exists($divCsv)) {
 $fd = fopen ("$divCsv", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 4096);
    // the 11 represents the number of columns in the text file
    for ($i = 0; $i < 11; ++$i){
          if ($i == 0){ $id = $buffer[$i]; }
          if ($i == 1){ $name = $buffer[$i]; }
          if ($i == 2){ $alley = $buffer[$i]; }
          if ($i == 3){ $day = $buffer[$i]; }
          if ($i == 4){ $captain = $buffer[$i]; }
          if ($i == 5){ $phone = $buffer[$i]; }
          if ($i == 6){ $tcsv = $buffer[$i]; }
          if ($i == 7){ $www = $buffer[$i]; }
          if ($i == 8){ $email = $buffer[$i]; }
          if ($i == 9){ $fpk = $buffer[$i]; }
          if ($i == 10){ $aic = $buffer[$i]; }
    }
    if ($team == $tcsv){
       $nameH = $name;
       $alleyH = $alley;
       $dayH = $day;
       $captainH = $captain;
       $phoneH = $phone;
       $wwwH = $www;
       $emailH = $email;
       $fpkH = $fpk;
       $aicH = $aic;
       $cupsH = '';
       if ($aicH == 'Y'){
          $cupsH = '<a href="cupai.php" title="All-in Cup">All-in Cup</a> &#10003;' ;
       }
       else {
          $cupsH = 'All-in Cup &#10007;';
       }
       if ($fpkH == 'Y'){
          $cupsH .= '&nbsp;&nbsp;&nbsp;&nbsp;<a href="cupfp.php" title="Front-pin Knockout">Front-pin Knockout</a> &#10003;' ;
       }
       else {
          $cupsH .= '&nbsp;&nbsp;&nbsp;&nbsp;Front-pin Knockout &#10007;';
       }
    }
 }
 $pageTitle = $nameH ;
 include ('pageheader.php');
 echo "<h3>$nameH</h3>\n";
 echo "<br><table class=\"border\"><tr><td class=\"normal\"><i>Captain</i></td><td class=\"normal\"><b>$captainH</b>&nbsp;&nbsp;&nbsp;&nbsp;$emailH</td></tr>\n";
 if ($phoneH != ''){
    echo "<tr><td class=\"normal\"><i>Phone</i> </td><td class=\"normal\"><b>$phoneH</b></td></tr>\n";
 }
 $alleyAbbrev = preg_replace("/[^a-zA-Z0-9]/", "", $alleyH);
 echo " <tr><td class=\"normal\"><i>Alley</i></td><td class=\"normal\"><a href=\"alley.php?alley=$alleyAbbrev&amp;name=$alleyH\" title=\"Show details for $alleyH alley\"><b>$alleyH</b></a> | <b>$dayH</b></td></tr>\n";
 echo " <tr><td class=\"normalcenter\" colspan=\"2\"><a href=\"division.php?div=$div\" title=\"Show details for $divName\">$divName</a></td></tr>\n";
 echo " <tr><td class=\"normalcenter\" colspan=\"2\">$cupsH</td></tr>\n";
 echo "</table><br>";
 echo "<table>\n";
 echo " <tr>\n";
 echo "  <td valign=\"top\">\n";
 echo "   <table class=\"border\">\n";
 $mmOld='';
 $csvFile = 'csv/t'.$team.'.csv';
 $fd = fopen ("$csvFile", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 4096);
    // the 6 represents the number of columns in the text file
    for ($i = 0; $i < 6; ++$i){
       if ($i == 0){
          $tweek = $buffer[$i];
       }
       if ($i == 1){
          $tdate = $buffer[$i];
          $bankHol = 0;
          if (strpos($bdslBankHols, '['.$tdate.']') !== false) {
             $bankHol = 1;
             $tdate = "<span style=\"color:red\">$tdate</span>" ;
          }
          list($fDay, $fMonth, $fYear) = split(" ", $tdate);
          $chkMonth = $fMonth;
          $date_formatted = "$fDay $fMonth $fYear";
          $final_date = strtotime($date_formatted);
          $fDay = date("d",$final_date);
          $fMonth = date("m",$final_date);
          $fYear = date("Y",$final_date);
          if ($fYear == $thisYear & $fMonth == $thisMonth & $fDay == $thisDay & $embold=='N'){
             $embold = 'Y';
          }
          elseif ($fYear == $thisYear & $fMonth == $thisMonth & $fDay >= $thisDay & $embold=='N'){
             $embold = 'Y';
          }
          elseif ($fYear >= $thisYear & $fMonth > $thisMonth & $embold=='N'){
             $embold = 'Y';
          }
          elseif ($fYear > $thisYear & $embold=='N'){
             $embold = 'Y';
          }
       }
       if ($i == 2){
          $tday = $buffer[$i];
          if ($bankHol == 1) {
             $tday = "<span style=\"color:red\">$tday</span>" ;
          }
       }
       if ($i == 3){
          $tversus = $buffer[$i];
          $starpos = strpos($tversus, '***');
          $greyout='Y';
          if ($starpos === false){
             $greyout = '';
          }
       }
       if ($i == 4){
          $thora = $buffer[$i];
       }
       if ($i == 5){
          $talley = $buffer[$i];
       }
    }
    ++$fCnt;
    if ($fCnt == 1){
       echo "    <tr>\n";
       echo "     <td nowrap class=\"hdr\" colspan=\"6\">Fixtures</td>\n";
       echo "    </tr>\n";
       echo "    <tr>\n";
       echo "     <td nowrap class=\"title\">Week</td>\n";
       echo "     <td nowrap class=\"title\">Date</td>\n";
       echo "     <td nowrap class=\"title\">Day</td>\n";
       echo "     <td nowrap class=\"title\">Versus</td>\n";
       echo "     <td nowrap class=\"title\">H/A</td>\n";
       echo "     <td nowrap class=\"title\">Alley</td>\n";
       echo "    </tr>\n";
    }
    if ($chkMonth == 'Jan' and $mmOld == 'Dec'){
       echo "   <tr>\n";
       echo "    <td nowrap colspan=\"6\" class=\"titlecenter\"><img src=\"blank.gif\"></td>\n";
       echo "   </tr>\n";
    }
    $tdclass = 'normal';
    $tdclassc = 'normalcenter';
    if($greyout == 'Y'){
       $tdclass = 'normalgray';
       $tdclassc = 'normalgraycenter';
    }
    if ($tweek != '' & $embold != 'Y'){
       echo "    <tr>\n";
       echo "     <td nowrap class=\"$tdclassc\">$tweek</td>\n";
       echo "     <td nowrap class=\"$tdclass\">$tdate</td>\n";
       echo "     <td nowrap class=\"$tdclass\">$tday</td>\n";
       echo "     <td nowrap class=\"$tdclass\">$tversus</td>\n";
       echo "     <td nowrap class=\"$tdclass\">$thora</td>\n";
       echo "     <td nowrap class=\"$tdclass\">$talley</td>\n";
       echo "    </tr>\n";
    }
    if ($tweek != '' & $embold == 'Y'){
       echo "    <tr>\n";
       echo "     <td nowrap class=\"$tdclassc\"><b>$tweek</b></td>\n";
       echo "     <td nowrap class=\"$tdclass\"><b>$tdate</b></td>\n";
       echo "     <td nowrap class=\"$tdclass\"><b>$tday</b></td>\n";
       echo "     <td nowrap class=\"$tdclass\"><b>$tversus</b></td>\n";
       echo "     <td nowrap class=\"$tdclass\"><b>$thora</b></td>\n";
       echo "     <td nowrap class=\"$tdclass\"><b>$talley</b></td>\n";
       $embold='X';
       echo "    </tr>\n";
    }
    $mmOld = $chkMonth;
 }
 fclose ($fd);
 echo "    <tr>\n";
 echo "     <td nowrap class=\"title\" colspan=\"6\"><img src=\"blank.gif\"></td>\n";
 echo "    </tr>\n";
 echo "   </table>\n";
 echo "  </td>\n";
 echo "  <td>&nbsp;\n";
 echo "  </td>\n";
 echo "  <td valign=\"top\">\n";
 echo "   <table class=\"border\" align=\"center\">\n";
 $tdStyleHdr =   "class=\"hdrsmall\"";
 $tdStyleTitle = "class=\"title\"";
 $tdStyleNormal =  "class=\"normal\"";
 $tdStyleText =  "class=\"normal\"";
 $tdStyleTextE =  "class=\"normalcenter\"";
 $tdStyleNum =   "class=\"normalcenter\"";
 $tdStyleFtr =   "class=\"titleright\"";
 $csvFile = 'csv-tables/table'.$div.'.csv';
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
    echo "    <tr>\n";
    ++$fCnt;
    if ($fCnt == 1){
	     echo "  <td nowrap $tdStyleHdr colspan=\"8\">$fld0 Table</td>\n";
    }
    elseif ($fCnt == 2){
	     echo "     <td nowrap $tdStyleTextE colspan=\"8\">$fld0</td>\n";
    }
    elseif ($fCnt == 3) {
	     echo "     <td nowrap $tdStyleTitle>&nbsp;</td>\n";
	     echo "     <td nowrap $tdStyleTitle>&nbsp;</td>\n";
	     echo "     <td nowrap $tdStyleTitle>$fld1</td>\n";
	     echo "     <td nowrap $tdStyleTitle>$fld2</td>\n";
	     echo "     <td nowrap $tdStyleTitle>$fld3</td>\n";
	     echo "     <td nowrap $tdStyleTitle>$fld4</td>\n";
	     echo "     <td nowrap $tdStyleTitle>$fld5</td>\n";
	     echo "     <td nowrap $tdStyleTitle>$fld6</td>\n";
    }
    elseif ($fld0 != ''){
       $posCnt = $fCnt - 3;
    if ($div == 6){
       $redPos = 17;
    }
    else {
       $redPos = 15;
    }
    if ($posCnt == 1){
       $tdStyleText =  "class=\"tblgrn\"";
       $tdStyleNum =   "class=\"tblgrncenter\"";
    }
    elseif ($posCnt == 2){
       $tdStyleText =  "class=\"tblamb\"";
       $tdStyleNum =   "class=\"tblambcenter\"";
    }
    elseif ($posCnt >= $redPos){
       $tdStyleText =  "class=\"tblred\"";
       $tdStyleNum =   "class=\"tblredcenter\"";
    }
    else{
       $tdStyleText =  "class=\"normal\"";
       $tdStyleNum =   "class=\"normalcenter\"";
    }
       if ($nameH == $fld0){
          $posCnt = "<b>$posCnt</b>";
          $fld0 = "<b>$fld0</b>";
          $fld1 = "<b>$fld1</b>";
          $fld2 = "<b>$fld2</b>";
          $fld3 = "<b>$fld3</b>";
          $fld4 = "<b>$fld4</b>";
          $fld5 = "<b>$fld5</b>";
          $fld6 = "<b>$fld6</b>";
       }
       else {
          $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
          list($part1, $part2) = split(' ', $fld0);
          if ($part1 != '***'){
             $fld0 = "<a href=\"team.php?div=$div&amp;team=$fld0Abbrev\" title=\"Show fixtures for $fld0\">$fld0</a>";
          }
       }
	     echo "     <td nowrap $tdStyleFtr>$posCnt</td>\n";
	     echo "     <td nowrap $tdStyleText>$fld0</td>\n";
	     echo "     <td nowrap $tdStyleNum>$fld1</td>\n";
	     echo "     <td nowrap $tdStyleNum>$fld2</td>\n";
	     echo "     <td nowrap $tdStyleNum>$fld3</td>\n";
	     echo "     <td nowrap $tdStyleNum>$fld4</td>\n";
	     echo "     <td nowrap $tdStyleNum>$fld5</td>\n";
	     echo "     <td nowrap $tdStyleNum>$fld6</td>\n";
    }
    echo "    </tr>\n";
  }
  fclose ($fd);
  $tdStyleText =  "class=\"normal\"";
  $tdStyleNum =   "class=\"normalcenter\"";
  echo "   </table>\n";
  echo "   <br>\n";
  echo "   <table class=\"border\">\n";
  $pCsv = 'player/' . $team . '.csv';
  if (file_exists($pCsv)){
     echo "    <tr><td class=\"normalvc\"><img border=\"0\" src=\"resource/persons.gif\" alt=\"players\"> <a href=\"player.php?team=$nameH\" title=\"View registered players\">registered players</a></td></tr>\n";
     echo "    <tr><td class=\"normalvc\"><img border=\"0\"src=\"resource/pdf.gif\" alt=\"players\"> <a href=\"regd_players.php?team=$nameH\" title=\"Download registered players list as PDF\" target=\"_blank\">registered players list as PDF</a></td></tr>\n";
  }
  echo "    <tr><td class=\"normalvc\"><img border=\"0\" src=\"resource/pdf.gif\" alt=\"csv\"> <a href=\"team_fixtures.php?team=$nameH\" title=\"Download fixtures as pdf\" target=\"_blank\">fixtures list as PDF</a></td></tr>\n";
  echo "    <tr><td class=\"normalvc\"><img border=\"0\" src=\"resource/ical.png\" alt=\"ical\"> <a href=\"teamical.php?team=$team&amp;name=$nameH&amp;div=$div&amp;home=$alleyH\" title=\"Download fixtures in ICAL format\" target=\"_blank\">fixtures in ICAL format</a></td></tr>\n";
  echo "    <tr><td class=\"normalvc\"><img border=\"0\" src=\"resource/excel.gif\" alt=\"csv\"> <a href=\"csv/t$team.csv\" title=\"Download fixtures in a csv file\" target=\"_blank\">fixtures list in CSV format</a></td></tr>\n";
  echo "    <tr><td class=\"normalvc\"><img border=\"0\" src=\"resource/print.gif\" alt=\"print\"> <a href=\"teamprint.php?team=$team&amp;name=$nameH&amp;div=$divName\" title=\"Opens a new page for printing\" target=\"_blank\">printable fixtures list (in a new window/tab)</a></td></tr>\n";
  echo "   </table>\n";
 $csvFile = 'csv/listteam.csv';
 $fd = fopen ("$csvFile", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 1024);
    for ($i = 0; $i < 10; ++$i){
          if ($i == 0){ $tName = $buffer[$i]; }
          if ($i == 4){ $tCsv = $buffer[$i]; }
          if ($i == 9){ $tHist = $buffer[$i]; }
    }
    if ($tCsv == $team){
       echo "   <p class=\"normal\"><br><b>Recent History</b><br>$tHist</p>\n";
    }
 }
 fclose ($fd);
 if ($wwwH != ''){
    echo "   <p class=\"normal\"><br><a href=\"$wwwH\" target=\"_blank\" title=\"$nameH web site\"><img src=\"resource/www.gif\" alt=\"$nameH web site\" border=\"0\"> $nameH website</a></p>\n";
 }
 echo "  </td>\n";
 echo " </tr>\n";
 echo "</table>\n";
 }
 include ('pagefooter.php');
?>
