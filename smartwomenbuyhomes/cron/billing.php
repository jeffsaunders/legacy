<?php
ini_set( 'memory_limit', '200M' );
set_time_limit( 0 );

// Open log
$logFile = './billing.log';
$fp = fopen($logFile, 'a');

// Connect to database
if (!($linkID = mysql_connect("192.168.15.100","swbh","6f3f749c5bb4c0cf"))){
	fwrite($fp, "Error - Could Not Connect to Database\n\n");
	fclose($fp);
	exit;
}
mysql_select_db("swbh", $linkID);

// Read in the config settings
$query = "
	SELECT *
	FROM config
	LIMIT 1
";
$rs_config = mysql_query($query, $dbhandle);
$config = mysql_fetch_assoc($rs_config);

// Set some values
$now = time();
$todayStart = mktime(0, 0, 0, date('n'), date('j'));
$todayEnd = mktime(0, 0, 0, date('n'), date('j') + 1);

// Grab the ones that need to be billed (renewing today)
$query = "
	SELECT *
	FROM members
	WHERE renewal_date BETWEEN ".$todayStart." AND ".$todayEnd."
";
//echo $query;
$rs_members = mysql_query($query, $dbhandle);

// Run their cards

// Live
$store_name = $config['fd_store_name'];
$store_number = $config['fd_store_number'];
$store_id = $config['fd_store_id'];
$password = $config['fd_password'];
$api_host = $config['fd_api_host'];
$cert_location = $config['fd_cert_location'];
$cert_password = $config['fd_cert_password'];

//$store_name = "SMART WOMEN BUY HOMES";
//$store_number = "1001324984";
//$store_id = "324984";
//$password = "121771sd";
//$api_host = "https://ws.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl";
//$cert_location = "/var/www/html/smartwomenbuyhomes.com/certs";
//$cert_password = "";

// Test Mode - override the config settings
$store_name = "Smart Women Buy Homes";
$store_number = "1909834738";
$store_id = "834738";
$password = "xSv9vrJ5";
$api_host = "https://ws.merchanttest.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl";
$cert_location = "/var/www/html/smartwomenbuyhomes.com/certs";
$cert_password = "ckp_1365734023";

$sub_total = $config['renewal_price'];
$shipping = 0;
if ($_REQUEST['billing_state'] == "TX"){
	$sales_tax = round(($config['renewal_price'] * .0825), 2); // 8.25%
}else{
	$sales_tax = 0;
}
$total = $sub_total + $shipping + $sales_tax;

