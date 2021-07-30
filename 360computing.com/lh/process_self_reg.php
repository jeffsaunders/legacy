<?php include_once("include/dbconnect.php"); ?>
<?php
/*print "<pre>";
print_r($_POST);
print "</pre>";*/
function encrypt($value, $key){
		if(!$value || !$key){
			return false;
		}
		$td = mcrypt_module_open('rijndael-256', '', 'ecb', '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$encryptedValue = mcrypt_generic($td, $value);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		return base64_encode( $encryptedValue );
	}
$dataKey = base64_decode('d2Vscm47d2xrZW5yd2VvaWowMiE5bm4=');
foreach($_POST as $key => $value)
	{
	$$key = strip_tags($value);
	}

//get ewn status
if ($member == "Y")
	{
	$ewn_status = "Active";
	$is_ewn_member = "Yes";
	}
	else
		{
		$is_ewn_member = "No";
		$ewn_id = "0";
		}

//figure out payment plan
if ($threepay == "3-Pay")
	{
	$payment_plan = "3-Pay";
	}
	else
		{
		$payment_plan = "1-Pay";
		}

//is from canada
if ($country == "Canada")
	{
	$is_from_canada = "Yes";
	}
	else
		{
		$is_from_canada = "No";
		}

//get as many of the flags as we can for the insert
$flag_sql = "SELECT * FROM `u_flag` WHERE `user_id` = '$ewn_id';";
$flag_result = mysql_query($flag_sql, $ewnLink);
$flag_row = mysql_fetch_assoc($flag_result);

//get platinum info
$platinum_flag = $flag_row['platinum'];
if($platinum_flag = "Y")
	{
	$is_platinum_member = "Yes";
	}
	else
		{
		$is_platinum_member = "No";
		}

//get MD info
$managing_director_flag = $flag_row['managing_director'];
if($managing_director_flag = "Y")
	{
	$is_managing_director = "Yes";
	}
	else
		{
		$is_managing_director = "No";
		}

//get chairmans_circle info
$chairmans_circle_flag = $flag_row['chairmans_circle'];
if($chairmans_circle_flag = "Y")
	{
	$is_chairmans_circle_member = "Yes";
	}
	else
		{
		$is_chairmans_circle_member = "No";
		}

// Get current conference info
$query = "
	SELECT *, UNIX_TIMESTAMP(start_date) AS start_date_ts, UNIX_TIMESTAMP(end_date) AS end_date_ts
	FROM conferences
	WHERE active = 1
	ORDER BY start_date DESC
	LIMIT 1
";
//echo $query."<br>";
$rs_conference = mysql_query($query, $confLink);
$conference = mysql_fetch_assoc($rs_conference);

// Get the next available registration number
	$query = "
		SELECT MAX(registration_id)+1
		FROM registrants
	";
	//echo $query."<br>";
	$rs_regID = mysql_query($query, $confLink);
	$regID = mysql_fetch_row($rs_regID);
	$registration_id = $regID[0];
//print $registration_id;
$insert_reg_sql = "
		INSERT INTO registrants (
			registration_id,
			conference,
			user_id,
			ewn_status,
			title,
			first_name,
			middle_name,
			last_name,
			suffix,
			company,
			occupation,
			address_1,
			address_2,
			city,
			state_province,
			postal_code,
			country,
			primary_phone,
			secondary_phone,
			email_address,
			payment_plan,
			reg_status,
			registered_by,
			cost,
			source_code,
			imported,
			registered_date)
			VALUES (
			'".$registration_id."',
			'".$conference['conference_id']."',
			'".$ewn_id."',
			'".$ewn_status."',
			'".addslashes($_REQUEST['title'])."',
			'".addslashes($_REQUEST['first_name'])."',
			'".addslashes($_REQUEST['middle_name'])."',
			'".addslashes($_REQUEST['last_name'])."',
			'".addslashes($_REQUEST['suffix'])."',
			'".addslashes($_REQUEST['company'])."',
			'".addslashes($_REQUEST['occupation'])."',
			'".addslashes($_REQUEST['address_1'])."',
			'".addslashes($_REQUEST['address_2'])."',
			'".addslashes($_REQUEST['city'])."',
			'".$state_province."',
			'".$_REQUEST['postal_code']."',
			'".addslashes($_REQUEST['country'])."',
			'".$_REQUEST['phone_1']."',
			'".$_REQUEST['phone_2']."',
			'".$_REQUEST['email_address']."',
			'".$payment_plan."',
			'Registered',
			'Self',
			'".$price."',
			'".$source_code."',
			'1',
			NOW())
		";
/*print "<pre>";
print $insert_reg_sql;
print "</pre>";*/

//insert registrant
mysql_query($insert_reg_sql, $confLink);

$card_num = encrypt($number_on_card, $dataKey);
//explode the exp date into $exp_m and $exp_y and encrypt them both
$pieces = explode("/", $exp_on_card);
$exp_m = encrypt($pieces['0'], $dataKey);
$exp_y = encrypt($pieces['1'], $dataKey);

$description = "eWomenNetwork Annual International Conference & Business Expo Registration Payment for ".$first_name." ".$last_name.".";

//get dates
$payment_1_date = date("m/d/Y");
$payment_2_date = date("m/d/Y", strtotime("+1 month"));
$payment_3_date = date("m/d/Y", strtotime("+2 months"));

//Create the billing records
//insert billing records into billing table
//$registration_id = "69";
for ($payment_counter=1; $payment_counter <= $number_of_payments; $payment_counter++)
	{
	//switch statement to assign dates and payment amounts
	switch ($payment_counter) {
    case 1:
		$this_payment_amount = $payment_amount;
        $this_date_to_bill = date("Y-m-d", strtotime($payment_1_date));
        break;
    case 2:
        $this_payment_amount = $payment_amount;
        $this_date_to_bill = date("Y-m-d", strtotime($payment_2_date));
        break;
    case 3:
        $this_payment_amount = $payment_amount;
        $this_date_to_bill = date("Y-m-d", strtotime($payment_3_date));
        break;
}
	$billing_insert_sql = "INSERT into `billing` (id, user_id, cc_num, exp_m, exp_y, last_four, payment_amount, payment_num, description, date_to_bill, reg_id) VALUES ('', '$ewn_id', '$card_num', '$exp_m', '$exp_y', '$last_four', '$this_payment_amount', '$payment_counter', '$description', '$this_date_to_bill', '$registration_id');";
	//print "<br><br>";
	//print $billing_insert_sql;
	
	//insert billing record
	mysql_query($billing_insert_sql, $confLink);
	//print "<br>";
	}
//email connie and bridget
$message = $first_name." ".$last_name." Self registered for the (2014) 14th Annual International Conference & Business Expo";
$subject = $first_name." ".$last_name." Self registered for the (2014) 14th Annual International Conference & Business Expo";
// Additional headers
$header .= 'From: eWomenNetwork Conference <Conference@eWomenNetwork.com>' . "\r\n";
// Mail it
$to = "connie.smith@ewomennetwork.net";
mail($to, $subject, $message, $header);
$to2 = "bridget.arnott@ewomennetwork.net";
mail($to2, $subject, $message, $header);
?>
<meta http-equiv="REFRESH" content="0; url=self_reg_complete.php">