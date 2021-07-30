<?php
require_once ('../includes/connect.php');

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
	SELECT first_name, confirm_date
	FROM members
	WHERE email = '".trim($decryptedEmail)."'
	AND member_id = '".$userID."'
";
$rs_member = mysql_query($query, $dbhandle);
if (mysql_num_rows($rs_member) == 0){
?>
<div align="center">
<br><br>
<h2>The Smart Women Buy Homes Marketing Kit for<br>Real Estate Professionals</h2>

<p>We're sorry, your exclusive private key was not found.</p>

</div>
<?php
}else{
	// Unfortunately, the way the hosting is configured there is no safe location for the files - do the best we can to obfuscate them.
	// Create a /downloads/ folder as a red herring, and specify it in the filename parameter to throw them off
	// Sanitize the passed filename
	$path_parts = pathinfo($_REQUEST['filename']);
	$file_name = $path_parts['basename'];
	$file_path = '/var/www/html/smartwomenbuyhomes.com/s22c61vb933957Q/'; // Real file location
	$file = $file_path.$file_name;
//die($file);
	$member = mysql_fetch_assoc($rs_member);

	// Record the download
	$query = "
		INSERT INTO downloads (
			member_id,
			download_date,
			download_ip,
			download_file)
		VALUES (
			'".$userID."',
			UNIX_TIMESTAMP(),
			'".$_SERVER['REMOTE_ADDR']."',
			'".$file_name."')
		";
	//die($query);
	$rs_update = mysql_query($query, $dbhandle);

	// set crazy headers for IE7 and below (ignored by all other browsers)
	header("Pragma: public");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

	// Declare what to do with the file, and what name to call it
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
	header("Content-Disposition: attachment; filename=\"$file_name\"");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Content-Length: ' . filesize($file));

	// Download the file
	set_time_limit(0); 
    ob_clean();
    flush();
	readfile($file);
?>
<div align="center">
<br><br>
<h2>The Smart Women Buy Homes Marketing Kit for<br>Real Estate Professionals</h2>

<p>Download Complete</p>

</div>
<?php
}
?>
