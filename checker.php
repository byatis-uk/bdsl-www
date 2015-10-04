<?php 
 // not under source control
   
   include ('bdsldates.php'); 
   $yearA = substr($bdslSeason,0,4);
   $yearB = $yearA + 1;
   $febDays = 28; 
   if ($yearB % 4 == 0) { $febDays = 29; } // yes, doesn't account for century years
      
   $localTime=time();
   $localTime=$localTime - (60 * 60 * 1);
   $thisDay = date("d",$localTime);
   $thisMonth = date("n",$localTime);
   $thisYear = date("Y",$localTime);
   $checkYear = $thisYear;
 
// team A
   $teamA = $_POST["teamA"];
   $teamAcsv = preg_replace("/[^a-zA-Z0-9]/", "", $teamA);
   $teamAcsv ='csv/t'.$teamAcsv.'.csv';
// team B
   $teamB = $_POST["teamB"];
   $teamBcsv = preg_replace("/[^a-zA-Z0-9]/", "", $teamB);
   $teamBcsv='csv/t'.$teamBcsv.'.csv';
// alley
   $alleyA = $_POST["alleyA"];
   $alleyAcsv = preg_replace("/[^a-zA-Z0-9]/", "", $alleyA);
   $alleyXcsv='csv/x'.$alleyAcsv.'.csv';
   $alleyAcsv='csv/a'.$alleyAcsv.'.csv';
   $listAlleyCsv = 'csv/listalley.csv';
// month
   $month = $_POST["selMonth"];
   list($selMonth, $selYear) = split(' ',$month);
// process team A and B headers
   $teamAhdr = '' ;
   $teamBhdr = '' ;
   $listTeamCsv = 'csv/listteam.csv';
   $fd = fopen ("$listTeamCsv", "r");
   while (!feof ($fd)) {
      $buffer = fgetcsv($fd, 1024);
      for ($i = 0; $i < 10; ++$i){
          if ($i == 0){ $lName = $buffer[$i]; }
          if ($i == 1){ $lAlley = $buffer[$i]; }
          if ($i == 3){ $lDiv = $buffer[$i]; }	
		  if ($i == 4){ $lCsv = $buffer[$i]; }
          if ($i == 5){ $lCapt = $buffer[$i]; }
          if ($i == 6){ $lPhone = $buffer[$i]; }
          // if ($i == 2){ $lNight = $buffer[$i]; }		  
          // if ($i == 7){ $lFPK = $buffer[$i]; }
          // if ($i == 8){ $lAIC = $buffer[$i]; }
          // if ($i == 9){ $lHist = $buffer[$i]; }
      }
	  if ($lName == $teamA){
         $div = 'Division '.$lDiv; 
         if ($lDiv == 'P') { $div = 'Premier Division'; }
         $teamAhdr = '<b>' . $teamA . '</b>' ;
         $teamAhdr .= '<br>' . $div ; 
         $teamAhdr .= '<br>Captain: <b>' . $lCapt . '</b>';
         $teamAhdr .= '<br><b>' . $lPhone .'</b>';
         $teamAhdr .= '<br>Home: '.$lAlley; 
      }
      if ($lName == $teamB){
         $div = 'Division '.$lDiv; 
         if ($lDiv == 'P') { $div = 'Premier Division'; }
         $teamBhdr = '<b>' . $teamB . '</b>' ;
         $teamBhdr .= '<br>' . $div ; 
         $teamBhdr .= '<br>Captain: <b>' . $lCapt . '</b>';
         $teamBhdr .= '<br><b>' . $lPhone .'</b>';
         $teamBhdr .= '<br>Home: '.$lAlley;
	  }
   } 
   fclose ($fd);
// process alley header
   $alleyAhdr = "" ;
   $fd = fopen ("$listAlleyCsv", "r");
   while (!feof ($fd)) {
      $buffer = fgetcsv($fd, 4096);
      for ($i = 0; $i < 9; ++$i){
         if ($i == 1 and $alleyA == $buffer[1]){ $alleyFound = 'Y' ; }
         elseif ($i == 1 and $alleyA != $buffer[1]){ $alleyFound = 'N'; }
         if ($i == 2 and $alleyFound == 'Y'){
            if ($buffer[2] == ""){ $buffer[2] = "&nbsp;"; }
            if ($buffer[2] != ''){ $alleyAhdr = $alleyAhdr.'<br><b>'.$buffer[2].'</b>'; }
         }
      }
   }
   fclose ($fd);
