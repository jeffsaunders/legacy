<?php
$dbServer = "192.168.15.100";
$dbUsername = "eWNWebSites";
$dbPassword = "zNyU59LFry5E9ajf";

if (!($emsLink = mysql_connect($dbServer, $dbUsername, $dbPassword))){
	die("<h3>Error - Could Not Connect to eWomen Events Database</h3>".mysql_error()."\n");
}
mysql_select_db("ems", $emsLink);

if (!($ewnLink = mysql_connect($dbServer, $dbUsername, $dbPassword, true))){
	die("<h3>Error - Could Not Connect to eWomen Members Database</h3>".mysql_error()."\n");
}
mysql_select_db("ewomen", $ewnLink);

if (!($confLink = mysql_connect($dbServer, $dbUsername, $dbPassword, true))){
	die("<h3>Error - Could Not Connect to eWomen Conference Database</h3>".mysql_error()."\n");
}
mysql_select_db("conference", $confLink);

//decrypt
function decrypt($value, $key){
		if(!$value || !$key){
			return false;
		}
		$td = mcrypt_module_open('rijndael-256', '', 'ecb', '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$decryptedValue = mdecrypt_generic($td, base64_decode($value));
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		return $decryptedValue;
	}
$today = date("Y-m-d");
$dataKey = base64_decode('d2Vscm47d2xrZW5yd2VvaWowMiE5bm4=');
$billing_sql = "SELECT * FROM `billing` WHERE `date_to_bill` < NOW() AND (`date_processed` =  '0000-00-00' OR `date_processed` IS NULL);";
$billing_result = mysql_query($billing_sql, $confLink);
for ($counter=1; $counter <= mysql_num_rows($billing_result); $counter++)
	{
	//unset vars
	unset($user_id);
	unset($description);
	unset($amount);
	unset($first_name);
	unset($last_name);
	unset($company);
	unset($address);
	unset($city);
	unset($state);
	unset($zip);
	unset($country);
	unset($phone);
	unset($email);
	unset($last_four);
	unset($card_num);
	unset($exp_date);
	unset($transaction_id);
	unset($transaction_type);
	unset($auth_code);
	unset($response_code);
	unset($reason_code);
	unset($reason_text);
	unset($avs_code);
	$billing_row = mysql_fetch_assoc($billing_result);
	print "<pre>";
	print_r($billing_row);
	print "</pre>";
	$user_id = $billing_row['user_id'];
	$reg_id = $billing_row['reg_id'];
	$billing_id = $billing_row['id'];
	$amount = $billing_row['payment_amount'];
	$card_num_hash = $billing_row['cc_num'];
	$card_num = decrypt($card_num_hash, $dataKey);
	$exp_m_hash = $billing_row['exp_m'];
	$exp_m = decrypt($exp_m_hash, $dataKey);
	$exp_m = trim($exp_m);
	$exp_y_hash = $billing_row['exp_y'];
	$exp_y = decrypt($exp_y_hash, $dataKey);
	$exp_y = trim($exp_y);
	$exp_date = $exp_m."/".$exp_y;
	$last_four = $billing_row['last_four'];
	$description = $billing_row['description'];
	//get_user_info
	$user_sql = "SELECT * from `registrants` WHERE `registration_id` = '$reg_id';";
	print $user_sql;
	$user_result = mysql_query($user_sql, $confLink);
	$user_row = mysql_fetch_assoc($user_result);
	/*print "<pre>";
	print_r($user_row);
	print "</pre>";*/
	$first_name = $user_row['first_name'];
	$last_name = $user_row['last_name'];
	$company = $user_row['company'];
	$address = $user_row['address_1']." ".$user_row['address_2'];
	$city = $user_row['city'];
	$state = $user_row['state_province'];
	$zip = $user_row['postal_code'];
	$country = $user_row['country'];
	$phone = $user_row['primary_phone'];
	$email = $user_row['email_address'];
	//processing
	require_once 'anet_php_sdk/AuthorizeNet.php'; // Make sure this path is correct.
	$transaction = new AuthorizeNetAIM('ewn1234', '2G6Pa9FN6Fas46sW');
	//$transaction = new AuthorizeNetAIM('5ps7rfG7Y9', '5k33d8qEX3Dp9N7Z');
	$transaction->amount = number_format($amount, 2, '.', '');
	$transaction->card_num = $card_num;
	$transaction->exp_date = $exp_date;
	$transaction->description = $description;
	$transaction->cust_id = $user_id;
	$transaction->first_name = $first_name;
	$transaction->last_name = $last_name;
	$transaction->company = $company;
	$transaction->address = $address;
	$transaction->city = $city;
	$transaction->state = $state;
	$transaction->zip = $zip;
	$transaction->country = $country;
	$transaction->phone = $phone;
	$transaction->email = $email;

	$response = $transaction->authorizeAndCapture();

	$transaction_id = $response->transaction_id;
	$transaction_type = $response->transaction_type;
	$auth_code = $response->authorization_code;
	$response_code = $response->response_code;
	$reason_code = $response->response_reason_code;
	$reason_text = $response->response_reason_text;
	$avs_code = $response->avs_response;
	//print "<br><br><br>";
	//print_r($response);
	//if successful, update billing record `date_processed` = NOW()
	if($response_code == "1")
		{
		$update_sql = "UPDATE `billing` SET `date_processed` = '$today' WHERE id = '$billing_id';";
		//print $update_sql;;
		mysql_query($update_sql, $confLink);
		}
	//insert record into `transactions`
	$transaction_sql = "INSERT INTO `transactions` (`id`, `user_id`, `last_four`, `amount`, `description`, `transaction_id`, `transaction_type`, `auth_code`, `response_code`, `reason_code`, `reason_text`, `avs_code`, `date_submitted`) VALUES ('', '$user_id', '$last_four', '$amount', '$description', '$transaction_id', '$transaction_type', '$auth_code', '$response_code', '$reason_code', '$reason_text', '$avs_code', now());";
		mysql_query($transaction_sql, $confLink);
	}
//include script to send report to accounting
include("/var/www/ewn2/scott/conference/conf_transaction_report.php");
?>