var popupcount = 0;

$(document).ready(function() {
	
	$('#emailActivate').click(function(e) {
		e.preventDefault();
		clickEmailActivate();
	});
	$('#joinMailingActivate').click(function(e) {
		e.preventDefault();
		showPopup($("#dialogJoinMailing"));
	});
	$('#joinMaileActivate').click(function(e) {
		e.preventDefault();
		showPopup($("#dialogJoinMaile"));
	});
	/*
	$('.window .close').click(function (e) {
		e.preventDefault();		
		/*
		popupcount--;
		if(popupcount < 1) {
			$('#mask').hide();
		}
		*
		$(this).parents(".window").hide();
	});
	*/
	$('.window div.close a.close').click(function (e) {
		e.preventDefault();		
		//alert("TEST");
		/*
		popupcount--;
		if(popupcount < 1) {
			$('#mask').hide();
		}
		*/
		
		$(this).parents(".window").hide();
	});
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});
	$('#popup').click(function(e) {
		e.preventDefault();
		showAjaxPopup($(this).attr('href'));
	});
	

});

function clickEmailActivate() {
	showPopup($("#dialogEmail"));
}

function clickEmail2Activate() {
	showPopup($("#dialogMaile"));
}


function showAjaxPopup(url) {
	$.get(url, function(data){
	    $('#popupcontent').html(data);
		$('#intropopup').height(510);
		$('#intropopup').width(726);
		showPopupContent($("#intropopup"));
	});
}

function showPopup(obj){
	if(!$(obj).is(':visible')) {
		/*
		popupcount++;
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);
		*/
		var winH = $(window).height();
		var winW = $(window).width();
		//$(obj).css('top',  winH/2-$(obj).height()/2);
		//$(obj).css('left', winW/2-$(obj).width()/2);
		
		var popMargTop = $(obj).height() / 2;
		var popMargLeft = $(obj).width() / 2;
		
		//Apply Margin to Popup
		$(obj).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		$(obj).find(".error").hide();
		
		$(obj).fadeIn(2000);
	}
}
function showPopupContent(obj) {
	
	if(!$(obj).is(':visible')) {
		
		var offset = $('#content').offset();
		var winH = $('#content').height();
		var winW = $('#content').width();
		
		$(obj).css('top', offset.top +  winH/2-$(obj).height()/2);
		//$(obj).css('left', offset.left +  winW/2-$(obj).width()/2);

		var popMargLeft = $(obj).width() / 2;
		
		//Apply Margin to Popup
		$(obj).css({ 
			'margin-left' : -popMargLeft
		});
		
		$(obj).find(".error").hide();
		
		$(obj).fadeIn(2000);
	}
}

/** BEGIN BLOCK Validate forms **/

/**
 * Validate email send form
 */
function validateSendMail(valForm) {
	
	var resultValidate = true;
	
	if(validateRequiredField($(valForm).find("#name")) == false) {
		resultValidate = false;
	}
	
	if(validateEmailField($(valForm).find("#emailFrom")) == false) {
		resultValidate = false;
	}
	
	if(validateEmails($(valForm).find("#emailTo")) == false) {
		resultValidate = false;
	}
	
	if (resultValidate == true) {
		$(valForm).find(".error").hide();
	} else {
		$(valForm).find(".error").show();
	}
	
	return resultValidate;
}

/**
 * Validate request appointment form
 */
function validateRequestAppoint(valForm) {
	
	var resultValidate = true;
	
	if(validateRequiredField($(valForm).find("#firstName")) == false) {
		resultValidate = false;
	}
	
	if(validateRequiredField($(valForm).find("#lastName")) == false) {
		resultValidate = false;
	}
	
	if(validateEmailField($(valForm).find("#email")) == false) {
		resultValidate = false;
	}
	
	if(validateRequiredField($(valForm).find("#contactSource")) == false) {
		resultValidate = false;
	}
	
	if (resultValidate == true) {
		$(valForm).find(".error").hide();
	} else {
		$(valForm).find(".error").show();
	}
	
	return resultValidate;
}

/**
 * Validate join mail form
 */
function validateJoinMail(valForm) {
	
	var resultValidate = true;
	
	if(validateRequiredField($(valForm).find("#firstName")) == false) {
		resultValidate = false;
	}
	
	if(validateEmailField($(valForm).find("#email")) == false) {
		resultValidate = false;
	}
	
	if (resultValidate == true) {
		$(valForm).find(".error").hide();
	} else {
		$(valForm).find(".error").show();
	}
	
	return resultValidate;
}

/**
 * Check required field 
 */
function validateRequiredField(field) {
	
	var result = false;
	
	if (jQuery.trim($(field).val()) != "") {
		result = true;
	}
	
	return result;
}

/**
 * Check email field
 */
function validateEmailField(field) {
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var address = $(field).val();
	
	return reg.test(address);
}

/**
 * Check emails
 */
function validateEmails(field) {
	
	var result = true;
	var emails = $(field).val().split(",");
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
	for (var obj in emails){
		if (reg.test(jQuery.trim(emails[obj])) == false) {
			result = false;
		}
	}
	
	return result;
}

/** END BLOCK Validate forms **/