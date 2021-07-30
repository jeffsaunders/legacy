<!-- BEGIN Include thankyou.php -->

<?
// write data to db
switch($task){
	case "changeplan":
		$options = "";
		for ($counter=1; $counter <= 25; $counter++){
			if ($_REQUEST['option'.$counter] != ""){
				$options .= $_REQUEST['option'.$counter].",";
			}
		}
		$query =
			"INSERT INTO requests (
			session_id,
			ipaddress,
			request_type,
			site,
			first_name,
			last_name,
			user_email,
			device_manuf,
			device_model,
			current_num,
			change_voice_plan,
			new_voice_plan,
			blackberry_plan,
			text_plan,
			vision_plan,
			options,
			requester_name,
			requester_phone,
			requester_email,
			note,
			request_time)
			VALUES (
			'".session_id()."',
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['request_type']."',
			'".$_SESSION['site']."',
			'".$_REQUEST['first_name']."',
			'".$_REQUEST['last_name']."',
			'".$_REQUEST['user_email']."',
			'".$_REQUEST['device_manuf']."',
			'".$_REQUEST['device_model']."',
			'".$_REQUEST['current_num']."',
			'".$_REQUEST['change_voice_plan']."',
			'".$_REQUEST['new_voice_plan']."',
			'".$_REQUEST['blackberry_plan']."',
			'".$_REQUEST['text_plan']."',
			'".$_REQUEST['vision_plan']."',
			'".rtrim($options,',')."',
			'".$_REQUEST['requester_name']."',
			'".$_REQUEST['requester_phone']."',
			'".$_REQUEST['requester_email']."',
			'".$_REQUEST['note']."',
			DATE_SUB(NOW(), INTERVAL 2 HOUR))";
//echo $query;
		$rs_insert = mysql_query($query, $linkID);
		break;

	case "changenumber":
		$query =
			"INSERT INTO requests (
			session_id,
			ipaddress,
			request_type,
			site,
			first_name,
			last_name,
			user_email,
			current_num,
			new_areacode,
			new_address1,
			new_address2,
			new_city,
			new_state,
			new_zipcode,
			requester_name,
			requester_phone,
			requester_email,
			note,
			request_time)
			VALUES (
			'".session_id()."',
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['request_type']."',
			'".$_SESSION['site']."',
			'".$_REQUEST['first_name']."',
			'".$_REQUEST['last_name']."',
			'".$_REQUEST['user_email']."',
			'".$_REQUEST['current_num']."',
			'".$_REQUEST['new_areacode']."',
			'".$_REQUEST['new_address1']."',
			'".$_REQUEST['new_address2']."',
			'".$_REQUEST['new_city']."',
			'".$_REQUEST['new_state']."',
			'".$_REQUEST['new_zipcode']."',
			'".$_REQUEST['requester_name']."',
			'".$_REQUEST['requester_phone']."',
			'".$_REQUEST['requester_email']."',
			'".$_REQUEST['note']."',
			DATE_SUB(NOW(), INTERVAL 2 HOUR))";
//echo $query;
		$rs_insert = mysql_query($query, $linkID);
		break;

	case "swapplan":
		$options = "";
		for ($counter=1; $counter <= 25; $counter++){
			if ($_REQUEST['option'.$counter] != ""){
				$options .= $_REQUEST['option'.$counter].", ";
			}
		}
		$query =
			"INSERT INTO requests (
			session_id,
			ipaddress,
			request_type,
			site,
			first_name,
			last_name,
			user_email,
			device_manuf,
			device_model,
			esn,
			current_num,
			change_voice_plan,
			new_voice_plan,
			blackberry_plan,
			text_plan,
			vision_plan,
			options,
			requester_name,
			requester_phone,
			requester_email,
			note,
			request_time)
			VALUES (
			'".session_id()."',
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['request_type']."',
			'".$_SESSION['site']."',
			'".$_REQUEST['first_name']."',
			'".$_REQUEST['last_name']."',
			'".$_REQUEST['user_email']."',
			'".$_REQUEST['device_manuf']."',
			'".$_REQUEST['device_model']."',
			'".$_REQUEST['esn']."',
			'".$_REQUEST['current_num']."',
			'".$_REQUEST['change_voice_plan']."',
			'".$_REQUEST['new_voice_plan']."',
			'".$_REQUEST['blackberry_plan']."',
			'".$_REQUEST['text_plan']."',
			'".$_REQUEST['vision_plan']."',
			'".rtrim($options,',')."',
			'".$_REQUEST['requester_name']."',
			'".$_REQUEST['requester_phone']."',
			'".$_REQUEST['requester_email']."',
			'".$_REQUEST['note']."',
			DATE_SUB(NOW(), INTERVAL 2 HOUR))";
