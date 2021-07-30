<?php

ini_set('log_errors', 'On');
ini_set('error_reporting', E_ALL);

if (!empty($_REQUEST['name']) && !empty($_REQUEST['emailTo']) && !empty($_REQUEST['emailFrom'])) {
	$emails = split('[,]', $_REQUEST['emailTo']);	
	foreach($emails as $to) {
		
		$sender = $_REQUEST['name'];
		$from = $_REQUEST['emailFrom'];
//		$subject = 'Thought you would love this';
		$subject = $_REQUEST['subject'];
		$note = $_REQUEST['note'];
		$arrPath = parse_url($_SERVER['HTTP_REFERER']);
		$message = '
		<html>
		<head>
		</head>
		<body>
			Dear ' . $to . ':
			<p>' . $sender . ' thought you might like this event from Keith Lloyd Couture - featuring custom designed clothing for both men and women. Unique designs, hand tailored to fit perfectly.
			<p>' . $sender . '`s message: ' . $note . '</p>
			<p>
			Please click link below:<br>
			<a href="' . $_SERVER['HTTP_REFERER'] . '">' . $_SERVER['HTTP_REFERER'] . '</a>
			</p>			
			<p>Thank you,<br>
			keithlloyd.com</p>
		</body>
		</html>
		';
		
		//<p>Put "inner box" here from <a href="' . $_SERVER['HTTP_REFERER'] . '">' . substr($arrPath['path'], 1) . '</a> page</p>
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: ' . $to . "\r\n";
		$headers .= 'From: ' . $from . "\r\n";
		
		mail($to, $subject, $message, $headers);
	}		
} 
header("Location: ".$_SERVER['HTTP_REFERER']);
?>
<!--
<div id="Success" style="position:absolute; top:80px; left:0px; width:580px; text-align:center; z-index:1002;">
	<span style="font-family:Arial,Helvetica,sans-serif; font-size:24px; color:#092C3E;">Thank You!</span><br>
	<span style="font-family:Arial,Helvetica,sans-serif; font-size:18px; color:#092C3E;">Your email has been sent.</span><br><br>
	<a href="javascript:hide('overlayMask');" class="learn"><font size="+1">Close</font></a>
</div>
-->
