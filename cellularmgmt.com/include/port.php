<!-- BEGIN INCLUDE port.php -->

<!-- Interactivity Scripts -->
<script>
function fillDevice(){
	var device_array = port.device.value.split("|")
	if (device_array[0] == "other"){
		port.device_manufacturer.value = '';
		port.device_manufacturer.readOnly = false;
		port.device_manufacturer.style.color = "#000000";
		port.device_manufacturer.focus();
		port.device_model.value = '';
		port.device_model.readOnly = false;
		port.device_model.style.color = "#000000";
		port.device_manufacturer.focus();
	}else{
		port.device_manufacturer.value = device_array[0];
		port.device_manufacturer.readOnly = true;
		port.device_manufacturer.style.color = "#C0C0C0";
		port.device_model.value = device_array[1];
		port.device_model.readOnly = true;
		port.device_model.style.color = "#C0C0C0";
		port.imei.focus();
	}
}

function checkTaxID(){
	if (port.acct_type[0].checked){
		port.tax_id.value = '';
		port.tax_id.readOnly = true;
		port.tax_id.style.color = "#C0C0C0";
	}else if (port.acct_type[1].checked){
		port.tax_id.readOnly = false;
		port.tax_id.style.color = "#000000";
		port.tax_id.focus();
	}
}

function fillCarrier(){
	if (port.carrier.value == "other"){
		port.port_from.value = '';
		port.port_from.disabled = false;
		port.port_from.focus();
	}else{
		port.port_from.value = port.carrier.value;
		port.port_from.disabled = true;
		port.bill_name.focus();
	}
}
</script>

