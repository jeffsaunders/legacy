<?
if ($_REQUEST['dev'] == "T"){
	echo 'Yo Adrian!';
}else{
?>

<!-- BEGIN Include account.php -->

<!-- SSL Site Seal -->
<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

<?
// Check to see if we already have this account session started
$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
//echo $query.'<br></br>';
$rs_order = mysql_query($query, $linkID);
$order = mysql_fetch_assoc($rs_order);
// If found lock in the carrier, add to existing account, and account type selections
//if (mysql_num_rows($rs_order) > 0){
//	$locked = true;
//}else{
//	$locked = false;
//}

// If there is request data, save it!
if ($_REQUEST['PlanID'] != ""){
	// If no record found, insert one
	if (mysql_num_rows($rs_order) == false){
		$query =
			"INSERT INTO orders (
			session_id,
			order_num,
			ipaddress,
			carrier,
			affiliation,
			add_line,
			acct_type,
			plan_discount,
			creation_time)
			VALUES (
			'".$SID."',
			UNIX_TIMESTAMP(),
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['Carrier']."',
			'".$_REQUEST['Affiliation']."',
			'".$_REQUEST['AddLine']."',
			'".$_REQUEST['AcctType']."',
			'".$_REQUEST['Discount']."',
			NOW())";
//echo $query.'<br></br>';
		$rs_insert = mysql_query($query, $linkID);
//		$locked = true;
		// Refresh account info
		$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
		$rs_order = mysql_query($query, $linkID);
		$order = mysql_fetch_assoc($rs_order);
//	}else{
//		$query =
//			"UPDATE orders SET
//			session_id = '".$SID."',
//			order_num = UNIX_TIMESTAMP(),
//			ipaddress = '".getenv('REMOTE_ADDR')."',
//			carrier = '".$_REQUEST['Carrier']."',
//			affiliation = '".$_REQUEST['Affiliation']."',
//			add_line = '".$_REQUEST['AddLine']."',
//			acct_type = '".$_REQUEST['AcctType']."',
//			plan_discount = '".$_REQUEST['Discount']."',
//			creation_time = NOW()
//			WHERE session_id = '".$SID."'";
////echo $query.'<br></br>';
//		$rs_update = mysql_query($query, $linkID);
//		$locked = true;
//		// Refresh account info
//		$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
//		$rs_order = mysql_query($query, $linkID);
//		$order = mysql_fetch_assoc($rs_order);
	}
	// make sure this device hasn't already been entered
	$error = false;
	if ($_REQUEST['ESN'] <> ""){
		$query = "SELECT * FROM devices WHERE session_id='".$SID."' AND esn='".$_REQUEST['ESN']."'";
//echo $query.'<br></br>';
		$rs_device = mysql_query($query, $linkID);
		if (mysql_num_rows($rs_device) > 0){
			$message = "A Device With That ESN Has Already Been Entered";
			$error = true;
		}
	}else{
		$query = "SELECT * FROM devices WHERE session_id='".$SID."' AND (iccid='".$_REQUEST['ICCID']."' OR imei='".$_REQUEST['IMEI']."')";
//echo $query.'<br></br>';
		$rs_device = mysql_query($query, $linkID);
		if (mysql_num_rows($rs_device) > 0){
			$message = "A Device With That ICCID or IMEI Has Already Been Entered";
			$error = true;
		}
	}
	if (!$error){
		// Look up the plan info
		$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['PlanID']."'";
		$rs_plan = mysql_query($query, $linkID);
//echo $query.'<br></br>';
		$row = mysql_fetch_assoc($rs_plan);
		// Now add the device
		$query =
			"INSERT INTO devices (
			session_id,
			esn,
			iccid,
			imei,
			plan_name,
			plan_quantity,
			plan_cost,
			device_time)
			VALUES (
			'".$SID."',
			'".$_REQUEST['ESN']."',
			'".$_REQUEST['ICCID']."',
			'".$_REQUEST['IMEI']."',
			'".$row['plan_name']."',
			'".$row['quantity']."',
			'".$row['cost']."',
			NOW())";
	//echo $query.'<br></br>';
		$rs_insert = mysql_query($query, $linkID);
		// Tell 'em what you did
//		$message = "Device Added to Cart";
	}
}
?>
<?
		// Refresh account info
		$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
		$rs_order = mysql_query($query, $linkID);
		$order = mysql_fetch_assoc($rs_order);
//print_r($order);
//echo $order['add_line'];
if ($order['carrier'] == "at&t"){
	$carrier = "AT&T";
}else{
	$carrier = ucwords($order['carrier']);
}
$sAcctType = "";
if ($order['add_line'] == "No") $sAcctType .= "New ";
if ($order['add_line'] == "Yes") $sAcctType .= "Existing ";
if ($order['acct_type'] == "CL") $sAcctType .= "Business ";
if ($order['acct_type'] == "IL") $sAcctType .= "Personal ";
//$box_color = "#000000";
//$box_bg = "#E6E6E6";
//$form_bg = "#E6E6E6"; //#DD0C08
$rowcount = 0;
$roweven = "#F6F6F6";
$rowodd = "#FFFFFF";
?>
<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Activate Service</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="930" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td width="100"><img src="images/spacer.gif" alt="" width="100" height="1" border="0"></td>
			<td align="center" class="xbigBlack">
				<br><strong>Please Enter Account Information For This Activation</strong><br>
				<strong class="bigBlack"><? echo $sAcctType; ?>Account</strong>
			</td>
			<td width="100"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
		</tr>
		</table>
	</td>
</tr>

<script>
function CopyShipToBill(){
	AcctInfo.bill_address_1.value = AcctInfo.ship_address_1.value;
	AcctInfo.bill_address_2.value = AcctInfo.ship_address_2.value;
	AcctInfo.bill_city.value = AcctInfo.ship_city.value;
	AcctInfo.bill_state.value = AcctInfo.ship_state.value;
	AcctInfo.bill_zipcode.value = AcctInfo.ship_zipcode.value;
	return;
}

