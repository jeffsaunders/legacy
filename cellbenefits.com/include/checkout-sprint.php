<?
//session_start();
// Test for session id; if none or mismatch they deep-linked, force them to start from scratch
if (!$_SESSION['SID']){ echo'<script>window.location="/?sec=home";</script>'; exit;}
// Good, there is a cookie - assign it's value to a variable for easy work
$SID = $_SESSION['SID'];
?>
	
<!-- BEGIN Include checkout.php -->

<!-- SSL Site Seal -->
<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

<?
// Get correct discount amount
if ($cart["carrier"] == "Sprint"){
	$discount = $sprint_discount;
}else{ //Nextel
	$discount = $nextel_discount;
}
?>

<?
/********************************************** OPTIONS - Page 2 ******************************************************/
if ($cargo == "options"){

// NEED TO PUT ALL THIS IN A DATABASE!!  TOO MUCH STATIC DATA!

	//Grab existing cart info, if it exists
	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);
	$cart = mysql_fetch_assoc($rs_cart);

	$simply_everything = false;
	if ($cart["plan_id"] == "208") $simply_everything = true;









	$qty_phones = 0;
	$voice_plans = false;
	$data_plans = false;
	$blackberry_plans = false;
	$family_plans = false;
	for ($counter=1; $counter <= 5; $counter++){
		if ($cart["phone".$counter."_id"] != ""){
			if ($cart["phone".$counter."_type"] == "V") $voice_plans = true;
			if ($cart["phone".$counter."_type"] == "D") $data_plans = true;
			if ($cart["phone".$counter."_type"] == "B") $blackberry_plans = true;
			if ($cart["phone".$counter."_type"] != "D") $qty_phones++; // Don't count aircards as phones
		}
	}
	if ($qty_phones > 1) $family_plans = true;








	$voice_only = false;
	$data_device = false;
	$blackberry = false;
	if ($cart["carrier"] == "Sprint"){
		$qty_phones = 0;
		$sprint_pcs = false;
		$sprint_pcs_vision = false;
		$sprint_power_vision = false;
		for ($counter=1; $counter <= 5; $counter++){
			$query = "SELECT * FROM phones WHERE product_id='".$cart['phone'.$counter.'_id']."'";
			$rs_phone = mysql_query($query, $linkID);
			$phone = mysql_fetch_assoc($rs_phone);
			if ($phone["sprint_pcs"] == "T") $sprint_pcs = true;
			if ($phone["sprint_pcs_vision"] == "T") $sprint_pcs_vision = true;
			if ($phone["sprint_power_vision"] == "T") $sprint_power_vision = true;
			if ($phone["phone_type"] == "D") $data_device = true;
			if ($phone["phone_type"] == "B") $blackberry = true;
			if ($cart["phone".$counter."_id"] != ""){
				if ($cart["phone".$counter."_type"] != "D") $qty_phones++; // Don't count aircards as phones
			}
		}
	}elseif ($cart["carrier"] == "Nextel"){
		$qty_phones = 0;
		$nextel_dual_mode = false;
		$nextel_non_dual = false;
		$nextel_easy_office = false;
		$nextel_mapquest = false;
		$nextel_trimble_gps = false;
		$nextel_intl_data = false;
		$nextel_games = false;
		for ($counter=1; $counter <= 5; $counter++){
			$query = "SELECT * FROM phones WHERE product_id='".$cart['phone'.$counter.'_id']."'";
			$rs_phone = mysql_query($query, $linkID);
			$phone = mysql_fetch_assoc($rs_phone);
			if ($phone["nextel_dual_mode"] == "T") $nextel_dual_mode = true;
			if ($phone["nextel_easy_office"] == "T") $nextel_easy_office = true;
			if ($phone["nextel_mapquest"] == "T") $nextel_mapquest = true;
			if ($phone["nextel_trimble_gps"] == "T") $nextel_trimble_gps = true;
			if ($phone["nextel_intl_data"] == "T") $nextel_intl_data = true;
			if ($phone["nextel_games"] == "T") $nextel_games = true;
			if ($phone["phone_type"] == "V") $voice_only = true;
			if ($phone["phone_type"] == "D") $data_device = true;
			if ($phone["phone_type"] == "B") $blackberry = true;
			if ($phone["phone_type"] == "V" && $phone["nextel_dual_mode"] != "T") $nextel_non_dual = true;
			if ($cart["phone".$counter."_id"] != ""){
				if ($cart["phone".$counter."_type"] != "D") $qty_phones++; // Don't count aircards as phones
			}
		}
	}
