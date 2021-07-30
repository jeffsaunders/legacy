<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>

<?php
if ($_REQUEST['string']){
	// Create encrypt function for password comparison
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

	$dataKey = base64_decode('1zvKhVe39VUe9HDtz3q1x2dqcoDDFEgW35VhIq2YmP0=');

	$output = encrypt($_REQUEST['string'], $dataKey);

	echo "Encrypted String for <em>&quot;" . $_REQUEST['string'] . "&quot;</em> -> <strong>" . $output ."</strong><br><br>";
}
?>
<form action="" name="encrypt" id="encrypt">
	<input type="text" name="string">
	<input type="submit" name="Encrypt">
</form>

</body>
</html>
