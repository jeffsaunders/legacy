<?
if (!$_REQUEST['sid']){
	session_start();
	// Test for session id; if none or mismatch they deep-linked, force them to start from scratch
	if (!$_SESSION['SID']){ echo'<script>window.location="/?sec=home";</script>'; exit;}
	// Good, there is a cookie - assign it's value to a variable for easy work
	$SID = $_SESSION['SID'];
}else{
	$SID = $_REQUEST['sid'];
};

// Grab the URI so we know which domain we are using
$uri = explode("/",$_SERVER['REQUEST_URI']);
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$anchor = $_REQUEST['anchor'];
$message = $_REQUEST['message'];
$cargo = $_REQUEST['cargo'];
$task = $_REQUEST['task'];

// Connect to the database
include "dbconnect.php";

//Grab existing cart info, if it exists
$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
$rs_cart = mysql_query($query, $linkID);

// Now, what to do...what to do?
switch($_REQUEST['task']){

case "addphone":	// Put a phone in the cart
	// If no order record found, insert one
	if (mysql_num_rows($rs_cart) == false){
		$query =
			"INSERT INTO orders (
			session_id,
			order_num,
			ipaddress,
			carrier,
			affiliation,
			mrc_discount,
			order_time)
			VALUES (
			'".$SID."',
			UNIX_TIMESTAMP(),
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['carrier']."',
			'".$_REQUEST['affiliation']."',
			'".$_REQUEST['mrc_discount']."',
			NOW())";
//echo $query.'<br></br>';
		$rs_insert = mysql_query($query, $linkID);
	}
	$query =
		"INSERT INTO order_items (
		session_id,
		product_id,
		product_manuf,
		product_model,
		phone_type,
		product_type,
		product_msrp,
		product_ir1,
		product_ir2,
		product_mir1,
		product_mir2,
		product_price,
		product_time)
		VALUES (
		'".$SID."',
		'".$_REQUEST['product_id']."',
		'".$_REQUEST['product_manuf']."',
		'".$_REQUEST['product_model']."',
		'".$_REQUEST['phone_type']."',
		'".$_REQUEST['product_type']."',
		'".$_REQUEST['product_msrp']."',
		'".$_REQUEST['product_ir1']."',
		'".$_REQUEST['product_ir2']."',
		'".$_REQUEST['product_mir1']."',
		'".$_REQUEST['product_mir2']."',
		'".$_REQUEST['product_price']."',
		NOW())";
//echo $query.'<br></br>';
		$rs_insert = mysql_query($query, $linkID);
		// Tell 'em what you did
//		$message = preg_replace(array('/&/'), array('±'), $_REQUEST['phone_manuf'].' '.$_REQUEST['phone_model'].' Added to Cart');
		// Send 'em to the cart
//		header("Location: /?sec=cart&message=$message&sid=$SID");
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
/*	}else{  // Otherwise, see if there is room, if so put it in the cart
		$row = mysql_fetch_assoc($rs_cart);
		for ($counter=1; $counter <= 5; $counter++){
			// Look for an empty slot
			if ($row['phone'.$counter.'_id'] == ""){
				// Found one!
				$query =
					"UPDATE orders SET
					carrier = '".$_REQUEST['carrier']."',
					phone".$counter."_id = '".$_REQUEST['phone_id']."',
					phone".$counter."_manuf = '".$_REQUEST['phone_manuf']."',
					phone".$counter."_model = '".$_REQUEST['phone_model']."',
					phone".$counter."_type = '".$_REQUEST['phone_type']."',
					phone".$counter."_msrp = '".$_REQUEST['phone_msrp']."',
					phone".$counter."_ir1 = '".$_REQUEST['phone_ir1']."',
					phone".$counter."_ir2 = '".$_REQUEST['phone_ir2']."',
					phone".$counter."_mir1 = '".$_REQUEST['phone_mir1']."',
					phone".$counter."_mir2 = '".$_REQUEST['phone_mir2']."',
					phone".$counter."_price = '".$_REQUEST['phone_price']."',
					phone".$counter."_time = NOW()
					WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
				$rs_update = mysql_query($query, $linkID);
				// Tell 'em what you did
////				$message = $_REQUEST['phone_manuf'].' '.$_REQUEST['phone_model'].' Added to Cart';
//				$message = preg_replace(array('/&/'), array('±'), $_REQUEST['phone_manuf'].' '.$_REQUEST['phone_model'].' Added to Cart');
				// Send 'em to the cart
				header("Location: ".$_SERVER['HTTP_REFERER']);
				exit;
			};
		};
		// if you reach here then cart is full - tell 'em!
		$message = 'Your Cart is Full - There is a Five Device Limit per Order';
		// Send 'em to the cart
		header("Location: ".$_SERVER['HTTP_REFERER']."&message=$message");
		exit;
	};
*/
	break;

case "removephone":	// Take a phone out of the cart
	// Get name of phone to be removed for message
//	$query = 
//		'SELECT phone'.$_REQUEST['cargo'].'_manuf AS phone_manuf,
//		phone'.$_REQUEST['cargo'].'_model AS phone_model
//		FROM orders
//		WHERE session_id = "'.$SID.'"';
//	$rs_phone = mysql_query($query, $linkID);
//	$row = mysql_fetch_assoc($rs_phone);
	// Remove phone
	$query = "DELETE FROM order_items WHERE record_id = '".$_REQUEST['cargo']."'";
