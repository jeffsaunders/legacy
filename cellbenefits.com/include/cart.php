<?
//Grab it again after inserting or updating
$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
$rs_cart = mysql_query($query, $linkID);
if (mysql_num_rows($rs_cart) == 0) $message = "Cart Empty";
?>

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

<!-- Display cart contents here -->
<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Shopping Cart</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
<!--	<td colspan="2" bgcolor="#FFFFFF"><img src="images/spacer.gif" alt="" width="930" height="400" border="0"></td>-->
	<td colspan="2" align="center">
		<?
		if ($message != ""){
			$message = str_replace('±', '&amp;', $message);
			echo '
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid '.$border_color.'; border-right: 1px solid '.$border_color.';">
		<tr>
			<td align="center" class="bigBlack"><br><strong>'.$message.'</strong></td>
		</tr>
		</table>
			';
		}
		?>
		<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<tr>
			<td width="930" height="15">
				<br>
				<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="border<? echo $carrier_label; ?>">
				<tr bgcolor="<? echo $box_color; ?>" class="bodyWhite">
					<td width="500" align="center">Item</td>
					<td width="200" align="center">Price</td>
					<td width="100" align="center">Due Today</td>
					<td width="100" align="center">After Rebates</td>
				</tr>
				<?
				$row = mysql_fetch_assoc($rs_cart);
				$today_subtotal = 0;
				$tomorrow_subtotal = 0;
				$phones_ordered = 0;
				for ($counter=1; $counter <= 5; $counter++){
					if ($row['phone'.$counter.'_id'] != ""){
						$query = "SELECT * FROM phones WHERE product_id='".$row['phone'.$counter.'_id']."'";
						$rs_phone = mysql_query($query, $linkID);
						$phone = mysql_fetch_assoc($rs_phone);
						echo'
				<tr>
					<td>
						<table border="0" class="borderWhite">
						<tr>
							<td><img src="images/'.$row["carrier"].'Logo.gif" alt="" width="100" height="40" border="0"></td>
							<td class="bodyBlack">'.$phone["label"].'<br></td>
						</tr>
						<tr>
							<td rowspan="2"><img src="images/phones/'.$phone["thumbnail"].'" alt="" width="70" height="130" border="0"></td>
							<td width="375" valign="top" class="smallBlack">'.$phone["description"].'</td>
						</tr>
						<tr>
							<td align="right" valign="bottom" class="smallBlack"><a href="/saveit.php?task=removephone&cargo='.$counter.'" class="smallBlack" onClick="return verifyRemove();"><strong>Remove This Phone</strong></a></td>
						</tr>
						</table>
					</td>
						';
				// Build a text string, with formatting, for the final sale price.
				$price = ($row['phone'.$counter.'_msrp']-($row['phone'.$counter.'_ir1']+$row['phone'.$counter.'_ir2']+$row['phone'.$counter.'_mir1']+$row['phone'.$counter.'_mir2']));
				// Yahoo AT&T Gift Cards
//				if ($cingular_site == "T" && $site == "yahoo"){
				if ($gift_card > 0){
					$price -= $gift_card;
				}
				$today = ($row['phone'.$counter.'_msrp']-($row['phone'.$counter.'_ir1']+$row['phone'.$counter.'_ir2']));
				$today_subtotal += $today;
				$tomorrow = ($today-($row['phone'.$counter.'_mir1']+$row['phone'.$counter.'_mir2']));
				// Yahoo AT&T Gift Cards
//				if ($cingular_site == "T" && $site == "yahoo"){
				if ($gift_card > 0){
					$tomorrow -= $gift_card;
				}
				$tomorrow_subtotal += $tomorrow;
				$phones_ordered++;
				if ($price < 0){
					// You MAKE money
					$total_label = '<font color="#FF0000">in your pocket*</font>';
					$total = '<font color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
				}else{
					// If there is a price, show it with 2 decimal places
					$total_label = 'your price*';
					$total = '$'.sprintf('%.2f', $price);
					$total_today = '$'.sprintf('%.2f', $today);
					$total_tomorrow = '$'.sprintf('%.2f', $tomorrow);
				};
				if ($today < 0){
					$total_today = '<font color="#FF0000">$'.sprintf('%.2f', $today).'</font>';
				}else{
					$total_today = '$'.sprintf('%.2f', $today);
				}
				if ($tomorrow < 0){
					$total_tomorrow = '<font color="#FF0000">$'.sprintf('%.2f', $tomorrow).'</font>';
				}else{
					$total_tomorrow = '$'.sprintf('%.2f', $tomorrow);
				}
						echo '
					<td align="center" valign="bottom">
						<table width="175" border="0" cellspacing="1" cellpadding="0" class="borderWhite">
						<tr class="bodyBlack">
							<td align="right">$'.$row['phone'.$counter.'_msrp'].'</td>
							<td>&nbsp;regular price</td>
						</tr>
						';
				if ($row['phone'.$counter.'_ir1'] != 0 || $row['phone'.$counter.'_ir2'] != 0){
						echo'
						<tr class="bodyBlack">
							<td align="right">-$';echo sprintf("%.2f", ($row['phone'.$counter.'_ir1']+$row['phone'.$counter.'_ir2']));echo'</td>
							<td>&nbsp;instant savings</td>
						</tr>
						';
				}
				// If there are any mail-in rebates....
				if ($row['phone'.$counter.'_mir1'] != 0 || $row['phone'.$counter.'_mir2'] != 0){
						echo'
						<tr class="bodyBlack">
							<td align="right">-$';echo sprintf("%.2f", ($row['phone'.$counter.'_mir1']+$row['phone'.$counter.'_mir2']));echo'</td>
							<td>&nbsp;mail-in rebate'.iif($row['phone'.$counter.'_mir1'] != 0 && $row['phone'.$counter.'_mir2'] != 0, "s", "").'</td>
						</tr>
						';
				}
//				if ($cingular_site == "T" && $site == "yahoo"){
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
						<table width="65" border="0" cellspacing="1" cellpadding="0" class="borderWhite">
<!--						<tr class="bodyBlack">
							<td align="right">$'.$row['phone'.$counter.'_msrp'].'</td>
						</tr>
						<tr class="bodyBlack">
							<td align="right">-$';echo sprintf("%.2f", ($row['phone'.$counter.'_ir1']+$row['phone'.$counter.'_ir2']));echo'</td>
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
					<td align="center" valign="bottom">
						<table width="65" border="0" cellspacing="1" cellpadding="0" class="borderWhite">
<!--						<tr class="bodyBlack">
							<td align="right">-$';echo sprintf("%.2f", ($today));echo'</td>
						</tr>
						<tr class="bodyBlack">
							<td align="right">-$';echo sprintf("%.2f", ($row['phone'.$counter.'_mir1']+$row['phone'.$counter.'_mir2']));echo'</td>
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
				</tr>		
						';
					}
				}
				?>
				</table>
				<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td width="400" rowspan="6">
						<table width="250" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="right"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br><a href="?sec=phones"><img src="images/AddPhoneCartButton<? echo $carrier_label; ?>.gif" alt="" width="200" height="26" border="0"></a><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td align="right"><a href="/saveit.php?task=empty" onClick="return verifyEmpty();"><img src="images/EmptyCartButton<? echo $carrier_label; ?>.gif" alt="" width="200" height="26" border="0"></a><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
						<?
						if ($phones_ordered > 0){
							echo'
<!--							<td align="right"><a href="https://secure.nr.net/'.strtolower($host[2]).'/?sec=checkout&sid='.$SID.'&site='.$_SESSION['site'].'&first=no"><img src="images/CheckoutCartButton'.$carrier_label.'.gif" alt="" width="200" height="26" border="0"></a></td>-->
							<td align="right"><a href="/?sec=checkout&sid='.$SID.'&site='.$_SESSION['site'].'&first=no"><img src="images/CheckoutCartButton'.$carrier_label.'.gif" alt="" width="200" height="26" border="0"></a></td>
							';
						}else{
							echo'
							<td align="right"><img src="images/CheckoutCartButtonOff'.$carrier_label.'.gif" alt="" width="200" height="26" border="0"></td>
							';
						}
						?>
						</tr>
						</table>
					</td>
					<td width="350" align="right" class="bodyBlack"><strong>Subtotal:&nbsp;</strong></td>
					<td valign="top">
