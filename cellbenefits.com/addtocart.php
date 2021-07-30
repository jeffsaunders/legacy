<?
session_start();
$SID = $_SESSION['SID'];
// test for session id; if none or mismatch they deep-linked, force them to start new reservation
//echo $SID.'<br>';
//echo $_SERVER['HTTP_REFERER'];
if (!$SID){ echo'<script>window.location="/?sec=home";</script>'; exit;}

// Connect to the database
include "dbconnect.php";

//Grab existing cart info, if it exists
$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
$rs_cart = mysql_query($query, $linkID);

// If no record found, insert one
if (mysql_num_rows($rs_cart) == false){
	$query =
		"INSERT INTO orders (
		session_id,
		order_num,
		ipaddress,
		carrier,
		phone1_id,
		phone1_manuf,
		phone1_model,
		phone1_msrp,
		phone1_ir1,
		phone1_ir2,
		phone1_mir1,
		phone1_mir2,
		phone1_price,
		phone1_time)
		VALUES (
		'".$SID."',
		UNIX_TIMESTAMP(),
		'".getenv('REMOTE_ADDR')."',
		'".$_REQUEST['carrier']."',
		'".$_REQUEST['phone_id']."',
		'".$_REQUEST['phone_manuf']."',
		'".$_REQUEST['phone_model']."',
		'".$_REQUEST['phone_msrp']."',
		'".$_REQUEST['phone_ir1']."',
		'".$_REQUEST['phone_ir2']."',
		'".$_REQUEST['phone_mir1']."',
		'".$_REQUEST['phone_mir2']."',
		'".$_REQUEST['phone_price']."',
		NOW())";
//echo $query.'<br></br>';
	$rs_insert = mysql_query($query, $linkID);

//echo mysql_affected_rows($rs_insert).'<br></br>';
//echo $_REQUEST["carrier"].'<br>';
//echo $_REQUEST["phone_id"].'<br>';
//echo $_REQUEST["phone_manuf"].'<br>';
//echo $_REQUEST["phone_model"].'<br>';
//echo $_REQUEST["phone_msrp"].'<br>';
//echo $_REQUEST["phone_ir1"].'<br>';
//echo $_REQUEST["phone_ir2"].'<br>';
//echo $_REQUEST["phone_mir1"].'<br>';
//echo $_REQUEST["phone_mir2"].'<br>';
//echo $_REQUEST["phone_price"].'<br>';
//	echo'<script>alert("'.$_REQUEST['phone_manuf'].' '.$_REQUEST['phone_model'].' Added to Cart");</script>';

	// send them to the cart eventually, but for now just send them back
	echo'<script>window.location="'.$_SERVER['HTTP_REFERER'].'";</script>';
	exit;
}else{
	$row = mysql_fetch_assoc($rs_cart);
	for ($counter=1; $counter <= 5; $counter++){
		if ($row['phone'.$counter.'_id'] == ""){
			$query =
				"UPDATE orders SET
				phone".$counter."_id = '".$_REQUEST['phone_id']."',
				phone".$counter."_manuf = '".$_REQUEST['phone_manuf']."',
				phone".$counter."_model = '".$_REQUEST['phone_model']."',
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
			echo'<script>window.location="'.$_SERVER['HTTP_REFERER'].'";</script>';
			exit;
		};
	};
	// if reach here then cart is full - tell 'em!
	echo 'Cart Full!';
};

?>
<!-- BEGIN addtocart.php -->
