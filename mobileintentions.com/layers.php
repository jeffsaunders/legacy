<!-- Layers/Pop Up ads -->

<!-- BEGIN Free Activation Promo -->
<div id="FreeActivation" style="position:absolute;top:-450;z-index:1">
<table width="760" border="0" cellspacing="5" cellpadding="0" bgcolor="#000000">
<tr>
	<td>
		<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td height="25" colspan="2" align="right" background="images/HeaderBar.jpg"><a href="javascript:void(0)" onclick="hideAd('FreeActivation')"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"></a></td>
		</tr>
		<tr>
			<td colspan="2"><img src="images/promos/PromoFreeActivation.jpg" alt="" width="750" height="375" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<script type="text/javascript">
if (document.layers) document.layers.FreeActivation.left = ((window.innerWidth / 2) - (760 / 2)); //Mozilla
else if (document.all) document.all.FreeActivation.style.left = ((document.body.offsetWidth / 2) - (760 / 2));  //IE
else if (document.getElementById) document.getElementById("FreeActivation").style.left = ((window.innerWidth / 2) - (760 / 2));
</script>
<!-- END Free Activation Promo -->


<!-- BEGIN Back To School Promo -->
<div id="BackToSchool" style="position:absolute;top:-450;">
<table width="760" border="0" cellspacing="5" cellpadding="0" bgcolor="#000000">
<tr>
	<td>
		<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td height="25" colspan="2" align="right" background="images/HeaderBar.jpg"><a href="javascript:void(0)" onclick="hideAd('BackToSchool')"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"></a></td>
		</tr>
		<tr>
			<td colspan="2"><img src="images/promos/BackToSchoolHeader.jpg" alt="" width="750" height="50" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="750" height="1" border="0"></td>
		</tr>
		<tr>
			<td><img src="images/promos/1000Minutes.gif" alt="" width="350" height="300" border="0"></td>
			<td>
				<table width="400" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" bgcolor="#EFEDEE">
						<table width="225" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" class="bigBlack"><br><strong>Get up to five phones for<br><font size="+2" color="#ED008C">FREE!</font></strong></td>
						</tr>
						<tr>
							<td align="center" class="bodyBlack"><br><strong>... Like the Best Selling</strong></td>
						</tr>
						<tr>
							<td align="center" class="bodyBlack">
								<?
								// Grab phone info
								$query = "SELECT
											product_id,
											manufacturer,
											model,
											bullet1,
											bullet2,
											bullet3,
											msrp,
											instant1,
											instant2,
											mail_in
											FROM phones
											WHERE product_id = 248
											";
								$result = mysql_query($query, $linkID);
								$row = mysql_fetch_assoc($result);
								echo'
								<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="xbigBlack">
										<strong>'.$row["manufacturer"].' '.$row["model"].'</strong>
									</td>
								</tr>
								<!-- Bullet point features -->
								<tr>
									<td align="center" valign="top">
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
										<table border="0" cellspacing="0" cellpadding="0" class="smallBlack">
										<tr>
											<td><li><em>'.$row["bullet1"].'</em></td>
										</tr>
										<tr>
											<td><li><em>'.$row["bullet2"].'</em></td>
										</tr>
										<tr>
											<td><li><em>'.$row["bullet3"].'</em></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									</td>
								</tr>
								<tr>
									<td align="center" valign="top">
										<!-- Display price breakdown table -->
										<table width="150" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
										<tr>
											<td><strong>Suggested Retail</strong></td>
											<td align="right"><font color="#008000">$'.$row["msrp"].'</font></td>
										</tr>
								';
								// Build a text tring, with formatting, for the final sale price.
								$price = ($row["msrp"]-($row["instant1"]+$row["instant2"]+$row["mail_in"]));
								if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
									// No price = "FREE"
									$total_label = 'Your Price*';
									$total = '<font size="2" color="#FF0000">FREE</font>';
								}elseif ($price < -.02){
									// You MAKE money
									$total_label = '<font color="#FF0000"><span id="pulse">You Pocket*</span></font>';
									$total = '<font size="2" color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
								}else{
									// If there is a price, show it with 2 decimal places
									$total_label = 'Your Price*';
									$total = '<font size="2" color="#FF0000">$'.sprintf('%.2f', $price).'</font>';
								};
								// Determine if there is a mail-in rebate for this phone.
								// If there is, add both instant rebates together and display the amount as a single instant rebate.
								// Otherwise, display each intant rebate on its own line, so there are always 2 rebates showing.
								if ($row["mail_in"] != 0){ //There's a mail-in rebate
									echo'
										<tr>
											<td><strong>Instant Rebates</strong></td>
											<td align="right">
												<font color="#008000">
												-$'.sprintf('%.2f', ($row["instant1"]+$row["instant2"])).' <!-- 2 Decimal Places -->
												</font>
											</td>
										</tr>
										<tr>
											<td><strong>T-Mobile Rebate</strong></td>
											<td align="right"><font color="#008000">-$'.$row["mail_in"].'</font></td>
										</tr>
									';
								}else{ //Show first instant rebate
									echo'
										<tr>
											<td><strong>Instant Rebate</strong></td>
											<td align="right"><font color="#008000">-$'.$row["instant1"].'</font></td>
										</tr>
									';
									if ($row["instant2"] != 0){ //There's a second instant rebate
										echo'	
										<tr>
											<td><strong>Instant Rebate</strong></td>
											<td align="right"><font color="#008000">-$'.$row["instant2"].'</font></td>
										</tr>
										';
									};
								};
								echo'
										<tr>
											<!-- Black line -->
											<td width="100%" height="1" colspan="2" bgcolor="#000000">
												<img src="images/spacer.gif" alt="" width="100%" height="1" border="0"><br>
											</td>
										</tr>
										<tr>
											<td><font size="2"><strong>'.$total_label.'</strong></font></td>
											<td align="right">
												<strong>'.$total.'</strong>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<!-- GO SECURE! -->
									<form action="https://secure.nr.net/mobileintentions/"> <!-- Outside of cell for IE formatting -->
									<td align="center">
								';
								if ($row["instant2"] == 0){ //No second instant rebate so add a spacer in its place
									echo'	
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									';
								};
								echo'
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
										<!-- Order Button -->
										<input type="image" src="images/OrderNow.gif" alt="Order your '.$row["manufacturer"].'&nbsp;'.$row["model"].' Now!" width="125" height="25" border="0">
										<input type="hidden" name="sec" value="order">
										<input type="hidden" name="prod" value="'.$row["product_id"].'">