function CopyShipToUse(){
	AcctInfo.service_address_1.value = AcctInfo.ship_address_1.value;
	AcctInfo.service_address_2.value = AcctInfo.ship_address_2.value;
	AcctInfo.service_city.value = AcctInfo.ship_city.value;
	AcctInfo.service_state.value = AcctInfo.ship_state.value;
	AcctInfo.service_zipcode.value = AcctInfo.ship_zipcode.value;
	return;
}

function CopyBillToUse(){
	AcctInfo.service_address_1.value = AcctInfo.bill_address_1.value;
	AcctInfo.service_address_2.value = AcctInfo.bill_address_2.value;
	AcctInfo.service_city.value = AcctInfo.bill_city.value;
	AcctInfo.service_state.value = AcctInfo.bill_state.value;
	AcctInfo.service_zipcode.value = AcctInfo.bill_zipcode.value;
	return;
}

function CopyContact(){
	AcctInfo.contact_name.value = AcctInfo.billing_name.value;
	AcctInfo.contact_phone.value = AcctInfo.billing_phone.value;
	AcctInfo.contact_email.value = AcctInfo.billing_email.value;
	return;
}
</script>


<?// echo $SID."<br>"; ?>


<form action="" method="post" name="AcctInfo" id="AcctInfo" onSubmit="return validate(this);">
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr bgcolor="<? echo $box_color; ?>" style="background-image:url(images/ButtonBarBG.jpg);">
			<td width="900" height="30" colspan="4" align="center" class="bodyWhite" style="padding:5px;">&nbsp;<strong><? echo iif($order['acct_type'] == "IL" && $order['add_line'] == "No", 'Billing &amp; Shipping Information', 'Account'); ?> Information</strong></td>
		</tr>
		<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
			<td rowspan="99" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td class="bodyBlack">
				<br>
				<ul>
					<li>The following information will assist in verifying your identity. By providing this information, you consent to <? echo $carrier_label; ?> pulling your credit report to determine creditworthiness. This site is secure. Encryption ensures that your confidential information will be securely transmitted.</li>
				</ul>
			</td>
			<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
			<td rowspan="99" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
		<tr bgcolor="<? echo $box_color; ?>">
			<td width="900" colspan="2" class="bodyWhite"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="900" border="0" cellspacing="0" cellpadding="5" align="center">
