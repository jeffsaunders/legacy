<!-- BEGIN Include activate.php -->

<?
// Check to see if we already have this account session started
$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
$rs_order = mysql_query($query, $linkID);
$order = mysql_fetch_assoc($rs_order);
// If found lock in the carrier, add to existing account, and account type selections
//if (mysql_num_rows($rs_order) > 0){
if ($order["carrier"] != ""){
	$locked = true;
}else{
	$locked = false;
}
// If there is request data, save it!
if ($_REQUEST['DeviceCount'] != ""){
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
			device_count,
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
			".$_REQUEST['DeviceCount'].",
			'".$_REQUEST['Discount']."',
			NOW())";
//echo $query.'<br></br>';
		$rs_insert = mysql_query($query, $linkID);
		$locked = true;
		// Refresh account info
		$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
		$rs_order = mysql_query($query, $linkID);
		$order = mysql_fetch_assoc($rs_order);
	}else{
		if (($_REQUEST['AddQty'] + $order["device_count"]) != $order["device_count"]){ // Add more devices
			$query =
				"UPDATE orders SET
				device_count = '".($_REQUEST['AddQty'] + $order["device_count"])."'
				WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
			$rs_update = mysql_query($query, $linkID);
			$locked = true;
			// Refresh account info
			$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
			$rs_order = mysql_query($query, $linkID);
			$order = mysql_fetch_assoc($rs_order);
		}
	}
	// make sure this device hasn't already been entered
	$error = false;
//	if ($_REQUEST['ESN'] <> ""){
//		$query = "SELECT * FROM devices WHERE session_id='".$SID."' AND esn='".$_REQUEST['ESN']."'";
////echo $query.'<br></br>';
//		$rs_device = mysql_query($query, $linkID);
//		if (mysql_num_rows($rs_device) > 0){
//			$message = "A Device With That ESN Has Already Been Entered";
//			$error = true;
//		}
//	}else{
//		$query = "SELECT * FROM devices WHERE session_id='".$SID."' AND (iccid='".$_REQUEST['ICCID']."' OR imei='".$_REQUEST['IMEI']."')";
////echo $query.'<br></br>';
//		$rs_device = mysql_query($query, $linkID);
//		if (mysql_num_rows($rs_device) > 0){
//			$message = "A Device With That ICCID or IMEI Has Already Been Entered";
//			$error = true;
//		}
//	}
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

