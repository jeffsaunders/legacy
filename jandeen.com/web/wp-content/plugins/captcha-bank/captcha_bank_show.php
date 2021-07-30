<?php
global $wpdb;
	$settings = $wpdb -> get_col
	(
		"SELECT settings_value FROM " . captcha_bank_settings() . " ORDER BY settings_id ASC"
	);
	$settings_array = array();
	for($flag=0; $flag < count($settings); $flag++)
	{
		array_push($settings_array, $settings[$flag]);
	}
require_once dirname(__FILE__) . '/captcha_bank_image.php';
 
$img = new captcha_bank_image($settings_array);
$img->display();  // outputs the image and content headers to the browser
?>