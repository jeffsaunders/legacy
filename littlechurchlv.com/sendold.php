<?
$passed = false;
if ($_REQUEST['password'] != ""){
	// ask for password
	// connect to the database
	include("dbconnect.php");
	// returns $linkID
//	mysql_select_db("littlechurch", $linkID);

	// look up password
	$query = "SELECT * FROM login WHERE password = '".$_REQUEST['password']."'";
	$rs_login = mysql_query($query, $linkID);
	if (mysql_num_rows($rs_login) == 0){
		$message = 'Invalid Password - Please Try Again.';
		header("Location: sendold.php?message=$message");
		exit;
	}
	$login = mysql_fetch_assoc($rs_login);
	if ($login['print_reservations'] != "T"){
		$message = 'Sorry '.$login['first_name'].', you do not have permission to print reservations.';
		header("Location: sendold.php?message=$message");
		exit;
	}else{
		$passed = true;
	}
}
?>

<?
/*
This code reproduces the EXACT report that the old Cold Fusion system generated.  YUCK!
The report is VERY ugly and needs to be reworked extensively.  It should consist of a true REPORT that is delivered via SSL rather than simulate screendumps and emailed.
Even more importantly, it should NOT email credit card numbers!!!!!!!  AAAAAAAAAAAAAAAAAAAAAAAAAAAAA!
*/
?>

