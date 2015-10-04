<?php
 include ('bdsldates.php');
 $team = $_GET["team"];
 $name = $_GET["name"];
 $div = $_GET["div"];
 echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
 echo "<html>\n";
 echo "<head>\n";
 echo "<title>$name - $div fixtures</title>\n";
 echo "</head>\n";
 echo "<body>\n";
 echo "<script type=\"text/javascript\">var sc_project=2897603; var sc_invisible=1; var sc_partition=29; var sc_security=\"4d6ebeab\";</script>\n";
 echo "<script type=\"text/javascript\" src=\"http://www.statcounter.com/counter/counter_xhtml.js\"></script>\n";
 echo "<noscript><div class=\"statcounter\"><A class=\"statcounter\" HREF=\"http://www.statcounter.com/\"><img class=\"statcounter\" src=\"http://c30.statcounter.com/2897603/0/4d6ebeab/0/\" ALT=\"StatCounter\"></a></div></noscript>\n";
 echo "<table align=\"left\" border=1 cellspacing=0 cellpadding=4>\n";
 $mmOld='';
 $csvFile = 'csv/t'.$team.'.csv';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 4096);
    // the 6 represents the number of columns in csv/t:$team.csv
    for ($i = 0; $i < 6; ++$i){
          if ($i == 0){
             $tweek = $buffer[$i];
          }
          if ($i == 1){
             $tdate = $buffer[$i];
             if (strpos($bdslBankHols, '['.$tdate.']') !== false) {
               $tdate = strtoupper($tdate);
               $tdate = "<span style=\"color:red\">$tdate</span>" ;
             }
             list($dd, $mm, $yy) = split(' ', $tdate);
          }
          if ($i == 2){
             $tday = $buffer[$i];
          }
          if ($i == 3){
             $tversus = $buffer[$i];
          }
          if ($i == 4){
             $thora = $buffer[$i];
          }
          if ($i == 5){
             $talley = $buffer[$i].'&nbsp;';
          }
    }
    ++$fCnt;
    if ($fCnt == 1){
       echo "   <tr>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 80%\" colspan=\"6\"><a href=\"http://www.berkeleydsl.org.uk\"><img src=\"resource/bdslsmall.gif\" alt=\"Berkeley and District Skittles League\" align=\"right\" border=\"0\"></a><b>$name</b><br><small>$div fixtures</small></td>\n";
       echo "   </tr>\n";
       echo "   <tr>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 60%\">Week</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 60%\">Date</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 60%\">Day</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 60%\">Versus</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 60%\">H/A</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 60%\">Alley</td>\n";
       echo "   </tr>\n";
    }
    if ($mm == 'Jan' and $mmOld == 'Dec'){
       echo "   <tr>\n";
       echo "    <td nowrap colspan=\"6\" align=\"center\" style=\"font-family: Verdana; font-size: 60%\"><i>xmas break</i></td>\n";
       echo "   </tr>\n";
    }
    if ($tweek != ''){
       echo "   <tr>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 70%\">$tweek</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 70%\">$tdate</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 70%\">$tday</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 70%\">$tversus</td>\n";
       echo "    <td nowrap align=\"center\" style=\"font-family: Verdana; font-size: 70%\">$thora</td>\n";
       echo "    <td nowrap align=\"left\" style=\"font-family: Verdana; font-size: 70%\">$talley</td>\n";
       echo "   </tr>\n";
    }
    $mmOld = $mm;
 }
 fclose ($fd);
 echo "</table>\n";
 echo "</body>\n";
 echo "</html>\n";
?>
