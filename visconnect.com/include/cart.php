<!-- BEGIN Include cart.php -->

<!-- Verify Actions -->
<script>
// Verify that they really want to empty thier cart
function verifyEmpty(){
	return confirm("Are you sure you want to empty your cart?");
}
// Verify that they really want to remove this phone
function verifyRemove(){
	return confirm("Are you sure you want to remove this phone from your cart?");
}
</script>

<?
// Get the order items
$query = "SELECT * FROM order_items WHERE session_id = '$SID'";
$rs_order = mysql_query($query, $linkID);
//$order = mysql_fetch_assoc($rs_order);
//print_r($order);
?>

<!-- Shopping Cart box -->
<table width="200" border="0" cellspacing="0" cellpadding="0" align="right" bgcolor="#FFFFFF">
<tr>
	<td><img src="images/ShoppingCartHeader.jpg" alt="" width="200" height="25" border="0"></td>
</tr>
<tr>
	<td bgcolor="#FFFFFF" background="images/ShoppingCartBG.jpg" style="background-position:top; background-repeat:repeat-y;">
		<table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td>
			<?
			// Is the cart empty (no phones in it)?
//			$empty = true;
//			for ($counter=1; $counter <= 5; $counter++){
//				if ($order['phone'.$counter.'_id'] != "") $empty = false;
//			}
			// Yes
