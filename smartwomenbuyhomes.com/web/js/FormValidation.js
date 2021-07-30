// Trim string
function trim(str){
	if(!str || typeof str != 'string') return null;
    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}

//Signup Form Validation
function validateSignup(theForm){
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
	// Address
	if (theForm.realtor_address_1.value == ""){
		theForm.realtor_address_1.focus();
		theForm.realtor_address_1.setAttribute("style", errorBG);
		theForm.realtor_address_2.setAttribute("style", errorBG);
		alert("Please Enter Your Address");
		theForm.realtor_address_1.setAttribute("style", normalBG);
		theForm.realtor_address_2.setAttribute("style", normalBG);
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
	if (theForm.realtor_website.value != ""){
	    var url_regex = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
		if (url_regex.test(theForm.realtor_website.value) == false){ 
			theForm.realtor_website.focus();
			theForm.realtor_website.setAttribute("style", errorBG);
			alert('Please Enter a Valid Website Address (or Leave Blank)');
			theForm.realtor_website.setAttribute("style", normalBG);
			return false;
		}
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

//Checkout Form Validation
function validateCheckout(theForm){
	// Global Declarations
	var errorBG =	"background:#FF0000;";
	var warningBG =	"background:#FFFF00;";
	var normalBG =	"background:#FFFFFF url('../images/bg-form-field.gif') top left repeat-x;";
	var transBG =	"background:transparent;";
	// Product
//	var buttons = theForm.elements["product_id"];
//	var choiceSelected = false;
//	for (var i = 0; i < buttons.length; i++){
//		if (buttons[i].checked) {
//			choiceSelected = true;
//		}
//	}
//	if (!choiceSelected){
//		window.location.hash = "product_question";
////		buttons[0].focus();
//		document.getElementById("product_question").setAttribute("style", errorBG);
//		alert("Please Select A Product");
//		document.getElementById("product_question").setAttribute("style", transBG);
//		return false;
//	}
	// Promo Code
//alert(theForm.submit.value);
//	if (theForm.submit.value == "promo_button"){
//		if (theForm.promo_code.value == ""){
//			theForm.promo_code.focus();
//			theForm.promo_code.setAttribute("style", errorBG);
//			alert("Please Enter Your Promotional Code");
//			theForm.promo_code.setAttribute("style", normalBG);
//			return false;
//		}
//	}

//alert(theForm.submit_button.value);
//return false;


	if (theForm.promo_code.value != "" && theForm.submit_button.value == "promo_button"){
		return true;
	}
	// First Name
	if (theForm.billing_first_name.value == ""){
		theForm.billing_first_name.focus();
		theForm.billing_first_name.setAttribute("style", errorBG);
		alert("Please Enter Your First Name");
		theForm.billing_first_name.setAttribute("style", normalBG);
		return false;
	}
	// Last Name
	if (theForm.billing_last_name.value == ""){
		theForm.billing_last_name.focus();
		theForm.billing_last_name.setAttribute("style", errorBG);
		alert("Please Enter Your Last Name");
		theForm.billing_last_name.setAttribute("style", normalBG);
		return false;
	}
	// Address
	if (theForm.billing_address_1.value == ""){
		theForm.billing_address_1.focus();
		theForm.billing_address_1.setAttribute("style", errorBG);
		theForm.billing_address_2.setAttribute("style", errorBG);
		alert("Please Enter Your Address");
		theForm.billing_address_1.setAttribute("style", normalBG);
		theForm.billing_address_2.setAttribute("style", normalBG);
		return false;
	}
	// City
	if (theForm.billing_city.value == ""){
		theForm.billing_city.focus();
		theForm.billing_city.setAttribute("style", errorBG);
		alert("Please Enter Your City");
		theForm.billing_city.setAttribute("style", normalBG);
		return false;
	}
	// State
	if (theForm.billing_state.value == ""){
		theForm.billing_state.focus();
		theForm.billing_state.setAttribute("style", errorBG);
		alert("Please Select Your State");
		theForm.billing_state.setAttribute("style", normalBG);
		return false;
	}
	// Zip Code
	var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//	var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
//	if (usa_regex.test(theForm.zip_code.value) == false && cdn_regex.test(theForm.zip_code.value) == false) { 
	if (usa_regex.test(theForm.billing_zip_code.value) == false) { 
		theForm.billing_zip_code.focus();
		theForm.billing_zip_code.setAttribute("style", errorBG);
		alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
		theForm.billing_zip_code.setAttribute("style", normalBG);
		return false;
	}
	// Phone
	if (theForm.billing_phone.value == ""){
		theForm.billing_phone.focus();
		theForm.billing_phone.setAttribute("style", errorBG);
		alert("Please Enter Your Phone Number");
		theForm.billing_phone.setAttribute("style", normalBG);
		return false;
	}
// Validation handled by formatPhone() function.
//	var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
//	var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
//	if (phone1_regex.test(theForm.billing_phone.value) == false && phone2_regex.test(theForm.billing_phone.value) == false){ 
//		theForm.billing_phone.focus();
//		theForm.billing_phone.setAttribute("style", errorBG);
//		alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
//		theForm.billing_phone.setAttribute("style", normalBG);
//		return false;
//	}
	// Credit card number
	// Verify Card Number Against Check Digit Using MOD10
	if (theForm.cc_number.value == ""){
		theForm.cc_number.focus();
		theForm.cc_number.setAttribute("style", "width:300px !important;" + errorBG);
		alert("Please Enter Credit Card Number");
		theForm.cc_number.setAttribute("style", "width:300px !important;" + normalBG);
		return false;
	}
	var ar = new Array(theForm.cc_number.value.length);
	var i = 0, sum = 0;
	for(i = 0; i < theForm.cc_number.value.length; ++i){
		ar[i] = parseInt(theForm.cc_number.value.charAt(i));
	}
	for(i = ar.length -2; i >= 0; i-=2){	// you have to start from the right, and work back.
		ar[i] *= 2;							// every second digit starting with the right most (check digit)
		if(ar[i] > 9) ar[i]-=9;				// will be doubled, and summed with the skipped digits.
	}										// if the double digit is > 9, ADD those individual digits together 
	for(i = 0; i < ar.length; ++i){
		sum += ar[i];
	}
	if ((sum%10)!=0){						// if the sum is not evenly divisible by 10 it fails
		theForm.cc_number.focus();
		theForm.cc_number.setAttribute("style", "width:300px !important; " + errorBG);
		alert("Please Enter A Valid Credit Card Number");
		theForm.cc_number.setAttribute("style", "width:300px !important; " + normalBG);
		return false;
	}
	// Credit card cvv
	if (theForm.cc_cvv.value == ""){
		theForm.cc_cvv.focus();
		theForm.cc_cvv.setAttribute("style", "width:80px !important; " + errorBG);
		alert("Please Enter The Credit Card Security Code (CVV)");
		theForm.cc_cvv.setAttribute("style", "width:80px !important; " + normalBG);
		return false;
	}
	if (theForm.cc_cvv.value.length < 3 || theForm.cc_cvv.value.length > 4){
		theForm.cc_cvv.focus();
		theForm.cc_cvv.setAttribute("style", "width:80px !important; " + errorBG);
		alert("The Credit Card Security Code (CVV) Must Be Either 3 OR 4 Digits");
		theForm.cc_cvv.setAttribute("style", "width:80px !important; " + normalBG);
		return false;
	}
	// Credit card name
	if (theForm.cc_name.value == ""){
		theForm.cc_name.focus();
		theForm.cc_name.setAttribute("style", errorBG);
		alert("Please Enter Your Name As It Appears On The Credit Card");
		theForm.cc_name.setAttribute("style", normalBG);
		return false;
	}
	// Credit card expiration month
	if (theForm.cc_exp_month.value == ""){
		theForm.cc_exp_month.focus();
		theForm.cc_exp_month.setAttribute("style", errorBG);
		alert("Please Select The Credit Card Expiration Month");
		theForm.cc_exp_month.setAttribute("style", normalBG);
		return false;
	}
	// Credit card expiration year
	if (theForm.cc_exp_year.value == ""){
		theForm.cc_exp_year.focus();
		theForm.cc_exp_year.setAttribute("style", errorBG);
		alert("Please Select The Credit Card Expiration Year");
		theForm.cc_exp_year.setAttribute("style", normalBG);
		return false;
	}
	// All's well - do it.
//	return false; // Testing
	theForm.submit();
}

//----------------------------------------------

//Signup Form Validation
function validateQuickForm(theForm){
	// Global Declarations
	var errorBG =	"background:#FF0000;";
	var warningBG =	"background:#FFFF00;";
	var normalBG =	"background:#FFFFFF url('../images/bg-form-field.gif') top left repeat-x;";
	var transBG =	"background:transparent;";
	// Name
	if (theForm.name.value == ""){
		theForm.name.focus();
		theForm.name.setAttribute("style", errorBG);
		alert("Please Enter Your Name");
		theForm.name.setAttribute("style", normalBG);
		return false;
	}
	// Phone
// Validation handled by formatPhone() function.
//	var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
//	var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
//	if (phone1_regex.test(theForm.phone.value) == false && phone2_regex.test(theForm.phone.value) == false){ 
//		theForm.phone.focus();
//		theForm.phone.setAttribute("style", errorBG);
//		alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
//		theForm.phone.setAttribute("style", normalBG);
//		return false;
//	}
	// Email
	if (theForm.email.value == ""){
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert("Please Enter Your Email Address");
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "@"
	if (theForm.email.value.indexOf("@") == -1) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Must Contain an "@"');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "@" as first char.
	if (theForm.email.value.indexOf("@") == 0) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Cannot Start With a "@"');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for anything after "@"
	if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Must Contain a Domain Name After the "@"');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for multiple "@"
	if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Must Contain Only One "@"');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "."
	if (theForm.email.value.indexOf(".") == -1) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Must Contain a "."');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "." as first char.
	if (theForm.email.value.indexOf(".") == 0) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Cannot Start With a "."');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for ".."
	if (theForm.email.value.indexOf("..") != -1) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Adjacent Dots ("..")');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "." adjacent to "@"
	if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for TLD
	if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for TLD at least 2 char.
	var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
	if (domain.length - (domain.indexOf(".")+1) < 2) {
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for "_" in TLD
	if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for spaces
	if (theForm.email.value.indexOf(" ") != -1) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Any Spaces (" ")');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Email - check for illegal char.
	var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	if (email_regex.test(theForm.email.value) == false) { 
		theForm.email.focus();
		theForm.email.setAttribute("style", errorBG);
		alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
		theForm.email.setAttribute("style", normalBG);
		return false;
	}
	// Best Time to CallName
	if (theForm.best_time.value == ""){
		theForm.best_time.focus();
		theForm.best_time.setAttribute("style", errorBG);
		alert("Please Select The Best Time To Call");
		theForm.best_time.setAttribute("style", normalBG);
		return false;
	}
	// Comments or Questions
	if (theForm.comment.value == ""){
		theForm.comment.focus();
		theForm.comment.setAttribute("style", warningBG);
		leaveBlank = confirm("                 Are You Sure You Want To Send A Blank Message?\n\r(Click 'Cancel' To Go Back And Enter A Message, 'OK' To Leave Blank)");
		theForm.comment.setAttribute("style", normalBG);
		if (!leaveBlank) return false;
	}
	// All's well - do it.
	alert("Your form has been submitted. Someone will get back with you shortly - Thank You")
//	return false; // Testing
	theForm.submit();
}
