<!-- BEGIN Include stop.php -->

<?
$tab_label = "Stop Service";
$message = "Please enter the following information to stop your service:";
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
// Reason for Stopping Service
	// Note (Reason)
	if (theForm.stop_reason){
		if (theForm.stop_reason.value == ""){
			theForm.stop_reason.style.background="#FF0000";
			alert("Please Explain Your Reason For Stopping Service");
			theForm.stop_reason.style.background="#FFFFFF";
			theForm.stop_reason.focus();
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
					<td align="right">Wireless Number:</td>
					<td><input type="text" name="current_num" id="current_num" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>

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
					<td><textarea cols="20" rows="3" name="stop_reason" id="stop_reason" style="width:300px;"></textarea></td>
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
				<input type="hidden" name="request_type" value="stop">
				<input type="hidden" name="task" value="stop">
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

<!-- END Include stop.php -->
