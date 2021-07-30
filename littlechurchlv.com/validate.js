// Reservation Form Validation

function validate(theForm){
// Step 1
	if (theForm.name == "Step1u" || theForm.name == "Step1i"){
	// Name
		if (theForm.ResName.value == ""){
			theForm.ResName.style.background="#FF0000";
			alert("Please Enter Your Name");
			theForm.ResName.style.background="#ECEADC";
			theForm.ResName.focus();
			return false;
		}
	// Relationship
		if (theForm.ResRelation.value == ""){
			theForm.ResRelation.style.background="#FF0000";
			alert("Please Select Your Relationship");
			theForm.ResRelation.style.background="#ECEADC";
			theForm.ResRelation.focus();
			return false;
		}
	// Email
		if (theForm.ResEmail.value == ""){
			theForm.ResEmail.style.background="#FF0000";
			alert("Please Enter Your Email Address");
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for "@"
 		if (theForm.ResEmail.value.indexOf("@") == -1) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Must Contain an "@"');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for "@" as first char.
 		if (theForm.ResEmail.value.indexOf("@") == 0) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Cannot Start With a "@"');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for anything after "@"
 		if (theForm.ResEmail.value.length == (theForm.ResEmail.value.indexOf("@")+1)) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Must Contain a Domain Name After the "@"');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for multiple "@"
 		if (theForm.ResEmail.value.substring((theForm.ResEmail.value.indexOf("@")+1),theForm.ResEmail.value.length).indexOf("@") != -1) {
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Must Contain Only One "@"');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for "."
 		if (theForm.ResEmail.value.indexOf(".") == -1) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Must Contain a "."');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for "." as first char.
 		if (theForm.ResEmail.value.indexOf(".") == 0) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Cannot Start With a "."');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for ".."
 		if (theForm.ResEmail.value.indexOf("..") != -1) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Must Not Contain Adjacent Dots ("..")');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for "." adjacent to "@"
 		if (theForm.ResEmail.value.indexOf(".@") != -1 || theForm.ResEmail.value.indexOf("@.") != -1) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for TLD
 		if (theForm.ResEmail.value.length == (theForm.ResEmail.value.indexOf(".")+1)) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for TLD at least 2 char.
		var domain = theForm.ResEmail.value.substring((theForm.ResEmail.value.indexOf("@")+1),theForm.ResEmail.value.length);
		if (domain.length - (domain.indexOf(".")+1) < 2) {
			theForm.ResEmail.style.background="#FF0000";
			alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for TLD over 3 char.
//		if (domain.length - (domain.indexOf(".")+1) > 3) {
//			theForm.ResEmail.style.background="#FF0000";
//			alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//			theForm.ResEmail.style.background="#ECEADC";
//			theForm.ResEmail.focus();
//			return false;
//		}
		// Check for "_" in TLD
		if (theForm.ResEmail.value.indexOf("_") > theForm.ResEmail.value.indexOf("@")) {
			theForm.ResEmail.style.background="#FF0000";
			alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for spaces
 		if (theForm.ResEmail.value.indexOf(" ") != -1) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Must Not Contain Any Spaces (" ")');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
		// Check for illegal char.
		var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
 		if (email_regex.test(theForm.ResEmail.value) == false) { 
			theForm.ResEmail.style.background="#FF0000";
			alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
			theForm.ResEmail.style.background="#ECEADC";
			theForm.ResEmail.focus();
			return false;
		}
	// Phone
		// USA & Canada
		if (theForm.name == "Step1u"){
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.ResHomePhone.value) == false && phone2_regex.test(theForm.ResHomePhone.value) == false) { 
				theForm.ResHomePhone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.ResHomePhone.style.background="#ECEADC";
				theForm.ResHomePhone.focus();
				return false;
			}
		// International
		}else if (theForm.name == "Step1i"){
			if (theForm.ResHomePhone.value == ""){
				theForm.ResHomePhone.style.background="#FF0000";
				alert("Please Enter Your Phone Number");
				theForm.ResHomePhone.style.background="#ECEADC";
				theForm.ResHomePhone.focus();
				return false;
			}
		}		
	// Address
		if (theForm.ResAddress.value == ""){
			theForm.ResAddress.style.background="#FF0000";
			theForm.ResAddress2.style.background="#FF0000";
			alert("Please Enter Your Address");
			theForm.ResAddress.style.background="#ECEADC";
			theForm.ResAddress2.style.background="#ECEADC";
			theForm.ResAddress.focus();
			return false;
		}
	// City
		if (theForm.ResCity.value == ""){
			theForm.ResCity.style.background="#FF0000";
			alert("Please Enter Your City");
			theForm.ResCity.style.background="#ECEADC";
			theForm.ResCity.focus();
			return false;
		}
	// State/Province
		// USA & Canada
		if (theForm.name == "Step1u"){
			if (theForm.ResState.value == ""){
				theForm.ResState.style.background="#FF0000";
				alert("Please Select Your State/Province");
				theForm.ResState.style.background="#ECEADC";
				theForm.ResState.focus();
				return false;
			}
		}
	// Zip/Postal Code
		// USA & Canada
		if (theForm.name == "Step1u"){
			if (theForm.ResZip.value == ""){
				theForm.ResZip.style.background="#FF0000";
				alert("Please Select Your Zip/Postal Code");
				theForm.ResZip.style.background="#ECEADC";
				theForm.ResZip.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
 			if (usa_regex.test(theForm.ResZip.value) == false && cdn_regex.test(theForm.ResZip.value) == false) { 
				theForm.ResZip.style.background="#FF0000";
				alert('Please Enter a Valid Zip/Postal Code as "NNNNN" or "NNNNN-NNNN" (USA) or "ANA NAN" (CDN)');
				theForm.ResZip.style.background="#ECEADC";
				theForm.ResZip.focus();
				return false;
			}
		}
	// Country
		// International
		if (theForm.name == "Step1i"){
			if (theForm.ResCountry.value == ""){
				theForm.ResCountry.style.background="#FF0000";
				alert("Please Select Your Country");
				theForm.ResCountry.style.background="#ECEADC";
				theForm.ResCountry.focus();
				return false;
			}
		}
	}
// Step 2
	if (theForm.name == "Step2"){
	// Bride's Name
		if (theForm.Bride.value == ""){
			theForm.Bride.style.background="#FF0000";
			alert("Please Enter The Bride's Full Name");
			theForm.Bride.style.background="#ECEADC";
			theForm.Bride.focus();
			return false;
		}
	// Groom's Name
		if (theForm.Groom.value == ""){
			theForm.Groom.style.background="#FF0000";
			alert("Please Enter The Groom's Full Name");
			theForm.Groom.style.background="#ECEADC";
			theForm.Groom.focus();
			return false;
		}
	// Reservation Month
		if (theForm.ResMonth.value == ""){
			theForm.ResMonth.style.background="#FF0000";
			alert("Please Select The Reservation Month");
			theForm.ResMonth.style.background="#ECEADC";
			theForm.ResMonth.focus();
			return false;
		}
	// Reservation Day
		if (theForm.ResDay.value == ""){
			theForm.ResDay.style.background="#FF0000";
			alert("Please Select The Reservation Day");
			theForm.ResDay.style.background="#ECEADC";
			theForm.ResDay.focus();
			return false;
		}
	// Reservation Year
		if (theForm.ResYear.value == ""){
			theForm.ResYear.style.background="#FF0000";
			alert("Please Select The Reservation Year");
			theForm.ResYear.style.background="#ECEADC";
			theForm.ResYear.focus();
			return false;
		}
	// Reservation Date Today
		targetDate = theForm.ResMonth.value + " " + theForm.ResDay.value + ", " + theForm.ResYear.value;
		if (targetDate == formatDate(new Date(),'MMM d, y')){
			theForm.ResMonth.style.background="#FF0000";
			theForm.ResDay.style.background="#FF0000";
			theForm.ResYear.style.background="#FF0000";
			alert("The Selected Date Is Today - Please Call The Chapel To Make Your Reservation");
			theForm.ResMonth.style.background="#ECEADC";
			theForm.ResDay.style.background="#ECEADC";
			theForm.ResYear.style.background="#ECEADC";
			theForm.ResMonth.focus();
			return false;
		}
	// Reservation Date In The Future
//		targetDate = theForm.ResMonth.value + " " + theForm.ResDay.value + ", " + theForm.ResYear.value;
		if (compareDates(targetDate,"MMM d, y",formatDate(new Date(),'MMM d, y'),"MMM d, y") == 0){
			theForm.ResMonth.style.background="#FF0000";
			theForm.ResDay.style.background="#FF0000";
			theForm.ResYear.style.background="#FF0000";
			alert("The Selected Date Is In The Past");
			theForm.ResMonth.style.background="#ECEADC";
			theForm.ResDay.style.background="#ECEADC";
			theForm.ResYear.style.background="#ECEADC";
			theForm.ResMonth.focus();
			return false;
		}
	// Reservation Day Not M-TH for Gazebo Ceremony
		MM = -1;
		if (theForm.ResMonth.value.toUpperCase().indexOf("JAN") !=-1) MM = 0;
		if (theForm.ResMonth.value.toUpperCase().indexOf("FEB") !=-1) MM = 1;
		if (theForm.ResMonth.value.toUpperCase().indexOf("MAR") !=-1) MM = 2;
		if (theForm.ResMonth.value.toUpperCase().indexOf("APR") !=-1) MM = 3;
		if (theForm.ResMonth.value.toUpperCase().indexOf("MAY") !=-1) MM = 4;
		if (theForm.ResMonth.value.toUpperCase().indexOf("JUN") !=-1) MM = 5;
		if (theForm.ResMonth.value.toUpperCase().indexOf("JUL") !=-1) MM = 6;
		if (theForm.ResMonth.value.toUpperCase().indexOf("AUG") !=-1) MM = 7;
		if (theForm.ResMonth.value.toUpperCase().indexOf("SEP") !=-1) MM = 8;
		if (theForm.ResMonth.value.toUpperCase().indexOf("OCT") !=-1) MM = 9;
		if (theForm.ResMonth.value.toUpperCase().indexOf("NOV") !=-1) MM = 10;
		if (theForm.ResMonth.value.toUpperCase().indexOf("DEC") !=-1) MM = 11;
		d=new Date();
		d.setDate(1);
		d.setMonth(MM);
		d.setDate(theForm.ResDay.value);
		d.setYear(theForm.ResYear.value);
		if (theForm.ResPackagedDesired.value == "Garden Ceremony for $375.00" && (d.getDay() < 1 || d.getDay() > 4)){
			var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
			theForm.ResMonth.style.background="#FF0000";
			theForm.ResDay.style.background="#FF0000";
			theForm.ResYear.style.background="#FF0000";
			theForm.ResPackagedDesired.style.background="#FF0000";
			alert("Garden Ceremonies Are Performed Monday-Thursday, 10:00 AM To 3:00 PM.\n\rThe Date You Selected Falls On A " + dayNames[d.getDay()] + " - Please Select A Different Date");
			theForm.ResMonth.style.background="#ECEADC";
			theForm.ResDay.style.background="#ECEADC";
			theForm.ResYear.style.background="#ECEADC";
			theForm.ResPackagedDesired.style.background="#ECEADC";
			theForm.ResMonth.focus();
			return false;
		}
	// Reservation Time Slot
		if (theForm.ResTimeFrom.value == ""){
			theForm.ResTimeFrom.style.background="#FF0000";
			alert("Please Select The Reservation Time Slot");
			theForm.ResTimeFrom.style.background="#ECEADC";
			theForm.ResTimeFrom.focus();
			return false;
		}
	// Reservation Time Not 10a-3p for Gazebo Ceremony
		if (theForm.ResPackagedDesired.value == "Garden Ceremony for $375.00" && (d.getDay() > 0 && d.getDay() < 5)){
			if (theForm.ResTimeFrom.value != "10:00 AM" &&
				theForm.ResTimeFrom.value != "10:30 AM" &&
				theForm.ResTimeFrom.value != "11:00 AM" &&
				theForm.ResTimeFrom.value != "11:30 AM" &&
				theForm.ResTimeFrom.value != "12:00 PM" &&
				theForm.ResTimeFrom.value != "12:30 PM" &&
				theForm.ResTimeFrom.value != "1:00 PM" &&
				theForm.ResTimeFrom.value != "1:30 PM" &&
				theForm.ResTimeFrom.value != "2:00 PM" &&
				theForm.ResTimeFrom.value != "2:30 PM" &&
				theForm.ResTimeFrom.value != "3:00 PM"){
				theForm.ResTimeFrom.style.background="#FF0000";
				theForm.ResPackagedDesired.style.background="#FF0000";
				alert("Garden Ceremonies Are Performed Monday-Thursday, 10:00 AM To 3:00 PM.\n\rThe Time You Selected Is " + theForm.ResTimeFrom.value + " - Please Select A Different Time");
				theForm.ResTimeFrom.style.background="#ECEADC";
				theForm.ResPackagedDesired.style.background="#ECEADC";
				theForm.ResMonth.focus();
				return false;
			}
		}
	// SPECIAL - don't allow reservations on 10/10/10
		targetDate = theForm.ResMonth.value + " " + theForm.ResDay.value + ", " + theForm.ResYear.value;
//alert(targetDate);
		if (targetDate == "October 10, 2010"){ //Should make these restrictions data driven......
			theForm.ResMonth.style.background="#FF0000";
			theForm.ResDay.style.background="#FF0000";
			theForm.ResYear.style.background="#FF0000";
			alert("We're Sorry, All Slots Are Sold Out For This Day,  Please Call The Chapel For Assistance");
			theForm.ResMonth.style.background="#ECEADC";
			theForm.ResDay.style.background="#ECEADC";
			theForm.ResYear.style.background="#ECEADC";
			theForm.ResMonth.focus();
			return false;
		}
/*
	// SPECIAL - don't allow Let's Elope on 10/10/10
		targetDate = theForm.ResMonth.value + " " + theForm.ResDay.value + ", " + theForm.ResYear.value;
//alert(targetDate);
//		if (theForm.ResPackagedDesired.value == "Let's Elope for $199.00" && targetDate == formatDate('Oct 10, 2010','MMM d, y')){
		if (theForm.ResPackagedDesired.value == "Let's Elope for $199.00" && (targetDate == "October 10, 2010" || targetDate == "February 14, 2011")){ //need to drop year from Valentines Day restriction.  Should make these restrictions data driven......
			theForm.ResMonth.style.background="#FF0000";
			theForm.ResDay.style.background="#FF0000";
			theForm.ResYear.style.background="#FF0000";
			alert("We're Sorry, the 'Let's Elope' Package Is Sold Out For This Day");
			theForm.ResMonth.style.background="#ECEADC";
			theForm.ResDay.style.background="#ECEADC";
			theForm.ResYear.style.background="#ECEADC";
			theForm.ResMonth.focus();
			return false;
		}
	// Reservation Time Not 10a-3p for Let's Elope Package
//		if (theForm.ResPackagedDesired.value == "Let's Elope for $199.00" && (d.getDay() > 0 && d.getDay() < 5)){
		if (theForm.ResPackagedDesired.value == "Let's Elope for $199.00"){
			if (theForm.ResTimeFrom.value != "10:00 AM" &&
				theForm.ResTimeFrom.value != "10:30 AM" &&
				theForm.ResTimeFrom.value != "11:00 AM" &&
				theForm.ResTimeFrom.value != "11:30 AM" &&
				theForm.ResTimeFrom.value != "12:00 PM" &&
				theForm.ResTimeFrom.value != "12:30 PM" &&
				theForm.ResTimeFrom.value != "1:00 PM" &&
				theForm.ResTimeFrom.value != "1:30 PM" &&
				theForm.ResTimeFrom.value != "2:00 PM" &&
				theForm.ResTimeFrom.value != "2:30 PM" &&
				theForm.ResTimeFrom.value != "3:00 PM"){
				theForm.ResTimeFrom.style.background="#FF0000";
				theForm.ResPackagedDesired.style.background="#FF0000";
				alert("'Let's Elope' Ceremonies Are Performed From 10:00 AM To 3:00 PM.\n\rThe Time You Selected Is " + theForm.ResTimeFrom.value + " - Please Select A Different Time");
				theForm.ResTimeFrom.style.background="#ECEADC";
				theForm.ResPackagedDesired.style.background="#ECEADC";
				theForm.ResMonth.focus();
				return false;
			}
		}
*/
	// Wedding Package
		if (theForm.ResPackagedDesired.value == ""){
			theForm.ResPackagedDesired.style.background="#FF0000";
			alert("Please Select A Wedding Package");
			theForm.ResPackagedDesired.style.background="#ECEADC";
			theForm.ResPackagedDesired.focus();
			return false;
		}
	// Wedding Type
		if (theForm.ResPackageType.value == ""){
			theForm.ResPackageType.style.background="#FF0000";
			alert("Please Select A Ceremony Type");
			theForm.ResPackageType.style.background="#ECEADC";
			theForm.ResPackageType.focus();
			return false;
		}
	// Wedding Style
		if (theForm.ResServiceType.value == ""){
			theForm.ResServiceType.style.background="#FF0000";
			alert("Please Select A Service Type");
			theForm.ResServiceType.style.background="#ECEADC";
			theForm.ResServiceType.focus();
			return false;
		}
	// Ceremony Language
		if (theForm.ResServiceLanguage.value == ""){
			theForm.ResServiceLanguage.style.background="#FF0000";
			alert("Please Select A Language For Your Ceremony");
			theForm.ResServiceLanguage.style.background="#ECEADC";
			theForm.ResServiceLanguage.focus();
			return false;
		}


//if (theForm.Bride.value == "s"){
//	alert(theForm.ResPackagedDesired.value);
//}





	// Number of Guests
		if (theForm.ResGuests.value == ""){
			theForm.ResGuests.style.background="#FF0000";
			alert("Please Enter The Number Of Guests Who Will Be In Attendance");
			theForm.ResGuests.style.background="#ECEADC";
			theForm.ResGuests.focus();
			return false;
		}
//		if (theForm.ResPackagedDesired.value == "Let's Tie the Knot Package for $375.00" && theForm.ResGuests.value > 30){
//			theForm.ResGuests.style.background="#FF0000";
//			alert('The Maximum Number Of Guests With The "Let\'s Tie the Knot" Package is 30');
//			theForm.ResGuests.style.background="#ECEADC";
//			theForm.ResGuests.focus();
//			return false;
//		}
//		if (theForm.ResPackagedDesired.value == "Let's Elope for $199.00" && theForm.ResGuests.value > 10){
//			theForm.ResGuests.style.background="#FF0000";
//			alert('The Maximum Number Of Guests With The "Let\'s Elope" Package is 10');
//			theForm.ResGuests.style.background="#ECEADC";
//			theForm.ResGuests.focus();
//			return false;
//		}
//		if (theForm.ResPackagedDesired.value == "Garden Ceremony for $375.00" && theForm.ResGuests.value > 10){
//			theForm.ResGuests.style.background="#FF0000";
//			alert('The Maximum Number Of Guests With The "Garden Ceremony" Package is 10');
//			theForm.ResGuests.style.background="#ECEADC";
//			theForm.ResGuests.focus();
//			return false;
//		}
		// All other packages...
		if (theForm.ResGuests.value > 75){
			theForm.ResGuests.style.background="#FF0000";
			alert("The Chapel's Maximum Capacity is 75 Guests");
			theForm.ResGuests.style.background="#ECEADC";
			theForm.ResGuests.focus();
			return false;
		}
	// Flower Color
		if (!theForm.ResFlowerColor.disabled){
			if (theForm.ResFlowerColor.value == ""){
				theForm.ResFlowerColor.style.background="#FF0000";
				alert("Please Enter Your Preferred Flower Color(s)");
				theForm.ResFlowerColor.style.background="#ECEADC";
				theForm.ResFlowerColor.focus();
				return false;
			}
		}
	// Flower Style
		if (!theForm.ResFlowerStyle.disabled){
			if (theForm.ResFlowerStyle.value == ""){
				theForm.ResFlowerStyle.style.background="#FF0000";
				alert("Please Enter Your Preferred Bride's Bouquet Style");
				theForm.ResFlowerStyle.style.background="#ECEADC";
				theForm.ResFlowerStyle.focus();
				return false;
			}
		}
	// Lodging
//		if (theForm.ResHotel.value == ""){
//			theForm.ResHotel.style.background="#FF0000";
//			alert("Please Enter Your Lodging Location");
//			theForm.ResHotel.style.background="#ECEADC";
//			theForm.ResHotel.focus();
//			return false;
//		}

		if (theForm.ResDVD.checked == true){
			if (theForm.ResDVDQty.value == "" || theForm.ResDVDQty.value < 1){
				theForm.ResDVDQty.style.background="#FF0000";
				alert("Please Enter The Number Of Additional DVDs You Would Like");
				theForm.ResDVDQty.style.background="#ECEADC";
				theForm.ResDVDQty.focus();
				return false;
			}

		}
	}
// Step 3
	if (theForm.name == "Step3"){
//alert(theForm.ResPhonePaymentInfo.checked);
//return false;
	// If They Opted To Call Info In
		if (theForm.ResPhonePaymentInfo.checked == true){
			alert("Please Call The Chapel To Arrange Payment");
			theForm.ResCreditCardType.value="";
			theForm.ResCreditCardName.value="";
			theForm.ResCreditCardNumber.value="";
			theForm.ResCreditCardCID.value="";
			theForm.ExpMonth.value="";
			theForm.ExpYear.value="";
			theForm.ResCreditCardZip.value="";
			theForm.ResPhonePaymentInfo.value="Yes";
			return true;
	// ...Otherwise
		}else{
		// Credit Card Type
			if (theForm.ResCreditCardType.value == ""){
				theForm.ResCreditCardType.style.background="#FF0000";
				alert("Please Select Credit Card Type");
				theForm.ResCreditCardType.style.background="#ECEADC";
				theForm.ResCreditCardType.focus();
				return false;
			}
		// Name On Credit Card
			if (theForm.ResCreditCardName.value == ""){
				theForm.ResCreditCardName.style.background="#FF0000";
				alert("Please Enter The Name On The Credit Card");
				theForm.ResCreditCardName.style.background="#ECEADC";
				theForm.ResCreditCardName.focus();
				return false;
			}
		// Credit Card Number
			if (theForm.ResCreditCardNumber.value == ""){
				theForm.ResCreditCardNumber.style.background="#FF0000";
				alert("Please Enter The Credit Card Number");
				theForm.ResCreditCardNumber.style.background="#ECEADC";
				theForm.ResCreditCardNumber.focus();
				return false;
			}
			// Verify Card Number Form
			switch(theForm.ResCreditCardType.value){
				// Visa
				case 'Visa':
				// 13 or 16 Digits Starting With "4"
					var prefix = parseInt(theForm.ResCreditCardNumber.value.substring(0,1));
					if ((theForm.ResCreditCardNumber.value.length != 13 && theForm.ResCreditCardNumber.value.length != 16) || prefix != 4){
						theForm.ResCreditCardNumber.style.background="#FF0000";
						alert("Please Enter A Valid Visa Card Number");
						theForm.ResCreditCardNumber.style.background="#ECEADC";
						theForm.ResCreditCardNumber.focus();
						return false;
					}
 					break;
				// Mastercard
				case 'MasterCard':
				// 16 Digits Starting With Ranging From "51" to "55"
					var prefix = parseInt(theForm.ResCreditCardNumber.value.substring(0,2));
					if (theForm.ResCreditCardNumber.value.length != 16 || (prefix < 51 || prefix > 55)){
						theForm.ResCreditCardNumber.style.background="#FF0000";
						alert("Please Enter A Valid MasterCard Number");
						theForm.ResCreditCardNumber.style.background="#ECEADC";
						theForm.ResCreditCardNumber.focus();
						return false;
					}
 					break;
				// Amex
				case 'American Express':
				// 15 Digits Starting With "34" or "37"
					var prefix = parseInt(theForm.ResCreditCardNumber.value.substring(0,2));
					if (theForm.ResCreditCardNumber.value.length != 15 || (prefix != 34 && prefix != 37)){
						theForm.ResCreditCardNumber.style.background="#FF0000";
						alert("Please Enter A Valid American Express Card Number");
						theForm.ResCreditCardNumber.style.background="#ECEADC";
						theForm.ResCreditCardNumber.focus();
						return false;
					}
					break;
				// Discover (Future?)
				case 'Discover':
				// 16 Digits Starting With "6011"
					var prefix = parseInt(theForm.ResCreditCardNumber.value.substring(0,4));
					if (theForm.ResCreditCardNumber.value.length != 16 || prefix != 6011){
						theForm.ResCreditCardNumber.style.background="#FF0000";
						alert("Please Enter A Valid Discover Card Number");
						theForm.ResCreditCardNumber.style.background="#ECEADC";
						theForm.ResCreditCardNumber.focus();
						return false;
					}
 					break;
			}
			// Verify Card Number Against Check Digit Using MOD10
			var ar = new Array(theForm.ResCreditCardNumber.value.length);
			var i = 0,sum = 0;
			for(i = 0; i < theForm.ResCreditCardNumber.value.length; ++i){
				ar[i] = parseInt(theForm.ResCreditCardNumber.value.charAt(i));
			}
			for(i = ar.length -2; i >= 0; i-=2){	// you have to start from the right, and work back.
				ar[i] *= 2;							// every second digit starting with the right most (check digit)
				if(ar[i] > 9) ar[i]-=9;				// will be doubled, and summed with the skipped digits.
			}										// if the double digit is > 9, ADD those individual digits together 
			for(i = 0; i < ar.length; ++i){
				sum += ar[i];
			}
			if ((sum%10)!=0){						// if the sum is not evenly divisible by 10 it fails
				theForm.ResCreditCardNumber.style.background="#FF0000";
				alert("Please Enter A Valid Credit Card Number");
				theForm.ResCreditCardNumber.style.background="#ECEADC";
				theForm.ResCreditCardNumber.focus();
				return false;
			}
		// Credit Card CID
			if (theForm.ResCreditCardCID.value == ""){
				theForm.ResCreditCardCID.style.background="#FF0000";
				alert("Please Enter The Credit Card CID Security Code");
				theForm.ResCreditCardCID.style.background="#ECEADC";
				theForm.ResCreditCardCID.focus();
				return false;
			}
		// Expiration Month
			if (theForm.ExpMonth.value == ""){
				theForm.ExpMonth.style.background="#FF0000";
				alert("Please Select The Credit Card Expiration Month");
				theForm.ExpMonth.style.background="#ECEADC";
				theForm.ExpMonth.focus();
				return false;
			}
		// Expiration Year
			if (theForm.ExpYear.value == ""){
				theForm.ExpYear.style.background="#FF0000";
				alert("Please Select The Credit Card Expiration Year");
				theForm.ExpYear.style.background="#ECEADC";
				theForm.ExpYear.focus();
				return false;
			}
		// Expiration Date Passed?
			var expires = new Date(theForm.ExpYear.value,theForm.ExpMonth.value,0,0,0);
 			if (compareDates(formatDate(expires,'MMM d, y'),"MMM d, y",formatDate(new Date(),'MMM d, y'),"MMM d, y")== 0){
				theForm.ExpMonth.style.background="#FF0000";
				theForm.ExpYear.style.background="#FF0000";
				alert("The Expiration Date You Entered Indicates That The Credit Card Is Expired");
				theForm.ExpMonth.style.background="#ECEADC";
				theForm.ExpMonth.focus();
				return false;
			}
		// Credit Card Billing Zipcode
		// Force for USA Only
			if (theForm.Country.value == "USA"){
				if (theForm.ResCreditCardZip.value == ""){
					theForm.ResCreditCardZip.style.background="#FF0000";
					alert("Please Enter The Credit Card Billing Address Zip Code");
					theForm.ResCreditCardZip.style.background="#ECEADC";
					theForm.ResCreditCardZip.focus();
					return false;
				}
			}
		}
	}
}
