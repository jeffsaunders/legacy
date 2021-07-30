<?
// Connect to the database
include "../dbconnect.php";
// Now, what to do...what to do?
switch($_REQUEST['task']){

///////CHANGE ALL THE TABLE NAMES FROM "_test"!!!!!!!!!!!!!!!!

case "addphone":	// Put a phone in the phones table
	// if manufacturer_new <> "" then make it manufacturer
	if ($_REQUEST['manufacturer_new'] != ""){
		$manufacturer = $_REQUEST['manufacturer_new'];
	}else{
		$manufacturer = $_REQUEST['manufacturer'];
	}
	// hard code MIR2 values and calc flat-rate
	if ($_REQUEST['carrier'] == "Sprint" || $_REQUEST['carrier'] == "Nextel"){
		$carrier = $_REQUEST['carrier'];
		$mail_in1 = 0;
		$mail_in2 = 50;
		$mail_in3 = 100;
		$mail_in4 = 60;
		$flat_rate = ($_REQUEST['msrp'] - $_REQUEST['flat_rate']);
		// equate sprint service values to the right column to make true
		$sprint_pcs = "F";
		$sprint_pcs_vision = "F";
		$sprint_power_vision = "F";
		if ($_REQUEST['sprint_service'] == "PCS") $sprint_pcs = "T";
		if ($_REQUEST['sprint_service'] == "Vision") $sprint_pcs_vision = "T";
		if ($_REQUEST['sprint_service'] == "PVision") $sprint_power_vision = "T";
	}else if ($_REQUEST['carrier'] == "ATT"){
		$carrier = "AT&T";
		$mail_in1 = 0;
		$mail_in2 = 50;
		$mail_in3 = 0;
		$mail_in4 = 0;
		$flat_rate = 0;
	}
	$query =
		"INSERT INTO `phones_test` (
		`carrier`,
		`manufacturer`,
		`model`,
		`label`,
		`thumbnail`,
		`description`,
		`bullet1`,
		`bullet2`,
		`bullet3`,
		`hookline`,
		`display`,
		`size`,
		`weight`,
		`talk_time`,
		`band`,
		`msrp`,
		`instant1-1`,
		`instant1-2`,
		`mail_in1-1`,
		`mail_in1-2`,
		`instant2-1`,
		`instant2-2`,
		`mail_in2-1`,
		`mail_in2-2`,
		`instant3-1`,
		`instant3-2`,
		`mail_in3-1`,
		`mail_in3-2`,
		`instant4-1`,
		`instant4-2`,
		`mail_in4-1`,
		`mail_in4-2`,
		`instant5-1`,
		`instant5-2`,
		`mail_in5-1`,
		`mail_in5-2`,
		`phone_type`,
		`sprint_pcs`,
		`sprint_pcs_vision`,
		`sprint_power_vision`,
		`nextel_dual_mode`,
		`nextel_easy_office`,
		`nextel_mapquest`,
		`nextel_trimble_gps`,
		`nextel_intl_data`,
		`nextel_games`,
		`at&t_xpress_mail`,
		`at&t_telenav`,
		`at&t_pda4bb`,
		`at&t_push_talk`,
		`at&t_media_basic`,
		`at&t_media_works`,
		`at&t_media_max`,
		`at&t_video_share`,
		`at&t_3g`)
		VALUES (
		'".addslashes($carrier)."',
		'".addslashes($manufacturer)."',
		'".addslashes($_REQUEST['model'])."',
		'".addslashes($_REQUEST['label'])."',
		'".addslashes($_REQUEST['thumbnail'])."',
		'".addslashes($_REQUEST['description'])."',
		'".addslashes($_REQUEST['bullet1'])."',
		'".addslashes($_REQUEST['bullet2'])."',
		'".addslashes($_REQUEST['bullet3'])."',
		'".addslashes($_REQUEST['hookline'])."',
		'".$_REQUEST['display']."',
		'".addslashes($_REQUEST['size'])."',
		'".addslashes($_REQUEST['weight'])."',
		'".addslashes($_REQUEST['talk_time'])."',
		'".addslashes($_REQUEST['band'])."',
		'".$_REQUEST['msrp']."',
		'".$_REQUEST['ir1']."',
		'".$_REQUEST['ir2']."',
		'".$_REQUEST['mir1']."',
		'".$mail_in1."',
		'".$_REQUEST['ir1']."',
		'".$_REQUEST['ir2']."',
		'".$_REQUEST['mir1']."',
		'".$mail_in2."',
		'".$_REQUEST['ir1']."',
		'".$_REQUEST['ir2']."',
		'".$_REQUEST['mir1']."',
		'".$mail_in3."',
		'".$_REQUEST['ir1']."',
		'".$_REQUEST['ir2']."',
		'".$_REQUEST['mir1']."',
		'".$mail_in4."',
		'".$flat_rate."',
		'0',
		'0',
		'0',
		'".$_REQUEST['phone_type']."',
		'".$sprint_pcs."',
		'".$sprint_pcs_vision."',
		'".$sprint_power_vision."',
		'".$_REQUEST['nextel_dual_mode']."',
		'".$_REQUEST['nextel_easy_office']."',
		'".$_REQUEST['nextel_mapquest']."',
		'".$_REQUEST['nextel_trimble_gps']."',
		'".$_REQUEST['nextel_intl_data']."',
		'".$_REQUEST['nextel_games']."',
		'".$_REQUEST['at&t_xpress_mail']."',
		'".$_REQUEST['at&t_telenav']."',
		'".$_REQUEST['at&t_pda4bb']."',
		'".$_REQUEST['at&t_push_talk']."',
		'".$_REQUEST['at&t_media_basic']."',
		'".$_REQUEST['at&t_media_works']."',
		'".$_REQUEST['at&t_media_max']."',
		'".$_REQUEST['at&t_video_share']."',
		'".addslashes($_REQUEST['at&t_3g'])."');";
//echo $query.'<br></br>';
	$rs_insert = mysql_query($query, $linkID);
//if ($rs_insert != false) echo "Success!<br></br>";
//if ($rs_insert == false) echo "Failed!<br></br>";
//echo mysql_insert_id($linkID).'<br></br>';
	// Get the unique_id of the new phone record and use it to set the product_id to the value of the unique_id with a leading "10", or "1" if we roll past 999
	$product_id = mysql_insert_id($linkID)+10000;
	// Update it
	$query = "UPDATE `phones_test` SET `product_id` = '".$product_id."' WHERE `unique_id` = '".mysql_insert_id($linkID)."'";
//echo $query.'<br></br>';
	$rs_product_id = mysql_query($query, $linkID);
	// Now step through all the features and insert them
	for ($counter=1; $counter <= 20; $counter++){
		if ($_REQUEST['feature'.$counter] != ""){
			$query =
				"INSERT INTO `phone_features_test` (
				`product_id`,
				`feature`)
				VALUES (
				'".$product_id."',
				'".addslashes($_REQUEST['feature'.$counter])."');";
//echo $query.'<br></br>';
			$rs_insert = mysql_query($query, $linkID);
		}
	}
	// Tell 'em what you did
//	$message = preg_replace(array('/&/'), array('±'), $_REQUEST['phone_manuf'].' '.$_REQUEST['phone_model'].' Added to Cart');
	// Send 'em somewhere
//	header("Location: /?sec=cart&message=$message&sid=$SID");
	exit;
	break;

}; // End Switch
?>
