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
$discount = $cingular_discount;
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
	$att_mobile_backup = false;
	$att_smart_limits = false;
	$att_mobile_tv_basic = false;
	$att_mobile_tv_plus = false;
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
			if ($phone["at&t_mobile_backup"] == "T") $att_mobile_backup = true;
			if ($phone["at&t_smart_limits"] == "T") $att_smart_limits = true;
			if ($phone["at&t_mobile_tv_basic"] == "T") $att_mobile_tv_basic = true;
			if ($phone["at&t_mobile_tv_plus"] == "T") $att_mobile_tv_plus = true;
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
						<td align="center">&nbsp;&nbsp;&nbsp;$16.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (16.99-(16.99*($discount*.01)))).'</td>', '<td align="center">$16.99</td>'); ?>
					<?
					}else{
					?>
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_early_nights" id="att_early_nights" value="8.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Early Nights &amp; Weekends (7:00pm to 7:00am)</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>8.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$8.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (8.99-(8.99*($discount*.01)))).'</td>', '<td align="center">$8.99</td>'); ?>
					<?
					}
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_voice_dial" id="att_voice_dial" value="4.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Voice Dial</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>4.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$4.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_enhanced_voicemail" id="att_enhanced_voicemail" value="1.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Enhanced Voice Mail</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>1.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$1.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (1.99-(1.99*($discount*.01)))).'</td>', '<td align="center">$1.99</td>'); ?>
					</tr>
					<?
					if ($att_xpress_mail){
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_xpress_mail" id="att_xpress_mail" value="4.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Xpress Mail (Corporate Email and Calendar Access)</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>4.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$4.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
					</tr>
					<?
					}
					?>
					</table>
					<?
//					if ($discountable == false){
//						$discountable = true;
						echo'
					<div align="right" class="smallBlack">&sup1;This Option Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></div>
						';
//					}else{
//						echo'
//					<br>
//						';
//					}
					?>
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
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Messaging Unlimited for Families</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>30.00</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$29.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (29.99-(29.99*($discount*.01)))).'</td>', '<td align="center">$29.99</td>'); ?>
					<?
					}else{
					?>
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="Messaging 200|5.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Messaging 200</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>5.00</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$5.00&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (5-(5*($discount*.01)))).'</td>', '<td align="center">$5.00</td>'); ?>
					</tr>
					<tr class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="Messaging 1500|15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Messaging 1500</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>15.00</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$15.00&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (15-(15*($discount*.01)))).'</td>', '<td align="center">$15.00</td>'); ?>
					</tr>
					<tr class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="Messaging Unlimited|20.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Messaging Unlimited</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>20.00</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$20.00&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (20-(20*($discount*.01)))).'</td>', '<td align="center">$20.00</td>'); ?>
					<?
					}
					?>
					</tr>
					<?
					if ($att_media_basic){
					?>
<!--
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Basic - 400 Messages & 1MB MEdia Net|9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Basic - 400 Messages & 1MB MEdia Net</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$9.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Basic w/Unlimited Mobile to Mobile Messaging|14.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Basic w/Unlimited Mobile to Mobile Messaging</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>14.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$14.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (14.99-(14.99*($discount*.01)))).'</td>', '<td align="center">$14.99</td>'); ?>
					</tr>
-->
					<?
					}
					if ($att_media_works){
					?>
<!--
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Works - 1500 Messages & 5 MB MEdia Net|14.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Works - 1500 Messages & 5 MB MEdia Net</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>14.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$14.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (14.99-(14.99*($discount*.01)))).'</td>', '<td align="center">$14.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Works w/Unlimited Mobile to Mobile Messaging|19.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Works w/Unlimited Mobile to Mobile Messaging</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>19.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$19.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (19.99-(19.99*($discount*.01)))).'</td>', '<td align="center">$19.99</td>'); ?>
					</tr>
-->
					<?
					}
//					if ($att_media_max){
					if ($att_media_basic || $att_media_works || $att_media_max){
					?>
<!--
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max 200 Bundle|19.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max 200 Bundle</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>19.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$19.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (19.99-(19.99*($discount*.01)))).'</td>', '<td align="center">$19.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max 200 Bundle w/Unlimited Mobile to Mobile Messaging|24.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max 200 Bundle w/Unlimited Mobile to Mobile Messaging</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>24.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$24.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (24.99-(24.99*($discount*.01)))).'</td>', '<td align="center">$24.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max 1500 Bundle|29.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max 1500 Bundle</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>29.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$29.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (29.99-(29.99*($discount*.01)))).'</td>', '<td align="center">$29.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max 1500 Bundle w/Unlimited Mobile to Mobile Messaging|34.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max 1500 Bundle w/Unlimited Mobile to Mobile Messaging</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>34.99</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (34.99-(34.99*($discount*.01)))).'</td>', '<td align="center">$34.99</td>'); ?>
					</tr>
-->
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Net Unlimited|15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Net Unlimited</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>15.00</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$15.00&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (15.00-(15.00*($discount*.01)))).'</td>', '<td align="center">$15.00</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value="MEdia Max Unlimited|35.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">MEdia Max Unlimited</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>35.00</strike></td>', ''); ?>
						<? echo iif($discount > 0, '<td align="center">$'.money_format('%i', (35.00-(35.00*($discount*.01)))).'</td>', '<td align="center">$35.00</td>'); ?>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_messaging" value=" |0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want an AT&amp;T Messaging Package</td>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', ''); ?>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', '<td>&nbsp;</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_intl_msg" id="att_intl_msg" value="9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Add International Long Distance Text Messaging Package</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$9.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					</tr>
					</table>
					<?
//					if ($discountable == false){
//						$discountable = true;
						echo'
					<div align="right" class="smallBlack">&sup1;This Option Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></div>
						';
//					}else{
//						echo'
//					<br>
//						';
//					}
					?>
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
						<td align="center">&nbsp;&nbsp;&nbsp;$4.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_video_share" value="Video Share Plus|9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Video Share Plus</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$9.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_video_share" value="Video Share Pay Per Use|0.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Video Share Pay Per Use (35&cent; per minute sent)</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>0.00</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$0.00&nbsp;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (0.00-(0.00*($discount*.01)))).'</td>', '<td align="center">$0.00</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_video_share" value=" |0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want an AT&amp;T Video Share Package</td>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', ''); ?>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', '<td>&nbsp;</td>'); ?>
					</tr>
					</table>
					<?
//					if ($discountable == false){
//						$discountable = true;
						echo'
					<div align="right" class="smallBlack">&sup1;This Option Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></div>
						';
//					}else{
//						echo'
//					<br>
//						';
//					}
					?>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<?
	}
	if ($att_mobile_tv_basic || $att_mobile_tv_plus){
	?>
	<!-- Mobile TV Services -->
	<tr>
		<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
			<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
			<tr>
				<td width="930" height="15">
					<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
					<tr bgcolor="<? echo $box_color; ?>">
						<td width="900" colspan="4" class="bodyWhite"><strong>&nbsp;Mobile TV Services</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td width="900" colspan="4">
							<br>
							<ul>
								<li>Add Mobile TV Services. &nbsp;Select from the following options.</li>
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
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_mobile_tv" value="Mobile TV Basic|15.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Mobile TV Basic</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>15.00</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$15.00&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (15.00-(15.00*($discount*.01)))).'</td>', '<td align="center">$15.00</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_mobile_tv" value="Mobile TV Plus|30.00"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Mobile TV Plus</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>30.00</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$30.00&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (30.00-(30.00*($discount*.01)))).'</td>', '<td align="center">$30.00</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_mobile_tv" value=" |0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want an AT&amp;T Mobile TV Package</td>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', ''); ?>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', '<td>&nbsp;</td>'); ?>
					</tr>
					</table>
					<?
//					if ($discountable == false){
//						$discountable = true;
						echo'
					<div align="right" class="smallBlack">&sup1;This Option Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></div>
						';
//					}else{
//						echo'
//					<br>
//						';
//					}
					?>
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
						<td align="center">&nbsp;&nbsp;&nbsp;$19.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (19.99-(19.99*($discount*.01)))).'</td>', '<td align="center">$19.99</td>'); ?>
					<?
					}else{
					?>
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_push_talk" id="att_push_talk" value="9.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Push to Talk Unlimited</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$9.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					<?
					}
					?>
					</tr>
					</table>
					<?
//					if ($discountable == false){
//						$discountable = true;
						echo'
					<div align="right" class="smallBlack">&sup1;This Option Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></div>
						';
//					}else{
//						echo'
//					<br>
//						';
//					}
					?>
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
<!--
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_telenav" value="TeleNav GPS Navigator 10 Routes|5.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">TeleNav GPS Navigator 10 Routes</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>5.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$5.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (5.99-(5.99*($discount*.01)))).'</td>', '<td align="center">$5.99</td>'); ?>
					</tr>
