<?php
$recipient = $_GET["to"];
$attach = $_GET["att"];
$cookie = $_GET["ck"];
$pageTitle='Contact form: Your message has been sent';
include ('pageheader.php');
if ($recipient == 'pete.stump@berkeleydsl.org.uk') { $recipient = 'Pete Stump';}
if ($recipient == 'gilly@stook.co.uk') { $recipient = 'Gilly Stook';}
if ($recipient == 'berkeley456@white-house-farm.demon.co.uk') { $recipient = 'Steve Tilley';}

$msg = '\nThank You.\n\nYour message to ' . $recipient . ' has been sent';

if ($attach == ""){
  $msg .= '.\n\nNo file was attached.';
}
else {
   $msg .= ' with your file [' . $attach . '] attached.';
}
if ($cookie == 'true') {
   $msg .= '\n\n\nYou chose to save details in a cookie. This will store\n- the recipient (officer)\n- your name\n- your email address\n- your team\n- your cookie preference\nin a cookie within your browser for up to 90 days.\nThis cookie (if present) will be used to populate fields on the \"Contact Us\" page on your next visit - unticking the checkbox on a future visit will remove the cookie.';
}
$line1 = '<script type="text/javascript">';
$line2 = 'alert ("' . $msg . '\n\n")';  
$line3 = 'window.setTimeout("history.go(-2)", 10)';
$line4 = '</script>';
echo $line1 . "\n";
echo $line2 . "\n";
echo $line3 . "\n";
echo $line4 . "\n";
include ('pagefooter.php');
?>
