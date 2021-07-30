<?php

function include_nucaptcha() {
	// try to load a dev library first
	if(file_exists(dirname(__FILE__) . '/dev/leapmarketingclient.php'))
	{
		require_once dirname(__FILE__) . '/dev/leapmarketingclient.php';
	}
	else
	{
		require_once dirname(__FILE__) . '/1.0/php/leapmarketingclient.php';
	}

	if (NuCaptchaData::is_functional()) {
		Leap::SetClientKey(NuCaptchaData::get_client_key());

		Leap::SetValidateOnError( NuCaptchaData::Get('validate_on_error') === true );
	}
}

function delete_nucaptcha_preferences() {
	NuCaptchaData::delete_data();
}

function nucaptcha_admin_warnings() {
	if( !is_admin() ) return;

	if (!NuCaptchaData::is_initialized()) {

		if (!array_key_exists('page', $_GET) || ('nucaptcha-key-config' != $_GET['page'])) {
			function nucaptcha_config_warning() {
				echo "<div id='nucaptcha_config_warning' class='error'><p><b>NuCaptcha is almost ready to use.</b>  You must <a href='plugins.php?page=nucaptcha-key-config'>configure NuCaptcha</a> before it will work.</p></div>";
			}
			add_action('admin_notices', 'nucaptcha_config_warning');
		}
	}

	if( NuCaptchaData::Get('ignore_admin_login_message') && NuCaptchaData::Get('protect_login') && current_user_can('delete_plugins') )
	{
		function nucaptcha_ignore_login_warning() {
				echo "<div id='nucaptcha_ignore_login_warning' class='error'><p><b>NuCaptcha login validation was purposely ignored for this Admin user.</b>  You can disable this feature in the <a href='plugins.php?page=nucaptcha-key-config'>NuCaptcha Config</a> page.</p></div>";
		}
		add_action('admin_notices', 'nucaptcha_ignore_login_warning');
		NuCaptchaData::Set('ignore_admin_login_message', false);
	}
}

function nucaptcha_cache_enabled() {
	return defined('WP_CACHE') && WP_CACHE === true;
}

function nucaptcha_config_page() {
	if ( function_exists('add_submenu_page') ) {
		$pages = array();
		$pages[] = add_submenu_page('plugins.php', 'NuCaptcha Config.', 'NuCaptcha Config.', 'manage_options', 'nucaptcha-key-config', 'nucaptcha_config');

		foreach ($pages as $page)
		{
			add_action( "admin_print_scripts-$page", 'nucaptcha_head' );
		}
	}
}

function nucaptcha_head() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('nucaptcha_admin', '', array('jquery'));
}

function generic_update($message, $error=false) {
	if ($error) {
		echo "<div class='error'><p>$message</p></div>";
	}
	else {
		echo "<div class='updated'><p>$message</p></div>";
	}
}

function should_show_nucaptcha_to_user() {
	switch (NuCaptchaData::Get('show_to'))
	{
		case 'everyone':
			// never show captcha when in admin dashboard
			return !is_admin();
		case 'unregistered':
			return !is_user_logged_in();
		default:
			return true;
	}
}

function nucaptcha_nonce_field($action) {
	// since wp 2.0.4
	if( function_exists('wp_nonce_field')){
		return wp_nonce_field('nucaptcha-'.$action);
	}
	return '';
}

function nucaptcha_verify_nonce_field($action) {
	if( function_exists('check_admin_referer')){
		// dies on error... probably not the most elegant but its what wp currently recommends to use
		check_admin_referer('nucaptcha-'.$action);
	}

	// older versions of wordpress don't have nonces
	return true;
}

function nucaptcha_check_passwords($password, $password_conf)
{
	if ((strlen($password) >= 8) && ($password == $password_conf)) return true;
	generic_update('Password not long enough or does not match.', true);
	return false;
}

