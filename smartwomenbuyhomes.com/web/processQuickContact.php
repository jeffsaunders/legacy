<?php
session_start();

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
$dataKey = base64_decode('1zvKhVe39VUe9HDtz3q1x2dqcoDDFEgW35VhIq2YmP0=');

// Make sure the passed encrypted token matches the session id
if (trim(decrypt($_REQUEST['token'], $dataKey)) == trim(session_id())){
	require_once ('includes/connect.php');
	
	// Write the record
	$query = "
		INSERT INTO quick_contacts (
			name,
			email,
			phone,
			best_time,
			comments,
			date)
		VALUES (
			'".addslashes($_REQUEST['name'])."',
			'".$_REQUEST['email']."',
			'".$_REQUEST['phone']."',
			'".$_REQUEST['best_time']."',
			'".addslashes($_REQUEST['comment'])."',
			UNIX_TIMESTAMP())
		";
	//die($query);
	$result = mysql_query($query, $dbhandle);
	
	// Now send email containing the form data to Jeanie
	$to = 'jeanie.douthitt@gmail.com';
//	$to = 'jeffsaunders@gmail.com'; //Testing
//	$to = 'kym.yancey@ewomennetwork.net'; //Testing
	$subject = 'Smart Women Buy Homes Quick Contact Submission';
	$message = '
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title></title>
<html>
<body>
<table style="font-family:Arial, Helvetica, sans-serif;">
<tr>
	<td colspan="2">The following information request was received at <strong>'.date('g:h a', time()).' on '.date('n/j/y', time()).'</strong>:<br><br></td>
</tr>
<tr>
	<td valign="top">Name:</td>
	<td><strong>'.$_REQUEST['name'].'</strong></td>
</tr>
<tr>
	<td valign="top">Email:</td>
	<td><strong>'.$_REQUEST['email'].'</strong></td>
</tr>
<tr>
	<td valign="top">Phone:</td>
	<td><strong>'.$_REQUEST['phone'].'</strong></td>
</tr>
<tr>
	<td valign="top">Best Time:</td>
	<td><strong>'.$_REQUEST['best_time'].'</strong></td>
</tr>
<tr>
	<td valign="top">Comments:</td>
	<td><strong>'.$_REQUEST['comment'].'</strong></td>
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
//	$headers .= 'Bcc: jeanie.douthitt@gmail.com' . "\r\n";
//	$headers .= 'Bcc: jeffsaunders@gmail.com' . "\r\n";  //Testing
	
	// Mail it
	mail($to, $subject, $message, $headers);

	// Go back to whence you came
	$source = $_REQUEST['source'];
	header("Location: /?page=$source");
}else{
	die("Form submitted from unverified location...nice try!");
}
?>