//			if ($empty){
			if (mysql_num_rows($rs_order) == false){
				echo'
				<br><div align="center" class="bodyBlack">Your Cart is Empty</div><br>
				';
			// No
			}else{
			?>
				<table width="190" border="0" cellspacing="5" cellpadding="0" align="center">
				<tr>
					<td align="center" class="bodyBlack">
						<img src="images/spacer.gif" alt="" width="1" height="5" border=""><br>Cart Contents:<br>
					</td>
				</tr>
				<tr>
					<td align="center"><img src="images/GrayDot.gif" alt="" width="190" height="1" border="0"><br></td>
				</tr>	
				<?
				$today_subtotal = 0;
				$tomorrow_subtotal = 0;
				$phones_ordered = 0;
				$mrc_total = 0;
				for ($counter=1; $counter <= mysql_num_rows($rs_order); $counter++){
					$order = mysql_fetch_assoc($rs_order);
					if ($order['phone_type'] == ""){ // Not a phone
						$query = "SELECT * FROM accessories WHERE product_id='".$order['product_id']."'";
					}else{
						$query = "SELECT * FROM phones WHERE product_id='".$order['product_id']."'";
						$phones_ordered++;
					}
					$rs_phone = mysql_query($query, $linkID);
					$phone = mysql_fetch_assoc($rs_phone);
					if ($phone["apply_gift_card"] == "T"){
						$gift_card_amount = $gift_card;
					}else{
						$gift_card_amount = 0;
					}
					$price = ($phone["msrp"]-($phone["instant".$pricing_level."-1"]+$phone["instant".$pricing_level."-2"]+$phone["mail_in".$pricing_level."-1"]+$phone["mail_in".$pricing_level."-2"]+$gift_card_amount));
//					if ($gift_card_amount > 0){
//						$price -= $gift_card;
//					}
					$today = ($order['product_msrp']-($order['product_ir1']+$order['product_ir2']));
					$today_subtotal += $today;
					$tomorrow = ($today-($order['product_mir1']+$order['product_mir2']));
					if ($gift_card_amount > 0){
						$tomorrow -= $gift_card_amount;
					}
					$tomorrow_subtotal += $tomorrow;
					if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
						// No price = "FREE"
						$div_total_label = 'Total*';
						$div_total = '<font color="#FF0000">FREE</font>';
					}elseif ($price < -.02){
						// You MAKE money
						$div_total_label = '<font color="#FF0000"><span id="pulse">for You*</span></font>';
						$div_total = '<font color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
					}else{
						// If there is a price, show it with 2 decimal places
						$div_total_label = 'Total*';
						$div_total = '$'.sprintf('%.2f', $price);
					};
				?>
				<tr>
					<td valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center"><img src="images/phones/<? echo $phone["thumbnail"]; ?>" alt="<? echo $phone["manufacturer"]." ".$phone["model"]; ?>" title="<? echo $phone["manufacturer"]." ".$phone["model"]; ?>" width="60" border="0"><br><a href="saveit.php?task=removephone&cargo=<? echo $order["record_id"] ?>" title="Remove This <? echo $phone["manufacturer"]." ".$phone["model"]; ?> From Your Cart" class="smallBlue" onClick="return verifyRemove();"><strong>Remove</strong></a></td>
							<td width="120" valign="top">
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td><strong><? echo $phone["model"]; ?><br>By <? echo $phone["manufacturer"]; ?></strong></td>
								</tr>
								<tr>
									<td>
										<br>
										<table width="110" border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
										<tr>
											<td align="right">$<? echo number_format($phone["msrp"], 2); ?></td>
											<td>&nbsp;Retail</td>
										</tr>
<!--										<tr>
											<td align="right">-$<? echo sprintf("%.2f", ($phone["instant".$pricing_level."-1"]+$phone["instant".$pricing_level."-2"])); ?></td>
											<td>&nbsp;instant savings</td>
										</tr>
-->				
										<?
										// Instant rebate(s)
										if ($phone["instant".$pricing_level."-1"] != 0 || $phone["instant".$pricing_level."-2"] != 0){
											echo'
										<tr>
											<td align="right">-$';echo sprintf("%.2f", ($phone["instant".$pricing_level."-1"]+$phone["instant".$pricing_level."-2"]));echo'</td>
											<td>&nbsp;Discount'.iif($phone["instant".$pricing_level."-1"] != 0 && $phone["instant".$pricing_level."-2"] != 0, "s", "").'</td>
										</tr>
											';
										}
										?>
										<?
										// Mail-in rebate(s)
										if ($phone["mail_in".$pricing_level."-1"] != 0 || $phone["mail_in".$pricing_level."-2"] != 0){
											echo'
										<tr>
											<td align="right">-$';echo sprintf("%.2f", ($phone["mail_in".$pricing_level."-1"]+$phone["mail_in".$pricing_level."-2"]));echo'</td>
											<td>&nbsp;mail-in rebate'.iif($phone["mail_in".$pricing_level."-1"] != 0 && $phone["mail_in".$pricing_level."-2"] != 0, "s", "").'</td>
										</tr>
											';
										}
										?>
										<?
										// Gift Card
										if ($gift_card_amount > 0){
											echo'
										<tr>
											<td align="right">-$';echo sprintf("%.2f", ($gift_card));echo'</td>
											<td>&nbsp;Gift Card</td>
										</tr>
											';
										}
										?>
										<tr>
											<td width="100%" colspan="2" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="100%" height="1" border="0"></td>
										</tr>
										<tr>
											<td align="right"><strong><? echo $div_total; ?></strong></td>
											<td>&nbsp;<? echo $div_total_label ?></td>
										</tr>
										<tr>
											<td colspan="2">
												<br>
												<?
												// If no instant rebate(s), then add a blank line for spacing
												if ($phone["instant".$pricing_level."-1"] == 0 && $phone["instant".$pricing_level."-2"] == 0) echo'<br>';
												?>
												<?
												// If no mail-in rebate(s), then add a blank line for spacing
												if ($phone["mail_in".$pricing_level."-1"] == 0 && $phone["mail_in".$pricing_level."-2"] == 0) echo'<br>';
												?>
												<table width="120" border="0" cellspacing="0" cellpadding="0" align="left" class="bodyBlack">
												<tr>
													<td width="75" align="right"><nobr>Due Today:&nbsp;</nobr></td>
													<td width="45" align="right"><strong>$<? echo sprintf('%.2f', $today); ?></strong></td>
												</tr>
												<?
												if ($order['phone_type'] != ""){ // It's a phone
													echo'
												<tr>
													<td align="right">Activation:&nbsp;</td>
													<td align="right"><strong>$'.sprintf('%.2f', $sprint_activation).'</strong></td>
												</tr>
													';
												}
												?>
												</table>									
											</td>
										</tr>
										</table>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<?
						if ($order['voice_plan_id'] != "" || $order['data_plan_id'] != "" || $order['smartphone_plan_id'] != "" || $order['blackberry_plan_id'] != ""){
						$mrc = 0;
						?>
						<tr>
							<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr bgcolor="#6E6E6E" class="smallWhite">
							<td colspan="2" align="center"><strong>Plans & Options Selected</strong></td>
						</tr>
							<?
							if ($order['voice_plan_id'] != ""){
							?>
						<tr bgcolor="#DCEAFB">
							<td colspan="2" align="center">
								<table width="170" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td width="125" class="tinyBlack"><? echo $order['voice_plan_name']; ?></td>
									<td width="5"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
								<?
								$query = "SELECT * FROM plans WHERE plan_id='".$order['voice_plan_id']."'";
								$rs_plan = mysql_query($query, $linkID);
								$plan = mysql_fetch_assoc($rs_plan);
								if ($plan['discountable'] == "T"){
								?>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', ($order["voice_plan_cost"]-($order["voice_plan_cost"]*($sprint_discount*.01)))); ?></strong></td>
								<?
									$mrc += $order["voice_plan_cost"]-($order["voice_plan_cost"]*($sprint_discount*.01));
								}else{
								?>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', ($order["voice_plan_cost"])); ?></strong></td>
								<?
									$mrc += $order["voice_plan_cost"];
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
							if ($order['data_plan_id'] != ""){
							?>
						<tr bgcolor="#DCEAFB">
							<td colspan="2" align="center">
								<table width="170" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td width="125" class="tinyBlack"><? echo $order['data_plan_name']; ?></td>
									<td width="5"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
								<?
								$query = "SELECT * FROM plans WHERE plan_id='".$order['data_plan_id']."'";
								$rs_plan = mysql_query($query, $linkID);
								$plan = mysql_fetch_assoc($rs_plan);
								if ($plan['discountable'] == "T"){
								?>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', ($order["data_plan_cost"]-($order["data_plan_cost"]*($sprint_discount*.01)))); ?></strong></td>
								<?
									$mrc += $order["data_plan_cost"]-($order["data_plan_cost"]*($sprint_discount*.01));
								}else{
								?>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', ($order["data_plan_cost"])); ?></strong></td>
								<?
									$mrc += $order["data_plan_cost"];
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
							if ($order['smartphone_plan_id'] != ""){
							?>
						<tr bgcolor="#DCEAFB">
							<td colspan="2" align="center">
								<table width="170" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td width="125" class="tinyBlack"><? echo $order['smartphone_plan_name']; ?></td>
									<td width="5"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
								<?
								$query = "SELECT * FROM plans WHERE plan_id='".$order['smartphone_plan_id']."'";
								$rs_plan = mysql_query($query, $linkID);
								$plan = mysql_fetch_assoc($rs_plan);
								if ($plan['discountable'] == "T"){
								?>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', ($order["smartphone_plan_cost"]-($order["smartphone_plan_cost"]*($sprint_discount*.01)))); ?></strong></td>
								<?
									$mrc += $order["smartphone_plan_cost"]-($order["smartphone_plan_cost"]*($sprint_discount*.01));
								}else{
								?>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', ($order["smartphone_plan_cost"])); ?></strong></td>
								<?
									$mrc += $order["smartphone_plan_cost"];
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
							if ($order['blackberry_plan_id'] != ""){
							?>
						<tr bgcolor="#DCEAFB">
							<td colspan="2" align="center">
								<table width="170" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td width="125" class="tinyBlack"><? echo $order['blackberry_plan_name']; ?></td>
									<td width="5"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
								<?
								$query = "SELECT * FROM plans WHERE plan_id='".$order['blackberry_plan_id']."'";
								$rs_plan = mysql_query($query, $linkID);
								$plan = mysql_fetch_assoc($rs_plan);
								if ($plan['discountable'] == "T"){
								?>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', ($order["blackberry_plan_cost"]-($order["blackberry_plan_cost"]*($sprint_discount*.01)))); ?></strong></td>
								<?
									$mrc += $order["blackberry_plan_cost"]-($order["blackberry_plan_cost"]*($sprint_discount*.01));
								}else{
								?>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', ($order["blackberry_plan_cost"])); ?></strong></td>
								<?
									$mrc += $order["blackberry_plan_cost"];
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
							if ($order['aircard_protection'] > 0){
							// NEED A MUCH BETTER WAY OF HANDLING OPTIONS THAN HARD CODING THEM!
							?>
						<tr bgcolor="#DCEAFB">
							<td colspan="2" align="center">
								<table width="170" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td width="125" class="tinyBlack">Total Equipment Protection</td>
									<td width="5"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', ($order["aircard_protection"])); ?></strong></td>
								</tr>
								</table>
							</td>
						</tr>
							<?
								$mrc += $order["aircard_protection"];
							}
							?>
						<tr bgcolor="#DCEAFB">
							<td colspan="2" align="center" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
						</tr>
						<tr bgcolor="#DCEAFB">
							<td colspan="2" align="center">
								<table width="170" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td width="128" align="right">Total Monthly Cost:</td>
									<td width="2"><img src="images/spacer.gif" alt="" width="2" height="1" border="0"></td>
									<td width="40" align="right" valign="top"><strong>$<? echo money_format('%i', $mrc); ?></strong></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><a href="?sec=checkout&sid=<? echo $SID; ?>&cargo=<? echo $order["record_id"] ?>" title="Change Plans & Options for this Device" class="smallBlue"><strong>Change Plans & Options</strong></a></td>
						</tr>
						<?
							$mrc_total += $mrc;
						}
						?>
						<tr>
							<td colspan="2" align="center"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><img src="images/GrayDot.gif" alt="" width="190" height="1" border="0"><br></td>
						</tr>	
						</table>
					</td>
				</tr>
				<?
//					}
				}
				?>
				<tr>
					<td>
						<table width="185" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr>
							<td width="135" align="right">Cart Subtotal:&nbsp;</td>
							<td width="50" align="right"><strong>$<? echo sprintf('%.2f', $today_subtotal); ?></strong></td>						
						</tr>
						<tr>
							<td align="right">Activation Fee:&nbsp;</td>
							<td align="right"><strong>$<? echo sprintf('%.2f', ($sprint_activation * $phones_ordered)); ?></strong></td>						
						</tr>
						<tr>
							<td align="right">Shipping & Handling:&nbsp;<!--<br><span class="tinyBlack">(<? echo $sprint_shipping_method.", $".sprintf('%.2f', $sprint_shipping)." per ".$sprint_shipping_per; ?>)&nbsp;</span>--></td>
							<?
							if ($sprint_shipping_per == "phone" || $sprint_shipping_per == "device" || $sprint_shipping_per == "line"){
								$ship_total = $sprint_shipping * $phones_ordered;
							}elseif ($sprint_shipping_per == "order"){
								$ship_total = $sprint_shipping;
							}
							?>
							<td align="right" valign="top"><strong>$<? echo sprintf('%.2f', $ship_total); ?></strong></td>						
						</tr>
						</table>					
					</td>
				</tr>
				<tr>
					<td align="center"><img src="images/GrayDot.gif" alt="" width="190" height="1" border="0"><br></td>
				</tr>	
				<tr>
					<td>
						<table width="185" border="0" cellspacing="0" cellpadding="0" class="bigBlack">
						<tr>
							<td align="right">Total (+Tax):&nbsp;</td>
							<td align="right"><strong>$<? echo sprintf('%.2f', ($today_subtotal + ($sprint_activation * $phones_ordered) + $ship_total)); ?></strong></td>						
						</tr>
						</table>
					</td>
				</tr>
				<?
				if ($today_subtotal - $tomorrow_subtotal != 0){
				?>
				<tr>
					<td>
						<table width="185" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr>
							<td width="130" align="right">Rebates/Gift Cards:&nbsp;</td>
							<td width="55" align="right"><font color="#FF0000"><strong>$<? echo sprintf('%.2f', ($today_subtotal - $tomorrow_subtotal)); ?></strong></font></td>						
						</tr>
						</table>
					</td>
				</tr>
				<?
				}
				?>
				<tr>
					<td>
						<table width="185" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<tr>
							<td width="130" align="right">Monthly Cost (+Tax):&nbsp;</td>
							<td width="55" align="right"><strong>$<? echo sprintf('%.2f', $mrc_total); ?></strong></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center"><br><? echo iif($sec != "checkout" && $sec != "summary", '<a href="https://secure.nr.net/'.strtolower($host[2]).'/?sec=checkout&sid='.$SID.'&site='.$_SESSION['site'].'">', ''); ?><img src="images/CheckoutButton.gif" alt="Pick Your Plan and Check Out" width="125" height="30" border="0"></a></td>
				</tr>
				<tr>
					<td align="center"><a href="saveit.php?task=empty&cargo=<? echo $sec; ?>&site=<? echo $site; ?>" class="smallBlue" title="Empty the Entire Contents of Your Cart" onClick="return verifyEmpty();"><strong>Empty Cart</strong></a></td>
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
<tr>
	<td><img src="images/ShoppingCartFooter.jpg" alt="" width="200" height="10" border="0"></td>
</tr>
<tr>
	<td align="right">
		<br>
		<a href="<? echo$_SERVER['REQUEST_URI']; ?>#top" onclick="popAd('GiftCardPromo')" onmouseover=" window.status='Click Here For More Information'; return true" onmouseout="window.status=''; return true" title="Click Here For More Information"><img src="images/GiftCardPromo50.jpg" alt="Click Here For More Information" title="Click Here For More Information" width="200" height="105" border="0"></a>
	</td>
</tr>
<tr>
	<td align="right">
		<br>
		<a href="<? echo$_SERVER['REQUEST_URI']; ?>#top" onclick="show('Discount')" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" title="Sprint's Corporate Discount Center"><img src="images/MRCDiscountPromo.jpg" alt="Apple Employee Sprint Service Discount" title="Apple Employee Sprint Service Discount" width="200" height="140" border="0"></a>
	</td>
</tr>
</table>					
				
<!-- END Include cart.php -->
