<!-- BEGIN Include transfer.php -->

<?
$tab_label = "Transfer Liability";
$message = "Please enter the following information to transfer your account liability to ".$label.":";
$instructions = "You must contact Sprint-Nextel and authorize them to transfer liability from your personal account BEFORE submitting the following form.<br><br>You can contact Sprint Customer Care at: 888-211-4727. Be prepared to provide them with your account number and password (if applicable).<br><br><em>* All fields required unless otherwise noted.</em>";
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
// Account Information
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
	// Bill Name
	if (theForm.bill_name){
		if (theForm.bill_name.value == ""){
			theForm.bill_name.style.background="#FF0000";
			alert("Please Enter Billing Name");
			theForm.bill_name.style.background="#FFFFFF";
			theForm.bill_name.focus();
			return false;
		}
	}
	// Bill Address
	if (theForm.bill_address1){
		if (theForm.bill_address1.value == ""){
			theForm.bill_address1.style.background="#FF0000";
			theForm.bill_address2.style.background="#FF0000";
			alert("Please Enter Billing Address");
			theForm.bill_address1.style.background="#FFFFFF";
			theForm.bill_address2.style.background="#FFFFFF";
			theForm.bill_address1.focus();
			return false;
		}
	}
	// Bill City
	if (theForm.bill_city){
		if (theForm.bill_city.value == ""){
			theForm.bill_city.style.background="#FF0000";
			alert("Please Enter Billing City");
			theForm.bill_city.style.background="#FFFFFF";
			theForm.bill_city.focus();
			return false;
		}
	}
	// Bill State
	if (theForm.bill_state){
		if (theForm.bill_state.value == ""){
			theForm.bill_state.style.background="#FF0000";
			alert("Please Select Billing State");
			theForm.bill_state.style.background="#FFFFFF";
			theForm.bill_state.focus();
			return false;
		}
	}
	// Billing Zip Code
	if (theForm.bill_zipcode){
		if (theForm.bill_zipcode.value == ""){
			theForm.bill_zipcode.style.background="#FF0000";
			alert("Please Enter Billing Zipcode");
			theForm.bill_zipcode.style.background="#FFFFFF";
			theForm.bill_zipcode.focus();
			return false;
		}
		var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//		var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 		if (usa_regex.test(theForm.bill_zipcode.value) == false && cdn_regex.test(theForm.bill_zipcode.value) == false) { 
 		if (usa_regex.test(theForm.bill_zipcode.value) == false) { 
			theForm.bill_zipcode.style.background="#FF0000";
			alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
			theForm.bill_zipcode.style.background="#FFFFFF";
			theForm.bill_zipcode.focus();
			return false;
		}
	}
	// Account Number
	if (theForm.acct_num){
		if (theForm.acct_num.value == ""){
			theForm.acct_num.style.background="#FF0000";
			alert("Please Enter Account Number");
			theForm.acct_num.style.background="#FFFFFF";
			theForm.acct_num.focus();
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
				<?
				// Show only if there are instructions defined
				if ($instructions != ""){
				?>
				<tr>
					<td colspan="3" align="center">
						<table border="0" cellspacing="0" cellpadding="0" align="center">
							<td width="700" class="bodyBlack"><? echo $instructions; ?><br><br></td>
						</table>
					</td>
				</tr>
				<?
				// End show only if there are instructions defined
				}
				?>
				
				<!-- User Information -->
				<tr>
					<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>User Information</strong></td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>
				<tr>
					<td align="right">User First Name:</td>
					<td><input type="text" name="first_name" id="first_name" value="" size="25" maxlength="25" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">User Last Name:</td>
					<td><input type="text" name="last_name" id="last_name" value="" size="25" maxlength="25" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">User Employee ID:</td>
					<td><input type="text" name="employee_id" id="employee_id" value="" size="25" maxlength="25" style="width:300px;"><span class="smallBlack">&nbsp;<em>*Optional</em></span></td>
				</tr>
				<tr>
					<td align="right">User Cost Center:</td>
					<td><input type="text" name="cost_center" id="cost_center" value="" size="25" maxlength="25" style="width:300px;"><span class="smallBlack">&nbsp;<em>*Optional</em></span></td>
				</tr>
				<tr>
					<td align="right">User Email Address:</td>
					<td><input type="text" name="user_email" id="user_email" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				
				<!-- Account Information -->
				<tr>
					<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Account Information</strong></td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>
				<tr>
					<td align="right">Phone Number to Transfer:</td>
					<td><input type="text" name="current_num" id="current_num" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Name as it Appears on Bill:</td>
					<td><input type="text" name="bill_name" id="bill_name" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Billing Address:</td>
					<td><input type="text" name="bill_address1" id="bill_address1" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td><input type="text" name="bill_address2" id="bill_address2" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Billing City:</td>
					<td><input type="text" name="bill_city" id="bill_city" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Billing State:</td>
					<td>
						<select name="bill_state" id="bill_state" style="width:300px;">
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
					<td align="right">Billing Zip Code:</td>
					<td><input type="text" name="bill_zipcode" id="bill_zipcode" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Account Number:</td>
					<td><input type="text" name="acct_num" id="acct_num" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Account Password:</td>
					<td><input type="text" name="acct_pass" id="acct_pass" value="" size="50" maxlength="50" style="width:300px;"><span class="smallBlack">&nbsp;<em>*Optional</em></span></td>
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
					<td><input type="text" name="requester_name" id="contact_name" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Requester Phone Number:</td>
					<td><input type="text" name="requester_phone" id="contact_phone" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right">Requester Email Address:</td>
					<td><input type="text" name="requester_email" id="contact_email" value="" size="50" maxlength="50" style="width:300px;"></td>
				</tr>
				<tr>
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>Additional Information:</td>
					<td><textarea cols="20" rows="3" name="note" id="note" style="width:300px;"></textarea></td>
				</tr>
				<tr>
					<td colspan="3" align="center">
					<br>
					<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
				<!--	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">-->
					</td>
				</tr>
				</table>
				<input type="hidden" name="request_type" value="transfer">
				<input type="hidden" name="task" value="transfer">
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

<!-- END Include transfer.php -->
