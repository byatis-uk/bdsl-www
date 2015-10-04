<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
 $referrer = @$_SERVER["HTTP_REFERER"];
 if ( empty( $referrer ) && !empty( $HTTP_REFERER ) )
 {
	$referrer = $HTTP_REFERER;
 }
?>
 <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
 <meta name="google-site-verification" content="vyILdIC3qTby_hwwrhHKbXVPq9mS3EKEdVhQBx-Yydg">
 <meta name="keywords" content="skittles, berkeley, gloucestershire, district, league, sharpness, cam, dursley, slimbridge, frocester, wotton-under-edge, pub, club">
 <meta name="description" content="Berkeley and District Skittles League, playing skittles in south Gloucestershire, England">
 <meta name="author" content="Pete Stump">
 <?php
  $thisYr=date("y");
  echo "<meta name=\"copyright\" content=\"Berkeley and District Skittles League 20$thisYr\">\n";
 ?>
 <meta http-equiv="Pragma" content="no-cache">
 <?php
 $breadTitle = '';
 if ($pageTitle != ''){
    $breadTitle = $pageTitle;
    $pageTitle = ' - '.$pageTitle;
 }
 echo "<title>Berkeley and District Skittles League$pageTitle</title>\n";
 ?>
 <link rel="shortcut icon" type="image/ico" href="http://www.berkeleydsl.org.uk/favicon.ico">
 <link rel="stylesheet" type="text/css" href="css/bdsl.css">
 <script type="text/javascript" src="js/stm31.js"></script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
 <script type="text/javascript" src="js/scrolltopcontrol.js">
  /***********************************************
  * Scroll To Top Control script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
  ***********************************************/
 </script>
 <script type="text/javascript" src="js/prototype.js"></script>
 <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
 <script type="text/javascript" src="js/lightbox.js"></script>
 <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen">
</head>
<body><a name="top"></a>
 <div id="container">
  <table border="0" cellspacing="0" cellpadding="0" width="100%">
   <tr>
    <td colspan="2" width="100%"  bgcolor="#FFFFFF">
     <table width="100%" cellspacing="0" cellpadding="2" bgcolor="#336699">
      <tr>
       <td width="10%" bgcolor="#FFFFFF">
<?php
 $logoGif="bdslhdr.gif";
 $chkDate=date("d");
 $chkMonth=date("m");
 if ($chkMonth == '12'){
    $logoGif="bdslxmas2.gif";
 }
 if ($chkMonth == '04' & $chkDate == '23'){
    $logoGif="bdslstgeorge.gif";
 }
 echo "        <a href=\"/index.php\" title=\"Home\"><img src=\"/resource/$logoGif\" alt=\"Home\" border=\"5\" style=\"border-color: #FFFFFF\" align=\"left\" height=\"80\" width=\"80\"></a>\n";
?>
       </td>
        <td width="3%" class="normalvc">
        <a href="http://m.berkeleydsl.org.uk" title="Mobile version" target="_blank"><img src="/resource/bdslmobi.gif" alt="Mobile version of this website" border="0" height="28" width="16"></a>
       </td>
       <td width="67%" bgcolor="#FFFFFF">
        <div align="left" style="font-family: Verdana; font-size: 22px; color: #336699; background-color: #FFFFFF"><b>Berkeley and District Skittles League</b><a href="http://www.teaching2fish.co.uk" title="teaching2fish human resources consultancy" target="_blank"><img src="blank.gif" border="0" alt="teaching2fish"></a><a href="http://www.maria-rtb.co.uk" title="round the bend driving lessons" target="_blank"><img src="blank.gif" border="0" alt="round the bend"></a><a href="http://www.lilyandvioletvintage.co.uk/" title="lily and violet vintage clothing" target="_blank"><img src="blank.gif" border="0" alt="lily and violet vintage"></a></div>
        <div align="left" style="font-family: Verdana; font-size: 10px; color: #000000; background-color: #FFFFFF">Headquarters: <b>Sharpness Dockers Sports &amp; Welfare Association, The Docks, Sharpness, Gloucestershire, GL13 9UN</b></div>
       </td>
       <td width="10%" valign="middle" bgcolor="#FFFFFF">
        <div align="center" style="font-family: Verdana; font-size: 11px; color: #336699; background-color: #FFFFFF"><b>Founded<br>1957</b></div>
       </td>
       <td width="10%" bgcolor="#FFFFFF">
<?php
 $logoGif="location.gif";
 echo "        <a href=\"/about.php\" title=\"The League covers an area in south Gloucestershire midway between Bristol and Gloucester\"><img src=\"/resource/$logoGif\" alt=\"The League covers an area in south Gloucestershire midway between Bristol and Gloucester\" border=\"5\" style=\"border-color: #FFFFFF\" align=\"right\" height=\"75\" width=\"75\"></a>\n";
?>
       </td>
      </tr>
      <tr>
       <td class="normalgray" colspan="3">
        <?php include('breadcrumb.php');?>
       </td>
       <td class="normalgrayright" colspan="2">
        <?php include('listteam.php');?>
       </td>
      </tr>
      <tr>
       <td align="center" colspan="5" class="box">
        <script type="text/javascript" src="js/menuhorz.js" language="JavaScript1.2"></script>
       </td>
      </tr>
     </table>
    </td>
   </tr>
   <tr>
    <td valign="top" width="10%" bgcolor="#FFFFFF">
     <table class="box">
      <tr>
       <td class="boxed">
<?php
 $pageName = basename($_SERVER['PHP_SELF']);
 if ($pageName == 'index.php'){
    echo "    <script type=\"text/javascript\" src=\"js/menuvert.js\" language=\"JavaScript1.2\"></script>\n";
 }
 else{
    echo "    <script type=\"text/javascript\" src=\"js/menuvert2.js\" language=\"JavaScript1.2\"></script>\n";
 }
?>
       </td>
      </tr>
     </table>
    </td>
    <td width="100%" align="center" valign="top" bgcolor="#FFFFFF">
     <table cellspacing="0" cellpadding="2" bgcolor="#FFFFFF">
      <tr>
       <td align="center" valign="top" bgcolor="#FFFFFF"><br>
<!-- end header -->
