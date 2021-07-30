<!-- BEGIN Include changeplan.php -->

<?
$tab_label = "Change Your Plan";
$message = "Please enter the following information to change your calling plan:";
$instructions = "<em>* All fields required unless otherwise noted.</em>";
?>

<!-- Validation Script -->
<script>
function validate(theForm){
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
// Device Information
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
	if (theForm.esn){
		if (theForm.esn.value == ""){
			theForm.esn.style.background="#FF0000";
			alert("Please Enter The ESN Number");
			theForm.esn.style.background="#FFFFFF";
			theForm.esn.focus();
			return false;
		}
		var esn_regex = /[0-9a-f]{8}/;  // 8 digits, hex!!!!!!!!!!!!!!!!!!!!!!
		if (esn_regex.test(theForm.esn.value) == false) { 
			theForm.esn.style.background="#FF0000";
			alert('Please Enter Exactly 8 Characters (0-1, A-F)');
			theForm.esn.style.background="#FFFFFF";
			theForm.esn.focus();
			return false;
		}
	}
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
	// Phone Number
	if (theForm.current_num){
		if (theForm.current_num.value == ""){
			theForm.current_num.style.background="#FF0000";
			alert("Please Enter Phone Number");
			theForm.current_num.style.background="#FFFFFF";
			theForm.current_num.focus();
			return false;
		}
		var current_num_regex1 = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
		var current_num_regex2 = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
		if (current_num_regex1.test(theForm.current_num.value) == false && current_num_regex2.test(theForm.current_num.value) == false) { 
			theForm.current_num.style.background="#FF0000";
			alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
			theForm.current_num.style.background="#FFFFFF";
			theForm.current_num.focus();
			return false;
		}
	}
// Plan Information
	// New Voice Plan
	if (theForm.new_voice_plan){
		if (theForm.change_voice_plan.checked && theForm.new_voice_plan.value == ""){
			theForm.new_voice_plan.style.background="#FF0000";
			alert('Please Select A New Calling Plan or Uncheck "Change My Calling Plan"');
			theForm.new_voice_plan.style.background="#FFFFFF";
			theForm.new_voice_plan.focus();
			return false;
		}
	}
	// New Data Plan
	if (theForm.new_data_plan){
		if (theForm.change_data_plan.checked && theForm.new_data_plan.value == ""){
			theForm.new_data_plan.style.background="#FF0000";
			alert('Please Select A New Data Plan or Uncheck "Change My Data Plan"');
			theForm.new_data_plan.style.background="#FFFFFF";
			theForm.new_data_plan.focus();
			return false;
		}
	}



// New Number Information
	// New SIM ICC ID
	if (theForm.new_sim_icc){
		if (theForm.new_sim_icc.value == ""){
			theForm.new_sim_icc.style.background="#FF0000";
			alert("Please Enter The New SIM ICC ID Number");
			theForm.new_sim_icc.style.background="#FFFFFF";
			theForm.new_sim_icc.focus();
			return false;
		}
		var new_sim_icc_regex = /(^\d{20}$)/;  // 20 digits, all numeric
		if (new_sim_icc_regex.test(theForm.new_sim_icc.value) == false) { 
			theForm.new_sim_icc.style.background="#FF0000";
			alert('Please Enter Exactly 20 Digits');
			theForm.new_sim_icc.style.background="#FFFFFF";
			theForm.new_sim_icc.focus();
			return false;
		}
	}
	// New Area Code
	if (theForm.new_areacode){
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
	// User Name
	if (theForm.new_username){
		if (theForm.new_username.value == ""){
			theForm.new_username.style.background="#FF0000";
			alert("Please Enter New User Name");
			theForm.new_username.style.background="#FFFFFF";
			theForm.new_username.focus();
			return false;
		}
	}


// Reason for Stopping Service
	// Note (Reason)
//	if (theForm.note){
//		if (theForm.note.value == ""){
//			theForm.note.style.background="#FF0000";
//			alert("Please Explain Your Reason For Stopping Service");
//			theForm.note.style.background="#FFFFFF";
//			theForm.note.focus();
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
				
				<!-- User Information -->
				<tr>
					<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>User Information</strong></td>
				</tr>
				<tr>
					<td width="300"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
					<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
					<td width="440"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>
				<tr>
					<td align="right">User First Name:</td>
					<td><input type="text" name="first_name" id="first_name" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">User Last Name:</td>
					<td><input type="text" name="last_name" id="last_name" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Employee ID:</td>
					<td><input type="text" name="employee_id" id="employee_id" value="" size="50" maxlength="50" style="width:300px;"><span class="smallBlack">&nbsp;*Optional</span></td>
				</tr>
				<tr>
					<td align="right">Cost Center:</td>
					<td><input type="text" name="cost_center" id="cost_center" value="" size="50" maxlength="50" style="width:300px;"><span class="smallBlack">&nbsp;*Optional</span></td>
				</tr>
				<tr>
					<td align="right">Email Address:</td>
					<td><input type="text" name="user_email" id="user_email" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				
				<!-- Device Information -->
				<tr>
					<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Device Information</strong></td>
				</tr>
				<tr>
					<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
					<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>
				<!--<tr>
					<td align="right">Device:</td>
					<td>
					<?
					// Get current approved devices
				//	$query = "SELECT * FROM devices WHERE available = 'T' ORDER BY manufacturer, model";
				//	$rs_devices = mysql_query($query, $linkID);
					?>
						<select name="device" id="device" onchange="fillDevice(this.form);" style="width:300px;">
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
					<td><input type="text" name="device_manufacturer" id="device_manufacturer" value="" size="50" maxlength="50" onChange="bbTest(this.form);" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Device Model:</td>
					<td><input type="text" name="device_model" id="device_model" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Device ESN Number:</td>
					<td><input type="text" name="esn" id="esn" value="" size="8" maxlength="8" style="width:300px;"></td>
				</tr>
				<!--<tr>
					<td align="right">Device IMEI Number:</td>
					<td><input type="text" name="imei" id="imei" value="" size="15" maxlength="15" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">SIM ICC ID Number:</td>
					<td><input type="text" name="sim_icc" id="sim_icc" value="" size="20" maxlength="20" style="width:300px;"></td>
				</tr>-->
				<tr>
					<td align="right"><? echo iif($task == "number", "Current ", ""); ?>Wireless Number:</td>
					<td><input type="text" name="current_num" id="current_num" value="" size="50" maxlength="50" style="width:300px;"></td>
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
					<td><input type="checkbox" name="change_voice_plan" id="change_voice_plan" onClick="enableVoicePlans(this.form);" value="T" checked>&nbsp;Change my calling plan.</td>
				</tr>
				<tr>
					<td align="right">New Calling Plan:</td>
					<td>
					<?
				//	$query = "SELECT * FROM plans WHERE plan_type = 'V' AND display = 'T' ORDER BY priority";
				//	$rs_plans = mysql_query($query, $linkID);
					?>
						<select name="new_voice_plan" id="new_voice_plan" style="width:300px;">
							<option value="">Select</option>
							<option disabled>------------------------</option>
							<?
				//			for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
				//				$row = mysql_fetch_assoc($rs_plans);
				//				echo'
				//			<option value="'.$row["plan_name"].'">'.$row["plan_name"].'</option>
				//				';
				//			}
							?>
						</select>
					</td>
				<tr>
					<td colspan="3" align="center" valign="top"><strong>-- Put Features and Options Here --</strong></td>
				</tr>
				<!--<tr>
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
				</tr>-->
				<tr>
					<td align="right">Data Plan:</td>
					<td><input type="checkbox" name="change_data_plan" id="change_data_plan" onClick="enableDataPlans(this.form);" value="T" checked>&nbsp;Change my data plan.</td>
				</tr>
				<tr>
					<td align="right">New Data Plan:</td>
					<td>
					<?
				//	$query = "SELECT * FROM plans WHERE plan_type = 'D' AND display = 'T' ORDER BY priority";
				//	$rs_plans = mysql_query($query, $linkID);
					?>
						<select name="new_data_plan" id="new_data_plan" style="width:300px;">
							<option value="">Select</option>
							<option disabled>------------------------</option>
							<?
				//			for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
				//				$row = mysql_fetch_assoc($rs_plans);
				//				echo'
				//			<option value="'.$row["plan_name"].'">'.$row["plan_name"].'</option>
				//				';
				//			}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div id="bb_options" style="display:none; z-index:1;">
						<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
						<tr>
							<td width="250" align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>BlackBerry Data ($44.99):</td>
							<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
							<td width="340">
								<input type="radio" name="blackberry_data" id="blackberry_data" value="add">&nbsp;Add&nbsp;
								<input type="radio" name="blackberry_data" id="blackberry_data" value="remove">&nbsp;Remove&nbsp;
								<input type="radio" name="blackberry_data" id="blackberry_data" value="unchanged" checked>&nbsp;No Change
							</td>
						</tr>
						<tr>
							<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>BlackBerry International ($69.99):</td>
							<td>
								<input type="radio" name="blackberry_intl" id="blackberry_intl" value="add">&nbsp;Add&nbsp;
								<input type="radio" name="blackberry_intl" id="blackberry_intl" value="remove">&nbsp;Remove&nbsp;
								<input type="radio" name="blackberry_intl" id="blackberry_intl" value="unchanged" checked>&nbsp;No Change
							</td>
						</tr>
						</table>
						</div>
					</td>
				</tr>

<? if ($task == "number"){ ?>
<!-- New Number Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>New Phone Number Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">New SIM Card ICC ID:</td>
	<td><input type="text" name="new_sim_icc" id="new_sim_icc" value="" size="50" maxlength="20" style="width:300px;"></td>
</tr>
<tr>
	<td align="right">New Area Code:</td>
	<td><input type="text" name="new_areacode" id="new_areacode" value="" size="50" maxlength="50" style="width:300px;"></td>
</tr>
<tr>
	<td align="right">New Address:</td>
	<td><input type="text" name="new_address1" id="new_address1" value="" size="50" maxlength="50" style="width:300px;"></td>
</tr>
<tr>
	<td align="right"></td>
	<td><input type="text" name="new_address2" id="new_address2" value="" size="50" maxlength="50" style="width:300px;"></td>
</tr>
<tr>
	<td align="right">New City:</td>
	<td><input type="text" name="new_city" id="new_city" value="" size="50" maxlength="50" style="width:300px;"></td>
</tr>
<tr>
	<td align="right">New State:</td>
	<td>
		<select name="new_state" id="new_state" style="width:300px;">
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
	<td align="right">New Zip Code:</td>
	<td><input type="text" name="new_zipcode" id="new_zipcode" value="" size="50" maxlength="50" style="width:300px;"></td>
</tr>
<? } ?>
<? if ($task == "stop"){ ?>
<!-- Issue Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Reason</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right" valign="top">Reason For Stopping Service:</td>
	<td><textarea cols="20" rows="3" name="note" id="note" style="width:300px;"></textarea></td>
</tr>
<? } ?>

				<!-- Requester Information -->
				<tr>
					<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Requester Information</strong></td>
				</tr>
				<tr>
					<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
					<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>
				<tr>
					<td align="right">Requester Name:</td>
					<td><input type="text" name="requester_name" id="requester_name" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Requester Phone Number:</td>
					<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="50" style="width:300px;"></td>
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
				<input type="hidden" name="task" value="changeplan">
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

<!-- END Include changeplan.php -->
