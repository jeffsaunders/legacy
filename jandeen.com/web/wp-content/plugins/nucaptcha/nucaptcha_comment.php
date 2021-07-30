<?php

function nucaptcha_comment_init() {

	// If Not Functional, or Don't want to display on comments
	if (!NuCaptchaData::is_functional()) return;
	
	// If we don't want to display on comment form, then just exit
	if (!NuCaptchaData::Get('protect_comments')) return;

	// Attach NuCaptcha to comment forms
	wp_register_script('nucaptcha_form', WP_PLUGIN_URL . '/nucaptcha/res/js/wp-nucaptcha-form.js');

	// TODO: Make only appear when we want it..
	wp_enqueue_script('jquery');
	wp_enqueue_script('nucaptcha_form', '', array('jquery'));

	// If we redirected and a comment exists, then we delete the old and force a retry
	add_filter('wp_head', 'nucaptcha_comment_retry', 0);
	// When they click submit, see if the NuCaptcha is valid?
	add_filter('preprocess_comment', 'nucaptcha_comment_process', 0);
	// If there is an error (Invalid NuCaptcha), then we redirect
	add_filter('comment_post_redirect', 'nucaptcha_comment_redirect', 0, 2);

	// NuCaptcha appear on normal form
	add_action('comment_form', 'nucaptcha_comment_form', 0);
}

function nucaptcha_comment_form_render()
{
	include_nucaptcha();
	$t = Leap::InitializeTransaction(null, nucaptcha_use_ssl(), null, Leap::PURPOSE_COMMENT);
	$ec = Leap::GetErrorCode();
	if (LMEC_OK == $ec) {

		$ncWidgetHtml = nucaptcha_deslashit(NuCaptchaData::Get('custom_skin_html')) . ' ' . $t->GetWidget(false, false, NuCaptchaData::Get('player_position'));

		// Modify the rendered html when running with wp-cache or wp-super-cache
		if( nucaptcha_cache_enabled() )
		{
			// remove the noscript block
			$ncWidgetHtml = preg_replace("/<noscript>.*?<\/noscript>/ims", '', $ncWidgetHtml);

			// parse the required scripts
			$m = "/<script[^>]*src=\"([^\"]*)\".*?<\/script>/ims";
			if( preg_match_all($m, $ncWidgetHtml, $matches) !== false )
			{
				if( count($matches) > 0 )
				{
					$scripts = $matches[1];

					// remove required scripts
					$ncWidgetHtml = preg_replace($m, '', $ncWidgetHtml);

					// wrap lmLoadPlayer with a chained calls to jQuery.getScript
					$initFunc = 'lmLoadPlayer(data);';
					$initScript = $initFunc;
					foreach( $scripts as $s )
					{
						$initScript = 'jQuery.getScript("'.$s.'", function() { '.$initScript.' });';
					}
					$ncWidgetHtml = str_replace($initFunc, $initScript, $ncWidgetHtml);
				}
			}
		}

		echo '<div id="wp_nucaptcha" style="padding-bottom: 4px;">'.$ncWidgetHtml.'</div>';
		echo '<div id="wp_nucaptcha_message">&nbsp;</div>';
		echo '<div id="wp_nucaptcha_sb"></div>';

		// Generates a string using current user info, returns 'anonymous_user' if not logged in
		$wpui = nucaptcha_wp_user_info();

		// Store our Public Persistent Storage
		echo '<input type="hidden" name="nucaptcha_ps" id="nucaptcha_ps" value="'.$t->GetPersistentDataForPublicStorage($wpui).'">';
		
	} else {
		echo '<div id="nucaptcha_error" class="'.NuCaptchaData::Get('css_error').'">Internal NC Code: '.$ec.'<br>Message: '.Leap::GetErrorString().'</div>';
	}
}

function nucaptcha_comment_form() {
	
	// If NuCaptcha not functional, then just exit
	if (!NuCaptchaData::is_functional()) return;

	// If we don't want to show this comment to this user
	if (!should_show_nucaptcha_to_user()) return;

	//
	global $nucaptcha_prev_comment;
	global $nucaptcha_comment_error;

	// Make the script load
	if ($nucaptcha_comment_error)
	{
		echo '<div id="nucaptcha_error" class="'.NuCaptchaData::Get('css_error').'">Incorrect <a href="http://www.nucaptcha.com/" target="_blank">NuCaptcha</a> Answer.  Please Try Again.</div>';
	}

	if( nucaptcha_cache_enabled() )
	{
		// Add support for wp-cache and wp-super-cache. REQUIRES JAVASCRIPT
		$urlAjax = get_bloginfo('wpurl').'/wp-content/plugins/nucaptcha/ajax.php';

		echo '<div id="wp_nucaptcha_ajax_render"></div>
			  <script type="text/javascript">
					InitNuCaptchaWPForm_Ajax(
						"#wp_nucaptcha_ajax_render", "'.$urlAjax.'",'.($nucaptcha_comment_error ? 'true' : 'false').', "'.NuCaptchaData::Get('css_message').'", "'.rawurlencode($nucaptcha_prev_comment).'"
				    );
			  </script>
			  <noscript><style type="text/css">#submit {display:none;} #comment {display:none;}</style><div class="'.NuCaptchaData::Get('css_error').'">Please enable Javascript to post comments.</div></noscript>';
	}
	else
	{
		nucaptcha_comment_form_render();

		echo '<script type="text/javascript">
				InitNuCaptchaWPForm('.($nucaptcha_comment_error?'true':'false').', "'.NuCaptchaData::Get('css_message').'", "'.rawurlencode($nucaptcha_prev_comment).'");
			  </script>';

		echo '<noscript>
		         <style type="text/css">#submit {display:none;}</style>
		         <input type="submit" value="Submit Comment" tabindex="6" id="submit-alt" name="submit">';

		// Did we have an error?
		if ($nucaptcha_comment_error)
		{
			// Then in noscript hide the comment field and add a new blank one
			echo '<style type="text/css">#comment {display:none;}</style>
			      <input type="hidden" name="comment" id="comment" value="'.addslashes($nucaptcha_prev_comment).'">';
		}
		echo '</noscript>';
	}
}