//echo $query;
		$rs_insert = mysql_query($query, $linkID);
		break;

	case "changeuser":
		$query =
			"INSERT INTO requests (
			session_id,
			ipaddress,
			request_type,
			site,
			first_name,
			last_name,
			employee_id,
			cost_center,
			user_email,
			current_num,
			requester_name,
			requester_phone,
			requester_email,
			note,
			request_time)
			VALUES (
			'".session_id()."',
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['request_type']."',
			'".$_SESSION['site']."',
			'".$_REQUEST['first_name']."',
			'".$_REQUEST['last_name']."',
			'".$_REQUEST['employee_id']."',
			'".$_REQUEST['cost_center']."',
			'".$_REQUEST['user_email']."',
			'".$_REQUEST['current_num']."',
			'".$_REQUEST['requester_name']."',
			'".$_REQUEST['requester_phone']."',
			'".$_REQUEST['requester_email']."',
			'".$_REQUEST['note']."',
			DATE_SUB(NOW(), INTERVAL 2 HOUR))";
//echo $query;
		$rs_insert = mysql_query($query, $linkID);
		break;

	case "transfer":
		$query =
			"INSERT INTO requests (
			session_id,
			ipaddress,
			request_type,
			site,
			first_name,
			last_name,
			employee_id,
			cost_center,
			user_email,
			current_num,
			bill_name,
			bill_address1,
			bill_address2,
			bill_city,
			bill_state,
			bill_zipcode,
			acct_num,
			acct_pass,
			requester_name,
			requester_phone,
			requester_email,
			note,
			request_time)
			VALUES (
			'".session_id()."',
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['request_type']."',
			'".$_SESSION['site']."',
			'".$_REQUEST['first_name']."',
			'".$_REQUEST['last_name']."',
			'".$_REQUEST['employee_id']."',
			'".$_REQUEST['cost_center']."',
			'".$_REQUEST['user_email']."',
			'".$_REQUEST['current_num']."',
			'".$_REQUEST['bill_name']."',
			'".$_REQUEST['bill_address1']."',
			'".$_REQUEST['bill_address2']."',
			'".$_REQUEST['bill_city']."',
			'".$_REQUEST['bill_state']."',
			'".$_REQUEST['bill_zipcode']."',
			'".$_REQUEST['acct_num']."',
			'".$_REQUEST['acct_pass']."',
			'".$_REQUEST['requester_name']."',
			'".$_REQUEST['requester_phone']."',
			'".$_REQUEST['requester_email']."',
			'".$_REQUEST['note']."',
			DATE_SUB(NOW(), INTERVAL 2 HOUR))";
//echo $query;
		$rs_insert = mysql_query($query, $linkID);
		break;

	case "stop":
		$query =
			"INSERT INTO requests (
			session_id,
			ipaddress,
			request_type,
			site,
			first_name,
			last_name,
			user_email,
			current_num,
			stop_reason,
			requester_name,
			requester_phone,
			requester_email,
			note,
			request_time)
			VALUES (
			'".session_id()."',
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['request_type']."',
			'".$_SESSION['site']."',
			'".$_REQUEST['first_name']."',
			'".$_REQUEST['last_name']."',
			'".$_REQUEST['user_email']."',
			'".$_REQUEST['current_num']."',
			'".$_REQUEST['stop_reason']."',
			'".$_REQUEST['requester_name']."',
			'".$_REQUEST['requester_phone']."',
			'".$_REQUEST['requester_email']."',
			'".$_REQUEST['note']."',
			DATE_SUB(NOW(), INTERVAL 2 HOUR))";