//	$query = 
//		"UPDATE orders SET
//		phone".$_REQUEST['cargo']."_id = '',
//		phone".$_REQUEST['cargo']."_manuf = '',
//		phone".$_REQUEST['cargo']."_model = '',
//		phone".$_REQUEST['cargo']."_type = '',
//		phone".$_REQUEST['cargo']."_msrp = '',
//		phone".$_REQUEST['cargo']."_ir1 = '',
//		phone".$_REQUEST['cargo']."_ir2 = '',
//		phone".$_REQUEST['cargo']."_mir1 = '',
//		phone".$_REQUEST['cargo']."_mir2 = '',
//		phone".$_REQUEST['cargo']."_price = ''
//		WHERE session_id = '".$SID."'";
//		phone".$_REQUEST['cargo']."_time = NOW() took this out from just after price above
	$rs_remove = mysql_query($query, $linkID);
	// Tell 'em what you did
//	$message = str_replace('/&/', '±', $row['phone_manuf'].' '.$row['phone_model'].' Removed from Cart');
//	$message = preg_replace(array('/&/'), array('±'), $row['phone_manuf'].' '.$row['phone_model'].' Removed from Cart');
	// Grab a fresh copy of the cart
//	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
//	$rs_cart = mysql_query($query, $linkID);
//	$row = mysql_fetch_assoc($rs_cart);
//	// Count the phones
//	$qty = 0;
//	for ($counter=1; $counter <= 5; $counter++){
//		if ($row['phone'.$counter.'_id'] != "") $qty++;
//	};
//	// if it's now empty, remove the carrier too
//	if ($qty == 0){
//		$query = 
//			"UPDATE orders SET
//			carrier = ''
//			WHERE session_id = '".$SID."'";
//		$rs_update = mysql_query($query, $linkID);
//	}
	// Send 'em back to the cart
//	header("Location: /?sec=cart&message=$message");
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;

case "empty":	// Empty cart completely
	// Empty cart
	$query = "DELETE FROM order_items WHERE session_id = '".$SID."'";
//	$query = "UPDATE orders SET ";
//	for ($counter=1; $counter <= 5; $counter++){
//		$query .= "
//			phone".$counter."_id = '',
//			phone".$counter."_manuf = '',
//			phone".$counter."_model = '',
//			phone".$counter."_type = '',
//			phone".$counter."_msrp = '',
//			phone".$counter."_ir1 = '',
//			phone".$counter."_ir2 = '',
//			phone".$counter."_mir1 = '',
//			phone".$counter."_mir2 = '',";
//		if ($counter < 5) $query .= "phone".$counter."_price = '',";
//		if ($counter == 5) $query .= "phone".$counter."_price = '' ";
//	}
//	$query .= "WHERE session_id = '".$SID."'";
//echo $query;
	$rs_empty = mysql_query($query, $linkID);
	// Tell 'em what you did
//	$message = 'Cart Empty';
	// Send 'em back to the cart
//	header("Location: /?sec=cart&message=$message");
	if ($cargo == "checkout"){
		header("Location: http://".$_REQUEST["site"].".visconnect.nr.net/");
	}else{
		header("Location: http://".$_REQUEST["site"].".visconnect.nr.net/?sec=".$cargo);
//		header("Location: ".$_SERVER['HTTP_REFERER']); // The above is more reliable!
	}
	exit;

case "addphoneinfo": // Put device info in the cart
	// Wipe out any plans already in the cart
