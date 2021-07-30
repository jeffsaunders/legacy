<?
//if (!$_REQUEST['sid']){
//	session_start();
//	// Test for session id; if none or mismatch they deep-linked, force them to start from scratch
//	if (!$_SESSION['SID']){ echo'<script>window.location="/?sec=home";</script>'; exit;}
//	// Good, there is a cookie - assign it's value to a variable for easy work
//	$SID = $_SESSION['SID'];
//}else{
//	$SID = $_REQUEST['sid'];
//};

// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
//$anchor = $_REQUEST['anchor'];
$message = $_REQUEST['message'];
//$cargo = $_REQUEST['cargo'];
//echo "<script>alert(".$_REQUEST['task'].");</script>";
$task = $_REQUEST['task'];

// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
}

// Connect to the database
include "dbconnect.php";

// Open a ticket
function openTicket(){
	include "dbconnect.php";
	session_start(); 
	$_SESSION['SID'] = session_id();
	$query =
		"INSERT INTO tickets (
		session_id,
		openned_by,
		openned_for,
		open_time,
		ipaddress,
		ticket_type,
		ticket_status,
		approved,
		approved_by)
		VALUES (
		'".$_SESSION['SID']."',
		'".$_SESSION['user']."',
		'".$_REQUEST['requester_name']."',
		DATE_SUB(NOW(), INTERVAL 2 HOUR),
		'".getenv('REMOTE_ADDR')."',
		'".$_REQUEST['port_type']."',
		'open',
		'".iif($_SESSION['user_level']=='User', 'F', 'T')."',
		'".iif($_SESSION['user_level']=='User', '', 'Requester')."')";
//echo $query.'<br></br>';
	$rs_openticket = mysql_query($query, $linkID);
	if ($rs_openticket){
		$query =
			"SELECT LAST_INSERT_ID() AS ticket_num";
		$rs_getticket = mysql_query($query, $linkID);
		$ticket = mysql_fetch_assoc($rs_getticket);
		return $ticket["ticket_num"];
	}
}