//echo $query;
		$rs_insert = mysql_query($query, $linkID);
		break;

	case "rma":
		$query =
			"INSERT INTO requests (
			session_id,
			ipaddress,
			request_type,
			site,
			current_num,
			device_manuf,
			device_model,
			issue_desc,
			issue_note,
			requester_name,
			requester_phone,
			requester_email,
			note,
			request_time)
			VALUES (
			'".session_id()."',
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['request_type']."',
			'".$_SESSION['site']."',
			'".$_REQUEST['current_num']."',
			'".$_REQUEST['device_manuf']."',
			'".$_REQUEST['device_model']."',
			'".$_REQUEST['issue_desc']."',
			'".$_REQUEST['issue_note']."',
			'".$_REQUEST['requester_name']."',
			'".$_REQUEST['requester_phone']."',
			'".$_REQUEST['requester_email']."',
			'".$_REQUEST['note']."',
			DATE_SUB(NOW(), INTERVAL 2 HOUR))";
//echo $query;
		$rs_insert = mysql_query($query, $linkID);
		break;
}

// build receipt email & send it
$to = $_REQUEST['requester_email'];
$subject = "Sprint-Nextel Service Change Request";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= 'Bcc: jeff@nr.net' . "\r\n";
$headers .= "From: ".$_SESSION['site'].".wiresupport.com <sprint.support@wiresupport.com>\r\n";
$message = '
<table width="700" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif; font-size:12;">
<tr>
	<td colspan="2">
		The following request was submitted from IP address <strong>'.getenv('REMOTE_ADDR').'</strong> on <strong>'.date('m/d/y \a\t h:i A', strtotime("-2 hours")).'</strong>, Pacific Time.<br>If you did not submit this request, please contact Vision Wireless Customer Support toll-free at <strong>877.351.1658</strong> or via email at <a href="mailto:sprint.support@wiresupport.com" style="text-decoration:underline;"><strong>sprint.support@wiresupport.com</strong></a> immediately.<br><hr width="100%" size="2" color="#000000" noshade><br>
	</td>
</tr>
';
switch($_REQUEST['request_type']){
	case "plan": $request_type = "Rate Plan Change";break;
	case "number": $request_type = "Phone Number Change";break;
	case "swap": $request_type = "Device Swap";break;
	case "user": $request_type = "Corporate User Change";break;
	case "transfer": $request_type = "Transfer Account Liability";break;
	case "stop": $request_type = "Stop Service";break;
	case "rma": $request_type = "RMA";break;
	default: $request_type = "Undefined";break;
}
$message .= '
<tr>
	<td width="200">Request Type:</td>
	<td width="500"><strong>'.$request_type.' Request</strong></td>
</tr>
';
if ($_REQUEST['request_type'] != "rma"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User First Name:</td>
	<td><strong>'.$_REQUEST['first_name'].'</strong></td>
</tr>
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User First Name:</td>
	<td><strong>'.$_REQUEST['last_name'].'</strong></td>
</tr>
	';
	if ($_REQUEST['request_type'] == "user" || $_REQUEST['request_type'] == "transfer"){
		$message .= '
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User Employee ID:</td>
	<td><strong>'.$_REQUEST['employee_id'].'</strong></td>
</tr>
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User Cost Center:</td>
	<td><strong>'.$_REQUEST['cost_center'].'</strong></td>
</tr>
		';
	}
	$message .= '
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User Email Address:</td>
	<td><strong>'.$_REQUEST['user_email'].'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] != "transfer"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>Device Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
	';
	if ($_REQUEST['request_type'] == "plan" || $_REQUEST['request_type'] == "swap" || $_REQUEST['request_type'] == "rma"){
		$message .= '
<tr>
	<td>Device Manufacturer:</td>
	<td><strong>'.$_REQUEST['device_manuf'].'</strong></td>
</tr>
<tr>
	<td>Device Model:</td>
	<td><strong>'.$_REQUEST['device_model'].'</strong></td>
</tr>
		';
		if ($_REQUEST['request_type'] == "swap"){
			$message .= '
<tr>
	<td>Device ESN:</td>
	<td><strong>'.$_REQUEST['esn'].'</strong></td>
</tr>
			';
		}
	}
	$message .= '