?>

	<script>
	// Verify that certain options were selected
	function validateOptions(theForm){
		if (theForm.sprint_power_vision){
			var choiceSelected = false;
			for (i = 0;  i < theForm.sprint_power_vision.length;  i++){
				if (theForm.sprint_power_vision[i].checked){
					choiceSelected = true;
				}
			}
			if (!choiceSelected){
				alert("Please select your Power Vision choice before continuing.");
				return false;
			}
		}
		if (theForm.sprint_pcs_vision){
			var choiceSelected = false;
			for (i = 0;  i < theForm.sprint_pcs_vision.length;  i++){
				if (theForm.sprint_pcs_vision[i].checked){
					choiceSelected = true;
				}
			}
			if (!choiceSelected){
				alert("Please select your PCS Vision choice before continuing.");
				return false;
			}
		}
		if (theForm.sms){
			var choiceSelected = false;
			for (i = 0;  i < theForm.sms.length;  i++){
				if (theForm.sms[i].checked){
					choiceSelected = true;
				}
			}
			if (!choiceSelected){
				alert("Please select your SMS Text Messages choice before continuing.");
				return false;
			}
		}
		if (theForm.nights && theForm.carrier.value != "Nextel"){
			var choiceSelected = false;
			for (i = 0;  i < theForm.nights.length;  i++){
				if (theForm.nights[i].checked){
					choiceSelected = true;
				}
			}
			if (!choiceSelected){
				alert("Please select your Nights & Weekend Minutes choice before continuing.");
				return false;
			}
		}
		return true;
	}
	</script>

	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<form action="saveit.php" method="post" name="PushOptions" id="PushOptions" onSubmit="return validateOptions(this);">
	<tr>
		<td width="199" align="center" background="images/YellowTab200BG.gif" class="bigBlack"><strong>Service Upgrades<br><span class="smallBlack">Step 2 of 5</span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<table width="930" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td class="bigBlack">
					<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
					<ul>
						This is the last step in selecting your plan! Customize your plan with a range of exciting and powerful services and features. 
					</ul>
				</td>
				<td width="100"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
			</tr>
			</table>
		</td>
	</tr>
	<?
	if ($discount == 0){
		if ($cart["carrier"] == "Sprint"){
			if ($sprint_power_vision && !$simply_everything){
	?>
	<!-- Power Vision Plans -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Sprint Power Vision</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>You have selected a Sprint Power Vision capable phone. &nbsp;These useful and enjoyable innovations make it easy to do a lot more than make a phone call. &nbsp;Click on each below to learn more about what each Sprint Power Vision Pack can do for you!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="700" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Ultimate Pack|25.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-PowerVisionUltimate.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Power Vision Ultimate Pack</a></td>
						<td align="center">$25.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Business Pack|25.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-PowerVisionAccessBus.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Power Vision Business Pack</a></td>
						<td align="center">$25.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Plus Pack|20.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-PowerVisionPlus.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Power Vision Plus Pack</a></td>
						<td align="center">$20.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Access Pack|15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-PowerVisionAccess.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Power Vision Access Pack</a></td>
						<td align="center">$15.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Unlimited Data Plan|39.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-HandsetAsModem.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Data Plan for Phone as Modem</a></td>
						<td align="center">$39.99</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="None|0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want a Sprint Power Vision Pack</td>
						<td align="center">&nbsp;</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($sprint_pcs_vision && !$simply_everything){
	?>
	<!-- PCS Vision Plans -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Sprint PCS Vision</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>You have selected a Sprint PCS Vision capable phone. &nbsp;These useful and enjoyable innovations make it easy to do a lot more than make a phone call. &nbsp;Click on each below to learn more about what each Sprint PCS Vision Pack can do for you!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="700" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_pcs_vision" value="PCS Vision Pack|15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-VisionUltimate.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Vision Pack</a></td>
						<td align="center">$15.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_pcs_vision" value="None|0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want a Sprint PCS Vision Pack</td>
						<td align="center">&nbsp;</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($blackberry && !$simply_everything){
	?>
	<!-- BlackBerry Data Plans -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;BlackBerry Data</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>You have selected a BlackBerry capable phone. &nbsp;A Data Pack is required to complete your BlackBerry purchase.<br>For a limited time, the Unlimited Data Pack is specially priced at $39.99/mo when you buy a Sprint PCS Voice Plan and a 2-year subscription agreement on the same device.</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="700" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_blackberry_data" value="BlackBerry Unlimited Data Pack|39.99" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-blackberryDataPack.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">BlackBerry Unlimited Data Pack</a></td>
						<td align="center">$39.99</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($data_device && !$sprint_power_vision && !$sprint_pcs_vision && !$sprint_pcs && !$blackberry){
	?>
	<!-- Aircard *ONLY* (only phone being ordered) Options -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Upgrade Your Plan</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>You have selected a Mobile Broadband Device. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="aircard_protection" id="aircard_protection" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-EquipServRepairProgram.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Total Equipment Protection</a></td>
						<td align="center">$5.00</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($sprint_power_vision || $sprint_pcs_vision || $sprint_pcs || $blackberry){
	?>
	<!-- All Phones, including aircards if there is another phone with them -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Upgrade Your Plan</strong></td>
					</tr>
					<?
					if (!$simply_everything){
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Choose one of the SMS Text Messaging options below. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="700" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sms" value="Unlimited SMS Text Messages|<? echo iif($qty_phones == 1, '10.00', '20.00'); ?>"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-SMSTextMessaging.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited SMS Text Messages</a><? echo iif($qty_phones == 1, '', '&nbsp;&nbsp;<font size="-2" color="#FF0000"><em>Covers All Phones on Family Plan</em></font>'); ?></td>
						<td align="center">$<? echo iif($qty_phones == 1, '10.00', '20.00'); ?></td> <!-- usually $15 -->
					</tr>
<!--					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sms" value="1000 SMS Text Messages|10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-sms1000NoVision.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">1,000 SMS Text Messages</a></td>
						<td align="center">$10.00</td>
					</tr>-->
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sms" value="300 SMS Text Messages|5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-sms300NoVision.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">300 SMS Text Messages</a><? echo iif($qty_phones == 1, '', '&nbsp;&nbsp;<font size="-2"><em>Per Phone on Family Plan</em></font>'); ?></td>
						<td align="center">$5.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sms" value="None|0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want an SMS Text Messaging option</td>
						<td align="center">&nbsp;</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Choose one of the Night &amp; Weekend Minutes options below. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="700" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<?
						if ($cart["plan_id"] >= 10){ // Not Power Pack Individual or Family, which already offer 7pm nights
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="nights" value="Nights Starting at 7:00|5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-nightsStarting7pm.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Night &amp; Weekend Minutes - Nights starting at 7:00 p.m.</a></td>
						<td align="center">$5.00</td>
					</tr>
					<?
						}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="nights" value="Nights Starting at 6:00|10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-nightsStarting6pm.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Night &amp; Weekend Minutes - Nights starting at 6:00 p.m.</a></td>
						<td align="center">$10.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="nights" value="None|0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want to add a Night & Weekend Minutes option</td>
						<td align="center">&nbsp;</td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<?
					if ($cart["plan_id"] == 14){ // Basic Plan does not already provide unlimited M2M
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="m2m" id="m2m" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-MobiletoMobileUnlimited.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Sprint Mobile to Mobile Calling</a></td>
						<td align="center">$5.00</td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="protection" id="protection" value="6.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-EquipServRepairProgram.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Total Equipment Protection</a></td>
						<td align="center">$7.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="rescue" id="rescue" value="4.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/popRoadside.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Roadside Rescue</a></td>
						<td align="center">$4.00</td>
					</tr>
<!--					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="voice_command" id="voice_command" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/popVoiceCommand.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Voice Command</a></td>
						<td align="center">$5.00</td>
					</tr>-->
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_intl_ld" id="sprint_intl_ld" value="4.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/services/worldwide/callfromus.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint International Long Distance</a></td>
						<td align="center">&nbsp;&nbsp;$4.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_mexico_ld" id="sprint_mexico_ld" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/services/worldwide/callfromus.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Mexico Long Distance</a></td>
						<td align="center">&nbsp;&nbsp;$5.00</td>
					</tr>
					<?
					if (!$simply_everything){
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_navigation" id="sprint_navigation" value="9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/services/gps/sprint_navigation.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Navigation</a></td>
						<td align="center">&nbsp;&nbsp;$9.99</td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_family_locator" id="sprint_family_locator" value="9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/services/gps/family_locator.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Family Locator</a></td>
						<td align="center">&nbsp;&nbsp;$9.99</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_mobile_locator" id="sprint_mobile_locator" value="15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/solutions/gps/mobile_locator.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Mobile Locator</a></td>
						<td align="center">$15.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_to_home" id="sprint_to_home" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://support.sprint.com/doc/sp4446.xml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint to Home</a></td>
						<td align="center">&nbsp;&nbsp;$5.00</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
		}elseif ($cart["carrier"] == "Nextel"){
			if (!$simply_everything){
	?>
	<!-- Voice Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Voice Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Upgrade your service. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_add_on_50" id="nextel_add_on_50" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/pp50_additional_minutes_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">50 Add-on Minutes</a></td>
						<td align="center">$5.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="m2m" id="m2m" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_mobile_mobile.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Mobile to Mobile Calling</a></td>
						<td align="center">$5.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nights" id="nights" value="6:00|5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/nights_weekends_10.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Nights &amp; Weekends starting at 6:00 p.m.</a></td>
						<td align="center">$5.00</td>
					</tr>
					<?
					if ($nextel_dual_mode){ //ANY Dual-Mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_sprint2home" id="nextel_sprint2home" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/sprint_to_home_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint to Home</a></td>
						<td align="center">$5.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mobile2office" id="nextel_mobile2office" value="8.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mobile_to_office_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile to Office</a></td>
						<td align="center">$8.00</td>
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
	<!-- Walkie-Talkie -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Nextel Walkie-Talkie</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Instantly connect at the push of the button. &nbsp;In under a second you can Walkie-Talkie to other Nextel phones - nationwide or internationally. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<?
					if ($cart["plan_id"] == 14){ // Basic Plan Only - rest already include Unlimited Walkie-Talkie
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_unltd_walkie" id="nextel_unltd_walkie" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_local_walkie.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Nextel Walkie-Talkie</a></td>
						<td align="center">$5.00</td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_unltd_grp_walkie" id="nextel_unltd_grp_walkie" value="10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_grp_walkie.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Group Walkie-Talkie</a> <strong class="smallBlack"><font color="#FF0000">(Includes Pay As You Go Text Messaging)</font></strong></td>
						<td align="center">$10.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_unltd_intl_walkie" id="nextel_unltd_intl_walkie" value="10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_intl_walkie.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited International Walkie-Talkie</a> <strong class="smallBlack"><font color="#FF0000">(Includes Pay As You Go Text Messaging)</font></strong></td>
						<td align="center">$10.00</td>
					</tr>
					<?
					if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_nextmail" id="nextel_nextmail" value="7.50"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_intl_walkie.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">NextMail</a> <strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$7.50</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_talkgroup_250" id="nextel_talkgroup_250" value="10.00" onClick="nextel_talkgroup_unltd.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/talkgroup_250_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Talkgroup 250</a></td>
						<td align="center">$10.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_talkgroup_unltd" id="nextel_talkgroup_unltd" value="25.00" onClick="nextel_talkgroup_250.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_talk_group_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Talkgroup Unlimited</a></td>
						<td align="center">$25.00</td>
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
	<?
			if ($voice_only || $data_device){ //ANY phone but a BlackBerry in cart - BlackBerry only if false, so don't show
	?>
	<!-- Data Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Data Service Plans</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Data Service. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<?
					if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_data" id="nextel_data" value="10.00" onClick="nextel_mobile_email.checked = false; nextel_telenav_unltd.checked = false; nextel_arcade.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/enhanced_service_plan.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Nextel Data Pack</a> <strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$10.00</td>
					</tr>
					<?
					}
					if ($nextel_dual_mode){ //ANY dual-mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_powersource_data_1000" id="nextel_powersource_data_1000" value="10.00" onClick="nextel_powersource_data_unltd.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/power_source_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">PowerSource Data Pack with Unlimited Web/Data &amp; 1,000 Text Messages</a><br><strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$10.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_powersource_data_unltd" id="nextel_powersource_data_unltd" value="15.00" onClick="nextel_powersource_data_1000.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/power_source_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">PowerSource Data Pack with Unlimited Web/Data &amp; Unlimited Text Messages</a><br><strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$15.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_pcs_vision_pack" id="nextel_pcs_vision_pack" value="15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/vision_pack1_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Vision Pack</a> <strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$15.00</td>
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
	<?
			}
	?>
	<!-- Messaging Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Messaging Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Messaging Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_sms_unltd" id="nextel_sms_unltd" value="10.00" onClick="nextel_sms_300.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_powerpack_text_msg.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Power Pack Text Messaging</a></td>
						<td align="center">$10.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_sms_300" id="nextel_sms_300" value="5.00" onClick="nextel_sms_unltd.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/text_messaging_300.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Text Messaging 300 Plan</a></td>
						<td align="center">$5.00</td>
					</tr>
					<?
					if ($nextel_non_dual){ //ANY non-dual mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mobile_email" id="nextel_mobile_email" value="15.00" onClick="nextel_data.checked = true;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/email/mobile_email.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile Email Enhanced</a> <strong class="smallBlack"><font color="#FF0000">(Requires Data Service Plan)</font></strong></td>
						<td align="center">$15.00</td>
					</tr>
					<?
					}
					if ($nextel_easy_office){ //ANY Easy Office capable phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_easy_office" id="nextel_easy_office" value="20.00" onClick="nextel_easy_office_plus1gb.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/easyoffice_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Easy Office</a> <strong class="smallBlack"><font color="#FF0000">($15 Activation fee will be included on your next invoice)</font></strong></td>
						<td align="center">$20.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_easy_office_plus1gb" id="nextel_easy_office_plus1gb" value="28.00" onClick="nextel_easy_office.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/easyoffice_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Easy Office with 1GB Mailbox Upgrade</a> <strong class="smallBlack"><font color="#FF0000">($15 Activation fee will be included on your next invoice)</font></strong></td>
						<td align="center">$28.00</td>
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
	<?
			if ($nextel_non_dual){ //ANY non-dual mode phone in cart
	?>
	<!-- Web Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Web Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Web Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_web" id="nextel_web" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/web.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Web Plan</a></td>
						<td align="center">$5.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_racing" id="nextel_racing" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/racing_connection.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Racing Connection</a> <strong class="smallBlack"><font color="#FF0000">(Free for Two Months!)</font></strong></td>
						<td align="center">$5.00</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
	?>
	<!-- GPS Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;GPS Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add GPS Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<?
					if ($nextel_mapquest){ //ANY MapQuest capable phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mapquest" id="nextel_mapquest" value="5.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mapquest_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">MapQuest Find Me with 300KB of Data Access</a> <strong class="smallBlack"><font color="#FF0000">(First Month Free!)</font></strong></td>
						<td align="center">$5.99</td>
					</tr>
					<?
					}
					if ($nextel_trimble_gps){ //ANY Trimble GPS capable phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_trimble_gold" id="nextel_trimble_gold" value="4.99" onClick="nextel_trimble_platinum.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/trimble_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Trimble Outdoors GPS Gold</a></td>
						<td align="center">$4.99</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_trimble_platinum" id="nextel_trimble_platinum" value="9.99" onClick="nextel_trimble_gold.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/trimble_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Trimble Outdoors GPS Platinum</a></td>
						<td align="center">$9.99</td>
					</tr>
					<?
					}
					if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_telenav_10" id="nextel_telenav_10" value="10.00" onClick="nextel_telenav_unltd.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/telenav_10_gpsdrivingdirections_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">TeleNav 10</a></td>
						<td align="center">$10.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_telenav_unltd" id="nextel_telenav_unltd" value="10.00" onClick="nextel_data.checked = true; nextel_telenav_10.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/gps/telenav.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">TeleNav Unlimited</a> <strong class="smallBlack"><font color="#FF0000">(Requires Data Service Plan)</font></strong></td>
						<td align="center">$10.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mobile_locator" id="nextel_mobile_locator" value="15.00" onClick="nextel_mobile_locator_500.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mobile_locator.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile Locator</a></td>
						<td align="center">$15.00</td>
					</tr>
					<?
					}
					if ($nextel_non_dual){ //ANY non-dual mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mobile_locator_500" id="nextel_mobile_locator_500" value="20.00" onClick="nextel_mobile_locator.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mobile_locator_500.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile Locator with Text Messaging 500</a></td>
						<td align="center">$20.00</td>
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
	<?
			}
			if ($nextel_non_dual){ //ANY non-dual mode phone in cart
	?>
	<!-- Admin Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Administrative Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Administrative Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_address_book" id="nextel_address_book" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/addressbook_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">MyNextel Address Book</td>
						<td align="center">$5.00</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_admin_pkg" id="nextel_admin_pkg" value="10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mobil_admin_pk.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile Admin Package</td>
						<td align="center">$10.00</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
		}
	?>
	<!-- International Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;International Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add International Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<?
					if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_intl_ld" id="nextel_intl_ld" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/intl_dialing_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Standard International Long Distance</td>
						<td align="center">Free</td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_intl_ld" id="sprint_intl_ld" value="4.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/intl_longdistancesavingsplan_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint International Long Distance</td>
						<td align="center">$4.00</td>
					</tr>
					<?
					if ($nextel_intl_data){ //ANY International Data capable phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_intl_data" id="nextel_intl_data" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/internationaldata_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">International Wireless Data Service Access</td>
						<td align="center">Free</td>
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
	<?
			if ($nextel_games){ //ANY games capable mode phone in cart
	?>
	<!-- Fun & Games -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Fun &amp; Games</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Games. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_arcade" id="nextel_arcade" value="5.00" onClick="nextel_data.checked = true;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/nextel_arcade.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Nextel Arcade</a> <strong class="smallBlack"><font color="#FF0000">(Requires Data Service Plan)</font></strong></td>
						<td align="center">$5.00</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
	?>
	<!-- Calling Features -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Calling Features</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Calling Features. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_inbound_restriction" id="nextel_inbound_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/inbound_callrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Inbound Calling Restriction</a></td>
						<td align="center">Free</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_outbound_restriction" id="nextel_outbound_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/outbound_callrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Outbound Calling Restriction</a></td>
						<td align="center">Free</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_ld_restriction" id="nextel_ld_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/longdistancecallrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Long Distance Calling Restriction</a></td>
						<td align="center">Free</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_walkie_restriction" id="nextel_walkie_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/ndccallrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Nextel Walkie-Talkie Calling Restriction</a></td>
						<td align="center">Free</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_intl_walkie_restriction" id="nextel_intl_walkie_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/idccallrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">International Walkie-Talkie Calling Restriction</a></td>
						<td align="center">Free</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
	?>
	<!-- Equipment Protection -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Equipment Protection</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Equipment Protection. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="protection" id="protection" value="6.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/support/total_equip_protect_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Total Equipment Protection</a></td>
						<td align="center">$6.00</td>
					</tr>
					<?
					if ($nextel_dual_mode){ //ANY Dual-Mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="rescue" id="rescue" value="4.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/popRoadside.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Roadside Rescue</a></td>
						<td align="center">$4.00</td>
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
	<?
		}
	}else{ //discount > 0
		if ($cart["carrier"] == "Sprint"){
			if ($sprint_power_vision && !$simply_everything){
	?>
	<!-- Power Vision Plans -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Sprint Power Vision</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>You have selected a Sprint Power Vision capable phone. &nbsp;These useful and enjoyable innovations make it easy to do a lot more than make a phone call. &nbsp;Click on each below to learn more about what each Sprint Power Vision Pack can do for you!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="550" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Ultimate Pack|25.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-PowerVisionUltimate.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Power Vision Ultimate Pack</a></td>
						<td align="center">$<strike>25.00</strike></td>
						<td align="center">$<? echo money_format('%i', (25.00-(25.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Business Pack|25.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-PowerVisionAccessBus.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Power Vision Business Pack</a></td>
						<td align="center">$<strike>25.00</strike></td>
						<td align="center">$<? echo money_format('%i', (25.00-(25.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Plus Pack|20.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-PowerVisionPlus.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Power Vision Plus Pack</a></td>
						<td align="center">$<strike>20.00</strike></td>
						<td align="center">$<? echo money_format('%i', (20.00-(20.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Access Pack|15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-PowerVisionAccess.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Power Vision Access Pack</a></td>
						<td align="center">$<strike>15.00</strike></td>
						<td align="center">$<? echo money_format('%i', (15.00-(15.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="Power Vision Unlimited Data Plan|39.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-HandsetAsModem.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Data Plan for Phone as Modem</a></td>
						<td align="center">$<strike>39.99</strike></td>
						<td align="center">$<? echo money_format('%i', (39.99-(39.99*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_power_vision" value="None|0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want a Sprint Power Vision Pack</td>
						<td align="center">&nbsp;</td>
						<td align="center">&nbsp;</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($sprint_pcs_vision && !$simply_everything){
	?>
	<!-- PCS Vision Plans -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Sprint PCS Vision</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>You have selected a Sprint PCS Vision capable phone. &nbsp;These useful and enjoyable innovations make it easy to do a lot more than make a phone call. &nbsp;Click on each below to learn more about what each Sprint PCS Vision Pack can do for you!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="550" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_pcs_vision" value="PCS Vision Pack|15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-VisionUltimate.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Vision Pack</a></td>
						<td align="center">$<strike>15.00</strike></td>
						<td align="center">$<? echo money_format('%i', (15.00-(15.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_pcs_vision" value="None|0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want a Sprint PCS Vision Pack</td>
						<td align="center">&nbsp;</td>
						<td align="center">&nbsp;</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($blackberry && !$simply_everything){
	?>
	<!-- BlackBerry Data Plans -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;BlackBerry Data</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>You have selected a BlackBerry capable phone. &nbsp;A Data Pack is required to complete your BlackBerry purchase.<br>For a limited time, the Unlimited Data Pack is specially priced at $39.99/mo when you buy a Sprint PCS Voice Plan and a 2-year subscription agreement on the same device.<br><br><em>*Because of this special pricing, no additional discounts apply.</em></li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="550" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sprint_blackberry_data" value="BlackBerry Unlimited Data Pack|39.99" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-blackberryDataPack.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">BlackBerry Unlimited Data Pack</a></td>
						<td align="center">$<strike>39.99</strike></td>
						<td align="center">$39.99*</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($data_device && !$sprint_power_vision && !$sprint_pcs_vision && !$sprint_pcs && !$blackberry){
	?>
	<!-- Aircard *ONLY* (only phone being ordered) Options -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Upgrade Your Plan</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>You have selected a Mobile Broadband Device. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="aircard_protection" id="aircard_protection" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-EquipServRepairProgram.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Total Equipment Protection</a></td>
						<td align="center">$<strike>5.00</strike></td>
<!--						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>-->
						<td align="center">&nbsp;&nbsp;&nbsp;$5.00&sup1;&nbsp;</td>
					</tr>
					</table>
					<div align="right" class="smallBlack">&sup1;This Option Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($sprint_power_vision || $sprint_pcs_vision || $sprint_pcs || $blackberry){
	?>
	<!-- All Phones, including aircards if there is another phone with them -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Upgrade Your Plan</strong></td>
					</tr>
					<?
					if (!$simply_everything){
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Choose one of the SMS Text Messaging options below. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="550" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sms" value="Unlimited SMS Text Messages|<? echo iif($qty_phones == 1, '10.00', '20.00'); ?>"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-SMSTextMessaging.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited SMS Text Messages</a><? echo iif($qty_phones == 1, '', '&nbsp;&nbsp;<font size="-2" color="#FF0000"><em>Covers All Phones on Family Plan</em></font>'); ?></td>
						<td align="center">$<strike><? echo iif($qty_phones == 1, '10.00', '20.00'); ?></strike></td> <!-- usually $15 -->
						<td align="center">$<? echo money_format('%i', (iif($qty_phones == 1, 10.00, 20.00)-(iif($qty_phones == 1, 10.00, 20.00)*($discount*.01)))); ?></td>
					</tr>
<!--					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sms" value="1000 SMS Text Messages|10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-sms1000NoVision.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">1,000 SMS Text Messages</a></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>-->
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sms" value="300 SMS Text Messages|5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-sms300NoVision.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">300 SMS Text Messages</a><? echo iif($qty_phones == 1, '', '&nbsp;&nbsp;<font size="-2"><em>Per Phone on Family Plan</em></font>'); ?></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="sms" value="None|0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want an SMS Text Messaging option</td>
						<td align="center">&nbsp;</td>
						<td align="center">&nbsp;</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Choose one of the Night &amp; Weekend Minutes options below. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="550" align="center">Option</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<?
						if ($cart["plan_id"] >= 10){ // Not Power Pack Individual or Family, which already offer 7pm nights
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="nights" value="Nights Starting at 7:00|5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-nightsStarting7pm.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Night &amp; Weekend Minutes - Nights starting at 7:00 p.m.</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<?
						}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="nights" value="Nights Starting at 6:00|10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-nightsStarting6pm.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Night &amp; Weekend Minutes - Nights starting at 6:00 p.m.</a></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="nights" value="None|0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want to add a Night & Weekend Minutes option</td>
						<td align="center">&nbsp;</td>
						<td align="center">&nbsp;</td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<?
					if ($cart["plan_id"] == 14){ // Basic Plan does not already provide unlimited M2M
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="m2m" id="m2m" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-MobiletoMobileUnlimited.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Sprint Mobile to Mobile Calling</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="protection" id="protection" value="6.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-EquipServRepairProgram.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Total Equipment Protection</a></td>
						<td align="center">$<strike>7.00</strike></td>
						<td align="center">$<? echo money_format('%i', (7.00-(7.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="rescue" id="rescue" value="4.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/popRoadside.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Roadside Rescue</a></td>
						<td align="center">$<strike>4.00</strike></td>
						<td align="center">$<? echo money_format('%i', (4.00-(4.00*($discount*.01)))); ?></td>
					</tr>
<!--					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="voice_command" id="voice_command" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/popVoiceCommand.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Voice Command</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>-->
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_intl_ld" id="sprint_intl_ld" value="4.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/services/worldwide/callfromus.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint International Long Distance</a></td>
						<td align="center">$<strike>4.00</strike></td>
						<td align="center">$<? echo money_format('%i', (4.00-(4.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_mexico_ld" id="sprint_mexico_ld" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/services/worldwide/callfromus.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Mexico Long Distance</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<?
					if (!$simply_everything){
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_navigation" id="sprint_navigation" value="9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/services/gps/sprint_navigation.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Navigation</a></td>
						<td align="center">$<strike>9.99</strike></td>
						<td align="center">$<? echo money_format('%i', (9.99-(9.99*($discount*.01)))); ?></td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_family_locator" id="sprint_family_locator" value="9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/services/gps/family_locator.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Family Locator</a></td>
						<td align="center">$<strike>9.99</strike></td>
						<td align="center">$<? echo money_format('%i', (9.99-(9.99*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_mobile_locator" id="sprint_mobile_locator" value="15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.nextel.com/en/solutions/gps/mobile_locator.shtml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Mobile Locator</a></td>
						<td align="center">$<strike>15.00</strike></td>
						<td align="center">$<? echo money_format('%i', (15.00-(15.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_to_home" id="sprint_to_home" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://support.sprint.com/doc/sp4446.xml','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint to Home</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
		}elseif ($cart["carrier"] == "Nextel"){
			if (!$simply_everything){
	?>
	<!-- Voice Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Voice Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Upgrade your service. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_add_on_50" id="nextel_add_on_50" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/pp50_additional_minutes_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">50 Add-on Minutes</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="m2m" id="m2m" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_mobile_mobile.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Mobile to Mobile Calling</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nights" id="nights" value="6:00|5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/nights_weekends_10.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Nights &amp; Weekends starting at 6:00 p.m.</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<?
					if ($nextel_dual_mode){ //ANY Dual-Mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_sprint2home" id="nextel_sprint2home" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/sprint_to_home_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint to Home</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mobile2office" id="nextel_mobile2office" value="8.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mobile_to_office_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile to Office</a></td>
						<td align="center">$<strike>8.00</strike></td>
						<td align="center">$<? echo money_format('%i', (8.00-(8.00*($discount*.01)))); ?></td>
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
	<!-- Walkie-Talkie -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Nextel Walkie-Talkie</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Instantly connect at the push of the button. &nbsp;In under a second you can Walkie-Talkie to other Nextel phones - nationwide or internationally. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<?
					if ($cart["plan_id"] == 14){ // Basic Plan Only - rest already include Unlimited Walkie-Talkie
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_unltd_walkie" id="nextel_unltd_walkie" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_local_walkie.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Nextel Walkie-Talkie</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_unltd_grp_walkie" id="nextel_unltd_grp_walkie" value="10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_grp_walkie.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Group Walkie-Talkie</a> <strong class="smallBlack"><font color="#FF0000">(Includes Pay As You Go Text Messaging)</font></strong></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_unltd_intl_walkie" id="nextel_unltd_intl_walkie" value="10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_intl_walkie.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited International Walkie-Talkie</a> <strong class="smallBlack"><font color="#FF0000">(Includes Pay As You Go Text Messaging)</font></strong></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					<?
					if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_nextmail" id="nextel_nextmail" value="7.50"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_intl_walkie.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">NextMail</a> <strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$<strike>7.50</strike></td>
						<td align="center">$<? echo money_format('%i', (7.50-(7.50*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_talkgroup_250" id="nextel_talkgroup_250" value="10.00" onClick="nextel_talkgroup_unltd.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/talkgroup_250_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Talkgroup 250</a></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_talkgroup_unltd" id="nextel_talkgroup_unltd" value="25.00" onClick="nextel_talkgroup_250.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_talk_group_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Talkgroup Unlimited</a></td>
						<td align="center">$<strike>25.00</strike></td>
						<td align="center">$<? echo money_format('%i', (25.00-(25.00*($discount*.01)))); ?></td>
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
	<?
			if ($voice_only || $data_device){ //ANY phone but a BlackBerry in cart - BlackBerry only if false, so don't show
	?>
	<!-- Data Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Data Service Plans</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Data Service. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<?
					if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_data" id="nextel_data" value="10.00" onClick="nextel_mobile_email.checked = false; nextel_telenav_unltd.checked = false; nextel_arcade.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/enhanced_service_plan.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Nextel Data Pack</a> <strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					<?
					}
					if ($nextel_dual_mode){ //ANY dual-mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_powersource_data_1000" id="nextel_powersource_data_1000" value="10.00" onClick="nextel_powersource_data_unltd.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/power_source_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">PowerSource Data Pack with Unlimited Web/Data &amp; 1,000 Text Messages</a><br><strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_powersource_data_unltd" id="nextel_powersource_data_unltd" value="15.00" onClick="nextel_powersource_data_1000.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/power_source_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">PowerSource Data Pack with Unlimited Web/Data &amp; Unlimited Text Messages</a><br><strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$<strike>15.00</strike></td>
						<td align="center">$<? echo money_format('%i', (15.00-(15.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_pcs_vision_pack" id="nextel_pcs_vision_pack" value="15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/vision_pack1_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint PCS Vision Pack</a> <strong class="smallBlack"><font color="#FF0000">(1 Month FREE!)</font></strong></td>
						<td align="center">$<strike>15.00</strike></td>
						<td align="center">$<? echo money_format('%i', (15.00-(15.00*($discount*.01)))); ?></td>
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
	<?
			}
	?>
	<!-- Messaging Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Messaging Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Messaging Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_sms_unltd" id="nextel_sms_unltd" value="10.00" onClick="nextel_sms_300.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/unl_powerpack_text_msg.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Unlimited Power Pack Text Messaging</a></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_sms_300" id="nextel_sms_300" value="5.00" onClick="nextel_sms_unltd.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/text_messaging_300.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Text Messaging 300 Plan</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<?
					if ($nextel_non_dual){ //ANY non-dual mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mobile_email" id="nextel_mobile_email" value="15.00" onClick="nextel_data.checked = true;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/email/mobile_email.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile Email Enhanced</a> <strong class="smallBlack"><font color="#FF0000">(Requires Data Service Plan)</font></strong></td>
						<td align="center">$<strike>15.00</strike></td>
						<td align="center">$<? echo money_format('%i', (15.00-(15.00*($discount*.01)))); ?></td>
					</tr>
					<?
					}
					if ($nextel_easy_office){ //ANY Easy Office capable phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_easy_office" id="nextel_easy_office" value="20.00" onClick="nextel_easy_office_plus1gb.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/easyoffice_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Easy Office</a><br><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><strong class="smallBlack"><font color="#FF0000">($15 Activation fee will be included on your next invoice)</font></strong></td>
						<td align="center">$<strike>20.00</strike></td>
						<td align="center">$<? echo money_format('%i', (20.00-(20.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_easy_office_plus1gb" id="nextel_easy_office_plus1gb" value="28.00" onClick="nextel_easy_office.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/easyoffice_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint Easy Office with 1GB Mailbox Upgrade</a><br><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><strong class="smallBlack"><font color="#FF0000">($15 Activation fee will be included on your next invoice)</font></strong></td>
						<td align="center">$<strike>28.00</strike></td>
						<td align="center">$<? echo money_format('%i', (28.00-(28.00*($discount*.01)))); ?></td>
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
	<?
			if ($nextel_non_dual){ //ANY non-dual mode phone in cart
	?>
	<!-- Web Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Web Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Web Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_web" id="nextel_web" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/web.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Web Plan</a></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_racing" id="nextel_racing" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/racing_connection.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Racing Connection</a> <strong class="smallBlack"><font color="#FF0000">(Free for Two Months!)</font></strong></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
	?>
	<!-- GPS Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;GPS Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add GPS Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<?
					if ($nextel_mapquest){ //ANY MapQuest capable phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mapquest" id="nextel_mapquest" value="5.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mapquest_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">MapQuest Find Me with 300KB of Data Access</a> <strong class="smallBlack"><font color="#FF0000">(First Month Free!)</font></strong></td>
						<td align="center">$<strike>5.99</strike></td>
						<td align="center">$<? echo money_format('%i', (5.99-(5.99*($discount*.01)))); ?></td>
					</tr>
					<?
					}
					if ($nextel_trimble_gps){ //ANY Trimble GPS capable phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_trimble_gold" id="nextel_trimble_gold" value="4.99" onClick="nextel_trimble_platinum.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/trimble_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Trimble Outdoors GPS Gold</a></td>
						<td align="center">$<strike>4.99</strike></td>
						<td align="center">$<? echo money_format('%i', (4.99-(4.99*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_trimble_platinum" id="nextel_trimble_platinum" value="9.99" onClick="nextel_trimble_gold.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/trimble_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Trimble Outdoors GPS Platinum</a></td>
						<td align="center">$<strike>9.99</strike></td>
						<td align="center">$<? echo money_format('%i', (9.99-(9.99*($discount*.01)))); ?></td>
					</tr>
					<?
					}
					if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_telenav_10" id="nextel_telenav_10" value="10.00" onClick="nextel_telenav_unltd.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/telenav_10_gpsdrivingdirections_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">TeleNav 10</a></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_telenav_unltd" id="nextel_telenav_unltd" value="10.00" onClick="nextel_data.checked = true; nextel_telenav_10.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/gps/telenav.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">TeleNav Unlimited</a> <strong class="smallBlack"><font color="#FF0000">(Requires Data Service Plan)</font></strong></td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mobile_locator" id="nextel_mobile_locator" value="15.00" onClick="nextel_mobile_locator_500.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mobile_locator.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile Locator</a></td>
						<td align="center">$<strike>15.00</strike></td>
						<td align="center">$<? echo money_format('%i', (15.00-(15.00*($discount*.01)))); ?></td>
					</tr>
					<?
					}
					if ($nextel_non_dual){ //ANY non-dual mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_mobile_locator_500" id="nextel_mobile_locator_500" value="20.00" onClick="nextel_mobile_locator.checked = false;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mobile_locator_500.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile Locator with Text Messaging 500</a></td>
						<td align="center">$<strike>20.00</strike></td>
						<td align="center">$<? echo money_format('%i', (20.00-(20.00*($discount*.01)))); ?></td>
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
	<?
			}
			if ($nextel_non_dual){ //ANY non-dual mode phone in cart
	?>
	<!-- Admin Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Administrative Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Administrative Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_address_book" id="nextel_address_book" value="5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/addressbook_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">MyNextel Address Book</td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_admin_pkg" id="nextel_admin_pkg" value="10.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/mobil_admin_pk.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Mobile Admin Package</td>
						<td align="center">$<strike>10.00</strike></td>
						<td align="center">$<? echo money_format('%i', (10.00-(10.00*($discount*.01)))); ?></td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
		}
	?>
	<!-- International Services -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;International Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add International Services. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<?
					if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_intl_ld" id="nextel_intl_ld" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/intl_dialing_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Standard International Long Distance</td>
						<td align="center">Free</td>
						<td align="center">Free</td>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="sprint_intl_ld" id="sprint_intl_ld" value="4.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/intl_longdistancesavingsplan_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint International Long Distance</td>
						<td align="center">$<strike>4.00</strike></td>
						<td align="center">$<? echo money_format('%i', (4.00-(4.00*($discount*.01)))); ?></td>
					</tr>
					<?
					if ($nextel_intl_data){ //ANY International Data capable phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_intl_data" id="nextel_intl_data" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/internationaldata_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">International Wireless Data Service Access</td>
						<td align="center">Free</td>
						<td align="center">Free</td>
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
	<?
			if ($nextel_games){ //ANY games capable mode phone in cart
	?>
	<!-- Fun & Games -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Fun &amp; Games</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Games. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_arcade" id="nextel_arcade" value="5.00" onClick="nextel_data.checked = true;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/nextel_arcade.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Nextel Arcade</a> <strong class="smallBlack"><font color="#FF0000">(Requires Data Service Plan)</font></strong></td>
						<td align="center">$<strike>5.00</strike></td>
						<td align="center">$<? echo money_format('%i', (5.00-(5.00*($discount*.01)))); ?></td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
			if ($nextel_non_dual || $blackberry){ //ANY non-dual mode OR BlackBerry phone in cart
	?>
	<!-- Calling Features -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Calling Features</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Calling Features. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_inbound_restriction" id="nextel_inbound_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/inbound_callrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Inbound Calling Restriction</a></td>
						<td align="center">Free</td>
						<td align="center">Free</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_outbound_restriction" id="nextel_outbound_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/outbound_callrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Outbound Calling Restriction</a></td>
						<td align="center">Free</td>
						<td align="center">Free</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_ld_restriction" id="nextel_ld_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/longdistancecallrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Long Distance Calling Restriction</a></td>
						<td align="center">Free</td>
						<td align="center">Free</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_walkie_restriction" id="nextel_walkie_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/ndccallrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Nextel Walkie-Talkie Calling Restriction</a></td>
						<td align="center">Free</td>
						<td align="center">Free</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="nextel_intl_walkie_restriction" id="nextel_intl_walkie_restriction" value="Free"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/services/popups/idccallrestrict_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">International Walkie-Talkie Calling Restriction</a></td>
						<td align="center">Free</td>
						<td align="center">Free</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
			}
	?>
	<!-- Equipment Protection -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Equipment Protection</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Equipment Protection. &nbsp;Select any of the following options. &nbsp;Click on each to learn more about what features or services it has to offer!</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Add</td>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="protection" id="protection" value="6.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://nextelonline.nextel.com/en/support/total_equip_protect_popup.shtml','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Total Equipment Protection</a></td>
						<td align="center">$<strike>6.00</strike></td>
						<td align="center">$<? echo money_format('%i', (6.00-(6.00*($discount*.01)))); ?></td>
					</tr>
					<?
					if ($nextel_dual_mode){ //ANY Dual-Mode phone in cart
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="checkbox" name="rescue" id="rescue" value="4.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0"><a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/popRoadside.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Roadside Rescue</a></td>
						<td align="center">$<strike>4.00</strike></td>
						<td align="center">$<? echo money_format('%i', (4.00-(4.00*($discount*.01)))); ?></td>
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
	<?
		}
	}
	?>
	<!-- Accessories -->
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" colspan="3" class="bodyWhite"><strong>&nbsp;Accessories</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="3">
							<br>
							<ul>
								<li>Add Optional Accessories. &nbsp;Select any of the following options.</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Qty</td>
						<td width="700" align="center">Accessory</td>
						<td width="150" align="center">Your Cost</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="text" name="universal_earbuds" id="universal_earbuds" value="0" size="1" maxlength="3"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Universal Earbud</a></td>
						<td align="center"><input type="hidden" name="universal_earbuds_price" id="universal_earbuds_price" value="19.99">$19.99</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="text" name="vehicle_adapters" id="vehicle_adapters" value="0" size="1" maxlength="3"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Vehicle Power Adapter</a></td>
						<td align="center"><input type="hidden" name="vehicle_adapters_price" id="vehicle_adapters_price" value="29.99">$29.99</td>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<input type="hidden" name="task" value="addoptions">
			<input type="hidden" name="carrier" value="<? echo $cart["carrier"]; ?>">
			<input type="hidden" name="sid" value="<? echo $SID; ?>">
<!--			<ul><input type="image" src="images/AddToOrderButton.gif" onClick="document.getElementById(this).submit();">-->
			<ul><input type="image" src="images/AddToOrderButton.gif">
		</td>
	</tr>
	</form>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF"><br><img src="images/GrayDot.gif" alt="" width="900" height="1" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td valign="top" class="bodyBlack">
					<ul>
						<li>Hours for Night &amp; Weekend Minutes starting at 7:00 p.m. are Monday-Thursday from 7:00 p.m. to 7:00 a.m., and Friday 7:00 p.m. to Mon. 7:00 a.m.</li><br><br>
						<li>Hours for Night &amp; Weekend Minutes starting at 6:00 p.m. are Monday-Thursday from 6:00 p.m. to 7:00 a.m., and Friday 6:00 p.m. to Mon. 7:00 a.m.</li><br><br>
						<li>Customers with a Sprint PCS Vision Phone or a Sprint Power Vision phone will be charged $0.03 per kilobyte for Sprint PCS Vision or Sprint Power Vision usage unless a Sprint PCS Vision or Sprint Power Vision Pack is selected.</li><br><br>
						<li>Casual text messages not included in your plan are $0.15 per message.</li><br><br>
					</ul>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	</table>
<?
/********************************************** PORTING - Page 3 ******************************************************/
}elseif ($cargo == "porting"){
?>
	<script>
	function validatePorting(theForm){
	<?
	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);
	$row = mysql_fetch_assoc($rs_cart);
	$phones_ordered = 0;
	for ($counter=1; $counter <= 5; $counter++){
		if ($row['phone'.$counter.'_id'] != ""){
	?>
	// Phone <? echo $counter; ?> User Name
		if (theForm.phone<? echo $counter; ?>_username){
			if (theForm.phone<? echo $counter; ?>_username.value == ""){
				theForm.phone<? echo $counter; ?>_username.style.background="#FF0000";
				alert("Please Enter A User Name for Phone <? echo $counter; ?>");
				theForm.phone<? echo $counter; ?>_username.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_username.focus();
				return false;
			}
		}
	// Phone <? echo $counter; ?> User City
		if (theForm.phone<? echo $counter; ?>_usercity){
			if (theForm.phone<? echo $counter; ?>_usercity.value == ""){
				theForm.phone<? echo $counter; ?>_usercity.style.background="#FF0000";
				alert("Please Enter The City Where Phone <? echo $counter; ?>'s User Lives");
				theForm.phone<? echo $counter; ?>_usercity.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_usercity.focus();
				return false;
			}
		}
	// Phone <? echo $counter; ?> User State
		if (theForm.phone<? echo $counter; ?>_userstate){
			if (theForm.phone<? echo $counter; ?>_userstate.value == ""){
				theForm.phone<? echo $counter; ?>_userstate.style.background="#FF0000";
				alert("Please Select The State Where Phone <? echo $counter; ?>'s User Lives");
				theForm.phone<? echo $counter; ?>_userstate.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_userstate.focus();
				return false;
			}
		}
	// Phone <? echo $counter; ?> User Zip Code
		if (theForm.phone<? echo $counter; ?>_userzip){
			if (theForm.phone<? echo $counter; ?>_userzip.value == ""){
				theForm.phone<? echo $counter; ?>_userzip.style.background="#FF0000";
				alert("Please Enter The Zip Code Where Phone <? echo $counter; ?>'s User Lives");
				theForm.phone<? echo $counter; ?>_userzip.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_userzip.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.phone<? echo $counter; ?>_userzip.value) == false && cdn_regex.test(theForm.phone<? echo $counter; ?>_userzip.value) == false) { 
 			if (usa_regex.test(theForm.phone<? echo $counter; ?>_userzip.value) == false) { 
				theForm.phone<? echo $counter; ?>_userzip.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.phone<? echo $counter; ?>_userzip.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_userzip.focus();
				return false;
			}
		}
	// Phone <? echo $counter; ?> User Desired Areacode
		if (theForm.phone<? echo $counter; ?>_areacode){
			if (theForm.phone<? echo $counter; ?>_areacode.value == ""){
				theForm.phone<? echo $counter; ?>_areacode.style.background="#FF0000";
				alert("Please Enter Your Desired Areacode For Phone <? echo $counter; ?> (i.e '212' for New York, '213' for Los Angeles, etc.)");
				theForm.phone<? echo $counter; ?>_areacode.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_areacode.focus();
				return false;
			}
		}
	// Phone <? echo $counter; ?> Porting Information
		if (theForm.portme<? echo $counter; ?>.checked){ // Porting form visible, so verify it
		// Phone <? echo $counter; ?> Port Number
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.phone<? echo $counter; ?>_port_number.value) == false && phone2_regex.test(theForm.phone<? echo $counter; ?>_port_number.value) == false) { 
				theForm.phone<? echo $counter; ?>_port_number.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.phone<? echo $counter; ?>_port_number.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_number.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port From Which Carrier
			if (theForm.phone<? echo $counter; ?>_port_from.value == ""){
				theForm.phone<? echo $counter; ?>_port_from.style.background="#FF0000";
				alert("Please Select The Carrier That Currently Hosts This Number");
				theForm.phone<? echo $counter; ?>_port_from.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_from.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Account Number
			if (theForm.phone<? echo $counter; ?>_port_acctnum.value == ""){
				theForm.phone<? echo $counter; ?>_port_acctnum.style.background="#FF0000";
				alert("Please Enter The Current Account Number");
				theForm.phone<? echo $counter; ?>_port_acctnum.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_acctnum.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Account Password
			if (theForm.phone<? echo $counter; ?>_port_password.value == ""){
				theForm.phone<? echo $counter; ?>_port_password.style.background="#FFFF00";
				leaveBlank = confirm("If The Account Requires A Password For Access, Please Enter It. Click 'OK' To Leave Blank Or 'Cancel' to Enter Password");
				theForm.phone<? echo $counter; ?>_port_password.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_password.focus();
				if (!leaveBlank) return false;
			}
		// Phone <? echo $counter; ?> Port Billing Name
			if (theForm.phone<? echo $counter; ?>_port_billname.value == ""){
				theForm.phone<? echo $counter; ?>_port_billname.style.background="#FF0000";
				alert("Please Enter Your Name Exactly As It Appears On Your Bill");
				theForm.phone<? echo $counter; ?>_port_billname.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_billname.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Billing Address(1)
			if (theForm.phone<? echo $counter; ?>_port_billaddr1.value == ""){
				theForm.phone<? echo $counter; ?>_port_billaddr1.style.background="#FF0000";
				theForm.phone<? echo $counter; ?>_port_billaddr2.style.background="#FF0000";
				alert("Please Enter Your Address Exactly As It Appears On Your Bill");
				theForm.phone<? echo $counter; ?>_port_billaddr1.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_billaddr2.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_billaddr1.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Billing City
			if (theForm.phone<? echo $counter; ?>_port_billcity.value == ""){
				theForm.phone<? echo $counter; ?>_port_billcity.style.background="#FF0000";
				alert("Please Enter Your City Exactly As It Appears On Your Bill");
				theForm.phone<? echo $counter; ?>_port_billcity.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_billcity.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Billing State
			if (theForm.phone<? echo $counter; ?>_port_billstate.value == ""){
				theForm.phone<? echo $counter; ?>_port_billstate.style.background="#FF0000";
				alert("Please Select Your Billing State");
				theForm.phone<? echo $counter; ?>_port_billstate.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_billstate.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Billing Zip Code
			if (theForm.phone<? echo $counter; ?>_port_billzip.value == ""){
				theForm.phone<? echo $counter; ?>_port_billzip.style.background="#FF0000";
				alert("Please Enter Your Billing Zip Code");
				theForm.phone<? echo $counter; ?>_port_billzip.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_billzip.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//				var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
//	 			if (usa_regex.test(theForm.phone<? echo $counter; ?>_port_billzip.value) == false && cdn_regex.test(theForm.phone<? echo $counter; ?>_port_billzip.value) == false) { 
 			if (usa_regex.test(theForm.phone<? echo $counter; ?>_port_billzip.value) == false) { 
				theForm.phone<? echo $counter; ?>_port_billzip.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.phone<? echo $counter; ?>_port_billzip.style.background="#FFE100";
				theForm.phone<? echo $counter; ?>_port_billzip.focus();
				return false;
			}
		}
	<?
		}
	}
	?>
		return true;
	}
	</script>
	
	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="199" align="center" background="images/YellowTab200BG.gif" class="bigBlack"><strong>Phone Details<br><span class="smallBlack">Step 3 of 5</span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<table width="930" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
			<tr>
				<td width="100"><img src="images/spacer.gif" alt="" width="100" height="1" border="0"></td>
				<td align="center" class="bigBlack"><br><strong><? echo $message; ?><br><br></strong></td>
				<td width="100"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<form action="saveit.php" method="post" name="PushPort" id="PushPort" onSubmit="return validatePorting(this);">
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
			<tr bgcolor="#58639B">
				<td width="900" class="bodyWhite"><strong>&nbsp;Individual Phone Details</strong></td>
			</tr>
			<tr>
				<td class="bodyBlack">
					<br>
					<ul>
						<li>Please provide information specific to each individual phone in your shopping cart.</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td>
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderNone" style="border: 0px solid;">
				<?
				$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
				$rs_cart = mysql_query($query, $linkID);
				$row = mysql_fetch_assoc($rs_cart);
				$phones_ordered = 0;
				for ($counter=1; $counter <= 5; $counter++){
					if ($row['phone'.$counter.'_id'] != ""){
						$query = "SELECT * FROM phones WHERE product_id='".$row['phone'.$counter.'_id']."'";
						$rs_phone = mysql_query($query, $linkID);
						$phone = mysql_fetch_assoc($rs_phone);
				?>
					<tr bgcolor="#58639B">
						<td width="900" height="20" colspan="3">
							<script>
							function toggle<? echo $counter; ?>() {
								if (PushPort.portme<? echo $counter; ?>.checked){
									noport<? echo $counter; ?>.style.visibility = "hidden";
									port<? echo $counter; ?>.style.visibility = "visible";
								}else{
									port<? echo $counter; ?>.style.visibility = "hidden";
									noport<? echo $counter; ?>.style.visibility = "visible";
								}
							}
							</script>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyWhite">
							<tr>
								<td>&nbsp;Phone <? echo $counter; ?></td>
								<td align="right" valign="top">Check Here To Port An Existing Number To This Phone <input type="checkbox" name="portme<? echo $counter; ?>" id="portme<? echo $counter; ?>" value="checked" onClick="javascrip:toggle<? echo $counter; ?>();"></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="375" valign="top">
							<table class="bodyBlack">
							<tr>
								<td colspan="2" class="smallBlack"><strong><? echo $phone["label"]; ?></strong></td>
							</tr>
							<tr>
								<td><img src="images/phones/<? echo $phone["thumbnail"]; ?>" alt="" width="70" height="130" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br></td>
								<td valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="4" border="0"><br>
									<table>
									<tr>
										<td align="right">User's Name:</td>
										<td colspan="3"><input type="text" name="phone<? echo $counter; ?>_username" id="phone<? echo $counter; ?>_username" size="25" maxlength="50" tabindex="<? echo ($counter*20)+1; ?>" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
									</tr>
									<tr>
										<td align="right">User's City:</td>
										<td colspan="3"><input type="text" name="phone<? echo $counter; ?>_usercity" id="phone<? echo $counter; ?>_usercity" size="25" maxlength="50" tabindex="<? echo ($counter*20)+2; ?>" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
									</tr>
									<tr>
										<td align="right">User's State:</td>
										<td>
											<select name="phone<? echo $counter; ?>_userstate" id="phone<? echo $counter; ?>_userstate" tabindex="<? echo ($counter*20)+3; ?>" class="bodyBlack" style="background-color: #FFE100;">
												<option value="">Select</option>
								                <option value="AL">AL</option>
												<option value="AK">AK</option>
												<option value="AZ">AZ</option>
												<option value="AR">AR</option>
												<option value="CA">CA</option>
												<option value="CO">CO</option>
												<option value="CT">CT</option>
												<option value="DE">DE</option>
												<option value="DC">DC</option>
												<option value="FL">FL</option>
												<option value="GA">GA</option>
												<option value="HI">HI</option>
												<option value="ID">ID</option>
												<option value="IL">IL</option>
												<option value="IN">IN</option>
												<option value="IA">IA</option>
												<option value="KS">KS</option>
												<option value="KY">KY</option>
												<option value="LA">LA</option>
												<option value="ME">ME</option>
												<option value="MD">MD</option>
												<option value="MA">MA</option>
												<option value="MI">MI</option>
												<option value="MN">MN</option>
												<option value="MS">MS</option>
												<option value="MO">MO</option>
												<option value="MT">MT</option>
												<option value="NE">NE</option>
												<option value="NV">NV</option>
												<option value="NH">NH</option>
												<option value="NJ">NJ</option>
												<option value="NM">NM</option>
												<option value="NY">NY</option>
												<option value="NC">NC</option>
												<option value="ND">ND</option>
												<option value="OH">OH</option>
												<option value="OK">OK</option>
												<option value="OR">OR</option>
												<option value="PA">PA</option>
												<option value="RI">RI</option>
												<option value="SC">SC</option>
												<option value="SD">SD</option>
												<option value="TN">TN</option>
												<option value="TX">TX</option>
												<option value="UT">UT</option>
												<option value="VT">VT</option>
												<option value="VA">VA</option>
												<option value="WA">WA</option>
												<option value="WV">WV</option>
												<option value="WI">WI</option>
												<option value="WY">WY</option>
											</select>
										</td>
										<td align="right"><img src="images/spacer.gif" alt="" width="14" height="1" border="0">Zip:</td>
										<td><input type="text" name="phone<? echo $counter; ?>_userzip" id="phone<? echo $counter; ?>_userzip" size="5" maxlength="10" tabindex="<? echo ($counter*20)+4; ?>" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
									</tr>
									<tr>
										<td colspan="3" align="right">Local/Desired Area Code:</td>
										<td ><input type="text" name="phone<? echo $counter; ?>_areacode" id="phone<? echo $counter; ?>_areacode" size="5" maxlength="10" tabindex="<? echo ($counter*20)+5; ?>" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
									</tr>
									<?
									if ($counter > 1){
									?>
									<tr>
										<script>
										function CopyUser<? echo $counter; ?>(){
											PushPort.phone<? echo $counter; ?>_username.value = PushPort.phone1_username.value;
											PushPort.phone<? echo $counter; ?>_usercity.value = PushPort.phone1_usercity.value;
											PushPort.phone<? echo $counter; ?>_userstate.value = PushPort.phone1_userstate.value;
											PushPort.phone<? echo $counter; ?>_userzip.value = PushPort.phone1_userzip.value;
											PushPort.phone<? echo $counter; ?>_areacode.value = PushPort.phone1_areacode.value;
										return;
										}
										</script>
										<td colspan="4" align="center"><br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br><a href="javascript:CopyUser<? echo $counter; ?>();" class="bodyBlack" style=" text-decoration:underline;"><strong>Click to Copy Phone 1's Information Here</strong></a></td>
									</tr>
									<?
									}
									?>
									</table>
								</td>
							</tr>
							</table>
						</td>
						<td bgcolor="#58639B"><img src="images/spacer.gif" alt="" width="2" height="1" border="0"></td>
						<td width="525" valign="top">
						<div id="noport<? echo $counter; ?>" style="position:relative; z-index:0; visibility:visible">
							<table width="525" border="0" align="center" class="biggerBlack">
							<tr>
								<td colspan="3" align="center"><strong>Keep Your Current Number...Port It!</strong><br><br></td>
							</tr>
							<tr>
								<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
								<td class="bodyBlack">
									<p><strong class="bigBlack">Bring Your Number</strong><br>
									With Wireless Local Number Portability (WLNP), you have the ability to switch wireless carriers without giving up your existing phone numbers. Now you can bring your current wireless number, from any other carrier, to your new <? echo $row["carrier"]; ?> phone.</p>								

									<p>To port an existing number to this phone, check the box in the blue bar above.</p>
								</td>
								<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
							</tr>
							</table>
							<div id="port<? echo $counter; ?>" style="position:absolute; top:0; left:0; z-index:1; visibility:hidden">
							<table width="525" border="0" align="center" class="biggerBlack">
							<tr>
								<td colspan="4" align="center"><strong>Keep Your Current Number...Port It!</strong></td>
							</tr>
							<tr>
								<td colspan="4" align="center" class="smallBlack"><strong>Fill out this form completely to port your existing number to this phone.</strong></td>
							</tr>
							<tr>
								<td align="right">Current Wireless Number:</td>
								<td><input type="text" name="phone<? echo $counter; ?>_port_number" id="phone<? echo $counter; ?>_port_number" size="15" maxlength="15" tabindex="<? echo ($counter*20)+6; ?>" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
								<td align="right">Acct #:</td>
								<td><input type="text" name="phone<? echo $counter; ?>_port_acctnum" id="phone<? echo $counter; ?>_port_acctnum" size="10" maxlength="50" tabindex="<? echo ($counter*20)+8; ?>" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
							</tr>
							<tr>
								<td align="right">Carrier Transferring From:</td>
								<td>
									<select  name="phone<? echo $counter; ?>_port_from" id="phone<? echo $counter; ?>_port_from" tabindex="<? echo ($counter*20)+7; ?>" class="bodyBlack" style="background-color: #FFE100; width: 106;">
										<option value="">Select</option>
<!--						                <option value="Sprint">Sprint</option>
						                <option value="Nextel">Nextel</option>-->
						                <option value="Cingular">Cingular</option>
										<option value="AT&T">AT&T</option>
										<option value="Verizon">Verizon</option>
										<option value="T-Mobile">T-Mobile</option>
						                <option value="Helio">Helio</option>
										<option value="Alltel">Alltel</option>
										<option value="US Cellular">US Cellular</option>
									</select>
<!--								<input type="text" name="phone<? echo $counter; ?>_port_from" id="phone<? echo $counter; ?>_port_from" size="15" maxlength="50" tabindex="<? echo ($counter*20)+7; ?>" class="bodyBlack" style="background-color: #FFE100;" value="">-->
								</td>
								<td align="right">Password:</td>
								<td><input type="text" name="phone<? echo $counter; ?>_port_password" id="phone<? echo $counter; ?>_port_password" size="10" maxlength="50" tabindex="<? echo ($counter*20)+9; ?>" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
							</tr>
							<tr>
								<td align="right">Name Exactly As On Bill:</td>
								<td colspan="3" align="right"><input type="text" name="phone<? echo $counter; ?>_port_billname" id="phone<? echo $counter; ?>_port_billname" size="26" maxlength="50" tabindex="<? echo ($counter*20)+10; ?>" class="bodyBlack" style="background-color: #FFE100;width: 290;" value=""><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
							</tr>
							<tr>
								<td align="right">Billing Address:</td>
								<td colspan="3">
									<input type="text" name="phone<? echo $counter; ?>_port_billaddr1" id="phone<? echo $counter; ?>_port_billaddr1" size="20" maxlength="50" tabindex="<? echo ($counter*20)+11; ?>" class="bodyBlack" style="background-color: #FFE100;" value="">
									<img src="images/spacer.gif" alt="" width="3" height="1" border="0">
									<input type="text" name="phone<? echo $counter; ?>_port_billaddr2" id="phone<? echo $counter; ?>_port_billaddr2" size="20" maxlength="50" tabindex="<? echo ($counter*20)+12; ?>" class="bodyBlack" style="background-color: #FFE100;width: 137;" value="">
								</td>
							</tr>
							<tr>
								<td align="right">Billing City/State/Zipcode:</td>
								<td colspan="3">
									<input type="text" name="phone<? echo $counter; ?>_port_billcity" id="phone<? echo $counter; ?>_port_billcity" size="20" maxlength="50" tabindex="<? echo ($counter*20)+13; ?>" class="bodyBlack" style="background-color: #FFE100;" value="">
									<img src="images/spacer.gif" alt="" width="3" height="1" border="0">
									<select name="phone<? echo $counter; ?>_port_billstate" id="phone<? echo $counter; ?>_port_billstate" tabindex="<? echo ($counter*20)+14; ?>" class="bodyBlack" style="background-color: #FFE100;">
										<option value="">Select</option>
						                <option value="AL">AL</option>
										<option value="AK">AK</option>
										<option value="AZ">AZ</option>
										<option value="AR">AR</option>
										<option value="CA">CA</option>
										<option value="CO">CO</option>
										<option value="CT">CT</option>
										<option value="DE">DE</option>
										<option value="DC">DC</option>
										<option value="FL">FL</option>
										<option value="GA">GA</option>
										<option value="HI">HI</option>
										<option value="ID">ID</option>
										<option value="IL">IL</option>
										<option value="IN">IN</option>
										<option value="IA">IA</option>
										<option value="KS">KS</option>
										<option value="KY">KY</option>
										<option value="LA">LA</option>
										<option value="ME">ME</option>
										<option value="MD">MD</option>
										<option value="MA">MA</option>
										<option value="MI">MI</option>
										<option value="MN">MN</option>
										<option value="MS">MS</option>
										<option value="MO">MO</option>
										<option value="MT">MT</option>
										<option value="NE">NE</option>
										<option value="NV">NV</option>
										<option value="NH">NH</option>
										<option value="NJ">NJ</option>
										<option value="NM">NM</option>
										<option value="NY">NY</option>
										<option value="NC">NC</option>
										<option value="ND">ND</option>
										<option value="OH">OH</option>
										<option value="OK">OK</option>
										<option value="OR">OR</option>
										<option value="PA">PA</option>
										<option value="RI">RI</option>
										<option value="SC">SC</option>
										<option value="SD">SD</option>
										<option value="TN">TN</option>
										<option value="TX">TX</option>
										<option value="UT">UT</option>
										<option value="VT">VT</option>
										<option value="VA">VA</option>
										<option value="WA">WA</option>
										<option value="WV">WV</option>
										<option value="WI">WI</option>
										<option value="WY">WY</option>
									</select>
									<img src="images/spacer.gif" alt="" width="3" height="1" border="0">
									<input type="text" name="phone<? echo $counter; ?>_port_billzip" id="phone<? echo $counter; ?>_port_billzip" size="6" maxlength="10" tabindex="<? echo ($counter*20)+15; ?>" class="bodyBlack" style="background-color: #FFE100;width: 57;" value="">
								</td>
							</tr>
							<?
							if ($counter > 1){
							?>
							<tr>
								<script>
								function CopyPort<? echo $counter; ?>(){
									PushPort.phone<? echo $counter; ?>_port_number.value = PushPort.phone1_port_number.value;
									PushPort.phone<? echo $counter; ?>_port_from.value = PushPort.phone1_port_from.value;
									PushPort.phone<? echo $counter; ?>_port_acctnum.value = PushPort.phone1_port_acctnum.value;
									PushPort.phone<? echo $counter; ?>_port_password.value = PushPort.phone1_port_password.value;
									PushPort.phone<? echo $counter; ?>_port_billname.value = PushPort.phone1_port_billname.value;
									PushPort.phone<? echo $counter; ?>_port_billaddr1.value = PushPort.phone1_port_billaddr1.value;
									PushPort.phone<? echo $counter; ?>_port_billaddr2.value = PushPort.phone1_port_billaddr2.value;
									PushPort.phone<? echo $counter; ?>_port_billcity.value = PushPort.phone1_port_billcity.value;
									PushPort.phone<? echo $counter; ?>_port_billstate.value = PushPort.phone1_port_billstate.value;
									PushPort.phone<? echo $counter; ?>_port_billzip.value = PushPort.phone1_port_billzip.value;
								return;
								}
								</script>
								<td colspan="4" align="center"><a href="javascript:CopyPort<? echo $counter; ?>();" class="bodyBlack" style=" text-decoration:underline;"><strong>Click to Copy Phone 1's Information Here</strong></a></td>
							</tr>
							<?
							}
							?>
							</table>
							</div>
						</div>
						<br>
						</td>
					</tr>		
				<?
					}
				}
				?>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<br>
			<input type="hidden" name="task" value="addport">
			<input type="hidden" name="sid" value="<? echo $SID; ?>">
<!--			<ul><input type="image" src="images/ContinueButton.gif" onClick="document.getElementById(this).submit();">-->
			<img src="images/spacer.gif" alt="" width="50" height="1" border="0"><input type="image" src="images/ContinueButton.gif">
			<br><br>
		<td>
		</form>
	</tr>
	</tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	</table>
<?
/********************************************** CUSTOMER INFO - Page 4 ******************************************************/
}elseif ($cargo == "info"){
?>
	<!-- Time/Date Math Function Libraries -->
	<script language="JavaScript" src="timedate.js"></script>	

	<script>
	function validateInfo(theForm){
	// First Name
		if (theForm.first_name){
			if (theForm.first_name.value == ""){
				theForm.first_name.style.background="#FF0000";
				alert("Please Enter Your First Name");
				theForm.first_name.style.background="#FFE100";
				theForm.first_name.focus();
				return false;
			}
		}
	// Last Name
		if (theForm.last_name){
			if (theForm.last_name.value == ""){
				theForm.last_name.style.background="#FF0000";
				alert("Please Enter Your Last Name");
				theForm.last_name.style.background="#FFE100";
				theForm.last_name.focus();
				return false;
			}
		}
	// Shipping Address (1)
		if (theForm.ship_address_1){
			if (theForm.ship_address_1.value == ""){
				theForm.ship_address_1.style.background="#FF0000";
				theForm.ship_address_2.style.background="#FF0000";
				alert("Please Enter Your Shipping Address");
				theForm.ship_address_1.style.background="#FFE100";
				theForm.ship_address_2.style.background="#FFE100";
				theForm.ship_address_1.focus();
				return false;
			}
		}
	// Shipping City
		if (theForm.ship_city){
			if (theForm.ship_city.value == ""){
				theForm.ship_city.style.background="#FF0000";
				alert("Please Enter Your Shipping City");
				theForm.ship_city.style.background="#FFE100";
				theForm.ship_city.focus();
				return false;
			}
		}
	// Shipping State
		if (theForm.ship_state){
			if (theForm.ship_state.value == ""){
				theForm.ship_state.style.background="#FF0000";
				alert("Please Select Your Shipping State");
				theForm.ship_state.style.background="#FFE100";
				theForm.ship_state.focus();
				return false;
			}
		}
	// Shipping Zip Code
		if (theForm.ship_zipcode){
			if (theForm.ship_zipcode.value == ""){
				theForm.ship_zipcode.style.background="#FF0000";
				alert("Please Enter Your Shipping Zipcode");
				theForm.ship_zipcode.style.background="#FFE100";
				theForm.ship_zipcode.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.ship_zipcode.value) == false && cdn_regex.test(theForm.ship_zipcode.value) == false) { 
 			if (usa_regex.test(theForm.ship_zipcode.value) == false) { 
				theForm.ship_zipcode.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.ship_zipcode.style.background="#FFE100";
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
				theForm.bill_address_1.style.background="#FFE100";
				theForm.bill_address_2.style.background="#FFE100";
				theForm.bill_address_1.focus();
				return false;
			}
		}
	// Billing City
		if (theForm.bill_city){
			if (theForm.bill_city.value == ""){
				theForm.bill_city.style.background="#FF0000";
				alert("Please Enter Your Billing City");
				theForm.bill_city.style.background="#FFE100";
				theForm.bill_city.focus();
				return false;
			}
		}
	// Billing State
		if (theForm.bill_state){
			if (theForm.bill_state.value == ""){
				theForm.bill_state.style.background="#FF0000";
				alert("Please Select Your Billing State");
				theForm.bill_state.style.background="#FFE100";
				theForm.bill_state.focus();
				return false;
			}
		}
	// Billing Zip Code
		if (theForm.bill_zipcode){
			if (theForm.bill_zipcode.value == ""){
				theForm.bill_zipcode.style.background="#FF0000";
				alert("Please Enter Your Billing Zipcode");
				theForm.bill_zipcode.style.background="#FFE100";
				theForm.bill_zipcode.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.bill_zipcode.value) == false && cdn_regex.test(theForm.bill_zipcode.value) == false) { 
 			if (usa_regex.test(theForm.bill_zipcode.value) == false) { 
				theForm.bill_zipcode.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.bill_zipcode.style.background="#FFE100";
				theForm.bill_zipcode.focus();
				return false;
			}
		}
	// Home Phone Number
		if (theForm.home_phone){
			if (theForm.home_phone.value == ""){
				theForm.home_phone.style.background="#FF0000";
				alert("Please Enter Your Home Phone Number");
				theForm.home_phone.style.background="#FFE100";
				theForm.home_phone.focus();
				return false;
			}
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.home_phone.value) == false && phone2_regex.test(theForm.home_phone.value) == false) { 
				theForm.home_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.home_phone.style.background="#FFE100";
				theForm.home_phone.focus();
				return false;
			}
		}
	// Alternate Phone Number
		if (theForm.alt_phone.value != ""){
//		if (theForm.alt_phone){
//			if (theForm.alt_phone.value == ""){
//				theForm.alt_phone.style.background="#FF0000";
//				alert("Please Enter An Alternate Phone Number");
//				theForm.alt_phone.style.background="#FFE100";
//				theForm.alt_phone.focus();
//				return false;
//			}
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.alt_phone.value) == false && phone2_regex.test(theForm.alt_phone.value) == false) { 
				theForm.alt_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.alt_phone.style.background="#FFE100";
				theForm.alt_phone.focus();
				return false;
			}
		}
	// Existing Sprint PCS Phone Number
		if (theForm.carrier_phone){
			if (theForm.carrier_phone.value != ""){
				var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
				var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
	 			if (phone1_regex.test(theForm.carrier_phone.value) == false && phone2_regex.test(theForm.carrier_phone.value) == false) { 
					theForm.carrier_phone.style.background="#FF0000";
					alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN or leave blank');
					theForm.carrier_phone.style.background="#FFE100";
					theForm.carrier_phone.focus();
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
				theForm.email.style.background="#FFE100";
				theForm.email_confirm.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "@"
	 		if (theForm.email.value.indexOf("@") == -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain an "@"');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "@" as first char.
	 		if (theForm.email.value.indexOf("@") == 0) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "@"');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for anything after "@"
	 		if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a Domain Name After the "@"');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for multiple "@"
	 		if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain Only One "@"');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "."
	 		if (theForm.email.value.indexOf(".") == -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a "."');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "." as first char.
	 		if (theForm.email.value.indexOf(".") == 0) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "."');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for ".."
	 		if (theForm.email.value.indexOf("..") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots ("..")');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "." adjacent to "@"
	 		if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for TLD
	 		if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for TLD at least 2 char.
			var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
			if (domain.length - (domain.indexOf(".")+1) < 2) {
				theForm.email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for TLD over 3 char.
//			if (domain.length - (domain.indexOf(".")+1) > 3) {
//				theForm.email.style.background="#FF0000";
//				alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//				theForm.email.style.background="#FFE100";
//				theForm.email.focus();
//				return false;
//			}
			// Check for "_" in TLD
			if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
				theForm.email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for spaces
	 		if (theForm.email.value.indexOf(" ") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Spaces (" ")');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for illegal char.
			var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	 		if (email_regex.test(theForm.email.value) == false) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			if (theForm.email.value != theForm.email_confirm.value){
				theForm.email.style.background="#FF0000";
				theForm.email_confirm.style.background="#FF0000";
				alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
				theForm.email.style.background="#FFE100";
				theForm.email_confirm.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
		}
	// SSN
		if (theForm.ssn){
			if (theForm.ssn.value == ""){
				theForm.ssn.style.background="#FF0000";
				alert("Please Enter Your Social Security Number");
				theForm.ssn.style.background="#FFE100";
				theForm.ssn.focus();
				return false;
			}
			var ssn_regex = /(^\d{3}-\d{2}-\d{4}$)/;  // xxx-xx-xxxx
 			if (ssn_regex.test(theForm.ssn.value) == false) { 
				theForm.ssn.style.background="#FF0000";
				alert('Please Enter a Valid Social Security Number as "NNN-NN-NNNN"');
				theForm.ssn.style.background="#FFE100";
				theForm.ssn.focus();
				return false;
			}
		}
	// Date of Birth
		if (theForm.dob){
			if (theForm.dob.value == ""){
				theForm.dob.style.background="#FF0000";
				alert("Please Enter Your Date of Birth");
				theForm.dob.style.background="#FFE100";
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
				theForm.dob.style.background="#FFE100";
				theForm.dob.focus();
				return false;
			}
			// is it a valid date?
			if (isValidDate(theForm.dob.value) == false){
				theForm.dob.style.background="#FF0000";
				alert("Please Enter A Valid Date for Date of Birth");
				theForm.dob.style.background="#FFE100";
				theForm.dob.focus();
				return false;
			}
			// are they 18?
			var now = new Date();
			var then = new Date(now.getTime()-(1000*60*60*24*365*18+345600000)); // 18 years ago + 4 days for leap years
			if (compareDates(theForm.dob.value,"M/d/yyyy",formatDate(then,'M/d/yyyy'),"M/d/yyyy") == 1){
				theForm.dob.style.background="#FF0000";
				alert("The Birth Date you entered indicates you are not yet 18 - you must be at least 18 to order a phone.");
				theForm.dob.style.background="#FFE100";
				theForm.dob.focus();
				return false;
			}
		}
	// Driver's License Number
		if (theForm.dl_num){
			if (theForm.dl_num.value == ""){
				theForm.dl_num.style.background="#FF0000";
				alert("Please Enter Your Driver's License Number");
				theForm.dl_num.style.background="#FFE100";
				theForm.dl_num.focus();
				return false;
			}
		}
	// Driver's License State
		if (theForm.dl_state){
			if (theForm.dl_state.value == ""){
				theForm.dl_state.style.background="#FF0000";
				alert("Please Select Your Driver's License State");
				theForm.dl_state.style.background="#FFE100";
				theForm.dl_state.focus();
				return false;
			}
		}

///////////////////////////////////////////////////////////////////

	// Driver's License Expiration Month
		if (theForm.dl_exp_month){
			if (theForm.dl_exp_month.value == ""){
				theForm.dl_exp_month.style.background="#FF0000";
				alert("Please Select Your Driver's License Expiration Month");
				theForm.dl_exp_month.style.background="#FFE100";
				theForm.dl_exp_month.focus();
				return false;
			}
		}
	// Driver's License Expiration Day
		if (theForm.dl_exp_day){
			if (theForm.dl_exp_day.value == ""){
				theForm.dl_exp_day.style.background="#FF0000";
				alert("Please Select Your Driver's License Expiration Day\n\r(Choose the last day of the month if there isn't an expiration day)");
				theForm.dl_exp_day.style.background="#FFE100";
				theForm.dl_exp_day.focus();
				return false;
			}
		}
	// Driver's License Expiration Year
		if (theForm.dl_exp_year){
			if (theForm.dl_exp_year.value == ""){
				theForm.dl_exp_year.style.background="#FF0000";
				alert("Please Select Your Credit Card Expiration Year");
				theForm.dl_exp_year.style.background="#FFE100";
				theForm.dl_exp_year.focus();
				return false;
			}
		}
	// Driver's License Expiration Date Passed?
		var expires = new Date(theForm.dl_exp_year.value,theForm.dl_exp_month.value-1,theForm.dl_exp_day.value,0,0);
			if (compareDates(formatDate(expires,'MMM d, y'),"MMM d, y",formatDate(new Date(),'MMM d, y'),"MMM d, y")== 0){
			theForm.dl_exp_month.style.background="#FF0000";
			theForm.dl_exp_day.style.background="#FF0000";
			theForm.dl_exp_year.style.background="#FF0000";
			alert("The Expiration Date You Entered Indicates That Your Driver's License Is Expired");
			theForm.dl_exp_month.style.background="#FFE100";
			theForm.dl_exp_day.style.background="#FFE100";
			theForm.dl_exp_year.style.background="#FFE100";
			theForm.dl_exp_month.focus();
			return false;
		}

////////////////////////////////////////////////////////////////

	// Credit Card Type
		if (theForm.cc_type){
			if (theForm.cc_type.value == ""){
				theForm.cc_type.style.background="#FF0000";
				alert("Please Select Your Credit Card Type");
				theForm.cc_type.style.background="#FFE100";
				theForm.cc_type.focus();
				return false;
			}
		}
	// Credit Card Expiration Month
		if (theForm.exp_month){
			if (theForm.exp_month.value == ""){
				theForm.exp_month.style.background="#FF0000";
				alert("Please Select Your Credit Card Expiration Month");
				theForm.exp_month.style.background="#FFE100";
				theForm.exp_month.focus();
				return false;
			}
		}
	// Credit Card Expiration Year
		if (theForm.exp_year){
			if (theForm.exp_year.value == ""){
				theForm.exp_year.style.background="#FF0000";
				alert("Please Select Your Credit Card Expiration Year");
				theForm.exp_year.style.background="#FFE100";
				theForm.exp_year.focus();
				return false;
			}
		}
	// Credit Card Expiration Date Passed?
		var expires = new Date(theForm.exp_year.value,theForm.exp_month.value,0,0,0);
			if (compareDates(formatDate(expires,'MMM d, y'),"MMM d, y",formatDate(new Date(),'MMM d, y'),"MMM d, y")== 0){
			theForm.exp_month.style.background="#FF0000";
			theForm.exp_year.style.background="#FF0000";
			alert("The Expiration Date You Entered Indicates That The Credit Card Is Expired");
			theForm.exp_month.style.background="#FFE100";
			theForm.exp_year.style.background="#FFE100";
			theForm.exp_month.focus();
			return false;
		}
	// Credit Card Name
		if (theForm.cc_name){
			if (theForm.cc_name.value == ""){
				theForm.cc_name.style.background="#FF0000";
				alert("Please Enter The Name Exactly As It Appears On Your Credit Card");
				theForm.cc_name.style.background="#FFE100";
				theForm.cc_name.focus();
				return false;
			}
		}
	// Credit Card Number
		if (theForm.cc_num){
			if (theForm.cc_num.value == ""){
				theForm.cc_num.style.background="#FF0000";
				alert("Please Enter The Credit Card Number");
				theForm.cc_num.style.background="#FFE100";
				theForm.cc_num.focus();
				return false;
			}
			// Verify Card Number Form
			switch(theForm.cc_type.value){
				// Visa
				case 'Visa':
				// 13 or 16 Digits Starting With "4"
					var prefix = parseInt(theForm.cc_num.value.substring(0,1));
					if ((theForm.cc_num.value.length != 13 && theForm.cc_num.value.length != 16) || prefix != 4){
						theForm.cc_num.style.background="#FF0000";
						alert("Please Enter A Valid Visa Card Number");
						theForm.cc_num.style.background="#FFE100";
						theForm.cc_num.focus();
						return false;
					}
 					break;
				// Mastercard
				case 'MasterCard':
				// 16 Digits Starting With Ranging From "51" to "55"
					var prefix = parseInt(theForm.cc_num.value.substring(0,2));
					if (theForm.cc_num.value.length != 16 || (prefix < 51 || prefix > 55)){
						theForm.cc_num.style.background="#FF0000";
						alert("Please Enter A Valid MasterCard Number");
						theForm.cc_num.style.background="#FFE100";
						theForm.cc_num.focus();
						return false;
					}
 					break;
				// Amex
				case 'American Express':
				// 15 Digits Starting With "34" or "37"
					var prefix = parseInt(theForm.cc_num.value.substring(0,2));
					if (theForm.cc_num.value.length != 15 || (prefix != 34 && prefix != 37)){
						theForm.cc_num.style.background="#FF0000";
						alert("Please Enter A Valid American Express Card Number");
						theForm.cc_num.style.background="#FFE100";
						theForm.cc_num.focus();
						return false;
					}
					break;
				// Discover
				case 'Discover':
				// 16 Digits Starting With "6011"
					var prefix = parseInt(theForm.cc_num.value.substring(0,4));
					if (theForm.cc_num.value.length != 16 || prefix != 6011){
						theForm.cc_num.style.background="#FF0000";
						alert("Please Enter A Valid Discover Card Number");
						theForm.cc_num.style.background="#FFE100";
						theForm.cc_num.focus();
						return false;
					}
 					break;
			}
			// Verify Card Number Against Check Digit Using MOD10
			var ar = new Array(theForm.cc_num.value.length);
			var i = 0,sum = 0;
			for(i = 0; i < theForm.cc_num.value.length; ++i){
				ar[i] = parseInt(theForm.cc_num.value.charAt(i));
			}
			for(i = ar.length -2; i >= 0; i-=2){	// you have to start from the right, and work back.
				ar[i] *= 2;							// every second digit starting with the right most (check digit)
				if(ar[i] > 9) ar[i]-=9;				// will be doubled, and summed with the skipped digits.
			}										// if the double digit is > 9, ADD those individual digits together 
			for(i = 0; i < ar.length; ++i){
				sum += ar[i];
			}
			if ((sum%10)!=0){						// if the sum is not evenly divisible by 10 it fails
				theForm.cc_num.style.background="#FF0000";
				alert("Please Enter A Valid Credit Card Number");
				theForm.cc_num.style.background="#FFE100";
				theForm.cc_num.focus();
				return false;
			}
		}
	// Credit Card CID
		if (theForm.cc_cid){
			if (theForm.cc_cid.value == ""){
				theForm.cc_cid.style.background="#FF0000";
				alert("Please Enter Your Credit Card CID Security Code");
				theForm.cc_cid.style.background="#FFE100";
				theForm.cc_cid.focus();
				return false;
			}
		}
		return true;
	}
	</script>

	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="199" align="center" background="images/YellowTab200BG.gif" class="bigBlack"><strong>Account Information<br><span class="smallBlack">Step 4 of 5</span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<table width="930" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
			<tr>
				<td width="100"><img src="images/spacer.gif" alt="" width="100" height="1" border="0"></td>
				<td align="center" class="bigBlack"><br><strong><? echo $message; ?><br><br></strong></td>
				<td width="100"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<form action="saveit.php" method="post" name="PushInfo" id="PushInfo" onSubmit="return validateInfo(this);">
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
			<tr bgcolor="#58639B">
				<td width="900" class="bodyWhite"><strong>&nbsp;Billing &amp; Shipping Information</strong></td>
			</tr>
			<tr>
				<td class="bodyBlack">
					<br>
					<ul>
						<li>For your protection, the information entered here must match what appears on your credit card statement!<br><a href="javascript:newwin=window.open('http://www.sprintpcs.com/support/help.html?helpID=155','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">We will ship only to your credit card billing address</a>.</li>
					</ul>
				</td>
			</tr>
			<tr bgcolor="#58639B">
				<td width="900" class="bodyWhite"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
			</tr>
			<tr>
				<td>
					<table width="900" border="0" cellspacing="0" cellpadding="5" align="center" class="borderNone">
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Name:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="first_name" id="first_name" size="30" maxlength="30" tabindex="1" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack">First</td>
								<td><input type="text" name="middle_name" id="middle_name" size="5" maxlength="5" tabindex="2" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack">MI</span></td>
								<td><input type="text" name="last_name" id="last_name" size="30" maxlength="30" tabindex="3" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack">Last</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Shipping Address:<br><span class="smallBlack">Make sure this matches<br>your credit card statement.<br><strong>Cannot be a P.O. Box.</strong></span></td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="ship_address_1" id="ship_address_1" size="30" maxlength="50" tabindex="4" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
								<td colspan="2"><input type="text" name="ship_address_2" id="ship_address_2" size="30" maxlength="50" tabindex="5" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
							</tr>
							<tr>
								<td><input type="text" name="ship_city" id="ship_city" size="30" maxlength="50" tabindex="6" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack">City</td>
								<td>
									<select name="ship_state" id="ship_state" tabindex="7" class="bodyBlack" style="background-color: #FFE100;">
										<option value="">Select</option>
						                <option value="AL">AL</option>
										<option value="AK">AK</option>
										<option value="AZ">AZ</option>
										<option value="AR">AR</option>
										<option value="CA">CA</option>
										<option value="CO">CO</option>
										<option value="CT">CT</option>
										<option value="DE">DE</option>
										<option value="DC">DC</option>
										<option value="FL">FL</option>
										<option value="GA">GA</option>
										<option value="HI">HI</option>
										<option value="ID">ID</option>
										<option value="IL">IL</option>
										<option value="IN">IN</option>
										<option value="IA">IA</option>
										<option value="KS">KS</option>
										<option value="KY">KY</option>
										<option value="LA">LA</option>
										<option value="ME">ME</option>
										<option value="MD">MD</option>
										<option value="MA">MA</option>
										<option value="MI">MI</option>
										<option value="MN">MN</option>
										<option value="MS">MS</option>
										<option value="MO">MO</option>
										<option value="MT">MT</option>
										<option value="NE">NE</option>
										<option value="NV">NV</option>
										<option value="NH">NH</option>
										<option value="NJ">NJ</option>
										<option value="NM">NM</option>
										<option value="NY">NY</option>
										<option value="NC">NC</option>
										<option value="ND">ND</option>
										<option value="OH">OH</option>
										<option value="OK">OK</option>
										<option value="OR">OR</option>
										<option value="PA">PA</option>
										<option value="RI">RI</option>
										<option value="SC">SC</option>
										<option value="SD">SD</option>
										<option value="TN">TN</option>
										<option value="TX">TX</option>
										<option value="UT">UT</option>
										<option value="VT">VT</option>
										<option value="VA">VA</option>
										<option value="WA">WA</option>
										<option value="WV">WV</option>
										<option value="WI">WI</option>
										<option value="WY">WY</option>
									</select>
									<br><span class="smallBlack">State</span>
								</td>
								<td><input type="text" name="ship_zipcode" id="ship_zipcode" size="10" maxlength="10" tabindex="8" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack">Zip Code</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<script>
						function CopyShip(){
							PushInfo.bill_address_1.value = PushInfo.ship_address_1.value;
							PushInfo.bill_address_2.value = PushInfo.ship_address_2.value;
							PushInfo.bill_city.value = PushInfo.ship_city.value;
							PushInfo.bill_state.value = PushInfo.ship_state.value;
							PushInfo.bill_zipcode.value = PushInfo.ship_zipcode.value;
						return;
						}
						</script>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Address:<br><span class="smallBlack"><a href="javascript:CopyShip();" class="smallBlack" style=" text-decoration:underline;">Click to Copy Shipping Address Here</strong></a></span></td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="bill_address_1" id="bill_address_1" size="30" maxlength="50" tabindex="9" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
								<td colspan="2"><input type="text" name="bill_address_2" id="bill_address_2" size="30" maxlength="50" tabindex="10" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
							</tr>
							<tr>
								<td><input type="text" name="bill_city" id="bill_city" size="30" maxlength="50" tabindex="11" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack">City</td>
								<td>
									<select name="bill_state" id="bill_state" tabindex="12" class="bodyBlack" style="background-color: #FFE100;">
										<option value="">Select</option>
						                <option value="AL">AL</option>
										<option value="AK">AK</option>
										<option value="AZ">AZ</option>
										<option value="AR">AR</option>
										<option value="CA">CA</option>
										<option value="CO">CO</option>
										<option value="CT">CT</option>
										<option value="DE">DE</option>
										<option value="DC">DC</option>
										<option value="FL">FL</option>
										<option value="GA">GA</option>
										<option value="HI">HI</option>
										<option value="ID">ID</option>
										<option value="IL">IL</option>
										<option value="IN">IN</option>
										<option value="IA">IA</option>
										<option value="KS">KS</option>
										<option value="KY">KY</option>
										<option value="LA">LA</option>
										<option value="ME">ME</option>
										<option value="MD">MD</option>
										<option value="MA">MA</option>
										<option value="MI">MI</option>
										<option value="MN">MN</option>
										<option value="MS">MS</option>
										<option value="MO">MO</option>
										<option value="MT">MT</option>
										<option value="NE">NE</option>
										<option value="NV">NV</option>
										<option value="NH">NH</option>
										<option value="NJ">NJ</option>
										<option value="NM">NM</option>
										<option value="NY">NY</option>
										<option value="NC">NC</option>
										<option value="ND">ND</option>
										<option value="OH">OH</option>
										<option value="OK">OK</option>
										<option value="OR">OR</option>
										<option value="PA">PA</option>
										<option value="RI">RI</option>
										<option value="SC">SC</option>
										<option value="SD">SD</option>
										<option value="TN">TN</option>
										<option value="TX">TX</option>
										<option value="UT">UT</option>
										<option value="VT">VT</option>
										<option value="VA">VA</option>
										<option value="WA">WA</option>
										<option value="WV">WV</option>
										<option value="WI">WI</option>
										<option value="WY">WY</option>
									</select>
									<br><span class="smallBlack">State</span>
								</td>
								<td><input type="text" name="bill_zipcode" id="bill_zipcode" size="10" maxlength="10" tabindex="13" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack">Zip Code</span></td>
							</tr>
							</table>
						</td>
					</tr>

					<?
					if ($ask_employer == "T"){
					?>
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Employer Name:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="employer_name" id="employer_name" size="30" maxlength="30" tabindex="14" class="bodyBlack" style="background-color: #FFE100;" value=""><span class="smallBlack"> (So that we can check to see if you qualify for any employee discounts)<br>&nbsp;</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<?
					}
					?>

					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Phone Numbers:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="home_phone" id="home_phone" size="18" maxlength="13" tabindex="14" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack">Home</span></td>
								<td><input type="text" name="alt_phone" id="alt_phone" size="18" maxlength="13" tabindex="15" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack">Alternate</span></td>
								<td><input type="text" name="carrier_phone" id="carrier_phone" size="18" maxlength="13" tabindex="16" class="bodyBlack" style="background-color: #FFE100;" value=""><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.sprintpcs.com/support/help.html?helpID=158','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">(If this is an upgrade order)</a><br>Primary Sprint Number</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Email Address:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="email" id="email" size="30" maxlength="50" tabindex="17" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
								<td class="xbigBlack">&nbsp;&nbsp;Confirm:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="email_confirm" id="email_confirm" size="30" maxlength="50" tabindex="18" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
			<br>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
			<tr bgcolor="#58639B">
				<td width="900" class="bodyWhite"><strong>&nbsp;Credit Approval</strong></td>
			</tr>
			<tr>
				<td class="bodyBlack">
					<br>
					<ul>
						<li>The following information will assist in verifying your identity. By providing this information, you consent to <? echo $carrier_label; ?> pulling your credit report to determine creditworthiness. This site is secure. Encryption ensures that your confidential information will be securely transmitted to us.</li>
					</ul>
				</td>
			</tr>
			<tr bgcolor="#58639B">
				<td width="900" class="bodyWhite"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
			</tr>
			<tr>
				<td>
					<table width="900" border="0" cellspacing="0" cellpadding="5" align="center" class="borderNone">
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Social Security Number:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="ssn" id="ssn" size="20" maxlength="11" tabindex="19" class="bodyBlack" style="background-color: #FFE100;" value=""><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.sprintpcs.com/support/help.html?helpID=160','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">Why do you need my SSN</a>?<br>Format: 555-55-5555</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Date of Birth:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="dob" id="dob" size="30" maxlength="10" tabindex="20" class="bodyBlack" style="background-color: #FFE100;" value=""><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.sprintpcs.com/support/help.html?helpID=162','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">Why do you need my date of birth</a>?<br>Format: mm/dd/yyyy</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Driver's License Number:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="dl_num" id="dl_num" size="30" maxlength="50" tabindex="21" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
								<td class="xbigBlack">&nbsp;&nbsp;State:<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									<select name="dl_state" id="dl_state" tabindex="22" class="bodyBlack" style="background-color: #FFE100;">
										<option value="">Select</option>
						                <option value="AL">AL</option>
										<option value="AK">AK</option>
										<option value="AZ">AZ</option>
										<option value="AR">AR</option>
										<option value="CA">CA</option>
										<option value="CO">CO</option>
										<option value="CT">CT</option>
										<option value="DE">DE</option>
										<option value="DC">DC</option>
										<option value="FL">FL</option>
										<option value="GA">GA</option>
										<option value="HI">HI</option>
										<option value="ID">ID</option>
										<option value="IL">IL</option>
										<option value="IN">IN</option>
										<option value="IA">IA</option>
										<option value="KS">KS</option>
										<option value="KY">KY</option>
										<option value="LA">LA</option>
										<option value="ME">ME</option>
										<option value="MD">MD</option>
										<option value="MA">MA</option>
										<option value="MI">MI</option>
										<option value="MN">MN</option>
										<option value="MS">MS</option>
										<option value="MO">MO</option>
										<option value="MT">MT</option>
										<option value="NE">NE</option>
										<option value="NV">NV</option>
										<option value="NH">NH</option>
										<option value="NJ">NJ</option>
										<option value="NM">NM</option>
										<option value="NY">NY</option>
										<option value="NC">NC</option>
										<option value="ND">ND</option>
										<option value="OH">OH</option>
										<option value="OK">OK</option>
										<option value="OR">OR</option>
										<option value="PA">PA</option>
										<option value="RI">RI</option>
										<option value="SC">SC</option>
										<option value="SD">SD</option>
										<option value="TN">TN</option>
										<option value="TX">TX</option>
										<option value="UT">UT</option>
										<option value="VT">VT</option>
										<option value="VA">VA</option>
										<option value="WA">WA</option>
										<option value="WV">WV</option>
										<option value="WI">WI</option>
										<option value="WY">WY</option>
									</select>
								</td>
							</tr>
							</table>
						</td>
					</tr>

<!------------------------------------------------------------------------>

					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Driver's License Expiration:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td>
									<select name="dl_exp_month" id="dl_exp_month" class="bodyBlack" style="background-color:#FFE100; width:125px;" tabindex="23">
										<option value="">Month</option>
										<option value="01">(01) January</option>
										<option value="02">(02) February</option>
										<option value="03">(03) March</option>
										<option value="04">(04) April</option>
										<option value="05">(05) May</option>
										<option value="06">(06) June</option>
										<option value="07">(07) July</option>
										<option value="08">(08) August</option>
										<option value="09">(09) September</option>
										<option value="10">(10) October</option>
										<option value="11">(11) November</option>
										<option value="12">(12) December</option>
									</select>
									<select name="dl_exp_day" id="dl_exp_day" class="bodyBlack" style="background-color:#FFE100; width:65px;" tabindex="24">
										<option value="">Day</option>
<?
for ($option=1; $option <= 31; $option++){
	echo'
										<option value="'.iif($option<10,"0","").$option.'">'.$option.'</option>
	';
}
?>
									</select>
									<select name="dl_exp_year" id="dl_exp_year" class="bodyBlack" style="background-color: #FFE100; width: 67px;" tabindex="25">
										<option value="">Year</option>
<?
echo'
										<option value="'.date("Y").'">'.date("Y").'</option>
										<option value="'.(date("Y")+1).'">'.(date("Y")+1).'</option>
										<option value="'.(date("Y")+2).'">'.(date("Y")+2).'</option>
										<option value="'.(date("Y")+3).'">'.(date("Y")+3).'</option>
										<option value="'.(date("Y")+4).'">'.(date("Y")+4).'</option>
										<option value="'.(date("Y")+5).'">'.(date("Y")+5).'</option>
										<option value="'.(date("Y")+6).'">'.(date("Y")+6).'</option>
										<option value="'.(date("Y")+7).'">'.(date("Y")+7).'</option>
										<option value="'.(date("Y")+8).'">'.(date("Y")+8).'</option>
										<option value="'.(date("Y")+9).'">'.(date("Y")+9).'</option>
';
?>
									</select>
								</td>
							</tr>
							</table>
						</td>
					</tr>

<!-------------------------------------------------------------------------->

					</table>
				</td>
			</tr>
			</table>
			<br>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
			<tr bgcolor="#58639B">
				<td width="900" class="bodyWhite"><strong>&nbsp;Credit Card Information</strong></td>
			</tr>
<!--			<tr>
				<td class="bodyBlack">
					<br>
					<ul>
						<li>The following information will assist in verifying your identity. By providing this information, you consent to Sprint pulling your credit report to determine creditworthiness. This site is secure. Encryption ensures that your confidential information will be securely transmitted to us.</li>
					</ul>
				</td>
			</tr>
			<tr bgcolor="#58639B">
				<td width="900" class="bodyWhite"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
			</tr>-->
			<tr>
				<td>
					<table width="900" border="0" cellspacing="0" cellpadding="5" align="center" class="borderNone">
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Credit Card Type:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td>
									<select name="cc_type" id="cc_type" class="bodyBlack" style="background-color: #FFE100; width: 195px;" tabindex="26">
										<option value="">Select Type of Card</option>
										<option value="Visa">Visa</option>
										<option value="MasterCard">MasterCard</option>
										<option value="American Express">American Express</option>
										<option value="Discover">Discover</option>
									</select>
								</td>
								<td class="xbigBlack">&nbsp;&nbsp;Expiration:<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									<select name="exp_month" id="exp_month" class="bodyBlack" style="background-color:#FFE100; width:125px;" tabindex="27">
										<option value="">Month</option>
										<option value="01">(01) January</option>
										<option value="02">(02) February</option>
										<option value="03">(03) March</option>
										<option value="04">(04) April</option>
										<option value="05">(05) May</option>
										<option value="06">(06) June</option>
										<option value="07">(07) July</option>
										<option value="08">(08) August</option>
										<option value="09">(09) September</option>
										<option value="10">(10) October</option>
										<option value="11">(11) November</option>
										<option value="12">(12) December</option>
									</select>
									<select name="exp_year" id="exp_year" class="bodyBlack" style="background-color: #FFE100; width: 67px;" tabindex="28">
										<option value="">Year</option>
<?
echo'
										<option value="'.date("Y").'">'.date("Y").'</option>
										<option value="'.(date("Y")+1).'">'.(date("Y")+1).'</option>
										<option value="'.(date("Y")+2).'">'.(date("Y")+2).'</option>
										<option value="'.(date("Y")+3).'">'.(date("Y")+3).'</option>
										<option value="'.(date("Y")+4).'">'.(date("Y")+4).'</option>
										<option value="'.(date("Y")+5).'">'.(date("Y")+5).'</option>
										<option value="'.(date("Y")+6).'">'.(date("Y")+6).'</option>
										<option value="'.(date("Y")+7).'">'.(date("Y")+7).'</option>
										<option value="'.(date("Y")+8).'">'.(date("Y")+8).'</option>
										<option value="'.(date("Y")+9).'">'.(date("Y")+9).'</option>
';
?>
									</select>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>Credit Card Number:</td>
						<td>
							<img src="images/spacer.gif" alt="" width="1" height="6" border="0"><br>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="cc_num" id="cc_num" size="30" maxlength="25" tabindex="29" class="bodyBlack" style="background-color: #FFE100;" value="" onkeypress="return onlyNumbers(event)"><br><span class="smallBlack">Numbers Only</span></td>
								</td>
								<td valign="top" class="xbigBlack">&nbsp;&nbsp;Credit Card CID:<img src="images/spacer.gif" alt="" width="10" height="1" border="0"><input type="text" name="cc_cid" id="cc_cid" size="5" maxlength="5" tabindex="30" class="bodyBlack" style="background-color: #FFE100;" value="" onkeypress="return onlyNumbers(event)"><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.<? $domain; ?>/cid_<? echo $carrier_label; ?>.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">What is this</a>?</span>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Name On Credit Card:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="cc_name" id="cc_name" size="30" maxlength="50" tabindex="31" class="bodyBlack" style="background-color: #FFE100;" value=""> <span class="smallBlack">(Exactly as it appears on the card.)</span></td>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<br>
			<input type="hidden" name="task" value="addinfo">
			<input type="hidden" name="affiliation" value="<? echo $label; ?>">
			<input type="hidden" name="sid" value="<? echo $SID; ?>">
			<img src="images/spacer.gif" alt="" width="50" height="1" border="0"><input type="image" name="submit" src="images/ContinueButton.gif">
			<br><br>
		<td>
		</form>
	</tr>
	</tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	</table>
<?
/********************************************** CONFIRMATION - Page 5 ******************************************************/
}elseif ($cargo == "confirm"){
	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);
	$row = mysql_fetch_assoc($rs_cart);
	setlocale(LC_MONETARY , 'en_US');
	?>
	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="199" align="center" background="images/YellowTab200BG.gif" class="bigBlack"><strong>Order Summary<br><span class="smallBlack">Step 5 of 5</span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
	<!--	<td colspan="2" bgcolor="#FFFFFF"><img src="images/spacer.gif" alt="" width="930" height="400" border="0"></td>-->
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
			<tr>
				<td width="40" rowspan="2"><img src="images/spacer.gif" alt="" width="40" height="1" border="0"></td>
				<td width="60"><img src="images/spacer.gif" alt="" width="60" height="1" border="0"></td>
				<td width="730" align="center" class="bigBlack"><br><strong><? echo stripslashes($message); ?><br><br></strong></td>
				<td width="100" rowspan="2"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
			</tr>
			<tr>
				<td colspan="2" class="bigBlack">Please verify the following information. Use your browser's "Back" button to go back and make corrections.<br><br><strong>To complete your order, you MUST agree to the <em>Terms of Service</em> below, signified by checking the accompanying checkbox, and click the "Submit Order" button.  Your order is NOT complete until you take this final step and submit this page.</strong><br><br></td>
			</tr>
			</table>
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B">
						<td width="900" class="bodyWhite">&nbsp;Customer Information</td>
					</tr>
					<tr>
						<td align="center">
							<table width="100%" border="0" class="borderNone">
							<tr>
								<td colspan="3">
									<strong class="bigBlack"><? echo $row["first_name"].' '.iif($row["middle_name"] != '', $row["middle_name"].' ', '').$row["last_name"].'&nbsp;&nbsp;('.$row["email"].')'; ?></strong>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="295">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="60" valign="top"><strong>Ship To:&nbsp;</strong></td>
										<td>
											<? echo $row["ship_address_1"]; ?><br>
											<? echo iif($row["ship_address_2"] != '', $row["ship_address_2"].'<br>', ''); ?>
											<? echo $row["ship_city"].', '.$row["ship_state"].'&nbsp;&nbsp;'.$row["ship_zipcode"] ?><br><br>
										</td>
									</tr>
									<tr>
										<td valign="top"><strong>Bill To:&nbsp;</strong></td>
										<td>
											<? echo $row["bill_address_1"]; ?><br>
											<? echo iif($row["bill_address_2"] != '', $row["bill_address_2"].'<br>', ''); ?>
											<? echo $row["bill_city"].', '.$row["bill_state"].'&nbsp;&nbsp;'.$row["bill_zipcode"] ?><br><br>
										</td>
									</tr>
									</table>
								</td>
								<td width="295" valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="150"><strong>Home Phone:&nbsp;</strong></td>
										<td><? echo $row["home_phone"]; ?></td>
									</tr>
									<tr>
										<td><strong>Alternate Phone:&nbsp;</strong></td>
										<td><? echo $row["alt_phone"]; ?></td>
									</tr>
									<?
									if ($row["carrier_phone"] != ''){
										echo'
									<tr>
										<td><strong>Sprint Phone:&nbsp;</strong></td>
										<td>'.$row["carrier_phone"].'</td>
									</tr>
										';
									}
									?>
									<tr>
										<td><br><strong>Social Security Num:&nbsp;</strong></td>
										<td valign="bottom"><? echo $row["ssn"]; ?></td>
									</tr>
									<tr>
										<td><strong>Date of Birth:&nbsp;</strong></td>
										<td><? echo $row["dob"]; ?></td>
									</tr>
									<tr>
										<td><strong><? echo $row["dl_state"]; ?> Driver's License:&nbsp;</strong></td>
										<td><? echo $row["dl_num"]; ?></td>
									</tr>
									</table>
								</td>
								<td width="295" valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
									<tr>
										<td width="125"><strong>Credit Card Type:&nbsp;</strong></td>
										<td><? echo $row["cc_type"]; ?></td>
									</tr>
									<tr>
										<td><strong>Credit Card Num:&nbsp;</strong></td>
										<td><? echo $row["cc_num"]; ?></td>
									</tr>
									<tr>
										<td><strong>Credit Card CID:&nbsp;</strong></td>
										<td><? echo $row["cc_cid"]; ?></td>
									</tr>
									<tr>
										<td><strong>Credit Card Exp:&nbsp;</strong></td>
										<td><? echo $row["cc_expiration"]; ?></td>
									</tr>
									<tr>
										<td valign="top"><strong>Name on Card:&nbsp;</strong></td>
										<td><? echo $row["cc_name"]; ?></td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
					<br>
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B" class="bodyWhite">
						<td>&nbsp;Phone Information</td>
						<td width="200" align="center">Price</td>
						<td width="100" align="center">After Rebates</td>
						<td width="100" align="center">Due Today</td>
					</tr>
					<?
					$today_subtotal = 0;
					$tomorrow_subtotal = 0;
					$phones_ordered = 0;
					for ($counter=1; $counter <= 5; $counter++){
						if ($row['phone'.$counter.'_id'] != ""){
							$query = "SELECT * FROM phones WHERE product_id='".$row['phone'.$counter.'_id']."'";
							$rs_phone = mysql_query($query, $linkID);
							$phone = mysql_fetch_assoc($rs_phone);
					?>
					<tr>
						<td>
							<table width="490" border="0" cellspacing="2" class="borderNone">
							<tr>
								<td colspan="2" class="smallBlack"><strong><? echo $phone["label"]; ?></strong><br></td>
							</tr>
							<tr>
								<td width="70" valign="top"><img src="images/phones/<? echo $phone["thumbnail"]; ?>" alt="" width="70" height="130" border="0"></td>
								<td valign="top">
									<table width="400" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
									<tr>
										<td>
											<strong>User Information:</strong><br>
										</td>
									</tr>
									<tr>
										<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
									</tr>
									<tr>
										<td>
											<? echo $row["phone".$counter."_username"]; ?><br>
											<? echo $row["phone".$counter."_usercity"].', '.$row["phone".$counter."_userstate"].', '.$row["phone".$counter."_userzip"] ?><br>
											<strong>Local/Desired Area Code:&nbsp;</strong> <? echo $row["phone".$counter."_areacode"]; ?>
										</td>
									</tr>
									<tr>
										<td>
											<br>
											<strong>Porting Information:</strong><br>
										</td>
									</tr>
									<tr>
										<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
									</tr>
									<tr>
										<td>
											<?
											if ($row["phone".$counter."_port_number"] == ""){
												echo 'This phone will be assigned a new phone number.';
											}else{
											?>
											<? echo $row["phone".$counter."_port_number"]; ?> transferred from <? echo $row["phone".$counter."_port_from"]; ?> to this phone.<br>
										</td>
									</tr>
									<tr>
										<td>
											<table border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
											<tr>
												<td valign="top"><strong>Acct#:&nbsp;</strong></td>
												<td valign="top">
											<? echo $row["phone".$counter."_port_acctnum"]; ?>, <strong>Password:</strong> <? echo iif($row["phone".$counter."_port_password"] != '', '"'.$row["phone".$counter."_port_password"].'"', "None Supplied"); ?>
												</td>
											</tr>
											<tr>
												<td valign="top"><strong>From:&nbsp;</strong></td>
												<td valign="top">
													<? echo $row["phone".$counter."_port_billname"]; ?><br>
													<? echo $row["phone".$counter."_port_billaddr1"]; ?><br>
													<? echo iif($row["phone".$counter."_port_billaddr2"] != '', $row["phone".$counter."_port_billaddr2"].'<br>', ''); ?>
													<? echo $row["phone".$counter."_port_billcity"].', '.$row["phone".$counter."_port_billstate"].', '.$row["phone".$counter."_port_billzip"] ?><br><br>
												</td>
											</tr>
											</table>
											<?
											}
											?>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
						</td>
					<?
					// Build a text string, with formatting, for the final sale price.
					$price = ($row['phone'.$counter.'_msrp']-($row['phone'.$counter.'_ir1']+$row['phone'.$counter.'_ir2']+$row['phone'.$counter.'_mir1']+$row['phone'.$counter.'_mir2']));
					if ($gift_card > 0){
						$price -= $gift_card;
					}
					$today = ($row['phone'.$counter.'_msrp']-($row['phone'.$counter.'_ir1']+$row['phone'.$counter.'_ir2']));
					$today_subtotal += $today;
					$tomorrow = ($today-($row['phone'.$counter.'_mir1']+$row['phone'.$counter.'_mir2']));
					if ($gift_card > 0){
						$tomorrow -= $gift_card;
					}
					$tomorrow_subtotal += $tomorrow;
					$phones_ordered++;
					if ($price < 0){
						// You MAKE money
						$total_label = '<font color="#FF0000">in your pocket*</font>';
						$total = '<font color="#FF0000">'.money_format('%-#4n', abs($price)).'</font>';
					}else{
						// If there is a price, show it with 2 decimal places
						$total_label = 'your price*';
						$total = money_format('%-#4n', $price);
						$total_today = money_format('%-#4n', $today);
						$total_tomorrow = money_format('%-#4n', $tomorrow);
					};
					if ($today < 0){
						$total_today = '<font color="#FF0000">'.money_format('%-#4n', $today).'</font>';
					}else{
						$total_today = money_format('%-#4n', $today);
					}
					if ($tomorrow < 0){
						$total_tomorrow = '<font color="#FF0000">'.money_format('%-#4n', $tomorrow).'</font>';
					}else{
						$total_tomorrow = money_format('%-#4n', $tomorrow);
					}
					echo '
						<td align="center" valign="bottom">
							<table width="175" border="0" cellspacing="1" cellpadding="0" class="borderNone">
							<tr class="bodyBlack">
								<td align="right">'.money_format("%-#4n", $row['phone'.$counter.'_msrp']).'</td>
								<td>&nbsp;regular price</td>
							</tr>
							<tr class="bodyBlack">
								<td align="right">-'.money_format("%-#4n", $row["phone".$counter."_ir1"]+$row["phone".$counter."_ir2"]).'</td>
								<td>&nbsp;instant savings</td>
							</tr>
							<tr class="bodyBlack">
								<td align="right">-'.money_format("%-#4n", $row["phone".$counter."_mir1"]+$row["phone".$counter."_mir2"]).'</td>
								<td>&nbsp;mail-in rebate'.iif($row["phone".$counter."_mir1"] != 0 && $row["phone".$counter."_mir2"] != 0, "s", "").'</td>
							</tr>
					';
			 		if ($gift_card > 0){
						echo'
							<tr class="bodyBlack">
								<td align="right">-$';echo sprintf("%.2f", $gift_card);echo'</td>
								<td>&nbsp;Amex gift card</td>
							</tr>
							';
					}
					echo'
							<tr class="bodyBlack">
								<td width="100%" colspan="2"><img src="images/BlackDot.gif" alt="" width="100%" height="1" border="0"></td>
							</tr>
							<tr class="bodyBlack">
								<td align="right"><strong>'.$total.'</strong></td>
								<td>&nbsp;'.$total_label.'</td>
							</tr>
							</table>
							<br><br><br><br>
						</td>
						<td align="center" valign="bottom">
							<table width="70" border="0" cellspacing="1" cellpadding="0" class="borderNone">
<!--							<tr class="bodyBlack">
								<td align="right">-'.money_format("%-#4n", $today).'</td>
							</tr>
							<tr class="bodyBlack">
								<td align="right">-'.money_format("%-#4n", $row['phone'.$counter.'_mir1']+$row['phone'.$counter.'_mir2']).'</td>
							</tr>
							<tr class="bodyBlack">
								<td width="100%" colspan="2"><img src="images/BlackDot.gif" alt="" width="100%" height="1" border="0"></td>
							</tr>-->
							<tr class="bodyBlack">
								<td align="right">'.$total_tomorrow.'</td>
							</tr>
							</table>
							<br><br><br><br>
						</td>
						<td align="center" valign="bottom">
							<table width="70" border="0" cellspacing="1" cellpadding="0" class="borderNone">
<!--							<tr class="bodyBlack">
								<td align="right">'.money_format("%-#4n", $row['phone'.$counter.'_msrp']).'</td>
							</tr>
							<tr class="bodyBlack">
								<td align="right">-'.money_format("%-#4n", $row["phone".$counter."_ir1"]+$row["phone".$counter."_ir2"]).'</td>
							</tr>
							<tr class="bodyBlack">
								<td width="100%" colspan="2"><img src="images/BlackDot.gif" alt="" width="100%" height="1" border="0"></td>
							</tr>-->
							<tr class="bodyBlack">
								<td align="right">'.$total_today.'</td>
							</tr>
							</table>
							<br><br><br><br>
						</td>
					</tr>		
					';
						}
					}
					?>
					</tr>
					<tr>
						<td colspan="2" align="right" bgcolor="#58639B" class="bodyWhite"><strong>Phone<? echo iif($counter > 1, 's', ''); ?> Total:&nbsp;</strong></td>
						<td align="right" class="bodyBlack">
							<strong>
							<?
							if ($tomorrow_subtotal < 0){
								echo '<font color="#FF0000">'.money_format('%-#4n', $tomorrow_subtotal).'</font>&nbsp;&nbsp;&nbsp;&nbsp;';
							}else{
								echo money_format('%-#4n', $tomorrow_subtotal).'&nbsp;&nbsp;&nbsp;&nbsp;';
							}
							?>
							</strong>
						</td>				
						<td align="right" class="bodyBlack">
							<strong>
							<?
							if ($today_subtotal < 0){
								echo '<font color="#FF0000">'.money_format('%-#4n', $today_subtotal).'</font>&nbsp;&nbsp;&nbsp;&nbsp;';
							}else{
								echo money_format('%-#4n', $today_subtotal).'&nbsp;&nbsp;&nbsp;&nbsp;';
							}
							?>
							</strong>
						</td>
					</tr>
					</table>
					<br>
					<?
					if ($discount ==0){
					?>
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B" class="bodyWhite">
						<td>&nbsp;Plan Information</td>
						<td width="200" align="center">Monthly Service</td>
						<td width="100" align="center">Monthly Cost</td>
						<td width="100" align="center">&nbsp;</td>
					</tr>
						<?
						$plans = 0;
						$plan_cost = 0;
						if ($row["plan_id"] != ''){
							$plans++;
							$plan_cost += $row["plan_cost"];
							echo'
					<tr class="bodyBlack">
						<td>&nbsp;'.$row["plan_group"].' Plan</td>
							';
							if ($row["plan_minutes"] == 0){
								echo'
						<td align="center">Unlimited Minutes</td>
								';
							}else{
								echo'
						<td align="center">'.$row["plan_minutes"].' Minutes</td>
								';
							}
							echo'
						<td align="right">'.money_format('%-#4n', ($row["plan_cost"])).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right" bgcolor="#58639B">&nbsp;</td>
					</tr>
							';
						}
						if ($row["bb_plan_id"] != ''){
							$plans++;
							$plan_cost += $row["bb_plan_cost"];
							echo'
					<tr class="bodyBlack">
						<td>&nbsp;BlackBerry Data Plan</td>
						<td align="center">'.$row["bb_plan_usage"].'</td>
						<td align="right">'.money_format('%-#4n', ($row["bb_plan_cost"])).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right" bgcolor="#58639B">&nbsp;</td>
					</tr>
							';
						}
						if ($row["data_plan_id"] != ''){
							$plans++;
							$plan_cost += $row["data_plan_cost"];
							echo'
					<tr class="bodyBlack">
						<td>&nbsp;Data Plan</td>
						<td align="center">'.$row["data_plan_usage"].'</td>
						<td align="right">'.money_format('%-#4n', ($row["data_plan_cost"])).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right" bgcolor="#58639B">&nbsp;</td>
					</tr>
							';
						}
					?>
					<tr>
						<td colspan="2" align="right" bgcolor="#58639B" class="bodyWhite"><strong>Monthy Plan<? echo iif($plans > 1, 's', ''); ?> Total:&nbsp;</strong></td>
						<td align="right" class="bodyBlack"><strong><? echo money_format('%-#4n', $plan_cost); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right" bgcolor="#58639B" class="bodyBlack">&nbsp;</td>
					</tr>
					</table>
					<?
						$count = 0;
						if ($row["carrier"] == 'Sprint'){
							$options = array(
								sprint_power_vision,
								sprint_pcs_vision,
								sprint_blackberry_data,
								sms,
								nights
							);
							for ($counter=0; $counter <= count($options)-1; $counter++){
								if ($row[$options[$counter]] != '' && $row[$options[$counter]] != 'None'){
									$count++;
								}
							}
							$options = array(
								array('m2m', 'Unlimited Mobile to Mobile Calling'),
								array('protection', 'Sprint Total Equipment Protection'),
								array('aircard_protection', 'Aircard Total Equipment Protection'),
								array('rescue', 'Roadside Rescue')
//								array('voice_command', 'Sprint PCS Voice Command')
							);
							for ($counter=0; $counter <= count($options)-1; $counter++){
								if ($row[$options[$counter][0]] != 0){
									$count++;
								}
							}
						}
						if ($row["carrier"] == 'Nextel'){
							$options = array(
								array('nextel_add_on_50', '50 Add-On Minutes'),
								array('m2m', 'Unlimited Mobile to Mobile Calling'),
								array('nights_price', 'Nights & Weekends Starting at 6:00pm'),
								array('nextel_sprint2home', 'Sprint to Home'),
								array('nextel_mobile2office', 'Mobile to Office'),
								array('nextel_unltd_walkie', 'Unlimited Nextel Walkie-Talkie'),
								array('nextel_unltd_group_walkie', 'Unlimited Group Walkie-Talkie'),
								array('nextel_unltd_intl_walkie', 'Unlimited International Walkie-Talkie'),
								array('nextel_nextmail', 'NextMail'),
								array('nextel_talkgroup_250', 'Talkgroup 250'),
								array('nextel_talkgroup_unltd', 'Talkgroup Unlimited'),
								array('nextel_data', 'Nextel Data Pack'),
								array('nextel_powersource_data_1000', 'Powersource Data Pack w/1000 Text Messages'),
								array('nextel_powersource_data_unltd', 'Powersource Data Pack w/Unlimited Text Messages'),
								array('nextel_pcs_vision_pack', 'Sprint PCS Vision Pack'),
								array('nextel_sms_unltd', 'Unlimited Power Pack text Messaging'),
								array('nextel_sms_300', 'Text Messaging 300 Plan'),
								array('nextel_mobile_email', 'Mobile Email Enhanced'),
								array('nextel_easy_office', 'Sprint Easy Office'),
								array('nextel_easy_office_plus1gb', 'Sprint Easy Office w/1GB mailbox Upgrade'),
								array('nextel_mapquest', 'Mapquest Find Me w/300KB of Data Access'),
								array('nextel_trimble_gold', 'Trimble Outdoors GPS Gold'),
								array('nextel_trimble_platinum', 'Trimble Outdoors GPS Platinum'),
								array('nextel_telenav_10', 'TeleNav 10'),
								array('nextel_telenav_unltd', 'TeleNav Unlimited'),
								array('nextel_mobile_locator', 'Mobile Locator'),
								array('nextel_mobile_locator_500', 'Mobile Locator w/Text Messaging 500'),
								array('nextel_address_book', 'MyNextel Address Book'),
								array('nextel_admin_pkg', 'Mobile Admin Package'),
								array('nextel_intl_ld', 'Standard International Long Distance'),
								array('sprint_intl_ld', 'Sprint International Long Distance Plan'),
								array('nextel_intl_data', 'International Wireless Data Service Access'),
								array('nextel_arcade', 'Nextel Arcade'),
								array('nextel_inbound_restriction', 'Inbound Calling Restriction'),
								array('nextel_outbound_restriction', 'Outbound Calling Restriction'),
								array('nextel_ld_restriction', 'Long Distance Calling Restriction'),
								array('nextel_walkie_restriction', 'Nextel Walkie-Talkie Calling Restriction'),
								array('nextel_intl_walkie_restriction', 'International Walkie-Talkie Calling Restriction')
							);
							for ($counter=0; $counter <= count($options)-1; $counter++){
								if ($row[$options[$counter][0]] != 0 || $row[$options[$counter][0]] == "Free"){
									$count++;
								}
							}
						}
						if ($count > 0){
					?>
						<br>
						<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
						<tr bgcolor="#58639B" class="bodyWhite">
							<td>&nbsp;Options &amp; Upgrade Information</td>
							<td width="100" align="center">Monthly Cost</td>
							<td width="100" align="center">&nbsp;</td>
						</tr>
					<?
							$count = 0;
							$opt_cost = 0;
							if ($row["carrier"] == 'Sprint'){
								$options = array(
									sprint_power_vision,
									sprint_pcs_vision,
									sprint_blackberry_data,
									sms,
									nights
								);
								for ($counter=0; $counter <= count($options)-1; $counter++){
									if ($row[$options[$counter]] != '' && $row[$options[$counter]] != 'None'){
										$count++;
										$field = $options[$counter]."_price";
										$opt_cost += $row[$field];
										echo'
						<tr class="bodyBlack">
							<td>&nbsp;'.$row[$options[$counter]].'</td>
							<td align="right">'.money_format('%-#4n', ($row[$field])).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td align="right" bgcolor="#58639B">&nbsp;</td>
						</tr>
										';
									}
								}
								$options = array(
									array('m2m', 'Unlimited Mobile to Mobile Calling'),
									array('protection', 'Sprint Total Equipment Protection'),
									array('aircard_protection', 'Aircard Total Equipment Protection'),
									array('rescue', 'Roadside Rescue')
//									array('voice_command', 'Sprint PCS Voice Command')
								);
								for ($counter=0; $counter <= count($options)-1; $counter++){
									if ($row[$options[$counter][0]] != 0){
										$count++;
										$opt_cost += $row[$options[$counter][0]];
										echo'
						<tr class="bodyBlack">
							<td>&nbsp;'.$options[$counter][1].'</td>
							<td align="right">'.money_format('%-#4n', ($row[$options[$counter][0]])).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td align="right" bgcolor="#58639B">&nbsp;</td>
						</tr>
										';
									}
								}
							}
							if ($row["carrier"] == 'Nextel'){
								$options = array(
									array('nextel_add_on_50', '50 Add-On Minutes'),
									array('m2m', 'Unlimited Mobile to Mobile Calling'),
									array('nights_price', 'Nights & Weekends Starting at 6:00pm'),
									array('nextel_sprint2home', 'Sprint to Home'),
									array('nextel_mobile2office', 'Mobile to Office'),
									array('nextel_unltd_walkie', 'Unlimited Nextel Walkie-Talkie'),
									array('nextel_unltd_group_walkie', 'Unlimited Group Walkie-Talkie'),
									array('nextel_unltd_intl_walkie', 'Unlimited International Walkie-Talkie'),
									array('nextel_nextmail', 'NextMail'),
									array('nextel_talkgroup_250', 'Talkgroup 250'),
									array('nextel_talkgroup_unltd', 'Talkgroup Unlimited'),
									array('nextel_data', 'Nextel Data Pack'),
									array('nextel_powersource_data_1000', 'Powersource Data Pack w/1000 Text Messages'),
									array('nextel_powersource_data_unltd', 'Powersource Data Pack w/Unlimited Text Messages'),
									array('nextel_pcs_vision_pack', 'Sprint PCS Vision Pack'),
									array('nextel_sms_unltd', 'Unlimited Power Pack text Messaging'),
									array('nextel_sms_300', 'Text Messaging 300 Plan'),
									array('nextel_mobile_email', 'Mobile Email Enhanced'),
									array('nextel_easy_office', 'Sprint Easy Office'),
									array('nextel_easy_office_plus1gb', 'Sprint Easy Office w/1GB mailbox Upgrade'),
									array('nextel_mapquest', 'Mapquest Find Me w/300KB of Data Access'),
									array('nextel_trimble_gold', 'Trimble Outdoors GPS Gold'),
									array('nextel_trimble_platinum', 'Trimble Outdoors GPS Platinum'),
									array('nextel_telenav_10', 'TeleNav 10'),
									array('nextel_telenav_unltd', 'TeleNav Unlimited'),
									array('nextel_mobile_locator', 'Mobile Locator'),
									array('nextel_mobile_locator_500', 'Mobile Locator w/Text Messaging 500'),
									array('nextel_address_book', 'MyNextel Address Book'),
									array('nextel_admin_pkg', 'Mobile Admin Package'),
									array('nextel_intl_ld', 'Standard International Long Distance'),
									array('sprint_intl_ld', 'Sprint International Long Distance Plan'),
									array('nextel_intl_data', 'International Wireless Data Service Access'),
									array('nextel_arcade', 'Nextel Arcade'),
									array('nextel_inbound_restriction', 'Inbound Calling Restriction'),
									array('nextel_outbound_restriction', 'Outbound Calling Restriction'),
									array('nextel_ld_restriction', 'Long Distance Calling Restriction'),
									array('nextel_walkie_restriction', 'Nextel Walkie-Talkie Calling Restriction'),
									array('nextel_intl_walkie_restriction', 'International Walkie-Talkie Calling Restriction')
								);
								for ($counter=0; $counter <= count($options)-1; $counter++){
		//echo $options[$counter][1];
									if ($row[$options[$counter][0]] != 0 || $row[$options[$counter][0]] == "Free"){
										$count++;
										if ($row[$options[$counter][0]] != "Free"){
											$opt_cost += $row[$options[$counter][0]];
										}
										echo'
						<tr class="bodyBlack">
							<td>&nbsp;'.$options[$counter][1].'</td>
							<td align="right">'.iif($row[$options[$counter][0]] != "Free", money_format('%-#4n', ($row[$options[$counter][0]]*1)), "Free").'&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td align="right" bgcolor="#58639B">&nbsp;</td>
						</tr>
									';
									}
								}
							}
					?>
						<tr>
							<td align="right" bgcolor="#58639B" class="bodyWhite"><strong>Monthy Option<? echo iif($count > 1, 's', ''); ?> Total:&nbsp;</strong></td>
							<td align="right" class="bodyBlack"><strong><? echo money_format('%-#4n', $opt_cost); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td align="right" bgcolor="#58639B" class="bodyBlack">&nbsp;</td>
						</tr>
						</table>
					<?
						}
					}else{
					?>
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
					<tr bgcolor="#58639B" class="bodyWhite">
						<td>&nbsp;Plan Information</td>
						<td width="200" align="center">Monthly Service</td>
						<td width="100" align="center">Monthly Cost</td>
						<td width="100" align="center">Your Cost<br><span class="smallWhite">(<? echo round($discount); ?>% Discount)</span></td>
					</tr>
					<?
					$plans = 0;
					$plan_cost = 0;
					if ($row["plan_id"] != ''){
						$plans++;
						$plan_cost += $row["plan_cost"];
						echo'
					<tr class="bodyBlack">
						<td>&nbsp;'.$row["plan_group"].' Plan</td>
						';
					if ($row["plan_minutes"] == 0){
						echo'
						<td align="center">Unlimited Minutes</td>
						';
					}else{
						echo'
						<td align="center">'.$row["plan_minutes"].' Minutes</td>
						';
					}
						echo'
						<td align="right"><strike>'.money_format('%-#4n', ($row["plan_cost"])).'</strike>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right">'.money_format('%-#4n', ($row["plan_cost"]-($row["plan_cost"]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
						';
					}
					if ($row["bb_plan_id"] != ''){
						$plans++;
						$plan_cost += $row["bb_plan_cost"];
						echo'
					<tr class="bodyBlack">
						<td>&nbsp;BlackBerry Data Plan</td>
						<td align="center">'.$row["bb_plan_usage"].'</td>
						<td align="right"><strike>'.money_format('%-#4n', ($row["bb_plan_cost"])).'</strike>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right">'.money_format('%-#4n', ($row["bb_plan_cost"]-($row["bb_plan_cost"]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
						';
					}
					if ($row["data_plan_id"] != ''){
						$plans++;
						$plan_cost += $row["data_plan_cost"];
						echo'
					<tr class="bodyBlack">
						<td>&nbsp;Data Plan</td>
						<td align="center">'.$row["data_plan_usage"].'</td>
						<td align="right"><strike>'.money_format('%-#4n', ($row["data_plan_cost"])).'</strike>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right">'.money_format('%-#4n', ($row["data_plan_cost"]-($row["data_plan_cost"]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
						';
					}
					?>
					<tr>
						<td colspan="2" align="right" bgcolor="#58639B" class="bodyWhite"><strong>Monthy Plan<? echo iif($plans > 1, 's', ''); ?> Total:&nbsp;</strong></td>
						<td align="right" class="bodyBlack"><strong><strike><? echo money_format('%-#4n', $plan_cost); ?></strike></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right" class="bodyBlack"><strong><? echo money_format('%-#4n', ($plan_cost-($plan_cost*($discount*.01)))); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					</table>
					<?
					$count = 0;
					if ($row["carrier"] == 'Sprint'){
						$options = array(
							sprint_power_vision,
							sprint_pcs_vision,
							sprint_blackberry_data,
							sms,
							nights
						);
						for ($counter=0; $counter <= count($options)-1; $counter++){
							if ($row[$options[$counter]] != '' && $row[$options[$counter]] != 'None'){
								$count++;
							}
						}
						$options = array(
							array('m2m', 'Unlimited Mobile to Mobile Calling'),
							array('protection', 'Sprint Total Equipment Protection'),
							array('aircard_protection', 'Aircard Total Equipment Protection'),
							array('rescue', 'Roadside Rescue')
//							array('voice_command', 'Sprint PCS Voice Command')
						);
						for ($counter=0; $counter <= count($options)-1; $counter++){
							if ($row[$options[$counter][0]] != 0){
								$count++;
							}
						}
					}
					if ($row["carrier"] == 'Nextel'){
						$options = array(
							array('nextel_add_on_50', '50 Add-On Minutes'),
							array('m2m', 'Unlimited Mobile to Mobile Calling'),
							array('nights_price', 'Nights & Weekends Starting at 6:00pm'),
							array('nextel_sprint2home', 'Sprint to Home'),
							array('nextel_mobile2office', 'Mobile to Office'),
							array('nextel_unltd_walkie', 'Unlimited Nextel Walkie-Talkie'),
							array('nextel_unltd_group_walkie', 'Unlimited Group Walkie-Talkie'),
							array('nextel_unltd_intl_walkie', 'Unlimited International Walkie-Talkie'),
							array('nextel_nextmail', 'NextMail'),
							array('nextel_talkgroup_250', 'Talkgroup 250'),
							array('nextel_talkgroup_unltd', 'Talkgroup Unlimited'),
							array('nextel_data', 'Nextel Data Pack'),
							array('nextel_powersource_data_1000', 'Powersource Data Pack w/1000 Text Messages'),
							array('nextel_powersource_data_unltd', 'Powersource Data Pack w/Unlimited Text Messages'),
							array('nextel_pcs_vision_pack', 'Sprint PCS Vision Pack'),
							array('nextel_sms_unltd', 'Unlimited Power Pack text Messaging'),
							array('nextel_sms_300', 'Text Messaging 300 Plan'),
							array('nextel_mobile_email', 'Mobile Email Enhanced'),
							array('nextel_easy_office', 'Sprint Easy Office'),
							array('nextel_easy_office_plus1gb', 'Sprint Easy Office w/1GB mailbox Upgrade'),
							array('nextel_mapquest', 'Mapquest Find Me w/300KB of Data Access'),
							array('nextel_trimble_gold', 'Trimble Outdoors GPS Gold'),
							array('nextel_trimble_platinum', 'Trimble Outdoors GPS Platinum'),
							array('nextel_telenav_10', 'TeleNav 10'),
							array('nextel_telenav_unltd', 'TeleNav Unlimited'),
							array('nextel_mobile_locator', 'Mobile Locator'),
							array('nextel_mobile_locator_500', 'Mobile Locator w/Text Messaging 500'),
							array('nextel_address_book', 'MyNextel Address Book'),
							array('nextel_admin_pkg', 'Mobile Admin Package'),
							array('nextel_intl_ld', 'Standard International Long Distance'),
							array('sprint_intl_ld', 'Sprint International Long Distance Plan'),
							array('nextel_intl_data', 'International Wireless Data Service Access'),
							array('nextel_arcade', 'Nextel Arcade'),
							array('nextel_inbound_restriction', 'Inbound Calling Restriction'),
							array('nextel_outbound_restriction', 'Outbound Calling Restriction'),
							array('nextel_ld_restriction', 'Long Distance Calling Restriction'),
							array('nextel_walkie_restriction', 'Nextel Walkie-Talkie Calling Restriction'),
							array('nextel_intl_walkie_restriction', 'International Walkie-Talkie Calling Restriction')
						);
						for ($counter=0; $counter <= count($options)-1; $counter++){
							if ($row[$options[$counter][0]] != 0 || $row[$options[$counter][0]] == "Free"){
								$count++;
							}
						}
					}
					if ($count > 0){
					?>
						<br>
						<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
						<tr bgcolor="#58639B" class="bodyWhite">
							<td>&nbsp;Options &amp; Upgrade Information</td>
							<td width="100" align="center">Monthly Cost</td>
							<td width="100" align="center">Your Cost<br><span class="smallWhite">(<? echo round($discount); ?>% Discount)</span></td>
						</tr>
						<?
						$count = 0;
						$opt_cost = 0;
						if ($row["carrier"] == 'Sprint'){
							$options = array(
								sprint_power_vision,
								sprint_pcs_vision,
								sprint_blackberry_data,
								sms,
								nights
							);
							for ($counter=0; $counter <= count($options)-1; $counter++){
								if ($row[$options[$counter]] != '' && $row[$options[$counter]] != 'None'){
									$count++;
									$field = $options[$counter]."_price";
									$opt_cost += $row[$field];
									echo'
										<tr class="bodyBlack">
											<td>&nbsp;'.$row[$options[$counter]].'</td>
											<td align="right"><strike>'.money_format('%-#4n', ($row[$field])).'</strike>&nbsp;&nbsp;&nbsp;&nbsp;</td>
											<td align="right">'.money_format('%-#4n', ($row[$field]-($row[$field]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
										</tr>
									';
								}
							}
							$options = array(
								array('m2m', 'Unlimited Mobile to Mobile Calling'),
								array('protection', 'Sprint Total Equipment Protection'),
								array('aircard_protection', 'Aircard Total Equipment Protection'),
								array('rescue', 'Roadside Rescue')
//								array('voice_command', 'Sprint PCS Voice Command')
							);
							for ($counter=0; $counter <= count($options)-1; $counter++){
								if ($row[$options[$counter][0]] != 0){
									$count++;
									$opt_cost += $row[$options[$counter][0]];
									echo'
										<tr class="bodyBlack">
											<td>&nbsp;'.$options[$counter][1].'</td>
											<td align="right"><strike>'.money_format('%-#4n', ($row[$options[$counter][0]])).'</strike>&nbsp;&nbsp;&nbsp;&nbsp;</td>
											<td align="right">'.money_format('%-#4n', ($row[$options[$counter][0]]-($row[$options[$counter][0]]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
										</tr>
									';
								}
							}
						}
						if ($row["carrier"] == 'Nextel'){
							$options = array(
								array('nextel_add_on_50', '50 Add-On Minutes'),
								array('m2m', 'Unlimited Mobile to Mobile Calling'),
								array('nights_price', 'Nights & Weekends Starting at 6:00pm'),
								array('nextel_sprint2home', 'Sprint to Home'),
								array('nextel_mobile2office', 'Mobile to Office'),
								array('nextel_unltd_walkie', 'Unlimited Nextel Walkie-Talkie'),
								array('nextel_unltd_group_walkie', 'Unlimited Group Walkie-Talkie'),
								array('nextel_unltd_intl_walkie', 'Unlimited International Walkie-Talkie'),
								array('nextel_nextmail', 'NextMail'),
								array('nextel_talkgroup_250', 'Talkgroup 250'),
								array('nextel_talkgroup_unltd', 'Talkgroup Unlimited'),
								array('nextel_data', 'Nextel Data Pack'),
								array('nextel_powersource_data_1000', 'Powersource Data Pack w/1000 Text Messages'),
								array('nextel_powersource_data_unltd', 'Powersource Data Pack w/Unlimited Text Messages'),
								array('nextel_pcs_vision_pack', 'Sprint PCS Vision Pack'),
								array('nextel_sms_unltd', 'Unlimited Power Pack text Messaging'),
								array('nextel_sms_300', 'Text Messaging 300 Plan'),
								array('nextel_mobile_email', 'Mobile Email Enhanced'),
								array('nextel_easy_office', 'Sprint Easy Office'),
								array('nextel_easy_office_plus1gb', 'Sprint Easy Office w/1GB mailbox Upgrade'),
								array('nextel_mapquest', 'Mapquest Find Me w/300KB of Data Access'),
								array('nextel_trimble_gold', 'Trimble Outdoors GPS Gold'),
								array('nextel_trimble_platinum', 'Trimble Outdoors GPS Platinum'),
								array('nextel_telenav_10', 'TeleNav 10'),
								array('nextel_telenav_unltd', 'TeleNav Unlimited'),
								array('nextel_mobile_locator', 'Mobile Locator'),
								array('nextel_mobile_locator_500', 'Mobile Locator w/Text Messaging 500'),
								array('nextel_address_book', 'MyNextel Address Book'),
								array('nextel_admin_pkg', 'Mobile Admin Package'),
								array('nextel_intl_ld', 'Standard International Long Distance'),
								array('sprint_intl_ld', 'Sprint International Long Distance Plan'),
								array('nextel_intl_data', 'International Wireless Data Service Access'),
								array('nextel_arcade', 'Nextel Arcade'),
								array('nextel_inbound_restriction', 'Inbound Calling Restriction'),
								array('nextel_outbound_restriction', 'Outbound Calling Restriction'),
								array('nextel_ld_restriction', 'Long Distance Calling Restriction'),
								array('nextel_walkie_restriction', 'Nextel Walkie-Talkie Calling Restriction'),
								array('nextel_intl_walkie_restriction', 'International Walkie-Talkie Calling Restriction')
							);
							for ($counter=0; $counter <= count($options)-1; $counter++){
	//echo $options[$counter][1];
								if ($row[$options[$counter][0]] != 0 || $row[$options[$counter][0]] == "Free"){
									$count++;
									if ($row[$options[$counter][0]] != "Free"){
										$opt_cost += $row[$options[$counter][0]];
									}
									echo'
										<tr class="bodyBlack">
											<td>&nbsp;'.$options[$counter][1].'</td>
											<td align="right">'.iif($row[$options[$counter][0]] != "Free", '<strike>'.money_format('%-#4n', ($row[$options[$counter][0]]*1)).'</strike>', "Free").'&nbsp;&nbsp;&nbsp;&nbsp;</td>
											<td align="right">'.iif($row[$options[$counter][0]] != "Free", money_format('%-#4n', ($row[$options[$counter][0]]-($row[$options[$counter][0]]*($discount*.01)))), "Free").'&nbsp;&nbsp;&nbsp;&nbsp;</td>
										</tr>
									';
								}
							}
						}
						?>
						<tr>
							<td align="right" bgcolor="#58639B" class="bodyWhite"><strong>Monthy Option<? echo iif($count > 1, 's', ''); ?> Total:&nbsp;</strong></td>
							<td align="right" class="bodyBlack"><strong><strike><? echo money_format('%-#4n', $opt_cost); ?></strike></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td align="right" class="bodyBlack"><strong><? echo money_format('%-#4n', ($opt_cost-($opt_cost*($discount*.01)))); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						</tr>
						</table>
					<?
						}
					}
					$count = 0;
					$accessories = array(
						array('universal_earbuds', 'Universal Earbuds'),
						array('vehicle_adapters', 'Vehicle Adapter')
					);
					for ($counter=0; $counter <= count($accessories)-1; $counter++){
						if ($row[$accessories[$counter][0]] != 0){
							$count++;
						}
					}
					if ($count > 0){
					?>
						<br>
						<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
						<tr bgcolor="#58639B" class="bodyWhite">
							<td>&nbsp;Accessories</td>
							<td width="100" align="center">Quantity</td>
							<td width="100" align="center">Your Cost</td>
						</tr>
						<?
						$count = 0;
						$acc_cost = 0;
						$accessories = array(
							array('universal_earbuds', 'Universal Earbuds'),
							array('vehicle_adapters', 'Vehicle Adapter')
						);
						for ($counter=0; $counter <= count($accessories)-1; $counter++){
	//echo $accessories[$counter][0];
	//print_r($accessories);
							if ($row[$accessories[$counter][0]] != 0){
								$count++;
								$field = $accessories[$counter][0]."_price";
								$acc_cost += $row[$accessories[$counter][0]]*$row[$field];
	//								$field = $options[$counter]."_price";
	//								if ($row[$options[$field]])(
	//								$cost += $row[$options[$counter][0]];
	//								}elseif ($row[$options[$counter]] != 'Free'){
	//									$cost += $row[$options[$counter]];
	//								}
								echo'
									<tr class="bodyBlack">
										<td>&nbsp;'.$accessories[$counter][1].'</td>
										<td align="center">'.$row[$accessories[$counter][0]].'</td>
										<td align="right">'.money_format('%-#4n', ($row[$accessories[$counter][0]]*$row[$field])).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
									</tr>
								';
							}
						}
						?>
						<tr>
							<td colspan="2" align="right" bgcolor="#58639B" class="bodyWhite"><strong>Accessories Total:&nbsp;</strong></td>
							<td align="right" class="bodyBlack"><strong><? echo money_format('%-#4n', $acc_cost); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						</tr>
						</table>
					<?
					}
					?>
					<br>
					<script>
					// Verify that a plan was selected
					function validateConfirm(theForm){
						if (!theForm.accept_terms.checked){
							theForm.accept_terms.style.background="#FF0000";
							alert("You must agree with the Terms & Conditions to complete your order.");
							theForm.accept_terms.style.background="#FFFFFF";
							theForm.accept_terms.focus();
							return false;
						}
						return true;
					}
					</script>

					<form action="saveit.php" method="post" name="PushConfirm" id="PushConfirm" onSubmit="return validateConfirm(this);">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="400" rowspan="6" valign="top" class="smallBlack">
							<strong>Terms of Service</strong><br>
							<textarea cols="85" rows="8" class="smallBlack" style="width:450px;">
1. IMPORTANT SERVICE/PRODUCT SPECIFIC TERMS

Your Agreement with Sprint PCS Service and includes the terms of your service plan and the attached Sprint PCS Terms and Conditions of Service ("Ts and Cs") - carefully read all these terms which include, among other things, a MANDATORY ARBITRATION of disputes provision. For certain optional provisions that may not be referenced here, the Agreement also includes terms relating to those services that are set forth at www.sprint.com or in our store brochures.

Term Agreements: If your Agreement requires you to keep a phone active/maintain a line of service for a minimum Term, the Term begins on the phone activation date; for customers changing service plans, the Term begins when the new service plan is selected. You may terminate any line of service before its Term ends by calling *2, however you will be responsible for an EARLY TERMINATION FEE of up to $200 ("Fee") for each line of service terminated early. You do not have to pay the Fee if you terminate under our return policy or where the Ts and Cs allow you to do so without the Fee. Payment of the Fee does not satisfy other outstanding obligations owed to us, including maintaining Term Commitments on other lines of service, or service or equipment-related charges.

Service Provisions: Service plans, customizable/upgrade options and special offers may not be available everywhere or combinable with certain other promotions/options. Coverage is not available everywhere. See our mapping brochure for approximate outdoor coverage information. Sprint PCS Service Plans are subject to credit approval. Rates exclude taxes, and Sprint Fees such as a USF charge that varies quarterly, cost recovery fees $0.55 per line, and state/local fees that vary by area (in some areas up to 15% but in most instances less than 2%). Call 1-866-770-6690 for the up-to-date amount of the USF charge and information on cost recovery charges. A $36 phone activation fee applies to new activations, certain service plan changes or upgrades of equipment. A deposit of up to $500 may be required to establish service. Service requires a phone compatible with our network. Monthly service charges are not refundable if service is terminated before your billing cycle ends.

Basic Services: All phone usage, including incoming and outgoing calls, incur charges unless specified otherwise by plan type. Unused plan minutes do not carry forward. Except with certain plans, included plan minutes are not good for local or long-distance off-network roaming calls. International roaming rates will vary. On a call that crosses time periods, minutes are deducted or charged based on the call start time. Calls are rounded up to the next whole minute.

Sprint PCS Vision Services: Services require a Sprint PCS Vision Phone or device and are not available while roaming off the nationwide Sprint PCS network. Data usage is calculated on a per kilobyte basis and is rounded up to the next whole kilobyte. Rounding occurs at the end of each session or each clock hour and, at that time, we will deduct accumulated data usage from your plan, or assess overage or casual usage charges. You are responsible for all data activity from and to your phone/device, regardless of who initiates the activity. Estimates of data usage will vary from actual use. In certain instances, we may delete premium and non-premium items downloaded to available storage areas (e.g., personal vault), including any pictures, games, ringers or screen savers. Your invoice will not separately identify the number of kilobytes attributable to your use of specific sites, sessions or services used. Premium services (games, ringers, etc.) priced separately.

PROMOTIONS, OPTIONS AND OTHER PROVISIONS

Sprint PCS Vision: Not available where use is in connection with server devices or host computer applications, other systems that drive continuous heavy traffic or data sessions, or as substitutes for private lines or frame relay connections. Sprint PCS Vision Packs are not available: (1) with any other device used in connection with a computer or PDA - including phones, smart phones or other devices used with connection kits or similar phone-to-computer/PDA accessories; and (2) with Bluetooth Sprint PCS Vision Phones used as a modem in connection with other devices. Sprint reserves the right to deny or to terminate service without notice for any misuse. Credits for Premium Services do not carry forward and are not available for use with all services. Sprint PCS Vision -Data Usage Only is available for use with connection cards and PDAs, but is not available for use with Blackberry devices.

Roaming-Included Plans: Not available with single-band or digital mode only phones, or to customers residing in an area not covered by the nationwide Sprint PCS network. Sprint may terminate service if a majority of minutes in a given month are used while roaming off the nationwide Sprint PCS network. International calling including in Canada & Mexico, not included. Usage in Expanded Voice Coverage areas may, in some instances, be invoiced after 30-60 days. When calling from Expanded Voice Coverage Areas: (a) Sprint PCS Vision and Sprint PCS to PCS Calling services are not available; and (b) certain calling features (Voicemail, Caller ID, Call Waiting, etc.) may not work.

Sprint PCS Add-a-Phone: Requires a minimum two-year Term agreement for each phone/line of service added ("Secondary Line"). The first phone activated on the service plan ("Primary Line") and Secondary Lines may have different Term commitment end dates. If the Primary Line on the account is terminated prior to the expiration of the Term of any Secondary Line, a Secondary Line must move to the Primary Line position.

Sprint Mobile-to-Mobile: Sprint Mobile to Mobile is only available on calls placed directly between separate Sprint PCS Phones and most Nextel Phones while on the nationwide Sprint PCS network (not through Voicemail, Directory Assistance or other indirect methods). Excludes Nextel subscribers in certain markets. Sprint Mobile to Mobile is not available while roaming.

SMS Messaging: Unused plan messages do not carry forward. Premium SMS Messages are an additional charge and vary by product. International rates may vary.

Sprint Voice Command: Not available while roaming off the nationwide Sprint PCS network. Calls to 911 or similar emergency numbers cannot be placed through Sprint PCS Voice Command. Dial "911" on your phone in an emergency. Airtime and applicable long-distance charges begin when you press or activate the TALK or similar key.

Sprint Total Equipment Protection
The Sprint Equipment Replacement Program is insurance underwritten by Continental Casualty Company, a CNA company (CNA) and administered by lock\line, LLC (lock\line Insurance Agency, LLC CA Lic.#oD63161), a licensed agent of CNA. There is a $50 deductible per approved insurance replacement. Sprint Equipment Service and Repair Program is administered by lock\line Warranty Services, LLC or one of its affiliates. See a Sprint PCS Total Equipment Protection brochure for complete terms and conditions of coverage, available at www.sprint.com or any participating Sprint location.

Roadside Rescue: Must be with vehicle and have your Sprint PCS Phone with you at the time of service. Limit 4 calls per program year (starts when service is added to your account). Allow approximately 72 hours to provision service to your account. Covers light passenger cars & trucks. Excludes RVs, motorcycles, boats, trailers, limousines, taxis and commercial or heavy-duty vehicles. This is not a reimbursement service and is not valid when operating vehicle off-road. Services are provided by AAA, AAA clubs, CAA clubs and in California, the National Automobile Club and Auto Partners Motor Club, Inc. Sprint is not a motor club.

Sprint PCS International and Sprint PCS Call Canada: For verification purposes, activation of plan may take approximately 1 to 3 days, additional information may be required during verification process.

One Month Free Offers: If you do not wish to continue with the service after the initial free month, you must contact us prior to the billing end date of your second invoice to avoid charges. Additional charges apply for premium content.

Sprint 30-day Risk-Free Guarantee: We will refund any activation fee you paid and waive your early termination fee only if, within 30 days of activation, you: (1) return your complete, undamaged Sprint PCS Phone with the original retailer's proof of purchase; and (2) request that we deactivate your service. In all instances, you are responsible for all charges based on actual usage (partial monthly service charges, taxes and Sprint surcharges or fees). Accessories may be returned within 30 days of purchase.

Sprint Spending Limit Program: In most instances a deposit between $125 and $500 applies. We may require a deposit of up to $1000 in certain instances. A preset account spending limit of between $125 and $500 will apply - ask the specific amount. We may limit the number of phones you can activate on your account. Monthly service plan charges accrue even if your service is turned off, when you exceed your spending limit or in instances of nonpayment. Roaming usage may be invoiced after 30 - 60 days.

&copy;2005 Sprint Nextel. All rights reserved. SPRINT, the "Going Forward" logo, the NEXTEL name and logo, and other trademarks are trademarks of Sprint Nextel.</textarea>
							<strong>I Agree to These Terms & Conditions.</strong> <input type="checkbox" name="accept_terms" id="accept_terms" value="Yes">
							<input type="hidden" name="task" value="addconfirm">
							<input type="hidden" name="sid" value="<? echo $SID; ?>">
							<ul><input type="image" src="images/<? echo $SubmitOrderButton; ?>">
							</form>
						</td>
						<td width="294" valign="top" class="bodyBlack">
							<table width="234" border="0" cellspacing="0" cellpadding="0" align="right" class="bodyBlack">
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td height="16" align="right"><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br><strong>Phones:</strong>&nbsp;</td>
							</tr>
							<tr>
								<td height="16" align="right"><strong>Accessories:</strong>&nbsp;</td>
							</tr>
							<tr>
								<td height="16" align="right"><strong>Plans:</strong>&nbsp;</td>
							</tr>
							<tr>
								<td height="16" align="right"><strong>Options:</strong>&nbsp;</td>
							</tr>
<?
if ($site == "apple"){
	$act_fee_label = "Activation Fee";
}else{
	$act_fee_label = "Activation Fee ($".sprintf('%.2f', $activation_fee)." per Line)";
}
?>
							<tr>
								<td height="16" align="right"><strong><? echo $act_fee_label;?>:</strong>&nbsp;</td>
							</tr>
							<tr>
								<td height="16" align="right"><strong>Shipping &amp; Handling:</strong>&nbsp;</td>
							</tr>
							<tr>
								<td height="16" align="right"><strong>Taxes:</strong>&nbsp;</td>
							</tr>
							<tr>
								<td height="18" align="right" valign="bottom" class="bigBlack"><strong>Total:</strong><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
							</tr>
							</table>						
						</td>
						<td valign="top">
							<table width="206" border="0" cellspacing="0" cellpadding="0" align="right" class="borderBlue">
							<tr bgcolor="#58639B" class="bodyWhite">
								<td width="103" align="center">Monthy<br>Charge</td>
								<td width="103" align="center">One-Time<br>Charge</td>
							</tr>	
							<tr class="bodyBlack">
								<td height="16" align="center">&nbsp;</td>
								<td align="right">
									<?
									if ($today_subtotal < 0){
										echo '<font color="#FF0000">'.money_format('%-#4n', $today_subtotal).'</font>&nbsp;&nbsp;&nbsp;&nbsp;';
									}else{
										echo money_format('%-#4n', $today_subtotal).'&nbsp;&nbsp;&nbsp;&nbsp;';
									}
									?>
								</td>
							</tr>	
							<tr class="bodyBlack">
								<td height="16" align="center">&nbsp;</td>
								<td align="right">
									<?
									if ($acc_cost < 0){
										echo '<font color="#FF0000">'.money_format('%-#4n', $acc_cost).'</font>&nbsp;&nbsp;&nbsp;&nbsp;';
									}else{
										echo money_format('%-#4n', $acc_cost).'&nbsp;&nbsp;&nbsp;&nbsp;';
									}
									?>
								</td>
							</tr>	
							<tr class="bodyBlack">
								<td height="16" align="right">
									<?
									if (($plan_cost-($plan_cost*($discount*.01))) < 0){
										echo '<font color="#FF0000">'.money_format('%-#4n', ($plan_cost-($plan_cost*($discount*.01)))).'</font>&nbsp;&nbsp;&nbsp;&nbsp;';
									}else{
										echo money_format('%-#4n', ($plan_cost-($plan_cost*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;';
									}
									?>
								</td>
								<td align="center">&nbsp;</td>
							</tr>	
							<tr class="bodyBlack">
								<td height="16" align="right">
									<?
									if (($opt_cost-($opt_cost*($discount*.01))) < 0){
										echo '<font color="#FF0000">'.money_format('%-#4n', ($opt_cost-($opt_cost*($discount*.01)))).'</font>&nbsp;&nbsp;&nbsp;&nbsp;';
									}else{
										echo money_format('%-#4n', ($opt_cost-($opt_cost*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;';
									}
									?>
								</td>
								<td height="16" align="center">&nbsp;</td>
							</tr>	
							<tr class="bodyBlack">
								<td align="center">&nbsp;</td>
								<td align="right">
									<?
										$act_fee = ($phones_ordered * $activation_fee);
										if ($act_fee == 0){
											echo '<div align="center"><font color="#FF0000">Waived</font></div>';
										}else{
											echo money_format('%-#4n', $act_fee).'&nbsp;&nbsp;&nbsp;&nbsp;';
										}
									?>
								</td>
							</tr>	
							<tr class="bodyBlack">
								<td height="16" align="center">&nbsp;</td>
								<td align="center">
<?
if ($site == "apple"){
	echo'
									<font color="#FF0000">FREE</font>
	';
}else{
	echo'
									TBD
	';
}
?>
								</td>
							</tr>	
							<tr class="bodyBlack">
								<td height="16" align="center">
									TBD
								</td>
								<td align="center">
									TBD
								</td>
							</tr>	
							<tr class="bigBlack">
								<td height="18" align="right">
									<strong>
									<?
									$recurring = (($plan_cost+$opt_cost)-(($plan_cost+$opt_cost)*($discount*.01)));
									if ($recurring < 0){
										echo '<font color="#FF0000">'.money_format('%-#4n', $recurring).'</font><img src="images/spacer.gif" alt="" width="13" height="1" border="0">';
									}else{
										echo money_format('%-#4n', $recurring).'<img src="images/spacer.gif" alt="" width="13" height="1" border="0">';
									}
									?>
									</strong>
								</td>
								<td align="right">
									<strong>
									<?
									if (($today_subtotal+$acc_cost+$act_fee) < 0){
										echo '<font color="#FF0000">'.money_format('%-#4n', ($today_subtotal+$acc_cost+$act_fee)).'</font><img src="images/spacer.gif" alt="" width="13" height="1" border="0">';
									}else{
										echo money_format('%-#4n', ($today_subtotal+$acc_cost+$act_fee)).'<img src="images/spacer.gif" alt="" width="13" height="1" border="0">';
									}
									?>
									</strong>
								</td>
							</tr>	
							</table>
						</td>
					</tr>
<?
if ($label == "Foster Farms"){ // SPECIAL
?>
					<tr>
						<td colspan="3">
							<em class="smallBlack"><strong><br>Sprint-Nextel will issue a $36 dollar credit within the first 3 months of service to cover the activation fee charged by Sprint.  Offer valid for June, July and August 2007 on orders for a new line of service placed through this website.</strong></em>
						</td>
					</tr>
<?
}
?>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	</table>
<?
/********************************************** SELECT PLAN(S) - Page 1 ******************************************************/
}else{
	//Grab existing cart info, if it exists
	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);
	$cart = mysql_fetch_assoc($rs_cart);

	$qty_phones = 0;
	$voice_plans = false;
	$data_plans = false;
	$blackberry_plans = false;
	$family_plans = false;
	for ($counter=1; $counter <= 5; $counter++){
		if ($cart["phone".$counter."_id"] != ""){
			if ($cart["phone".$counter."_type"] == "V") $voice_plans = true;
			if ($cart["phone".$counter."_type"] == "D") $data_plans = true;
			if ($cart["phone".$counter."_type"] == "B") $blackberry_plans = true;
			if ($cart["phone".$counter."_type"] != "D") $qty_phones++; // Don't count aircards as phones
		}
	}
	if ($qty_phones > 1) $family_plans = true;
	
//echo "Voice: ".$voice_plans."<br>";
//echo "Data: ".$data_plans."<br>";
//echo "BB: ".$blackberry_plans."<br>";
//echo "Family: ".$family_plans."<br>";

	//Grab plan names (groups)
	if ($family_plans){
//		if ($blackberry_plans){
//			$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'sprint-nextel' AND family_plan = 'T' AND plan_type = 'B' AND display = 'T' GROUP BY group_name ORDER BY group_position";
//		}else{
			$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'sprint-nextel' AND family_plan = 'T' AND (plan_type = 'V' OR plan_type = 'B') AND display = 'T' GROUP BY group_name ORDER BY group_position";
//		}
	}else{
//		if ($blackberry_plans){
//			$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'sprint-nextel' AND family_plan = 'F' AND plan_type = 'B' AND display = 'T' GROUP BY group_name ORDER BY group_position";
//		}else{
			$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'sprint-nextel' AND family_plan = 'F' AND (plan_type = 'V' OR plan_type = 'B') AND display = 'T' GROUP BY group_name ORDER BY group_position";
//		}
	}
//echo $query.'<br></br>';
	$rs_plan_names = mysql_query($query, $linkID);
	?>

	<script>
	// Verify that a plan was selected
	function validatePlan(theForm){
		if (theForm.voice_plan_id){
			var planSelected = false;
			for (i = 0;  i < theForm.voice_plan_id.length;  i++){
				if (theForm.voice_plan_id[i].checked){
					planSelected = true;
//					return true;
				}
			}
			if (!planSelected){
				alert("Please select a Voice Plan before continuing.");
				return false;
			}
		}
		if (theForm.data_plan_id){
			var planSelected = false;
			for (i = 0;  i < theForm.data_plan_id.length;  i++){
				if (theForm.data_plan_id[i].checked){
					planSelected = true;
//					return true;
				}
			}
			if (!planSelected){
				alert("Please select a Data Plan before continuing.");
				return false;
			}
		}
		return true;
	}
	</script>

	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<form action="saveit.php" method="get" name="PushPlan" id="PushPlan" onSubmit="return validatePlan(this);">
	<tr>
		<td width="199" align="center" background="images/YellowTab200BG.gif" class="bigBlack"><strong>Pick Your Plan<br><span class="smallBlack">Step 1 of 5</span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<table width="930" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
<!--				<td width="50"><img src="images/spacer.gif" alt="" width="50" height="1" border="0"></td>-->
				<td class="bigBlack">
					<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
					<ul>
						Sprint offers service plan choices to bring you access to more of what you need so you can do more of what you want. And their <a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-30DayRiskFreeGuarantee.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bigBlack" style="text-decoration:underline;">30-Day Risk-Free Guarantee</a> lets you try their services risk free. You only need to select the plan that fits you and your family best.
					</ul>
				</td>
				<td width="100"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
			</tr>
			</table>
		</td>
	</tr>
	<!-- Voice Plans -->
	<?
	if ($voice_plans || $blackberry_plans){
	?>
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
				<?
				for ($counter=1; $counter <= mysql_num_rows($rs_plan_names); $counter++){
					$groups = mysql_fetch_assoc($rs_plan_names);
					$group = $groups["group_name"];
					$query = "SELECT * FROM plan_features WHERE group_id = '".$groups["group_id"]."'";
//echo $query.'<br></br>';
					$rs_features = mysql_query($query, $linkID);
					$query = "SELECT * FROM plans WHERE group_id = '".$groups["group_id"]."' AND display = 'T' ORDER BY cost";
//echo $query.'<br></br>';
					$rs_plans = mysql_query($query, $linkID);
					$plan = mysql_fetch_assoc($rs_plans);
					mysql_data_seek($rs_plans,0);  // go back to the top
//print_r($plans);
					echo'
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border'.$carrier_label.'">
					<tr bgcolor="#58639B">
						<td width="900" colspan="6" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plan'.iif(mysql_num_rows($rs_plans) > 1, "s", "").'</strong></td>
					</tr>
					<tr bgcolor="#FFFFEF">
						<td width="900" colspan="6" class="bodyBlack">
							<br>
					';
					if (mysql_num_rows($rs_features) > 1){
						echo'
							<ul>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
							$row = mysql_fetch_assoc($rs_features);
							echo'
								<li class="bodyBlack">'.$row["feature"].'</li>
							';
						}
						echo'
							<ul><br>
						';
					}else{
						$row = mysql_fetch_assoc($rs_features);
						echo $row["feature"];
					};
					echo'
						</td>
					</tr>
					';
					if ($discount == 0){
						echo'
						<tr bgcolor="#58639B" class="bodyWhite">
							<td width="50" align="center">Select</td>
							<td width="75" align="center">Included Minutes</td>
							<td width="325" align="center">Additional Minutes</td>
							<td width="250" align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
							<td width="200" align="center">Cost per Month</td>
						</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
//print_r($row).'<br></br>';
							if ($row["nights_unlimited"] == "T") $nights = "Unlimited";
							if ($row["nights_unlimited"] == "F") $nights = "Limited";
							if ($row["nights_unlimited"] == "NA") $nights = "N/A";
							echo'
						<tr bgcolor="#FFFFFF" class="bodyBlack">
							<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="voice_plan_id" value="'.$row["plan_id"].'"></td>
							<td align="center">'.$row["quantity"].'</td>
							<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
							<td align="center">'.$nights.'</td>
							<td align="center">$'.money_format('%i', $row["cost"]).'</td>
						</tr>
							';
						}
						echo'
						</table>
						<br>
						';
					}else{
						echo'
						<tr bgcolor="#58639B" class="bodyWhite">
							<td width="50" align="center">Select</td>
							<td width="75" align="center">Included Minutes</td>
							<td width="275" align="center">Additional Minutes<br><span class="smallWhite">(With your '.round($discount).'% discount)</span></td>
							<td width="200" align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
							<td width="150" align="center">Cost per Month</td>
							<td width="150" align="center">Your Cost per Month<br><span class="smallWhite">(With your '.round($discount).'% discount)</span></td>
						</tr>
						';
						$discountable = true;
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
//print_r($row).'<br></br>';
							if ($row["nights_unlimited"] == "T") $nights = "Unlimited";
							if ($row["nights_unlimited"] == "F") $nights = "Limited";
							if ($row["nights_unlimited"] == "NA") $nights = "N/A";
							if ($row["discountable"] == 'F'){
								$discountable = false;
								echo'
						<tr bgcolor="#FFFFFF" class="bodyBlack">
							<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="voice_plan_id" value="'.$row["plan_id"].'"></td>
							<td align="center">'.$row["quantity"].'</td>
							<td align="center">Additional Anytime Minutes $<strike>'.money_format('%i', $row["add_min_cost"]).'</strike> $'.money_format('%i', ($row["add_min_cost"]-($row["add_min_cost"]*($discount*.01)))).'</td>
							<td align="center">'.$nights.'</td>
							<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
							<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
						</tr>
								';
							}else{
								echo'
						<tr bgcolor="#FFFFFF" class="bodyBlack">
							<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="voice_plan_id" value="'.$row["plan_id"].'"></td>
							<td align="center">'.$row["quantity"].'</td>
							<td align="center">Additional Anytime Minutes $<strike>'.money_format('%i', $row["add_min_cost"]).'</strike> $'.money_format('%i', ($row["add_min_cost"]-($row["add_min_cost"]*($discount*.01)))).'</td>
							<td align="center">'.$nights.'</td>
							<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
							<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($discount*.01)))).'</td>
						</tr>
								';
							}
						};
						echo'
						</table>
						';
						if ($discountable == false){
							$discountable = true;
							echo'
						<div align="right" class="smallBlack">&sup1;This Plan Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></div>
							';
						}else{
							echo'
						<br>
							';
						}
					}
				}
			?>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
	};
	if ($data_plans){
	?>
	<!-- Data Plans -->
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td class="bodyBlack">
					<strong>Your cart contains a Sprint Mobile Broadband Data Device. Please select a Data Plan:</strong><br><br>
				</td>
			</tr>
			</table>
			<br>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
				<?
//				for ($counter=1; $counter <= mysql_num_rows($rs_plan_names); $counter++){
//					$groups = mysql_fetch_assoc($rs_plan_names);
//					$group = $groups["group_name"];
					$query = "SELECT * FROM plan_features WHERE group_id = '5'";
	//echo $query.'<br></br>';
					$rs_features = mysql_query($query, $linkID);
	//				$feature = mysql_fetch_assoc($rs_features);
	//print_r($plans);
					$query = "SELECT * FROM plans WHERE group_id = '5' AND display = 'T' ORDER BY cost";
	//echo $query.'<br></br>';
					$rs_plans = mysql_query($query, $linkID);
					$plan = mysql_fetch_assoc($rs_plans);
					mysql_data_seek($rs_plans,0);  // go back to the top
	//print_r($plans);
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" class="border'.$carrier_label.'">
					<tr bgcolor="#58639B">
						<td width="900" colspan="6" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plans</strong></td>
					</tr>
					<tr bgcolor="#FFFFEF">
						<td width="900" colspan="6" class="bodyBlack">
							<br>
					';
					if (mysql_num_rows($rs_features) > 1){
						echo'
							<ul>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
							$row = mysql_fetch_assoc($rs_features);
							echo'
								<li class="bodyBlack">'.$row["feature"].'</li>
							';
						}
						echo'
							<ul><br>
						';
					}else{
						$row = mysql_fetch_assoc($rs_features);
						echo $row["feature"];
					};
					echo'
							</ul>
						</td>
					</tr>
					';
					if ($discount == 0){
						echo'
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="225" align="center">Usage</td>
						<td width="425" align="center">Additional Kilobytes</td>
						<td width="200" align="center">Cost per Month</td>
					</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
//print_r($row).'<br></br>';
							echo'
						<tr bgcolor="#FFFFFF" class="bodyBlack">
							<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="data_plan_id" value="'.$row["plan_id"].'"></td>
							<td align="center">'.$row["quantity"].'</td>
							';
							if ($row["add_min_cost"] > 0){
								$add_cost = '$'.money_format('%.4n', $row["add_min_cost"]).'';
							}else{
								$add_cost = "N/A";
							};
							echo'
							<td align="center">'.$add_cost.'</td>
							<td align="center">$'.money_format('%i', $row["cost"]).'</td>
						</tr>
							';
						}
						// Add a dummy radio button in case there is only one plan to display - fixes javascript radio button array with only 1 element bug
						echo'
						<input type="radio" name="data_plan_id" value="0" style="display:none">
						</table>
						<br>
						';
					}else{
						echo'
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="175" align="center">Usage</td>
						<td width="375" align="center">Additional Kilobytes<br><span class="smallWhite">(With your '.round($discount).'% discount)</span></td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your '.round($discount).'% discount)</span></td>
					</tr>
						';
						$discountable = true;
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
//print_r($row).'<br></br>';
							if ($row["discountable"] == 'F'){
								$discountable = false;
								echo'
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="data_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="center">'.$row["quantity"].'</td>
								';
								if ($row["add_min_cost"] > 0){
									$add_cost = '$<strike>'.money_format('%.4n', $row["add_min_cost"]).'</strike> $'.money_format('%.4n', ($row["add_min_cost"]-($row["add_min_cost"]*($discount*.01)))).'';
								}else{
									$add_cost = "N/A";
								};
								echo'
						<td align="center">'.$add_cost.'</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
					</tr>
								';
							}else{
								echo'
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="data_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="center">'.$row["quantity"].'</td>
								';
								if ($row["add_min_cost"] > 0){
									$add_cost = '$<strike>'.money_format('%.4n', $row["add_min_cost"]).'</strike> $'.money_format('%.4n', ($row["add_min_cost"]-($row["add_min_cost"]*($discount*.01)))).'';
								}else{
									$add_cost = "N/A";
								};
								echo'
						<td align="center">'.$add_cost.'</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($discount*.01)))).'</td>
					</tr>
								';
							}
						}
						// Add a dummy radio button in case there is only one plan to display - fixes javascript radio button array with only 1 element bug
						echo'
					<input type="radio" name="data_plan_id" value="0" style="display:none">
					</table>
						';
						if ($discountable == false){
							$discountable = true;
							echo'
					<div align="right" class="smallBlack">&sup1;This Plan Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
							';
						}else{
							echo'
					<br>
							';
						}
					}
//				}
				?>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
	};
//	if ($blackberry_plans){
	if (false){
	?>
	<!-- BlackBerry Plans -->
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td class="bodyBlack">
					<strong>Your cart contains a BlackBerry Device. The following BlackBerry Data Plan is automatically selected for you:</strong><br><br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
				<?
//				for ($counter=1; $counter <= mysql_num_rows($rs_plan_names); $counter++){
//					$groups = mysql_fetch_assoc($rs_plan_names);
//					$group = $groups["group_name"];
					$query = "SELECT * FROM plan_features WHERE group_id = '6'";
	//echo $query.'<br></br>';
					$rs_features = mysql_query($query, $linkID);
	//				$feature = mysql_fetch_assoc($rs_features);
	//print_r($plans);
					$query = "SELECT * FROM plans WHERE group_id = '6' AND display = 'T' ORDER BY cost";
	//echo $query.'<br></br>';
					$rs_plans = mysql_query($query, $linkID);
					$plan = mysql_fetch_assoc($rs_plans);
					mysql_data_seek($rs_plans,0);  // go back to the top
	//print_r($plans);
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" class="border'.$carrier_label.'">
					<tr bgcolor="#58639B">
						<td width="900" colspan="6" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plans</strong></td>
					</tr>
					<tr bgcolor="#FFFFEF">
						<td width="900" colspan="6" class="bodyBlack">
							<br>
							<ul>
					';
					for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
						$row = mysql_fetch_assoc($rs_features);
						echo' <li class="bodyBlack">'.$row["feature"].'</li>';
					};
					echo'
							</ul>
						</td>
					</tr>
					';
					if ($discount == 0){
						echo'
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="225" align="center">Usage</td>
						<td width="425" align="center">Additional Kilobytes</td>
						<td width="200" align="center">Cost per Month</td>
					</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
//print_r($row).'<br></br>';
							echo'
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="blackberry_plan_id" value="'.$row["plan_id"].'" checked></td>
						<td align="center">'.$row["quantity"].'</td>
							';
							if ($row["add_min_cost"] > 0){
								$add_cost = '$'.money_format('%.4n', $row["add_min_cost"]).'';
							}else{
								$add_cost = "N/A";
							};
							echo'
						<td align="center">'.$add_cost.'</td>
						<td align="center">$'.money_format('%i', $row["cost"]).'</td>
					</tr>
							';
						}
						echo'
						</table>
						<br>
						';
					}else{
						echo'
					<tr bgcolor="#58639B" class="bodyWhite">
						<td width="50" align="center">Select</td>
						<td width="175" align="center">Usage</td>
						<td width="375" align="center">Additional Kilobytes<br><span class="smallWhite">(With your '.round($discount).'% discount)</span></td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your '.round($discount).'% discount)</span></td>
					</tr>
						';
						$discountable = true;
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
//print_r($row).'<br></br>';
							if ($row["discountable"] == 'F'){
								$discountable = false;
								echo'
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="blackberry_plan_id" value="'.$row["plan_id"].'" checked></td>
						<td align="center">'.$row["quantity"].'</td>
								';
								if ($row["add_min_cost"] > 0){
									$add_cost = '$<strike>'.money_format('%.4n', $row["add_min_cost"]).'</strike> $'.money_format('%.4n', ($row["add_min_cost"]-($row["add_min_cost"]*($discount*.01)))).'';
								}else{
									$add_cost = "N/A";
								};
								echo'
						<td align="center">'.$add_cost.'</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
					</tr>
								';
							}else{
								echo'
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="#FFE100"><input type="radio" name="blackberry_plan_id" value="'.$row["plan_id"].'" checked></td>
						<td align="center">'.$row["quantity"].'</td>
								';
								if ($row["add_min_cost"] > 0){
									$add_cost = '$<strike>'.money_format('%.4n', $row["add_min_cost"]).'</strike> $'.money_format('%.4n', ($row["add_min_cost"]-($row["add_min_cost"]*($discount*.01)))).'';
								}else{
									$add_cost = "N/A";
								};
								echo'
						<td align="center">'.$add_cost.'</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($discount*.01)))).'</td>
					</tr>
								';
							}
						};
						echo'
					</table>
						';
						if ($discountable == false){
							$discountable = true;
							echo'
					<div align="right" class="smallBlack">&sup1;This Plan Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
							';
						}else{
							echo'
					<br>
							';
						}
					}
//				}
				?>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
	};
	?>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF">
			<input type="hidden" name="task" value="addplan">
			<input type="hidden" name="discount" value="<? echo $discount; ?>">
			<input type="hidden" name="sid" value="<? echo $SID; ?>">
<!--			<ul><input type="image" src="images/AddToOrderButton.gif" onClick="document.getElementById(this).submit();">-->
			<ul><input type="image" src="images/AddToOrderButton.gif">
		</td>
	</tr>
	</form>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF"><br><img src="images/GrayDot.gif" alt="" width="900" height="1" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td colspan="3" class="bodyBlack">
					<strong>All voice plans shown include these features while on the Nationwide Sprint PCS Network:</strong><br><br>
				</td>
			</tr>
			<tr>
				<td valign="top" class="bodyBlack">
					<ul>
						<li>Nationwide Long Distance</li>
						<li>No Domestic Roaming Charges</li>
						<li>Crystal-Clear Calls</li>
						<li>Voice Mail</li>
					</ul>
				</td>
				<td valign="top" class="bodyBlack">
					<ul>
						<li>Caller ID w/Block</li>
						<li>Call Waiting</li>
						<li>Numeric Paging</li>
						<li>Three-Way Calling</li>
					</ul>
				</td>
				<td valign="top" class="bodyBlack">
					<ul>
						<li>Call Forwarding (20&cent;/minute)</li>
						<li>Sprint 411 ($1.79/call plus airtime charges)</li>
						<li>Free Emergency 911 Calling</li>
						<li>Free Non-Emergency 311 Calling</li>
					</ul>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="bodyBlack">
					<a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/popStandardFeatures.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Learn more</a> about these standard features
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF"><br><img src="images/GrayDot.gif" alt="" width="900" height="1" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td valign="top" class="bodyBlack">
					<ul>
						<li>Online purchase requires a two-year <a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/popLegalTermsPrivacy.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">subscriber agreement</a> for all plans.</li><br><br>
						<li>Rates exclude taxes & Monthly Sprint Fees (including <a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/popUSF.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">USF</a> Charge of up to 11.3% that varies quarterly, Administrative Charge of up to $1.99 per line, Regulatory Charge of 20&cent; per line, & state/local fees that vary by area). Sprint Fees are not taxes or government-required charges and are subject to change. <a href="javascript:newwin=window.open('http://www.sprint.com/taxesandfees','','scrollbars=yes,width=800,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Details</a>.</li><br><br>
						<li>Hours for Nights & Weekends starting at 7pm are Mon.-Thurs. 7pm-7am and Friday 7pm-Mon. 7am. Hours for Nights & Weekends starting at 9pm are Mon.-Thurs. 9pm-7am and Friday 9pm-Mon. 7am.</li><br><br>
						<li>Stated prices and options are for online purchase only and are subject to change.</li><br><br>
						<li>Certain services (e.g. Sprint PCS Vision, Sprint Mobile to Mobile Calling, etc.) only available and limited to the nationwide Sprint PCS Network reaching over 260 million people.</li>
					</ul>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</tr>
		<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	</table>
<?
};
?>
	
<div id="foo" style="position:absolute; top:-250; z-index:-1; visibility:hidden">
<?
// Load hidden forms for feeding cart.  Encase it in a div to hide it offscreen.
include "include/forms.php";
?>
</div>


<!-- END Include checkout.php -->