<!--						<input type="hidden" name="zipcode" value="'.$zipcode.'">-->
									</td>
								</tr>
								</table>
								';
								?>
							</td>
						</tr>
						</table>
					</td>
					<td width="175" height="275" valign="top" background="images/promos/PromoPhone.jpg">
						<br><br>
						<table width="75" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" class="smallBlack">
								<strong>Now with<br>
								<font color="#FF0000">FREE Activation!</font></strong>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2"><img src="images/promos/JDPower.jpg" alt="" width="400" height="25" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25" colspan="2" bgcolor="#5B5B5B">
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="630" valign="bottom" class="smallWhite">&nbsp;&nbsp;&nbsp;*Limited-time offer; a two year agreement and activation of new/additional line of service for each phone required.</td>
					<td><img src="images/promos/RankedHighest.gif" alt="" width="120" height="24" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<script type="text/javascript">
if (document.layers) document.layers.BackToSchool.left = ((window.innerWidth / 2) - (760 / 2)); //Mozilla
else if (document.all) document.all.BackToSchool.style.left = ((document.body.offsetWidth / 2) - (760 / 2));  //IE
else if (document.getElementById) document.getElementById("BackToSchool").style.left = ((window.innerWidth / 2) - (760 / 2));
</script>

<!-- END Back To School Promo -->


