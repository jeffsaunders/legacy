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
//if ($cart["carrier"] == "Sprint"){
//	$discount = $sprint_discount;
//}else{ //Nextel
//	$discount = $nextel_discount;
//}
?>

<?
/********************************************** OPTIONS - Page 2 ******************************************************/
if ($cargo == "options"){

	//Grab existing cart info, if it exists
	$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);
	$cart = mysql_fetch_assoc($rs_cart);

	$discount = $cingular_discount;
	$voice_only = false;
	$data_device = false;
	$blackberry = false;
	$pda = false;
	$smartphone = false;
	$qty_voice = 0;
	$qty_phones = 0;
	$att_xpress_mail = false;
	$att_telenav = false;
	$att_pda4bb = false;
	$att_push_talk = false;
	$att_media_basic = false;
	$att_media_works = false;
	$att_media_max = false;
	$att_video_share = false;
	for ($counter=1; $counter <= 5; $counter++){
		if ($cart['phone'.$counter.'_id'] != ''){
			$query = "SELECT * FROM phones WHERE product_id='".$cart['phone'.$counter.'_id']."'";
//echo $query.'<br></br>';
			$rs_phone = mysql_query($query, $linkID);
			$phone = mysql_fetch_assoc($rs_phone);
			if ($phone["phone_type"] == "V") $voice_only = true;
			if ($phone["phone_type"] == "D") $data_device = true;
			if ($phone["phone_type"] == "B") $blackberry = true;
			if ($phone["phone_type"] == "P") $pda = true;
			if ($phone["phone_type"] == "S") $smartphone = true;
			if ($phone["at&t_xpress_mail"] == "T") $att_xpress_mail = true;
			if ($phone["at&t_telenav"] == "T") $att_telenav = true;
			if ($phone["at&t_pda4bb"] == "T") $att_pda4bb = true;
			if ($phone["at&t_push_talk"] == "T") $att_push_talk = true;
			if ($phone["at&t_media_basic"] == "T") $att_media_basic = true;
			if ($phone["at&t_media_works"] == "T") $att_media_works = true;
			if ($phone["at&t_media_max"] == "T") $att_media_max = true;
			if ($phone["at&t_video_share"] == "T") $att_video_share = true;
			if ($phone["phone_type"] != "D") $qty_voice++; // Don't count aircards as phones
			$qty_phones++;
		}
	}
?>

	<script>
	// Verify that certain options were selected
	function validateOptions(theForm){
		if (theForm.att_messaging){
			var choiceSelected = false;
			for (i = 0;  i < theForm.att_messaging.length;  i++){
				if (theForm.att_messaging[i].checked){
					choiceSelected = true;
				}
			}
			if (!choiceSelected){
				alert("Please select your Messaging Service choice before continuing.");
				return false;
			}
		}
		if (theForm.att_video_share){
			var choiceSelected = false;
			for (i = 0;  i < theForm.att_video_share.length;  i++){
				if (theForm.att_video_share[i].checked){
					choiceSelected = true;
				}
			}
			if (!choiceSelected){
				alert("Please select your Video Share Service choice before continuing.");
				return false;
			}
		}
		if (theForm.att_telenav){
			var choiceSelected = false;
			for (i = 0;  i < theForm.att_telenav.length;  i++){
				if (theForm.att_telenav[i].checked){
					choiceSelected = true;
				}
			}
			if (!choiceSelected){
				alert("Please select your TeleNav Service choice before continuing.");
				return false;
			}
		}
		return true;
	}
	</script>

	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<form action="saveit.php" method="post" name="PushOptions" id="PushOptions" onSubmit="return validateOptions(this);">
	<tr>
		<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Service Upgrades<br><span class="<? echo $tab_class; ?>"><font size="-2">Step 2 of 5</font></span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
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
if ($voice_only){
?>
	<!-- Voice Services -->
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $box_color; ?>">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Voice Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Upgrade your service. &nbsp;Select any of the following options.</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="<? echo $box_color; ?>" class="bodyWhite">
						<td width="50" align="center">Add</td>
					<?
					if ($discount > 0){
					?>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					<?
					}else{
					?>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					<?
					}
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
					<?
//echo $qty_phones.'<br></br>';
					if ($qty_voice > 1){
					?>
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_family_early_nights" id="att_family_early_nights" value="16.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">FamilyTalk Early Nights &amp; Weekends (7:00pm to 7:00am)</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>16.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (16.99-(16.99*($discount*.01)))).'</td>', '<td align="center">$16.99</td>'); ?>
					<?
					}else{
					?>
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_early_nights" id="att_early_nights" value="8.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Early Nights &amp; Weekends (7:00pm to 7:00am)</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>8.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (8.99-(8.99*($discount*.01)))).'</td>', '<td align="center">$8.99</td>'); ?>
					<?
					}
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_voice_dial" id="att_voice_dial" value="4.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Voice Dial</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>4.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_enhanced_voicemail" id="att_enhanced_voicemail" value="1.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Enhanced Voice Mail</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>1.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (1.99-(1.99*($discount*.01)))).'</td>', '<td align="center">$1.99</td>'); ?>
					</tr>
					<?
					if ($att_xpress_mail){
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_xpress_mail" id="att_xpress_mail" value="4.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Xpress Mail (Corporate Email and Calendar Access)</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>4.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
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
	<!-- Messaging Services -->
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $box_color; ?>">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Messaging Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Messaging Services. &nbsp;Select from the following options.</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="<? echo $box_color; ?>" class="bodyWhite">
						<td width="50" align="center">Add</td>
					<?
					if ($discount > 0){
					?>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					<?
					}else{
					?>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					<?
					}
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
					<?
					if ($qty_voice > 1){
					?>
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="FamilyTalk Messaging Unlimited|29.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">FamilyTalk Messaging Unlimited</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>29.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (29.99-(29.99*($discount*.01)))).'</td>', '<td align="center">$29.99</td>'); ?>
					<?
					}else{
					?>
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="Messaging Starter - 200 Messages|4.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Messaging Starter - 200 Messages</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>4.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
					</tr>
					<tr class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="Messaging Starter w/Unlimited Mobile to Mobile Messaging|9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Messaging Starter w/Unlimited Mobile to Mobile Messaging</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					</tr>
					<tr class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="Messaging Unlimited|19.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Messaging Unlimited</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>19.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (19.99-(19.99*($discount*.01)))).'</td>', '<td align="center">$19.99</td>'); ?>
					<?
					}
					?>
					</tr>
					<?
					if ($att_media_basic){
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Basic - 400 Messages & 1MB MEdia Net|9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Basic - 400 Messages & 1MB MEdia Net</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Basic w/Unlimited Mobile to Mobile Messaging|14.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Basic w/Unlimited Mobile to Mobile Messaging</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>14.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (14.99-(14.99*($discount*.01)))).'</td>', '<td align="center">$14.99</td>'); ?>
					</tr>
					<?
					}
					if ($att_media_works){
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Works - 1500 Messages & 5 MB MEdia Net|14.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Works - 1500 Messages & 5 MB MEdia Net</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>14.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (14.99-(14.99*($discount*.01)))).'</td>', '<td align="center">$14.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Works w/Unlimited Mobile to Mobile Messaging|19.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Works w/Unlimited Mobile to Mobile Messaging</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>19.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (19.99-(19.99*($discount*.01)))).'</td>', '<td align="center">$19.99</td>'); ?>
					</tr>
					<?
					}
					if ($att_media_max){
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max 200 Bundle|19.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max 200 Bundle</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>19.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (19.99-(19.99*($discount*.01)))).'</td>', '<td align="center">$19.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max 200 Bundle w/Unlimited Mobile to Mobile Messaging|24.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max 200 Bundle w/Unlimited Mobile to Mobile Messaging</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>24.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (24.99-(24.99*($discount*.01)))).'</td>', '<td align="center">$24.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max 1500 Bundle|29.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max 1500 Bundle</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>29.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (29.99-(29.99*($discount*.01)))).'</td>', '<td align="center">$29.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max 1500 Bundle w/Unlimited Mobile to Mobile Messaging|34.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max 1500 Bundle w/Unlimited Mobile to Mobile Messaging</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>34.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (34.99-(34.99*($discount*.01)))).'</td>', '<td align="center">$34.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max Unlimited Bundle|39.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max Unlimited Bundle</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>39.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (39.99-(39.99*($discount*.01)))).'</td>', '<td align="center">$39.99</td>'); ?>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value=" |0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want a Messaging Package</td>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', ''); ?>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', '<td>&nbsp;</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_intl_msg" id="att_intl_msg" value="9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Add International Long Distance Text Messaging Package</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
	if ($att_video_share){
	?>
	<!-- Video Services -->
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $box_color; ?>">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Video Sharing Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Video Sharing Services. &nbsp;Select from the following options.</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="<? echo $box_color; ?>" class="bodyWhite">
						<td width="50" align="center">Add</td>
					<?
					if ($discount > 0){
					?>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					<?
					}else{
					?>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					<?
					}
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_video_share" value="Video Share Starter|4.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Video Share Starter</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>4.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_video_share" value="Video Share Plus|9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Video Share Plus</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_video_share" value="Video Share Pay Per Use|0.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Video Share Pay Per Use (35&cent; per minute sent)</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>0.00</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (0.00-(0.00*($discount*.01)))).'</td>', '<td align="center">$0.00</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_video_share" value=" |0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want an AT&amp;T Video Share Package</td>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', ''); ?>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', '<td>&nbsp;</td>'); ?>
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
	if ($att_push_talk){
	?>
	<!-- Push to Talk Services -->
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $box_color; ?>">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Push to Talk Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Upgrade your service. &nbsp;Select the following option.</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="<? echo $box_color; ?>" class="bodyWhite">
						<td width="50" align="center">Add</td>
					<?
					if ($discount > 0){
					?>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					<?
					}else{
					?>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					<?
					}
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
					<?
					if ($qty_voice > 1){
					?>
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_family_push_talk" id="att_family_push_talk" value="19.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">FamilyTalk Push to Talk</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>19.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (19.99-(19.99*($discount*.01)))).'</td>', '<td align="center">$19.99</td>'); ?>
					<?
					}else{
					?>
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_push_talk" id="att_push_talk" value="9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Push to Talk Unlimited</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					<?
					}
					?>
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
	if ($att_telenav){
	?>
	<!-- GPS Services -->
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $box_color; ?>">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;GPS Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Upgrade your service. &nbsp;Select from the following options.</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="<? echo $box_color; ?>" class="bodyWhite">
						<td width="50" align="center">Add</td>
					<?
					if ($discount > 0){
					?>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					<?
					}else{
					?>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					<?
					}
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_telenav" value="TeleNav GPS Navigator 10 Routes|5.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">TeleNav GPS Navigator 10 Routes</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>5.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (5.99-(5.99*($discount*.01)))).'</td>', '<td align="center">$5.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_telenav" value="TeleNav GPS Navigator Unlimited Routes|9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">TeleNav GPS Navigator Unlimited Routes</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_telenav" value=" |0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want an AT&amp;T TeleNav Package</td>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', ''); ?>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', '<td>&nbsp;</td>'); ?>
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
<?
} // End Voice Only
?>
	<!-- Protection Services -->
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $box_color; ?>">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Personal and Equipment Protection Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Upgrade your service. &nbsp;Select from the following options.</li>
							</ul>
						</td>
					</tr>
					<tr bgcolor="<? echo $box_color; ?>" class="bodyWhite">
						<td width="50" align="center">Add</td>
					<?
					if ($discount > 0){
					?>
						<td width="550" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
						<td width="150" align="center">Your Cost per month<br><span class="smallWhite">(With your <? echo round($discount); ?>% discount)</span></td>
					<?
					}else{
					?>
						<td width="700" align="center">Service</td>
						<td width="150" align="center">Cost per Month</td>
					<?
					}
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_roadside_assist" id="att_roadside_assist" value="2.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Roadside Assistance</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>2.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (2.99-(2.99*($discount*.01)))).'</td>', '<td align="center">$2.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_phone_insurance" id="att_phone_insurance" value="4.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Wireless Phone Insurance</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>4.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
					</tr>
					</table>
					<br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<!-- Accessories -->
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $box_color; ?>">
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
					<tr bgcolor="<? echo $box_color; ?>" class="bodyWhite">
						<td width="50" align="center">Qty</td>
						<td width="700" align="center">Accessory</td>
						<td width="150" align="center">Your Cost</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="text" name="universal_earbuds" id="universal_earbuds" value="0" size="1" maxlength="3"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Universal Earbud</a></td>
						<td align="center"><input type="hidden" name="universal_earbuds_price" id="universal_earbuds_price" value="19.99">$19.99</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="text" name="vehicle_adapters" id="vehicle_adapters" value="0" size="1" maxlength="3"></td>
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
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<input type="hidden" name="task" value="addoptions">
			<input type="hidden" name="carrier" value="<? echo $cart["carrier"]; ?>">
			<input type="hidden" name="sid" value="<? echo $SID; ?>">