// Now, what to do...what to do?
switch($_REQUEST['task']){

case "login":	// Log in to the system
	$query = "SELECT * FROM users WHERE username = '".$_REQUEST['username']."' AND password = '".$_REQUEST['password']."'";
	$rs_login = mysql_query($query, $linkID);
	if (mysql_num_rows($rs_login) == 0){
		$message = "Incorrect Credentials %26mdash; Please Try Again.<br><br>";
		header("Location: index.php?sec=login&message=$message");
		exit;
	}else{
		$row = mysql_fetch_assoc($rs_login);
		// SET COOKIE TO REMEMBER USERNAME & PASSWORD IF $_REQUEST['remember'] == "on" 
		session_start(); 
		$_SESSION['user'] = $row['first_name']." ".$row['last_name'];
		$_SESSION['user_level'] = $row['user_level'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['password'] = $row['password'];
		if ($_REQUEST['remember'] == "T"){
			header("Location: index.php?sec=home&cookie=yes");
		}elseif ($_REQUEST['forget'] == "T"){
			header("Location: index.php?sec=home&cookie=no");
		}else{
			header("Location: index.php?sec=home");
		}
		exit;
	}
	break;

// PORTING
case "add_port":	// Add a new port ticket
//	session_start(); 
//	$_SESSION['SID'] = session_id();
	// Open a ticket
	$ticket_num = openTicket();
	// now write the transfer record
	$query =
		"INSERT INTO transfers (
		ticket_num,
		port_type,
		device,
		imei,
		sim_icc,
		first_name,
		last_name,
		employee_id,
		cost_center,
		user_email,
		port_num,
		acct_type,
		port_from,
		bill_name,
		bill_address1,
		bill_address2,
		bill_city,
		bill_state,
		bill_zipcode,
		from_acct_num,
		from_acct_pass,
		tax_id,
		requester_name,
		requester_phone,
		requester_email)
		VALUES (
		'".$ticket_num."',
		'".$_REQUEST['port_type']."',
		'".$_REQUEST['device_manufacturer']." ".$_REQUEST['device_model']."',
		'".$_REQUEST['imei']."',
		'".$_REQUEST['sim_icc']."',
		'".$_REQUEST['first_name']."',
		'".$_REQUEST['last_name']."',
		'".$_REQUEST['employee_id']."',
		'".$_REQUEST['cost_center']."',
		'".$_REQUEST['user_email']."',
		'".$_REQUEST['port_num']."',
		'".$_REQUEST['acct_type']."',
		'".$_REQUEST['port_from']."',
		'".$_REQUEST['bill_name']."',
		'".$_REQUEST['bill_address1']."',
		'".$_REQUEST['bill_address2']."',
		'".$_REQUEST['bill_city']."',
		'".$_REQUEST['bill_state']."',
		'".$_REQUEST['bill_zipcode']."',
		'".$_REQUEST['from_acct_num']."',
		'".$_REQUEST['from_acct_pass']."',
		'".$_REQUEST['tax_id']."',
		'".$_REQUEST['requester_name']."',
		'".$_REQUEST['requester_phone']."',
		'".$_REQUEST['requester_email']."')";
//echo $query.'<br></br>';
	$rs_addport = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Port Request Submitted';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$dest = $_REQUEST['change_type'];
	header("Location: $uri/?sec=port&task=$dest&status=$status");
	break;

// CHANGES
case "add_change": // Add a change ticket
//	session_start(); 
//	$_SESSION['SID'] = session_id();
	// Open a ticket
	$ticket_num = openTicket();
	// now write the transfer record
	$query =
		"INSERT INTO changes (
		ticket_num,
		change_type,
		first_name,
		last_name,
		employee_id,
		cost_center,
		user_email,
		device,
		current_num,
		imei,
		change_plan,
		new_plan,
		world_traveler,
		world_connect,
		blackberry_data,
		blackberry_intl,
		sim_icc,
		new_sim_icc,
		new_areacode,
		new_address1,
		new_address2,
		new_city,
		new_state,
		new_zipcode,
		new_username,
		note,
		requester_name,
		requester_phone,
		requester_email)
		VALUES (
		'".$ticket_num."',
		'".$_REQUEST['change_type']."',
		'".$_REQUEST['first_name']."',
		'".$_REQUEST['last_name']."',
		'".$_REQUEST['employee_id']."',
		'".$_REQUEST['cost_center']."',
		'".$_REQUEST['user_email']."',
		'".$_REQUEST['device_manufacturer']." ".$_REQUEST['device_model']."',
		'".$_REQUEST['current_num']."',
		'".$_REQUEST['imei']."',
		'".$_REQUEST['change_plan']."',
		'".$_REQUEST['new_plan']."',
		'".$_REQUEST['world_traveler']."',
		'".$_REQUEST['world_connect']."',
		'".$_REQUEST['blackberry_data']."',
		'".$_REQUEST['blackberry_intl']."',
		'".$_REQUEST['sim_icc']."',
		'".$_REQUEST['new_sim_icc']."',
		'".$_REQUEST['new_areacode']."',
		'".$_REQUEST['new_address1']."',
		'".$_REQUEST['new_address2']."',
		'".$_REQUEST['new_city']."',
		'".$_REQUEST['new_state']."',
		'".$_REQUEST['new_zipcode']."',
		'".$_REQUEST['new_username']."',
		'".$_REQUEST['note']."',
		'".$_REQUEST['requester_name']."',
		'".$_REQUEST['requester_phone']."',
		'".$_REQUEST['requester_email']."')";
//echo $query.'<br></br>';
	$rs_addchange = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Change Request Submitted';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$dest = $_REQUEST['change_type'];
	header("Location: $uri/?sec=change&task=$dest&status=$status");
	break;

// SERVICE REQUESTS
case "add_request": // Add a change ticket
//	session_start(); 
//	$_SESSION['SID'] = session_id();
	// Open a ticket
	$ticket_num = openTicket();
	// now write the transfer record
	$query =
		"INSERT INTO requests (
		ticket_num,
		request_type,
		device,
		imei,
		sim_icc,
		phone_num,
		first_name,
		last_name,
		employee_id,
		cost_center,
		user_email,
		carrier_from,
		carrier_to,
		quantity,
		change_plan,
		new_plan,
		world_traveler,
		world_connect,
		blackberry_data,
		blackberry_intl,
		req_areacode,
		ship_name,
		ship_address1,
		ship_address2,
		ship_city,
		ship_state,
		ship_zipcode,
		issue_desc,
		note,
		requester_name,
		requester_phone,
		requester_email)
		VALUES (
		'".$ticket_num."',
		'".$_REQUEST['request_type']."',
		'".$_REQUEST['device_manufacturer']." ".$_REQUEST['device_model']."',
		'".$_REQUEST['imei']."',
		'".$_REQUEST['sim_icc']."',
		'".$_REQUEST['phone_num']."',
		'".$_REQUEST['first_name']."',
		'".$_REQUEST['last_name']."',
		'".$_REQUEST['employee_id']."',
		'".$_REQUEST['cost_center']."',
		'".$_REQUEST['user_email']."',
		'".$_REQUEST['carrier_from']."',
		'".$_REQUEST['carrier_to']."',
		'".$_REQUEST['quantity']."',
		'".$_REQUEST['change_plan']."',
		'".$_REQUEST['new_plan']."',
		'".$_REQUEST['world_traveler']."',
		'".$_REQUEST['world_connect']."',
		'".$_REQUEST['blackberry_data']."',
		'".$_REQUEST['blackberry_intl']."',
		'".$_REQUEST['req_areacode']."',
		'".$_REQUEST['ship_name']."',
		'".$_REQUEST['ship_address1']."',
		'".$_REQUEST['ship_address2']."',
		'".$_REQUEST['ship_city']."',
		'".$_REQUEST['ship_state']."',
		'".$_REQUEST['ship_zipcode']."',
		'".$_REQUEST['issue_desc']."',
		'".$_REQUEST['note']."',
		'".$_REQUEST['requester_name']."',
		'".$_REQUEST['requester_phone']."',
		'".$_REQUEST['requester_email']."')";
