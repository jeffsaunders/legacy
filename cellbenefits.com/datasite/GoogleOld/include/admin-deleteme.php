<!-- BEGIN INCLUDE admin.php -->

<!-- Interactivity Scripts -->
<script>
function fillDevice(ID){
	var device_array = document.getElementById(ID).device.value.split("|")
//alert(document.getElementById(ID).id);
	if (device_array[0] == "other" || device_array[0] == ""){
		document.getElementById(ID).device_manufacturer.value = '';
		document.getElementById(ID).device_manufacturer.disabled = false;
		document.getElementById(ID).device_manufacturer.focus();
		document.getElementById(ID).device_model.value = '';
		document.getElementById(ID).device_model.disabled = false;
	}else{
		document.getElementById(ID).device_manufacturer.value = device_array[0];
		document.getElementById(ID).device_manufacturer.disabled = true;
		document.getElementById(ID).device_model.value = device_array[1];
		document.getElementById(ID).device_model.disabled = true;
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
	if (document.getElementById(ID).carrier_from.value == "other" || document.getElementById(ID).carrier_from.value == ""){
		document.getElementById(ID).carrier_from_other.value = '';
		document.getElementById(ID).carrier_from_other.disabled = false;
		document.getElementById(ID).carrier_from_other.focus();
	}else{
		document.getElementById(ID).carrier_from_other.value = document.getElementById(ID).carrier_from.value;
		document.getElementById(ID).carrier_from_other.disabled = true;
		document.getElementById(ID).carrier_to.focus();
	}
}

function fillCarrierTo(ID){
	if (document.getElementById(ID).carrier_to.value == "other" || document.getElementById(ID).carrier_to.value == ""){
		document.getElementById(ID).carrier_to_other.value = '';
		document.getElementById(ID).carrier_to_other.disabled = false;
		document.getElementById(ID).carrier_to_other.focus();
	}else{
		document.getElementById(ID).carrier_to_other.value = document.getElementById(ID).carrier_to.value;
		document.getElementById(ID).carrier_to_other.disabled = true;
		document.getElementById(ID).requester_name.focus();
	}
}
</script>

<?
if (!$cargo) $cargo = "approve";
if ($cargo == "unlock"){
	$title = "Unlock GSM Device";
	$message = "Please enter the following information to unlock a GSM device:";
	$instructions = "";
//	echo'<input type="hidden" name="change_type" value="plan">';
}elseif ($cargo == "bulk_order"){
	$title = "Bulk Order";
	$message = "Please enter the following information to bulk order devices:";
	$instructions = "";
//	echo'<input type="hidden" name="change_type" value="number">';
}elseif ($cargo == "rma"){
	$title = "RMA Request";
	$message = "Please enter the following information to initiate an RMA request:";
	$instructions = "";
//	echo'<input type="hidden" name="change_type" value="username">';
}elseif ($cargo == "update_line"){
	$title = "Update Line of Service";
	$message = "Please enter the following information to update a line of service record:";
	$instructions = "";
//	echo'<input type="hidden" name="change_type" value="stop">';
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="40" border="0"></td>
</tr>
<tr>
	<td width="100%" height="25" bgcolor="#EFEFEF" style="border-top: 2px solid #000080;" class="bigBlack">&nbsp;&nbsp;<strong><? echo $title; ?></strong></td>
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
<? if ($cargo == "update_line"){ ?>
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
	<td><input type="text" name="phone_number" id="phone_number" value="" size="50" maxlength="50" style="width:200px;"></td>
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
	<td><input type="text" name="requester_name" id="requester_name" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="50" style="width:200px;"></td>
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
</form>
<? } ?>

<!-- UNLOCK GSM DEVICE -->
<? if ($cargo == "unlock"){ ?>
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
		<select name="carrier_from" id="carrier_from" onchange="fillCarrierFrom(form.id);" style="width:200px;">
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
	<td><input type="text" name="carrier_from_other" id="carrier_from_other" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Carrier You Plan on Using the Device with:</td>
	<td>
	<!-- POPULATE THIS FROM DB! -->
		<select name="carrier_to" id="carrier_to" onchange="fillCarrierTo(form.id);" style="width:200px;">
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
	<td><input type="text" name="carrier_to_other" id="carrier_to_other" value="" size="50" maxlength="50" style="width:200px;"></td>
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
	<td><input type="text" name="requester_name" id="requester_name" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="50" style="width:200px;"></td>
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
</form>
<? } ?>

<!-- BULK ORDERS -->
<? if ($cargo == "bulk_order"){ ?>
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
	<td><input type="text" name="areacode" id="areacode" value="" size="50" maxlength="50" style="width:200px;"></td>
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
	<td><input type="text" name="ship_address1" id="ship_address1" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right"></td>
	<td><input type="text" name="ship_address2" id="ship_address2" value="" size="50" maxlength="50" style="width:200px;"></td>
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
	<td><input type="text" name="requester_name" id="requester_name" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="50" style="width:200px;"></td>
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
</form>
<? } ?>

<!-- REQUEST RMA -->
<? if ($cargo == "rma"){ ?>
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
	<td><input type="text" name="phone_number" id="phone_number" value="" size="50" maxlength="50" style="width:200px;"></td>
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
	<td><input type="text" name="requester_name" id="requester_name" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td><input type="text" name="requester_phone" id="requester_phone" value="" size="50" maxlength="50" style="width:200px;"></td>
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
</form>
<? } ?>

<!-- END INCLUDE admin.php -->
