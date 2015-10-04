<?php
 $alley = $_GET["alley"];
 $name = $_GET["name"];
 echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
 echo "<html>\n";
 echo "<head>\n";
 echo " <title>$name - BDSL fixtures</title>\n";
 echo "</head>\n";
 echo "<body>\n";
 echo "<script type=\"text/javascript\">var sc_project=2897603; var sc_invisible=1; var sc_partition=29; var sc_security=\"4d6ebeab\";</script>\n";
 echo "<script type=\"text/javascript\" src=\"http://www.statcounter.com/counter/counter_xhtml.js\"></script>\n";
 echo "<noscript><div class=\"statcounter\"><a class=\"statcounter\" href=\"http://www.statcounter.com/\"><img class=\"statcounter\" src=\"http://c30.statcounter.com/2897603/0/4d6ebeab/0/\" alt=\"StatCounter\"></a></div></noscript>\n";
 echo "<table>\n";
 echo " <tr>\n";
 echo "  <td valign=\"top\">\n";
 echo "   <table align=\"left\" border=1 cellspacing=0 cellpadding=3>\n";
 $csvFile = 'csv/a'.$alley.'.csv';
 $fCnt=0;
 $newTable=0;
 $tdCnt=1;
 $mmOld='';
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 4096);
    // the 5 represents the number of columns in the text file
    for ($i = 0; $i < 5; ++$i){
       if ($i == 0){ $week = $buffer[$i]; }
       if ($i == 1){
          $date = $buffer[$i];
          list($dd, $mm, $yy) = split(' ', $date);
       }
       if ($i == 2){ $day = $buffer[$i]; }
       if ($i == 3){ $team = $buffer[$i]; }
       if ($i == 4){ $div = $buffer[$i]; }
    }
    ++$fCnt;
    if ($mm == 'Jan' and $mmOld == 'Dec'){
       echo "   <tr>\n";
       echo "    <td nowrap colspan=\"5\" align=\"center\" style=\"font-family: Verdana; font-size: 60%\"><i>xmas break</i></td>\n";
       echo "   </tr>\n";
       ++$fCnt;
    }
    if ($fCnt == 41){
       $newTable = 1;
       $tdCnt = 1;
    }
    elseif ($fCnt == 80){
       $newTable = 2;
       $tdCnt = 1;
    }
    elseif ($fCnt == 119){
       $newTable = 1;
       $tdCnt = 2;
    }
    elseif ($fCnt == 158){
       $newTable = 2;
       $tdCnt = 3;
    }
    else {
       $newTable = 0;
    }
    if ($newTable == 2){
       echo "   </table>\n";
       echo "  </td>\n";
       echo " </tr>\n";
       echo " </table>\n";
       echo " <br style=\"{page-break-after: always}\">\n";
       echo " <table>\n";
       echo " <tr>\n";
       echo "  <td valign=\"top\">\n";
       echo "   <table align=\"left\" border=1 cellspacing=0 cellpadding=3>\n";
    }
    if ($newTable == 1){
       echo "   </table>\n";
       echo "  </td>\n";
       echo "  <td valign=\"top\">\n";
       echo "   <table align=\"left\" border=1 cellspacing=0 cellpadding=3>\n";
    }
    if ($newTable != 0){
       echo "   <tr>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 70%\" colspan=\"5\"><a href=\"http://www.berkeleydsl.org.uk\"><img src=\"resource/bdslsmall.gif\" alt=\"Berkeley and District Skittles League\" align=\"right\" border=\"0\"></a><b>$name Alley</b><br><small>BDSL fixtures</i></small></td>\n";
       echo "   </tr>\n";
       echo "   <tr>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 60%\">Week</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 60%\">Date</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 60%\">Day</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 60%\">Home Team</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 60%\">Div</td>\n";
       echo "   </tr>\n";
    }
    if ($fCnt == 1){
       echo "   <tr>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 70%\" colspan=\"5\"><a href=\"http://www.berkeleydsl.org.uk\"><img src=\"resource/bdslsmall.gif\" alt=\"Berkeley and District Skittles League\" align=\"right\" border=\"0\"></a><b>$name Alley</b><br><small>BDSL fixtures</small></a></td>\n";
       echo "   </tr>\n";
       echo "   <tr>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 60%\">$week</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 60%\">$date</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 60%\">$day</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 60%\">$team</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 60%\">Div</td>\n";
       echo "   </tr>\n";
    }
    if ($week != '' and $fCnt != 1){
       echo "   <tr>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 70%\">$week</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 70%\">$date</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 70%\">$day</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 70%\">$team</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 70%\">$div</td>\n";
       echo "   </tr>\n";
    }
    $mmOld = $mm;
 }
 fclose ($fd);
 echo "   </table>\n";
 echo "  </td>\n";
 if ($tdCnt == 1 and $fCnt >= 41){
    echo "  </td>\n";
    echo "  <td>\n";
    echo "  </td>\n";
    echo " </tr>\n";
 }
 echo " </tr>\n";
 echo "</table>\n";
 echo "</body>\n";
 echo "</html>\n";
?>
