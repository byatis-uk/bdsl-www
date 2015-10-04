<?php
 $pageTitle='News and Notices';
 include ('pageheader.php');
?>
<h3>News and Notices</h3><br>
<table class="noborder" width="70%">
<?php
$localTime=time();
$localTime=$localTime - (60 * 60 * 1);
$today = date("z",$localTime);
$dataOut='';
$fCnt=0;
$tkrCsv ='csv/notices.csv';
// process csv file
$fd = fopen ("$tkrCsv", "r");
// initialize a loop to go through each line of the file
while (!feof ($fd)) {
// declare an array to hold all of the contents of each row, indexed
$buffer = fgetcsv($fd, 4096);
	   // the 2 represents the number of columns in the text file
	   for ($i = 0; $i < 2; ++$i){
	      if ($i == 0){
	         $csvDate = $buffer[$i];
	         if ($csvDate != 'pinned'){
   	        $tkrDate = strtotime($csvDate);
	            $postDate = date("z",$tkrDate);
	            $dateDiff = $today - $postDate;
              if ($dateDiff < 0){ $dateDiff += 365;}
	            if ($dateDiff == 0){ $msg='<img src="resource/pin_today.gif" alt="today"> today'; }
	            if ($dateDiff == 1){ $msg='<img src="resource/pin_yesterday.gif" alt="yesterday"> yesterday'; }
	            if ($dateDiff > 1 & $dateDiff <= 6){ $msg=$dateDiff.' days ago'; }
              if ($dateDiff > 6 & $dateDiff <= 14){$msg='1 week ago'; }
	            if ($dateDiff > 14 & $dateDiff <= 21){$msg='2 weeks ago'; }
	            if ($dateDiff > 21 & $dateDiff <= 28){$msg='3 weeks ago'; }
	            if ($dateDiff > 28 & $dateDiff <= 31){$msg='4 weeks ago'; }
              if ($dateDiff > 31 & $dateDiff <= 60){$msg='1 month ago'; }
	            if ($dateDiff > 61){ $msg=date("F Y",$tkrDate); }
	         }
	         else {
	            $msg='<img src="resource/pinned.gif" alt="Pinned"> pinned';
	         }
	      }
	   }
	   if ($buffer[1] > ""){
	      $dataOut[$fCnt]='<tr><td class="normalgrayright" nowrap>'.$msg.'</td><td class="normal">&nbsp;</td><td class="normal">'.$buffer[1].'</td></tr>';
	      ++$fCnt;
	   }
	}
	fclose ($fd);
// build output 
for ($lCnt = 0; $lCnt <= $fCnt; ++$lCnt){
    if ($lCnt == 5){
       echo "        <tr><td class=\"normal\" colspan=\"3\"><hr></td></tr>\n" ;
       echo "        <tr><td class=\"normal\" colspan=\"2\"></td><td class=\"normalgray\"><b>older...</b>\n" ;
    }
	  echo "       $dataOut[$lCnt]\n";
	}
?>
</table>
<?php include ('pagefooter.php');?>