<!-- BEGIN Get More 1000 Promo -->
<div id="GetMore1K" style="position:absolute;top:-450;">
<table width="760" border="0" cellspacing="5" cellpadding="0" bgcolor="#000000">
<tr>
	<td>
		<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td height="25" colspan="2" align="right" background="images/HeaderBar.jpg"><a href="javascript:void(0)" onclick="hideAd('GetMore1K')"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"></a></td>
		</tr>
		<tr>
			<td colspan="2"><img src="images/promos/GetMore1KHeader.jpg" alt="" width="750" height="50" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="750" height="1" border="0"></td>
		</tr>
		<tr>
			<td><img src="images/promos/1000Minutes2.gif" alt="" width="350" height="300" border="0"></td>
			<td>
				<table width="400" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" bgcolor="#EFEDEE">
						<table width="225" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" class="bigBlack"><br><strong>Most of our phones are<br><font size="+2" color="#ED008C">FREE!</font></strong></td>
						</tr>
						<tr>
							<td align="center" class="bodyBlack"><br><strong>... Like the Best Selling</strong></td>
						</tr>
						<tr>
							<td align="center" class="bodyBlack">
								<?
								// Grab phone info
								$query = "SELECT
											product_id,
											manufacturer,
											model,
											bullet1,
											bullet2,
											bullet3,
											msrp,
											instant1,
											instant2,
											mail_in
											FROM phones
											WHERE product_id = 248
											";
								$result = mysql_query($query, $linkID);
								$row = mysql_fetch_assoc($result);
								echo'
								<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="xbigBlack">
										<strong>'.$row["manufacturer"].' '.$row["model"].'</strong>
									</td>
								</tr>
								<!-- Bullet point features -->
								<tr>
									<td align="center" valign="top">
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
										<table border="0" cellspacing="0" cellpadding="0" class="smallBlack">
										<tr>
											<td><li><em>'.$row["bullet1"].'</em></td>
										</tr>
										<tr>
											<td><li><em>'.$row["bullet2"].'</em></td>
										</tr>
										<tr>
											<td><li><em>'.$row["bullet3"].'</em></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									</td>
								</tr>
								<tr>
									<td align="center" valign="top">
										<!-- Display price breakdown table -->
										<table width="150" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
										<tr>
											<td><strong>Suggested Retail</strong></td>
											<td align="right"><font color="#008000">$'.$row["msrp"].'</font></td>
										</tr>
								';
								// Build a text tring, with formatting, for the final sale price.
								$price = ($row["msrp"]-($row["instant1"]+$row["instant2"]+$row["mail_in"]));
								if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
									// No price = "FREE"
									$total_label = 'Your Price*';
									$total = '<font size="2" color="#FF0000">FREE</font>';
								}elseif ($price < -.02){
									// You MAKE money
									$total_label = '<font color="#FF0000"><span id="pulse">You Pocket*</span></font>';
									$total = '<font size="2" color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
								}else{
									// If there is a price, show it with 2 decimal places
									$total_label = 'Your Price*';
									$total = '<font size="2" color="#FF0000">$'.sprintf('%.2f', $price).'</font>';
								};
								// Determine if there is a mail-in rebate for this phone.
								// If there is, add both instant rebates together and display the amount as a single instant rebate.
								// Otherwise, display each intant rebate on its own line, so there are always 2 rebates showing.
								if ($row["mail_in"] != 0){ //There's a mail-in rebate
									echo'
										<tr>
											<td><strong>Instant Rebates</strong></td>
											<td align="right">
												<font color="#008000">
												-$'.sprintf('%.2f', ($row["instant1"]+$row["instant2"])).' <!-- 2 Decimal Places -->
												</font>
											</td>
										</tr>
										<tr>
											<td><strong>T-Mobile Rebate</strong></td>
											<td align="right"><font color="#008000">-$'.$row["mail_in"].'</font></td>
										</tr>
									';
								}else{ //Show first instant rebate
									echo'
										<tr>
											<td><strong>Instant Rebate</strong></td>
											<td align="right"><font color="#008000">-$'.$row["instant1"].'</font></td>
										</tr>
									';
									if ($row["instant2"] != 0){ //There's a second instant rebate
										echo'	
										<tr>
											<td><strong>Instant Rebate</strong></td>
											<td align="right"><font color="#008000">-$'.$row["instant2"].'</font></td>
										</tr>
										';
									};
								};
								echo'
										<tr>
											<!-- Black line -->
											<td width="100%" height="1" colspan="2" bgcolor="#000000">
												<img src="images/spacer.gif" alt="" width="100%" height="1" border="0"><br>
											</td>
										</tr>
										<tr>
											<td><font size="2"><strong>'.$total_label.'</strong></font></td>
											<td align="right">
												<strong>'.$total.'</strong>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<!-- GO SECURE! -->
									<form action="https://secure.nr.net/mobileintentions/"> <!-- Outside of cell for IE formatting -->
									<td align="center">
								';
								if ($row["instant2"] == 0){ //No second instant rebate so add a spacer in its place
									echo'	
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									';
								};
								echo'
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
										<!-- Order Button -->
										<input type="image" src="images/OrderNow.gif" alt="Order your '.$row["manufacturer"].'&nbsp;'.$row["model"].' Now!" width="125" height="25" border="0">
										<input type="hidden" name="sec" value="order">
										<input type="hidden" name="prod" value="'.$row["product_id"].'">