<script>
function validateForm(id) {
	theForm = document.getElementById(id);
	// Verify Add Line selected
//	if (theForm.AddLine){
//		var choiceSelected = false;
//		for (i = 0;  i < theForm.AddLine.length;  i++){
//			if (theForm.AddLine[i].checked){
//				choiceSelected = true;
//			}
//		}
//		if (!choiceSelected){
//			theForm.AddLine.style.background="#FF0000";
//			alert("Will you be adding this service to an existing account?");
//			theForm.AddLine.style.background="#FFFFFF";
//			theForm.AddLine.focus();
//			return false;
//		}
//	}
	// Verify Acct Type selected
	if (theForm.AcctType){
		if (theForm.AcctType.value == ""){
			theForm.AcctType.style.background="#FF0000";
			alert("Please Select an Account Type");
			theForm.AcctType.style.background="#FFFFFF";
			theForm.AcctType.focus();
			return false;
		}
	}
	// Verify ESN
	if (theForm.ESN.style.visibility == "visible"){
		if (theForm.ESN.value == ""){
			theForm.ESN.style.background="#FF0000";
			alert("Please Enter The ESN Number");
			theForm.ESN.style.background="#FFFFFF";
			theForm.ESN.focus();
			return false;
		}
		var ESN_regex = /[0-9a-f]{8}/;  // 8 digits, hex!!!!!!!!!!!!!!!!!!!!!!
		if (ESN_regex.test(theForm.ESN.value) == false) { 
			theForm.ESN.style.background="#FF0000";
			alert('Please Enter Exactly 8 Characters (0-1, A-F)');
			theForm.ESN.style.background="#FFFFFF";
			theForm.ESN.focus();
			return false;
		}
	}
	// Verify SIM ICCID
	if (theForm.ICCID.style.visibility == "visible"){
		if (theForm.ICCID.value == ""){
			theForm.ICCID.style.background="#FF0000";
			alert("Please Enter The SIM ICC ID Number");
			theForm.ICCID.style.background="#FFFFFF";
			theForm.ICCID.focus();
			return false;
		}
		var ICCID_regex = /(^\d{20}$)/;  // 20 digits, all numeric
		if (ICCID_regex.test(theForm.ICCID.value) == false) { 
			theForm.ICCID.style.background="#FF0000";
			alert('Please Enter Exactly 20 Digits (Numbers)');
			theForm.ICCID.style.background="#FFFFFF";
			theForm.ICCID.focus();
			return false;
		}
	}
	// Verify IMEI
	if (theForm.IMEI.style.visibility == "visible"){
		if (theForm.IMEI.value == ""){
			theForm.IMEI.style.background="#FF0000";
			alert("Please Enter The Device IMEI Number");
			theForm.IMEI.style.background="#FFFFFF";
			theForm.IMEI.focus();
			return false;
		}
		var IMEI_regex = /(^\d{15}$)/;  // 15 digits, all numeric
		if (IMEI_regex.test(theForm.IMEI.value) == false) { 
			theForm.IMEI.style.background="#FF0000";
			alert('Please Enter Exactly 15 Digits (Numbers)');
			theForm.IMEI.style.background="#FFFFFF";
			theForm.IMEI.focus();
			return false;
		}
	}
	// Verify Plan selected
	if (theForm.PlanID){
		var choiceSelected = false;
		for (i = 0;  i < theForm.PlanID.length;  i++){
			if (theForm.PlanID[i].checked){
				choiceSelected = true;
			}
		}
		if (!choiceSelected){
			theForm.PlanID.style.background="#FF0000";
			alert("Please select a plan");
			theForm.PlanID.style.background="#FFFFFF";
			theForm.PlanID.focus();
			return false;
		}
	}
	return true;
}
</script>

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Activate Service</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
	<form name="PlanForm" id="PlanForm" method="POST" action=".">