// process team A
   $fd = fopen ("$teamAcsv", "r");
   while (!feof ($fd)) {
      $buffer = fgetcsv($fd, 4096);
      for ($i = 0; $i < 6; ++$i){
         // if the field is empty, make it = &nbsp
         if ($buffer[$i] == ""){ $buffer[$i] = "&nbsp;"; }
         // parse date field dd MMM yyy
         if ($i == 1){ list($day, $month, $year) = split(' ', $buffer[$i]); }
      }
      if ($month == "$selMonth"){
         if ($buffer[4] == "home"){ $ha = "H"; }
         else { $ha = "A"; }
         $teamAlist[$day] = $buffer[3]." (".$ha.")";
         $weekdayList[$day] = $buffer[2];
      }
   }
   fclose ($fd);
// process team B
   $fd = fopen ("$teamBcsv", "r");
   while (!feof ($fd)) {
      $buffer = fgetcsv($fd, 4096);

      for ($i = 0; $i < 6; ++$i){
         // parse date field dd MMM yyy	  
         if ($i == 1){ list($day, $month, $year) = split(' ', $buffer[$i]); }
      }
      if ($month == "$selMonth"){
          if ($buffer[4] == "home"){ $ha = "H"; }
          else { $ha = "A"; }
          $teamBlist[$day] = $buffer[3]." (".$ha.")";
          $weekdayList[$day] = $buffer[2];
      }
   }
   fclose ($fd);
// process Alley
   if (file_exists($alleyXcsv)) {
      // alley has extra non-BDSL dates
      $fd = fopen ("$alleyXcsv", "r");
      $otherLeague = 1;
   }
   else {
      $fd = fopen ("$alleyAcsv", "r");
      $otherLeague = 0;
   }
   $tdslFlag=0;
   $sdslFlag=0;
   $ndslFlag=0;
   while (!feof ($fd)) {
      $buffer = fgetcsv($fd, 4096);
      for ($i = 0; $i < 5; ++$i){
         if ($i == 1){ list($day, $month, $year) = split(' ', $buffer[$i]); }
      }
      if (strpos($buffer[3],"TDSL") > 0) { $tdslFlag=1; }
      if (strpos($buffer[3],"SDSL") > 0) { $sdslFlag=1; }
      if (strpos($buffer[3],"NDSL") > 0) { $ndslFlag=1; }
      if ($month == "$selMonth"){
         if ($alleyAlist[$day] == ""){
            $alleyAlist[$day] = $buffer[3];
            $weekdayList[$day] = $buffer[2];
         }
         else {
            $alleyBlist[$day] = $buffer[3];
            $alleyflag = 2;
         }
      }
   }
   fclose ($fd);
