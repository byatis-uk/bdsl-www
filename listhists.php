<?php
 echo " <select class=\"normal\" onchange=\"location = this.options[this.selectedIndex].value;\">\n";
 echo "  <option selected>Select a season...\n";
 $thisYr=date("Y");
 $thisMth=date("n");
 $subtract = 1;
 if ($thisMth > 8) {
    // new season
	$subtract=0;
 }
  for ($i = ($thisYr - $subtract); $i >= 1957; $i--) {
    $season=$i . '-' . ($i+1);
    echo "  <option class=\"normal\" value=\"archive.php?award=&season=$season\">$season\n";
 }
 echo " </select>\n";
 ?>
 
