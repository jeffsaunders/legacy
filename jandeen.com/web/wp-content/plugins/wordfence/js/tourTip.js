if(! window['wordfenceTour']){
window['wordfenceTour'] = {
	wfClearEmailField: function(){
		if(jQuery('#wfListEmail').val() == "Enter your email"){
			jQuery('#wfListEmail').val('');
		}
	},
	processEmailClick: function(evt){
		var email = jQuery('#wfListEmail').val();
		if(! /[^\@]+\@[^\.]+\.[^\.]+/.test(email)){
			alert("Please enter a valid email address.");
			return false;
		}
		jQuery.ajax({
			type: 'POST',
			url: WordfenceAdminVars.ajaxURL,
			dataType: "json",
			data: {
				nonce: WordfenceAdminVars.firstNonce,
				email: email,
				action: 'wordfence_updateAlertEmail'
				},
			success: function(json){ 
				if(json.ok){
					jQuery('#wordfenceEmailDiv').html('<div style="color: #0A0;">Your admin alert email address has been set to ' + jQuery('<div/>').text(json.email).html() + '.</div>');	
				} else if(json.err){
					alert(json.err);
				}
			},
			error: function(){ 
			}
			});

		if(jQuery('#wfJoinListCheck').is(':checked')){
			return true;
		} else {
			try {
				if(evt.preventDefault) evt.preventDefault();
				evt.returnValue = false;
			} catch(e){}

			return false;
		}
	}
}
}

jQuery(function(){
if(WordfenceAdminVars.tourClosed != '1'){
	var formHTML = '<div style="padding: 0 5px 0 15px;" id="wordfenceEmailDiv"><form target="_new" style="display: inline;" method="post" class="af-form-wrapper" action="http://www.aweber.com/scripts/addlead.pl"  ><div style="display: none;"><input type="hidden" name="meta_web_form_id" value="1428034071" /><input type="hidden" name="meta_split_id" value="" /><input type="hidden" name="listname" value="wordfence" /><input type="hidden" name="redirect" value="http://www.aweber.com/thankyou-coi.htm?m=text" id="redirect_ae9f0882518768f447c80ea8f3b7afde" /><input type="hidden" name="meta_adtracking" value="widgetForm" /><input type="hidden" name="meta_message" value="1" /><input type="hidden" name="meta_required" value="email" /><input type="hidden" name="meta_tooltip" value="" /></div><input class="text" id="wfListEmail" type="text" name="email" value="Enter your email" tabindex="500" onclick="wordfenceTour.wfClearEmailField(); return false;" /><input name="submit" type="submit" value="Get Alerted" tabindex="501" onclick="var evt = event || window.event; try { return wordfenceTour.processEmailClick(evt); } catch(err){ evt.returnValue = false; evt.preventDefault(); }" /><div style="display: none;"><img src="http://forms.aweber.com/form/displays.htm?id=jCxMHAzMLAzsjA==" alt="" /></div><div style="padding: 5px; font-size: 10px;"><input type="checkbox" id="wfJoinListCheck" value="1" checked /><span style="font-size: 10px;">Also join our WordPress Security email list to receive WordPress Security Alerts and Wordfence news.</span></div></form></div>';
	var elem = '#toplevel_page_Wordfence';

	jQuery('#pointer-close').after('<a id="pointer-primary" class="button-primary">Start Tour</a>');
	jQuery('#pointer-primary').click(function(){ window.location.href = 'admin.php?page=Wordfence'; });
}
});