<!--				<tr>
					<td colspan="2" bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
				</tr>-->
				<?
				if ($order['acct_type'] == "IL"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Name:</td>
					<td width="650">
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td>
								<input type="text" name="first_name" id="first_name" size="30" maxlength="50" tabindex="1" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>" value="<? echo $order['first_name']; ?>"><br><span class="smallBlack">First</td>
							<td><input type="text" name="middle_name" id="middle_name" size="5" maxlength="5" tabindex="2" class="bodyBlack" style="width:50px; background-color: <? echo $form_bg; ?>" value="<? echo $order['middle_name']; ?>"><br><span class="smallBlack">MI</span></td>
							<td><input type="text" name="last_name" id="last_name" size="30" maxlength="50" tabindex="3" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>" value="<? echo $order['last_name']; ?>"><br><span class="smallBlack">Last</span></td>
						</tr>
						</table>
					</td>
				</tr>
				<?
				}else{
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td width="250" align="right" valign="top" class="xbigBlack">Company Name:</td>
					<td width="650">
						<img src="images/spacer.gif" alt="" width="1" height="1" border="0">
						<input type="text" name="company_name" id="company_name" size="75" maxlength="100" tabindex="4" class="bodyBlack" style="width:503px; background-color: <? echo $form_bg; ?>" value="<? echo $order['company_name']; ?>">
					</td>
				</tr>
				<?
					if ($order['add_line'] == "No"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Tax ID (FEIN):</td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td width="195" valign="top"><input type="text" name="tax_id" id="tax_id" size="30" maxlength="50" tabindex="5" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['tax_id']; ?>"></td>
							<td width="605">&nbsp;</td>
						</tr>
						</table>
					</td>
				</tr>
				<?
					}else{
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>
				<?
					}
				?>
				<?
				}
				?>
				<?
				if ($order['add_line'] == "Yes"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br><? echo $carrier; ?> Phone Number:</td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td width="195" valign="top"><input type="text" name="wireless_phone" id="wireless_phone" size="30" maxlength="50" tabindex="6" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['wireless_phone']; ?>"><br><span class="smallBlack">Primary Number for This Account</span></td>
							<td width="605" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="23" height="1" border="0">Acct#:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="acct_number" id="acct_number" size="30" maxlength="50" tabindex="7" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['acct_number']; ?>"><span class="smallBlack"> (*Enter Either or Both)</span></td>
						</tr>
						</table>
					</td>
				</tr>
				<?
				}
				?>
				<?
				if ($order['add_line'] == "No"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Shipping Address:<br><span class="smallBlack"><strong>Cannot be a P.O. Box.</strong></span></td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="text" name="ship_address_1" id="ship_address_1" size="30" maxlength="50" tabindex="8" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['ship_address_1']; ?>"></td>
							<td colspan="2"><input type="text" name="ship_address_2" id="ship_address_2" size="30" maxlength="50" tabindex="9" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['ship_address_2']; ?>"></td>
						</tr>
						<tr>
							<td width="195"><input type="text" name="ship_city" id="ship_city" size="30" maxlength="50" tabindex="10" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['ship_city']; ?>"><br><span class="smallBlack">City</td>
							<td width="105">
								<select name="ship_state" id="ship_state" tabindex="11" class="bodyBlack" style="width:80px; background-color: <? echo $form_bg; ?>;">
									<option value="">Select</option>
					                <option value="AL"<? if($order['ship_state']=="AL") echo " selected";?>>AL</option>
									<option value="AK"<? if($order['ship_state']=="AK") echo " selected";?>>AK</option>
									<option value="AZ"<? if($order['ship_state']=="AZ") echo " selected";?>>AZ</option>
									<option value="AR"<? if($order['ship_state']=="AR") echo " selected";?>>AR</option>
									<option value="CA"<? if($order['ship_state']=="CA") echo " selected";?>>CA</option>
									<option value="CO"<? if($order['ship_state']=="CO") echo " selected";?>>CO</option>
									<option value="CT"<? if($order['ship_state']=="CT") echo " selected";?>>CT</option>
									<option value="DE"<? if($order['ship_state']=="DE") echo " selected";?>>DE</option>
									<option value="DC"<? if($order['ship_state']=="DC") echo " selected";?>>DC</option>
									<option value="FL"<? if($order['ship_state']=="FL") echo " selected";?>>FL</option>
									<option value="GA"<? if($order['ship_state']=="GA") echo " selected";?>>GA</option>
									<option value="HI"<? if($order['ship_state']=="HI") echo " selected";?>>HI</option>
									<option value="ID"<? if($order['ship_state']=="ID") echo " selected";?>>ID</option>
									<option value="IL"<? if($order['ship_state']=="IL") echo " selected";?>>IL</option>
									<option value="IN"<? if($order['ship_state']=="IN") echo " selected";?>>IN</option>
									<option value="IA"<? if($order['ship_state']=="IA") echo " selected";?>>IA</option>
									<option value="KS"<? if($order['ship_state']=="KS") echo " selected";?>>KS</option>
									<option value="KY"<? if($order['ship_state']=="KY") echo " selected";?>>KY</option>
									<option value="LA"<? if($order['ship_state']=="LA") echo " selected";?>>LA</option>
									<option value="ME"<? if($order['ship_state']=="ME") echo " selected";?>>ME</option>
									<option value="MD"<? if($order['ship_state']=="MD") echo " selected";?>>MD</option>
									<option value="MA"<? if($order['ship_state']=="MA") echo " selected";?>>MA</option>
									<option value="MI"<? if($order['ship_state']=="MI") echo " selected";?>>MI</option>
									<option value="MN"<? if($order['ship_state']=="MN") echo " selected";?>>MN</option>
									<option value="MS"<? if($order['ship_state']=="MS") echo " selected";?>>MS</option>
									<option value="MO"<? if($order['ship_state']=="MO") echo " selected";?>>MO</option>
									<option value="MT"<? if($order['ship_state']=="MT") echo " selected";?>>MT</option>
									<option value="NE"<? if($order['ship_state']=="NE") echo " selected";?>>NE</option>
									<option value="NV"<? if($order['ship_state']=="NV") echo " selected";?>>NV</option>
									<option value="NH"<? if($order['ship_state']=="NH") echo " selected";?>>NH</option>
									<option value="NJ"<? if($order['ship_state']=="NJ") echo " selected";?>>NJ</option>
									<option value="NM"<? if($order['ship_state']=="NM") echo " selected";?>>NM</option>
									<option value="NY"<? if($order['ship_state']=="NY") echo " selected";?>>NY</option>
									<option value="NC"<? if($order['ship_state']=="NC") echo " selected";?>>NC</option>
									<option value="ND"<? if($order['ship_state']=="ND") echo " selected";?>>ND</option>
									<option value="OH"<? if($order['ship_state']=="OH") echo " selected";?>>OH</option>
									<option value="OK"<? if($order['ship_state']=="OK") echo " selected";?>>OK</option>
									<option value="OR"<? if($order['ship_state']=="OR") echo " selected";?>>OR</option>
									<option value="PA"<? if($order['ship_state']=="PA") echo " selected";?>>PA</option>
									<option value="RI"<? if($order['ship_state']=="RI") echo " selected";?>>RI</option>
									<option value="SC"<? if($order['ship_state']=="SC") echo " selected";?>>SC</option>
									<option value="SD"<? if($order['ship_state']=="SD") echo " selected";?>>SD</option>
									<option value="TN"<? if($order['ship_state']=="TN") echo " selected";?>>TN</option>
									<option value="TX"<? if($order['ship_state']=="TX") echo " selected";?>>TX</option>
									<option value="UT"<? if($order['ship_state']=="UT") echo " selected";?>>UT</option>
									<option value="VT"<? if($order['ship_state']=="VT") echo " selected";?>>VT</option>
									<option value="VA"<? if($order['ship_state']=="VA") echo " selected";?>>VA</option>
									<option value="WA"<? if($order['ship_state']=="WA") echo " selected";?>>WA</option>
									<option value="WV"<? if($order['ship_state']=="WV") echo " selected";?>>WV</option>
									<option value="WI"<? if($order['ship_state']=="WI") echo " selected";?>>WI</option>
									<option value="WY"<? if($order['ship_state']=="WY") echo " selected";?>>WY</option>
								</select>
								<br><span class="smallBlack">State</span>
							</td>
							<td width="450"><input type="text" name="ship_zipcode" id="ship_zipcode" size="10" maxlength="10" tabindex="12" class="bodyBlack" style="width:100px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['ship_zipcode']; ?>"><br><span class="smallBlack">Zip Code</span></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Address:<br><span class="smallBlack"><a href="javascript:CopyShipToBill();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Shipping Address Here</strong></a></span></td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="text" name="bill_address_1" id="bill_address_1" size="30" maxlength="50" tabindex="13" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['bill_address_1']; ?>"></td>
							<td colspan="2"><input type="text" name="bill_address_2" id="bill_address_2" size="30" maxlength="50" tabindex="14" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['bill_address_2']; ?>"></td>
						</tr>
						<tr>
							<td width="195"><input type="text" name="bill_city" id="bill_city" size="30" maxlength="50" tabindex="15" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['bill_city']; ?>"><br><span class="smallBlack">City</td>
							<td width="105">
								<select name="bill_state" id="bill_state" tabindex="16" class="bodyBlack" style="width:80px; background-color: <? echo $form_bg; ?>;">
									<option value="">Select</option>
					                <option value="AL"<? if($order['bill_state']=="AL") echo " selected";?>>AL</option>
									<option value="AK"<? if($order['bill_state']=="AK") echo " selected";?>>AK</option>
									<option value="AZ"<? if($order['bill_state']=="AZ") echo " selected";?>>AZ</option>
									<option value="AR"<? if($order['bill_state']=="AR") echo " selected";?>>AR</option>
									<option value="CA"<? if($order['bill_state']=="CA") echo " selected";?>>CA</option>
									<option value="CO"<? if($order['bill_state']=="CO") echo " selected";?>>CO</option>
									<option value="CT"<? if($order['bill_state']=="CT") echo " selected";?>>CT</option>
									<option value="DE"<? if($order['bill_state']=="DE") echo " selected";?>>DE</option>
									<option value="DC"<? if($order['bill_state']=="DC") echo " selected";?>>DC</option>
									<option value="FL"<? if($order['bill_state']=="FL") echo " selected";?>>FL</option>
									<option value="GA"<? if($order['bill_state']=="GA") echo " selected";?>>GA</option>
									<option value="HI"<? if($order['bill_state']=="HI") echo " selected";?>>HI</option>
									<option value="ID"<? if($order['bill_state']=="ID") echo " selected";?>>ID</option>
									<option value="IL"<? if($order['bill_state']=="IL") echo " selected";?>>IL</option>
									<option value="IN"<? if($order['bill_state']=="IN") echo " selected";?>>IN</option>
									<option value="IA"<? if($order['bill_state']=="IA") echo " selected";?>>IA</option>
									<option value="KS"<? if($order['bill_state']=="KS") echo " selected";?>>KS</option>
									<option value="KY"<? if($order['bill_state']=="KY") echo " selected";?>>KY</option>
									<option value="LA"<? if($order['bill_state']=="LA") echo " selected";?>>LA</option>
									<option value="ME"<? if($order['bill_state']=="ME") echo " selected";?>>ME</option>
									<option value="MD"<? if($order['bill_state']=="MD") echo " selected";?>>MD</option>
									<option value="MA"<? if($order['bill_state']=="MA") echo " selected";?>>MA</option>
									<option value="MI"<? if($order['bill_state']=="MI") echo " selected";?>>MI</option>
									<option value="MN"<? if($order['bill_state']=="MN") echo " selected";?>>MN</option>
									<option value="MS"<? if($order['bill_state']=="MS") echo " selected";?>>MS</option>
									<option value="MO"<? if($order['bill_state']=="MO") echo " selected";?>>MO</option>
									<option value="MT"<? if($order['bill_state']=="MT") echo " selected";?>>MT</option>
									<option value="NE"<? if($order['bill_state']=="NE") echo " selected";?>>NE</option>
									<option value="NV"<? if($order['bill_state']=="NV") echo " selected";?>>NV</option>
									<option value="NH"<? if($order['bill_state']=="NH") echo " selected";?>>NH</option>
									<option value="NJ"<? if($order['bill_state']=="NJ") echo " selected";?>>NJ</option>
									<option value="NM"<? if($order['bill_state']=="NM") echo " selected";?>>NM</option>
									<option value="NY"<? if($order['bill_state']=="NY") echo " selected";?>>NY</option>
									<option value="NC"<? if($order['bill_state']=="NC") echo " selected";?>>NC</option>
									<option value="ND"<? if($order['bill_state']=="ND") echo " selected";?>>ND</option>
									<option value="OH"<? if($order['bill_state']=="OH") echo " selected";?>>OH</option>
									<option value="OK"<? if($order['bill_state']=="OK") echo " selected";?>>OK</option>
									<option value="OR"<? if($order['bill_state']=="OR") echo " selected";?>>OR</option>
									<option value="PA"<? if($order['bill_state']=="PA") echo " selected";?>>PA</option>
									<option value="RI"<? if($order['bill_state']=="RI") echo " selected";?>>RI</option>
									<option value="SC"<? if($order['bill_state']=="SC") echo " selected";?>>SC</option>
									<option value="SD"<? if($order['bill_state']=="SD") echo " selected";?>>SD</option>
									<option value="TN"<? if($order['bill_state']=="TN") echo " selected";?>>TN</option>
									<option value="TX"<? if($order['bill_state']=="TX") echo " selected";?>>TX</option>
									<option value="UT"<? if($order['bill_state']=="UT") echo " selected";?>>UT</option>
									<option value="VT"<? if($order['bill_state']=="VT") echo " selected";?>>VT</option>
									<option value="VA"<? if($order['bill_state']=="VA") echo " selected";?>>VA</option>
									<option value="WA"<? if($order['bill_state']=="WA") echo " selected";?>>WA</option>
									<option value="WV"<? if($order['bill_state']=="WV") echo " selected";?>>WV</option>
									<option value="WI"<? if($order['bill_state']=="WI") echo " selected";?>>WI</option>
									<option value="WY"<? if($order['bill_state']=="WY") echo " selected";?>>WY</option>
								</select>
								<br><span class="smallBlack">State</span>
							</td>
							<td width="450"><input type="text" name="bill_zipcode" id="bill_zipcode" size="10" maxlength="10" tabindex="17" class="bodyBlack" style="width:100px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['bill_zipcode']; ?>"><br><span class="smallBlack">Zip Code</span></td>
						</tr>
						</table>
					</td>
				</tr>
				<?
				}
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Service Address:<? echo iif($order['add_line'] == "No", '<br><span class="smallBlack"><a href="javascript:CopyShipToUse();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Shipping Address Here</strong></a></span><br><span class="smallBlack"><a href="javascript:CopyBillToUse();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Billing Address Here</strong></a></span>', ''); ?></td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="text" name="service_address_1" id="service_address_1" size="30" maxlength="50" tabindex="18" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['service_address_1']; ?>"></td>
							<td colspan="2"><input type="text" name="service_address_2" id="service_address_2" size="30" maxlength="50" tabindex="19" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['service_address_2']; ?>"><span class="smallBlack"> (*Primary Place of Use Address)</span></td>
						</tr>
						<tr>
							<td width="195"><input type="text" name="service_city" id="service_city" size="30" maxlength="50" tabindex="20" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['service_city']; ?>"><br><span class="smallBlack">City</td>
							<td width="105">
								<select name="service_state" id="service_state" tabindex="21" class="bodyBlack" style="width:80px; background-color: <? echo $form_bg; ?>;">
									<option value="">Select</option>
					                <option value="AL"<? if($order['service_state']=="AL") echo " selected";?>>AL</option>
									<option value="AK"<? if($order['service_state']=="AK") echo " selected";?>>AK</option>
									<option value="AZ"<? if($order['service_state']=="AZ") echo " selected";?>>AZ</option>
									<option value="AR"<? if($order['service_state']=="AR") echo " selected";?>>AR</option>
									<option value="CA"<? if($order['service_state']=="CA") echo " selected";?>>CA</option>
									<option value="CO"<? if($order['service_state']=="CO") echo " selected";?>>CO</option>
									<option value="CT"<? if($order['service_state']=="CT") echo " selected";?>>CT</option>
									<option value="DE"<? if($order['service_state']=="DE") echo " selected";?>>DE</option>
									<option value="DC"<? if($order['service_state']=="DC") echo " selected";?>>DC</option>
									<option value="FL"<? if($order['service_state']=="FL") echo " selected";?>>FL</option>
									<option value="GA"<? if($order['service_state']=="GA") echo " selected";?>>GA</option>
									<option value="HI"<? if($order['service_state']=="HI") echo " selected";?>>HI</option>
									<option value="ID"<? if($order['service_state']=="ID") echo " selected";?>>ID</option>
									<option value="IL"<? if($order['service_state']=="IL") echo " selected";?>>IL</option>
									<option value="IN"<? if($order['service_state']=="IN") echo " selected";?>>IN</option>
									<option value="IA"<? if($order['service_state']=="IA") echo " selected";?>>IA</option>
									<option value="KS"<? if($order['service_state']=="KS") echo " selected";?>>KS</option>
									<option value="KY"<? if($order['service_state']=="KY") echo " selected";?>>KY</option>
									<option value="LA"<? if($order['service_state']=="LA") echo " selected";?>>LA</option>
									<option value="ME"<? if($order['service_state']=="ME") echo " selected";?>>ME</option>
									<option value="MD"<? if($order['service_state']=="MD") echo " selected";?>>MD</option>
									<option value="MA"<? if($order['service_state']=="MA") echo " selected";?>>MA</option>
									<option value="MI"<? if($order['service_state']=="MI") echo " selected";?>>MI</option>
									<option value="MN"<? if($order['service_state']=="MN") echo " selected";?>>MN</option>
									<option value="MS"<? if($order['service_state']=="MS") echo " selected";?>>MS</option>
									<option value="MO"<? if($order['service_state']=="MO") echo " selected";?>>MO</option>
									<option value="MT"<? if($order['service_state']=="MT") echo " selected";?>>MT</option>
									<option value="NE"<? if($order['service_state']=="NE") echo " selected";?>>NE</option>
									<option value="NV"<? if($order['service_state']=="NV") echo " selected";?>>NV</option>
									<option value="NH"<? if($order['service_state']=="NH") echo " selected";?>>NH</option>
									<option value="NJ"<? if($order['service_state']=="NJ") echo " selected";?>>NJ</option>
									<option value="NM"<? if($order['service_state']=="NM") echo " selected";?>>NM</option>
									<option value="NY"<? if($order['service_state']=="NY") echo " selected";?>>NY</option>
									<option value="NC"<? if($order['service_state']=="NC") echo " selected";?>>NC</option>
									<option value="ND"<? if($order['service_state']=="ND") echo " selected";?>>ND</option>
									<option value="OH"<? if($order['service_state']=="OH") echo " selected";?>>OH</option>
									<option value="OK"<? if($order['service_state']=="OK") echo " selected";?>>OK</option>
									<option value="OR"<? if($order['service_state']=="OR") echo " selected";?>>OR</option>
									<option value="PA"<? if($order['service_state']=="PA") echo " selected";?>>PA</option>
									<option value="RI"<? if($order['service_state']=="RI") echo " selected";?>>RI</option>
									<option value="SC"<? if($order['service_state']=="SC") echo " selected";?>>SC</option>
									<option value="SD"<? if($order['service_state']=="SD") echo " selected";?>>SD</option>
									<option value="TN"<? if($order['service_state']=="TN") echo " selected";?>>TN</option>
									<option value="TX"<? if($order['service_state']=="TX") echo " selected";?>>TX</option>
									<option value="UT"<? if($order['service_state']=="UT") echo " selected";?>>UT</option>
									<option value="VT"<? if($order['service_state']=="VT") echo " selected";?>>VT</option>
									<option value="VA"<? if($order['service_state']=="VA") echo " selected";?>>VA</option>
									<option value="WA"<? if($order['service_state']=="WA") echo " selected";?>>WA</option>
									<option value="WV"<? if($order['service_state']=="WV") echo " selected";?>>WV</option>
									<option value="WI"<? if($order['service_state']=="WI") echo " selected";?>>WI</option>
									<option value="WY"<? if($order['service_state']=="WY") echo " selected";?>>WY</option>
								</select>
								<br><span class="smallBlack">State</span>
							</td>
							<td width="450"><input type="text" name="service_zipcode" id="service_zipcode" size="10" maxlength="10" tabindex="22" class="bodyBlack" style="width:100px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['service_zipcode']; ?>"><br><span class="smallBlack">Zip Code</span></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Requested Area Code:</td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="text" name="request_areacode" id="request_areacode" size="15" maxlength="50" tabindex="23" class="bodyBlack" style="width:80px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['request_areacode']; ?>"></td>
							<?
							if ($order['add_line'] == "No"){
							?>
							<td class="xbigBlack"><img src="images/spacer.gif" alt="" width="12" height="1" border="0">Requested Password:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="password" id="password" size="30" maxlength="50" tabindex="24" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['password']; ?>"><span class="smallBlack"> (*Optional)</span></td>
							<?
							}else{
							?>
							<td class="xbigBlack"><img src="images/spacer.gif" alt="" width="36" height="1" border="0">Account Password:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="password" id="password" size="30" maxlength="50" tabindex="25" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['password']; ?>"><span class="smallBlack"> (*If Applicable)</span></td>
							<?
							}
							?>
						</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>
				<?
				if ($order['acct_type'] == "CL"){
					if ($order['add_line'] == "No"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Contact:</td>
					<td width="650">
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td colspan="2">
								<input type="text" name="billing_name" id="billing_name" size="30" maxlength="100" tabindex="26" class="bodyBlack" style="width:405px; background-color: <? echo $form_bg; ?>" value="<? echo $order['billing_name']; ?>">
							</td>
						</tr>
						<tr>
							<td width="195"><input type="text" name="billing_phone" id="billing_phone" size="19" maxlength="25" tabindex="27" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['billing_phone']; ?>"><br><span class="smallBlack">Phone Number</span></td>
							<td width="605" valign="top" class="xbigBlack"><input type="text" name="billing_email" id="billing_email" size="50" maxlength="50" tabindex="28" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['billing_email']; ?>"><br><span class="smallBlack">Email</span></td>
						</tr>
						</table>
					</td>
				</tr>
				<?
					}
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Order Contact:<? echo iif($order['add_line'] == "No", '<br><span class="smallBlack"><a href="javascript:CopyContact();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Billing Contact Here</strong></a></span>', ''); ?></td>
					<td width="650">
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td colspan="2">
								<input type="text" name="contact_name" id="contact_name" size="30" maxlength="100" tabindex="29" class="bodyBlack" style="width:405px; background-color: <? echo $form_bg; ?>" value="<? echo $order['contact_name']; ?>">
							</td>
						</tr>
						<tr>
							<td width="195"><input type="text" name="contact_phone" id="contact_phone" size="19" maxlength="25" tabindex="30" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['contact_phone']; ?>"><br><span class="smallBlack">Phone Number</span></td>
							<td width="605" valign="top" class="xbigBlack"><input type="text" name="contact_email" id="contact_email" size="50" maxlength="50" tabindex="31" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['contact_email']; ?>"><br><span class="smallBlack">Email</span></td>
						</tr>
						</table>
					</td>
				</tr>
				<?
				}
				?>
				<?
				if ($order['acct_type'] == "IL"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Phone Numbers:</td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td width="195"><input type="text" name="home_phone" id="home_phone" size="19" maxlength="25" tabindex="32" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['home_phone']; ?>"><br><span class="smallBlack">Home</span></td>
							<td width="605"><input type="text" name="alt_phone" id="alt_phone" size="19" maxlength="25" tabindex="33" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['alt_phone']; ?>"><br><span class="smallBlack">Alternate</span></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Email Address:</td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td width="195" valign="top"><input type="text" name="email" id="email" size="30" maxlength="50" tabindex="34" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['email']; ?>"></td>
							<td width="605" class="xbigBlack">&nbsp;Confirm:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="email_confirm" id="email_confirm" size="30" maxlength="50" tabindex="35" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value=""><br><img src="images/spacer.gif" alt="" width="105" height="1" border="0"><span class="smallBlack"> (*Please Re-Enter Email Address)</span></td>
						</tr>
						</table>
					</td>
				</tr>
				<?
				}
				?>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="900" height="2" border="0"></td>
		</tr>
		</table>
		<?
		if ($order['acct_type'] == "IL" && $order['add_line'] == "No"){
			$rowcount = 0;
		?>
		<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
		<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
		<tr bgcolor="<? echo $box_color; ?>" style="background-image:url(images/ButtonBarBG.jpg);">
			<td width="900" height="30" colspan="4" align="center" class="bodyWhite" style="padding:5px;"><strong>&nbsp;Credit Approval</strong></td>
		</tr>
		<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
			<td rowspan="99" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td class="bodyBlack">
				<br>
				<ul>
					<li>The following information will assist in verifying your identity. By providing this information, you consent to <? echo $carrier_label; ?> pulling your credit report to determine creditworthiness. This site is secure. Encryption ensures that your confidential information will be securely transmitted.</li>
				</ul>
			</td>
			<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
			<td rowspan="99" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
		<tr bgcolor="<? echo $box_color; ?>">
			<td width="900" colspan="2" class="bodyWhite"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="900" border="0" cellspacing="0" cellpadding="5" align="center" class="borderNone">
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>Social Security Number:</td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="text" name="ssn" id="ssn" size="20" maxlength="11" tabindex="36" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['ssn']; ?>"><span class="smallBlack"> <a onClick="whyssn.style.visibility='visible';" class="smallBlack" style="text-decoration:underline; cursor:pointer;">Why do you need my SSN</a>?<br>Format: 555-55-5555</span></td>
						</tr>
						</table>
					</td>
					<td width="200" class="tinyBlack">
						<div id="whyssn" style="position:relative; top:0; left:0; z-index:1; visibility:hidden">
							<table cellspacing="0" cellpadding="5" background="images/HelpDivBorder.gif" class="tinyBlack">
							<tr>
								<td height="51">
									We ask you to enter your Social Security Number when purchasing online in order to verify your identity, perform an accurate credit check, and protect you from fraud.
								</td>
							</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>Date of Birth:</td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="text" name="dob" id="dob" size="30" maxlength="10" tabindex="37" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['dob']; ?>"><span class="smallBlack"> <a onClick="whydob.style.visibility='visible';" class="smallBlack" style="text-decoration:underline; cursor:pointer;">Why do you need my date of birth</a>?<br>Format: mm/dd/yyyy</span></td>
						</tr>
						</table>
					</td>
					<td width="200" class="tinyBlack">
						<div id="whydob" style="position:relative; top:0; left:0; z-index:1; visibility:hidden">
							<table cellspacing="0" cellpadding="5" background="images/HelpDivBorder.gif" class="tinyBlack">
							<tr>
								<td height="51">
									We ask for your date of birth when you purchase online to verify your age. You must be at least 18 years old to purchase a service plan.
								</td>
							</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Driver's License Number:</td>
					<td>
						<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
						<tr>
							<td><input type="text" name="dl_number" id="dl_number" size="30" maxlength="50" tabindex="38" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['dl_number']; ?>"></td>
							<td class="xbigBlack">&nbsp;&nbsp;State:<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
								<select name="dl_state" id="dl_state" tabindex="39" class="bodyBlack" style="width:80px; background-color: <? echo $form_bg; ?>;">
									<option value="">Select</option>
					                <option value="AL"<? if($order['dl_state']=="AL") echo " selected";?>>AL</option>
									<option value="AK"<? if($order['dl_state']=="AK") echo " selected";?>>AK</option>
									<option value="AZ"<? if($order['dl_state']=="AZ") echo " selected";?>>AZ</option>
									<option value="AR"<? if($order['dl_state']=="AR") echo " selected";?>>AR</option>
									<option value="CA"<? if($order['dl_state']=="CA") echo " selected";?>>CA</option>
									<option value="CO"<? if($order['dl_state']=="CO") echo " selected";?>>CO</option>
									<option value="CT"<? if($order['dl_state']=="CT") echo " selected";?>>CT</option>
									<option value="DE"<? if($order['dl_state']=="DE") echo " selected";?>>DE</option>
									<option value="DC"<? if($order['dl_state']=="DC") echo " selected";?>>DC</option>
									<option value="FL"<? if($order['dl_state']=="FL") echo " selected";?>>FL</option>
									<option value="GA"<? if($order['dl_state']=="GA") echo " selected";?>>GA</option>
									<option value="HI"<? if($order['dl_state']=="HI") echo " selected";?>>HI</option>
									<option value="ID"<? if($order['dl_state']=="ID") echo " selected";?>>ID</option>
									<option value="IL"<? if($order['dl_state']=="IL") echo " selected";?>>IL</option>
									<option value="IN"<? if($order['dl_state']=="IN") echo " selected";?>>IN</option>
									<option value="IA"<? if($order['dl_state']=="IA") echo " selected";?>>IA</option>
									<option value="KS"<? if($order['dl_state']=="KS") echo " selected";?>>KS</option>
									<option value="KY"<? if($order['dl_state']=="KY") echo " selected";?>>KY</option>
									<option value="LA"<? if($order['dl_state']=="LA") echo " selected";?>>LA</option>
									<option value="ME"<? if($order['dl_state']=="ME") echo " selected";?>>ME</option>
									<option value="MD"<? if($order['dl_state']=="MD") echo " selected";?>>MD</option>
									<option value="MA"<? if($order['dl_state']=="MA") echo " selected";?>>MA</option>
									<option value="MI"<? if($order['dl_state']=="MI") echo " selected";?>>MI</option>
									<option value="MN"<? if($order['dl_state']=="MN") echo " selected";?>>MN</option>
									<option value="MS"<? if($order['dl_state']=="MS") echo " selected";?>>MS</option>
									<option value="MO"<? if($order['dl_state']=="MO") echo " selected";?>>MO</option>
									<option value="MT"<? if($order['dl_state']=="MT") echo " selected";?>>MT</option>
									<option value="NE"<? if($order['dl_state']=="NE") echo " selected";?>>NE</option>
									<option value="NV"<? if($order['dl_state']=="NV") echo " selected";?>>NV</option>
									<option value="NH"<? if($order['dl_state']=="NH") echo " selected";?>>NH</option>
									<option value="NJ"<? if($order['dl_state']=="NJ") echo " selected";?>>NJ</option>
									<option value="NM"<? if($order['dl_state']=="NM") echo " selected";?>>NM</option>
									<option value="NY"<? if($order['dl_state']=="NY") echo " selected";?>>NY</option>
									<option value="NC"<? if($order['dl_state']=="NC") echo " selected";?>>NC</option>
									<option value="ND"<? if($order['dl_state']=="ND") echo " selected";?>>ND</option>
									<option value="OH"<? if($order['dl_state']=="OH") echo " selected";?>>OH</option>
									<option value="OK"<? if($order['dl_state']=="OK") echo " selected";?>>OK</option>
									<option value="OR"<? if($order['dl_state']=="OR") echo " selected";?>>OR</option>
									<option value="PA"<? if($order['dl_state']=="PA") echo " selected";?>>PA</option>
									<option value="RI"<? if($order['dl_state']=="RI") echo " selected";?>>RI</option>
									<option value="SC"<? if($order['dl_state']=="SC") echo " selected";?>>SC</option>
									<option value="SD"<? if($order['dl_state']=="SD") echo " selected";?>>SD</option>
									<option value="TN"<? if($order['dl_state']=="TN") echo " selected";?>>TN</option>
									<option value="TX"<? if($order['dl_state']=="TX") echo " selected";?>>TX</option>
									<option value="UT"<? if($order['dl_state']=="UT") echo " selected";?>>UT</option>
									<option value="VT"<? if($order['dl_state']=="VT") echo " selected";?>>VT</option>
									<option value="VA"<? if($order['dl_state']=="VA") echo " selected";?>>VA</option>
									<option value="WA"<? if($order['dl_state']=="WA") echo " selected";?>>WA</option>
									<option value="WV"<? if($order['dl_state']=="WV") echo " selected";?>>WV</option>
									<option value="WI"<? if($order['dl_state']=="WI") echo " selected";?>>WI</option>
									<option value="WY"<? if($order['dl_state']=="WY") echo " selected";?>>WY</option>
								</select>
							</td>
						</tr>
						</table>
					</td>
					<td width="200">&nbsp;</td>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="900" height="2" border="0"></td>
		</tr>
		</table>
		<?
		}
		?>
		<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
		<tr>
			<td colspan="2" align="center">
				<br>
				<input type="hidden" name="sec" id="sec" value="activate">
				<input type="hidden" name="step" id="step" value="confirm">
				<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
				<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
				<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
				<input type="hidden" name="sid" value="<? echo $SID; ?>">
