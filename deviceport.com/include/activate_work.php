<!-- BEGIN Include activate.php -->

<?
//////////////////////////////////////////////////////////////////////////////
if (!$step || $step == "select"){
?>
	<script>
	//Populate (fill-down) Data Plan choice
	function popPlans(n,q,v) { // n=record#, q=max records, v=form version (a or b)
		// Populate the remaining plans fields with the value of the first device's plan selected the first time
		if (n == 1 && document.getElementById("PlanID"+q+v).value == ""){ //if the first record was just changed AND the last record is blank (assume not populated yet)
			for (plan=2; plan<=q; plan++){  // populate the rest of the plans with the value of the first one.
				document.getElementById("PlanID"+plan+v).value = document.getElementById("PlanID1"+v).value;
			}
		}
	}
	//Populate (fill-down) Voice Plan choice
	function popVoicePlans(n,q,v) { // n=record#, q=max records, v=form version (a or b)
		// Populate the remaining plans fields with the value of the first device's plan selected the first time
		if (n == 1 && document.getElementById("VoicePlanID"+q+v).value == ""){ //if the first record was just changed AND the last record is blank (assume not populated yet)
			for (plan=2; plan<=q; plan++){  // populate the rest of the plans with the value of the first one.
				document.getElementById("VoicePlanID"+plan+v).value = document.getElementById("VoicePlanID1"+v).value;
			}
		}
	}
	//Populate (fill-down) Area Code entered
	function popACs(n,q,v) { // n=record#, q=max records, v=form version (a or b)
		// Populate the remaining Area Code fields with the value of the first device's Area Code, the first time
		if (n == 1 && document.getElementById("RequestAreaCode"+q+v).value == ""){ //if the first record was just changed AND the last record is blank (assume not populated yet)
			for (ac=2; ac<=q; ac++){  // populate the rest of the area codes with the value of the first one.
				document.getElementById("RequestAreaCode"+ac+v).value = document.getElementById("RequestAreaCode1"+v).value;
			}
		}
	}
	</script>
	
	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<tr>
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
				<td class="superbigBlack">Activate with <? echo $familiar_name; ?></td>
			</tr>
			</table>
			
		<!-- Password -->
		
	<?
	if ($password_protect == "T" && (!$_SESSION['passed'] || $_SESSION['passed'] == "false")){
	?>
			<div id="EnterPassword" style="position:static; visibility:visible; display:block;">
				<table width="900" border="0" cellspacing="0" cellpadding="0" id="EnterPasswordTable">
				<tr>
					<td class="bigBlack">Please Enter Password for Access:</td>
				</tr>
				<tr>
					<td align="center">
						<br>
						<form name="PassForm" id="PassForm" method="POST" action="/saveit.php">
						<table>
						<tr>
							<td class="bigBlack">Username:</td>
							<td><input type="text" name="username" size="20" maxlength="25"></td>
							<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
							<td class="bigBlack">Password:</td>
							<td><input type="password" name="password" size="20" maxlength="25"></td>
						</tr>
						<tr>
							<td colspan="5" align="center"><br><input type="submit" value="Enter" style="width:150px;"></td>
						</tr>
		<?
		if ($_SESSION['passed'] == "false"){ //Login Failed
			echo'		<tr>
							<td colspan="5" align="center" class="bodyBlack"><font color="#FF0000">Incorrect Credentials - Please Try Again</font></td>
						</tr>
			';
		}
		?>
						</table>
						<input type="hidden" name="sec" id="sec" value="<? echo $sec; ?>">
						<input type="hidden" name="task" id="task" value="login">
						<input type="hidden" name="site" id="site" value="<? echo $site; ?>">
						</form>
						<br>
					</td>
				</tr>
				</table>
				<script>document.PassForm.username.focus();</script>
			</div>
			<!-- Hide Carrier layer -->
			<div id="SelectCarrier" style="position:static; visibility:hidden; display:none;">
	<?
	}else{ //Password is valid or site is not password protected
	?>
			<!-- Show Carrier layer -->
			<div id="SelectCarrier" style="position:static; visibility:visible; display:block;">
	<?
	}
	?>

		<!-- Select Carrier -->
		
				<table width="900" border="0" cellspacing="0" cellpadding="0" id="SelectCarrierTable">
				<tr>
					<td class="bigBlack">Please Select a Carrier:</td>
				</tr>
				<tr>
					<td align="center">
						<table width="600" border="0" cellspacing="0" cellpadding="10">
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
		echo'				<td align="center" valign="bottom">
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
		echo'				<td align="center" valign="bottom">
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
		echo'				<td align="center" valign="bottom">
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
				<form name="PlanForm" id="PlanForm" method="POST" enctype="multipart/form-data" action="">
			</div>
			
	<?
	if ($locked){
		// Dim it
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
			
		<!-- Welcome Message-->
	
	<?
	if (!$sec && !$locked && $introduction != ""){  // Only show this if it's the default home page and it's not empty.
	?>
			<div id="WelcomeMessage" style="position:static; visibility:visible; display:block;">
				<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
				<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="superbigBlack">Welcome to <? echo $familiar_name; ?></td>
				</tr>
				<tr>
					<td class="bodyBlack"><br><? echo $introduction; ?></td>
				</tr>
				</table>
				<br>
			</div>
	<?
	}else{
	?>
			<div id="WelcomeMessage" style="position:static; visibility:visible; display:block;"><br></div>
	<?
	}
	?>
	
		<!-- Account Type & Device Numbers-->
	
			<div id="AcctTypeSection" style="position:static; <? echo iif(!$locked, "visibility:hidden; display:none;", "visibility:visible;"); ?>">
				<table width="900" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
				<table width="900" border="0" cellspacing="0" cellpadding="0" id="AcctTypeTable">
				<tr>
					<td width="200" height="125" rowspan="4" valign="top" class="bigBlack">
						You Selected:<br><br>
						<!-- Image to dynamically replace via Javascript -->
						<div align="center"><img src="images/spacer.gif" alt="" name="ChosenLogo" id="ChosenLogo" border="0"></div><br><br>
					</td>
					<td rowspan="4"><img src="images/spacer.gif" alt="" width="30" height="110" border="0"></td>
					<td width="670" height="30" valign="top" class="bigBlack">
					<?
					if ($change_plan == "T"){
					?>
						<script>
						function submitChangePlan() {
							document.PlanForm.sid.value = "<? echo $SID; ?>";
							document.PlanForm.task.value = "changeplan";
							document.PlanForm.DeviceCount.value = 1;
							document.PlanForm.action = 'saveit.php';
							document.PlanForm.submit();
						}
						</script>
						Will you be changing an existing service plan?&nbsp;
						<?
						if ($locked){  // ChangeLine already selected so disable ability to select one
							echo'
						<input type="radio" name="ChangePlan" value="Yes" '.iif($order["change_plan"] == "Yes", checked, "").' disabled> Yes
						<input type="radio" name="ChangePlan" value="No" '.iif($order["change_plan"] == "No", checked, "").' disabled> No
						<input type="hidden" name="ChangePlan" id="AddLine" value="'.$order['change_plan'].'">
							';
						}else{
							echo'
						<input type="radio" name="ChangePlan" value="Yes" '.iif($order["change_plan"] == "Yes", checked, "").' onClick="submitChangePlan();"> Yes
						<input type="radio" name="ChangePlan" value="No" '.iif($order["change_plan"] == "No", checked, "").' onClick="show(\'AddLine\');"> No
							';
						}
						?>
					</td>
				</tr>
				<tr>
					<td height="30" valign="top" class="bigBlack">
					<div id="AddLine" style="position:static; <? echo iif((!$locked || $order['change_plan'] == "Yes"), "visibility:hidden; display:none;", "visibility:visible;"); ?>">
					<?
					}else{
					?>
					<div id="AddLine" style="position:static; visibility:visible;">
					<?
					}
					?>
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
					</div>
					</td>
				</tr>
				<tr>
					<td height="30" valign="top" class="bigBlack">
						<div id="AcctType" style="position:static; <? echo iif((!$locked || $order['change_plan'] == "Yes"), "visibility:hidden; display:none;", "visibility:visible;"); ?>">
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
					<td height="30" valign="top" class="bigBlack">
						<div id="Quantity" style="position:static; <? echo iif((!$locked || $order['change_plan'] == "Yes"), "visibility:hidden; display:none;", "visibility:visible;"); ?>">
						<script>
						function checkQuantity() {
							if (PlanForm.DeviceCount.value == "" || PlanForm.DeviceCount.value == 0){
								PlanForm.DeviceCount.style.background="#FF0000";
								alert("Please Enter a Quantity");
								PlanForm.DeviceCount.style.background="<? echo $form_bg; ?>";
								PlanForm.DeviceCount.focus();
								return false;
							}
							document.PlanForm.sid.value = "<? echo $SID; ?>";
							if (PlanForm.ChangePlan){
								document.PlanForm.ChangePlan.value = "No";
							}
							if (document.PlanForm.DeviceCount.value == ""){
								document.PlanForm.DeviceCount.value = 1;
							}
							document.PlanForm.task.value = "openorder";
							document.PlanForm.action = 'saveit.php';
							document.PlanForm.submit();
						}

						function popUpload() {
							show("Upload");
							PlanForm.SheetName.focus();
						}
						</script>
						How many devices will you be activating with this order?&nbsp;
						<?
						if ($locked){  // Device quantity already defined so disable ability to enter it
							echo'
						<input type="text" name="DeviceCount" id="DeviceCount" size="1" maxlength="3" style="background-color:'.$form_bgcolor.'" value="'.$order['device_count'].'" disabled>
						<input type="hidden" name="DeviceCount" id="DeviceCount" value="'.$order['device_count'].'">
						&nbsp;<input type="button" value="Go" onClick="checkQuantity();" disabled>
						&nbsp;or&nbsp;<input type="button" value="Upload Spreadsheet" onClick="uploadSheet();" disabled>
							';
						}else{
							echo'
						<input type="text" name="DeviceCount" id="DeviceCount" size="1" maxlength="3" style="background-color:'.$form_bgcolor.';" onKeyPress="return onlyNumbers(event,this);" onChange="checkQuantity();" value="">
						&nbsp;<input type="button" value="Go" onClick="checkQuantity();">
						&nbsp;or&nbsp;&nbsp;<input type="button" value="Upload Spreadsheet"  style="width:130px;" onClick="popUpload();">
							';
						}
						?>
						</div>
					</td>
				</tr>
				<tr>
					<td height="30" valign="top" class="bigBlack">
						<div id="Upload" style="position:static; <? echo iif((!$locked || $order['change_plan'] == "Yes"), "visibility:hidden; display:none;", "visibility:visible;"); ?>">
						<script>
//						function checkQuantity() {
//							if (PlanForm.DeviceCount.value == "" || PlanForm.DeviceCount.value == 0){
//								PlanForm.DeviceCount.style.background="#FF0000";
//								alert("Please Enter a Quantity");
//								PlanForm.DeviceCount.style.background="<? echo $form_bg; ?>";
//								PlanForm.DeviceCount.focus();
//								return false;
//							}
//							document.PlanForm.sid.value = "<? echo $SID; ?>";
//							if (PlanForm.ChangePlan){
//								document.PlanForm.ChangePlan.value = "No";
//							}
//							if (document.PlanForm.DeviceCount.value == ""){
//								document.PlanForm.DeviceCount.value = 1;
//							}
//							document.PlanForm.task.value = "openorder";
//							document.PlanForm.action = 'saveit.php';
//							document.PlanForm.submit();
//						}
						</script>

						<script>
							// Progress Bar file for IFRAME
							var postLocation="pgbar.php";
					
							// add any extension that you do no want to upload to the list 
							// below they should be placed with in the /^ and / characters
							// separate each extension by a pipe symbol |	
//							var re = /^(\.php)|(\.sh)/;  // disallow shell scripts and php
//							var re = /^(\.xls)/;  // only allow Excel spreadsheet files
					
							// dofilter = false; if you don't want this filtering
							var dofilter=true;
					
							// this function will match each of the filenames with a
							// given list of banned extension. If any one of the
							// extensions match, an alert will be popped up and the
							// upload will not continue;
					 		function check_types(){
								if(document.PlanForm.SheetName.value.indexOf(".xls") == -1){
									alert('Sorry, only XLS files are supported');
									return false;
								}
								return true;
							}
					
							function postIt(){
								if(check_types() == false){
									return false;
								}
								baseUrl = postLocation;
								sid = "<?=$SID;?>";
								iTotal = escape("-1");
								baseUrl += "?iTotal=" + iTotal;
								baseUrl += "&iRead=0";
								baseUrl += "&iStatus=1";
								baseUrl += "&sessionid=" + sid;
					
								document.getElementById('barframe').src = baseUrl;
//								document.forms[0].submit();
								document.PlanForm.action = "/cgi-bin/upload.cgi?sid=<?=$SID?>";
								document.PlanForm.enctype = "multipart/form-data";
								document.PlanForm.task.value = "upload";
								document.PlanForm.submit();
							}
						</script>
						Filename to Upload:&nbsp;
						<?
						if ($locked){  // Device quantity already defined so disable ability to enter it
							echo'
						<input type="text" name="DeviceCount" id="DeviceCount" size="1" maxlength="3" style="background-color:'.$form_bgcolor.'" value="'.$order['device_count'].'" disabled>
						<input type="hidden" name="DeviceCount" id="DeviceCount" value="'.$order['device_count'].'">
						&nbsp;<input type="button" value="Go" onClick="checkQuantity();" disabled>
						&nbsp;or&nbsp;<input type="button" value="Upload Spreadsheet" onClick="uploadSheet();" disabled>
							';
						}else{
							echo'
						<input type="file" name="SheetName" id="SheetName" size="40" style="background-color:'.$form_bgcolor.';" value="">&nbsp;
						<input type="button" name="uploadit" id="uploadit" value="Submit File" onClick="postIt();">
<!--						<input type="hidden" name="required_files" value="filename"> <!-- List required files -->
						<input type="hidden" name="sessionid" value="'.$SID.'">
						<input type="hidden" name="redirect" value="/saveit.php"> <!-- Where to go after upload -->
<!--						<input type="hidden" name="task" id="task" value="upload">-->
							';
						}
						?>
<!-- Upload Progress Bar -->
<div align="center"><iframe src="blank.php" name="barframe" id="barframe" width="1" height="1" marginwidth="0" marginheight="0" align="top" scrolling="no" frameborder="0"></iframe></div>
						</div>
					</td>
				</tr>
				<?
				if ($change_plan != "T"){  // Spacer
				?>
				<tr>
					<td height="30">&nbsp;</td>
				</tr>
				<?
				}
				?>
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
	if ($order['carrier'] == "sprint" || $order['carrier'] == "verizon"){
		if ($order['change_plan'] == "Yes"){
	?>
			<div id="CDMAChangePlan" style="position:static; visibility:<? echo iif(($locked && ($order['carrier'] == "sprint" || $order['carrier'] == "verizon")), 'visible;', 'hidden; display:none;'); ?>">
				<?
				// Get stored device information for default values
				$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
				$rs_devices = mysql_query($query, $linkID);
				for ($counter=1; $counter <= $order['device_count']; $counter++){
					$device = mysql_fetch_assoc($rs_devices);
//					$ExistingNumber[$counter] = $device["existing_number"];
					$ESN[$counter] = $device["esn"];
					$PlanID[$counter] =  $device["plan_id"];
				}
				?>
				<script>
				<?
				if ($order['device_count']){
					$deviceCount = $order['device_count'];
				}else{
					$deviceCount = 0;
				}
				?>
				function validateChangePlan() {
					var blank = true;
					for (counter=1; counter <= <? echo $deviceCount; ?>; counter++){
						if (eval('document.PlanForm.ESN'+counter+'.value') != ""){
//						if (eval('document.PlanForm.ExistingNumber'+counter+'.value') != ""){
							blank = false;
//							var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
//							var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
//				 			if (phone1_regex.test(eval('document.PlanForm.ExistingNumber'+counter+'.value')) == false && phone2_regex.test(eval('document.PlanForm.ExistingNumber'+counter+'.value')) == false) { 
//								eval('PlanForm.ExistingNumber'+counter+'.style.background="#FF0000";');
//								alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
//								eval('PlanForm.ExistingNumber'+counter+'.style.background="#FFFFFF";');
//								eval('PlanForm.ExistingNumber'+counter+'.focus();');
//								return false;
//							}
//							for (counter2=1; counter2 <= counter-1; counter2++){
//								if (eval('PlanForm.ExistingNumber'+counter2+'.value == PlanForm.ExistingNumber'+counter+'.value')){
//									eval('PlanForm.ExistingNumber'+counter2+'.style.background="#FFE100";');
//									eval('PlanForm.ExistingNumber'+counter+'.style.background="#FF0000";');
//									alert('Phone Number Already Entered For Device #'+counter2);
//									eval('PlanForm.ExistingNumber'+counter2+'.style.background="#FFFFFF";');
//									eval('PlanForm.ExistingNumber'+counter+'.style.background="#FFFFFF";');
//									eval('PlanForm.ExistingNumber'+counter+'.focus();');
//									return false;
//								}
//							}
							for (counter2=1; counter2 <= counter-1; counter2++){
								if (eval('PlanForm.ESN'+counter2+'.value == PlanForm.ESN'+counter+'.value')){
									eval('PlanForm.ESN'+counter2+'.style.background="#FFE100";');
									eval('PlanForm.ESN'+counter+'.style.background="#FF0000";');
									alert('ESN Already Entered For Device #'+counter2);
									eval('PlanForm.ESN'+counter2+'.style.background="#FFFFFF";');
									eval('PlanForm.ESN'+counter+'.style.background="#FFFFFF";');
									eval('PlanForm.ESN'+counter+'.focus();');
									return false;
								}
							}
							if (eval('PlanForm.PlanID'+counter+'.value == ""')){
								eval('PlanForm.PlanID'+counter+'.style.background="#FF0000";');
								alert('Please Select A Plan For Device #'+counter);
								eval('PlanForm.PlanID'+counter+'.style.background="#FFFFFF";');
								eval('PlanForm.PlanID'+counter+'.focus();');
								return false;
							}
						}
					}
					if (blank){
						alert('Please Enter At Least One Device');
//						PlanForm.ExistingNumber1.focus();
						PlanForm.ESN1.focus();
						return false;
					}
					document.PlanForm.task.value = "addchangeplan";
					document.PlanForm.DeviceCount.value = "<? echo $deviceCount; ?>";
					document.PlanForm.action = '/saveit.php';
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
					<td class="xbigBlack">
						Please Enter Your Device Information:<br><br>
					</td>
				</tr>
				<tr>
					<td width="900">
						<?
						$query = "SELECT * FROM plans WHERE carrier = '".$order['carrier']."' AND display = 'T' ORDER BY display_order ASC";
						$rs_plans = mysql_query($query, $linkID);
						?>
						<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
						<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
							<td height="25" width="50" align="center">Device</td>
<!--							<td width="200" align="center">Phone Number</td>-->
							<td width="200" align="center">Device ESN</td>
							<td width="650" align="center">Data Plan</td>
						</tr>
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
						<tr bgcolor="<? echo $box_bgcolor; ?>" class="bodyBlack">
							<?
							// Align numeric values centered but decimal tabbed based on length of highest number
							if ($order['device_count'] < 10){  // 1 digit
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.$counter.'</strong></td>
								';
							}elseif ($order['device_count'] > 9 && $order['device_count'] < 100){  // 2 digits
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*","&nbsp; ",str_pad($counter,2,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}else{  // 3 digits (999 max)
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*"," &nbsp; ",str_pad($counter,3,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}
							?>
<!--							<td align="center"><input type="text" name="ExistingNumber<? echo $counter; ?>" id="ExistingNumber<? echo $counter; ?>" size="11" maxlength="20" style="width:180px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $ExistingNumber[$counter]; ?>"></td>-->
							<td align="center"><input type="text" name="ESN<? echo $counter; ?>" id="ESN<? echo $counter; ?>" size="11" maxlength="20" style="width:180px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $ESN[$counter]; ?>"></td>
							<td align="center">
								<select name="PlanID<? echo $counter; ?>" id="PlanID<? echo $counter; ?>" class="bodyBlack" style="width:630px; background-color: <? echo $form_bgcolor; ?>;" onChange="popPlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>');">
									<option value="">Select</option>
							<?
							// Go to the top of the result set and step through plans
							mysql_data_seek($rs_plans, 0);
							for ($plan_counter=1; $plan_counter <= mysql_num_rows($rs_plans); $plan_counter++){
								$row = mysql_fetch_assoc($rs_plans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if (!$skipit){
							?>
									<option value="<? echo $row["plan_id"]; ?>"<? if($PlanID[$counter]==$row["plan_id"]) echo " selected";?>><? echo $row["plan_name"]; ?> - <? echo $row["quantity"]." ($".$row["cost"]; ?>)</option>
							<?
								}
							};
							?>
								</select>
							</td>
						</tr>
						<?
						}
						?>
						<tr>
							<td colspan="3" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
						</tr>
						</table>
						<script>
						// show layer with add more form
						function popMore(){
							hide('FinishedButton');
							show('AddMore');
							document.getElementById("AddQty").focus();
						}
						</script>
						<table id="Buttons" width="900" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="210" align="center">
								<input type="button" value="&raquo; Add More Devices &laquo;" style="width:190px;" onClick="popMore();">
							</td>
							<td width="690" height="50">
								<!-- Put finished button in it's own layer so it can be swapped out -->
								<div id="FinishedButton" style="position:static; z-index:1; visibility:visible;">
									<div align="right">
									<input type="button" value="&raquo; Submit Change Order &raquo;" style="width:190px;" onClick="return validateChangePlan();">
									<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									</div>
								</div>
								<!-- Layer to provide a way to add more devices without starting all over -->
								<div id="AddMore" style="position:static; z-index:2; visibility:visible; display:none;">
								<script>
								// Redraw page with more device slots
								function pushMore(){
									document.PlanForm.sec.value = "activate";
									document.PlanForm.step.value = "select";
									document.PlanForm.task.value = "addmore";
									document.PlanForm.action = '/saveit.php';
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
										<input type="button" value="Add" style="width:40px;" class="bodyBlack" onClick="pushMore();">
									</td>
									<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
									<td>
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="popFinished();" class="smallBlack">Whoops, I don't want to add any more.</a>
									</td>
								</tr>
								</table>
								</div>
							</td>
						</tr>
						</table>
	<?
		}else{
	?>
			<div id="CDMADevices" style="position:static; visibility:<? echo iif(($locked && ($order['carrier'] == "sprint" || $order['carrier'] == "verizon")), 'visible;', 'hidden; display:none;'); ?>">
				<?
				// Get stored device information for default values
				$voice_selected = false;
				$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
				$rs_devices = mysql_query($query, $linkID);
				for ($counter=1; $counter <= $order['device_count']; $counter++){
					$device = mysql_fetch_assoc($rs_devices);
					$ESN[$counter] = $device["esn"];
					$PlanID[$counter] =  $device["plan_id"];
					$VoicePlanID[$counter] =  $device["voice_plan_id"];
					$RequestAreaCode[$counter] =  $device["request_areacode"];
					$User[$counter] =  $device["user"];
					if ($device["voice_plan_id"] != "" && $device["voice_plan_id"] != "None" && $order['carrier'] != "sprint") $voice_selected = true;
				}
				if ($_REQUEST['AddVoicePlan'] == "Yes") $voice_selected = true;
				?>
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
					if (CDMADataOnly.style.visibility == "visible"){
						FormLayer = "a";
					}else{
						FormLayer = "b";
					}
					for (counter=1; counter <= <? echo $deviceCount; ?>; counter++){
						if (eval('document.PlanForm.ESN'+counter+FormLayer+'.value') != ""){
							blank = false;
//							var ESN_regex = /(^\d{11}$)/;  // 11 digits, all numeric
//							if (ESN_regex.test(eval('document.PlanForm.ESN'+counter+FormLayer+'.value')) == false) { 
//								eval('PlanForm.ESN'+counter+FormLayer+'.style.background="#FF0000";');
//								alert('Please Enter Exactly 11 Digits (Numbers) For Device #'+counter+'\'s ESN');
//								eval('PlanForm.ESN'+counter+FormLayer+'.style.background="#FFFFFF";');
//								eval('PlanForm.ESN'+counter+FormLayer+'.focus();');
//								return false;
//							}
							for (counter2=1; counter2 <= counter-1; counter2++){
								if (eval('PlanForm.ESN'+counter2+FormLayer+'.value == PlanForm.ESN'+counter+'.value')){
									eval('PlanForm.ESN'+counter2+FormLayer+'.style.background="#FFE100";');
									eval('PlanForm.ESN'+counter+FormLayer+'.style.background="#FF0000";');
									alert('ESN Already Entered For Device #'+counter2);
									eval('PlanForm.ESN'+counter2+FormLayer+'.style.background="#FFFFFF";');
									eval('PlanForm.ESN'+counter+FormLayer+'.style.background="#FFFFFF";');
									eval('PlanForm.ESN'+counter+FormLayer+'.focus();');
									return false;
								}
							}
							eval('PlanForm.ESN'+counter+'.value = PlanForm.ESN'+counter+FormLayer+'.value;');
							if (eval('PlanForm.PlanID'+counter+FormLayer+'.value == ""')){
								eval('PlanForm.PlanID'+counter+FormLayer+'.style.background="#FF0000";');
								alert('Please Select A Plan For Device #'+counter);
								eval('PlanForm.PlanID'+counter+FormLayer+'.style.background="#FFFFFF";');
								eval('PlanForm.PlanID'+counter+FormLayer+'.focus();');
								return false;
							}
							eval('PlanForm.PlanID'+counter+'.value = PlanForm.PlanID'+counter+FormLayer+'.value;');
							if (eval('PlanForm.RequestAreaCode'+counter+FormLayer+'.value == ""')){
								eval('PlanForm.RequestAreaCode'+counter+FormLayer+'.style.background="#FF0000";');
								alert('Please Enter A Requested Area Code For Device #'+counter);
								eval('PlanForm.RequestAreaCode'+counter+FormLayer+'.style.background="#FFFFFF";');
								eval('PlanForm.RequestAreaCode'+counter+FormLayer+'.focus();');
								return false;
							}
							eval('PlanForm.RequestAreaCode'+counter+'.value = PlanForm.RequestAreaCode'+counter+FormLayer+'.value;');
//							if (eval('PlanForm.User'+counter+FormLayer+'.value == ""')){
//								eval('PlanForm.User'+counter+FormLayer+'.style.background="#FF0000";');
//								alert('Please Enter A User Name Or User Location For Device #'+counter);
//								eval('PlanForm.User'+counter+FormLayer+'.style.background="#FFFFFF";');
//								eval('PlanForm.User'+counter+FormLayer+'.focus();');
//								return false;
//							}
//							eval('PlanForm.User'+counter+'.value = PlanForm.User'+counter+FormLayer+'.value;');
							if (CDMADataVoice.style.visibility == "visible"){
								if (eval('PlanForm.VoicePlanID'+counter+FormLayer+'.value == ""')){
									eval('PlanForm.VoicePlanID'+counter+FormLayer+'.style.background="#FF0000";');
									alert('Please Select A Voice Plan For Device #'+counter);
									eval('PlanForm.VoicePlanID'+counter+FormLayer+'.style.background="#FFFFFF";');
									eval('PlanForm.VoicePlanID'+counter+FormLayer+'.focus();');
									return false;
								}
								eval('PlanForm.VoicePlanID'+counter+'.value = PlanForm.VoicePlanID'+counter+FormLayer+'.value;');
							}
						}
					}
					if (blank){
						alert('Please Enter At Least One Device');
						eval('PlanForm.ESN1'+FormLayer+'.focus();');
						return false;
					}
					document.PlanForm.sec.value = "activate";
					document.PlanForm.step.value = "account";
					document.PlanForm.task.value = "adddevices";
					document.PlanForm.DeviceCount.value = "<? echo $order['device_count'] ?>";
					document.PlanForm.action = '/saveit.php';
					document.PlanForm.submit();
				}

				// Show or don't show voice plans
				function addVoice(){
					if (PlanForm.AddVoicePlan[0].checked){
//						window.location="http://<? echo $site; ?>.deviceport.com/?sec=activate&step=select&site=<? echo $site; ?>&AddVoicePlan=Yes&sid=<? echo $_REQUEST['sid']; ?>";
						hide('CDMADataOnly');
						show('CDMADataVoice');
						PlanForm.ESN1b.focus();
					}else if (PlanForm.AddVoicePlan[1].checked){
//						window.location="http://<? echo $site; ?>.deviceport.com/?sec=activate&step=select&site=<? echo $site; ?>&AddVoicePlan=No&sid=<? echo $_REQUEST['sid']; ?>";
						hide('CDMADataVoice');
						show('CDMADataOnly');
						PlanForm.ESN1a.focus();
					}
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
					<td class="xbigBlack">
						Please Enter Your Device Information:<br><br>
					</td>
				</tr>
				<?
				if (($order['carrier'] == "sprint" && $sprint_voice_plans == "T") || ($order['carrier'] == "verizon" && $verizon_voice_plans == "T")){
				?>
				<tr>
					<td class="bigBlack">
						<ul>
							Would you like to add a Voice Plan to <? echo iif($order['device_count'] > 1, "any of the devices", "the device"); ?> you are activating?<br>
							<ul>
								<input type="radio" name="AddVoicePlan" value="Yes" onClick="addVoice();"<? echo iif($voice_selected == true, " checked", ""); ?>> Yes, I would like to add a Voice Plan to <? echo iif($order['device_count'] > 1, "at least one of the devices", "the device"); ?> I am activating.<br>
								<input type="radio" name="AddVoicePlan" value="No" onClick="addVoice();"<? echo iif($voice_selected == false, " checked", ""); ?>> No, I just want to select a Data Plan for the device<? echo iif($order['device_count'] > 1, "s", ""); ?> I am activating.<br>
							</ul>
						</ul>
					</td>
				</tr>
				<?
				}
				?>
				<tr>
					<td width="900">

						<div id="CDMADataOnly" style="position:static; visibility:<? echo iif($voice_selected == false, 'visible;', 'hidden; display:none;'); ?>">

						<?
						$query = "SELECT * FROM plans WHERE carrier = '".$order['carrier']."' AND plan_type = 'D' AND display = 'T' ORDER BY display_order ASC";
						$rs_dataplans = mysql_query($query, $linkID);
						?>
						<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
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
							if ($order['device_count'] < 10){  // 1 digit
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.$counter.'</strong></td>
								';
							}elseif ($order['device_count'] > 9 && $order['device_count'] < 100){  // 2 digits
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*","&nbsp; ",str_pad($counter,2,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}else{  // 3 digits (999 max)
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*"," &nbsp; ",str_pad($counter,3,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}
							?>
	<!--						<td align="center"><input type="text" name="ESN<? echo $counter; ?>a" id="ESN<? echo $counter; ?>a" size="8" maxlength="8" style="width:80px; background-color:<? echo $form_bg; ?>;" onKeyUp="if (this.value.length == 8){return checkESN('<? echo $counter; ?>');};" onChange="checkESN('<? echo $counter; ?>');" value=""> <!-- 4 hex digits (8 char.) --</td>-->
							<td align="center"><input type="text" name="ESN<? echo $counter; ?>a" id="ESN<? echo $counter; ?>a" size="11" maxlength="20" style="width:80px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $ESN[$counter]; ?>"> <!-- 4 hex digits (8 char.) or 11 digits decimal --></td>
							<td align="center">
								<select name="PlanID<? echo $counter; ?>a" id="PlanID<? echo $counter; ?>a" class="bodyBlack" style="width:430px; background-color: <? echo $form_bgcolor; ?>;" onChange="popPlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>','a');">
									<option value="">Select</option>
							<?
							mysql_data_seek($rs_dataplans, 0);
							for ($plan_counter=1; $plan_counter <= mysql_num_rows($rs_dataplans); $plan_counter++){
								$row = mysql_fetch_assoc($rs_dataplans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if (!$skipit){
							?>
									<option value="<? echo $row["plan_id"]; ?>"<? if($PlanID[$counter]==$row["plan_id"]) echo " selected";?>><? echo $row["plan_name"]; ?> - <? echo $row["quantity"]." ($".$row["cost"]; ?>)</option>
							<?
								}
							};
							?>
								</select>
							</td>
							<td align="center"><input type="text" name="RequestAreaCode<? echo $counter; ?>a" id="RequestAreaCode<? echo $counter; ?>a" size="15" maxlength="50" class="bodyBlack" style="width:80px; background-color:<? echo $form_bgcolor; ?>;" onChange="popACs('<? echo $counter; ?>','<? echo $order['device_count']; ?>','a');" value="<? echo $RequestAreaCode[$counter]; ?>"></td>
							<td align="center"><input type="text" name="User<? echo $counter; ?>a" id="User<? echo $counter; ?>a" size="15" maxlength="50" class="bodyBlack" style="width:180px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $User[$counter]; ?>"></td>
						</tr>
						<?
						}
						?>
						<tr>
							<td colspan="5" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
						</tr>
						</table>

						</div>

						<div id="CDMADataVoice" style="position:static; visibility:<? echo iif($voice_selected == true, 'visible;', 'hidden; display:none;'); ?>">

						<?
						$query = "SELECT * FROM plans WHERE carrier = '".$order['carrier']."' AND plan_type = 'D' AND display = 'T' ORDER BY display_order ASC";
						$rs_dataplans = mysql_query($query, $linkID);
						$query = "SELECT * FROM plans WHERE carrier = '".$order['carrier']."' AND plan_type = 'V' AND display = 'T' ORDER BY display_order ASC";
						$rs_voiceplans = mysql_query($query, $linkID);
						?>
						<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
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
							if ($order['device_count'] < 10){  // 1 digit
								echo'
							<td rowspan="2" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.$counter.'</strong></td>
								';
							}elseif ($order['device_count'] > 9 && $order['device_count'] < 100){  // 2 digits
								echo'
							<td rowspan="2" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*","&nbsp; ",str_pad($counter,2,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}else{  // 3 digits (999 max)
								echo'
							<td rowspan="2" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*"," &nbsp; ",str_pad($counter,3,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}
							?>
	<!--						<td align="center"><input type="text" name="ESN<? echo $counter; ?>b" id="ESN<? echo $counter; ?>b" size="8" maxlength="8" style="width:80px; background-color:<? echo $form_bg; ?>;" onKeyUp="if (this.value.length == 8){return checkESN('<? echo $counter; ?>');};" onChange="checkESN('<? echo $counter; ?>');" value=""> <!-- 4 hex digits (8 char.) --</td>-->
							<td height="30" align="center"><input type="text" name="ESN<? echo $counter; ?>b" id="ESN<? echo $counter; ?>b" size="11" maxlength="20" style="width:80px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $ESN[$counter]; ?>"> <!-- 4 hex digits (8 char.) or 11 digits decimal --></td>
							<td align="center">
								<select name="PlanID<? echo $counter; ?>b" id="PlanID<? echo $counter; ?>b" class="bodyBlack" style="width:430px; background-color: <? echo $form_bgcolor; ?>;" onChange="popPlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>','b');">
									<option value="">Select</option>
							<?
							mysql_data_seek($rs_dataplans, 0);
							for ($plan_counter=1; $plan_counter <= mysql_num_rows($rs_dataplans); $plan_counter++){
								$row = mysql_fetch_assoc($rs_dataplans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if (!$skipit){
							?>
									<option value="<? echo $row["plan_id"]; ?>"<? if($PlanID[$counter]==$row["plan_id"]) echo " selected";?>><? echo $row["plan_name"]; ?> - <? echo $row["quantity"]." ($".$row["cost"]; ?>)</option>
							<?
								}
							};
							?>
								</select>
							</td>
							<td align="center"><input type="text" name="RequestAreaCode<? echo $counter; ?>b" id="RequestAreaCode<? echo $counter; ?>b" size="15" maxlength="50" class="bodyBlack" style="width:80px; background-color:<? echo $form_bgcolor; ?>;" onChange="popACs('<? echo $counter; ?>','<? echo $order['device_count']; ?>','b');" value="<? echo $RequestAreaCode[$counter]; ?>"></td>
							<td align="center"><input type="text" name="User<? echo $counter; ?>b" id="User<? echo $counter; ?>b" size="15" maxlength="50" class="bodyBlack" style="width:180px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $User[$counter]; ?>"></td>
						</tr>
						<tr>
							<td colspan="4">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								<tr>
									<td align="right" bgcolor="<? echo $rowlabel_bgcolor; ?>" class="bodyWhite"><img src="images/spacer.gif" alt="" width="6" height="1" border="0">Please Select a Voice Plan for Device <? echo $counter; ?>:&nbsp;</td>
									<td bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="2" height="30" border="0"></td>
									<td align="center" bgcolor="<? echo $box_bgcolor; ?>" class="bodyBlack">
										<select name="VoicePlanID<? echo $counter; ?>b" id="VoicePlanID<? echo $counter; ?>b" class="bodyBlack" style="width:564px; background-color: <? echo $form_bgcolor; ?>;" onChange="popVoicePlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>','b');">
											<option value="">Select</option>
											<option value="None"<? if($VoicePlanID[$counter]=="None") echo " selected";?>>No Voice Plan for This Device</option>
									<?
									mysql_data_seek($rs_voiceplans, 0);
									for ($plan_counter=1; $plan_counter <= mysql_num_rows($rs_voiceplans); $plan_counter++){
										$row = mysql_fetch_assoc($rs_voiceplans);
										// Should we not offer this plan on this site?
										$skipit = false;
										for ($x=0; $x <= count($plans_exclude)-1; $x++){
											if ($row["plan_id"] == $plans_exclude[$x]){
												$skipit = true;
											}
										}
										if (!$skipit){
									?>
											<option value="<? echo $row["plan_id"]; ?>"<? if($VoicePlanID[$counter]==$row["plan_id"]) echo " selected";?>><? echo $row["plan_name"]; ?> - <? echo $row["quantity"]." ($".$row["cost"]; ?>)</option>
									<?
										}
									};
									?>
									</select>
									<input type="hidden" name="ESN<? echo $counter; ?>" id="ESN<? echo $counter; ?>" value="">
									<input type="hidden" name="PlanID<? echo $counter; ?>" id="PlanID<? echo $counter; ?>" value="">
									<input type="hidden" name="RequestAreaCode<? echo $counter; ?>" id="RequestAreaCode<? echo $counter; ?>" value="">
									<input type="hidden" name="User<? echo $counter; ?>" id="User<? echo $counter; ?>" value="">
									<input type="hidden" name="VoicePlanID<? echo $counter; ?>" id="VoicePlanID<? echo $counter; ?>" value="">
									</td>
								</tr>
								</table>
							</td>
<!--							<td colspan="2" bgcolor="<? echo $box_bgcolor; ?>">&nbsp;</td>-->
						</tr>
						<?
						}
						?>
						<tr>
							<td colspan="5" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
						</tr>
						</table>

						</div>

						<script>
						// show layer with add more form
						function popMore(){
							hide('FinishedButton');
							show('AddMore');
							document.getElementById("AddQty").focus();
						}
						</script>
						<table id="Buttons" width="900" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td width="210" align="center">
								<input type="button" value="&raquo; Add More Devices &laquo;" style="width:190px;" onClick="popMore();">
							</td>
							<td width="690" height="50">
								<!-- Put finished button in it's own layer so it can be swapped out -->
								<div id="FinishedButton" style="position:static; z-index:1; visibility:visible;">
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
									document.PlanForm.sec.value = "activate";
									document.PlanForm.step.value = "select";
									document.PlanForm.task.value = "addmore";
									document.PlanForm.action = '/saveit.php';
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
										<input type="button" value="Add" style="width:40px;" class="bodyBlack" onClick="pushMore();">
									</td>
									<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
									<td>
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="popFinished();" class="smallBlack">Whoops, I don't want to add any more.</a>
									</td>
								</tr>
								</table>
								</div>
							</td>
						</tr>
						</table>
	<?
		}
	?>
					<?
					// Sprint Plans
					if ($order['carrier'] == "sprint"){
					?>
						<table width="900" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
						</tr>
						</table>
						<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>

						<div id="SprintDataPlans" style="position:static; visibility:visible;">

						<table id="sprintDataPlansTable" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<script>
								// show layer with voice plans
								function popVoice(){
									hide('SprintDataPlans');
									show('SprintVoicePlans');
								}
								</script>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="xbigBlack">Sprint Data Plans:<br></td>
									<td align="right" valign="top">
										<?
										if ($sprint_voice_plans == "T"){
											echo'
										<input type="button" value="&raquo; Show Voice Plans &laquo;" style="width:190px;" onClick="popVoice();">
										<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
											';
										}
										?>
									</td>
								</tr>
								</table>
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
							<td></td>
							';
						}
						?>
						</tr>
						<tr>
							<td align="right" class="bodyBlack"><strong><em>*Pricing Note - Any negotiated contract pricing will apply retroactively once activated</em></strong><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td width="930" height="15">
							<?
							$query = "SELECT * FROM plans WHERE carrier = 'Sprint' AND plan_type = 'D' AND display = 'T' ORDER BY display_order ASC";
							$rs_plans = mysql_query($query, $linkID);
							echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td align="center">Plan Name</td>
									<td align="center">Included<br>Data</td>
									<td align="center">Additional<br>Data</td>
									<td align="center">Canadian<br>Data</td>
									<td align="center">Mexican<br>Data</td>
									<td align="center">Cost<br>&nbsp;&nbsp;per Month*</td>
								</tr>
							';
							$showtwoyear = false;
							for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
								$twoyear = false;
								$row = mysql_fetch_assoc($rs_plans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if ($row["commitment"] == "2"){
									$twoyear = true;
									$showtwoyear = true;
								}
								if (!$skipit){
									if ($row["add_unit_cost"] == 0){
										$add_unit_cost = "N/A";
									}else{
										$add_unit_cost = '$'.money_format('%.4i', $row["add_unit_cost"]).'/KB';
									}
									if ($row["add_cdn_cost"] == 0){
										$add_cdn_cost = "N/A";
									}else{
										$add_cdn_cost = '$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB';
									}
									if ($row["add_mx_cost"] == 0){
										$add_mx_cost = "N/A";
									}else{
										$add_mx_cost = '$'.money_format('%.4i', $row["add_mx_cost"]).'/KB';
									}
									echo'
								<tr bgcolor="'.$box_bgcolor.'" onMouseOver="show(\'Plan'.$row["plan_id"].'Div\');" onMouseOut="hide(\'Plan'.$row["plan_id"].'Div\');" class="bodyBlack">
									<td height="25" align="left" style="padding-left: 5px">
										<div id="container" style="position:relative; align:left; z-index:0; display:block;">
											<!-- Plan Details Balloon -->
											<div id="Plan'.$row["plan_id"].'Div" style="position:absolute; top:-16; left:50; z-index:1; width:300px; background-color:#FFFFFF; border: thin solid '.$border_bgcolor.'; padding:5px; visibility:hidden">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
												<tr>
													<td><strong>'.$row["plan_name"].'</strong></td>
												</tr>
												<tr>
													<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
												</tr>
												<tr>
													<td>'.$row["description"].'</td>
												</tr>
												</table>
											</div>
										</div>
										'.$row["plan_name"].'
									</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center">'.$add_unit_cost.'</td>
									<td align="center">'.$add_cdn_cost.'</td>
									<td align="center">'.$add_mx_cost.'</td>
									<td align="center">'.iif($twoyear, "&nbsp;&nbsp;", "").'$'.money_format('%i', $row["cost"]).iif($twoyear, "&dagger;", "").'</td>
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

						</div>

						<div id="SprintVoicePlans" style="position:static; visibility:hidden; display:none;">

						<table id="sprintVoicePlansTable" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<script>
								// show layer with voice plans
								function popData(){
									hide('SprintVoicePlans');
									show('SprintDataPlans');
								}
								</script>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="xbigBlack">Sprint Voice Plans:<br></td>
									<td align="right" valign="top">
										<input type="button" value="&raquo; Show Data Plans &laquo;" style="width:190px;" onClick="popData();">
										<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									</td>
								</tr>
								</table>
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
							<td></td>
							';
						}
						?>
						</tr>
						<tr>
							<td align="right" class="bodyBlack"><strong><em>*Pricing Note - Any negotiated contract pricing will apply retroactively once activated</em></strong><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td width="930" height="15">
							<?
							if ($order["acct_type"] == "IL"){
								$query = "SELECT * FROM plans WHERE carrier = 'Sprint' AND plan_type = 'V' AND (audience = 'IL' OR audience = 'ALL') AND display = 'T' ORDER BY display_order ASC";
							}elseif ($order["acct_type"] == "CL"){
								$query = "SELECT * FROM plans WHERE carrier = 'Sprint' AND plan_type = 'V' AND (audience = 'CL' OR audience = 'ALL') AND display = 'T' ORDER BY display_order ASC";
							}
							$rs_plans = mysql_query($query, $linkID);
							echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td align="center">Plan Name</td>
									<td align="center">Included<br>Minutes</td>
									<td align="center">Additional<br>Minutes</td>
									<td align="center">Cost<br>&nbsp;&nbsp;per Month*</td>
								</tr>
							';
//							$showtwoyear = false;
							for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
								$twoyear = false;
								$row = mysql_fetch_assoc($rs_plans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if ($row["commitment"] == "2"){
									$twoyear = true;
									$showtwoyear = true;
								}
								if (!$skipit){
									if ($row["add_unit_cost"] == 0){
										$add_unit_cost = "N/A";
									}else{
										$add_unit_cost = '$'.money_format('%.4i', $row["add_unit_cost"]).'/Minute';
									}
//									if ($row["add_cdn_cost"] == 0){
//										$add_cdn_cost = "N/A";
//									}else{
//										$add_cdn_cost = '$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB';
//									}
//									if ($row["add_mx_cost"] == 0){
//										$add_mx_cost = "N/A";
//									}else{
//										$add_mx_cost = '$'.money_format('%.4i', $row["add_mx_cost"]).'/KB';
//									}
									echo'
								<tr bgcolor="'.$box_bgcolor.'" onMouseOver="show(\'Plan'.$row["plan_id"].'Div\');" onMouseOut="hide(\'Plan'.$row["plan_id"].'Div\');" class="bodyBlack">
									<td height="25" align="left" style="padding-left: 5px">
										<div id="container" style="position:relative; align:left; z-index:0; display:block;">
											<!-- Plan Details Balloon -->
											<div id="Plan'.$row["plan_id"].'Div" style="position:absolute; top:-16; left:50; z-index:1; width:300px; background-color:#FFFFFF; border: thin solid '.$border_bgcolor.'; padding:5px; visibility:hidden">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
												<tr>
													<td><strong>'.$row["plan_name"].'</strong></td>
												</tr>
												<tr>
													<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
												</tr>
												<tr>
													<td>'.$row["description"].'</td>
												</tr>
												</table>
											</div>
										</div>
										'.$row["plan_name"].'
									</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center">'.$add_unit_cost.'</td>
<!--									<td align="center">'.$add_cdn_cost.'</td>-->
<!--									<td align="center">'.$add_mx_cost.'</td>-->
									<td align="center">'.iif($twoyear, "&nbsp;&nbsp;", "").'$'.money_format('%i', $row["cost"]).iif($twoyear, "&dagger;", "").'</td>
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

						</div>

						<table width="900" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td class="smallBlack"><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><em><strong>Point at Plan for Additional Details</strong></em></td>
							<td height="20" align="right" class="smallBlack"><em>* With 1-Year Commitment Unless Otherwise Noted</em><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><? echo iif($showtwoyear, '<br><em>&dagger; Specially Priced Plan, 2-Year Commitment Required</em><img src="images/spacer.gif" alt="" width="8" height="1" border="0">', ''); ?></td>
						</tr>
						</table>
						<br>
					<?
					// Verizon Plans
					}elseif ($order['carrier'] == "verizon"){
					?>
						<table width="900" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
						</tr>
						</table>
						<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>

						<div id="VerizonDataPlans" style="position:static; visibility:visible;">

						<table id="verizonDataPlansTable" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<script>
								// show layer with voice plans
								function popVoice(){
									hide('VerizonDataPlans');
									show('VerizonVoicePlans');
								}
								</script>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="xbigBlack">Verizon Data Plans:<br></td>
									<td align="right" valign="top">
										<?
										if ($verizon_voice_plans == "T"){
											echo'
										<input type="button" value="&raquo; Show Voice Plans &laquo;" style="width:190px;" onClick="popVoice();">
										<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
											';
										}
										?>
									</td>
								</tr>
								</table>
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
							<td></td>
							';
						}
						?>
						</tr>
						<tr>
							<td align="right" class="bodyBlack"><strong><em>*Pricing Note - Any negotiated contract pricing will apply retroactively once activated</em></strong><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td width="930" height="15">
							<?
							$query = "SELECT * FROM plans WHERE carrier = 'Verizon' AND plan_type = 'D' AND display = 'T' ORDER BY display_order ASC";
							$rs_plans = mysql_query($query, $linkID);
							echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td align="center">Plan Name</td>
									<td align="center">Included<br>Data</td>
									<td align="center">Additional<br>Data</td>
									<td align="center">Canadian<br>Data</td>
									<td align="center">Mexican<br>Data</td>
									<td align="center">Cost<br>&nbsp;&nbsp;per Month*</td>
								</tr>
							';
							$showtwoyear = false;
							for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
								$twoyear = false;
								$row = mysql_fetch_assoc($rs_plans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if ($row["commitment"] == "2"){
									$twoyear = true;
									$showtwoyear = true;
								}
								if (!$skipit){
									if ($row["add_unit_cost"] == 0){
										$add_unit_cost = "N/A";
									}else{
										$add_unit_cost = '$'.money_format('%.4i', $row["add_unit_cost"]).'/KB';
									}
									if ($row["add_cdn_cost"] == 0){
										$add_cdn_cost = "N/A";
									}else{
										$add_cdn_cost = '$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB';
									}
									if ($row["add_mx_cost"] == 0){
										$add_mx_cost = "N/A";
									}else{
										$add_mx_cost = '$'.money_format('%.4i', $row["add_mx_cost"]).'/KB';
									}
									echo'
								<tr bgcolor="'.$box_bgcolor.'" onMouseOver="show(\'Plan'.$row["plan_id"].'Div\');" onMouseOut="hide(\'Plan'.$row["plan_id"].'Div\');" class="bodyBlack">
									<td height="25" align="left" style="padding-left: 5px">
										<div id="container" style="position:relative; align:left; z-index:0; display:block;">
											<!-- Plan Details Balloon -->
											<div id="Plan'.$row["plan_id"].'Div" style="position:absolute; top:-16; left:50; z-index:1; width:790px; background-color:#FFFFFF; border: thin solid '.$border_bgcolor.'; padding:5px; visibility:hidden">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
												<tr>
													<td><strong>'.$row["plan_name"].'</strong></td>
												</tr>
												<tr>
													<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
												</tr>
												<tr>
													<td>'.$row["description"].'</td>
												</tr>
												</table>
											</div>
										</div>
										'.$row["plan_name"].'
									</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center">'.$add_unit_cost.'</td>
									<td align="center">'.$add_cdn_cost.'</td>
									<td align="center">'.$add_mx_cost.'</td>
									<td align="center">'.iif($twoyear, "&nbsp;&nbsp;", "").'$'.money_format('%i', $row["cost"]).iif($twoyear, "&dagger;", "").'</td>
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

						</div>

						<div id="VerizonVoicePlans" style="position:static; visibility:hidden; display:none;">

						<table id="verizonVoicePlansTable" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<script>
								// show layer with voice plans
								function popData(){
									hide('VerizonVoicePlans');
									show('VerizonDataPlans');
								}
								</script>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="xbigBlack">Verizon Voice Plans:<br></td>
									<td align="right" valign="top">
										<input type="button" value="&raquo; Show Data Plans &laquo;" style="width:190px;" onClick="popData();">
										<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									</td>
								</tr>
								</table>
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
							<td></td>
							';
						}
						?>
						</tr>
						<tr>
							<td align="right" class="bodyBlack"><strong><em>*Pricing Note - Any negotiated contract pricing will apply retroactively once activated</em></strong><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td width="930" height="15">
							<?
							if ($order["acct_type"] == "IL"){
								$query = "SELECT * FROM plans WHERE carrier = 'Verizon' AND plan_type = 'V' AND (audience = 'IL' OR audience = 'ALL') AND display = 'T' ORDER BY display_order ASC";
							}elseif ($order["acct_type"] == "CL"){
								$query = "SELECT * FROM plans WHERE carrier = 'Verizon' AND plan_type = 'V' AND (audience = 'CL' OR audience = 'ALL') AND display = 'T' ORDER BY display_order ASC";
							}
							$rs_plans = mysql_query($query, $linkID);
							echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td align="center">Plan Name</td>
									<td align="center">Included<br>Minutes</td>
									<td align="center">Additional<br>Minutes</td>
									<td align="center">Cost<br>&nbsp;&nbsp;per Month*</td>
								</tr>
							';
							$showtwoyear = false;
							for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
								$twoyear = false;
								$row = mysql_fetch_assoc($rs_plans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if ($row["commitment"] == "2"){
									$twoyear = true;
									$showtwoyear = true;
								}
								if (!$skipit){
									if ($row["add_unit_cost"] == 0){
										$add_unit_cost = "N/A";
									}else{
										$add_unit_cost = '$'.money_format('%.4i', $row["add_unit_cost"]).'/Minute';
									}
//									if ($row["add_cdn_cost"] == 0){
//										$add_cdn_cost = "N/A";
//									}else{
//										$add_cdn_cost = '$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB';
//									}
//									if ($row["add_mx_cost"] == 0){
//										$add_mx_cost = "N/A";
//									}else{
//										$add_mx_cost = '$'.money_format('%.4i', $row["add_mx_cost"]).'/KB';
//									}
									echo'
								<tr bgcolor="'.$box_bgcolor.'" onMouseOver="show(\'Plan'.$row["plan_id"].'Div\');" onMouseOut="hide(\'Plan'.$row["plan_id"].'Div\');" class="bodyBlack">
									<td height="25" align="left" style="padding-left: 5px">
										<div id="container" style="position:relative; align:left; z-index:0; display:block;">
											<!-- Plan Details Balloon -->
											<div id="Plan'.$row["plan_id"].'Div" style="position:absolute; top:-16; left:50; z-index:1; width:790px; background-color:#FFFFFF; border: thin solid '.$border_bgcolor.'; padding:5px; visibility:hidden">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
												<tr>
													<td><strong>'.$row["plan_name"].'</strong></td>
												</tr>
												<tr>
													<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
												</tr>
												<tr>
													<td>'.$row["description"].'</td>
												</tr>
												</table>
											</div>
										</div>
										'.$row["plan_name"].'
									</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center">'.$add_unit_cost.'</td>
<!--									<td align="center">'.$add_cdn_cost.'</td>-->
<!--									<td align="center">'.$add_mx_cost.'</td>-->
									<td align="center">'.iif($twoyear, "&nbsp;&nbsp;", "").'$'.money_format('%i', $row["cost"]).iif($twoyear, "&dagger;", "").'</td>
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

						</div>

						<table width="900" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td class="smallBlack"><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><em><strong>Point at Plan for Additional Details</strong></em></td>
							<td height="20" align="right" class="smallBlack"><em>* With 1-Year Commitment Unless Otherwise Noted</em><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><? echo iif($showtwoyear, '<br><em>&dagger; Specially Priced Plan, 2-Year Commitment Required</em><img src="images/spacer.gif" alt="" width="8" height="1" border="0">', ''); ?></td>
						</tr>
						</table>
						<br>
					<?
					}
					?>
					</td>
				</tr>
				</table>
			</div>
	<?
	}
	if ($order['carrier'] == "at&t"){
	?>
			<div id="GSMDevices" style="position:static; visibility:<? echo iif(($locked && $order['carrier'] == "at&t"), 'visible;', 'hidden; display:none;'); ?>">
				<?
				// Get stored device information for default values
				$voice_selected = false;
				$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
				$rs_devices = mysql_query($query, $linkID);
				for ($counter=1; $counter <= $order['device_count']; $counter++){
					$device = mysql_fetch_assoc($rs_devices);
					$ICCID[$counter] = $device["iccid"];
					$IMEI[$counter] = $device["imei"];
					$ShipSIMCard[$counter] = $device["ship_sim_card"];
					$PlanID[$counter] =  $device["plan_id"];
					$VoicePlanID[$counter] =  $device["voice_plan_id"];
					$RequestAreaCode[$counter] =  $device["request_areacode"];
					$User[$counter] =  $device["user"];
					if ($device["voice_plan_id"] != "" && $device["voice_plan_id"] != "None") $voice_selected = true;
				}
				if ($_REQUEST['AddVoicePlan'] == "Yes") $voice_selected = true;
				?>
				<script>
				function validateGSM() {
					var blank = true;
					if (GSMDataOnly.style.visibility == "visible"){
						FormLayer = "a";
					}else{
						FormLayer = "b";
					}
					for (counter=1; counter <= <? echo $order['device_count']; ?>; counter++){
						if (eval('document.PlanForm.IMEI'+counter+FormLayer+'.value') != ""){
							blank = false;
							if (PlanForm.ShipSIMCard[0].checked){
								var ICCID_regex = /(^\d{20}$)/;  // 20 digits, all numeric
								if (ICCID_regex.test(eval('document.PlanForm.ICCID'+counter+FormLayer+'.value')) == false) { 
									eval('PlanForm.ICCID'+counter+FormLayer+'.style.background="#FF0000";');
									alert('Please Enter Exactly 20 Digits (Numbers) For Device #'+counter+'\'s SIM Card Number');
									eval('PlanForm.ICCID'+counter+FormLayer+'.style.background="#FFFFFF";');
									eval('PlanForm.ICCID'+counter+FormLayer+'.focus();');
									return false;
								}
								for (counter2=1; counter2 <= counter-1; counter2++){
									if (eval('PlanForm.ICCID'+counter2+FormLayer+'.value == PlanForm.ICCID'+counter+FormLayer+'.value')){
										eval('PlanForm.ICCID'+counter2+FormLayer+'.style.background="#FFE100";');
										eval('PlanForm.ICCID'+counter+FormLayer+'.style.background="#FF0000";');
										alert('ICCID Already Entered For Device #'+counter2);
										eval('PlanForm.ICCID'+counter2+FormLayer+'.style.background="#FFFFFF";');
										eval('PlanForm.ICCID'+counter+FormLayer+'.style.background="#FFFFFF";');
										eval('PlanForm.ICCID'+counter+FormLayer+'.focus();');
										return false;
									}
								}
//alert('PlanForm.ICCID'+counter+'.value = PlanForm.ICCID'+counter+FormLayer+'.value;');
//alert(eval('PlanForm.ICCID'+counter+FormLayer+'.value;'));
								eval('PlanForm.ICCID'+counter+'.value = PlanForm.ICCID'+counter+FormLayer+'.value;');
//								document.PlanForm.ICCID'+counter+'.value = PlanForm.ICCID'+counter+FormLayer+'.value;
//alert(eval('PlanForm.ICCID'+counter+'.value;'));
//alert(document.PlanForm.ICCID1.value);
							}
							if (eval('PlanForm.IMEI'+counter+FormLayer+'.value == ""')){
								eval('PlanForm.IMEI'+counter+FormLayer+'.style.background="#FF0000";');
								alert('Please Enter Device #'+counter+'\'s IMEI Number');
								eval('PlanForm.IMEI'+counter+FormLayer+'.style.background="#FFFFFF";');
								eval('PlanForm.IMEI'+counter+FormLayer+'.focus();');
								return false;
							}
							var IMEI_regex = /(^\d{15}$)/;  // 15 digits, all numeric
							if (IMEI_regex.test(eval('document.PlanForm.IMEI'+counter+FormLayer+'.value')) == false) { 
								eval('PlanForm.IMEI'+counter+FormLayer+'.style.background="#FF0000";');
								alert('Please Enter Exactly 15 Digits (Numbers) For Device #'+counter+'\'s IMEI Number');
								eval('PlanForm.IMEI'+counter+FormLayer+'.style.background="#FFFFFF";');
								eval('PlanForm.IMEI'+counter+FormLayer+'.focus();');
								return false;
							}
							for (counter2=1; counter2 <= counter-1; counter2++){
								if (eval('PlanForm.IMEI'+counter2+FormLayer+'.value == PlanForm.IMEI'+counter+FormLayer+'.value')){
									eval('PlanForm.IMEI'+counter2+FormLayer+'.style.background="#FFE100";');
									eval('PlanForm.IMEI'+counter+FormLayer+'.style.background="#FF0000";');
									alert('IMEI Already Entered For Device #'+counter2);
									eval('PlanForm.IMEI'+counter2+FormLayer+'.style.background="#FFFFFF";');
									eval('PlanForm.IMEI'+counter+FormLayer+'.style.background="#FFFFFF";');
									eval('PlanForm.IMEI'+counter+FormLayer+'.focus();');
									return false;
								}
							}
							eval('PlanForm.IMEI'+counter+'.value = PlanForm.IMEI'+counter+FormLayer+'.value;');
							if (eval('PlanForm.PlanID'+counter+FormLayer+'.value == ""')){
								eval('PlanForm.PlanID'+counter+FormLayer+'.style.background="#FF0000";');
								alert('Please Select A Data Plan For Device #'+counter);
								eval('PlanForm.PlanID'+counter+FormLayer+'.style.background="#FFFFFF";');
								eval('PlanForm.PlanID'+counter+FormLayer+'.focus();');
								return false;
							}
							eval('PlanForm.PlanID'+counter+'.value = PlanForm.PlanID'+counter+FormLayer+'.value;');
							if (eval('PlanForm.RequestAreaCode'+counter+FormLayer+'.value == ""')){
								eval('PlanForm.RequestAreaCode'+counter+FormLayer+'.style.background="#FF0000";');
								alert('Please Enter A Requested Area Code For Device #'+counter);
								eval('PlanForm.RequestAreaCode'+counter+FormLayer+'.style.background="#FFFFFF";');
								eval('PlanForm.RequestAreaCode'+counter+FormLayer+'.focus();');
								return false;
							}
							eval('PlanForm.RequestAreaCode'+counter+'.value = PlanForm.RequestAreaCode'+counter+FormLayer+'.value;');
//							if (eval('PlanForm.User'+counter+FormLayer+'.value == ""')){
//								eval('PlanForm.User'+counter+FormLayer+'.style.background="#FF0000";');
//								alert('Please Enter A User Name Or User Location For Device #'+counter);
//								eval('PlanForm.User'+counter+FormLayer+'.style.background="#FFFFFF";');
//								eval('PlanForm.User'+counter+FormLayer+'.focus();');
//								return false;
//							}
//							eval('PlanForm.User'+counter+'.value = PlanForm.User'+counter+FormLayer+'.value;');
							if (GSMDataVoice.style.visibility == "visible"){
								if (eval('PlanForm.VoicePlanID'+counter+FormLayer+'.value == ""')){
									eval('PlanForm.VoicePlanID'+counter+FormLayer+'.style.background="#FF0000";');
									alert('Please Select A Voice Plan For Device #'+counter);
									eval('PlanForm.VoicePlanID'+counter+FormLayer+'.style.background="#FFFFFF";');
									eval('PlanForm.VoicePlanID'+counter+FormLayer+'.focus();');
									return false;
								}
								eval('PlanForm.VoicePlanID'+counter+'.value = PlanForm.VoicePlanID'+counter+FormLayer+'.value;');
							}
						}
					}
					if (blank){
						alert('Please Enter At Least One Device');
						eval('PlanForm.ICCID1'+FormLayer+'.focus();');
						return false;
					}
					document.PlanForm.sec.value = "activate";
					document.PlanForm.step.value = "account";
					document.PlanForm.task.value = "adddevices";
					document.PlanForm.DeviceCount.value = "<? echo $order['device_count'] ?>";
					document.PlanForm.action = '/saveit.php';
					document.PlanForm.submit();
				}

				// Activate or deactivate SIM Card Number field if choice selected
				function getSIMs(){
//alert(ATTDataOnly.style.visibility);
					if (PlanForm.ShipSIMCard[0].checked){
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
						if (GSMDataOnly.style.visibility == "visible"){
							PlanForm.ShipSIMCard<? echo $counter; ?>a.value = 'No';
							PlanForm.ICCID<? echo $counter; ?>a.readOnly = false;
							PlanForm.ICCID<? echo $counter; ?>a.style.background = "#FFFFFF";
							PlanForm.ICCID1a.focus();
						}else{
							PlanForm.ShipSIMCard<? echo $counter; ?>b.value = 'No';
							PlanForm.ICCID<? echo $counter; ?>b.readOnly = false;
							PlanForm.ICCID<? echo $counter; ?>b.style.background = "#FFFFFF";
							PlanForm.ICCID1b.focus();
						}
						<?
						}
						?>
					}else if (PlanForm.ShipSIMCard[1].checked){
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
						if (GSMDataOnly.style.visibility == "visible"){
							PlanForm.ShipSIMCard<? echo $counter; ?>a.value = 'Yes';
							PlanForm.ICCID<? echo $counter; ?>a.value = '';
							PlanForm.ICCID<? echo $counter; ?>a.readOnly = true;
							PlanForm.ICCID<? echo $counter; ?>a.style.background = "#C0C0C0";
							PlanForm.IMEI1a.focus();
						}else{
							PlanForm.ShipSIMCard<? echo $counter; ?>b.value = 'Yes';
							PlanForm.ICCID<? echo $counter; ?>b.value = '';
							PlanForm.ICCID<? echo $counter; ?>b.readOnly = true;
							PlanForm.ICCID<? echo $counter; ?>b.style.background = "#C0C0C0";
							PlanForm.IMEI1b.focus();
						}
						<?
						}
						?>
					}
				}

				// Show or don't show voice plans
				function addVoice(){
					if (PlanForm.AddVoicePlan[0].checked){
//						window.location="http://<? echo $site; ?>.deviceport.com/?sec=activate&step=select&site=<? echo $site; ?>&AddVoicePlan=Yes&sid=<? echo $_REQUEST['sid']; ?>";
						hide('GSMDataOnly');
						show('GSMDataVoice');
						if (PlanForm.ShipSIMCard[1].checked){
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
							PlanForm.ShipSIMCard<? echo $counter; ?>b.value = 'Yes';
							PlanForm.ICCID<? echo $counter; ?>b.value = '';
							PlanForm.ICCID<? echo $counter; ?>b.readOnly = true;
							PlanForm.ICCID<? echo $counter; ?>b.style.background = "#C0C0C0";
						<?
						}
						?>
							PlanForm.IMEI1b.focus();
						}else{
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
							PlanForm.ShipSIMCard<? echo $counter; ?>b.value = 'No';
							PlanForm.ICCID<? echo $counter; ?>b.readOnly = false;
							PlanForm.ICCID<? echo $counter; ?>b.style.background = "#FFFFFF";
						<?
						}
						?>
							PlanForm.ICCID1b.focus();
						}
					}else if (PlanForm.AddVoicePlan[1].checked){
//						window.location="http://<? echo $site; ?>.deviceport.com/?sec=activate&step=select&site=<? echo $site; ?>&AddVoicePlan=No&sid=<? echo $_REQUEST['sid']; ?>";
						hide('GSMDataVoice');
						show('GSMDataOnly');
						if (PlanForm.ShipSIMCard[1].checked){
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
							PlanForm.ShipSIMCard<? echo $counter; ?>a.value = 'Yes';
							PlanForm.ICCID<? echo $counter; ?>a.value = '';
							PlanForm.ICCID<? echo $counter; ?>a.readOnly = true;
							PlanForm.ICCID<? echo $counter; ?>a.style.background = "#C0C0C0";
						<?
						}
						?>
							PlanForm.IMEI1a.focus();
						}else{
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
							PlanForm.ShipSIMCard<? echo $counter; ?>a.value = 'No';
							PlanForm.ICCID<? echo $counter; ?>a.readOnly = false;
							PlanForm.ICCID<? echo $counter; ?>a.style.background = "#FFFFFF";
						<?
						}
						?>
							PlanForm.ICCID1a.focus();
						}
					}
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
					<td class="xbigBlack">
						Please Enter Your Device Information:<br>
					</td>
				</tr>
				<tr>
					<td class="bigBlack">
						<ul>
							<br>Are you in possession of the <? echo iif($order['carrier'] == "at&t", "AT&amp;T", ucfirst($order['carrier'])); ?> SIM <? echo iif($order['device_count'] > 1, "Cards", "Card"); ?> that you would like to activate?<br>
							<ul>
								<input type="radio" name="ShipSIMCard" value="No" onClick="getSIMs();"<? echo iif(!$ShipSIMCard[1] || $ShipSIMCard[1] == "No", " checked", ""); ?>> Yes, I already have the SIM <? echo iif($order['device_count'] > 1, "Cards", "Card"); ?> and will enter <? echo iif($order['device_count'] > 1, "their numbers", "its number"); ?> below.<br>
								<input type="radio" name="ShipSIMCard" value="Yes" onClick="getSIMs();"<? echo iif($ShipSIMCard[1] == "Yes", " checked", ""); ?>> No, please ship me the SIM <? echo iif($order['device_count'] > 1, "Cards", "Card"); ?>.
							</ul>
						</ul>
					</td>
				</tr>
				<?
				if ($cingular_voice_plans == "T"){
				?>
				<tr>
					<td class="bigBlack">
						<ul>
							Would you like to add a Voice Plan to <? echo iif($order['device_count'] > 1, "any of the devices", "the device"); ?> you are activating?<br>
							<ul>
								<input type="radio" name="AddVoicePlan" value="Yes" onClick="addVoice();"<? echo iif($voice_selected == true, " checked", ""); ?>> Yes, I would like to add a Voice Plan to <? echo iif($order['device_count'] > 1, "at least one of the devices", "the device"); ?> I am activating.<br>
								<input type="radio" name="AddVoicePlan" value="No" onClick="addVoice();"<? echo iif($voice_selected == false, " checked", ""); ?>> No, I just want to select a Data Plan for the device<? echo iif($order['device_count'] > 1, "s", ""); ?> I am activating.<br>
							</ul>
						</ul>
					</td>
				</tr>
				<?
				}
				?>
				<tr>
					<td width="900">

						<div id="GSMDataOnly" style="position:static; visibility:<? echo iif($voice_selected == false, 'visible;', 'hidden; display:none;'); ?>">

						<?
						$query = "SELECT * FROM plans WHERE carrier = '".$order['carrier']."' AND plan_type = 'D' AND display = 'T' ORDER BY display_order ASC";
						$rs_plans = mysql_query($query, $linkID);
						?>
						<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
						<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
							<td height="25" align="center"><img src="images/spacer.gif" alt="" width="50" height="1" border="0"><br>Device</td>
							<td align="center"><img src="images/spacer.gif" alt="" width="154" height="1" border="0"><br>SIM Card Number</td>
							<td align="center"><img src="images/spacer.gif" alt="" width="114" height="1" border="0"><br>IMEI Number</td>
							<td align="center"><img src="images/spacer.gif" alt="" width="390" height="1" border="0"><br>Data Plan</td>
							<td align="center"><img src="images/spacer.gif" alt="" width="80" height="1" border="0"><br>Requested <nobr>Area Code</nobr></td>
							<td align="center"><img src="images/spacer.gif" alt="" width="98" height="1" border="0"><br>User Name</td>
						</tr>
<!--						<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
							<td height="26" width="50" align="center">Device</td>
							<td width="170" align="center">SIM Card Number</td>
							<td width="130" align="center">IMEI Number</td>
							<td width="395" align="center">Data Plan</td>
							<td width="80" align="center">Requested <nobr>Area Code</nobr></td>
							<td width="100" align="center">User Name</td>
						</tr>-->
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
						<tr bgcolor="<? echo $box_bgcolor; ?>" class="bodyBlack">
							<?
							// Align numeric values centered but decimal tabbed based on length of highest number
							if ($order['device_count'] < 10){  // 1 digit
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.$counter.'</strong></td>
								';
							}elseif ($order['device_count'] > 9 && $order['device_count'] < 100){  // 2 digits
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*","&nbsp; ",str_pad($counter,2,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}else{  // 3 digits (999 max)
								echo'
							<td height="30" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*"," &nbsp; ",str_pad($counter,3,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}
							?>
							<td align="center"><input type="text" name="ICCID<? echo $counter; ?>a" id="ICCID<? echo $counter; ?>a" size="20" maxlength="20" style="width:145px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $ICCID[$counter]; ?>"> <!-- 20 digits decimal --></td>
							<td align="center"><input type="text" name="IMEI<? echo $counter; ?>a" id="IMEI<? echo $counter; ?>a" size="15" maxlength="15" style="width:105px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $IMEI[$counter]; ?>"> <!-- 15 digits decimal --></td>
							<td align="center">
								<select name="PlanID<? echo $counter; ?>a" id="PlanID<? echo $counter; ?>a" class="bodyBlack" style="width:380px; background-color: <? echo $form_bgcolor; ?>;" onChange="popPlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>','a');">
									<option value="">Select</option>
							<?
							mysql_data_seek($rs_plans, 0);
							for ($plan_counter=1; $plan_counter <= mysql_num_rows($rs_plans); $plan_counter++){
								$row = mysql_fetch_assoc($rs_plans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if (!$skipit){
							?>
									<option value="<? echo $row["plan_id"]; ?>"<? if($PlanID[$counter]==$row["plan_id"]) echo " selected";?>><? echo $row["plan_name"]; ?> - <? echo $row["quantity"]." ($".$row["cost"]; ?>)</option>
							<?
								}
							};
							?>
								</select>
							</td>
							<td align="center"><input type="text" name="RequestAreaCode<? echo $counter; ?>a" id="RequestAreaCode<? echo $counter; ?>a" size="15" maxlength="50" class="bodyBlack" style="width:70px; background-color:<? echo $form_bgcolor; ?>;" onChange="popACs('<? echo $counter; ?>','<? echo $order['device_count']; ?>','a');" value="<? echo $RequestAreaCode[$counter]; ?>"></td>
							<td align="center"><input type="text" name="User<? echo $counter; ?>a" id="User<? echo $counter; ?>a" size="15" maxlength="50" class="bodyBlack" style="width:88px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $User[$counter]; ?>"></td>
						</tr>
<!--
						<input type="hidden" name="ICCID<? echo $counter; ?>" id="ICCID<? echo $counter; ?>" value="">
						<input type="hidden" name="IMEI<? echo $counter; ?>" id="IMEI<? echo $counter; ?>" value="">
						<input type="hidden" name="PlanID<? echo $counter; ?>" id="PlanID<? echo $counter; ?>" value="">
						<input type="hidden" name="RequestAreaCode<? echo $counter; ?>" id="RequestAreaCode<? echo $counter; ?>" value="">
						<input type="hidden" name="User<? echo $counter; ?>" id="User<? echo $counter; ?>" value="">
-->
						<input type="hidden" name="ShipSIMCard<? echo $counter; ?>a" id="ShipSIMCard<? echo $counter; ?>a" value="No">
						<?
						}
						?>
						<script>
							// set all the SIM fields to their default value, based on selected choice
//							getSIMs();
						</script>
						<tr>
							<td colspan="6" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
						</tr>
						</table>

						</div>

						<div id="GSMDataVoice" style="position:static; visibility:<? echo iif($voice_selected == true, 'visible;', 'hidden; display:none;'); ?>">

						<?
						$query = "SELECT * FROM plans WHERE carrier = '".$order['carrier']."' AND plan_type = 'D' AND display = 'T' ORDER BY display_order ASC";
						$rs_dataplans = mysql_query($query, $linkID);
						$query = "SELECT * FROM plans WHERE carrier = '".$order['carrier']."' AND plan_type = 'V' AND display = 'T' ORDER BY display_order ASC";
						$rs_voiceplans = mysql_query($query, $linkID);
						?>
						<table border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
						<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
							<td height="25" align="center"><img src="images/spacer.gif" alt="" width="50" height="1" border="0"><br>Device</td>
							<td align="center"><img src="images/spacer.gif" alt="" width="154" height="1" border="0"><br>SIM Card Number</td>
							<td align="center"><img src="images/spacer.gif" alt="" width="114" height="1" border="0"><br>IMEI Number</td>
							<td align="center"><img src="images/spacer.gif" alt="" width="390" height="1" border="0"><br>Data Plan</td>
							<td align="center"><img src="images/spacer.gif" alt="" width="80" height="1" border="0"><br>Requested <nobr>Area Code</nobr></td>
							<td align="center"><img src="images/spacer.gif" alt="" width="98" height="1" border="0"><br>User Name</td>
						</tr>
<!--						<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
							<td height="25" width="50" align="center">Device</td>
							<td width="160" align="center">SIM Card Number</td>
							<td width="120" align="center">IMEI Number</td>
							<td width="390" align="center">Data Plan</td>
							<td width="80" align="center">Requested <nobr>Area Code</nobr></td>
							<td width="100" align="center">User Name</td>
						</tr>-->
						<?
						for ($counter=1; $counter <= $order['device_count']; $counter++){
						?>
						<tr bgcolor="<? echo $box_bgcolor; ?>" class="bodyBlack">
							<?
							// Align numeric values centered but decimal tabbed based on length of highest number
							if ($order['device_count'] < 10){  // 1 digit
								echo'
							<td height="58" rowspan="2" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.$counter.'</strong></td>
								';
							}elseif ($order['device_count'] > 9 && $order['device_count'] < 100){  // 2 digits
								echo'
							<td height="58" rowspan="2" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*","&nbsp; ",str_pad($counter,2,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}else{  // 3 digits (999 max)
								echo'
							<td height="58" rowspan="2" align="center" bgcolor="'.$rowlabel_bgcolor.'" style="background-image:url(images/XRadioButtonBG.gif);" class="bodyWhite"><strong>'.str_replace("*"," &nbsp; ",str_pad($counter,3,"*",STR_PAD_LEFT)).'</strong></td>
								';
							}
							?>
							<td align="center"><input type="text" name="ICCID<? echo $counter; ?>b" id="ICCID<? echo $counter; ?>b" size="20" maxlength="20" style="width:145px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $ICCID[$counter]; ?>"> <!-- 20 digits decimal --></td>
							<td align="center"><input type="text" name="IMEI<? echo $counter; ?>b" id="IMEI<? echo $counter; ?>b" size="15" maxlength="15" style="width:105px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $IMEI[$counter]; ?>"> <!-- 15 digits decimal --></td>
							<td align="center">
								<select name="PlanID<? echo $counter; ?>b" id="PlanID<? echo $counter; ?>b" class="bodyBlack" style="width:380px; background-color: <? echo $form_bgcolor; ?>;" onChange="popPlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>','b');">
									<option value="">Select</option>
							<?
							mysql_data_seek($rs_dataplans, 0);
							for ($plan_counter=1; $plan_counter <= mysql_num_rows($rs_dataplans); $plan_counter++){
								$row = mysql_fetch_assoc($rs_dataplans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if (!$skipit){
							?>
									<option value="<? echo $row["plan_id"]; ?>"<? if($PlanID[$counter]==$row["plan_id"]) echo " selected";?>><? echo $row["plan_name"]; ?> - <? echo $row["quantity"]." ($".$row["cost"]; ?>)</option>
							<?
								}
							};
							?>
								</select>
							</td>
							<td align="center"><input type="text" name="RequestAreaCode<? echo $counter; ?>b" id="RequestAreaCode<? echo $counter; ?>b" size="15" maxlength="50" class="bodyBlack" style="width:70px; background-color:<? echo $form_bgcolor; ?>;" onChange="popACs('<? echo $counter; ?>','<? echo $order['device_count']; ?>','b');" value="<? echo $RequestAreaCode[$counter]; ?>"></td>
							<td align="center"><input type="text" name="User<? echo $counter; ?>b" id="User<? echo $counter; ?>b" size="15" maxlength="50" class="bodyBlack" style="width:88px; background-color:<? echo $form_bgcolor; ?>;" value="<? echo $User[$counter]; ?>"></td>
						</tr>
						<tr>
							<td align="right" colspan="2" bgcolor="<? echo $rowlabel_bgcolor; ?>" class="bodyWhite">Please Select a Voice Plan for Device <? echo $counter; ?>:&nbsp;</td>						
							<td align="center" colspan="3" bgcolor="<? echo $box_bgcolor; ?>" class="bodyBlack">
								<select name="VoicePlanID<? echo $counter; ?>b" id="VoicePlanID<? echo $counter; ?>b" class="bodyBlack" style="width:564px; background-color: <? echo $form_bgcolor; ?>;" onChange="popVoicePlans('<? echo $counter; ?>','<? echo $order['device_count']; ?>','b');">
									<option value="">Select</option>
									<option value="None"<? if($VoicePlanID[$counter]=="None") echo " selected";?>>No Voice Plan for This Device</option>
							<?
							mysql_data_seek($rs_voiceplans, 0);
							for ($plan_counter=1; $plan_counter <= mysql_num_rows($rs_voiceplans); $plan_counter++){
								$row = mysql_fetch_assoc($rs_voiceplans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if (!$skipit){
							?>
									<option value="<? echo $row["plan_id"]; ?>"<? if($VoicePlanID[$counter]==$row["plan_id"]) echo " selected";?>><? echo $row["plan_name"]; ?> - <? echo $row["quantity"]." ($".$row["cost"]; ?>)</option>
							<?
								}
							};
							?>
								</select>
							</td>
<!--							<td colspan="2" bgcolor="<? echo $box_bgcolor; ?>">&nbsp;</td>-->
						</tr>
						<input type="hidden" name="ICCID<? echo $counter; ?>" id="ICCID<? echo $counter; ?>" value="">
						<input type="hidden" name="IMEI<? echo $counter; ?>" id="IMEI<? echo $counter; ?>" value="">
						<input type="hidden" name="PlanID<? echo $counter; ?>" id="PlanID<? echo $counter; ?>" value="">
						<input type="hidden" name="RequestAreaCode<? echo $counter; ?>" id="RequestAreaCode<? echo $counter; ?>" value="">
						<input type="hidden" name="User<? echo $counter; ?>" id="User<? echo $counter; ?>" value="">
						<input type="hidden" name="VoicePlanID<? echo $counter; ?>" id="VoicePlanID<? echo $counter; ?>" value="">
						<input type="hidden" name="ShipSIMCard<? echo $counter; ?>b" id="ShipSIMCard<? echo $counter; ?>b" value="No">
						<?
						}
						?>
						<script>
							// set all the SIM fields to their default value, based on selected choice
							getSIMs();
						</script>
						<tr>
							<td colspan="6" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
						</tr>
						</table>

						</div>

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
								<input type="button" value="&raquo; Add More Devices &laquo;" style="width:190px;" onClick="popMore();">
							</td>
							<td width="690" height="50">
								<!-- Put finished button in it's own layer so it can be swapped out -->
								<div id="FinishedButton" style="position:static; z-index:1; visibility:visible;">
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
									document.PlanForm.sec.value = "activate";
									document.PlanForm.step.value = "select";
									document.PlanForm.task.value = "addmore";
									document.PlanForm.action = '/saveit.php';
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
										<input type="button" value="Add" style="width:40px;" class="bodyBlack" onClick="pushMore();">
									</td>
									<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
									<td>
										<a href="javascript:void(0);" onMouseOver="javascript:window.status='';return true;" onClick="popFinished();" class="smallBlack">Whoops, I don't want to add any more.</a>
									</td>
								</tr>
								</table>
								</div>
							</td>
						</tr>
						</table>
					<?
					// AT&T Plans
					if ($order['carrier'] == "at&t"){
					?>
						<table width="900" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
						</tr>
						</table>
						<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>

						<div id="AT&TDataPlans" style="position:static; visibility:visible;">

						<table id="at&tDataPlansTable" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<script>
								// show layer with voice plans
								function popVoice(){
									hide('AT&TDataPlans');
									show('AT&TVoicePlans');
								}
								</script>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="xbigBlack">AT&T Data Plans:<br></td>
									<td align="right" valign="top">
										<?
										if ($cingular_voice_plans == "T"){
											echo'
										<input type="button" value="&raquo; Show Voice Plans &laquo;" style="width:190px;" onClick="popVoice();">
										<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
											';
										}
										?>
									</td>
								</tr>
								</table>
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
							<td></td>
							';
						}
						?>
						</tr>
						<tr>
							<td align="right" class="bodyBlack"><strong><em>*Pricing Note - Any negotiated contract pricing will apply retroactively once activated</em></strong><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td width="930" height="15">
							<?
							$query = "SELECT * FROM plans WHERE carrier = 'AT&T' AND plan_type = 'D' AND display = 'T' ORDER BY display_order ASC";
							$rs_plans = mysql_query($query, $linkID);
							echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td align="center">Plan Name</td>
									<td align="center">Included<br>Data</td>
									<td align="center">Additional<br>Data</td>
									<td align="center">Canadian<br>Data</td>
									<td align="center">Mexican<br>Data</td>
									<td align="center">Cost<br>&nbsp;&nbsp;per Month*</td>
								</tr>
							';
							$showtwoyear = false;
							for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
								$twoyear = false;
								$row = mysql_fetch_assoc($rs_plans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if ($row["commitment"] == "2"){
									$twoyear = true;
									$showtwoyear = true;
								}
								if (!$skipit){
									if ($row["add_unit_cost"] == 0){
										$add_unit_cost = "N/A";
									}else{
										$add_unit_cost = '$'.money_format('%.4i', $row["add_unit_cost"]).'/KB';
									}
									if ($row["add_cdn_cost"] == 0){
										$add_cdn_cost = "N/A";
									}else{
										$add_cdn_cost = '$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB';
									}
									if ($row["add_mx_cost"] == 0){
										$add_mx_cost = "N/A";
									}else{
										$add_mx_cost = '$'.money_format('%.4i', $row["add_mx_cost"]).'/KB';
									}
									echo'
								<tr bgcolor="'.$box_bgcolor.'" onMouseOver="show(\'Plan'.$row["plan_id"].'Div\');" onMouseOut="hide(\'Plan'.$row["plan_id"].'Div\');" class="bodyBlack">
									<td height="25" align="left" style="padding-left: 5px">
										<div id="container" style="position:relative; align:left; z-index:0; display:block;">
											<!-- Plan Detail Balloon -->
											<div id="Plan'.$row["plan_id"].'Div" style="position:absolute; top:-16; left:50; z-index:1; width:350px; background-color:#FFFFFF; border: thin solid '.$border_bgcolor.'; padding:5px; visibility:hidden">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
												<tr>
													<td><strong>'.$row["plan_name"].'</strong></td>
												</tr>
												<tr>
													<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
												</tr>
												<tr>
													<td>'.$row["description"].'</td>
												</tr>
												</table>
											</div>
										</div>
										'.$row["plan_name"].'
									</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center">'.$add_unit_cost.'</td>
									<td align="center">'.$add_cdn_cost.'</td>
									<td align="center">'.$add_mx_cost.'</td>
									<td align="center">'.iif($twoyear, "&nbsp;&nbsp;", "").'$'.money_format('%i', $row["cost"]).iif($twoyear, "&dagger;", "").'</td>
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
						
						</div>

						<div id="AT&TVoicePlans" style="position:static; visibility:hidden; display:none;">

						<table id="at&tVoicePlansTable" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								<script>
								// show layer with voice plans
								function popData(){
									hide('AT&TVoicePlans');
									show('AT&TDataPlans');
								}
								</script>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="xbigBlack">AT&T Voice Plans:<br></td>
									<td align="right" valign="top">
										<input type="button" value="&raquo; Show Data Plans &laquo;" style="width:190px;" onClick="popData();">
										<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									</td>
								</tr>
								</table>
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
							<td></td>
							';
						}
						?>
						</tr>
						<tr>
							<td align="right" class="bodyBlack"><strong><em>*Pricing Note - Any negotiated contract pricing will apply retroactively once activated</em></strong><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td width="930" height="15">
							<?
							if ($order["acct_type"] == "IL"){
								$query = "SELECT * FROM plans WHERE carrier = 'AT&T' AND plan_type = 'V' AND (audience = 'IL' OR audience = 'ALL') AND display = 'T' ORDER BY display_order ASC";
							}elseif ($order["acct_type"] == "CL"){
								$query = "SELECT * FROM plans WHERE carrier = 'AT&T' AND plan_type = 'V' AND (audience = 'CL' OR audience = 'ALL') AND display = 'T' ORDER BY display_order ASC";
							}
							$rs_plans = mysql_query($query, $linkID);
							echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td align="center">Plan Name</td>
									<td align="center">Included<br>Minutes</td>
									<td align="center">Additional<br>Minutes</td>
									<td align="center">Cost<br>&nbsp;&nbsp;per Month*</td>
								</tr>
							';
							$showtwoyear = false;
							for ($counter=1; $counter <= mysql_num_rows($rs_plans); $counter++){
								$twoyear = false;
								$row = mysql_fetch_assoc($rs_plans);
								// Should we not offer this plan on this site?
								$skipit = false;
								for ($x=0; $x <= count($plans_exclude)-1; $x++){
									if ($row["plan_id"] == $plans_exclude[$x]){
										$skipit = true;
									}
								}
								if ($row["commitment"] == "2"){
									$twoyear = true;
									$showtwoyear = true;
								}
								if (!$skipit){
									if ($row["add_unit_cost"] == 0){
										$add_unit_cost = "N/A";
									}else{
										$add_unit_cost = '$'.money_format('%.4i', $row["add_unit_cost"]).'/Minute';
									}
//									if ($row["add_cdn_cost"] == 0){
//										$add_cdn_cost = "N/A";
//									}else{
//										$add_cdn_cost = '$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB';
//									}
//									if ($row["add_mx_cost"] == 0){
//										$add_mx_cost = "N/A";
//									}else{
//										$add_mx_cost = '$'.money_format('%.4i', $row["add_mx_cost"]).'/KB';
//									}
									echo'
								<tr bgcolor="'.$box_bgcolor.'" onMouseOver="show(\'Plan'.$row["plan_id"].'Div\');" onMouseOut="hide(\'Plan'.$row["plan_id"].'Div\');" class="bodyBlack">
									<td height="25" align="left" style="padding-left: 5px">
										<div id="container" style="position:relative; align:left; z-index:0; display:block;">
											<!-- Plan Details Balloon -->
											<div id="Plan'.$row["plan_id"].'Div" style="position:absolute; top:-16; left:50; z-index:1; width:350px; background-color:#FFFFFF; border: thin solid '.$border_bgcolor.'; padding:5px; visibility:hidden">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
												<tr>
													<td><strong>'.$row["plan_name"].'</strong></td>
												</tr>
												<tr>
													<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
												</tr>
												<tr>
													<td>'.$row["description"].'</td>
												</tr>
												</table>
											</div>
										</div>
										'.$row["plan_name"].'
									</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center">'.$add_unit_cost.'</td>
<!--									<td align="center">'.$add_cdn_cost.'</td>-->
<!--									<td align="center">'.$add_mx_cost.'</td>-->
									<td align="center">'.iif($twoyear, "&nbsp;&nbsp;", "").'$'.money_format('%i', $row["cost"]).iif($twoyear, "&dagger;", "").'</td>
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

						</div>
						
						<table width="900" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td class="smallBlack"><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><em><strong>Point at Plan for Additional Details</strong></em></td>
							<td height="20" align="right" class="smallBlack"><em>* With 1-Year Commitment Unless Otherwise Noted. Any negotiated contract pricing will apply retroactively once activated.</em><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><? echo iif($showtwoyear, '<br><em>&dagger; Specially Priced Plan, 2-Year Commitment Required</em><img src="images/spacer.gif" alt="" width="8" height="1" border="0">', ''); ?></td>
						</tr>
						</table>
						<br>
					<?
					}
					?>
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
	<input type="hidden" name="site" id="site" value="<? echo $site; ?>">
	<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
	<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
	<input type="hidden" name="Discount" id="Discount" value="<? echo $order['plan_discount'] ?>">
	<input type="hidden" name="locked" id="locked" value="T">
<!--<input type="hidden" name="dev" id="dev" value="T">-->
	</form>
</tr>
</table>

<?
//////////////////////////////////////////////////////////////////////
}elseif ($step == "account"){
?>
	<!-- SSL Site Seal -->
	<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

	<?
	if ($order['carrier'] == "at&t"){
		$carrier = "AT&T";
		// Get first device's ship_sim_card value
		$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
		$rs_devices = mysql_query($query, $linkID);
		$device = mysql_fetch_assoc($rs_devices);
		$ShipSIMCard = $device["ship_sim_card"];
	}else{
		// Set carrier name (capitalized)
		$carrier = ucwords($order['carrier']);
		$ShipSIMCard = "";
	}
	// Build account type string
	$sAcctType = "";
	if ($order['add_line'] == "No") $sAcctType .= "New ";
	if ($order['add_line'] == "Yes") $sAcctType .= "Existing ";
	if ($order['acct_type'] == "CL") $sAcctType .= "Business ";
	if ($order['acct_type'] == "IL") $sAcctType .= "Personal ";
	$rowcount = 0;
	// Alternating row background colors
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
		// Verify Years in Business
		if (theForm.years_in_business){
			if (theForm.years_in_business.value == ""){
				theForm.years_in_business.style.background="#FF0000";
				alert("Please Enter How Many Years The Business Has Existed");
				theForm.years_in_business.style.background="#FFFFFF";
				theForm.years_in_business.focus();
				return false;
			}
		}
		<?
		if ($carrier =="Sprint"){
		?>
		// Verify Account Password
//		if (theForm.acct_password){
//			var pin_regex = /^[1-9]\d{9}$/;  // nnnnnn
//			if (pin_regex.test(theForm.acct_password.value) == false){
//				theForm.acct_password.style.background="#FF0000";
//				alert("Please Enter A Ten Digit PIN Number");
//				theForm.acct_password.style.background="#FFFFFF";
//				theForm.acct_password.focus();
//				return false;
//			}
//		}
		<?
		}
		?>
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
		// Verify Order Placer Name
		if (theForm.order_placer_name){
			if (theForm.order_placer_name.value == ""){
				theForm.order_placer_name.style.background="#FF0000";
				alert("Please Enter The Authorized Order Placer's Name");
				theForm.order_placer_name.style.background="#FFFFFF";
				theForm.order_placer_name.focus();
				return false;
			}
		}
		// Verify Order Placer Title
		if (theForm.order_placer_title){
			if (theForm.order_placer_title.value == ""){
				theForm.order_placer_title.style.background="#FF0000";
				alert("Please Enter The Authorized Order Placer's Title/Position");
				theForm.order_placer_title.style.background="#FFFFFF";
				theForm.order_placer_title.focus();
				return false;
			}
		}
		// Order Placer Phone Number
		if (theForm.order_placer_phone){
			if (theForm.order_placer_phone.value == ""){
				theForm.order_placer_phone.style.background="#FF0000";
				alert("Please Enter The Authorized Order Placer's Phone Number");
				theForm.order_placer_phone.style.background="#FFFFFF";
				theForm.order_placer_phone.focus();
				return false;
			}
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.order_placer_phone.value) == false && phone2_regex.test(theForm.order_placer_phone.value) == false) { 
				theForm.order_placer_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.order_placer_phone.style.background="#FFFFFF";
				theForm.order_placer_phone.focus();
				return false;
			}
		}
		// Order Placer Email Address
		if (theForm.order_placer_email){
			if (theForm.order_placer_email.value == ""){
				theForm.order_placer_email.style.background="#FF0000";
//				theForm.order_placer_email_confirm.style.background="#FF0000";
				alert("Please Enter the Authorized Order Placer's Email Address");
				theForm.order_placer_email.style.background="#FFFFFF";
//				theForm.order_placer_email_confirm.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for "@"
	 		if (theForm.order_placer_email.value.indexOf("@") == -1) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Must Contain an "@"');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for "@" as first char.
	 		if (theForm.order_placer_email.value.indexOf("@") == 0) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "@"');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for anything after "@"
	 		if (theForm.order_placer_email.value.length == (theForm.order_placer_email.value.indexOf("@")+1)) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Must Contain a Domain Name After the "@"');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for multiple "@"
	 		if (theForm.order_placer_email.value.substring((theForm.order_placer_email.value.indexOf("@")+1),theForm.order_placer_email.value.length).indexOf("@") != -1) {
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Must Contain Only One "@"');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for "."
	 		if (theForm.order_placer_email.value.indexOf(".") == -1) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Must Contain a "."');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for "." as first char.
	 		if (theForm.order_placer_email.value.indexOf(".") == 0) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "."');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for ".."
	 		if (theForm.order_placer_email.value.indexOf("..") != -1) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots ("..")');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for "." adjacent to "@"
	 		if (theForm.order_placer_email.value.indexOf(".@") != -1 || theForm.order_placer_email.value.indexOf("@.") != -1) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for TLD
	 		if (theForm.order_placer_email.value.length == (theForm.order_placer_email.value.indexOf(".")+1)) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for TLD at least 2 char.
			var domain = theForm.order_placer_email.value.substring((theForm.order_placer_email.value.indexOf("@")+1),theForm.order_placer_email.value.length);
			if (domain.length - (domain.indexOf(".")+1) < 2) {
				theForm.order_placer_email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for TLD over 3 char.
//			if (domain.length - (domain.indexOf(".")+1) > 3) {
//				theForm.order_placer_email.style.background="#FF0000";
//				alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//				theForm.order_placer_email.style.background="#FFFFFF";
//				theForm.order_placer_email.focus();
//				return false;
//			}
			// Check for "_" in TLD
			if (theForm.order_placer_email.value.indexOf("_") > theForm.order_placer_email.value.indexOf("@")) {
				theForm.order_placer_email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for spaces
	 		if (theForm.order_placer_email.value.indexOf(" ") != -1) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Spaces (" ")');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
			// Check for illegal char.
			var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	 		if (email_regex.test(theForm.order_placer_email.value) == false) { 
				theForm.order_placer_email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
				theForm.order_placer_email.style.background="#FFFFFF";
				theForm.order_placer_email.focus();
				return false;
			}
//			if (theForm.order_placer_email.value != theForm.order_placer_email_confirm.value){
//				theForm.order_placer_email.style.background="#FF0000";
//				theForm.order_placer_email_confirm.style.background="#FF0000";
//				alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
//				theForm.order_placer_email.style.background="#FFFFFF";
//				theForm.order_placer_email_confirm.style.background="#FFFFFF";
//				theForm.order_placer_email.focus();
//				return false;
//			}
		}
		// Verify Verizon MAA On File
		if (theForm.maa_on_file){
			if (theForm.maa_on_file.value == ""){
				theForm.maa_on_file.style.background="#FF0000";
				alert("Please Select Yes, No, or Unknown If You Are Not Certain");
				theForm.maa_on_file.style.background="#FFFFFF";
				theForm.maa_on_file.focus();
				return false;
			}
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
		<?
		if ($carrier =="Sprint"){
		?>
		// Verify Primary Wireless Phone Number and/or Account Number
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
		// Verify Carrier Phone Number Format
//		if (theForm.wireless_phone){
//			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
//			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
//			if (theForm.wireless_phone.value != "" && phone1_regex.test(theForm.wireless_phone.value) == false && phone2_regex.test(theForm.wireless_phone.value) == false) { 
//				theForm.wireless_phone.style.background="#FF0000";
//				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
//				theForm.wireless_phone.style.background="#FFFFFF";
//				theForm.wireless_phone.focus();
//				return false;
//			}
//		}
		// Verify Account Number
//		if (theForm.acct_number){
//			if (theForm.acct_number.value == ""){
//				theForm.acct_number.style.background="#FF0000";
//				alert("Please Enter The Account Number");
//				theForm.acct_number.style.background="#FFFFFF";
//				theForm.acct_number.focus();
//				return false;
//			}
//		}
		<?
			if ($order['add_line'] == "No"){
		?>
		// Verify Security Question Selected
		if (theForm.security_question){
			if (theForm.security_question.value == ""){
				theForm.security_question.style.background="#FF0000";
				theForm.security_answer.style.background="#FF0000";
				alert("Please Select A Security Question And Enter A Private Answer");
				theForm.security_question.style.background="#FFFFFF";
				theForm.security_answer.style.background="#FFFFFF";
				theForm.security_question.focus();
				return false;
			}
		}
		// Verify Security Question Selected If Account Password NOT Entered (They Checked "I Do Not Have A PIN")
		if (theForm.security_question){
			if (theForm.security_question.value == "" && theForm.no_pin.checked){
				theForm.security_question.style.background="#FF0000";
				theForm.security_answer.style.background="#FF0000";
				alert("Please Select A Security Question And Enter A Private Answer");
				theForm.security_question.style.background="#FFFFFF";
				theForm.security_answer.style.background="#FFFFFF";
				theForm.security_question.focus();
				return false;
			}
		}
		// Verify Security Answer
		if (theForm.security_answer){
			if (theForm.security_answer.value == ""){
				theForm.security_answer.style.background="#FF0000";
				alert("Please Enter A Private Security Answer");
				theForm.security_answer.style.background="#FFFFFF";
				theForm.security_answer.focus();
				return false;
			}
		}
		// Verify Account Password
		if (theForm.acct_password){
//			if (theForm.no_pin.checked == false){
//				if (theForm.acct_password.value != ""){
//					var pin_regex = /^[1-9]\d{9}$/;  // nnnnnnnnnn
//					if (pin_regex.test(theForm.acct_password.value) == false){
				if (theForm.acct_password.value.length < 6 || theForm.acct_password.value.length > 10){ // 6 to 10 digits
						theForm.acct_password.style.background="#FF0000";
						alert("Please Enter A Six to Ten Digit PIN Number");
						theForm.acct_password.style.background="#FFFFFF";
						theForm.acct_password.focus();
						return false;
//					}
				}
//			}
		}
		<?
			}else{
		?>
		// Verify Security Question Selected OR Account Password Entered
		if (theForm.security_question){
			if (theForm.security_question.value == "" && theForm.acct_password.value == ""){
				theForm.security_question.style.background="#FF0000";
				theForm.security_answer.style.background="#FF0000";
				theForm.acct_password.style.background="#FF0000";
				alert("Please Select A Security Question And Enter A Private Answer OR Enter The Account Password");
				theForm.security_question.style.background="#FFFFFF";
				theForm.security_answer.style.background="#FFFFFF";
				theForm.acct_password.style.background="#FFFFFF";
				theForm.security_question.focus();
				return false;
			}
		}
		// Verify Security Question Selected If Account Password NOT Entered (They Checked "I Do Not Have A PIN")
		if (theForm.security_question){
			if (theForm.security_question.value == "" && theForm.no_pin.checked){
				theForm.security_question.style.background="#FF0000";
				theForm.security_answer.style.background="#FF0000";
				alert("Please Select A Security Question And Enter A Private Answer");
				theForm.security_question.style.background="#FFFFFF";
				theForm.security_answer.style.background="#FFFFFF";
				theForm.security_question.focus();
				return false;
			}
		}
		// Verify Security Answer
		if (theForm.security_answer){
			if (theForm.security_question.value != "" && theForm.acct_password.value == "" && theForm.security_answer.value == ""){
				theForm.security_answer.style.background="#FF0000";
				alert("Please Enter A Private Security Answer");
				theForm.security_answer.style.background="#FFFFFF";
				theForm.security_answer.focus();
				return false;
			}
		}
		// Verify Account Password
		if (theForm.acct_password){
			if (theForm.no_pin.checked == false){
//				if (theForm.acct_password.value != ""){
//					var pin_regex = /^[1-9]\d{9}$/;  // nnnnnnnnnn
//					if (pin_regex.test(theForm.acct_password.value) == false){
				if (theForm.acct_password.value.length < 6 || theForm.acct_password.value.length > 10){ // 6 to 10 digits
						theForm.acct_password.style.background="#FF0000";
						alert("Please Enter A Six to Ten Digit PIN Number");
						theForm.acct_password.style.background="#FFFFFF";
						theForm.acct_password.focus();
						return false;
//					}
				}
			}
		}
		// Verify Account Password
// no need to test - already tested above
//		if (theForm.acct_password){
//			if (theForm.acct_password.value == ""){
//				theForm.acct_password.style.background="#FF0000";
//				alert("Please Enter The Account Password");
//				theForm.acct_password.style.background="#FFFFFF";
//				theForm.acct_password.focus();
//				return false;
//			}
//		}
		<?
			}
		?>
		<?
		}elseif ($carrier =="Verizon"){
		?>
		// Verify Carrier Phone Number Format
		if (theForm.wireless_phone){
			if (theForm.wireless_phone.value == ""){
				theForm.wireless_phone.style.background="#FF0000";
				alert("Please Enter Any Wireless Number on This Account");
				theForm.wireless_phone.style.background="#FFFFFF";
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
		// Verify Account Number
		if (theForm.acct_number){
			if (theForm.acct_number.value == ""){
				theForm.acct_number.style.background="#FF0000";
				alert("Please Enter The Account Number");
				theForm.acct_number.style.background="#FFFFFF";
				theForm.acct_number.focus();
				return false;
			}
		}
		<?
		}else{
		?>
		// Verify Primary Wireless Phone Number and/or Account Number
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
		<?
//			if ($order['add_line'] == "No"){
		?>
		// Verify Account Password
//		if (theForm.acct_password){
//			if (theForm.acct_password.value == ""){
//				theForm.acct_password.style.background="#FF0000";
//				alert("Please Enter The Account Password You Want For This New Account");
//				theForm.acct_password.style.background="#FFFFFF";
//				theForm.acct_password.focus();
//				return false;
//			}
//		}
		<?
//			}
		?>
		<?
		}
		?>
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
		// Verify Sales Rep
		if (theForm.sales_rep){
			if (theForm.sales_rep.value == ""){
				theForm.sales_rep.style.background="#FF0000";
				alert('Please Select Your Sales Rep or "Unknown" If You Don\'t Have One')
				theForm.sales_rep.style.background="#FFFFFF";
				theForm.sales_rep.focus();
				return false;
			}
		}
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

	function CopyBillingContact(){
		AcctInfo.order_placer_name.value = AcctInfo.billing_name.value;
		AcctInfo.order_placer_phone.value = AcctInfo.billing_phone.value;
		AcctInfo.order_placer_email.value = AcctInfo.billing_email.value;
		return;
	}

	function CopyOrderContact(){
		AcctInfo.order_placer_name.value = AcctInfo.contact_name.value;
		AcctInfo.order_placer_phone.value = AcctInfo.contact_phone.value;
		AcctInfo.order_placer_email.value = AcctInfo.contact_email.value;
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
								<td valign="top" class="superbigBlack">Activate with <? echo $familiar_name; ?></td>
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
			<form action="saveit.php" method="POST" name="AcctInfo" id="AcctInfo">
			<tr>
				<td align="center">
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
					<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
						<td height="25" align="center"><? echo iif($order['acct_type'] == "IL" && $order['add_line'] == "No", 'Billing &amp; Shipping', 'Account'); ?> Information</td>
					</tr>
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
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
								<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Company Name:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="650">
											<input type="text" name="company_name" id="company_name" size="75" maxlength="100" tabindex="4" class="bodyBlack" style="width:504px; background-color: <? echo $form_bg; ?>" value="<? echo $order['company_name']; ?>">
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<?
//								if ($order['add_line'] == "No"){
							//	if ($order['carrier'] == "verizon" || $order['carrier'] == "sprint"){
//								if ($order['carrier'] == "verizon"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); if($order['carrier'] != "sprint") $rowcount++; ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Tax ID (TIN/FEIN):</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="195" valign="top"><input type="text" name="tax_id" id="tax_id" size="30" maxlength="50" tabindex="5" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['tax_id']; ?>"></td>
										<?
										if ($order['carrier'] == "verizon"){
										?>
										<td width="605" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="20" height="1" border="0">Years In Business:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="years_in_business" id="years_in_business" size="5" maxlength="3" tabindex="6" onKeyPress="return onlyNumbers(event,this);" class="bodyBlack" style="width:50px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['years_in_business']; ?>"></td>
										<?
										}else{
										?>
										<td width="605">&nbsp;</td>
										<?
										}
										?>
									</tr>
									</table>
								</td>
							</tr>
							<?
//									if ($order['carrier'] == "sprint"){
							?>
<!--							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br><? echo $carrier; ?> Password:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="650" valign="top">
											<input type="text" name="acct_password" id="acct_password" size="30" maxlength="50" tabindex="7" onKeyPress="return onlyNumbers(event,this);" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['password']; ?>"><span class="smallBlack"> *Must be a Ten Digit Number<br>Enter Desired Password/PIN</span></td>
									</tr>
									</table>
								</td>
							</tr>-->
							<?
//									}
							?>
							<?
							//	}else{
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
							</tr>
							<?
							//	}
							?>
							<?
							}
							?>
							<?
//							if ($order['add_line'] == "No"){
							if ($order['carrier'] == "at&t" && $ShipSIMCard == "Yes"){
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
										<td width="450"><input type="text" name="ship_zipcode" id="ship_zipcode" size="10" maxlength="10" tabindex="12" class="bodyBlack" style="width:97px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['ship_zipcode']; ?>"><br><span class="smallBlack">Zip Code</span></td>
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
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Address:<?echo iif($ShipSIMCard == "Yes", '<br><span class="smallBlack"><a href="javascript:CopyShipToUse();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Shipping Address Here</strong></a></span>', ''); ?></td>
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
										<td width="450"><input type="text" name="bill_zipcode" id="bill_zipcode" size="10" maxlength="10" tabindex="17" class="bodyBlack" style="width:97px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['bill_zipcode']; ?>"><br><span class="smallBlack">Zip Code</span></td>
									</tr>
									</table>
								</td>
							</tr>
							<?
							}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Service Address:<?echo iif($ShipSIMCard == "Yes", '<br><span class="smallBlack"><a href="javascript:CopyShipToUse();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Shipping Address Here</strong></a></span>', ''); ?><? echo iif($order['add_line'] == "No", '<br><span class="smallBlack"><a href="javascript:CopyBillToUse();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Billing Address Here</strong></a></span>', ''); ?></td>
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
										<td width="450"><input type="text" name="service_zipcode" id="service_zipcode" size="10" maxlength="10" tabindex="22" class="bodyBlack" style="width:97px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['service_zipcode']; ?>"><br><span class="smallBlack">Zip Code</span></td>
									</tr>
									</table>
								</td>
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
								if ($order['carrier'] == "verizon"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Main Point of Contact:<? echo iif($order['add_line'] == "No", '<br><span class="smallBlack"><a href="javascript:CopyBillingContact();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Billing Contact Here</strong></a></span><br><span class="smallBlack"><a href="javascript:CopyOrderContact();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Order Contact Here</strong></a></span>', '<br><span class="smallBlack"><a href="javascript:CopyOrderContact();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Order Contact Here</strong></a></span>'); ?></td>
								<td width="650">
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td colspan="2">
											<input type="text" name="order_placer_name" id="order_placer_name" size="30" maxlength="100" tabindex="40" class="bodyBlack" style="width:405px; background-color: <? echo $form_bg; ?>" value="<? echo $order['order_placer_name']; ?>"><span class="smallBlack"> *Contact of Record on Account</span>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<input type="text" name="order_placer_title" id="order_placer_title" size="30" maxlength="100" tabindex="41" class="bodyBlack" style="width:405px; background-color: <? echo $form_bg; ?>" value="<? echo $order['order_placer_title']; ?>"><br><span class="smallBlack">Title/Position</span>
										</td>
									</tr>
									<tr>
										<td width="195"><input type="text" name="order_placer_phone" id="order_placer_phone" size="19" maxlength="25" tabindex="42" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['order_placer_phone']; ?>"><br><span class="smallBlack">Phone Number</span></td>
										<td width="605" valign="top" class="xbigBlack"><input type="text" name="order_placer_email" id="order_placer_email" size="50" maxlength="50" tabindex="43" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['order_placer_email']; ?>"><br><span class="smallBlack">Email</span></td>
									</tr>
									<tr>
										<td colspan="2" valign="top" class="bbigBlack">
											<trong>Verizon Business Agreement/MAA already on file?</strong><img src="images/spacer.gif" alt="" width="5" height="1" border="0">
											<select name="maa_on_file" id="maa_on_file" tabindex="45" class="bodyBlack" style="width:85px; background-color: <? echo $form_bg; ?>;">
												<option value="">Select</option>
								                <option value="Yes"<? if($order['maa_on_file']=="Yes") echo " selected";?>>Yes</option>
												<option value="No"<? if($order['maa_on_file']=="No") echo " selected";?>>No</option>
												<option value="Unknown"<? if($order['maa_on_file']=="Unknown") echo " selected";?>>Unknown</option>
											</select>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<?
								}
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
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
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
							<?
							if ($order['add_line'] == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++;  ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br><? echo $carrier; ?> Phone Number:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="195" valign="top"><input type="text" name="wireless_phone" id="wireless_phone" size="30" maxlength="50" tabindex="50" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['wireless_phone']; ?>"><span class="smallBlack"><br>Any Number on This Account</span></td>
										<td width="605" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="25" height="1" border="0">Acct#:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="acct_number" id="acct_number" size="30" maxlength="50" tabindex="51" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['acct_number']; ?>"><? echo iif($carrier == 'Verizon', '<span class="smallBlack"> *Required</span>', '<span class="smallBlack"> *Enter Either or Both</span>'); ?></td>
									</tr>
									</table>
								</td>
							</tr>
							<?
								if ($order['carrier'] == "sprint"){
									//Grab the security questions
//									$query = "SELECT * FROM questions WHERE carrier = 'Sprint' AND display = 'T' ORDER BY question";
									$query = "SELECT * FROM questions WHERE carrier = 'Sprint' AND display = 'T'";
									$rs_questions = mysql_query($query, $linkID);
//									$rowcount = 0;
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Security Question:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="195" valign="top">
											<select name="security_question" id="security_question" tabindex="52" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;">
												<option value="">Select</option>
												<?
												for ($counter=1; $counter <= mysql_num_rows($rs_questions); $counter++){
													$question = mysql_fetch_assoc($rs_questions);
													echo'
								                <option value="'.$question['question'].'"'.iif($order["security_question"]==$question['question'], " selected", "").'>'.$question['question'].'</option>
													';
												}
												?>
								                <option value="Unknown"<? if($order["security_question"]=="Unknown") echo " selected";?>>Unknown/Uncertain</option>
											</select>
										</td>
										<td width="605" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="11" height="1" border="0">Answer:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="security_answer" id="security_answer" size="30" maxlength="50" tabindex="53" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['security_answer']; ?>"><? echo iif($carrier == 'Sprint', '<span class="smallBlack"> *Enter Either or Both</span>', '<span class="smallBlack"> *Optional</span>'); ?></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Account PIN:</td>
								<td>
									<script>
									function togglePIN(){
										if (AcctInfo.no_pin.checked){
											AcctInfo.acct_password.value = "Do Not Have/Unknown";
											AcctInfo.acct_password.readOnly = true;
											AcctInfo.acct_password.disabled = true;
											AcctInfo.acct_password.style.color = "#C0C0C0";
										}else{
											AcctInfo.acct_password.value = "";
											AcctInfo.acct_password.readOnly = false;
											AcctInfo.acct_password.disabled = false;
											AcctInfo.acct_password.style.color = "#000000";
											AcctInfo.acct_password.focus();
										}
									}
									</script>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="800" colspan="2" valign="top">
											<input type="text" name="acct_password" id="acct_password" size="30" maxlength="50" tabindex="54" onKeyPress="return onlyNumbers(event,this);" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['password']; ?>"><? echo iif($carrier == 'Sprint', '<span class="smallBlack"> *6 to 10 Digits</span>', '<span class="smallBlack"> *If Applicable</span>'); ?><img src="images/spacer.gif" alt="" width="20" height="1" border="0"><input type="checkbox" name="no_pin" id="no_pin" value="" onClick="togglePIN();">&nbsp;&nbsp;<span class="xbigBlack">I Do Not Have a PIN</span>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<?
								}else{
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td>&nbsp;</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td colspan="2" class="xbigBlack"><img src="images/spacer.gif" alt="" width="81" height="1" border="0">Account Password/PIN:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="acct_password" id="acct_password" size="30" maxlength="50" tabindex="55" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['password']; ?>"><? echo iif($carrier == 'Sprint', '<span class="smallBlack"> *Required</span>', '<span class="smallBlack"> *If Applicable</span>'); ?></td>
									</tr>
									</table>
								</td>
							</tr>
							<?
								}
							?>
							<?
 							}
							?>
							<?
							if ($order['add_line'] == "No"){
							?>
							<?
								if ($order['carrier'] == "sprint"){
									//Grab the security questions
//									$query = "SELECT * FROM questions WHERE carrier = 'Sprint' AND display = 'T' ORDER BY question";
									$query = "SELECT * FROM questions WHERE carrier = 'Sprint' AND display = 'T'";
									$rs_questions = mysql_query($query, $linkID);
//									$rowcount = 0;
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Security Question:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="195" valign="top">
											<select name="security_question" id="security_question" tabindex="56" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;">
												<option value="">Select</option>
												<?
												for ($counter=1; $counter <= mysql_num_rows($rs_questions); $counter++){
													$question = mysql_fetch_assoc($rs_questions);
													echo'
								                <option value="'.$question['question'].'"'.iif($order["security_question"]==$question['question'], " selected", "").'>'.$question['question'].'</option>
													';
												}
												?>
<!--								                <option value="Unknown"<? if($order["security_question"]=="Unknown") echo " selected";?>>Unknown/Uncertain</option>-->
											</select>
										</td>
										<td width="605" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="12" height="1" border="0">Answer:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="security_answer" id="security_answer" size="30" maxlength="50" tabindex="57" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['security_answer']; ?>"><? echo iif($order['add_line'] == "Yes", '<span class="smallBlack"> *Optional</span>', '<span class="smallBlack"> *Required</span>'); ?></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Requested PIN:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="800" colspan="2" valign="top">
											<input type="text" name="acct_password" id="acct_password" size="30" maxlength="50" tabindex="58" onKeyPress="return onlyNumbers(event,this);" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['password']; ?>"><span class="smallBlack"> *6 to 10 Digits Required</span>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<?
								}else{
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Requested Password:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="650">
											<input type="text" name="acct_password" id="acct_password" size="30" maxlength="50" tabindex="59" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['password']; ?>"><? echo iif($order['carrier'] == "at&t", '<span class="smallBlack"> *Optional</span>', '<span class="smallBlack"> *Required</span>'); ?>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<?
								}
							?>
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
					if ($order['acct_type'] == "IL" /*&& $order['add_line'] == "No"*/){
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
										<td><input type="text" name="ssn" id="ssn" size="20" maxlength="11" tabindex="136" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['ssn']; ?>"><span class="smallBlack"> <a onClick="whyssn.style.visibility='visible';" class="smallBlack" style="text-decoration:underline; cursor:pointer;">Why do you need my SSN</a>?<br>Format: 555-55-5555</span></td>
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
										<td><input type="text" name="dob" id="dob" size="30" maxlength="10" tabindex="137" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['dob']; ?>"><span class="smallBlack"> <a onClick="whydob.style.visibility='visible';" class="smallBlack" style="text-decoration:underline; cursor:pointer;">Why do you need my date of birth</a>?<br>Format: mm/dd/yyyy</span></td>
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
										<td><input type="text" name="dl_number" id="dl_number" size="30" maxlength="50" tabindex="138" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;" value="<? echo $order['dl_number']; ?>"></td>
										<td class="xbigBlack">&nbsp;&nbsp;State:<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
											<select name="dl_state" id="dl_state" tabindex="139" class="bodyBlack" style="width:80px; background-color: <? echo $form_bg; ?>;">
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
											<select name="dl_exp_month" id="dl_exp_month" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width:125px;" tabindex="140">
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
											<select name="dl_exp_day" id="dl_exp_day" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width:65px;" tabindex="141">
												<option value="">Day</option>
		<?
		for ($option=1; $option <= 31; $option++){
			echo'
												<option value="'.iif($option<10,"0","").$option.'"'.iif(date("d",$dl_date)==$option,' selected', '').'>'.$option.'</option>
			';
		}
		?>
											</select>
											<select name="dl_exp_year" id="dl_exp_year" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width: 67px;" tabindex="142">
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
					<img src="images/spacer.gif" alt="" width="1" height="25" border="0"><br>
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="<? echo $border_bgcolor; ?>" class="bodyBlack">
					<tr bgcolor="<? echo $border_bgcolor; ?>" class="bodyWhite">
						<td height="25" align="center">Additional Information</td>
					</tr>
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" class="borderNone">
							<?
								if ($show_reps == "T"){
									//Grab the sales reps
									$query = "SELECT * FROM reps WHERE site = '".$site."' AND active = 'T' ORDER BY last_name, first_name";
									$rs_reps = mysql_query($query, $linkID);
									$rowcount = 0;
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td width="<? echo iif($order['acct_type'] == "IL", "250", "215"); ?>" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Sales Representative:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td>
											<select name="sales_rep" id="sales_rep" tabindex="200" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;">
												<option value="">Select</option>
												<?
												for ($counter=1; $counter <= mysql_num_rows($rs_reps); $counter++){
													$rep = mysql_fetch_assoc($rs_reps);
													$rep_name = $rep['first_name']." ".$rep['last_name'];
													echo'
								                <option value="'.$rep_name.'"'.iif($order["sales_rep"]==$rep_name, " selected", "").'>'.$rep_name.' - '.$rep['location'].'</option>
													';
												}
												?>
								                <option value="Unknown"<? if($order['sales_rep']=="Unknown") echo " selected";?>>Unknown/Uncertain</option>
											</select>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<?
								}
								if ($order['carrier'] == "at&t" && $ShipSIMCard == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td width="<? echo iif($order['acct_type'] == "IL", "250", "215"); ?>" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Shipping Options:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td>
											<select name="shipping" id="shipping" tabindex="201" class="bodyBlack" style="width:200px; background-color: <? echo $form_bg; ?>;">
												<option value="">Select</option>
								                <option value="Standard"<? if($order['shipping']=="Standard") echo " selected";?>>Standard for $9.95</option>
								                <option value="Next-Day"<? if($order['shipping']=="Next-Day") echo " selected";?>>Next-Day for $14.95</option>
											</select>
										</td>
										<td valign="top" class="smallBlack">*</td>
										<td class="smallBlack">Note: You will NOT be charged the standard $9.95 shipping fee if you have a business agreement with AT&amp;T.  There is still a charge for Next-Day shipping.</td>
									</tr>
									</table>
								</td>
							</tr>
							<?
								}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td width="<? echo iif($order['acct_type'] == "IL", "250", "215"); ?>" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Additional Information:</td>
								<td>
									<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
									<tr>
										<td>
											<textarea name="notes" id="notes" tabindex="202" rows="4" cols="85" class="bodyBlack" style="width:505px;">
<? echo $order['notes']; ?></textarea> <!-- Leave here for formatting! -->
										</td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
						</td>
					</tr>
<!--					<tr>
						<td colspan="2" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="900" height="2" border="0"></td>
					</tr>-->
					</table>
					<!-- Continue Button -->
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr>
						<td colspan="2" align="center">
							<br>
							<input type="hidden" name="sec" id="sec" value="activate">
							<input type="hidden" name="step" id="step" value="confirm">
							<input type="hidden" name="task" id="task" value="updateorder">
							<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
							<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
							<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
							<input type="hidden" name="sid" value="<? echo $SID; ?>">
							<input type="button" value="&raquo; Proceed to Confirmation &laquo;" style="width:320px;" class="bodyBlack" onClick="validateForm('AcctInfo');">
							<br><br>
						<td>
					</tr>
					</table>
				</td>
			</tr>
			</form>
			
			<!-- Cart Contents -->
			
			<tr>
				<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
			</tr>
			<tr>
				<td align="center">
					<br>
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="xbigBlack">Cart Contents:</td>
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
									document.RemoveForm.task.value = 'removedevice';
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
							$query = "SELECT * FROM orders o, devices d WHERE o.session_id='".$SID."' AND d.session_id='".$SID."' ORDER BY esn, imei";
			//				$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
							$rs_cart = mysql_query($query, $linkID);
							$row = mysql_fetch_assoc($rs_cart);
							$discount = ($row["plan_discount"] * .01);
			//echo $discount;
							mysql_data_seek($rs_cart,0);
							if ($_SESSION['carrier'] == "sprint" || $_SESSION['carrier'] == "verizon"){
								echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td width="60" align="center"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></td>
									<td width="100" height="30" align="center">Device ESN</td>
									<td width="386" align="center">Data Plan Name</td>
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
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td width="55" align="center"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></td>
									<td width="180" height="30" align="center">SIM Card Number</td>
									<td width="135" align="center">Device IMEI</td>
									<td width="336" align="center">Data Plan Name</td>
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
									<td height="30" align="center">'.iif($row["ship_sim_card"] == "Yes", "SIM Card To Be Shipped", $row["iccid"]).'</td>
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
									<td height="30" align="right" colspan="5" bgcolor="'.$box_bgcolor.'" class="bodyBlack"><strong>Estimated* Monthly Total&nbsp;&nbsp;</strong></td>
									<td align="right" bgcolor="'.$box_bgcolor.'" class="bodyBlack"><strong>$'.money_format('%i', ($total-($total*$discount))).'</strong><img src="images/spacer.gif" alt="" width="15" height="1" border="0"></td>
								</tr>
								';
							}
							echo'
							</table>
							';
						?>
							<div align="right"><em class="smallBlack">*Plus Federal, State, and Local taxes & fees.<? echo iif($discount > 0 && $discount < 1, "&nbsp;&nbsp;Prices reflect your ".($discount*100)."% discount.", ""); ?><img src="images/spacer.gif" alt="" width="20" height="20" border="0"></em></div>
						</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
			<!-- Remove item from cart form --> 
			<form action="saveit.php" method="POST" name="RemoveForm" id="RemoveForm">
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
/////////////////////////////////////////////////////////////////////////////////////////////////
}elseif ($step == "confirm"){
?>

	<!-- SSL Site Seal -->
	<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>
	
	<?
	if ($order['carrier'] == "at&t"){
		$carrier = "AT&T";
		// Get first device's ship_sim_card value
		$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
		$rs_devices = mysql_query($query, $linkID);
		$device = mysql_fetch_assoc($rs_devices);
		$ShipSIMCard = $device["ship_sim_card"];
	}else{
		// Set carrier name (capitalized)
		$carrier = ucwords($order['carrier']);
		$ShipSIMCard = "";
	}
	// Build account type string
	$sAcctType = "";
	if ($order['add_line'] == "No") $sAcctType .= "New ";
	if ($order['add_line'] == "Yes") $sAcctType .= "Existing ";
	if ($order['acct_type'] == "CL") $sAcctType .= "Business ";
	if ($order['acct_type'] == "IL") $sAcctType .= "Personal ";
	$rowcount = 0;
	// Alternating row background colors
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
								<td valign="top" class="superbigBlack">Activate with <? echo $familiar_name; ?></td>
							</tr>
							<tr>
								<td valign="top" class="bigBlack">Please verify that the following information is correct:</td>
							</tr>
							<tr>
								<td class="bodyBlack">
									<br>
									<ul>
										<li>If you wish to make any changes, click the "Edit Account Information" button located below the Account Information section.  If the information is correct, please acknowledge your acceptance of the Terms & Conditions by checking the appropriate box and click the "Submit Complete Order" button at the bottom.</li>
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
							<table width="900" border="0" cellspacing="0" cellpadding="5" align="center" class="bigBlack">
							<?
							if ($order['acct_type'] == "IL"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td width="300" align="right" valign="top">Name:</td>
								<td width="600"><strong><? echo $order['first_name']; ?> <? echo $order['middle_name']; ?> <? echo $order['last_name']; ?></strong></td>
							</tr>
							<?
//								if ($order['add_line'] == "No"){
								if ($order['carrier'] == "at&t" && $ShipSIMCard == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Shipping Address:<br><span class="smallBlack"><strong>Cannot be a P.O. Box.</strong></span></td>
								<td>
									<strong><? echo $order['ship_address_1']; echo iif($order["ship_address_2"] != "", ", ", ""); echo $order['ship_address_2']; ?><br>
									<? echo $order['ship_city']; ?>,&nbsp;<? echo $order['ship_state']; ?>&nbsp;&nbsp;<? echo $order['ship_zipcode']; ?></strong>
								</td>
							</tr>
							<?
								}
								if ($order['add_line'] == "No"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Billing Address:</td>
								<td>
									<strong><? echo $order['bill_address_1']; echo iif($order["bill_address_2"] != "", ", ", ""); echo $order['bill_address_2']; ?><br>
									<? echo $order['bill_city']; ?>,&nbsp;<? echo $order['bill_state']; ?>&nbsp;&nbsp;<? echo $order['bill_zipcode']; ?></strong>
								</td>
							</tr>
							<?
								}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Service Address:<br><span class="smallBlack"><strong>Primary Place of Use Address<br>Cannot be a P.O. Box.</strong></span></td>
								<td>
									<strong><? echo $order['service_address_1']; echo iif($order["service_address_2"] != "", ", ", ""); echo $order['service_address_2']; ?><br>
									<? echo $order['service_city']; ?>,&nbsp;<? echo $order['service_state']; ?>&nbsp;&nbsp;<? echo $order['service_zipcode']; ?></strong>
								</td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Home Phone:</td>
								<td><strong><? echo $order['home_phone']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Alternate Phone:</td>
								<td><strong><? echo $order['alt_phone']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Email Address:</td>
								<td><strong><? echo $order['email']; ?></strong></td>
							</tr>
							<?
								if ($order['add_line'] == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top"><? echo $carrier; ?> Phone Number:</td>
								<td><strong><? echo $order['wireless_phone']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Account Number:</td>
								<td><strong><? echo $order['acct_number']; ?></strong></td>
							</tr>
							<?
									if ($order['carrier'] == "sprint"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top">Security Question:</td>
								<td><strong><? echo $order['security_question']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Security Answer:</td>
								<td><strong><? echo $order['security_answer']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Account Password/PIN:</td>
								<td><strong><? echo $order['password']; ?></strong></td>
							</tr>
							<?
								}else{ //add_line = "no"
							?>
							<?
									if ($order['carrier'] == "sprint"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top">Security Question:</td>
								<td><strong><? echo $order['security_question']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Security Answer:</td>
								<td><strong><? echo $order['security_answer']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Account Password/PIN:</td>
								<td><strong><? echo $order['password']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Social Security Number:</td>
								<td><strong><? echo $order['ssn']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Date of Birth:</td>
								<td><strong><? echo $order['dob']; ?></strong>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Driver's License:</td>
								<td><strong><? echo $order['dl_state']; ?> - <? echo $order['dl_number']; ?></strong>&nbsp;&nbsp;<span class="bigBlack">Expires:</span>&nbsp;<strong><? echo $order['dl_expiration']; ?></strong></td>
							</tr>
							<?
								}
							?>
							<?
								if ($show_reps == "T"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Sales Representative:</td>
								<td><strong><? echo $order['sales_rep']; ?></strong></td>
							</tr>
							<?
								}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Additional Information:</td>
								<td><textarea readonly class="bigBlack" style="width: 500px; height: 100%; font-weight: bold; border: 0; overflow:hidden;"><? echo $order['notes']; ?></textarea></td>
							</tr>
							<?
							}else{ //acct_type = "CL"
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td width="300" align="right" valign="top">Company Name:</td>
								<td width="600"><strong><? echo $order['company_name']; ?></strong></td>
							</tr>
							<?
								if ($order['carrier'] == "verizon"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Tax ID (TIN/FEIN):</td>
								<td><strong><? echo $order['tax_id']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Years in Business:</td>
								<td><strong><? echo $order['years_in_business']; ?></strong></td>
							</tr>
							<?
								}
							?>
							<?
								if ($order['add_line'] == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Service Address:<br><span class="smallBlack"><strong>Primary Place of Use Address<br>Cannot be a P.O. Box.</strong></span></td>
								<td>
									<strong><? echo $order['service_address_1']; echo iif($order["service_address_2"] != "", ", ", ""); echo $order['service_address_2']; ?><br>
									<? echo $order['service_city']; ?>,&nbsp;<? echo $order['service_state']; ?>&nbsp;&nbsp;<? echo $order['service_zipcode']; ?></strong>
								</td>
							</tr>
							<?
									if ($order['carrier'] == "at&t" && $ShipSIMCard == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Shipping Address:<br><span class="smallBlack"><strong>Cannot be a P.O. Box.</strong></span></td>
								<td>
									<strong><? echo $order['ship_address_1']; echo iif($order["ship_address_2"] != "", ", ", ""); echo $order['ship_address_2']; ?><br>
									<? echo $order['ship_city']; ?>,&nbsp;<? echo $order['ship_state']; ?>&nbsp;&nbsp;<? echo $order['ship_zipcode']; ?></strong>
								</td>
							</tr>
							<?
									}
									if ($order['add_line'] == "No"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Billing Address:</td>
								<td>
									<strong><? echo $order['bill_address_1']; echo iif($order["bill_address_2"] != "", ", ", ""); echo $order['bill_address_2']; ?><br>
									<? echo $order['bill_city']; ?>,&nbsp;<? echo $order['bill_state']; ?>&nbsp;&nbsp;<? echo $order['bill_zipcode']; ?></strong>
								</td>
							</tr>
							<?
									}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Order Contact:</td>
								<td><strong><? echo $order['contact_name']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Order Contact Phone:</td>
								<td><strong><? echo $order['contact_phone']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Order Contact Email:</td>
								<td><strong><? echo $order['contact_email']; ?></strong></td>
							</tr>
							<?
									if ($order['carrier'] == "verizon"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Main Point of Contact:</td>
								<td><strong><? echo $order['order_placer_name'].", ".$order['order_placer_title']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Main Point of Contact Phone:</td>
								<td><strong><? echo $order['order_placer_phone']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Main Point of Contact Email:</td>
								<td><strong><? echo $order['order_placer_email']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Verizon MAA On File:</td>
								<td><strong><? echo $order['maa_on_file']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top"><? echo $carrier; ?> Phone Number:</td>
								<td><strong><? echo $order['wireless_phone']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Account Number:</td>
								<td><strong><? echo $order['acct_number']; ?></strong></td>
							</tr>
							<?
									if ($order['carrier'] == "sprint"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top">Security Question:</td>
								<td><strong><? echo $order['security_question']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Security Answer:</td>
								<td><strong><? echo $order['security_answer']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Account Password/PIN:</td>
								<td><strong><? echo $order['password']; ?></strong></td>
							</tr>
							<?
									if ($show_reps == "T"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Sales Representative:</td>
								<td><strong><? echo $order['sales_rep']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<?
									if ($ShipSIMCard == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Shipping Method:</td>
								<td><strong><? echo $order['shipping']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Additional Information:</td>
								<td><textarea readonly class="bigBlack" style="width: 500px; height: 100%; font-weight: bold; border: 0; overflow:hidden;"><? echo $order['notes']; ?></textarea></td>
							</tr>
							<?
								}else{ //add_line = "No"
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td width="300" align="right" valign="top">Shipping Address:<br><span class="smallBlack"><strong>Cannot be a P.O. Box.</strong></span></td>
								<td width="600">
									<strong><? echo $order['ship_address_1']; echo iif($order["ship_address_2"] != "", ", ", ""); echo $order['ship_address_2']; ?><br>
									<? echo $order['ship_city']; ?>,&nbsp;<? echo $order['ship_state']; ?>&nbsp;&nbsp;<? echo $order['ship_zipcode']; ?></strong>
								</td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Billing Address:</td>
								<td>
									<strong><? echo $order['bill_address_1']; echo iif($order["bill_address_2"] != "", ", ", ""); echo $order['bill_address_2']; ?><br>
									<? echo $order['bill_city']; ?>,&nbsp;<? echo $order['bill_state']; ?>&nbsp;&nbsp;<? echo $order['bill_zipcode']; ?></strong>
								</td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Service Address:<br><span class="smallBlack"><strong>Primary Place of Use Address<br>Cannot be a P.O. Box.</strong></span></td>
								<td>
									<strong><? echo $order['service_address_1']; echo iif($order["service_address_2"] != "", ", ", ""); echo $order['service_address_2']; ?><br>
									<? echo $order['service_city']; ?>,&nbsp;<? echo $order['service_state']; ?>&nbsp;&nbsp;<? echo $order['service_zipcode']; ?></strong>
								</td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Billing Contact:</td>
								<td><strong><? echo $order['billing_name']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Billing Contact Phone:</td>
								<td><strong><? echo $order['billing_phone']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Billing Contact Email:</td>
								<td><strong><? echo $order['billing_email']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Order Contact:</td>
								<td><strong><? echo $order['contact_name']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Order Contact Phone:</td>
								<td><strong><? echo $order['contact_phone']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Order Contact Email:</td>
								<td><strong><? echo $order['contact_email']; ?></strong></td>
							</tr>
							<?
									if ($order['carrier'] == "sprint"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top">Security Question:</td>
								<td><strong><? echo $order['security_question']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Security Answer:</td>
								<td><strong><? echo $order['security_answer']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<?
									if ($order['carrier'] == "verizon"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Main Point of Contact:</td>
								<td><strong><? echo $order['order_placer_name'].", ".$order['order_placer_title']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
								<td align="right" valign="top" class="bigBlack">Main Point of Contact Phone:</td>
								<td><strong><? echo $order['order_placer_phone']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Main Point of Contact Email:</td>
								<td><strong><? echo $order['order_placer_email']; ?></strong></td>
							</tr>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Verizon MAA On File:</td>
								<td><strong><? echo $order['maa_on_file']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top">Account Password/PIN:</td>
								<td><strong><? echo $order['password']; ?></strong></td>
							</tr>
							<?
									if ($show_reps == "T"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Sales Representative:</td>
								<td><strong><? echo $order['sales_rep']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<?
									if ($ShipSIMCard == "Yes"){
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Shipping Method:</td>
								<td><strong><? echo $order['shipping']; ?></strong></td>
							</tr>
							<?
									}
							?>
							<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
								<td align="right" valign="top" class="bigBlack">Additional Information:</td>
								<td><textarea readonly class="bigBlack" style="width: 500px; height: 100%; font-weight: bold; border: 0; overflow:hidden;"><? echo $order['notes']; ?></textarea></td>
							</tr>
							<?
								}
							?>
							<?
							}
							?>
							</table>
						</td>
					</tr>
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
								<input type="button" value="&raquo; Edit Account Information &laquo;" style="width:320px;" class="bodyBlack" onClick="document.EditAcct.submit();">
							</form>
						<td>
					</tr>
					</table>
				</td>
			</tr>
			</table>

	<!-- Cart Contents -->
	
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
			</tr>
			<tr>
				<td align="center">
					<br>
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="xbigBlack">Cart Contents:</td>
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
							$query = "SELECT * FROM orders o, devices d WHERE o.session_id='".$SID."' AND d.session_id='".$SID."' ORDER BY esn, imei";
							$rs_cart = mysql_query($query, $linkID);
							$row = mysql_fetch_assoc($rs_cart);
							$discount = ($row["plan_discount"] * .01);
							mysql_data_seek($rs_cart,0);
							if ($_SESSION['carrier'] == "sprint" || $_SESSION['carrier'] == "verizon"){
								echo'
								<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$border_bgcolor.'" class="bodyBlack">
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
								<tr bgcolor="'.$border_bgcolor.'" class="bodyWhite">
									<td width="55" align="center"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></td>
									<td width="180" height="30" align="center">SIM Card Number</td>
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
									<td height="30" align="center">'.iif($row["ship_sim_card"] == "Yes", "SIM Card To Be Shipped", $row["iccid"]).'</td>
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
						</td>
					</tr>
					<tr>
						<td align="right" class="smallBlack">
							<em>*Plus Federal, State, and Local taxes & fees.&nbsp;&nbsp;Any negotiated contract pricing will apply retroactively once activated.<? echo iif($discount > 0 && $discount < 1, "&nbsp;&nbsp;Prices reflect your ".($discount*100)."% discount.", ""); ?><img src="images/spacer.gif" alt="" width="8" height="1" border="0"></em>
						</td>
					</tr>
					</table>
					<br>
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr>
						<td colspan="2" align="center">
							<form action="https://secure.nr.net/deviceport/" method="post" name="EditDevices" id="EditDevices">
								<input type="hidden" name="sec" id="sec" value="activate">
								<input type="hidden" name="step" id="step" value="select">
								<input type="hidden" name="site" id="site" value="<? echo $_SESSION['site']; ?>">
								<input type="hidden" name="Carrier" id="Carrier" value="<? echo $order['carrier'] ?>">
								<input type="hidden" name="Affiliation" id="Affiliation" value="<? echo $label; ?>">
								<input type="hidden" name="sid" value="<? echo $SID; ?>">
								<input type="button" value="&raquo; Edit Cart Contents &laquo;" style="width:320px;" class="bodyBlack" onClick="document.EditDevices.submit();">
							</form>
						<td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	
	<!-- Terms & Conditions -->
	
	<tr>
		<td bgcolor="<? echo $header_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
	</tr>
	<tr>
		<td align="center">
			<br>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td colspan="3" class="xbigBlack">Terms & Conditions</td>
			</tr>
			<tr>
				<td colspan="3" valign="top" class="bigBlack">Please read & agree to the following in order to complete your order:<br><br></td>
			</tr>
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
			<form action="saveit.php" method="POST" name="ConfirmOrder" id="ConfirmOrder">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="5" cellpadding="0">
					<tr>
						<td width="35" align="right"><a href="javascript:PrintIFrame();" class="bigBlack"><img src="images/PrinterIcon.jpg" alt="" width="25" height="25" border="0"></a></td>
						<td width="100"><a href="javascript:PrintIFrame();" class="smallBlack"><strong>Print Terms</strong></a></td>
						<td width="620" align="center" class="bigBlack"><input type="checkbox" name="accept_terms" id="accept_terms" value="Yes"> <strong>I Agree to These Terms & Conditions.</strong></td>
						<td width="145"><img src="images/spacer.gif" alt="" width="145" height="2" border="0"></td>
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
					<input type="hidden" name="carrier" id="carrier" value="<? echo $order['carrier'] ?>">
					<input type="hidden" name="sid" value="<? echo $SID; ?>">
					<input type="button" value="&raquo; Submit Complete Order &laquo;" style="width:320px;" class="bodyBlack" onClick="validateConfirm();">
					</form>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>

<?
////////////////////////////////////////////////////////////////////////
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
						<td valign="top" class="xbigBlack">Thank You for Activating with <? echo $familiar_name; ?></td>
					</tr>
					<tr>
						<td valign="top" class="bigBlack">Your order has been submitted for processing.</td>
					</tr>
					<tr>
						<td class="bodyBlack">
							<br><br>
							If you have any questions about your order, please call <? echo $support_phone; ?> or email us at <a href="mailto:<? echo $support_email; ?>" class="bodyBlack" style="text-decoration:underline;"><? echo $support_email; ?></a>.<br>
						</td>
					</tr>
					<?
					if ($_REQUEST['carrier'] == "verizon"){
					?>
					<tr>
						<td class="bodyBlack">
							<br><br>
							<strong>Special Notice for Verizon Wireless Customers:<br><br>
							If you selected a Verizon Telemetry Plan you need to have a Verizon Business Agreement/MAA and a signed Telemetry Addendum on file with Verizon Wireless. &nbsp;If you do not have these forms in place, or if you are uncertain if you do, please contact Lisa Paler at Vision Wireless via email at <a href="mailto:lisa@visioncell.com" class="bodyBlack"style="text-decoration:underline;">lisa@visioncell</a> or phone at 415.305.1553.<br><br>
							Shortly, an email will be sent to the Main Point of Contact email address for this account from <em>wfmvadoem@hq.verizonwireless.com</em> to confirm this order. &nbsp;Please watch for this email and reply with your authorization for the request.</strong><br>
						</td>
					</tr>
					<?
					}
					?>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
<?
////////////////////////////////////////////////////////////////////////
}elseif ($step == "sendchange"){


	// build request email and send it
	$to = "aircell.support@visioncell.com";
//	$to = "andrea@visioncell.com, vanessa@visioncell.com";
//	$to = "jeff@nr.net";
	$subject = "Plan Change Request from ".$familiar_name;
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= 'Bcc: jeff@nr.net' . "\r\n";
//	$headers .= "From: ".$_REQUEST['requester_name']." <".$_REQUEST['requester_email'].">\r\n";
	$headers .= "From: Do Not Reply <donotreply@deviceport.com>\r\n";
	$message = '
	<table width="700" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif; font-size:12;">
	<tr>
		<td width="200">Request Type:</td>
		<td width="500"><strong>Device Plan Change(s)</strong></td>
	</tr>
	<tr>
		<td>Request Timestamp:</td>
		<td><strong>'.date('m/d/y \a\t h:i A', strtotime("-2 hours")).', Pacific Time</strong></td>
	</tr>
	<tr>
		<td>Requester IP Address:</td>
		<td><strong>'.getenv('REMOTE_ADDR').'</strong></td>
	</tr>
	<tr>
		<td>Requested Via:</td>
		<td><strong>'.$_SESSION['site'].'.deviceport.com</strong></td>
	</tr>
	<tr>
		<td valign="top">Number of Devices to Change:</td>
		<td><strong>'.mysql_num_rows($rs_change_devices).'</strong><br><br></td>
	</tr>
	';
	// Get stored device information
	// moved this query to index.php to perform it BEFORE killing the session upon order completion, otherwise the SID would be different at this point.
//	$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
//	$rs_change_devices = mysql_query($query, $linkID);
	for ($counter=1; $counter <= mysql_num_rows($rs_change_devices); $counter++){
		$device = mysql_fetch_assoc($rs_change_devices);
		$message .= '
	<tr>
		<td>Device #'.$counter.' ESN:</td>
		<td><strong>'.$device["esn"].'</strong></td>
	</tr>
	<tr>
		<td valign="top">Requested New Plan:</td>
		<td><strong>'.$device["plan_name"].', '.$device["plan_cost"].'</strong><br><br></td>
	</tr>
		';
	}
	$message .= '
	</table>
	';
//	echo $message;
	// send email
	mail($to, $subject, $message, $headers);
	
	// now, finally, display "thank you" message
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
						<td valign="top" class="xbigBlack">Thank You for Activating with <? echo $familiar_name; ?></td>
					</tr>
					<tr>
						<td valign="top" class="bigBlack">Your change order has been submitted for processing.</td>
					</tr>
					<tr>
						<td class="bodyBlack">
							<br><br>
							If you have any questions about your order, please call <? echo $support_phone; ?> or email us at <a href="mailto:<? echo $support_email; ?>" class="bodyBlack" style="text-decoration:underline;"><? echo $support_email; ?></a>.<br>
						</td>
					</tr>
					<?
					if ($_REQUEST['carrier'] == "verizon"){
					?>
					<tr>
						<td class="bodyBlack">
							<br><br>
							<strong>Special Notice for Verizon Wireless Customers:<br><br>
							If you selected a Verizon Telemetry Plan you need to have a Verizon Business Agreement/MAA and a signed Telemetry Addendum on file with Verizon Wireless. &nbsp;If you do not have these forms in place, or if you are uncertain if you do, please contact Lisa Paler at Vision Wireless via email at <a href="mailto:lisa@visioncell.com" class="bodyBlack"style="text-decoration:underline;">lisa@visioncell</a> or phone at 415.305.1553.</strong><br>
						</td>
					</tr>
					<?
					}
					?>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
<?
}  // end of step loop
?>

<!-- END Include activate.php -->
