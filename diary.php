<?php
 $pageTitle='Diary';
 include ('pageheader.php');
?>
<h3>Diary</h3>
<table class="noborder">
<?php
 $tdDataStyle = "class=\"normal\"";
 $space = "&nbsp;";
 $localTime=time();
 $localTime=$localTime - (60 * 60 * 1);
 $thisDay = date("d",$localTime);
 $thisMonth = date("m",$localTime);
 $thisYear = date("Y",$localTime);
 $checkMonth = 0;
 // process csv file
 $fd = fopen ('csv/diary.csv', "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 4096);
    // the 6 represents the number of columns in the text file
    for ($i = 0; $i < 8; ++$i){
      if ($i == 0){ $eventYear = $buffer[$i]; }
      if ($i == 1){ $eventMonth = $buffer[$i]; }
      if ($i == 2){ $eventDay = $buffer[$i]; }
      if ($i == 3){ $eventDesc = $buffer[$i]; }
      if ($i == 4){ $eventLocation = $buffer[$i]; }
      if ($i == 5){ $eventDate = $buffer[$i]; }
      if ($i == 6){ $eventMonthAlpha = $buffer[$i]; }
      if ($i == 7){ $eventDateShort = $buffer[$i]; }
    }
    if ($eventYear == $thisYear & $eventMonth == $thisMonth & $eventDay < $thisDay){
       $greyOut = 'Y';
    }
    elseif ($eventYear <= $thisYear & $eventMonth < $thisMonth){
       $greyOut = 'Y';
    }
    elseif ($eventYear < $thisYear){
       $greyOut = 'Y';
    }
    else{
       $greyOut = 'N';
    }
    if ($greyOut == 'N'){
       $tdDataStyle = "class=\"normal\"";
       $strikeO = '';
       $strikeC = '';
    }
    else{
       $tdDataStyle = "class=\"normalgray\"";
       $strikeO = '<s>';
       $strikeC = '</s>';
    }
    if ($eventMonth <> $checkMonth){
       $checkMonth = $eventMonth;
       $tdDataStyleChk = $tdDataStyle;
       if ($eventMonth == $thisMonth & $greyOut == 'Y'){
          $tdDataStyle = "class=\"normal\"";
       }
       echo " <tr>\n";
       echo "  <td nowrap $tdDataStyle colspan=\"5\"><b>$eventMonthAlpha $eventYear</b></td>\n";
       echo " </tr>\n";
       $tdDataStyle = $tdDataStyleChk;
    }
    if ($eventDateShort <> ''){
       echo " <tr>\n";
       echo "  <td nowrap $tdDataStyle>$strikeO$eventDateShort$strikeC</td>\n";
       echo "  <td nowrap $tdDataStyle>$space</td>\n";
       echo "  <td nowrap $tdDataStyle>$strikeO$eventDesc$strikeC</td>\n";
       echo "  <td nowrap $tdDataStyle>$space</td>\n";
       echo "  <td nowrap $tdDataStyle>$strikeO$eventLocation$strikeC</td>\n";
       echo " </tr>\n";
   }
 }
 fclose ($fd);
?>
</table>
<?php include ('pagefooter.php');?>
