<?
//echo '<script>alert("Boo!");</script>';
// Connect to the database
include "dbconnect.php";
// Set location for session cookies
//session_save_path("/var/www/html/deviceport.com/tmp");
session_save_path("/var/www/nr.net/tmp");

// Lookup username & password if they are logging in
if ($_REQUEST['task'] == "login"){
	$query = "SELECT * FROM passwords WHERE site = '".$_REQUEST['site']."' AND username = '".$_REQUEST['username']."' AND password = '".$_REQUEST['password']."'";
	$rs_password = mysql_query($query, $linkID);
	// Start session
	session_start();
	if (mysql_num_rows($rs_password) > 0){ //Passed
		$_SESSION['passed'] = "true";
	}else{
		$_SESSION['passed'] = "false"; //Failed
	}
	if ($_REQUEST['sec'] != ""){ // If there was an sec value on the submitting page, go back there
		header("Location: /?sec=".$_REQUEST['sec']);
	}else{
		header("Location: /"); // ...otherwise go home
	}
}	

// Test for a passed session id
if (!$_REQUEST['sid']){
	session_start();
	// Test for session id; if none or mismatch they deep-linked, force them to start from scratch
	if (!$_SESSION['SID']){ echo'<script>window.location="/?sec=home";</script>'; exit;}
	// Good, there is a cookie - assign it's value to a variable for easy work
	$SID = $_SESSION['SID'];
}else{
	$SID = $_REQUEST['sid'];
};
//echo $SID;

// Grab the URI so we know which domain we are using
$uri = explode("/",$_SERVER['REQUEST_URI']);

// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$anchor = $_REQUEST['anchor'];
$message = $_REQUEST['message'];
$cargo = $_REQUEST['cargo'];
$task = $_REQUEST['task'];
$site = $_REQUEST['site'];

//Grab existing cart info, if it exists
$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
$rs_order = mysql_query($query, $linkID);
$order = mysql_fetch_assoc($rs_order);

// Now, what to do...what to do?
switch($_REQUEST['task']){

case "openorder":	// Put initial order info in the cart
	$query =
		"INSERT INTO orders (
		session_id,
		order_num,
		ipaddress,
		carrier,
		affiliation,
		change_plan,
		add_line,
		acct_type,
		device_count,
		plan_discount,
		creation_time)
		VALUES (
		'".$SID."',
		UNIX_TIMESTAMP(),
		'".getenv('REMOTE_ADDR')."',
		'".$_REQUEST['Carrier']."',
		'".$_REQUEST['Affiliation']."',
		'".$_REQUEST['ChangePlan']."',
		'".$_REQUEST['AddLine']."',
		'".$_REQUEST['AcctType']."',
		".$_REQUEST['DeviceCount'].",
		'".$_REQUEST['Discount']."',
		NOW())";
//echo $query.'<br></br>';
	$rs_insert = mysql_query($query, $linkID);
	// Go somewhere
	header("Location: /?sec=activate&step=select&site=".$site."&sid=$SID");
	exit;

case "changeplan":	// Customer only changing plan
	$query =
		"INSERT INTO orders (
		session_id,
		order_num,
		ipaddress,
		carrier,
		affiliation,
		change_plan,
		device_count,
		creation_time)
		VALUES (
		'".$SID."',
		UNIX_TIMESTAMP(),
		'".getenv('REMOTE_ADDR')."',
		'".$_REQUEST['Carrier']."',
		'".$_REQUEST['Affiliation']."',
		'".$_REQUEST['ChangePlan']."',
		".$_REQUEST['DeviceCount'].",
		NOW())";
//echo $query.'<br></br>';
	$rs_insert = mysql_query($query, $linkID);
	// Go somewhere
	header("Location: /?sec=activate&step=select&site=".$site."&sid=$SID");
	exit;

