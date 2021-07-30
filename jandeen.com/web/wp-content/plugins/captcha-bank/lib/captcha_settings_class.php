<?php
global $wpdb;
global $current_user;
$current_user = wp_get_current_user();
if (!current_user_can("edit_posts") && ! current_user_can("edit_pages"))
{
	return;
}
else
{
	if(isset($_REQUEST["param"]))
	{
		if($_REQUEST["param"] == "update_settings")
		{
			$ux_label  = esc_attr($_REQUEST['ux_label']);
			$ux_tooltip  = esc_attr($_REQUEST['ux_tooltip']);
			$ux_captcha_on_login_form = isset($_REQUEST['ux_captcha_on_login_form'])? intval($_REQUEST['ux_captcha_on_login_form']):0;
			$ux_captcha_on_register_form = isset($_REQUEST['ux_captcha_on_register_form'])? intval($_REQUEST['ux_captcha_on_register_form']):0;
			$wpdb->query
			(
				$wpdb->prepare
				(
					"UPDATE ".captcha_bank_settings()." SET settings_value = %s  WHERE settings_key = %s",
					$ux_label,
					'label'
				)
			);
			$wpdb->query
			(
				$wpdb->prepare
				(
					"UPDATE ".captcha_bank_settings()." SET settings_value = %s  WHERE settings_key = %s",
					$ux_tooltip,
					'tooltip'
				)
			);
			$wpdb->query
			(
				$wpdb->prepare
				(
					"UPDATE ".captcha_bank_settings()." SET settings_value = %s  WHERE settings_key = %s",
					$ux_captcha_on_login_form,
					'captcha_on_login_form'
				)
			);
			$wpdb->query
			(
				$wpdb->prepare
				(
					"UPDATE ".captcha_bank_settings()." SET settings_value = %s  WHERE settings_key = %s",
					$ux_captcha_on_register_form,
					'captcha_on_register_form'
				)
			);
			 die();
		 }
	}
 }
?>