// build output
   $pageTitle = $teamA.' v '.$teamB.' @ '.$alleyA.' - '.$month ;
   include ('pageheader.php');
   include ('checkinc.php');
   echo "<br>\n";
   $tdHdrStyle = "class=\"hdrchecker\"";
   $tdDataStyleOK = "class=\"normal\"";
   $tdDataStyleNA = "class=\"title\"";
   $tdDataStyleIP = "class=\"normalgray\"";
   $finalMessage = "No dates available - check with the alley for cancellations or try an alternative";
   if ($tdslFlag == 1 & $sdslFlag == 1){
      $warningMessage = "<b>NB</b> this page only shows league fixtures as per the fixtures list and includes Stroud &amp; District League (SDSL) fixtures <br>and Thornbury &amp; District League (TDSL) fixtures<br>It does not allow for cancelled, rearranged or cup fixtures" ;
   }
   elseif ($ndslFlag == 1 & $sdslFlag == 1){
      $warningMessage = "<b>NB</b> this page only shows league fixtures as per the fixtures list and includes Stroud &amp; District League (SDSL) fixtures <br>and Nailsworth &amp; District League (NDSL) fixtures<br>It does not allow for cancelled, rearranged or cup fixtures" ;
   }
   elseif ($ndslFlag == 1 & $sdslFlag == 0){
      $warningMessage = "<b>NB</b> this page only shows league fixtures as per the fixtures list and includes Nailsworth &amp; District League (NDSL) fixtures<br>It does not allow for cancelled, rearranged or cup fixtures" ;
   }
   elseif ($tdslFlag == 1 & $sdslFlag == 0){
      $warningMessage = "<b>NB</b> this page only shows league fixtures as per the fixtures list and includes Thornbury &amp; District League (TDSL) fixtures<br>It does not allow for cancelled, rearranged or cup fixtures" ;
   }
   elseif ($tdslFlag == 0 & $sdslFlag == 1){
      $warningMessage = "<b>NB</b> this page only shows league fixtures as per the fixtures list and includes Stroud &amp; District League (SDSL) fixtures<br>It does not allow for cancelled, rearranged or cup fixtures" ;
   }
   else {
      $warningMessage = "<b>NB</b> this page only shows league fixtures as per the fixtures list<br>It does not allow for cancelled, rearranged or cup fixtures" ;
   }
   echo "<!-- begin checker output -->\n";
   echo "<table class=\"border\">\n";
   if ($alleyflag == 2){
      $colSpan=7;
   }
   else {
      $colSpan=6;
   }
   if ($alleyflag == 2){
      echo " <tr><td $tdHdrStyle align=\"center\" valign=\"bottom\">Date</td><td $tdHdrStyle align=\"center\" valign=\"bottom\">Day</td><td valign=\"top\" $tdHdrStyle>$teamAhdr</td><td valign=\"top\" $tdHdrStyle>$teamBhdr<br></td><td valign=\"top\" $tdHdrStyle><br><b>$alleyA Alley</b>$alleyAhdr<br><br><i>home team</i></td><td valign=\"top\" $tdHdrStyle><br><b>Second Alley</b><br><br><br><i>home team</i></td><td $tdHdrStyle>&nbsp;</td></tr>\n";
   }
   else {
      echo " <tr><td $tdHdrStyle align=\"center\" valign=\"bottom\">Date</td><td $tdHdrStyle align=\"center\" valign=\"bottom\">Day</td><td valign=\"top\" $tdHdrStyle>$teamAhdr</td><td valign=top $tdHdrStyle>$teamBhdr<br></td><td valign=\"top\" $tdHdrStyle><br><b>$alleyA Alley</b>$alleyAhdr<br><br><i>home team</i></td><td $tdHdrStyle>&nbsp;</td></tr>\n";
   }
   if ($selMonth == "Sep" | $selMonth == "Nov" | $selMonth == "Apr"){ $monthDays = 30; }
   elseif ($selMonth == "Feb"){ $monthDays = $febDays; }
   else { $monthDays = 31; }
   for ($d = 1; $d <= $monthDays; ++$d){
      if ($teamAlist[$d] == ""){ $teamAlist[$d] = "&nbsp;"; }
      if ($teamBlist[$d] == ""){ $teamBlist[$d] = "&nbsp;"; }
      if ($alleyAlist[$d] == ""){ $alleyAlist[$d] = "&nbsp;"; }
      if ($alleyBlist[$d] == ""){ $alleyBlist[$d] = "&nbsp;"; }
      $weekdayList[$d] = date("D",strtotime("$d $selMonth $selYear"));
      if ($weekdayList[$d] != "Sat" & $weekdayList[$d] != "Sun"){
         $checkAteam = "NA";
         $checkBteam = "NA";
         $checkAalley = "NA";
         $checkBalley = "NA";
         $byeCheck = substr($teamAlist[$d],0,3);
         if ($teamAlist[$d] == "&nbsp;" | $byeCheck == "***"){
            $checkAteam = "OK";
         }
         $byeCheck = substr($teamBlist[$d],0,3);
         if ($teamBlist[$d] == "&nbsp;" | $byeCheck == "***"){
            $checkBteam = "OK";
         }
		 $byeCheck = substr($alleyAlist[$d],0,3);
         if ($alleyAlist[$d] == "&nbsp;" | $byeCheck == "***"){
            $checkAalley = "OK";
         }
		 $byeCheck = substr($alleyBlist[$d],0,3);
         if ($alleyBlist[$d] == "&nbsp;" | $byeCheck == "***"){
            $checkBalley = "OK";
         }
         if ($checkAteam == "OK" & $checkBteam == "OK" & $checkAalley == "OK"){
            $tdDataStyle = $tdDataStyleOK;
			$freeFlag = "&#171; date available";
		    $calTime = strtotime("$d $selMonth $selYear") + (60 * 60 * 20);
	        if ($calTime <= $localTime) {
			   $tdDataStyle = $tdDataStyleIP;
			   $freeFlag = "<s>".$freeFlag."</s>";
			}
            $finalMessage = $warningMessage;
         }
         else {
            $tdDataStyle = $tdDataStyleNA;
            $freeFlag = "&nbsp;" ;
         }
		 $testDate = $d.' '.$selMonth.' '.substr($selYear,2,2);
		 $outDate = $d.' '. $selMonth;
		 $outDay = $weekdayList[$d];
		 if (strpos($bdslBankHols, '['.$testDate.']') !== false) {
            $outDate = "<span style=\"color:red\">$outDate</span>" ;
            $outDay = "<span style=\"color:red\">$outDay</span>" ;					
         }
         if ($alleyflag == 2){
            if ($checkAteam == "OK" & $checkBteam == "OK" & $checkBalley == "OK"){
               $tdDataStyle = $tdDataStyleOK;
		       $calTime = strtotime("$d $selMonth $selYear") + (60 * 60 * 20);
	           if ($calTime <= $localTime) {
			      $tdDataStyle = $tdDataStyleIP;
			      $freeFlag = "<s>".$freeFlag."</s>";
		       }
               if ($checkAalley == "NA"){
                  $freeFlag = "&#171; date available (2nd alley)";
	              if ($calTime <= $localTime) {
			         $tdDataStyle = $tdDataStyleIP;
			         $freeFlag = "<s>".$freeFlag."</s>";
		          }				  
                  $finalMessage = $warningMessage;
               }
               else {
                  $freeFlag = "&#171; date available";
	              if ($calTime <= $localTime) {
			         $tdDataStyle = $tdDataStyleIP;
			         $freeFlag = "<s>".$freeFlag."</s>";
		          }				  
                  $finalMessage = $warningMessage;
               }
            }
            else {
               $tdDataStyle = $tdDataStyleNA;
               $freeFlag = "&nbsp;" ;
            }
            echo " <tr><td $tdDataStyle>$outDate</td><td $tdDataStyle>$outDay</td><td $tdDataStyle>$teamAlist[$d]</td><td $tdDataStyle>$teamBlist[$d]</td><td $tdDataStyle><i>$alleyAlist[$d]</i></td><td $tdDataStyle><i>$alleyBlist[$d]</i></td><td $tdDataStyle>$freeFlag</td></tr>\n";
         }
         else {
            echo " <tr><td $tdDataStyle>$outDate</td><td $tdDataStyle>$outDay</td><td $tdDataStyle>$teamAlist[$d]</td><td $tdDataStyle>$teamBlist[$d]</td><td $tdDataStyle><i>$alleyAlist[$d]</i></td><td $tdDataStyle>$freeFlag</td></tr>\n";
         }
      }
      if ($weekdayList[$d] == "Fri" and $d < ($monthDays - 2)){
         echo " <tr><td colspan=\"$colSpan\" class=\"hdrchecker\"><img src=\"/resource/transparent.gif\" width=\"0\" height=\"0\" alt=\"\"></td></tr>\n";
      }
   }
   echo " <tr><td colspan=\"$colSpan\" class=\"hdrchecker\"><img src=\"/resource/transparent.gif\" width=\"0\" height=\"0\" alt=\"\"></td></tr>\n";
   echo " <tr><td colspan=\"$colSpan\" class=\"normalerror\">$finalMessage</td></tr>\n";
   echo "</table>\n";
   echo "<!-- end checker output -->\n";
   include ('pagefooter.php');
 ?>