//	$query =
//		"UPDATE orders SET
//		plan_id = '',
//		plan_group = '',
//		plan_name = '',
//		plan_minutes = '',
//		plan_cost = '0',
//		plan_disc = '0',
//		data_plan_id = '',
//		data_plan_name = '',
//		data_plan_usage = '',
//		data_plan_cost = '0',
//		data_plan_disc = '0',
//		bb_plan_id = '',
//		bb_plan_name = '',
//		bb_plan_usage = '',
//		bb_plan_cost = '0',
//		bb_plan_disc = '0'
//		WHERE session_id = '".$SID."'";
//	$rs_update = mysql_query($query, $linkID);
//	$message = '';
//	if ($_REQUEST['voice_plan_id']){
//		$query = "SELECT * FROM plans WHERE plan_id = '".$_REQUEST['voice_plan_id']."'";
//		$rs_voice = mysql_query($query, $linkID);
//		$voice_plan = mysql_fetch_assoc($rs_voice);
//		if ($voice_plan["discountable"] == 'F'){
//			$discount = 0;
//		}else{
//			$discount = $_REQUEST['discount'];
//		}
//		$query =
//			"UPDATE orders SET
//			plan_id = '".$_REQUEST['voice_plan_id']."',
//			plan_group = '".$voice_plan['group_name']."',
//			plan_name = '".$voice_plan['plan_name']."',
//			plan_minutes = '".$voice_plan['quantity']."',
//			plan_cost = '".$voice_plan['cost']."',
//			plan_disc = '".$discount."',
//			plan_time = NOW()
//			WHERE session_id = '".$SID."'";
//		$rs_update = mysql_query($query, $linkID);
//		$message .= preg_replace(array('/&/'), array('±'), $voice_plan['quantity'].' Minute '.$voice_plan['group_name'].' Plan');
//	};
	if ($_REQUEST['data_plan_id']){
		$query = "SELECT * FROM plans WHERE plan_id = '".$_REQUEST['data_plan_id']."'";
		$rs_data = mysql_query($query, $linkID);
		$data_plan = mysql_fetch_assoc($rs_data);
		if ($data_plan["discountable"] == 'F'){
			$discount = 0;
		}else{
			$discount = $_REQUEST['discount'];
		}
		$query =
			"UPDATE order_items SET
			data_plan_id = '".$_REQUEST['data_plan_id']."',
			data_plan_name = '".$data_plan['plan_name']."',
			data_plan_usage = '".$data_plan['quantity']."',
			data_plan_cost = '".$data_plan['cost']."',
			data_plan_discount = '".$discount."',
			plan_time = NOW(),
			aircard_protection = '".$_REQUEST['aircard_protection']."',
			option_time = NOW(),
			phone_username = '".$_REQUEST['phone_username']."',
			phone_usercity = '".$_REQUEST['phone_usercity']."',
			phone_userstate = '".$_REQUEST['phone_userstate']."',
			phone_userzip = '".$_REQUEST['phone_userzip']."',
			phone_areacode = '".$_REQUEST['phone_areacode']."',
			port_time = NOW()
			WHERE record_id = '".$_REQUEST['record_id']."'";
		$rs_update = mysql_query($query, $linkID);
		if ($message != '') $message .= ' and ';
//		if ($_REQUEST['voice_plan_id']) $message .= ' and ';
		$message .= $data_plan['quantity'].' Data Plan';
	};
/*	if ($_REQUEST['smartphone_plan_id']){
		$query = "SELECT * FROM plans WHERE plan_id = '".$_REQUEST['smartphone_plan_id']."'";
		$rs_smart = mysql_query($query, $linkID);
		$smart_plan = mysql_fetch_assoc($rs_smart);
		if ($smart_plan["discountable"] == 'F'){
			$discount = 0;
		}else{
			$discount = $_REQUEST['discount'];
		}
		$query =
			"UPDATE orders SET
			smartphone_plan_id = '".$_REQUEST['smartphone_plan_id']."',
			smartphone_plan_name = '".$smart_plan['plan_name']."',
			smartphone_plan_usage = '".$smart_plan['quantity']."',
			smartphone_plan_cost = '".$smart_plan['cost']."',
			smartphone_plan_disc = '".$discount."'
			WHERE session_id = '".$SID."'";
		$rs_update = mysql_query($query, $linkID);
		if ($message != '') $message .= ' and ';
//		if ($_REQUEST['smartphone_plan_id']) $message .= ' and ';
		$message .= $smart_plan['quantity'].' SmartPhone Plan';
	};
	if ($_REQUEST['blackberry_plan_id']){
		$query = "SELECT * FROM plans WHERE plan_id = '".$_REQUEST['blackberry_plan_id']."'";
		$rs_blackberry = mysql_query($query, $linkID);
		$blackberry_plan = mysql_fetch_assoc($rs_blackberry);
		if ($blackberry_plan["discountable"] == 'F'){
			$discount = 0;
		}else{
			$discount = $_REQUEST['discount'];
		}
		$query =
			"UPDATE orders SET
			bb_plan_id = '".$_REQUEST['blackberry_plan_id']."',
			bb_plan_name = '".$blackberry_plan['plan_name']."',
			bb_plan_usage = '".$blackberry_plan['quantity']."',
			bb_plan_cost = '".$blackberry_plan['cost']."',
			bb_plan_disc = '".$discount."'
			WHERE session_id = '".$SID."'";
		$rs_update = mysql_query($query, $linkID);
		$message .= ' and '.$blackberry_plan['quantity'].' BlackBerry Plan';
	};
	$message .= ' Added to Cart';
*/	header("Location: https://secure.nr.net/".strtolower($uri[1])."/?sec=checkout&sid=$SID&site=".$_SESSION['site']);
	exit;

