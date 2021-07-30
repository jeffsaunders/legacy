<!-- BEGIN Include checkout.php -->

<!-- SSL Site Seal -->
<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

<?
// Test for session id; if none or mismatch they deep-linked, force them to start from scratch
if (!$_SESSION['SID']){ echo'<script>window.location="/?sec=home";</script>'; exit;}
// Good, there is a cookie - assign it's value to a variable for easy work
$SID = $_SESSION['SID'];
//echo $SID;
?>

<!-- Form validation scripts -->
<script>
function validatePhoneInfo(theForm){
// Plan Selected
	if (theForm.data_plan_id){
		var planSelected = false;
		for (i = 0;  i < theForm.data_plan_id.length;  i++){
			if (theForm.data_plan_id[i].checked){
				planSelected = true;
//					return true;
			}
		}
		if (!planSelected){
			for (i = 0;  i < theForm.data_plan_id.length;  i++){
				theForm.data_plan_id[i].style.background="#FF0000";
			}
			alert("Please select a Data Plan before continuing.");
			for (i = 0;  i < theForm.data_plan_id.length;  i++){
				theForm.data_plan_id[i].style.background="#DCEAFB";
			}
			return false;
		}
	}
// Phone User Name
	if (theForm.phone_username){
		if (theForm.phone_username.value == ""){
			theForm.phone_username.style.background="#FF0000";
			alert("Please Enter A User Name");
			theForm.phone_username.style.background="#FFFFFF";
			theForm.phone_username.focus();
			return false;
		}
	}
// Phone User Desired Areacode
	if (theForm.phone_areacode){
		if (theForm.phone_areacode.value == ""){
			theForm.phone_areacode.style.background="#FF0000";
			alert("Please Enter The Desired Areacode");
			theForm.phone_areacode.style.background="#FFFFFF";
			theForm.phone_areacode.focus();
			return false;
		}
		var ac_regex = /(^\d{3}$)/;  // xxx
			if (ac_regex.test(theForm.phone_areacode.value) == false) { 
			theForm.phone_areacode.style.background="#FF0000";
			alert('Please Enter a Valid Area Code as "NNN"');
			theForm.phone_areacode.style.background="#FFFFFF";
			theForm.phone_areacode.focus();
			return false;
		}
	}
// Phone User City
	if (theForm.phone_usercity){
		if (theForm.phone_usercity.value == ""){
			theForm.phone_usercity.style.background="#FF0000";
			alert("Please Enter A City Name");
			theForm.phone_usercity.style.background="#FFFFFF";
			theForm.phone_usercity.focus();
			return false;
		}
	}
// Phone User State
	if (theForm.phone_userstate){
		if (theForm.phone_userstate.value == ""){
			theForm.phone_userstate.style.background="#FF0000";
			alert("Please Select A State");
			theForm.phone_userstate.style.background="#FFFFFF";
			theForm.phone_userstate.focus();
			return false;
		}
	}
// Phone User Zip Code
	if (theForm.phone_userzip){
		if (theForm.phone_userzip.value == ""){
			theForm.phone_userzip.style.background="#FF0000";
			alert("Please Enter A Zip Code");
			theForm.phone_userzip.style.background="#FFFFFF";
			theForm.phone_userzip.focus();
			return false;
		}
		var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.phone_userzip.value) == false && cdn_regex.test(theForm.phone_userzip.value) == false) { 
			if (usa_regex.test(theForm.phone_userzip.value) == false) { 
			theForm.phone_userzip.style.background="#FF0000";
			alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
			theForm.phone_userzip.style.background="#FFFFFF";
			theForm.phone_userzip.focus();
			return false;
		}
	}
	return true;
}

/////////////////////////////////////////////////////////

function validateCustInfo(theForm){
// First Name
	if (theForm.first_name){
		if (theForm.first_name.value == ""){
			theForm.first_name.style.background="#FF0000";
			alert("Please Enter Your First Name");
			theForm.first_name.style.background="#FFFFFF";
			theForm.first_name.focus();
			return false;
		}
	}
// Last Name
	if (theForm.last_name){
		if (theForm.last_name.value == ""){
			theForm.last_name.style.background="#FF0000";
			alert("Please Enter Your Last Name");
			theForm.last_name.style.background="#FFFFFF";
			theForm.last_name.focus();
			return false;
		}
	}
// Shipping Address
	if (theForm.ship_address_1){
		if (theForm.ship_address_1.value == ""){
			theForm.ship_address_1.style.background="#FF0000";
			theForm.ship_address_2.style.background="#FF0000";
			alert("Please Enter Your Shipping Address");
			theForm.ship_address_1.style.background="#FFFFFF";
			theForm.ship_address_2.style.background="#FFFFFF";
			theForm.ship_address_1.focus();
			return false;
		}
	}
// Shipping City
	if (theForm.ship_city){
		if (theForm.ship_city.value == ""){
			theForm.ship_city.style.background="#FF0000";
			alert("Please Enter Your Shipping City");
			theForm.ship_city.style.background="#FFFFFF";
			theForm.ship_city.focus();
			return false;
		}
	}
// Shipping State
	if (theForm.ship_state){
		if (theForm.ship_state.value == ""){
			theForm.ship_state.style.background="#FF0000";
			alert("Please Enter Your Shipping State");
			theForm.ship_state.style.background="#FFFFFF";
			theForm.ship_state.focus();
			return false;
		}
	}
// Shipping Zip Code
	if (theForm.ship_zipcode){
		if (theForm.ship_zipcode.value == ""){
			theForm.ship_zipcode.style.background="#FF0000";
			alert("Please Enter Your Shipping Zipcode");
			theForm.ship_zipcode.style.background="#FFFFFF";
			theForm.ship_zipcode.focus();
			return false;
		}
		var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.ship_zipcode.value) == false && cdn_regex.test(theForm.ship_zipcode.value) == false) { 
			if (usa_regex.test(theForm.ship_zipcode.value) == false) { 
			theForm.ship_zipcode.style.background="#FF0000";
			alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
			theForm.ship_zipcode.style.background="#FFFFFF";
			theForm.ship_zipcode.focus();
			return false;
		}
	}
// Billing Address
	if (theForm.bill_address_1){
		if (theForm.bill_address_1.value == ""){
			theForm.bill_address_1.style.background="#FF0000";
			theForm.bill_address_2.style.background="#FF0000";
			alert("Please Enter Your Billing Address");
			theForm.bill_address_1.style.background="#FFFFFF";
			theForm.bill_address_2.style.background="#FFFFFF";
			theForm.bill_address_1.focus();
			return false;
		}
	}
// Billing City
	if (theForm.bill_city){
		if (theForm.bill_city.value == ""){
			theForm.bill_city.style.background="#FF0000";
			alert("Please Enter Your Billing City");
			theForm.bill_city.style.background="#FFFFFF";
			theForm.bill_city.focus();
			return false;
		}
	}
// Billing State
	if (theForm.bill_state){
		if (theForm.bill_state.value == ""){
			theForm.bill_state.style.background="#FF0000";
			alert("Please Enter Your Billing State");
			theForm.bill_state.style.background="#FFFFFF";
			theForm.bill_state.focus();
			return false;
		}
	}
// Billing Zip Code
	if (theForm.bill_zipcode){
		if (theForm.bill_zipcode.value == ""){
			theForm.bill_zipcode.style.background="#FF0000";
			alert("Please Enter Your Billing Zipcode");
			theForm.bill_zipcode.style.background="#FFFFFF";
			theForm.bill_zipcode.focus();
			return false;
		}
		var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.bill_zipcode.value) == false && cdn_regex.test(theForm.bill_zipcode.value) == false) { 
			if (usa_regex.test(theForm.bill_zipcode.value) == false) { 
			theForm.bill_zipcode.style.background="#FF0000";
			alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
			theForm.bill_zipcode.style.background="#FFFFFF";
			theForm.bill_zipcode.focus();
			return false;
		}
	}
// Home Phone Number
	if (theForm.home_phone){
		if (theForm.home_phone.value == ""){
			theForm.home_phone.style.background="#FF0000";
			alert("Please Enter Your Home Phone Number");
			theForm.home_phone.style.background="#FFFFFF";
			theForm.home_phone.focus();
			return false;
		}
		var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
		var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
			if (phone1_regex.test(theForm.home_phone.value) == false && phone2_regex.test(theForm.home_phone.value) == false) { 
			theForm.home_phone.style.background="#FF0000";
			alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
			theForm.home_phone.style.background="#FFFFFF";
			theForm.home_phone.focus();
			return false;
		}
	}
// Alternate Phone Number
	if (theForm.alt_phone.value != ""){
//		if (theForm.alt_phone){
//			if (theForm.alt_phone.value == ""){
//				theForm.alt_phone.style.background="#FF0000";
//				alert("Please Enter An Alternate Phone Number");
//				theForm.alt_phone.style.background="#FFFFFF";
//				theForm.alt_phone.focus();
//				return false;
//			}
		var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
		var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
			if (phone1_regex.test(theForm.alt_phone.value) == false && phone2_regex.test(theForm.alt_phone.value) == false) { 
			theForm.alt_phone.style.background="#FF0000";
			alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
			theForm.alt_phone.style.background="#FFFFFF";
			theForm.alt_phone.focus();
			return false;
		}
	}
// Existing Carrier Phone Number
	if (theForm.carrier_phone){
		if (theForm.carrier_phone.value != ""){
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.carrier_phone.value) == false && phone2_regex.test(theForm.carrier_phone.value) == false) { 
				theForm.carrier_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN or leave blank');
				theForm.carrier_phone.style.background="#FFFFFF";
				theForm.carrier_phone.focus();
				return false;
			}
		}
	}
