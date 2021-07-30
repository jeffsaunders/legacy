<!-- BEGIN INCLUDE manage.php -->

<!-- Interactivity Scripts -->
<script>
function fillManufacturer(theForm){
	if (theForm.manufacturer.value == "other"){
		theForm.manufacturer_other.value = '';
		theForm.manufacturer_other.disabled = false;
		theForm.manufacturer_other.focus();
	}else{
		theForm.manufacturer_other.value = theForm.manufacturer.value;
		theForm.manufacturer_other.disabled = true;
		theForm.model.focus();
	}
}
</script>

<!-- Validation Script -->
<script>
function validate(theForm){
// Manage Users
	// User Level
	if (theForm.user_level){
		if (theForm.user_level.value == ""){
			theForm.user_level.style.background="#FF0000";
			alert("Please Select A User Level");
			theForm.user_level.style.background="#FFFFFF";
			theForm.user_level.focus();
			return false;
		}
	}
	// User Name
	if (theForm.username){
		if (theForm.username.value == ""){
			theForm.username.style.background="#FF0000";
			alert("Please Enter A User Name");
			theForm.username.style.background="#FFFFFF";
			theForm.username.focus();
			return false;
		}
	}
	// User Name
	if (theForm.password){
		if (theForm.password.value == ""){
			theForm.password.style.background="#FF0000";
			alert("Please Enter A Password");
			theForm.password.style.background="#FFFFFF";
			theForm.password.focus();
			return false;
		}
		if (theForm.password.value != theForm.password2.value){
			theForm.password.style.background="#FF0000";
			theForm.password2.style.background="#FF0000";
			alert("Passwords Don't Match - Please Re-Enter Passwords");
			theForm.password.style.background="#FFFFFF";
			theForm.password2.style.background="#FFFFFF";
			theForm.password.focus();
			return false;
		}
	}
// Manage Devices
	// manufacturer
	if (theForm.manufacturer){
		if (theForm.manufacturer.value == "other" || theForm.manufacturer.value == ""){
			if (theForm.manufacturer_other.value == ""){
				theForm.manufacturer_other.style.background="#FF0000";
				alert("Please Enter The Device Manufacturer");
				theForm.manufacturer_other.style.background="#FFFFFF";
				theForm.manufacturer_other.focus();
				return false;
			}
		}
	}
	// model
	if (theForm.model){
		if (theForm.model.value == ""){
			theForm.model.style.background="#FF0000";
			alert("Please Enter The Device Model");
			theForm.model.style.background="#FFFFFF";
			theForm.model.focus();
			return false;
		}
	}
	return true;
}
</script>