//echo $query.'<br></br>';
	$rs_addrequest = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Request Submitted';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$dest = $_REQUEST['request_type'];
	header("Location: $uri/?sec=service&task=$dest&status=$status");
	break;


// SITE NOTES
case "edit_welcome":	// Update the site welcome message
	session_start(); 
	$_SESSION['SID'] = session_id();
	$query =
		"UPDATE site_notes SET
		title = '".$_REQUEST['title']."',
		note = '".$_REQUEST['note']."',
		note_by = '".$_SESSION['user']."',
		note_time = DATE_SUB(NOW(), INTERVAL 2 HOUR)
		WHERE type = 'welcome'";
//echo $query.'<br></br>';
	$rs_update_welcome = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Welcome Message Updated';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: $uri/?sec=news&task=edit_welcome&status=$status");
	break;

case "add_note":	// Add a site note
	session_start(); 
	$_SESSION['SID'] = session_id();
	$note_date = explode('/', $_REQUEST['note_date']);
	$start_date = explode('/', $_REQUEST['start_date']);
	$end_date = explode('/', $_REQUEST['end_date']);
	$query =
		"INSERT INTO site_notes (
		title,
		note,
		note_date,
		start_date,
		end_date,
		show_user,
		show_asst,
		show_admin,
		note_by,
		note_time)
		VALUES (
		'".$_REQUEST['title']."',
		'".$_REQUEST['note']."',
		".iif($_REQUEST['note_date'] == '', NULL, '\''.$note_date[2].'-'.$note_date[0].'-'.$note_date[1].'\'').",
		".iif($_REQUEST['start_date'] == '', NULL, '\''.$start_date[2].'-'.$start_date[0].'-'.$start_date[1].'\'').",
		".iif($_REQUEST['end_date'] == '', 'NULL', '\''.$end_date[2].'-'.$end_date[0].'-'.$end_date[1].'\'').",
		'".iif($_REQUEST['show_user'] == 'T', 'T', 'F')."',
		'".iif($_REQUEST['show_asst'] == 'T', 'T', 'F')."',
		'".iif($_REQUEST['show_admin'] == 'T', 'T', 'F')."',
		'".$_SESSION['user']."',
		DATE_SUB(NOW(), INTERVAL 2 HOUR)
		)";
//echo $query.'<br></br>';
	$rs_add_note = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Site Note Added';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: $uri/?sec=news&task=add_note&status=$status");
	break;

case "edit_note":	// Update an existing site note
	session_start(); 
	$_SESSION['SID'] = session_id();
	$note_date = explode('/', $_REQUEST['note_date']);
	$start_date = explode('/', $_REQUEST['start_date']);
	$end_date = explode('/', $_REQUEST['end_date']);
	$query =
		"UPDATE site_notes SET
		title = '".$_REQUEST['title']."',
		note = '".$_REQUEST['note']."',
		note_date = ".iif($_REQUEST['note_date'] == '', 'NULL', '\''.$note_date[2].'-'.$note_date[0].'-'.$note_date[1].'\'').",
		start_date = ".iif($_REQUEST['start_date'] == '', 'NULL', '\''.$start_date[2].'-'.$start_date[0].'-'.$start_date[1].'\'').",
		end_date = ".iif($_REQUEST['end_date'] == '', 'NULL', '\''.$end_date[2].'-'.$end_date[0].'-'.$end_date[1].'\'').",
		show_user = '".iif($_REQUEST['show_user'] == 'T', 'T', 'F')."',
		show_asst = '".iif($_REQUEST['show_asst'] == 'T', 'T', 'F')."',
		show_admin = '".iif($_REQUEST['show_admin'] == 'T', 'T', 'F')."',
		note_by = '".$_SESSION['user']."',
		note_time = DATE_SUB(NOW(), INTERVAL 2 HOUR)
		WHERE unique_id = '".$_REQUEST['unique_id']."'";
