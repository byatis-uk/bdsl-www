<?php
 $name = $_GET["name"];
 $msg = $_GET["msg"];
 $bdslname = $_COOKIE['bdslname'];
 $bdslemail = $_COOKIE['bdslemail'];
 $bdslteam = $_COOKIE['bdslteam'];
 $bdsloff = $_COOKIE['bdsloff'];
 $bdslcookie = $_COOKIE['bdslcookie'];
 if ($bdslteam == ''){
   $bdslteam='not applicable';
 }
 $checkS = '';
 $check1 = '';
 $check4 = '';
 if ($name == 'GillyStook') {$checkS = 'checked'; $toEmail = 'Gilly Stook';}
 elseif ($name == 'PeteStump') {$check1 = 'checked'; $toEmail = 'Pete Stump';}
 elseif ($name == 'SteveTilley') {$check4 = 'checked'; $toEmail = 'Steve Tilley';}
 elseif ($bdsloff == 'GillyStook') {$checkS = 'checked'; $toEmail = 'Gilly Stook';}
 elseif ($bdsloff == 'PeteStump') {$check1 = 'checked'; $toEmail = 'Pete Stump';}
 elseif ($bdsloff == 'SteveTilley') {$check4 = 'checked'; $toEmail = 'Steve Tilley';}
 else {$check1 = 'checked'; $toEmail = 'Pete Stump';}
 $pageTitle='Contact Us';
 include ('pageheader.php');
 include('mailcode-includes/config.inc.php');
 $userip = $_SERVER['REMOTE_ADDR'];
?>
<script language="javascript" type="text/javascript" src="js/fbcontact.js"></script>
<h3>Contact Us</h3><br>