<!--			<ul><input type="image" src="images/AddToOrderButton.gif" onClick="document.getElementById(this).submit();">-->
			<ul><input type="image" src="images/<? echo $AddToOrderButton; ?>">
		</td>
	</tr>
	</form>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;"><br><img src="images/GrayDot.gif" alt="" width="900" height="1" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td valign="top" class="bodyBlack">
					<ul>
						<li>Hours for Night &amp; Weekend Minutes starting at 9:00 p.m. are Monday-Thursday from 9:00 p.m. to 6:00 a.m., and Friday 9:00 p.m. to Mon. 6:00 a.m.</li><br><br>
						<li>Hours for Night &amp; Weekend Minutes starting at 7:00 p.m. are Monday-Thursday from 7:00 p.m. to 7:00 a.m., and Friday 7:00 p.m. to Mon. 7:00 a.m.</li><br><br>
						<li>Casual text messages not included in your plan are 10&cent; per message.</li><br><br>
					</ul>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
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
				theForm.phone<? echo $counter; ?>_username.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_username.focus();
				return false;
			}
		}
	// Phone <? echo $counter; ?> User City
		if (theForm.phone<? echo $counter; ?>_usercity){
			if (theForm.phone<? echo $counter; ?>_usercity.value == ""){
				theForm.phone<? echo $counter; ?>_usercity.style.background="#FF0000";
				alert("Please Enter The City Where Phone <? echo $counter; ?>'s User Lives");
				theForm.phone<? echo $counter; ?>_usercity.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_usercity.focus();
				return false;
			}
		}
	// Phone <? echo $counter; ?> User State
		if (theForm.phone<? echo $counter; ?>_userstate){
			if (theForm.phone<? echo $counter; ?>_userstate.value == ""){
				theForm.phone<? echo $counter; ?>_userstate.style.background="#FF0000";
				alert("Please Select The State Where Phone <? echo $counter; ?>'s User Lives");
				theForm.phone<? echo $counter; ?>_userstate.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_userstate.focus();
				return false;
			}
		}
	// Phone <? echo $counter; ?> User Zip Code
		if (theForm.phone<? echo $counter; ?>_userzip){
			if (theForm.phone<? echo $counter; ?>_userzip.value == ""){
				theForm.phone<? echo $counter; ?>_userzip.style.background="#FF0000";
				alert("Please Enter The Zip Code Where Phone <? echo $counter; ?>'s User Lives");
				theForm.phone<? echo $counter; ?>_userzip.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_userzip.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.phone<? echo $counter; ?>_userzip.value) == false && cdn_regex.test(theForm.phone<? echo $counter; ?>_userzip.value) == false) { 
 			if (usa_regex.test(theForm.phone<? echo $counter; ?>_userzip.value) == false) { 
				theForm.phone<? echo $counter; ?>_userzip.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.phone<? echo $counter; ?>_userzip.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_userzip.focus();
				return false;
			}
		}
	// Phone <? echo $counter; ?> User Desired Areacode
		if (theForm.phone<? echo $counter; ?>_areacode){
			if (theForm.phone<? echo $counter; ?>_areacode.value == ""){
				theForm.phone<? echo $counter; ?>_areacode.style.background="#FF0000";
				alert("Please Enter Your Desired Areacode For Phone <? echo $counter; ?> (i.e '212' for New York, '213' for Los Angeles, etc.)");
				theForm.phone<? echo $counter; ?>_areacode.style.background="<? echo $form_bg; ?>";
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
				theForm.phone<? echo $counter; ?>_port_number.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_number.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port From Which Carrier
			if (theForm.phone<? echo $counter; ?>_port_from.value == ""){
				theForm.phone<? echo $counter; ?>_port_from.style.background="#FF0000";
				alert("Please Select The Carrier That Currently Hosts This Number");
				theForm.phone<? echo $counter; ?>_port_from.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_from.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Account Number
			if (theForm.phone<? echo $counter; ?>_port_acctnum.value == ""){
				theForm.phone<? echo $counter; ?>_port_acctnum.style.background="#FF0000";
				alert("Please Enter The Current Account Number");
				theForm.phone<? echo $counter; ?>_port_acctnum.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_acctnum.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Account Password
			if (theForm.phone<? echo $counter; ?>_port_password.value == ""){
				theForm.phone<? echo $counter; ?>_port_password.style.background="#FFFF00";
				leaveBlank = confirm("If The Account Requires A Password For Access, Please Enter It. Click 'OK' To Leave Blank Or 'Cancel' to Enter Password");
				theForm.phone<? echo $counter; ?>_port_password.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_password.focus();
				if (!leaveBlank) return false;
			}
		// Phone <? echo $counter; ?> Port Billing Name
			if (theForm.phone<? echo $counter; ?>_port_billname.value == ""){
				theForm.phone<? echo $counter; ?>_port_billname.style.background="#FF0000";
				alert("Please Enter Your Name Exactly As It Appears On Your Bill");
				theForm.phone<? echo $counter; ?>_port_billname.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_billname.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Billing Address(1)
			if (theForm.phone<? echo $counter; ?>_port_billaddr1.value == ""){
				theForm.phone<? echo $counter; ?>_port_billaddr1.style.background="#FF0000";
				theForm.phone<? echo $counter; ?>_port_billaddr2.style.background="#FF0000";
				alert("Please Enter Your Address Exactly As It Appears On Your Bill");
				theForm.phone<? echo $counter; ?>_port_billaddr1.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_billaddr2.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_billaddr1.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Billing City
			if (theForm.phone<? echo $counter; ?>_port_billcity.value == ""){
				theForm.phone<? echo $counter; ?>_port_billcity.style.background="#FF0000";
				alert("Please Enter Your City Exactly As It Appears On Your Bill");
				theForm.phone<? echo $counter; ?>_port_billcity.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_billcity.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Billing State
			if (theForm.phone<? echo $counter; ?>_port_billstate.value == ""){
				theForm.phone<? echo $counter; ?>_port_billstate.style.background="#FF0000";
				alert("Please Select Your Billing State");
				theForm.phone<? echo $counter; ?>_port_billstate.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_billstate.focus();
				return false;
			}
		// Phone <? echo $counter; ?> Port Billing Zip Code
			if (theForm.phone<? echo $counter; ?>_port_billzip.value == ""){
				theForm.phone<? echo $counter; ?>_port_billzip.style.background="#FF0000";
				alert("Please Enter Your Billing Zip Code");
				theForm.phone<? echo $counter; ?>_port_billzip.style.background="<? echo $form_bg; ?>";
				theForm.phone<? echo $counter; ?>_port_billzip.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//				var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
//	 			if (usa_regex.test(theForm.phone<? echo $counter; ?>_port_billzip.value) == false && cdn_regex.test(theForm.phone<? echo $counter; ?>_port_billzip.value) == false) { 
 			if (usa_regex.test(theForm.phone<? echo $counter; ?>_port_billzip.value) == false) { 
				theForm.phone<? echo $counter; ?>_port_billzip.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.phone<? echo $counter; ?>_port_billzip.style.background="<? echo $form_bg; ?>";
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
		<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Phone Details<br><span class="<? echo $tab_class; ?>"><font size="-2">Step 3 of 5</font></span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
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
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<form action="saveit.php" method="post" name="PushPort" id="PushPort" onSubmit="return validatePorting(this);">
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
			<tr bgcolor="<? echo $box_color; ?>">
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
					<tr bgcolor="<? echo $box_color; ?>">
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
								<td align="right" valign="top"><strong>Check Here To Port An Existing Number To This Phone</strong> <input type="checkbox" name="portme<? echo $counter; ?>" id="portme<? echo $counter; ?>" value="checked" onClick="javascrip:toggle<? echo $counter; ?>();"></td>
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
										<td colspan="3"><input type="text" name="phone<? echo $counter; ?>_username" id="phone<? echo $counter; ?>_username" size="25" maxlength="50" tabindex="<? echo ($counter*20)+1; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
									</tr>
									<tr>
										<td align="right">User's City:</td>
										<td colspan="3"><input type="text" name="phone<? echo $counter; ?>_usercity" id="phone<? echo $counter; ?>_usercity" size="25" maxlength="50" tabindex="<? echo ($counter*20)+2; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
									</tr>
									<tr>
										<td align="right">User's State:</td>
										<td>
											<select name="phone<? echo $counter; ?>_userstate" id="phone<? echo $counter; ?>_userstate" tabindex="<? echo ($counter*20)+3; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;">
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
										<td><input type="text" name="phone<? echo $counter; ?>_userzip" id="phone<? echo $counter; ?>_userzip" size="5" maxlength="10" tabindex="<? echo ($counter*20)+4; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
									</tr>
									<tr>
										<td colspan="3" align="right">Local/Desired Area Code:</td>
										<td ><input type="text" name="phone<? echo $counter; ?>_areacode" id="phone<? echo $counter; ?>_areacode" size="5" maxlength="10" tabindex="<? echo ($counter*20)+5; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
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
						<td bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="2" height="1" border="0"></td>
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

									<p><strong>To port an existing number to this phone, check the box in the blue bar above.</strong></p>
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
								<td><input type="text" name="phone<? echo $counter; ?>_port_number" id="phone<? echo $counter; ?>_port_number" size="15" maxlength="15" tabindex="<? echo ($counter*20)+6; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td align="right">Acct #:</td>
								<td><input type="text" name="phone<? echo $counter; ?>_port_acctnum" id="phone<? echo $counter; ?>_port_acctnum" size="10" maxlength="50" tabindex="<? echo ($counter*20)+8; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
							</tr>
							<tr>
								<td align="right">Carrier Transferring From:</td>
								<td>
									<select  name="phone<? echo $counter; ?>_port_from" id="phone<? echo $counter; ?>_port_from" tabindex="<? echo ($counter*20)+7; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>; width: 106;">
										<option value="">Select</option>
						                <option value="Sprint">Sprint</option>
						                <option value="Nextel">Nextel</option>
						                <option value="Cingular">Cingular</option>
										<option value="AT&T">AT&T</option>
<!--										<option value="Verizon">Verizon</option>-->
										<option value="T-Mobile">T-Mobile</option>
						                <option value="Helio">Helio</option>
										<option value="Alltel">Alltel</option>
										<option value="US Cellular">US Cellular</option>
									</select>
<!--								<input type="text" name="phone<? echo $counter; ?>_port_from" id="phone<? echo $counter; ?>_port_from" size="15" maxlength="50" tabindex="<? echo ($counter*20)+7; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value="">-->
								</td>
								<td align="right">Password:</td>
								<td><input type="text" name="phone<? echo $counter; ?>_port_password" id="phone<? echo $counter; ?>_port_password" size="10" maxlength="50" tabindex="<? echo ($counter*20)+9; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
							</tr>
							<tr>
								<td align="right">Name Exactly As On Bill:</td>
								<td colspan="3" align="right"><input type="text" name="phone<? echo $counter; ?>_port_billname" id="phone<? echo $counter; ?>_port_billname" size="26" maxlength="50" tabindex="<? echo ($counter*20)+10; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;width: 290;" value=""><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
							</tr>
							<tr>
								<td align="right">Billing Address:</td>
								<td colspan="3">
									<input type="text" name="phone<? echo $counter; ?>_port_billaddr1" id="phone<? echo $counter; ?>_port_billaddr1" size="20" maxlength="50" tabindex="<? echo ($counter*20)+11; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value="">
									<img src="images/spacer.gif" alt="" width="3" height="1" border="0">
									<input type="text" name="phone<? echo $counter; ?>_port_billaddr2" id="phone<? echo $counter; ?>_port_billaddr2" size="20" maxlength="50" tabindex="<? echo ($counter*20)+12; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;width: 137;" value="">
								</td>
							</tr>
							<tr>
								<td align="right">Billing City/State/Zipcode:</td>
								<td colspan="3">
									<input type="text" name="phone<? echo $counter; ?>_port_billcity" id="phone<? echo $counter; ?>_port_billcity" size="20" maxlength="50" tabindex="<? echo ($counter*20)+13; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value="">
									<img src="images/spacer.gif" alt="" width="3" height="1" border="0">
									<select name="phone<? echo $counter; ?>_port_billstate" id="phone<? echo $counter; ?>_port_billstate" tabindex="<? echo ($counter*20)+14; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;">
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
									<input type="text" name="phone<? echo $counter; ?>_port_billzip" id="phone<? echo $counter; ?>_port_billzip" size="6" maxlength="10" tabindex="<? echo ($counter*20)+15; ?>" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;width: 57;" value="">
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
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<br>
			<input type="hidden" name="task" value="addport">
			<input type="hidden" name="sid" value="<? echo $SID; ?>">
<!--			<ul><input type="image" src="images/ContinueButton.gif" onClick="document.getElementById(this).submit();">-->
			<img src="images/spacer.gif" alt="" width="50" height="1" border="0"><input type="image" src="images/<? echo $AddToOrderButton; ?>">
			<br><br>
		<td>
		</form>
	</tr>
	</tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
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
				theForm.first_name.style.background="<? echo $form_bg; ?>";
				theForm.first_name.focus();
				return false;
			}
		}
	// Last Name
		if (theForm.last_name){
			if (theForm.last_name.value == ""){
				theForm.last_name.style.background="#FF0000";
				alert("Please Enter Your Last Name");
				theForm.last_name.style.background="<? echo $form_bg; ?>";
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
				theForm.ship_address_1.style.background="<? echo $form_bg; ?>";
				theForm.ship_address_2.style.background="<? echo $form_bg; ?>";
				theForm.ship_address_1.focus();
				return false;
			}
		}
	// Shipping City
		if (theForm.ship_city){
			if (theForm.ship_city.value == ""){
				theForm.ship_city.style.background="#FF0000";
				alert("Please Enter Your Shipping City");
				theForm.ship_city.style.background="<? echo $form_bg; ?>";
				theForm.ship_city.focus();
				return false;
			}
		}
	// Shipping State
		if (theForm.ship_state){
			if (theForm.ship_state.value == ""){
				theForm.ship_state.style.background="#FF0000";
				alert("Please Select Your Shipping State");
				theForm.ship_state.style.background="<? echo $form_bg; ?>";
				theForm.ship_state.focus();
				return false;
			}
		}
	// Shipping Zip Code
		if (theForm.ship_zipcode){
			if (theForm.ship_zipcode.value == ""){
				theForm.ship_zipcode.style.background="#FF0000";
				alert("Please Enter Your Shipping Zipcode");
				theForm.ship_zipcode.style.background="<? echo $form_bg; ?>";
				theForm.ship_zipcode.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.ship_zipcode.value) == false && cdn_regex.test(theForm.ship_zipcode.value) == false) { 
 			if (usa_regex.test(theForm.ship_zipcode.value) == false) { 
				theForm.ship_zipcode.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.ship_zipcode.style.background="<? echo $form_bg; ?>";
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
				theForm.bill_address_1.style.background="<? echo $form_bg; ?>";
				theForm.bill_address_2.style.background="<? echo $form_bg; ?>";
				theForm.bill_address_1.focus();
				return false;
			}
		}
	// Billing City
		if (theForm.bill_city){
			if (theForm.bill_city.value == ""){
				theForm.bill_city.style.background="#FF0000";
				alert("Please Enter Your Billing City");
				theForm.bill_city.style.background="<? echo $form_bg; ?>";
				theForm.bill_city.focus();
				return false;
			}
		}
	// Billing State
		if (theForm.bill_state){
			if (theForm.bill_state.value == ""){
				theForm.bill_state.style.background="#FF0000";
				alert("Please Select Your Billing State");
				theForm.bill_state.style.background="<? echo $form_bg; ?>";
				theForm.bill_state.focus();
				return false;
			}
		}
	// Billing Zip Code
		if (theForm.bill_zipcode){
			if (theForm.bill_zipcode.value == ""){
				theForm.bill_zipcode.style.background="#FF0000";
				alert("Please Enter Your Billing Zipcode");
				theForm.bill_zipcode.style.background="<? echo $form_bg; ?>";
				theForm.bill_zipcode.focus();
				return false;
			}
			var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//			var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
// 			if (usa_regex.test(theForm.bill_zipcode.value) == false && cdn_regex.test(theForm.bill_zipcode.value) == false) { 
 			if (usa_regex.test(theForm.bill_zipcode.value) == false) { 
				theForm.bill_zipcode.style.background="#FF0000";
				alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
				theForm.bill_zipcode.style.background="<? echo $form_bg; ?>";
				theForm.bill_zipcode.focus();
				return false;
			}
		}
	// Home Phone Number
		if (theForm.home_phone){
			if (theForm.home_phone.value == ""){
				theForm.home_phone.style.background="#FF0000";
				alert("Please Enter Your Home Phone Number");
				theForm.home_phone.style.background="<? echo $form_bg; ?>";
				theForm.home_phone.focus();
				return false;
			}
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.home_phone.value) == false && phone2_regex.test(theForm.home_phone.value) == false) { 
				theForm.home_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.home_phone.style.background="<? echo $form_bg; ?>";
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
//				theForm.alt_phone.style.background="<? echo $form_bg; ?>";
//				theForm.alt_phone.focus();
//				return false;
//			}
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.alt_phone.value) == false && phone2_regex.test(theForm.alt_phone.value) == false) { 
				theForm.alt_phone.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.alt_phone.style.background="<? echo $form_bg; ?>";
				theForm.alt_phone.focus();
				return false;
			}
		}
	// Existing Carrier Phone Number
		if (theForm.carrier_phone){
			if (theForm.carrier_phone.value != ""){
				var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
				var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
	 			if (phone1_regex.test(theForm.carrier_phone.value) == false && phone2_regex.test(theForm.carrier_phone.value) == false) { 
					theForm.carrier_phone.style.background="#FF0000";
					alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN or leave blank');
					theForm.carrier_phone.style.background="<? echo $form_bg; ?>";
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
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email_confirm.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for "@"
	 		if (theForm.email.value.indexOf("@") == -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain an "@"');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for "@" as first char.
	 		if (theForm.email.value.indexOf("@") == 0) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "@"');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for anything after "@"
	 		if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a Domain Name After the "@"');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for multiple "@"
	 		if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain Only One "@"');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for "."
	 		if (theForm.email.value.indexOf(".") == -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a "."');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for "." as first char.
	 		if (theForm.email.value.indexOf(".") == 0) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "."');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for ".."
	 		if (theForm.email.value.indexOf("..") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots ("..")');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for "." adjacent to "@"
	 		if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for TLD
	 		if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for TLD at least 2 char.
			var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
			if (domain.length - (domain.indexOf(".")+1) < 2) {
				theForm.email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for TLD over 3 char.
//			if (domain.length - (domain.indexOf(".")+1) > 3) {
//				theForm.email.style.background="#FF0000";
//				alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//				theForm.email.style.background="<? echo $form_bg; ?>";
//				theForm.email.focus();
//				return false;
//			}
			// Check for "_" in TLD
			if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
				theForm.email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for spaces
	 		if (theForm.email.value.indexOf(" ") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Spaces (" ")');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			// Check for illegal char.
			var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	 		if (email_regex.test(theForm.email.value) == false) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
			if (theForm.email.value != theForm.email_confirm.value){
				theForm.email.style.background="#FF0000";
				theForm.email_confirm.style.background="#FF0000";
				alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
				theForm.email.style.background="<? echo $form_bg; ?>";
				theForm.email_confirm.style.background="<? echo $form_bg; ?>";
				theForm.email.focus();
				return false;
			}
		}
	// SSN
		if (theForm.ssn){
			if (theForm.ssn.value == ""){
				theForm.ssn.style.background="#FF0000";
				alert("Please Enter Your Social Security Number");
				theForm.ssn.style.background="<? echo $form_bg; ?>";
				theForm.ssn.focus();
				return false;
			}
			var ssn_regex = /(^\d{3}-\d{2}-\d{4}$)/;  // xxx-xx-xxxx
 			if (ssn_regex.test(theForm.ssn.value) == false) { 
				theForm.ssn.style.background="#FF0000";
				alert('Please Enter a Valid Social Security Number as "NNN-NN-NNNN"');
				theForm.ssn.style.background="<? echo $form_bg; ?>";
				theForm.ssn.focus();
				return false;
			}
		}
	// Date of Birth
		if (theForm.dob){
			if (theForm.dob.value == ""){
				theForm.dob.style.background="#FF0000";
				alert("Please Enter Your Date of Birth");
				theForm.dob.style.background="<? echo $form_bg; ?>";
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
				theForm.dob.style.background="<? echo $form_bg; ?>";
				theForm.dob.focus();
				return false;
			}
			// is it a valid date?
			if (isValidDate(theForm.dob.value) == false){
				theForm.dob.style.background="#FF0000";
				alert("Please Enter A Valid Date for Date of Birth");
				theForm.dob.style.background="<? echo $form_bg; ?>";
				theForm.dob.focus();
				return false;
			}
			// are they 18?
			var now = new Date();
			var then = new Date(now.getTime()-(1000*60*60*24*365*18+345600000)); // 18 years ago + 4 days for leap years
			if (compareDates(theForm.dob.value,"M/d/yyyy",formatDate(then,'M/d/yyyy'),"M/d/yyyy") == 1){
				theForm.dob.style.background="#FF0000";
				alert("The Birth Date you entered indicates you are not yet 18 - you must be at least 18 to order a phone.");
				theForm.dob.style.background="<? echo $form_bg; ?>";
				theForm.dob.focus();
				return false;
			}
		}
	// Driver's License Number
		if (theForm.dl_num){
			if (theForm.dl_num.value == ""){
				theForm.dl_num.style.background="#FF0000";
				alert("Please Enter Your Driver's License Number");
				theForm.dl_num.style.background="<? echo $form_bg; ?>";
				theForm.dl_num.focus();
				return false;
			}
		}
	// Driver's License State
		if (theForm.dl_state){
			if (theForm.dl_state.value == ""){
				theForm.dl_state.style.background="#FF0000";
				alert("Please Select Your Driver's License State");
				theForm.dl_state.style.background="<? echo $form_bg; ?>";
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
				theForm.dl_exp_month.style.background="<? echo $form_bg; ?>";
				theForm.dl_exp_month.focus();
				return false;
			}
		}
	// Driver's License Expiration Day
		if (theForm.dl_exp_day){
			if (theForm.dl_exp_day.value == ""){
				theForm.dl_exp_day.style.background="#FF0000";
				alert("Please Select Your Driver's License Expiration Day\n\r(Choose the last day of the month if there isn't an expiration day)");
				theForm.dl_exp_day.style.background="<? echo $form_bg; ?>";
				theForm.dl_exp_day.focus();
				return false;
			}
		}
	// Driver's License Expiration Year
		if (theForm.dl_exp_year){
			if (theForm.dl_exp_year.value == ""){
				theForm.dl_exp_year.style.background="#FF0000";
				alert("Please Select Your Credit Card Expiration Year");
				theForm.dl_exp_year.style.background="<? echo $form_bg; ?>";
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
			theForm.dl_exp_month.style.background="<? echo $form_bg; ?>";
			theForm.dl_exp_day.style.background="<? echo $form_bg; ?>";
			theForm.dl_exp_year.style.background="<? echo $form_bg; ?>";
			theForm.dl_exp_month.focus();
			return false;
		}

////////////////////////////////////////////////////////////////

	// Credit Card Type
		if (theForm.cc_type){
			if (theForm.cc_type.value == ""){
				theForm.cc_type.style.background="#FF0000";
				alert("Please Select Your Credit Card Type");
				theForm.cc_type.style.background="<? echo $form_bg; ?>";
				theForm.cc_type.focus();
				return false;
			}
		}
	// Credit Card Expiration Month
		if (theForm.exp_month){
			if (theForm.exp_month.value == ""){
				theForm.exp_month.style.background="#FF0000";
				alert("Please Select Your Credit Card Expiration Month");
				theForm.exp_month.style.background="<? echo $form_bg; ?>";
				theForm.exp_month.focus();
				return false;
			}
		}
	// Credit Card Expiration Year
		if (theForm.exp_year){
			if (theForm.exp_year.value == ""){
				theForm.exp_year.style.background="#FF0000";
				alert("Please Select Your Credit Card Expiration Year");
				theForm.exp_year.style.background="<? echo $form_bg; ?>";
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
			theForm.exp_month.style.background="<? echo $form_bg; ?>";
			theForm.exp_year.style.background="<? echo $form_bg; ?>";
			theForm.exp_month.focus();
			return false;
		}
	// Credit Card Name
		if (theForm.cc_name){
			if (theForm.cc_name.value == ""){
				theForm.cc_name.style.background="#FF0000";
				alert("Please Enter The Name Exactly As It Appears On Your Credit Card");
				theForm.cc_name.style.background="<? echo $form_bg; ?>";
				theForm.cc_name.focus();
				return false;
			}
		}
	// Credit Card Number
		if (theForm.cc_num){
			if (theForm.cc_num.value == ""){
				theForm.cc_num.style.background="#FF0000";
				alert("Please Enter The Credit Card Number");
				theForm.cc_num.style.background="<? echo $form_bg; ?>";
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
						theForm.cc_num.style.background="<? echo $form_bg; ?>";
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
						theForm.cc_num.style.background="<? echo $form_bg; ?>";
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
						theForm.cc_num.style.background="<? echo $form_bg; ?>";
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
						theForm.cc_num.style.background="<? echo $form_bg; ?>";
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
				theForm.cc_num.style.background="<? echo $form_bg; ?>";
				theForm.cc_num.focus();
				return false;
			}
		}
	// Credit Card CID
		if (theForm.cc_cid){
			if (theForm.cc_cid.value == ""){
				theForm.cc_cid.style.background="#FF0000";
				alert("Please Enter Your Credit Card CID Security Code");
				theForm.cc_cid.style.background="<? echo $form_bg; ?>";
				theForm.cc_cid.focus();
				return false;
			}
		}
		return true;
	}
	</script>

	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Account Information<br><span class="<? echo $tab_class; ?>"><font size="-2">Step 4 of 5</font></span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
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
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<form action="saveit.php" method="post" name="PushInfo" id="PushInfo" onSubmit="return validateInfo(this);">
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
			<tr bgcolor="<? echo $box_color; ?>">
				<td width="900" class="bodyWhite"><strong>&nbsp;Billing &amp; Shipping Information</strong></td>
			</tr>
			<tr>
				<td class="bodyBlack">
					<br>
					<ul>
						<li>For your protection, the information entered here must match what appears on your credit card statement!<br><strong>We will ship only to your credit card billing address.</strong></li>
					</ul>
				</td>
			</tr>
			<tr bgcolor="<? echo $box_color; ?>">
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
								<td><input type="text" name="first_name" id="first_name" size="30" maxlength="30" tabindex="1" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">First</td>
								<td><input type="text" name="middle_name" id="middle_name" size="5" maxlength="5" tabindex="2" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">MI</span></td>
								<td><input type="text" name="last_name" id="last_name" size="30" maxlength="30" tabindex="3" class="bodyWhitek" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Last</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Shipping Address:<br><span class="smallBlack">Make sure this matches<br>your credit card statement.<br><strong>Cannot be a P.O. Box.</strong></span></td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="ship_address_1" id="ship_address_1" size="30" maxlength="50" tabindex="4" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td colspan="2"><input type="text" name="ship_address_2" id="ship_address_2" size="30" maxlength="50" tabindex="5" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
							</tr>
							<tr>
								<td><input type="text" name="ship_city" id="ship_city" size="30" maxlength="50" tabindex="6" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">City</td>
								<td>
									<select name="ship_state" id="ship_state" tabindex="7" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;">
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
								<td><input type="text" name="ship_zipcode" id="ship_zipcode" size="10" maxlength="10" tabindex="8" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Zip Code</span></td>
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
								<td><input type="text" name="bill_address_1" id="bill_address_1" size="30" maxlength="50" tabindex="9" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td colspan="2"><input type="text" name="bill_address_2" id="bill_address_2" size="30" maxlength="50" tabindex="10" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
							</tr>
							<tr>
								<td><input type="text" name="bill_city" id="bill_city" size="30" maxlength="50" tabindex="11" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">City</td>
								<td>
									<select name="bill_state" id="bill_state" tabindex="12" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;">
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
								<td><input type="text" name="bill_zipcode" id="bill_zipcode" size="10" maxlength="10" tabindex="13" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Zip Code</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Phone Numbers:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="home_phone" id="home_phone" size="18" maxlength="13" tabindex="14" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Home</span></td>
								<td><input type="text" name="alt_phone" id="alt_phone" size="18" maxlength="13" tabindex="15" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Alternate</span></td>
								<td><input type="text" name="carrier_phone" id="carrier_phone" size="18" maxlength="13" tabindex="16" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><span class="smallBlack"> (If you have a current account)<br>Verizon Wireless</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Email Address:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="email" id="email" size="30" maxlength="50" tabindex="17" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td class="xbigBlack">&nbsp;&nbsp;Confirm:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="email_confirm" id="email_confirm" size="30" maxlength="50" tabindex="18" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
			<br>
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
			<tr bgcolor="<? echo $box_color; ?>">
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
			<tr bgcolor="<? echo $box_color; ?>">
				<td width="900" class="bodyWhite"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
			</tr>
			<tr>
				<td>
					<table width="900" border="0" cellspacing="0" cellpadding="5" align="center" class="borderNone">
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>Social Security Number:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="ssn" id="ssn" size="20" maxlength="11" tabindex="19" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><span class="smallBlack"> <a onClick="whyssn.style.visibility='visible';" class="smallBlack" style="text-decoration:underline; cursor:pointer;">Why do you need my SSN</a>?<br>Format: 555-55-5555</span></td>
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
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>Date of Birth:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="dob" id="dob" size="30" maxlength="10" tabindex="20" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""><span class="smallBlack"> <a onClick="whydob.style.visibility='visible';" class="smallBlack" style="text-decoration:underline; cursor:pointer;">Why do you need my date of birth</a>?<br>Format: mm/dd/yyyy</span></td>
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
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Driver's License Number:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="dl_num" id="dl_num" size="30" maxlength="50" tabindex="21" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td class="xbigBlack">&nbsp;&nbsp;State:<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									<select name="dl_state" id="dl_state" tabindex="22" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;">
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
						<td width="200">&nbsp;</td>
					</tr>

<!------------------------------------------------------------------------>

					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Driver's License Expiration:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td>
									<select name="dl_exp_month" id="dl_exp_month" class="bodyWhite" style="background-color:<? echo $form_bg; ?>; width:125px;" tabindex="23">
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
									<select name="dl_exp_day" id="dl_exp_day" class="bodyWhite" style="background-color:<? echo $form_bg; ?>; width:65px;" tabindex="24">
										<option value="">Day</option>
<?
for ($option=1; $option <= 31; $option++){
	echo'
										<option value="'.iif($option<10,"0","").$option.'">'.$option.'</option>
	';
}
?>
									</select>
									<select name="dl_exp_year" id="dl_exp_year" class="bodyWhite" style="background-color:<? echo $form_bg; ?>; width: 67px;" tabindex="25">
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
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
			<tr bgcolor="<? echo $box_color; ?>">
				<td width="900" class="bodyWhite"><strong>&nbsp;Credit Card Information</strong></td>
			</tr>
			<tr>
				<td>
					<table width="900" border="0" cellspacing="0" cellpadding="5" align="center" class="borderNone">
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Credit Card Type:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td>
									<select name="cc_type" id="cc_type" class="bodyWhite" style="background-color: <? echo $form_bg; ?>; width: 195px;" tabindex="26">
										<option value="">Select Type of Card</option>
										<option value="Visa">Visa</option>
										<option value="MasterCard">MasterCard</option>
										<option value="American Express">American Express</option>
										<option value="Discover">Discover</option>
									</select>
								</td>
								<td class="xbigBlack">&nbsp;&nbsp;Expiration:<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									<select name="exp_month" id="exp_month" class="bodyWhite" style="background-color:<? echo $form_bg; ?>; width:125px;" tabindex="27">
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
									<select name="exp_year" id="exp_year" class="bodyWhite" style="background-color:<? echo $form_bg; ?>; width: 67px;" tabindex="28">
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
								<td><input type="text" name="cc_num" id="cc_num" size="30" maxlength="25" tabindex="29" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value="" onkeypress="return onlyNumbers(event)"><br><span class="smallBlack">Numbers Only</span></td>
								</td>
								<td valign="top" class="xbigBlack">&nbsp;&nbsp;Credit Card CID:<img src="images/spacer.gif" alt="" width="10" height="1" border="0"><input type="text" name="cc_cid" id="cc_cid" size="5" maxlength="5" tabindex="30" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value="" onkeypress="return onlyNumbers(event)"><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.<? echo $domain; ?>/cid_<? echo $carrier_label; ?>.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">What is this</a>?</span>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Name On Credit Card:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="cc_name" id="cc_name" size="30" maxlength="50" tabindex="31" class="bodyWhite" style="background-color: <? echo $form_bg; ?>;" value=""> <span class="smallBlack">(Exactly as it appears on the card.)</span></td>
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
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<br>
			<input type="hidden" name="task" value="addinfo">
			<input type="hidden" name="affiliation" value="<? echo $label; ?>">
			<input type="hidden" name="sid" value="<? echo $SID; ?>">
			<img src="images/spacer.gif" alt="" width="50" height="1" border="0"><input type="image" name="submit" src="images/<? echo $AddToOrderButton; ?>">
			<br><br>
		<td>
		</form>
	</tr>
	</tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
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
		<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Order Summary<br><span class="<? echo $tab_class; ?>"><font size="-2">Step 5 of 5</font></span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
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
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $bar_color; ?>">
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
										<td><strong>AT&T Phone:&nbsp;</strong></td>
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
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $bar_color; ?>" class="bodyWhite">
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
					$today = ($row['phone'.$counter.'_msrp']-($row['phone'.$counter.'_ir1']+$row['phone'.$counter.'_ir2']));
					$today_subtotal += $today;
					$tomorrow = ($today-($row['phone'.$counter.'_mir1']+$row['phone'.$counter.'_mir2']));
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
						<td colspan="2" align="right" bgcolor="<? echo $bar_color; ?>" class="bodyWhite"><strong>Phone<? echo iif($counter > 1, 's', ''); ?> Total:&nbsp;</strong></td>
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
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $bar_color; ?>" class="bodyWhite">
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
						<td colspan="2" align="right" bgcolor="<? echo $box_color; ?>" class="bodyWhite"><strong>Monthy Plan<? echo iif($plans > 1, 's', ''); ?> Total:&nbsp;</strong></td>
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
							array('rescue', 'Roadside Rescue'),
							array('voice_command', 'Sprint PCS Voice Command')
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
						<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
						<tr bgcolor="<? echo $box_color; ?>" class="bodyWhite">
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
								array('rescue', 'Roadside Rescue'),
								array('voice_command', 'Sprint PCS Voice Command')
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
							<td align="right" bgcolor="<? echo $bar_color; ?>" class="bodyWhite"><strong>Monthy Option<? echo iif($count > 1, 's', ''); ?> Total:&nbsp;</strong></td>
							<td align="right" class="bodyBlack"><strong><strike><? echo money_format('%-#4n', $opt_cost); ?></strike></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td align="right" class="bodyBlack"><strong><? echo money_format('%-#4n', ($opt_cost-($opt_cost*($discount*.01)))); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						</tr>
						</table>
					<?
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
						<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
						<tr bgcolor="<? echo $bar_color; ?>" class="bodyWhite">
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
							<td colspan="2" align="right" bgcolor="<? echo $bar_color; ?>" class="bodyWhite"><strong>Accessories Total:&nbsp;</strong></td>
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
Customer Agreement Terms & Conditions

Your Verizon Wireless Customer Agreement

Please carefully read this agreement, including the Calling Plan or Plans you've chosen, before filing it in a safe place.

(Para una copia de este documento en espanol, llame al 1.800.922.0204 o visite a nuestro website a espanol.vzwshop.com.)

By accepting this agreement, you're bound by its conditions. It covers important topics such as how long it lasts, fees for early termination and late payments, our rights to change its conditions and your wireless service, limitations of liability, privacy, and settlement of disputes by arbitration instead of in court. If you accept this agreement, it will apply to all your wireless service from us, including all your existing Calling Plans and other lines in service.

Your Calling Plans

YOUR CALLING PLANS BECOME PART OF THIS AGREEMENT. The prices you pay may depend in part on how long-the minimum term-you're agreeing in advance to do business with us. Calling Plans describe these prices and your minimum term. To the extent any condition in your Calling Plan expressly conflicts with this agreement, the condition in your Calling Plan will govern. If at any time you change your service (by accepting a promotion, for example), you'll be subject to any requirements, such as a new minimum term, we set for that change.

Your Rights to Refuse or Cancel This Agreement

THIS AGREEMENT STARTS WHEN YOU ACCEPT. Paragraphs marked "&sect;" continue after it ends. You accept when you do any of the following things after an opportunity to review this agreement:

     &middot; Give us a written or electronic signature; 
     &middot; Tell us orally or electronically that you accept; 
     &middot; Activate your service through your wireless phone; 
     &middot; Open a package that says you are accepting by opening it; or 
     &middot; Use your service after making any change or addition when we've told you that the change or addition requires acceptance.

IF YOU DON'T WANT TO ACCEPT, DON'T DO ANY OF THESE THINGS. You can cancel (if you're a new customer) or go back to the conditions of your former Customer Agreement (if you're already a customer) without additional fees if you tell us (and return to us in good condition any wireless phone you got from us with your new service) WITHIN 30 DAYS of accepting. You'll still be responsible through that date for the new service and any charges associated with it.

Your Rights to Change or End Your Service; Termination Fees; Phone Number Portability

&sect; Except as explicitly permitted by this agreement, you're agreeing to maintain service with us for your minimum term. (Periods of suspension of service don't count towards fulfillment of your minimum term.) After that, you'll become a month-to-month customer under this agreement. AN EARLY TERMINATION FEE WILL APPLY IF YOU CHOOSE TO END YOUR SERVICE BEFORE BECOMING A MONTH-TO-MONTH CUSTOMER, OR IF WE TERMINATE IT EARLY FOR GOOD CAUSE. FOR SERVICE ACTIVATED PRIOR TO 11/16/06, THE EARLY TERMINATION FEE IS $175 PER WIRELESS PHONE NUMBER. FOR SERVICE ACTIVATED ON OR AFTER 11/16/06, OR FOR LINES OF SERVICE WITH MINIMUM TERMS EXTENDED ON OR AFTER 11/16/06, THE EARLY TERMINATION FEE IS $175, WHICH WILL BE REDUCED BY $5 FOR EACH FULL MONTH TOWARD YOUR MINIMUM TERM THAT YOU COMPLETE. (The Early Termination Fee applies only to the extent permitted by law. If you buy your wireless phone from an authorized agent or third-party vendor, you should check to see if they charge a separate termination fee.) If you terminate your service as of the end of your minimum term, you won't be responsible for any remaining part of your monthly billing cycle. Otherwise, all terminations by you during a monthly billing cycle become effective on the last day of that billing cycle. You'll remain responsible for all fees and charges incurred until then and won't be entitled to any partial month credits or refunds. You may be able to take, or "port," your current wireless phone number to another service provider. If you request your new service provider to port a number from us, and we receive your request from that new service provider, we'll treat it as notice from you to terminate our service for that number upon successful completion of porting. After the porting is completed, you won't be able to use our service for that number. You'll remain responsible for any Early Termination Fee, and for all fees and charges through the end of that billing cycle, just like any other termination. If you're porting a phone number to us from another company, we may not be able to provide you some services, such as 911 location services, immediately.

Our Rights to Make Changes

Your service is subject to our business policies, practices, and procedures, which we can change without notice. UNLESS OTHERWISE PROHIBITED BY LAW, WE CAN ALSO CHANGE PRICES AND ANY OTHER CONDITIONS IN THIS AGREEMENT AT ANY TIME BY SENDING YOU WRITTEN NOTICE PRIOR TO THE BILLING PERIOD IN WHICH THE CHANGES WOULD GO INTO EFFECT. IF YOU CHOOSE TO USE YOUR SERVICE AFTER THAT POINT, YOU'RE ACCEPTING THE CHANGES. IF THE CHANGES HAVE A MATERIAL ADVERSE EFFECT ON YOU, HOWEVER, YOU CAN END THE AFFECTED SERVICE, WITHOUT ANY EARLY TERMINATION FEE, JUST BY CALLING US WITHIN 60 DAYS AFTER WE SEND NOTICE OF THE CHANGE.

Your Wireless Phone

Your wireless phone is any device you use to receive our wireless voice or data service. It must comply with Federal Communications Commission regulations and be compatible with our network and your Calling Plan. Whether you buy your wireless phone from us or someone else is entirely your choice. At times we may change your wireless phone's software, applications or programming remotely and without notice. This could affect data you've stored on, the way you've programmed, or the way you use, your wireless phone. Your wireless phone may also contain software that prevents it from being used with any other company's wireless service, even if it's no longer used to receive our service.

Your Wireless Phone Number and Caller ID

You don't have any rights in any personal identification number, email address, or identifier we assign you (we'll tell you if we decide to change or reassign them). The same is true of your wireless phone number, except for any right you may have to port it. Your wireless phone number and name may show up when you call someone. You can block this "Caller ID" for most calls by dialing *67 before each call, or by ordering per-line call blocking (dialing *82 to unblock) where it's available. You can't block Caller ID to some numbers, such as toll-free numbers.

How Service Works

Wireless phones use radio transmissions, so we can't provide service when your wireless phone isn't in range of one of our transmission sites, or a transmission site of another company that's agreed to carry our customers' calls, or if there isn't sufficient network capacity available at that moment. Even within a coverage area, there are many factors, including customer's equipment, terrain, proximity to buildings, foliage, and weather, that may impact service.

Charges and Fees We Set

&sect; You agree to pay all access, usage, and other charges and fees we bill you or that the user of your wireless phone accepted, even if you weren't the user of your wireless phone and didn't authorize its use. These include Federal Universal Service, Regulatory and administrative Charges, and may also include other charges related to our governmental costs. We set these charges. They aren't taxes, aren't required by law, are kept by us in whole or in part, and the amounts and what's included are subject to change. You may have to pay fees to begin service or reconnect suspended service. Usage charges may vary depending on where, when, and how you call. You have a Home Rate and Coverage Area and a Local Calling Area (which may be different). When you call from inside a Local Calling Area to somewhere outside of it, or call from anywhere outside a Local Calling Area, there may be toll, regional calling, or long distance charges in addition to airtime (we provide or select the long distance service for calls on our network). When you make a call inside your Local Calling Area that uses a local phone company's lines (for example, a call to a typical home phone number), we may charge landline or connection fees. We charge airtime for most calls, including toll-free and operator-assisted calls. Additional features and services such as operator or directory assistance, call dialing, calling card use, Call Forwarding, data calls, automatic call delivery, Voice Mail, Text Messaging, and wireless Internet access, may have additional charges. Features such as Call Waiting, Call Forwarding, or 3-Way Calling involve multiple calls and multiple charges.

Taxes, Fees, and Surcharges We Don't Set

&sect; You agree to pay all taxes, fees, and surcharges set by the government. We may not always give advance notice of changes to these items. If you're tax-exempt you must give us your exemption certificates and pay for any filings we make.

Roaming and Roaming Charges

You're "roaming" whenever you make or receive a call using a transmission site outside your Home Rate and Coverage Area, or using another company's transmission site. Your wireless phone may sometimes connect to and roam on another company's network even when you're within your Home Rate and Coverage Area or Local Calling Area. There may be extra charges (including charges for long distance, tolls, or calls that don't connect) and higher rates for roaming calls, depending on your Calling Plan.

Your Bill

&sect; Your bill is our notice to you of your fees, charges and other important information. You should read everything in your bill. We bill usage charges after calls are made or received. We bill access fees and some other charges in advance. You can view your detailed bill online. We'll also send you a streamlined bill without call detail (or a detailed bill if you request one, subject to any applicable fee). We may charge a fee for bill reprints. If you choose Internet billing (where available), you waive any right to paper bills or notices.

How We Calculate Your Bill

Your bill reflects the fees and charges in effect under your Calling Plan at the time they're incurred. You can dispute your bill, but only within 180 days of receiving it. Unless otherwise provided by state law, you must still pay any disputed charges until the dispute is resolved. Charges may vary depending on where your wireless phone is when a call starts. If a charge depends on an amount of time used, we'll round up any fraction of a minute to the next full minute. Time starts when you first press SEND or the call connects to a network on outgoing calls, and when the call connects to a network (which may be before it rings) on incoming calls. Time may end several seconds after you press END or the call otherwise disconnects. For calls made on our network, we only bill for calls that are answered (which includes calls answered by machines). Most calls you make or receive during a billing cycle are included in your bill for that cycle. Billing for airtime (including roaming) and related charges may, however, sometimes be delayed. Delayed airtime will be applied against the included airtime for the month when you actually made or received the call, even though such charges may show up on a later bill. This may result in charges higher than you'd expect in the later month.

Your Rights for Dropped Calls or Interrupted Service

If you get disconnected by our network from a call in your Home Rate and Coverage Area, redial. If the same number answers within 5 minutes, call us within 90 days and we'll give you a 1-minute airtime credit. If service is interrupted in your Home Rate and Coverage Area for more than 24 hours in a row due to our fault, call us within 180 days and we'll give you a credit for the period of interruption. These are your only rights for dropped calls or interrupted service.

Payments, Deposits, Credit Cards, and Checks

&sect; Payment is due in full as stated on your bill. IF WE DON'T RECEIVE PAYMENT IN FULL WHEN DUE, WE MAY, TO THE EXTENT PERMITTED BY THE LAW OF THE STATE OF THE BILLING ADDRESS WE HAVE ON FILE FOR YOU AT THE TIME, CHARGE YOU A LATE FEE OF UP TO 1.5 PERCENT A MONTH (18 PERCENT ANNUALLY), OR A FLAT $5 A MONTH, WHICHEVER IS GREATER, ON UNPAID BALANCES. (IF YOU CHOOSE ANOTHER COMPANY TO BILL YOU FOR OUR SERVICE [SUCH AS ANOTHER VERIZON COMPANY], LATE FEES WILL BE SET BY THAT PARTY OR BY ITS TARIFFS, WHICH MAY BE HIGHER THAN OUR LATE FEE RATE.) WE MAY ALSO CHARGE YOU FOR ANY COLLECTION AGENCY FEES THAT WE ARE CHARGED BY A COLLECTION AGENCY WE USE TO COLLECT FROM YOU IF IT IS PERMITTED BY THE LAW OF THE STATE WHERE YOU HAVE YOUR BILLING ADDRESS WHEN WE FIRST SEND YOUR ACCOUNT TO A COLLECTION AGENCY. We may require an advance deposit (or an increased deposit) from you. We'll pay simple interest on any deposit at the rate the law requires. Please retain your evidence of deposit. You agree that we can apply deposits, payments, or prepayments in any order to any amounts you owe us on any account. You can't use a deposit to pay any bill unless we agree. We refund final credit balances of less than $1 only upon request. We won't honor limiting notations you make on or with your checks. We may charge you up to $25 for any returned check, depending on applicable law.

If Your Wireless Phone is Lost or Stolen

If your wireless phone is lost or stolen, it is very important that you notify us immediately for your own protection, so that we can suspend your service to prevent further usage. If your bill shows charges to your phone after the loss but before you reported it, and you want a credit for those charges, we will investigate your account activity. You do not have to pay the charges you dispute while they are being investigated to determine whether the charges resulted from usage by someone not authorized to use the phone. Further, if we haven't given you a courtesy suspension of recurring monthly fees within the prior year, we'll give you one for 30 days, or until you replace or recover your wireless phone, whichever comes first. You may need to provide further information regarding the theft or loss if we ask for it.

Our Rights to Limit or End Service or This Agreement

You agree not to resell our service to someone else without our prior written permission. You also agree your wireless phone won't be used for any other purpose that isn't allowed by this agreement or that's illegal. You agree that you won't install, deploy, or use any regeneration equipment or similar mechanism (for example, a repeater) to originate, amplify, enhance, retransmit or regenerate a transmitted RF signal. WE CAN, WITHOUT NOTICE, LIMIT, SUSPEND, OR END YOUR SERVICE OR ANY AGREEMENT WITH YOU FOR THIS OR ANY OTHER GOOD CAUSE, including, but not limited to: (a) paying late more than once in any 12 months; (b) incurring charges larger than a required deposit or billing limit (even if we haven't yet billed the charges); (c) harassing our employees or agents; (d) lying to us; (e) interfering with our operations; (f) breaching this agreement; (g) "spamming," or other abusive messaging or calling; (h) modifying your wireless phone from its manufacturer's specifications; (i) providing credit information we can't verify; (j) using your service in a way that adversely affects our network or other customers; or (k) allowing anyone to tamper with your wireless phone number. We can also temporarily limit your service for any operational or governmental reason. If you file for bankruptcy, our rights to limit, suspend, or end your service or any agreement with you will be governed by bankruptcy law.

Directory Information

&sect; We don't publish directories of our customers' phone numbers. We don't provide them to third parties for listing in directories either.

Your Privacy - IMPORTANT INFORMATION - PLEASE READ CAREFULLY BEFORE MAKING YOUR PURCHASE DECISION

&sect; We have a duty under federal law to protect the confidentiality of information about the quantity, technical configuration, type, destination, and amount of your use of our service, together with similar information on your bills. (This doesn't include your name, address, and wireless phone number.) Except as provided in this agreement, we won't intentionally share personal information about you without your permission. WE MAY USE AND SHARE INFORMATION ABOUT YOU AND HOW YOU USE THE SERVICES: (A) SO WE CAN PROVIDE OUR GOODS OR SERVICES; (B) SO OTHERS CAN PROVIDE GOODS OR SERVICES TO US, OR TO YOU ON OUR BEHALF; (C) SO WE OR OUR AFFILIATES CAN COMMUNICATE WITH YOU ABOUT GOODS OR SERVICES THAT ANY OF US OFFER (ALTHOUGH YOU CAN CALL US ANY TIME IF YOU DON'T WANT US TO DO THIS); (D) TO PROTECT OURSELVES; OR (E) AS REQUIRED BY LAW, LEGAL PROCESS, OR EXIGENT CIRCUMSTANCES. IN ADDITION, WE MAY INCLUDE OUR OWN OR THIRD-PARTY ADVERTISING IN THE SERVICES YOU'VE PURCHASED FROM US, AND WE MAY SHARE INFORMATION ABOUT YOU WITH AFFILIATES, VENDORS AND THIRD PARTIES TO, IN ADDITION TO THE ABOVE REASONS, DELIVER RELEVANT ADVERTISING TO YOU WHILE USING THE SERVICES. WE MAY COLLECT AND TRANSMIT INFORMATION REGARDING YOUR USE OF THE SERVICES THROUGH APPLICATIONS OR OTHER SOFTWARE PRESENT ON YOUR DEVICE. IF YOU DO NOT WANT US TO COLLECT, TRANSMIT OR USE SUCH INFORMATION ABOUT YOU FOR THE ABOVE PURPOSES, YOU SHOULD NOT USE THE SERVICES; BY USING THE SERVICES, YOU EXPRESSLY AUTHORIZE US TO USE YOUR INFORMATION FOR THESE PURPOSES. Further, you've authorized us to investigate your credit history at any time and to share credit information about you with credit reporting agencies and our affiliates. If you ask, we'll tell you the name and address of any credit agency that gives us a credit report about you. It's illegal for unauthorized people to intercept your calls, but such interceptions can occur. For training or quality assurance, we may also monitor or record our calls with you.

Employee Discounts

You may be eligible for a discount on your monthly access fee based on an agreement between your employer and us or if you qualify under a government employee discount program. When you make changes to your account, we may require you to validate that you are still employed by your organization. You understand that by participating in an employee discount program we may release certain information relating to your service, including your name, your wireless telephone number and total monthly charge to your organization (does not apply to government employees). We may adjust your discount in accordance with your organization's agreement with us and remove your discount after your Customer Agreement expires or if you leave your employer. You agree that any change or removal of your discount, based on your employment status or your organization's agreement with us, shall not be considered to have a material adverse effect on you

Disclaimer of Warranties

&sect; WE MAKE NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, TO THE EXTENT PERMITTED BY APPLICABLE LAW, ANY IMPLIED WARRANTY OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE CONCERNING YOUR SERVICE OR YOUR WIRELESS PHONE. WE CAN'T PROMISE UNINTERRUPTED OR ERROR-FREE SERVICE AND DON'T AUTHORIZE ANYONE TO MAKE ANY WARRANTIES ON OUR BEHALF. THIS DOESN'T DEPRIVE YOU OF ANY WARRANTY RIGHTS YOU MAY HAVE AGAINST ANYONE ELSE.

Waivers and Limitations of Liability

&sect; UNLESS THE LAW FORBIDS IT IN ANY PARTICULAR CASE, WE EACH AGREE TO LIMIT CLAIMS FOR DAMAGES OR OTHER MONETARY RELIEF AGAINST EACH OTHER TO DIRECT DAMAGES. THIS LIMITATION AND WAIVER WILL APPLY REGARDLESS OF THE THEORY OF LIABILITY, WHETHER FRAUD, MISREPRESENTATION, BREACH OF CONTRACT, PERSONAL INJURY, PRODUCTS LIABILITY, OR ANY OTHER THEORY. THIS MEANS THAT NEITHER OF US WILL SEEK ANY INDIRECT, SPECIAL, CONSEQUENTIAL, TREBLE, OR PUNITIVE DAMAGES FROM THE OTHER. THIS LIMITATION AND WAIVER ALSO APPLIES TO ANY CLAIMS YOU MAY BRING AGAINST ONE OF OUR SUPPLIERS, TO THE EXTENT THAT WE WOULD BE REQUIRED TO INDEMNIFY THE SUPPLIER FOR SUCH CLAIM. You agree we aren't liable for problems caused by you or a third party; by buildings, hills, network congestion, tunnels, weather, or other things we don't control; or by any act of God. You also agree we aren't liable for missed Voice Mails, or deletions of Voice Mails from your Voice Mailbox (if you have one), even if you've saved them. If another wireless carrier is involved in any problem (for example, while you roam), you also agree to any limitations of liability in its favor that it imposes.

Dispute Resolution and Mandatory Arbitration
&sect; WE EACH AGREE TO SETTLE DISPUTES (EXCEPT CERTAIN SMALL CLAIMS) ONLY BY ARBITRATION. THERE'S NO JUDGE OR JURY IN ARBITRATION, AND REVIEW IS LIMITED, BUT AN ARBITRATOR CAN AWARD THE SAME DAMAGES AND RELIEF, AND MUST HONOR THE SAME LIMITATIONS IN THIS AGREEMENT, AS A COURT WOULD. IF AN APPLICABLE STATUTE PROVIDES FOR AN AWARD OF ATTORNEY'S FEES, AN ARBITRATOR CAN AWARD THEM TOO. WE ALSO EACH AGREE, TO THE FULLEST EXTENT PERMITTED BY LAW, THAT:

(1) THE FEDERAL ARBITRATION ACT APPLIES TO THIS AGREEMENT. EXCEPT FOR QUALIFYING SMALL CLAIMS COURT CASES, ANY CONTROVERSY OR CLAIM ARISING OUT OF OR RELATING TO THIS AGREEMENT, OR ANY PRIOR AGREEMENT FOR WIRELESS SERVICE WITH US OR ANY OF OUR AFFILIATES OR PREDECESSORS IN INTEREST, OR ANY PRODUCT OR SERVICE PROVIDED UNDER OR IN CONNECTION WITH THIS AGREEMENT OR SUCH A PRIOR AGREEMENT, OR ANY ADVERTISING FOR SUCH PRODUCTS OR SERVICES, WILL BE SETTLED BY ONE OR MORE NEUTRAL ARBITRATORS BEFORE THE AMERICAN ARBITRATION ASSOCIATION ("AAA") OR BETTER BUSINESS BUREAU ("BBB"). YOU CAN ALSO BRING ANY ISSUES YOU MAY HAVE TO THE ATTENTION OF FEDERAL, STATE, OR LOCAL GOVERNMENT AGENCIES AND THEY CAN, IF THE LAW ALLOWS, SEEK RELIEF AGAINST US ON YOUR BEHALF.

(2) FOR CLAIMS OVER $10,000, THE AAA'S WIRELESS INDUSTRY ARBITRATION ("WIA") RULES WILL APPLY. FOR CLAIMS OF $10,000 OR LESS, THE COMPLAINING PARTY CAN CHOOSE EITHER THE AAA'S SUPPLEMENTARY PROCEDURES FOR CONSUMER-RELATED DISPUTES, AN INDIVIDUAL ACTION IN SMALL CLAIMS COURT, OR THE BBB'S RULES FOR BINDING ARBITRATION. EACH OF US MAY BE REQUIRED TO EXCHANGE RELEVANT EVIDENCE IN ADVANCE. IN LARGE/COMPLEX CASES UNDER THE WIA RULES, THE ARBITRATORS MUST APPLY THE FEDERAL RULES OF EVIDENCE AND THE LOSER MAY HAVE THE AWARD REVIEWED BY A PANEL OF THREE NEW ARBITRATORS.

(3) YOU CAN OBTAIN PROCEDURES, RULES, AND FEE INFORMATION FROM THE AAA (WWW.ADR.ORG), THE BBB (WWW.BBB.ORG), OR FROM US. THIS AGREEMENT DOESN'T PERMIT CLASS ARBITRATIONS EVEN IF THOSE PROCEDURES OR RULES WOULD. IN EXCHANGE FOR YOUR AGREEMENT TO ARBITRATE ON AN INDIVIDUAL BASIS, WE'RE PROVIDING YOU A FREE INTERNAL MEDIATION PROGRAM. MEDIATION IS A PROCESS FOR MUTUALLY RESOLVING DISPUTES. A MEDIATOR CAN HELP PARTIES REACH AGREEMENT, BUT DOESN'T DECIDE THEIR ISSUES. IN OUR MEDIATION PROGRAM, WE'LL ASSIGN SOMEONE (WHO MAY BE FROM OUR COMPANY) NOT DIRECTLY INVOLVED IN THE DISPUTE TO MEDIATE. THAT PERSON WILL HAVE ALL THE RIGHTS AND PROTECTIONS OF A MEDIATOR. NOTHING SAID IN THE MEDIATION CAN BE USED IN A LATER ARBITRATION OR LAWSUIT. CONTACT US AT VERIZONWIRELESS.COM OR THROUGH CUSTOMER SERVICE TO FIND OUT MORE.

(4) IF YOU REQUEST MEDIATION UNDER OUR PROGRAM, PARTICIPATE IN GOOD FAITH IN AT LEAST ONE TELEPHONIC MEDIATION SESSION, AND THE MEDIATION DOESN'T RESOLVE THE DISPUTES BETWEEN US, WE'LL PAY ANY FILING FEE LATER CHARGED YOU BY THE AAA OR BBB FOR ONE ARBITRATION OF THOSE DISPUTES. IF THAT ARBITRATION PROCEEDS, WE'LL ALSO PAY ANY FURTHER ADMINISTRATIVE AND ARBITRATOR FEES LATER CHARGED FOR IT AND (IF THE ARBITRATION AWARD IS APPEALABLE UNDER THIS AGREEMENT) ANY APPEAL TO A NEW THREE ARBITRATOR PANEL. WE MAY MAKE YOU A WRITTEN OFFER OF SETTLEMENT ANY TIME BEFORE ARBITRATION BEGINS. IF WE DO AND YOU DON'T RECOVER IN ARBITRATION MORE THAN 75% OF THE OFFERED AMOUNT, YOU AGREE TO REPAY US THE LESSER OF ANY FEES WE ADVANCED OR WHAT YOU WOULD HAVE PAID IN FEES AND COSTS IN COURT UNDER SIMILAR CIRCUMSTANCES.

(5) ANY ARBITRATION AWARD MADE AFTER COMPLETION OF AN ARBITRATION IS FINAL AND BINDING AND MAY BE CONFIRMED IN ANY COURT OF COMPETENT JURISDICTION. AN AWARD AND ANY JUDGMENT CONFIRMING IT ONLY APPLIES TO THE ARBITRATION IN WHICH IT WAS AWARDED AND CAN'T BE USED IN ANY OTHER CASE EXCEPT TO ENFORCE THE AWARD ITSELF.

(6) IF FOR SOME REASON THE PROHIBITION ON CLASS ARBITRATIONS SET FORTH IN SUBSECTION (3) ABOVE IS DEEMED UNENFORCEABLE, THEN THE AGREEMENT TO ARBITRATE WILL NOT APPLY. FURTHER, IF FOR ANY REASON A CLAIM PROCEEDS IN COURT RATHER THAN THROUGH ARBITRATION, WE EACH WAIVE ANY TRIAL BY JURY.

About You

&sect; You represent that you're at least 18 years old and have the legal capacity to accept this agreement. If you're ordering for a company, you're representing that you're authorized to bind it, and where the context requires, "you" means the company.

About This Agreement

&sect; A waiver of any part of this agreement in one instance isn't a waiver of any part or any other instance. You can't assign this agreement or any of your rights or duties under it. We may assign all or part of this agreement or your debts to us without notice, and you agree to make all subsequent payments as instructed. NOTICES ARE CONSIDERED DELIVERED WHEN WE SEND THEM BY EMAIL OR FAX TO ANY EMAIL OR FAX NUMBER YOU'VE PROVIDED TO US, OR 3 DAYS AFTER MAILING TO THE MOST CURRENT BILLING ADDRESS WE HAVE ON FILE FOR YOU, IF BY US, OR TO THE CUSTOMER SERVICE ADDRESS ON YOUR MOST RECENT BILL, IF BY YOU. If any part of this agreement, including any part of its arbitration provisions, is held invalid, that part may be severed from this agreement. This agreement and the documents to which it refers form the entire agreement between us on their subjects. You can't rely on any other documents or statements on those subjects by any sales or service representatives, and you have no other rights with respect to service or this agreement, except as a specifically provided by law. This agreement isn't for the benefit of any third party except our parents, affiliates, subsidiaries, agents, and predecessors and successors in interest. Except to the extent we've agreed otherwise in the provisions on late fees, collection costs and arbitration, this agreement and disputes covered by it are governed by the laws of the state encompassing the area code assigned to your wireless phone number when you accepted this agreement, without regard to the conflicts of laws and rules of that state.

Last Updated: 05/15/07</textarea>
							<strong>I Agree to These Terms & Conditions.</strong> <input type="checkbox" name="accept_terms" id="accept_terms" value="Yes">
							<input type="hidden" name="task" value="addconfirm">
							<input type="hidden" name="sid" value="<? echo $SID; ?>">
							<ul><input type="image" src="images/<? echo $SubmitOrderButton; ?>">
							</form>
						</td>
						<td width="294" valign="top" class="bodyBlack">
							<table border="0" cellspacing="0" cellpadding="0" align="right" class="bodyBlack">
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
							<tr>
								<td height="16" align="right"><strong>Activation Fee ($<? echo sprintf('%.2f', $activation_fee); ?> per Line):</strong>&nbsp;</td>
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
							<table width="206" border="0" cellspacing="0" cellpadding="0" align="right" class="border<? echo $carrier_label; ?>">
							<tr bgcolor="<? echo $bar_color; ?>" class="bodyWhite">
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
										echo money_format('%-#4n', $act_fee).'&nbsp;&nbsp;&nbsp;&nbsp;';
									?>
								</td>
							</tr>	
							<tr class="bodyBlack">
								<td height="16" align="center">&nbsp;</td>
								<td align="center">
									TBD
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
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
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
	$att_pda4bb = false;
	$blackberry_plans = false;
	$smartphone_plans = false;
	$family_plans = false;
	for ($counter=1; $counter <= 5; $counter++){
		if ($cart["phone".$counter."_id"] != ""){
			if ($cart["phone".$counter."_type"] == "V") $voice_plans = true; // Voice
			if ($cart["phone".$counter."_type"] == "D") $data_plans = true; // Data
			if ($cart["phone".$counter."_type"] == "B"){ // BlackBerry (duh)
				$voice_plans = true;
				$blackberry_plans = true; 
			}
			if ($cart["phone".$counter."_type"] == "P"){ // PDA (AT&T)
				$voice_plans = true;
				$data_plans = true;
			}
			if ($cart["phone".$counter."_type"] == "S"){ // SmartPhone (AT&T)
				$voice_plans = true;
				$smartphone_plans = true;
			}
			if ($cart["phone".$counter."_type"] != "D") $qty_phones++; // Don't count aircards as phones
			$query = "SELECT * FROM phones WHERE product_id = '".$cart["phone".$counter."_id"]."'";
//echo $query.'<br></br>';
			$rs_pda4bb = mysql_query($query, $linkID); // Does this phone offer PDA Connect for BlackBerry Connect?
			$pda4bb = mysql_fetch_assoc($rs_pda4bb);
//echo $pda4bb["at&t_pda4bb"].'<br></br>';
			if ($pda4bb["at&t_pda4bb"] == "T") $att_pda4bb = true;  // ...it does.
		}
	}
	if ($qty_phones > 1) $family_plans = true;
	
//echo "Voice: ".$voice_plans."<br>";
//echo "Data: ".$data_plans."<br>";
//echo "BB: ".$blackberry_plans."<br>";
//echo "Family: ".$family_plans."<br>";

	//Grab plan names (groups)
	if ($family_plans){
		$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'Verizon' AND family_plan = 'T' AND plan_type = 'V' AND display = 'T' GROUP BY group_name ORDER BY group_position";
	}else{
		$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'Verizon' AND family_plan = 'F' AND plan_type = 'V' AND display = 'T' GROUP BY group_name ORDER BY group_position";
	}
//echo $query.'<br></br>';
	$rs_plan_names = mysql_query($query, $linkID);
//$plan_names = mysql_fetch_assoc($rs_plan_names);
//print_r($plan_names);
	?>

	<script>
	// Verify that a plan was selected
	function validatePlan(theForm){
		if (theForm.voice_plan_id){
			var planSelected = false;
			for (i = 0;  i < theForm.voice_plan_id.length;  i++){
				if (theForm.voice_plan_id[i].checked){
					planSelected = true;
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
				}
			}
			if (!planSelected){
				alert("Please select a Data Plan before continuing.");
				return false;
			}
		}

		if (theForm.smartphone_plan_id){
			var planSelected = false;
			for (i = 0;  i < theForm.smartphone_plan_id.length;  i++){
				if (theForm.smartphone_plan_id[i].checked){
					planSelected = true;
				}
			}
			if (!planSelected){
				alert("Please select a Smartphone Plan before continuing.");
				return false;
			}
		}

		if (theForm.bb_plan_id){
			var planSelected = false;
			for (i = 0;  i < theForm.bb_plan_id.length;  i++){
				if (theForm.bb_plan_id[i].checked){
					planSelected = true;
				}
			}
			if (!planSelected){
				alert("Please select a BlackBerry Plan before continuing.");
				return false;
			}
		}
		return true;
	}
	</script>

	<table width="930" border="0" cellspacing="0" cellpadding="0">
	<form action="saveit.php" method="get" name="PushPlan" id="PushPlan" onSubmit="return validatePlan(this);">
	<tr>
		<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Pick Your Plan<br><span class="<? echo $tab_class; ?>"><font size="-2">Step 1 of 5</font></span></strong></td>
		<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
	</tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td class="bigBlack">
					<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
					<ul>
						<table width="750" class="bodyBlack">
						<tr>
							<td colspan="2" class="xbigBlack"><strong>All Nationwide Plans Include:</strong></td>
						</tr>
						<tr>
							<td width="50%" valign="top">
								<strong class="bigBlack">National "IN" Calling Minutes</strong><br>
								Call any Verizon Wireless customers anytime without using your plan minutes
							</td>
							<td valign="top">
								<strong class="bigBlack">Night & Weekend Minutes</strong><br>
								Weekdays between 9:01 pm and 5:59 am.<br>
								Weekends from 12:00 am Saturday to 11:59 pm Sunday.
							</td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td valign="top">
								<strong class="bigBlack">No Domestic Roaming or Long Distance Charges</strong><br>
								Make or receive calls within the United States & Puerto Rico
							</td>
							<td valign="top">
								<strong class="bigBlack">Mobile Web</strong><br>
								Get automatic access to the mobile Internet at your fingertips with Mobile Web 2.0 at reasonable pay-as-you-go rates.
							</td>
						</tr>
						</table>
					</ul>
				</td>
				<td width="100" valign="top"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
			</tr>
			<tr>
				<td colspan="2" align="center" class="bigBlack"><strong>Select ONE Voice Plan from ONE of the following:</strong></td>
			</tr>
			</table>
		</td>
	</tr>
	<!-- Voice Plans -->
	<?
	if ($voice_plans || $blackberry_plans){
	?>
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
				<?
				for ($counter=1; $counter <= mysql_num_rows($rs_plan_names); $counter++){
					if ($counter > 1){
						echo'
					<div align="center"><strong class="xbigBlack">&ndash; OR &ndash;</strong></div><br>
						';
					}
					$groups = mysql_fetch_assoc($rs_plan_names);
					$group = $groups["group_name"];
					$query = "SELECT * FROM plan_features WHERE group_name = '".$group."'";
					$rs_features = mysql_query($query, $linkID);
					$query = "SELECT * FROM plans WHERE group_name = '".$group."' AND display = 'T'";
					$rs_plans = mysql_query($query, $linkID);
					$plan = mysql_fetch_assoc($rs_plans);
					mysql_data_seek($rs_plans,0);  // go back to the top
//print_r($plans);
					echo'
					<table width="900" border="" cellspacing="0" cellpadding="0" align="center" class="border'.$carrier_label.'">
					<tr bgcolor="'.$box_color.'">
						<td width="900" colspan="10" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plans</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF">
						<td colspan="10" class="bodyBlack" style="padding: 10px;">
					';
					for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
						$row = mysql_fetch_assoc($rs_features);
						echo $row["feature"];
					};
					echo'
						</td>
					</tr>
					';
					if ($plan["plan_type"] == "V"){ // Voice plans
						if (substr($plan["group_name"],0,11) == "AT&T Nation") $minute_type = "Rollover";
						if (substr($plan["group_name"],0,10) == "AT&T Unity") $minute_type = "Unity";
						if ($cingular_discount > 0){
							echo'
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td><img src="images/spacer.gif" alt="" width="50" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="95" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="200" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="124" height="0" border="0"></td>
<!--						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>-->
						<td><img src="images/spacer.gif" alt="" width="120" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="145" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="150" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Included Minutes</td>
						<td align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
						<td align="center">Mobile to Mobile Minutes</td>
<!--						<td align="center">'.$minute_type.' Minutes</td>-->
						<td align="center">Additional Minutes</td>
						<td align="center">Cost per Month</td>
						<td align="center">Your Cost per Month<br><span class="smallWhite">(With your '.round($cingular_discount).'% discount)</span></td>
					</tr>
							';
							for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
								$row = mysql_fetch_assoc($rs_plans);
								if (is_null($row["nights_qty"])){
									$nights_qty = "Unlimited";
								}else{
									$nights_qty = $row["nights_qty"].' Minutes';
								}
								echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="voice_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$nights_qty.'</td>
						<td align="center">Unlimited</td>
<!--						<td align="center">Unlimited</td>-->
						<td align="center">$'.money_format('%i', $row["add_min_cost"]).'/Min.</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($verizon_discount*.01)))).'</td>
					</tr>
								';
							};
						}else{ // No MRC discount
							echo'
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td><img src="images/spacer.gif" alt="" width="50" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="101" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="213" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="169" height="0" border="0"></td>
<!--						<td><img src="images/spacer.gif" alt="" width="140" height="0" border="0"></td>-->
						<td><img src="images/spacer.gif" alt="" width="173" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="170" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Included Minutes</td>
						<td align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
						<td align="center">Mobile to Mobile Minutes</td>
<!--						<td align="center">'.$minute_type.' Minutes</td>-->
						<td align="center">Additional Minutes</td>
						<td align="center">Cost per Month</td>
					</tr>
							';
							for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
								$row = mysql_fetch_assoc($rs_plans);
								if (is_null($row["nights_qty"])){
									$nights_qty = "Unlimited";
								}else{
									$nights_qty = $row["nights_qty"].' Minutes';
								}
								echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="voice_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$nights_qty.'</td>
						<td align="center">Unlimited</td>
<!--						<td align="center">Unlimited</td>-->
						<td align="center">$'.money_format('%i', $row["add_min_cost"]).'/Min.</td>
						<td align="center">$'.money_format('%i', $row["cost"]).'</td>
					</tr>
								';
							};
						};
					};
					echo'
					</table>
					<br>
					';
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
		<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td class="bodyBlack">
					<strong>Your cart contains an AT&amp;T BroadbandConnect Data Device. Please select one of the following Data Plans:</strong><br><br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
				<?
					$query = "SELECT * FROM plan_features WHERE group_id = '15'";
					$rs_features = mysql_query($query, $linkID);
					if ($att_pda4bb){
						$query = "SELECT * FROM plans WHERE group_id = '15' AND display = 'T' ORDER BY 'plan_id'";
					}else{
						$query = "SELECT * FROM plans WHERE group_id = '15' AND unique_id <> '157' AND display = 'T' ORDER BY 'plan_id'"; // Exclude PDA Connect for BB
					}
					$rs_plans = mysql_query($query, $linkID);
					$plan = mysql_fetch_assoc($rs_plans);
					mysql_data_seek($rs_plans,0);  // go back to the top
//print_r($plans);
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'">
						<td width="900" colspan="8" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plans</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF">
						<td colspan="10" class="bodyBlack" style="padding: 10px;">
					';
					for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
						$row = mysql_fetch_assoc($rs_features);
						echo $row["feature"];
					};
					echo'
						</td>
					</tr>
					';
					if ($cingular_discount > 0){
						echo'
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td><img src="images/spacer.gif" alt="" width="50" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="264" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="80" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="80" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="140" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Plan Name</td>
						<td align="center">Included<br>Data</td>
						<td align="center">Additional<br>Data</td>
						<td align="center">Canadian<br>Data</td>
						<td align="center">International<br>Data</td>
						<td align="center">Cost<br>per Month</td>
						<td align="center">Your Cost per Month<br><span class="smallWhite">(With your '.round($cingular_discount).'% discount)</span></td>
					</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["special_price"] == 'T'){
								$plan_name = $row["plan_name"].' <font size="-2" color="#FF0000"><strong><em>Special Offer!</em></strong></font>';
							}else{
								$plan_name = $row["plan_name"];
							}
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							if ($row["add_data_cost"] == 0){
								$add_data_cost = "N/A";
							}else{
								$add_data_cost = '$'.money_format('%.4i', $row["add_data_cost"]).'/KB';
							}
							echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="data_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$add_data_cost.'</td>
						<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
						<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($cingular_discount*.01)))).'</td>
					</tr>
							';
						};
					}else{ // No MRC discount
						echo'
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td><img src="images/spacer.gif" alt="" width="50" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="356" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Plan Name</td>
						<td align="center">Included<br>Data</td>
						<td align="center">Additional<br>Data</td>
						<td align="center">Canadian<br>Data</td>
						<td align="center">International<br>Data</td>
						<td align="center">Cost<br>per Month</td>
					</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["special_price"] == 'T'){
								$plan_name = $row["plan_name"].' <font size="-2" color="#FF0000"><strong><em>Special Offer!</em></strong></font>';
							}else{
								$plan_name = $row["plan_name"];
							}
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							if ($row["add_data_cost"] == 0){
								$add_data_cost = "N/A";
							}else{
								$add_data_cost = '$'.money_format('%.4i', $row["add_data_cost"]).'/KB';
							}
							echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="data_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$add_data_cost.'</td>
						<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
						<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
						<td align="center">$'.money_format('%i', $row["cost"]).'</td>
					</tr>
							';
						};
					};
					echo'
					</table>
					<br>
					';
				?>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
	};
	if ($smartphone_plans){
	?>
	<!-- SmartPhone Plans -->
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td class="bodyBlack">
					<strong>Your cart contains a SmartPhone Device. Please select one of the following SmartPhone Plans:</strong><br><br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
				<?
					$query = "SELECT * FROM plan_features WHERE group_id = '16'";
					$rs_features = mysql_query($query, $linkID);
					$query = "SELECT * FROM plans WHERE group_id = '16' AND display = 'T'";
					$rs_plans = mysql_query($query, $linkID);
					$plan = mysql_fetch_assoc($rs_plans);
					mysql_data_seek($rs_plans,0);  // go back to the top
//print_r($plans);
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'">
						<td width="900" colspan="8" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plans</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF">
						<td colspan="10" class="bodyBlack" style="padding: 10px;">
					';
					for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
						$row = mysql_fetch_assoc($rs_features);
						echo $row["feature"];
					};
					echo'
						</td>
					</tr>
					';
					if ($cingular_discount > 0){
						echo'
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td><img src="images/spacer.gif" alt="" width="50" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="264" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="80" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="80" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="140" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Plan Name</td>
						<td align="center">Included<br>Data</td>
						<td align="center">Additional<br>Data</td>
						<td align="center">Canadian<br>Data</td>
						<td align="center">International<br>Data</td>
						<td align="center">Cost<br>per Month</td>
						<td align="center">Your Cost per Month<br><span class="smallWhite">(With your '.round($cingular_discount).'% discount)</span></td>
					</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["special_price"] == 'T'){
								$plan_name = $row["plan_name"].' <font size="-2" color="#FF0000"><strong><em>Special Offer!</em></strong></font>';
							}else{
								$plan_name = $row["plan_name"];
							}
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							if ($row["add_data_cost"] == 0){
								$add_data_cost = "N/A";
							}else{
								$add_data_cost = '$'.money_format('%.4i', $row["add_data_cost"]).'/KB';
							}
							echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="smartphone_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$add_data_cost.'</td>
						<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
						<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($cingular_discount*.01)))).'</td>
					</tr>
							';
						};
					}else{ // No MRC discount
						echo'
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td><img src="images/spacer.gif" alt="" width="50" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="356" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Plan Name</td>
						<td align="center">Included<br>Data</td>
						<td align="center">Additional<br>Data</td>
						<td align="center">Canadian<br>Data</td>
						<td align="center">International<br>Data</td>
						<td align="center">Cost<br>per Month</td>
					</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["special_price"] == 'T'){
								$plan_name = $row["plan_name"].' <font size="-2" color="#FF0000"><strong><em>Special Offer!</em></strong></font>';
							}else{
								$plan_name = $row["plan_name"];
							}
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							if ($row["add_data_cost"] == 0){
								$add_data_cost = "N/A";
							}else{
								$add_data_cost = '$'.money_format('%.4i', $row["add_data_cost"]).'/KB';
							}
							echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="smartphone_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$add_data_cost.'</td>
						<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
						<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
						<td align="center">$'.money_format('%i', $row["cost"]).'</td>
					</tr>
							';
						};
					};
					echo'
					</table>
					<br>
					';
				?>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
	};
	if ($blackberry_plans){
	?>
	<!-- BlackBerry Plans -->
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td class="bodyBlack">
					<strong>Your cart contains a BlackBerry Device. Please select one of the following BlackBerry Plans:</strong><br><br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
				<?
					$query = "SELECT * FROM plan_features WHERE group_id = '17'";
					$rs_features = mysql_query($query, $linkID);
					$query = "SELECT * FROM plans WHERE group_id = '17' AND display = 'T'";
					$rs_plans = mysql_query($query, $linkID);
					$plan = mysql_fetch_assoc($rs_plans);
					mysql_data_seek($rs_plans,0);  // go back to the top
//print_r($plans);
					echo'
					<table width="900" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'">
						<td width="900" colspan="8" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plans</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF">
						<td colspan="10" class="bodyBlack" style="padding: 10px;">
					';
					for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
						$row = mysql_fetch_assoc($rs_features);
						echo $row["feature"];
					};
					echo'
						</td>
					</tr>
					';
					if ($cingular_discount > 0){
						echo'
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td><img src="images/spacer.gif" alt="" width="50" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="264" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="80" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="80" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="140" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Plan Name</td>
						<td align="center">Included<br>Data</td>
						<td align="center">Additional<br>Data</td>
						<td align="center">Canadian<br>Data</td>
						<td align="center">International<br>Data</td>
						<td align="center">Cost<br>per Month</td>
						<td align="center">Your Cost per Month<br><span class="smallWhite">(With your '.round($cingular_discount).'% discount)</span></td>
					</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["special_price"] == 'T'){
								$plan_name = $row["plan_name"].' <font size="-2" color="#FF0000"><strong><em>Special Offer!</em></strong></font>';
							}else{
								$plan_name = $row["plan_name"];
							}
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							if ($row["add_data_cost"] == 0){
								$add_data_cost = "N/A";
							}else{
								$add_data_cost = '$'.money_format('%.4i', $row["add_data_cost"]).'/KB';
							}
							echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="blackberry_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$add_data_cost.'</td>
						<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
						<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($cingular_discount*.01)))).'</td>
					</tr>
							';
						};
					}else{ // No MRC discount
						echo'
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td><img src="images/spacer.gif" alt="" width="50" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="356" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Plan Name</td>
						<td align="center">Included<br>Data</td>
						<td align="center">Additional<br>Data</td>
						<td align="center">Canadian<br>Data</td>
						<td align="center">International<br>Data</td>
						<td align="center">Cost<br>per Month</td>
					</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["special_price"] == 'T'){
								$plan_name = $row["plan_name"].' <font size="-2" color="#FF0000"><strong><em>Special Offer!</em></strong></font>';
							}else{
								$plan_name = $row["plan_name"];
							}
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							if ($row["add_data_cost"] == 0){
								$add_data_cost = "N/A";
							}else{
								$add_data_cost = '$'.money_format('%.4i', $row["add_data_cost"]).'/KB';
							}
							echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="blackberry_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$add_data_cost.'</td>
						<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
						<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
						<td align="center">$'.money_format('%i', $row["cost"]).'</td>
					</tr>
							';
						};
					};
					echo'
					</table>
					<br>
					';
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
		<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<input type="hidden" name="task" value="addplan">
			<input type="hidden" name="discount" value="<? echo $cingular_discount; ?>">
			<input type="hidden" name="sid" value="<? echo $SID; ?>">