<!--						<table width="204" border="0" cellspacing="0" cellpadding="0" align="right" bordercolor="#58639B" class="bodyBlack">-->
						<table width="204" border="0" cellspacing="0" cellpadding="0" align="right" class="border<? echo $carrier_label; ?>" style="border-top: 0px solid;">
						<tr>
<!--							<td width="50%" height="25" align="center" style="border-left: 2px solid; border-bottom: 2px solid; border-right: 1px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid; border-bottom: 0px solid;">
								<table width="65" border="0" cellspacing="0" cellpadding="0" class="borderWhite">
								<tr class="bodyBlack">
									<td align="right">
									<?
									if ($today_subtotal < 0){
										echo '<font color="#FF0000">$'.sprintf('%.2f', $today_subtotal).'</font>';
									}else{
										echo '$'.sprintf('%.2f', $today_subtotal);
									}
									?>
									</td>
								</tr>
								</table>
							</td>
<!--							<td width="50%" align="center" style="border-left: 1px solid; border-bottom: 2px solid; border-right: 2px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid; border-bottom: 0px solid;">
								<table width="65" border="0" cellspacing="0" cellpadding="0" class="borderWhite">
								<tr class="bodyBlack">
									<td align="right">
									<?
									if ($tomorrow_subtotal < 0){
										echo '<font color="#FF0000">$'.sprintf('%.2f', $tomorrow_subtotal).'</font>';
									}else{
										echo '$'.sprintf('%.2f', $tomorrow_subtotal);
									}
									?>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>				
				</tr>
				<tr>
