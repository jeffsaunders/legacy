<?
// Grab the URI so we know which domain we are using
//$uri = explode("/",$_SERVER['REQUEST_URI']);

// Interrogate and reassign passed variables
//$sec = $_REQUEST['sec'];
//$anchor = $_REQUEST['anchor'];
//$message = $_REQUEST['message'];
//$cargo = $_REQUEST['cargo'];
//$task = $_REQUEST['task'];

// Connect to the database
include("dbconnect.php");

// PHP Functions
include("functions.php");

// Now, what to do...what to do?
switch($_REQUEST['task']){
	case "contactSubmit":	// Contact Form submitted
//		// Captcha Test
//		session_start(); 
//		if ($_REQUEST['captcha'] != $_SESSION['Captcha']){
//			echo'<script>alert("Tsk Tsk - You Know Better Than That!");</script>';
//			echo'<script>window.location = "http://www.spam.com";</script>';
//			exit;
//		}
		// Assign values
		$to = 'info@littlechurchlv.com';
//$to = 'lcotw_test@nr.net';  //Testing
		$from = $_REQUEST['email'];
		$name = addcslashes($_REQUEST['name'], '&');
		$phone = $_REQUEST['phone'];
		$type = "Contact Request";
		$subject = "Contact Request";

		// Build message
		$message = "<table border='0' cellspacing='0' cellpadding='0'><font face='sans-serif'>";
		$message .= "<tr><td><font face='sans-serif'><strong>From: </strong></font></td><td><font face='sans-serif'>&nbsp;".$name."</font></td></tr>";
		$message .= "<tr><td><font face='sans-serif'><strong>Email:</strong></font></td><td><font face='sans-serif'>&nbsp;".$from."</font></td></tr>";
		$message .= "<tr><td><font face='sans-serif'><strong>Phone:</strong></font></td><td><font face='sans-serif'>&nbsp;".$phone."</font></td></tr>";
		$message .= "<tr><td><font face='sans-serif'><strong>Type: </strong></font></td><td><font face='sans-serif'>&nbsp;".$type."</font></td></tr>";
		$message .= "</table><br>";
		$message .= "<font face='sans-serif' size='3'><strong>Message:</strong></font>"."<br>";
		$message .= "<font face='sans-serif' size='3'>".addcslashes($_REQUEST['message'], '&')."</font>";
//				$message .= addcslashes($_REQUEST['message'], '\000..\037\046\134\178..\377')."</font>"; //Chars 0-31, literal "&", literal "\", and chars 128-255 (values in Octal <shrug>)
//				$fixedtext = iconv($_REQUEST['message'], 'US-ASCII//TRANSLIT', $fixedtext);
//				$message .= $fixedtext."</font>";

		// Build additional headers
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: ".$name." (".$type.") <".$from.">\r\n";
//		if ($_REQUEST['email_cc'] != "") $headers .= "Cc: ".$from.""."\r\n";
$headers .= "Bcc: lcotw_test@nr.net"."\r\n";  //Testing

		// Save it to database
//		if ($_REQUEST['email_cc'] != ""){
//			$copy = "T";
//		}else{
			$copy = "F";
//		}
		$query =
			"INSERT INTO inquiries (
			name,
			email,
			phone,
			copy,
			purpose,
			subject,
			message,
			timestamp)
			VALUES (
			'".$_REQUEST['name']."',
			'".$_REQUEST['email']."',
			'".$_REQUEST['phone']."',
			'".$copy."',
			'".$type."',
			'".$subject."',
			'".addcslashes($_REQUEST['message'], '&')."',
			NOW())";
//echo $query.'<br></br>';
		$result = mysql_query($query, $linkID);

		// Send it off
		mail($to, stripslashes($subject), stripslashes($message), $headers);

		// Send 'em back
//		header("Location: ".$_REQUEST['location']."");
		// Using the browser history puts them back in the same place on the page
//		echo'<script>history.go(-1);</script>';
		echo'<script>window.location = "'.$_SERVER['HTTP_REFERER'].'";</script>';
		exit;

//////////
	case "feedbackSubmit":	// Feedback Form submitted
		// Assign values
		$to = 'info@littlechurchlv.com';
//$to = 'lcotw_test@nr.net';  //Testing
		$from = $_REQUEST['email'];
		$name = addcslashes($_REQUEST['name'], '&');
		$phone = $_REQUEST['phone'];
		$type = $_REQUEST['type'];
		$subject = "Feedback";

		// Build message
		$message = "<table border='0' cellspacing='0' cellpadding='0'><font face='sans-serif'>";
		$message .= "<tr><td><font face='sans-serif'><strong>From: </strong></font></td><td><font face='sans-serif'>&nbsp;".$name."</font></td></tr>";
		$message .= "<tr><td><font face='sans-serif'><strong>Email:</strong></font></td><td><font face='sans-serif'>&nbsp;".$from."</font></td></tr>";
		$message .= "<tr><td><font face='sans-serif'><strong>Phone:</strong></font></td><td><font face='sans-serif'>&nbsp;".$phone."</font></td></tr>";
		$message .= "<tr><td><font face='sans-serif'><strong>Type: </strong></font></td><td><font face='sans-serif'>&nbsp;".$type."</font></td></tr>";
		$message .= "</table><br>";
		$message .= "<font face='sans-serif' size='3'><strong>Message:</strong></font>"."<br>";
		$message .= "<font face='sans-serif' size='3'>".addcslashes($_REQUEST['message'], '&')."</font>";
//				$message .= addcslashes($_REQUEST['message'], '\000..\037\046\134\178..\377')."</font>"; //Chars 0-31, literal "&", literal "\", and chars 128-255 (values in Octal <shrug>)
//				$fixedtext = iconv($_REQUEST['message'], 'US-ASCII//TRANSLIT', $fixedtext);
//				$message .= $fixedtext."</font>";

		// Build additional headers
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: ".$name." (".$type.") <".$from.">\r\n";
//		if ($_REQUEST['email_cc'] != "") $headers .= "Cc: ".$from.""."\r\n";
$headers .= "Bcc: lcotw_test@nr.net"."\r\n";  //Testing

		// Save it to database
//		if ($_REQUEST['email_cc'] != ""){
//			$copy = "T";
//		}else{
			$copy = "F";
//		}
		$query =
			"INSERT INTO inquiries (
			name,
			email,
			phone,
			copy,
			purpose,
			subject,
			message,
			timestamp)
			VALUES (
			'".$_REQUEST['name']."',
			'".$_REQUEST['email']."',
			'".$_REQUEST['phone']."',
			'".$copy."',
			'".$type."',
			'".$subject."',
			'".addcslashes($_REQUEST['message'], '&')."',
			NOW())";
//echo $query.'<br></br>';
		$result = mysql_query($query, $linkID);

		// Send it off
		mail($to, stripslashes($subject), stripslashes($message), $headers);

		// Send 'em back
//		header("Location: ".$_REQUEST['location']."");
		// Using the browser history puts them back in the same place on the page
//		echo'<script>history.go(-1);</script>';
		echo'<script>window.location = "'.$_SERVER['HTTP_REFERER'].'";</script>';
		exit;

}; // End Switch
?>