<!--	<td colspan="2" align="center" bgcolor="<? echo iif($locked, "#EFEFEF", "#FFFFFF"); ?>" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">-->
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<script language="javascript">
		// Declare images to swap
		if (document.images) {
			// MouseOut Images
			img1off = new Image(); 
			img1off.src = "images/SprintLogoOff.gif"; 
//			img2off = new Image(); 
//			img2off.src = "images/NextelLogoOff.gif";
			img3off = new Image();
			img3off.src = "images/AT&TLogoOff.gif";
			img4off = new Image(); 
			img4off.src = "images/VerizonLogoOff.gif";   
			// MouseOver Images
			img1on = new Image(); 
			img1on.src = "images/SprintLogo.gif"; 
//			img2on = new Image(); 
//			img2on.src = "images/NextelSprintLogo.gif";
			img3on = new Image();
			img3on.src = "images/AT&TLogo.gif";
			img4on = new Image(); 
			img4on.src = "images/VerizonLogo.gif";   
		}
	
		// Swap Image
		function imgOn(imgName) {
	        if (document.images) {
	            document[imgName].src = eval(imgName + "on.src");
	        }
		}
		function imgOff(imgName) {
	        if (document.images) {
	            document[imgName].src = eval(imgName + "off.src");
	        }
		}

		// Swap layer visibility
		function show(id) {
			document.getElementById(id).style.visibility = "visible";
			document.getElementById(id).style.display = "block";
		}
		function hide(id) {
			document.getElementById(id).style.visibility = "hidden";
			document.getElementById(id).style.display = "none";
		}
		
		// Carrier Logo Clicked
		function logoClicked(carrier) {
			if (document.PlanForm.Carrier.value == carrier){
				return
			}
			hide("AcctType");
			hide("Quantity");
			document.PlanForm.AddLine[0].checked = false;
			document.PlanForm.AddLine[1].checked = false;
			document.PlanForm.AcctType.value = "";
			document.PlanForm.DeviceCount.value = "";
//			document.PlanForm.ESN.value = "";
//			document.PlanForm.ICCID.value = "";
//			document.PlanForm.IMEI.value = "";
			if (carrier == "sprint"){
				document.PlanForm.Carrier.value = "sprint";
				document.PlanForm.Discount.value = "<? echo $sprint_discount; ?>";
				document["ChosenLogo"].src = "images/SprintLogo.gif";
			}
//			if (carrier == "nextel"){
//				document.PlanForm.Carrier.value = "nextel";
//				document.PlanForm.Discount.value = "<? echo $nextel_discount; ?>";
//				document["ChosenLogo"].src = "images/NextelLogo.gif";
//			}
			if (carrier == "at&t"){
				document.PlanForm.Carrier.value = "at&t";
				document.PlanForm.Discount.value = "<? echo $cingular_discount; ?>";
				document["ChosenLogo"].src = "images/AT&TLogo.gif";
			}
			if (carrier == "verizon"){
				document.PlanForm.Carrier.value = "verizon";
				document.PlanForm.Discount.value = "<? echo $verizon_discount; ?>";
				document["ChosenLogo"].src = "images/VerizonLogo.gif";
			}
			// IE
			//fix for IE bold text & opacity bug - explicitly setting a BG color fixes filter
			document.getElementById("SelectCarrierTable").style.backgroundColor = "#FFFFFF";
			document.getElementById("SelectCarrierTable").style.filter = "alpha(opacity:25)";
			// Everyone else
			document.all["SelectCarrierTable"].style.Mozopacity = (25/100);
			document.all["SelectCarrierTable"].style.opacity = (25/100);
			document.all["SelectCarrierTable"].style.KHTMLopacity = (25/100);
			show("AcctTypeSection")
		}
		</script>
		<table id="SelectCarrierTable" border="0" cellspacing="10" cellpadding="10">
		<tr>
			<td colspan="10" align="center" class="xbigBlack"><strong>Please Select a Carrier</strong></td>
		</tr>
		<tr>
<?
// What carriers are offered for this site?
if ($sprint_site == "T"){
	if (!$locked){
		$onclick = "logoClicked('sprint');";
		$alt = "Click to Select Sprint";
	}else{  // Carrier already selected so disable ability to select one
		$onclick = "";
		$alt = "Carrier Already Selected";
	}
	echo'			<td align="center" valign="bottom">
						<a id="SprintLogoLink" onMouseOver="imgOn(\'img1\')" onMouseOut="imgOff(\'img1\')" onClick="'.$onclick.'">
						<img src="images/SprintLogoOff.gif" alt="'.$alt.'" title="'.$alt.'" name="img1" id="img1" border="0">
						</a>
					</td>
	';
}
//if ($nextel_site == "T"){
//	if (!$locked){
//		$onclick = "logoClicked('nextel');";
//		$alt = "Click to Select Nextel";
//	}else{  // Carrier already selected so disable ability to select one
//		$onclick = "";
//		$alt = "Carrier Already Selected";
//	}
//	echo'			<td align="center" valign="bottom">
//						<a onMouseOver="imgOn(\'img2\')" onMouseOut="imgOff(\'img2\')" onClick="'.$onclick.'">
//						<img src="images/NextelLogoOff.gif" alt="'.$alt.'" title="'.$alt.'" name="img2" id="img2" border="0">
//						</a>
//					</td>
//	';
//}
if ($cingular_site == "T"){
	if (!$locked){
		$onclick = "logoClicked('at&t');";
		$alt = "Click to Select AT&T";
	}else{  // Carrier already selected so disable ability to select one
		$onclick = "";
		$alt = "Carrier Already Selected";
	}
	echo'			<td align="center" valign="bottom">
						<a onMouseOver="imgOn(\'img3\')" onMouseOut="imgOff(\'img3\')" onClick="'.$onclick.'">
						<img src="images/AT&TLogoOff.gif" alt="'.$alt.'" title="'.$alt.'" name="img3" id="img3" border="0">
						</a>
					</td>
	';
}
if ($verizon_site == "T"){
	if (!$locked){
		$onclick = "logoClicked('verizon');";
		$alt = "Click to Select Verizon Wireless";
	}else{  // Carrier already selected so disable ability to select one
		$onclick = "";
		$alt = "Carrier Already Selected";
	}
	echo'			<td align="center" valign="bottom">
						<a onMouseOver="imgOn(\'img4\')" onMouseOut="imgOff(\'img4\')" onClick="'.$onclick.'">
						<img src="images/VerizonLogoOff.gif" alt="'.$alt.'" title="'.$alt.'" name="img4" id="img4" border="0">
						</a>
					</td>
	';
}
?>
		</tr>
		</table>