<!--				<input type="submit" name="submit" id="submit" tabindex="40" value="Proceed to Confirmation">-->
				<table border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
						<td width="300" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
						<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="document.AcctInfo.submit();" class="buttonWhite">
						<strong>&raquo; Proceed to Confirmation &laquo;</strong>
						</a>
					</td>
					<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
				</tr>
				</table>
				<br>
			<td>
		</tr>
		</table>
	</td>
</tr>
</form>

<!-- Cart Contents -->

<tr>
	<td colspan="2" align="center" bgcolor="#F5E7E7" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>; border-top:thin solid <? echo $border_color; ?>;">
		<br>
		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center" class="xbigBlack">
				<strong>Devices in Your Cart</strong><br><br>
			</td>
		</tr>
		<tr>
			<td width="930" height="15">
				<script>
				function removeIt(ESN,ICCID,lastOne) {
					if (!lastOne){
						if (ESN != ""){
							var go = confirm("Confirm Remove " + ESN);
						}else{
							var go = confirm("Confirm Remove " + ICCID);
						}
					}else{
						var go = confirm("This will empty your cart\r\nand start the order over\r\n\nIs that what you want?");
					}
					if (go == true){
						document.RemoveForm.sec.value = 'activate';
						document.RemoveForm.step.value = 'account';
						document.RemoveForm.cargo.value = 'remove';
						document.RemoveForm.Carrier.value = '<? echo $_SESSION['carrier']; ?>';
						document.RemoveForm.esn.value = ESN;
						document.RemoveForm.iccid.value = ICCID;
						document.RemoveForm.sid.value = '<? echo $SID; ?>';
						document.RemoveForm.submit();
					}
				}
				</script>
			<?
