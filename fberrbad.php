<?php
 $pageTitle='Contact form error: File type';
 include ('pageheader.php');
?>
 <script type="text/javascript">
 alert ("\n*** Your message has NOT been sent ***\n\nSorry, but the attached file type is not accepted by the server.")
 window.setTimeout("history.go(-1)", 10) 
 </script>
<?php include ('pagefooter.php');?>
