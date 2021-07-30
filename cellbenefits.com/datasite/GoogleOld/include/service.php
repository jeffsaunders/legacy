<!-- BEGIN INCLUDE admin.php -->

<!-- Interactivity Scripts -->
<script>
function fillDevice(ID){
	var device_array = document.getElementById(ID).device.value.split("|")
//alert(document.getElementById(ID).id);
	if (device_array[0] == "other" || device_array[0] == ""){
		document.getElementById(ID).device_manufacturer.value = '';
		document.getElementById(ID).device_manufacturer.readOnly = false;
		document.getElementById(ID).device_manufacturer.style.color = "#000000";
		document.getElementById(ID).device_manufacturer.focus();
		document.getElementById(ID).device_model.value = '';
		document.getElementById(ID).device_model.readOnly = false;
		document.getElementById(ID).device_model.style.color = "#000000";
	}else{
		document.getElementById(ID).device_manufacturer.value = device_array[0];
		document.getElementById(ID).device_manufacturer.readOnly = true;
		document.getElementById(ID).device_manufacturer.style.color = "#C0C0C0";
		document.getElementById(ID).device_model.value = device_array[1];
		document.getElementById(ID).device_model.readOnly = true;
		document.getElementById(ID).device_model.style.color = "#C0C0C0";
		if (device_array[0] == "RIM" || device_array[0] == "BLACKBERRY"){
			showDiv('bb_options');
		}else{
			hideDiv('bb_options');
		}
		if (document.getElementById(ID).id == "unlock" || document.getElementById(ID).id == "update_line"){
			document.getElementById(ID).imei.focus();
		}else if (document.getElementById(ID).id == "order"){
			document.getElementById(ID).quantity.focus();
		}else if (document.getElementById(ID).id == "rma"){
			document.getElementById(ID).requester_name.focus();
		}
	}
}

function fillCarrierFrom(ID){
	if (document.getElementById(ID).carriers_1.value == "other" || document.getElementById(ID).carriers_1.value == ""){
		document.getElementById(ID).carrier_from.value = '';
		document.getElementById(ID).carrier_from.readOnly = false;
		document.getElementById(ID).carrier_from.style.color = "#000000";
		document.getElementById(ID).carrier_from.focus();
	}else{
		document.getElementById(ID).carrier_from.value = document.getElementById(ID).carriers_1.value;
		document.getElementById(ID).carrier_from.readOnly = true;
		document.getElementById(ID).carrier_from.style.color = "#C0C0C0";
		document.getElementById(ID).carrier_to.focus();
	}
}

function fillCarrierTo(ID){
	if (document.getElementById(ID).carriers_2.value == "other" || document.getElementById(ID).carriers_2.value == ""){
		document.getElementById(ID).carrier_to.value = '';
		document.getElementById(ID).carrier_to.readOnly = false;
		document.getElementById(ID).carrier_to.style.color = "#000000";
		document.getElementById(ID).carrier_to.focus();
	}else{
		document.getElementById(ID).carrier_to.value = document.getElementById(ID).carriers_2.value;
		document.getElementById(ID).carrier_to.readOnly = true;
		document.getElementById(ID).carrier_to.style.color = "#C0C0C0";
		document.getElementById(ID).requester_name.focus();
	}
}

function bbTest(theForm){
	if (theForm.device_manufacturer.value.toUpperCase() == "RIM" || theForm.device_manufacturer.value.toUpperCase() == "BLACKBERRY"){
		showDiv('bb_options');
	}else{
		hideDiv('bb_options');
	}
}

function enablePlans(theForm){
	if (theForm.change_plan.checked){
		theForm.new_plan.disabled = false;
		theForm.new_plan.focus();
	}else{
		theForm.new_plan.disabled = true;
//		theForm.world_traveler.focus();
	}
}
</script>

