<?php
 $team = $_GET["team"];
 $name = $_GET["name"];
 $div  = $_GET["div"];
 $home = $_GET["home"];
 $localTime = time();
 $localTime = $localTime - (60 * 60 * 1);
 $thisYear  = date("Y",$localTime);
 $thisMonth = date("m",$localTime);
 $thisDay   = date("d",$localTime);
 $thisHour  = date("G",$localTime);
 $thisMin   = date("H",$localTime);
 $thisSec   = date("s",$localTime);
 $uid       = 100;
 $dtStamp   = $thisYear.$thisMonth.$thisDay.'T'.$thisHour.$thisMin.$thisSec.'Z';
 $csvFile = 'csv/t'.$team.'.csv';
 header("Content-Type: text/Calendar");
 header("Content-Disposition: inline; filename=BDSL $name.ics");
 echo "BEGIN:VCALENDAR\r\n";
 echo "VERSION:2.0\r\n";
 echo "PRODID:-//BDSL//$name//EN\r\n";
 echo "CALSCALE:GREGORIAN\r\n";
 echo "X-WR-RELCALID;VALUE=TEXT:E0A52536-791B-4589-B4BF-57A20CE090A0\r\n";
 echo "X-WR-TIMEZONE:Europe/London\r\n";
 echo "X-WR-CALNAME;VALUE=TEXT:BDSL $name\r\n";
 echo "X-TC-DTSTAMP:$dtStamp\r\n";
 echo "X-TC-CALCOLOR;VALUE=INTEGER;X-TC-CALCOLORTYPE=RGB:181,197,244\r\n";
 echo "BEGIN:VTIMEZONE\r\n";
 echo "TZID:Europe/London\r\n";
 echo "BEGIN:STANDARD\r\n";
 echo "TZOFFSETFROM:+0100\r\n";
 echo "TZOFFSETTO:+0000\r\n";
 echo "TZNAME:GMT\r\n";
 echo "DTSTART:19701025T020000\r\n";
 echo "RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU\r\n";
 echo "END:STANDARD\r\n";
 echo "BEGIN:DAYLIGHT\r\n";
 echo "TZOFFSETFROM:+0000\r\n";
 echo "TZOFFSETTO:+0100\r\n";
 echo "TZNAME:BST\r\n";
 echo "DTSTART:19700329T010000\r\n";
 echo "RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU\r\n";
 echo "END:DAYLIGHT\r\n";
 echo "END:VTIMEZONE\r\n";
  $csvFile = 'csv/t'.$team.'.csv';
 $fCnt=0;
  $fd = fopen ("$csvFile", "r");
 while (!feof ($fd)) {
    $buffer = fgetcsv($fd, 4096);
    // the 6 represents the number of columns in csv/t:$team.csv
    for ($i = 0; $i < 6; ++$i){
          if ($i == 0){
             $tweek = $buffer[$i];
          }
          if ($i == 1){
             $tdate = $buffer[$i];
			 $tdate = strtotime($tdate);
             $yy = date("Y",$tdate);
             $mm = date("m",$tdate);
             $dd = date("d",$tdate);
          }
          if ($i == 2){
             $tday = $buffer[$i];
          }
          if ($i == 3){
             $tversus = $buffer[$i];
			 list($byeCheck, $byeTail) = split(' ',$tversus);
             if ($byeCheck == "***"){
                $tversus = '[no fixture - '.$byeTail.']';
             }
          }
          if ($i == 4){
             $thora = $buffer[$i];
          }
          if ($i == 5){
             $talley = $buffer[$i];
			 if ($thora == 'home'){
			    $talley = $home;
			 }
			 if ($byeCheck == "***"){
                $talley = '';
             }
          }
    }
    ++$fCnt;
    if ($tweek != ''){
	  $uid+=1;
      echo "BEGIN:VEVENT\r\n";
      echo "UID:B5D38DC8-$yy-$mm$dd-BBE1-99CB1AEF7$uid\r\n";
      echo "DTSTAMP:$dtStamp\r\n";
      echo 'DTSTART;TZID=Europe/London:'.$yy.$mm.$dd.'T203000'."\r\n";
      echo 'DTEND;TZID=Europe/London:'.$yy.$mm.$dd.'T223000'."\r\n";
      echo "SUMMARY:v $tversus ($thora)\r\n";
      echo "LOCATION:$talley\r\n";
      echo "URL;VALUE=URI:http://www.berkeleydsl.org.uk/team.php?div=$div&team=$team\r\n";
      echo "END:VEVENT\r\n";
    }
 }
 echo "END:VCALENDAR\r\n";
 fclose ($fd);
?>