/*case "addoptions":	// Put options in the cart, actually just update them, even from empty
	// Wipe out any options already in the cart
	$query =
		"UPDATE orders SET
		sprint_power_vision = NULL,
		sprint_power_vision_price = 0,
		sprint_pcs_vision = NULL,
		sprint_pcs_vision_price = 0,
		sprint_blackberry_data = NULL,
		sprint_blackberry_data_price = 0,
		sms = NULL,
		sms_price = 0,
		nights = NULL,
		nights_price = 0,
		m2m = 0,
		protection = 0,
		aircard_protection = 0,
		rescue = 0,
		voice_command = 0,
		sprint_mexico_ld = 0,
		sprint_to_home = 0,
		sprint_navigation = 0,
		sprint_family_locator = 0,
		sprint_mobile_locator = 0,
		nextel_add_on_50 = 0,
		nextel_sprint2home = 0,
		nextel_mobile2office = 0,
		nextel_unltd_walkie = 0,
		nextel_unltd_group_walkie = 0,
		nextel_unltd_intl_walkie = 0,
		nextel_nextmail = 0,
		nextel_talkgroup_250 = 0,
		nextel_talkgroup_unltd = 0,
		nextel_data = 0,
		nextel_powersource_data_1000 = 0,
		nextel_powersource_data_unltd = 0,
		nextel_pcs_vision_pack = 0,
		nextel_sms_unltd = 0,
		nextel_sms_300 = 0,
		nextel_mobile_email = 0,
		nextel_easy_office = 0,
		nextel_easy_office_plus1gb = 0,
		nextel_mapquest = 0,
		nextel_trimble_gold = 0,
		nextel_trimble_platinum = 0,
		nextel_telenav_10 = 0,
		nextel_telenav_unltd = 0,
		nextel_mobile_locator = 0,
		nextel_mobile_locator_500 = 0,
		nextel_address_book = 0,
		nextel_admin_pkg = 0,
		nextel_intl_ld = NULL,
		sprint_intl_ld = 0,
		nextel_intl_data = NULL,
		nextel_arcade = 0,
		nextel_inbound_restriction = NULL,
		nextel_outbound_restriction = NULL,
		nextel_ld_restriction = NULL,
		nextel_walkie_restriction = NULL,
		nextel_intl_walkie_restriction = NULL,
		att_early_nights = 0,
		att_family_early_nights = 0,
		att_voice_dial = 0,
		att_enhanced_voicemail = 0,
		att_xpress_mail = 0,
		att_messaging = NULL,
		att_messaging_price = 0,
		att_intl_msg = 0,
		att_video_share = NULL,
		att_video_share_price = 0,
		att_push_talk = 0,
		att_family_push_talk = 0,
		att_telenav = NULL,
		att_telenav_price = 0,
		att_roadside_assist = 0,
		att_phone_insurance = 0,
		universal_earbuds = '0',
		universal_earbuds_price = '0',
		vehicle_adapters = '0',
		vehicle_adapters_price = '0'
		WHERE session_id = '".$SID."'";
	$rs_update = mysql_query($query, $linkID);
	// split up option names & prices
	$power_vision = explode("|", $_REQUEST['sprint_power_vision']);
	$pcs_vision = explode("|", $_REQUEST['sprint_pcs_vision']);
	$bb_data = explode("|", $_REQUEST['sprint_blackberry_data']);
	$sms = explode("|", $_REQUEST['sms']);
	$nights = explode("|", $_REQUEST['nights']);
	$att_messaging = explode("|", $_REQUEST['att_messaging']);
	$att_video_share = explode("|", $_REQUEST['att_video_share']);
	$att_telenav = explode("|", $_REQUEST['att_telenav']);
	if ($_REQUEST['carrier'] == "Sprint"){
		$query =
			"UPDATE orders SET
			sprint_power_vision = '".$power_vision[0]."',
			sprint_power_vision_price = '".$power_vision[1]."',
			sprint_pcs_vision = '".$pcs_vision[0]."',
			sprint_pcs_vision_price = '".$pcs_vision[1]."',
			sprint_blackberry_data = '".$bb_data[0]."',
			sprint_blackberry_data_price = '".$bb_data[1]."',
			sms = '".$sms[0]."',
			sms_price = '".$sms[1]."',
			nights = '".$nights[0]."',
			nights_price = '".$nights[1]."',
			m2m = '".$_REQUEST['m2m']."',
			protection = '".$_REQUEST['protection']."',
			aircard_protection = '".$_REQUEST['aircard_protection']."',
			rescue = '".$_REQUEST['rescue']."',
			voice_command = 0',
			sprint_intl_ld = '".$_REQUEST['sprint_intl_ld']."',
			sprint_mexico_ld = '".$_REQUEST['sprint_mexico_ld']."',
			sprint_to_home = '".$_REQUEST['sprint_to_home']."',
			sprint_navigation = '".$_REQUEST['sprint_navigation']."',
			sprint_family_locator = '".$_REQUEST['sprint_family_locator']."',
			sprint_mobile_locator = '".$_REQUEST['sprint_mobile_locator']."',
			universal_earbuds = '".$_REQUEST['universal_earbuds']."',
			universal_earbuds_price = '".$_REQUEST['universal_earbuds_price']."',
			vehicle_adapters = '".$_REQUEST['vehicle_adapters']."',
			vehicle_adapters_price = '".$_REQUEST['vehicle_adapters_price']."',
			option_time = NOW()
			WHERE session_id = '".$SID."'";
		$rs_update = mysql_query($query, $linkID);
	}elseif ($_REQUEST['carrier'] == "Nextel"){
		$query =
			"UPDATE orders SET
			nextel_add_on_50 = '".$_REQUEST['nextel_add_on_50']."',
			nextel_sprint2home = '".$_REQUEST['nextel_sprint2home']."',
			nextel_mobile2office = '".$_REQUEST['nextel_mobile2office']."',
			nextel_unltd_walkie = '".$_REQUEST['nextel_unltd_walkie']."',
			nextel_unltd_group_walkie = '".$_REQUEST['nextel_unltd_group_walkie']."',
			nextel_unltd_intl_walkie = '".$_REQUEST['nextel_unltd_intl_walkie']."',
			nextel_nextmail = '".$_REQUEST['nextel_nextmai']."',
			nextel_talkgroup_250 = '".$_REQUEST['nextel_talkgroup_250']."',
			nextel_talkgroup_unltd = '".$_REQUEST['nextel_talkgroup_unltd']."',
			nextel_data = '".$_REQUEST['nextel_data']."',
			nextel_powersource_data_1000 = '".$_REQUEST['nextel_powersource_data_1000']."',
			nextel_powersource_data_unltd = '".$_REQUEST['nextel_powersource_data_unltd']."',
			nextel_pcs_vision_pack = '".$_REQUEST['nextel_pcs_vision_pack']."',
			nextel_sms_unltd = '".$_REQUEST['nextel_sms_unltd']."',
			nextel_sms_300 = '".$_REQUEST['nextel_sms_300']."',
			nextel_mobile_email = '".$_REQUEST['nextel_mobile_email']."',
			nextel_easy_office = '".$_REQUEST['nextel_easy_office']."',
			nextel_easy_office_plus1gb = '".$_REQUEST['nextel_easy_office_plus1gb']."',
			nextel_mapquest = '".$_REQUEST['nextel_mapquest']."',
			nextel_trimble_gold = '".$_REQUEST['nextel_trimble_gold']."',
			nextel_trimble_platinum = '".$_REQUEST['nextel_trimble_platinum']."',
			nextel_telenav_10 = '".$_REQUEST['nextel_telenav_10']."',
			nextel_telenav_unltd = '".$_REQUEST['nextel_telenav_unltd']."',
			nextel_mobile_locator = '".$_REQUEST['nextel_mobile_locator']."',
			nextel_mobile_locator_500 = '".$_REQUEST['nextel_mobile_locator_500']."',
			nextel_address_book = '".$_REQUEST['nextel_address_book']."',
			nextel_admin_pkg = '".$_REQUEST['nextel_admin_pkg']."',
			nextel_intl_ld = '".$_REQUEST['nextel_intl_ld']."',
			sprint_intl_ld = '".$_REQUEST['sprint_intl_ld']."',
			nextel_intl_data = '".$_REQUEST['nextel_intl_data']."',
			nextel_arcade = '".$_REQUEST['nextel_arcade']."',
			nextel_inbound_restriction = '".$_REQUEST['nextel_inbound_restriction']."',
			nextel_outbound_restriction = '".$_REQUEST['nextel_outbound_restriction']."',
			nextel_ld_restriction = '".$_REQUEST['nextel_ld_restriction']."',
			nextel_walkie_restriction = '".$_REQUEST['nextel_walkie_restriction']."',
			nextel_intl_walkie_restriction = '".$_REQUEST['nextel_intl_walkie_restriction']."',
			nights = '".$nights[0]."',
			nights_price = '".$nights[1]."',
			m2m = '".$_REQUEST['m2m']."',
			protection = '".$_REQUEST['protection']."',
			rescue = '".$_REQUEST['rescue']."',
			universal_earbuds = '".$_REQUEST['universal_earbuds']."',
			universal_earbuds_price = '".$_REQUEST['universal_earbuds_price']."',
			vehicle_adapters = '".$_REQUEST['vehicle_adapters']."',
			vehicle_adapters_price = '".$_REQUEST['vehicle_adapters_price']."',
			option_time = NOW()
			WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}elseif ($_REQUEST['carrier'] == "AT&T"){
		$query =
			"UPDATE orders SET
			att_early_nights = '".$_REQUEST['att_early_nights']."',
			att_family_early_nights = '".$_REQUEST['att_family_early_nights']."',
			att_voice_dial = '".$_REQUEST['att_voice_dial']."',
			att_enhanced_voicemail = '".$_REQUEST['att_enhanced_voicemail']."',
			att_xpress_mail = '".$_REQUEST['att_xpress_mail']."',
			att_messaging = '".$att_messaging[0]."',
			att_messaging_price = '".$att_messaging[1]."',
			att_intl_msg = '".$_REQUEST['att_intl_msg']."',
			att_video_share = '".$att_video_share[0]."',
			att_video_share_price = '".$att_video_share[1]."',
			att_push_talk = '".$_REQUEST['att_push_talk']."',
			att_family_push_talk = '".$_REQUEST['att_family_push_talk']."',
			att_telenav = '".$att_telenav[0]."',
			att_telenav_price = '".$att_telenav[1]."',
			att_roadside_assist = '".$_REQUEST['att_roadside_assist']."',
			att_phone_insurance = '".$_REQUEST['att_phone_insurance']."',
			universal_earbuds = '".$_REQUEST['universal_earbuds']."',
			universal_earbuds_price = '".$_REQUEST['universal_earbuds_price']."',
			vehicle_adapters = '".$_REQUEST['vehicle_adapters']."',
			vehicle_adapters_price = '".$_REQUEST['vehicle_adapters_price']."',
			option_time = NOW()
			WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	};
	$message = 'Options Added to Cart';
	header("Location: https://secure.nr.net/".strtolower($uri[1])."/?sec=checkout&message=$message&cargo=porting&sid=$SID");
	exit;
*/
/*case "addport":	// Put porting and phone user information in the cart, actually just update them, even from empty
	// Wipe out any porting information already in the cart
	$query =
		"UPDATE orders SET
		phone1_username = NULL,
		phone1_usercity = NULL,
		phone1_userstate = NULL,
		phone1_userzip = NULL,
		phone1_areacode = NULL,
		phone1_port_number = NULL,
		phone1_port_from = NULL,
		phone1_port_acctnum = NULL,
		phone1_port_password = NULL,
		phone1_port_billname = NULL,
		phone1_port_billaddr1 = NULL,
		phone1_port_billaddr2 = NULL,
		phone1_port_billcity = NULL,
		phone1_port_billstate = NULL,
		phone1_port_billzip = NULL,
		phone2_username = NULL,
		phone2_usercity = NULL,
		phone2_userstate = NULL,
		phone2_userzip = NULL,
		phone2_areacode = NULL,
		phone2_port_number = NULL,
		phone2_port_from = NULL,
		phone2_port_acctnum = NULL,
		phone2_port_password = NULL,
		phone2_port_billname = NULL,
		phone2_port_billaddr1 = NULL,
		phone2_port_billaddr2 = NULL,
		phone2_port_billcity = NULL,
		phone2_port_billstate = NULL,
		phone2_port_billzip = NULL,
		phone3_username = NULL,
		phone3_usercity = NULL,
		phone3_userstate = NULL,
		phone3_userzip = NULL,
		phone3_areacode = NULL,
		phone3_port_number = NULL,
		phone3_port_from = NULL,
		phone3_port_acctnum = NULL,
		phone3_port_password = NULL,
		phone3_port_billname = NULL,
		phone3_port_billaddr1 = NULL,
		phone3_port_billaddr2 = NULL,
		phone3_port_billcity = NULL,
		phone3_port_billstate = NULL,
		phone3_port_billzip = NULL,
		phone4_username = NULL,
		phone4_usercity = NULL,
		phone4_userstate = NULL,
		phone4_userzip = NULL,
		phone4_areacode = NULL,
		phone4_port_number = NULL,
		phone4_port_from = NULL,
		phone4_port_acctnum = NULL,
		phone4_port_password = NULL,
		phone4_port_billname = NULL,
		phone4_port_billaddr1 = NULL,
		phone4_port_billaddr2 = NULL,
		phone4_port_billcity = NULL,
		phone4_port_billstate = NULL,
		phone4_port_billzip = NULL,
		phone5_username = NULL,
		phone5_usercity = NULL,
		phone5_userstate = NULL,
		phone5_userzip = NULL,
		phone5_areacode = NULL,
		phone5_port_number = NULL,
		phone5_port_from = NULL,
		phone5_port_acctnum = NULL,
		phone5_port_password = NULL,
		phone5_port_billname = NULL,
		phone5_port_billaddr1 = NULL,
		phone5_port_billaddr2 = NULL,
		phone5_port_billcity = NULL,
		phone5_port_billstate = NULL,
		phone5_port_billzip = NULL
		WHERE session_id = '".$SID."'";
	$rs_update = mysql_query($query, $linkID);
	$query =
		"UPDATE orders SET
		phone1_username = '".$_REQUEST['phone1_username']."',
		phone1_usercity = '".$_REQUEST['phone1_usercity']."',
		phone1_userstate = '".$_REQUEST['phone1_userstate']."',
		phone1_userzip = '".$_REQUEST['phone1_userzip']."',
		phone1_areacode = '".$_REQUEST['phone1_areacode']."',
		phone1_port_number = '".$_REQUEST['phone1_port_number']."',
		phone1_port_from = '".$_REQUEST['phone1_port_from']."',
		phone1_port_acctnum = '".$_REQUEST['phone1_port_acctnum']."',
		phone1_port_password = '".$_REQUEST['phone1_port_password']."',
		phone1_port_billname = '".$_REQUEST['phone1_port_billname']."',
		phone1_port_billaddr1 = '".$_REQUEST['phone1_port_billaddr1']."',
		phone1_port_billaddr2 = '".$_REQUEST['phone1_port_billaddr2']."',
		phone1_port_billcity = '".$_REQUEST['phone1_port_billcity']."',
		phone1_port_billstate = '".$_REQUEST['phone1_port_billstate']."',
		phone1_port_billzip = '".$_REQUEST['phone1_port_billzip']."',
		phone2_username = '".$_REQUEST['phone2_username']."',
		phone2_usercity = '".$_REQUEST['phone2_usercity']."',
		phone2_userstate = '".$_REQUEST['phone2_userstate']."',
		phone2_userzip = '".$_REQUEST['phone2_userzip']."',
		phone2_areacode = '".$_REQUEST['phone2_areacode']."',
		phone2_port_number = '".$_REQUEST['phone2_port_number']."',
		phone2_port_from = '".$_REQUEST['phone2_port_from']."',
		phone2_port_acctnum = '".$_REQUEST['phone2_port_acctnum']."',
		phone2_port_password = '".$_REQUEST['phone2_port_password']."',
		phone2_port_billname = '".$_REQUEST['phone2_port_billname']."',
		phone2_port_billaddr1 = '".$_REQUEST['phone2_port_billaddr1']."',
		phone2_port_billaddr2 = '".$_REQUEST['phone2_port_billaddr2']."',
		phone2_port_billcity = '".$_REQUEST['phone2_port_billcity']."',
		phone2_port_billstate = '".$_REQUEST['phone2_port_billstate']."',
		phone2_port_billzip = '".$_REQUEST['phone2_port_billzip']."',
		phone3_username = '".$_REQUEST['phone3_username']."',
		phone3_usercity = '".$_REQUEST['phone3_usercity']."',
		phone3_userstate = '".$_REQUEST['phone3_userstate']."',
		phone3_userzip = '".$_REQUEST['phone3_userzip']."',
		phone3_areacode = '".$_REQUEST['phone3_areacode']."',
		phone3_port_number = '".$_REQUEST['phone3_port_number']."',
		phone3_port_from = '".$_REQUEST['phone3_port_from']."',
		phone3_port_acctnum = '".$_REQUEST['phone3_port_acctnum']."',
		phone3_port_password = '".$_REQUEST['phone3_port_password']."',
		phone3_port_billname = '".$_REQUEST['phone3_port_billname']."',
		phone3_port_billaddr1 = '".$_REQUEST['phone3_port_billaddr1']."',
		phone3_port_billaddr2 = '".$_REQUEST['phone3_port_billaddr2']."',
		phone3_port_billcity = '".$_REQUEST['phone3_port_billcity']."',
		phone3_port_billstate = '".$_REQUEST['phone3_port_billstate']."',
		phone3_port_billzip = '".$_REQUEST['phone3_port_billzip']."',
		phone4_username = '".$_REQUEST['phone4_username']."',
		phone4_usercity = '".$_REQUEST['phone4_usercity']."',
		phone4_userstate = '".$_REQUEST['phone4_userstate']."',
		phone4_userzip = '".$_REQUEST['phone4_userzip']."',
		phone4_areacode = '".$_REQUEST['phone4_areacode']."',
		phone4_port_number = '".$_REQUEST['phone4_port_number']."',
		phone4_port_from = '".$_REQUEST['phone4_port_from']."',
		phone4_port_acctnum = '".$_REQUEST['phone4_port_acctnum']."',
		phone4_port_password = '".$_REQUEST['phone4_port_password']."',
		phone4_port_billname = '".$_REQUEST['phone4_port_billname']."',
		phone4_port_billaddr1 = '".$_REQUEST['phone4_port_billaddr1']."',
		phone4_port_billaddr2 = '".$_REQUEST['phone4_port_billaddr2']."',
		phone4_port_billcity = '".$_REQUEST['phone4_port_billcity']."',
		phone4_port_billstate = '".$_REQUEST['phone4_port_billstate']."',
		phone4_port_billzip = '".$_REQUEST['phone4_port_billzip']."',
		phone5_username = '".$_REQUEST['phone5_username']."',
		phone5_usercity = '".$_REQUEST['phone5_usercity']."',
		phone5_userstate = '".$_REQUEST['phone5_userstate']."',
		phone5_userzip = '".$_REQUEST['phone5_userzip']."',
		phone5_areacode = '".$_REQUEST['phone5_areacode']."',
		phone5_port_number = '".$_REQUEST['phone5_port_number']."',
		phone5_port_from = '".$_REQUEST['phone5_port_from']."',
		phone5_port_acctnum = '".$_REQUEST['phone5_port_acctnum']."',
		phone5_port_password = '".$_REQUEST['phone5_port_password']."',
		phone5_port_billname = '".$_REQUEST['phone5_port_billname']."',
		phone5_port_billaddr1 = '".$_REQUEST['phone5_port_billaddr1']."',
		phone5_port_billaddr2 = '".$_REQUEST['phone5_port_billaddr2']."',
		phone5_port_billcity = '".$_REQUEST['phone5_port_billcity']."',
		phone5_port_billstate = '".$_REQUEST['phone5_port_billstate']."',
		phone5_port_billzip = '".$_REQUEST['phone5_port_billzip']."',
		port_time = NOW()
		WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
	$rs_update = mysql_query($query, $linkID);
	$message = 'Phone Information Added to Cart';
	header("Location: https://secure.nr.net/".strtolower($uri[1])."/?sec=checkout&message=$message&cargo=info&sid=$SID");
	exit;
*/



