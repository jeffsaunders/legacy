// Trim string
function trim(str){
	if(!str || typeof str != 'string') return null;
    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}

//Contact Form Validation
function validateRequest(theForm){
	// Global Declarations
	var errorBG =	"background:#FF0000;";
	var warningBG =	"background:#FFFF00;";
	var normalBG =	"background:#FFFFFF url('../images/bg-form-field.gif') top left repeat-x;";
	var transBG =	"background:transparent;";
	// First Name
	if (theForm.realtor_first_name.value == ""){
		theForm.realtor_first_name.focus();
		theForm.realtor_first_name.setAttribute("style", errorBG);
		alert("Please Enter Your First Name");
		theForm.realtor_first_name.setAttribute("style", normalBG);
		return false;
	}
	// Last Name
	if (theForm.realtor_last_name.value == ""){
		theForm.realtor_last_name.focus();
		theForm.realtor_last_name.setAttribute("style", errorBG);
		alert("Please Enter Your Last Name");
		theForm.realtor_last_name.setAttribute("style", normalBG);
		return false;
	}
	// Company Name
	if (theForm.realtor_company_name.value == ""){
		theForm.realtor_company_name.focus();
		theForm.realtor_company_name.setAttribute("style", errorBG);
		alert("Please Enter Your Company Name");
		theForm.realtor_company_name.setAttribute("style", normalBG);
		return false;
	}
	// Role
	var buttons = theForm.elements["realtor_role"];
	var choiceSelected = false;
	for (var i = 0; i < buttons.length; i++){
		if (buttons[i].checked) {
			choiceSelected = true;
		}
	}
	if (!choiceSelected){
		window.location.hash = "realtor_role_question";
//		buttons[0].focus();
		document.getElementById("realtor_role_question").setAttribute("style", errorBG);
		alert("Please Select Your Role");
		document.getElementById("realtor_role_question").setAttribute("style", transBG);
		return false;
	}
	if (buttons[4].checked && theForm.realtor_role_other.value == ""){
		window.location.hash = "realtor_role_question";
		theForm.realtor_role_other.focus();
		document.getElementById("realtor_role_other").setAttribute("style", errorBG);
		alert("Please Explain Your Role");
		document.getElementById("realtor_role_other").setAttribute("style", normalBG);
		return false;
	}
	// Company Name
	if (theForm.realtor_company_name.value == ""){
		theForm.realtor_company_name.focus();
		theForm.realtor_company_name.setAttribute("style", errorBG);
		alert("Please Enter Your Company Name");
		theForm.realtor_company_name.setAttribute("style", normalBG);
		return false;
	}
	// City
	if (theForm.realtor_city.value == ""){
		theForm.realtor_city.focus();
		theForm.realtor_city.setAttribute("style", errorBG);
		alert("Please Enter Your City");
		theForm.realtor_city.setAttribute("style", normalBG);
		return false;
	}
	// State
	if (theForm.realtor_state.value == ""){
		theForm.realtor_state.focus();
		theForm.realtor_state.setAttribute("style", errorBG);
		alert("Please Select Your State");
		theForm.realtor_state.setAttribute("style", normalBG);
		return false;
	}
	// Zip Code
	var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//	var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
//	if (usa_regex.test(theForm.zip_code.value) == false && cdn_regex.test(theForm.zip_code.value) == false) { 
	if (usa_regex.test(theForm.realtor_zip_code.value) == false) { 
		theForm.realtor_zip_code.focus();
		theForm.realtor_zip_code.setAttribute("style", errorBG);
		alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
		theForm.realtor_zip_code.setAttribute("style", normalBG);
		return false;
	}
	// Phone
// Validation handled by formatPhone() function.
//	var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
//	var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
//	if (phone1_regex.test(theForm.realtor_phone.value) == false && phone2_regex.test(theForm.realtor_phone.value) == false){ 
//		theForm.realtor_phone.focus();
//		theForm.realtor_phone.setAttribute("style", errorBG);
//		alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
//		theForm.realtor_phone.setAttribute("style", normalBG);
//		return false;
//	}
	// Email
	if (theForm.realtor_email.value == ""){
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert("Please Enter Your Email Address");
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "@"
	if (theForm.realtor_email.value.indexOf("@") == -1) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain an "@"');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "@" as first char.
	if (theForm.realtor_email.value.indexOf("@") == 0) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Cannot Start With a "@"');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for anything after "@"
	if (theForm.realtor_email.value.length == (theForm.realtor_email.value.indexOf("@")+1)) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain a Domain Name After the "@"');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for multiple "@"
	if (theForm.realtor_email.value.substring((theForm.realtor_email.value.indexOf("@")+1),theForm.realtor_email.value.length).indexOf("@") != -1) {
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain Only One "@"');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "."
	if (theForm.realtor_email.value.indexOf(".") == -1) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain a "."');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "." as first char.
	if (theForm.realtor_email.value.indexOf(".") == 0) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Cannot Start With a "."');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for ".."
	if (theForm.realtor_email.value.indexOf("..") != -1) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Adjacent Dots ("..")');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "." adjacent to "@"
	if (theForm.realtor_email.value.indexOf(".@") != -1 || theForm.realtor_email.value.indexOf("@.") != -1) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for TLD
	if (theForm.realtor_email.value.length == (theForm.realtor_email.value.indexOf(".")+1)) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for TLD at least 2 char.
	var domain = theForm.realtor_email.value.substring((theForm.realtor_email.value.indexOf("@")+1),theForm.realtor_email.value.length);
	if (domain.length - (domain.indexOf(".")+1) < 2) {
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "_" in TLD
	if (theForm.realtor_email.value.indexOf("_") > theForm.realtor_email.value.indexOf("@")) {
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for spaces
	if (theForm.realtor_email.value.indexOf(" ") != -1) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Any Spaces (" ")');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for illegal char.
	var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	if (email_regex.test(theForm.realtor_email.value) == false) { 
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
		theForm.realtor_email.setAttribute("style", normalBG);
		return false;
	}
	// Verify emails match
	if (theForm.realtor_email.value != theForm.realtor_email_confirm.value){
		theForm.realtor_email.focus();
		theForm.realtor_email.setAttribute("style", errorBG);
		theForm.realtor_email_confirm.setAttribute("style", errorBG);
		alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email_confirm.setAttribute("style", normalBG);
		return false;
	}
	// Website Address
	if (theForm.realtor_website.value == ""){
		theForm.realtor_website.focus();
		theForm.realtor_website.setAttribute("style", warningBG);
		leaveBlank = confirm("           Providing Your Website Address Helps Prove Your Eligibility\n\r(Click 'Cancel' To Go Back And Enter Your Address, 'OK' To Leave Blank)");
		theForm.realtor_website.setAttribute("style", normalBG);
		if (!leaveBlank) return false;
	}
    var url_regex = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
	if (url_regex.test(theForm.realtor_website.value) == false){ 
		theForm.realtor_website.focus();
		theForm.realtor_website.setAttribute("style", errorBG);
		alert('Please Enter a Valid Website Address');
		theForm.realtor_website.setAttribute("style", normalBG);
		return false;
	}
	// Referral
	var boxes = theForm.elements["referral[]"];
	var statusSelected = false;
	for (i = 0; i < boxes.length; i++){
		if (boxes[i].checked) {
			statusSelected = true;
		}
	}
	if (!statusSelected){
		window.location.hash = "referral_question";
//		document.getElementById("referral[0]").focus();
		document.getElementById("referral_question").setAttribute("style", errorBG);
		alert("Please Select At Least One Item Regarding How You Heard About Us.");
		document.getElementById("referral_question").setAttribute("style", transBG);
		return false;
	}
	if (boxes[3].checked && theForm.referral_agent_name.value == ""){
		window.location.hash = "status_question";
		theForm.referral_agent_name.focus();
		document.getElementById("referral_agent_name").setAttribute("style", errorBG);
		alert("Please Enter Agent's Name");
		document.getElementById("referral_agent_name").setAttribute("style", normalBG);
		return false;
	}
	if (boxes[4].checked && theForm.referral_other_detail.value == ""){
		window.location.hash = "status_question";
		theForm.referral_other_detail.focus();
		document.getElementById("referral_other_detail").setAttribute("style", errorBG);
		alert("Please Tell Us How You Heard About Us");
		document.getElementById("referral_other_detail").setAttribute("style", normalBG);
		return false;
	}
	// Confirmation checkbox
	if (!theForm.confirmation.checked){
		document.getElementById("confirmation_question").focus();
		document.getElementById("confirmation_question").setAttribute("style", errorBG);
		alert("Please Certify That You Are A Licensed Real Estate Professional.");
		document.getElementById("confirmation_question").setAttribute("style", transBG);
		return false;
	}
	// All's well - do it.
//	return false; // Testing
	theForm.submit();
}

//----------------------------------------------

/*
//Order Form Validation
function validateOrder(theForm){
	// Email
	if (theForm.realtor_email.value == ""){
		theForm.realtor_email.setAttribute("style", errorBG);
		alert("Please Enter Your Email Address");
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for "@"
	if (theForm.realtor_email.value.indexOf("@") == -1) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain an "@"');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for "@" as first char.
	if (theForm.realtor_email.value.indexOf("@") == 0) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Cannot Start With a "@"');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for anything after "@"
	if (theForm.realtor_email.value.length == (theForm.realtor_email.value.indexOf("@")+1)) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain a Domain Name After the "@"');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for multiple "@"
	if (theForm.realtor_email.value.substring((theForm.realtor_email.value.indexOf("@")+1),theForm.realtor_email.value.length).indexOf("@") != -1) {
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain Only One "@"');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for "."
	if (theForm.realtor_email.value.indexOf(".") == -1) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain a "."');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for "." as first char.
	if (theForm.realtor_email.value.indexOf(".") == 0) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Cannot Start With a "."');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for ".."
	if (theForm.realtor_email.value.indexOf("..") != -1) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Adjacent Dots ("..")');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for "." adjacent to "@"
	if (theForm.realtor_email.value.indexOf(".@") != -1 || theForm.realtor_email.value.indexOf("@.") != -1) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for TLD
	if (theForm.realtor_email.value.length == (theForm.realtor_email.value.indexOf(".")+1)) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for TLD at least 2 char.
	var domain = theForm.realtor_email.value.substring((theForm.realtor_email.value.indexOf("@")+1),theForm.realtor_email.value.length);
	if (domain.length - (domain.indexOf(".")+1) < 2) {
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
//	// Check for TLD over 3 char. *ALLOWED NOW
//	if (domain.length - (domain.indexOf(".")+1) > 3) {
//		theForm.realtor_email.setAttribute("style", errorBG);
//		alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//		theForm.realtor_email.setAttribute("style", normalBG);
//		theForm.realtor_email.focus();
//		return false;
//	}
	// Check for "_" in TLD
	if (theForm.realtor_email.value.indexOf("_") > theForm.realtor_email.value.indexOf("@")) {
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for spaces
	if (theForm.realtor_email.value.indexOf(" ") != -1) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Any Spaces (" ")');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Check for illegal char.
	var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	if (email_regex.test(theForm.realtor_email.value) == false) { 
		theForm.realtor_email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
		theForm.realtor_email.setAttribute("style", normalBG);
		theForm.realtor_email.focus();
		return false;
	}
	// Name
	var full_name = theForm.first_name.value + " " + theForm.mi.value + " " + theForm.last_name.value;
	if (trim(full_name) == ""){
		theForm.first_name.setAttribute("style", errorBG);
		theForm.mi.setAttribute("style", errorBG);
		theForm.last_name.setAttribute("style", errorBG);
		alert("Please Enter Your Name");
		theForm.first_name.setAttribute("style", normalBG);
		theForm.mi.setAttribute("style", normalBG);
		theForm.last_name.setAttribute("style", normalBG);
		theForm.first_name.focus();
		return false;
	}
	// Shipping Address
	if (theForm.shipping_address.value == ""){
		theForm.shipping_address.setAttribute("style", errorBG);
		alert("Please Enter Your Shipping Address");
		theForm.shipping_address.setAttribute("style", normalBG);
		theForm.shipping_address.focus();
		return false;
	}
	// Shipping City
	if (theForm.shipping_city.value == ""){
		theForm.shipping_city.setAttribute("style", errorBG);
		alert("Please Enter Your Shipping City");
		theForm.shipping_city.setAttribute("style", normalBG);
		theForm.shipping_city.focus();
		return false;
	}
	// Shipping State
	if (theForm.shipping_state.value == ""){
		theForm.shipping_state.setAttribute("style", errorBG);
		alert("Please Enter Your Shipping State");
		theForm.shipping_state.setAttribute("style", normalBG);
		theForm.shipping_state.focus();
		return false;
	}
	// Shipping Zip Code
	if (theForm.shipping_zip_code.value == ""){
		theForm.shipping_zip_code.setAttribute("style", errorBG);
		alert("Please Enter Your Shipping Zip Code");
		theForm.shipping_zip_code.setAttribute("style", normalBG);
		theForm.shipping_zip_code.focus();
		return false;
	}
	var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.zip_code.value) == false && cdn_regex.test(theForm.zip_code.value) == false) { 
		if (usa_regex.test(theForm.shipping_zip_code.value) == false) { 
		theForm.shipping_zip_code.setAttribute("style", errorBG);
		alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
		theForm.shipping_zip_code.setAttribute("style", normalBG);
		theForm.shipping_zip_code.focus();
		return false;
	}
	// Billing Address
	if (theForm.billing_address.value == ""){
		theForm.billing_address.setAttribute("style", errorBG);
		alert("Please Enter Your Billing Address\nClick the Copy Link To Copy Shipping Address");
		theForm.billing_address.setAttribute("style", normalBG);
		theForm.billing_address.focus();
		return false;
	}
	// Billing City
	if (theForm.billing_city.value == ""){
		theForm.billing_city.setAttribute("style", errorBG);
		alert("Please Enter Your Billing City\nClick the Copy Link To Copy Shipping Address");
		theForm.billing_city.setAttribute("style", normalBG);
		theForm.billing_city.focus();
		return false;
	}
	// Billing State
	if (theForm.billing_state.value == ""){
		theForm.billing_state.setAttribute("style", errorBG);
		alert("Please Enter Your Billing State\nClick the Copy Link To Copy Shipping Address");
		theForm.billing_state.setAttribute("style", normalBG);
		theForm.billing_state.focus();
		return false;
	}
	// Billing Zip Code
	if (theForm.billing_zip_code.value == ""){
		theForm.billing_zip_code.setAttribute("style", errorBG);
		alert("Please Enter Your Billing Zip Code\nClick the Copy Link To Copy Shipping Address");
		theForm.billing_zip_code.setAttribute("style", normalBG);
		theForm.billing_zip_code.focus();
		return false;
	}
	var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.zip_code.value) == false && cdn_regex.test(theForm.zip_code.value) == false) { 
		if (usa_regex.test(theForm.billing_zip_code.value) == false) { 
		theForm.billing_zip_code.setAttribute("style", errorBG);
		alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
		theForm.billing_zip_code.setAttribute("style", normalBG);
		theForm.billing_zip_code.focus();
		return false;
	}




	// Message
//	if (theForm.message.value == ""){
//		theForm.message.style.background="#FFFF00";
//		leaveBlank = confirm("Are You Sure You Want To Send An Empty Message?\n\r   (Click 'Cancel' To Go Back And Enter A Message)");
//		theForm.message.setAttribute("style", normalBG);
//		theForm.message.focus();
//		if (!leaveBlank) return false;
//	}
//	// All's well - do it.
	theForm.submit();
}
*/
