
var showing_advanced        = false;

function ToggleAdvancedForm()
{
    if (showing_advanced)
    {
        jQuery('#nucaptcha_advanced').html('<a href="" onclick="return ToggleAdvancedForm();">Show Advanced</a>');
        jQuery('.nc_advanced').fadeOut('fast');
    }
    else
    {
        jQuery('#nucaptcha_advanced').html('<a href="" onclick="return ToggleAdvancedForm();">Hide Advanced</a>');
        jQuery('.nc_advanced').fadeIn('fast');
    }

    // Toggle the state
    showing_advanced = !showing_advanced;

	jQuery('#input_show_advanced').val(showing_advanced ? 1 : 0);
    return false;
}

function InitShowingAdvanced()
{
	showing_advanced = jQuery('#input_show_advanced').val() == '1' ? true : false;
	if(showing_advanced)
	{
		jQuery('.nc_advanced').show();
	}
	else
	{
		jQuery('.nc_advanced').hide();
	}
	jQuery('#nucaptcha_advanced').html('<a href="" onclick="return ToggleAdvancedForm();">'+(showing_advanced?'Hide':'Show')+' Advanced</a>');
}

function SetupAdminForm_SignIn()
{
	jQuery(document).ready(function(){
		jQuery('#email').focus();

		jQuery('.radio_password').change(function(){
			var v = jQuery(this).val();
			if( v == 'new' )
			{
				jQuery('#input_submit').val('Create Account');
				jQuery('#password').attr('disabled', 'disabled');
			}
			else
			{
				jQuery('#input_submit').val('Secure Sign In');
				jQuery('#password').removeAttr('disabled').focus();
			}
		});

		jQuery('form.adminform').submit(function(e){
			var v = jQuery('.radio_password:checked').val();
			if( v == 'new' )
			{
				// open create account in new tab
				e.preventDefault();
				window.open('http://console.nucaptcha.com/account/create?email=' + encodeURIComponent(jQuery('#email').val()) + '&r=' + encodeURIComponent(jQuery('#referrer').val()));
				return false;
			}
			return true;
		});
	});
}

function SetupAdminForm_UpdateAccount()
{
    InitShowingAdvanced();
}

function SetupAdminForm_WPConfig()
{
	InitShowingAdvanced();
}