<tr>
	<td>'.iif($_REQUEST['request_type'] == "number", "Current ", "").'Wireless Number:</td>
	<td><strong>'.$_REQUEST['current_num'].'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "plan" || $_REQUEST['request_type'] == "swap"){
	if ($_REQUEST['change_voice_plan'] == "T"){
		$ChangePlan = "Yes";
	}else{
		$ChangePlan = "No";
	}
	$message .= '
<tr>
	<td colspan="2"><br><strong>Plan Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Change Calling Plan:</td>
	<td><strong>'.$ChangePlan.'</strong></td>
</tr>
<tr>
	<td>New Calling Plan:</td>
	<td><strong>'.iif($_REQUEST['new_voice_plan'] == "", "No Change", $_REQUEST['new_voice_plan']).'</strong></td>
</tr>
<tr>
	<td>Vision Plan:</td>
	<td><strong>'.$_REQUEST['vision_plan'].'</strong></td>
</tr>
<tr>
	<td>BlackBerry:</td>
	<td><strong>'.$_REQUEST['blackberry_plan'].'</strong></td>
</tr>
<tr>
	<td>Text Messaging Plan:</td>
	<td><strong>'.$_REQUEST['text_plan'].'</strong></td>
</tr>
<tr>
	<td valign="top">Option(s):</td>
	<td><strong>'.rtrim($options,',').'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "number"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>New Phone Number Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Primary Place of Use Area Code:</td>
	<td><strong>'.$_REQUEST['new_areacode'].'</strong></td>
</tr>
<tr>
	<td valign="top">Primary Place of Use Address:</td>
	<td><strong>'.$_REQUEST['new_address1'].''.iif($_REQUEST['new_address2'] != "", "<br>".$_REQUEST['new_address2'], "").'</strong></td>
</tr>
<tr>
	<td>Primary Place of Use City:</td>
	<td><strong>'.$_REQUEST['new_city'].'</strong></td>
</tr>
<tr>
	<td>Primary Place of Use State:</td>
	<td><strong>'.$_REQUEST['new_state'].'</strong></td>
</tr>
<tr>
	<td>Primary Place of Use Zip Code:</td>
	<td><strong>'.$_REQUEST['new_zipcode'].'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "transfer"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>Account Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Phone Number to Transfer:</td>
	<td><strong>'.$_REQUEST['current_num'].'</strong></td>
</tr>
<tr>
	<td>Name as it Appears on Bill:</td>
	<td><strong>'.$_REQUEST['bill_name'].'</strong></td>
</tr>
<tr>
	<td valign="top">Billing Address:</td>
	<td><strong>'.$_REQUEST['bill_address1'].''.iif($_REQUEST['bill_address2'] != "", "<br>".$_REQUEST['bill_address2'], "").'</strong></td>
</tr>
<tr>
	<td>Billing City:</td>
	<td><strong>'.$_REQUEST['bill_city'].'</strong></td>
</tr>
<tr>
	<td>Billing State:</td>
	<td><strong>'.$_REQUEST['bill_state'].'</strong></td>
</tr>
<tr>
	<td>Billing Zip Code:</td>
	<td><strong>'.$_REQUEST['bill_zipcode'].'</strong></td>
</tr>
<tr>
	<td>Account Number:</td>
	<td><strong>'.$_REQUEST['acct_num'].'</strong></td>
</tr>
<tr>
	<td>Account Password:</td>
	<td><strong>'.iif($_REQUEST['acct_pass'] == "", "Not Provided", $_REQUEST['acct_pass']).'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "stop"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>Reason</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td valign="top">Reason For Stopping Service:</td>
	<td><strong>'.$_REQUEST['stop_reason'].'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "rma"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>Issue Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Issue Description:</td>
	<td><strong>'.$_REQUEST['issue_desc'].'</strong></td>
</tr>
<tr>
	<td valign="top">Issue Notes:</td>
	<td><strong>'.iif($_REQUEST['issue_note'] == "", "None Entered", $_REQUEST['issue_note']).'</strong></td>
</tr>
	';
}
$message .= '
<tr>
	<td colspan="2"><br><strong>Requester Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Requester Name:</td>
	<td><strong>'.$_REQUEST['requester_name'].'</strong></td>
</tr>
<tr>
	<td>Requester Phone Number:</td>
	<td><strong>'.$_REQUEST['requester_phone'].'</strong></td>
</tr>
<tr>
	<td>Requester Email Address:</td>
	<td><strong>'.$_REQUEST['requester_email'].'</strong></td>
</tr>
<tr>
	<td valign="top">Additional Information:</td>
	<td><strong>'.iif($_REQUEST['note'] == "", "None Entered", $_REQUEST['note']).'</strong></td>
</tr>
<tr>
	<td colspan="2"><br><hr width="100%" size="2" color="#000000" noshade>If you have any questions or if any of the above information is incorrect, please contact Vision Wireless Customer Support toll-free at <strong>877.351.1658</strong> or via email at <a href="mailto:sprint.support@wiresupport.com" style="text-decoration:underline;"><strong>sprint.support@wiresupport.com</strong></a>.<br><br></td>
