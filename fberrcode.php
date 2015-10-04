<?php
 $pageTitle='Contact form error: Verification Code';
 include ('pageheader.php');
?>
 <script type="text/javascript">
 alert ("\n*** Your message has NOT been sent ***\n\nSorry, but VERIFICATION CODE entered does not match the code required. On return to the Contact Us page, click on 'generate verification new code' and enter the new code.")
 window.setTimeout("history.go(-1)", 10) 
 </script>
<?php
 include ('pagefooter.php');
?>