-->
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_telenav" value="AT&T Navigator|9.99"></td>
<!--						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">TeleNav GPS Navigator Unlimited Routes</td>-->
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">AT&T Navigator</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>9.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$9.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (9.99-(9.99*($discount*.01)))).'</td>', '<td align="center">$9.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="radio" name="att_telenav" value=" |0.00" checked></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">I do not want an AT&amp;T Navigator Package</td>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', ''); ?>
						<? echo iif($discount > 0, '<td>&nbsp;</td>', '<td>&nbsp;</td>'); ?>
					</tr>
					</table>
					<?
//					if ($discountable == false){
//						$discountable = true;
						echo'
					<div align="right" class="smallBlack">&sup1;This Option Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></div>
						';
//					}else{
//						echo'
//					<br>
//						';
//					}
					?>
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
					<?
					if ($att_mobile_backup){
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_mobile_backup" id="att_mobile_backup" value="1.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">AT&amp;T Mobile Backup</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>1.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$1.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (1.99-(1.99*($discount*.01)))).'</td>', '<td align="center">$1.99</td>'); ?>
					</tr>
					<?
					}
					if ($att_smart_limits){
					?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_smart_limits" id="att_smart_limits" value="4.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Smart Limits for Wireless Parental Controls</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>4.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$4.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
					</tr>
					<?
					}
					?>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_detailed_billing" id="att_detailed_billing" value="1.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Detailed Billing</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>1.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$1.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (1.99-(1.99*($discount*.01)))).'</td>', '<td align="center">$1.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_roadside_assist" id="att_roadside_assist" value="2.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Roadside Assistance</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>2.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$2.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (2.99-(2.99*($discount*.01)))).'</td>', '<td align="center">$2.99</td>'); ?>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="checkbox" name="att_phone_insurance" id="att_phone_insurance" value="4.99"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Wireless Phone Insurance</td>
						<? echo iif($discount > 0, '<td align="center">$<strike>4.99</strike></td>', ''); ?>
						<td align="center">&nbsp;&nbsp;&nbsp;$4.99&sup1;&nbsp;</td>
						<?// echo iif($discount > 0, '<td align="center">$'.money_format('%i', (4.99-(4.99*($discount*.01)))).'</td>', '<td align="center">$4.99</td>'); ?>
					</tr>
					</table>
					<?
//					if ($discountable == false){
//						$discountable = true;
						echo'
					<div align="right" class="smallBlack">&sup1;This Option Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br></div>
						';
//					}else{
//						echo'
//					<br>
//						';
//					}
					?>
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
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="text" name="universal_earbuds" id="universal_earbuds" value="0" size="1" maxlength="3" style="text-align:right;"></td>
						<td><img src="images/spacer.gif" alt="" width="40" height="1" border="0">Universal Earbud</a></td>
						<td align="center"><input type="hidden" name="universal_earbuds_price" id="universal_earbuds_price" value="19.99">$19.99</td>
					</tr>
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td height="25" align="center" bgcolor="<? echo $form_bg; ?>"><input type="text" name="vehicle_adapters" id="vehicle_adapters" value="0" size="1" maxlength="3" style="text-align:right;"></td>
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
										<td colspan="3"><input type="text" name="phone<? echo $counter; ?>_username" id="phone<? echo $counter; ?>_username" size="25" maxlength="50" tabindex="<? echo ($counter*20)+1; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
									</tr>
									<tr>
										<td align="right">User's City:</td>
										<td colspan="3"><input type="text" name="phone<? echo $counter; ?>_usercity" id="phone<? echo $counter; ?>_usercity" size="25" maxlength="50" tabindex="<? echo ($counter*20)+2; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
									</tr>
									<tr>
										<td align="right">User's State:</td>
										<td>
											<select name="phone<? echo $counter; ?>_userstate" id="phone<? echo $counter; ?>_userstate" tabindex="<? echo ($counter*20)+3; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;">
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
										<td><input type="text" name="phone<? echo $counter; ?>_userzip" id="phone<? echo $counter; ?>_userzip" size="5" maxlength="10" tabindex="<? echo ($counter*20)+4; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
									</tr>
									<tr>
										<td colspan="3" align="right">Local/Desired Area Code:</td>
										<td ><input type="text" name="phone<? echo $counter; ?>_areacode" id="phone<? echo $counter; ?>_areacode" size="5" maxlength="10" tabindex="<? echo ($counter*20)+5; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
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
								<td><input type="text" name="phone<? echo $counter; ?>_port_number" id="phone<? echo $counter; ?>_port_number" size="15" maxlength="15" tabindex="<? echo ($counter*20)+6; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td align="right">Acct #:</td>
								<td><input type="text" name="phone<? echo $counter; ?>_port_acctnum" id="phone<? echo $counter; ?>_port_acctnum" size="10" maxlength="50" tabindex="<? echo ($counter*20)+8; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
							</tr>
							<tr>
								<td align="right">Carrier Transferring From:</td>
								<td>
									<select  name="phone<? echo $counter; ?>_port_from" id="phone<? echo $counter; ?>_port_from" tabindex="<? echo ($counter*20)+7; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>; width: 106;">
										<option value="">Select</option>
						                <option value="Sprint">Sprint</option>
						                <option value="Nextel">Nextel</option>
<!--						                <option value="Cingular">Cingular</option>
										<option value="AT&T">AT&T</option>-->
										<option value="Verizon">Verizon</option>-->
										<option value="T-Mobile">T-Mobile</option>
						                <option value="Helio">Helio</option>
										<option value="Alltel">Alltel</option>
										<option value="US Cellular">US Cellular</option>
									</select>
<!--								<input type="text" name="phone<? echo $counter; ?>_port_from" id="phone<? echo $counter; ?>_port_from" size="15" maxlength="50" tabindex="<? echo ($counter*20)+7; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value="">-->
								</td>
								<td align="right">Password:</td>
								<td><input type="text" name="phone<? echo $counter; ?>_port_password" id="phone<? echo $counter; ?>_port_password" size="10" maxlength="50" tabindex="<? echo ($counter*20)+9; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
							</tr>
							<tr>
								<td align="right">Name Exactly As On Bill:</td>
								<td colspan="3" align="right"><input type="text" name="phone<? echo $counter; ?>_port_billname" id="phone<? echo $counter; ?>_port_billname" size="26" maxlength="50" tabindex="<? echo ($counter*20)+10; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;width: 290;" value=""><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
							</tr>
							<tr>
								<td align="right">Billing Address:</td>
								<td colspan="3">
									<input type="text" name="phone<? echo $counter; ?>_port_billaddr1" id="phone<? echo $counter; ?>_port_billaddr1" size="20" maxlength="50" tabindex="<? echo ($counter*20)+11; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value="">
									<img src="images/spacer.gif" alt="" width="3" height="1" border="0">
									<input type="text" name="phone<? echo $counter; ?>_port_billaddr2" id="phone<? echo $counter; ?>_port_billaddr2" size="20" maxlength="50" tabindex="<? echo ($counter*20)+12; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;width: 137;" value="">
								</td>
							</tr>
							<tr>
								<td align="right">Billing City/State/Zipcode:</td>
								<td colspan="3">
									<input type="text" name="phone<? echo $counter; ?>_port_billcity" id="phone<? echo $counter; ?>_port_billcity" size="20" maxlength="50" tabindex="<? echo ($counter*20)+13; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value="">
									<img src="images/spacer.gif" alt="" width="3" height="1" border="0">
									<select name="phone<? echo $counter; ?>_port_billstate" id="phone<? echo $counter; ?>_port_billstate" tabindex="<? echo ($counter*20)+14; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;">
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
									<input type="text" name="phone<? echo $counter; ?>_port_billzip" id="phone<? echo $counter; ?>_port_billzip" size="6" maxlength="10" tabindex="<? echo ($counter*20)+15; ?>" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;width: 57;" value="">
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
								<td><input type="text" name="first_name" id="first_name" size="30" maxlength="30" tabindex="1" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">First</td>
								<td><input type="text" name="middle_name" id="middle_name" size="5" maxlength="5" tabindex="2" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">MI</span></td>
								<td><input type="text" name="last_name" id="last_name" size="30" maxlength="30" tabindex="3" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Last</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Shipping Address:<br><span class="smallBlack">Make sure this matches<br>your credit card statement.<br><strong>Cannot be a P.O. Box.</strong></span></td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="ship_address_1" id="ship_address_1" size="30" maxlength="50" tabindex="4" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td colspan="2"><input type="text" name="ship_address_2" id="ship_address_2" size="30" maxlength="50" tabindex="5" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
							</tr>
							<tr>
								<td><input type="text" name="ship_city" id="ship_city" size="30" maxlength="50" tabindex="6" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">City</td>
								<td>
									<select name="ship_state" id="ship_state" tabindex="7" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;">
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
								<td><input type="text" name="ship_zipcode" id="ship_zipcode" size="10" maxlength="10" tabindex="8" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Zip Code</span></td>
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
								<td><input type="text" name="bill_address_1" id="bill_address_1" size="30" maxlength="50" tabindex="9" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td colspan="2"><input type="text" name="bill_address_2" id="bill_address_2" size="30" maxlength="50" tabindex="10" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
							</tr>
							<tr>
								<td><input type="text" name="bill_city" id="bill_city" size="30" maxlength="50" tabindex="11" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">City</td>
								<td>
									<select name="bill_state" id="bill_state" tabindex="12" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;">
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
								<td><input type="text" name="bill_zipcode" id="bill_zipcode" size="10" maxlength="10" tabindex="13" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Zip Code</span></td>
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
								<td><input type="text" name="home_phone" id="home_phone" size="18" maxlength="13" tabindex="14" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Home</span></td>
								<td><input type="text" name="alt_phone" id="alt_phone" size="18" maxlength="13" tabindex="15" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><br><span class="smallBlack">Alternate</span></td>
								<td><input type="text" name="carrier_phone" id="carrier_phone" size="18" maxlength="13" tabindex="16" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><span class="smallBlack"> (If you have a current account)<br>Cingular/AT&T Wireless</span></td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Email Address:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="email" id="email" size="30" maxlength="50" tabindex="17" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td class="xbigBlack">&nbsp;&nbsp;Confirm:<img src="images/spacer.gif" alt="" width="15" height="1" border="0"><input type="text" name="email_confirm" id="email_confirm" size="30" maxlength="50" tabindex="18" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
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
								<td><input type="text" name="ssn" id="ssn" size="20" maxlength="11" tabindex="19" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><span class="smallBlack"> <a onClick="whyssn.style.visibility='visible';" class="smallBlack" style="text-decoration:underline; cursor:pointer;">Why do you need my SSN</a>?<br>Format: 555-55-5555</span></td>
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
								<td><input type="text" name="dob" id="dob" size="30" maxlength="10" tabindex="20" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""><span class="smallBlack"> <a onClick="whydob.style.visibility='visible';" class="smallBlack" style="text-decoration:underline; cursor:pointer;">Why do you need my date of birth</a>?<br>Format: mm/dd/yyyy</span></td>
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
								<td><input type="text" name="dl_num" id="dl_num" size="30" maxlength="50" tabindex="21" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""></td>
								<td class="xbigBlack">&nbsp;&nbsp;State:<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									<select name="dl_state" id="dl_state" tabindex="22" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;">
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
									<select name="dl_exp_month" id="dl_exp_month" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width:125px;" tabindex="23">
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
									<select name="dl_exp_day" id="dl_exp_day" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width:65px;" tabindex="24">
										<option value="">Day</option>