</tr>
<tr>
	<td valign="top">Thank You,<br>Vision Wireless</td>
	<td align="right"><img src="http://www.wiresupport.com/images/VisionLogo200.gif" alt="Vision Wireless Logo" width="200" height="40" border="0"></td>
</tr>
</table>
';
//echo $message;
// send email
mail($to, $subject, $message, $headers);

// build request email and send it
$to = "sprint.support@contactsprint.com";
//$to = "jeff@nr.net";
$subject = "Sprint-Nextel ".$request_type." Request from ".$_REQUEST['requester_name'];
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= 'Bcc: jeff@nr.net' . "\r\n";
$headers .= "From: ".$_REQUEST['requester_name']." <".$_REQUEST['requester_email'].">\r\n";
$message = '
<table width="700" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif; font-size:12;">
<tr>
	<td width="200">Request Type:</td>
	<td width="500"><strong>'.$request_type.'</strong></td>
</tr>
<tr>
	<td>Request Timestamp:</td>
	<td><strong>'.date('m/d/y \a\t h:i A', strtotime("-2 hours")).', Pacific Time</strong></td>
</tr>
<tr>
	<td>Requester IP Address:</td>
	<td><strong>'.getenv('REMOTE_ADDR').'</strong></td>
</tr>
<tr>
	<td>Requested Via:</td>
	<td><strong>'.$_SESSION['site'].'.wiresupport.com</strong></td>
</tr>
';
if ($_REQUEST['request_type'] != "rma"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User First Name:</td>
	<td><strong>'.$_REQUEST['first_name'].'</strong></td>
</tr>
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User First Name:</td>
	<td><strong>'.$_REQUEST['last_name'].'</strong></td>
</tr>
	';
	if ($_REQUEST['request_type'] == "user" || $_REQUEST['request_type'] == "transfer"){
		$message .= '
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User Employee ID:</td>
	<td><strong>'.$_REQUEST['employee_id'].'</strong></td>
</tr>
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User Cost Center:</td>
	<td><strong>'.$_REQUEST['cost_center'].'</strong></td>
</tr>
		';
	}
	$message .= '
<tr>
	<td>'.iif($_REQUEST['request_type'] == "user", "New ", "").'User Email Address:</td>
	<td><strong>'.$_REQUEST['user_email'].'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] != "transfer"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>Device Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
	';
	if ($_REQUEST['request_type'] == "plan" || $_REQUEST['request_type'] == "swap" || $_REQUEST['request_type'] == "rma"){
		$message .= '
<tr>
	<td>Device Manufacturer:</td>
	<td><strong>'.$_REQUEST['device_manuf'].'</strong></td>
</tr>
<tr>
	<td>Device Model:</td>
	<td><strong>'.$_REQUEST['device_model'].'</strong></td>
</tr>
		';
		if ($_REQUEST['request_type'] == "swap"){
			$message .= '
<tr>
	<td>Device ESN:</td>
	<td><strong>'.$_REQUEST['esn'].'</strong></td>
</tr>
			';
		}
	}
	$message .= '