<?
if ($site == "apple"){
	$act_fee_label = "Activation Fee";
}else{
	$act_fee_label = "One-Time Activation Fee ($".sprintf('%.2f', $activation_fee)." per Line)";
}
?>

					<td align="right" class="bodyBlack"><strong><? echo $act_fee_label; ?>:&nbsp;</strong></td>
					<td valign="top">
						<table width="204" border="0" cellspacing="0" cellpadding="0" align="right" class="border<? echo $carrier_label; ?>">
						<tr>
<!--							<td width="50%" height="25" align="center" style="border-left: 2px solid; border-bottom: 2px solid; border-right: 1px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid; border-bottom: 0px solid;">
								<table width="65" border="0" cellspacing="0" cellpadding="0" class="borderWhite">
								<tr class="bodyBlack">
									<td align="right">
									<?
										$act_fee = ($phones_ordered * $activation_fee);
										if ($act_fee == 0){
											echo '<div align="center"><font color="#FF0000">Waived</font></div>';
										}else{
											echo '$'.sprintf('%.2f', $act_fee);
										}
									?>
									</td>
								</tr>
								</table>
							</td>
<!--							<td width="50%" align="center" style="border-left: 1px solid; border-bottom: 2px solid; border-right: 2px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid; border-bottom: 0px solid;">
								<table width="65" border="0" cellspacing="0" cellpadding="0" class="borderWhite">
								<tr class="bodyBlack">
									<td align="right">
									<?
										$act_fee = ($phones_ordered * $activation_fee);
										if ($act_fee == 0){
											echo '<div align="center"><font color="#FF0000">Waived</font></div>';
										}else{
											echo '$'.sprintf('%.2f', $act_fee);
										}
									?>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>				
				</tr>
<!--				<tr>
					<td align="right" class="bodyBlack"><strong>Activation Fee Discount($36 per Line):&nbsp;</strong></td>
					<td>
						<table width="204" border="0" cellspacing="0" cellpadding="0" align="right" class="border<? echo $carrier_label; ?>">
						<tr>
							<td width="50%" align="center" style="border-left: 2px solid; border-bottom: 2px solid; border-right: 1px solid;">
								<table width="65" border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
								<tr>
									<td align="right">
									<?
//										$act_disc = ($phones_ordered * -36);  // $36 per line
//										echo '<font color="#FF0000"><nobr>$'.sprintf('%.2f', $act_disc).'</nobr></font>';
									?>
									</td>
								</tr>
								</table>
							</td>
							<td width="50%" align="center" style="border-left: 1px solid; border-bottom: 2px solid; border-right: 2px solid;">
								<table width="65" border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
								<tr>
									<td align="right">
									<strong>
									<?
