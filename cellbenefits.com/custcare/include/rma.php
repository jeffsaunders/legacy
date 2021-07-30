<!-- BEGIN Include rma.php -->

<?
$tab_label = "Request RMA";
$message = "Please enter the following information to initiate an RMA request:";
$instructions = "<em>* All fields required unless otherwise noted.</em>";
?>

<!-- Validation Script -->
<script>
function validate(theForm){
// User Information
	// First Name
//	if (theForm.first_name){
//		if (theForm.first_name.value == ""){
//			theForm.first_name.style.background="#FF0000";
//			alert("Please Enter User First Name");
//			theForm.first_name.style.background="#FFFFFF";
//			theForm.first_name.focus();
//			return false;
//		}
//	}
	// Last Name
//	if (theForm.last_name){
//		if (theForm.last_name.value == ""){
//			theForm.last_name.style.background="#FF0000";
//			alert("Please Enter User Last Name");
//			theForm.last_name.style.background="#FFFFFF";
//			theForm.last_name.focus();
//			return false;
//		}
//	}
	// Employee ID
//	if (theForm.employee_id){
//		if (theForm.employee_id.value == ""){
//			theForm.employee_id.style.background="#FF0000";
//			alert("Please Enter User Employee ID");
//			theForm.employee_id.style.background="#FFFFFF";
//			theForm.employee_id.focus();
//			return false;
//		}
//	}
	// Cost Center
//	if (theForm.cost_center){
//		if (theForm.cost_center.value == ""){
//			theForm.cost_center.style.background="#FF0000";
//			alert("Please Enter User Cost Center");
//			theForm.cost_center.style.background="#FFFFFF";
//			theForm.cost_center.focus();
//			return false;
//		}
//	}
	// User Email
//	if (theForm.user_email){
//		if (theForm.user_email.value == ""){
//			theForm.user_email.style.background="#FF0000";
//			alert("Please Enter User Email Address");
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
		// Check for "@"
// 		if (theForm.user_email.value.indexOf("@") == -1) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Must Contain an "@"');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
		// Check for "@" as first char.
// 		if (theForm.user_email.value.indexOf("@") == 0) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Cannot Start With a "@"');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for anything after "@"
 //		if (theForm.user_email.value.length == (theForm.user_email.value.indexOf("@")+1)) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Must Contain a Domain Name After the "@"');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for multiple "@"
 //		if (theForm.user_email.value.substring((theForm.user_email.value.indexOf("@")+1),theForm.user_email.value.length).indexOf("@") != -1) {
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Must Contain Only One "@"');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for "."
 //		if (theForm.user_email.value.indexOf(".") == -1) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Must Contain a "."');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for "." as first char.
 //		if (theForm.user_email.value.indexOf(".") == 0) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Cannot Start With a "."');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for ".."
 //		if (theForm.user_email.value.indexOf("..") != -1) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Must Not Contain Adjacent Dots ("..")');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for "." adjacent to "@"
 //		if (theForm.user_email.value.indexOf(".@") != -1 || theForm.user_email.value.indexOf("@.") != -1) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for TLD
 //		if (theForm.user_email.value.length == (theForm.user_email.value.indexOf(".")+1)) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for TLD at least 2 char.
//		var domain = theForm.user_email.value.substring((theForm.user_email.value.indexOf("@")+1),theForm.user_email.value.length);
//		if (domain.length - (domain.indexOf(".")+1) < 2) {
//			theForm.user_email.style.background="#FF0000";
//			alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for "_" in TLD
//		if (theForm.user_email.value.indexOf("_") > theForm.user_email.value.indexOf("@")) {
//			theForm.user_email.style.background="#FF0000";
//			alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for spaces
 //		if (theForm.user_email.value.indexOf(" ") != -1) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Must Not Contain Any Spaces (" ")');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//		// Check for illegal char.
//		var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
 //		if (email_regex.test(theForm.user_email.value) == false) { 
//			theForm.user_email.style.background="#FF0000";
//			alert('User Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
//			theForm.user_email.style.background="#FFFFFF";
//			theForm.user_email.focus();
//			return false;
//		}
//	}
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
//	if (theForm.device){
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
//	}
	// Verify ESN
//	if (theForm.esn){
//		if (theForm.esn.value == ""){
//			theForm.esn.style.background="#FF0000";
//			alert("Please Enter The ESN Number");
//			theForm.esn.style.background="#FFFFFF";
//			theForm.esn.focus();
//			return false;
//		}
//		var esn_regex = /[0-9a-f]{8}/;  // 8 digits, hex!!!!!!!!!!!!!!!!!!!!!!
//		if (esn_regex.test(theForm.esn.value) == false) { 
//			theForm.esn.style.background="#FF0000";
//			alert('Please Enter Exactly 8 Characters (0-1, A-F)');
//			theForm.esn.style.background="#FFFFFF";
//			theForm.esn.focus();
//			return false;
//		}
//	}
	// IMEI
//	if (theForm.imei){
//		if (theForm.imei.value == ""){
//			theForm.imei.style.background="#FF0000";
//			alert("Please Enter The Device IMEI Number");
//			theForm.imei.style.background="#FFFFFF";
//			theForm.imei.focus();
//			return false;
//		}
//		var imei_regex = /(^\d{15}$)/;  // 15 digits, all numeric
//		if (imei_regex.test(theForm.imei.value) == false) { 
//			theForm.imei.style.background="#FF0000";
//			alert('Please Enter Exactly 15 Digits');
//			theForm.imei.style.background="#FFFFFF";
//			theForm.imei.focus();
//			return false;
//		}
//	}
	// SIM ICC ID
//	if (theForm.sim_icc){
//		if (theForm.sim_icc.value == ""){
//			theForm.sim_icc.style.background="#FF0000";
//			alert("Please Enter The SIM ICC ID Number");
//			theForm.sim_icc.style.background="#FFFFFF";
//			theForm.sim_icc.focus();
//			return false;
//		}
//		var sim_icc_regex = /(^\d{20}$)/;  // 20 digits, all numeric
//		if (sim_icc_regex.test(theForm.sim_icc.value) == false) { 
//			theForm.sim_icc.style.background="#FF0000";
//			alert('Please Enter Exactly 20 Digits');
//			theForm.sim_icc.style.background="#FFFFFF";
//			theForm.sim_icc.focus();
//			return false;
//		}
//	}
// Plan Information
	// New Voice Plan
//	if (theForm.new_voice_plan){
//		if (theForm.change_voice_plan.checked && theForm.new_voice_plan.value == ""){
//			theForm.new_voice_plan.style.background="#FF0000";
//			alert('Please Select A New Calling Plan or Uncheck "Change My Calling Plan"');
//			theForm.new_voice_plan.style.background="#FFFFFF";
//			theForm.new_voice_plan.focus();
//			return false;
//		}
//	}
	// New Data Plan
//	if (theForm.new_data_plan){
//		if (theForm.change_data_plan.checked && theForm.new_data_plan.value == ""){
//			theForm.new_data_plan.style.background="#FF0000";
//			alert('Please Select A New Data Plan or Uncheck "Change My Data Plan"');
//			theForm.new_data_plan.style.background="#FFFFFF";
//			theForm.new_data_plan.focus();
//			return false;
//		}
//	}



// New Number Information
	// New SIM ICC ID
//	if (theForm.new_sim_icc){
//		if (theForm.new_sim_icc.value == ""){
//			theForm.new_sim_icc.style.background="#FF0000";
//			alert("Please Enter The New SIM ICC ID Number");
//			theForm.new_sim_icc.style.background="#FFFFFF";
//			theForm.new_sim_icc.focus();
//			return false;
//		}
//		var new_sim_icc_regex = /(^\d{20}$)/;  // 20 digits, all numeric
//		if (new_sim_icc_regex.test(theForm.new_sim_icc.value) == false) { 
//			theForm.new_sim_icc.style.background="#FF0000";
//			alert('Please Enter Exactly 20 Digits');
//			theForm.new_sim_icc.style.background="#FFFFFF";
//			theForm.new_sim_icc.focus();
//			return false;
//		}
//	}
	// New Area Code
/*	if (theForm.new_areacode){
		if (theForm.new_areacode.value == ""){
			theForm.new_areacode.style.background="#FF0000";
			alert("Please Enter New Area Code");
			theForm.new_areacode.style.background="#FFFFFF";
			theForm.new_areacode.focus();
			return false;
		}
	}
	// New Service Address
	if (theForm.new_address1){
		if (theForm.new_address1.value == ""){
			theForm.new_address1.style.background="#FF0000";
			theForm.new_address2.style.background="#FF0000";
			alert("Please Enter New Address");
			theForm.new_address1.style.background="#FFFFFF";
			theForm.new_address2.style.background="#FFFFFF";
			theForm.new_address1.focus();
			return false;
		}
	}
	// New Service City
	if (theForm.new_city){
		if (theForm.new_city.value == ""){
			theForm.new_city.style.background="#FF0000";
			alert("Please Enter New City");
			theForm.new_city.style.background="#FFFFFF";
			theForm.new_city.focus();
			return false;
		}
	}
	// New Service State
	if (theForm.new_state){
		if (theForm.new_state.value == ""){
			theForm.new_state.style.background="#FF0000";
			alert("Please Select New State");
			theForm.new_state.style.background="#FFFFFF";
			theForm.new_state.focus();
			return false;
		}
	}
	// New Service Zip Code
	if (theForm.new_zipcode){
		if (theForm.new_zipcode.value == ""){
			theForm.new_zipcode.style.background="#FF0000";
			alert("Please Enter New Zipcode");
			theForm.new_zipcode.style.background="#FFFFFF";
			theForm.new_zipcode.focus();
			return false;
		}
		var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//		var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 		if (usa_regex.test(theForm.bill_zipcode.value) == false && cdn_regex.test(theForm.bill_zipcode.value) == false) { 
 		if (usa_regex.test(theForm.new_zipcode.value) == false) { 
			theForm.new_zipcode.style.background="#FF0000";
			alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
			theForm.new_zipcode.style.background="#FFFFFF";
			theForm.new_zipcode.focus();
			return false;
		}
	}
*/	// User Name
//	if (theForm.new_username){
//		if (theForm.new_username.value == ""){
//			theForm.new_username.style.background="#FF0000";
//			alert("Please Enter New User Name");
//			theForm.new_username.style.background="#FFFFFF";
//			theForm.new_username.focus();
//			return false;
//		}
//	}

// Issue Information
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

// Reason for Stopping Service
	// Note (Reason)
//	if (theForm.reason){
//		if (theForm.reason.value == ""){
//			theForm.reason.style.background="#FF0000";
//			alert("Please Explain Your Reason For Stopping Service");
//			theForm.reason.style.background="#FFFFFF";
//			theForm.reason.focus();
//			return false;
//		}
//	}


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
	// Note
//	if (theForm.note){
//		if (theForm.note.value == ""){
//			theForm.note.style.background="#FF0000";
//			alert("Please Explain Your Reason For Stopping Service");
//			theForm.note.style.background="#FFFFFF";
//			theForm.note.focus();
//			return false;
//		}
//	}
	return true;
}
</script>

