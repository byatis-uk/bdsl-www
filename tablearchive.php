<?php
 $season = $_GET["season"];
 if ($season != ''){
    $seasonText = 'Season 20'.substr($season,0,2).'/'.substr($season,2,2);
    $uScr = '_';
 }
 else {
    $seasonText = 'Current Season';
    $uScr = '';
 }
 $pageTitle = 'Tables - '.$seasonText;
 include ('pageheader.php');
 echo "<h3>$seasonText</h3><br>\n";
 echo "<table>\n";
 echo " <tr>\n";
 echo "  <td align=\"center\" valign=\"top\">\n";
 $tdStyleHdr =   "class=\"hdr\"";
 $tdStyleTitle = "class=\"title\"";
 $tdStyleNormal =  "class=\"normal\"";
 $tdStyleCenter =  "class=\"normalcenter\"";
 $tdStyleFtr =   "class=\"titleright\"";
 for ($d = 0; $d < 7; ++$d){
    $div = $d;
    if ($d == 0){
       $div='P';
    }
    $csvFile = 'csv-tables/table'.$div.$uScr.$season.'.csv';
    $fCnt=0;
    $fd = fopen ("$csvFile", "r");
    while (!feof ($fd)) {
	     $buffer = fgetcsv($fd, 4096);
	     for ($i = 0; $i < 7; ++$i){
	        if ($i == 0){ $fld0 = $buffer[$i]; }
	        if ($i == 1){ $fld1 = $buffer[$i]; }
	        if ($i == 2){ $fld2 = $buffer[$i]; }
	        if ($i == 3){ $fld3 = $buffer[$i]; }
	        if ($i == 4){ $fld4 = $buffer[$i]; }
	        if ($i == 5){ $fld5 = $buffer[$i]; }
	        if ($i == 6){ $fld6 = $buffer[$i]; }
       }
	     ++$fCnt;
       if ($fCnt == 1){
          echo "   <table class=\"border\" align=\"center\" width=\"100%\">\n";
          echo "    <tr>\n";
   	     echo "     <td nowrap class=\"hdrsmall\" colspan=\"8\">$fld0</td>\n";
          echo "    </tr>\n";
	     }
       elseif ($fCnt == 2){
	        echo "";
	     }
	     elseif ($fCnt == 3) {
          echo "    <tr>\n";
	        echo "     <td nowrap $tdStyleTitle>&nbsp;</td>\n";
	        echo "     <td nowrap $tdStyleTitle>&nbsp;</td>\n";
	        echo "     <td nowrap $tdStyleTitle>$fld1</td>\n";
	        echo "     <td nowrap $tdStyleTitle>$fld2</td>\n";
	        echo "     <td nowrap $tdStyleTitle>$fld3</td>\n";
	        echo "     <td nowrap $tdStyleTitle>$fld4</td>\n";
	        echo "     <td nowrap $tdStyleTitle>$fld5</td>\n";
	        echo "     <td nowrap $tdStyleTitle>$fld6</td>\n";
          echo "    </tr>\n";
	     }
       elseif ($fld0 != '') {
          $posCnt = $fCnt-3;
          echo "    <tr>\n";
	        echo "     <td nowrap $tdStyleTitle>$posCnt</td>\n";
	        echo "     <td nowrap $tdStyleNormal>$fld0</td>\n";
	        echo "     <td nowrap $tdStyleCenter>$fld1</td>\n";
	        echo "     <td nowrap $tdStyleCenter>$fld2</td>\n";
	        echo "     <td nowrap $tdStyleCenter>$fld3</td>\n";
	        echo "     <td nowrap $tdStyleCenter>$fld4</td>\n";
	        echo "     <td nowrap $tdStyleCenter>$fld5</td>\n";
	        echo "     <td nowrap $tdStyleNormal>$fld6</td>\n";
          echo "    </tr>\n";
	     }
    }
    echo "    <tr><td nowrap class=\"titleright\" colspan=\"8\">* denotes point deducted</td></tr>\n";
    echo "   </table>\n";
    echo "  </td>\n";
    switch ($d) {
       case 0:
       echo "  <td class=\"normal\">&nbsp;</td>\n";
       echo "  <td align=\"left\" valign=\"top\">\n";
       break;
    case 1:
       echo " </tr>\n";
       echo " <tr><td colspan=\"3\" class=\"normal\">&nbsp;</td></tr>\n";
       echo " <tr>\n";
       echo "  <td align=\"left\" valign=\"top\">\n";
       break;
    case 2:
       echo "  <td class=\"normal\">&nbsp;</td>\n";
       echo "  <td align=\"left\" valign=\"top\">\n";
       break;
    case 3:
       echo " </tr>\n";
       echo " <tr><td colspan=\"3\" class=\"normal\">&nbsp;</td></tr>";
       echo " <tr>\n";
       echo "  <td align=\"left\" valign=\"top\">\n";
       break;
    case 4:
       echo "  <td class=\"normal\">&nbsp;</td>\n";
       echo "  <td align=\"left\" valign=\"top\">\n";
       break;
    case 5:
       echo " </tr>\n";
       echo " <tr><td colspan=\"3\" class=\"normal\">&nbsp;</td></tr>";
       echo " <tr>\n";
       echo "  <td align=\"left\" valign=\"top\">\n";
       break;
    case 6:
       echo "  <td class=\"normal\">&nbsp;</td>\n";
       echo " </tr>\n";
       break;
    }
    fclose ($fd);
 }
 echo "</table>\n";
 include ('pagefooter.php');
?>