function nucaptcha_load_account_details($email, $password, $publisherId=null)
{
	$email = trim($email);

	// Reset the dependency checking
	NuCaptchaData::Set('dep_ok', false);
	NuCaptchaData::Set('client_key', '');

	// Store our email and password
	NuCaptchaData::Set('email', $email);

	// Get a list of the available publishers
	$result = lmApiClient::list_publishers($email, $password);

	if ('failed' == $result['status']) {
		throw new Exception('Invalid email/password combination.');
	}

	$first = true;
	$list = array();
	foreach ($result['publishers'] as $id=>$access) {
		// Get the publishers name and store it in the list
		$info = lmApiClient::get_publisher_info($email, $password, $id);

		if ('failed' == $info['status']) {
			throw new Exception(sprintf('Error in get_publisher_info(%s)', $id));
		}

		$list[$id] = $info['publisherName'];

		// Grab FIRST in case publisherId null, or not found.
		if ($first || ($id == $publisherId)) {
			$first = false;

			// Store the publisher id
			NuCaptchaData::Set('publisher_id', $id);

			// Get the Publisher Name
			NuCaptchaData::Set('domain_name', $info['publisherName']);

			// Get the Client Key
			NuCaptchaData::Set('client_key', $info['clientKey']);
		}
	}

	// Store the publisher list
	NuCaptchaData::Set('publisher_list', $list);
}

function nucaptcha_config() {
	// Confirm we have access to submit option changes
	if ( isset($_POST['submit']) ) {
		if ( function_exists('current_user_can') && !current_user_can('manage_options') )
			die(__('Access Denied.'));
	}

	include_nucaptcha();

	// Store the AJAX URL for the admin code
	echo '<script type="text/javascript">';
	echo 'var nucaptcha_admin_ajax = "'.get_bloginfo('wpurl').'/wp-content/plugins/nucaptcha/ajax.php";';
	echo '</script>';

	// Did we submit the disable ssl verify?
	if (array_key_exists('force_ssl_verify', $_POST)) {
		NuCaptchaData::Set('ssl_verify', $_POST['force_ssl_verify'] != '0');
	}

	// Are we signing in to the account?
	if (array_key_exists('submit_signin', $_POST)) {
		try {
			// Reset data to defaults before trying to sign in
			nucaptcha_verify_nonce_field('signin');
			NuCaptchaData::reset_to_default();
			nucaptcha_load_account_details($_POST['email'], $_POST['password']);
			generic_update('<b>Sign In Successful.</b>  Your settings have been retrieved from NuCaptcha.');
		}
		catch(Exception $e) {
			generic_update('<b>Could not update account: ' . $e->getMessage() . '</b>', true);
		}
	}
	// Are we modifying the account / updating the information?
	else if (array_key_exists('submit_update_account', $_POST)) {
		try {
			nucaptcha_verify_nonce_field('update_account');
			nucaptcha_load_account_details($_POST['email'], $_POST['password'], $_POST['publisher_id']);
			generic_update('<b>Account Configuration Updated.</b>  Your settings have been retrieved from NuCaptcha.');

			NuCaptchaData::Set('show_advanced',  nucaptcha_check_post('show_advanced', '1'));
		}
		catch(Exception $e) {
			generic_update('<b>Could not update account: ' . $e->getMessage() . '</b>', true);
		}
	}
	else if (array_key_exists('submit_wpconfig', $_POST)) {
		nucaptcha_verify_nonce_field('wpconfig');

		generic_update('<b>Configuration Updated.</b>  Your NuCaptcha preferences have been updated.');

		NuCaptchaData::Set('show_to', $_POST['show_to']);

		NuCaptchaData::Set('protect_comments', nucaptcha_check_post('protect_comments'));
		NuCaptchaData::Set('protect_signup', nucaptcha_check_post('protect_signup'));
		NuCaptchaData::Set('protect_login', nucaptcha_check_post('protect_login'));
		NuCaptchaData::Set('protect_resetpwd', nucaptcha_check_post('protect_resetpwd'));
		NuCaptchaData::Set('ignore_admin_login', nucaptcha_check_post('ignore_admin_login'));

		NuCaptchaData::Set('css_error', $_POST['css_error']);
		NuCaptchaData::Set('css_message', $_POST['css_message']);

		NuCaptchaData::Set('player_position', $_POST['player_position']);

		NuCaptchaData::Set('ssl_verify', nucaptcha_check_post('ssl_verify'));

		NuCaptchaData::Set('validate_on_error', nucaptcha_check_post('validate_on_error'));

		NuCaptchaData::Set('custom_skin_html', nucaptcha_slashit($_POST['custom_skin_html']));
		NuCaptchaData::Set('show_advanced',  nucaptcha_check_post('show_advanced', '1'));
	}

	// Display the CSS and HTML for the form
	include_once 'res/css/wp-nucaptcha-admin.css';
	include_once 'nucaptcha_config.html';

	$blog_url = get_bloginfo('wpurl').'/wp-admin/plugins.php?page=nucaptcha-key-config';
	if (!NuCaptchaData::is_initialized()) {
		$nucaptcha_initialized = false;
		include_once 'nucaptcha_config_signin.html';
	}
	else {
		$nucaptcha_initialized = true;
		if ((array_key_exists('detail', $_GET)) && ('updatedetails' == $_GET['detail'])) {
			include_once 'nucaptcha_config_updateaccount.html';
		} else {
			include_once 'nucaptcha_config_wpconfig.html';
		}
	}
}

