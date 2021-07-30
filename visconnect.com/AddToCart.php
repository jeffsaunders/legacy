<?
// Start session
session_start();
// Assign it to a session variable
$_SESSION['SID'] = session_id();
// Assign it's value to a local variable too for easy work
$SID = $_SESSION['SID'];
// Grab URL, split it up, and reverse it.
$host = array_reverse(explode(".",$_SERVER['HTTP_HOST']));
if (!$host[2] || strtolower($host[2]) == "www"){
	$destination = "http://www.visioncell.com";
	header("Location: $destination");
	exit;
}elseif (strtolower($host[2]) == "secure"){
	if ($_REQUEST['site']){
		$_SESSION['site'] = $_REQUEST['site'];
	}
}else{
	$_SESSION['site'] = $host[2];
}

// Interrogate and reassign passed variables
$phone_id[1] = $_REQUEST['PhoneID1'];
$phone_id[2] = $_REQUEST['PhoneID2'];
$phone_id[3] = $_REQUEST['PhoneID3'];
$phone_id[4] = $_REQUEST['PhoneID4'];
$phone_id[5] = $_REQUEST['PhoneID5'];
$accessory_id[1] = $_REQUEST['AccessoryID1'];
$accessory_id[2] = $_REQUEST['AccessoryID2'];
$accessory_id[3] = $_REQUEST['AccessoryID3'];
$accessory_id[4] = $_REQUEST['AccessoryID4'];
$accessory_id[5] = $_REQUEST['AccessoryID5'];
$new_cart = $_REQUEST['NewCart'];
$site = $_SESSION['site'];

// Connect to the database
include "dbconnect.php";

// Check to see if there is already a cart started for this session id.
$rs_cart = mysql_query("SELECT * FROM orders WHERE session_id = '$SID'", $linkID);
if (mysql_num_rows($rs_cart) != false && (!$new_cart)){ // cart exists
	$cart = mysql_fetch_assoc($rs_cart);
}
if ($new_cart == "yes"){
	// start new session
//	session_save_path("/home/actipal/sessions");
	// Set the session timout to 24 hours - that should be plenty, even if they come back in the morning.
	ini_set("session.gc_maxlifetime", "86400"); 
	session_start();
	$site = $_SESSION['site'];
	$_SESSION = array(); 
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	session_regenerate_id(true);
	$_SESSION['SID'] = session_id();
	$SID = $_SESSION['SID'];
}
// Grab site data
$rs_config = mysql_query("SELECT * FROM sites WHERE site = '$site'", $linkID);
$config = mysql_fetch_assoc($rs_config);
$pricing_level = $config["pricing_level"];
for ($phone_num=1; $phone_num <= 5; $phone_num++){
	// Grab phone data
	if ($phone_id[$phone_num] != ""){
		$rs_phone = mysql_query("SELECT * FROM phones WHERE product_id = '".$phone_id[$phone_num]."' AND display <> 'N'", $linkID);
		if (mysql_num_rows($rs_phone) == false){ // No phone found
			$message = "Phone is Currently Not Available";
			$destination = "/?sec=cart&message=".$message."&sid=".$SID;
//echo $destination;
			header("Location: $destination");
			exit;
		}
		$phone = mysql_fetch_assoc($rs_phone);
		$message = "";

//echo '<script>alert('.$phone['product_id'].');</script>	

	//Grab existing cart info again, just in case it's new
	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);

	// Add the phone to the cart
	$phone_price = $phone['msrp'] - $phone["instant".$pricing_level."-1"] - $phone["instant".$pricing_level."-2"] - $phone["mail_in".$pricing_level."-1"] - $phone["mail_in".$pricing_level."-2"];
	// If no record found, insert one
	// NEED TO MAKE THIS MORE GENERIC - KINDA HARD-CODED FOR APPLE/SPRINT
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
			'".$phone['carrier']."',
			'".$config['label']."',
			'".$config['sprint_discount']."',
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
		'".$phone['product_id']."',
		'".$phone['manufacturer']."',
		'".$phone['model']."',
		'".$phone['phone_type']."',
		'".$phone['product_type']."',
		'".$phone['msrp']."',
		'".$phone["instant".$pricing_level."-1"]."',
		'".$phone["instant".$pricing_level."-2"]."',
		'".$phone["mail_in".$pricing_level."-1"]."',
		'".$phone["mail_in".$pricing_level."-2"]."',
		'".$phone_price."',
		NOW())";
//echo $query.'<br></br>';
	$rs_insert = mysql_query($query, $linkID);
	// Send them somewhere
//	header("Location: ".$_SERVER['HTTP_REFERER']);
//	header("Location: /");
//	exit;
	}
}

// Accessories
for ($acc_num=1; $acc_num <= 5; $acc_num++){
	// Grab accessory data
	if ($accessory_id[$acc_num] != ""){
		$rs_accessory = mysql_query("SELECT * FROM accessories WHERE product_id = '".$accessory_id[$acc_num]."' AND display <> 'N'", $linkID);
		if (mysql_num_rows($rs_accessory) == false){ // No accessory found
			$message = "Accessory is Currently Not Available";
			$destination = "/?sec=cart&message=".$message."&sid=".$SID;
	//echo $destination;
			header("Location: $destination");
			exit;
		}
		$accessory = mysql_fetch_assoc($rs_accessory);
		$message = "";

//echo '<script>alert('.$accessory_id[$acc_num].');</script>';

	//Grab existing cart info again, just in case it's new
	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);

	// Add the phone to the cart
	$acc_price = $accessory['msrp'] - $accessory["instant".$pricing_level."-1"] - $accessory["instant".$pricing_level."-2"] - $accessory["mail_in".$pricing_level."-1"] - $accessory["mail_in".$pricing_level."-2"];
	// If no record found, insert one
	// NEED TO MAKE THIS MORE GENERIC - KINDA HARD-CODED FOR APPLE/SPRINT
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
			'".$phone['carrier']."',
			'".$config['label']."',
			'".$config['sprint_discount']."',
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
		'".$accessory['product_id']."',
		'".$accessory['manufacturer']."',
		'".$accessory['model']."',
		'".$accessory['phone_type']."',
		'".$accessory['product_type']."',
		'".$accessory['msrp']."',
		'".$accessory["instant".$pricing_level."-1"]."',
		'".$accessory["instant".$pricing_level."-2"]."',
		'".$accessory["mail_in".$pricing_level."-1"]."',
		'".$accessory["mail_in".$pricing_level."-2"]."',
		'".$acc_price."',
		NOW())";
//echo $query.'<br></br>';
	$rs_insert = mysql_query($query, $linkID);
	// Send them somewhere
//	header("Location: ".$_SERVER['HTTP_REFERER']);
//	header("Location: /");
//	exit;
	}
}

// Send them somewhere
//header("Location: ".$_SERVER['HTTP_REFERER']);
header("Location: /");
exit;

?>
