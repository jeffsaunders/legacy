<?php

function nucaptcha_lmapiclient_disable_ssl_verify($ssl_verify)
{
	// Force no verify
	return false;
}

class lmApiClient
{
	const NUCAPTCHA_API_URL = "https://api.nucaptcha.com/1.0/plugin";

	// Build script changes to WordPress-PE when posting to plugin exchange on SVN
	const NUCAPTCHA_REFERRER_ID = 'WordPress-PE';

	/**
	 * Check to see if an account is already set up for an email address.
	 *
	 * @param string $email
	 * @return array Array(status => string, errorMessage => string, exists => bool)
	 */
	public static function account_exists($email)
	{
		return self::api_call(self::NUCAPTCHA_API_URL, 'account_exists', Array('accountId' => $email));
	}

	/**
	 * Create a new publisher account.
	 *
	 * @param string $email
	 * @param string $password
	 * @param string $firstName
	 * @param string $lastName
	 * @param string $emailOptOut
	 * @return array Array(status => string, errorMessage => string, accountId => string)
	 */
	public static function create_account($email, $password, $emailOptOut)
	{
		return self::api_call(self::NUCAPTCHA_API_URL, 'create_account', array(
			'email'     => $email,
			'password'  => $password,
			'firstName' => '',
			'lastName'  => '',
			'emailOptOut' => $emailOptOut
		));
	}

	/**
	 * Check to see if a publisher already exists.
	 *
	 * @param int publisherId
	 * @return array Array(status => string, errorMessage => string, exists => bool, publisherId => int)
	 */
	public static function publisher_exists_by_id($publisherId)
	{
		return self::api_call(self::NUCAPTCHA_API_URL, 'publisher_exists', Array('publisherId' => $publisherId));
	}

	/**
	 * Check to see if a publisher already exists.
	 *
	 * @param string publisherName
	 * @return array Array(status => string, errorMessage => string, exists => bool, publisherId => int)
	 */
	public static function publisher_exists_by_name($publisherName)
	{
		return self::api_call(self::NUCAPTCHA_API_URL, 'publisher_exists', Array('publisherName' => $publisherName));
	}

	/**
	 * Create a new publisher account.
	 *
	 * @param string $email,
	 * @param string $password,
	 * @param string publisherName
	 * @return array Array(status => string, errorMessage => string, publisherId => int)
	 */
	public static function create_publisher($email, $password, $publisherName)
	{
		return self::api_call(self::NUCAPTCHA_API_URL, 'create_publisher', Array(
			'accountId'     => $email,
			'password'      => $password,
			'publisherName' => $publisherName,
			'referrerId'    => self::NUCAPTCHA_REFERRER_ID,
		));
	}

	/**
	 * Retrieve a client key for an existing publisher
	 *
	 * @param string $email
	 * @param string $password
	 * @param int $publisherId
	 * @return array Array(status => string, errorMessage => string, clientKey => string)
	 */
	public static function get_clientkey($email, $password, $publisherId)
	{
		return self::api_call(self::NUCAPTCHA_API_URL, 'get_clientkey', Array(
			'accountId'   => $email,
			'password'    => $password,
			'publisherId' => $publisherId,
		));
	}

	/**
	 * Get publisher info.
	 *
	 * @param string $email
	 * @param string $password
	 * @param int $publisherId
	 * @return array Array(status => string, errorMessage => string, clientKey => string)
	 */
	public static function get_publisher_info($email, $password, $publisherId)
	{
		return self::api_call(self::NUCAPTCHA_API_URL, 'get_publisher_info', Array(
			'accountId'   => $email,
			'password'    => $password,
			'publisherId' => $publisherId,
		));
	}