// Email Address
	if (theForm.email){
		if (theForm.email.value == ""){
			theForm.email.style.background="#FF0000";
			theForm.email_confirm.style.background="#FF0000";
			alert("Please Enter Your Email Address Twice to Confirm");
			theForm.email.style.background="#FFFFFF";
			theForm.email_confirm.style.background="#FFFFFF";
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
		// Check for TLD over 3 char.
//			if (domain.length - (domain.indexOf(".")+1) > 3) {
//				theForm.email.style.background="#FF0000";
//				alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//				theForm.email.style.background="#FFFFFF";
//				theForm.email.focus();
//				return false;
//			}
		// Check for "_" in TLD
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
		if (theForm.email.value != theForm.email_confirm.value){
			theForm.email.style.background="#FF0000";
			theForm.email_confirm.style.background="#FF0000";
			alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
			theForm.email.style.background="#FFFFFF";
			theForm.email_confirm.style.background="#FFFFFF";
			theForm.email.focus();
			return false;
		}
	}
// SSN
	if (theForm.ssn){
		if (theForm.ssn.value == ""){
			theForm.ssn.style.background="#FF0000";
			alert("Please Enter Your Social Security Number");
			theForm.ssn.style.background="#FFFFFF";
			theForm.ssn.focus();
			return false;
		}
		var ssn_regex = /(^\d{3}-\d{2}-\d{4}$)/;  // xxx-xx-xxxx
			if (ssn_regex.test(theForm.ssn.value) == false) { 
			theForm.ssn.style.background="#FF0000";
			alert('Please Enter a Valid Social Security Number as "NNN-NN-NNNN"');
			theForm.ssn.style.background="#FFFFFF";
			theForm.ssn.focus();
			return false;
		}
	}
// Date of Birth
	if (theForm.dob){
		if (theForm.dob.value == ""){
			theForm.dob.style.background="#FF0000";
			alert("Please Enter Your Date of Birth");
			theForm.dob.style.background="#FFFFFF";
			theForm.dob.focus();
			return false;
		}
		// check format
		var dob1_regex = /(^\d{2}\/\d{2}\/\d{4}$)/;  // mm/dd/yyyy
//			var dob2_regex = /(^\d{2}\-\d{2}\-\d{4}$)/;  // mm-dd-yyyy
// 			if (dob1_regex.test(theForm.dob.value) == false && dob2_regex.test(theForm.dob.value) == false) { 
			if (dob1_regex.test(theForm.dob.value) == false) { 
			theForm.dob.style.background="#FF0000";
//				alert('Please Enter a Valid Date as "MM/DD/YYYY" or "MM-DD-YYYY"');
			alert('Please Enter a Valid Date as "MM/DD/YYYY"');
			theForm.dob.style.background="#FFFFFF";
			theForm.dob.focus();
			return false;
		}
		// is it a valid date?
		if (isValidDate(theForm.dob.value) == false){
			theForm.dob.style.background="#FF0000";
			alert("Please Enter A Valid Date for Date of Birth");
			theForm.dob.style.background="#FFFFFF";
			theForm.dob.focus();
			return false;
		}
		// are they 18?
		var now = new Date();
		var then = new Date(now.getTime()-(1000*60*60*24*365*18+345600000)); // 18 years ago + 4 days for leap years
		if (compareDates(theForm.dob.value,"M/d/yyyy",formatDate(then,'M/d/yyyy'),"M/d/yyyy") == 1){
			theForm.dob.style.background="#FF0000";
			alert("The Birth Date you entered indicates you are not yet 18 - you must be at least 18 to order a phone.");
			theForm.dob.style.background="#FFFFFF";
			theForm.dob.focus();
			return false;
		}
	}
// Driver's License Number
	if (theForm.dl_num){
		if (theForm.dl_num.value == ""){
			theForm.dl_num.style.background="#FF0000";
			alert("Please Enter Your Driver's License Number");
			theForm.dl_num.style.background="#FFFFFF";
			theForm.dl_num.focus();
			return false;
		}
	}
// Driver's License State
	if (theForm.dl_state){
		if (theForm.dl_state.value == ""){
			theForm.dl_state.style.background="#FF0000";
			alert("Please Select Your Driver's License State");
			theForm.dl_state.style.background="#FFFFFF";
			theForm.dl_state.focus();
			return false;
		}
	}
// Driver's License Expiration Month
	if (theForm.dl_exp_month){
		if (theForm.dl_exp_month.value == ""){
			theForm.dl_exp_month.style.background="#FF0000";
			alert("Please Select Your Driver's License Expiration Month");
			theForm.dl_exp_month.style.background="#FFFFFF";
			theForm.dl_exp_month.focus();
			return false;
		}
	}
// Driver's License Expiration Day
	if (theForm.dl_exp_day){
		if (theForm.dl_exp_day.value == ""){
			theForm.dl_exp_day.style.background="#FF0000";
			alert("Please Select Your Driver's License Expiration Day\n\r(Choose the last day of the month if there isn't an expiration day)");
			theForm.dl_exp_day.style.background="#FFFFFF";
			theForm.dl_exp_day.focus();
			return false;
		}
	}
// Driver's License Expiration Year
	if (theForm.dl_exp_year){
		if (theForm.dl_exp_year.value == ""){
			theForm.dl_exp_year.style.background="#FF0000";
			alert("Please Select Your Credit Card Expiration Year");
			theForm.dl_exp_year.style.background="#FFFFFF";
			theForm.dl_exp_year.focus();
			return false;
		}
	}
// Driver's License Expiration Date Passed?
	var expires = new Date(theForm.dl_exp_year.value,theForm.dl_exp_month.value-1,theForm.dl_exp_day.value,0,0);
		if (compareDates(formatDate(expires,'MMM d, y'),"MMM d, y",formatDate(new Date(),'MMM d, y'),"MMM d, y")== 0){
		theForm.dl_exp_month.style.background="#FF0000";
		theForm.dl_exp_day.style.background="#FF0000";
		theForm.dl_exp_year.style.background="#FF0000";
		alert("The Expiration Date You Entered Indicates That Your Driver's License Is Expired");
		theForm.dl_exp_month.style.background="#FFFFFF";
		theForm.dl_exp_day.style.background="#FFFFFF";
		theForm.dl_exp_year.style.background="#FFFFFF";
		theForm.dl_exp_month.focus();
		return false;
	}
// Credit Card Type
	if (theForm.cc_type){
		if (theForm.cc_type.value == ""){
			theForm.cc_type.style.background="#FF0000";
			alert("Please Select Your Credit Card Type");
			theForm.cc_type.style.background="#FFFFFF";
			theForm.cc_type.focus();
			return false;
		}
	}
// Credit Card Expiration Month
	if (theForm.exp_month){
		if (theForm.exp_month.value == ""){
			theForm.exp_month.style.background="#FF0000";
			alert("Please Select Your Credit Card Expiration Month");
			theForm.exp_month.style.background="#FFFFFF";
			theForm.exp_month.focus();
			return false;
		}
	}
// Credit Card Expiration Year
	if (theForm.exp_year){
		if (theForm.exp_year.value == ""){
			theForm.exp_year.style.background="#FF0000";
			alert("Please Select Your Credit Card Expiration Year");
			theForm.exp_year.style.background="#FFFFFF";
			theForm.exp_year.focus();
			return false;
		}
	}
// Credit Card Expiration Date Passed?
	var expires = new Date(theForm.exp_year.value,theForm.exp_month.value,0,0,0);
		if (compareDates(formatDate(expires,'MMM d, y'),"MMM d, y",formatDate(new Date(),'MMM d, y'),"MMM d, y")== 0){
		theForm.exp_month.style.background="#FF0000";
		theForm.exp_year.style.background="#FF0000";
		alert("The Expiration Date You Entered Indicates That The Credit Card Is Expired");
		theForm.exp_month.style.background="#FFFFFF";
		theForm.exp_year.style.background="#FFFFFF";
		theForm.exp_month.focus();
		return false;
	}
// Credit Card Number
	if (theForm.cc_num){
		if (theForm.cc_num.value == ""){
			theForm.cc_num.style.background="#FF0000";
			alert("Please Enter The Credit Card Number");
			theForm.cc_num.style.background="#FFFFFF";
			theForm.cc_num.focus();
			return false;
		}
		// Verify Card Number Form
		switch(theForm.cc_type.value){
			// Visa
			case 'Visa':
			// 13 or 16 Digits Starting With "4"
				var prefix = parseInt(theForm.cc_num.value.substring(0,1));
				if ((theForm.cc_num.value.length != 13 && theForm.cc_num.value.length != 16) || prefix != 4){
					theForm.cc_num.style.background="#FF0000";
					alert("Please Enter A Valid Visa Card Number");
					theForm.cc_num.style.background="#FFFFFF";
					theForm.cc_num.focus();
					return false;
				}
					break;
			// Mastercard
			case 'MasterCard':
			// 16 Digits Starting With Ranging From "51" to "55"
				var prefix = parseInt(theForm.cc_num.value.substring(0,2));
				if (theForm.cc_num.value.length != 16 || (prefix < 51 || prefix > 55)){
					theForm.cc_num.style.background="#FF0000";
					alert("Please Enter A Valid MasterCard Number");
					theForm.cc_num.style.background="#FFFFFF";
					theForm.cc_num.focus();
					return false;
				}
					break;
			// Amex
			case 'American Express':
			// 15 Digits Starting With "34" or "37"
				var prefix = parseInt(theForm.cc_num.value.substring(0,2));
				if (theForm.cc_num.value.length != 15 || (prefix != 34 && prefix != 37)){
					theForm.cc_num.style.background="#FF0000";
					alert("Please Enter A Valid American Express Card Number");
					theForm.cc_num.style.background="#FFFFFF";
					theForm.cc_num.focus();
					return false;
				}
				break;
			// Discover
			case 'Discover':
			// 16 Digits Starting With "6011"
				var prefix = parseInt(theForm.cc_num.value.substring(0,4));
				if (theForm.cc_num.value.length != 16 || prefix != 6011){
					theForm.cc_num.style.background="#FF0000";
					alert("Please Enter A Valid Discover Card Number");
					theForm.cc_num.style.background="#FFFFFF";
					theForm.cc_num.focus();
					return false;
				}
					break;
		}
		// Verify Card Number Against Check Digit Using MOD10
		var ar = new Array(theForm.cc_num.value.length);
		var i = 0,sum = 0;
		for(i = 0; i < theForm.cc_num.value.length; ++i){
			ar[i] = parseInt(theForm.cc_num.value.charAt(i));
		}
		for(i = ar.length -2; i >= 0; i-=2){	// you have to start from the right, and work back.
			ar[i] *= 2;							// every second digit starting with the right most (check digit)
			if(ar[i] > 9) ar[i]-=9;				// will be doubled, and summed with the skipped digits.
		}										// if the double digit is > 9, ADD those individual digits together 
		for(i = 0; i < ar.length; ++i){
			sum += ar[i];
		}
		if ((sum%10)!=0){						// if the sum is not evenly divisible by 10 it fails
			theForm.cc_num.style.background="#FF0000";
			alert("Please Enter A Valid Credit Card Number");
			theForm.cc_num.style.background="#FFFFFF";
			theForm.cc_num.focus();
			return false;
		}
	}
// Credit Card CID
	if (theForm.cc_cid){
		if (theForm.cc_cid.value == ""){
			theForm.cc_cid.style.background="#FF0000";
			alert("Please Enter Your Credit Card CID Security Code");
			theForm.cc_cid.style.background="#FFFFFF";
			theForm.cc_cid.focus();
			return false;
		}
	}
// Credit Card Name
	if (theForm.cc_name){
		if (theForm.cc_name.value == ""){
			theForm.cc_name.style.background="#FF0000";
			alert("Please Enter The Name Exactly As It Appears On Your Credit Card");
			theForm.cc_name.style.background="#FFFFFF";
			theForm.cc_name.focus();
			return false;
		}
	}
	return true;
}