<?
for ($option=1; $option <= 31; $option++){
	echo'
										<option value="'.iif($option<10,"0","").$option.'">'.$option.'</option>
	';
}
?>
									</select>
									<select name="dl_exp_year" id="dl_exp_year" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width: 67px;" tabindex="25">
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
									<select name="cc_type" id="cc_type" class="bodyBlack" style="background-color: <? echo $form_bg; ?>; width: 195px;" tabindex="26">
										<option value="">Select Type of Card</option>
										<option value="Visa">Visa</option>
										<option value="MasterCard">MasterCard</option>
										<option value="American Express">American Express</option>
										<option value="Discover">Discover</option>
									</select>
								</td>
								<td class="xbigBlack">&nbsp;&nbsp;Expiration:<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
									<select name="exp_month" id="exp_month" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width:125px;" tabindex="27">
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
									<select name="exp_year" id="exp_year" class="bodyBlack" style="background-color:<? echo $form_bg; ?>; width: 67px;" tabindex="28">
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
								<td><input type="text" name="cc_num" id="cc_num" size="30" maxlength="25" tabindex="29" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value="" onkeypress="return onlyNumbers(event)"><br><span class="smallBlack">Numbers Only</span></td>
								</td>
								<td valign="top" class="xbigBlack">&nbsp;&nbsp;Credit Card CID:<img src="images/spacer.gif" alt="" width="10" height="1" border="0"><input type="text" name="cc_cid" id="cc_cid" size="5" maxlength="5" tabindex="30" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value="" onkeypress="return onlyNumbers(event)"><span class="smallBlack"> <a href="javascript:newwin=window.open('http://www.<? echo $domain; ?>/cid_<? echo $carrier_label; ?>.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="smallBlack" style="text-decoration:underline;">What is this</a>?</span>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="250" align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Name On Credit Card:</td>
						<td>
							<table border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
							<tr>
								<td><input type="text" name="cc_name" id="cc_name" size="30" maxlength="50" tabindex="31" class="bodyBlack" style="background-color: <? echo $form_bg; ?>;" value=""> <span class="smallBlack">(Exactly as it appears on the card.)</span></td>
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
					// Yahoo AT&T Gift Cards
//	 				if ($cingular_site == "T" && $site == "yahoo"){
					if ($gift_card > 0){
						$price -= $gift_card;
					}
					$today = ($row['phone'.$counter.'_msrp']-($row['phone'.$counter.'_ir1']+$row['phone'.$counter.'_ir2']));
					$today_subtotal += $today;
					$tomorrow = ($today-($row['phone'.$counter.'_mir1']+$row['phone'.$counter.'_mir2']));
					// Yahoo AT&T Gift Cards
//	 				if ($cingular_site == "T" && $site == "yahoo"){
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
					';
					if ($row["phone".$counter."_ir1"] != 0 || $row["phone".$counter."_ir2"] != 0){
						echo'
							<tr class="bodyBlack">
								<td align="right">-'.money_format("%-#4n", $row["phone".$counter."_ir1"]+$row["phone".$counter."_ir2"]).'</td>
								<td>&nbsp;instant savings</td>
						';
					}
					// If there are any mail-in rebates....
					if ($row["phone".$counter."_mir1"] != 0 || $row["phone".$counter."_mir2"] != 0){
					echo'
							</tr>
							<tr class="bodyBlack">
								<td align="right">-'.money_format("%-#4n", $row["phone".$counter."_mir1"]+$row["phone".$counter."_mir2"]).'</td>
								<td>&nbsp;mail-in rebate'.iif($row["phone".$counter."_mir1"] != 0 && $row["phone".$counter."_mir2"] != 0, "s", "").'</td>
							</tr>
					';
					}
//					if ($cingular_site == "T" && $site == "yahoo"){
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
							<br><br><br>
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
							<br><br><br>
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
							<br><br><br>
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
					$plan_full_cost = 0;
					$plan_cost = 0;
					$discountable_disclaimer = false;
					if ($row["plan_id"] != ''){
						$plans++;
						$plan_full_cost += $row["plan_cost"];
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
						';
						$query = "SELECT * FROM plans WHERE plan_id = '".$row["plan_id"]."'";
						$rs_plans = mysql_query($query, $linkID);
						$plan = mysql_fetch_assoc($rs_plans);
						$discountable = true;
						if ($plan["discountable"] == 'F'){
							$discountable = false;
							$discountable_disclaimer = true;
						}
						if ($discountable == false){
							echo'
							<td align="right">'.money_format('%-#4n', $row["plan_cost"]).'&sup1;<img src="images/spacer.gif" alt="" width="9" height="1" border="0"></td>
							';
							$plan_cost += $row["plan_cost"];
						}else{
//							echo'
//							<td align="right">'.money_format('%-#4n', ($row["plan_cost"]-($row["plan_cost"]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
//							';
//							$plan_cost += $row["plan_cost"]-($row["plan_cost"]*($discount*.01));
							if ($phones_ordered > 1){
								echo'
							<td align="right">'.money_format('%-#4n', ($row["plan_cost"]-(($row["plan_cost"]-9.99)*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
								';
								$plan_cost += $row["plan_cost"]-(($row["plan_cost"]-9.99)*($discount*.01));
							}else{
								echo'
							<td align="right">'.money_format('%-#4n', ($row["plan_cost"]-($row["plan_cost"]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
								';
								$plan_cost += $row["plan_cost"]-($row["plan_cost"]*($discount*.01));
							}
						}
						echo'
					</tr>
						';
					}
					if ($row["bb_plan_id"] != ''){
						$plans++;
						$plan_full_cost += $row["bb_plan_cost"];
						echo'
					<tr class="bodyBlack">
						<td>&nbsp;BlackBerry Data Plan</td>
						<td align="center">'.$row["bb_plan_usage"].'</td>
						<td align="right"><strike>'.money_format('%-#4n', ($row["bb_plan_cost"])).'</strike>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						';
						$query = "SELECT * FROM plans WHERE plan_id = '".$row["bb_plan_id"]."'";
						$rs_plans = mysql_query($query, $linkID);
						$plan = mysql_fetch_assoc($rs_plans);
						$discountable = true;
						if ($plan["discountable"] == 'F'){
							$discountable = false;
							$discountable_disclaimer = true;
						}
						if ($discountable == false){
							echo'
							<td align="right">'.money_format('%-#4n', $row["bb_plan_cost"]).'&sup1;<img src="images/spacer.gif" alt="" width="9" height="1" border="0"></td>
							';
							$plan_cost += $row["bb_plan_cost"];
						}else{
							echo'
						<td align="right">'.money_format('%-#4n', ($row["bb_plan_cost"]-($row["bb_plan_cost"]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
							';
							$plan_cost += $row["bb_plan_cost"]-($row["bb_plan_cost"]*($discount*.01));
						}
						echo'
					</tr>
						';
					}
					if ($row["data_plan_id"] != ''){
						$plans++;
						$plan_full_cost += $row["data_plan_cost"];
						echo'
					<tr class="bodyBlack">
						<td>&nbsp;Data Plan</td>
						<td align="center">'.$row["data_plan_usage"].'</td>
						<td align="right"><strike>'.money_format('%-#4n', ($row["data_plan_cost"])).'</strike>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						';
						$query = "SELECT * FROM plans WHERE plan_id = '".$row["data_plan_id"]."'";
						$rs_plans = mysql_query($query, $linkID);
						$plan = mysql_fetch_assoc($rs_plans);
						$discountable = true;
						if ($plan["discountable"] == 'F'){
							$discountable = false;
							$discountable_disclaimer = true;
						}
						if ($discountable == false){
							echo'
							<td align="right">'.money_format('%-#4n', $row["data_plan_cost"]).'&sup1;<img src="images/spacer.gif" alt="" width="9" height="1" border="0"></td>
							';
							$plan_cost += $row["data_plan_cost"];
						}else{
							echo'
						<td align="right">'.money_format('%-#4n', ($row["data_plan_cost"]-($row["data_plan_cost"]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
							';
							$plan_cost += $row["data_plan_cost"]-($row["data_plan_cost"]*($discount*.01));
						}
						echo'
					</tr>
						';
					}
					?>
					<tr>
						<td colspan="2" align="right" bgcolor="<? echo $box_color; ?>" class="bodyWhite"><strong>Monthy Plan<? echo iif($plans > 1, 's', ''); ?> Total:&nbsp;</strong></td>
						<td align="right" class="bodyBlack"><strong><strike><? echo money_format('%-#4n', $plan_full_cost); ?></strike></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="right" class="bodyBlack"><strong><? echo money_format('%-#4n', $plan_cost); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					</table>
					<?
					if ($discountable_disclaimer == true){
						echo'
					<div align="right" class="smallBlack">&sup1;This Plan Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						';
					}
					$count = 0;
