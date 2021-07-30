<?php
/*
Plugin Name: NuCaptcha
Plugin URI: http://docs.nucaptcha.com/plugins/wordpress
Description: NuCaptcha is a powerful next-generation Animated Captcha available for WordPress.  It is both easier to use and more secure than common Captcha systems.
Version: 1.0.20375
Author: Christopher Bailey, Gary Richardson, Randy Lukashuk / NuCaptcha Inc.
Author URI: http://www.nucaptca.com/
License: LGPLv2.1
*/

//
// NOTE:  ALL GLOBALS MUST GO IN THIS FILE
//

/**
 * @var $nucaptcha_comment_error - A boolean to store whether or not the posted comment nucaptcha was CORRECT (true) or NOT (false)
 */
$nucaptcha_comment_error = false;

/**
 * @var $nucaptcha_prev_comment - string that holds the previous comment.  Untouched.  It is stored here when we delete it.
 */
$nucaptcha_prev_comment = '';

/**
 * @var $nucaptcha_dependency_error - Error to display if there is a dependency/compatability issue
 */
$nucaptcha_dependency_error = '';

/**
 * @var $nucaptcha_disable_ssl_verify - SSL certificates not configured correctly for this server.  Notify the user and suggest they turn it off.
 */
$nucaptcha_disable_ssl_verify = false;

/**
 * @var $nucaptcha_incompatible_plugins - A list of active plugins to check for before NuCaptcha is enabled.
 */
$nucaptcha_incompatible_plugins = '/wp-recaptcha|really-simple-captcha|si-captcha|solvemedia|keycaptcha/i';
$nucaptcha_plugin_friendly_names = array(
	'wp-recaptcha/wp-recaptcha.php' => 'wp-recaptcha',
	'really-simple-captcha/really-simple-captcha.php' => 'Really Simple CAPTCHA',
	'solvemedia/solvemedia.php' => 'SOLVEMEDIA',
	'wp-recaptcha/wp-recaptcha.php' => 'WP-reCAPTCHA',
	'si-captcha/si-captcha.php' => 'SI CAPTCHA Anti-Spam',
	'keycaptcha/keycaptcha.php' => 'KeyCAPTCHA',
);

// Bumping this version will force a new dependency check
define('NUCAPTCHA_DATA_VERSION', 6);

// Set nucaptcha version details
global $wp_version;
define('LM_PLATFORM', sprintf('wordpress %s,nucaptcha %s', $wp_version, '1.0.20375'));
define('NCWP_ENABLE_BUDDYPRESS', true);
define('NCWP_ENABLE_CONTACTFORM7', true);

/**
 * To avoid any PHP or other configuration issues, check the dependencies with a backwards
 * compatible piece of code.  If everything checks out, THEN include the NuCaptcha plugin.
 *
 */
function nucaptcha_init() {
	$can_run = nucaptcha_can_run();
	
	if (true === $can_run) {

		require_once 'nucaptcha_plugin.php';
		require_once 'nucaptcha_data.php';
		require_once 'nucaptcha_comment.php';
		require_once 'nucaptcha_register.php';
		require_once 'nucaptcha_api_client.php';

		if( defined('NCWP_ENABLE_CONTACTFORM7') )
		{
			if( function_exists('wpcf7_add_shortcode') )
			{
				require_once 'nucaptcha_wpcf7.php';
			}
		}

		// Disable WordPress streams transport - doesn't appear to be working correctly with https
		// It is only used in the case where curl is not installed and allow_url_fopen is set to true
		add_filter('use_streams_transport', 'nucaptcha_disable_streams_transport');

		// SSL verify
		add_filter('https_ssl_verify', 'nucaptcha_ssl_verify');
		add_filter('https_local_ssl_verify', 'nucaptcha_ssl_verify');
		
		// Administration / Config
		add_action('admin_menu', 'nucaptcha_config_page');
		wp_register_script('nucaptcha_admin', WP_PLUGIN_URL . '/nucaptcha/res/js/wp-nucaptcha-admin.js');
		nucaptcha_admin_warnings();

		// Initialize the comment section
		nucaptcha_comment_init();

		// Initialize the signup section
		nucaptcha_register_init();

		// Clean up if deactivated
		register_deactivation_hook(__FILE__, 'delete_nucaptcha_preferences');
	}
	else {
		if (!array_key_exists('page', $_GET) || ('nucaptcha-key-config' != $_GET['page'])) {
			global $nucaptcha_dependency_error;
			$nucaptcha_dependency_error = sprintf("<div id='nucaptcha_config_warning' class='error'><p><b>NuCaptcha dependency error:</b></p><p>This WordPress configuration is not able to run the NuCaptcha plugin.</p><p>Reason: <i>%s</i></p></div>", $can_run);
			function nucaptcha_dependency_error() {
				global $nucaptcha_dependency_error;
				echo $nucaptcha_dependency_error;
			}
			add_action('admin_notices', 'nucaptcha_dependency_error');
		}
	}
}

