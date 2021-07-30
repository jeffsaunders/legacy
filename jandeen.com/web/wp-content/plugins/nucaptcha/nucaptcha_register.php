<?php

function nucaptcha_register_init() {
	// If Not Functional, or Don't want to display on register form
	if (!NuCaptchaData::is_functional()) return;
	
	// If we don't want to display on signup form, then just exit
	if (!NuCaptchaData::Get('protect_signup') && NuCaptchaData::Get('protect_login') && !NuCaptchaData::Get('protect_resetpwd')) return;	

	add_action('login_head', 'nucaptcha_register_header');

	// NuCaptcha appear on login/register/password form
	if( NuCaptchaData::Get('protect_signup') ) {
		add_action('register_form', 'nucaptcha_register_form', 0);
		// Hook the check_recaptcha function into WordPress
		// Note: Give errors before anything else.  This prevents other registration plugins from redirecting.
		if (version_compare(get_bloginfo('version'), '2.5' ) >= 0)
			add_action('register_post', 'nucaptcha_register_validate', -1, 3);
		else
			add_action('registration_errors', 'nucaptcha_register_validate_legacy', -1);

		if( defined('NCWP_ENABLE_BUDDYPRESS') )
		{
			add_action( 'bp_before_registration_submit_buttons', 'nucaptcha_bpregister_form' );
			add_filter( 'bp_core_validate_user_signup', 'nucaptcha_bpregister_validate', 10, 1 );
		}
	}
	
	if( NuCaptchaData::Get('protect_login') ) {
		// Note: Authenticate filter has to be last.  Multiple plugins using this hook do not play nice together.
		// Hopefully this will be fixed in a future version of Wordpress.
		add_action('login_form', 'nucaptcha_login_form', 0);
		add_filter('authenticate', 'nucaptcha_login_validate', 10000, 3);  // yuck, this needs to be highest priority to work
	}
	if( NuCaptchaData::Get('protect_resetpwd') ) {
		// Note: Again, like the register, do before anything else to avoid redirects.
		add_action('lostpassword_form', 'nucaptcha_lostpassword_form', -1);
		add_action('allow_password_reset', 'nucaptcha_allow_password_reset', -1, 2);
	}
}

//
// Register Form
//
function nucaptcha_register_header() {
	// Need to increase the size of the login panel so the player doesn't overflow
	echo '<style type="text/css">#login {width:390px;}</style>';
}

function nucaptcha_register_form() {
	include_nucaptcha();
	nucaptcha_register_form_helper(Leap::PURPOSE_CREATE_ACCOUNT);
}

function nucaptcha_register_form_helper($purpose) {
	$t = Leap::InitializeTransaction(null, nucaptcha_use_ssl(), null, $purpose);
	$ec = Leap::GetErrorCode();
	if (LMEC_OK == $ec) {
		echo nucaptcha_deslashit(NuCaptchaData::Get('custom_skin_html'));
		echo '<div id="wp_nucaptcha" style="padding-bottom: 4px;">'.$t->GetWidget(false, false, NuCaptchaData::Get('player_position')).'</div>';
		
		// Generates a string using current user info, returns 'anonymous_user' if not logged in
		$wpui = nucaptcha_wp_user_info();
		
		// Store our Public Persistent Storage
		echo '<input type="hidden" name="nucaptcha_ps" id="nucaptcha_ps" value="'.$t->GetPersistentDataForPublicStorage($wpui).'">';
	} else {
		echo '<div id="nucaptcha_error" class="'.NuCaptchaData::Get('css_error').'">Internal NC Code: '.$ec.'<br>Message: '.Leap::GetErrorString().'</div>';
	}
}

// Check the captcha (for WP versions < 2.5)
function nucaptcha_register_validate_legacy() {
	global $errors;
	
	// Is it correct?
	$response = validate_nucaptcha();
	if (!$response)
	{
		$errors['captcha_wrong'] = '<strong>ERROR:</strong> Incorrect <a href="http://www.nucaptcha.com/" target="_blank">NuCaptcha</a> Answer.  Please Try Again.';
	}
}