function nucaptcha_comment_process( $comment_data ) {

	// If we don't want to show this comment to this user
	if (!should_show_nucaptcha_to_user()) return $comment_data;

	// Do not check trackbacks
	if ('' != $comment_data['comment_type']) return $comment_data;

	// Check for wp_nucaptcha_ps.  If it doesn't exists, then there's a good chance the current theme doesn't have a call to 'comment_form' action.
	if(!array_key_exists('nucaptcha_ps', $_POST))
	{
		wp_die('It appears that your current WordPress Theme is not compatible with comment form plugins.<br/><br/> <a href="http://questions.nucaptcha.com/nucaptcha/topics/nucaptcha_doesnt_work_with_my_current_wordpress_theme">Click here</a> for more information on making your WordPress theme plugin friendly.', 'NuCaptcha Error');

		// queue the comment as SPAM (so no moderation email sent)
		add_filter('pre_comment_approved', create_function('$a', 'return "spam";'));

		// Mark it as an error so we capture it in nucaptcha_comment_redirect
		global $nucaptcha_comment_error;
		$nucaptcha_comment_error = true;

		return $comment_data;
	}

	// Cases where we don't want to check (registered users, admin, etc.)

	// Did they get it correct?
	$response = validate_nucaptcha();

	/*
	 * @see http://codex.wordpress.org/Plugin_API/Filter_Reference
	     * 1    = approved
	     * 0    = moderate
	     * spam = spam
	 */
	if( !$response )
	{
		// queue the comment as SPAM (so no moderation email sent)
		add_filter('pre_comment_approved', create_function('$a', 'return "spam";'));

		// Mark it as an error so we capture it in nucaptcha_comment_redirect
		global $nucaptcha_comment_error;
		$nucaptcha_comment_error = true;
	}

	return $comment_data;
}

function nucaptcha_comment_redirect($location, $comment) {

	// If we don't want to show this comment to this user
	if (!should_show_nucaptcha_to_user()) return $location;

	// If no error, then just exit
	global $nucaptcha_comment_error;
	if (!$nucaptcha_comment_error) return $location;

	// Create a new URL back to the comment form with the nucaptcha info to delete the comment and try again
	$location = substr($location, 0,strrpos($location, '#')) . ((strrpos($location, "?") === false) ? "?" : "&") .
		'nc_cid=' . $comment->comment_ID .						// Comment ID
		'&nc_uid=' . generate_id_hash($comment->comment_ID) .	// Generated UID (not super unique)
		'#commentform';											// Focus on the comment form to begin with

	return $location;
}

function get_comment_from_url() {
	// If Expected Fields do not exist
	if (false === array_key_exists('nc_cid', $_GET)) return false;
	if (false === array_key_exists('nc_uid', $_GET)) return false;

	// Some basic validation on the ID
	if (false === is_numeric($_GET['nc_cid'])) return false;

	// Does the Comment ID match the Hashed Comment ID?
	if (generate_id_hash($_GET['nc_cid']) != $_GET['nc_uid']) return false;

	// Get the comment.  If we don't get back an array, there was a problem.  Exit
	$comment = get_comment($_GET['nc_cid']);
	if (false === $comment) return false;

	// Return the comment
	return $comment;
}

function nucaptcha_comment_retry() {
	if (!is_single() && !is_page()) return;

	// If we don't want to show this comment to this user
	if (!should_show_nucaptcha_to_user()) return;


	// Get the comment from the URL, returning if not valid
	$comment = get_comment_from_url();
	if (false !== $comment)
	{
		// Store the comment for later usage
		global $nucaptcha_prev_comment;
		$nucaptcha_prev_comment = $comment->comment_content;

		// Delete the comment since we're going to try again with the NuCaptcha comment
		wp_delete_comment($comment->comment_ID);

		// Mark as having a NuCaptcha error on the page
		global $nucaptcha_comment_error;
		$nucaptcha_comment_error = true;
	}
}