</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td valign="top">
		<table width="710" border="0" cellspacing="0" cellpadding="0" align="left" bgcolor="#FFFFFF">
		<tr>
			<td><img src="images/CheckoutHeader.jpg" alt="" width="710" height="25" border="0"></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" background="images/InfoBG.jpg" style="background-position:top; background-repeat:repeat-y;">
				<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
				<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
				<tr>
					<td align="center">
						<table width="690" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
						<tr>
							<td>
								<?
								$query = "SELECT * FROM order_items WHERE session_id='".$SID."' AND phone_type <> ''";
								$rs_devices = mysql_query($query, $linkID);
								$devices = mysql_num_rows($rs_devices);
//echo $devices;
								if ($cargo == ""){
									$query = "SELECT * FROM order_items WHERE session_id='".$SID."' AND phone_type <> '' and data_plan_id = ''";
								}else{
									$query = "SELECT * FROM order_items WHERE session_id='".$SID."' AND record_id = '".$cargo."'";
								}
//echo $query;
								$rs_cart = mysql_query($query, $linkID);
								if (mysql_num_rows($rs_cart) != false){
									$item = mysql_fetch_assoc($rs_cart);
									$query = "SELECT * FROM phones WHERE product_id='".$item['product_id']."'";
									$rs_phone = mysql_query($query, $linkID);
									$phone = mysql_fetch_assoc($rs_phone);
								?>
								<!-- Phone Information -->
								<form action="saveit.php" method="post" name="PushPhoneInfo" id="PushPhoneInfo" onSubmit="return validatePhoneInfo(this);">
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<tr>
									<td width="690" colspan="3" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td width="70" rowspan="3"><img src="images/phones/<? echo $phone["thumbnail"]; ?>" alt="<? echo $phone["manufacturer"]; ?> <? echo $phone["model"]; ?>" title="<? echo $phone["manufacturer"]; ?> <? echo $phone["model"]; ?>" width="70" height="130" border="0"></td>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
												<strong><? echo $phone["label"]; ?></strong>
											</td>
											<td width="65" rowspan="2" align="center" valign="top" class="smallBlack">
												<!-- SSL Site Seal -->
												<script type="text/javascript">TrustLogo("images/SiteSeal.gif", "SC","none");</script><br>
												<font face="Arial,Helvetica,sans-serif" style="font-size:9px;">*Secure Site*</font>
											</td>
										</tr>
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
												First we need to gather information about each device in your order.&nbsp;&nbsp;Please select a plan, options, and enter information specific to this <? echo $phone["manufacturer"]; ?> <? echo $phone["model"]; ?>.<br>
<!--												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>-->
											</td>
										</tr>
										<tr>
											<td colspan="2" class="bodyBlack">
												Sprint offers service plan choices to bring you access to more of what you need so you can do more of what you want. And their <a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-30DayRiskFreeGuarantee.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" title="Sprint's 30-Day Guarantee Details" class="bodyBlue">30-Day Risk-Free Guarantee</a> lets you try their services risk free. You only need to select the plan that fits best.
											</td>
										</tr>
										</table>
									</td>
								</tr>
								</table>
								<br>
<script>//alert("<? echo $item["data_plan_id"]; ?>");</script>
								<!-- Plans -->
								<?
									$query = "SELECT * FROM plans WHERE group_name = 'Sprint Mobile Broadband Connection' AND display = 'T' ORDER BY cost";
									$rs_plans = mysql_query($query, $linkID);
									$plan = mysql_fetch_assoc($rs_plans);
									$query = "SELECT * FROM plan_features WHERE group_id = '".$plan["group_id"]."'";
									$rs_features = mysql_query($query, $linkID);
									mysql_data_seek($rs_plans,0);  // go back to the top
									echo'
								<br>
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								';
									$discountable = true;
									if ($sprint_discount > 0){
										echo'
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<tr>
									<td colspan="7" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="690" colspan="5" bgcolor="'.$box_bg.'" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
										';
										for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
											$row = mysql_fetch_assoc($rs_features);
											echo $row["feature"];
										};
										echo'
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
										';
										if ($plan["plan_type"] == 'D'){
											echo'
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td width="75" height="20" align="center"><strong>Select</strong></td>
									<td width="240" align="enter"><strong>Mobile Broadband Plans</strong></td>
									<td width="125" align="center"><strong>Monthly Usage</strong></td>
									<td width="125" align="center"><strong>Monthly Price</strong></td>
									<td width="125" align="center"><strong>Your Price</strong></td>
								</tr>
											';
										}
										for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
											$row = mysql_fetch_assoc($rs_plans);
											if ($plan["plan_type"] == 'D'){
												echo'
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td align="center"><input type="radio" name="data_plan_id" value="'.$row["plan_id"].'"'.iif($item["data_plan_id"] == $row["plan_id"], " checked", "").'></td>
									<td align="left">'.$row["plan_name"].'</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center"><strike>$'.money_format('%i', $row["cost"]).'</strike></td>
												';
												if ($row["discountable"] == 'F'){
													$discountable = false;
													echo'
									<td align="center"><img src="images/spacer.gif" alt="" width="7" height="1" border="0">$'.money_format('%i', $row["cost"]).'&dagger;</td>
													';
												}else{
													echo'
									<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($sprint_discount*.01)))).'</td>
													';
												}
												echo'
								</tr>
								<tr>
									<td colspan="5" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
												';
											}
										}
									}else{
										echo'
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<tr>
									<td colspan="6" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="690" colspan="4" bgcolor="'.$box_bg.'" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
										';
										for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
											$row = mysql_fetch_assoc($rs_features);
											echo $row["feature"];
										};
										echo'
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
										';
										if ($plan["plan_type"] == 'D'){
											echo'
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td width="75" height="20" align="center"><strong>Select</strong></td>
									<td width="365" align="enter"><strong>Mobile Broadband Plans</strong></td>
									<td width="125" align="center"><strong>Monthly Usage</strong></td>
									<td width="125" align="center"><strong>Monthly Price</strong></td>
								</tr>
											';
										}
										for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
											$row = mysql_fetch_assoc($rs_plans);
											if ($plan["plan_type"] == 'D'){
												echo'
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td align="center"><input type="radio" name="data_plan_id" tabindex="'.$counter2.'" value="'.$row["plan_id"].'"'.iif($item["data_plan_id"] == $row["plan_id"], " checked", "").'></td>
									<td align="left">'.$row["plan_name"].'</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center">$'.money_format('%i', $row["cost"]).'</td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
												';
											}
										}
									}
									// Add a dummy radio button in case there is only one plan to display - fixes javascript radio button array with only 1 element bug
									echo'
									<input type="radio" name="data_plan_id" value="0" style="display:none">
								</table>
								';
									if ($discountable == false){
										$discountable = true;
										echo'
								<div align="right" class="tinyBlack">&dagger;This Plan Not Eligible for Discounts&nbsp;<br><img src="images/spacer.gif" alt="" width="1" height="7" border=""></div>
										';
									}else{
										echo'
								<br>
										';
									}
								?>
								<!-- Options -->
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<?
									if ($sprint_discount > 0){
								?>
								<tr>
									<td colspan="6" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="690" colspan="4" bgcolor="<? echo $box_bg; ?>" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
												Do even more with these optional services.<br>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td width="75" height="20" align="center"><strong>Select</strong></td>
									<td width="365"><strong>Protection Services</strong></td>
									<td width="125" align="center"><strong>Monthly Price</strong></td>
									<td width="125" align="center"><strong>Your Price</strong></td>
								</tr>
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td align="center"><input type="checkbox" name="aircard_protection" id="aircard_protection" tabindex="100" value="7.00" <? echo iif($item["aircard_protection"] > 0, " checked", ""); ?>></td>
									<td align="left">Total Equipment Protection&nbsp;<a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-EquipServRepairProgram.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" title="Total Equipment Protection Service Details" class="smallBlue"><strong>[Details]</strong></a></td>
									<td align="center"><strike>$<? echo money_format('%i', 7); ?></strike></td>
<!--									<td align="center">$<? echo money_format('%i', (7-(7*($sprint_discount*.01)))); ?></td>-->
									<td align="center">$<? echo money_format('%i', 7); ?>&dagger;</td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<?
									}else{
								?>
								<tr>
									<td colspan="5" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="690" colspan="3" bgcolor="<? echo $box_bg; ?>" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
												Do even more with these optional services.<br>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td width="75" height="20" align="center"><strong>Select</strong></td>
									<td width="490"><strong>Protection Services</strong></td>
									<td width="125" align="center"><strong>Monthly Price</strong></td>
								</tr>
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td align="center"><input type="checkbox" name="aircard_protection" id="aircard_protection" tabindex="100" value="7.00" <? echo iif($item["aircard_protection"] > 0, " checked", ""); ?>></td>
									<td align="left">Total Equipment Protection&nbsp;<a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-EquipServRepairProgram.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" title="Total Equipment Protection Service Details" class="smallBlue"><strong>[Details]</strong></a></td>
									<td align="center">$<? echo money_format('%i', 7); ?></td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<?
									}
								?>
								</table>
								<?
									if ($sprint_discount > 0){
								?>
								<div align="right" class="tinyBlack">&dagger;This Option Not Eligible for Discounts&nbsp;<br><img src="images/spacer.gif" alt="" width="1" height="7" border=""></div>
								<?
									}else{
								?>
								<br>
								<?
									}
								?>
								<!-- Phone User Information -->
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<tr>
									<td colspan="3" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="690" colspan="3" bgcolor="<? echo $box_bg; ?>" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
												Now we need to gather user information about this <? echo $phone["manufacturer"]; ?> <? echo $phone["model"]; ?>.<br>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
								</tr>
								<?
