<?php
 $fixDate = $_GET["fixt"];
 $pageTitle = '';
 include ('pageheader.php');
?>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
 <tr>
  <td width="67%" valign="top">
   <table width="100%" border="0" cellspacing="3" cellpadding="3">
    <tr>
     <td align="center">
<?php
   $localTime=time();
   $localTime=$localTime - (60 * 60 * 1);
   $chkDay = date("j",$localTime);
   $chkMonth = date("n",$localTime);
   // process csv file
   $fd = fopen ('csv/ukholiday.csv', "r");
   // initialize a loop to go through each line of the file
   while (!feof ($fd)) {
      // declare an array to hold all of the contents of each row, indexed
      $buffer = fgetcsv($fd, 4096);
      // the 10 represents the number of columns in the text file
      for ($i = 0; $i < 10; ++$i){
         if ($i == 0){ $holDay = $buffer[$i]; }
         if ($i == 1){ $holMonth = $buffer[$i]; }
         if ($i == 2){ $holAlt = $buffer[$i]; }
         if ($i == 3){ $holLink = $buffer[$i]; }
         if ($i == 4){ $holGifL = $buffer[$i]; }
         if ($i == 5){ $holGifHL = $buffer[$i]; }
         if ($i == 6){ $holGifWL = $buffer[$i]; }
         if ($i == 7){ $holGifR = $buffer[$i]; }
         if ($i == 8){ $holGifHR = $buffer[$i]; }
         if ($i == 9){ $holGifWR = $buffer[$i]; }
      }
      if ($chkDay == $holDay & $chkMonth == $holMonth){
         if ($holGifL != ""){
            echo "      <img src=\"/resource/$holGifL\" hspace=\"10\" border=\"0\" align=\"left\" alt=\"$holAlt\" height=\"$holGifHL\" width=\"$holGifWL\">\n";
         }
         if ($holGifR != ""){
            echo "      <img src=\"/resource/$holGifR\" hspace=\"10\" border=\"0\" align=\"right\" alt=\"$holAlt\" height=\"$holGifHR\" width=\"$holGifWR\">\n";
         }
      }
   }
   fclose ($fd);
?>
    <!-- begin diary -->
    <div class="roundbox">
      <table width="90%">
       <tr><td align="left" colspan="2" style="background-color: "><h5>Forthcoming dates in the Diary</h5></td></tr>
       <tr><td class="verysmall" colspan="2">&nbsp;</td></tr>
<?php
 $localTime=time();
 $localTime=$localTime - (60 * 60 * 1);
 $thisDay = date("d",$localTime);
 $thisMonth = date("m",$localTime);
 $thisYear = date("Y",$localTime);
 $dataOut='';
 $dataOut[0]='Forthcoming events from the Diary';
 $dataOut[1]='<i>- none</i>';
 $fCnt=1;
 // process csv file
 $fd = fopen ('csv/diary.csv', "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 4096);
    // the 8 represents the number of columns in the csv file
    for ($i = 0; $i < 8; ++$i){
       if ($i == 0){ $eventYear = $buffer[$i]; }
       if ($i == 1){ $eventMonth = $buffer[$i]; }
       if ($i == 2){ $eventDay = $buffer[$i]; }
       if ($i == 3){ $eventDesc = $buffer[$i]; }
       if ($i == 4){ $eventLoc = $buffer[$i]; }
    }
    if ($eventLoc != ''){
       $eventDesc = $eventDesc . ' <i>(at ' . $eventLoc . ')</i>';
    }
    if ($eventYear == $thisYear & $eventMonth == $thisMonth & $eventDay == $thisDay){
       $dataOut[$fCnt] = '<img src="resource/pin_today.gif" alt="today"> today</td><td class="normal">'.$eventDesc;
       ++$fCnt;
    }
    if ($eventYear == $thisYear & $eventMonth == $thisMonth & $eventDay > $thisDay){
       $dataOut[$fCnt] = $buffer[7].' '.$buffer[6].' </td><td class="normal">'.$eventDesc;
       ++$fCnt;
    }
    if ($eventYear >= $thisYear & $eventMonth > $thisMonth){
       $dataOut[$fCnt] = $buffer[7].' '.$buffer[6].' </td><td class="normal">'.$eventDesc;
       ++$fCnt;
    }
    if ($eventYear > $thisYear){
       $dataOut[$fCnt] = $buffer[7].' '.$buffer[6].' </td><td class="normal">'.$eventDesc;
       ++$fCnt;
    }
 }
 fclose ($fd);
 // build output
 if ($fCnt >= 3){
    $lMax = 3;
 }
 else {
    $lMax = ($fCnt - 1);
 }
 for ($lCnt = 0; $lCnt <= $lMax; ++$lCnt){
    if ($lCnt == 0){
       // echo "       <tr><td class=\"hdrsmall\" nowrap colspan=\"2\">$dataOut[$lCnt]</td></tr>\n";
    }
    else {
       echo "       <tr><td class=\"normalgrayright\" nowrap>$dataOut[$lCnt]</td></tr>\n";
    }
 }
