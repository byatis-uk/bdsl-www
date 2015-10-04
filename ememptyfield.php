<?php
 $pageTitle='Email error: Empty fields';
 include ('pageheader.php');
?>
<table class="noborder" width="50%">
 <tr><td class="hdr" nowrap><b>Error: your email has not been sent</b></td></tr>
 <tr><td class="normalerror" nowrap><b><br>Not all fields were completed<br><br></b></td></tr>
 <tr><td class="normalcenter">All fields on the email form need to be completed<br><br></td></tr>
 <tr><td class="normalcenter"><a href="javascript:history.go(-1)"><img src="/resource/back.gif" border="0" alt="go back to email page"> back</a><br></td></tr>
 <tr><td class="titlecenter">Security settings in some browsers mean that the email form may not work for you</td></tr>
</table>
<?php include ('pagefooter.php');?>
