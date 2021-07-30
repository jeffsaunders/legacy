<?php 
$storename = "1001293007"; //Storenumber
$sharedSecret = "38363833343930353637333234313535363838313437383438393130343632353531363935393236373133363033383830373131333435363138333336393639"; //Shared Secret
/* If you have below PHP version 5.1 OR don't want to set the Default TimeZone, then make the following changes to set your server timeZone: 
Example: If your server is in "PST" timezone, here are the changes: 
//date_default_timezone_set("Asia/Calcutta"); // Comment this line 
$timezone = "PST" // Change to your server timeZone 
*/ 
//date_default_timezone_set("Asia/Calcutta"); 
$timezone = "CST";
/* ---- */ 
$dateTime = date("Y:m:d-H:i:s");
function getDateTime(){
	global $dateTime;
	return $dateTime;
}
function getTimezone(){
	global $timezone;
	return $timezone;
}
function getStorename(){
	global $storename;
	return $storename;
}
function createHash($chargetotal){
	global $storename, $sharedSecret;
	$str = $storename . getDateTime() . $chargetotal . $sharedSecret;
	for ($i = 0; $i < strlen($str); $i++){
		$hex_str.=dechex(ord($str[$i]));
	}
	return hash('sha256', $hex_str);
}
?> 