//echo $_SESSION['carrier'];
				$query = "SELECT * FROM orders o, devices d WHERE o.session_id='".$SID."' AND d.session_id='".$SID."'";
//				$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
				$rs_cart = mysql_query($query, $linkID);
				$row = mysql_fetch_assoc($rs_cart);
				$discount = ($row["plan_discount"] * .01);
//echo $discount;
				mysql_data_seek($rs_cart,0);
				if ($_SESSION['carrier'] == "sprint" || $_SESSION['carrier'] == "verizon"){
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">
						<td width="100" height="30" align="center">Device ESN</td>
						<td width="386" align="center">Plan Name</td>
						<td width="170" align="center">Included Data</td>
						<td width="170" align="center">Cost per Month</td>
						<td width="60" align="center"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></td>
					</tr>
					';
					$total = 0;
					for ($counter=1; $counter <= mysql_num_rows($rs_cart); $counter++){
						$row = mysql_fetch_assoc($rs_cart);
						echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="30" align="center">'.$row["esn"].'</td>
						<td align="left" style="padding-left: 5px">'.$row["plan_name"].'</td>
						<td align="center">'.$row["plan_quantity"].'</td>
						<td align="right">$'.money_format('%i', ($row["plan_cost"]-($row["plan_cost"]*$discount))).'<img src="images/spacer.gif" alt="" width="60" height="1" border="0"></td>
						<td align="center"><input type="button" name="remove" id="remove" value="Remove" onClick="removeIt(\''.$row["esn"].'\',\'\','.iif(mysql_num_rows($rs_cart)==1, "1", "0").');" style="width:50;" class="smallBlack"></td>
					</tr>
						';
						$total += $row["plan_cost"];
					};
					echo'
					<tr>
						<td height="30" align="right" colspan="3" bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">Estimated* Monthly Total&nbsp;</td>
						<td align="right" bgcolor="'.$box_bg.'" class="bodyBlack">$'.money_format('%i', ($total-($total*$discount))).'<img src="images/spacer.gif" alt="" width="60" height="1" border="0"></td>
						<td bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyBlack">&nbsp;</td>
					</tr>
					';
				}else{
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">
						<td width="180" height="30" align="center">Device ICCID</td>
						<td width="135" align="center">Device IMEI</td>
						<td width="336" align="center">Plan Name</td>
						<td width="90" align="center">Included<br>Data</td>
						<td width="90" align="center">Cost<br>per Month</td>
						<td width="55" align="center"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></td>
					</tr>
					';
					$total = 0;
					for ($counter=1; $counter <= mysql_num_rows($rs_cart); $counter++){
						$row = mysql_fetch_assoc($rs_cart);
						echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="30" align="center">'.$row["iccid"].'</td>
						<td align="center">'.$row["imei"].'</td>
						<td align="left" style="padding-left: 5px">'.$row["plan_name"].'</td>
						<td align="center">'.$row["plan_quantity"].'</td>
						<td align="right">$'.money_format('%i', ($row["plan_cost"]-($row["plan_cost"]*$discount))).'<img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
						<td align="center"><input type="button" name="remove" id="remove" value="Remove" onClick="removeIt(\'\',\''.$row["iccid"].'\','.iif(mysql_num_rows($rs_cart)==1, "1", "0").');" style="width:50;" class="smallBlack"></td>
					</tr>
						';
						$total += $row["plan_cost"];
					};
					echo'
					<tr>
						<td height="30" align="right" colspan="4" bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">Estimated* Monthly Total&nbsp;</td>
						<td align="right" bgcolor="'.$box_bg.'" class="bodyBlack">$'.money_format('%i', ($total-($total*$discount))).'<img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
						<td bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyBlack">&nbsp;</td>
					</tr>
					';
				}
				echo'
				</table>
				';
			?>
				<em class="smallBlack"><img src="images/spacer.gif" alt="" width="20" height="1" border="0">*Plus Federal, State, and Local taxes & fees.<? echo iif($discount > 0 && $discount < 1, "&nbsp;&nbsp;Prices reflect your ".($discount*100)."% discount.", ""); ?></em>
			</td>
		</tr>
		</table>
		<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
		<tr>
			<td colspan="2" align="center">
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
				<form action="" method="post" name="AddDevices" id="AddDevices">
					<input type="hidden" name="sec" id="sec" value="activate">
					<input type="hidden" name="step" id="step" value="select">
					<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
					<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
					<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
					<input type="hidden" name="sid" value="<? echo $SID; ?>">
<!--					<input type="submit" name="add_devices" id="add_devices" value="Add More Devices">-->
					<table border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
							<td width="300" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
							<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="document.AddDevices.submit();" class="buttonWhite">
							<strong>&raquo; Add More Devices &laquo;</strong>
							</a>
						</td>
						<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
					</tr>
					</table>
				</form>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>




<?
}  // end of temp test loop
?>