<?
if (!$passed){
	// ask for password
?> 
<html>
<body>

<script>
function validate(theForm){
// Username
//	if (theForm.username){
//		if (theForm.username.value == ""){
//			theForm.username.style.background="#FF0000";
//			alert("Blank Usernames Not Allowed - Please Enter Your Username");
//			theForm.username.style.background="#FFFFFF";
//			theForm.username.focus();
//			return false;
//		}
//	}
// Password
	if (theForm.password){
		if (theForm.password.value == ""){
			theForm.password.style.background="#FF0000";
			alert("Blank Passwords Not Allowed - Please Enter Your Password");
			theForm.password.style.background="#FFFFFF";
			theForm.password.focus();
			return false;
		}
	}
// Remember AND Forget
//	if (theForm.remember){
//		if (theForm.remember.checked && theForm.forget.checked){
//			theForm.remember.style.background="#FF0000";
//			theForm.forget.style.background="#FF0000";
//			alert("I Cannot Both Remember And Forget You At The Same Time - Please Select Only One Or Neither");
//			theForm.remember.style.background="#E5EBF9";
//			theForm.forget.style.background="#E5EBF9";
//			theForm.remember.focus();
//			return false;
//		}
//	}
	return true;
}
</script>
<br>
<div align="center">
	<font size="+2"><strong>The Little Church of the West</strong></font><br>
	<font size="+1"><strong>Reservation Print System</strong></font><br><br>
	<?
//	if ($_REQUEST['message'] != ""){
//		echo '<strong><font color="#FF0000">'.$_REQUEST['message'].'</font></strong>';
//	}else{
//		echo '<strong>Please Enter Your Password.</strong>';
//	}
	?>
<!--	<br><br>-->
</div>
<form action="" method="post" name="passwordForm" id="passwordForm" onSubmit="return validate(this);">
<table border="0" align="center">
<tr>
	<td align="right">Password:</td>
	<td><input type="password" name="password" id="password" size="20" maxlength="25"></td>
	<td><input type="submit" name="login" id="login" value="Print"></td>
</tr>
</table>
</form>
	<?
	if ($_REQUEST['message'] != ""){
		echo '<script>alert("'.$_REQUEST['message'].'");</script>';
	}
	?>

<?
}else{
	// forgo indentation as this is temporary........

// Functions First...

// Function to extract as much info from the browser as it is willing to give up
// Works better than PHP's own get_browser() function
function php_get_browser($agent = NULL){
	$agent=$agent?$agent:$_SERVER['HTTP_USER_AGENT'];
	$yu=array();
	$q_s=array("#\.#","#\*#","#\?#");
	$q_r=array("\.",".*",".?");
	$brows=parse_ini_file("/etc/browscap.ini",true);
	foreach($brows as $k=>$t){
		if(fnmatch($k,$agent)){
			$yu['browser_name_pattern']=$k;
			$pat=preg_replace($q_s,$q_r,$k);
			$yu['browser_name_regex']=strtolower("^$pat$");
			foreach($brows as $g=>$r){
				if($t['Parent']==$g){
					foreach($brows as $a=>$b){
						if($r['Parent']==$a){
							$yu=array_merge($yu,$b,$r,$t);
							foreach($yu as $d=>$z){
								$l=strtolower($d);
								$hu[$l]=$z;
							}
						}
					}
				}
			}
			break;
		}
	}
	return $hu;
}

// get unprinted orders
//$query = "SELECT *, UNIX_TIMESTAMP(Step1Time) AS ResTime FROM reservations WHERE Printed <> 'T' AND Test <> 'T' AND (ResHomePhone <> '' OR ResCreditCardNumber <> '') ORDER BY Step1Time";
$query = "SELECT *, UNIX_TIMESTAMP(Step1Time) AS ResTime, UNIX_TIMESTAMP(Step1Time) AS Time1, UNIX_TIMESTAMP(Step2Time) AS Time2, UNIX_TIMESTAMP(Step3Time) AS Time3 FROM reservations WHERE Printed <> 'T' AND Test <> 'T' ORDER BY Step1Time";
//$query = "SELECT *, UNIX_TIMESTAMP(Step1Time) AS ResTime FROM reservations WHERE SessionID = '9949ae8acc103c8c582e6b832764ff30'";
$result = mysql_query($query, $linkID);
for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
	$row = mysql_fetch_assoc($result);

	// calculate how many minutes ago they last saved data
	$Complete = false;
	if ($row["Time3"] != 0){
		$LastTime = $row["Time3"]; //just grab the time for good measuer - not really used.
		$Complete = true; //...becasue any value here means they completed the reservation
	}elseif ($row["Time2"] != 0){
		$LastTime = $row["Time2"];
	}else{
		$LastTime = $row["Time1"];
	}
	$ElapsedTime = ((time()-$LastTime)/60);
	if ($Complete || $ElapsedTime > 30){

	// build email
	$to = "orders@littlechurchlv.com";
//$to = "lcotw_test@nr.net"; //Testing
	if (strlen(trim($row["ResCreditCardNumber"])) < 5){
		$subject = "INCOMPLETE RESERVATION";
	}else{
		$subject = "NEW WEDDING RESERVATION";
	}
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= 'Bcc: lcotw_test@nr.net' . "\r\n"; //Testing
	$headers .= "From: Little Church Reservations <".$row['ResEmail'].">\r\n";
	$message = '
<table bgcolor="#F4E7C6" bordercolor="#2E618E" border="1" cellpadding="5" width="600">
<tr>
	<td colspan="2" bgcolor="#000000" align="center">
		<b><font face="Arial" size="-1" color="White">RESERVATION INFORMATION</font></b>
	</td>
</tr>
<!--<tr>
	<td colspan="2" align="center">
		<font face="Arial" size="-1" color="Blue">INTERNAL NOTES:<br>
		<ul>
		<li>The customer completed the 3 step process on '.strftime("%m/%d/%y",$row["ResTime"]).' at '.strftime("%I:%M %p %Z",$row["ResTime"]).'</li>
		</ul>
	</td>
</tr>-->
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Website Request #: <font face="Arial" size="-1" color="Black"><B>'.$row["ResNumber"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Reservation Submitted On: <font face="Arial" size="-1" color="Black"><B>'.strftime("%A %m/%d/%y %I:%M %p %Z",$row["ResTime"]).'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Reservation Submitted By: <font face="Arial" size="-1" color="Black"><B>'.$row["ResName"].' - '.$row["ResRelation"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Address:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResAddress"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">City: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResCity"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">State/Province:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResState"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Zip/Postal Code:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResZip"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Country:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResCountry"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Phone: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResHomePhone"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2"><font face="Arial" size="-1" color="Blue">Email:</font> <font face="Arial" size="-1" color="Black"><B><a href="mailto:'.$row["ResEmail"].'">'.$row["ResEmail"].'</a></B></font>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="##000000" align="center">
		<b><font face="Arial" size="-1" color="White">WEDDING INFORMATION</font></b>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Reservation Date:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResDate"].'</B></font>
	</td>
	<td>
<!--		<font face="Arial" size="-1" color="Blue">Reservation times:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResTimeFrom"].' to '.$row["ResTimeTo"].'</B></font>-->
		<font face="Arial" size="-1" color="Blue">Reservation Time:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResTimeFrom"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2"><font face="Arial" size="-1" color="Blue">Package Requested: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResPackagedDesired"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Service Type: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResServiceType"].' '.$row["ResPackageType"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Language: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResServiceLanguage"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Bride\'s Name: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResBrideName"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Groom\'s Name: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResGroomName"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Flower Color Requested: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResFlowerColor"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Bride\'s Bouquet Style: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResFlowerStyle"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Lodging: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResHotel"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Number of Guests: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResGuests"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Additional DVDs: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResDVDQty"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Add Webcam Service: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResWebcam"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Reserve Limo: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResLimo"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Upgrade Photo Package: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResUpgradePhotos"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Special Requests: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResRequests"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="##000000" align="center"><b><font face="Arial" size="-1" color="White">PAYMENT INFORMATION</font></b>
	</td>
</tr>
<!--<tr>
	<td colspan="2"><font face="Arial" size="-1" color="Blue">Following is the Billing Info for <font face="Arial" size="-1" color="Red"><B>'.$row["ResBrideName"].'</B></font>:</font>
	</td>
</tr>-->
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Type of Card:</font> <font face="Arial" size="-1" color="Black"><b>'.$row["ResCreditCardType"].'</b></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Name on Card:</font> <font face="Arial" size="-1" color="Black"><b>'.$row["ResCreditCardName"].'</b></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Expiration Date:</font> <font face="Arial" size="-1" color="Black"><b>'.$row["ResCreditCardExpiration"].'</b></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Credit Card Number:</font> <font face="Arial" size="-1" color="Red"><b>'.$row["ResCreditCardNumber"].'</b></font></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Billing Zipcode:</font> <font face="Arial" size="-1" color="Black"><b>'.$row["ResCreditCardZip"].'</b></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Credit Card Security Code (CID):</font> <font face="Arial" size="-1" color="Red"><b>'.$row["ResCreditCardCID"].'</b></font></font>
	</td>
</tr>
<!--
<tr><td colspan="2" bgcolor="##000000" align="center"><b><font face="Arial" size="-1" color="White">WEBSITE INFORMATION</font></b></td></tr>
<tr><td colspan="2"><font face="Arial" size="-1" color="Blue">Date of First Visit:</font> <font face="Arial" size="-1" color="Black"><b>#firstvisit.VisitDateTime#</b></font></td></tr>
<tr><td colspan="2"><font face="Arial" size="-1" color="Blue">## of pages Viewed:</font> <font face="Arial" size="-1" color="Black"><b>#getpagecount.PageCount#</b></font></td></tr>
<tr><td colspan="2"><font face="Arial" size="-1" color="Blue">IP Address:</font> <font face="Arial" size="-1" color="Black"><b><a href="http://ws.arin.net/cgi-bin/whois.pl?queryinput=#IPaddress#" target="_blank">#IPaddress#</a></b></font></td></tr>
<tr><td colspan="2"><font face="Arial" size="-1" color="Blue">Source:</font> <font face="Arial" size="-1" color="Black"><b>#firstvisit.cgireferer#</b></font></td></tr>
-->
</table>
';

	// send email
	mail($to, $subject, $message, $headers);

	// Now output to web page
	echo'
<table bgcolor="#F4E7C6" bordercolor="#2E618E" border="1" cellpadding="5" width="600">
<tr>
	<td colspan="2" bgcolor="#000000" align="center">
		<b><font face="Arial" size="-1" color="White">RESERVATION INFORMATION</font></b>
	</td>
</tr>
<!--<tr>
	<td colspan="2" align="center">
		<font face="Arial" size="-1" color="Blue">INTERNAL NOTES:<br>
		<ul>
		<li>The customer completed the 3 step process on '.strftime("%m/%d/%y",$row["ResTime"]).' at '.strftime("%I:%M %p %Z",$row["ResTime"]).'</li>
		</ul>
	</td>
</tr>-->
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Website Request #: <font face="Arial" size="-1" color="Black"><B>'.$row["ResNumber"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Reservation Submitted On: <font face="Arial" size="-1" color="Black"><B>'.strftime("%A %m/%d/%y %I:%M %p %Z",$row["ResTime"]).'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Reservation Submitted By: <font face="Arial" size="-1" color="Black"><B>'.$row["ResName"].' - '.$row["ResRelation"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Address:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResAddress"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">City: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResCity"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">State/Province:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResState"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Zip/Postal Code:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResZip"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Country:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResCountry"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Phone: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResHomePhone"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2"><font face="Arial" size="-1" color="Blue">Email:</font> <font face="Arial" size="-1" color="Black"><B><a href="mailto:'.$row["ResEmail"].'">'.$row["ResEmail"].'</a></B></font>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="##000000" align="center">
		<b><font face="Arial" size="-1" color="White">WEDDING INFORMATION</font></b>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Reservation Date:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResDate"].'</B></font>
	</td>
	<td>
<!--		<font face="Arial" size="-1" color="Blue">Reservation times:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResTimeFrom"].' to '.$row["ResTimeTo"].'</B></font>-->
		<font face="Arial" size="-1" color="Blue">Reservation Time:</font> <font face="Arial" size="-1" color="Black"><B>'.$row["ResTimeFrom"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2"><font face="Arial" size="-1" color="Blue">Package Requested: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResPackagedDesired"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Service Type: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResServiceType"].' '.$row["ResPackageType"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Language: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResServiceLanguage"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Bride\'s Name: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResBrideName"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Groom\'s Name: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResGroomName"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Flower Color Requested: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResFlowerColor"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Bride\'s Bouquet Style: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResFlowerStyle"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Lodging: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResHotel"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Number of Guests: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResGuests"].'</B></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Additional DVDs: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResDVDQty"].'</B></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Add Webcam Service: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResWebcam"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Reserve Limo: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResLimo"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Upgrade Photo Package: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResUpgradePhotos"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2">
		<font face="Arial" size="-1" color="Blue">Special Requests: </font><font face="Arial" size="-1" color="Black"><B>'.$row["ResRequests"].'</B></font>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="##000000" align="center"><b><font face="Arial" size="-1" color="White">PAYMENT INFORMATION</font></b>
	</td>
</tr>
<!--<tr>
	<td colspan="2"><font face="Arial" size="-1" color="Blue">Following is the Billing Info for <font face="Arial" size="-1" color="Red"><B>'.$row["ResBrideName"].'</B></font>:</font>
	</td>
</tr>-->
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Type of Card:</font> <font face="Arial" size="-1" color="Black"><b>'.$row["ResCreditCardType"].'</b></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Name on Card:</font> <font face="Arial" size="-1" color="Black"><b>'.$row["ResCreditCardName"].'</b></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Expiration Date:</font> <font face="Arial" size="-1" color="Black"><b>'.$row["ResCreditCardExpiration"].'</b></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Credit Card Number:</font> <font face="Arial" size="-1" color="Red"><b>'.$row["ResCreditCardNumber"].'</b></font></font>
	</td>
</tr>
<tr>
	<td>
		<font face="Arial" size="-1" color="Blue">Billing Zipcode:</font> <font face="Arial" size="-1" color="Black"><b>'.$row["ResCreditCardZip"].'</b></font>
	</td>
	<td>
		<font face="Arial" size="-1" color="Blue">Credit Card Security Code (CID):</font> <font face="Arial" size="-1" color="Red"><b>'.$row["ResCreditCardCID"].'</b></font></font>
	</td>
</tr>
<!--
<tr><td colspan="2" bgcolor="##000000" align="center"><b><font face="Arial" size="-1" color="White">WEBSITE INFORMATION</font></b></td></tr>
<tr><td colspan="2"><font face="Arial" size="-1" color="Blue">Date of First Visit:</font> <font face="Arial" size="-1" color="Black"><b>#firstvisit.VisitDateTime#</b></font></td></tr>
<tr><td colspan="2"><font face="Arial" size="-1" color="Blue">## of pages Viewed:</font> <font face="Arial" size="-1" color="Black"><b>#getpagecount.PageCount#</b></font></td></tr>
<tr><td colspan="2"><font face="Arial" size="-1" color="Blue">IP Address:</font> <font face="Arial" size="-1" color="Black"><b><a href="http://ws.arin.net/cgi-bin/whois.pl?queryinput=#IPaddress#" target="_blank">#IPaddress#</a></b></font></td></tr>
<tr><td colspan="2"><font face="Arial" size="-1" color="Blue">Source:</font> <font face="Arial" size="-1" color="Black"><b>#firstvisit.cgireferer#</b></font></td></tr>
-->
</table>
';
	if ($counter < mysql_num_rows($result)){
		echo'<div align="center" style="page-break-before: always"><br></div>';
	}

	// Interrogate the browser
//	$browser = php_get_browser();
	$details = "";
//	foreach ($browser as $element => $value) {
//		$details .= "[".$element ."->".$value."] ";
//	}

	// Flag as printed
	$query = 
		"UPDATE reservations SET
		Printed = 'T',
		PrintTime = NOW(),
		PrintName = '".$login['first_name']." ".$login['last_name']."',
		PrintIPAddress = '".getenv('REMOTE_ADDR')."',
		PrintBrowser = '".$_SERVER['HTTP_USER_AGENT']."',
		PrintDetails = '".$details."'
		WHERE SessionId = '".$row['SessionID']."'";
//echo $query.'<br></br>';
	$update = mysql_query($query, $linkID);

	} //End if elapsed time is over 30 minutes
}
} //End password found so reservations ran
?> 

</body>
</html>