case "upload": // Parse uploaded spreadsheet and feed the beast
	// First, open a new order since we are bypassing that step by uploading
	$query =
		"INSERT INTO orders (
		session_id,
		order_num,
		ipaddress,
		carrier,
		affiliation,
		change_plan,
		add_line,
		acct_type,
		device_count,
		plan_discount,
		creation_time)
		VALUES (
		'".$SID."',
		UNIX_TIMESTAMP(),
		'".getenv('REMOTE_ADDR')."',
		'".$_REQUEST['Carrier']."',
		'".$_REQUEST['Affiliation']."',
		'".$_REQUEST['ChangePlan']."',
		'".$_REQUEST['AddLine']."',
		'".$_REQUEST['AcctType']."',
		0,
		'".$_REQUEST['Discount']."',
		NOW())";
//echo $query.'<br></br>';
	$rs_insert = mysql_query($query, $linkID);

	// Now process the uploaded spreadsheet
	// Pull the name apart
	$tmp_name = $_GET['tmp_name'];
	$upload = $_REQUEST['file'];
	$fullname = $upload['name'][0];
	$splitstring = split("\\\\",$fullname);
	$cnt = count($splitstring)-1;
	$filename = $splitstring[$cnt];
//	$uploadedname = $filename;
	$splitfilename = explode('.', $filename);
	$tempfilename = $SID .'.' .$splitfilename[1];
//echo $fullname."<br>";
//echo $filename."<br>";
//echo $_GET['tmp_name']."<br>";
//echo $tmp_name['name'][0]."<br>";
	// Move the uploaded file to a temporary holding place, naming it as the session id with the same file extention as the uploaded file
	$destfullpath = '/var/www/html/deviceport.com/httpdocs/tmp/'. $SID .'.' .$splitfilename[1];
	rename($tmp_name['name'][0], $destfullpath);

	// Open the spreadsheet and pull it apart
	require_once 'include/reader.php';

	$reader = new Spreadsheet_Excel_Reader();
	$reader->setOutputEncoding("UTF-8");

//echo $destfullpath."<br>";
	$reader->read($destfullpath);

	// Stuff values into an array
	for ($r = 1; $r <= $reader->sheets[0]["numRows"]; $r++){
		for ($c = 1; $c <= $reader->sheets[0]["numCols"]; $c++){
			$row[$r][$c] = $reader->sheets[0]["cells"][$r][$c];
		}
	}
//print_r($row);

	// Loop through the array and pull out the "good" records (skip first record - it's the column headers)
	$device_count = 0;
	for ($r = 2; $r <= count($row); $r++){
		// Test for an empty record
		$v = "";
		for ($c = 1; $c <= count($row[$r]); $c++){
			// Concatonate the elements together
			$v .= $row[$r][$c];
		}
//echo $v."<br>";
		// Is the concatonated string empty?  if not, write the values to a new device record
		if (!empty($v)){
//print_r($row[$r]);
//echo "<br>";
			// Array Schema - Array([1]=>ESN [2]=>SIM/ICCID [3]=>IMEI [4]=>Data Plan ID [5]=>Area Code [6]=>Username [7]=>Voice Plan ID)
			// Look up the plan info
			$query = "SELECT * FROM plans WHERE plan_id='".$row[$r][4]."'";
			$rs_dataplan = mysql_query($query, $linkID);
//echo $query.'<br></br>';
			$query = "SELECT * FROM plans WHERE plan_id='".$row[$r][7]."'";
//echo $query.'<br></br>';
			$rs_voiceplan = mysql_query($query, $linkID);
			$data = mysql_fetch_assoc($rs_dataplan);
			$voice = mysql_fetch_assoc($rs_voiceplan);
			// Figure out if we need to ship a SIM
			$ship_sim = "No";
			if (!empty($row[$r][3])){ //IMEI not blank
				if (empty($row[$r][2])){ //SIM blank
					$ship_sim = "Yes";
				}
			}
			// Now add the device
			$query =
				"INSERT INTO devices (
				session_id,
				esn,
				iccid,
				imei,
				ship_sim_card,
				plan_id,
				plan_name,
				plan_quantity,
				plan_cost,
				voice_plan_id,
				voice_plan_name,
				voice_plan_quantity,
				voice_plan_cost,
				request_areacode,
				user,
				device_time)
				VALUES (
				'".$SID."',
				'".$row[$r][1]."',
				'".$row[$r][2]."',
				'".$row[$r][3]."',
				'".$ship_sim."',
				'".$row[$r][4]."',
				'".$data['plan_name']."',
				'".$data['quantity']."',
				'".$data['cost']."',
				'".$row[$r][7]."',
				'".$voice['plan_name']."',
				'".$voice['quantity']."',
				'".$voice['cost']."',
				'".$row[$r][5]."',
				'".$row[$r][6]."',
				NOW())";
//echo $query.'<br></br>';
			$rs_insert = mysql_query($query, $linkID);
			$device_count++;
		}
	}

	// Update order device count with the number of rows uploaded
	$query =
		"UPDATE orders SET
		device_count = '".$device_count."'
		WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
	$rs_update = mysql_query($query, $linkID);

	// Clean up
	unlink($destfullpath);

	// Go somewhere
	header("Location: /?sec=activate&step=select&site=".$site."&sid=$SID");

	exit;

