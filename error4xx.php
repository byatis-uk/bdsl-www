<?php
 $errCode = $_GET["error"];
 $errMsg='';
 switch ($errCode) {
    case 400:
        $errMsg = 'Bad Request';
        break;
    case 401:
        $errMsg = 'Unauthorized';
        break;
    case 402:
        $errMsg = 'PaymentRequired';
        break;
    case 403:
        $errMsg = 'Forbidden';
        break;
    case 404:
        $errMsg = 'Not Found';
        break;
 }
 $pageTitle="ERROR $errCode";
 include ('pageheader.php');
 echo "<h3>Oops!</h3>";
 echo "<br><br><h5>Sorry, but there is an error with page you were looking for - it may have moved, does not exist or there may be another technical problem</h5>";
 echo "<br><br><h6>Error $errCode $errMsg</h6>";
 include ('pagefooter.php');
?>
