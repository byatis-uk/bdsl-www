<?php
 $gID = $_GET["name"];
 $csvFile = 'csv/email1957.csv';
 $fCnt=0;
 $gName='';
 $gAddr='';
 // process csv file
 $fd = fopen ("$csvFile", "r");
 // initialize a loop to go through each line of the file
 while (!feof ($fd)) {
    // declare an array to hold all of the contents of each row, indexed
    $buffer = fgetcsv($fd, 1024);
    // the 3 represents the number of columns in the text file
    for ($i = 0; $i < 4; ++$i){
          if ($i == 0){ $eID = $buffer[$i]; }
          if ($i == 1){ $eName = $buffer[$i]; }
          if ($i == 2){ $eAddr = $buffer[$i]; }
          if ($i == 3){ $eMemo = $buffer[$i]; }
    }
    ++$fCnt;
    if ($gID == $eID){
       $gName = $eName;
       $gAddr = $eAddr;
    }
 }
 fclose ($fd);
 $newAddr = '';
 for ($c = 0; $c < strlen($gAddr); ++$c){
    $newAddr .= '&#' . ord(substr($gAddr,$c,1)) . ';' ;
 }
 $gAddr = $newAddr;
 $pageTitle="Send Email to $gName";
 include ('pageheader.php');
 include('email-includes/config.inc.php');
 $userip = $_SERVER['REMOTE_ADDR'];
 $bdslemail = $_COOKIE['bdslemail'];
?>
 <script type="text/javascript" src="js/emcontact.js"></script>
 <h3>Send Email</h3><br>
 <table class="noborder" width="50%">
<?php
 echo " <tr><td class=\"title\"><font color=red>* In order to send an email directly to $gName, your email address must match the email address entered on your team registration form OR must have been registered with the <a href=\"fbcontact.php\" title=\"contact the webmaster\">webmaster</a>.</td></tr>\n";
 echo " <tr><td class=\"normal\"><br></td></tr>\n";
 echo " <tr><td class=\"hdr\">To: <b>$gName</b></td></tr>\n";
?>
  <tr>
   <td class="normal">
    <form enctype="multipart/form-data" action="email-includes/mailer.php" method="post" onsubmit="return validate_form(this)" onreset="return clear_form()">
<?php
 echo "   <input type=\"hidden\" name=\"address\" value=\"$userip\">\n";
 echo "   <input type=\"hidden\" name=\"to\" value=\"$gAddr\">\n";
 echo "   <input type=\"hidden\" name=\"toname\" value=\"$gName\">\n";
?>
 <br><p id="email"><font color=red>*</font> <b>Your email address:</b></p>
<?php
 echo "   <input type=\"text\" class=\"normal\" name=\"email\" size=\"70\" value=\"$bdslemail\"><br>\n";
?>
   </td>
  </tr>
  <tr>
   <td class="normal">
<?php
  if ($attachments == 1) {
  echo "    Attachment:<br>\n";
  echo "    <input type=\"file\" name=\"attachment\" size=\"28\"><br>\n";
  echo "    <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"<? echo $max_file_size; ?>\">\n";
  }
?>
     <p id="subject"><b>Subject:</b></p>
     <input class="normal" type="text" name="subject" size="70"><br>
     <p id="message"><b>Message:</b></p>
     <textarea  class="normal" name="message" rows="12" cols="70"></textarea><br>
    </td>
   </tr>
   <tr>
    <td class="normal">
     <input type="radio" name="copygroup" value="cc">CC: to self<br>
     <input type="radio" name="copygroup" value="nocopy" checked>Do not CC: to self<br>
    </td>
   </tr>
   <tr>
   <td class="titlecenter">
    <input type="submit" name="submit" value="Send">
    <input type="reset" value="Clear">
   </form>
   </td>
  </tr>
 </table>
<?php
 include ('pagefooter.php');
?>
