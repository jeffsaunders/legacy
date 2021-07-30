<?php
// It's still a mystery.....
$current_month = date("F");
$current_date = date("d");
$current_year = date("Y");
$current_time = date("H:i");


// if submitted write record
// run credit card
// send email receipt
// display thank you or decline screen

?>
<?php
if (isset($_REQUEST['submit'])){ // They just hit the submit button

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

	// Decryption key
	$dataKey = base64_decode('1zvKhVe39VUe9HDtz3q1x2dqcoDDFEgW35VhIq2YmP0=');

	// Save the payment info to their account record
	// See if they already have a method on file
	$query = "
		SELECT method_id
		FROM payment_methods
		WHERE member_id = '".$_REQUEST['member_id']."'
	";
	//echo $query;
	$rs_method = mysql_query($query, $dbhandle);

	if (mysql_num_rows($rs_method) > 0){
		// Update the record
		$query = "
			UPDATE payment_methods
			SET add_date = UNIX_TIMESTAMP(),
			SET billing_first_name = '".$_REQUEST['billing_first_name']."',
			SET billing_middle_name = '".$_REQUEST['billing_middle_name']."',
			SET billing_last_name = '".$_REQUEST['billing_last_name']."',
			SET billing_address_1 = '".$_REQUEST['billing_address_1']."',
			SET billing_address_2 = '".$_REQUEST['billing_address_2']."',
			SET billing_city = '".$_REQUEST['billing_city']."',
			SET billing_state = '".$_REQUEST['billing_state']."',
			SET billing_zipcode = '".$_REQUEST['billing_zip_code']."',
			SET billing_phone = '".$_REQUEST['billing_phone']."',
			SET credit_card_number = '".encrypt($_REQUEST['cc_number'], $dataKey)."',
			SET credit_card_security_code = '".encrypt($_REQUEST['cc_cvv'], $dataKey)."',
			SET credit_card_name = '".encrypt($_REQUEST['cc_name'], $dataKey)."',
			SET credit_card_exp_month = '".encrypt($_REQUEST['cc_exp_month'], $dataKey)."',
			SET credit_card_exp_year = '".encrypt($_REQUEST['cc_exp_year'], $dataKey)."',
			SET credit_card_last_four = '".substr($_REQUEST['cc_number'], -4)."'
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
				UNIX_TIMESTAMP(),
				'".$_REQUEST['billing_first_name']."',
				'".$_REQUEST['billing_middle_name']."',
				'".$_REQUEST['billing_last_name']."',
				'".$_REQUEST['billing_address_1']."',
				'".$_REQUEST['billing_address_2']."',
				'".$_REQUEST['billing_city']."',
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
	$store_name = "SMART WOMEN BUY HOMES";
	$store_number = "1001324984";
	$store_id = "324984";
	$password = "121771sd";
	$api_host = "https://ws.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl";
	$cert_location = "/certs";
	$cert_password = "";

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

	// Build the transaction XML
	$xml = '
<fdggwsapi:FDGGWSApiOrderRequest xmlns:v1=”http://secure.linkpt.net/fdggwsapi/schemas_us/v1” xmlns:fdggwsapi=“http://secure.linkpt.net/fdggwsapi/schemas_us/fdggwsapi">
	<v1:Transaction>
		<v1:CreditCardTxType>
			<v1:Type>sale</v1:Type>
		</v1:CreditCardTxType>
		<v1:CreditCardData>
			<v1:CardNumber>'.$_REQUEST['cc_number'].'</v1:CardNumber>
			<v1:CardCodeValue>'.$_REQUEST['cc_cvv'].'</v1:CardCodeValue>
			<v1:ExpMonth>'.$_REQUEST['cc_exp_month'].'</v1:ExpMonth>
			<v1:ExpYear>'.$_REQUEST['cc_exp_year'].'</v1:ExpYear>
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
			<v1:Email>email'.$member['email'].'</v1:Email>
		</v1:Billing>
	</v1:Transaction>
</fdggwsapi:FDGGWSApiOrderRequest>
	';

	// Wrap the XML in a SOAP container
	$soap = '
<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
	<SOAP-ENV:Header />
	<SOAP-ENV:Body>
		'.$xml.'
	</SOAP-ENV:Body>
</SOAP-ENV:Envelope>
	';

	// Send 'er in
	$body = $soap;
	// initializing cURL with the FDGGWS API URL:
	$ch = curl_init($api_host);
	// setting the request type to POST:
	curl_setopt($ch, CURLOPT_POST, 1);
	// setting the content type:
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
	// setting the authorization method to BASIC:
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	// supplying your credentials:
	curl_setopt($ch, CURLOPT_USERPWD, "WS".$store_id."._.1:".$password);
	// filling the request body with your SOAP message:
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	// configuring cURL not to verify the server certificate:
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	// setting the path where cURL can find the client certificate:
	curl_setopt($ch, CURLOPT_SSLCERT, $cert_location."/WS".$store_id."._.1.pem");
	// setting the path where cURL can find the client certificate’s private key:
	curl_setopt($ch, CURLOPT_SSLKEY, $cert_location."/WS".$store_id."._.1.key");
	// setting the key password:
	curl_setopt($ch, CURLOPT_SSLKEYPASSWD, $cert_password);
	// telling cURL to return the HTTP response body as operation result value when calling curl_exec:
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// calling cURL and saving the SOAP response message in a variable which contains a string like "<SOAP-ENV:Envelope ...>...</SOAP-ENV:Envelope>":
	$result = curl_exec($ch);

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
	}

	// closing cURL:
	curl_close($ch);



/****************************************************************
// CODE EXAMPLE
	
Before going live you need to create test account The test account can be created from the following URL: http://www.firstdata.com/gg/apply_test_account.htm. Once you register to the test account you will receive a tar.gz file of your certificate. This will be a list of files as below:
1. WS1334649181._.1.auth.txt
2. WS1334649181._.1.key
3. WS1334649181._.1.key.pw.txt
4. WS1334649181._.1.ks
5. WS1334649181._.1.ks.pw.txt
6. WS1334649181._.1.p12
7. WS1334649181._.1.p12.pw.txt
8. WS1334649181._.1.pem

The number 1334649181 would be different for your test store.

Then the next step is to create a script which will use this certificate and do some test payments.
Note: If you would try to execute the FirstData script it will not work as it require live server testing environment.

I have used PHP script with curl and the sample script is as below:

//php script sample code first data integration starts here

<?php

define("FDAPI_URL","https://ws.merchanttest.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl");// URL for test store test payment.
//############## OR ###############
//define("FDAPI_URL", "https://ws.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl");// URL for live store for actual payment.

define("FD_USERPWD","WSXXXXXXXXX._.1:XXXXXXXX ");//Replace WSXXXXXXXXX._.1:XXXXXXXX with actual username:password
define("FD_SSLCERT", "/home/mypayment/httpdocs/certificate/WS1334649181._.1.pem"); //replace WSXXXXXXXX._.1.pem with actual pem file
define("FD_SSLKEY","/home/mypayment/httpdocs/certificate/WS1334649181._.1.key"); //replace WSXXXXXXXXX._.1.key with actual key file.
define("FD_SSLKEYPASSWD", "ckp_1334649181"); //Replace "ckp_1334649181" key with your store key . You can download all these from your store after loged into your account


// function to get Transacion ID
function getFirstDataTransactionID($result)
{
    $varPos = strpos($result, '<fdggwsapi:TransactionID>');
    $varPos2 = strpos($result, '</fdggwsapi:TransactionID>');
    $varPos = $varPos + 25;
    $varLen = $varPos2 - $varPos;
    return substr($result,$varPos,$varLen);
}
// function to get Transaction Result
// Return Type APPROVED /  FAILED
function getTransactionResult($result)
{
    $varPos = strpos($result, '<fdggwsapi:TransactionResult>');
    $varPos2 = strpos($result, '</fdggwsapi:TransactionResult>');
    if($varPos !== false)
    {
        $varPos = $varPos + 29;
        $varLen = $varPos2 - $varPos;
        return substr($result,$varPos,$varLen);
    }
    else
    {
        return 'FAILED';
    }
        }

// function to get the orderID
//###################
// This function is used in case of recurring billing as in case of  recurrring billing we get OrderID instead of Transaction ID
//#######################
function getRecurrringOrderID($result)
{
    $varPos = strpos($result, '<fdggwsapi:OrderId>');
    $varPos2 = strpos($result, '</fdggwsapi:OrderId>');
    if($varPos !== false)
    {
        $varPos = $varPos + 19;
        $varLen = $varPos2 - $varPos;
        return substr($result,$varPos,$varLen);
    }
    else
    {
        return '';
    }
}



/*
 // This is the code that you have to use to test your first data web service transactions.
 session_start();
 include("firstdata_cfg.php");
 $order_no=$_REQUEST['order_no'];
 $purchase_order_no=$_REQUEST['purchase_order_no'];
 $invoice_no=$_REQUEST['invoice_no'];
 $subtotal=$_REQUEST['subtotal'];
 $shiping=$_REQUEST['shiping'];
 $tax=$_REQUEST['tax'];
 $transaction_origin=$_REQUEST['transaction_origin'];
 $transaction_type=$_REQUEST['transaction_type'];
 $card_no=$_REQUEST['card_no'];
 $exp_month=$_REQUEST['exp_month'];
 $exp_year=$_REQUEST['exp_year'];
 $cvv=$_REQUEST['cvv'];
 $amount=number_format($_REQUEST['amount'],2);
 $customer_id=$_REQUEST['customer_id'];
 $customer_name=$_REQUEST['customer_name'];
 $billing_company=$_REQUEST['billing_company'];
 $address1=$_REQUEST['address1'];
 $address2=$_REQUEST['address2'];
 $city=$_REQUEST['city'];
 $state=$_REQUEST['state'];
 $country=$_REQUEST['country'];
 $zip=$_REQUEST['zip'];
 $phone=$_REQUEST['phone'];
 $fax=$_REQUEST['fax'];
 $email=$_REQUEST['email'];
// Set the fdggwsapi request - XML String-we have broken it down for viewing purposes
$body = "<SOAP-ENV:Envelope xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/'><SOAP-ENV:Header/>
<SOAP-ENV:Body>
<fdggwsapi:FDGGWSApiOrderRequest xmlns:v1='http://secure.linkpt.net/fdggwsapi/schemas_us/v1' xmlns:v3='http://secure.linkpt.net/fdggwsapi/schemas_us/a1' xmlns:fdggwsapi='http://secure.linkpt.net/fdggwsapi/schemas_us/fdggwsapi'>
<v1:Transaction>
      <v1:CreditCardTxType>
              <v1:Type>sale</v1:Type>
      </v1:CreditCardTxType>
      <v1:CreditCardData>
              <v1:CardNumber>$card_no</v1:CardNumber>
              <v1:ExpMonth>$exp_month</v1:ExpMonth>
              <v1:ExpYear>$exp_year</v1:ExpYear>
              <v1:CardCodeValue>$cvv</v1:CardCodeValue>
      </v1:CreditCardData>
     <v1:Payment>
            <v1:ChargeTotal>$amount</v1:ChargeTotal>
            <v1:SubTotal>$subtotal</v1:SubTotal>
            <v1:Tax>$tax</v1:Tax>
            <v1:Shipping>$shiping</v1:Shipping>
     </v1:Payment>
     <v1:TransactionDetails>
               <v1:InvoiceNumber>$invoice_no</v1:InvoiceNumber>
            <v1:OrderId>$order_no</v1:OrderId>
            <v1:PONumber>$purchase_order_no</v1:PONumber>
            <v1:TransactionOrigin>$transaction_origin</v1:TransactionOrigin>
     </v1:TransactionDetails>
     <v1:Billing>
               <v1:CustomerID>$customer_id</v1:CustomerID>
            <v1:Name>$customer_name</v1:Name>
            <v1:Company>$billing_company</v1:Company>
            <v1:Address1>$address1</v1:Address1>
            <v1:Address2>$address2</v1:Address2>
            <v1:City>$city</v1:City>
            <v1:State>$state</v1:State>
            <v1:Zip>$zip</v1:Zip>
            <v1:Country>$country</v1:Country>
            <v1:Phone>$phone</v1:Phone>
            <v1:Fax>$fax</v1:Fax>
            <v1:Email>$email</v1:Email>
     </v1:Billing>
 </v1:Transaction>
</fdggwsapi:FDGGWSApiOrderRequest>
</SOAP-ENV:Body></SOAP-ENV:Envelope>";


// initializing cURL with the IPG API URL (OLD URL):
$ch = curl_init(FDAPI_URL);



// setting the request type to POST:
curl_setopt($ch, CURLOPT_POST, 1);

// setting the content type:
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));

// setting the authorization method to BASIC:
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

// supplying your credentials:
curl_setopt($ch, CURLOPT_USERPWD, FD_USERPWD);

// filling the request body with your SOAP message:
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// telling cURL to verify the server certificate:
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// setting the path where cURL can find the certificate to verify the
// Info directly from the API Manual Below:
 curl_setopt($ch, CURLOPT_SSLCERT, FD_SSLCERT);
 curl_setopt($ch, CURLOPT_SSLKEY, FD_SSLKEY);
 curl_setopt($ch, CURLOPT_SSLKEYPASSWD, FD_SSLKEYPASSWD);
// telling cURL to return the HTTP response body as operation result
// value when calling curl_exec:
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// calling cURL and saving the SOAP response message in a variable which
// contains a string like "<SOAP-ENV:Envelope ...>...</SOAP-ENV:Envelope>":
$result = curl_exec($ch);  //if the curl executed successfully then it will return the <saop> XML response with getTransactionResult

if (getTransactionResult($result) == 'FAILED') {
        $res = 2;
}
else{
      $res = 1 ;
}
curl_close($ch);
# end code
print("The response is $result");
if($res == 1)
{
   echo 'success';
    header("location:paymentsuccess.php");
}
else
{
  echo 'fail';
   header("location:paymentunsuccess.php");
}
echo "<br/>";
 $_SESSION['trans_result']=getTransactionResult($result);
echo "<br/>";
 $_SESSION['order_id']=getRecurrringOrderID($result);
*/

	
	
	
	
	
	
	

// if it declines, write the sales record (decline) then show them the decline page (which includes a back button so they can change the info)



/*	// Do some word math
	$realtor_role = ($_REQUEST['realtor_role_other'] != '' ? $_REQUEST['realtor_role_other'] : $_REQUEST['realtor_role']);
	$realtor_referral = '';
	if (!empty($_REQUEST['referral'])){
		$realtor_referral = implode("|", $_REQUEST['referral']);
	}
	if (!empty($_REQUEST['referral_agent_name'])){
		if (!empty($_REQUEST['referral_other_detail'])){
			$realtor_referral = substr($realtor_referral, 0, -1); // Trim off the extra "|"
		}
		$realtor_referral .= ": ".$_REQUEST['referral_agent_name'];
	}
	if (!empty($_REQUEST['referral_other_detail'])){
		if (!empty($realtor_referral) && !empty($_REQUEST['referral_agent_name'])){
			$realtor_referral .= "|";
		}
		$realtor_referral .= "Other: ".$_REQUEST['referral_other_detail'];
	}
*/

// write the sales record






//die();


// Send email receipt






//show them the thank you page










	// Send the verification email

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

	// Encrypt email address and pass it as the ID value
	$dataKey = base64_decode('1zvKhVe39VUe9HDtz3q1x2dqcoDDFEgW35VhIq2YmP0=');
	$id = encrypt($_REQUEST['realtor_email'], $dataKey);
	$id .= $member_id;
	
	// build the email
	$to = $_REQUEST['realtor_email'];
//	$to = 'jeff.saunders@ewomennetwork.net'; //Testing
//	$to = 'kym.yancey@ewomennetwork.net'; //Testing
	$subject = 'Your Smart Women Buy Homes Advisor Program Information Request';
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

				<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; color:#272727;"><strong>Hello '.$_REQUEST['realtor_first_name'].':</strong></p>

				<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; color:#272727;">Thank you so much for your interest in Smart Women Buy Homes. Please <a href="https://www.smartwomenbuyhomes.com/secure.php?page=realtor-marketing-kit&id='.$id.'">Click Here</a> to access important information about how our exclusive Smart Women Buy Homes Advisor Program can help you bring the joy of homeownership to single women and expand your real estate practice.</p>

				<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; color:#272727;">This link is your exclusive private key to access this information at any time, so please keep it safe and keep it handy.</p>

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
//		$headers .= 'Bcc: jeffsaunders@gmail.com' . "\r\n";  //Testing

	// Mail it
	mail($to, $subject, $message, $headers);
		
		// Include link to the marketing kit page with hashed email address and member id
		// On that page check to see if they have already verified, if not, stamp the time then show them the page
		// If they have verified, just show them the page...they can come back all they want with that link
		
		// Tell them thanks for the information request and that they should look for the email
*/
?>
<h2>Opportunity for Realtors</h2>

<p>Thank you so much for your interest in Smart Women Buy Homes.</p>

<p>Shortly you will receive an email sent to the address you entered on the request form.  In it you will find a your exclusive private link to access important information about how our Smart Women Buy Homes Advisor Program can help you bring the joy of homeownership to single women and expand your real estate practice.</p>

<?php
}else{
	// get passed value and pull it apart
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
?>

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
?>

<h2>The Smart Women Buy Homes Marketing Kit - <span style="font-color:#C60 !important;">Checkout</span></h2>

<div class="checkout">
	<form action="" method="post" name="checkoutForm" id="checkoutForm">
	<div class="form-fields">
		<!-- Again, what is this for???? -->
        <p style="display:none;">
        <select name="month" id="month">
            <option value="<?php echo $current_month; ?>"><?php echo $current_month; ?></option>
        </select>
        
        <input type="text" name="date" id="date" size="2" value="<?php echo $current_date; ?>" />
        
        <select>
            <option value="<?php echo $current_year; ?>"><?php echo $current_year; ?></option>
        </select>
        
        <input type="text" name="time" id="time" size="5" value="<?php echo $current_time; ?>" />
        </p>

		<!-- Product(s) -->
		<h3 style="margin-bottom:5px;">Product</h3>
		<p>
			<input type="radio" name="product_id" value="KIT1" checked class="radio-indent"> $999.99 - Smart Women Buy Homes Marketing Kit for Real Estate Professionals<br>
			<input type="hidden" name="product_description" id="product_description" value="Smart Women Buy Homes Marketing Kit for Real Estate Professionals">
			<input type="hidden" name="product_price" id="product_price" value="695.00">
		</p>  

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
					<input type="text" name="billing_zip_code" id="billing_zip_code" value="<?php echo $BillingZipCode; ?>" class="text-input medium-input">
				</p>
			</div><!--form-location-->

			<div class="clear"</div><!--clear-->

		</div><!--form-address-->
		<p>
			<label>Phone</label><br>
			<input type="text" name="billing_phone" id="billing_phone" value="<?php echo $BillingPhone; ?>" class="text-input medium-input">
		</p>

		<!-- Payment Information -->
		<h3 style="border-top:1px solid #666; padding-top:20px; margin:20px 0px 10px 0px;">Credit Card Information</h3>

		<p><img src="images/misc/credit_card_logos.jpg" width="158" height="30" alt="Visa, Mastercard, Discover, American Express" border="0"></p>

		<p style="float:left; margin-right:10px;">
			<label>Credit Card Number</label><br>
			<input class="text-input medium-input" style="width:300px !important;" type="text" id="cc_number" name="cc_number"> <!-- Numbers ONLY -->
		</p>

		<p style="float:left;">
			<label>Security Code</label><br>
			<input class="text-input small-input" style="width:80px !important;" type="text" id="cc_cvv" name="rcc_cvv">
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

		<p>
			<br>
			<input type="hidden" name="member_id" id="member_id" value="<?php echo $userID; ?>">
			<input class="button" type="submit" value="Submit Payment" name="submit" id="submit">
		</p>

		<br><br>
	</div><!--form-fields-->    
<!--
	At the end of each year, your membership is automatically renewed for another year.  You may cancel your membership at any time as long as it is at least 30 days before the end of the current term.  Your membership will be cancelled upon the next renewal date and you will no longer be charged for automatic renewals.  Cancellations within the final 30 days of the current term will be effective at the end of the subsequent term.  Your next annual renewal date will be one year from today.
-->
	<div class="clear"></div><!-- End .clear -->
	</form>
</div><!--checkout-->
<?php
	}
}
?>
<!-- This dangling closer must be paired with an open in the calling script -->
</div>   
                