//										$act_disc = ($phones_ordered * -36);  // $36 per line
//										echo '<font color="#FF0000"><nobr>$'.sprintf('%.2f', $act_disc).'</nobr></font>';
									?>
									</strong>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>				
				</tr>-->
				<tr>
					<td align="right" class="bodyBlack"><strong>Shipping &amp; Handling:&nbsp;</strong></td>
					<td valign="top">
						<table width="204" border="0" cellspacing="0" cellpadding="0" align="right" class="border<? echo $carrier_label; ?>">
						<tr>
<!--							<td width="50%" height="25" align="center" style="border-left: 2px solid; border-bottom: 2px solid; border-right: 1px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid; border-bottom: 0px solid;">
								<table width="65" border="0" cellspacing="0" cellpadding="0" class="borderWhite">
								<tr class="bodyBlack">
									<td align="center">
										<?// echo '$'.sprintf('%.2f', $[shipping cost]); ?>
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
								</table>
							</td>
<!--							<td width="50%" align="center" style="border-left: 1px solid; border-bottom: 2px solid; border-right: 2px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid; border-bottom: 0px solid;">
								<table width="65" border="0" cellspacing="0" cellpadding="0" class="borderWhite">
								<tr class="bodyBlack">
									<td align="center">
										<?// echo '$'.sprintf('%.2f', $[shipping cost]); ?>
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
								</table>
							</td>
						</tr>
						</table>
					</td>				
				</tr>
				<tr>
					<td align="right" class="bodyBlack"><strong>Taxes:&nbsp;</strong></td>
					<td valign="top">
						<table width="204" border="0" cellspacing="0" cellpadding="0" align="right" class="border<? echo $carrier_label; ?>">
						<tr>
<!--							<td width="50%" height="25" align="center" style="border-left: 2px solid; border-bottom: 2px solid; border-right: 1px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid; border-bottom: 0px solid;">
								<table width="65" border="0" cellspacing="1" cellpadding="0" class="borderWhite">
								<tr class="bodyBlack">
									<td align="center">
										<?// echo '$'.sprintf('%.2f', $[taxes]); ?>
										TBD
									</td>
								</tr>
								</table>
							</td>
<!--							<td width="50%" align="center" style="border-left: 1px solid; border-bottom: 2px solid; border-right: 2px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid; border-bottom: 0px solid;">
								<table width="65" border="0" cellspacing="1" cellpadding="0" class="borderWhite">
								<tr class="bodyBlack">
									<td align="center">
										<?// echo '$'.sprintf('%.2f', $[taxes]); ?>
										TBD
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>				
				</tr>
				<tr>
					<td align="right" class="bigBlack"><strong>Total:&nbsp;</strong></td>
					<td valign="top">
						<table width="204" border="0" cellspacing="0" cellpadding="0" align="right" class="border<? echo $carrier_label; ?>">
						<tr>
<!--							<td width="50%" height="25" align="center" style="border-left: 2px solid; border-bottom: 2px solid; border-right: 1px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid;">
								<table width="65" border="0" cellspacing="1" cellpadding="0" class="borderWhite">
								<tr class="bigBlack">
									<td align="right">
									<strong>
									<?
									$today_total = $today_subtotal + $act_fee + $act_disc;
									if ($today_total < 0){
										echo '<font color="#FF0000">$'.sprintf('%.2f', $today_total).'</font>';
									}else{
										echo '$'.sprintf('%.2f', $today_total);
									}
									?>
									</strong>
									</td>
								</tr>
								</table>
							</td>
<!--							<td width="50%" align="center" style="border-left: 1px solid; border-bottom: 2px solid; border-right: 2px solid;">-->
							<td width="50%" align="center" style="border-top: 0px solid;">
								<table width="65" border="0" cellspacing="1" cellpadding="0" class="borderWhite">
								<tr class="bigBlack">
									<td align="right">
									<strong>
									<?
									$tomorrow_total = $tomorrow_subtotal + $act_fee + $act_disc;
									if ($tomorrow_total < 0){
										echo '<font color="#FF0000">$'.sprintf('%.2f', $tomorrow_total).'</font>';
									}else{
										echo '$'.sprintf('%.2f', $tomorrow_total);
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
				<br>
			</td>
		</tr>
		</table>
	</td>
</tr>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<!-- END Include cart.php -->
