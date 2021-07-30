<?php

class NuCaptchaData
{
	static $OPTION_KEY = 'nucaptcha_data';	// IF YOU CHANGE THIS, YOU MUST UPDATE nucaptcha.php

	static protected $DEFAULT_OPTION = array(
			// Bumping this version in nucaptcha.php will force a new dependency check.
			
			'version'         => NUCAPTCHA_DATA_VERSION,
			'dep_ok'          => false,
			'email'           => '',
			'domain_name'     => '',
			'client_key'      => '',

			'publisher_list'  => array(),
			'publisher_id'    => 0,

			// Where is it enabled?
			'protect_comments'	=> true,
			'protect_signup'	=> true,
			'protect_resetpwd'	=> true,

			// Leave this disabled by default in case something goes wrong with install
			// and the user gets locked out
			'protect_login'		=> false,

			// Who has to see it?
			'show_to'         => 'everyone',

			// Visual Preferences
			'css_error'       => 'wp-caption',
			'css_message'     => 'wp-caption',
			'player_position' => 'center',
			
			//
			'ssl_verify'      => true,

			//
			'ignore_admin_login' => true,
			'ignore_admin_login_message' => false, // so the message is only displayed once

			// will Leap::Validate succeed on error
			'validate_on_error' => true,

			'custom_skin_html' => '',
			'show_advanced' => false
		);
	
	// These options will never reset to default
	static protected $NO_RESET_OPTION = array ('ssl_verify');


	static public function delete_data() {
		delete_option(self::$OPTION_KEY);
	}

	static protected function get_nucaptcha_data() {
		// Get the option data
		$option = get_option(self::$OPTION_KEY);
		if (false === $option) {
			// static init on default so couldn't store the admin email as the default there.
			self::$DEFAULT_OPTION['email'] = get_option('admin_email');
			self::$DEFAULT_OPTION['domain_name'] = substr(get_bloginfo('url'), strpos(get_bloginfo('url'), '//')+2);

			// If it doesn't exist, add it.  Return the default
			add_option(self::$OPTION_KEY, self::$DEFAULT_OPTION);
			return get_option(self::$OPTION_KEY);
		}
		else if ((count(self::$DEFAULT_OPTION) != count($option)) ||
				 (self::$DEFAULT_OPTION['version'] != $option['version'])) {
			// Any default values not existing inside the option data should be added from the default
			// This is to handle any future scenario where we add new options.
			// Also to update for versions
			foreach (self::$DEFAULT_OPTION as $key=>$value) {
				if (!in_array($key, $option)) {
					$option[$key] = self::$DEFAULT_OPTION[$key];
				}
			}
			$option['version'] = self::$DEFAULT_OPTION['version'];
		}
		//$option['ignore_admin_login'] = true;
		return $option;
	}

	static public function Get($key) {
		if (false === array_key_exists($key, self::$DEFAULT_OPTION)) {
			throw new Exception("Unknown NuCaptchaData variable: '$key' from NuCaptchaData::Get('$command_name')");
		}

		$data = self::get_nucaptcha_data();
		return $data[$key];
	}

	static public function Set($key, $value) {
		if (false === array_key_exists($key, self::$DEFAULT_OPTION)) {
			throw new Exception("Unknown NuCaptchaData variable: '$key' from NuCaptchaData::Set('$command_name', '$value')");
		}

		$data = self::get_nucaptcha_data();
		$data[$key] = $value;
		update_option(self::$OPTION_KEY, $data);
	}

	static public function is_initialized()	{
		return (strlen(self::get_client_key('client_key')) > 0);
	}

	static public function is_functional() {
		// If dependencies OK, then return true
		if ( self::Get('dep_ok') ) return true;

		// Is Initialized?
		if ( !self::is_initialized() ) return false;

		// Dependencies are now OK.  Update
		self::Set('dep_ok', true);
		return true;
	}

	static public function get_client_key() {
		return self::Get('client_key');
	}

	static public function get_api_version() {
		return Leap::GetVersion();
	}

	static public function reset_to_default() {
		foreach (self::$DEFAULT_OPTION as $key=>$value) {
			if( !in_array( $key, self::$NO_RESET_OPTION ) )
			{
				self::Set($key, $value);
			}
		}
	}
}