<form enctype="multipart/form-data" action="mailcode-includes/mailer.php" method="post" onsubmit="return validate_form(this)" onreset="return clear_form(<?php echo "'$toEmail'"; ?>)">
 
 <table class="noborder" width="95%">
  
  <tr>
   <td class="titlecenter" colspan="3">Please use this form to contact the league on any matters but please leave a valid email address if you wish to get a reply.</td>
  </tr>
  <tr>
   <td class="titlecenter" colspan="3">Team captains may also use this form to advise results secretaries of player registrations, rearranged fixtures and to send in scans of score sheets.</td>
  </tr>
  <tr>
   <td class="normal"><b>Send message to:</b><br>
      <h3><span id="addressee"><br><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$toEmail"; ?></span></h3>
   </td>
   <td class="normal" colspan="2"><br>
  <?php
   echo "     <input onclick=\"changeRadioButton(this.form)\" name=\"sendto\" type=\"radio\" value=\"Gilly Stook\" $checkS>&nbsp;<b>Gilly Stook</b>&nbsp;&nbsp;(League Secretary / Ladies Singles / Open Pairs)<br>\n";
   echo "     <input onclick=\"changeRadioButton(this.form)\" name=\"sendto\" type=\"radio\" value=\"Pete Stump\" $check1>&nbsp;<b>Pete Stump</b> (Secretary Divisions 1, 2, 3 / Website)<br>\n";
   echo "     <input onclick=\"changeRadioButton(this.form)\" name=\"sendto\" type=\"radio\" value=\"Steve Tilley\" $check4>&nbsp;<b>Steve Tilley</b> (Secretary Divisions 4, 5, 6)\n";
   echo "     <input type=\"hidden\" name=\"address\" value=\"$userip\">\n";
   echo "     <br><br>\n";
   echo "    </td>\n";
   echo "   </tr>\n";
   echo "   <tr>\n";
   echo "   <td colspan=\"3\"><hr></td>\n";
   echo "   </tr>\n"; 
	
   echo "  <tr>\n";
   echo "   <td class=\"normal\" id=\"name\"><b>Your name:</b></td>\n";   
   echo "   <td class=\"normal\" colspan=\"2\"><input class=\"normal\" type=\"text\" name=\"name\" size=\"40\" value=\"$bdslname\"></td>\n";
   echo "  </tr>\n";	
  
   echo "  <tr>\n";
   echo "   <td class=\"normal\" id=\"email\" nowrap><b>Your email address:</b></td>\n";
   echo "   <td class=\"normal\" colspan=\"2\"><input class=\"normal\" type=\"text\" name=\"email\" size=\"40\" value=\"$bdslemail\"></td>";
   echo "  </tr>\n";		
 
   echo "  <tr>\n";
   echo "   <td class=\"normal\"><b>Your team:</b></td>\n";
   echo "   <td class=\"normal\" colspan=\"2\">\n";	 
   echo "    <select class=\"normal\" name=\"team\">\n";
   echo "     <option class=\"normal\" selected value=\"$bdslteam\">$bdslteam\n";
   $teamCsv='csv/listteam.csv';
   $fd = fopen ("$teamCsv", "r");
   // initialize a loop to go through each line of the file
   while (!feof ($fd)) {
   // declare an array to hold all of the contents of each row, indexed
      $buffer = fgetcsv($fd, 1024);
      // the 5 represents the number of columns in the text file
      for ($i = 0; $i < 5; ++$i){
         if ($i == 0 and $buffer[$i] == $teamA and $buffer[$i] != ''){
            echo "     <option class=\"normal\" value=\"$buffer[$i]\">$buffer[$i]\n";
         }
         elseif ($i == 0 and $buffer[$i] != $teamA and $buffer[$i] != '') {
            echo "     <option class=\"normal\" value=\"$buffer[$i]\">$buffer[$i]\n";
         }
      }
   }
   fclose ($fd);
   echo "    </select></td></tr>\n";
  ?>
  
  <tr>
   <td class="normal" id="message" nowrap><b>Your message:</b></td>
   <td class="normal" colspan="2"><textarea class="normal" name="message" rows="12" cols="80"><?php echo "$msg"; ?></textarea></td>
  </tr>
   
   <!-- Begin Attachments: do not delete this section, enable/disable attachments in script config -->
   <?php if ($attachments == 1) { ?>
    <tr>
	 <td colspan="3" class="normal"><hr>
      <b>Attach file <i>optional</i></b> (e.g. scan of your score sheet - <font color="red">max size <? echo $max_file_size / 1000000; ?> MB</font>):
	 </td>
	</tr>
    <tr>
	 <td class="normal">&nbsp;</td><td class="normal" colspan="2"><input class="normal" type="file" name="attachment" size="60">
      <input type="hidden" name="MAX_FILE_SIZE" value="<? echo $max_file_size; ?>">
	 </td>
	</tr>
    <tr>
	 <td colspan="3"><hr></td>
	</tr>
   <?php } ?>
   <!-- End Attachments -->
   
   <tr>
    <td class="normalvc" id="code" nowrap><b>Enter verification code:</b></td>
	<td class="normalvc">
     <input class="normal" id="security_code" name="security_code" type="text" size="12">
	</td>
    <td class="normalvc">
	 <img src="mailcode-includes/txt2png.php?" name="img" id="img" alt="Verification Code" title="Verification Code">
     <!-- a href="" onclick="newcode(); return false;"> [generate new code]</a-->
     <button onclick="newcode(); return false;">generate new code</button>
    </td>
   </tr>
 
   <tr>
    <td class="normal" colspan="3"><hr>
	 <?php
	  if ($bdslcookie == ''){
         echo "Save your name / email / team in a cookie? &nbsp;<input type=\"checkbox\" name=\"cookiecb\" value=\"true\">";
	  }
	  else {
         echo "Save your name / email / team in a cookie? &nbsp;<input type=\"checkbox\" name=\"cookiecb\" value=\"true\" checked>";
	  }
	 ?>
    </td>
   </tr>
  
   <tr>
    <td class="titlecenter" colspan="3">
    <?php     
	 echo "     <input id=\"btnsend\" type=\"submit\" name=\"submit\" value=\" Send to $toEmail \">\n";
     ?>
     <input type="reset" value=" Clear ">
	</td>
   </tr>
 
  <tr>
   <td class="titlecenter" colspan="3">
    Please note that we will only use your email address to contact you on matters relating to the League.
    <?php
     echo "<br>Your IP address ($userip) will be sent with your message.\n";
    ?>
    <br>If this contact form does not work for you, then please use regular email:<ul><li><a href="mailto:&#x67;&#x69;&#000108;&#108;&#121;&#00064;&#x73;&#116;&#000111;&#000111;&#x6b;&#00046;&#99;&#000111;&#x2e;&#x75;&#000107;?subject=BDSL Contact Form" title="mail to Gilly Stook">Gilly Stook</a>&nbsp;</li><li><a href="mailto:&#112;&#101;&#116;&#101;&#46;&#115;&#116;&#117;&#109;&#112;&#64;&#98;&#101;&#114;&#107;&#101;&#108;&#101;&#121;&#100;&#115;&#108;&#46;&#111;&#114;&#103;&#46;&#117;&#107;?subject=BDSL Contact Form" title="mail to Pete Stump">Pete Stump</a></li><li><a href="mailto:&#98;&#101;&#114;&#107;&#101;&#108;&#101;&#121;&#52;&#53;&#54;&#64;&#119;&#104;&#105;&#116;&#101;&#45;&#104;&#111;&#117;&#115;&#101;&#45;&#102;&#97;&#114;&#109;&#46;&#100;&#101;&#109;&#111;&#110;&#46;&#99;&#111;&#46;&#117;&#107;?subject=BDSL Divisions 4 5 6" title="mail to Steve Tilley">Steve Tilley</a></li></ul>
   </td>
  </tr>
 
 </table>
</form>
<?php include ('pagefooter.php');?>