<!--						<input type="hidden" name="zipcode" value="'.$zipcode.'">-->
									</td>
								</tr>
								</table>
								';
								?>
							</td>
						</tr>
						</table>
					</td>
					<td width="175" height="275" valign="top" background="images/promos/PromoPhone.jpg">
						<br><br>
						<table width="75" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" class="smallBlack">
								<strong>Now with<br>
								<font color="#FF0000">FREE Activation!</font></strong>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2"><img src="images/promos/JDPower.jpg" alt="" width="400" height="25" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25" colspan="2" bgcolor="#5B5B5B">
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="630" valign="bottom" class="smallWhite">&nbsp;&nbsp;&nbsp;*A two year agreement and activation of new/additional line of service for each phone required.</td>
					<td><img src="images/promos/RankedHighest.gif" alt="" width="120" height="24" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<script type="text/javascript">
if (document.layers) document.layers.GetMore1K.left = ((window.innerWidth / 2) - (760 / 2));  //Mozilla
else if (document.all) document.all.GetMore1K.style.left = ((document.body.offsetWidth / 2) - (760 / 2));  //IE
else if (document.getElementById) document.getElementById("GetMore1K").style.left = ((window.innerWidth / 2) - (760 / 2));
</script>

<!-- END Get More 1000 Promo -->