case "addcustinfo": // Add customer information to the order
//	$key_string = "6afgCems46e6NC8JmVzFoN9eda471T";
	$query =
		"UPDATE orders SET
		first_name = '".$_REQUEST['first_name']."',
		middle_name = '".$_REQUEST['middle_name']."',
		last_name = '".$_REQUEST['last_name']."',
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
		home_phone = '".$_REQUEST['home_phone']."',
		alt_phone = '".$_REQUEST['alt_phone']."',
		carrier_phone = '".$_REQUEST['carrier_phone']."',
		email = '".$_REQUEST['email']."',
		ssn = '".$_REQUEST['ssn']."',
		dob = '".$_REQUEST['dob']."',
		dl_num = '".$_REQUEST['dl_num']."',
		dl_state = '".$_REQUEST['dl_state']."',
		dl_expiration = '".$_REQUEST['dl_exp_month']."/".$_REQUEST['dl_exp_day']."/".$_REQUEST['dl_exp_year']."',
		cc_type = '".$_REQUEST['cc_type']."',
		cc_expiration = '".$_REQUEST['exp_month']."/".$_REQUEST['exp_year']."',
		cc_name = '".$_REQUEST['cc_name']."',
		cc_num = '".$_REQUEST['cc_num']."',
		cc_cid = '".$_REQUEST['cc_cid']."',
		info_time = NOW()
		WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';       				ssn = AES_ENCRYPT('".$_REQUEST['ssn']."','".$key_string."'),
	$rs_update = mysql_query($query, $linkID);