case "addmore": // Add more rows to the device form
	// If they want to add more devices, let 'em!
	if (($_REQUEST['AddQty'] + $order["device_count"]) != $order["device_count"]){ // Add more devices
		$query =
			"UPDATE orders SET
			device_count = '".($_REQUEST['AddQty'] + $order["device_count"])."'
			WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
		$locked = true;
		// Refresh account info
		$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
		$rs_order = mysql_query($query, $linkID);
		$order = mysql_fetch_assoc($rs_order);
	}
	// Go somewhere
	header("Location: /?sec=activate&step=select&site=".$site."&sid=$SID");
	exit;

case "adddevices":	// Add devices to the cart
	for ($counter=1; $counter <= $_REQUEST['DeviceCount']; $counter++){
		// Is this device already in the database?
		if ($_REQUEST['ESN'.$counter] != ""){ // Sprint or Verizon
			$query = "SELECT COUNT(*) AS quantity FROM devices WHERE esn = '".$_REQUEST['ESN'.$counter]."' AND session_id = '".$SID."'";
			$rs_esn = mysql_query($query, $linkID);
			$count = mysql_fetch_assoc($rs_esn);
			if ($count["quantity"] == 0){  // ESN not already there - insert it
				// Look up the plan info
				$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['PlanID'.$counter]."'";
				$rs_dataplan = mysql_query($query, $linkID);
//echo $query.'<br></br>';
				$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['VoicePlanID'.$counter]."'";
//echo $query.'<br></br>';
				$rs_voiceplan = mysql_query($query, $linkID);
				$data = mysql_fetch_assoc($rs_dataplan);
				$voice = mysql_fetch_assoc($rs_voiceplan);
				// Now add the device
				$query =
					"INSERT INTO devices (
					session_id,
					esn,
					iccid,
					imei,
					ship_sim_card,
					plan_id,
					plan_name,
					plan_quantity,
					plan_cost,
					voice_plan_id,
					voice_plan_name,
					voice_plan_quantity,
					voice_plan_cost,
					request_areacode,
					user,
					device_time)
					VALUES (
					'".$SID."',
					'".$_REQUEST['ESN'.$counter]."',
					'".$_REQUEST['ICCID'.$counter]."',
					'".$_REQUEST['IMEI'.$counter]."',
					'".$_REQUEST['ShipSIMCard'.$counter]."',
					'".$_REQUEST['PlanID'.$counter]."',
					'".$data['plan_name']."',
					'".$data['quantity']."',
					'".$data['cost']."',
					'".$_REQUEST['VoicePlanID'.$counter]."',
					'".$voice['plan_name']."',
					'".$voice['quantity']."',
					'".$voice['cost']."',
					'".$_REQUEST['RequestAreaCode'.$counter]."',
					'".$_REQUEST['User'.$counter]."',
					NOW())";
//echo $query.'<br></br>';
				$rs_insert = mysql_query($query, $linkID);
			}else{  // ESN is already there - update it
				// Look up the plan info
				$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['PlanID'.$counter]."'";
//echo $query.'<br></br>';
				$rs_dataplan = mysql_query($query, $linkID);
				$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['VoicePlanID'.$counter]."'";
//echo $query.'<br></br>';
				$rs_voiceplan = mysql_query($query, $linkID);
				$data = mysql_fetch_assoc($rs_dataplan);
				$voice = mysql_fetch_assoc($rs_voiceplan);
				// Now update the device
				$query =
					"UPDATE devices SET
					esn = '".$_REQUEST['ESN'.$counter]."',
					ship_sim_card = '".$_REQUEST['ShipSIMCard'.$counter]."',
					plan_id = '".$_REQUEST['PlanID'.$counter]."',
					plan_name = '".$data['plan_name']."',
					plan_quantity = '".$data['quantity']."',
					plan_cost = '".$data['cost']."',
					voice_plan_id = '".$_REQUEST['VoicePlanID'.$counter]."',
					voice_plan_name = '".$voice['plan_name']."',
					voice_plan_quantity = '".$voice['quantity']."',
					voice_plan_cost = '".$voice['cost']."',
					request_areacode = '".$_REQUEST['RequestAreaCode'.$counter]."',
					user = '".$_REQUEST['User'.$counter]."',
					device_time = NOW()
					WHERE session_id = '".$SID."' AND imei = '".$_REQUEST['IMEI'.$counter]."'";
//echo $query.'<br></br>';
				$rs_update = mysql_query($query, $linkID);
			}
		}
		// Is this device already in the database?
		if ($_REQUEST['IMEI'.$counter] != ""){  // AT&T
			$query = "SELECT COUNT(*) AS quantity FROM devices WHERE imei = '".$_REQUEST['IMEI'.$counter]."' AND session_id = '".$SID."'";
			$rs_imei = mysql_query($query, $linkID);
			$count = mysql_fetch_assoc($rs_imei);
			if ($count["quantity"] == 0){  // IMEI not already there - insert it
				// Look up the plan info
				$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['PlanID'.$counter]."'";
//echo $query.'<br></br>';
				$rs_dataplan = mysql_query($query, $linkID);
				$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['VoicePlanID'.$counter]."'";
//echo $query.'<br></br>';
				$rs_voiceplan = mysql_query($query, $linkID);
				$data = mysql_fetch_assoc($rs_dataplan);
				$voice = mysql_fetch_assoc($rs_voiceplan);
				// Now add the device
				$query =
					"INSERT INTO devices (
					session_id,
					esn,
					iccid,
					imei,
					ship_sim_card,
					plan_id,
					plan_name,
					plan_quantity,
					plan_cost,
					voice_plan_id,
					voice_plan_name,
					voice_plan_quantity,
					voice_plan_cost,
					request_areacode,
					user,
					device_time)
					VALUES (
					'".$SID."',
					'".$_REQUEST['ESN'.$counter]."',
					'".$_REQUEST['ICCID'.$counter]."',
					'".$_REQUEST['IMEI'.$counter]."',
					'".$_REQUEST['ShipSIMCard'.$counter]."',
					'".$_REQUEST['PlanID'.$counter]."',
					'".$data['plan_name']."',
					'".$data['quantity']."',
					'".$data['cost']."',
					'".$_REQUEST['VoicePlanID'.$counter]."',
					'".$voice['plan_name']."',
					'".$voice['quantity']."',
					'".$voice['cost']."',
					'".$_REQUEST['RequestAreaCode'.$counter]."',
					'".$_REQUEST['User'.$counter]."',
					NOW())";
//echo $query.'<br></br>';
				$rs_insert = mysql_query($query, $linkID);
			}else{  // IMEI is already there - update it
				// Look up the plan info
				$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['PlanID'.$counter]."'";
//echo $query.'<br></br>';
				$rs_dataplan = mysql_query($query, $linkID);
				$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['VoicePlanID'.$counter]."'";
//echo $query.'<br></br>';
				$rs_voiceplan = mysql_query($query, $linkID);
				$data = mysql_fetch_assoc($rs_dataplan);
				$voice = mysql_fetch_assoc($rs_voiceplan);
				// Now update the device
				$query =
					"UPDATE devices SET
					iccid = '".$_REQUEST['ICCID'.$counter]."',
					ship_sim_card = '".$_REQUEST['ShipSIMCard'.$counter]."',
					plan_id = '".$_REQUEST['PlanID'.$counter]."',
					plan_name = '".$data['plan_name']."',
					plan_quantity = '".$data['quantity']."',
					plan_cost = '".$data['cost']."',
					voice_plan_id = '".$_REQUEST['VoicePlanID'.$counter]."',
					voice_plan_name = '".$voice['plan_name']."',
					voice_plan_quantity = '".$voice['quantity']."',
					voice_plan_cost = '".$voice['cost']."',
					request_areacode = '".$_REQUEST['RequestAreaCode'.$counter]."',
					user = '".$_REQUEST['User'.$counter]."',
					device_time = NOW()
					WHERE session_id = '".$SID."' AND imei = '".$_REQUEST['IMEI'.$counter]."'";
//echo $query.'<br></br>';
				$rs_update = mysql_query($query, $linkID);
			}
		}
	}
	// Go somewhere