//					if ($row["carrier"] == 'Sprint'){
//						$options = array(
//							sprint_power_vision,
//							sprint_pcs_vision,
//							sprint_blackberry_data,
//							sms,
//							nights
//						);
//						for ($counter=0; $counter <= count($options)-1; $counter++){
//							if ($row[$options[$counter]] != '' && $row[$options[$counter]] != 'None'){
//								$count++;
//							}
//						}
//						$options = array(
//							array('m2m', 'Unlimited Mobile to Mobile Calling'),
//							array('protection', 'Sprint Total Equipment Protection'),
//							array('aircard_protection', 'Aircard Total Equipment Protection'),
//							array('rescue', 'Roadside Rescue'),
//							array('voice_command', 'Sprint PCS Voice Command')
//						);
//						for ($counter=0; $counter <= count($options)-1; $counter++){
//							if ($row[$options[$counter][0]] != 0){
//								$count++;
//							}
//						}
//					}
//					if ($row["carrier"] == 'Nextel'){
						$options = array(
							array('att_early_nights', 'Early Nights & Weekends'),
							array('att_family_early_nights', 'Early Nights & Weekends for Families'),
							array('att_voice_dial', 'Voice Dialing'),
							array('att_enhanced_voicemail', 'Enhanced Voicemail'),
							array('att_xpress_mail', 'XPress Mail'),
							array('att_messaging_price', $row["att_messaging"]),
							array('att_intl_msg', 'International Messaging'),
							array('att_video_share_price', $row["att_video_share"]),
							array('att_push_talk', 'Push to Talk'),
							array('att_family_push_talk', 'Push to Talk for Families'),
							array('att_telenav_price', $row["att_telenav"]),
							array('att_roadside_assist', 'Roadside Assistance'),
							array('att_phone_insurance', 'Phone Insurance'),
							array('att_mobile_backup', 'Mobile Backup'),
							array('att_smart_limits', 'Smart Limits for Wireless Parental Controls'),
							array('att_detailed_billing', 'Detailed Billing'),
							array('att_mobile_tv_price', $row["att_mobile_tv"])
						);
						for ($counter=0; $counter <= count($options)-1; $counter++){
							if ($row[$options[$counter][0]] != 0 || $row[$options[$counter][0]] == "Free"){
								$count++;
							}
						}
//					}
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
//						if ($row["carrier"] == 'Sprint'){
//							$options = array(
//								sprint_power_vision,
//								sprint_pcs_vision,
//								sprint_blackberry_data,
//								sms,
//								nights
//							);
//							for ($counter=0; $counter <= count($options)-1; $counter++){
//								if ($row[$options[$counter]] != '' && $row[$options[$counter]] != 'None'){
//									$count++;
//									$field = $options[$counter]."_price";
//									$opt_cost += $row[$field];
//									echo'
//										<tr class="bodyBlack">
//											<td>&nbsp;'.$row[$options[$counter]].'</td>
//											<td align="right"><strike>'.money_format('%-#4n', ($row[$field])).'</strike>&nbsp;&nbsp;&nbsp;&nbsp;</td>
//											<td align="right">'.money_format('%-#4n', ($row[$field]-($row[$field]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
//										</tr>
//									';
//								}
//							}
//							$options = array(
//								array('m2m', 'Unlimited Mobile to Mobile Calling'),
//								array('protection', 'Sprint Total Equipment Protection'),
//								array('aircard_protection', 'Aircard Total Equipment Protection'),
//								array('rescue', 'Roadside Rescue'),
//								array('voice_command', 'Sprint PCS Voice Command')
//							);
//							for ($counter=0; $counter <= count($options)-1; $counter++){
//								if ($row[$options[$counter][0]] != 0){
//									$count++;
//									$opt_cost += $row[$options[$counter][0]];
//									echo'
//										<tr class="bodyBlack">
//											<td>&nbsp;'.$options[$counter][1].'</td>
//											<td align="right"><strike>'.money_format('%-#4n', ($row[$options[$counter][0]])).'</strike>&nbsp;&nbsp;&nbsp;&nbsp;</td>
//											<td align="right">'.money_format('%-#4n', //($row[$options[$counter][0]]-($row[$options[$counter][0]]*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;</td>
//										</tr>
//									';
//								}
//							}
//						}
//						if ($row["carrier"] == 'Nextel'){
						$options = array(
							array('att_early_nights', 'Early Nights & Weekends'),
							array('att_family_early_nights', 'Early Nights & Weekends for Families'),
							array('att_voice_dial', 'Voice Dialing'),
							array('att_enhanced_voicemail', 'Enhanced Voicemail'),
							array('att_xpress_mail', 'XPress Mail'),
							array('att_messaging_price', $row["att_messaging"]),
							array('att_intl_msg', 'International Messaging'),
							array('att_video_share_price', $row["att_video_share"]),
							array('att_push_talk', 'Push to Talk'),
							array('att_family_push_talk', 'Push to Talk for Families'),
							array('att_telenav_price', $row["att_telenav"]),
							array('att_roadside_assist', 'Roadside Assistance'),
							array('att_phone_insurance', 'Phone Insurance'),
							array('att_mobile_backup', 'Mobile Backup'),
							array('att_smart_limits', 'Smart Limits for Wireless Parental Controls'),
							array('att_detailed_billing', 'Detailed Billing'),
							array('att_mobile_tv_price', $row["att_mobile_tv"])
							);
							$discountable = true;
							for ($counter=0; $counter <= count($options)-1; $counter++){
	//echo $options[$counter][1];
								if ($row[$options[$counter][0]] != 0 || $row[$options[$counter][0]] == "Free"){
									$count++;
									echo'
										<tr class="bodyBlack">
											<td>&nbsp;'.$options[$counter][1].'</td>
											<td align="right">'.iif($row[$options[$counter][0]] != "Free", '<strike>'.money_format('%-#4n', ($row[$options[$counter][0]]*1)).'</strike>', "Free").'&nbsp;&nbsp;&nbsp;&nbsp;</td>
									';
									if ($options[$counter][1] == "MEdia Max Unlimited"){
										if ($row[$options[$counter][0]] != "Free"){
											$opt_cost += $row[$options[$counter][0]]*($discount*.01);
										}
										echo'
											<td align="right">'.iif($row[$options[$counter][0]] != "Free", money_format('%-#4n', ($row[$options[$counter][0]]-($row[$options[$counter][0]]*($discount*.01))))."&nbsp;", "Free&nbsp;").'&nbsp;&nbsp;&nbsp;</td>
										</tr>
										';
									}else{
										if ($row[$options[$counter][0]] != "Free"){
											$opt_cost += $row[$options[$counter][0]];
										}
										$discountable = false;
										echo'
											<td align="right">'.iif($row[$options[$counter][0]] != "Free", money_format('%-#4n', $row[$options[$counter][0]]).'&sup1;<img src="images/spacer.gif" alt="" width="9" height="1" border="0">', "Free&nbsp;&nbsp;").'</td>
										';
									}
								}
							}