//	$message = 'Customer Information Added to Cart';
/////////	header("Location: https://secure.nr.net/".strtolower($uri[1])."/?sec=checkout&cargo=confirm&sid=$SID&site=$site");
//	header("Location: https://secure.nr.net/".strtolower($uri[1])."/?sec=summary&sid=$SID&site=".$_SESSION['site']);
	header("Location: https://secure.nr.net/".strtolower($uri[1])."/?sec=summary&sid=$SID");

///////////temp kludge for demo 


	// start new session
//	session_save_path("/var/www/html/cellbenefits.com/tmp");
	// Set the session timout to 24 hours - that should be plenty, even if they come back in the morning.

/*	ini_set("session.gc_maxlifetime", "86400"); 
	session_start();
	$site = $_SESSION['site'];
	$_SESSION = array(); 
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	session_regenerate_id(true);
	$_SESSION['SID'] = session_id();
	$SID = $_SESSION['SID'];
		echo'<script>window.location="http://apple.visconnect.com"</script>';
*/	exit;

case "addconfirmwithoutPOST":
	$query =
		"UPDATE orders SET
		accept_terms = '".$_REQUEST['accept_terms']."',
		confirm_time = NOW()
		WHERE session_id = '".$SID."'";
	$rs_update = mysql_query($query, $linkID);
	session_start();
	$site = $_SESSION['site'];