//echo $query.'<br></br>';
	$rs_update_note = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Site Note Updated';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: $uri/?sec=news&task=edit_note&cargo=".$_REQUEST['unique_id']."&status=$status");
	break;

case "del_note":	// Delete an existing site note (actually just set "display" to false)
	session_start(); 
	$_SESSION['SID'] = session_id();
	$query =
		"UPDATE site_notes SET
		display = 'F'
		WHERE unique_id = '".$_REQUEST['unique_id']."'";
//echo $query.'<br></br>';
	$rs_update_note = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Site Note Deleted';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: $uri/?sec=news&status=$status");
	break;


// SITE USERS
case "add_user":	// Add a site user
	session_start(); 
	$_SESSION['SID'] = session_id();
	$query =
		"INSERT INTO users (
		user_id,
		user_level,
		username,
		password,
		first_name,
		last_name,
		phone_num)
		VALUES (
		'".$_REQUEST['user_id']."',
		'".$_REQUEST['user_level']."',
		'".$_REQUEST['username']."',
		'".$_REQUEST['password']."',
		'".$_REQUEST['first_name']."',
		'".$_REQUEST['last_name']."',
		'".$_REQUEST['phone_num']."'
		)";
//echo $query.'<br></br>';
	$rs_add_user = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Site User Added';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: $uri/?sec=manage&task=add_user&status=$status");
	break;

case "edit_user":  // Update the site welcome message
	session_start(); 
	$_SESSION['SID'] = session_id();
	$query =
		"UPDATE users SET
		user_id = '".$_REQUEST['user_id']."',
		user_level = '".$_REQUEST['user_level']."',
		username = '".$_REQUEST['username']."',
		password = '".$_REQUEST['password']."',
		first_name = '".$_REQUEST['first_name']."',
		last_name = '".$_REQUEST['last_name']."',
		phone_num = '".$_REQUEST['phone_num']."'
		WHERE username = '".$_REQUEST['username']."'";
//echo $query.'<br></br>';
	$rs_update_user = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'User Updated';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: $uri/?sec=manage&task=edit_user&cargo=".$_REQUEST['username']."&status=$status");
	break;

case "del_user":	// Delete an existing user
	session_start(); 
	$_SESSION['SID'] = session_id();
	$query =
		"DELETE from users
		WHERE username = '".$_REQUEST['username']."'";
//echo $query.'<br></br>';
	$rs_update_note = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Site User Deleted';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: $uri/?sec=manage&task=list_users&status=$status");
	break;


// DEVICES
case "add_device":	// Add a device
	session_start(); 
	$_SESSION['SID'] = session_id();
	$query =
		"INSERT INTO devices (
		manufacturer,
		model,
		available)
		VALUES (
		'".iif($_REQUEST['manufacturer'] == "other", $_REQUEST['manufacturer_other'], $_REQUEST['manufacturer'])."',
		'".$_REQUEST['model']."',
		'".$_REQUEST['available']."'
		)";
//echo $query.'<br></br>';
	$rs_add_device = mysql_query($query, $linkID);
	// Tell 'em what you did
	$status = 'Device Added';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: $uri/?sec=manage&task=add_device&status=$status");
	break;

case "edit_device":  // Update the device list
	session_start(); 
	$_SESSION['SID'] = session_id();
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		if ($_REQUEST['delete'.$counter] == "T"){
			$query =
				"DELETE from devices
				WHERE unique_id = '".$_REQUEST['unique_id'.$counter]."'";
		}else{
			$query =
				"UPDATE devices SET
				manufacturer = '".$_REQUEST['manufacturer'.$counter]."',
				model = '".$_REQUEST['model'.$counter]."',
				available = '".$_REQUEST['available'.$counter]."'
				WHERE unique_id = '".$_REQUEST['unique_id'.$counter]."'";
		}
//echo $query.'<br></br>';
		$rs_update_devices = mysql_query($query, $linkID);
	}
	// Tell 'em what you did
	$status = 'Devices Updated';
	// Send 'em back
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("Location: $uri/?sec=manage&task=edit_devices&status=$status");
	break;

}; // End Switch
