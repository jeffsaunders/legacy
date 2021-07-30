<?php

require_once '../../../wp-load.php';
require_once 'nucaptcha_api_client.php';

try {
	

//	echo str_replace('>', '&gt;', str_replace('<', '&lt;', print_r($_POST, true))); return;
	if( array_key_exists('method', $_POST) )
	{
		//
		// admin only methods
		//
		switch ($_POST['method']) {
			case 'account_exists': {
				$result = lmApiClient::account_exists(trim($_POST['param']));
				echo handleExists($_POST, $result);
			}
			break;

			case 'publisher_exists': {
				$result = lmApiClient::publisher_exists_by_name(trim($_POST['param']));
				echo handleExists($_POST, $result);
			}
			break;

			default: {
				throw new Exception(printf('Unknown command: "%s"', wp_kses($_POST['method'])));
			}
			break;
		}
	}
	else
	{
		if (!array_key_exists('method', $_GET)) throw new Exception('Invalid Parameters.');
		//
		// public methods
		//
		switch ($_GET['method']) {
			case 'render_comment': {
				nucaptcha_comment_form_render();
			}
			break;

			default: {
				throw new Exception(printf('Unknown command: "%s"', wp_kses($_GET['method'])));
			}
			break;

		}

	}
}
catch (Exception $e)
{
	echo $e->getMessage();
}

/**
 * Check a result object for the existence of an account/publisher.
 *
 * @param array $post $_POST array
 * @param array $result result value from an lmAPIClient call
 * @return string message to display
 */
function handleExists(Array $post, Array $result)
{
	if('failed' == $result['status'])
	{
		if(true === array_key_exists('message_error', $post))
		{
			return '<span class="msg_error">'.$post['message_exists'].'</span>';
		}
		else
		{
			return '<span class="msg_exception">'.$result['errorMessage'].'</span>';
		}
	}
	else
	{
		if(true == $result['exists'])
		{
			return '<span class="msg_error">'.$post['message_exists'].'</span>';
		}
		else
		{
			return '<span class="msg_ok">'.$post['message_available'].'</span>';
		}
	}
}
