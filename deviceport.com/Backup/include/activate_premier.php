<!-- BEGIN Include activate_premier.php -->

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
//echo '<script>alert("Boo");</script>';
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
//	$error = false;
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
	if ($_REQUEST['task'] == "adddevices"){
		for ($counter=1; $counter <= $_REQUEST['DeviceCount']; $counter++){
			if ($_REQUEST['ESN'.$counter] != "" || $_REQUEST['ICCID'.$counter] != ""){
				// Look up the plan info
				$query = "SELECT * FROM plans WHERE plan_id='".$_REQUEST['PlanID'.$counter]."'";
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
					request_areacode,
					user,
					device_time)
					VALUES (
					'".$SID."',
					'".$_REQUEST['ESN'.$counter]."',
					'".$_REQUEST['ICCID'.$counter]."',
					'".$_REQUEST['IMEI'.$counter]."',
					'".$row['plan_name']."',
					'".$row['quantity']."',
					'".$row['cost']."',
					'".$_REQUEST['RequestAreaCode'.$counter]."',
					'".$_REQUEST['User'.$counter]."',
					NOW())";
			//echo $query.'<br></br>';
				$rs_insert = mysql_query($query, $linkID);
				// Tell 'em what you did
		//		$message = "Device Added to Cart";
			}
		}
	}
}
if ($_REQUEST['task'] == "sendorder"){
	$query =
		"UPDATE orders SET
		accept_terms_time = NOW()
		WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
	$rs_update = mysql_query($query, $linkID);
//echo "<script>alert('xxx');</script>";

// ADD POST TO VWELITE CODE HERE

/*

	// POST order to Vision IL Admin (VWElite)
	// First, get the order info
	$query = "SELECT * FROM orders WHERE session_id = '".$SID."'";
//echo $query."<br><br>";
	$order = mysql_query($query, $linkID);
	$fields = mysql_num_fields($order);
	$row = mysql_fetch_assoc($order);
	// Then build the list of parameters and values to POST
	$params = "";
	$i = 0; 
	while ($i < $fields){
		$params .= "&".mysql_field_name($order, $i)."=".urlencode($row[mysql_field_name($order, $i)]);
		$i++; 
	} 
//echo $params."<br><br>";
	mysql_free_result($order);

	// Now POST it using cURL
	$url = "https://www.vwelite.com/pws.php";
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // this line makes it work under https
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//	curl_setopt($ch, CURLOPT_TIMEOUT, 4); // times out after 4 seconds
//	ob_start();
	$result = curl_exec($ch);
//	curl_close($ch);
//	$result = ob_get_contents();
//	ob_end_clean();
//echo("Results: <br>".$result)."<br><br>";

	// read the reply and act accordingly
	if ($result != false){ //POST was successful
		if (preg_match("/ok:/i", $result)) { //if we got back an "ok:"
			$raw_return = stristr($result,"ok: "); // The part of the reply starting with "ok: "
		}else{ //if we got "error:" instead (suppoded to get one or the other EVERY time
			$raw_return = stristr($result,"error: "); // The part of the reply starting with "error: "
		}
//		$raw_return = stristr($result,"?sid="); // The part of the reply starting with "?sid="
//echo $raw_return."<br><br>"; 
		$raw_sessid = substr($raw_return, strpos($raw_return,"?"), 37); // The first 37 characters ("?sid=" + the 32 character session_id)
//echo $raw_sessid."<br><br>"; 
		$sessid = substr($raw_sessid, -32, 32); // The last 32 characters of that ("?sid=" removed)...the value of sid only.
//echo $sessid."<br><br>";
		$raw_status = substr($raw_return, strpos($raw_return,"&")); // The rest of the returned value starting at the "&" ("&status=...")
//echo $raw_status."<br><br>"; 
		$status = substr($raw_status, 8, 7); // 7 characters starting at position 8 (immediately after the "&status=")...will be "success" if it is, if it's not then it failed.
//echo $status."<br><br>";
		if ($status == "success"){
			$query =
				"UPDATE orders SET
				delivery_time = NOW()
				WHERE session_id = '".$sessid."'";
			$rs_close = mysql_query($query, $linkID);
		}else{ // Didn't get "success"
			$query =
				'INSERT INTO undelivered_orders (
				session_id,
				first_response,
				last_response,
				first_attempt,
				last_attempt)
				VALUES (
				"'.$SID.'",
				"'.mysql_real_escape_string ($result).'",
				"'.mysql_real_escape_string ($result).'",
				NOW(),
				NOW())';
//			$query =
//				"INSERT INTO undelivered_orders (
//				session_id,
//				first_attempt,
//				last_attempt,
//				first_response,
//				last_response)
//				VALUES (
//				'".$SID."',
//				NOW(),
//				NOW(),
//				\"".$result."\",
//				\"".$result."\")";
			$rs_insert = mysql_query($query, $linkID);
//echo $query.'<br></br>';
		}
	}else{ // POST failed
			$query =
			'INSERT INTO undelivered_orders (
			session_id,
			first_response,
			last_response,
			first_attempt,
			last_attempt)
			VALUES (
			"'.$SID.'",
			"'.mysql_real_escape_string ($result).'",
			"'.mysql_real_escape_string ($result).'",
			NOW(),
			NOW())';
//echo $query.'<br></br>';
		$rs_insert = mysql_query($query, $linkID);
	}






*/











	// Refresh account info
//	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
//	$rs_order = mysql_query($query, $linkID);
//	$order = mysql_fetch_assoc($rs_order);
}

// They want to remove a device from the order
if ($task == "remove"){
	if ($_REQUEST['esn'] != ""){
		$query = "DELETE FROM devices WHERE session_id='".$SID."' AND esn = '".$_REQUEST['esn']."'";
	}elseif ($_REQUEST['iccid'] != ""){
		$query = "DELETE FROM devices WHERE session_id='".$SID."' AND iccid = '".$_REQUEST['iccid']."'";
	}
//echo $query;
	$rs_remove = mysql_query($query, $linkID);
	$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);
	if (mysql_num_rows($rs_cart) == false){
//		$query = "UPDATE orders SET carrier = '' WHERE session_id='".$SID."'";
//		$rs_delete = mysql_query($query, $linkID);
		$query = "DELETE FROM orders WHERE session_id = '".$SID."'";
		$rs_empty = mysql_query($query, $linkID);
		$query = "DELETE FROM devices WHERE session_id = '".$SID."'";
		$rs_empty = mysql_query($query, $linkID);
		$locked = false;
//		header("Location: http://".$site.".cellbenefits.com/datasite/");
//		header("Location: ./");
//		$sec = "";
		echo'<script>location.href="./";</script>'; // Using javascript eliminates "non-secure destination" warning in IE
	}
}

// They want to start over - dump everything
if ($_REQUEST['task'] == "restart"){
//echo "<script>alert('".$SID."');</script>";
	$query = "DELETE FROM orders WHERE session_id = '".$SID."'";
	$rs_empty = mysql_query($query, $linkID);
	$query = "DELETE FROM devices WHERE session_id = '".$SID."'";
	$rs_empty = mysql_query($query, $linkID);
	$locked = false;
	// Refresh account info
	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
	$rs_order = mysql_query($query, $linkID);
	$order = mysql_fetch_assoc($rs_order);
}
?>