	/**
	 * Get a list of publishers that an account has access to.
	 *
	 * @param string $email
	 * @param string $password
	 * @return array Array(status => string, errorMessage => string, publishers => Array(publisherId => accessLevel)
	 */
	public static function list_publishers($email, $password)
	{
		$result = self::api_call(self::NUCAPTCHA_API_URL, 'list_publishers', Array(
			'accountId'   => $email,
			'password'    => $password,
		));
		
		// this is a sub array
		if (isset($result['publishers']) && ('' != $result['publishers']))
		{
			$result['publishers'] = self::urlDecodeData($result['publishers']);
		}
		else if(isset($result['errorMessage']) && ('' != $result['errorMessage']))
		{
			throw new Exception($result['errorMessage']);
		}
		else
		{
			throw new Exception('No publishers attached to this account.  You can create a publisher in the <a href="http://console.nucaptcha.com">NuCaptcha Console</a>.');
		}

		return $result;
	}

	/**
	 * Convert an array into a url encoded string
	 *
	 * @param array $data
	 * @return string
	 */
	protected static function urlEncodeData(Array $data)
	{
		$returnStringPieces = Array();
		foreach($data as $key => $value)
		{
			$encodedKey = urlencode($key);
			$encodedValue = urlencode($value);
			$returnStringPieces[] = "$encodedKey=$encodedValue";
		}

		return join('&', $returnStringPieces);
	}

	/**
	 * Convert a url encoded string into an array
	 *
	 * @param string $dataString
	 * @return Array
	 */
	protected static function urlDecodeData($dataString)
	{
		$returnData = Array();
		$pieces = explode('&', $dataString);

		foreach($pieces as $encodedPair)
		{
			$result = explode("=", $encodedPair, 2);

			if(sizeof($result) != 2)
			{
				throw new Exception("Invalid URL Encoded data '$dataString'");
			}

			$key   = urldecode($result[0]);
			$value = urldecode($result[1]);

			$returnData[$key] = $value;
		}

		return $returnData;
	}

	/**
	 * Perform an API request.
	 *
	 * @param string $base_url
	 * @param string $method one of createaccount or retrievekey
	 * @param array $parameters key => value pairs of the data to send
	 * @return array key => value pairs of the response from the server
	 */
	protected static function api_call($base_url, $method, Array $request_parameters)
	{
		$full_url = join("/", Array(
			$base_url,
			$method,
			'urlencode' // $dataFormat
		));

		$data = self::urlEncodeData($request_parameters);

		$result = self::wp_client($full_url, $data);

		$decoded_result = self::urlDecodeData($result);
		if(null === $decoded_result)
		{
			throw new Exception("Invalid response '$result' from API server for request $method");
		}

		return $decoded_result;
   }

	/**
	 * Use the build in wordpress http client to perform API requests.
	 *
	 * @param string $full_url
	 * @param string $data
	 * @return string
	 */
	private static function wp_client($full_url, $data)
	{
		$result = wp_remote_post($full_url, Array(
			'body' => $data,
		));

		if(is_wp_error($result))
		{
			throw new Exception("Could not contact API server: " . $result->get_error_message() . ".  Make sure php_curl or equivalent is installed.");
		}

		$response_code = wp_remote_retrieve_response_code($response);

		if($response_code >= 400)
		{
			throw new Exception("Could not contact API server: Got HTTP code " . $response_code);
		}

		$body = wp_remote_retrieve_body($result);

		if(false !== strpos($body, "404 Page Not Found"))
		{
			throw new Exception("Got CI 404 for URL $full_url");
		}

		return $body;
	}

	/**
	 * Use CURL to do the HTTP request. Not all PHP install have curl, so this
	 * is not recommended for use.
	 *
	 * @param string $full_url
	 * @param string $data
	 * @return string
	 */
	private static function curl_client($full_url, $data)
	{
		$ch = curl_init($full_url);

	   //curl_setopt($ch, CURL_FAILONERROR, true);
	   curl_setopt($ch, CURLOPT_POST, true);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	   //error_log("Requesting $fullURL");
	   $result = curl_exec($ch);
	   $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	   curl_close($ch);

	   // check HTTP error code
	   if($http_code >= 400)
	   {
		   throw new Exception("Got HTTP code $http_code for URL $full_url.");
	   }

	   // check for HTTP code in CI result -- it doesn't always set
	   // proper HTTP codes
	   if(false !== strpos($result, "404 Page Not Found"))
	   {
		   throw new Exception("Got CI 404 for URL $full_url");
	   }

	   return $result;
	}
}
