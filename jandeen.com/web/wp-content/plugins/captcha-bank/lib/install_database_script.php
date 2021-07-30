<?php
global $wpdb;
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
if (count($wpdb->get_var('SHOW TABLES LIKE "' . captcha_bank_settings() . '"')) == 0)
{
	$sql= 'CREATE TABLE '.captcha_bank_settings(). '(
	settings_id INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	settings_key VARCHAR(200) NOT NULL,
	settings_value VARCHAR(200) NOT NULL,
	PRIMARY KEY (settings_id)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE utf8_general_ci';	
	dbDelta($sql);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"label",
			"Captcha"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"tooltip",
			"Enter the characters you see in the image"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"no_of_characters",
			"6"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"image_width",
			"215"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"image_height",
			"80"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"background_image",
			"bg4.jpg"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"text_color",
			"#e00000"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"fonts",
			"AHGBold.ttf"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"case_sensitive",
			"1"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"lines_on_image",
			"1"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"no_of_lines",
			"5"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"lines_color",
			"#707070"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"noise",
			"1"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"noise_level",
			"5"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"noise_color",
			"#707070"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"text_trasparency",
			"1"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"trasparency_percentage",
			"40"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"captcha_type",
			"both"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"distortion",
			"1"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"distortion_level",
			"0.75"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"image_signature",
			"1"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"signature",
			"Captcha-Bank"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"signature_color",
			"#000000"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"captcha_on_login_form",
			"1"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"captcha_on_comment_form",
			"0"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"captcha_on_admin_comment_form",
			"0"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"captcha_on_register_form",
			"1"
		)
	);
	$wpdb->query
	(
		$wpdb->prepare
		(
			"INSERT INTO ".captcha_bank_settings()."(settings_key,settings_value) VALUES(%s, %s)",
			"captcha_on_lost_password_form",
			"0"
		)
	);
}
?>