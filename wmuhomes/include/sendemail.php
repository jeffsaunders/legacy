<?
// Assign values
//$to = $_REQUEST['MailTo'];
$to = 'jeff@nr.net';  //Testing
$from = $_REQUEST['Email'];
$name = addcslashes($_REQUEST['Name'], '&');
$subject = addcslashes($_REQUEST['Subject'], '&');

// Build message
$message = "<table border='0' cellspacing='0' cellpadding='0'><font face='sans-serif'>";
$message .= "<tr><td><font face='sans-serif'><strong>From: </strong></font></td><td><font face='sans-serif'>&nbsp;".$name."</font></td></tr>";
$message .= "<tr><td><font face='sans-serif'><strong>Email:</strong></font></td><td><font face='sans-serif'>&nbsp;".$from."</font></td></tr>";
$message .= "</table><br>";
$message .= "<font face='sans-serif' size='3'><strong>Message:</strong></font>"."<br>";
$message .= "<font face='sans-serif' size='3'>".addcslashes($_REQUEST['Message'], '&')."</font>";

// Build additional headers
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: ".$name." <".$from.">\r\n";
//if ($_REQUEST['email_cc'] != "") $headers .= "Cc: ".$from.""."\r\n";

// Send it off
mail($to, stripslashes($subject), stripslashes($message), $headers);
?>

<div id="Success" style="position:absolute; top:80px; left:0px; width:580px; text-align:center; z-index:1002;">
	<span style="font-family:'Myvetica',sans-serif; font-size:24px; color:#092C3E;">Thank You!</span><br>
	<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#092C3E;">Your email has been sent to the property manager.</span><br><br>
	<a href="javascript:hide('overlayMask');" class="menuBlue">Close</a>
</div>
