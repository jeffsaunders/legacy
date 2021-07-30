<!-- BEGIN INCLUDE device.php -->

<form action="dbaccess.php" method="post" name="change" id="change" onSubmit="return validate(this);">

<?
if (!$cargo) $cargo = "plan";
if ($cargo == "plan"){
	$title = "Plan Change";
	$message = "Please enter the following information to change your calling plan:";
	$instructions = "";
	echo'<input type="hidden" name="change_type" value="plan">';
}elseif ($cargo == "number"){
	$title = "Phone Number Change";
	$message = "Please enter the following information to change your wireless number:";
	$instructions = "In order to change the phone number on your device, you will need to obtain a new SIM card from one of the tech stop locations. If you do not have access to a tech stop, you have the option of having a new SIM card shipped to you";
	echo'<input type="hidden" name="change_type" value="number">';
}elseif ($cargo == "username"){
	$title = "Change Account Username";
	$message = "Please enter the following information to change the account's username:";
	$instructions = "";
	echo'<input type="hidden" name="change_type" value="username">';
}elseif ($cargo == "stop"){
	$title = "Stop Service";
	$message = "Please enter the following information to stop your service:";
	$instructions = "";
	echo'<input type="hidden" name="change_type" value="stop">';
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

<!-- Top Section -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>User Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">User First Name:</td>
	<td><input type="text" name="first_name" id="first_name" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">User Last Name:</td>
	<td><input type="text" name="last_name" id="last_name" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Employee ID:</td>
	<td><input type="text" name="employee_id" id="employee_id" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Cost Center:</td>
	<td><input type="text" name="cost_center" id="cost_center" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Email Address:</td>
	<td><input type="text" name="user_email" id="user_email" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right"><? echo iif($cargo == "number", "Current ", ""); ?>Wireless Number:</td>
	<td><input type="text" name="current_num" id="current_num" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<? if ($cargo == "number"){ ?>
<tr>
	<td align="right">Device IMEI Number:</td>
	<td><input type="text" name="imei" id="imei" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<? } ?>

<!-- Middle Section -->
<? if ($cargo == "plan"){ ?>
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Plan Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">New Plan:</td>
	<td>
	<?
	$query = "SELECT * FROM plans WHERE display = 'T' ORDER BY priority";
	$rs_plans = mysql_query($query, $linkID);
	?>
		<select name="new_plan" id="new_plan" style="width:200px;">
<!--			<option value="other">Other</option>-->
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
</tr>
<? } ?>
<? if ($cargo == "number"){ ?>
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>New Phone Number Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">New SIM Card ICC ID:</td>
	<td><input type="text" name="new_sim_icc" id="new_sim_icc" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">New Area Code:</td>
	<td><input type="text" name="new_areacode" id="new_areacode" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">New City:</td>
	<td><input type="text" name="new_city" id="new_city" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">New State:</td>
	<td>
		<select name="new_state" id="new_state" style="width:200px;">
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
	<td><input type="text" name="new_zipcode" id="new_zipcode" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<? } ?>
<? if ($cargo == "username"){ ?>
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>New Username Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">New Account Username:</td>
	<td><input type="text" name="new_username" id="new_username" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<? } ?>

<!-- Bottom Section -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Contact Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Contact Name:</td>
	<td><input type="text" name="contact_name" id="contact_name" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Contact Phone Number:</td>
	<td><input type="text" name="contact_phone" id="contact_phone" value="" size="50" maxlength="50" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Contact Email:</td>
	<td><input type="text" name="contact_email" id="contact_email" value="" size="50" maxlength="50" style="width:200px;"></td>
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

<!-- END INCLUDE device.php -->