//	unset($_SESSION['SID']);
//	$_SESSION = array(); 
//	session_regenerate_id();
//	$_SESSION['SID'] = session_id();
//	$SID = $_SESSION['SID'];
//	echo'<script>window.location="http://'.$site.'.cellbenefits.com/?sec=thankyou&sid='.$SID.'"</script>';

	echo'<script>window.location="http://'.$site.'.visconnect.nr.net/?sec=thankyou"</script>';

//	header("Location: https://secure.nr.net/cellbenefits/?sec=thankyou&sid=$SID");
//	header("Location: http://mckesson.cellbenefits.com/?sec=thankyou&sid=$SID", TRUE, 303);
	exit;

case "addconfirm":
	$query =
		"UPDATE orders SET
		accept_terms = '".$_REQUEST['accept_terms']."',
		confirm_time = NOW()
		WHERE session_id = '".$SID."'";
	$rs_update = mysql_query($query, $linkID);
	// POST order to Vision Admin
	// First, get the order record
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
	$url = "https://www.vwelite.com/apple.php";
//	$url = "http://216.131.124.151/apple.php";
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
//////////////////////	$result = curl_exec($ch);   DON'T POST!!!!!!!!!!
	curl_close($ch);
//	$result = ob_get_contents();
//	ob_end_clean();
//echo("Results: <br>".$result)."<br><br>";
	// read the reply and act accordingly
	if ($result != false){ //POST was successful
		if (preg_match("/ok:/i", $result)) { //if we got back an "ok:"
			$raw_return = stristr($result,"ok: "); // The part of the reply starting with "ok: "
//echo $raw_return."<br><br>"; 
			$raw_key = substr($raw_return, 4, 32); // The next 32 characters starting at position 4 (after "ok: ", zero relative)
//echo $raw_key."<br><br>"; 
			// Now POST all the device records for the order
			$query = "SELECT * FROM order_items WHERE session_id = '".$SID."'";
			$order_items = mysql_query($query, $linkID);
			for ($counter=1; $counter <= mysql_num_rows($order_items); $counter++){
				$fields = mysql_num_fields($order_items);
				$row = mysql_fetch_assoc($order_items);
				// Then build the list of parameters and values to POST...
				$params = "";
				$i = 0; 
				while ($i < $fields){
					$params .= "&".mysql_field_name($order_items, $i)."=".urlencode($row[mysql_field_name($order_items, $i)]);
					$i++; 
				} 
				// ...and tack on the key that was returned above
				$params .= "&key=".$raw_key;
//echo $params."<br><br>";
				// Now POST it using cURL
//				$url = "https://www.vwelite.com/apple.php";
//				$url = "http://216.131.124.151/apple.php";
//				$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
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
				curl_close($ch);
//				$result = ob_get_contents();
//				ob_end_clean();
//echo("Results: <br>".$result)."<br><br>";
			}
			mysql_free_result($order_items);
			// Stamp the delivery time
			$query =
				"UPDATE orders SET
				delivery_time = NOW()
				WHERE session_id = '".$SID."'";
			$rs_close = mysql_query($query, $linkID);
		}
	}else{ // POST failed
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
	// start new session
	session_start();
	$site = $_SESSION['site'];
//	unset($_SESSION['SID']);
//	$_SESSION = array(); 
//	session_regenerate_id();
//	$_SESSION['SID'] = session_id();
//	$SID = $_SESSION['SID'];
	echo'<script>window.location="http://'.$site.'.visconnect.nr.net/?sec=thankyou"</script>';
	exit;

}; // End Switch
?>

