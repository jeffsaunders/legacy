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

//Quote Form Validation
function validateQuote(theForm){
	// Company Name
	if (theForm.company.value == ""){
		theForm.company.style.background="#FF0000";
		alert("Please Enter Your Company Name");
		theForm.company.style.background="#FFFFFF";
		theForm.company.focus();
		return false;
	}
	// First Name
	if (theForm.first_name.value == ""){
		theForm.first_name.style.background="#FF0000";
		alert("Please Enter Your First Name");
		theForm.first_name.style.background="#FFFFFF";
		theForm.first_name.focus();
		return false;
	}
	// Last Name
	if (theForm.last_name.value == ""){
		theForm.last_name.style.background="#FF0000";
		alert("Please Enter Your Last Name");
		theForm.last_name.style.background="#FFFFFF";
		theForm.last_name.focus();
		return false;
	}
	// Address
	if (theForm.address.value == ""){
		theForm.address.style.background="#FF0000";
		alert("Please Enter Your Address");
		theForm.address.style.background="#FFFFFF";
		theForm.address.focus();
		return false;
	}
	// City
	if (theForm.city.value == ""){
		theForm.city.style.background="#FF0000";
		alert("Please Enter Your City");
		theForm.city.style.background="#FFFFFF";
		theForm.city.focus();
		return false;
	}
	// State
	if (theForm.state.value == ""){
		theForm.state.style.background="#FF0000";
		alert("Please Enter Your State");
		theForm.state.style.background="#FFFFFF";
		theForm.state.focus();
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
	// Phone Number
	if (theForm.phone.value == ""){
		theForm.phone.style.background="#FF0000";
		alert("Please Enter Your Phone Number");
		theForm.phone.style.background="#FFFFFF";
		theForm.phone.focus();
		return false;
	}
	var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
	var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
	if (phone1_regex.test(theForm.phone.value) == false && phone2_regex.test(theForm.phone.value) == false) { 
		theForm.phone.style.background="#FF0000";
		alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
		theForm.phone.style.background="#FFFFFF";
		theForm.phone.focus();
		return false;
	}
	// Fax Number
	if (theForm.fax.value == ""){
		theForm.fax.style.background="#FF0000";
		alert("Please Enter Your Phone Number");
		theForm.fax.style.background="#FFFFFF";
		theForm.fax.focus();
		return false;
	}
	var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
	var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
	if (phone1_regex.test(theForm.fax.value) == false && phone2_regex.test(theForm.fax.value) == false) { 
		theForm.fax.style.background="#FF0000";
		alert('Please Enter a Valid Fax Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
		theForm.fax.style.background="#FFFFFF";
		theForm.fax.focus();
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
	// Best Time to Call
	if (theForm.besttime.value == ""){
		theForm.besttime.style.background="#FF0000";
		alert("Please Enter The Best Time To Call");
		theForm.besttime.style.background="#FFFFFF";
		theForm.besttime.focus();
		return false;
	}
	// Material
	if (theForm.material.value == ""){
		theForm.material.style.background="#FF0000";
		alert("Please Tell Us What Surface Material You Are Working With");
		theForm.material.style.background="#FFFFFF";
		theForm.material.focus();
		return false;
	}
	// Tools
	if (theForm.tools.value == ""){
		theForm.tools.style.background="#FF0000";
		alert("Please Tell Us What Specific Tools You Are Working With Now");
		theForm.tools.style.background="#FFFFFF";
		theForm.tools.focus();
		return false;
	}
	// Message
	if (theForm.message.value == ""){
		theForm.message.style.background="#FFFF00";
		leaveBlank = confirm("Are You Sure You Want To Send An Empty Quote Request?\n\r   (Click 'Cancel' To Go Back And Enter A Request)");
		theForm.message.style.background="#FFFFFF";
		theForm.message.focus();
		if (!leaveBlank) return false;
	}
	// All's well - do it.
	theForm.submit();
}