<!--			<ul><input type="image" src="images/AddToOrderButton.gif" onClick="document.getElementById(this).submit();">-->
			<ul><input type="image" src="images/<? echo $AddToOrderButton; ?>">
		</td>
	</tr>
	</form>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;"><br><img src="images/GrayDot.gif" alt="" width="900" height="1" border="0"></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<br>
			<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td valign="top" class="bodyBlack">
					<ul>
						<li>Online purchase requires a two-year subscriber agreement.</li><br><br>
						<li>Rates exclude taxes & fees (including USF charge that varies quarterly, cost recovery fees, &amp; state/local fees that vary by area.</li><br><br>
						<li>Tolls, taxes, surcharges and other fees, such as E911 and gross receipt charges, vary by market and as of September 1, 2007, add between 4&#37; and 34&#37; to your monthly bill and are in addition to your monthly access fees and airtime charges.</li><br><br>
						<li>Monthly Federal Universal Service Charge on interstate &amp; international telecom charges (varies quarterly based on FCC rate) is 11&#37; per line.</li><br><br>
						<li>The Verizon Wireless monthly Regulatory Charge will increase from 4&cent; to 7&cent; per line effective 11/15/07.</li><br><br>
						<li>Monthly Administrative Charge (subject to change) is 70&cent; per line.</li><br><br>
						<li>The Federal Universal Service, Regulatory and Administrative Charges are Verizon Wireless charges, not taxes. For more details on these charges, call 1&ndash;888&ndash;684&ndash;1888.</li><br><br>
						<li>Stated prices and options are for online purchase only and are subject to change.</li><br><br>
						<li>Mail-in rebates are only applicable if plan requirements are met.</li>
					</ul>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="<? echo $bar_color; ?>" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
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