//	header("Location: https://secure.nr.net/deviceport/?sec=activate&step=account&site=".$site."&sid=$SID");
	header("Location: /?sec=activate&step=account&site=".$site."&sid=$SID");
	exit;

case "addchangeplan":	// Add plan changes to the cart
	for ($counter=1; $counter <= $_REQUEST['DeviceCount']; $counter++){
		// Is this device already in the database?
//		$query = "SELECT COUNT(*) AS quantity FROM devices WHERE existing_number = '".$_REQUEST['ExisingNumber'.$counter]."' AND session_id = '".$SID."'";
		$query = "SELECT COUNT(*) AS quantity FROM devices WHERE esn = '".$_REQUEST['ESN'.$counter]."' AND session_id = '".$SID."'";
		$rs_existing = mysql_query($query, $linkID);
		$count = mysql_fetch_assoc($rs_existing);
		if ($count["quantity"] == 0){  // ESN not already there - insert it
			// Look up the plan info
			$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['PlanID'.$counter]."'";
//echo $query.'<br></br>';
			$rs_plan = mysql_query($query, $linkID);
			$row = mysql_fetch_assoc($rs_plan);
			// Now add the device
			$query =
				"INSERT INTO devices (
				session_id,
				esn,
				plan_id,
				plan_name,
				plan_quantity,
				plan_cost,
				device_time)
				VALUES (
				'".$SID."',
				'".$_REQUEST['ESN'.$counter]."',
				'".$_REQUEST['PlanID'.$counter]."',
				'".$row['plan_name']."',
				'".$row['quantity']."',
				'".$row['cost']."',
				NOW())";
//echo $query.'<br></br>';
			$rs_insert = mysql_query($query, $linkID);
		}else{  // ESN is already there - update it
			// Look up the plan info
			$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['PlanID'.$counter]."'";
//echo $query.'<br></br>';
			$rs_plan = mysql_query($query, $linkID);
			$row = mysql_fetch_assoc($rs_plan);
			// Now update the device
			$query =
				"UPDATE devices SET
				esn = '".$_REQUEST['ESN'.$counter]."',
				plan_id = '".$_REQUEST['PlanID'.$counter]."',
				plan_name = '".$row['plan_name']."',
				plan_quantity = '".$row['quantity']."',
				plan_cost = '".$row['cost']."',
				device_time = NOW()
				WHERE session_id = '".$SID."' AND existing_number = '".$_REQUEST['ExistingNumber'.$counter]."'";
//echo $query.'<br></br>';
			$rs_update = mysql_query($query, $linkID);
		}
	}
	// Go somewhere
	header("Location: /?sec=activate&step=sendchange&site=".$site."&sid=$SID");
	exit;