//						}
						?>
						<tr>
							<td align="right" bgcolor="<? echo $bar_color; ?>" class="bodyWhite"><strong>Monthy Option<? echo iif($count > 1, 's', ''); ?> Total:&nbsp;</strong></td>
							<td align="right" class="bodyBlack"><strong><strike><? echo money_format('%-#4n', $opt_cost); ?></strike></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
<!--							<td align="right" class="bodyBlack"><strong><? echo money_format('%-#4n', ($opt_cost-($opt_cost*($discount*.01)))); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
							<td align="right" class="bodyBlack"><strong><? echo money_format('%-#4n', $opt_cost); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						</tr>
						</table>
					<?
					}
					if ($discountable == false){
						echo'
						<div align="right" class="smallBlack">&sup1;This Service Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						';
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
By checking &quot;I Agree to These Terms & Conditions&quot;, you will be bound to the following for the two-year term of the agreement:

1) The Terms of Service, including the binding arbitration clause
2) The &quot;Plan Terms&quot; and other information regarding your Rate Plan contained on the
Rate Plan page
3) The terms and conditions and other information regarding features provided on the page where
you selected your features.

Printed materials containing much of this information will also be provided to you.

If you terminate this Agreement after the 30 day cancellation period, but before the expiration of your Service Commitment, you will pay AT&amp;T an Early Termination Fee of $175 for each wireless telephone number associated with this service. Go to wireless.att.com/cell-phone-service/legal/return-policy.jsp for information about the 30 day cancellation policy.

TERMS OF SERVICE:
&quot;AT&amp;T&quot; or &quot;we,&quot; &quot;us&quot; or &quot;our&quot; refers to AT&amp;T Mobility LLC acting on behalf of its FCC-licensed affiliates doing business as AT&amp;T. &quot;You&quot; or &quot;your&quot; refers to the person or entity that is the customer of record. PLEASE READ THIS AGREEMENT CAREFULLY TO ENSURE THAT YOU UNDERSTAND EACH PROVISION. This Agreement requires the use of arbitration to resolve disputes and also limits the remedies available to you in the event of a dispute.

SERVICE COMMITMENT; EARLY TERMINATION FEE
Your Service Commitment begins on the day we activate your service. You have received certain benefits from us in exchange for any Service Commitment greater than one month. If we terminate your service for nonpayment or other default before the end of the Service Commitment, or if you terminate your service for any reason other than (a) in accordance with the cancellation policy; or (b) pursuant to a change of terms, conditions, or rates as set forth below, you agree to pay us with respect to each Equipment identifier or telephone number assigned to you, in addition to all other amounts owed, an Early Termination Fee of $175 (&quot;Early Termination Fee&quot;). The Early Termination Fee is not a penalty, but rather a charge to compensate us for your failure to satisfy the Service Commitment on which your rate plan is based. AFTER YOUR SERVICE COMMITMENT, THIS AGREEMENT SHALL AUTOMATICALLY RENEW ON A MONTH-TO-MONTH BASIS UNTIL EITHER PARTY GIVES NOTICE PURSUANT TO THE TERMINATION PROVISION BELOW.

30-DAY CANCELLATION PERIOD/TERMINATION
You may terminate this Agreement within thirty (30) days after activating service without paying an Early Termination Fee. You will pay for service fees and charges incurred through the termination date, but AT&amp;T will refund your activation fee, if any, if you terminate within three (3) days of activating the service. Also, you may have to return any handsets and accessories purchased with this Agreement. If you terminate after the 30th day but before expiration of the Agreement's Service Commitment, you will pay AT&amp;T an Early Termination Fee for each wireless telephone number associated with the service. Either party may terminate this Agreement at any time after your Service Commitment ends with thirty (30) days notice to the other party. We may terminate this Agreement at any time without notice if we cease to provide service in your area. We may interrupt or terminate your service without notice for any conduct that we believe violates this Agreement or any terms and conditions of your rate plan, or if you behave in an abusive, derogatory, or similarly unreasonable manner with any of our representatives, or if we discover that you are under age, or if you fail to make all required payments when due, or if we have reasonable cause to believe that your Equipment is being used for an unlawful purpose or in a way that may adversely affect our service, or if you provided inaccurate credit information or we believe your credit has deteriorated and you refuse to pay any requested advance payment or deposit.