/*									$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
//echo $query;
									$rs_cart = mysql_query($query, $linkID);
									$row = mysql_fetch_assoc($rs_cart);
									$phones_ordered = 0;
									for ($counter=1; $counter <= 5; $counter++){
										if ($row['phone'.$counter.'_id'] != ""){
											$phones_ordered++;
											$query = "SELECT * FROM phones WHERE product_id='".$row['phone'.$counter.'_id']."'";
											$rs_phone = mysql_query($query, $linkID);
											$phone = mysql_fetch_assoc($rs_phone);
*/								?>
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td height="20"><img src="images/spacer.gif" alt="" width="18" height="1" border="0"><strong>User Information</strong></td>
								</tr>
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td>
										<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<!-- Column sizers -->
										<tr>
											<td><img src="images/spacer.gif" alt="" width="100" height="1" border="0"></td>
											<td><img src="images/spacer.gif" alt="" width="195" height="1" border="0"></td>
											<td><img src="images/spacer.gif" alt="" width="30" height="1" border="0"></td>
											<td><img src="images/spacer.gif" alt="" width="30" height="1" border="0"></td>
											<td><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
											<td><img src="images/spacer.gif" alt="" width="75" height="1" border="0"></td>
											<td><img src="images/spacer.gif" alt="" width="70" height="1" border="0"></td>
											<td><img src="images/spacer.gif" alt="" width="80" height="1" border="0"></td>
										</tr>
										<tr>
											<td width="100">User's Name:</td>
											<td colspan="2"><input type="text" name="phone_username" id="phone_username" size="25" maxlength="50" tabindex="200" class="bodyBlack" style="width:225px;" value="<? echo $item["phone_username"]; ?>"></td>
											<td></td>
											<td width="100">User's City:</td>
											<td colspan="3"><input type="text" name="phone_usercity" id="phone_usercity" size="25" maxlength="50" tabindex="220" class="bodyBlack" style="width:225px;" value="<? echo $item["phone_usercity"]; ?>"></td>
										</tr>
										<tr>
											<td colspan="2">Local or Desired Area Code (User's Area Code):</td>
											<td><input type="text" name="phone_areacode" id="phone_areacode" size="3" maxlength="50" tabindex="210" class="bodyBlack" style="width:30px;" value="<? echo $item["phone_areacode"]; ?>"></td>
											<td></td>
											<td>User's State:</td>
											<td>
												<select name="phone_userstate" id="phone_userstate" tabindex="230" class="bodyBlack" style="">
													<option value="">Select</option>
									                <option value="AL"<? echo iif($item["phone_userstate"] == "AL", " selected", ""); ?>>AL</option>
													<option value="AK"<? echo iif($item["phone_userstate"] == "AK", " selected", ""); ?>>AK</option>
													<option value="AZ"<? echo iif($item["phone_userstate"] == "AZ", " selected", ""); ?>>AZ</option>
													<option value="AR"<? echo iif($item["phone_userstate"] == "AR", " selected", ""); ?>>AR</option>
													<option value="CA"<? echo iif($item["phone_userstate"] == "CA", " selected", ""); ?>>CA</option>
													<option value="CO"<? echo iif($item["phone_userstate"] == "CO", " selected", ""); ?>>CO</option>
													<option value="CT"<? echo iif($item["phone_userstate"] == "CT", " selected", ""); ?>>CT</option>
													<option value="DE"<? echo iif($item["phone_userstate"] == "DE", " selected", ""); ?>>DE</option>
													<option value="DC"<? echo iif($item["phone_userstate"] == "DC", " selected", ""); ?>>DC</option>
													<option value="FL"<? echo iif($item["phone_userstate"] == "FL", " selected", ""); ?>>FL</option>
													<option value="GA"<? echo iif($item["phone_userstate"] == "GA", " selected", ""); ?>>GA</option>
													<option value="HI"<? echo iif($item["phone_userstate"] == "HI", " selected", ""); ?>>HI</option>
													<option value="ID"<? echo iif($item["phone_userstate"] == "ID", " selected", ""); ?>>ID</option>
													<option value="IL"<? echo iif($item["phone_userstate"] == "IL", " selected", ""); ?>>IL</option>
													<option value="IN"<? echo iif($item["phone_userstate"] == "IN", " selected", ""); ?>>IN</option>
													<option value="IA"<? echo iif($item["phone_userstate"] == "IA", " selected", ""); ?>>IA</option>
													<option value="KS"<? echo iif($item["phone_userstate"] == "KS", " selected", ""); ?>>KS</option>
													<option value="KY"<? echo iif($item["phone_userstate"] == "KY", " selected", ""); ?>>KY</option>
													<option value="LA"<? echo iif($item["phone_userstate"] == "LA", " selected", ""); ?>>LA</option>
													<option value="ME"<? echo iif($item["phone_userstate"] == "ME", " selected", ""); ?>>ME</option>
													<option value="MD"<? echo iif($item["phone_userstate"] == "MD", " selected", ""); ?>>MD</option>
													<option value="MA"<? echo iif($item["phone_userstate"] == "MA", " selected", ""); ?>>MA</option>
													<option value="MI"<? echo iif($item["phone_userstate"] == "MI", " selected", ""); ?>>MI</option>
													<option value="MN"<? echo iif($item["phone_userstate"] == "MN", " selected", ""); ?>>MN</option>
													<option value="MS"<? echo iif($item["phone_userstate"] == "MS", " selected", ""); ?>>MS</option>
													<option value="MO"<? echo iif($item["phone_userstate"] == "MO", " selected", ""); ?>>MO</option>
													<option value="MT"<? echo iif($item["phone_userstate"] == "MT", " selected", ""); ?>>MT</option>
													<option value="NE"<? echo iif($item["phone_userstate"] == "NE", " selected", ""); ?>>NE</option>
													<option value="NV"<? echo iif($item["phone_userstate"] == "NV", " selected", ""); ?>>NV</option>
													<option value="NH"<? echo iif($item["phone_userstate"] == "NH", " selected", ""); ?>>NH</option>
													<option value="NJ"<? echo iif($item["phone_userstate"] == "NJ", " selected", ""); ?>>NJ</option>
													<option value="NM"<? echo iif($item["phone_userstate"] == "NM", " selected", ""); ?>>NM</option>
													<option value="NY"<? echo iif($item["phone_userstate"] == "NY", " selected", ""); ?>>NY</option>
													<option value="NC"<? echo iif($item["phone_userstate"] == "NC", " selected", ""); ?>>NC</option>
													<option value="ND"<? echo iif($item["phone_userstate"] == "ND", " selected", ""); ?>>ND</option>
													<option value="OH"<? echo iif($item["phone_userstate"] == "OH", " selected", ""); ?>>OH</option>
													<option value="OK"<? echo iif($item["phone_userstate"] == "OK", " selected", ""); ?>>OK</option>
													<option value="OR"<? echo iif($item["phone_userstate"] == "OR", " selected", ""); ?>>OR</option>
													<option value="PA"<? echo iif($item["phone_userstate"] == "PA", " selected", ""); ?>>PA</option>
													<option value="RI"<? echo iif($item["phone_userstate"] == "RI", " selected", ""); ?>>RI</option>
													<option value="SC"<? echo iif($item["phone_userstate"] == "SC", " selected", ""); ?>>SC</option>
													<option value="SD"<? echo iif($item["phone_userstate"] == "SD", " selected", ""); ?>>SD</option>
													<option value="TN"<? echo iif($item["phone_userstate"] == "TN", " selected", ""); ?>>TN</option>
													<option value="TX"<? echo iif($item["phone_userstate"] == "TX", " selected", ""); ?>>TX</option>
													<option value="UT"<? echo iif($item["phone_userstate"] == "UT", " selected", ""); ?>>UT</option>
													<option value="VT"<? echo iif($item["phone_userstate"] == "VT", " selected", ""); ?>>VT</option>
													<option value="VA"<? echo iif($item["phone_userstate"] == "VA", " selected", ""); ?>>VA</option>
													<option value="WA"<? echo iif($item["phone_userstate"] == "WA", " selected", ""); ?>>WA</option>
													<option value="WV"<? echo iif($item["phone_userstate"] == "WV", " selected", ""); ?>>WV</option>
													<option value="WI"<? echo iif($item["phone_userstate"] == "WI", " selected", ""); ?>>WI</option>
													<option value="WY"<? echo iif($item["phone_userstate"] == "WY", " selected", ""); ?>>WY</option>
												</select>
											</td>
											<td>Zip Code:</td>
											<td align="right"><input type="text" name="phone_userzip" id="phone_userzip" size="5" maxlength="10" tabindex="240" class="bodyBlack" style="width:80px;" value="<? echo $item["phone_userzip"]; ?>"></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									</td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								</table>
								<br>
								<input type="hidden" name="discount" value="<? echo $sprint_discount; ?>">
								<input type="hidden" name="task" value="addphoneinfo">
								<input type="hidden" name="record_id" value="<? echo $item["record_id"]; ?>">
								<input type="hidden" name="sid" value="<? echo $SID; ?>">
								<div align="center"><input type="image" src="images/ContinueButton.gif"></div>
								</form>
								<?
								}else{ //Account Information
									$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
////echo $query;
									$rs_cart = mysql_query($query, $linkID);
									$order = mysql_fetch_assoc($rs_cart);
//										$query = "SELECT * FROM phones WHERE product_id='".$item['product_id']."'";
//										$rs_phone = mysql_query($query, $linkID);
//										$phone = mysql_fetch_assoc($rs_phone);
								?>
								<!-- Customer Information -->
								<form action="saveit.php" method="post" name="PushCustInfo" id="PushCustInfo" onSubmit="return validateCustInfo(this);">
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<tr>
									<td width="690" colspan="3" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
												This site is secure.&nbsp;&nbsp;Data encryption ensures that your confidential information will be securely transmitted.&nbsp;&nbsp;All information entered on this form is secured by C&middot;O&middot;M&middot;O&middot;D&middot;O and authenticity is verified by IdAuthority, as demonstrated by the Site Seal to the right.<br>
<!--												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>-->
											</td>
											<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
											<td width="65" rowspan="2" align="center" valign="top" class="smallBlack">
												<!-- SSL Site Seal -->
												<script type="text/javascript">TrustLogo("images/SiteSeal.gif", "SC","none");</script><br>
												<font face="Arial,Helvetica,sans-serif" style="font-size:9px;">*Secure Site*</font>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								</table>
								<br>
								<!-- Billing & Shipping Information -->
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<tr>
									<td colspan="3" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="688" bgcolor="<? echo $box_bg; ?>" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
												Now we need to gather your shipping<?=iif($devices > 0,', billing, credit,',''); ?> and payment information.<br>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
								</tr>
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td height="20"><img src="images/spacer.gif" alt="" width="18" height="1" border="0"><strong>Billing & Shipping Information</strong></td>
								</tr>
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td>
										<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bigBlack">
										<tr>
											<td width="200" align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Name:</td>
											<td>
												<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="first_name" id="first_name" size="30" maxlength="30" tabindex="1" class="bodyBlack" style="" value="<? echo $order["first_name"]; ?>"><br><span class="smallBlack">First</td>
													<td><input type="text" name="middle_name" id="middle_name" size="2" maxlength="5" tabindex="2" class="bodyBlack" style="" value="<? echo $order["middle_name"]; ?>"><br><span class="smallBlack">MI</span></td>
													<td><input type="text" name="last_name" id="last_name" size="30" maxlength="30" tabindex="3" class="bodyBlack" style="" value="<? echo $order["last_name"]; ?>"><br><span class="smallBlack">Last</span></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Shipping Address:<br><span class="smallBlack">Make sure this matches<br>your credit card statement.<br><strong>Cannot be a P.O. Box.</strong></span></td>
											<td>
												<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="ship_address_1" id="ship_address_1" size="30" maxlength="50" tabindex="4" class="bodyBlack" style="" value="<? echo $order["ship_address_1"]; ?>"></td>
													<td colspan="2"><input type="text" name="ship_address_2" id="ship_address_2" size="30" maxlength="50" tabindex="5" class="bodyBlack" style="" value="<? echo $order["ship_address_2"]; ?>"></td>
												</tr>
												<tr>
													<td><input type="text" name="ship_city" id="ship_city" size="30" maxlength="50" tabindex="6" class="bodyBlack" style="" value="<? echo $order["ship_city"]; ?>"><br><span class="smallBlack">City</td>
													<td>
														<select name="ship_state" id="ship_state" tabindex="7" class="bodyBlack" style="">
															<option value="">Select</option>
											                <option value="AL"<? echo iif($order["ship_state"] == "AL", " selected", ""); ?>>AL</option>
															<option value="AK"<? echo iif($order["ship_state"] == "AK", " selected", ""); ?>>AK</option>
															<option value="AZ"<? echo iif($order["ship_state"] == "AZ", " selected", ""); ?>>AZ</option>
															<option value="AR"<? echo iif($order["ship_state"] == "AR", " selected", ""); ?>>AR</option>
															<option value="CA"<? echo iif($order["ship_state"] == "CA", " selected", ""); ?>>CA</option>
															<option value="CO"<? echo iif($order["ship_state"] == "CO", " selected", ""); ?>>CO</option>
															<option value="CT"<? echo iif($order["ship_state"] == "CT", " selected", ""); ?>>CT</option>
															<option value="DE"<? echo iif($order["ship_state"] == "DE", " selected", ""); ?>>DE</option>
															<option value="DC"<? echo iif($order["ship_state"] == "DC", " selected", ""); ?>>DC</option>
															<option value="FL"<? echo iif($order["ship_state"] == "FL", " selected", ""); ?>>FL</option>
															<option value="GA"<? echo iif($order["ship_state"] == "GA", " selected", ""); ?>>GA</option>
															<option value="HI"<? echo iif($order["ship_state"] == "HI", " selected", ""); ?>>HI</option>
															<option value="ID"<? echo iif($order["ship_state"] == "ID", " selected", ""); ?>>ID</option>
															<option value="IL"<? echo iif($order["ship_state"] == "IL", " selected", ""); ?>>IL</option>
															<option value="IN"<? echo iif($order["ship_state"] == "IN", " selected", ""); ?>>IN</option>
															<option value="IA"<? echo iif($order["ship_state"] == "IA", " selected", ""); ?>>IA</option>
															<option value="KS"<? echo iif($order["ship_state"] == "KS", " selected", ""); ?>>KS</option>
															<option value="KY"<? echo iif($order["ship_state"] == "KY", " selected", ""); ?>>KY</option>
															<option value="LA"<? echo iif($order["ship_state"] == "LA", " selected", ""); ?>>LA</option>
															<option value="ME"<? echo iif($order["ship_state"] == "ME", " selected", ""); ?>>ME</option>
															<option value="MD"<? echo iif($order["ship_state"] == "MD", " selected", ""); ?>>MD</option>
															<option value="MA"<? echo iif($order["ship_state"] == "MA", " selected", ""); ?>>MA</option>
															<option value="MI"<? echo iif($order["ship_state"] == "MI", " selected", ""); ?>>MI</option>
															<option value="MN"<? echo iif($order["ship_state"] == "MN", " selected", ""); ?>>MN</option>
															<option value="MS"<? echo iif($order["ship_state"] == "MS", " selected", ""); ?>>MS</option>
															<option value="MO"<? echo iif($order["ship_state"] == "MO", " selected", ""); ?>>MO</option>
															<option value="MT"<? echo iif($order["ship_state"] == "MT", " selected", ""); ?>>MT</option>
															<option value="NE"<? echo iif($order["ship_state"] == "NE", " selected", ""); ?>>NE</option>
															<option value="NV"<? echo iif($order["ship_state"] == "NV", " selected", ""); ?>>NV</option>
															<option value="NH"<? echo iif($order["ship_state"] == "NH", " selected", ""); ?>>NH</option>
															<option value="NJ"<? echo iif($order["ship_state"] == "NJ", " selected", ""); ?>>NJ</option>
															<option value="NM"<? echo iif($order["ship_state"] == "NM", " selected", ""); ?>>NM</option>
															<option value="NY"<? echo iif($order["ship_state"] == "NY", " selected", ""); ?>>NY</option>
															<option value="NC"<? echo iif($order["ship_state"] == "NC", " selected", ""); ?>>NC</option>
															<option value="ND"<? echo iif($order["ship_state"] == "ND", " selected", ""); ?>>ND</option>
															<option value="OH"<? echo iif($order["ship_state"] == "OH", " selected", ""); ?>>OH</option>
															<option value="OK"<? echo iif($order["ship_state"] == "OK", " selected", ""); ?>>OK</option>
															<option value="OR"<? echo iif($order["ship_state"] == "OR", " selected", ""); ?>>OR</option>
															<option value="PA"<? echo iif($order["ship_state"] == "PA", " selected", ""); ?>>PA</option>
															<option value="RI"<? echo iif($order["ship_state"] == "RI", " selected", ""); ?>>RI</option>
															<option value="SC"<? echo iif($order["ship_state"] == "SC", " selected", ""); ?>>SC</option>
															<option value="SD"<? echo iif($order["ship_state"] == "SD", " selected", ""); ?>>SD</option>
															<option value="TN"<? echo iif($order["ship_state"] == "TN", " selected", ""); ?>>TN</option>
															<option value="TX"<? echo iif($order["ship_state"] == "TX", " selected", ""); ?>>TX</option>
															<option value="UT"<? echo iif($order["ship_state"] == "UT", " selected", ""); ?>>UT</option>
															<option value="VT"<? echo iif($order["ship_state"] == "VT", " selected", ""); ?>>VT</option>
															<option value="VA"<? echo iif($order["ship_state"] == "VA", " selected", ""); ?>>VA</option>
															<option value="WA"<? echo iif($order["ship_state"] == "WA", " selected", ""); ?>>WA</option>
															<option value="WV"<? echo iif($order["ship_state"] == "WV", " selected", ""); ?>>WV</option>
															<option value="WI"<? echo iif($order["ship_state"] == "WI", " selected", ""); ?>>WI</option>
															<option value="WY"<? echo iif($order["ship_state"] == "WY", " selected", ""); ?>>WY</option>
														</select>
														<br><span class="smallBlack">State</span>
													</td>
													<td><input type="text" name="ship_zipcode" id="ship_zipcode" size="10" maxlength="10" tabindex="8" class="bodyBlack" style="" value="<? echo $order["ship_zipcode"]; ?>"><br><span class="smallBlack">Zip Code</span></td>
												</tr>
												</table>
											</td>
										</tr>
										<?
										if ($devices != 0){
										?>
										<tr>
											<script>
											function CopyShip(){
												PushCustInfo.bill_address_1.value = PushCustInfo.ship_address_1.value;
												PushCustInfo.bill_address_2.value = PushCustInfo.ship_address_2.value;
												PushCustInfo.bill_city.value = PushCustInfo.ship_city.value;
												PushCustInfo.bill_state.value = PushCustInfo.ship_state.value;
												PushCustInfo.bill_zipcode.value = PushCustInfo.ship_zipcode.value;
											return;
											}
											</script>
											<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Billing Address:<br><span class="smallBlack"><a href="javascript:CopyShip();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Shipping Address</strong></a></span></td>
											<td>
												<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="bill_address_1" id="bill_address_1" size="30" maxlength="50" tabindex="9" class="bodyBlack" style="" value="<? echo $order["bill_address_1"]; ?>"></td>
													<td colspan="2"><input type="text" name="bill_address_2" id="bill_address_2" size="30" maxlength="50" tabindex="10" class="bodyBlack" style="" value="<? echo $order["bill_address_2"]; ?>"></td>
												</tr>
												<tr>
													<td><input type="text" name="bill_city" id="bill_city" size="30" maxlength="50" tabindex="11" class="bodyBlack" style="" value="<? echo $order["bill_city"]; ?>"><br><span class="smallBlack">City</td>
													<td>
														<select name="bill_state" id="bill_state" tabindex="12" class="bodyBlack" style="">
															<option value="">Select</option>
											                <option value="AL"<? echo iif($order["bill_state"] == "AL", " selected", ""); ?>>AL</option>
															<option value="AK"<? echo iif($order["bill_state"] == "AK", " selected", ""); ?>>AK</option>
															<option value="AZ"<? echo iif($order["bill_state"] == "AZ", " selected", ""); ?>>AZ</option>
															<option value="AR"<? echo iif($order["bill_state"] == "AR", " selected", ""); ?>>AR</option>
															<option value="CA"<? echo iif($order["bill_state"] == "CA", " selected", ""); ?>>CA</option>
															<option value="CO"<? echo iif($order["bill_state"] == "CO", " selected", ""); ?>>CO</option>
															<option value="CT"<? echo iif($order["bill_state"] == "CT", " selected", ""); ?>>CT</option>
															<option value="DE"<? echo iif($order["bill_state"] == "DE", " selected", ""); ?>>DE</option>
															<option value="DC"<? echo iif($order["bill_state"] == "DC", " selected", ""); ?>>DC</option>
															<option value="FL"<? echo iif($order["bill_state"] == "FL", " selected", ""); ?>>FL</option>
															<option value="GA"<? echo iif($order["bill_state"] == "GA", " selected", ""); ?>>GA</option>
															<option value="HI"<? echo iif($order["bill_state"] == "HI", " selected", ""); ?>>HI</option>
															<option value="ID"<? echo iif($order["bill_state"] == "ID", " selected", ""); ?>>ID</option>
															<option value="IL"<? echo iif($order["bill_state"] == "IL", " selected", ""); ?>>IL</option>
															<option value="IN"<? echo iif($order["bill_state"] == "IN", " selected", ""); ?>>IN</option>
															<option value="IA"<? echo iif($order["bill_state"] == "IA", " selected", ""); ?>>IA</option>
															<option value="KS"<? echo iif($order["bill_state"] == "KS", " selected", ""); ?>>KS</option>
															<option value="KY"<? echo iif($order["bill_state"] == "KY", " selected", ""); ?>>KY</option>
															<option value="LA"<? echo iif($order["bill_state"] == "LA", " selected", ""); ?>>LA</option>
															<option value="ME"<? echo iif($order["bill_state"] == "ME", " selected", ""); ?>>ME</option>
															<option value="MD"<? echo iif($order["bill_state"] == "MD", " selected", ""); ?>>MD</option>
															<option value="MA"<? echo iif($order["bill_state"] == "MA", " selected", ""); ?>>MA</option>
															<option value="MI"<? echo iif($order["bill_state"] == "MI", " selected", ""); ?>>MI</option>
															<option value="MN"<? echo iif($order["bill_state"] == "MN", " selected", ""); ?>>MN</option>
															<option value="MS"<? echo iif($order["bill_state"] == "MS", " selected", ""); ?>>MS</option>
															<option value="MO"<? echo iif($order["bill_state"] == "MO", " selected", ""); ?>>MO</option>
															<option value="MT"<? echo iif($order["bill_state"] == "MT", " selected", ""); ?>>MT</option>
															<option value="NE"<? echo iif($order["bill_state"] == "NE", " selected", ""); ?>>NE</option>
															<option value="NV"<? echo iif($order["bill_state"] == "NV", " selected", ""); ?>>NV</option>
															<option value="NH"<? echo iif($order["bill_state"] == "NH", " selected", ""); ?>>NH</option>
															<option value="NJ"<? echo iif($order["bill_state"] == "NJ", " selected", ""); ?>>NJ</option>
															<option value="NM"<? echo iif($order["bill_state"] == "NM", " selected", ""); ?>>NM</option>
															<option value="NY"<? echo iif($order["bill_state"] == "NY", " selected", ""); ?>>NY</option>
															<option value="NC"<? echo iif($order["bill_state"] == "NC", " selected", ""); ?>>NC</option>
															<option value="ND"<? echo iif($order["bill_state"] == "ND", " selected", ""); ?>>ND</option>
															<option value="OH"<? echo iif($order["bill_state"] == "OH", " selected", ""); ?>>OH</option>
															<option value="OK"<? echo iif($order["bill_state"] == "OK", " selected", ""); ?>>OK</option>
															<option value="OR"<? echo iif($order["bill_state"] == "OR", " selected", ""); ?>>OR</option>
															<option value="PA"<? echo iif($order["bill_state"] == "PA", " selected", ""); ?>>PA</option>
															<option value="RI"<? echo iif($order["bill_state"] == "RI", " selected", ""); ?>>RI</option>
															<option value="SC"<? echo iif($order["bill_state"] == "SC", " selected", ""); ?>>SC</option>
															<option value="SD"<? echo iif($order["bill_state"] == "SD", " selected", ""); ?>>SD</option>
															<option value="TN"<? echo iif($order["bill_state"] == "TN", " selected", ""); ?>>TN</option>
															<option value="TX"<? echo iif($order["bill_state"] == "TX", " selected", ""); ?>>TX</option>
															<option value="UT"<? echo iif($order["bill_state"] == "UT", " selected", ""); ?>>UT</option>
															<option value="VT"<? echo iif($order["bill_state"] == "VT", " selected", ""); ?>>VT</option>
															<option value="VA"<? echo iif($order["bill_state"] == "VA", " selected", ""); ?>>VA</option>
															<option value="WA"<? echo iif($order["bill_state"] == "WA", " selected", ""); ?>>WA</option>
															<option value="WV"<? echo iif($order["bill_state"] == "WV", " selected", ""); ?>>WV</option>
															<option value="WI"<? echo iif($order["bill_state"] == "WI", " selected", ""); ?>>WI</option>
															<option value="WY"<? echo iif($order["bill_state"] == "WY", " selected", ""); ?>>WY</option>
														</select>
														<br><span class="smallBlack">State</span>
													</td>
													<td><input type="text" name="bill_zipcode" id="bill_zipcode" size="10" maxlength="10" tabindex="13" class="bodyBlack" style="" value="<? echo $order["bill_zipcode"]; ?>"><br><span class="smallBlack">Zip Code</span></td>
												</tr>
												</table>
											</td>
										</tr>
										<?
										}
										?>
										<tr>
											<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Phone Numbers:</td>
											<td>
												<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="home_phone" id="home_phone" size="18" maxlength="13" tabindex="14" class="bodyBlack" style="" value="<? echo $order["home_phone"]; ?>"><br><span class="smallBlack">Home</span></td>
													<td><input type="text" name="alt_phone" id="alt_phone" size="18" maxlength="13" tabindex="15" class="bodyBlack" style="" value="<? echo $order["alt_phone"]; ?>"><br><span class="smallBlack">Alternate</span></td>
													<td><input type="text" name="carrier_phone" id="carrier_phone" size="18" maxlength="13" tabindex="16" class="bodyBlack" style="" value="<? echo $order["carrier_phone"]; ?>"><br><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.sprintpcs.com/support/help.html?helpID=158','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">Sprint PCS Number</a></span></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Email Address:</td>
											<td>
												<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="email" id="email" size="25" maxlength="50" tabindex="17" class="bodyBlack" style="" value="<? echo $order["email"]; ?>"></td>
													<td class="bigBlack">&nbsp;&nbsp;Confirm:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="email_confirm" id="email_confirm" size="25" maxlength="50" tabindex="18" class="bodyBlack" style="" value=""></td>
												</tr>
												</table>
											</td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									</td>
								</tr>
								<tr>
									<td bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								</table>
								<?
								if ($devices != 0){
								?>
								<br>
								<!-- Credit Approval Information -->
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<tr>
									<td colspan="3" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="688" bgcolor="<? echo $box_bg; ?>" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
												The following information will assist in verifying your identity.&nbsp;&nbsp;By providing this information, you consent to Sprint pulling your credit report to determine creditworthiness.&nbsp;&nbsp;This site is secured by C&middot;O&middot;M&middot;O&middot;D&middot;O.&nbsp;&nbsp;Encryption ensures that your confidential information will be securely transmitted to us.<br>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
								</tr>
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td height="20"><img src="images/spacer.gif" alt="" width="18" height="1" border="0"><strong>Credit Approval</strong></td>
								</tr>
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td>
										<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bigBlack">
										<tr>
											<td width="200" align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Social Security Number:</td>
											<td>
												<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="ssn" id="ssn" size="20" maxlength="11" tabindex="19" class="bodyBlack" style="" value="<? echo $order["ssn"]; ?>"><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.sprintpcs.com/support/help.html?helpID=160','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">Why do you need my SSN</a>?<br>Format: 555-55-5555</span></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Date of Birth:</td>
											<td>
												<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="dob" id="dob" size="30" maxlength="10" tabindex="20" class="bodyBlack" style="" value="<? echo $order["dob"]; ?>"><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.sprintpcs.com/support/help.html?helpID=162','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">Why do you need my date of birth</a>?<br>Format: mm/dd/yyyy</span></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Driver's License Number:</td>
											<td>
												<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="dl_num" id="dl_num" size="30" maxlength="50" tabindex="21" class="bodyBlack" style="" value="<? echo $order["dl_num"]; ?>"></td>
													<td class="bigBlack">&nbsp;&nbsp;State:<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
														<select name="dl_state" id="dl_state" tabindex="22" class="bodyBlack" style="">
															<option value="">Select</option>
											                <option value="AL"<? echo iif($order["dl_state"] == "AL", " selected", ""); ?>>AL</option>
															<option value="AK"<? echo iif($order["dl_state"] == "AK", " selected", ""); ?>>AK</option>
															<option value="AZ"<? echo iif($order["dl_state"] == "AZ", " selected", ""); ?>>AZ</option>
															<option value="AR"<? echo iif($order["dl_state"] == "AR", " selected", ""); ?>>AR</option>
															<option value="CA"<? echo iif($order["dl_state"] == "CA", " selected", ""); ?>>CA</option>
															<option value="CO"<? echo iif($order["dl_state"] == "CO", " selected", ""); ?>>CO</option>
															<option value="CT"<? echo iif($order["dl_state"] == "CT", " selected", ""); ?>>CT</option>
															<option value="DE"<? echo iif($order["dl_state"] == "DE", " selected", ""); ?>>DE</option>
															<option value="DC"<? echo iif($order["dl_state"] == "DC", " selected", ""); ?>>DC</option>
															<option value="FL"<? echo iif($order["dl_state"] == "FL", " selected", ""); ?>>FL</option>
															<option value="GA"<? echo iif($order["dl_state"] == "GA", " selected", ""); ?>>GA</option>
															<option value="HI"<? echo iif($order["dl_state"] == "HI", " selected", ""); ?>>HI</option>
															<option value="ID"<? echo iif($order["dl_state"] == "ID", " selected", ""); ?>>ID</option>
															<option value="IL"<? echo iif($order["dl_state"] == "IL", " selected", ""); ?>>IL</option>
															<option value="IN"<? echo iif($order["dl_state"] == "IN", " selected", ""); ?>>IN</option>
															<option value="IA"<? echo iif($order["dl_state"] == "IA", " selected", ""); ?>>IA</option>
															<option value="KS"<? echo iif($order["dl_state"] == "KS", " selected", ""); ?>>KS</option>
															<option value="KY"<? echo iif($order["dl_state"] == "KY", " selected", ""); ?>>KY</option>
															<option value="LA"<? echo iif($order["dl_state"] == "LA", " selected", ""); ?>>LA</option>
															<option value="ME"<? echo iif($order["dl_state"] == "ME", " selected", ""); ?>>ME</option>
															<option value="MD"<? echo iif($order["dl_state"] == "MD", " selected", ""); ?>>MD</option>
															<option value="MA"<? echo iif($order["dl_state"] == "MA", " selected", ""); ?>>MA</option>
															<option value="MI"<? echo iif($order["dl_state"] == "MI", " selected", ""); ?>>MI</option>
															<option value="MN"<? echo iif($order["dl_state"] == "MN", " selected", ""); ?>>MN</option>
															<option value="MS"<? echo iif($order["dl_state"] == "MS", " selected", ""); ?>>MS</option>
															<option value="MO"<? echo iif($order["dl_state"] == "MO", " selected", ""); ?>>MO</option>
															<option value="MT"<? echo iif($order["dl_state"] == "MT", " selected", ""); ?>>MT</option>
															<option value="NE"<? echo iif($order["dl_state"] == "NE", " selected", ""); ?>>NE</option>
															<option value="NV"<? echo iif($order["dl_state"] == "NV", " selected", ""); ?>>NV</option>
															<option value="NH"<? echo iif($order["dl_state"] == "NH", " selected", ""); ?>>NH</option>
															<option value="NJ"<? echo iif($order["dl_state"] == "NJ", " selected", ""); ?>>NJ</option>
															<option value="NM"<? echo iif($order["dl_state"] == "NM", " selected", ""); ?>>NM</option>
															<option value="NY"<? echo iif($order["dl_state"] == "NY", " selected", ""); ?>>NY</option>
															<option value="NC"<? echo iif($order["dl_state"] == "NC", " selected", ""); ?>>NC</option>
															<option value="ND"<? echo iif($order["dl_state"] == "ND", " selected", ""); ?>>ND</option>
															<option value="OH"<? echo iif($order["dl_state"] == "OH", " selected", ""); ?>>OH</option>
															<option value="OK"<? echo iif($order["dl_state"] == "OK", " selected", ""); ?>>OK</option>
															<option value="OR"<? echo iif($order["dl_state"] == "OR", " selected", ""); ?>>OR</option>
															<option value="PA"<? echo iif($order["dl_state"] == "PA", " selected", ""); ?>>PA</option>
															<option value="RI"<? echo iif($order["dl_state"] == "RI", " selected", ""); ?>>RI</option>
															<option value="SC"<? echo iif($order["dl_state"] == "SC", " selected", ""); ?>>SC</option>
															<option value="SD"<? echo iif($order["dl_state"] == "SD", " selected", ""); ?>>SD</option>
															<option value="TN"<? echo iif($order["dl_state"] == "TN", " selected", ""); ?>>TN</option>
															<option value="TX"<? echo iif($order["dl_state"] == "TX", " selected", ""); ?>>TX</option>
															<option value="UT"<? echo iif($order["dl_state"] == "UT", " selected", ""); ?>>UT</option>
															<option value="VT"<? echo iif($order["dl_state"] == "VT", " selected", ""); ?>>VT</option>
															<option value="VA"<? echo iif($order["dl_state"] == "VA", " selected", ""); ?>>VA</option>
															<option value="WA"<? echo iif($order["dl_state"] == "WA", " selected", ""); ?>>WA</option>
															<option value="WV"<? echo iif($order["dl_state"] == "WV", " selected", ""); ?>>WV</option>
															<option value="WI"<? echo iif($order["dl_state"] == "WI", " selected", ""); ?>>WI</option>
															<option value="WY"<? echo iif($order["dl_state"] == "WY", " selected", ""); ?>>WY</option>
														</select>
													</td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Driver's License Expiration:</td>
											<td>
												<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
												<tr>
													<td>
														<?
														$dl = explode("/", $order["dl_expiration"]);
														?>
														<select name="dl_exp_month" id="dl_exp_month" class="bodyBlack" style="width:125px;" tabindex="23">
															<option value="">Month</option>
															<option value="01"<? echo iif($dl[0] == "01", " selected", ""); ?>>(01) January</option>
															<option value="02"<? echo iif($dl[0] == "02", " selected", ""); ?>>(02) February</option>
															<option value="03"<? echo iif($dl[0] == "03", " selected", ""); ?>>(03) March</option>
															<option value="04"<? echo iif($dl[0] == "04", " selected", ""); ?>>(04) April</option>
															<option value="05"<? echo iif($dl[0] == "05", " selected", ""); ?>>(05) May</option>
															<option value="06"<? echo iif($dl[0] == "06", " selected", ""); ?>>(06) June</option>
															<option value="07"<? echo iif($dl[0] == "07", " selected", ""); ?>>(07) July</option>
															<option value="08"<? echo iif($dl[0] == "08", " selected", ""); ?>>(08) August</option>
															<option value="09"<? echo iif($dl[0] == "09", " selected", ""); ?>>(09) September</option>
															<option value="10"<? echo iif($dl[0] == "10", " selected", ""); ?>>(10) October</option>
															<option value="11"<? echo iif($dl[0] == "11", " selected", ""); ?>>(11) November</option>
															<option value="12"<? echo iif($dl[0] == "12", " selected", ""); ?>>(12) December</option>
														</select>
														<select name="dl_exp_day" id="dl_exp_day" class="bodyBlack" style="width:65px;" tabindex="24">
															<option value="">Day</option>
															<?
															for ($option=1; $option <= 31; $option++){
																echo'
															<option value="'.iif($option<10,"0","").$option.'"'.iif($dl[1] == iif($option<10,"0","").$option, " selected", "").'>'.iif($option<10,"0","").$option.'</option>
																';
															}
															?>
														</select>
														<select name="dl_exp_year" id="dl_exp_year" class="bodyBlack" style="width: 67px;" tabindex="25">
															<option value="">Year</option>
															<?
															echo'
															<option value="'.date("Y").'"'.iif($dl[2] == date("Y"), " selected", "").'>'.date("Y").'</option>
															<option value="'.(date("Y")+1).'"'.iif($dl[2] == (date("Y")+1), " selected", "").'>'.(date("Y")+1).'</option>
															<option value="'.(date("Y")+2).'"'.iif($dl[2] == (date("Y")+2), " selected", "").'>'.(date("Y")+2).'</option>
															<option value="'.(date("Y")+3).'"'.iif($dl[2] == (date("Y")+3), " selected", "").'>'.(date("Y")+3).'</option>
															<option value="'.(date("Y")+4).'"'.iif($dl[2] == (date("Y")+4), " selected", "").'>'.(date("Y")+4).'</option>
															<option value="'.(date("Y")+5).'"'.iif($dl[2] == (date("Y")+5), " selected", "").'>'.(date("Y")+5).'</option>
															<option value="'.(date("Y")+6).'"'.iif($dl[2] == (date("Y")+6), " selected", "").'>'.(date("Y")+6).'</option>
															<option value="'.(date("Y")+7).'"'.iif($dl[2] == (date("Y")+7), " selected", "").'>'.(date("Y")+7).'</option>
															<option value="'.(date("Y")+8).'"'.iif($dl[2] == (date("Y")+8), " selected", "").'>'.(date("Y")+8).'</option>
															<option value="'.(date("Y")+9).'"'.iif($dl[2] == (date("Y")+9), " selected", "").'>'.(date("Y")+9).'</option>
															';
															?>
														</select>
													</td>
												</tr>
												</table>
											</td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									</td>
								</tr>
								<tr>
									<td bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								</table>
								<?
								}
								?>
								<br>
								<!-- Credit Card Information -->
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<tr>
									<td colspan="3" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="688" bgcolor="<? echo $box_bg; ?>" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
												Please provide payment information<?=iif($devices > 0,' for the non-billed portions of this order.&nbsp;&nbsp;Must be paid by Credit Card.','.'); ?><br>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
								</tr>
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td height="20"><img src="images/spacer.gif" alt="" width="18" height="1" border="0"><strong>Credit Card Information</strong></td>
								</tr>
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bigBlack">
										<tr>
											<td width="200" align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br>Credit Card Type:&nbsp;&nbsp;</td>
											<td>
												<table border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
												<tr>
													<td>
														<select name="cc_type" id="cc_type" class="bodyBlack" style="width:140px;" tabindex="26">
															<option value="">Select Type of Card</option>
															<option value="Visa"<? echo iif($order["cc_type"] == "Visa", " selected", ""); ?>>Visa</option>
															<option value="MasterCard"<? echo iif($order["cc_type"] == "MasterCard", " selected", ""); ?>>MasterCard</option>
															<option value="American Express"<? echo iif($order["cc_type"] == "American Express", " selected", ""); ?>>American Express</option>
															<option value="Discover"<? echo iif($order["cc_type"] == "Discover", " selected", ""); ?>>Discover</option>
														</select>
													</td>
													<td align="right" class="bigBlack">&nbsp;&nbsp;Expiration:&nbsp;&nbsp;
														<?
														$exp = explode("/", $order["cc_expiration"]);
														?>
														<select name="exp_month" id="exp_month" class="bodyBlack" style="width:125px;" tabindex="27">
															<option value="">Month</option>
															<option value="01"<? echo iif($exp[0] == "01", " selected", ""); ?>>(01) January</option>
															<option value="02"<? echo iif($exp[0] == "02", " selected", ""); ?>>(02) February</option>
															<option value="03"<? echo iif($exp[0] == "03", " selected", ""); ?>>(03) March</option>
															<option value="04"<? echo iif($exp[0] == "04", " selected", ""); ?>>(04) April</option>
															<option value="05"<? echo iif($exp[0] == "05", " selected", ""); ?>>(05) May</option>
															<option value="06"<? echo iif($exp[0] == "06", " selected", ""); ?>>(06) June</option>
															<option value="07"<? echo iif($exp[0] == "07", " selected", ""); ?>>(07) July</option>
															<option value="08"<? echo iif($exp[0] == "08", " selected", ""); ?>>(08) August</option>
															<option value="09"<? echo iif($exp[0] == "09", " selected", ""); ?>>(09) September</option>
															<option value="10"<? echo iif($exp[0] == "10", " selected", ""); ?>>(10) October</option>
															<option value="11"<? echo iif($exp[0] == "11", " selected", ""); ?>>(11) November</option>
															<option value="12"<? echo iif($exp[0] == "12", " selected", ""); ?>>(12) December</option>
														</select>
														<select name="exp_year" id="exp_year" class="bodyBlack" style="width:67px;" tabindex="28">
															<option value="">Year</option>
															<?
															echo'
															<option value="'.date("Y").'"'.iif($exp[1] == date("Y"), " selected", "").'>'.date("Y").'</option>
															<option value="'.(date("Y")+1).'"'.iif($exp[1] == (date("Y")+1), " selected", "").'>'.(date("Y")+1).'</option>
															<option value="'.(date("Y")+2).'"'.iif($exp[1] == (date("Y")+2), " selected", "").'>'.(date("Y")+2).'</option>
															<option value="'.(date("Y")+3).'"'.iif($exp[1] == (date("Y")+3), " selected", "").'>'.(date("Y")+3).'</option>
															<option value="'.(date("Y")+4).'"'.iif($exp[1] == (date("Y")+4), " selected", "").'>'.(date("Y")+4).'</option>
															<option value="'.(date("Y")+5).'"'.iif($exp[1] == (date("Y")+5), " selected", "").'>'.(date("Y")+5).'</option>
															<option value="'.(date("Y")+6).'"'.iif($exp[1] == (date("Y")+6), " selected", "").'>'.(date("Y")+6).'</option>
															<option value="'.(date("Y")+7).'"'.iif($exp[1] == (date("Y")+7), " selected", "").'>'.(date("Y")+7).'</option>
															<option value="'.(date("Y")+8).'"'.iif($exp[1] == (date("Y")+8), " selected", "").'>'.(date("Y")+8).'</option>
															<option value="'.(date("Y")+9).'"'.iif($exp[1] == (date("Y")+9), " selected", "").'>'.(date("Y")+9).'</option>
															';
															?>
														</select>
													</td>
												</tr>
												</table>
												<img src="images/spacer.gif" alt="" width="1" height="8" border="0"><br>
											</td>
										</tr>
										<tr>
											<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>Credit Card Number:&nbsp;&nbsp;</td>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="6" border="0"><br>
												<table border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="cc_num" id="cc_num" size="30" maxlength="25" tabindex="29" class="bodyBlack" style="" value="<? echo $order["cc_num"]; ?>" onkeypress="return onlyNumbers(event)"><br><span class="smallBlack">Numbers Only</span></td>
													</td>
													<td valign="top" class="bigBlack">&nbsp;&nbsp;Credit Card CID:&nbsp;&nbsp;<input type="text" name="cc_cid" id="cc_cid" size="5" maxlength="5" tabindex="30" class="bodyBlack" style="" value="<? echo $order["cc_cid"]; ?>" onkeypress="return onlyNumbers(event)"><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.<? $domain; ?>/cid_<? echo $carrier_label; ?>.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">What is this</a>?</span>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br>Name On Credit Card:&nbsp;&nbsp;</td>
											<td>
												<table border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
												<tr>
													<td><input type="text" name="cc_name" id="cc_name" size="30" maxlength="50" tabindex="31" class="bodyBlack" style="" value="<? echo $order["cc_name"]; ?>"> <span class="smallBlack">(Exactly as it appears on the card.)</span></td>
													</td>
												</tr>
												</table>
												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
											</td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									</td>
								</tr>
								<tr>
									<td bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								</table>
								<br>
								<input type="hidden" name="task" value="addcustinfo">
<!--								<input type="hidden" name="record_id" value="<? echo $item["record_id"]; ?>">-->
								<input type="hidden" name="sid" value="<? echo $SID; ?>">
								<div align="center"><input type="image" src="images/ContinueButton.gif"></div>
								</form>
								<?
								}
								?>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
<!--				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>-->
			</td>
		</tr>
		<tr>
			<td><img src="images/InfoFooter.jpg" alt="" width="710" height="10" border="0"></td>
		</tr>
		</table>					
	</td>
</tr>
</table>

<!-- END Include checkout.php -->