case "removedevice": // Remove a device from the order
	if ($_REQUEST['esn'] != ""){ // Sprint or Verizon
		$query = "DELETE FROM devices WHERE session_id='".$SID."' AND esn = '".$_REQUEST['esn']."'";
	}elseif ($_REQUEST['iccid'] != ""){  // AT&T
		$query = "DELETE FROM devices WHERE session_id='".$SID."' AND iccid = '".$_REQUEST['iccid']."'";
	}
//echo $query;
	$rs_remove = mysql_query($query, $linkID);
	// Reload the order
	$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);
	// No more devices - dump order
	if (mysql_num_rows($rs_cart) == false){
		$query = "DELETE FROM orders WHERE session_id = '".$SID."'";
		$rs_empty = mysql_query($query, $linkID);
		$query = "DELETE FROM devices WHERE session_id = '".$SID."'";
		$rs_empty = mysql_query($query, $linkID);
		$locked = false;
		echo'<script>location.href="./";</script>'; // Using javascript eliminates "non-secure destination" warning in IE
	}
	// Go somewhere
//	header("Location: https://secure.nr.net/deviceport/?sec=activate&step=account&site=".$site."&sid=$SID");
	header("Location: /?sec=activate&step=account&site=".$site."&sid=$SID");
	exit;