function nucaptcha_check_post($key, $val=null)
{
	// set default
	if( $val == null )
	{
		$val = $key;
	}

	return (array_key_exists($key, $_POST) ? ($_POST[$key] == $val) : false);
}

function nucaptcha_wp_user_info() {
	$uinfo = wp_get_current_user();
	if( $uinfo->ID == 0 ) {
		// not logged in
		return "anonymous_user";
	}

	return $uinfo->user_login.'-'.$uinfo->user_email.'-'.$uinfo->ID;
}

function validate_nucaptcha() {
	include_nucaptcha();

	if (false == array_key_exists('nucaptcha_ps', $_POST))
	{
		// persistent data isn't present -- Someone trying to sneak a post in?
		return false;
	}

	$result = Leap::ValidateTransaction($_POST['nucaptcha_ps'], false, nucaptcha_wp_user_info());
	return $result;
}

function generate_id_hash($id) {
	include_nucaptcha();
	return md5(lmcHelper::GenerateWebUserID() . $id);
}

function nucaptcha_test_ssl_connection()
{
	// Test the connection to the NuCaptcha servers
	//$testUrl = NUCAPTCHA_API_URL . '/accountExists/urlencode';
	//$testData = 'accountId='.urlencode('test@test.com');
	try
	{
		//$result = self::wp_client($testUrl, $testData);
		lmApiClient::account_exists('test@test.com');
	}
	catch(Exception $e)
	{
		// This can happen when your environment doesn't have curl certs (ie MAMP Free on Mac OSX)
		// Lets try to disable ssl_verify within WordPress
		global $nucaptcha_disable_ssl_verify;
		$nucaptcha_disable_ssl_verify = true;
		try
		{
			lmApiClient::account_exists('test@test.com');
			generic_update('<form id="sslvdisable" action="" method="post"><input type="hidden" name="force_ssl_verify" value="0">It is likely that SSL certificate bundles are not configured correctly on this server.  Please consult your server documentation for proper configuration.<br><br>Alternatively, you can <a href="" onclick="jQuery(\'#sslvdisable\').submit(); return false;">click here</a> to disable SSL certificate verification.<br><br>Warning: Disabling SSL verification can open you up to man in the middle attacks and should only ever be considered for development servers.  You can re-enable SSL verification at any time in the NuCaptcha WordPress Configuration tab.<input type="submit" value="Disable SSL Verify" style="display:none;"></form>', true);
		}
		catch(Exception $e2)
		{
			// This should never happen
			generic_update('Unable to connect to NuCaptcha API servers.  Please make sure php_curl or equivalent is installed or try again later.', true);
		}
		$nucaptcha_disable_ssl_verify = false;
	}
}

function nucaptcha_ssl_verify($ssl_verify)
{
	global $nucaptcha_disable_ssl_verify;
	if( $nucaptcha_disable_ssl_verify === true )
	{
		return false; // Force no verify
	}
	return NuCaptchaData::Get('ssl_verify');
}

// add slashes to html if magic quotes is not on
function nucaptcha_slashit($stringvar)
{
    if (!get_magic_quotes_gpc()){
        $stringvar = addslashes($stringvar);
    }
    return $stringvar;
}

// remove slashes if magic quotes is on
function nucaptcha_deslashit($stringvar)
{
    if (1 == get_magic_quotes_gpc()){
        $stringvar = stripslashes($stringvar);
    }
    return $stringvar;
}

// returns true if WP site running over https
function nucaptcha_use_ssl()
{
	if( 0 === strpos(strtolower(get_bloginfo('wpurl')), 'https://') )
	{
		return true;
	}
	return false;
}