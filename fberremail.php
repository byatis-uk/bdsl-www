<?php
 $pageTitle='Contact form error: Email address';
 include ('pageheader.php');
?>
 <script type="text/javascript">
 alert ("\n*** Your message has NOT been sent ***\n\nSorry, but your email address appears to be invalid.\n\nEven if you do not want to enter a real email address, it must still be in the format of name@domain.com.")
 window.setTimeout("history.go(-1)", 10) 
 </script>
<?php
 include ('pagefooter.php');
?>