case "restart":	// Dump everything and start over
	$query = "DELETE FROM orders WHERE session_id = '".$SID."'";
	$rs_empty = mysql_query($query, $linkID);
	$query = "DELETE FROM devices WHERE session_id = '".$SID."'";
	$rs_empty = mysql_query($query, $linkID);
	$locked = false;
	// Go somewhere
//	echo'<script>window.location="http://'.$site.'.deviceport.com/?sec=activate&step=select&site='.$site.'&sid='.$_REQUEST['sid'].'"</script>';
	echo'<script>window.location="http://'.$site.'.deviceport.nr.net/?sec=activate&step=select&site='.$site.'&sid='.$_REQUEST['sid'].'"</script>';
	exit;

case "updateorder":	// Add Account information to order
	// Build DL expiration date as one value
	if ($_REQUEST['dl_exp_month'] == ""){
		$dl_expiration = "";
	}else{
		$dl_expiration = $_REQUEST['dl_exp_month']."/".$_REQUEST['dl_exp_day']."/".$_REQUEST['dl_exp_year'];
	}
	$query =
		"UPDATE orders SET
		first_name = '".$_REQUEST['first_name']."',
		middle_name = '".$_REQUEST['middle_name']."',
		last_name = '".$_REQUEST['last_name']."',
		company_name = '".$_REQUEST['company_name']."',
		tax_id = '".$_REQUEST['tax_id']."',
		years_in_business = '".$_REQUEST['years_in_business']."',
		wireless_phone = '".$_REQUEST['wireless_phone']."',
		acct_number = '".$_REQUEST['acct_number']."',
		ship_address_1 = '".$_REQUEST['ship_address_1']."',
		ship_address_2 = '".$_REQUEST['ship_address_2']."',
		ship_city = '".$_REQUEST['ship_city']."',
		ship_state = '".$_REQUEST['ship_state']."',
		ship_zipcode = '".$_REQUEST['ship_zipcode']."',
		bill_address_1 = '".$_REQUEST['bill_address_1']."',
		bill_address_2 = '".$_REQUEST['bill_address_2']."',
		bill_city = '".$_REQUEST['bill_city']."',
		bill_state = '".$_REQUEST['bill_state']."',
		bill_zipcode = '".$_REQUEST['bill_zipcode']."',
		service_address_1 = '".$_REQUEST['service_address_1']."',
		service_address_2 = '".$_REQUEST['service_address_2']."',
		service_city = '".$_REQUEST['service_city']."',
		service_state = '".$_REQUEST['service_state']."',
		service_zipcode = '".$_REQUEST['service_zipcode']."',
		security_question = '".$_REQUEST['security_question']."',
		security_answer = '".$_REQUEST['security_answer']."',
		password = '".$_REQUEST['acct_password']."',
		billing_name = '".$_REQUEST['billing_name']."',
		billing_phone = '".$_REQUEST['billing_phone']."',
		billing_email = '".$_REQUEST['billing_email']."',
		contact_name = '".$_REQUEST['contact_name']."',
		contact_phone = '".$_REQUEST['contact_phone']."',
		contact_email = '".$_REQUEST['contact_email']."',
		order_placer_name = '".$_REQUEST['order_placer_name']."',
		order_placer_title = '".$_REQUEST['order_placer_title']."',
		order_placer_phone = '".$_REQUEST['order_placer_phone']."',
		order_placer_email = '".$_REQUEST['order_placer_email']."',
		maa_on_file = '".$_REQUEST['maa_on_file']."',
		home_phone = '".$_REQUEST['home_phone']."',
		alt_phone = '".$_REQUEST['alt_phone']."',
		email = '".$_REQUEST['email']."',
		ssn = '".$_REQUEST['ssn']."',
		dob = '".$_REQUEST['dob']."',
		dl_number = '".$_REQUEST['dl_number']."',
		dl_state = '".$_REQUEST['dl_state']."',
		dl_expiration = '".$dl_expiration."',
		sales_rep = '".$_REQUEST['sales_rep']."',
		shipping = '".$_REQUEST['shipping']."',
		notes = '".$_REQUEST['notes']."',
		info_time = NOW()
		WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
	$rs_update = mysql_query($query, $linkID);
	// Go somewhere
