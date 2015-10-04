<?

function check_email_address($email) {
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	// Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			return false;
		}
	}  
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}

require("config.inc.php");

if ($logging == 1) {
        $localTime=time();
        $localTime=$localTime - (60 * 60 * 1);
	$timestamp = date('Y-m-d',$localTime);
	foreach ($_POST as $key => $string) {
		$value = stripslashes($string);
		$logmsg .= ucfirst ($key) ." : ". $value . "\n";
	}
	$fh = fopen("$logpath/$timestamp.txt", "a+") or die( "Error opening file" );
	if (!fwrite($fh, $logmsg)) { die( "Error writing to file!" ); }
	if (!fwrite($fh, "\n---------------\n\n")) { die( "Error writing to file!" ); }
	fclose($fh) or die( "Error closing file!" );
}

session_start();
if(($_SESSION['security_code'] == $_REQUEST['security_code']) && (!empty($_SESSION['security_code'])) ) {
	$boundary = md5(date('r', time()));
	$msg = "This is a multi-part message in MIME format.\n\n";
	$msg .= "--$boundary\n";
	$msg .= "Content-Type: text/plain; charset=utf-8; format=flowed; delsp=yes\n";
	$msg .= "Content-Transfer-Encoding: 7bit\n\n";
	$msg .= "$intro\n";
	foreach ($_POST as $key => $string) {
		$value = stripslashes($string);
		if ($value == '') { $badfield = true; $emptykey = $key; }
		if ($key != "security_code" && $key != "submit" && $key !="MAX_FILE_SIZE") {
                        if ($key == "email" && check_email_address($value) == false) { $bademail = true; }
			$msg .= ucfirst ($key) ." : ". $value . "\n";
		}
		if ($key == "sendto") {
			$sendTo = $value;
		}
		if ($key == name) {
			$name = $value;
		}
		if ($key == team) {
			$teamName = $value;
		}
		if ($key == email) {
			$headers = "From: " . $name . " <" . $value . ">\n";
			$headers .= "Reply-To: " . $value . "\n";
			$headers .= "Return-Path: " . $value . "\n";
			$headers .= "Envelope-from: " . $value . "\n";
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";		
		}
	}
	if ($attachments == 0) {
		$msg .= "--$boundary--\n";
	}
	if (isset($_FILES['attachment']) && $attachments == 1) {
		if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
			$file_upload = true;
			$tmp_path = "tmp/" . basename( $_FILES['attachment']['name']); 
			if(move_uploaded_file($_FILES['attachment']['tmp_name'], $tmp_path)) {
				$file = fopen($tmp_path,'rb');
				$data = fread($file,filesize($tmp_path));
				fclose($file);
			}
			$attachment = chunk_split(base64_encode($data));
			$attachment_name = $_FILES['attachment']['name'];
			$attachment_type = $_FILES['attachment']['type'];
			$attachment_size = $_FILES['attachment']['size'];
			$file_extension = strtolower(substr(strrchr($attachment_name,"."),1));
			$msg .= "\n--$boundary\n";
			$msg .= "Content-Type: $attachment_type; name=\"$attachment_name\"\n"; 
			$msg .= "Content-Transfer-Encoding: base64\n";
			$msg .= "Content-Disposition: attachment; filename=$attachment_name\n\n\n";
			$msg .= "$attachment\n";
			
		}
	}
	session_unregister(security_code);
	if ($attachments == 1 && $attachment_size > $max_file_size && $file_upload == true) {
		header ("Location:$bigfile");
	}
	else if ($attachments == 1 && !in_array($file_extension, $file_types) && $file_upload == true) {
		header ("Location:$badfile");
	}
	else if ($formval == 1 && $emailval == 1) {
		if ($bademail != true && $badfield != true) {
			if ($sendTo == "petestump") {
			   $to = "webmaster@berkeleydsl.org.uk";
                           $subject = "BDSL - Feedback Form";
                        }
                        else {
                           $to = "berkeley456@white-house-farm.demon.co.uk";
                           $subject = "BDSL Divisions 4 5 6 (via Feedback Form)";
                        }
			mail($to, $subject, $msg, $headers);
			header ("Location:$thanks");
		}
		else if ($bademail != true && $badfield == true) {
			header ("Location:$emptyfield"); 
		}
		else { header ("Location:$invalid"); }
	}
	else if ($formval != 1 && $emailval == 1) {
		if ($bademail != true) {
			mail($to, $subject, $msg, $headers);
			header ("Location:$thanks");
		}
		else { header ("Location:$invalid"); }
	
	}
	else if ($formval == 1 && $emailval != 1) {
		if ($badfield != true) {
			mail($to, $subject, $msg, $headers);
			header ("Location:$thanks");
		}
		else {
			header ("Location:$emptyfield"); 
		}
	}
	
} 
else { 
	session_unregister(security_code);
	header ("Location:$wrong"); 
}
if (file_exists($tmp_path)) {
	unlink($tmp_path);
}
?>