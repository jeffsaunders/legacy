<!-- BEGIN Include swapdevice.php -->

<?
$tab_label = "Swap Device";
$message = "Please enter the following information to move your existing number to a new device:";
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
	// Device manufacturer
	if (theForm.device_manuf){
		if (theForm.device_manuf.value == ""){
			theForm.device_manuf.style.background="#FF0000";
			alert("Please Enter The Device Manufacturer");
			theForm.device_manuf.style.background="#FFFFFF";
			theForm.device_manuf.focus();
			return false;
		}
	}
	// Device model
	if (theForm.device_model){
		if (theForm.device_model.value == ""){
			theForm.device_model.style.background="#FF0000";
			alert("Please Enter The Device Model");
			theForm.device_model.style.background="#FFFFFF";
			theForm.device_model.focus();
			return false;
		}
	}
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
	return true;
}
</script>

<script>
// interaction scripts
function enableVoicePlans(theForm){
	if (theForm.change_voice_plan.checked){
		theForm.new_voice_plan.disabled = false;
		theForm.new_voice_plan.focus();
	}else{
		theForm.new_voice_plan.disabled = true;
		theForm.new_voice_plan.value = "";
//		theForm.world_traveler.focus();
	}
}
function enableDataPlans(theForm){
	if (theForm.change_data_plan.checked){
		theForm.new_data_plan.disabled = false;
		theForm.new_data_plan.focus();
	}else{
		theForm.new_data_plan.disabled = true;
		theForm.new_data_plan.value = "";
//		theForm.world_traveler.focus();
	}
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
				<form action="?sec=thankyou" method="post" name="port" id="port" onSubmit="return validate(this);">
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
<!--				<tr>
					<td align="right">Employee ID:</td>
					<td><input type="text" name="employee_id" id="employee_id" value="" size="50" maxlength="50" style="width:300px;"><span class="smallBlack">&nbsp;*Optional</span></td>
				</tr>
				<tr>
					<td align="right">Cost Center:</td>
					<td><input type="text" name="cost_center" id="cost_center" value="" size="50" maxlength="50" style="width:300px;"><span class="smallBlack">&nbsp;*Optional</span></td>
				</tr>-->
				<tr>
					<td align="right">User Email Address:</td>
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
				<tr>
					<td align="right">New Device Manufacturer:</td>
					<td><input type="text" name="device_manuf" id="device_manuf" value="" size="50" maxlength="50" onChange="bbTest(this.form);" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">New Device Model:</td>
					<td><input type="text" name="device_model" id="device_model" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">New Device ESN Number:</td>
<!--					<td><input type="text" name="esn" id="esn" value="" size="8" maxlength="8" style="width:300px;"><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.cellbenefits.com/cid_<? echo $carrier_label; ?>.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">What is this</a>?</span></td>"WhatIsESN.style.visibility='visible';"-->
					<td>
						<div id="WhatIsESN" style="position:absolute; top:400; left:500; z-index:1; visibility:hidden" onClick="WhatIsESN.style.visibility='hidden';">
							<table width="320" border="1" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border-style:solid; border-width:1; border-color:#000000;">
							<tr>
								<td>
									<table width="100% border="0" cellspacing="0" cellpadding="0" class="smallBlack">
									<tr>
										<td valign="top">
											Short for <u><strong>E</strong></u>lectronic <u><strong>S</strong></u>erial <u><strong>N</strong></u>umber, a unique identification number that every cellular phone has and is assigned by the specific manufacturer.<br><br>In addition to being programmed into the circuitry of the phone's microchip, the ESN typically is found on a label under the cellular phone's battery.
										</td>
										<td align="right">
											<a onClick="hide('WhatIsESN');" class="smallBlack" style="text-decoration:none; cursor:pointer;">Close</a><br>
											<img src="images/ESN.gif" alt="" width="125" border="0">
										</td>
									</tr>
									</table>
								</td>
							</tr>						
						</table>
						</div>
						<input type="text" name="esn" id="esn" value="" size="8" maxlength="8" style="width:300px;">
						<span class="smallBlack"> <a onClick="show('WhatIsESN');" class="smallBlack" style="text-decoration:underline; cursor:pointer;">What is this?</span>
					</td>
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
					<td><input type="checkbox" name="change_voice_plan" id="change_voice_plan" onClick="enableVoicePlans(this.form);" value="T">&nbsp;Change my calling plan.</td>
				</tr>
				<tr>
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"><br>New Calling Plan:</td>
					<td>
						<select name="new_voice_plan" id="new_voice_plan" style="width:300px;" disabled>
							<option value="">No Change</option>
							<option disabled>------------------------</option>
							<?
							// Not the most efficient way to do this, but the list is short...
							$aPlans = explode(',',$plans); //from site config
							foreach($aPlans as $number){
								$query = "SELECT * FROM plans WHERE display = 'T' AND plan_type = 'V' AND plan_id = '".$number."'";
								$result = mysql_query($query, $linkID);
								$row = mysql_fetch_assoc($result);
								echo'
							<option value="'.$row["plan_name"].'">'.$row["plan_name"].' ($'.$row["plan_cost"].')</option>
								';
							}
							?>
						</select><br>
						<span class="smallBlack"><strong>Note:</strong> Pricing is standard retail pricing and does not reflect<br>any special discounts your organization may receive.</span><br>
					</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"><br>Vision Plan:</td>
					<td>
						<table border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="radio" name="vision_plan" id="vision_plan" value="None" checked> None</td>
						</tr>
						<?
						$query = "SELECT * FROM plans WHERE display = 'T' AND plan_type = 'D' ORDER BY plan_id";
						$result = mysql_query($query, $linkID);
							for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
								$row = mysql_fetch_assoc($result);
								echo'
						<tr>
							<td>
								<input type="radio" name="vision_plan" id="vision_plan" value="'.$row["plan_name"].'"> '.$row["plan_name"].' ($'.$row["plan_cost"].')
								';
								if ($row["plan_note"] != ""){
									echo' <span class="smallBlack"><em>*'.$row["plan_note"].'</em></span>';
								}
								echo'
							</td>
						</tr>
								';
							}
						?>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"><br>BlackBerry Plan:</td>
					<td>
						<table border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="radio" name="blackberry_plan" id="blackberry_plan" value="N/A" checked> Not Applicable</td>
						</tr>
						<?
						$query = "SELECT * FROM plans WHERE display = 'T' AND plan_type = 'B' ORDER BY plan_id";
						$result = mysql_query($query, $linkID);
							for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
								$row = mysql_fetch_assoc($result);
								echo'
						<tr>
							<td>
								<input type="radio" name="blackberry_plan" id="blackberry_plan" value="'.$row["plan_name"].'"> '.$row["plan_name"].' ($'.$row["plan_cost"].')
								';
								if ($row["plan_note"] != ""){
									echo' <span class="smallBlack"><em>*'.$row["plan_note"].'</em></span>';
								}
								echo'
							</td>
						</tr>
								';
							}
						?>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"><br>Text Messaging Plan:</td>
					<td>
						<table border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="radio" name="text_plan" id="text_plan" value="None" checked> None</td>
						</tr>
						<?
						$query = "SELECT * FROM plans WHERE display = 'T' AND plan_type = 'T' ORDER BY plan_id";
						$result = mysql_query($query, $linkID);
							for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
								$row = mysql_fetch_assoc($result);
								echo'
						<tr>
							<td>
								<input type="radio" name="text_plan" id="text_plan" value="'.$row["plan_name"].'"> '.$row["plan_name"].' ($'.$row["plan_cost"].')
								';
								if ($row["plan_note"] != ""){
									echo' <span class="smallBlack"><em>*'.$row["plan_note"].'</em></span>';
								}
								echo'
							</td>
						</tr>
								';
							}
						?>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"><br>Options:</td>
					<td>
						<table border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
						<?
						$query = "SELECT * FROM plans WHERE display = 'T' AND plan_type = 'O' ORDER BY plan_id";
						$result = mysql_query($query, $linkID);
							for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
								$row = mysql_fetch_assoc($result);
								echo'
						<tr>
							<td>
								<input type="checkbox" name="option'.$counter.'" id="option'.$counter.'" value="'.$row["plan_name"].'"> '.$row["plan_name"].' ($'.$row["plan_cost"].')
								';
								if ($row["plan_note"] != ""){
									echo' <span class="smallBlack"><em>*'.$row["plan_note"].'</em></span>';
								}
								echo'
							</td>
						</tr>
								';
							}
						?>
						</table>
					</td>
				</tr>

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
					<td align="right">Requester Email Address:</td>
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
				<input type="hidden" name="request_type" value="swap">
				<input type="hidden" name="task" value="swapplan">
				</form>
			</td>
		</tr>
		</table>
		<br>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="920" height="5" border="0"></td>
</tr>
</table>

<!-- END Include swapdevice.php -->