<?
if (!$step || $step == "select"){
?>
	<script>
/*	function validateForm(id) {
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
*/	
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
	
	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<!--<tr>
		<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Activate Service</strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>-->
	<tr>
		<form name="PlanForm" id="PlanForm" method="GET" action="">
	<!--	<td colspan="2" align="center" bgcolor="<? echo iif($locked, "#EFEFEF", "#FFFFFF"); ?>" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">-->
	<!--	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">-->
		<td align="center" bgcolor="<? echo $content_bgcolor; ?>">
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
				hide("WelcomeMessage");
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
	
		<!-- Step Label -->
		
			<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			<table width="900" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="superbigBlack">Activate with PWS</td>
			</tr>
			</table>
			
		<!-- Select Carrier -->
		
			<table width="900" border="0" cellspacing="0" cellpadding="0" id="SelectCarrierTable">
			<tr>
				<td class="bigBlack">Please Select a Carrier:</td>
			</tr>
			<tr>
				<td align="center">
					<table width="750" border="0" cellspacing="10" cellpadding="10">
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
				</td>
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
			
		<!-- Premier Welcome Message-->
	
	<?
	if (!$sec && !$locked){  // Only show this if it's the default home page.
	?>
	<!--		<div id="WelcomeMessage" style="position:static; border-top:1px solid <? echo $header_bgcolor; ?>; visibility:visible;">-->
			<div id="WelcomeMessage" style="position:static; visibility:visible; display:block;">
				<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
				<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="superbigBlack">Welcome to PWS</td>
				</tr>
				<tr>
					<td class="bodyBlack"><br>
						Premier Wireless Solutions (PWS) is the wireless core that provides a full spectrum of RF technologies and systems integration to help our customers add wireless capability to their product roadmap. PWS combines leading RF products (modules/modems) with industry recognized integration expertise to ease the complexities of embedded wireless integration in the M2M space.<br><br>
						Cellular activations and service plans are the thread that ties our principles products and customers applications together. Partnered with Vision Wireless this activation portal gives PWS customers the tools to remotely access and activate the service providers directly.  Through this process the customer is given the unique ability to establish service accounts, as well as activate lines without having to track down network salespeople and explain the M2M market in order to get up and running.<br><br>
						PWS and Vision Wireless have developed this easy to use tool with your M2M products and market in mind.<br><br>
 		 			</td>
				</tr>
				</table>
			</div>
	<?
	}else{
	?>
			<div id="WelcomeMessage" style="position:absolute; top:-100; visibility:hidden; display:none;"><!--Dummy--></div>
	<?
	}
	?>
	
		<!-- Account Type & Device Numbers-->
	
	<!--		<div id="AcctTypeSection" style="position:static; border-top:1px solid <? echo header_bgcolor; ?>; <? echo iif(!$locked, "visibility:hidden; display:none;", "visibility:visible;"); ?>">-->
			<div id="AcctTypeSection" style="position:static; <? echo iif(!$locked, "visibility:hidden; display:none;", "visibility:visible;"); ?>">
				<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
				<table width="900" border="0" cellspacing="0" cellpadding="0" id="AcctTypeTable">
				<tr>
					<td width="200" height="100" rowspan="3" valign="top" class="bigBlack">
						You Selected:<br><br>
						<div align="center"><img src="images/spacer.gif" alt="" name="ChosenLogo" id="ChosenLogo" border="0"></div><br><br>
					</td>
					<td rowspan="3"><img src="images/spacer.gif" alt="" width="30" height="110" border="0"></td>
					<td width="670" height="25" valign="top" class="bigBlack">
						Will you be adding this service to an existing account?&nbsp;
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
						<div id="AcctType" style="position:static; <? echo iif(!$locked, "visibility:hidden; display:none;", "visibility:visible;"); ?>">
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
						Please Select Account Type:&nbsp;
						<?
						if ($locked){  // Account Type already selected so disable ability to select one
							echo'
						<select name="AcctType" id="AcctType" style="background-color: '.$form_bgcolor.'" disabled>
							<option value="CL" '.iif($order["acct_type"] == "CL", selected, "").'>Business Account</option>
							<option value="IL" '.iif($order["acct_type"] == "IL", selected, "").'>Personal Account</option>
						<input type="hidden" name="AcctType" id="AcctType" value="'.$order['acct_type'].'">
							';
						}else{
							echo'
						<select name="AcctType" id="AcctType" style="background-color: '.$form_bgcolor.'" onChange="popQuantity();" onBlur="checkAcctType();">
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
	//document.PlanForm.sec.value = "activate2";
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
						How many devices will you be activating with this order?&nbsp;
						<?
						if ($locked){  // Device quantity already defined so disable ability to enter it
							echo'
						<input type="text" name="DeviceCount" id="DeviceCount" size="1" maxlength="3" style="background-color:'.$form_bgcolor.'" value="'.$order['device_count'].'" disabled>
						<input type="hidden" name="DeviceCount" id="DeviceCount" value="'.$order['device_count'].'">
						&nbsp;<input type="button" value="Go" onClick="checkQuantity();" disabled>
							';
						}else{
							echo'
						<input type="text" name="DeviceCount" id="DeviceCount" size="1" maxlength="3" style="background-color:'.$form_bgcolor.';" onKeyPress="return onlyNumbers(event,this);" onChange="checkQuantity();" value="">
						&nbsp;<input type="button" value="Go" onClick="checkQuantity();">
							';
						}
						?>
						</div>
					</td>
				</tr>
				</table>
				<?
				if ($locked){
					if ($order['carrier'] == "sprint") $carrier_logo = "SprintLogo.gif";
					if ($order['carrier'] == "at&t") $carrier_logo = "AT&TLogo.gif";
					if ($order['carrier'] == "verizon") $carrier_logo = "VerizonLogo.gif";
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
					document["ChosenLogo"].src = "images/'.$carrier_logo.'";
				</script>
					';
				}
				?>		
			</div>
	
	<?
	if ($_REQUEST['Carrier'] == "sprint" || $_REQUEST['Carrier'] == "verizon"){
	?>
	<!--		<div id="CDMADevices" style="position:static; border-top:1px solid <? echo header_bgcolor; ?>; visibility:<? echo iif(($locked && ($_REQUEST['Carrier'] == "sprint" || $_REQUEST['Carrier'] == "verizon")), 'visible;', 'hidden; display:none;'); ?>">-->
			<div id="CDMADevices" style="position:static; visibility:<? echo iif(($locked && ($_REQUEST['Carrier'] == "sprint" || $_REQUEST['Carrier'] == "verizon")), 'visible;', 'hidden; display:none;'); ?>">
				<script>
				<?
				if ($order['device_count']){
					$deviceCount = $order['device_count'];
				}else{
					$deviceCount = 0;
				}
				?>
				function validateCDMA() {
					// NEED TO ADD A CHECK TO MAKE SURE THERE ARE NO DUPLICATE ESNs!!
					var blank = true;
					for (counter=1; counter <= <? echo $deviceCount; ?>; counter++){
						if (eval('document.PlanForm.ESN'+counter+'.value') != ""){
							blank = false;
//							var ESN_regex = /(^\d{11}$)/;  // 11 digits, all numeric
//							if (ESN_regex.test(eval('document.PlanForm.ESN'+counter+'.value')) == false) { 
//								eval('PlanForm.ESN'+counter+'.style.background="#FF0000";');
//								alert('Please Enter Exactly 11 Digits (Numbers) For Device #'+counter+'\'s ESN');
//								eval('PlanForm.ESN'+counter+'.style.background="#FFFFFF";');
//								eval('PlanForm.ESN'+counter+'.focus();');
//								return false;
//							}
							if (eval('PlanForm.PlanID'+counter+'.value == ""')){
								eval('PlanForm.PlanID'+counter+'.style.background="#FF0000";');
								alert('Please Select A Plan For Device #'+counter);
								eval('PlanForm.PlanID'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.PlanID'+counter+'.focus();');
								return false;
							}
							if (eval('PlanForm.RequestAreaCode'+counter+'.value == ""')){
								eval('PlanForm.RequestAreaCode'+counter+'.style.background="#FF0000";');
								alert('Please Enter A Requested Area Code For Device #'+counter);
								eval('PlanForm.RequestAreaCode'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.RequestAreaCode'+counter+'.focus();');
								return false;
							}
							if (eval('PlanForm.User'+counter+'.value == ""')){
								eval('PlanForm.User'+counter+'.style.background="#FF0000";');
								alert('Please Enter A User Name Or User Location For Device #'+counter);
								eval('PlanForm.User'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.User'+counter+'.focus();');
								return false;
							}
						}
					}
					if (blank){
						alert('Please Enter At Least One Device');
						PlanForm.ESN1.focus();
						return false;
					}
					document.PlanForm.sec.value = "activate";
					document.PlanForm.step.value = "account";
					document.PlanForm.task.value = "adddevices";
					document.PlanForm.action = 'https://secure.nr.net/deviceport/';
					document.PlanForm.submit();
				}
				</script>
				<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
				<table width="900" border="0" cellspacing="0" cellpadding="0" id="CDMADeviceTable">
				<tr>
					<td class="bigBlack">
						Please Enter Your Device Information:<br><br>
					</td>
				</tr>
				<tr>
					<td width="900">
						<?
						$query = "SELECT * FROM plans WHERE carrier = '".$_REQUEST['Carrier']."' ORDER BY display_order ASC";
						$rs_plans = mysql_query($query, $linkID);
						?>
						<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
	<!--					<tr bgcolor="<? echo $box_color; ?>" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">-->
						<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
							<td height="25" width="50" align="center">Device</td>
							<td width="100" align="center">ESN Dec.</td>
							<td width="450" align="center">Data Plan</td>
							<td width="100" align="center">Requested<br>Area Code</td>
							<td width="200" align="center">User Name</td>
						</tr>
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
						<tr bgcolor="<? echo $box_bgcolor; ?>" class="bodyBlack">
							<?
							// Align numeric values centered but decimal tabbed based on length of highest number
							if ($order['device_count'] < 10){
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.$counter.'</strong></td>
								';
							}elseif ($order['device_count'] > 9 && $order['device_count'] < 100){
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*","&nbsp; ",str_pad($counter,2,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}else{
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*"," &nbsp; ",str_pad($counter,3,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}
							?>
	<!--						<td align="center"><input type="text" name="ESN<? echo $counter; ?>" id="ESN<? echo $counter; ?>" size="8" maxlength="8" style="width:80px; background-color:<? echo $form_bg; ?>;" onKeyUp="if (this.value.length == 8){return checkESN('<? echo $counter; ?>');};" onChange="checkESN('<? echo $counter; ?>');" value=""> <!-- 4 hex digits (8 char.) --</td>-->
							<td align="center"><input type="text" name="ESN<? echo $counter; ?>" id="ESN<? echo $counter; ?>" size="11" maxlength="20" style="width:80px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $_REQUEST['ESN'.$counter]; ?>"> <!-- 4 hex digits (8 char.) or 11 digits decimal --></td>
							<td align="center">
								<select name="PlanID<? echo $counter; ?>" id="PlanID<? echo $counter; ?>" class="bodyBlack" style="width:430px; background-color: <? echo $form_bgcolor; ?>;" onChange="popPlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>');">
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
							<td align="center"><input type="text" name="RequestAreaCode<? echo $counter; ?>" id="RequestAreaCode<? echo $counter; ?>" size="15" maxlength="50" class="bodyBlack" style="width:80px; background-color:<? echo $form_bgcolor; ?>;" onChange="popACs('<? echo $counter; ?>','<? echo $order['device_count']; ?>');" value="<? echo $_REQUEST['RequestAreaCode'.$counter]; ?>"></td>
							<td align="center"><input type="text" name="User<? echo $counter; ?>" id="User<? echo $counter; ?>" size="15" maxlength="50" class="bodyBlack" style="width:180px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $_REQUEST['User'.$counter]; ?>"></td>
						</tr>
						<?
						}
						?>
						<tr>
							<td colspan="5" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
						</tr>
						</table>
						<script>
						// show layer with add more form
						function popMore(){
							hide('FinishedButton');
							show('AddMore');
							//document.getElementById("AddQty").focus();
						}
						</script>
						<table id="Buttons" width="900" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="210" align="center">
<!--								<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
										<td width="175" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="popMore();" class="buttonWhite">
										<strong>&raquo; Add More Devices &laquo;</strong>
										</a>
									</td>
									<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
								</tr>
								</table>-->
								<input type="button" value="&raquo; Add More Devices &laquo;" style="width:190px;" onClick="popMore();">
							</td>
							<td width="690" height="50">
								<!-- Put finished button in it's own layer so it can be swapped out -->
								<div id="FinishedButton" style="position:static; z-index:1; visibility:visible;">
<!--								<table border="0" cellspacing="0" cellpadding="0" align="right">
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
								</table>-->
									<div align="right">
									<input type="button" value="&raquo; Go to Next Step &raquo;" style="width:190px;" onClick="return validateCDMA();">
									<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									</div>
								</div>
								<!-- Layer to provide a way to add more devices wihtout starting all over -->
								<div id="AddMore" style="position:static; z-index:2; visibility:visible; display:none;">
								<script>
								// Redraw page with more device slots
								function pushMore(){
									document.PlanForm.task.value = "addmore";
									document.PlanForm.submit();
								}
								// Don't want to add more, so put finished button back up
								function popFinished(){
									hide('AddMore');
									show('FinishedButton');
								}
								</script>
								<table border="0" cellspacing="0" cellpadding="0" class="bigBlack">
								<tr>
									<td>
										<img src="images/spacer.gif" alt="" width="12" height="1" border="0">
										How many more devices would you like to add?&nbsp;
										<input type="text" name="AddQty" id="AddQty" size="1" maxlength="3" onkeypress="return onlyNumbers(event,this)" style="position:relative; background-color:<? echo $form_bgcolor; ?>;" value="">
									</td>
									<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
									<td>
<!--										<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><img src="images/ButtonBG-Left.gif" alt="" width="6" height="15" border="0"></td>
											<td align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
												<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="pushMore();" class="smallWhite" style="text-decoration:none;">
												<strong>Add</strong>
												</a>
											</td>
											<td><img src="images/ButtonBG-Right.gif" alt="" width="6" height="15" border="0"></td>
										</tr>
										</table>-->
										<input type="button" value="Add" style="width:40px;" class="bodyBlack" onClick="pushMore();">
									</td>
									<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
									<td>
<!--								<input type="button" name="AddButton" value="Add" onClick="document.PlanForm.sec.value = 'activate2'; document.PlanForm.submit();" style="position:relative;">&nbsp;&nbsp;&nbsp;-->
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="popFinished();" class="smallBlack">Whoops, I don't want to add any more.</a>
									</td>
								</tr>
								</table>
								</div>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</div>
	<?
	}
	if ($_REQUEST['Carrier'] == "at&t"){
	?>
			<div id="GSMDevices" style="position:static; visibility:<? echo iif(($locked && $_REQUEST['Carrier'] == "at&t"), 'visible;', 'hidden; display:none;'); ?>">
				<script>
				function validateGSM() {
					// NEED TO ADD A CHECK TO MAKE SURE THERE ARE NO DUPLICATE ICCIDs OR IMEIs!!
					var blank = true;
					for (counter=1; counter <= <? echo $order['device_count']; ?>; counter++){
						if (eval('document.PlanForm.ICCID'+counter+'.value') != ""){
							blank = false;
							var ICCID_regex = /(^\d{20}$)/;  // 20 digits, all numeric
							if (ICCID_regex.test(eval('document.PlanForm.ICCID'+counter+'.value')) == false) { 
								eval('PlanForm.ICCID'+counter+'.style.background="#FF0000";');
								alert('Please Enter Exactly 20 Digits (Numbers) For Device #'+counter+'\'s SIM Card Number');
								eval('PlanForm.ICCID'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.ICCID'+counter+'.focus();');
								return false;
							}
							if (eval('PlanForm.IMEI'+counter+'.value == ""')){
								eval('PlanForm.IMEI'+counter+'.style.background="#FF0000";');
								alert('Please Enter Device #'+counter+'\'s IMEI Number');
								eval('PlanForm.IMEI'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.IMEI'+counter+'.focus();');
								return false;
							}
							var IMEI_regex = /(^\d{15}$)/;  // 15 digits, all numeric
							if (IMEI_regex.test(eval('document.PlanForm.IMEI'+counter+'.value')) == false) { 
								eval('PlanForm.IMEI'+counter+'.style.background="#FF0000";');
								alert('Please Enter Exactly 15 Digits (Numbers) For Device #'+counter+'\'s IMEI Number');
								eval('PlanForm.IMEI'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.IMEI'+counter+'.focus();');
								return false;
							}
							if (eval('PlanForm.PlanID'+counter+'.value == ""')){
								eval('PlanForm.PlanID'+counter+'.style.background="#FF0000";');
								alert('Please Select A Plan For Device #'+counter);
								eval('PlanForm.PlanID'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.PlanID'+counter+'.focus();');
								return false;
							}
							if (eval('PlanForm.RequestAreaCode'+counter+'.value == ""')){
								eval('PlanForm.RequestAreaCode'+counter+'.style.background="#FF0000";');
								alert('Please Enter A Requested Area Code For Device #'+counter);
								eval('PlanForm.RequestAreaCode'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.RequestAreaCode'+counter+'.focus();');
								return false;
							}
							if (eval('PlanForm.User'+counter+'.value == ""')){
								eval('PlanForm.User'+counter+'.style.background="#FF0000";');
								alert('Please Enter A User Name Or User Location For Device #'+counter);
								eval('PlanForm.User'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.User'+counter+'.focus();');
								return false;
							}
						}
					}
					if (blank){
						alert('Please Enter At Least One Device');
						PlanForm.ICCID1.focus();
						return false;
					}
					document.PlanForm.sec.value = "activate";
					document.PlanForm.step.value = "account";
					document.PlanForm.task.value = "adddevices";
					document.PlanForm.action = 'https://secure.nr.net/deviceport/';
					document.PlanForm.submit();
				}
				</script>

				<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
				<table width="900" border="0" cellspacing="0" cellpadding="0" id="CDMADeviceTable">
				<tr>
					<td class="bigBlack">
						Please Enter Your Device Information:<br><br>
					</td>
				</tr>
				<tr>
					<td width="900">
						<?
						$query = "SELECT * FROM plans WHERE carrier = '".$_REQUEST['Carrier']."' ORDER BY display_order ASC";
						$rs_plans = mysql_query($query, $linkID);
						?>
						<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
	<!--					<tr bgcolor="<? echo $box_color; ?>" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">-->
						<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
							<td height="25" width="50" align="center">Device</td>
							<td width="170" align="center">SIM Card Number</td>
							<td width="130" align="center">IMEI Number</td>
							<td width="395" align="center">Data Plan</td>
							<td width="80" align="center">Requested <nobr>Area Code</nobr></td>
							<td width="100" align="center">User Name</td>
						</tr>
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
						<tr bgcolor="<? echo $box_bgcolor; ?>" class="bodyBlack">
							<?
							// Align numeric values centered but decimal tabbed based on length of highest number
							if ($order['device_count'] < 10){
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.$counter.'</strong></td>
								';
							}elseif ($order['device_count'] > 9 && $order['device_count'] < 100){
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*","&nbsp; ",str_pad($counter,2,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}else{
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*"," &nbsp; ",str_pad($counter,3,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}
							?>
							<td align="center"><input type="text" name="ICCID<? echo $counter; ?>" id="ICCID<? echo $counter; ?>" size="20" maxlength="20" style="width:150px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $_REQUEST['ICCID'.$counter]; ?>"> <!-- 20 digits decimal --></td>
							<td align="center"><input type="text" name="IMEI<? echo $counter; ?>" id="IMEI<? echo $counter; ?>" size="15" maxlength="15" style="width:110px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $_REQUEST['IMEI'.$counter]; ?>"> <!-- 15 digits decimal --></td>
							<td align="center">
								<select name="PlanID<? echo $counter; ?>" id="PlanID<? echo $counter; ?>" class="bodyBlack" style="width:375px; background-color: <? echo $form_bgcolor; ?>;" onChange="popPlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>');">
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
							<td align="center"><input type="text" name="RequestAreaCode<? echo $counter; ?>" id="RequestAreaCode<? echo $counter; ?>" size="15" maxlength="50" class="bodyBlack" style="width:60px; background-color:<? echo $form_bgcolor; ?>;" onChange="popACs('<? echo $counter; ?>','<? echo $order['device_count']; ?>');" value="<? echo $_REQUEST['RequestAreaCode'.$counter]; ?>"></td>
							<td align="center"><input type="text" name="User<? echo $counter; ?>" id="User<? echo $counter; ?>" size="15" maxlength="50" class="bodyBlack" style="width:80px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $_REQUEST['User'.$counter]; ?>"></td>
						</tr>
						<?
						}
						?>
						<tr>
							<td colspan="6" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
						</tr>
						</table>
						<script>
						// show layer with add more form
						function popMore(){
							hide('FinishedButton');
							show('AddMore');
							//document.getElementById("AddQty").focus();
						}
						</script>
						<table id="Buttons" width="900" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="210" align="center">
<!--								<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
										<td width="175" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="popMore();" class="buttonWhite">
										<strong>&raquo; Add More Devices &laquo;</strong>
										</a>
									</td>
									<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
								</tr>
								</table>-->
								<input type="button" value="&raquo; Add More Devices &laquo;" style="width:190px;" onClick="popMore();">
							</td>
							<td width="690" height="50">
								<!-- Put finished button in it's own layer so it can be swapped out -->
								<div id="FinishedButton" style="position:static; z-index:1; visibility:visible;">
<!--								<table border="0" cellspacing="0" cellpadding="0" align="right">
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
								</table>-->
									<div align="right">
									<input type="button" value="&raquo; Go to Next Step &raquo;" style="width:190px;" onClick="validateGSM();">
									<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									</div>
								</div>
								<!-- Layer to provide a way to add more devices wihtout starting all over -->
								<div id="AddMore" style="position:static; z-index:2; visibility:visible; display:none;">
								<script>
								// Redraw page with more device slots
								function pushMore(){
									document.PlanForm.task.value = "addmore";
									document.PlanForm.submit();
								}
								// Don't want to add more, so put finished button back up
								function popFinished(){
									hide('AddMore');
									show('FinishedButton');
								}
								</script>
								<table border="0" cellspacing="0" cellpadding="0" class="bigBlack">
								<tr>
									<td>
										<img src="images/spacer.gif" alt="" width="12" height="1" border="0">
										How many more devices would you like to add?&nbsp;
										<input type="text" name="AddQty" id="AddQty" size="1" maxlength="3" onkeypress="return onlyNumbers(event,this)" style="position:relative; background-color:<? echo $form_bgcolor; ?>;" value="">
									</td>
									<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
									<td>
<!--										<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td><img src="images/ButtonBG-Left.gif" alt="" width="6" height="15" border="0"></td>
											<td align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
												<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="pushMore();" class="smallWhite" style="text-decoration:none;">
												<strong>Add</strong>
												</a>
											</td>
											<td><img src="images/ButtonBG-Right.gif" alt="" width="6" height="15" border="0"></td>
										</tr>
										</table>-->
										<input type="button" value="Add" style="width:40px;" class="bodyBlack" onClick="pushMore();">
									</td>
									<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
									<td>
<!--								<input type="button" name="AddButton" value="Add" onClick="document.PlanForm.sec.value = 'activate2'; document.PlanForm.submit();" style="position:relative;">&nbsp;&nbsp;&nbsp;-->
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="popFinished();" class="smallBlack">Whoops, I don't want to add any more.</a>
									</td>
								</tr>
								</table>
								</div>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</div>
	<?
	}
	?>
			</td>
		</tr>
	</td>
	<input type="hidden" name="sec" id="sec" value="">
	<input type="hidden" name="step" id="step" value="">
	<input type="hidden" name="task" id="task" value="">
	<input type="hidden" name="sid" id="sid" value="<? echo $SID; ?>">
	<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
	<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
	<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
	<input type="hidden" name="Discount" id="Discount" value="<? echo $order['plan_discount'] ?>">
	<input type="hidden" name="locked" id="locked" value="T">
<!--<input type="hidden" name="dev" id="dev" value="T">-->
	</form>
</tr>
<!--<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>-->
</table>

<?
}elseif ($step == "account"){
?>
	<!-- SSL Site Seal -->
	<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

	<?
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
	$rowcount = 0;
	$roweven = "#F6F6F6";
	$rowodd = "#FFFFFF";
	?>

	<script>
	function validateForm(id) {
		theForm = document.getElementById(id);
		// Verify First Name
		if (theForm.first_name){
			if (theForm.first_name.value == ""){
				theForm.first_name.style.background="#FF0000";
				alert("Please Enter A First Name");
				theForm.first_name.style.background="#FFFFFF";
				theForm.first_name.focus();
				return false;
			}
		}
		// Verify Last Name
		if (theForm.last_name){
			if (theForm.last_name.value == ""){
				theForm.last_name.style.background="#FF0000";
				alert("Please Enter A Last Name");
				theForm.last_name.style.background="#FFFFFF";
				theForm.last_name.focus();
				return false;
			}
		}
		// Verify Company Name
		if (theForm.company_name){
			if (theForm.company_name.value == ""){
				theForm.company_name.style.background="#FF0000";
				alert("Please Enter A Company Name");
				theForm.company_name.style.background="#FFFFFF";
				theForm.company_name.focus();
				return false;
			}
		}
		// Verify Tax ID
		if (theForm.tax_id){
			if (theForm.tax_id.value == ""){
				theForm.tax_id.style.background="#FF0000";
				alert("Please Enter A Company Tax ID");
				theForm.tax_id.style.background="#FFFFFF";
				theForm.tax_id.focus();
				return false;
			}
		}
		// Verify Primary Wireless Phone Number
		if (theForm.wireless_phone && theForm.acct_number){
			if (theForm.wireless_phone.value == "" && theForm.acct_number.value == ""){
				theForm.wireless_phone.style.background="#FF0000";
				theForm.acct_number.style.background="#FF0000";
				alert("Please Enter This Account's Primary Wireless Phone\n\rNumber, The Account Number, Or Both");
				theForm.wireless_phone.style.background="#FFFFFF";
				theForm.acct_number.style.background="#FFFFFF";
				theForm.wireless_phone.focus();
				return false;
			}
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (theForm.wireless_phone.value != "" && phone1_regex.test(theForm.wireless_phone.value) == false && phone2_regex.test(theForm.wireless_phone.value) == false) { 
				theForm.wireless_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.wireless_phone.style.background="#FFFFFF";
				theForm.wireless_phone.focus();
				return false;
			}
		}
		// Shipping Address (1)
		if (theForm.ship_address_1){
			if (theForm.ship_address_1.value == ""){
				theForm.ship_address_1.style.background="#FF0000";
				theForm.ship_address_2.style.background="#FF0000";
				alert("Please Enter Your Shipping Address");
				theForm.ship_address_1.style.background="#FFFFFF";
				theForm.ship_address_2.style.background="#FFFFFF";
				theForm.ship_address_1.focus();
				return false;
			}
		}
		// Shipping City
		if (theForm.ship_city){
			if (theForm.ship_city.value == ""){
				theForm.ship_city.style.background="#FF0000";
				alert("Please Enter Your Shipping City");
				theForm.ship_city.style.background="#FFFFFF";
				theForm.ship_city.focus();
				return false;
			}
		}
		// Shipping State
		if (theForm.ship_state){
			if (theForm.ship_state.value == ""){
				theForm.ship_state.style.background="#FF0000";
				alert("Please Select Your Shipping State");
				theForm.ship_state.style.background="#FFFFFF";
				theForm.ship_state.focus();
				return false;
			}
		}
		// Shipping Zip Code
		if (theForm.ship_zipcode){
			if (theForm.ship_zipcode.value == ""){
				theForm.ship_zipcode.style.background="#FF0000";
				alert("Please Enter Your Shipping Zipcode");
				theForm.ship_zipcode.style.background="#FFFFFF";
				theForm.ship_zipcode.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.ship_zipcode.value) == false && cdn_regex.test(theForm.ship_zipcode.value) == false) { 
 			if (usa_regex.test(theForm.ship_zipcode.value) == false) { 
				theForm.ship_zipcode.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.ship_zipcode.style.background="#FFFFFF";
				theForm.ship_zipcode.focus();
				return false;
			}
		}
		// Billing Address (1)
		if (theForm.bill_address_1){
			if (theForm.bill_address_1.value == ""){
				theForm.bill_address_1.style.background="#FF0000";
				theForm.bill_address_2.style.background="#FF0000";
				alert("Please Enter Your Billing Address");
				theForm.bill_address_1.style.background="#FFFFFF";
				theForm.bill_address_2.style.background="#FFFFFF";
				theForm.bill_address_1.focus();
				return false;
			}
		}
		// Billing City
		if (theForm.bill_city){
			if (theForm.bill_city.value == ""){
				theForm.bill_city.style.background="#FF0000";
				alert("Please Enter Your Billing City");
				theForm.bill_city.style.background="#FFFFFF";
				theForm.bill_city.focus();
				return false;
			}
		}
		// Billing State
		if (theForm.bill_state){
			if (theForm.bill_state.value == ""){
				theForm.bill_state.style.background="#FF0000";
				alert("Please Select Your Billing State");
				theForm.bill_state.style.background="#FFFFFF";
				theForm.bill_state.focus();
				return false;
			}
		}
		// Billing Zip Code
		if (theForm.bill_zipcode){
			if (theForm.bill_zipcode.value == ""){
				theForm.bill_zipcode.style.background="#FF0000";
				alert("Please Enter Your Billing Zipcode");
				theForm.bill_zipcode.style.background="#FFFFFF";
				theForm.bill_zipcode.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.bill_zipcode.value) == false && cdn_regex.test(theForm.bill_zipcode.value) == false) { 
 			if (usa_regex.test(theForm.bill_zipcode.value) == false) { 
				theForm.bill_zipcode.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.bill_zipcode.style.background="#FFFFFF";
				theForm.bill_zipcode.focus();
				return false;
			}
		}
		// Service Address (1)
		if (theForm.service_address_1){
			if (theForm.service_address_1.value == ""){
				theForm.service_address_1.style.background="#FF0000";
				theForm.service_address_2.style.background="#FF0000";
				alert("Please Enter Your Service Address");
				theForm.service_address_1.style.background="#FFFFFF";
				theForm.service_address_2.style.background="#FFFFFF";
				theForm.service_address_1.focus();
				return false;
			}
		}
		// Service City
		if (theForm.service_city){
			if (theForm.service_city.value == ""){
				theForm.service_city.style.background="#FF0000";
				alert("Please Enter Your Service City");
				theForm.service_city.style.background="#FFFFFF";
				theForm.service_city.focus();
				return false;
			}
		}
		// Service State
		if (theForm.service_state){
			if (theForm.service_state.value == ""){
				theForm.service_state.style.background="#FF0000";
				alert("Please Select Your Service State");
				theForm.service_state.style.background="#FFFFFF";
				theForm.service_state.focus();
				return false;
			}
		}
		// Service Zip Code
		if (theForm.service_zipcode){
			if (theForm.service_zipcode.value == ""){
				theForm.service_zipcode.style.background="#FF0000";
				alert("Please Enter Your Service Zipcode");
				theForm.service_zipcode.style.background="#FFFFFF";
				theForm.service_zipcode.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.Service_zipcode.value) == false && cdn_regex.test(theForm.Service_zipcode.value) == false) { 
 			if (usa_regex.test(theForm.service_zipcode.value) == false) { 
				theForm.service_zipcode.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.service_zipcode.style.background="#FFFFFF";
				theForm.service_zipcode.focus();
				return false;
			}
		}
		// Verify Billing Name
		if (theForm.billing_name){
			if (theForm.billing_name.value == ""){
				theForm.billing_name.style.background="#FF0000";
				alert("Please Enter A Billing Name");
				theForm.billing_name.style.background="#FFFFFF";
				theForm.billing_name.focus();
				return false;
			}
		}
		// Billing Phone Number
		if (theForm.billing_phone){
			if (theForm.billing_phone.value == ""){
				theForm.billing_phone.style.background="#FF0000";
				alert("Please Enter The Billing Phone Number");
				theForm.billing_phone.style.background="#FFFFFF";
				theForm.billing_phone.focus();
				return false;
			}
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.billing_phone.value) == false && phone2_regex.test(theForm.billing_phone.value) == false) { 
				theForm.billing_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.billing_phone.style.background="<? echo $form_bg; ?>";
				theForm.billing_phone.focus();
				return false;
			}
		}
		// Email Address
		if (theForm.billing_email){
			if (theForm.billing_email.value == ""){
				theForm.billing_email.style.background="#FF0000";
//				theForm.billing_email_confirm.style.background="#FF0000";
				alert("Please Enter the Billing Email Address");
				theForm.billing_email.style.background="#FFFFFF";
//				theForm.billing_email_confirm.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for "@"
	 		if (theForm.billing_email.value.indexOf("@") == -1) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Must Contain an "@"');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for "@" as first char.
	 		if (theForm.billing_email.value.indexOf("@") == 0) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "@"');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for anything after "@"
	 		if (theForm.billing_email.value.length == (theForm.billing_email.value.indexOf("@")+1)) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Must Contain a Domain Name After the "@"');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for multiple "@"
	 		if (theForm.billing_email.value.substring((theForm.billing_email.value.indexOf("@")+1),theForm.billing_email.value.length).indexOf("@") != -1) {
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Must Contain Only One "@"');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for "."
	 		if (theForm.billing_email.value.indexOf(".") == -1) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Must Contain a "."');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for "." as first char.
	 		if (theForm.billing_email.value.indexOf(".") == 0) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "."');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for ".."
	 		if (theForm.billing_email.value.indexOf("..") != -1) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots ("..")');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for "." adjacent to "@"
	 		if (theForm.billing_email.value.indexOf(".@") != -1 || theForm.billing_email.value.indexOf("@.") != -1) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for TLD
	 		if (theForm.billing_email.value.length == (theForm.billing_email.value.indexOf(".")+1)) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for TLD at least 2 char.
			var domain = theForm.billing_email.value.substring((theForm.billing_email.value.indexOf("@")+1),theForm.billing_email.value.length);
			if (domain.length - (domain.indexOf(".")+1) < 2) {
				theForm.billing_email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for TLD over 3 char.
//			if (domain.length - (domain.indexOf(".")+1) > 3) {
//				theForm.billing_email.style.background="#FF0000";
//				alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//				theForm.billing_email.style.background="#FFFFFF";
//				theForm.billing_email.focus();
//				return false;
//			}
			// Check for "_" in TLD
			if (theForm.billing_email.value.indexOf("_") > theForm.billing_email.value.indexOf("@")) {
				theForm.billing_email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for spaces
	 		if (theForm.billing_email.value.indexOf(" ") != -1) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Spaces (" ")');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
			// Check for illegal char.
			var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	 		if (email_regex.test(theForm.billing_email.value) == false) { 
				theForm.billing_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
				theForm.billing_email.style.background="#FFFFFF";
				theForm.billing_email.focus();
				return false;
			}
//			if (theForm.billing_email.value != theForm.billing_email_confirm.value){
//				theForm.billing_email.style.background="#FF0000";
//				theForm.billing_email_confirm.style.background="#FF0000";
//				alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
//				theForm.billing_email.style.background="#FFFFFF";
//				theForm.billing_email_confirm.style.background="#FFFFFF";
//				theForm.billing_email.focus();
//				return false;
//			}
		}
		// Verify Contact Name
		if (theForm.contact_name){
			if (theForm.contact_name.value == ""){
				theForm.contact_name.style.background="#FF0000";
				alert("Please Enter A Contact Name");
				theForm.contact_name.style.background="#FFFFFF";
				theForm.contact_name.focus();
				return false;
			}
		}
		// Contact Phone Number
		if (theForm.contact_phone){
			if (theForm.contact_phone.value == ""){
				theForm.contact_phone.style.background="#FF0000";
				alert("Please Enter The Contact Phone Number");
				theForm.contact_phone.style.background="#FFFFFF";
				theForm.contact_phone.focus();
				return false;
			}
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.contact_phone.value) == false && phone2_regex.test(theForm.contact_phone.value) == false) { 
				theForm.contact_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.contact_phone.style.background="#FFFFFF";
				theForm.contact_phone.focus();
				return false;
			}
		}
		// Contact Email Address
		if (theForm.contact_email){
			if (theForm.contact_email.value == ""){
				theForm.contact_email.style.background="#FF0000";
//				theForm.contact_email_confirm.style.background="#FF0000";
				alert("Please Enter the Contact Email Address");
				theForm.contact_email.style.background="#FFFFFF";
//				theForm.contact_email_confirm.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for "@"
	 		if (theForm.contact_email.value.indexOf("@") == -1) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Must Contain an "@"');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for "@" as first char.
	 		if (theForm.contact_email.value.indexOf("@") == 0) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "@"');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for anything after "@"
	 		if (theForm.contact_email.value.length == (theForm.contact_email.value.indexOf("@")+1)) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Must Contain a Domain Name After the "@"');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for multiple "@"
	 		if (theForm.contact_email.value.substring((theForm.contact_email.value.indexOf("@")+1),theForm.contact_email.value.length).indexOf("@") != -1) {
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Must Contain Only One "@"');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for "."
	 		if (theForm.contact_email.value.indexOf(".") == -1) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Must Contain a "."');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for "." as first char.
	 		if (theForm.contact_email.value.indexOf(".") == 0) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "."');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for ".."
	 		if (theForm.contact_email.value.indexOf("..") != -1) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots ("..")');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for "." adjacent to "@"
	 		if (theForm.contact_email.value.indexOf(".@") != -1 || theForm.contact_email.value.indexOf("@.") != -1) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for TLD
	 		if (theForm.contact_email.value.length == (theForm.contact_email.value.indexOf(".")+1)) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for TLD at least 2 char.
			var domain = theForm.contact_email.value.substring((theForm.contact_email.value.indexOf("@")+1),theForm.contact_email.value.length);
			if (domain.length - (domain.indexOf(".")+1) < 2) {
				theForm.contact_email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for TLD over 3 char.
//			if (domain.length - (domain.indexOf(".")+1) > 3) {
//				theForm.contact_email.style.background="#FF0000";
//				alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//				theForm.contact_email.style.background="#FFFFFF";
//				theForm.contact_email.focus();
//				return false;
//			}
			// Check for "_" in TLD
			if (theForm.contact_email.value.indexOf("_") > theForm.contact_email.value.indexOf("@")) {
				theForm.contact_email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for spaces
	 		if (theForm.contact_email.value.indexOf(" ") != -1) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Spaces (" ")');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
			// Check for illegal char.
			var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	 		if (email_regex.test(theForm.contact_email.value) == false) { 
				theForm.contact_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
				theForm.contact_email.style.background="#FFFFFF";
				theForm.contact_email.focus();
				return false;
			}
//			if (theForm.contact_email.value != theForm.contact_email_confirm.value){
//				theForm.contact_email.style.background="#FF0000";
//				theForm.contact_email_confirm.style.background="#FF0000";
//				alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
//				theForm.contact_email.style.background="#FFFFFF";
//				theForm.contact_email_confirm.style.background="#FFFFFF";
//				theForm.contact_email.focus();
//				return false;
//			}
		}
		// Home Phone Number
		if (theForm.home_phone){
			if (theForm.home_phone.value == ""){
				theForm.home_phone.style.background="#FF0000";
				alert("Please Enter Your Home Phone Number");
				theForm.home_phone.style.background="#FFFFFF";
				theForm.home_phone.focus();
				return false;
			}
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.home_phone.value) == false && phone2_regex.test(theForm.home_phone.value) == false) { 
				theForm.home_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.home_phone.style.background="#FFFFFF";
				theForm.home_phone.focus();
				return false;
			}
		}
		// Alternate Phone Number
		if (theForm.alt_phone){
			if (theForm.alt_phone.value != ""){
//			if (theForm.alt_phone.value == ""){
//				theForm.alt_phone.style.background="#FF0000";
//				alert("Please Enter An Alternate Phone Number");
//				theForm.alt_phone.style.background="#FFFFFF";
//				theForm.alt_phone.focus();
//				return false;
//			}
				var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
				var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 				if (phone1_regex.test(theForm.alt_phone.value) == false && phone2_regex.test(theForm.alt_phone.value) == false) { 
					theForm.alt_phone.style.background="#FF0000";
					alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
					theForm.alt_phone.style.background="#FFFFFF";
					theForm.alt_phone.focus();
					return false;
				}
			}
		}
		// Email Address
		if (theForm.email){
			if (theForm.email.value == ""){
				theForm.email.style.background="#FF0000";
				theForm.email_confirm.style.background="#FF0000";
				alert("Please Enter Your Email Address Twice to Confirm");
				theForm.email.style.background="#FFFFFF";
				theForm.email_confirm.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for "@"
	 		if (theForm.email.value.indexOf("@") == -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain an "@"');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for "@" as first char.
	 		if (theForm.email.value.indexOf("@") == 0) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "@"');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for anything after "@"
	 		if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a Domain Name After the "@"');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for multiple "@"
	 		if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain Only One "@"');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for "."
	 		if (theForm.email.value.indexOf(".") == -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a "."');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for "." as first char.
	 		if (theForm.email.value.indexOf(".") == 0) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "."');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for ".."
	 		if (theForm.email.value.indexOf("..") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots ("..")');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for "." adjacent to "@"
	 		if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for TLD
	 		if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for TLD at least 2 char.
			var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
			if (domain.length - (domain.indexOf(".")+1) < 2) {
				theForm.email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for TLD over 3 char.
//			if (domain.length - (domain.indexOf(".")+1) > 3) {
//				theForm.email.style.background="#FF0000";
//				alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//				theForm.email.style.background="#FFFFFF";
//				theForm.email.focus();
//				return false;
//			}
			// Check for "_" in TLD
			if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
				theForm.email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for spaces
	 		if (theForm.email.value.indexOf(" ") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Spaces (" ")');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			// Check for illegal char.
			var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	 		if (email_regex.test(theForm.email.value) == false) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
				theForm.email.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
			if (theForm.email.value != theForm.email_confirm.value){
				theForm.email.style.background="#FF0000";
				theForm.email_confirm.style.background="#FF0000";
				alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
				theForm.email.style.background="#FFFFFF";
				theForm.email_confirm.style.background="#FFFFFF";
				theForm.email.focus();
				return false;
			}
		}
		// SSN
		if (theForm.ssn){
			if (theForm.ssn.value == ""){
				theForm.ssn.style.background="#FF0000";
				alert("Please Enter Your Social Security Number");
				theForm.ssn.style.background="#FFFFFF";
				theForm.ssn.focus();
				return false;
			}
			var ssn_regex = /(^\d{3}-\d{2}-\d{4}$)/;  // xxx-xx-xxxx
 			if (ssn_regex.test(theForm.ssn.value) == false) { 
				theForm.ssn.style.background="#FF0000";
				alert('Please Enter a Valid Social Security Number as "NNN-NN-NNNN"');
				theForm.ssn.style.background="#FFFFFF";
				theForm.ssn.focus();
				return false;
			}
		}
		// Date of Birth
		if (theForm.dob){
			if (theForm.dob.value == ""){
				theForm.dob.style.background="#FF0000";
				alert("Please Enter Your Date of Birth");
				theForm.dob.style.background="#FFFFFF";
				theForm.dob.focus();
				return false;
			}
			// check format
			var dob1_regex = /(^\d{2}\/\d{2}\/\d{4}$)/;  // mm/dd/yyyy
//			var dob2_regex = /(^\d{2}\-\d{2}\-\d{4}$)/;  // mm-dd-yyyy
// 			if (dob1_regex.test(theForm.dob.value) == false && dob2_regex.test(theForm.dob.value) == false) { 
 			if (dob1_regex.test(theForm.dob.value) == false) { 
				theForm.dob.style.background="#FF0000";
//				alert('Please Enter a Valid Date as "MM/DD/YYYY" or "MM-DD-YYYY"');
				alert('Please Enter a Valid Date as "MM/DD/YYYY"');
				theForm.dob.style.background="#FFFFFF";
				theForm.dob.focus();
				return false;
			}
			// is it a valid date?
			if (isValidDate(theForm.dob.value) == false){
				theForm.dob.style.background="#FF0000";
				alert("Please Enter A Valid Date for Date of Birth");
				theForm.dob.style.background="#FFFFFF";
				theForm.dob.focus();
				return false;
			}
			// are they 18?
			var now = new Date();
			var then = new Date(now.getTime()-(1000*60*60*24*365*18+345600000)); // 18 years ago + 4 days for leap years
			if (compareDates(theForm.dob.value,"M/d/yyyy",formatDate(then,'M/d/yyyy'),"M/d/yyyy") == 1){
				theForm.dob.style.background="#FF0000";
				alert("The Birth Date you entered indicates you are not yet 18 - you must be at least 18 to order a phone.");
				theForm.dob.style.background="#FFFFFF";
				theForm.dob.focus();
				return false;
			}
		}
		// Driver's License Number
		if (theForm.dl_number){
			if (theForm.dl_number.value == ""){
				theForm.dl_number.style.background="#FF0000";
				alert("Please Enter Your Driver's License Number");
				theForm.dl_number.style.background="#FFFFFF";
				theForm.dl_number.focus();
				return false;
			}
		}
		// Driver's License State
		if (theForm.dl_state){
			if (theForm.dl_state.value == ""){
				theForm.dl_state.style.background="#FF0000";
				alert("Please Select Your Driver's License State");
				theForm.dl_state.style.background="#FFFFFF";
				theForm.dl_state.focus();
				return false;
			}
		}
		// Driver's License Expiration Month
		if (theForm.dl_exp_month){
			if (theForm.dl_exp_month.value == ""){
				theForm.dl_exp_month.style.background="#FF0000";
				alert("Please Select Your Driver's License Expiration Month");
				theForm.dl_exp_month.style.background="#FFFFFF";
				theForm.dl_exp_month.focus();
				return false;
			}
		}
		// Driver's License Expiration Day
		if (theForm.dl_exp_day){
			if (theForm.dl_exp_day.value == ""){
				theForm.dl_exp_day.style.background="#FF0000";
				alert("Please Select Your Driver's License Expiration Day\n\r(Choose the last day of the month if there isn't an expiration day)");
				theForm.dl_exp_day.style.background="#FFFFFF";
				theForm.dl_exp_day.focus();
				return false;
			}
		}
		// Driver's License Expiration Year
		if (theForm.dl_exp_year){
			if (theForm.dl_exp_year.value == ""){
				theForm.dl_exp_year.style.background="#FF0000";
				alert("Please Select Your Driver's License Expiration Year");
				theForm.dl_exp_year.style.background="#FFFFFF";
				theForm.dl_exp_year.focus();
				return false;
			}
		}
	// Driver's License Expiration Date Passed?
		if (theForm.dl_exp_month && theForm.dl_exp_day && theForm.dl_exp_year){
			var expires = new Date(theForm.dl_exp_year.value,theForm.dl_exp_month.value-1,theForm.dl_exp_day.value,0,0);
				if (compareDates(formatDate(expires,'MMM d, y'),"MMM d, y",formatDate(new Date(),'MMM d, y'),"MMM d, y")== 0){
				theForm.dl_exp_month.style.background="#FF0000";
				theForm.dl_exp_day.style.background="#FF0000";
				theForm.dl_exp_year.style.background="#FF0000";
				alert("The Expiration Date You Entered Indicates That Your Driver's License Is Expired");
				theForm.dl_exp_month.style.background="#FFFFFF";
				theForm.dl_exp_day.style.background="#FFFFFF";
				theForm.dl_exp_year.style.background="#FFFFFF";
				theForm.dl_exp_month.focus();
				return false;
			}
		}
			
////////////////////////////////////////////////////////////////




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
/*		if (theForm.AcctType){
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
*/

		theForm.submit();
//		return true;
	}























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

	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" bgcolor="<? echo $content_bgcolor; ?>">
	
		<!-- Step Label -->
		
			<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td>
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="800" valign="top">
							<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td valign="top" class="superbigBlack">Activate with PWS</td>
							</tr>
							<tr>
								<td valign="top" class="bigBlack">Please Enter Account Information For This <? echo $sAcctType; ?>Account:</td>
							</tr>
							<tr>
								<td class="bodyBlack">
									<br>
									<ul>
										<li>This site is secure. &nbsp;Data encryption ensures that your confidential information will be securely transmitted.<br>All information entered on this form is secured by <a href="http://www.comodo.com" target="_blank" class="bodyBlack">C&middot;O&middot;M&middot;O&middot;D&middot;O</a>, verified by the Site Seal to the right.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
						<td valign="top" width="100" rowspan="2" align="right"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
					</tr>
					</table>
				</td>
			</tr>
<!--			<form action="" method="POST" name="AcctInfo" id="AcctInfo" onSubmit="return validate(this);">-->
			<form action="" method="POST" name="AcctInfo" id="AcctInfo">
			<tr>
				<td align="center">
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
					<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
						<td height="25" align="center"><? echo iif($order['acct_type'] == "IL" && $order['add_line'] == "No", 'Billing &amp; Shipping', 'Account'); ?> Information</td>
					</tr>
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
<!--							<tr>
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
										<td width="195" valign="top"><input type="text" name="wireless_phone" id="wireless_phone" size="30" maxlength="50" tabindex="6" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['wireless_phone']; ?>"><span class="smallBlack"><br>Primary Number for This Account</span></td>
										<td width="605" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="15" height="1" border="0">Acct#:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="acct_number" id="acct_number" size="30" maxlength="50" tabindex="7" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['acct_number']; ?>"><span class="smallBlack"> *Enter Either or Both</span></td>
									</tr>
									<tr>
										<?
										if ($order['add_line'] == "No"){
										?>
										<td colspan="2" class="xbigBlack"><img src="images/spacer.gif" alt="" width="87" height="1" border="0">Requested Password:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="password" id="password" size="30" maxlength="50" tabindex="8" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['password']; ?>"><span class="smallBlack"> *Optional</span></td>
										<?
										}else{
										?>
										<td colspan="2" class="xbigBlack"><img src="images/spacer.gif" alt="" width="111" height="1" border="0">Account Password:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="password" id="password" size="30" maxlength="50" tabindex="8" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['password']; ?>"><span class="smallBlack"> *If Applicable</span></td>
										<?
										}
										?>
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
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Service Address:<? echo iif($order['add_line'] == "No", '<br><span class="smallBlack"><a href="javascript:CopyShipToUse();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Shipping Address Here</strong></a></span><br><span class="smallBlack"><a href="javascript:CopyBillToUse();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Billing Address Here</strong></a></span>', ''); ?></td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td><input type="text" name="service_address_1" id="service_address_1" size="30" maxlength="50" tabindex="18" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['service_address_1']; ?>"></td>
										<td colspan="2"><input type="text" name="service_address_2" id="service_address_2" size="30" maxlength="50" tabindex="19" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['service_address_2']; ?>"><span class="smallBlack"> *Primary Place of Use Address</span></td>
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



<!--							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
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
							</tr>-->





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
										<td width="605" class="xbigBlack">&nbsp;Confirm:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="email_confirm" id="email_confirm" size="30" maxlength="50" tabindex="35" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value=""><br><img src="images/spacer.gif" alt="" width="105" height="1" border="0"><span class="smallBlack"> *Please Re-Enter Email Address</span></td>
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
<!--					<tr>
						<td colspan="2" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="900" height="2" border="0"></td>
					</tr>-->
					</table>
					<?
					if ($order['acct_type'] == "IL" && $order['add_line'] == "No"){
						$rowcount = 0;
					?>
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top">
							<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="bodyBlack">
									<br>
									<ul>
										<li>The following information will assist in verifying customer identity. By providing this information, you consent to <? echo $carrier; ?> pulling any necessary credit report(s) to determine creditworthiness. This site is secure. Encryption ensures that your confidential information will be securely transmitted.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
					<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
						<td height="25" align="center">Credit Approval</td>
					</tr>
<!--					<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
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
					</tr>-->
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" class="borderNone">
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
							</tr>
							<tr>
							<tr>
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Driver's License Expiration:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td colspan="2">
											<? $dl_date = mktime(0,0,0,substr($order['dl_expiration'],0,2),substr($order['dl_expiration'],3,2),substr($order['dl_expiration'],6,4)); ?>
											<select name="dl_exp_month" id="dl_exp_month" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width:125px;" tabindex="23">
												<option value="">Month</option>
												<option value="01"<? if(date("m",$dl_date)=="01") echo " selected";?>>(01) January</option>
												<option value="02"<? if(date("m",$dl_date)=="02") echo " selected";?>>(02) February</option>
												<option value="03"<? if(date("m",$dl_date)=="03") echo " selected";?>>(03) March</option>
												<option value="04"<? if(date("m",$dl_date)=="04") echo " selected";?>>(04) April</option>
												<option value="05"<? if(date("m",$dl_date)=="05") echo " selected";?>>(05) May</option>
												<option value="06"<? if(date("m",$dl_date)=="06") echo " selected";?>>(06) June</option>
												<option value="07"<? if(date("m",$dl_date)=="07") echo " selected";?>>(07) July</option>
												<option value="08"<? if(date("m",$dl_date)=="08") echo " selected";?>>(08) August</option>
												<option value="09"<? if(date("m",$dl_date)=="09") echo " selected";?>>(09) September</option>
												<option value="10"<? if(date("m",$dl_date)=="10") echo " selected";?>>(10) October</option>
												<option value="11"<? if(date("m",$dl_date)=="11") echo " selected";?>>(11) November</option>
												<option value="12"<? if(date("m",$dl_date)=="12") echo " selected";?>>(12) December</option>
											</select>
											<select name="dl_exp_day" id="dl_exp_day" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width:65px;" tabindex="24">
												<option value="">Day</option>
		<?
		for ($option=1; $option <= 31; $option++){
			echo'
												<option value="'.iif($option<10,"0","").$option.'"'.iif(date("d",$dl_date)==$option,' selected', '').'>'.$option.'</option>
			';
		}
		?>
											</select>
											<select name="dl_exp_year" id="dl_exp_year" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width: 67px;" tabindex="25">
												<option value="">Year</option>
		<?
		echo'
												<option value="'.date("Y").'"'.iif(date("Y",$dl_date)==date("Y"),' selected', '').'>'.date("Y").'</option>
												<option value="'.(date("Y")+1).'"'.iif(date("Y",$dl_date)==date("Y")+1,' selected', '').'>'.(date("Y")+1).'</option>
												<option value="'.(date("Y")+2).'"'.iif(date("Y",$dl_date)==date("Y")+2,' selected', '').'>'.(date("Y")+2).'</option>
												<option value="'.(date("Y")+3).'"'.iif(date("Y",$dl_date)==date("Y")+3,' selected', '').'>'.(date("Y")+3).'</option>
												<option value="'.(date("Y")+4).'"'.iif(date("Y",$dl_date)==date("Y")+4,' selected', '').'>'.(date("Y")+4).'</option>
												<option value="'.(date("Y")+5).'"'.iif(date("Y",$dl_date)==date("Y")+5,' selected', '').'>'.(date("Y")+5).'</option>
												<option value="'.(date("Y")+6).'"'.iif(date("Y",$dl_date)==date("Y")+6,' selected', '').'>'.(date("Y")+6).'</option>
												<option value="'.(date("Y")+7).'"'.iif(date("Y",$dl_date)==date("Y")+7,' selected', '').'>'.(date("Y")+7).'</option>
												<option value="'.(date("Y")+8).'"'.iif(date("Y",$dl_date)==date("Y")+8,' selected', '').'>'.(date("Y")+8).'</option>
												<option value="'.(date("Y")+9).'"'.iif(date("Y",$dl_date)==date("Y")+9,' selected', '').'>'.(date("Y")+9).'</option>
		';
		?>
											</select>
									</tr>
									</table>
								</td>
							</tr>
<!--
									</table>
								</td>
								<td width="200">&nbsp;</td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
							</tr>-->
							</table>
						</td>
					</tr>
<!--					<tr>
						<td colspan="2" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="900" height="2" border="0"></td>
					</tr>-->
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
<!--							<table border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
									<td width="300" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
									<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="document.AcctInfo.submit();" class="buttonWhite">
									<strong>&raquo; Proceed to Confirmation &laquo;</strong>
									</a>
								</td>
								<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
							</tr>
							</table>-->
							<input type="button" value="&raquo; Proceed to Confirmation &laquo;" style="width:320px;" class="bodyBlack" onClick="validateForm('AcctInfo');">
							<br><br><br>
						<td>
					</tr>
					</table>
				</td>
			</tr>
			</form>
<!--		</td>
	</tr>-->
			
			<!-- Cart Contents -->
			
<!--	<tr>
		<td>-->
			<tr>
				<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
			</tr>
			<tr>
<!--				<td align="center" bgcolor="#F0F0F0">-->
				<td align="center">
<!--				<td colspan="2" align="center" bgcolor="#F5E7E7" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>; border-top:thin solid <? echo $border_color; ?>;">-->
					<br>
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="superbigBlack">Cart Contents:</td>
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
									document.RemoveForm.task.value = 'remove';
									document.RemoveForm.Carrier.value = '<? echo $_SESSION['carrier']; ?>';
									document.RemoveForm.esn.value = ESN;
									document.RemoveForm.iccid.value = ICCID;
									document.RemoveForm.sid.value = '<? echo $SID; ?>';
									document.RemoveForm.submit();
								}
							}
							</script>
							<br>
						<?
			//echo $_SESSION['carrier'];
							$query = "SELECT * FROM orders o, devices d WHERE o.session_id='".$SID."' AND d.session_id='".$SID."' ORDER BY esn";
			//				$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
							$rs_cart = mysql_query($query, $linkID);
							$row = mysql_fetch_assoc($rs_cart);
							$discount = ($row["plan_discount"] * .01);
			//echo $discount;
							mysql_data_seek($rs_cart,0);
							if ($_SESSION['carrier'] == "sprint" || $_SESSION['carrier'] == "verizon"){
								echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
<!--								<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">-->
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td width="60" align="center"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></td>
									<td width="100" height="30" align="center">Device ESN</td>
									<td width="386" align="center">Plan Name</td>
									<td width="170" align="center">Included Data</td>
									<td width="170" align="center">Cost per Month</td>
								</tr>
								';
								$total = 0;
								for ($counter=1; $counter <= mysql_num_rows($rs_cart); $counter++){
									$row = mysql_fetch_assoc($rs_cart);
									echo'
								<tr bgcolor="'.$box_bgcolor.'" class="bodyBlack">
									<td align="center" bgcolor="'.$rowlabel_bgcolor.'"><input type="button" name="remove" id="remove" value="Remove" onClick="removeIt(\''.$row["esn"].'\',\'\','.iif(mysql_num_rows($rs_cart)==1, "1", "0").');" style="width:50;" class="smallBlack"></td>
									<td height="30" align="center">'.$row["esn"].'</td>
									<td align="left" style="padding-left: 5px">'.$row["plan_name"].'</td>
									<td align="center">'.$row["plan_quantity"].'</td>
									<td align="right">$'.money_format('%i', ($row["plan_cost"]-($row["plan_cost"]*$discount))).'<img src="images/spacer.gif" alt="" width="60" height="1" border="0"></td>
								</tr>
									';
									$total += $row["plan_cost"];
								};
								echo'
								<tr>
									<td height="30" align="right" colspan="4" bgcolor="'.$border_bgcolor.'" class="bodyWhite">Estimated* Monthly Total&nbsp;</td>
									<td align="right" bgcolor="'.$box_bgcolor.'" class="bodyBlack">$'.money_format('%i', ($total-($total*$discount))).'<img src="images/spacer.gif" alt="" width="60" height="1" border="0"></td>
								</tr>
								';
							}else{
								echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
<!--								<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">-->
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td width="55" align="center"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></td>
									<td width="180" height="30" align="center">Device ICCID</td>
									<td width="135" align="center">Device IMEI</td>
									<td width="336" align="center">Plan Name</td>
									<td width="90" align="center">Included<br>Data</td>
									<td width="90" align="center">Cost<br>per Month</td>
								</tr>
								';
								$total = 0;
								for ($counter=1; $counter <= mysql_num_rows($rs_cart); $counter++){
									$row = mysql_fetch_assoc($rs_cart);
									echo'
								<tr bgcolor="'.$box_bgcolor.'" class="bodyBlack">
									<td align="center" bgcolor="'.$rowlabel_bgcolor.'"><input type="button" name="remove" id="remove" value="Remove" onClick="removeIt(\'\',\''.$row["iccid"].'\','.iif(mysql_num_rows($rs_cart)==1, "1", "0").');" style="width:50;" class="smallBlack"></td>
									<td height="30" align="center">'.$row["iccid"].'</td>
									<td align="center">'.$row["imei"].'</td>
									<td align="left" style="padding-left: 5px">'.$row["plan_name"].'</td>
									<td align="center">'.$row["plan_quantity"].'</td>
									<td align="right">$'.money_format('%i', ($row["plan_cost"]-($row["plan_cost"]*$discount))).'<img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
								</tr>
									';
									$total += $row["plan_cost"];
								};
								echo'
								<tr>
									<td height="30" align="right" colspan="5" bgcolor="'.$border_bgcolor.'" class="bodyWhite">Estimated* Monthly Total&nbsp;&nbsp;</td>
									<td align="right" bgcolor="'.$box_bgcolor.'" class="bodyBlack">$'.money_format('%i', ($total-($total*$discount))).'<img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
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
<!--					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr>
						<td colspan="2" align="center">
							<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
							<form action="" method="GET" name="AddDevices" id="AddDevices">
								<input type="hidden" name="sec" id="sec" value="activate">
								<input type="hidden" name="step" id="step" value="select">
								<input type="hidden" name="task" id="task" value="addmore">
								<input type="hidden" name="AddQTY" id="AddQTY" value="1">
								<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
								<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
								<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
								<input type="hidden" name="sid" value="<? echo $SID; ?>">
			<!--					<input type="submit" name="add_devices" id="add_devices" value="Add More Devices">--
<!--								<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
										<td width="300" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="document.AddDevices.submit();" class="buttonWhite">
										<strong>&raquo; Add More Devices &laquo;</strong>
										</a>
									</td>
									<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
								</tr>
								</table>--
							<input type="button" value="&raquo; Add More Devices &laquo;" style="width:320px;" class="bodyBlack" onClick="document.AddDevices.submit();">
							</form>
						</td>
					</tr>
					</table>-->
				</td>
			</tr>
<!--			<tr>
				<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
			</tr>-->
<!--			<tr>
				<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
			</tr>
</table>-->




			</table>

<form action="" method="POST" name="RemoveForm" id="RemoveForm">
	<input type="hidden" name="sec" id="sec" value="">
	<input type="hidden" name="step" id="step" value="">
	<input type="hidden" name="task" id="task" value="">
	<input type="hidden" name="Carrier" id="Carrier" value="">
	<input type="hidden" name="esn" id="esn" value="">
	<input type="hidden" name="iccid" id="iccid" value="">
	<input type="hidden" name="sid" id="sid" value="">
</form>

			
		</td>
	</tr>
	</table>
			
			
			
<?
}elseif ($step == "confirm"){
?>

	<!-- SSL Site Seal -->
	<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>
	
	<?
	// If there is request data, save it!
	//if ($_REQUEST['service_city'] != ""){
		// Write account information to database
		$query =
			"UPDATE orders SET
			first_name = '".$_REQUEST['first_name']."',
			middle_name = '".$_REQUEST['middle_name']."',
			last_name = '".$_REQUEST['last_name']."',
			company_name = '".$_REQUEST['company_name']."',
			tax_id = '".$_REQUEST['tax_id']."',
			wireless_phone = '".$_REQUEST['wireless_phone']."',
			acct_number = '".$_REQUEST['acct_number']."',
			ship_address_1 = '".$_REQUEST['ship_address_1']."',
			ship_address_2 = '".$_REQUEST['ship_address_2']."',
			ship_city = '".$_REQUEST['ship_city']."',
			ship_state = '".$_REQUEST['ship_state']."',
			ship_zipcode = '".$_REQUEST['ship_zipcode']."',
			bill_address_1 = '".$_REQUEST['bill_address_1']."',
			bill_address_2 = '".$_REQUEST['bill_address_2']."',
			bill_city = '".$_REQUEST['bill_city']."',
			bill_state = '".$_REQUEST['bill_state']."',
			bill_zipcode = '".$_REQUEST['bill_zipcode']."',
			service_address_1 = '".$_REQUEST['service_address_1']."',
			service_address_2 = '".$_REQUEST['service_address_2']."',
			service_city = '".$_REQUEST['service_city']."',
			service_state = '".$_REQUEST['service_state']."',
			service_zipcode = '".$_REQUEST['service_zipcode']."',
			password = '".$_REQUEST['password']."',
			billing_name = '".$_REQUEST['billing_name']."',
			billing_phone = '".$_REQUEST['billing_phone']."',
			billing_email = '".$_REQUEST['billing_email']."',
			contact_name = '".$_REQUEST['contact_name']."',
			contact_phone = '".$_REQUEST['contact_phone']."',
			contact_email = '".$_REQUEST['contact_email']."',
			home_phone = '".$_REQUEST['home_phone']."',
			alt_phone = '".$_REQUEST['alt_phone']."',
			email = '".$_REQUEST['email']."',
			ssn = '".$_REQUEST['ssn']."',
			dob = '".$_REQUEST['dob']."',
			dl_number = '".$_REQUEST['dl_number']."',
			dl_state = '".$_REQUEST['dl_state']."',
			dl_expiration = '".$_REQUEST['dl_exp_month']."/".$_REQUEST['dl_exp_day']."/".$_REQUEST['dl_exp_year']."',
			info_time = NOW()
			WHERE session_id = '".$SID."'";
	//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	//}
	// Refresh account info
	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
	$rs_order = mysql_query($query, $linkID);
	$order = mysql_fetch_assoc($rs_order);
	?>
	<?
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
	$rowcount = 0;
	$roweven = "#F6F6F6";
	$rowodd = "#FFFFFF";
	?>

	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" bgcolor="<? echo $content_bgcolor; ?>">
	
		<!-- Step Label -->
		
			<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td>
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="800" valign="top">
							<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td valign="top" class="superbigBlack">Activate with PWS</td>
							</tr>
							<tr>
								<td valign="top" class="bigBlack">Please verify that the following information is correct:</td>
							</tr>
							<tr>
								<td class="bodyBlack">
									<br>
									<ul>
										<li>If you wish to make any changes, click the applicable button located in each section.  If the information is correct, please acknowledge your acceptance of the Terms & Conditions by checking the appropriate box and click the "Submit Order" button at the bottom.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
						<td valign="top" width="100" rowspan="2" align="right"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center">
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
					<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
						<td height="25" align="center"><? echo iif($order['acct_type'] == "IL" && $order['add_line'] == "No", 'Billing &amp; Shipping', 'Account'); ?> Information</td>
					</tr>
					<tr>
						<td align="center">
							<table width="900" border="0" cellspacing="0" cellpadding="5" align="center" class="xbigBlack">
							<?
							if ($order['acct_type'] == "IL"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Name:</td>
								<td><strong><? echo $order['first_name']; ?> <? echo $order['middle_name']; ?> <? echo $order['last_name']; ?></strong></td>
							</tr>
							<?
							}else{
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Company Name:</td>
								<td><strong><? echo $order['company_name']; ?></strong></td>
							</tr>
							<?
								if ($order['add_line'] == "No"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Tax ID (FEIN):</td>
								<td><strong><? echo $order['tax_id']; ?></strong></td>
							</tr>
							<?
			//echo $rowcount;
			//					}else{
							?>
			<!--				<tr bgcolor="<?// echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
							</tr>-->
							<?
								}
							?>
							<?
							}
							?>
							<?
							if ($order['add_line'] == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br><? echo $carrier; ?> Phone Number:</td>
								<td><strong><? echo $order['wireless_phone']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Account Number:</td>
								<td><strong><? echo $order['acct_number']; ?></strong>
							</tr>
							<?
							}
							?>
							<?
							if ($order['add_line'] == "No"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Shipping Address:<br><span class="smallBlack"><strong>Cannot be a P.O. Box.</strong></span></td>
								<td>
									<strong><? echo $order['ship_address_1']; echo iif($order["ship_address_2"] != "", ", ", ""); echo $order['ship_address_2']; ?><br>
									<? echo $order['ship_city']; ?>,&nbsp;<? echo $order['ship_state']; ?>&nbsp;&nbsp;<? echo $order['ship_zipcode']; ?></strong>
								</td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Address:</td>
								<td>
									<strong><? echo $order['bill_address_1']; echo iif($order["bill_address_2"] != "", ", ", ""); echo $order['bill_address_2']; ?><br>
									<? echo $order['bill_city']; ?>,&nbsp;<? echo $order['bill_state']; ?>&nbsp;&nbsp;<? echo $order['bill_zipcode']; ?></strong>
								</td>
							</tr>
							<?
							}
			// Column width defined here - first row in ALL forms
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td width="300" align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Service Address:<br><span class="smallBlack"><strong>Primary Place of Use Address<br>Cannot be a P.O. Box.</strong></span></td>
								<td>
									<strong><? echo $order['service_address_1']; echo iif($order["service_address_2"] != "", ", ", ""); echo $order['service_address_2']; ?><br>
									<? echo $order['service_city']; ?>,&nbsp;<? echo $order['service_state']; ?>&nbsp;&nbsp;<? echo $order['service_zipcode']; ?></strong>
								</td>
							</tr>
<!--							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Requested Area Code:</td>
								<td><strong><? echo $order['request_areacode']; ?></strong>
							</tr>-->
							<?
							if ($order['add_line'] == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Requested Password:</td>
								<td><strong><? echo $order['password']; ?></strong>
							</tr>
							<?
							}
							?>
							<?
							if ($order['acct_type'] == "CL"){
								if ($order['add_line'] == "No"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Contact:</td>
								<td><strong><? echo $order['billing_name']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Contact Phone:</td>
								<td><strong><? echo $order['billing_phone']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Contact Email:</td>
								<td><strong><? echo $order['billing_email']; ?></strong>
							</tr>
							<?
								}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Order Contact:</td>
								<td><strong><? echo $order['contact_name']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Order Contact Phone:</td>
								<td><strong><? echo $order['contact_phone']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Order Contact Email:</td>
								<td><strong><? echo $order['contact_email']; ?></strong>
							</tr>
							<?
							}
							?>
							<?
							if ($order['acct_type'] == "IL"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Home Phone:</td>
								<td><strong><? echo $order['home_phone']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Alternate Phone:</td>
								<td><strong><? echo $order['alt_phone']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Email Address:</td>
								<td><strong><? echo $order['email']; ?></strong>
							</tr>
							<?
								}
							?>
							<?
							if ($order['acct_type'] == "IL" && $order['add_line'] == "No"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Social Security Number:</td>
								<td><strong><? echo $order['ssn']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Date of Birth:</td>
								<td><strong><? echo $order['dob']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Driver's License:</td>
								<td><strong><? echo $order['dl_state']; ?> - <? echo $order['dl_number']; ?></strong>&nbsp;&nbsp;<span class="xbigBlack">Expires:</span>&nbsp;<strong><? echo $order['dl_expiration']; ?></strong></td>
							</tr>
							<?
								}
							?>
							</table>
						</td>
					</tr>



<!--			<tr>
				<td colspan="2" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="900" height="2" border="0"></td>
			</tr>-->
					</table>





					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr>
						<td colspan="2" align="center">
							<br>
							<form action="" method="post" name="EditAcct" id="EditAcct">
								<input type="hidden" name="sec" id="sec" value="activate">
								<input type="hidden" name="step" id="step" value="account">
								<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
								<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
								<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
								<input type="hidden" name="sid" value="<? echo $SID; ?>">
			<!--					<input type="submit" name="edit_acct" id="edit_acct" value="Edit Account Information">-->
		<!--						<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
										<td width="300" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="document.EditAcct.submit();" class="buttonWhite">
										<strong>&raquo; Edit Account Information &laquo;</strong>
										</a>
									</td>
									<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
								</tr>
								</table>-->
							<input type="button" value="&raquo; Edit Account Information &laquo;" style="width:320px;" class="bodyBlack" onClick="document.EditAcct.submit();">
							</form>
						<td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
	
	<!-- Cart Contents -->
	
<!--	<tr>
		<td colspan="2" align="center" bgcolor="#F5E7E7" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>; border-top:thin solid <? echo $border_color; ?>;">
			<br>-->
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
			</tr>
			<tr>
<!--				<td align="center" bgcolor="#F0F0F0">-->
				<td align="center">
<!--				<td colspan="2" align="center" bgcolor="#F5E7E7" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>; border-top:thin solid <? echo $border_color; ?>;">-->
					<br>
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="superbigBlack">Cart Contents:</td>
					</tr>
					<tr>
						<td width="900" height="15">
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
							<br>
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
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
<!--								<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">-->
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td width="60" align="center"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></td>
									<td width="100" height="30" align="center">Device ESN</td>
									<td width="386" align="center">Plan Name</td>
									<td width="170" align="center">Included Data</td>
									<td width="170" align="center">Cost per Month</td>
								</tr>
								';
								$total = 0;
								for ($counter=1; $counter <= mysql_num_rows($rs_cart); $counter++){
									$row = mysql_fetch_assoc($rs_cart);
									echo'
								<tr bgcolor="'.$box_bgcolor.'" class="bodyBlack">
									<td align="center" bgcolor="'.$rowlabel_bgcolor.'"><input type="button" name="remove" id="remove" value="Remove" onClick="removeIt(\''.$row["esn"].'\',\'\','.iif(mysql_num_rows($rs_cart)==1, "1", "0").');" style="width:50;" class="smallBlack"></td>
									<td height="30" align="center">'.$row["esn"].'</td>
									<td align="left" style="padding-left: 5px">'.$row["plan_name"].'</td>
									<td align="center">'.$row["plan_quantity"].'</td>
									<td align="right">$'.money_format('%i', ($row["plan_cost"]-($row["plan_cost"]*$discount))).'<img src="images/spacer.gif" alt="" width="60" height="1" border="0"></td>
								</tr>
									';
									$total += $row["plan_cost"];
								};
								echo'
								<tr>
									<td height="30" align="right" colspan="4" bgcolor="'.$border_bgcolor.'" class="bodyWhite">Estimated* Monthly Total&nbsp;</td>
									<td align="right" bgcolor="'.$box_bgcolor.'" class="bodyBlack">$'.money_format('%i', ($total-($total*$discount))).'<img src="images/spacer.gif" alt="" width="60" height="1" border="0"></td>
								</tr>
								';
							}else{
								echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
<!--								<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">-->
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td width="55" align="center"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></td>
									<td width="180" height="30" align="center">Device ICCID</td>
									<td width="135" align="center">Device IMEI</td>
									<td width="336" align="center">Plan Name</td>
									<td width="90" align="center">Included<br>Data</td>
									<td width="90" align="center">Cost<br>per Month</td>
								</tr>
								';
								$total = 0;
								for ($counter=1; $counter <= mysql_num_rows($rs_cart); $counter++){
									$row = mysql_fetch_assoc($rs_cart);
									echo'
								<tr bgcolor="'.$box_bgcolor.'" class="bodyBlack">
									<td align="center" bgcolor="'.$rowlabel_bgcolor.'"><input type="button" name="remove" id="remove" value="Remove" onClick="removeIt(\'\',\''.$row["iccid"].'\','.iif(mysql_num_rows($rs_cart)==1, "1", "0").');" style="width:50;" class="smallBlack"></td>
									<td height="30" align="center">'.$row["iccid"].'</td>
									<td align="center">'.$row["imei"].'</td>
									<td align="left" style="padding-left: 5px">'.$row["plan_name"].'</td>
									<td align="center">'.$row["plan_quantity"].'</td>
									<td align="right">$'.money_format('%i', ($row["plan_cost"]-($row["plan_cost"]*$discount))).'<img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
								</tr>
									';
									$total += $row["plan_cost"];
								};
								echo'
								<tr>
									<td height="30" align="right" colspan="5" bgcolor="'.$border_bgcolor.'" class="bodyWhite">Estimated* Monthly Total&nbsp;&nbsp;</td>
									<td align="right" bgcolor="'.$box_bgcolor.'" class="bodyBlack">$'.money_format('%i', ($total-($total*$discount))).'<img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
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
<!--					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr>
						<td colspan="2" align="center">
							<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
							<form action="" method="GET" name="AddDevices" id="AddDevices">
								<input type="hidden" name="sec" id="sec" value="activate">
								<input type="hidden" name="step" id="step" value="select">
								<input type="hidden" name="task" id="task" value="addmore">
								<input type="hidden" name="AddQTY" id="AddQTY" value="1">
								<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
								<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
								<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
								<input type="hidden" name="sid" value="<? echo $SID; ?>">
			<!--					<input type="submit" name="add_devices" id="add_devices" value="Add More Devices">--
<!--								<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
										<td width="300" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="document.AddDevices.submit();" class="buttonWhite">
										<strong>&raquo; Add More Devices &laquo;</strong>
										</a>
									</td>
									<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
								</tr>
								</table>--
							<input type="button" value="&raquo; Add More Devices &laquo;" style="width:320px;" class="bodyBlack" onClick="document.AddDevices.submit();">
							</form>
						</td>
					</tr>
					</table>-->
				</td>
			</tr>
<!--			<tr>
				<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
			</tr>-->
<!--			<tr>
				<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
			</tr>
</table>-->










<!--

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
							document.RemoveForm.step.value = 'confirm';
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
			</tr>-->
			</table>
			<br>
<!--			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
			<tr>
				<td align="center">
					<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					<form action="" method="post" name="AddDevices" id="AddDevices">
						<input type="hidden" name="sec" id="sec" value="activate">
						<input type="hidden" name="step" id="step" value="select">
						<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
						<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
						<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
						<input type="hidden" name="sid" value="<? echo $SID; ?>">
	<!--					<input type="submit" name="add_devices" id="add_devices" value="Add More Devices">--
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
			</table>-->
		</td>
	</tr>
	
	<!-- Terms & Conditions -->
	
	<tr>
		<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
	</tr>
	<tr>


<!--				<td align="center" bgcolor="#F0F0F0">-->
		<td align="center">
<!--				<td colspan="2" align="center" bgcolor="#F5E7E7" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>; border-top:thin solid <? echo $border_color; ?>;">-->
			<br>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td colspan="3" class="superbigBlack">Terms & Conditions</td>
			</tr>
			<tr>
				<td colspan="3" valign="top" class="bigBlack">Please read & agree to the following in order to complete your order:<br><br><br></td>
			</tr>
<!--		<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>; border-top:thin solid <? echo $border_color; ?>;">
			<br>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">-->
			<tr bgcolor="<? echo $border_bgcolor; ?>">
				<td width="900" height="30" colspan="3" align="center" class="bodyWhite" style="padding:5px;">&nbsp;<strong>Terms &amp; Conditions</strong></td>
			</tr>
			<tr>
				<td rowspan="99" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
				<td width="100%">
					<script>
					function CheckIsIE(){
						if (navigator.appName.toUpperCase() == 'MICROSOFT INTERNET EXPLORER'){
							return true;
						}else{
							return false;
						}
					}
					
					function PrintIFrame(){
						if (CheckIsIE() == true){
							document.terms.focus();
							document.terms.print();
						}else{
							window.frames['terms'].focus();
							window.frames['terms'].print();
						}
					}
					</script> 
					<iframe src="include/<? echo $carrier; ?>Terms.php" name="terms" id="terms" width="900" height="200" marginwidth="5" marginheight="5" align="top" scrolling="yes" frameborder="0"></iframe>
				</td>
				<td rowspan="99" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			</tr>
			<tr>
				<td colspan="2" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="900" height="2" border="0"></td>
			</tr>
			</table>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
			<script>
			// Verify that terms were accepted
			function validateConfirm(){
				if (!ConfirmOrder.accept_terms.checked){
					ConfirmOrder.accept_terms.style.background="#FF0000";
					alert("You must agree with the Terms & Conditions to complete your order.");
					ConfirmOrder.accept_terms.style.background="#FFFFFF";
					ConfirmOrder.accept_terms.focus();
					return false;
				}
				ConfirmOrder.submit();
			}
			</script>
			<!-- Switching back to HTTP so must use GET method, unfortunately -->
			<form action="" method="GET" name="ConfirmOrder" id="ConfirmOrder">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="5" cellpadding="0">
					<tr>
						<td width="35" align="right"><a href="javascript:PrintIFrame();" class="bigBlack"><img src="images/PrinterIcon.jpg" alt="" width="25" height="25" border="0"></a></td>
						<td width="100"><a href="javascript:PrintIFrame();" class="smallBlack"><strong>Print Terms</strong></a></td>
						<td align="center" class="bigBlack"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"><input type="checkbox" name="accept_terms" id="accept_terms" value="Yes"> <strong>I Agree to These Terms & Conditions.</strong></td>
						<td width="135"><img src="images/spacer.gif" alt="" width="135" height="2" border="0"></td>
					</tr>
					</table>			
				</td>
			</tr>
			<tr>
				<td colspan="4" align="center">
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					<input type="hidden" name="sec" id="sec" value="activate">
					<input type="hidden" name="step" id="step" value="thankyou">
					<input type="hidden" name="task" id="task" value="sendorder">
					<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
	<!--				<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
					<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">-->
					<input type="hidden" name="sid" value="<? echo $SID; ?>">
	<!--				<input type="submit" name="confirm" id="confirm" value="Submit Complete Order">-->
<!--					<table border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td><img src="images/ButtonBG-Left.gif" alt="" width="10" height="25" border="0"></td>
							<td width="300" align="center" bgcolor="#E6E6E6" background="images/ButtonBG-Center.gif">
							<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="document.ConfirmOrder.submit();" class="buttonWhite">
							<strong>&raquo; Submit Complete Order &laquo;</strong>
							</a>
						</td>
						<td><img src="images/ButtonBG-Right.gif" alt="" width="10" height="25" border="0"></td>
					</tr>
					</table>
					<br>-->
					<input type="button" value="&raquo; Submit Complete Order &laquo;" style="width:320px;" class="bodyBlack" onClick="validateConfirm();">
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
}elseif ($step == "thankyou"){
?>


	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" bgcolor="<? echo $content_bgcolor; ?>">
	
		<!-- Step Label -->
		
			<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td>
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
<!--						<td width="800" valign="top">
							<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>-->
								<td valign="top" class="superbigBlack">Thank You for Activating with PWS</td>
							</tr>
							<tr>
								<td valign="top" class="bigBlack">Your order has been submitted for processing.</td>
							</tr>
<!--							<tr>
								<td class="bodyBlack">
									<br>
									<ul>
										<li>If you wish to make any changes, click the applicable button located in each section.  If the information is correct, please acknowledge your acceptance of the Terms & Conditions by checking the appropriate box and click the "Submit Order" button at the bottom.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
						<td valign="top" width="100" rowspan="2" align="right"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>-->
					</tr>
					<tr>
						<td class="bodyBlack">
<!--							<div align="center">
							<br>
							<strong class="xbigBlack">Thank You!</strong><br>
							<strong class="bigBlack">Your order has been submitted for processing.</strong><br>
							<br>
							</div>
			<!--				<strong>Shortly, an email confirmation of your order will be sent to the<? echo iif($order['acct_type']=="CL", " order contact", ""); ?> email address you provided.  Please save or print it for your records.<br>-->
							<br><br>
<!--							<strong>If you wish to print an order confirmation, <a href="https://secure.nr.net/deviceport/receipt.php?sid=<? echo $SID; ?>" target="_blank" class="bodyBlack">Click Here</a>.<br>
							<br>-->
							If you have any questions about your order, please call <? echo $support_phone; ?> or email us at <a href="mailto:<? echo $support_email; ?>" class="bodyBlack"><? echo $support_email; ?></a>.<br><br>
						</td>
					</tr>
					</table>
				</td>
			</tr>


<!--
<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Activate Service</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="410" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td width="20"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
			<td class="bodyBlack">
				<div align="center">
				<br>
				<strong class="xbigBlack">Thank You!</strong><br>
				<strong class="bigBlack">Your order has been submitted for processing.</strong><br>
				<br>
				</div>
<!--				<strong>Shortly, an email confirmation of your order will be sent to the<? echo iif($order['acct_type']=="CL", " order contact", ""); ?> email address you provided.  Please save or print it for your records.<br>--
				<br>
				<strong>If you wish to print an order confirmation, <a href="https://secure.nr.net/deviceport/receipt.php?sid=<? echo $SID; ?>" target="_blank" class="bodyBlack">Click Here</a>.<br>
				<br>
				If you have any questions about your order, please call 877.351.1658 or email us at <a href="mailto:<? echo $support_email; ?>" class="bodyBlack"><? echo $support_email; ?></a>.</strong>
			</td>
			<td width="20"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
		</tr>
		</table>
		<br>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>-->
			</table>
		</td>
	</tr>
	</table>

	<?
/*	// start new session
	session_save_path("/var/www/html/deviceport.com/tmp");
	// Set the session timout to 20 minutes
//	ini_set("session.gc_maxlifetime", "1200"); 
	session_start();
//	$site = $_SESSION['site'];
	$_SESSION = array(); 
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	session_regenerate_id(true);
	$_SESSION['SID'] = session_id();
	// Assign new session ID
	$SID = $_SESSION['SID'];
*/	?>

<?
}  // end of step loop
?>

<!--
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
-->

<!-- END Include activate.php -->