<?
if ($locked){
	echo'
		<script>
		// IE
		//fix for IE bold text & opacity bug - explicitly setting a BG color fixes filter
		document.getElementById("SelectCarrierTable").style.backgroundColor = "#FFFFFF";
		document.getElementById("SelectCarrierTable").style.filter = "alpha(opacity:25)";
		// Everyone else
		document.all["SelectCarrierTable"].style.Mozopacity = (25/100);
		document.all["SelectCarrierTable"].style.opacity = (25/100);
		document.all["SelectCarrierTable"].style.KHTMLopacity = (25/100);
		</script>
	';
}
?>		
		
<!-- Account Type & Device Numbers-->

		<div id="AcctTypeSection" style="position:static; border-top:thin solid <? echo $border_color; ?>; visibility:hidden; display:none;">
			<br>
			<table id="AcctTypeTable" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="200" height="100" rowspan="3" align="center" valign="top" class="xbigBlack">
					<strong>You Selected:</strong><br><img src="images/spacer.gif" alt="" name="ChosenLogo" id="ChosenLogo" border="0">
				</td>
				<td rowspan="3"><img src="images/spacer.gif" alt="" width="30" height="1" border="0"></td>
				<td width="700" height="25" valign="top" class="bigBlack">
					<strong>Will you be adding this service to an existing account?</strong>&nbsp;
					<?
					if ($locked){  // AddLine already selected so disable ability to select one
						echo'
					<input type="radio" name="AddLine" value="Yes" '.iif($order["add_line"] == "Yes", checked, "").' disabled> Yes
					<input type="radio" name="AddLine" value="No" '.iif($order["add_line"] == "No", checked, "").' disabled> No
					<input type="hidden" name="AddLine" id="AddLine" value="'.$order['add_line'].'">
						';
					}else{
						echo'
					<input type="radio" name="AddLine" value="Yes" '.iif($order["add_line"] == "Yes", checked, "").' onClick="show(\'AcctType\');"> Yes
					<input type="radio" name="AddLine" value="No" '.iif($order["add_line"] == "No", checked, "").' onClick="show(\'AcctType\');"> No
						';
					}
					?>
				</td>
			</tr>
			<tr>
				<td height="25" valign="top" class="bigBlack">
					<div id="AcctType" style="position:static; visibility:hidden;">
					<script>
					function checkAcctType() {
						if (PlanForm.AcctType.value == ""){
							PlanForm.AcctType.style.background="#FF0000";
							alert("Please Select an Account Type");
							PlanForm.AcctType.style.background="<? echo $form_bg; ?>";
							PlanForm.AcctType.focus();
							return false;
						}
					}

					function popQuantity() {
						show("Quantity");
						PlanForm.DeviceCount.focus();
					}