// Let's DO IT!
while ($member = mysql_fetch_assoc($rs_members)){
	// Decrypt payment information

///////////////////////////////////////////////////////////////////////////////////////////////////







	// Build the transaction XML in a SOAP container
	$body = '
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
	<SOAP-ENV:Header/>
	<SOAP-ENV:Body>
		<fdggwsapi:FDGGWSApiOrderRequest xmlns:v1="http://secure.linkpt.net/fdggwsapi/schemas_us/v1" xmlns:v3="http://secure.linkpt.net/fdggwsapi/schemas_us/a1" xmlns:fdggwsapi="http://secure.linkpt.net/fdggwsapi/schemas_us/fdggwsapi">
			<v1:Transaction>
				<v1:CreditCardTxType>
					<v1:Type>sale</v1:Type>
				</v1:CreditCardTxType>
				<v1:CreditCardData>
					<v1:CardNumber>'.$_REQUEST['cc_number'].'</v1:CardNumber>
					<v1:ExpMonth>'.$_REQUEST['cc_exp_month'].'</v1:ExpMonth>
					<v1:ExpYear>'.$_REQUEST['cc_exp_year'].'</v1:ExpYear>
					<v1:CardCodeValue>'.$_REQUEST['cc_cvv'].'</v1:CardCodeValue>
				</v1:CreditCardData>
				<v1:Payment>
					<v1:ChargeTotal>'.$total.'</v1:ChargeTotal>
					<v1:SubTotal>'.$sub_total.'</v1:SubTotal>
					<v1:Tax>'.$sales_tax.'</v1:Tax>
					<v1:Shipping>'.$shipping.'</v1:Shipping>
				</v1:Payment>
				<v1:TransactionDetails>
					<v1:Ip>'.getenv('REMOTE_ADDR').'</v1:Ip>
					<v1:TerminalType>Unspecified</v1:TerminalType>
					<v1:TransactionOrigin>ECI</v1:TransactionOrigin>
				</v1:TransactionDetails>
				<v1:Billing>
					<v1:CustomerID>'.$_REQUEST['member_id'].'</v1:CustomerID>
					<v1:Name>'.$_REQUEST['cc_name'].'</v1:Name>
					<v1:Company>'.$member['company_name'].'</v1:Company>
					<v1:Address1>'.$_REQUEST['billing_address_1'].'</v1:Address1>
					<v1:Address2>'.$_REQUEST['billing_address_2'].'</v1:Address2>
					<v1:City>'.$_REQUEST['billing_city'].'</v1:City>
					<v1:State>'.$_REQUEST['billing_state'].'</v1:State>
					<v1:Zip>'.$_REQUEST['billing_zip_code'].'</v1:Zip>
					<v1:Country>USA</v1:Country>
					<v1:Phone>'.$_REQUEST['billing_phone'].'</v1:Phone>
					<v1:Email>'.$member['email'].'</v1:Email>
				</v1:Billing>
			</v1:Transaction>
		</fdggwsapi:FDGGWSApiOrderRequest>
	</SOAP-ENV:Body>
</SOAP-ENV:Envelope>
	';

//echo "<pre>";
//echo htmlentities($body);
//echo "<br><br>";
//echo "</pre>";

// Send 'er in
// initializing cURL with the FDGGWS API URL:
$ch = curl_init($api_host);
// setting the request type to POST:
curl_setopt($ch, CURLOPT_POST, 1);
// setting the content type:
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
// setting the authorization method to BASIC:
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
// supplying your credentials:
curl_setopt($ch, CURLOPT_USERPWD, "WS".$store_number."._.1:".$password);
//	curl_setopt($ch, CURLOPT_USERPWD, "WS1909834738._.1:xSv9vrJ5");
// filling the request body with your SOAP message:
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
// configuring cURL not to verify the server certificate:
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// setting the path where cURL can find the client certificate:
curl_setopt($ch, CURLOPT_SSLCERT, $cert_location."/WS".$store_number."._.1.pem");
// setting the path where cURL can find the client certificate’s private key:
curl_setopt($ch, CURLOPT_SSLKEY, $cert_location."/WS".$store_number."._.1.key");
// setting the key password:
curl_setopt($ch, CURLOPT_SSLKEYPASSWD, $cert_password);
// telling cURL to return the HTTP response body as operation result value when calling curl_exec:
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// calling cURL and saving the SOAP response message in a variable which contains a string like "<SOAP-ENV:Envelope ...>...</SOAP-ENV:Envelope>":
$result = curl_exec($ch);

//echo "<pre>";
//echo htmlentities($result);
////print_r($result);
//echo "<br><br>";
//print_r(curl_getinfo($ch));
//echo "<br><br>";
//echo curl_error($ch);
//echo "<br><br>";
//echo "</pre>";

// Parse the results

// Functions to make it easier
// Make sure the transaction succeeded overall
function getTransactionResult($result){
	$start = strpos($result, '<fdggwsapi:TransactionResult>');
	$stop = strpos($result, '</fdggwsapi:TransactionResult>');
	if($start !== false){
		$start = $start + 29; // length of the opening tag
		$length = $stop - $start; // length of the data
		return substr($result, $start, $length); // "APPROVED" if all went well
	}else{
		return 'FAILED';
	}
}

// extract the returned values
function getTransactionValue($result, $tag){
	$start = strpos($result, '<fdggwsapi:'.$tag.'>');
	$stop = strpos($result, '</fdggwsapi:'.$tag.'>');
	$start = $start + (strlen($tag) + 12); // length of the tag
	$length = $stop - $start; // length of the data
	return substr($result, $start, $length); // the data
}

if (getTransactionResult($result) == 'FAILED'){
	$success = false;
}else{
	$success = true;
}
// Indicates your provider
$CommercialServiceProvider = getTransactionValue($result, "CommercialServiceProvider");
// The time stamp set by the First Data Global Gateway Web Service API before returning the transaction approval.
$TransactionTime = getTransactionValue($result, "TransactionTime");
// The reference number returned by the processor. This value may be empty
$ProcessorReferenceNumber = getTransactionValue($result, "ProcessorReferenceNumber");
// In case of an approval, this element contains the following string: "APPROVED"
$ProcessorResponseMessage = getTransactionValue($result, "ProcessorResponseMessage");
// Response Code from the credit card processor
$ProcessorResponseCode = getTransactionValue($result, "ProcessorResponseCode");
// Approval Code from the credit card processor
$ProcessorApprovalCode = getTransactionValue($result, "ProcessorApprovalCode");
// Error Message. This element is empty in case of an approval
$ErrorMessage = getTransactionValue($result, "ErrorMessage");
// This element contains the order ID. For Sale, PreAuth, ForceTicket, and Credit transactions, a new order ID is returned. For PostAuth, Return, and Void transactions, supply this number in the v1:OrderId element for identifying the transaction to which you refer. The fdggwsapi:OrderId element of a response to a PostAuth, Return, or Void transaction simply returns the order ID of the original transaction. The OrderId generated by Web Service can have a maximum of 100 digits.
$OrderId = getTransactionValue($result, "OrderId");
// The approval code returned by the processor. This value may be empty. Not sure why this is differnet than the ProcessorApprovalCode.
$ApprovalCode = getTransactionValue($result, "ApprovalCode");
// Address Verification System (AVS) response
$AVSResponse = getTransactionValue($result, "AVSResponse");
// The TDate required for Void transactions. Only returned for Sale, ForcedTicket, and PostAuth.
$TDate = getTransactionValue($result, "TDate");
// The transaction result. Always APPROVED in case of an approval. Seems a bit redundant.
$TransactionResult = getTransactionValue($result, "TransactionResult");
// The Transaction ID used for this transaction.
$TransactionID = getTransactionValue($result, "TransactionID");
// Calculated tax for the transaction
$CalculatedTax = getTransactionValue($result, "CalculatedTax");
// Calculated shipping for the transaction.
$CalculatedShipping = getTransactionValue($result, "CalculatedShipping");
// A numerical value indicating the risk of fraud on the transaction. Higher values indicate a greater risk of fraud. The actual range used for this field has not yet been defined.  This field is only returns a value for merchants who use the optional, add-on Fraud Service.
$TransactionScore = getTransactionValue($result, "TransactionScore");
// Three (3) digit response code returned by processor for 3D Secure enabled transactions. This field only returns a value for 3D Secure transactions for merchants who use this optional, add-on service.
$AuthenticationResponseCode = getTransactionValue($result, "AuthenticationResponseCode");
// This element can contain any of the following values: "ACCEPT", "REJECT", "ERROR", or "REVIEW".
$FraudAction = getTransactionValue($result, "FraudAction");

// closing cURL:
curl_close($ch);

/*// Handy displays
echo "Success = ";
echo $success."<br><br>";
echo "CommercialServiceProvider = ";
echo $CommercialServiceProvider;
echo "<br><br>TransactionTime = ";
echo $TransactionTime;
echo "<br><br>ProcessorReferenceNumber = ";
echo $ProcessorReferenceNumber;
echo "<br><br>ProcessorResponseMessage = ";
echo $ProcessorResponseMessage;
echo "<br><br>ProcessorResponseCode = ";
echo $ProcessorResponseCode;
echo "<br><br>ProcessorApprovalCode = ";
echo $ProcessorApprovalCode;
echo "<br><br>ErrorMessage = ";
echo $ErrorMessage;
echo "<br><br>OrderId = ";
echo $OrderId;
echo "<br><br>ApprovalCode = ";
echo $ApprovalCode;
echo "<br><br>AVSResponse = ";
echo $AVSResponse;
echo "<br><br>TDate = ";
echo $TDate;
echo "<br><br>TransactionResult = ";
echo $TransactionResult;
echo "<br><br>TransactionID = ";
echo $TransactionID;
echo "<br><br>CalculatedTax = ";
echo $CalculatedTax;
echo "<br><br>CalculatedShipping = ";
echo $CalculatedShipping;
echo "<br><br>TransactionScore = ";
echo $TransactionScore;
echo "<br><br>AuthenticationResponseCode = ";
echo $AuthenticationResponseCode;
echo "<br><br>FraudAction = ";
echo $FraudAction;
*/

if ($success && $TransactionResult == "APPROVED"){
	// Write the transaction results
	$query = "
		INSERT INTO transactions (
			member_id,
			method_id,
			method_last_four,
			transaction_date,
			transaction_ip,
			product_id,
			product_description,
			sale_amount,
			sale_tax,
			sale_shipping,
			sale_total,
			order_number,
			process_date,
			process_id,
			process_type,
			process_auth_code,
			process_response_code,
			process_avs_code,
			process_reason_code,
			process_reason_text)
		VALUES (
			'".$_REQUEST['member_id']."',
			'".$method_id."',
			'".substr($_REQUEST['cc_number'], -4)."',
			UNIX_TIMESTAMP(),
			'".$_SERVER['REMOTE_ADDR']."',
			'".$_REQUEST['product_id']."',
			'".addslashes($_REQUEST['product_description'])."',
			'".$sub_total."',
			'".$sales_tax."',
			'".$shipping."',
			'".$total."',
			'".$OrderId."',
			'".$TransactionTime."',
			'".$TransactionID." / ".$ProcessorReferenceNumber."',
			'SALE',
			'".$ApprovalCode."',
			'".$ProcessorResponseCode."',
			'".$AVSResponse."',
			'".$AuthenticationResponseCode."',
			'".$TransactionResult."')
		";
	//die($query);
	$result = mysql_query($query, $dbhandle);

	// Set their membership join and renewal dates
	$query = "
		UPDATE members
		SET join_date = UNIX_TIMESTAMP(),
			renewal_date = '".strtotime('+1 year',time())."'
		WHERE member_id = '".$_REQUEST['member_id']."'
	";
	//die($query);
	$result = mysql_query($query, $dbhandle);

	// Send them a receipt with a download link

	// Build the receipt email
	$to = $member['email'];
//		$to = 'jeff.saunders@ewomennetwork.net'; //Testing
//		$to = 'kym.yancey@ewomennetwork.net'; //Testing
	$subject = 'Your Smart Women Buy Homes Marketing Kit Receipt';
	$message = '
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title></title>
<html>
<body bgcolor="#F6F6F6">
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td>
		<table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF">
		<tr>
			<td width="700" height="2" bgcolor="#F35C23"></td>
		</tr>
		<tr>
			<td width="700" align="center" bgcolor="#FFFFFF"><img src="http://smartwomenbuyhomes.com/images/header.jpg" alt="Smart Women Buy Homes" width="680" border="0"></td>
		</tr>
		<tr>
			<td style="padding:0px 10px 16px 10px;">

				<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; color:#272727;"><strong>Hello '.$member['first_name'].':</strong></p>

				<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; color:#272727;">Thank you so much for purchasing the Smart Women Buy Homes Marketing Kit for Real Estate Professionals. Please <a href="https://www.smartwomenbuyhomes.com/secure.php?page=download-marketing-kit&id='.encrypt($member['email'], $dataKey).$_REQUEST['member_id'].'&filename=/downloads/SWBH_Kit.zip">Click Here</a> to download your kit.</p>

			</td>
		</tr>
		<tr>
			<td style="padding:0px 10px 16px 10px;">
				<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#272727;">
				<tr>
					<td><strong>Order Reference Number:</strong></td>
					<td>'.$OrderId.'</td>
				</tr>
				<tr>
					<td><strong>Order Date & Time:</strong></td>
					<td>'.date("M d, Y @ g:i a T").'</td>
				</tr>
				<tr>
					<td><strong>Order Address:</strong></td>
					<td>'.$_SERVER['REMOTE_ADDR'].'</td>
				</tr>
				<tr>
					<td colspan="2"><hr width="100%" size="2" noshade></td>
				</tr>
				</table>
				<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#272727;">
				<tr>
					<td width="50%" valign="top">
						<strong>Customer Information:</strong><br>
						'.$member['first_name'].' '.$member['last_name'].'<br>
						'.($member['company_name'] != "" ? $member['company_name']."<br>" : "").'
						'.$member['address_1'].'<br>
						'.($member['address_2'] != "" ? $member['address_2']."<br>" : "").'
						'.$member['city'].', '.$member['state'].' '.$member['zipcode'].'<br>
						'.$member['email'].'<br>
						'.$member['phone'].'
					</td>
					<td width="50%" valign="top">
						<strong>Billing Information:</strong><br>
						'.$_REQUEST['billing_first_name'].' '.$_REQUEST['billing_last_name'].'<br>
						'.$_REQUEST['billing_address_1'].'<br>
						'.($_REQUEST['billing_address_2'] != "" ? $_REQUEST['billing_address_2']."<br>" : "").'
						'.$_REQUEST['billing_city'].', '.$_REQUEST['billing_state'].' '.$_REQUEST['billing_zip_code'].'<br>
						'.$_REQUEST['billing_phone'].'<br>
						Card ending in: '.substr($_REQUEST['cc_number'], -4).'
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr width="100%" size="2" noshade></td>
				</tr>
				</table>
				<table width="100%" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#272727;">
				<tr>
					<td>'.$_REQUEST['product_description'].'</td>
					<td><strong>Price:</strong></td>
					<td align="right">$'.money_format("%i", $sub_total).'</td>
				</tr>
				<tr>
					<td></td>
					<td><strong>Shipping:</strong></td>
					<td align="right">$'.money_format("%i", $shipping).'</td>
				</tr>
				<tr>
					<td></td>
					<td><strong>Sales Tax:</strong></td>
					<td align="right">$'.money_format("%i", $sales_tax).'</td>
				</tr>
				<tr>
					<td></td>
					<td><strong>Total:</strong></td>
					<td align="right">$'.money_format("%i", $total).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td bgcolor="#F35C23" width="700">
				<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-align:center;">
						Copyright &copy; '.date('Y').' Smart Women Buy Homes. All rights reserved.
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</body>
</html>
	';
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= 'From: Smart Women Buy Homes <Jeanie.Douthitt@gmail.com>' . "\r\n";
//	$headers .= 'Bcc: jeffsaunders@gmail.com' . "\r\n";  //Testing

	// Mail it
	mail($to, $subject, $message, $headers);

}else{
	// Write the transaction results
	$query = "
		INSERT INTO transactions (
			member_id,
			method_id,
			method_last_four,
			transaction_date,
			transaction_ip,
			product_id,
			product_description,
			sale_amount,
			sale_tax,
			sale_shipping,
			sale_total,
			order_number,
			process_date,
			process_id,
			process_type,
			process_auth_code,
			process_response_code,
			process_avs_code,
			process_reason_code,
			process_reason_text)
		VALUES (
			'".$_REQUEST['member_id']."',
			'".$method_id."',
			'".substr($_REQUEST['cc_number'], -4)."',
			UNIX_TIMESTAMP(),
			'".$_SERVER['REMOTE_ADDR']."',
			'".$_REQUEST['product_id']."',
			'".addslashes($_REQUEST['product_description'])."',
			'".$sub_total."',
			'".$sales_tax."',
			'".$shipping."',
			'".$total."',
			'".$OrderId."',
			'".$TransactionTime."',
			'".$OrderId."',
			'SALE',
			'FAILED',
			'',
			'',
			'',
			'".$ErrorMessage."')
		";
	//die($query);
	$result = mysql_query($query, $dbhandle);
}


























// Grab the ones that haven't confirmed in 3 days, but less than 6 days
$query = "
	SELECT ua.user_id, uf.platinum
	FROM u_account ua, u_flag uf
	WHERE ua.dt_confirmed = 0
	AND ua.dt_noticed = 0
	AND ua.dt_welcomed BETWEEN (UNIX_TIMESTAMP() - 259200) AND (UNIX_TIMESTAMP() - 129600)
	AND ua.user_id = uf.user_id
";
//echo $query."\n";die();
$rs_secondNotice = mysql_query($query, $linkID);

// Send them a second notice
while ($secondNotice = mysql_fetch_array($rs_secondNotice, MYSQL_NUM)){
	$userID = $secondNotice[0];
	$isPlatinum = $secondNotice[1];
//$userID = '160495'; // Testing (Jeff)
//$isPlatinum = 'Y'; // Testing
	// Send the email
	$systemEmail = new SystemEmail();
	$systemEmail->sendEmailUserId('Welcome Emails', ($isPlatinum == 'Y' ? 'Platinum Second Notice' : 'Second Notice') , $userID);

	// Stamp notice date
	$query = "
		UPDATE u_account
		SET dt_noticed = UNIX_TIMESTAMP()
		WHERE user_id = ".$userID
	;
	//echo $query."<br>";
	$rs_update = mysql_query($query, $linkID);

	// Update history
	$history = new History();
	$history->addUserHistory($userID, $userID, 'Confirmation Email Reminder Sent', '' );
}

// Grab the ones that haven't confirmed in 6 or more days
$query = "
	SELECT ua.user_id, ua.dt_joined, ua.dt_welcomed, ua.dt_noticed, uf.platinum
	FROM u_account ua, u_flag uf
	WHERE ua.dt_confirmed = 0
	AND ua.dt_noticed != 0
	AND ua.dt_welcomed != 0
	AND ua.dt_welcomed < (UNIX_TIMESTAMP() - 518400)
	AND ua.user_id = uf.user_id
	ORDER BY platinum DESC, dt_welcomed ASC
";
//echo $query."\n";die();
$rs_unconfirmed = mysql_query($query, $linkID);

// Build and send a report
if (mysql_num_rows($rs_unconfirmed)){
	$message = '
<style>
	body {font:normal 11px Verdana, Arial, Helvetica, sans-serif;}
</style>
<html>
<body>
<table width="700" align="center">
<tr>
	<td colspan="3" align="center"><font size="+2"><strong>Unconfirmed New Members</strong></font></td>
</tr>
<tr>
	<td colspan="3" align="center">eWomenNetwork members who joined more than six days ago who have not yet confirmed their membership</td>
</tr>
	';
	while ($unconfirmed = mysql_fetch_assoc($rs_unconfirmed)){
		// Grab the details for those who have not confirmed
		// Get the encrypted password string for this new member to create confirmation link
		$userID = $unconfirmed["user_id"];
		$isPlatinum = $unconfirmed['platinum'];
//$userID = '160495'; // Testing (Jeff)
//$isPlatinum = 'Y'; // Testing
		$query = "
			SELECT password
			FROM u_password
			WHERE user_id = '".$userID."'
		";
		//echo $query."\n";
		$rs_password = mysql_query($query, $linkID);
		$password = mysql_fetch_assoc($rs_password);
		// Get their profile information
		$query = "
			SELECT *
			FROM u_profile
			WHERE user_id = '".$userID."'
		";
		//echo $query."\n";
		$rs_profile = mysql_query($query, $linkID);
		$profile = mysql_fetch_assoc($rs_profile);
		// Get their personal information
		// Grab some of the same data from the u_personal table in case it's missing from u_profile
		$query = "
			SELECT name_first, name_last, name_suffix, company_name, city, state_province, day_phone_area, day_phone_first, day_phone_last, day_phone_extension, email, email_secondary
			FROM u_personal
			WHERE user_id = '".$userID."'
		";
		//echo $query."\n";
		$rs_personal = mysql_query($query, $linkID);
		$personal = mysql_fetch_assoc($rs_personal);
		// Get their chapter information
		$query = "
			SELECT sc.chapter_city, sc.chapter_state_province
			FROM s_chapter sc, u_chapter uc
			WHERE uc.user_id = '".$userID."'
			AND uc.chapter_joined = sc.chapter_id
		";
		//echo $query."\n";
		$rs_chapter = mysql_query($query, $linkID);
		$chapter = mysql_fetch_assoc($rs_chapter);
		// Write the details
		$message .= '
<tr>
	<td colspan="3"><hr width="100%" size="1" noshade></td>
</tr>
		';
		if ($isPlatinum == 'Y'){
			$message .= '
<tr>
	<td colspan="3"><strong><font color="#FF0000">PLATINUM Member</font></strong></td>
</tr>
			';
		}
		$message .= '
<tr>
	<td valign="bottom">
		<font size="-2">
		<table>
		<tr>
			<td>'.$personal["name_first"].' '.$personal["name_last"].' '.$personal["name_suffix"].'</td>
		</tr>
		<tr>
			<td>'.$personal["company_name"].'</td>
		</tr>
		<tr>
			<td>'.$personal["city"].', '.$personal["state_province"].'</td>
		</tr>
		<tr>
			<td><a href="http://www.ewomennetwork.com/NewMemberWelcome.php?id='.urlencode($password["password"]).$unconfirmed["user_id"].'"><strong>MANUALLY CONFIRM</strong></td>
		</tr>
		</table>
	</td>
	<td valign="bottom">
		<table>
		<tr>
			<td>Phone:</td>
			<td>('.$personal["day_phone_area"].') '.$personal["day_phone_first"].'-'.$personal["day_phone_last"].' Ext: '.$personal["day_phone_extension"].'</td>
		</tr>
		<tr>
			<td>Business Email:</td>
			<td>'.$profile["email"].'</td>
		</tr>
		<tr>
			<td>Personal Email:</td>
			<td>'.$personal["email"].'</td>
		</tr>
		<tr>
			<td>Secondary Email:</td>
			<td>'.$personal["email_secondary"].'</td>
		</tr>
		</table>
	</td>
	<td valign="bottom">
		<table>
		<tr>
			<td>Member ID:</td>
			<td>'.$unconfirmed["user_id"].'</td>
		</tr>
		<tr>
			<td>Email Date:</td>
			<td>'.date('m/d/y @ g:i a',$unconfirmed["dt_welcomed"]).'</td>
		</tr>
		<tr>
			<td>2nd Notice:</td>
			<td>'.date('m/d/y',$unconfirmed["dt_noticed"]).'</td>
		</tr>
		<tr>
			<td>Chapter:</td>
			<td>'.$chapter["chapter_city"].', '.$chapter["chapter_state_province"].'</td>
		</tr>
		</table>
		</font>
	</td>
</tr>
		';
	}
	// Close 'er up.
	$message .= '
</table>	
</body>
</html>
	';
}else{
        $message = '
<style>
        body {font:normal 11px Verdana, Arial, Helvetica, sans-serif;}
</style>
<html>
<body>
<table width="700" align="center">
<tr>
        <td align="center"><font size="+2"><strong>Unconfirmed New Members</strong></font></td>
</tr>
<tr>
        <td align="center"><strong>eWomenNetwork members who joined more than six days ago who have not yet confirmed their membership</strong></td>
</tr>
<tr>
	<td align="center"><br><br><strong>&mdash; None Found &mdash;</strong></td>
</tr>
</table>
</body>
</html>
        ';
}
// Build the email
$to = 'members@ewomennetwork.com';
//$to = 'jeff.saunders@ewomennetwork.net'; //Testing
$subject = 'Unconfirmed New Members';
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Additional headers
$headers .= 'From: Member Services <Members@eWomenNetwork.com>' . "\r\n";
$headers .= 'Cc: kym.yancey@ewomennetwork.net' . "\r\n";
$headers .= 'Cc: connie.smith@ewomennetwork.net' . "\r\n";
$headers .= 'Bcc: jeff.saunders@ewomennetwork.net' . "\r\n";  //Testing

// Mail it
mail($to, $subject, $message, $headers);

// C'est Fini
?>