<!-- Validation Script -->
<script>
function validate(theForm){
// Device Information
	// Phone Number
	if (theForm.phone_num){
		if (theForm.phone_num.value == ""){
			theForm.phone_num.style.background="#FF0000";
			alert("Please Enter Phone Number");
			theForm.phone_num.style.background="#FFFFFF";
			theForm.phone_num.focus();
			return false;
		}
		var phone_num_regex1 = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
		var phone_num_regex2 = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
		if (phone_num_regex1.test(theForm.phone_num.value) == false && phone_num_regex2.test(theForm.phone_num.value) == false) { 
			theForm.phone_num.style.background="#FF0000";
			alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
			theForm.phone_num.style.background="#FFFFFF";
			theForm.phone_num.focus();
			return false;
		}
	}
	// Device
	if (theForm.device){
//		if (theForm.device.value == "other" || theForm.device.value == ""){
			if (theForm.device_manufacturer.value == ""){
				theForm.device_manufacturer.style.background="#FF0000";
				alert("Please Enter The Device Manufacturer");
				theForm.device_manufacturer.style.background="#FFFFFF";
				theForm.device_manufacturer.focus();
				return false;
			}
			if (theForm.device_model.value == ""){
				theForm.device_model.style.background="#FF0000";
				alert("Please Enter The Device Model");
				theForm.device_model.style.background="#FFFFFF";
				theForm.device_model.focus();
				return false;
			}
//		}
	}
	// Quantity
	if (theForm.quantity){
		if (theForm.quantity.value == ""){
			theForm.quantity.style.background="#FF0000";
			alert("Please Enter A Quantity");
			theForm.quantity.style.background="#FFFFFF";
			theForm.quantity.focus();
			return false;
		}
		var quantity_regex = /(^\d+$)/;  // all numeric
		if (quantity_regex.test(theForm.quantity.value) == false) { 
			theForm.quantity.style.background="#FF0000";
			alert('Please Enter Only A Number');
			theForm.quantity.style.background="#FFFFFF";
			theForm.quantity.focus();
			return false;
		}
	}
	// Requested Area Code
	if (theForm.req_areacode){
		if (theForm.req_areacode.value == ""){
			theForm.req_areacode.style.background="#FF0000";
			alert("Please Enter Requested Area Code");
			theForm.req_areacode.style.background="#FFFFFF";
			theForm.req_areacode.focus();
			return false;
		}
	}
	// IMEI
	if (theForm.imei){
		if (theForm.imei.value == ""){
			theForm.imei.style.background="#FF0000";
			alert("Please Enter The Device IMEI Number");
			theForm.imei.style.background="#FFFFFF";
			theForm.imei.focus();
			return false;
		}
		var imei_regex = /(^\d{15}$)/;  // 15 digits, all numeric
		if (imei_regex.test(theForm.imei.value) == false) { 
			theForm.imei.style.background="#FF0000";
			alert('Please Enter Exactly 15 Digits');
			theForm.imei.style.background="#FFFFFF";
			theForm.imei.focus();
			return false;
		}
	}
	// SIM ICC ID
	if (theForm.sim_icc){
		if (theForm.sim_icc.value == ""){
			theForm.sim_icc.style.background="#FF0000";
			alert("Please Enter The SIM ICC ID Number");
			theForm.sim_icc.style.background="#FFFFFF";
			theForm.sim_icc.focus();
			return false;
		}
		var sim_icc_regex = /(^\d{20}$)/;  // 20 digits, all numeric
		if (sim_icc_regex.test(theForm.sim_icc.value) == false) { 
			theForm.sim_icc.style.background="#FF0000";
			alert('Please Enter Exactly 20 Digits');
			theForm.sim_icc.style.background="#FFFFFF";
			theForm.sim_icc.focus();
			return false;
		}
	}
// Plan Information
	// New Plan
	if (theForm.new_plan){
		if (theForm.change_plan.checked && theForm.new_plan.value == ""){
			theForm.new_plan.style.background="#FF0000";
			alert("Please Select A New Plan");
			theForm.new_plan.style.background="#FFFFFF";
			theForm.new_plan.focus();
			return false;
		}
	}
// User Information
	// First Name
	if (theForm.first_name){
		if (theForm.first_name.value == ""){
			theForm.first_name.style.background="#FF0000";
			alert("Please Enter User First Name");
			theForm.first_name.style.background="#FFFFFF";
			theForm.first_name.focus();
			return false;
		}
	}
	// Last Name
	if (theForm.last_name){
		if (theForm.last_name.value == ""){
			theForm.last_name.style.background="#FF0000";
			alert("Please Enter User Last Name");
			theForm.last_name.style.background="#FFFFFF";
			theForm.last_name.focus();
			return false;
		}
	}
	// Employee ID
	if (theForm.employee_id){
		if (theForm.employee_id.value == ""){
			theForm.employee_id.style.background="#FF0000";
			alert("Please Enter User Employee ID");
			theForm.employee_id.style.background="#FFFFFF";
			theForm.employee_id.focus();
			return false;
		}
	}
	// Cost Center
	if (theForm.cost_center){
		if (theForm.cost_center.value == ""){
			theForm.cost_center.style.background="#FF0000";
			alert("Please Enter User Cost Center");
			theForm.cost_center.style.background="#FFFFFF";
			theForm.cost_center.focus();
			return false;
		}
	}
	// User Email
	if (theForm.user_email){
		if (theForm.user_email.value == ""){
			theForm.user_email.style.background="#FF0000";
			alert("Please Enter User Email Address");
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for "@"
 		if (theForm.user_email.value.indexOf("@") == -1) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Must Contain an "@"');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for "@" as first char.
 		if (theForm.user_email.value.indexOf("@") == 0) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Cannot Start With a "@"');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for anything after "@"
 		if (theForm.user_email.value.length == (theForm.user_email.value.indexOf("@")+1)) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Must Contain a Domain Name After the "@"');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for multiple "@"
 		if (theForm.user_email.value.substring((theForm.user_email.value.indexOf("@")+1),theForm.user_email.value.length).indexOf("@") != -1) {
			theForm.user_email.style.background="#FF0000";
			alert('User Email Must Contain Only One "@"');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for "."
 		if (theForm.user_email.value.indexOf(".") == -1) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Must Contain a "."');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for "." as first char.
 		if (theForm.user_email.value.indexOf(".") == 0) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Cannot Start With a "."');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for ".."
 		if (theForm.user_email.value.indexOf("..") != -1) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Must Not Contain Adjacent Dots ("..")');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for "." adjacent to "@"
 		if (theForm.user_email.value.indexOf(".@") != -1 || theForm.user_email.value.indexOf("@.") != -1) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for TLD
 		if (theForm.user_email.value.length == (theForm.user_email.value.indexOf(".")+1)) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for TLD at least 2 char.
		var domain = theForm.user_email.value.substring((theForm.user_email.value.indexOf("@")+1),theForm.user_email.value.length);
		if (domain.length - (domain.indexOf(".")+1) < 2) {
			theForm.user_email.style.background="#FF0000";
			alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for "_" in TLD
		if (theForm.user_email.value.indexOf("_") > theForm.user_email.value.indexOf("@")) {
			theForm.user_email.style.background="#FF0000";
			alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for spaces
 		if (theForm.user_email.value.indexOf(" ") != -1) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Must Not Contain Any Spaces (" ")');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
		// Check for illegal char.
		var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
 		if (email_regex.test(theForm.user_email.value) == false) { 
			theForm.user_email.style.background="#FF0000";
			alert('User Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
			theForm.user_email.style.background="#FFFFFF";
			theForm.user_email.focus();
			return false;
		}
	}
// Shipping Information
	// Ship to Name
	if (theForm.ship_name){
		if (theForm.ship_name.value == ""){
			theForm.ship_name.style.background="#FF0000";
			alert("Please Enter Ship To Name");
			theForm.ship_name.style.background="#FFFFFF";
			theForm.ship_name.focus();
			return false;
		}
	}
	// Ship to Address
	if (theForm.ship_address1){
		if (theForm.ship_address1.value == ""){
			theForm.ship_address1.style.background="#FF0000";
			theForm.ship_address2.style.background="#FF0000";
			alert("Please Enter Shipping Address");
			theForm.ship_address1.style.background="#FFFFFF";
			theForm.ship_address2.style.background="#FFFFFF";
			theForm.ship_address1.focus();
			return false;
		}
	}
	// Ship to City
	if (theForm.ship_city){
		if (theForm.ship_city.value == ""){
			theForm.ship_city.style.background="#FF0000";
			alert("Please Enter Shipping City");
			theForm.ship_city.style.background="#FFFFFF";
			theForm.ship_city.focus();
			return false;
		}
	}
	// Ship to State
	if (theForm.ship_state){
		if (theForm.ship_state.value == ""){
			theForm.ship_state.style.background="#FF0000";
			alert("Please Select Shipping State");
			theForm.ship_state.style.background="#FFFFFF";
			theForm.ship_state.focus();
			return false;
		}
	}
	// Ship to Zip Code
	if (theForm.ship_zipcode){
		if (theForm.ship_zipcode.value == ""){
			theForm.ship_zipcode.style.background="#FF0000";
			alert("Please Enter Shipping Zipcode");
			theForm.ship_zipcode.style.background="#FFFFFF";
			theForm.ship_zipcode.focus();
			return false;
		}
		var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//		var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 		if (usa_regex.test(theForm.bill_zipcode.value) == false && cdn_regex.test(theForm.bill_zipcode.value) == false) { 
 		if (usa_regex.test(theForm.ship_zipcode.value) == false) { 
			theForm.ship_zipcode.style.background="#FF0000";
			alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
			theForm.ship_zipcode.style.background="#FFFFFF";
			theForm.ship_zipcode.focus();
			return false;
		}
	}
// Requester Information
	// Requester Name
	if (theForm.requester_name){
		if (theForm.requester_name.value == ""){
			theForm.requester_name.style.background="#FF0000";
			alert("Please Enter Requester Name");
			theForm.requester_name.style.background="#FFFFFF";
			theForm.requester_name.focus();
			return false;
		}
	}
	// Phone Number
	if (theForm.requester_phone){
		if (theForm.requester_phone.value == ""){
			theForm.requester_phone.style.background="#FF0000";
			alert("Please Enter Phone Number");
			theForm.requester_phone.style.background="#FFFFFF";
			theForm.requester_phone.focus();
			return false;
		}
		var requester_phone_regex1 = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}(.*?)$/;  // (xxx)xxx-xxxx *...
		var requester_phone_regex2 = /^[1-9]\d{2}\-\d{3}\-\d{4}(.*?)$/;  // xxx-xxx-xxxx *...
		if (requester_phone_regex1.test(theForm.requester_phone.value) == false && requester_phone_regex2.test(theForm.requester_phone.value) == false) { 
			theForm.requester_phone.style.background="#FF0000";
			alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
			theForm.requester_phone.style.background="#FFFFFF";
			theForm.requester_phone.focus();
			return false;
		}
	}
	// Requester Email
	if (theForm.requester_email){
		if (theForm.requester_email.value == ""){
			theForm.requester_email.style.background="#FF0000";
			alert("Please Enter Requester Email Address");
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for "@"
 		if (theForm.requester_email.value.indexOf("@") == -1) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Must Contain an "@"');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for "@" as first char.
 		if (theForm.requester_email.value.indexOf("@") == 0) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Cannot Start With a "@"');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for anything after "@"
 		if (theForm.requester_email.value.length == (theForm.requester_email.value.indexOf("@")+1)) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Must Contain a Domain Name After the "@"');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for multiple "@"
 		if (theForm.requester_email.value.substring((theForm.requester_email.value.indexOf("@")+1),theForm.requester_email.value.length).indexOf("@") != -1) {
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Must Contain Only One "@"');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for "."
 		if (theForm.requester_email.value.indexOf(".") == -1) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Must Contain a "."');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for "." as first char.
 		if (theForm.requester_email.value.indexOf(".") == 0) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Cannot Start With a "."');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for ".."
 		if (theForm.requester_email.value.indexOf("..") != -1) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Must Not Contain Adjacent Dots ("..")');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for "." adjacent to "@"
 		if (theForm.requester_email.value.indexOf(".@") != -1 || theForm.requester_email.value.indexOf("@.") != -1) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for TLD
 		if (theForm.requester_email.value.length == (theForm.requester_email.value.indexOf(".")+1)) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for TLD at least 2 char.
		var domain = theForm.requester_email.value.substring((theForm.requester_email.value.indexOf("@")+1),theForm.requester_email.value.length);
		if (domain.length - (domain.indexOf(".")+1) < 2) {
			theForm.requester_email.style.background="#FF0000";
			alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for "_" in TLD
		if (theForm.requester_email.value.indexOf("_") > theForm.requester_email.value.indexOf("@")) {
			theForm.requester_email.style.background="#FF0000";
			alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for spaces
 		if (theForm.requester_email.value.indexOf(" ") != -1) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Must Not Contain Any Spaces (" ")');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
		// Check for illegal char.
		var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
 		if (email_regex.test(theForm.requester_email.value) == false) { 
			theForm.requester_email.style.background="#FF0000";
			alert('Requester Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
			theForm.requester_email.style.background="#FFFFFF";
			theForm.requester_email.focus();
			return false;
		}
	}
// Additional Information
	// RMA Reason
	if (theForm.issue_desc){
		if (theForm.issue_desc.value == ""){
			theForm.issue_desc.style.background="#FF0000";
			alert("Please Enter A Brief Description");
			theForm.issue_desc.style.background="#FFFFFF";
			theForm.issue_desc.focus();
			return false;
		}
	}
	// Note (Additional Information)
//	if (theForm.note){
//		if (theForm.note.value == ""){
//			theForm.note.style.background="#FF0000";
//			alert("Please Provide Any Additional Information");
//			theForm.note.style.background="#FFFFFF";
//			theForm.note.focus();
//			return false;
//		}
//	}
	return true;
}
</script>


<?
if (!$task) $task = "approve";
if ($task == "update"){
	$title = "Update Line of Service";
	$message = "Please enter the following information to update a line of service record:";
	$instructions = "";
}elseif ($task == "unlock"){
	$title = "Unlock GSM Device";
	$message = "Please enter the following information to unlock a GSM device:";
	$instructions = "";
}elseif ($task == "order"){
	$title = "Bulk Order";
	$message = "Please enter the following information to bulk order devices:";
	$instructions = "";
}elseif ($task == "rma"){
	$title = "RMA Request";
	$message = "Please enter the following information to initiate an RMA request:";
	$instructions = "";
}
?>

<? if ($status != ""){ // Database Updated - pop up message ?>
<script>
function show(id) {
	document.getElementById(id).style.visibility = "visible";
	document.getElementById(id).style.display = "block";
}
function hide(id) {
	document.getElementById(id).style.visibility = "hidden";
	document.getElementById(id).style.display = "none";
}
</script>

<script type="text/javascript">
// Determine current browser window dimensions
if (window.innerWidth){ //if browser supports window.innerWidth (mozilla)
	bwidth=window.innerWidth;
	bheight=window.innerHeight;
}else if (document.all){ //else if browser supports document.all (IE 4+)
	bwidth=document.body.clientWidth;
	bheight=document.body.clientHeight;
};
// Create DIV
div = "<div id='status' style='position:absolute; top:";
div += ((bheight/2)-12);
div += "; left:";
div += ((bwidth/2)-175);
div += "; width:350; height:140; z-index:2; padding:3px; background-color:#E0E0E0; border-color:#008000; border:thin solid; text-align:center; filter:alpha(opacity=90); display:block; visibility:visible'";
div += " onFocus=setTimeout(\"hide('status')\",5000);";
div += ">";
document.write(div);
// give it focus to trigger onFocus event
document.getElementById('status').focus();
// Write the rest in plain HTML
</script>
	<table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="center" class="bigBlack"><br><br><strong><? echo $status; ?></strong></td>
	</tr>
	<tr>
		<td align="center"><br><input type="button" name="ok" id="ok" value="OK" onClick="hide('status');" style="width:100px;"></td>
	</tr>
	</table>
</div>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="40" border="0"></td>
</tr>
<tr>
	<td width="100%" height="25" bgcolor="#EFEFEF" style="border-top: 2px solid #008000;" class="bigBlack">&nbsp;&nbsp;<strong><? echo $title; ?></strong></td>
</tr>
</table>
<br>
<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td colspan="3" class="bodyBlack"><strong><? echo $message; ?></strong><br><br></td>
</tr>
<? if ($instructions != ""){ ?>
<tr>
	<td colspan="3" align="center">
		<table border="0" cellspacing="0" cellpadding="0" align="center">
			<td width="500" class="bodyBlack"><em><? echo $instructions; ?></em><br><br></td>
		</table>
	</td>
</tr>
<? } ?>

<!-- UPDATE LINE OF SERVICE -->
<? if ($task == "update"){ ?>
<form action="dbaccess.php" method="post" name="update_line" id="update_line" onSubmit="return validate(this);">

<!-- Device Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Device Information</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Wireless Number:</td>
	<td><input type="text" name="phone_num" id="phone_num" value="" size="50" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Device:</td>
	<td>
	<?
	// Get current approved devices
	$query = "SELECT * FROM devices WHERE available = 'T' ORDER BY manufacturer, model";
	$rs_devices = mysql_query($query, $linkID);
	?>
		<select name="device" id="device" onchange="fillDevice(form.id);" style="width:200px;">
			<option value="">Select</option>
			<option disabled>------------------------</option>
			<?
			for ($counter=1; $counter <= mysql_num_rows($rs_devices); $counter++){
				$row = mysql_fetch_assoc($rs_devices);
				echo'
			<option value="'.$row["manufacturer"].'|'.$row["model"].'">'.$row["manufacturer"].' '.$row["model"].'</option>
				';
			}
			?>
			<option value="other">Other</option>
		</select>
	</td>
</tr>
<tr>
	<td align="right">Device Manufacturer:</td>
	<td><input type="text" name="device_manufacturer" id="device_manufacturer" value="" size="50" maxlength="50" onChange="bbTest(this.form);" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Device Model:</td>
	<td><input type="text" name="device_model" id="device_model" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Device IMEI Number:</td>
	<td><input type="text" name="imei" id="imei" value="" size="15" maxlength="15" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">SIM ICC ID Number:</td>
	<td><input type="text" name="sim_icc" id="sim_icc" value="" size="20" maxlength="20" style="width:200px;"></td>
</tr>

<!-- Plan Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Plan Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Calling Plan:</td>
	<td><input type="checkbox" name="change_plan" id="change_plan" onClick="enablePlans(this.form);" value="T" checked>&nbsp;Change the calling plan.</td>
</tr>
<tr>
	<td align="right">New Plan:</td>
	<td>
	<?
	$query = "SELECT * FROM plans WHERE display = 'T' ORDER BY priority";
	$rs_plans = mysql_query($query, $linkID);
	?>
		<select name="new_plan" id="new_plan" style="width:200px;">
			<option value="">Select</option>
			<option disabled>------------------------</option>
			<?
			for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
				$row = mysql_fetch_assoc($rs_plans);
				echo'
			<option value="'.$row["plan_name"].'">'.$row["plan_name"].'</option>
				';
			}
			?>
		</select>
	</td>
<tr>
	<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>World Traveler ($5.99):</td>
	<td>
		<input type="radio" name="world_traveler" id="world_traveler" value="add">&nbsp;Add&nbsp;
		<input type="radio" name="world_traveler" id="world_traveler" value="remove">&nbsp;Remove&nbsp;
		<input type="radio" name="world_traveler" id="world_traveler" value="unchanged" checked>&nbsp;No Change
	</td>
</tr>
<tr>
	<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>World Connect ($3.99):</td>
	<td>
		<input type="radio" name="world_connect" id="world_connect" value="add">&nbsp;Add&nbsp;
		<input type="radio" name="world_connect" id="world_connect" value="remove">&nbsp;Remove&nbsp;
		<input type="radio" name="world_connect" id="world_connect" value="unchanged" checked>&nbsp;No Change
	</td>
</tr>
<tr>
	<td colspan="3">
		<div id="bb_options" style="display:none; z-index:1;">
		<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
		<tr>
			<td width="261" align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>BlackBerry Data ($39.99):</td>
			<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
			<td width="329">
				<input type="radio" name="blackberry_data" id="blackberry_data" onchange="checkTaxID();" value="add">&nbsp;Add&nbsp;
				<input type="radio" name="blackberry_data" id="blackberry_data" onchange="checkTaxID();" value="remove">&nbsp;Remove&nbsp;
				<input type="radio" name="blackberry_data" id="blackberry_data" onchange="checkTaxID();" value="unchanged" checked>&nbsp;No Change
			</td>
		</tr>
		<tr>
			<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>BlackBerry International ($69.99):</td>
			<td>
				<input type="radio" name="blackberry_intl" id="blackberry_intl" onchange="checkTaxID();" value="add">&nbsp;Add&nbsp;
				<input type="radio" name="blackberry_intl" id="blackberry_intl" onchange="checkTaxID();" value="remove">&nbsp;Remove&nbsp;
				<input type="radio" name="blackberry_intl" id="blackberry_intl" onchange="checkTaxID();" value="unchanged" checked>&nbsp;No Change
			</td>
		</tr>
		</table>
		</div>
	</td>
</tr>

<!-- User Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>User Information</strong></td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">User First Name:</td>
	<td><input type="text" name="first_name" id="first_name" value="" size="25" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">User Last Name:</td>
	<td><input type="text" name="last_name" id="last_name" value="" size="25" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Employee ID:</td>
	<td><input type="text" name="employee_id" id="employee_id" value="" size="25" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Cost Center:</td>
	<td><input type="text" name="cost_center" id="cost_center" value="" size="25" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">User Email:</td>
	<td><input type="text" name="user_email" id="user_email" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>

<!-- Requester Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Requester Information</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Requester Name:</td>
	<td><input type="text" name="requester_name" id="requester_name" value="<? echo $_SESSION['user']; ?>" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Email:</td>
	<td><input type="text" name="requester_email" id="requester_email" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
</table>
<input type="hidden" name="request_type" value="update">
<input type="hidden" name="task" value="add_request">
</form>
<? } ?>

<!-- UNLOCK GSM DEVICE -->
<? if ($task == "unlock"){ ?>
<form action="dbaccess.php" method="post" name="unlock" id="unlock" onSubmit="return validate(this);">

<!-- Device Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Device Information</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Device:</td>
	<td>
	<?
	// Get current approved devices
	$query = "SELECT * FROM devices WHERE available = 'T' ORDER BY manufacturer, model";
	$rs_devices = mysql_query($query, $linkID);
	?>
		<select name="device" id="device" onchange="fillDevice(form.id);" style="width:200px;">
			<option value="">Select</option>
			<option disabled>------------------------</option>
			<?
			for ($counter=1; $counter <= mysql_num_rows($rs_devices); $counter++){
				$row = mysql_fetch_assoc($rs_devices);
				echo'
			<option value="'.$row["manufacturer"].'|'.$row["model"].'">'.$row["manufacturer"].' '.$row["model"].'</option>
				';
			}
			?>
			<option value="other">Other</option>
		</select>
	</td>
</tr>
<tr>
	<td align="right">Device Manufacturer:</td>
	<td><input type="text" name="device_manufacturer" id="device_manufacturer" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Device Model:</td>
	<td><input type="text" name="device_model" id="device_model" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Device IMEI Number:</td>
	<td><input type="text" name="imei" id="imei" value="" size="15" maxlength="15" style="width:200px;"></td>
</tr>
<!--<tr>
	<td align="right">SIM ICC ID Number:</td>
	<td><input type="text" name="sim_icc" id="sim_icc" value="" size="20" maxlength="20" style="width:200px;"></td>
</tr>-->
<tr>
	<td align="right">Carrier Branded to:</td>
	<td>
	<!-- POPULATE THIS FROM DB! -->
		<select name="carriers_1" id="carriers_1" onchange="fillCarrierFrom(form.id);" style="width:200px;">
			<option value="">Select</option>
			<option disabled>------------------------</option>
			<option value="Sprint">Sprint</option>
			<option value="Nextel">Nextel</option>
			<option value="Verizon">Verizon</option>
			<option value="T-Mobile">T-Mobile</option>
			<option value="Alltel">Alltel</option>
			<option value="Helio">Helio</option>
			<option value="USCellular">U.S. Cellular</option>
			<option value="other">Other</option>
		</select>
	</td>
</tr>
<tr>
	<td align="right">Carrier Branded to (Other):</td>
	<td><input type="text" name="carrier_from" id="carrier_from" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Carrier You Plan on Using the Device with:</td>
	<td>
	<!-- POPULATE THIS FROM DB! -->
		<select name="carriers_2" id="carriers_2" onchange="fillCarrierTo(form.id);" style="width:200px;">
			<option value="">Select</option>
			<option disabled>------------------------</option>
			<option value="Sprint">Sprint</option>
			<option value="Nextel">Nextel</option>
			<option value="Verizon">Verizon</option>
			<option value="T-Mobile">T-Mobile</option>
			<option value="Alltel">Alltel</option>
			<option value="Helio">Helio</option>
			<option value="USCellular">U.S. Cellular</option>
			<option value="other">Other</option>
		</select>
	</td>
</tr>
<tr>
	<td align="right">Planned New Carrier (Other):</td>
	<td><input type="text" name="carrier_to" id="carrier_to" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>

<!-- Requester Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Requester Information</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Requester Name:</td>
	<td><input type="text" name="requester_name" id="requester_name" value="<? echo $_SESSION['user']; ?>" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Email:</td>
	<td><input type="text" name="requester_email" id="requester_email" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
</table>
<input type="hidden" name="request_type" value="unlock">
<input type="hidden" name="task" value="add_request">
</form>
<? } ?>

<!-- BULK ORDERS -->
<? if ($task == "order"){ ?>
<form action="dbaccess.php" method="post" name="order" id="order" onSubmit="return validate(this);">

<!-- Device Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Device Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Device:</td>
	<td>
	<?
	// Get current approved devices
	$query = "SELECT * FROM devices WHERE available = 'T' ORDER BY manufacturer, model";
	$rs_devices = mysql_query($query, $linkID);
	?>
		<select name="device" id="device" onchange="fillDevice(form.id);" style="width:200px;">
			<option value="">Select</option>
			<option disabled>------------------------</option>
			<?
			for ($counter=1; $counter <= mysql_num_rows($rs_devices); $counter++){
				$row = mysql_fetch_assoc($rs_devices);
				echo'
			<option value="'.$row["manufacturer"].'|'.$row["model"].'">'.$row["manufacturer"].' '.$row["model"].'</option>
				';
			}
			?>
			<option value="other">Other</option>
		</select>
	</td>
</tr>
<tr>
	<td align="right">Device Manufacturer:</td>
	<td><input type="text" name="device_manufacturer" id="device_manufacturer" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Device Model:</td>
	<td><input type="text" name="device_model" id="device_model" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Quantity:</td>
	<td><input type="text" name="quantity" id="quantity" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requested Area Code:</td>
	<td><input type="text" name="req_areacode" id="req_areacode" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>

<!-- Shipping Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Shipping Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Ship to Name:</td>
	<td><input type="text" name="ship_name" id="ship_name" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Shipping Address:</td>
	<td><input type="text" name="ship_address1" id="ship_address1" value="" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td align="right"></td>
	<td><input type="text" name="ship_address2" id="ship_address2" value="" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Shipping City:</td>
	<td><input type="text" name="ship_city" id="ship_city" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Shipping State:</td>
	<td>
		<select name="ship_state" id="ship_state" style="width:200px;">
			<option value="">Select</option>
			<option disabled>------------------------</option>
			<option value="AL">Alabama</option>
			<option value="AK">Alaska</option>
			<option value="AZ">Arizona</option>
			<option value="AR">Arkansas</option>
			<option value="CA">California</option>
			<option value="CO">Colorado</option>
			<option value="CT">Connecticut</option>
			<option value="DE">Delaware</option>
			<option value="DC">District of Columbia</option>
			<option value="FL">Florida</option>
			<option value="GA">Georgia</option>
			<option value="HI">Hawaii</option>
			<option value="ID">Idaho</option>
			<option value="IL">Illinois</option>
			<option value="IN">Indiana</option>
			<option value="IA">Iowa</option>
			<option value="KS">Kansas</option>
			<option value="KY">Kentucky</option>
			<option value="LA">Louisiana</option>
			<option value="ME">Maine</option>
			<option value="MD">Maryland</option>
			<option value="MA">Massachusetts</option>
			<option value="MI">Michigan</option>
			<option value="MN">Minnesota</option>
			<option value="MS">Mississippi</option>
			<option value="MO">Missouri</option>
			<option value="MT">Montana</option>
			<option value="NE">Nebraska</option>
			<option value="NV">Nevada</option>
			<option value="NH">New Hampshire</option>
			<option value="NJ">New Jersey</option>
			<option value="NM">New Mexico</option>
			<option value="NY">New York</option>
			<option value="NC">North Carolina</option>
			<option value="ND">North Dakota</option>
			<option value="OH">Ohio</option>
			<option value="OK">Oklahoma</option>
			<option value="OR">Oregon</option>
			<option value="PA">Pennsylvania</option>
			<option value="RI">Rhode Island</option>
			<option value="SC">South Carolina</option>
			<option value="SD">South Dakota</option>
			<option value="TN">Tennessee</option>
			<option value="TX">Texas</option>
			<option value="UT">Utah</option>
			<option value="VT">Vermont</option>
			<option value="VA">Virginia</option>
			<option value="WA">Washington</option>
			<option value="WV">West Virginia</option>
			<option value="WI">Wisconsin</option>
			<option value="WY">Wyoming</option>
			<option disabled>------------------------</option>
			<option value="AS">American Samoa</option>
			<option value="GU">Guam</option>
			<option value="MH">Marshall Islands</option>
			<option value="MP">Northern Mariana Islands</option>
			<option value="PW">Palau</option>
			<option value="PR">Puerto Rico</option>
			<option value="VI">Virgin Islands</option>
		</select>	
	</td>
</tr>
<tr>
	<td align="right">Shipping Zip Code:</td>
	<td><input type="text" name="ship_zipcode" id="ship_zipcode" value="" size="50" maxlength="10" style="width:200px;"></td>
</tr>

<!-- Requester Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Requester Information</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Requester Name:</td>
	<td><input type="text" name="requester_name" id="requester_name" value="<? echo $_SESSION['user']; ?>" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Email:</td>
	<td><input type="text" name="requester_email" id="requester_email" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>

<!-- Other Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Additional Information</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right" valign="top">Order Notes:</td>
	<td><textarea cols="20" rows="3" name="note" id="note" style="width:200px;"></textarea></td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
</table>
<input type="hidden" name="request_type" value="order">
<input type="hidden" name="task" value="add_request">
</form>
<? } ?>

<!-- REQUEST RMA -->
<? if ($task == "rma"){ ?>
<form action="dbaccess.php" method="post" name="rma" id="rma" onSubmit="return validate(this);">

<!-- Device Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Device Information</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Wireless Number:</td>
	<td><input type="text" name="phone_num" id="phone_num" value="" size="50" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Device:</td>
	<td>
	<?
	// Get current approved devices
	$query = "SELECT * FROM devices WHERE available = 'T' ORDER BY manufacturer, model";
	$rs_devices = mysql_query($query, $linkID);
	?>
		<select name="device" id="device" onchange="fillDevice(form.id);" style="width:200px;">
			<option value="">Select</option>
			<option disabled>------------------------</option>
			<?
			for ($counter=1; $counter <= mysql_num_rows($rs_devices); $counter++){
				$row = mysql_fetch_assoc($rs_devices);
				echo'
			<option value="'.$row["manufacturer"].'|'.$row["model"].'">'.$row["manufacturer"].' '.$row["model"].'</option>
				';
			}
			?>
			<option value="other">Other</option>
		</select>
	</td>
</tr>
<tr>
	<td align="right">Device Manufacturer:</td>
	<td><input type="text" name="device_manufacturer" id="device_manufacturer" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Device Model:</td>
	<td><input type="text" name="device_model" id="device_model" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<!--<tr>
	<td align="right">Device IMEI Number:</td>
	<td><input type="text" name="imei" id="imei" value="" size="15" maxlength="15" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">SIM ICC ID Number:</td>
	<td><input type="text" name="sim_icc" id="sim_icc" value="" size="20" maxlength="20" style="width:200px;"></td>
</tr>-->

<!-- Requester Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Requester Information</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Requester Name:</td>
	<td><input type="text" name="requester_name" id="requester_name" value="<? echo $_SESSION['user']; ?>" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="25" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Email:</td>
	<td><input type="text" name="requester_email" id="requester_email" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>

<!-- Issue Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Issue Information</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Issue Description:</td>
	<td><input type="text" name="issue_desc" id="issue_desc" value="" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td align="right" valign="top">Issue Notes:</td>
	<td><textarea cols="20" rows="3" name="note" id="note" style="width:200px;"></textarea></td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
</table>
<input type="hidden" name="request_type" value="rma">
<input type="hidden" name="task" value="add_request">
</form>
<? } ?>

<!-- END INCLUDE admin.php -->