CHARGES AND DISPUTES
You are responsible for paying all charges for or resulting from services provided under this Agreement. You will receive monthly bills that are due in full as shown thereon. YOU MUST, WITHIN 100 DAYS OF THE DATE OF THE BILL, NOTIFY US IN WRITING AT AT&amp;T, BILL DISPUTE, SUITE 1400, 5565 Glenridge Connector, P.O. BOX 16, ATLANTA, GA 30342 (&quot;AT&amp;T'S ADDRESS&quot;) OF ANY DISPUTE YOU HAVE WITH RESPECT TO THE BILL, INCLUDING ANY CHARGES ON THE BILL AND ANY SERVICE WE PROVIDED FOR WHICH YOU WERE BILLED, OR YOU WILL HAVE WAIVED YOUR RIGHT TO DISPUTE THE BILL OR SUCH SERVICES AND TO BRING, OR PARTICIPATE IN, ANY LEGAL ACTION RAISING ANY SUCH DISPUTE. Charges include, without limitation, airtime, roaming, recurring monthly service, activation, administrative, and late payment charges; regulatory cost recovery and other surcharges; optional feature charges; toll, collect call and directory assistance charges; restoral and reactivation charges, any other charges or calls billed to your phone number; and applicable taxes and governmental fees, whether assessed directly upon you or upon AT&amp;T. To determine your primary place of use (&quot;PPU&quot;) and which jurisdiction's taxes and assessments to collect, you are required to provide us with your residential or business street address. If you do not provide us with such address, or if it falls outside our licensed service area, we may reasonably designate a PPU within the licensed service area for you. Subscriber must live and have a mailing address within AT&amp;T's owned network coverage area.

UNLIMITED VOICE SERVICES
Unlimited voice services are provided solely for live dialog between two individuals. Unlimited voice services may not be used for conference calling, call forwarding, monitoring services, data transmissions, transmission of broadcasts, transmission of recorded material, or other connections which do not consist of uninterrupted live dialog between two individuals. If AT&amp;T finds that you are using an unlimited voice service offering for other than live dialog between two individuals, AT&amp;T may at its option terminate your service, or change your plan to one with no unlimited usage components. AT&amp;T will provide notice that it intends to take any of the above actions and you may terminate the agreement.

OFF-NET USAGE
If your minutes of use (including unlimited services) on other carrier networks (&quot;off-net usage&quot;) during any two consecutive months exceeds your off-net usage allowance, AT&amp;T may at its option terminate your service, deny your continued use of other carriers' coverage, or change your plan to one imposing usage charges for off-net usage. Your off-net usage allowance is equal to the lesser of 750 minutes or 40% of the Anytime Minutes included with your plan. AT&amp;T will provide notice that it intends to take any of the above actions and you may terminate the agreement.

BILLING AND PAYMENT
Except as provided below, monthly service and certain other charges are billed one month in advance, and there is no proration of such charges if service is terminated on other than the last day of your billing cycle. Monthly service and certain other charges are billed in arrears if you are a former customer of AT&amp;T Wireless and maintain uninterrupted service on select AT&amp;T rate plans, provided, however, that in either case, if you elect to receive your bills for your AT&amp;T services combined with your landline phone bill (where available) you will be billed in advance as provided above. You agree to pay for incoming and outgoing calls, and data services sent to and from your Equipment. AIRTIME AND OTHER MEASURED USAGE (&quot;CHARGEABLE TIME&quot;) IS BILLED IN FULL-MINUTE INCREMENTS, AND ACTUAL AIRTIME AND USAGE ARE ROUNDED UP TO THE NEXT FULL-MINUTE INCREMENT AT THE END OF EACH CALL FOR BILLING PURPOSES. AT&amp;T CHARGES A FULL MINUTE OF AIRTIME USAGE FOR EVERY FRACTION OF THE LAST MINUTE OF AIRTIME USED ON EACH WIRELESS CALL. DATA TRANSPORT IS BILLED IN FULL-KILOBYTE INCREMENTS, AND ACTUAL TRANSPORT IS ROUNDED UP TO THE NEXT FULL-KILOBYTE INCREMENT AT THE END OF EACH DATA SESSION FOR BILLING PURPOSES. AT&amp;T CHARGES A FULL KILOBYTE OF DATA TRANSPORT FOR EVERY FRACTION OF THE LAST KILOBYTE OF DATA TRANSPORT USED ON EACH DATA SESSION. NETWORK OVERHEAD, SOFTWARE UPDATE REQUESTS, AND RESEND REQUESTS CAUSED BY NETWORK ERRORS CAN INCREASE MEASURED KILOBYTES. If you select a rate plan that includes a predetermined allotment of services (for example, a predetermined amount of airtime, megabytes or text messages), unless otherwise specifically provided as a part of such rate plan, any unused allotment of services from one billing cycle will not carry over to any other billing cycle. We may bill you in a format as we determine from time to time. Additional charges may apply for additional copies of your bill, or for detailed information about your usage of services. Charges for usage of services on networks maintained by other carriers or on networks acquired by AT&amp;T after August 31, 2004, may appear on your bill after the billing cycle in which the usage occurred. Chargeable Time begins for outgoing calls when you press SEND (or similar key) and for incoming calls when a signal connection from the caller is established with our facilities. Chargeable Time ends after you press END (or similar key), but not until your wireless telephone's signal of call disconnect is received by our facilities and the call disconnect signal has been confirmed. All outgoing calls for which we receive answer supervision or which have at least 30 seconds of Chargeable Time, including ring time, shall incur a minimum of one-minute airtime charge. Answer supervision is generally received when a call is answered; however, answer supervision may also be generated by voicemail systems, private branch exchanges, and interexchange switching equipment. Chargeable Time may include time for us to recognize that only one party has disconnected from the call, time to clear the channels in use, and ring time. Chargeable Time may also occur from other uses of our facilities, including by way of example, voicemail deposits and retrievals, and call transfers. Calls that begin in one rate period and end in another rate period may be billed in their entirety at the rates for the period in which the call began. If your wireless phone or other device (&quot;Equipment&quot;) is lost or stolen, you must contact us immediately to report the Equipment lost or stolen. You may be responsible for all charges incurred on your phone number until you report the theft or loss. You will cooperate with us in the investigation of the loss or theft and will provide a police report number to us if requested. AT&amp;T will take into account the information provided by the customer to evaluate on an individual basis whether grounds exist for further relief. You also remain responsible for paying your monthly service fee if your service is suspended for nonpayment. We may require payment by money order, cashier's check, or a similarly secure form of payment at our discretion.

DISHONORED CHECKS AND OTHER INSTRUMENTS
We will charge you $30 or the highest amount allowed by law, whichever is less, for any check or other instrument (including credit card chargebacks) tendered by you and returned unpaid by a financial institution for any reason. You agree to reimburse us the fees of any collection agency, which may be based on a percentage at a maximum of 33% of the debt, and all costs and expenses, including reasonable attorneys' fees, we incur in such collection efforts.

CHANGES TO TERMS AND RATES
We may change any terms, conditions, rates, fees, expenses, or charges regarding your service at any time. We will provide you with notice of such changes (other than changes to governmental fees, proportional charges for governmental mandates, roaming rates or administrative charges) either in your monthly bill or separately. You understand and agree that State and Federal Universal Service fees and other governmentally imposed fees, whether or not assessed directly upon you, may be increased based upon the government's or our calculations. IF WE INCREASE THE PRICE OF ANY OF THE SERVICES TO WHICH YOU SUBSCRIBE, BEYOND THE LIMITS SET FORTH IN YOUR RATE PLAN BROCHURE, OR IF WE MATERIALLY DECREASE THE GEOGRAPHICAL AREA IN WHICH YOUR AIRTIME RATE APPLIES (OTHER THAN A TEMPORARY DECREASE FOR REPAIRS OR MAINTENANCE), WE WILL DISCLOSE THE CHANGE AT LEAST ONE BILLING CYCLE IN ADVANCE (EITHER THROUGH A NOTICE WITH YOUR BILL, A TEXT MESSAGE TO YOUR EQUIPMENT, OR OTHERWISE) AND YOU MAY TERMINATE THIS AGREEMENT WITHOUT PAYING AN EARLY TERMINATION FEE OR RETURNING OR PAYING FOR ANY PROMOTIONAL ITEMS, PROVIDED YOUR NOTICE OF TERMINATION IS DELIVERED TO US WITHIN THIRTY (30) DAYS AFTER THE FIRST BILL REFLECTING THE CHANGE. If you lose your eligibility for a particular rate plan, we may change your rate plan to one for which you qualify.

CONTINGENT BENEFITS
You may receive or be eligible for certain rate plans, discounts, features, promotions, and other benefits (&quot;Benefits&quot;) through a business or government customer's agreement with us (&quot;Business Agreement&quot;). Any and all such Benefits are provided to you solely as a result of the corresponding Business Agreement, and such Benefits may be modified or terminated without notice. If a business or government entity pays your charges or is otherwise liable for the charges, you authorize us to share your account information with that entity and/or its authorized agents. If you are on a rate plan and/or receive certain Benefits tied to a Business Agreement with us, but you are liable for your own charges, then you authorize us to share enough account information with that entity and/or its authorized agents to verify your continuing eligibility for those Benefits and/or that rate plan. You may receive Benefits because of your agreement to have the charges for your service billed (&quot;Joint Billing&quot;) by a landline company affiliated with AT&amp;T (&quot;Affiliate&quot;) or because you subscribe to certain service provided by an Affiliate. If you cancel Joint Billing or the Affiliate service your rates will be adjusted without notice to a rate plan for which you qualify.

EQUIPMENT
Your Equipment must be compatible with, and not interfere with, our service, and must comply with all applicable laws, rules, and regulations. We may periodically program your Equipment remotely with system settings for roaming service and other features that cannot be changed manually. Equipment purchased for use on AT&amp;T's system is designed for use exclusively on AT&amp;T's system. You agree that you will not make any modifications to the Equipment or programming to enable the Equipment to operate on any other system. AT&amp;T may in it's sole and absolute discretion modify the programming to enable the operation of the Equipment on other systems. You can get details on AT&amp;T policies for modifying Equipment by calling 1-866-246-4852.

ADVANCE PAYMENTS AND/OR DEPOSITS
We may require you to make deposits or advance payments for services, which we may offset against any unpaid balance on your account. Interest will not be paid on advance payments or deposits unless required by law. We may require additional advance payments or deposits if we determine that the initial payment was inadequate. Based on your creditworthiness as we determine it, we may establish a credit limit and restrict service or features. If your account balance goes beyond the limit we set for you, we may immediately interrupt or suspend service until your balance is brought below the limit. Any charges you incur in excess of your limit become immediately due. If you have more than one account with us, you must keep all accounts in good standing to maintain service. If one account is past due or over its limit, all accounts in your name are subject to interruption or termination and all other available collection remedies.

LATE PAYMENT CHARGES
Late payment charges are based on the state to which the area code of the wireless telephone number assigned to you is assigned by the North American Numbering Plan Administration (for area code assignments see www.nationalnanpa.com/area_code_maps). You agree that for amounts not paid by the due date, AT&amp;T may charge, as a part of its
rates and charges, and you agree to pay, a late payment fee of $5 in CT, D.C., DE, IL, KS, MA, MD, ME, MI, MO, NH, NJ, NY, OH, OK, PA, RI, VA, VT WI, WV; the late payment charge is 1.5% of the balance carried forward to the next bill in all other states.

SERVICE LIMITATIONS; LIMITATION OF LIABILITY
Service may be interrupted, delayed, or otherwise limited for a variety of reasons, including environmental conditions, unavailability of radio frequency channels, system capacity, priority access by National Security and Emergency Preparedness personnel in the event of a disaster or emergency, coordination with other systems, equipment modifications and repairs, and problems with the facilities of interconnecting carriers. We may block access to certain categories of numbers (e.g. 976, 900, and international destinations) or certain web sites at our sole discretion. We may, but do not have the obligation to, refuse to transmit any information through the service and may screen and delete information prior to delivery of that information to you. There are gaps in service within the service areas shown on coverage maps, which, by their nature, are only approximations of actual coverage. WE DO NOT GUARANTEE YOU UNINTERRUPTED SERVICE OR COVERAGE. WE CANNOT ASSURE YOU THAT IF YOU PLACE A 911 CALL YOU WILL BE FOUND. Airtime and other service charges apply to all calls, including involuntarily terminated calls. AT&amp;T MAKES NO WARRANTY, EXPRESS OR IMPLIED, OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE, SUITABILITY, OR PERFORMANCE REGARDING ANY SERVICES OR GOODS, AND IN NO EVENT SHALL AT&amp;T BE LIABLE, WHETHER OR NOT DUE TO ITS OWN NEGLIGENCE, for any: (a) act or omission of a third party; (b) mistakes, omissions, interruptions, errors, failures to transmit, delays, or defects in the service provided by or through us; (c) damage or injury caused by the use of service or Equipment, including use in a vehicle; (d) claims against you by third parties; (e) damage or injury caused by a suspension or termination of service by AT&amp;T; or (f) damage or injury caused by failure or delay in connecting a call to 911 or any other emergency service. Notwithstanding the foregoing, if your service is interrupted for 24 or more continuous hours by a cause within our control, we will issue you, upon request, a credit equal to a pro-rata adjustment of the monthly service fee for the time period your service was unavailable, not to exceed the monthly service fee. Our liability to you for service failures is limited solely to the credit set forth above. Unless applicable law precludes parties from contracting to so limit liability, and provided such law does not discriminate against arbitration clauses, AT&amp;T shall not be liable for any indirect, special, punitive, incidental or consequential losses or damages you or any third party may suffer by use of, or inability to use, service or Equipment provided by or through AT&amp;T, including loss of business or goodwill, revenue or profits, or claims of personal injuries. To the full extent allowed by law, you hereby release, indemnify, and hold AT&amp;T and its officers, directors, employees and agents harmless from and against any and all claims of any person or entity for damages of any nature arising in any way from or relating to, directly or indirectly, service provided by AT&amp;T or any person's use thereof (including, but not limited to, vehicular damage and personal injury), INCLUDING CLAIMS ARISING IN WHOLE OR IN PART FROM THE ALLEGED NEGLIGENCE OF AT&amp;T, or any violation by you of this Agreement. This obligation shall survive termination of your service with AT&amp;T. AT&amp;T is not liable to you for changes in operation, equipment, or technology that cause your Equipment or software to be rendered obsolete or require modification. SOME STATES, INCLUDING THE STATE OF KANSAS, DO NOT ALLOW DISCLAIMERS OF IMPLIED WARRANTIES OR LIMITS ON REMEDIES FOR BREACH. THEREFORE, THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU. THIS AGREEMENT GIVES YOU SPECIFIC LEGAL RIGHTS, AND YOU MAY HAVE OTHER RIGHTS WHICH VARY FROM STATE TO STATE.

ACCOUNT ACCESS
You authorize us to provide information about and to make changes to your account, including adding new service, upon the direction of any person able to provide information we deem sufficient to identify you.

VOICEMAIL SERVICE
We may deactivate your voicemail service if you do not initialize it within a reasonable period after activation. We will reactivate the service upon your request.

DISPUTE RESOLUTION BY BINDING ARBITRATION
Please read this carefully. It affects your rights.

Summary: Most customer concerns can be resolved quickly and to the customer's satisfaction by calling our customer service department at 800-331-0500. In the unlikely event that AT&amp;T's customer service department is unable to resolve a complaint you may have to your satisfaction (or if AT&amp;T has not been able to resolve a dispute it has with you after attempting to do so informally), we each agree to resolve those disputes through binding arbitration or small claims court instead of in courts of general jurisdiction. Arbitration is more informal than a lawsuit in court. Arbitration uses a neutral arbitrator instead of a judge or jury, allows for more limited discovery than in court, and is subject to very limited review by courts. Arbitrators can award the same damages and relief that a court can award. Any arbitration under this Agreement will take place on an individual basis; class arbitrations and class actions are not permitted. AT&amp;T will pay all costs of arbitration, no matter who wins, so long as your claim is not frivolous. Moreover, in arbitration you are entitled to recover attorneys' fees from AT&amp;T to at least the same extent as you would be in court. In addition, under certain circumstances (as explained below), AT&amp;T will pay you and your attorney a special premium if the arbitrator awards you an
amount that is greater than what AT&amp;T has offered you to settle the dispute.

ARBITRATION AGREEMENT
(1) AT&amp;T and you agree to arbitrate all disputes and claims between us. This agreement to arbitrate is intended to be broadly interpreted. It includes, but is not limited to:

     &middot; claims arising out of or relating to any aspect of the relationship between us,
       whether based in contract, tort, statute, fraud, misrepresentation or any other
       legal theory;
     &middot; claims that arose before this or any prior Agreement (including, but not limited
       to, claims relating to advertising);
     &middot; claims that are currently the subject of purported class action litigation in
       which you are not a member of a certified class; and
     &middot; claims that may arise after the termination of this Agreement.

References to &quot;AT&amp;T,&quot; &quot;you,&quot; and &quot;us&quot; include our respective subsidiaries, affiliates, agents, employees, predecessors in interest, successors, and assigns, as well as all authorized or unauthorized users or beneficiaries of services or equipment under this or prior Agreements between us. Notwithstanding the foregoing, either party may bring an individual action in small claims court. You agree that, by entering into this Agreement, you and AT&amp;T are each waiving the right to a trial by jury or to participate in a class action. This Agreement evidences a transaction in interstate commerce, and thus the Federal Arbitration Act governs the interpretation and enforcement of this provision. This arbitration provision shall survive termination of this Agreement.

(2) A party who intends to seek arbitration must first send to the other, by certified mail, a written Notice of Dispute (&quot;Notice&quot;). The Notice to AT&amp;T should be addressed to: General Counsel, AT&amp;T, 5565 Glenridge Connector, 20th Floor, Atlanta, GA 30342 (&quot;Notice Address&quot;). The Notice must (a) describe the nature and basis of the claim or dispute; and (b) set forth the specific relief sought (&quot;Demand&quot;). If AT&amp;T and you do not reach an agreement to resolve the claim within 30 days after the Notice is received, you or AT&amp;T may commence an arbitration proceeding. During the arbitration, the amount of any settlement offer made by AT&amp;T or you shall not be disclosed to the arbitrator until after the arbitrator determines the amount, if any, to which you or AT&amp;T is entitled. You may download or copy a form Notice and a form to initiate arbitration at: www.att.com/arbitration-forms.

(3) After AT&amp;T receives notice at the Notice Address that you have commenced arbitration, it will promptly reimburse you for your payment of the filing fee. (The filing fee currently is $125 for claims under $10,000, but is subject to change by the arbitration provider. If you are unable to pay this fee, AT&amp;T will pay it directly upon receiving a written request at the Notice Address.) The arbitration will be governed by the Commercial Dispute Resolution Procedures and the Supplementary Procedures for Consumer Related Disputes (collectively, &quot;AAA Rules&quot;) of the American Arbitration Association (&quot;AAA&quot;), as modified by this Agreement, and will be administered by the AAA. The AAA Rules are available online at www.adr.org, by calling the AAA at 1-800-778-7879, or by writing to the Notice Address. (You may obtain information that is designed for non-lawyers, about the arbitration process at www.att.com/arbitration-information.) All issues are for the arbitrator to decide, including the scope of this arbitration provision, but the arbitrator is bound by the terms of this Agreement. Unless AT&amp;T and you agree otherwise, any arbitration hearings will take place in the county (or parish) of your billing address. If your claim is for $10,000 or less, we agree that you may choose whether the arbitration will be conducted solely on the basis of documents submitted to the arbitrator, through a telephonic hearing, or by an in-person hearing as established by the AAA Rules. If your claim exceeds $10,000, the right to a hearing will be determined by the AAA Rules. Except as otherwise provided for herein, AT&amp;T will pay all AAA filing, administration, and arbitrator fees for any arbitration initiated in accordance with the notice requirements above. If, however, the arbitrator finds that either the substance of your claim or the relief sought in the Demand is frivolous or brought for an improper purpose (as measured by the standards set forth in Federal Rule of Civil Procedure 11(b), then the payment of all such fees will be governed by the AAA Rules. In such case, you agree to reimburse AT&amp;T for all monies previously disbursed by it that are otherwise your obligation to pay under the AAA Rules.

(4) If, after finding in your favor in any respect on the merits of your claim, the arbitrator issues you an award that is:

     &middot; equal to or less than the greater of (a) $5,000 or (b) the maximum claim that
       may be brought in small claims court in the county of your billing address; and
     &middot; greater than the value of AT&amp;T's last written settlement offer made before
       an arbitrator was selected,

then AT&amp;T will:

     &middot; pay you the greater of (a) $5,000 or (b) the maximum claim that may be brought
       in small claims court in the county of your billing address (&quot;the premium&quot;)
       instead of the arbitrator's award; and
     &middot; pay your attorney, if any, twice the amount of attorneys' fees, and reimburse
       any expenses, that your attorney reasonably accrues for investigating, preparing,
       and pursuing your claim in arbitration (&quot;the attorney premium&quot;).

If AT&amp;T did not make a written offer to settle the dispute before an arbitrator was selected, you and your attorney will be entitled to receive the premium and the attorney premium, respectively, if the arbitrator awards you any relief on the merits. The arbitrator may make rulings and resolve disputes as to the payment and reimbursement of fees, expenses, and the premium and the attorney premium at any time during the proceeding and upon request from either party made within 14 days of the arbitrator's ruling on the merits.

(5) The right to attorneys' fees and expenses discussed in paragraph (4) supplements any right to attorneys' fees and expenses you may have under applicable law. Thus, if you would be entitled to a larger amount under the applicable law, this provision does not preclude the arbitrator from awarding you that amount. However, you may not recover duplicative awards of attorneys' fees or costs. Although under some laws AT&amp;T may have a right to an award of attorneys' fees and expenses if it prevails in an arbitration, AT&amp;T agrees that it will not seek such an award.

(6) The arbitrator may award injunctive relief only in favor of the individual party seeking relief and only to the extent necessary to provide relief warranted by that party's individual claim. YOU AND AT&amp;T AGREE THAT EACH MAY BRING CLAIMS AGAINST THE OTHER ONLY IN YOUR OR ITS INDIVIDUAL CAPACITY, AND NOT AS A PLAINTIFF OR CLASS MEMBER IN ANY PURPORTED CLASS OR REPRESENTATIVE PROCEEDING. Further, unless both you and AT&amp;T agree otherwise, the arbitrator may not consolidate more than one person's claims, and may not otherwise preside over any form of a representative or class proceeding. If this specific provison is found to be unenforceable, then the entirety of this arbitration provison shall be null and void.

(7) Notwithstanding any provision in this Agreement to the contrary, we agree that if AT&amp;T makes any change to this arbitration provision (other than a change to the Notice Address) during your Service Commitment, you may reject any such change and require AT&amp;T to adhere to the language in this provision if a dispute between us arises.

MISCELLANEOUS
This Agreement, the signature or rate summary sheet, the terms included in the rate brochure(s) describing your plan and services, terms of service for products and services not otherwise described herein that are posted on applicable AT&amp;T web sites, and any documents expressly referred to herein or therein, make up the complete agreement between you and AT&amp;T, and supersede any and all prior agreements and understandings relating to the subject matter of this Agreement. If any provision of this Agreement is found to be unenforceable by a court or agency of competent jurisdiction, the remaining provisions will remain in full force and effect. The foregoing does not apply to the prohibition against class or representative actions that is part of the arbitration clause; if that prohibition is found to be unenforceable, the arbitration clause (but only the arbitration clause) shall be null and void. AT&amp;T may assign this Agreement, but you may not assign this Agreement without our prior written consent. The law of the state of your billing address shall govern this Agreement except to the extent that such law is preempted by or inconsistent with applicable federal law. Your caller identification information (such as your name and phone number) may be displayed on the equipment or bill of the person receiving your call; technical limitations may, in some circumstances, prevent you from blocking the transmission of caller identification information. You consent to the use by us or our authorized agents of regular mail, predictive or autodialing equipment, email, text messaging, facsimile or other reasonable means to contact you to advise you about our services or other matters we believe may be of interest to you. In any event, we reserve the right to contact you by any means regarding customer servicerelated notifications, or other such information. The original version of this Agreement is in the English language. Any discrepancy or conflicts between the English version and any other language version will be resolved with reference to and by interpreting the English version.

&copy; 2007 AT&amp;T Knowledge Ventures. All rights reserved. AT&amp;T, AT&amp;T logo, Cingular and Cingular logos are trademarks of AT&amp;T Knowledge Ventures and/or AT&amp;T affiliated companies.</textarea>
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
//									if (($plan_cost-($plan_cost*($discount*.01))) < 0){
//										echo '<font color="#FF0000">'.money_format('%-#4n', ($plan_cost-($plan_cost*($discount*.01)))).'</font>&nbsp;&nbsp;&nbsp;&nbsp;';
//									}else{
//										echo money_format('%-#4n', ($plan_cost-($plan_cost*($discount*.01)))).'&nbsp;&nbsp;&nbsp;&nbsp;';
//									}
									if ($plan_cost < 0){
										echo '<font color="#FF0000">'.money_format('%-#4n', ($plan_cost-($plan_cost*($discount*.01)))).'</font>&nbsp;&nbsp;&nbsp;&nbsp;';
									}else{
										echo money_format('%-#4n', $plan_cost).'&nbsp;&nbsp;&nbsp;&nbsp;';
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
//									$recurring = (($plan_cost+$opt_cost)-(($plan_cost+$opt_cost)*($discount*.01)));
//									if ($recurring < 0){
//										echo '<font color="#FF0000">'.money_format('%-#4n', $recurring).'</font><img src="images/spacer.gif" alt="" width="13" height="1" border="0">';
//									}else{
//										echo money_format('%-#4n', $recurring).'<img src="images/spacer.gif" alt="" width="13" height="1" border="0">';
//									}
									$recurring = $plan_cost+($opt_cost*$discount*.01);
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
		$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'AT&T' AND family_plan = 'T' AND plan_type = 'V' AND display = 'T' GROUP BY group_name ORDER BY group_position";
	}else{
		$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'AT&T' AND family_plan = 'F' AND plan_type = 'V' AND display = 'T' GROUP BY group_name ORDER BY group_position";
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
<!--				<td width="50"><img src="images/spacer.gif" alt="" width="50" height="1" border="0"></td>-->
				<td class="bigBlack">
					<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
					<ul>
						Whether you're a footloose single, a traveling businesswoman or a family of five, AT&T has rate plans that suit your situation.<br><br>
						Please select a voice plan from either the AT&T Nation Plans or the AT&T Unity Plans.  Below them you will find all additional plan groups appropriate for the devices in your shopping cart - please select one plan from each group. 
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
						<td><img src="images/spacer.gif" alt="" width="75" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="180" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="104" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="125" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="150" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Included Minutes</td>
						<td align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
						<td align="center">Mobile to Mobile Minutes</td>
						<td align="center">'.$minute_type.' Minutes</td>
						<td align="center">Additional Minutes</td>
						<td align="center">Cost per Month</td>
						<td align="center">Your Cost per Month<br><span class="smallWhite">(With your '.round($cingular_discount).'% discount'.iif($family_plans, "&sup2;", "").')</span></td>
					</tr>
							';
							$discountable = true;
							for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
								$row = mysql_fetch_assoc($rs_plans);
								if (is_null($row["nights_qty"])){
									$nights_qty = "Unlimited";
								}else{
									$nights_qty = $row["nights_qty"].' Minutes';
								}
								if ($row["discountable"] == 'F'){
									$discountable = false;
									echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="voice_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$nights_qty.'</td>
						<td align="center">Unlimited</td>
						<td align="center">Unlimited</td>
						<td align="center">$'.money_format('%i', $row["add_min_cost"]).'/Min.</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
					</tr>
								';
								}else{
									echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="voice_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$nights_qty.'</td>
						<td align="center">Unlimited</td>
						<td align="center">Unlimited</td>
						<td align="center">$'.money_format('%i', $row["add_min_cost"]).'/Min.</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
									';
									if ($family_plans){
										echo'
						<td align="center">$'.money_format('%i', ($row["cost"]-(($row["cost"]-9.99)*($cingular_discount*.01)))).'</td>
										';
									}else{
										echo'
						<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($cingular_discount*.01)))).'</td>
										';
									}
									echo '
					</tr>
									';
								}
							};
						}else{ // No MRC discount
							echo'
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td><img src="images/spacer.gif" alt="" width="50" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="180" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="136" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="140" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="140" height="0" border="0"></td>
						<td><img src="images/spacer.gif" alt="" width="140" height="0" border="0"></td>
					</tr>
					<tr bgcolor="'.$box_color.'" class="bodyWhite">
						<td align="center">Select</td>
						<td align="center">Included Minutes</td>
						<td align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
						<td align="center">Mobile to Mobile Minutes</td>
						<td align="center">'.$minute_type.' Minutes</td>
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
						<td align="center">Unlimited</td>
						<td align="center">$'.money_format('%i', $row["add_min_cost"]).'/Min.</td>
						<td align="center">$'.money_format('%i', $row["cost"]).'</td>
					</tr>
								';
							};
						};
					};
					echo'
					</table>
					';
					$disclaimer = '<div align="right" class="smallBlack">';
					if ($discountable == false){
						$discountable = true;
						$disclaimer .= '&sup1;This Plan Not Eligible for Discounts&nbsp;&nbsp;&nbsp;';
					}
					if ($family_plans){
						$disclaimer .= '&sup2;Discount Applies to First Line Only&nbsp;&nbsp;&nbsp;';
					}
					$disclaimer .= '&nbsp;&nbsp;<br><br></div>';
					echo $disclaimer;
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
						$discountable = true;
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
							if ($row["discountable"] == 'F'){
								$discountable = false;
								echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="data_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$add_data_cost.'</td>
						<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
						<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
					</tr>
								';
							}else{
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
							}
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
						$discountable = true;
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
							if ($row["discountable"] == 'F'){
								$discountable = false;
								echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="25" align="center" bgcolor="'.$form_bg.'"><input type="radio" name="blackberry_plan_id" value="'.$row["plan_id"].'"></td>
						<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">'.$add_data_cost.'</td>
						<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
						<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
					</tr>
								';
							}else{
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
							}
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
						<li>Rates exclude taxes & fees (including USF charge that varies quarterly, cost recovery fees, &amp; state/local fees that vary by area - <a href="javascript:newwin=window.open('http://www.wireless.att.com/customer_service/additional_charges','','scrollbars=yes,width=1000,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Click Here</a> for more information.).</li><br><br>
						<li>Hours for Nights & Weekends starting at 7pm are Mon.-Thurs. 7pm-7am and Friday 7pm-Mon. 7am. Hours for Nights & Weekends starting at 9pm are Mon.-Thurs. 9pm-6am and Friday 9pm-Mon. 6am.</li><br><br>
						<li>Stated prices and options are for online purchase only and are subject to change.</li><br><br>
						<li>Mail-in rebates are only applicable if plan requirements are met.</li>
					</ul>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</tr>
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