// Check the captcha (for WP versions >= 2.5)
function nucaptcha_register_validate($user, $email, $errors) {
	// Is it correct?
	$response = validate_nucaptcha();
	if (!$response)
	{
		$errors->add('captcha_wrong', '<strong>ERROR:</strong> Incorrect <a href="http://www.nucaptcha.com/" target="_blank">NuCaptcha</a> Answer.  Please Try Again.');
	}
	return $errors;
}

if( defined('NCWP_ENABLE_BUDDYPRESS') )
{
	function nucaptcha_bpregister_form() {

		echo '<style type="text/css">#nucaptcha-details-section { float: right; width: 48%; }</style>';
		echo '<div class="register-section" id="nucaptcha-details-section">';
		echo '<h4>Human Verification</h4>';
		echo '<label for="nucaptcha-answer">CAPTCHA Challenge (required)</label>';
		
			include_nucaptcha();
			nucaptcha_register_form_helper(Leap::PURPOSE_CREATE_ACCOUNT);

		echo '</div>';
	}

	function nucaptcha_bpregister_validate($result) {
		//$result = array( 'user_name' => $user_name, 'user_email' => $user_email, 'errors' => $errors );
		
		// Is it correct?
		$response = validate_nucaptcha();
		if (!$response)
		{
			// Note: we need to set this as a user_name error to work with BuddyPress
			$result['errors']->add('user_name', __('Incorrect CAPTCHA answer.  Please try again', 'buddypress'));
		}
		return $result;
	}
}

//
// Lost Password Form
//
function nucaptcha_lostpassword_form() {
	include_nucaptcha();
	nucaptcha_register_form_helper(Leap::PURPOSE_PASSWORD_RESET);
}

function nucaptcha_allow_password_reset($unknown, $userid) {
	if( $userid !== null ) {
		// Is it correct?
		$response = validate_nucaptcha();
		if (!$response)
		{
			// This cancels the password reset process
			return new WP_Error('captcha_wrong', '<strong>ERROR:</strong> Incorrect <a href="http://www.nucaptcha.com/" target="_blank">NuCaptcha</a> Answer.  Please Try Again.');
		}
	}
	return true;
}

//
// Login Form
//
function nucaptcha_login_form_error($errno, $errstr, $errfile, $errline)
{
	echo '<div id="nucaptcha_error" class="'.NuCaptchaData::Get('css_error').'">NC: '."$errstr in $errfile line $errline".'<br> '.Leap::GetErrorString().'</div>';
	return true;
}

function nucaptcha_login_form() {
	// We need to be very careful in the login form.  We need to catch anything that can go wrong.
	// If something does go wrong and the submit button doesn't get rendered, the admin user can get locked out - very bad.
	// The validate only applies to non-admin users.
	set_error_handler('nucaptcha_login_form_error', E_ERROR | E_USER_ERROR);
	try
	{
		include_nucaptcha();
		nucaptcha_register_form_helper(Leap::PURPOSE_LOGIN);
	}
	catch(Exception $e)
	{
		// Display error
		echo '<div id="nucaptcha_error" class="'.NuCaptchaData::Get('css_error').'">Internal NuCaptcha Exception: '.$e->getMessage().'<br>Leap Error String: '.Leap::GetErrorString().'</div>';
	}
	
	// Restore error handler
	restore_error_handler();
}

function nucaptcha_login_validate($user, $username, $password) {
	if( is_a( $user, 'WP_User' ) ){
		// Ignore answers for users who can delete plugins
		// This is in case something breaks with the plugin - the admin can still login to delete the plugin
		if( NuCaptchaData::Get('ignore_admin_login') && $user->has_cap('delete_plugins') )
		{
			NuCaptchaData::Set('ignore_admin_login_message', true);
			return $user;
		}
		
		// Is it correct?
		$response = validate_nucaptcha();
		if (!$response)
		{
			// This cancels the login process
			return new WP_Error('captcha_wrong', '<strong>ERROR:</strong> Incorrect <a href="http://www.nucaptcha.com/" target="_blank">NuCaptcha</a> Answer.  Please Try Again.');
		}	
	}
	return $user;
}
