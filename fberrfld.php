<?php
 $pageTitle='Contact form error: Empty fields';
 include ('pageheader.php');
?>
 <script type="text/javascript">
  alert ("\n*** Your message has NOT been sent ***\n\nSorry, but you have not completed all the required fields.")
  window.setTimeout("history.go(-1)", 10)
 </script>
<?php
 include ('pagefooter.php');
?>