//	header("Location: https://secure.nr.net/deviceport/?sec=activate&step=confirm&site=".$site."&sid=$SID");
	header("Location: /?sec=activate&step=confirm&site=".$site."&sid=$SID");
	exit;

case "sendorder":	// Add terms confirmation to order
	$query =
		"UPDATE orders SET
		accept_terms_time = NOW()
		WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
	$rs_update = mysql_query($query, $linkID);

	// Send order to VWElite
	$query = "SELECT * FROM orders WHERE session_id = '".$SID."'";
//echo $query."<br><br>";
	$order = mysql_query($query, $linkID);
	$fields = mysql_num_fields($order);
	$row = mysql_fetch_assoc($order);
	// Then build the list of parameters and values to POST
	$params = "";
	$i = 0; 
	while ($i < $fields){
		$params .= "&".mysql_field_name($order, $i)."=".urlencode($row[mysql_field_name($order, $i)]);
		$i++; 
	} 
//echo $params."<br><br>";
	mysql_free_result($order);

	// Now POST it using cURL
	$url = "http://216.131.124.151/pws.php"; // TEST URL
//	$url = "https://www.vwelite.com/pws.php";
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // this line makes it work under https
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//	curl_setopt($ch, CURLOPT_TIMEOUT, 4); // times out after 4 seconds
//	ob_start();
	$result = curl_exec($ch);
