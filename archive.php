<?php
 // under source control
 $award = $_GET["award"];
 $years = $_GET["season"];
 $pageTitle = 'Awards Archive';
 include ('pageheader.php');
 include ('seasoninc.php');
 echo "  <h3>Awards and Honours Archive</h3><br>\n";
 echo "  <table class=\"noborder\"><tr><td>\n";
 echo "   <table class=\"border\" width=\"100%\">\n";
 echo "    <tr>\n";
 echo "    <td class=\"title\">\n";
            include ('listhista.php');
 echo "    </td>\n";
 echo "    <td class=\"title\">\n";
            include ('listhists.php');
 echo "    </td>\n";
 echo "   </tr>\n";
 echo "  </table>\n";
 $csvA = 'csv/hist_award.csv';
 $csvH = 'csv/hist_honour.csv';
 if ($award == '' and $years ==''){
    echo "   <tr><td class=\"normal\" width=\"100%\">\n";
    echo "<br><hr><br>Thanks go to Pat Day for collating this information from the league records and from the<br>trophies themselves.<br><br>Be aware that there are many gaps in the information available especially from the 1960s.<br><br>Select a <i>Title</i> or <i>Season</i> from the dropdown lists above.<br><br><hr>";
    echo "   </td></tr>\n";
 }
 if ($award != ''){
    echo "   <tr><td><table class=\"border\" width=\"100%\">\n";
    $fd = fopen ("$csvA", "r");
    while (!feof ($fd)) {
       $buffer = fgetcsv($fd, 4096);
       for ($i = 0; $i < 6; ++$i){
          if ($i == 0){ $code = $buffer[$i]; }
          if ($i == 1){ $name = $buffer[$i]; }
          if ($i == 2){ $notes = $buffer[$i]; }
          if ($i == 3){ $trophy1 = $buffer[$i]; }
          if ($i == 4){ $trophy2 = $buffer[$i]; }
          if ($i == 5){ $cols = $buffer[$i];}
       }
       if ($code == $award){
          $colspan = $cols+1;
          echo "   <tr>\n";
          echo "    <td class=\"normal\" colspan=\"$colspan\"></td>\n";
          echo "   </tr>\n";
          echo "   <tr>\n";
          echo "    <td nowrap class=\"hdrcenterpad\" colspan=\"$colspan\"><b>$name<b></td>\n";
          echo "   </tr>\n";
          if ($trophy1 != ''){
             echo "   <tr>\n";
             echo "    <td nowrap class=\"titlealtleft\" colspan=\"$colspan\"><i>Winner Trophy:</i><br>&nbsp;$trophy1</td>\n";
             echo "   </tr>\n";
          }
          if ($trophy2 != ''){
             echo "   <tr>\n";
             echo "    <td nowrap class=\"titlealtleft\" colspan=\"$colspan\"><i>Runner-up Trophy:</i><br>&nbsp;$trophy2</td>\n";
             echo "   </tr>\n";
          }
          if ($notes != ''){
             echo "   <tr>\n";
             echo "    <td nowrap class=\"normal\" colspan=\"$colspan\">$notes</td>\n";
             echo "   </tr>\n";
          }
          echo "   <tr>\n";
          echo "    <td nowrap class=\"title\">Season</td>\n";
          echo "    <td nowrap class=\"title\">Winner</td>\n";
          if ($colspan == 3) { echo "    <td nowrap class=\"title\">Runner-up</td>\n";}
          echo "   </tr>\n";
       }
    }
    $fd = fopen ("$csvH", "r");
    while (!feof ($fd)) {
       $buffer = fgetcsv($fd, 4096);
       for ($i = 0; $i < 4; ++$i){
          if ($i == 0){ $code = $buffer[$i]; }
          if ($i == 1){ $season = $buffer[$i]; }
          if ($i == 2){ $ch = $buffer[$i]; }
          if ($i == 3){ $ru = $buffer[$i]; }
       }
       if ($code == $award){
          $emS = '';
          $emE = '';
	         if (substr($thisSeason,0,4) == substr($season,0,4)){
		       $emS = '<b>';
			  $emE = '</b>';
		    }
          echo "   <tr>\n";
          echo "    <td nowrap class=\"normal\">$emS$season$emE</td>\n";
          echo "    <td nowrap class=\"normal\">$emS$ch$emE</td>\n";
          if ($colspan == 3) { echo "    <td nowrap class=\"normal\">$emS$ru$emE</td>\n";}
          echo "   </tr>\n";
       }
    }
    echo "  </td><tr></table>\n";
 }
 if ($years != ''){
    echo "   <tr><td><table class=\"border\" width=\"100%\">\n";
    echo "   <tr>\n";
    echo "    <td class=\"normal\" colspan=\"3\"></td>\n";
    echo "   </tr>\n";
    echo "   <tr>\n";
    echo "    <td nowrap class=\"hdrcenterpad\" colspan=\"3\"><b>Season $years<b></td>\n";
    echo "   </tr>\n";
    echo "   <tr>\n";
    echo "    <td nowrap class=\"title\">Title</td>\n";
    echo "    <td nowrap class=\"title\">Winner</td>\n";
    echo "    <td nowrap class=\"title\">Runner-up</td>\n";
    echo "   </tr>\n";
    $yCnt=0;
    $fd = fopen ("$csvH", "r");
    while (!feof ($fd)) {
       $buffer = fgetcsv($fd, 4096);
       for ($i = 0; $i < 4; ++$i){
          if ($i == 0){ $code = $buffer[$i]; }
          if ($i == 1){ $season = $buffer[$i]; }
          if ($i == 2){ $ch = $buffer[$i]; }
          if ($i == 3){ $ru = $buffer[$i]; }
       }
       if ($season == $years){
          $yCnt=0;
          $yd = fopen ("$csvA", "r");
          while (!feof ($yd)) {
             $byffer = fgetcsv($yd, 4096);
             for ($y = 0; $y < 6; ++$y){
                if ($y == 0){ $award = $byffer[$y]; }
                if ($y == 1){ $name = $byffer[$y]; }
                if ($y == 2){ $notes = $byffer[$y]; }
                if ($y == 3){ $trophy1 = $byffer[$y]; }
                if ($y == 4){ $trophy2 = $byffer[$y]; }
                if ($y == 5){ $cols = $byffer[$y];}
             }
             if ($code == $award) { $comp = $name; }
          }
          echo "   <tr>\n";
          echo "    <td nowrap class=\"normal\">$comp</td>\n";
          echo "    <td nowrap class=\"normal\">$ch</td>\n";
          echo "    <td nowrap class=\"normal\">$ru</td>\n";
          echo "   </tr>\n";
          ++$yCnt;
       }
    }
    if ($yCnt == 0) {
       echo "   <tr>\n";
       echo "    <td class=\"normal\" colspan=\"3\"><br>we currently have no record of winners/runners-up for the $years season<br><br></td>\n";
       echo "   </tr>\n";
    }
    echo "  </td><tr></table>\n";
 }
 echo "  </td></tr></table>\n";
 include ('pagefooter.php');
?>
