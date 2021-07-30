// Trim string
function trim(str){
	if(!str || typeof str != 'string') return null;
    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}

//Contact Form Validation
function validateContact(theForm){
	// Name
	if (theForm.name.value == ""){
		theForm.name.style.background="#FF0000";
		alert("Please Enter Your Name");
		theForm.name.style.background="#FFFFFF";
		theForm.name.focus();
		return false;
	}
	// Email
	if (theForm.email.value == ""){
		theForm.email.style.background="#FF0000";
		alert("Please Enter Your Email Address");
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "@"
	if (theForm.email.value.indexOf("@") == -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain an "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "@" as first char.
	if (theForm.email.value.indexOf("@") == 0) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Cannot Start With a "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for anything after "@"
	if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain a Domain Name After the "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for multiple "@"
	if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain Only One "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "."
	if (theForm.email.value.indexOf(".") == -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain a "."');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "." as first char.
	if (theForm.email.value.indexOf(".") == 0) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Cannot Start With a "."');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for ".."
	if (theForm.email.value.indexOf("..") != -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Adjacent Dots ("..")');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "." adjacent to "@"
	if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for TLD
	if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for TLD at least 2 char.
	var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
	if (domain.length - (domain.indexOf(".")+1) < 2) {
		theForm.email.style.background="#FF0000";
		alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
/*					// Check for TLD over 3 char. *ALLOWED NOW
	if (domain.length - (domain.indexOf(".")+1) > 3) {
		theForm.email.style.background="#FF0000";
		alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
*/					// Check for "_" in TLD
	if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
		theForm.email.style.background="#FF0000";
		alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for spaces
	if (theForm.email.value.indexOf(" ") != -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Any Spaces (" ")');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for illegal char.
	var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	if (email_regex.test(theForm.email.value) == false) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Verify emails match
	if (theForm.email.value != theForm.email2.value){
		theForm.email.style.background="#FF0000";
		theForm.email2.style.background="#FF0000";
		alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
		theForm.email.style.background="#FFFFFF";
		theForm.email2.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Message
	if (theForm.message.value == ""){
		theForm.message.style.background="#FFFF00";
		leaveBlank = confirm("Are You Sure You Want To Send An Empty Message?\n\r   (Click 'Cancel' To Go Back And Enter A Message)");
		theForm.message.style.background="#FFFFFF";
		theForm.message.focus();
		if (!leaveBlank) return false;
	}
	// All's well - do it.
	theForm.submit();
}

//----------------------------------------------

//Email List Form Validation
function validateJoin(theForm){
	// First Name
	if (theForm.name.value == ""){
		theForm.name.style.background="#FF0000";
		alert("Please Enter Your First Name");
		theForm.name.style.background="#FFFFFF";
		theForm.name.focus();
		return false;
	}
	// Email
	if (theForm.email.value == ""){
		theForm.email.style.background="#FF0000";
		alert("Please Enter Your Email Address");
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "@"
	if (theForm.email.value.indexOf("@") == -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain an "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "@" as first char.
	if (theForm.email.value.indexOf("@") == 0) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Cannot Start With a "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for anything after "@"
	if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain a Domain Name After the "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for multiple "@"
	if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain Only One "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "."
	if (theForm.email.value.indexOf(".") == -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain a "."');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "." as first char.
	if (theForm.email.value.indexOf(".") == 0) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Cannot Start With a "."');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for ".."
	if (theForm.email.value.indexOf("..") != -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Adjacent Dots ("..")');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "." adjacent to "@"
	if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for TLD
	if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for TLD at least 2 char.
	var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
	if (domain.length - (domain.indexOf(".")+1) < 2) {
		theForm.email.style.background="#FF0000";
		alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
/*					// Check for TLD over 3 char. *ALLOWED NOW
	if (domain.length - (domain.indexOf(".")+1) > 3) {
		theForm.email.style.background="#FF0000";
		alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
*/					// Check for "_" in TLD
	if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
		theForm.email.style.background="#FF0000";
		alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for spaces
	if (theForm.email.value.indexOf(" ") != -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Any Spaces (" ")');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for illegal char.
	var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	if (email_regex.test(theForm.email.value) == false) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Verify emails match
	if (theForm.email.value != theForm.email2.value){
		theForm.email.style.background="#FF0000";
		theForm.email2.style.background="#FF0000";
		alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
		theForm.email.style.background="#FFFFFF";
		theForm.email2.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Zip Code
	if (theForm.zipcode.value == ""){
		theForm.zipcode.style.background="#FF0000";
		alert("Please Enter Your Zip Code");
		theForm.zipcode.style.background="#FFFFFF";
		theForm.zipcode.focus();
		return false;
	}
	var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.zipcode.value) == false && cdn_regex.test(theForm.zipcode.value) == false) { 
		if (usa_regex.test(theForm.zipcode.value) == false) { 
		theForm.zipcode.style.background="#FF0000";
		alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
		theForm.zipcode.style.background="#FFFFFF";
		theForm.zipcode.focus();
		return false;
	}
	// All's well - do it.
	theForm.submit();
}

//----------------------------------------------

//Order Form Validation
function validateOrder(theForm){
	// Email
	if (theForm.email.value == ""){
		theForm.email.style.background="#FF0000";
		alert("Please Enter Your Email Address");
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "@"
	if (theForm.email.value.indexOf("@") == -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain an "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "@" as first char.
	if (theForm.email.value.indexOf("@") == 0) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Cannot Start With a "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for anything after "@"
	if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain a Domain Name After the "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for multiple "@"
	if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain Only One "@"');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "."
	if (theForm.email.value.indexOf(".") == -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain a "."');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "." as first char.
	if (theForm.email.value.indexOf(".") == 0) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Cannot Start With a "."');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for ".."
	if (theForm.email.value.indexOf("..") != -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Adjacent Dots ("..")');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for "." adjacent to "@"
	if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for TLD
	if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for TLD at least 2 char.
	var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
	if (domain.length - (domain.indexOf(".")+1) < 2) {
		theForm.email.style.background="#FF0000";
		alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
/*					// Check for TLD over 3 char. *ALLOWED NOW
	if (domain.length - (domain.indexOf(".")+1) > 3) {
		theForm.email.style.background="#FF0000";
		alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
*/					// Check for "_" in TLD
	if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
		theForm.email.style.background="#FF0000";
		alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for spaces
	if (theForm.email.value.indexOf(" ") != -1) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Any Spaces (" ")');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Check for illegal char.
	var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	if (email_regex.test(theForm.email.value) == false) { 
		theForm.email.style.background="#FF0000";
		alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
		theForm.email.style.background="#FFFFFF";
		theForm.email.focus();
		return false;
	}
	// Name
	var full_name = theForm.first_name.value + " " + theForm.mi.value + " " + theForm.last_name.value;
	if (trim(full_name) == ""){
		theForm.first_name.style.background="#FF0000";
		theForm.mi.style.background="#FF0000";
		theForm.last_name.style.background="#FF0000";
		alert("Please Enter Your Name");
		theForm.first_name.style.background="#FFFFFF";
		theForm.mi.style.background="#FFFFFF";
		theForm.last_name.style.background="#FFFFFF";
		theForm.first_name.focus();
		return false;
	}
	// Shipping Address
	if (theForm.shipping_address.value == ""){
		theForm.shipping_address.style.background="#FF0000";
		alert("Please Enter Your Shipping Address");
		theForm.shipping_address.style.background="#FFFFFF";
		theForm.shipping_address.focus();
		return false;
	}
	// Shipping City
	if (theForm.shipping_city.value == ""){
		theForm.shipping_city.style.background="#FF0000";
		alert("Please Enter Your Shipping City");
		theForm.shipping_city.style.background="#FFFFFF";
		theForm.shipping_city.focus();
		return false;
	}
	// Shipping State
	if (theForm.shipping_state.value == ""){
		theForm.shipping_state.style.background="#FF0000";
		alert("Please Enter Your Shipping State");
		theForm.shipping_state.style.background="#FFFFFF";
		theForm.shipping_state.focus();
		return false;
	}
	// Shipping Zip Code
	if (theForm.shipping_zip_code.value == ""){
		theForm.shipping_zip_code.style.background="#FF0000";
		alert("Please Enter Your Shipping Zip Code");
		theForm.shipping_zip_code.style.background="#FFFFFF";
		theForm.shipping_zip_code.focus();
		return false;
	}
	var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.zip_code.value) == false && cdn_regex.test(theForm.zip_code.value) == false) { 
		if (usa_regex.test(theForm.shipping_zip_code.value) == false) { 
		theForm.shipping_zip_code.style.background="#FF0000";
		alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
		theForm.shipping_zip_code.style.background="#FFFFFF";
		theForm.shipping_zip_code.focus();
		return false;
	}
	// Billing Address
	if (theForm.billing_address.value == ""){
		theForm.billing_address.style.background="#FF0000";
		alert("Please Enter Your Billing Address\nClick the Copy Link To Copy Shipping Address");
		theForm.billing_address.style.background="#FFFFFF";
		theForm.billing_address.focus();
		return false;
	}
	// Billing City
	if (theForm.billing_city.value == ""){
		theForm.billing_city.style.background="#FF0000";
		alert("Please Enter Your Billing City\nClick the Copy Link To Copy Shipping Address");
		theForm.billing_city.style.background="#FFFFFF";
		theForm.billing_city.focus();
		return false;
	}
	// Billing State
	if (theForm.billing_state.value == ""){
		theForm.billing_state.style.background="#FF0000";
		alert("Please Enter Your Billing State\nClick the Copy Link To Copy Shipping Address");
		theForm.billing_state.style.background="#FFFFFF";
		theForm.billing_state.focus();
		return false;
	}
	// Billing Zip Code
	if (theForm.billing_zip_code.value == ""){
		theForm.billing_zip_code.style.background="#FF0000";
		alert("Please Enter Your Billing Zip Code\nClick the Copy Link To Copy Shipping Address");
		theForm.billing_zip_code.style.background="#FFFFFF";
		theForm.billing_zip_code.focus();
		return false;
	}
	var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.zip_code.value) == false && cdn_regex.test(theForm.zip_code.value) == false) { 
		if (usa_regex.test(theForm.billing_zip_code.value) == false) { 
		theForm.billing_zip_code.style.background="#FF0000";
		alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
		theForm.billing_zip_code.style.background="#FFFFFF";
		theForm.billing_zip_code.focus();
		return false;
	}




	// Message
/*	if (theForm.message.value == ""){
		theForm.message.style.background="#FFFF00";
		leaveBlank = confirm("Are You Sure You Want To Send An Empty Message?\n\r   (Click 'Cancel' To Go Back And Enter A Message)");
		theForm.message.style.background="#FFFFFF";
		theForm.message.focus();
		if (!leaveBlank) return false;
	}
*/	// All's well - do it.
//	theForm.submit();
}
