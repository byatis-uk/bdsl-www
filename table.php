<?php
 $div = $_GET["div"];
 $search = $_GET["search"];
 $pageTitle='Division '.$div.' Table';
 include ('pageheader.php');
 $divDesc ='Division '.$div;
 if ($div == 'P') { $divDesc ='Premier Division'; }
 echo "<h3>$divDesc</h3><br>\n";
 echo "<table align=\"center\" width=\"100%\">\n";
 echo " <tr>\n";
 echo "  <td align=\"center\" valign=\"top\" width=\"30%\">\n";
 echo "   <table class=\"border\">\n";
 $tdStyleHdr =   "class=\"hdrsmall\"";
 $tdStyleTitle = "class=\"title\"";
 $tdStyleNormal =  "class=\"normal\"";
 $tdStyleText =  "class=\"normal\"";
 $tdStyleTextE =  "class=\"normalcenter\"";
 $tdStyleNum =   "class=\"normalcenter\"";
 $tdStyleFtr =   "class=\"titleright\"";
 $csvFile = 'csv-tables/table'.$div.'.csv';
 $fCnt=0;
 $fd = fopen ("$csvFile", "r");
 while (!feof ($fd)) {
   $buffer = fgetcsv($fd, 4096);
   for ($i = 0; $i < 8; ++$i){
      if ($i == 0){
         $fld0 = $buffer[$i];
      }
      if ($i == 1){
         $fld1 = $buffer[$i];
      }
      if ($i == 2){
         $fld2 = $buffer[$i];
      }
      if ($i == 3){
         $fld3 = $buffer[$i];
      }
      if ($i == 4){
         $fld4 = $buffer[$i];
      }
      if ($i == 5){
         $fld5 = $buffer[$i];
      }
      if ($i == 6){
         $fld6 = $buffer[$i];
      }
      if ($i == 7){
         $fld7 = $buffer[$i];
      }
 }
 echo "    <tr>\n";
 ++$fCnt;
 if ($fCnt == 1){
    echo "     <td nowrap $tdStyleHdr colspan=\"9\">Table</td>\n";
 }
 elseif ($fCnt == 2){
    echo "     <td nowrap $tdStyleTextE colspan=\"9\">$fld0</td>\n";
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
    echo "     <td nowrap $tdStyleTitle>$fld7</td>\n";
 }
 elseif ($fld0 != '') {
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
    $fld0Abbrev = preg_replace("/[^a-zA-Z0-9]/", "", $fld0);
    $fldTeam = "<a href=\"team.php?div=$div&team=$fld0Abbrev\" title=\"&raquo; open $fld0 fixtures and details page\">$fld0</a>";
    list($part1, $part2) = split(' ', $fld0);
    if ($part1 == '***'){
       $fldTeam = "$fld0";
    }
	  $fld0=str_replace('\'','',$fld0);
    echo "     <td nowrap $tdStyleFtr>$posCnt</td>\n";
    echo "     <td nowrap $tdStyleText>$fldTeam</td>\n";
    echo "     <td nowrap $tdStyleNum><a href=\"table.php?div=$div&search=$fld0\" title=\"&raquo; highlight results for $fld0\">$fld1</a></td>\n";
    echo "     <td nowrap $tdStyleNum>$fld2</td>\n";
    echo "     <td nowrap $tdStyleNum>$fld3</td>\n";
    echo "     <td nowrap $tdStyleNum>$fld4</td>\n";
    echo "     <td nowrap $tdStyleNum>$fld5</td>\n";
    echo "     <td nowrap $tdStyleNum>$fld6</td>\n";
    echo "     <td nowrap $tdStyleText>";
    if ( strlen($fld7) < 12 ) { $form = $fld7; }
    else { $form = substr($fld7,-12,12); }
    $formlen = strlen($form);
    $formout = '';
    for ($s = 0; $s < $formlen; $s=$s+2){
       $worl=substr($form,$s,1);
       $hora=substr($form,$s+1,1);
       if ($worl == "W") { $formout .= "<span style=\"color:green\">$worl</span><sup>$hora</sup>";}
       if ($worl == "L") { $formout .= "<span style=\"color:red\">$worl</span><sup>$hora</sup>";}
       if ($worl == "D") { $formout .= "<span style=\"color:orange\">$worl</span><sup>$hora</sup>";}
    }
    echo "$formout</td>\n";
 }
 echo "    </tr>\n";
 }
 fclose ($fd);
 $tdStyleText =  "class=\"normal\"";
 $tdStyleNum =   "class=\"normalcenter\"";
 echo "    <tr>\n";
 echo "     <td nowrap $tdStyleFtr colspan=\"8\"><sup>* denotes point deducted</sup></td>\n";
 echo "     <td nowrap $tdStyleFtr><sup>most recent &raquo;</sup></td>\n";
 echo "    </tr>\n";
 echo "   </table>\n";
 echo "  </td>\n";
 echo "  <td align=\"center\" valign=\"top\" width=\"70%\">\n";
 echo "   <table class=\"border\">\n";
 $csvFile = 'csv/reports'.$div.'.csv';
 $fCnt=0;
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 4096);
	  // the 2 represents the number of columns in the text file
	  for ($i = 0; $i < 2; ++$i){
	     if ($i == 0){
	        $fld0 = $buffer[$i];
	     }
	     if ($i == 1){
	        $fld1 = $buffer[$i];
	        $fld1=str_replace('Windbound Ex ','Windbound Exiles ',$fld1);
	        $fld1=str_replace(' Of ',' of ',$fld1);
	        $fld1=str_replace('S.W.A ','SWA ',$fld1);
	        $fld1=str_replace('XR','X-R',$fld1);
	        $fld1=str_replace('Deecees','DeeCees',$fld1);
	        $fld1=str_replace('Not Double D\'s','Not Double Ds',$fld1);
	        $fld1=str_replace('Not the Double D\'s','Not Double Ds',$fld1);
	        $fld1=str_replace('Bus is \'Ere','Bus is Ere',$fld1);
	        $fld1=str_replace('The ','',$fld1);
	        $search=str_replace('The ','',$search);
	        $search=str_replace(' (WITHDRAWN)','',$search);
	        if ($search == 'Playmates'){
	           $fld1=str_replace('Sharpness Playmates','Sharpness playmates',$fld1);
	        }
	        if ($search == 'Rangers'){
	           $fld1=str_replace('BA Rangers','BA rangers',$fld1);
	        }
	        $fld1=str_replace($search,'<span class="highlight">'.$search.'</span>',$fld1);
	     }
	  }
	  ++$fCnt;
    if ($fCnt == 1){
	     $divDesc = 'Division '.$div;
       if ($div == 'P'){
	        $divDesc = 'Premier Division';
	     }
	     echo "    <tr><td nowrap $tdStyleHdr>Results<sup>&dagger;</sub></td></tr>\n";
	  }
    if ($fld0 != '') {
	     echo "    <tr><td $tdStyleText><i>$fld0</i><br>$fld1</td></tr>\n";
    }
 }
 fclose ($fd);
 echo "    <tr><td nowrap $tdStyleTitle><sup>&dagger;</sup><i>NB not all results are necessarily published here</td></tr>\n";
 echo "   </table>\n";
 echo "  </td></tr></table>\n";
 echo " </tr>\n";
 echo "</table>\n";
 include ('pagefooter.php');
?>