//					function popSerial() {
//						if (document.PlanForm.Carrier.value == "sprint" || document.PlanForm.Carrier.value == "verizon") {
//							hide("ICCID");
//							show("ESN");
//							PlanForm.ESN.focus();
//						}else{
//							hide("ESN");
//							show("ICCID");
//							PlanForm.ICCID.focus();
//						}
//					}
					</script>
					<strong>Please Select Account Type:</strong>&nbsp;
					<?
					if ($locked){  // Account Type already selected so disable ability to select one
						echo'
					<select name="AcctType" id="AcctType" style="background-color: '.$form_bg.'" disabled>
						<option value="CL" '.iif($order["acct_type"] == "CL", selected, "").'>Business Account</option>
						<option value="IL" '.iif($order["acct_type"] == "IL", selected, "").'>Personal Account</option>
					<input type="hidden" name="AcctType" id="AcctType" value="'.$order['acct_type'].'">
						';
					}else{
						echo'
					<select name="AcctType" id="AcctType" style="background-color: '.$form_bg.'" onChange="popQuantity();" onBlur="checkAcctType();">
						<option value="">Select</option>
						<option value="CL" '.iif($order["acct_type"] == "CL", selected, "").'>Business Account</option>
						<option value="IL" '.iif($order["acct_type"] == "IL", selected, "").'>Personal Account</option>
						';
					}
					?>
					</select>
					</div>
				</td>
			</tr>
			<tr>
				<td height="50" valign="top" class="bigBlack">
					<div id="Quantity" style="position:static; visibility:visible;">
					<script>
					function checkQuantity() {
//alert("Boo");
						if (PlanForm.DeviceCount.value == "" || PlanForm.DeviceCount.value == 0){
							PlanForm.DeviceCount.style.background="#FF0000";
							alert("Please Enter a Quantity");
							PlanForm.DeviceCount.style.background="<? echo $form_bg; ?>";
							PlanForm.DeviceCount.focus();
							return false;
						}
//						show("Buttons");
document.PlanForm.sec.value = "activate2";
						document.PlanForm.submit();
					}

					// Only accept digits (numbers)
					function onlyNumbers(e,o){
//alert(o.value);
						var keynum
						var keychar
						var ltrcheck
						var crcheck
						if(window.event){ // IE
							keynum = e.keyCode
						}else if(e.which){ // Netscape/Firefox/Opera
							keynum = e.which
						}
//alert(keynum);
						if (keynum == 08 || !keynum) return true; // Backspace or navigation (arrow) key
						keychar = String.fromCharCode(keynum)
						ltrcheck = /\D/ //Regular expression for NON-digit (letter)
						crcheck = /\cM/ //Regular expression ctrl-M (enter)
						if (crcheck.test(keychar)) o.blur();
						return !ltrcheck.test(keychar) //Return true if not a letter
					//	return (!ltrcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter OR enter
					}
					</script>
					<strong>How many devices will you be activating with this order?</strong>&nbsp;
					<?
					if ($locked){  // Device quantity already defined so disable ability to enter it
						echo'
					<input type="text" name="DeviceCount" id="DeviceCount" size="1" maxlength="3" style="background-color:'.$form_bg.'" value="'.$order['device_count'].'" disabled>
					<input type="hidden" name="DeviceCount" id="DeviceCount" value="'.$order['device_count'].'">
						';
					}else{
						echo'
					<input type="text" name="DeviceCount" id="DeviceCount" size="1" maxlength="3" style="background-color:'.$form_bg.';" onKeyPress="return onlyNumbers(event,this);" onBlur="checkQuantity();" value="">
						';
					}
					?>
					</div>
				</td>
			</tr>
			</table>
			<?
			if ($locked){
				echo'
			<script>
				// IE
				//fix for IE bold text & opacity bug - explicitly setting a BG color fixes filter
				document.getElementById("AcctTypeTable").style.backgroundColor = "#FFFFFF";
				document.getElementById("AcctTypeTable").style.filter = "alpha(opacity:25)";
				// Everyone else
				document.all["AcctTypeTable"].style.Mozopacity = (25/100);
				document.all["AcctTypeTable"].style.opacity = (25/100);
				document.all["AcctTypeTable"].style.KHTMLopacity = (25/100);
			</script>
				';
			}
			?>		
		</div>


		<div id="CDMADevices" style="position:static; border-top:thin solid <? echo $border_color; ?>; visibility:<? echo iif(($locked && ($_REQUEST['Carrier'] == "sprint" || $_REQUEST['Carrier'] == "verizon")), 'visible;', 'hidden; display:none;'); ?>">
			<script>
			// Verify ID Numbers
			function checkESN(n) {
				// Verify ESN
				if (PlanForm.ESN+n){
//alert(document.getElementById("ESN"+n).value);
//					if (document.getElementById("ESN"+n).value == ""){
//						document.getElementById("ESN"+n).style.background="#FF0000";
//						alert("Please Enter The ESN Number");
//						document.getElementById("ESN"+n).style.background="#FFFFFF";
//						document.getElementById("ESN"+n).focus();
//						return false;
//					}
					var ESN_regex = /[0-9a-f]{8}/;  // 8 digits, hex!!!!!!!!!!!!!!!!!!!!!!
					if (ESN_regex.test(document.getElementById("ESN"+n).value) == false) { 
						document.getElementById("ESN"+n).style.background="#FF0000";
						alert('Please Enter Exactly 8 Characters (0-1, A-F)');
						document.getElementById("ESN"+n).style.background="#FFFFFF";
						document.getElementById("ESN"+n).focus();
						return false;
					}
				}
			}
			//Populate (fill-down) Plan choice
			function popPlans(n,q) { // n=record#, q=max records
				// Populate the remaining plans fields with the value of the first device's plan selected the first time
				if (n == 1 && document.getElementById("PlanID"+q).value == ""){ //if the first record was just changed AND the last record is blank (assume not populated yet)
					for (plan=2; plan<=q; plan++){  // populate the rest of the plans with the value of the first one.
						document.getElementById("PlanID"+plan).value = document.getElementById("PlanID1").value;
					}
				}
			}
			//Populate (fill-down) Area Code entered
			function popACs(n,q) { // n=record#, q=max records
				// Populate the remaining Area Code fields with the value of the first device's Area Code, the first time
				if (n == 1 && document.getElementById("RequestAreaCode"+q).value == ""){ //if the first record was just changed AND the last record is blank (assume not populated yet)
					for (ac=2; ac<=q; ac++){  // populate the rest of the area codes with the value of the first one.
						document.getElementById("RequestAreaCode"+ac).value = document.getElementById("RequestAreaCode1").value;
					}
				}
			}
			</script>
			<br>
			<table id="CDMADeviceTable" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center" class="xbigBlack">
					<strong>Please Enter Your Device Information<br><br></strong>
				</td>
			</tr>
			<tr>
				<td width="930" height="15">
					<?
					$query = "SELECT * FROM plans WHERE carrier = '".$_REQUEST['Carrier']."' ORDER BY display_order ASC";
					$rs_plans = mysql_query($query, $linkID);
					?>
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $box_color; ?>" class="bodyBlack">
					<tr bgcolor="<? echo $box_color; ?>" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">
						<td height="25" width="50" align="center">Device</td>
						<td width="100" align="center">ESN</td>
						<td width="450" align="center">Data Plan</td>
						<td width="100" align="center">Requested<br>Area Code</td>
						<td width="200" align="center">User/Location</td>
					</tr>
					<?
					for ($counter=1; $counter <= $order['device_count']; $counter++){
					?>
					<tr bgcolor="<? echo $box_bg; ?>" class="bodyBlack">
						<?
						if ($order['device_count'] < 10){
							echo'
						<td height="25" align="center" style="background-image:url(images/RadioButtonBG.gif);" class="bodyWhite"><strong>'.$counter.'</strong></td>
							';
						}elseif ($order['device_count'] > 9 && $order['device_count'] < 100){
							echo'
						<td height="25" align="center" style="background-image:url(images/RadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*","&nbsp; ",str_pad($counter,2,"*",STR_PAD_LEFT)).'</strong></td>
							';
						}else{
							echo'
						<td height="25" align="center" style="background-image:url(images/RadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*"," &nbsp; ",str_pad($counter,3,"*",STR_PAD_LEFT)).'</strong></td>
							';
						}
						?>
