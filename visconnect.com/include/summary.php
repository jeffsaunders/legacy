<!-- BEGIN Include summary.php -->

<!-- SSL Site Seal -->
<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

<?
// Test for session id; if none or mismatch they deep-linked, force them to start from scratch
if (!$_SESSION['SID']){ echo'<script>window.location="/?sec=home";</script>'; exit;}
// Good, there is a cookie - assign it's value to a variable for easy work
$SID = $_SESSION['SID'];
//echo $SID;
?>

<!-- Verify Actions -->
<script>
/* These are already loaded in the cart.php include that is present on every page
// Verify that they really want to empty thier cart
function verifyEmpty(){
	return confirm("Are you sure you want to empty your cart?");
}
// Verify that they really want to remove this phone
function verifyRemove(){
	return confirm("Are you sure you want to remove this phone from your cart?");
}
*/
</script>

<?
$query = "SELECT * FROM orders WHERE session_id = '".$SID."'";
//echo $query;
$rs_cart = mysql_query($query, $linkID);
$order = mysql_fetch_assoc($rs_cart);
// Get the order items
$query = "SELECT * FROM order_items WHERE session_id = '".$SID."'";
//echo $query;
$rs_items = mysql_query($query, $linkID);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td valign="top">
		<table width="710" border="0" cellspacing="0" cellpadding="0" align="left" bgcolor="#FFFFFF">
		<tr>
			<td><img src="images/CheckoutHeader.jpg" alt="" width="710" height="25" border="0"></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" background="images/InfoBG.jpg" style="background-position:top; background-repeat:repeat-y;">
				<table width="690" border="0" cellspacing="0" cellpadding="5" align="center" class="bodyBlack">
				<tr>
					<td width="670" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
						Please verify the following information.<br><br>
						<font color="#FF0000">To complete your order, you MUST agree to the <em>Terms of Service</em> below, signified by checking the accompanying checkbox, and click the "Submit Order" button.&nbsp;&nbsp;Your order is NOT complete until you take this final step and submit this page.</font><br>
					</td>
					<td width="65" rowspan="2" align="center" valign="top" class="smallBlack">
						<!-- SSL Site Seal -->
						<script type="text/javascript">TrustLogo("images/SiteSeal.gif", "SC","none");</script><br>
						<font face="Arial,Helvetica,sans-serif" style="font-size:9px;">*Secure Site*</font>
					</td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<!-- Customer Information -->
				<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
				<tr>
					<td colspan="3" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
				</tr>
				<tr bgcolor="#6E6E6E">
					<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td height="20">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyWhite">
						<tr>
							<td><img src="images/spacer.gif" alt="" width="12" height="1" border="0"><strong>Customer Information</strong></td>
							<td align="right"><a href="?sec=checkout&sid=<? echo $SID; ?>&" title="Change Your Customer Information" class="smallWhite"><strong>Edit Customer Information</strong></a><img src="images/spacer.gif" alt="" width="12" height="1" border="0"></td>
						</tr>
						</table>
					</td>
					<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
				</tr>
				<tr bgcolor="#DCEAFB" class="bodyBlack">
					<td>
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
						<tr>
							<td>
								<table width="100%" border="0" cellspacing="3" cellpadding="0" class="bodyBlack">
								<tr>
									<td colspan="3">
										<strong><? echo $order["first_name"].' '.iif($order["middle_name"] != '', $order["middle_name"].' ', '').$order["last_name"].'&nbsp;&nbsp;('.$order["email"].')'; ?></strong>
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
									<td width="230" valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
										<tr>
											<td width="60" valign="top"><strong>Ship To:</strong></td>
											<td width="170">
												<? echo $order["ship_address_1"]; ?><br>
												<? echo iif($order["ship_address_2"] != '', $order["ship_address_2"].'<br>', ''); ?>
												<? echo $order["ship_city"].', '.$order["ship_state"].'&nbsp;&nbsp;'.$order["ship_zipcode"] ?><br><br>
											</td>
										</tr>
										<tr>
											<td valign="top"><strong>Bill To:</strong></td>
											<td>
												<? echo $order["bill_address_1"]; ?><br>
												<? echo iif($order["bill_address_2"] != '', $order["bill_address_2"].'<br>', ''); ?>
												<? echo $order["bill_city"].', '.$order["bill_state"].'&nbsp;&nbsp;'.$order["bill_zipcode"] ?><br><br>
											</td>
										</tr>
										</table>
									</td>
									<td width="220" valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
										<tr>
											<td width="110"><strong>Home Phone:</strong></td>
											<td width="110"><? echo $order["home_phone"]; ?></td>
										</tr>
										<tr>
											<td><strong>Alt. Phone:</strong></td>
											<td><? echo $order["alt_phone"]; ?></td>
										</tr>
										<?
										if ($order["carrier_phone"] != ''){
											echo'
										<tr>
											<td><strong>Sprint Phone:</strong></td>
											<td>'.$order["carrier_phone"].'</td>
										</tr>
											';
										}
										?>
										<tr>
											<td><br><strong>Social Security:</strong></td>
											<td valign="bottom"><? echo $order["ssn"]; ?></td>
										</tr>
										<tr>
											<td><strong>Date of Birth:</strong></td>
											<td><? echo $order["dob"]; ?></td>
										</tr>
										<tr>
											<td valign="top"><strong><? echo $order["dl_state"]; ?> Driver's Lic.:</strong></td>
											<td><? echo $order["dl_num"]; ?></td>
										</tr>
										</table>
									</td>
									<td width="220" valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
										<tr>
											<td width="105"><strong>Card Type:&nbsp;</strong></td>
											<td width="115"><? echo $order["cc_type"]; ?></td>
										</tr>
										<tr>
											<td><strong>Card Num.:&nbsp;</strong></td>
											<td><? echo $order["cc_num"]; ?></td>
										</tr>
										<tr>
											<td><strong>Card CID:&nbsp;</strong></td>
											<td><? echo $order["cc_cid"]; ?></td>
										</tr>
										<tr>
											<td><strong>Card Exp.:&nbsp;</strong></td>
											<td><? echo $order["cc_expiration"]; ?></td>
										</tr>
										<tr>
											<td valign="top"><strong>Name on Card:&nbsp;</strong></td>
											<td><? echo $order["cc_name"]; ?></td>
										</tr>
										</table>
									</td>
								</tr>
								</table>
							</td>						
						</tr>
						</table>
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
					</td>
				</tr>
				<tr>
					<td bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
				</tr>
				</table>
				<br>
				<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
				<tr>
					<td colspan="3" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
				</tr>
				<tr bgcolor="#6E6E6E">
					<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td height="20">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyWhite">
						<tr>
							<td><img src="images/spacer.gif" alt="" width="12" height="1" border="0"><strong>Device Information</strong></td>
							<td align="right"><!--<a href="?sec=checkout&sid=<? echo $SID; ?>&" title="Change Your Customer Information" class="smallWhite"><strong>Edit Customer Information</strong></a><img src="images/spacer.gif" alt="" width="18" height="1" border="0">--></td>
						</tr>
						</table>
					</td>
					<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
				</tr>
				<tr class="bodyBlack">
					<td>
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
							<?
							$today_subtotal = 0;
							$tomorrow_subtotal = 0;
							$phones_ordered = 0;
							$mrc_total = 0;
							for ($counter=1; $counter <= mysql_num_rows($rs_items); $counter++){
								$item = mysql_fetch_assoc($rs_items);
								if ($item['phone_type'] != ""){ // It's a phone/aircard
									$query = "SELECT * FROM phones WHERE product_id='".$item['product_id']."'";
									$phones_ordered++;
									$rs_phone = mysql_query($query, $linkID);
									$phone = mysql_fetch_assoc($rs_phone);
									$mrc = 0;
//print_r($phone);
							?>
						<tr>
							<td>
								<table width="670" border="0" cellspacing="2">
								<tr>
									<?
									$split_label = explode("<br>",$phone["label"]);
									?>
									<td class="bodyBlack"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><strong><? echo $split_label[0]." ".$split_label[1]; ?></strong></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table width="670" border="0" cellspacing="3" cellpadding="0" class="bodyBlack">
								<tr>
									<td width="70" align="center" valign="top"><img src="images/phones/<? echo $phone["thumbnail"]; ?>" alt="" width="70" height="130" border="0"><br><a href="saveit.php?task=removephone&cargo=<? echo $item["record_id"] ?>" title="Remove This <? echo $phone["manufacturer"]." ".$phone["model"]; ?> From Your Cart" class="smallBlue" onClick="return verifyRemove();"><strong>Remove</strong></a></td>
									<td width="200" valign="top">
										<table width="100%" border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
										<tr>
											<td><? echo $phone["description"]; ?></td>
										</tr>
										</table>
									</td>
									<td width="225" valign="bottom">
										<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bodyBlack">
										<tr bgcolor="#6E6E6E">
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyWhite">
												<tr>
													<td><strong>User Information</strong></td>
													<td align="right"><a href="?sec=checkout&sid=<? echo $SID; ?>&cargo=<? echo $item["record_id"] ?>" title="Change Plans & Options for this Device" class="smallWhite"><strong>Edit</strong></a></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#DCEAFB">
											<td>
												<? echo $item["phone_username"]; ?><br>
												<? echo $item["phone_usercity"].', '.$item["phone_userstate"].', '.$item["phone_userzip"] ?><br>
												<strong>Local/Desired Area Code:&nbsp;</strong> <? echo $item["phone_areacode"]; ?>
											</td>
										</tr>
										<tr>
											<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
										</tr>
										<tr bgcolor="#6E6E6E">
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyWhite">
												<tr>
													<td><strong>Plans & Options Selected</strong></td>
													<td align="right"><a href="?sec=checkout&sid=<? echo $SID; ?>&cargo=<? echo $item["record_id"] ?>" title="Change Plans & Options for this Device" class="smallWhite"><strong>Edit</strong></a></td>
												</tr>
												</table>
											</td>
										</tr>
										<?
										if ($item['voice_plan_id'] != ""){
										?>
										<tr bgcolor="#DCEAFB">
											<td align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
												<tr>
													<td width="200"><? echo $item['voice_plan_name']; ?></td>
													<?
													$query = "SELECT * FROM plans WHERE plan_id='".$item['voice_plan_id']."'";
													$rs_plan = mysql_query($query, $linkID);
													$plan = mysql_fetch_assoc($rs_plan);
													if ($plan['discountable'] == "T"){
													?>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', ($item["voice_plan_cost"]-($item["voice_plan_cost"]*($sprint_discount*.01)))); ?></td>
													<?
														$mrc += $item["voice_plan_cost"]-($item["voice_plan_cost"]*($sprint_discount*.01));
													}else{
													?>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', ($item["voice_plan_cost"])); ?></td>
													<?
														$mrc += $item["voice_plan_cost"];
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
										if ($item['data_plan_id'] != ""){
										?>
										<tr bgcolor="#DCEAFB">
											<td align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
												<tr>
													<td><? echo $item['data_plan_name']; ?></td>
													<?
													$query = "SELECT * FROM plans WHERE plan_id='".$item['data_plan_id']."'";
													$rs_plan = mysql_query($query, $linkID);
													$plan = mysql_fetch_assoc($rs_plan);
													if ($plan['discountable'] == "T"){
													?>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', ($item["data_plan_cost"]-($item["data_plan_cost"]*($sprint_discount*.01)))); ?></td>
													<?
														$mrc += $item["data_plan_cost"]-($item["data_plan_cost"]*($sprint_discount*.01));
													}else{
													?>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', ($item["data_plan_cost"])); ?></td>
													<?
														$mrc += $item["data_plan_cost"];
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
										if ($item['smartphone_plan_id'] != ""){
										?>
										<tr bgcolor="#DCEAFB">
											<td align="center">
												<table width="250" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
												<tr>
													<td width="200"><? echo $item['smartphone_plan_name']; ?></td>
													<?
													$query = "SELECT * FROM plans WHERE plan_id='".$item['smartphone_plan_id']."'";
													$rs_plan = mysql_query($query, $linkID);
													$plan = mysql_fetch_assoc($rs_plan);
													if ($plan['discountable'] == "T"){
													?>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', ($item["smartphone_plan_cost"]-($item["smartphone_plan_cost"]*($sprint_discount*.01)))); ?></td>
													<?
														$mrc += $item["smartphone_plan_cost"]-($item["smartphone_plan_cost"]*($sprint_discount*.01));
													}else{
													?>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', ($item["smartphone_plan_cost"])); ?></td>
													<?
														$mrc += $item["smartphone_plan_cost"];
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
										if ($item['blackberry_plan_id'] != ""){
										?>
										<tr bgcolor="#DCEAFB">
											<td align="center">
												<table width="250" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
												<tr>
													<td width="200"><? echo $item['blackberry_plan_name']; ?></td>
													<?
													$query = "SELECT * FROM plans WHERE plan_id='".$item['blackberry_plan_id']."'";
													$rs_plan = mysql_query($query, $linkID);
													$plan = mysql_fetch_assoc($rs_plan);
													if ($plan['discountable'] == "T"){
													?>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', ($item["blackberry_plan_cost"]-($item["blackberry_plan_cost"]*($sprint_discount*.01)))); ?></td>
													<?
														$mrc += $item["blackberry_plan_cost"]-($item["blackberry_plan_cost"]*($sprint_discount*.01));
													}else{
													?>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', ($item["blackberry_plan_cost"])); ?></td>
													<?
														$mrc += $item["blackberry_plan_cost"];
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
										if ($item['aircard_protection'] > 0){
										// NEED A MUCH BETTER WAY OF HANDLING OPTIONS THAN HARD CODING THEM!
										?>
										<tr bgcolor="#DCEAFB">
											<td align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
												<tr>
													<td>Total Equipment Protection</td>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', ($item["aircard_protection"])); ?></td>
												</tr>
												</table>
											</td>
										</tr>
										<?
											$mrc += $item["aircard_protection"];
										}
										?>
										<tr bgcolor="#DCEAFB">
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr bgcolor="#DCEAFB">
											<td align="center">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
												<tr>
													<td align="right"><strong>Total Monthly Cost:</strong></td>
													<td width="50" align="right" valign="top">$<? echo money_format('%i', $mrc); ?></td>
												</tr>
												</table>
											</td>
										</tr>
										<?
										$mrc_total += $mrc;
										?>
										</table>
									</td>
									<td width="175" align="right" valign="bottom">
										<!-- price table -->
										<?
										$price = ($phone["msrp"]-($phone["instant".$pricing_level."-1"]+$phone["instant".$pricing_level."-2"]+$phone["mail_in".$pricing_level."-1"]+$phone["mail_in".$pricing_level."-2"]));
										$today = ($phone['msrp']-($phone['instant'.$pricing_level.'-1']+$phone['instant'.$pricing_level.'-2']));
										$today_subtotal += $today;
										$tomorrow = ($today-($item['product_mir1']+$item['product_mir2']));
										$tomorrow_subtotal += $tomorrow;
										if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
											// No price = "FREE"
											$div_total_label = 'Your Price*';
											$div_total = '<font color="#FF0000">FREE</font>';
										}elseif ($price < -.02){
											// You MAKE money
											$div_total_label = '<font color="#FF0000"><span id="pulse">You Make*</span></font>';
											$div_total = '<font color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
										}else{
											// If there is a price, show it with 2 decimal places
											$div_total_label = 'Your Price*';
											$div_total = '$'.sprintf('%.2f', $price);
										};
										?>
										<table width="170" border="0" cellspacing="0" cellpadding="0" class="bodyBlack" bgcolor="#DCEAFB">
										<tr bgcolor="#6E6E6E">
											<td colspan="2">
												<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bodyWhite">
												<tr>
													<td><img src="images/spacer.gif" alt="" width="2" height="1" border="0"><strong>Price</strong></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
										</tr>
										<tr>
											<td><strong>&nbsp;Regular Price</strong></td>
											<td align="right">$<? echo number_format($phone["msrp"], 2); ?>&nbsp;</td>
										</tr>
										<?
										// Instant rebate(s)
										if ($phone["instant".$pricing_level."-1"] != 0 || $phone["instant".$pricing_level."-2"] != 0){
											echo'
										<tr>
											<td><strong>&nbsp;Instant Savings'.iif($phone["instant".$pricing_level."-1"] != 0 && $phone["instant".$pricing_level."-2"] != 0, "s", "").'</strong></td>
											<td align="right">-$';echo sprintf("%.2f", ($phone["instant".$pricing_level."-1"]+$phone["instant".$pricing_level."-2"]));echo'&nbsp;</td>
										</tr>
											';
										}
										?>
										<?
										// Mail-in rebate(s)
										if ($phone["mail_in".$pricing_level."-1"] != 0 || $phone["mail_in".$pricing_level."-2"] != 0){
											echo'
										<tr>
											<td><strong>&nbsp;Mail-in Rebate'.iif($phone["mail_in".$pricing_level."-1"] != 0 && $phone["mail_in".$pricing_level."-2"] != 0, "s", "").'</strong></td>
											<td align="right">-$';echo sprintf("%.2f", ($phone["mail_in".$pricing_level."-1"]+$phone["mail_in".$pricing_level."-2"]));echo'&nbsp;</td>
										</tr>
											';
										}
										?>
										<tr>
											<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"></td>
										</tr>
										<tr>
											<td width="100%" colspan="2" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="100%" height="1" border="0"></td>
										</tr>
										<tr>
											<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"></td>
										</tr>
										<tr>
											<td><strong>&nbsp;<? echo $div_total_label ?></strong></td>
											<td align="right"><? echo $div_total; ?>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
										</tr>
										</table>
									</td>
								</tr>
									<?
									if ($counter < mysql_num_rows($rs_items)){
									?>
								<tr>
									<td colspan="4"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><img src="images/GrayDot.gif" alt="" width="670" height="1" border="0"><br></td>
								</tr>
									<?
									}
									?>
								</table>
							</td>
						</tr>
							<?
								}else{
									$query = "SELECT * FROM accessories WHERE product_id='".$item['product_id']."'";
//									$phones_ordered++;
									$rs_phone = mysql_query($query, $linkID);
									$phone = mysql_fetch_assoc($rs_phone);
									$mrc = 0;
//print_r($phone);
							?>
						<tr>
							<td>
								<table width="670" border="0" cellspacing="2">
								<tr>
									<?
									$split_label = explode("<br>",$phone["label"]);
									?>
									<td class="bodyBlack"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><strong><? echo $split_label[0]." ".$split_label[1]; ?></strong></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table width="670" border="0" cellspacing="3" cellpadding="0" class="bodyBlack">
								<tr>
									<td width="70" align="center" valign="top"><img src="images/phones/<? echo $phone["thumbnail"]; ?>" alt="" width="70" height="130" border="0"><br><a href="saveit.php?task=removephone&cargo=<? echo $item["record_id"] ?>" title="Remove This <? echo $phone["manufacturer"]." ".$phone["model"]; ?> From Your Cart" class="smallBlue" onClick="return verifyRemove();"><strong>Remove</strong></a></td>
									<td width="425" valign="top">
										<table width="425" border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
										<tr>
											<td><? echo $phone["description"]; ?></td>
										</tr>
										</table>
									</td>
									<td width="175" align="right" valign="bottom">
										<!-- price table -->
										<?
										$price = ($phone["msrp"]-($phone["instant".$pricing_level."-1"]+$phone["instant".$pricing_level."-2"]+$phone["mail_in".$pricing_level."-1"]+$phone["mail_in".$pricing_level."-2"]));
										$today = ($phone['msrp']-($phone['instant'.$pricing_level.'-1']+$phone['instant'.$pricing_level.'-2']));
										$today_subtotal += $today;
										$tomorrow = ($today-($item['product_mir1']+$item['product_mir2']));
										$tomorrow_subtotal += $tomorrow;
										if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
											// No price = "FREE"
											$div_total_label = 'Your Price*';
											$div_total = '<font color="#FF0000">FREE</font>';
										}elseif ($price < -.02){
											// You MAKE money
											$div_total_label = '<font color="#FF0000"><span id="pulse">You Make*</span></font>';
											$div_total = '<font color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
										}else{
											// If there is a price, show it with 2 decimal places
											$div_total_label = 'Your Price*';
											$div_total = '$'.sprintf('%.2f', $price);
										};
										?>
										<table width="170" border="0" cellspacing="0" cellpadding="0" class="bodyBlack" bgcolor="#DCEAFB">
										<tr bgcolor="#6E6E6E">
											<td colspan="2">
												<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bodyWhite">
												<tr>
													<td><img src="images/spacer.gif" alt="" width="2" height="1" border="0"><strong>Price</strong></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
										</tr>
										<tr>
											<td><strong>&nbsp;Regular Price</strong></td>
											<td align="right">$<? echo number_format($phone["msrp"], 2); ?>&nbsp;</td>
										</tr>
										<?
										// Instant rebate(s)
										if ($phone["instant".$pricing_level."-1"] != 0 || $phone["instant".$pricing_level."-2"] != 0){
											echo'
										<tr>
											<td><strong>&nbsp;Instant Savings'.iif($phone["instant".$pricing_level."-1"] != 0 && $phone["instant".$pricing_level."-2"] != 0, "s", "").'</strong></td>
											<td align="right">-$';echo sprintf("%.2f", ($phone["instant".$pricing_level."-1"]+$phone["instant".$pricing_level."-2"]));echo'&nbsp;</td>
										</tr>
											';
										}
										?>
										<?
										// Mail-in rebate(s)
										if ($phone["mail_in".$pricing_level."-1"] != 0 || $phone["mail_in".$pricing_level."-2"] != 0){
											echo'
										<tr>
											<td><strong>&nbsp;Mail-in Rebate'.iif($phone["mail_in".$pricing_level."-1"] != 0 && $phone["mail_in".$pricing_level."-2"] != 0, "s", "").'</strong></td>
											<td align="right">-$';echo sprintf("%.2f", ($phone["mail_in".$pricing_level."-1"]+$phone["mail_in".$pricing_level."-2"]));echo'&nbsp;</td>
										</tr>
											';
										}
										?>
										<tr>
											<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"></td>
										</tr>
										<tr>
											<td width="100%" colspan="2" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="100%" height="1" border="0"></td>
										</tr>
										<tr>
											<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"></td>
										</tr>
										<tr>
											<td><strong>&nbsp;<? echo $div_total_label ?></strong></td>
											<td align="right"><? echo $div_total; ?>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
										</tr>
										</table>
									</td>
								</tr>
									<?
									if ($counter < mysql_num_rows($rs_items)){
									?>
								<tr>
									<td colspan="4"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><img src="images/GrayDot.gif" alt="" width="670" height="1" border="0"><br></td>
								</tr>
									<?
									}
									?>
								</table>
							</td>
						</tr>
							<?
								}
							}
							?>
						</table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
				</tr>
				</table>
				<br>
				<script>
				// Verify that a plan was selected
				function validateConfirm(theForm){
					if (!theForm.accept_terms.checked){
						theForm.accept_terms.style.background="#FF0000";
						alert("You must agree with the Terms & Conditions to complete your order.");
						theForm.accept_terms.style.background="#DCEAFB";
						theForm.accept_terms.focus();
						return false;
					}
					return true;
				}
				// Functions for printing terms
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
				<?
//					$navigator_user_agent = (isset( $_SERVER['HTTP_USER_AGENT']))?strtolower($_SERVER['HTTP_USER_AGENT']):'';
//					if (stristr($navigator_user_agent, "msie")){
				?>
<!--					<form action="http://<? echo $site; ?>.visconnect.com/saveit.php" method="post" name="PushConfirm" id="PushConfirm" onSubmit="return validateConfirm(this);">-->
				<?
//					}else{
				?>
				<form action="saveit.php" method="post" name="PushConfirm" id="PushConfirm" onSubmit="return validateConfirm(this);">
				<?
//					}
				?>
				<table width="690" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td width="335" valign="top" class="smallBlack">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr bgcolor="#6E6E6E">
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bodyWhite">
								<tr>
									<td>&nbsp;<strong>Terms of Service</strong></td>
									<td align="right"><a href="javascript:PrintIFrame();" class="smallWhite"><strong>Print Terms</strong></a>&nbsp;&nbsp;<br><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;">
								<iframe src="include/SprintTerms.php" name="terms" id="terms" width="335" height="107" marginwidth="5" marginheight="5" align="top" scrolling="yes" frameborder="0"></iframe>
							</td>
						</tr>
						<tr>
							<td height="25" bgcolor="#DCEAFB" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;">
								<table border="0" cellspacing="0" cellpadding="2" class="bodyBlack">
								<tr>
									<td>&nbsp;&nbsp;<strong>I Agree to These Terms & Conditions.</strong></td>
									<td> <input type="checkbox" name="accept_terms" id="accept_terms" value="Yes"></td>
								</tr>
								</table>


<!--								&nbsp;&nbsp;<strong>I Agree to These Terms & Conditions.</strong> <input type="checkbox" name="accept_terms" id="accept_terms" value="Yes"><!--<font color="#FF0000"><sup>*(Check Here)</sup></font>-->
							</td>
						</tr>
						</table>
					</td>
					<td width="350" valign="top" class="bodyBlack">
						<table width="335" border="0" cellspacing="0" cellpadding="0" align="right" class="bodyBlack" bgcolor="#DCEAFB">
						<tr bgcolor="#6E6E6E">
							<td colspan="4">
								<table width="100%" border="0" cellspacing="0" cellpadding="2" class="bodyWhite">
								<tr>
									<td><img src="images/spacer.gif" alt="" width="2" height="1" border="0">&nbsp;<strong>Totals</strong></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
				<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
				<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
						</tr>
						<tr>
							<td>&nbsp;<strong>Subtotal (Items in Cart)</strong></td>
							<td align="right" class="bigBlack">$<? echo number_format($today_subtotal, 2); ?>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
						</tr>
						<tr>
							<td>&nbsp;<strong>Activation Fee</strong></td>
							<?
							if ($sprint_activation == 0){
								echo'
							<td align="right" class="bigBlack"><font color="#FF0000">Waived!</font>&nbsp;</td>
								';
							}else{
								echo'
							<td align="right" class="bigBlack">$'.sprintf('%.2f', ($sprint_activation * $phones_ordered)).'&nbsp;</td>
								';
							}
							?>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
						</tr>
						<tr>
							<td>&nbsp;<strong>Shipping & Handling (<? echo $sprint_shipping_method; ?>)</strong></td>
							<?
							if ($sprint_shipping_per == "phone" || $sprint_shipping_per == "device" || $sprint_shipping_per == "line"){
								$ship_total = $sprint_shipping * $phones_ordered;
							}elseif ($sprint_shipping_per == "order"){
								$ship_total = $sprint_shipping;
							}
							if ($ship_total == 0){
								echo'
							<td align="right" class="bigBlack"><font color="#FF0000">FREE!</font>&nbsp;</td>
								';
							}else{
								echo'
							<td align="right" class="bigBlack">$'.sprintf('%.2f', $ship_total).'&nbsp;</td>
								';
							}
							?>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"></td>
						</tr>
						<tr>
							<td width="100%" colspan="2" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="100%" height="1" border="0"></td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
						</tr>
						<tr>
							<td width="100%" colspan="2" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="100%" height="1" border="0"></td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="4" border="0"></td>
						</tr>
						<tr>
							<td class="bigBlack">&nbsp;<strong>Total (Plus Tax)</strong></td>
							<td align="right" class="bigBlack"><strong>$<? echo sprintf('%.2f', ($today_subtotal + ($sprint_activation * $phones_ordered) + $ship_total)); ?></strong>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
						</tr>
						<tr>
							<td>&nbsp;<strong>Mail-in Rebate(s)</strong></td>
							<?
							if (($today_subtotal - $tomorrow_subtotal) == 0){
								echo'
							<td align="right" class="bigBlack"><font color="#FF0000">NONE!</font>&nbsp;</td>
								';
							}else{
								echo'
							<td align="right" class="bigBlack">$'.sprintf('%.2f', ($today_subtotal - $tomorrow_subtotal)).'&nbsp;</td>
								';
							}
							?>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
						</tr>
						<tr>
							<td>&nbsp;<strong>Monthly Cost (Plus Tax)</strong></td>
							<td align="right" class="bigBlack">$<? echo number_format($mrc_total, 2); ?>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
						</tr>
						<tr>
							<td width="100%" colspan="2" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="100%" height="1" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<br>
						<input type="hidden" name="task" value="addconfirm">
						<input type="hidden" name="sid" value="<? echo $SID; ?>">
						<div align="center"><input type="image" src="images/SubmitOrderButton.gif"></div>
						</form>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><img src="images/InfoFooter.jpg" alt="" width="710" height="10" border="0"></td>
		</tr>
		</table>					
	</td>
</tr>
</table>

<!-- END Include summary.php -->