<?
if (!$task) $task = "list_users";
if ($task == "list_users"){
	$title = "Site Users";
	$message = "The following is a list of the current site users:";
	$instructions = "";
}elseif ($task == "edit_user"){
	$title = "Site Users";
	$message = "Please make any changes below and click submit:";
	$instructions = "Any changes made via this form will be immediate. Deletions are permanent.";
}elseif ($task == "add_user"){
	$title = "Site Users";
	$message = "Please enter the following information to add a new site user:";
	$instructions = "";
}elseif ($task == "list_devices"){
	$title = "Authorized Devices";
	$message = "The following is a list of the devices currently entered:";
	$instructions = "Items marked as \"Available\" populate the list of available devices on the site forms.";
}elseif ($task == "add_device"){
	$title = "Authorized Devices";
	$message = "Please enter the following information to add a new device:";
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
	<td class="bodyBlack"><strong><? echo $message; ?></strong><br><br></td>
</tr>
<? if ($instructions != ""){ ?>
<tr>
	<td align="center">
		<table border="0" cellspacing="0" cellpadding="0" align="center">
			<td width="500" class="bodyBlack"><em><? echo $instructions; ?></em><br><br></td>
		</table>
	</td>
</tr>
<? } ?>

<!-- LIST USERS -->
<? if ($task == "list_users"){ ?>
<?
$query = "SELECT * FROM users ORDER BY user_level DESC, username ASC";
$rs_users = mysql_query($query, $linkID);
?>
<tr>
	<td class="smallBlack"><br><strong>Administrator Level Users</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="4" class="bodyBlack">
		<tr bgcolor="000000" class="bodyWhite">
			<th width="90">User Name</th>
			<th width="90">User ID</th>
			<th width="90">First Name</th>
			<th width="90">Last Name</th>
			<th width="160">Phone Number</th>
			<th width="20">&nbsp;&nbsp;~</th>
		</tr>
	<?
	$hit = 0;
	for ($counter=1; $counter <= mysql_num_rows($rs_users); $counter++){
		$user = mysql_fetch_assoc($rs_users);
		if ($user["user_level"] == "Admin"){
			$hit++;
			$bg = iif(is_even($hit),"#F8F8F8","#E0E0E0");
	?>
		<tr bgcolor="<? echo $bg; ?>">
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["username"]; ?></td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo $user["user_id"]; ?></td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo $user["first_name"]; ?></td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo $user["last_name"]; ?></td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo $user["phone_num"]; ?></td>
			<td align="center" style="border-left: 1px solid #FFFFFF;"><a href="?sec=manage&task=edit_user&cargo=<? echo $user["username"]; ?>" class="bodyBlack">Edit</a></td>
		</tr>
	<?
		 }
	}
	 ?>
		</table>
	</td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td class="smallBlack"><br><strong>Assistance Level Users</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5" class="bodyBlack">
		<tr bgcolor="000000" class="bodyWhite">
			<th width="90">User Name</th>
			<th width="90">User ID</th>
			<th width="90">First Name</th>
			<th width="90">Last Name</th>
			<th width="160">Phone Number</th>
			<th width="20">&nbsp;&nbsp;~</th>
		</tr>
	<?
	$hit = 0;
	mysql_data_seek($rs_users, 0);
	for ($counter=1; $counter <= mysql_num_rows($rs_users); $counter++){
		$user = mysql_fetch_assoc($rs_users);
		if ($user["user_level"] == "Asst"){
			$hit++;
			$bg = iif(is_even($hit),"#F8F8F8","#E0E0E0");
	?>
		<tr bgcolor="<? echo $bg; ?>">
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["username"]; ?></td>
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["user_id"]; ?></td>
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["first_name"]; ?></td>
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["last_name"]; ?></td>
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["phone_num"]; ?></td>
			<td align="center" style="border-left: 1px solid #FFFFFF;"><a href="?sec=manage&task=edit_user&cargo=<? echo $user["username"]; ?>" class="bodyBlack">Edit</a></td>
		</tr>
	<?
		 }
	}
	 ?>
		</table>
	</td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td class="smallBlack"><br><strong>User Level Users</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5" class="bodyBlack">
		<tr bgcolor="000000" class="bodyWhite">
			<th width="90">User Name</th>
			<th width="90">User ID</th>
			<th width="90">First Name</th>
			<th width="90">Last Name</th>
			<th width="160">Phone Number</th>
			<th width="20">&nbsp;&nbsp;~</th>
		</tr>
	<?
	$hit = 0;
	mysql_data_seek($rs_users, 0);
	for ($counter=1; $counter <= mysql_num_rows($rs_users); $counter++){
		$user = mysql_fetch_assoc($rs_users);
		if ($user["user_level"] == "User"){
			$hit++;
			$bg = iif(is_even($hit),"#F8F8F8","#E0E0E0");
	?>
		<tr bgcolor="<? echo $bg; ?>">
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["username"]; ?></td>
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["user_id"]; ?></td>
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["first_name"]; ?></td>
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["last_name"]; ?></td>
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["phone_num"]; ?></td>
			<td align="center" style="border-left: 1px solid #FFFFFF;"><a href="?sec=manage&task=edit_user&cargo=<? echo $user["username"]; ?>" class="bodyBlack">Edit</a></td>
		</tr>
	<?
		 }
	}
	 ?>
		</table>
	</td>
</tr>
<tr>
	<td align="center">
	<br>
		<input type="button" name="add" id="add" value="Add a New User" style="width:190px;" onClick="window.location='?sec=manage&task=add_user';">
	</td>
</tr>
</table>
<? } ?>

<!-- ADD USER -->
<? if ($task == "add_user"){ ?>
<form action="dbaccess.php" method="post" name="add_user" id="add_user" onSubmit="return validate(this);">
<tr>
	<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Add New User</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
		<tr>
			<td width="250" align="right">User Level:</td>
			<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
			<td width="340">
				<select name="user_level" id="user_level" style="width:200px;">
					<option value="">Select</option>
					<option disabled>------------------------</option>
					<option value="Admin">Administrator</option>
					<option value="Asst">Assistant</option>
					<option value="User">User</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">User Name:</td>
			<td><input type="text" name="username" id="username" value="" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">Password:</td>
			<td><input type="password" name="password" id="password" value="" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">Retype Password:</td>
			<td><input type="password" name="password2" id="password2" value="" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">User's First Name:</td>
			<td><input type="text" name="first_name" id="first_name" value="" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">User's Last Name:</td>
			<td><input type="text" name="last_name" id="last_name" value="" size="50" maxlength="50" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">User's ID:</td>
			<td><input type="text" name="user_id" id="user_id" value="" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">User's Phone Number:</td>
			<td><input type="text" name="phone_num" id="phone_num" value="" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
</table>
<input type="hidden" name="task" value="add_user">
</form>
<? } ?>

<!-- EDIT USER -->
<? if ($task == "edit_user"){ ?>
<?
$query = "SELECT * FROM users WHERE username = '".$_REQUEST['cargo']."'";
$rs_users = mysql_query($query, $linkID);
	$user = mysql_fetch_assoc($rs_users);
?>
<form action="dbaccess.php" method="post" name="edit_user" id="edit_user" onSubmit="return validate(this);">
<tr>
	<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Edit User</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
		<tr>
			<td width="250" align="right">User Level:</td>
			<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
			<td width="340">
				<select name="user_level" id="user_level" style="width:200px;">
					<option value="">Select</option>
					<option disabled>------------------------</option>
					<option value="Admin" <? echo iif($user["user_level"] == "Admin", "selected", ""); ?>>Administrator</option>
					<option value="Asst" <? echo iif($user["user_level"] == "Asst", "selected", ""); ?>>Assistant</option>
					<option value="User" <? echo iif($user["user_level"] == "User", "selected", ""); ?>>User</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">User Name:</td>
			<td><input type="text" name="username" id="username" value="<? echo $user["username"]; ?>" size="50" maxlength="25" style="width:200px;" disabled></td>
		</tr>
		<tr>
			<td align="right">Password:</td>
			<td><input type="password" name="password" id="password" value="<? echo $user["password"]; ?>" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">Retype Password:</td>
			<td><input type="password" name="password2" id="password2" value="<? echo $user["password"]; ?>" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">User's First Name:</td>
			<td><input type="text" name="first_name" id="first_name" value="<? echo $user["first_name"]; ?>" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">User's Last Name:</td>
			<td><input type="text" name="last_name" id="last_name" value="<? echo $user["last_name"]; ?>" size="50" maxlength="50" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">User's ID:</td>
			<td><input type="text" name="user_id" id="user_id" value="<? echo $user["user_id"]; ?>" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">User's Phone Number:</td>
			<td><input type="text" name="phone_num" id="phone_num" value="<? echo $user["phone_num"]; ?>" size="50" maxlength="25" style="width:200px;"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<script>
	function deleteIt(){
		var answer = confirm("Confirm Delete!");
		if (answer){
			window.location='dbaccess.php?task=del_user&username=<? echo $user["username"]; ?>';
		}
	}
	</script>
	<input type="button" name="delete" id="delete" value="Delete This User" style="width:190px;" onClick="deleteIt();">
	</td>
</tr>
</table>
<? // This seemily redundent field is here because we still need to pass this value for the update & the form field is purposely disabled above so it doesn't send it.?>
<input type="hidden" name="username" value="<? echo $user["username"]; ?>">
<input type="hidden" name="task" value="edit_user">
</form>
<? } ?>


<!-- LIST DEVICES -->
<? if ($task == "list_devices"){ ?>
<?
$query = "SELECT * FROM devices ORDER BY manufacturer ASC, model ASC";
$rs_devices = mysql_query($query, $linkID);
?>
<tr>
	<td class="smallBlack"><br><strong>Devices</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="bodyBlack">
		<tr bgcolor="000000" class="bodyWhite">
			<th width="150">Manufacturer</th>
			<th width="350">Model</th>
			<th width="100">Available</th>
		</tr>
	<?
	for ($counter=1; $counter <= mysql_num_rows($rs_devices); $counter++){
		$device = mysql_fetch_assoc($rs_devices);
		$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
		<tr bgcolor="<? echo $bg; ?>">
			<td style="border-right: 1px solid #FFFFFF;"><? echo iif($device["available"] == "T", "<strong>", ""); ?><? echo $device["manufacturer"]; ?></strong></td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($device["available"] == "T", "<strong>", ""); ?><? echo $device["model"]; ?></strong></td>
			<td align="center" style="border-left: 1px solid #FFFFFF;"><? echo iif($device["available"] == "T", "<strong>Yes</strong>", "No"); ?></td>
		</tr>
	<? } ?>
		</table>
	</td>
</tr>
<tr>
	<td align="center">
	<br>
		<input type="button" name="add" id="add" value="Add a New Device" style="width:190px;" onClick="window.location='?sec=manage&task=add_device';">&nbsp;&nbsp;
		<input type="button" name="edit" id="edit" value="Edit This List" style="width:190px;" onClick="window.location='?sec=manage&task=edit_devices';">
	</td>
</tr>
</table>
<? } ?>

<!-- ADD DEVICE -->
<? if ($task == "add_device"){ ?>
<form action="dbaccess.php" method="post" name="add_device" id="add_device" onSubmit="return validate(this);">
<tr>
	<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Add New Device</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
		<tr>
			<td align="right">Select Manufacturer:</td>
			<td>
				<select name="manufacturer" id="manufacturer" onchange="fillManufacturer(this.form);" style="width:200px;">
					<option value="">Select</option>
					<option disabled>------------------------</option>
					<option value="Cingular">Cingular Branded</option>
					<option value="HP">Hewlett-Packard (HP)</option>
					<option value="LG">LG</option>
					<option value="Motorola">Motorola</option>
					<option value="Nokia">Nokia</option>
					<option value="Option">Option</option>
					<option value="Palm">Palm</option>
					<option value="Pantech">Pantech</option>
					<option value="RIM">RIM (BlackBerry)</option>
					<option value="Samsung">Samsung</option>
					<option value="Sierra Wireless">Sierra Wireless</option>
					<option value="Sony Ericsson">Sony Ericsson</option>
					<option value="other">Other</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Device Manufacturer:</td>
			<td><input type="text" name="manufacturer_other" id="manufacturer_other" value="" size="50" maxlength="50" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right">Device Model:</td>
			<td><input type="text" name="model" id="model" value="" size="50" maxlength="50" style="width:200px;"></td>
		</tr>
		<tr>
			<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>Available:</td>
			<td>
				<input type="radio" name="available" id="available" value="T" checked>&nbsp;Yes<br>
				<input type="radio" name="available" id="available" value="F">&nbsp;No
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
</table>
<input type="hidden" name="task" value="add_device">
</form>
<? } ?>

<!-- EDIT DEVICES -->
<? if ($task == "edit_devices"){ ?>
<?
$query = "SELECT * FROM devices ORDER BY manufacturer ASC, model ASC";
$rs_devices = mysql_query($query, $linkID);
?>
<form action="dbaccess.php" method="get" name="edit_devices" id="edit_devices" onSubmit="return validateMultiple(this);">
<tr>
	<td class="smallBlack"><br><strong>Edit Devices</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="bodyBlack">
		<tr bgcolor="000000" class="bodyWhite">
			<th width="200">Manufacturer</th>
			<th width="200">Model</th>
			<th width="125">Available</th>
			<th width="75"></th>
		</tr>
	<?
	for ($counter=1; $counter <= mysql_num_rows($rs_devices); $counter++){
		$device = mysql_fetch_assoc($rs_devices);
		$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
		<tr bgcolor="<? echo $bg; ?>">
			<td style="border-right: 1px solid #FFFFFF;">
				<input type="text" name="manufacturer<? echo $counter; ?>" id="manufacturer<? echo $counter; ?>" value="<? echo $device["manufacturer"]; ?>" size="50" maxlength="50" style="width:192px;">
			</td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;">
				<input type="text" name="model<? echo $counter; ?>" id="model<? echo $counter; ?>" value="<? echo $device["model"]; ?>" size="50" maxlength="50" style="width:192px;">
			</td>
			<td align="center" style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;">
				<input type="radio" name="available<? echo $counter; ?>" id="available<? echo $counter; ?>" value="T"<? echo iif($device["available"] == "T", " checked", ""); ?>>&nbsp;Yes&nbsp;
				<input type="radio" name="available<? echo $counter; ?>" id="available<? echo $counter; ?>" value="F"<? echo iif($device["available"] == "T", "", " checked"); ?>>&nbsp;No
			</td>
			<td style="border-left: 1px solid #FFFFFF;"><input type="checkbox" name="delete<? echo $counter; ?>" value="T">&nbsp;Delete</td>
		</tr>
		<input type="hidden" name="unique_id<? echo $counter; ?>" value="<? echo $device["unique_id"]; ?>">
	<? } ?>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
<input type="hidden" name="counter" value="<? echo $counter-1; ?>">
<input type="hidden" name="task" value="edit_device">
</table>

<script>
// Special Validation Script for this section only - uses $counter to build dynamically
function validateMultiple(theForm){
	<? for ($counter=1; $counter <= mysql_num_rows($rs_devices); $counter++){ ?>
	if (theForm.manufacturer<? echo $counter; ?>.value == ""){
		theForm.manufacturer<? echo $counter; ?>.style.background="#FF0000";
		alert("Please Enter The Device Manufacturer");
		theForm.manufacturer<? echo $counter; ?>.style.background="#FFFFFF";
		theForm.manufacturer<? echo $counter; ?>.focus();
		return false;
	}
	if (theForm.model<? echo $counter; ?>.value == ""){
		theForm.model<? echo $counter; ?>.style.background="#FF0000";
		alert("Please Enter The Device Model");
		theForm.model<? echo $counter; ?>.style.background="#FFFFFF";
		theForm.model<? echo $counter; ?>.focus();
		return false;
	}

	<? } ?>
	<? for ($counter=1; $counter <= mysql_num_rows($rs_devices); $counter++){ ?>
	if (theForm.delete<? echo $counter; ?>.checked){
		var answer = confirm("Confirm Delete of "+theForm.manufacturer<? echo $counter; ?>.value+" "+theForm.model<? echo $counter; ?>.value+"!");
		if (!answer){
			return false; // Bail immediately
		}
	}
	<? } ?>
	return true;
}
</script>

<? } ?>

<!-- END INCLUDE manage.php -->

