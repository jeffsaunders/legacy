<?php
if (isset($_REQUEST['submit_order'])){ // They just hit the submit button so let's process them

	// Encrypt function
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

	// Encryption key
	$dataKey = base64_decode('1zvKhVe39VUe9HDtz3q1x2dqcoDDFEgW35VhIq2YmP0=');

	// Save the payment info to their account record
	// See if they already have a method on file
	$query = "
		SELECT method_id
		FROM payment_methods
		WHERE member_id = '".$_REQUEST['member_id']."'
	";
	//echo $query;die();
	$rs_method = mysql_query($query, $dbhandle);

	if (mysql_num_rows($rs_method) > 0){
		// Update the record
		$query = "
			UPDATE payment_methods
			SET add_date = UNIX_TIMESTAMP(),
				billing_first_name = '".addslashes($_REQUEST['billing_first_name'])."',
				billing_middle_name = '".addslashes($_REQUEST['billing_middle_name'])."',
				billing_last_name = '".addslashes($_REQUEST['billing_last_name'])."',
				billing_address_1 = '".addslashes($_REQUEST['billing_address_1'])."',
				billing_address_2 = '".addslashes($_REQUEST['billing_address_2'])."',
				billing_city = '".addslashes($_REQUEST['billing_city'])."',
				billing_state = '".$_REQUEST['billing_state']."',
				billing_zipcode = '".$_REQUEST['billing_zip_code']."',
				billing_phone = '".$_REQUEST['billing_phone']."',
				credit_card_number = '".encrypt($_REQUEST['cc_number'], $dataKey)."',
				credit_card_security_code = '".encrypt($_REQUEST['cc_cvv'], $dataKey)."',
				credit_card_name = '".encrypt($_REQUEST['cc_name'], $dataKey)."',
				credit_card_exp_month = '".encrypt($_REQUEST['cc_exp_month'], $dataKey)."',
				credit_card_exp_year = '".encrypt($_REQUEST['cc_exp_year'], $dataKey)."',
				credit_card_last_four = '".substr($_REQUEST['cc_number'], -4)."'
			WHERE member_id = '".$_REQUEST['member_id']."'
		";
		//die($query);
		$result = mysql_query($query, $dbhandle);
		// Get the method_id
		$method = mysql_fetch_assoc($rs_method);
		$method_id = $method['method_id'];
	}else{
		// Write the record
		$query = "
			INSERT INTO payment_methods (
				member_id,
				add_date,
				billing_first_name,
				billing_middle_name,
				billing_last_name,
				billing_address_1,
				billing_address_2,
				billing_city,
				billing_state,
				billing_zipcode,
				billing_phone,
				credit_card_number,
				credit_card_security_code,
				credit_card_name,
				credit_card_exp_month,
				credit_card_exp_year,
				credit_card_last_four)
			VALUES (
				'".$_REQUEST['member_id']."',
				UNIX_TIMESTAMP(),
				'".addslashes($_REQUEST['billing_first_name'])."',
				'".addslashes($_REQUEST['billing_middle_name'])."',
				'".addslashes($_REQUEST['billing_last_name'])."',
				'".addslashes($_REQUEST['billing_address_1'])."',
				'".addslashes($_REQUEST['billing_address_2'])."',
				'".addslashes($_REQUEST['billing_city'])."',
				'".$_REQUEST['billing_state']."',
				'".$_REQUEST['billing_zip_code']."',
				'".$_REQUEST['billing_phone']."',
				'".encrypt($_REQUEST['cc_number'], $dataKey)."',
				'".encrypt($_REQUEST['cc_cvv'], $dataKey)."',
				'".encrypt($_REQUEST['cc_name'], $dataKey)."',
				'".encrypt($_REQUEST['cc_exp_month'], $dataKey)."',
				'".encrypt($_REQUEST['cc_exp_year'], $dataKey)."',
				'".substr($_REQUEST['cc_number'], -4)."')
			";
		//die($query);
		$result = mysql_query($query, $dbhandle);
		// Get the method_id
		$method_id = mysql_insert_id();
	}

	// Payment transaction
	// Live
	$store_name = $config['fd_store_name'];
	$store_number = $config['fd_store_number'];
	$store_id = $config['fd_store_id'];
	$password = $config['fd_password'];
	$api_host = $config['fd_api_host'];
	$cert_location = $config['fd_cert_location'];
	$cert_password = $config['fd_cert_password'];

	// Test Mode - override the config settings
//	$store_name = "Smart Women Buy Homes";
//	$store_number = "1909834738";
//	$store_id = "834738";
//	$password = "xSv9vrJ5";
//	$api_host = "https://ws.merchanttest.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl";
//	$cert_location = "/var/www/html/smartwomenbuyhomes.com/certs";
//	$cert_password = "ckp_1365734023";

	$sub_total = $_REQUEST['product_price'];
	$shipping = 0;
	if ($_REQUEST['billing_state'] == "TX"){
		$sales_tax = round(($_REQUEST['product_price'] * .0825), 2); // 8.25%
	}else{
		$sales_tax = 0;
	}
	$total = $sub_total + $shipping + $sales_tax;

	// Get some customer info
	$query = "
		SELECT *
		FROM members
		WHERE member_id = '".$_REQUEST['member_id']."'
	";
	//echo $query;
	$rs_member = mysql_query($query, $dbhandle);
	$member = mysql_fetch_assoc($rs_member);

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

/*
// Handy displays
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
				promo_code,
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
				'".$_REQUEST['promo_code']."',
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
					<td width="500">'.$_REQUEST['product_description'].'</td>
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
		$headers .= 'Bcc: Jeanie.Douthitt@gmail.com' . "\r\n";  //Uncomment when live
//		$headers .= 'Bcc: jeffsaunders@gmail.com' . "\r\n";  //Testing
	
		// Mail it
		mail($to, $subject, $message, $headers);
?>

<br><br>
<h2>Opportunity for Realtors</h2>

<p>Thank you so much for ordering the Smart Women Buy Homes Marketing Kit for Real Estate Professionals.</p>

<p>Shortly you will receive an email receipt for your purchase.  That email will also contain your exclusive private link to download your Smart Women Buy Homes Marketing Kit for Real Estate Professionals.  You may also <a href="/page-includes/download-marketing-kit.php?page=download-marketing-kit&id=<? echo encrypt($member['email'], $dataKey).$_REQUEST['member_id']; ?>&filename=/downloads/SWBH_Kit.zip" target="_blank">click here</a> to download your kit immediately.</p>

<?php
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
				promo_code,
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
				'".$_REQUEST['promo_code']."',
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
?>
<br><br>
<h2>Opportunity for Realtors</h2>

<p>We're sorry but your payment transaction returned the following code: <strong><?php echo $ErrorMessage; ?></strong></p>

<p><a href="javascript:back(-1);">Click Here</a> or use your browser's back button to make any needed corrections to your payment information.</p>

<?php	
	}
}else{
	// Show the form if they are worthy...

	// Get passed value and pull it apart
	$id = explode("=", $_REQUEST["id"]);

	// Now put back any stripped out plus signs (RFC 2396)
	$encryptedID = str_replace(' ', '+', $id[0]) . "=";

	// Deal with what's left
	$userID = $id[1];

	// Decryption function
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

	// Decrypt passed ID
	$dataKey = base64_decode('1zvKhVe39VUe9HDtz3q1x2dqcoDDFEgW35VhIq2YmP0=');
	$decryptedEmail = decrypt($encryptedID, $dataKey);

	// Look up decrypted email address
	$query = "
		SELECT *
		FROM members
		WHERE email = '".trim($decryptedEmail)."'
		AND member_id = '".$userID."'
	";
	//echo $query;
	$rs_member = mysql_query($query, $dbhandle);
	if (mysql_num_rows($rs_member) == 0){
//if (1==2){  // comment out the line above and uncomment this line to make the checkout form appear regardless - testing
?>
<br><br>
<h2>The Smart Women Buy Homes Marketing Kit - <span style="font-color:#C60 !important;">Checkout</span></h2>

<p>We're sorry, your exclusive private key was not found.  Please click the link at the bottom of the The Smart Women Buy Homes Marketing Kit for Real Estate Professionals information page, reached via the exclusive link emailed to you, to purchase the kit.</p>

<?php
	}else{
		$member = mysql_fetch_assoc($rs_member);
		// Assign stored values for form population
		$BillingFirstName	= $member['first_name'];
		$BillingLastName 	= $member['last_name'];
		$BillingCity		= $member['city'];
		$BillingState		= $member['state'];
		$BillingZipCode		= $member['zipcode'];
		$BillingPhone		= $member['phone'];
		$CCName				= $member['first_name'] . " " . $member['last_name'];

		// Passed promo code, if there is one
		$PromoCode			= $_REQUEST['promo_code'];
                $PromoMessage 			= "";

		// Get all the products for sale
		$query = "
			SELECT *
			FROM products
			WHERE available = 'Y'
			ORDER BY display_sequence ASC
		";
		$rs_products = mysql_query($query, $dbhandle);

		// Check for a promo code
		if (isset($_REQUEST['promo_button'])){
			$query = "
				SELECT *
				FROM promo_codes
				WHERE LOWER(promo_code) = '".strtolower(trim($PromoCode))."'
				AND active = '1'
				AND start_date <= '".date('Y-m-d')."'
				AND end_date >= '".date('Y-m-d')."'
			";
			//echo $query;die();
			$rs_promo = mysql_query($query, $dbhandle);
			if (mysql_num_rows($rs_promo) > 0){
				// There's a code, let's see if it's still available
				$promo = mysql_fetch_assoc($rs_promo);
				if ($promo['quantity'] > 0){  // Not unlimited, count how many times it's been used
					$query = "
						SELECT COUNT(promo_code) AS used
						FROM transactions
						WHERE LOWER(promo_code) = '".strtolower(trim($PromoCode))."'
						AND process_reason_text = 'APPROVED'
					";
					//echo $query;die();
					$rs_count = mysql_query($query, $dbhandle);
					$count = mysql_fetch_assoc($rs_count);
					// If it's not yet used up, apply it
					if (($promo['quantity'] - $count['used']) > 0){
						$promo_amount = $promo['amount'];
						$promo_type = $promo['type'];
					}
				}else{ // Unlimited, apply it no matter what
					$promo_amount = $promo['amount'];
					$promo_type = $promo['type'];
				}
			}else{
				$PromoMessage = "Promotional Code Invalid";
			}
		}	

?>

<br><br>
<h2>The Smart Women Buy Homes Marketing Kit - <span style="font-color:#C60 !important;">Checkout</span></h2>

<!-- Form Validation Scripts -->
<script src="/js/FormValidation.js" type="text/javascript"></script>

<div class="checkout">
	<form action="" method="post" name="checkoutForm" id="checkoutForm" onSubmit="return validateCheckout(this);">
	<div class="form-fields">

		<!-- Product(s) -->
		<h3 style="margin-bottom:5px;">Product</h3>
		<p id=product_question">
		<?php
		// This really needs to be checkboxes if there is more than one product - leave it as radio(s), for now.
		for ($item = 0; $item < mysql_num_rows($rs_products); $item++){
			$product = mysql_fetch_assoc($rs_products);
			$productPrice = $product['product_price'];
			// Is there a discount to apply?
			if (isset($promo_amount)){
				if ($promo['type'] == "dollar"){
					$productPrice = $product['product_price'] - $promo_amount;
					$PromoMessage = "$".$promo_amount." Discount Applied!";
				}else{
					$productPrice = $product['product_price'] - ($product['product_price'] * ($promo_amount / 100));
					$PromoMessage = $promo_amount."% Discount Applied!";
				}
		}
		?>
			<input type="radio" name="product_id" id="product_id<?php echo $item; ?>" value="<?php echo $product['product_id']; ?>" class="radio-indent"<?php echo mysql_num_rows($rs_products) == 1 ? " checked" : ""; ?>> $<?php echo money_format("%i", $productPrice); ?> - <?php echo $product['product_name']; ?><br>
			<input type="hidden" name="product_description" id="product_description<?php echo $item; ?>" value="<?php echo $product['product_name']; ?>">
			<input type="hidden" name="product_price" id="product_price<?php echo $item; ?>" value="<?php echo $productPrice; ?>">
			<?php
		}
		// Add a dummy radio button if there is only one - works around javascript "radio button array with only 1 element" bug
		if (mysql_num_rows($rs_products) == 1){
		?>
			<input type="radio" name="product_id" id="product_id1" value="dummy" style="display:none">
		<?php
		}
		?>
		</p>

		<!-- Promotional Code -->
		<p>
			<label>Promotional Code</label> - If you received a Promotional Code please enter it here and click "Apply".<br>
			<input type="text" name="promo_code" id="Promo_code" value="<?php echo trim($PromoCode); ?>" class="text-input small-input">&nbsp;&nbsp;<input type="submit" name="promo_button" id="promo_button" value="Apply" class="button" onClick="checkoutForm.submit_button.value = this.name;">&nbsp;&nbsp;<strong><em><?php echo $PromoMessage; ?></em></strong>
		</p>


<!-- PayPal Button -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="3G35CL8FZ2QLC">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>



		<!-- Billing Information -->
		<h3 style="border-top:1px solid #666; padding-top:20px; margin-bottom:10px;">Billing Address</h3>
		<div class="form-name">                  
			<p>
				<label>First Name</label><br>
				<input type="text" name="billing_first_name" id="billing_first_name" value="<?php echo $BillingFirstName; ?>" class="text-input medium-input">
			</p>
			
			<p>
				<label>MI</label><br>
				<input style="width:50px !important;" class="text-input small-input" type="text" id="billing_middle_name" name="billing_middle_name">
			</p>
			
			<p>
				<label>Last Name</label><br>
				<input type="text" name="billing_last_name" id="billing_last_name" value="<?php echo $BillingLastName; ?>" class="text-input medium-input">
			</p>
		</div><!--form-name-->

		<div class="clear"></div><!--clear-->

		<div class="form-address">
			<p>
				<label>Address</label><br>
				<input class="text-input medium-input" type="text" id="billing_address_1" name="billing_address_1" style="margin:0px 0px 10px 0px;"><br>
				<input class="text-input medium-input" type="text" id="billing_address_2" name="billing_address_2">
			</p>

			<div class="form-location">
				<p>
					<label>City</label><br>
					<input type="text" name="billing_city" id="billing_city" value="<?php echo $BillingCity; ?>" class="text-input medium-input">
				</p>
	
				<p>
					<label>State</label><br>
					<select name="billing_state" class="select" style="width:80px; padding-right:10px;">
						<option value="">Select</option>
						<option value="AL"<?php echo ($BillingState == "AL" ? " selected" : ""); ?>>AL</option>
						<option value="AK"<?php echo ($BillingState == "AK" ? " selected" : ""); ?>>AK</option>
						<option value="AZ"<?php echo ($BillingState == "AZ" ? " selected" : ""); ?>>AZ</option>
						<option value="AR"<?php echo ($BillingState == "AR" ? " selected" : ""); ?>>AR</option>
						<option value="CA"<?php echo ($BillingState == "CA" ? " selected" : ""); ?>>CA</option>
						<option value="CO"<?php echo ($BillingState == "CO" ? " selected" : ""); ?>>CO</option>
						<option value="CT"<?php echo ($BillingState == "CT" ? " selected" : ""); ?>>CT</option>
						<option value="DE"<?php echo ($BillingState == "DE" ? " selected" : ""); ?>>DE</option>
						<option value="DC"<?php echo ($BillingState == "DC" ? " selected" : ""); ?>>DC</option>
						<option value="FL"<?php echo ($BillingState == "FL" ? " selected" : ""); ?>>FL</option>
						<option value="GA"<?php echo ($BillingState == "GA" ? " selected" : ""); ?>>GA</option>
						<option value="HI"<?php echo ($BillingState == "HI" ? " selected" : ""); ?>>HI</option>
						<option value="ID"<?php echo ($BillingState == "ID" ? " selected" : ""); ?>>ID</option>
						<option value="IL"<?php echo ($BillingState == "IL" ? " selected" : ""); ?>>IL</option>
						<option value="IN"<?php echo ($BillingState == "IN" ? " selected" : ""); ?>>IN</option>
						<option value="IA"<?php echo ($BillingState == "IA" ? " selected" : ""); ?>>IA</option>
						<option value="KS"<?php echo ($BillingState == "KS" ? " selected" : ""); ?>>KS</option>
						<option value="KY"<?php echo ($BillingState == "KY" ? " selected" : ""); ?>>KY</option>
						<option value="LA"<?php echo ($BillingState == "LA" ? " selected" : ""); ?>>LA</option>
						<option value="ME"<?php echo ($BillingState == "ME" ? " selected" : ""); ?>>ME</option>
						<option value="MD"<?php echo ($BillingState == "MD" ? " selected" : ""); ?>>MD</option>
						<option value="MA"<?php echo ($BillingState == "MA" ? " selected" : ""); ?>>MA</option>
						<option value="MI"<?php echo ($BillingState == "MI" ? " selected" : ""); ?>>MI</option>
						<option value="MN"<?php echo ($BillingState == "MN" ? " selected" : ""); ?>>MN</option>
						<option value="MS"<?php echo ($BillingState == "MS" ? " selected" : ""); ?>>MS</option>
						<option value="MO"<?php echo ($BillingState == "MO" ? " selected" : ""); ?>>MO</option>
						<option value="MT"<?php echo ($BillingState == "MT" ? " selected" : ""); ?>>MT</option>
						<option value="NE"<?php echo ($BillingState == "NE" ? " selected" : ""); ?>>NE</option>
						<option value="NV"<?php echo ($BillingState == "NV" ? " selected" : ""); ?>>NV</option>
						<option value="NH"<?php echo ($BillingState == "NH" ? " selected" : ""); ?>>NH</option>
						<option value="NJ"<?php echo ($BillingState == "NJ" ? " selected" : ""); ?>>NJ</option>
						<option value="NM"<?php echo ($BillingState == "NM" ? " selected" : ""); ?>>NM</option>
						<option value="NY"<?php echo ($BillingState == "NY" ? " selected" : ""); ?>>NY</option>
						<option value="NC"<?php echo ($BillingState == "NC" ? " selected" : ""); ?>>NC</option>
						<option value="ND"<?php echo ($BillingState == "ND" ? " selected" : ""); ?>>ND</option>
						<option value="OH"<?php echo ($BillingState == "OH" ? " selected" : ""); ?>>OH</option>
						<option value="OK"<?php echo ($BillingState == "OK" ? " selected" : ""); ?>>OK</option>
						<option value="OR"<?php echo ($BillingState == "OR" ? " selected" : ""); ?>>OR</option>
						<option value="PA"<?php echo ($BillingState == "PA" ? " selected" : ""); ?>>PA</option>
						<option value="RI"<?php echo ($BillingState == "RI" ? " selected" : ""); ?>>RI</option>
						<option value="SC"<?php echo ($BillingState == "SC" ? " selected" : ""); ?>>SC</option>
						<option value="SD"<?php echo ($BillingState == "SD" ? " selected" : ""); ?>>SD</option>
						<option value="TN"<?php echo ($BillingState == "TN" ? " selected" : ""); ?>>TN</option>
						<option value="TX"<?php echo ($BillingState == "TX" ? " selected" : ""); ?>>TX</option>
						<option value="UT"<?php echo ($BillingState == "UT" ? " selected" : ""); ?>>UT</option>
						<option value="VT"<?php echo ($BillingState == "VT" ? " selected" : ""); ?>>VT</option>
						<option value="VA"<?php echo ($BillingState == "VA" ? " selected" : ""); ?>>VA</option>
						<option value="WA"<?php echo ($BillingState == "WA" ? " selected" : ""); ?>>WA</option>
						<option value="WV"<?php echo ($BillingState == "WV" ? " selected" : ""); ?>>WV</option>
						<option value="WI"<?php echo ($BillingState == "WI" ? " selected" : ""); ?>>WI</option>
						<option value="WY"<?php echo ($BillingState == "WY" ? " selected" : ""); ?>>WY</option>
					</select>
				</p>
	
				<p>
					<label>Zip</label><br>
					<input type="text" name="billing_zip_code" id="billing_zip_code" value="<?php echo $BillingZipCode; ?>" class="text-input medium-input" onKeyPress="return onlyNumbers(event);">
				</p>
			</div><!--form-location-->

			<div class="clear"</div><!--clear-->

		</div><!--form-address-->
		<p>
			<label>Phone</label><br>
			<input type="text" name="billing_phone" id="billing_phone" value="<?php echo $BillingPhone; ?>" class="text-input medium-input" onKeyPress="return onlyNumbers(event);" onBlur="return formatPhone(this);">
		</p>

		<!-- Payment Information -->
		<h3 style="border-top:1px solid #666; padding-top:20px; margin:20px 0px 10px 0px;">Credit Card Information</h3>

		<p><img src="images/misc/credit_card_logos.png" width="127" height="40" alt="Visa and Mastercard" border="0"></p>

		<p style="float:left; margin-right:10px;">
			<label>Credit Card Number</label><br>
			<input type="text" name="cc_number" id="cc_number" class="text-input medium-input" style="width:300px !important;" onKeyPress="return onlyNumbers(event);" onBlur="return formatCC(this);">
		</p>

		<p style="float:left;">
			<label>Security Code</label><br>
			<input class="text-input small-input" style="width:80px !important;" type="text" id="cc_cvv" name="cc_cvv" onKeyPress="return onlyNumbers(event);" onBlur="return formatCC(this);">
		</p>

		<div class="clear"></div><!--clear-->

		<p>
			<label>Name as appears on your credit card</label><br>
			<input type="text" name="cc_name" id="cc_name" value="<?php echo $CCName; ?>" class="text-input medium-input">
		</p>

		<div class="clear"></div><!--clear-->

		<p style="float:left; margin-right:10px;">
			<label>EXP Month</label><br>
			<select name="cc_exp_month" class="formlist">
				<option value="">Select</option>
				<option value = "01">01 - January</option>
				<option value = "02">02 - February</option>
				<option value = "03">03 - March</option>
				<option value = "04">04 - April</option>
				<option value = "05">05 - May</option>
				<option value = "06">06 - June</option>
				<option value = "07">07 - July</option>
				<option value = "08">08 - August</option>
				<option value = "09">09 - September</option>
				<option value = "10">10 - October</option>
				<option value = "11">11 - November</option>
				<option value = "12">12 - December</option>
			</select>
		</p>
		
		<p style="float:left;">
			<label>EXP Year</label><br />
			<select name="cc_exp_year" class="select" style="width:80px; padding-right:10px;">
				<option value="">Select</option>
				<?php
				$year = date("Y");
				for ($n = 0; $n <= 9; $n++){
				?>
				<option value="<?php echo substr($year+$n, -2); ?>"><?php echo $year+$n; ?></option>
				<?php
				}
				?>
			</select>
		</p>

		<div class="clear"></div><!--clear-->
		<br>
		<div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="50">&nbsp;</td>
						<td height="22" align="center"><strong>License Agreement</strong></td>
						<td width="50" align="right" valign="top"><a href="javascript:window.frames['terms'].focus();window.frames['terms'].print();"><strong>Print</strong></a>&nbsp;</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid Black">
					<iframe src="/page-includes/license-agreement.php?cargo=<?php echo $CCName.'|'.$BillingCity.', '.$BillingState; ?>" name="terms" id="terms" width="100%" height="120" marginwidth="5" marginheight="5" align="top" scrolling="yes" frameborder="0"></iframe>
				</td>
			</tr>
			</table>
			<br>
		</div>
		<p>
			By clicking the <em>Submit Payment</em> button you acknowledge you have read and agree to the terms of the above listed license agreement and are authorizing Smart Women Buy, LLC to charge your credit card for the Smart Women Buy Homes Membership and Marketing Kit for Real Estate Professionals, and to automatically renew your Smart Women Buy Homes membership each year on this date, per the terms of the license agreement.<br><br>
			<input type="hidden" name="member_id" id="member_id" value="<?php echo $userID; ?>">
                        <input type="hidden" name="submit_button" id="submit_button" value="">
			<input class="button" type="submit" value="Submit Payment" name="submit_order" id="submit_order" onClick="checkoutForm.submit_button.value = this.name;">
		</p>

		<br><br>
	</div><!--form-fields-->    
	At the end of each year, your membership is automatically renewed for another year.  You may cancel your membership at any time as long as it is at least 10 days before the end of the current term.  Your membership will be cancelled upon the next renewal date and you will no longer be charged for automatic renewals.  Cancellations within the final 10 days of the current term will be effective at the end of the subsequent term.  Your next annual renewal date will be one year from today.
	<div class="clear"></div><!-- End .clear -->
	</form>
</div><!--checkout-->
<?php
	}
}
?>
<!-- This dangling closer must be paired with an open in the calling script, removing it messes things up -->
</div>   
                