//	curl_close($ch);
//	$result = ob_get_contents();
//	ob_end_clean();
//echo("<strong>Results: <br></strong>".$result)."<br><br>";

	// read the reply and act accordingly
	if ($result != false){ //POST was successful
		if (preg_match("/ok:/i", $result)) { //if we got back an "ok:"
			$raw_return = stristr($result,"ok: "); // The part of the reply starting with "ok: "
//echo $raw_return."<br><br>"; 
			$raw_key = substr($raw_return, 4, 32); // The next 32 characters starting at position 4 (after "ok: ", zero relative)
//echo $raw_key."<br><br>"; 
//		$raw_status = substr($raw_return, strpos($raw_return,"<br>")); // The rest of the returned value starting at the "<br>" following the key
//echo $raw_status."<br><br>"; 
			$query =
				"UPDATE orders SET
				delivery_time = NOW()
				WHERE session_id = '".$SID."'";
			$rs_close = mysql_query($query, $linkID);

			$query = "SELECT * FROM devices WHERE session_id = '".$SID."'";
			$order_items = mysql_query($query, $linkID);
			for ($counter=1; $counter <= mysql_num_rows($order_items); $counter++){
				$fields = mysql_num_fields($order_items);
				$row = mysql_fetch_assoc($order_items);
				// Then build the list of parameters and values to POST
				$params = "";
				$i = 0; 
				while ($i < $fields){
					$params .= "&".mysql_field_name($order_items, $i)."=".urlencode($row[mysql_field_name($order_items, $i)]);
					$i++; 
				} 
				$params .= "&key=".$raw_key;
//echo $params."<br><br>";

				// Now POST it using cURL
//				$url = "http://216.131.124.151/pws.php"; // TEST URL
				$url = "https://www.vwelite.com/pws.php";
				$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HEADER, 1);
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POST,1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // this line makes it work under https
				curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//				curl_setopt($ch, CURLOPT_TIMEOUT, 4); // times out after 4 seconds
//				ob_start();
				$result = curl_exec($ch);
//				curl_close($ch);
//				$result = ob_get_contents();
//				ob_end_clean();
//echo("<strong>Results: <br></strong>".$result)."<br><br>";
				if (!preg_match("/ok:/i", $result)) { //if we did NOT get back an "ok:"
					$query =
					'INSERT INTO undelivered_orders (
					session_id,
					first_response,
					last_response,
					first_attempt,
					last_attempt)
					VALUES (
					"'.$SID.'",
					"'.mysql_real_escape_string ($result).'",
					"'.mysql_real_escape_string ($result).'",
					NOW(),
					NOW())';
//echo $query.'<br></br>';
					$rs_insert = mysql_query($query, $linkID);
					$counter = mysql_num_rows($order_items) + 1; //increment counter out of range to fall out of loop
				}
			}
			mysql_free_result($order_items);
		}else{
			$query =
			'INSERT INTO undelivered_orders (
			session_id,
			first_response,
			last_response,
			first_attempt,
			last_attempt)
			VALUES (
			"'.$SID.'",
			"'.mysql_real_escape_string ($result).'",
			"'.mysql_real_escape_string ($result).'",
			NOW(),
			NOW())';
//echo $query.'<br></br>';
			$rs_insert = mysql_query($query, $linkID);
		}
	}else{
		$query =
		'INSERT INTO undelivered_orders (
		session_id,
		first_response,
		last_response,
		first_attempt,
		last_attempt)
		VALUES (
		"'.$SID.'",
		"'.mysql_real_escape_string ($result).'",
		"'.mysql_real_escape_string ($result).'",
		NOW(),
		NOW())';
//echo $query.'<br></br>';
		$rs_insert = mysql_query($query, $linkID);
	}
	// Go somewhere using javascript to avoid security warning for sending to an insecure page
//	echo'<script>window.location="http://'.$site.'.'.strtolower($uri[1]).'.com/?sec=activate&step=thankyou&carrier='.$_REQUEST['carrier'].'&site='.$site.'&sid='.$_REQUEST['sid'].'"</script>';
	echo'<script>window.location="http://'.$site.'.'.strtolower($uri[1]).'.nr.net/?sec=activate&step=thankyou&carrier='.$_REQUEST['carrier'].'&site='.$site.'&sid='.$_REQUEST['sid'].'"</script>';
	exit;

}; // End Switch
?>