?>
       <tr><td class="normalright" colspan="2"><a href="diary.php" title="View diary">[more...]</a></td></tr>
      </table>
    </div>
      <!-- end diary -->
     </td>
    </tr>
    <tr><td class="verysmall">&nbsp;</td></tr>
    <tr>
     <td align="center">
     <?php include ('leaders.php');?>
     </td>
    </tr>
    <tr><td class="verysmall">&nbsp;</td></tr>
    <tr>
     <td align="center" width="90%">
      <?php include ('noticesinc.php');?>
     </td>
    </tr>
   </table>
  </td>
  <td width="33%" valign="top">
   <table width="100%" border=0>
    <tr>
     <td>
      <table width="100%">
       <tr><td class="hdrsmall">Welcome</td></tr>
       <tr><td class="normal">The Berkeley and District Skittles League was formed in 1957 and consists of up to 112 teams in 7 divisions playing from September  to April every year. Matches are played on 18 alleys in pubs and clubs in Berkeley, Sharpness, Cam, Dursley, Coaley, Wotton-under-Edge, Slimbridge and Rockhampton.&nbsp;<a href="about.php" title="Read more about the League">[more...]</a></td></tr>
      </table>
     </td>
    </tr>
    <tr><td class="verysmall">&nbsp;</td></tr>
    <tr>
     <td align="left">
      <?php include ('downloads.php');?>
     </td>
    </tr>
    <tr><td class="verysmall">&nbsp;</td></tr>
    <tr>
     <td align="left">
      <!-- begin fixtures php -->
      <table width="100%">
<?php
 if ($fixDate == '') {
    $localTime=time();
    $localTime=$localTime - (60 * 60 * 1);
    if (date("w",$localTime) == 6) { $localTime=$localTime + (24*60*60); }
    if (date("w",$localTime) == 0) { $localTime=$localTime + (24*60*60); }
 }
 else {
    $localTime=$fixDate;
 }
 $today = date("j M y",$localTime);
 $dispDay = date("j",$localTime);
 if ($dispDay == 1 | $dispDay == 21 | $dispDay == 31){
    $dispDay = $dispDay.'st';
 }
 elseif ($dispDay == 2 | $dispDay == 22){
    $dispDay = $dispDay.'nd';
 }
 elseif ($dispDay == 3 | $dispDay == 23){
    $dispDay = $dispDay.'rd';
 }
 else {
    $dispDay = $dispDay.'th';
 }
 $dispToday = date("D",$localTime)." ".$dispDay." ".date("F",$localTime);
 $dataOut='';
 $dataOut[0]='League Fixtures for';
 $dataOut[1]=$dispToday;
 $thisMonth = date("M",$localTime);
 if ($thisMonth == 'May' or $thisMonth == 'Jun' or $thisMonth == 'Jul' or $thisMonth == 'Aug'){
    $dataOut[2]='<i> - no fixtures (close season)</i>';
 }
 elseif ($thisMonth == 'Dec' & $dispDay >= 18){
    $dataOut[2]='<i> - no fixtures (xmas break)</i>';
 }
 elseif ($thisMonth == 'Jan' & $dispDay < 4){
    $dataOut[2]='<i> - no fixtures (xmas break)</i>';
 }
 else {
    $dataOut[2]='<i> - no fixtures</i>';
 }
 $fCnt=2;
 for ($d = 0; $d <= 6; ++$d){
    if ($d == 0) {
       $divCsv ='csv/fPremierDivision.csv';
       $divDesc = 'Prem:';
    }
    else {
       $divCsv ='csv/fDivision'.$d.'.csv';
        $divDesc = 'Div '.$d.':';
    }
    $fd = fopen ("$divCsv", "r");
    $dCnt = 0;
    while (!feof ($fd)) {
       $buffer = fgetcsv($fd, 4096);
       for ($i = 0; $i < 6; ++$i){
          if ($i == 1){ $gameDate = $buffer[$i]; }
       }
       if ($gameDate == $today){
          ++$dCnt;
          if ($dCnt == 1) {
             $dataOut[$fCnt]='&nbsp;';
             ++$fCnt;
          }
          $dataOut[$fCnt]=$divDesc.' <b>'.$buffer[3].'</b> v <b>'.$buffer[4].'</b>';
          ++$fCnt;
       }
    }
    fclose ($fd);
 }
 $nextTime = $localTime + (60 * 60 * 24);
 $prevTime = $localTime - (60 * 60 * 24);
 if (date("w",$nextTime) == 6) { $nextTime = $nextTime + (60 * 60 * 48); }
 if (date("w",$prevTime) == 0) { $prevTime = $prevTime - (60 * 60 * 48); }
 for ($lCnt = 0; $lCnt <= $fCnt; ++$lCnt){
    if ($lCnt == 0){
       echo "       <tr><td class=\"hdrsmall\" nowrap>$dataOut[0] $dataOut[1]</td><td class=\"hdrsmall\" nowrap align=\"right\"> <a href=\"index.php?fixt=$prevTime\" title=\"Show fixtures for previous day\"><img src=\"resource/back2.gif\" border=0 alt=\"Show fixtures for previous day\"></a> <a href=\"index.php?fixt=$nextTime\" title=\"Show fixtures for next day\"><img src=\"resource/fwd2.gif\" border=0 alt=\"Show fixtures for next day\"></a></td></tr>\n";
       $lCnt = 1;
     }
    else {
       if ($dataOut[$lCnt] == '&nbsp;') {
          echo "       <tr><td class=\"verysmall\" nowrap colspan=\"2\">$dataOut[$lCnt]</td></tr>\n";
       }
       else {
          echo "       <tr><td class=\"normal\" nowrap colspan=\"2\">$dataOut[$lCnt]</td></tr>\n";
       }
     }
 }
?>
      </table>
      <!-- end fixtures php -->
     </td>
    </tr>
    <tr><td class="normal"><?php include ('footnoteinc.php');?></td></tr>
   </table>
  </td>
 </tr>
</table>
<?php include ('pagefooter.php');?>