<tr>
	<td>'.iif($_REQUEST['request_type'] == "number", "Current ", "").'Wireless Number:</td>
	<td><strong>'.$_REQUEST['current_num'].'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "plan" || $_REQUEST['request_type'] == "swap"){
	if ($_REQUEST['change_voice_plan'] == "T"){
		$ChangePlan = "Yes";
	}else{
		$ChangePlan = "No";
	}
	$message .= '
<tr>
	<td colspan="2"><br><strong>Plan Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Change Calling Plan:</td>
	<td><strong>'.$ChangePlan.'</strong></td>
</tr>
<tr>
	<td>New Calling Plan:</td>
	<td><strong>'.iif($_REQUEST['new_voice_plan'] == "", "No Change", $_REQUEST['new_voice_plan']).'</strong></td>
</tr>
<tr>
	<td>Vision Plan:</td>
	<td><strong>'.$_REQUEST['vision_plan'].'</strong></td>
</tr>
<tr>
	<td>BlackBerry:</td>
	<td><strong>'.$_REQUEST['blackberry_plan'].'</strong></td>
</tr>
<tr>
	<td>Text Messaging Plan:</td>
	<td><strong>'.$_REQUEST['text_plan'].'</strong></td>
</tr>
<tr>
	<td valign="top">Option(s):</td>
	<td><strong>'.rtrim($options,',').'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "number"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>New Phone Number Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Primary Place of Use Area Code:</td>
	<td><strong>'.$_REQUEST['new_areacode'].'</strong></td>
</tr>
<tr>
	<td valign="top">Primary Place of Use Address:</td>
	<td><strong>'.$_REQUEST['new_address1'].''.iif($_REQUEST['new_address2'] != "", "<br>".$_REQUEST['new_address2'], "").'</strong></td>
</tr>
<tr>
	<td>Primary Place of Use City:</td>
	<td><strong>'.$_REQUEST['new_city'].'</strong></td>
</tr>
<tr>
	<td>Primary Place of Use State:</td>
	<td><strong>'.$_REQUEST['new_state'].'</strong></td>
</tr>
<tr>
	<td>Primary Place of Use Zip Code:</td>
	<td><strong>'.$_REQUEST['new_zipcode'].'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "transfer"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>Account Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Phone Number to Transfer:</td>
	<td><strong>'.$_REQUEST['current_num'].'</strong></td>
</tr>
<tr>
	<td>Name as it Appears on Bill:</td>
	<td><strong>'.$_REQUEST['bill_name'].'</strong></td>
</tr>
<tr>
	<td valign="top">Billing Address:</td>
	<td><strong>'.$_REQUEST['bill_address1'].''.iif($_REQUEST['bill_address2'] != "", "<br>".$_REQUEST['bill_address2'], "").'</strong></td>
</tr>
<tr>
	<td>Billing City:</td>
	<td><strong>'.$_REQUEST['bill_city'].'</strong></td>
</tr>
<tr>
	<td>Billing State:</td>
	<td><strong>'.$_REQUEST['bill_state'].'</strong></td>
</tr>
<tr>
	<td>Billing Zip Code:</td>
	<td><strong>'.$_REQUEST['bill_zipcode'].'</strong></td>
</tr>
<tr>
	<td>Account Number:</td>
	<td><strong>'.$_REQUEST['acct_num'].'</strong></td>
</tr>
<tr>
	<td>Account Password:</td>
	<td><strong>'.iif($_REQUEST['acct_pass'] == "", "Not Provided", $_REQUEST['acct_pass']).'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "stop"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>Reason</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td valign="top">Reason For Stopping Service:</td>
	<td><strong>'.$_REQUEST['stop_reason'].'</strong></td>
</tr>
	';
}
if ($_REQUEST['request_type'] == "rma"){
	$message .= '
<tr>
	<td colspan="2"><br><strong>Issue Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Issue Description:</td>
	<td><strong>'.$_REQUEST['issue_desc'].'</strong></td>
</tr>
<tr>
	<td valign="top">Issue Notes:</td>
	<td><strong>'.iif($_REQUEST['issue_note'] == "", "None Entered", $_REQUEST['issue_note']).'</strong></td>
</tr>
	';
}
$message .= '
<tr>
	<td colspan="2"><br><strong>Requester Information</strong><br><hr width="100%" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td>Requester Name:</td>
	<td><strong>'.$_REQUEST['requester_name'].'</strong></td>
</tr>
<tr>
	<td>Requester Phone Number:</td>
	<td><strong>'.$_REQUEST['requester_phone'].'</strong></td>
</tr>
<tr>
	<td>Requester Email Address:</td>
	<td><strong>'.$_REQUEST['requester_email'].'</strong></td>
</tr>
<tr>
	<td valign="top">Additional Information:</td>
	<td><strong>'.iif($_REQUEST['note'] == "", "None Entered", $_REQUEST['note']).'</strong></td>
</tr>
</table>
';
//echo $message;
// send email
mail($to, $subject, $message, $headers);

// now, finally, display "thank you" message
?>

<table width="920" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Thank You</strong></td>
	<td><img src="images/spacer.gif" alt="" width="721" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="920" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="0" height="400" border="0"></td>
			<td align="center" valign="top" class="bodyBlack">
				<br><br><br><br>
				<span class="xbigBlack">Thank You</span><br>
				<span class="bigBlack">Your request has been submitted and is being forwarded to Customer Support.</span><br><br>
				A copy of your request has been emailed to the Requester Email Address you provided.<br>
				You may make additional requests by selecting from the menu above.
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="920" height="5" border="0"></td>
</tr>
</table>

<!-- END Include thankyou.php -->