<!--						<td align="center"><input type="text" name="ESN<? echo $counter; ?>" id="ESN<? echo $counter; ?>" size="8" maxlength="8" style="width:80px; background-color:<? echo $form_bg; ?>;" onKeyUp="if (this.value.length == 8){return checkESN('<? echo $counter; ?>');};" onChange="checkESN('<? echo $counter; ?>');" value=""> <!-- 4 hex digits (8 char.) --</td>-->
						<td align="center"><input type="text" name="ESN<? echo $counter; ?>" id="ESN<? echo $counter; ?>" size="8" maxlength="8" style="width:80px; background-color:<? echo $form_bg; ?>;" value="<? echo $_REQUEST['ESN'.$counter]; ?>"> <!-- 4 hex digits (8 char.) --></td>
						<td align="center">
							<select name="PlanID<? echo $counter; ?>" id="PlanID<? echo $counter; ?>" class="bodyBlack" style="width:430px; background-color: <? echo $form_bg; ?>;" onChange="popPlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>');">
								<option value="">Select</option>

						<?
						mysql_data_seek($rs_plans, 0);
						for ($plan_counter=1; $plan_counter <= mysql_num_rows($rs_plans); $plan_counter++){
							$row = mysql_fetch_assoc($rs_plans);
							$skipit = false;
							for ($x=0; $x <= count($plans_exclude)-1; $x++){
								if ($row["plan_id"] == $plans_exclude[$x]){
									$skipit = true;
								}
							}
							if (!$skipit){
						?>
								<option value="<? echo $row["plan_id"]; ?>"<? if($_REQUEST['PlanID'.$counter]==$row["plan_id"]) echo " selected";?>><? echo $row["plan_name"]; ?> - <? echo $row["quantity"]." ($".$row["cost"]; ?>)</option>
						<?
							}
						};
						?>
							</select>
						</td>
						<td align="center"><input type="text" name="RequestAreaCode<? echo $counter; ?>" id="RequestAreaCode<? echo $counter; ?>" size="15" maxlength="50" class="bodyBlack" style="width:80px; background-color:<? echo $form_bg; ?>;" onChange="popACs('<? echo $counter; ?>','<? echo $order['device_count']; ?>');" value="<? echo $_REQUEST['RequestAreaCode'.$counter]; ?>"></td>
						<td align="center"><input type="text" name="User<? echo $counter; ?>" id="User<? echo $counter; ?>" size="15" maxlength="50" class="bodyBlack" style="width:180px; background-color:<? echo $form_bg; ?>;" value="<? echo $_REQUEST['User'.$counter]; ?>"></td>
					</tr>
					<?
					}
					?>
					</table>
					<script>
					function popMore(){
						hide('FinishedButton');
						show('AddMore');
						//document.getElementById("AddQty").focus();
					}
					function popFinished(){
						hide('AddMore');
						show('FinishedButton');
					}
					</script>
					<table id="Buttons" width="900" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="215">
							<table border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
									<td width="175" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
									<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="popMore();" class="buttonWhite">
									<strong>&raquo; Add More Devices &laquo;</strong>
									</a>
								</td>
								<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
							</tr>
							</table>
						</td>
						<td width="685" height="50">
							<div id="FinishedButton" style="position:static; z-index:1; visibility:visible;">
							<table border="0" cellspacing="0" cellpadding="0" align="right">
							<tr>
								<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
									<td width="175" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
									<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="" class="buttonWhite">
									<strong>&raquo; Go to Next Step &raquo;</strong>
									</a>
								</td>
								<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
								<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
							</tr>
							</table>
							</div>
							<div id="AddMore" style="position:static; z-index:2; visibility:visible; display:none;">
							<script>
							function pushMore(){
document.PlanForm.sec.value = "activate2";
								document.PlanForm.submit();
							}
							</script>
							<table border="0" cellspacing="0" cellpadding="0" class="bigBlack">
							<tr>
								<td>
									<strong>How many more devices would you like to add?</strong>&nbsp;
									<input type="text" name="AddQty" id="AddQty" size="1" maxlength="3" onkeypress="return onlyNumbers(event,this)" style="position:relative; background-color:<? echo $form_bg; ?>;" value="">
								</td>
								<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
								<td>
									<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><img src="images/ButtonBG-Left.gif" alt="" width="6" height="15" border="0"></td>
										<td align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
											<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="pushMore();" class="smallWhite" style="text-decoration:none;">
											<strong>Add</strong>
											</a>
										</td>
										<td><img src="images/ButtonBG-Right.gif" alt="" width="6" height="15" border="0"></td>
									</tr>
									</table>
								</td>
								<td><img src="images/spacer.gif" alt="" width="15" height="1" border="0"></td>
								<td>