<!-- Validation Script -->
<script>
function validate(theForm){
// Device Information
	// Device
	if (theForm.device){
//		if (theForm.device.value == "other"){
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
// Account Information
	// Phone Number
	if (theForm.port_num){
		if (theForm.port_num.value == ""){
			theForm.port_num.style.background="#FF0000";
			alert("Please Enter Phone Number");
			theForm.port_num.style.background="#FFFFFF";
			theForm.port_num.focus();
			return false;
		}
		var port_num_regex1 = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
		var port_num_regex2 = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
		if (port_num_regex1.test(theForm.port_num.value) == false && port_num_regex2.test(theForm.port_num.value) == false) { 
			theForm.port_num.style.background="#FF0000";
			alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
			theForm.port_num.style.background="#FFFFFF";
			theForm.port_num.focus();
			return false;
		}
	}
	// Tax ID
	if (theForm.tax_id){
		if (theForm.acct_type[1].checked && theForm.tax_id.value == ""){
			theForm.tax_id.style.background="#FF0000";
			alert("Please Enter Company Tax ID");
			theForm.tax_id.style.background="#FFFFFF";
			theForm.tax_id.focus();
			return false;
		}
	}
	// Carrier
	if (theForm.carrier){
		if (theForm.carrier.value == "other"){
			if (theForm.port_from.value == ""){
				theForm.port_from.style.background="#FF0000";
				alert("Please Enter The Carrier Transferring From");
				theForm.port_from.style.background="#FFFFFF";
				theForm.port_from.focus();
				return false;
			}
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
	if (theForm.from_acct_num){
		if (theForm.from_acct_num.value == ""){
			theForm.from_acct_num.style.background="#FF0000";
			alert("Please Enter Account Number");
			theForm.from_acct_num.style.background="#FFFFFF";
			theForm.from_acct_num.focus();
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

<form action="dbaccess.php" method="post" name="port" id="port" onSubmit="return validate(this);">

<?
if (!$task || ($task != "port" && $task != "migrate" && $task != "transfer")) $task = "port";
if ($task == "port"){
	$title = "Port Your Phone to AT&amp;T";
	$message = "Please enter the following information to port your number to AT&amp;T:";
	$instructions = "* All fields required unless otherwise noted.";
	echo'<input type="hidden" name="port_type" value="port">';
}elseif ($task == "migrate"){
	$title = "Migrate from the old AT&amp;T Wireless";
	$message = "Please enter the following information to migrate your old AT&amp;T account to the new AT&amp;T:";
	$instructions = "* All fields required unless otherwise noted.";
	echo'<input type="hidden" name="port_type" value="migrate">';
}elseif ($task == "transfer"){
	$title = "Transfer Your Personal Number to Google";
	$message = "Please enter the following information to transfer your account liability to Google:";
	$instructions = "You must contact Cingular and authorize them to transfer liability from your personal account BEFORE submitting the following form.<br><br>You can contact Cingular customer care at: 800-331-0500. Be prepared to provide them with your account number and password (if applicable).<br><br>* All fields required unless otherwise noted.";
	echo'<input type="hidden" name="port_type" value="transfer">';
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

<!-- Header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="40" border="0"></td>
</tr>
<tr>
	<td width="100%" height="25" bgcolor="#EFEFEF" style="border-top: 2px solid #AA0000;" class="bigBlack">&nbsp;&nbsp;<strong><? echo $title; ?></strong></td>
</tr>
</table>

<br>

<!-- Form -->
<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td colspan="3" class="bodyBlack"><strong><? echo $message; ?></strong><br><br></td>
</tr>
<?
// Show only if there are instructions defined
if ($instructions != ""){
?>
<tr>
	<td colspan="3" align="center">
		<table border="0" cellspacing="0" cellpadding="0" align="center">
			<td width="500" class="bodyBlack"><em><? echo $instructions; ?></em><br><br></td>
		</table>
	</td>
</tr>
<?
// End show only if there are instructions defined
}
?>

<!-- Device Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>New Device Information</strong></td>
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
		<select name="device" id="device" onchange="fillDevice();" style="width:200px;">
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
<tr>
	<td align="right">SIM ICC ID Number:</td>
	<td><input type="text" name="sim_icc" id="sim_icc" value="" size="20" maxlength="20" style="width:200px;"></td>
</tr>

<!-- User Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>User Information</strong></td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<?
// Show only on migrate form
if ($task == "migrate"){
?>
<tr>
	<td align="right">Current AT&amp;T Phone Number:</td>
	<td><input type="text" name="port_num" id="port_num" value="" size="15" maxlength="15" style="width:200px;"></td>
</tr>
<?
}
?>
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

<!-- Account Information -->
<?
// Show only on port and transfer forms
if ($task == "port" || $task == "transfer"){
?>
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Account Information</strong></td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Phone Number to <? echo iif($task == "port", "Port", "Transfer"); ?>:</td>
	<td><input type="text" name="port_num" id="port_num" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
	<?
	// Show only on port form
	if ($task == "port"){
	?>
<tr>
	<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>Account Type:</td>
	<td>
		<input type="radio" name="acct_type" id="acct_type" onchange="checkTaxID();" value="personal" checked>&nbsp;Personal<br>
		<input type="radio" name="acct_type" id="acct_type" onchange="checkTaxID();" value="corporate">&nbsp;Corporate
	</td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="3" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="3" border="0"></td>
</tr>
<tr>
	<td align="right">Company Tax ID:</td>
	<td><input type="text" name="tax_id" id="tax_id" value="" size="50" maxlength="50" style="width:200px;" readOnly></td>
</tr>
<tr>
	<td align="right">Carrier Transferring From:</td>
	<td>
	<!-- POPULATE THIS FROM DB! -->
		<select name="carrier" id="carrier" onchange="fillCarrier();" style="width:200px;" <? echo iif($task == "migrate", "disabled", ""); ?>>
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
	<td align="right">Transferring From (Other):</td>
	<td><input type="text" name="port_from" id="port_from" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
	<?
	// End show only on port form
	}
	?>
<tr>
	<td align="right">Name as it appears on bill:</td>
	<td><input type="text" name="bill_name" id="bill_name" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Billing Address:</td>
	<td><input type="text" name="bill_address1" id="bill_address1" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right"></td>
	<td><input type="text" name="bill_address2" id="bill_address2" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Billing City:</td>
	<td><input type="text" name="bill_city" id="bill_city" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Billing State:</td>
	<td>
		<select name="bill_state" id="bill_state" style="width:200px;">
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
	<td><input type="text" name="bill_zipcode" id="bill_zipcode" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Account Number:</td>
	<td><input type="text" name="from_acct_num" id="from_acct_num" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Account Password:</td>
	<td><input type="text" name="from_acct_pass" id="from_acct_pass" value="" size="50" maxlength="50" style="width:200px;"><span class="smallBlack">&nbsp;*Optional</span></td>
</tr>
<?
}
?>

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
	<td><input type="text" name="requester_name" id="contact_name" value="<? echo $_SESSION['user']; ?>" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td><input type="text" name="requester_phone" id="contact_phone" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Email:</td>
	<td><input type="text" name="requester_email" id="contact_email" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br><br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
</table>
<input type="hidden" name="task" value="add_port">
</form>

<!-- END INCLUDE port.php -->
