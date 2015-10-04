<?php
 $pageTitle='Contact form error: File size';
 include ('pageheader.php');
?>
 <script type="text/javascript">
 alert ("\n*** Your message has NOT been sent ***\n\nSorry, but the attached file is too large - it needs to be less than 1 MB in size.")
 window.setTimeout("history.go(-1)", 10)
 </script>
<?php include ('pagefooter.php');?>