<!-- BEGIN Regional 3000 Promo -->
<div id="Regional3K" style="position:absolute;top:-450;">
<table width="760" border="0" cellspacing="5" cellpadding="0" bgcolor="#000000">
<tr>
	<td>
		<table width="750" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td height="25" colspan="2" align="right" background="images/HeaderBar.jpg"><a href="javascript:void(0)" onclick="hideAd('Regional3K')"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"></a></td>
		</tr>
		<tr>
			<td colspan="2"><img src="images/promos/Regional3KHeader.jpg" alt="" width="750" height="50" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="750" height="1" border="0"></td>
		</tr>
		<tr>
			<td><img src="images/promos/3000RegionalMinutes.gif" alt="" width="350" height="300" border="0"></td>
			<td>
				<table width="400" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top" bgcolor="#EFEDEE">
						<table width="225" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" class="bigBlack"><br><strong>Most of our phones are<br><font size="+2" color="#ED008C">FREE!</font></strong></td>
						</tr>
						<tr>
							<td align="center" class="bodyBlack"><br><strong>... Like the Best Selling</strong></td>
						</tr>
						<tr>
							<td align="center" class="bodyBlack">
								<?
								// Grab phone info
								$query = "SELECT
											product_id,
											manufacturer,
											model,
											bullet1,
											bullet2,
											bullet3,
											msrp,
											instant1,
											instant2,
											mail_in
											FROM phones
											WHERE product_id = 248
											";
								$result = mysql_query($query, $linkID);
								$row = mysql_fetch_assoc($result);
								echo'
								<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="xbigBlack">
										<strong>'.$row["manufacturer"].' '.$row["model"].'</strong>
									</td>
								</tr>
								<!-- Bullet point features -->
								<tr>
									<td align="center" valign="top">
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
										<table border="0" cellspacing="0" cellpadding="0" class="smallBlack">
										<tr>
											<td><li><em>'.$row["bullet1"].'</em></td>
										</tr>
										<tr>
											<td><li><em>'.$row["bullet2"].'</em></td>
										</tr>
										<tr>
											<td><li><em>'.$row["bullet3"].'</em></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									</td>
								</tr>
								<tr>
									<td align="center" valign="top">
										<!-- Display price breakdown table -->
										<table width="150" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
										<tr>
											<td><strong>Suggested Retail</strong></td>
											<td align="right"><font color="#008000">$'.$row["msrp"].'</font></td>
										</tr>
								';
								// Build a text tring, with formatting, for the final sale price.
								$price = ($row["msrp"]-($row["instant1"]+$row["instant2"]+$row["mail_in"]));
								if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
									// No price = "FREE"
									$total_label = 'Your Price*';
									$total = '<font size="2" color="#FF0000">FREE</font>';
								}elseif ($price < -.02){
									// You MAKE money
									$total_label = '<font color="#FF0000"><span id="pulse">You Pocket*</span></font>';
									$total = '<font size="2" color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
								}else{
									// If there is a price, show it with 2 decimal places
									$total_label = 'Your Price*';
									$total = '<font size="2" color="#FF0000">$'.sprintf('%.2f', $price).'</font>';
								};
								// Determine if there is a mail-in rebate for this phone.
								// If there is, add both instant rebates together and display the amount as a single instant rebate.
								// Otherwise, display each intant rebate on its own line, so there are always 2 rebates showing.
								if ($row["mail_in"] != 0){ //There's a mail-in rebate
									echo'
										<tr>
											<td><strong>Instant Rebates</strong></td>
											<td align="right">
												<font color="#008000">
												-$'.sprintf('%.2f', ($row["instant1"]+$row["instant2"])).' <!-- 2 Decimal Places -->
												</font>
											</td>
										</tr>
										<tr>
											<td><strong>T-Mobile Rebate</strong></td>
											<td align="right"><font color="#008000">-$'.$row["mail_in"].'</font></td>
										</tr>
									';
								}else{ //Show first instant rebate
									echo'
										<tr>
											<td><strong>Instant Rebate</strong></td>
											<td align="right"><font color="#008000">-$'.$row["instant1"].'</font></td>
										</tr>
									';
									if ($row["instant2"] != 0){ //There's a second instant rebate
										echo'	
										<tr>
											<td><strong>Instant Rebate</strong></td>
											<td align="right"><font color="#008000">-$'.$row["instant2"].'</font></td>
										</tr>
										';
									};
								};
								echo'
										<tr>
											<!-- Black line -->
											<td width="100%" height="1" colspan="2" bgcolor="#000000">
												<img src="images/spacer.gif" alt="" width="100%" height="1" border="0"><br>
											</td>
										</tr>
										<tr>
											<td><font size="2"><strong>'.$total_label.'</strong></font></td>
											<td align="right">
												<strong>'.$total.'</strong>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<!-- GO SECURE! -->
									<form action="https://secure.nr.net/mobileintentions/"> <!-- Outside of cell for IE formatting -->
									<td align="center">
								';
								if ($row["instant2"] == 0){ //No second instant rebate so add a spacer in its place
									echo'	
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									';
								};
								echo'
										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
										<!-- Order Button -->
										<input type="image" src="images/OrderNow.gif" alt="Order your '.$row["manufacturer"].'&nbsp;'.$row["model"].' Now!" width="125" height="25" border="0">
										<input type="hidden" name="sec" value="order">
										<input type="hidden" name="prod" value="'.$row["product_id"].'">
<!--						<input type="hidden" name="zipcode" value="'.$zipcode.'">-->
									</td>
								</tr>
								</table>
								';
								?>
							</td>
						</tr>
						</table>
					</td>
					<td width="175" height="275" valign="top" background="images/promos/PromoPhone.jpg">
						<br><br>
						<table width="75" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" class="smallBlack">
								<strong>Now with<br>
								<font color="#FF0000">FREE Activation!</font></strong>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2"><img src="images/promos/JDPower.jpg" alt="" width="400" height="25" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="25" colspan="2" bgcolor="#5B5B5B">
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="630" valign="bottom" class="smallWhite">&nbsp;&nbsp;&nbsp;*A two year agreement and activation of new/additional line of service for each phone required.&nbsp;&nbsp;Call for more information.</td>
					<td><img src="images/promos/RankedHighest.gif" alt="" width="120" height="24" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<script type="text/javascript">
if (document.layers) document.layers.Regional3K.left = ((window.innerWidth / 2) - (760 / 2)); //Mozilla
else if (document.all) document.all.Regional3K.style.left = ((document.body.offsetWidth / 2) - (760 / 2));  //IE
else if (document.getElementById) document.getElementById("Regional3K").style.left = ((window.innerWidth / 2) - (760 / 2));
</script>

<!-- END Regional 3000 Promo -->

