<?php
$amount = "10.00";
$card_num = "5555555555554444";
$exp_date = "11/16";
$description = "This is a test charge";
$user_id = "12345";
$first_name = "John";
$last_name = "Doe";
$company = "ACME";
$address = "1234 Any St.";
$city = "Anytown";
$state = "WI";
$zip = "53119";
$country = "USA";
$phone = "8005551212";
$email = "scott@360computing.com";


	require_once 'anet_php_sdk/AuthorizeNet.php'; // Make sure this path is correct.
	//$transaction = new AuthorizeNetAIM('ewn1234', '2G6Pa9FN6Fas46sW');
	$transaction = new AuthorizeNetAIM('5ps7rfG7Y9', '5k33d8qEX3Dp9N7Z');
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
	print "<br><br><br>";
	print_r($response);
?>