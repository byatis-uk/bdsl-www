<?php
 $pageTitle='Email error: Your Email address';
 include ('pageheader.php');
?>
 <script type="text/javascript">
 alert ("\nYour email has NOT been sent\n\nYour email address must match the email address entered on your team registration form or must match an email address registered with the webmaster")
 window.setTimeout("history.go(-1)", 10)
 </script>
<?php
 include ('pagefooter.php');
?>