add_action('init', 'nucaptcha_init');


/**
 * Check to see if NuCaptcha is configured.
 *
 * We manually check the options because we don't want to include
 * the nucaptcha_data.php in case user is running PHP 4.x
 *
 */
function is_nucaptcha_configured()
{
	// Get the option to see if we're configured
	$option = get_option('nucaptcha_data');
	if (false === $option) return false;

	// Is it the right version?
	if ($option['version'] < NUCAPTCHA_DATA_VERSION) return false;

	// Valid option.. check configuration status
	return $option['dep_ok'];
}


/**
 * Is this a windows server?  Return bool
 */
function nucaptcha_is_windows_server() {
	$key = 'SERVER_SOFTWARE';
	if (array_key_exists($key, $_SERVER)) {
		if( stristr( $_SERVER[$key], 'win32' ) !== false ) return true;
		if( stristr( $_SERVER[$key], 'microsoft' ) !== false ) return true;
	}
	return false;
}


/**
 * Is this server able to run NuCaptcha?
 *
 * Return true if it can.
 * Return string error/reason if it can't
 */
function nucaptcha_can_run() {
	
	// check for incompatible plugins
	global $nucaptcha_incompatible_plugins;
	global $nucaptcha_plugin_friendly_names;
	$plugins = get_option('active_plugins');
	$incompatible = array();
	foreach( $plugins as $r )
	{
		$m = preg_match($nucaptcha_incompatible_plugins, $r);
		if( $m !== false && $m > 0 )
		{
			$incompatible[] = $r;
		}
	}

	if( count($incompatible) > 0 )
	{
		$reason = '<ul>';
		foreach($incompatible as $r)
		{
			$deactivate_link = '<a href="' . wp_nonce_url('plugins.php?action=deactivate&amp;plugin='.$r, 'deactivate-plugin_' . $r). '" title="Deactivate this plugin">Deactivate</a>';
			$fn = $r;
			if( array_key_exists($r, $nucaptcha_plugin_friendly_names ))
			{
				$fn = $nucaptcha_plugin_friendly_names[$r];
			}
			$reason .= '<li>';
			$reason .= 'NuCaptcha is not compatible with '.$fn.'. '.$deactivate_link.' this plugin before using NuCaptcha.';
			$reason .= '</li>';
		}
		$reason .= '</ul>';
		return $reason;
	}

	if (is_nucaptcha_configured()) {
		return true;
	}

	// PHP_VERSION_ID is available as of PHP 5.2.7, if our
	// version is lower than that, then emulate it
	if (!defined('PHP_VERSION_ID')) {
		$version = explode('.', PHP_VERSION);

		define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
	}

	if( PHP_VERSION_ID < 50100 ) {
		return 'Host Configuration requires PHP Version 5.1 or greater.  You are running: '.PHP_VERSION;
	}

	// Confirm mCrypt is loaded
	if ( !extension_loaded('mcrypt') ) {
		return 'NuCaptcha requires the <a href="http://php.net/manual/en/book.mcrypt.php">mcrypt</a> extension to be installed and enabled.';
	}

	// Check WP version (we have a known minimum of 2.7)
	global $wp_version;
	if( version_compare( $wp_version, '2.7', '<' ) )
	{
		return 'NuCaptcha requires WordPress version 2.7 or higher.  You are running: '.$wp_version;
	}

	return true;
}

function nucaptcha_disable_streams_transport($args)
{
	return false;
}

function nucaptcha_plugin_action_links( $links, $file ) {
	if ( $file == plugin_basename( dirname(__FILE__).'/nucaptcha.php' ) ) {
		$links[] = '<a href="plugins.php?page=nucaptcha-key-config">'.__('Settings').'</a>';
	}

	return $links;
}

add_filter( 'plugin_action_links', 'nucaptcha_plugin_action_links', 10, 2 );
