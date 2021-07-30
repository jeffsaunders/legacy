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
		$locked = true;
		// Refresh account info
		$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
		$rs_order = mysql_query($query, $linkID);
		$order = mysql_fetch_assoc($rs_order);
	}else{
		$query =
			"UPDATE orders SET
			session_id = '".$SID."',
			order_num = UNIX_TIMESTAMP(),
			ipaddress = '".getenv('REMOTE_ADDR')."',
			carrier = '".$_REQUEST['Carrier']."',
			affiliation = '".$_REQUEST['Affiliation']."',
			add_line = '".$_REQUEST['AddLine']."',
			acct_type = '".$_REQUEST['AcctType']."',
			plan_discount = '".$_REQUEST['Discount']."',
			creation_time = NOW()
			WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
		$locked = true;
		// Refresh account info
		$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
		$rs_order = mysql_query($query, $linkID);
		$order = mysql_fetch_assoc($rs_order);
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
	<form name="PlanForm" id="PlanForm" method="post" action="">
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
			hide("ESN");
			hide("ICCID");
			hide("sprintplans");
			hide("at&tplans");
			hide("verizonplans");
			hide("Buttons");
			document.PlanForm.AddLine[0].checked = false;
			document.PlanForm.AddLine[1].checked = false;
			document.PlanForm.AcctType.value = "";
			document.PlanForm.ESN.value = "";
			document.PlanForm.ICCID.value = "";
			document.PlanForm.IMEI.value = "";
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
							PlanForm.AcctType.style.background="#FFFFFF";
							PlanForm.AcctType.focus();
							return false;
						}
					}

					function popSerial() {
						if (document.PlanForm.Carrier.value == "sprint" || document.PlanForm.Carrier.value == "verizon") {
							hide("ICCID");
							show("ESN");
							PlanForm.ESN.focus();
						}else{
							hide("ESN");
							show("ICCID");
							PlanForm.ICCID.focus();
						}
					}
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
					<select name="AcctType" id="AcctType" style="background-color: '.$form_bg.'" onChange="popSerial();" onBlur="checkAcctType();">
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
					<script>
					// Only accept digits (numbers)
					function onlyNumbers(e){
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
					//	return !ltrcheck.test(keychar) //Return true if not a letter
						return (!ltrcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter OR enter
					}

					// Verify ID Numbers
					function checkESN() {
						// Verify ESN
						if (PlanForm.ESN){
							if (PlanForm.ESN.value == ""){
								PlanForm.ESN.style.background="#FF0000";
								alert("Please Enter The ESN Number");
								PlanForm.ESN.style.background="#FFFFFF";
								PlanForm.ESN.focus();
								return false;
							}
							var ESN_regex = /[0-9a-f]{8}/;  // 8 digits, hex!!!!!!!!!!!!!!!!!!!!!!
							if (ESN_regex.test(PlanForm.ESN.value) == false) { 
								PlanForm.ESN.style.background="#FF0000";
								alert('Please Enter Exactly 8 Characters (0-1, A-F)');
								PlanForm.ESN.style.background="#FFFFFF";
								PlanForm.ESN.focus();
								return false;
							}
						}
						// IE
						//fix for IE bold text & opacity bug - explicitly setting a BG color fixes filter
						document.getElementById("AcctTypeTable").style.backgroundColor = "#FFFFFF";
						document.getElementById("AcctTypeTable").style.filter = "alpha(opacity:25)";
						// Everyone else
						document.all["AcctTypeTable"].style.Mozopacity = (25/100);
						document.all["AcctTypeTable"].style.opacity = (25/100);
						document.all["AcctTypeTable"].style.KHTMLopacity = (25/100);
						hide("Whoops");
						show(document.PlanForm.Carrier.value+'plans');
						document.PlanForm.ESN.blur();
					}

					function checkICCID() {
						// Verify SIM ICCID
						if (PlanForm.ICCID){
							if (PlanForm.ICCID.value == ""){
								PlanForm.ICCID.style.background="#FF0000";
								alert("Please Enter The SIM ICC ID Number");
								PlanForm.ICCID.style.background="#FFFFFF";
								PlanForm.ICCID.focus();
								return false;
							}
							var ICCID_regex = /(^\d{20}$)/;  // 20 digits, all numeric
							if (ICCID_regex.test(PlanForm.ICCID.value) == false) { 
								PlanForm.ICCID.style.background="#FF0000";
								alert('Please Enter Exactly 20 Digits (Numbers)');
								PlanForm.ICCID.style.background="#FFFFFF";
								PlanForm.ICCID.focus();
								return false;
							}
						}
						// Verify IMEI
						if (PlanForm.IMEI){
							if (PlanForm.IMEI.value == ""){
								PlanForm.IMEI.style.background="#FF0000";
								alert("Please Enter The Device IMEI Number");
								PlanForm.IMEI.style.background="#FFFFFF";
								PlanForm.IMEI.focus();
								return false;
							}
							var IMEI_regex = /(^\d{15}$)/;  // 15 digits, all numeric
							if (IMEI_regex.test(PlanForm.IMEI.value) == false) { 
								PlanForm.IMEI.style.background="#FF0000";
								alert('Please Enter Exactly 15 Digits (Numbers)');
								PlanForm.IMEI.style.background="#FFFFFF";
								PlanForm.IMEI.focus();
								return false;
							}
						}
						hide("Whoops");
						show(document.PlanForm.Carrier.value+'plans');
						document.PlanForm.IMEI.blur();
					}
					</script>

				<!-- ESN -->

					<div id="ESN" style="position:static; visibility:hidden; display:none;">
					<strong>Please Enter Your Wireless Device's Electronic Serial Number (ESN):</strong>&nbsp;
					<input type="text" name="ESN" id="ESN" size="8" maxlength="8" style="background-color: <? echo $form_bg; ?>;" onKeyUp="if (this.value.length == 8){return checkESN();};" onChange="checkESN();" value=""> <!-- 4 hex digits (8 char.) -->
					</div>

				<!-- ICCID & IMEI -->

					<div id="ICCID" style="position:static; visibility:hidden;">
					<strong>Please Enter Your Wireless Device's SIM Card ID (ICC-ID):</strong>&nbsp;
					<input type="text" name="ICCID" id="ICCID" size="20" maxlength="20" style="background-color: <? echo $form_bg; ?>;" onKeyPress="return onlyNumbers(event)" onKeyUp="if (this.value.length == 20){document.PlanForm.IMEI.focus();};" value=""><br> <!-- 20 digits -->
					<img src="images/spacer.gif" alt="" width="18" height="1" border="0">
					<strong>...and International Mobile Equipment Identifier (IMEI):</strong>&nbsp;
					<input type="text" name="IMEI" id="IMEI" size="15" maxlength="15" style="background-color: <? echo $form_bg; ?>;" onKeyPress="return onlyNumbers(event)" onKeyUp="if (this.value.length == 15){checkICCID();};" onChange="checkICCID();" value=""> <!-- 15 digits -->
					</div>
				</td>
			</tr>
				<tr>
					<td colspan="3" align="center">

					<!-- Whoops Button -->

						<div id="Whoops" style="position:static; visibility:hidden; display:none;">
						<table border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
								<td width="350" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
								<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="document.whoopsie.submit();" class="buttonWhite">
								<strong>&raquo; Finished - Proceed to Account Setup &laquo;</strong>
								</a>
							</td>
							<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
						</tr>
						</table>
<!--						<input type="button" name="Whoops" id="Whoops" value="Proceed to Account Setup" onClick="document.whoopsie.submit();">-->
						</div>
					</td>
				</tr>
			</table>
			<br>
		</div>

<!-- Sprint Plans -->

		<script>
		function showButtons(){
			// IE
			//fix for IE bold text & opacity bug - explicitly setting a BG color fixes filter
			document.getElementById(document.PlanForm.Carrier.value+"PlansTable").style.backgroundColor = "#FFFFFF";
			document.getElementById(document.PlanForm.Carrier.value+"PlansTable").style.filter = "alpha(opacity:25)";
			// Everyone else
			document.all[document.PlanForm.Carrier.value+"PlansTable"].style.Mozopacity = (25/100);
			document.all[document.PlanForm.Carrier.value+"PlansTable"].style.opacity = (25/100);
			document.all[document.PlanForm.Carrier.value+"PlansTable"].style.KHTMLopacity = (25/100);
			show('Buttons');
		}
		</script>

		<div id="sprintplans" style="position:static; border-top:thin solid <? echo $border_color; ?>; visibility:hidden; display:none;">
			<br>
			<table id="sprintPlansTable" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center" class="bigBlack">
					<strong>Please Select a Sprint Mobile Broadband Connection Plan<br></strong>
				</td>
			</tr>
			<tr>
			<?
			If ($sprint_plan_notes <> ""){
				echo'
				<td align="center" class="bodyBlack">'.$sprint_plan_notes.'<br><br></td>
				';
			}else{
				echo'
				<td><br></td>
				';
			}
			?>
			</tr>
			<tr>
				<td width="930" height="15">
				<?
					$query = "SELECT * FROM plans WHERE carrier = 'Sprint' ORDER BY display_order ASC";
					$rs_plans = mysql_query($query, $linkID);
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Plan Name</td>
						<td align="center">Included<br>Data</td>
						<td align="center">Additional<br>Data</td>
						<td align="center">Canadian<br>Data</td>
						<td align="center">Mexican<br>Data</td>
						<td align="center">Cost<br>per Month</td>
					</tr>
					';
					for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
						$row = mysql_fetch_assoc($rs_plans);
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
				?>
				</td>
			</tr>
			</table>
			<br>
		</div>

<!-- AT&T Plans -->

		<div id="at&tplans" style="position:static; border-top:thin solid <? echo $border_color; ?>; visibility:hidden; display:none;">
			<br>
			<table id="at&tPlansTable" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center" class="xbigBlack">
					<strong>Please Select an AT&T Data Connect Plan</strong><br>
				</td>
			</tr>
			<tr>
			<?
			If ($cingular_plan_notes <> ""){
				echo'
				<td align="center" class="bodyBlack">'.$cingular_plan_notes.'<br><br></td>
				';
			}else{
				echo'
				<td><br></td>
				';
			}
			?>
			</tr>
			<tr>
				<td width="930" height="15">
				<?
					$query = "SELECT * FROM plans WHERE carrier = 'AT&T' ORDER BY display_order ASC";
					$rs_plans = mysql_query($query, $linkID);
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Plan Name</td>
						<td align="center">Included<br>Data</td>
						<td align="center">Additional<br>Data</td>
						<td align="center">Canadian<br>Data</td>
						<td align="center">Mexican<br>Data</td>
						<td align="center">Cost<br>per Month</td>
					</tr>
					';
					for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
						$row = mysql_fetch_assoc($rs_plans);
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
				?>
				</td>
			</tr>
			</table>
			<br>
		</div>

<!-- Verizon Plans -->

		<div id="verizonplans" style="position:static; border-top:thin solid <? echo $border_color; ?>; visibility:hidden; display:none;">
			<br>
			<table id="verizonPlansTable" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center" class="xbigBlack">
					<strong>Please Select a Verizon Broadband Access Plan</strong><br><br>
				</td>
			</tr>
			<tr>
			<?
			If ($verizon_plan_notes <> ""){
				echo'
				<td align="center" class="bodyBlack">'.$verizon_plan_notes.'<br><br></td>
				';
			}else{
				echo'
				<td><br></td>
				';
			}
			?>
			</tr>
			<tr>
				<td width="930" height="15">
				<?
					$query = "SELECT * FROM plans WHERE carrier = 'Verizon' ORDER BY display_order ASC";
					$rs_plans = mysql_query($query, $linkID);
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="336" align="center">Plan Name</td>
						<td width="100" align="center">Included<br>Data</td>
						<td width="100" align="center">Additional<br>Data</td>
						<td width="100" align="center">Canadian<br>Data</td>
						<td width="100" align="center">Mexican<br>Data</td>
						<td width="100" align="center">Cost<br>per Month</td>
					</tr>
					';
					for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
						$row = mysql_fetch_assoc($rs_plans);
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
				?>
				</td>
			</tr>
			</table>
			<br>
		</div>

<!-- Submit Buttons -->

		<div id="Buttons" style="position:static; border-top:thin solid <? echo $border_color; ?>; visibility:hidden; display:none;">
			<br>
			<div align="center">
				<script>
				function addMore() {
					var go = validateForm("PlanForm");
					if (go == true){
						document.PlanForm.sec.value = 'activate';
						document.PlanForm.step.value = 'select';
						document.PlanForm.submit();
					}
				}
				function allFinished() {
					var go = validateForm("PlanForm");
					if (go == true){
						document.PlanForm.sec.value = 'activate';
						document.PlanForm.step.value = 'account';
						document.PlanForm.action = 'https://secure.nr.net/datasite/';
						document.PlanForm.submit();
					}
				}
				</script>

				<table border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td colspan="7" align="center" class="xbigBlack"><strong>Please Choose Your Next Step</strong><br><br></td>
				</tr>
				<tr>
					<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
					<td width="350" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
						<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="addMore();" class="buttonWhite">
						<strong>&raquo; Add Another Device to This Account &laquo;</strong>
						</a>
					</td>
					<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="20" height="25" border="0"></td>
					<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
					<td width="350" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif" class="bigWhite">
						<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="allFinished();" class="buttonWhite">
						<strong>&raquo; Finished - Proceed to Account Setup &laquo;</strong>
						</a>
					</td>
					<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
				</tr>
				</table>
<!--				
				<strong class="xbigBlack">Please Choose Your Next Step</strong><br><br>
				<input type="button" name="AddDevice" id="AddDevice" value="Add Another Device to This Account" onClick="addMore();">
				<img src="images/spacer.gif" alt="" width="25" height="1" border="0">
				<input type="button" name="Finished" id="Finished" value="Finished - Proceed to Account Setup" onClick="allFinished();">
-->
			</div>
			<br>
		</div>


<!-- Cart Contents -->

		<div id="Cart" style="position:static; border-top:thin solid <? echo $border_color; ?>; background-color:#F5E7E7; <? echo iif(!$locked, 'visibility:hidden; display:none;', 'visibility:visible; display:block;'); ?>"> <!-- FFF2F0 F5E7E7 A7CBE1 95EAFF 3AADFF 9FCFFF --> 
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
							document.RemoveForm.step.value = '';
							document.RemoveForm.cargo.value = 'remove';
							document.RemoveForm.Carrier.value = document.PlanForm.Carrier.value;
							document.RemoveForm.esn.value = ESN;
							document.RemoveForm.iccid.value = ICCID;
							document.RemoveForm.sid.value = '<? echo $SID; ?>';
							document.RemoveForm.submit();
						}
//						location.href = "?sec=activate&cargo=remove&Carrier=" + document.PlanForm.Carrier.value + "&esn=" + ESN + "&iccid=" + ICCID
					}
					</script>
				<?
					$query = "SELECT * FROM orders o, devices d WHERE o.session_id='".$SID."' AND d.session_id='".$SID."'";
//					$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
					$rs_cart = mysql_query($query, $linkID);
					$row = mysql_fetch_assoc($rs_cart);
					$discount = ($row["plan_discount"] * .01);
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
		<br>
		</div>
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

<form action="https://secure.nr.net/datasite/" method="post" name="whoopsie" id="whoopsie">
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