<table width="920" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong><? echo $tab_label; ?></strong></td>
	<td><img src="images/spacer.gif" alt="" width="721" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="920" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="0" height="400" border="0"></td>
			<td>
				<!-- Form -->
				<form action="" method="post" name="port" id="port" onSubmit="return validate(this);">
				<br><br>

				<!-- Head -->
				<table width="800" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
				<tr>
					<td colspan="3" class="xbigBlack"><? echo $message; ?><br><br></td>
				</tr>
				<? if ($instructions != ""){ ?>
				<tr>
					<td colspan="3" align="center">
						<table border="0" cellspacing="0" cellpadding="0" align="center">
							<td width="700" class="bodyBlack"><em><? echo $instructions; ?></em><br><br></td>
						</table>
					</td>
				</tr>
				<? } ?>

				<!-- Device Information -->
				<tr>
					<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Device Information</strong></td>
				</tr>
				<tr>
					<td width="300"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
					<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
					<td width="440"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>
				<tr>
					<td align="right">Wireless Number:</td>
					<td><input type="text" name="phone_num" id="phone_num" value="" size="50" maxlength="25" style="width:300px;"></td>
				</tr>
				<!--<tr>
					<td align="right">Device:</td>
					<td>
					<?
					// Get current approved devices
				//	$query = "SELECT * FROM devices WHERE available = 'T' ORDER BY manufacturer, model";
				//	$rs_devices = mysql_query($query, $linkID);
					?>
						<select name="device" id="device" onchange="fillDevice(form.id);" style="width:300px;">
							<option value="">Select</option>
							<option disabled>------------------------</option>
							<?
				//			for ($counter=1; $counter <= mysql_num_rows($rs_devices); $counter++){
				//				$row = mysql_fetch_assoc($rs_devices);
				//				echo'
				//			<option value="'.$row["manufacturer"].'|'.$row["model"].'">'.$row["manufacturer"].' '.$row["model"].'</option>
				//				';
				//			}
							?>
							<option value="other">Other</option>
						</select>
					</td>
				</tr>-->
				<tr>
					<td align="right">Device Manufacturer:</td>
					<td><input type="text" name="device_manufacturer" id="device_manufacturer" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Device Model:</td>
					<td><input type="text" name="device_model" id="device_model" value="" size="50" maxlength="50" style="width:300px;"></td>
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
					<td><input type="text" name="issue_desc" id="issue_desc" value="" size="50" maxlength="100" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right" valign="top">Issue Notes:</td>
					<td><textarea cols="20" rows="3" name="issue_note" id="issue_note" style="width:300px;"></textarea></td>
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
					<td><input type="text" name="requester_name" id="requester_name" value="<? echo $_SESSION['user']; ?>" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Requester Phone Number:</td>
					<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="25" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Requester Email:</td>
					<td><input type="text" name="requester_email" id="requester_email" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Additional Information:</td>
					<td><textarea cols="20" rows="3" name="note" id="note" style="width:300px;"></textarea></td>
				</tr>
				<tr>
					<td colspan="3" align="center">
					<br>
					<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
<!--					<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">-->
					</td>
				</tr>
				</table>
				<input type="hidden" name="task" value="rma">
				</form>
				<br>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="920" height="5" border="0"></td>
</tr>
</table>

<!-- END Include rma.php -->
