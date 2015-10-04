<?php
 $pageTitle='Email error: Security code';
 include ('pageheader.php');
?>
<table class="noborder" width="50%">
 <tr><td class="hdr" nowrap><b>Error: your email has not been sent</b></td></tr>
 <tr><td class="normalerror" nowrap><b><br>Security code entered does not match the code required<br><br></b></td></tr>
 <tr><td class="normalcenter">The security code must be entered as a deterrent to spammers. Please note that the security code changes each time the feedback form is accessed - if you are unable to read the security code provided then <U>generate security new code</U> on the feedback page<br><br></td></tr>
 <tr><td class="normalcenter"><A HREF="javascript:history.go(-1)"><img src="/resource/back.gif" border=0 alt="go back to email page"> back</a><br></td></tr>
 <tr><td class="titlecenter">Security settings in some browsers mean that the email form may not work for you</td></tr>
</table>
<?php include ('pagefooter.php');?>
