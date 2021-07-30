var message_class       = "wp-caption";


function IsValueEmpty(stringid)
{
	var q = jQuery(stringid);
	if( q.length != 1 ) return false;
	
    var str = q.val();
    str = str.replace(/^\s+|\s+$/g,"");
    return (0 == str.length);
}

function NuCaptchaComment(error_msg, callback)
{
    jQuery('#wp_nucaptcha_message').hide();
    jQuery('#wp_nucaptcha_message').html('<div class="'+message_class+'">'+error_msg+'</div>');
    jQuery('#wp_nucaptcha_message').fadeIn('fast', callback);
}

/**
 * The NuCaptcha Submit button
 *
 * If we're showing the captcha
 */
function NuCaptchaSubmit()
{
    // Is the form empty?  If so warn about an empty form
    if (IsValueEmpty('textarea#comment'))
    {
        NuCaptchaComment('Please enter a comment.');
        return false;
    }

	if (IsValueEmpty('#nucaptcha-answer'))
	{
		NuCaptchaComment('Please complete the NuCaptcha challenge.');
		return false;
	}

	NuCaptchaComment('Comment Submitted.  Please wait.');
	jQuery('#nucaptcha_error').fadeOut('fast');
	jQuery('#wp_nucaptcha').fadeOut('fast');
	jQuery('#submit').fadeOut('fast');
	return true;
}

function InitNuCaptchaWPForm(nucaptcha_error, msg_class, previous_comment)
{
	// Update the message class
    message_class = msg_class;

    // Remove the comment by default
    jQuery('#wp_nucaptcha_message').hide();

    // Store our previous comment into the comment
    if (previous_comment.length > 0)
    {
        jQuery('#comment').val(unescape(previous_comment));
    }

	var sub = jQuery('#submit, #comment_post_ID, #comment_parent');
    sub.remove();
    sub.appendTo('#wp_nucaptcha_sb');

	// Hook into submit
	jQuery('#commentform').submit(function() { return NuCaptchaSubmit(); });
}

// Render the NuCaptcha widget using Ajax.  Used when running with WP_CACHE (ie wp-cache and wp-super-cache plugins)
function InitNuCaptchaWPForm_Ajax(nucaptcha_ajax_id, nucaptcha_ajax_url,
	nucaptcha_error, msg_class, previous_comment)
{
	// Render the NuCaptcha then init
	jQuery.ajax({
		type : "GET",
		url : nucaptcha_ajax_url,
		data : { method : "render_comment" },
		success : function(response){
		  // the server has finished executing PHP and has returned something, so display it!
		  jQuery(nucaptcha_ajax_id).parent().append(response);
		  InitNuCaptchaWPForm(nucaptcha_error, msg_class, previous_comment);
		}
	  });
}