<!--							<input type="button" name="AddButton" value="Add" onClick="document.PlanForm.sec.value = 'activate2'; document.PlanForm.submit();" style="position:relative;">&nbsp;&nbsp;&nbsp;-->
									<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="popFinished();" class="smallBlack"><strong>Whoops, I don't want to add any more.</strong></a>
								</td>
							</tr>
							</table>
							</div>
						</td>
					</tr>
					</table>


					
					
					
					
					





<?
/*						$row = mysql_fetch_assoc($rs_plans);
						$skipit = false;
						for ($x=0; $x <= count($plans_exclude)-1; $x++){
							if ($row["plan_id"] == $plans_exclude[$x]){
								$skipit = true;
							}
						}
						if (!$skipit){
							if ($row["add_data_cost"] == 0){
								$add_data_cost = "N/A";
							}else{
								$add_data_cost = '$'.money_format('%.4i', $row["add_data_cost"]).'/KB';
							}
							echo'
						<tr bgcolor="'.$box_bg.'" class="bodyBlack">
							<td height="25" align="center" bgcolor="'.$form_bg.'" style="background-image:url(images/RadioButtonBG.gif);"><input type="radio" name="PlanID" onClick="showButtons();" value="'.$row["plan_id"].'"></td>
							<td align="left" style="padding-left: 5px">'.$row["plan_name"].'</td>
							<td align="center">'.$row["quantity"].'</td>
							<td align="center">'.$add_data_cost.'</td>
							<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
							<td align="center">$'.money_format('%.4i', $row["add_mx_cost"]).'/KB</td>
							<td align="center">$'.money_format('%i', $row["cost"]).'</td>
						</tr>
							';
						}
					};
					echo'
					</table>
					';
*/				?>


					<div align="center"><a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="" class="smallBlack"><strong>Click here to start the order over</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br></div>
				</td>
			</tr>
			</table>
		</div>
		</td>
	</tr>












</td>
	<input type="hidden" name="sec" id="sec" value="">
	<input type="hidden" name="step" id="step" value="">
	<input type="hidden" name="sid" id="sid" value="<? echo $SID; ?>">
	<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
	<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
	<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
	<input type="hidden" name="Discount" id="Discount" value="<? echo $order['plan_discount'] ?>">
	<input type="hidden" name="locked" id="locked" value="T">
	</form>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<form action="https://secure.nr.net/deviceport/" method="post" name="whoopsie" id="whoopsie">
	<input type="hidden" name="sec" id="sec" value="activate">
	<input type="hidden" name="step" id="step" value="account">
	<input type="hidden" name="sid" id="sid" value="<? echo $SID; ?>">
	<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
	<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
	<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
	<input type="hidden" name="Discount" id="Discount" value="<? echo $order['plan_discount'] ?>">
	<input type="hidden" name="locked" id="locked" value="T">
	<input type="hidden" name="AddLine" id="AddLine" value="<? echo $order['add_line'] ?>">
	<input type="hidden" name="AcctType" id="AcctType" value="<? echo $order['acct_type'] ?>">
</form>

<!-- END Include activate.php -->
