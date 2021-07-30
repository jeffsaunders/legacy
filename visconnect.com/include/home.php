<!-- BEGIN Include home.php -->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<!-- Left Column -->
	<td valign="top">
		<table width="250" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<!-- Product Profile box -->
				<table width="250" border="0" cellspacing="0" cellpadding="0" align="left" bgcolor="#FFFFFF">
				<tr>
					<td><img src="images/ProductProfileHeader.jpg" alt="" width="250" height="25" border="0"></td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF" background="images/ProductProfileBG.jpg" style="background-position:top; background-repeat:repeat-y;">
						<table width="250" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td>
								<?
								// Build details table for phone they asked for...
								if ($anchor != ""){
									// Get the phone they asked for
									$query = "SELECT * FROM phones WHERE product_id = '$anchor'";
									$rs_phone = mysql_query($query, $linkID);
									// Phone found
									if (mysql_num_rows($rs_phone) != 0){
										$row = mysql_fetch_assoc($rs_phone);
										$gift_card_amount = $gift_card;
									}else{  // Phone not found - look for accessory instead
										$query = "SELECT * FROM accessories WHERE product_id = '$anchor'";
										$rs_accessory = mysql_query($query, $linkID);
										$row = mysql_fetch_assoc($rs_accessory);
										if ($row["apply_gift_card"] == "T"){
											$gift_card_amount = $gift_card;
										}else{
											$gift_card_amount = 0;
										}
									}
								// ...or grab a phone at random if they didn't specify
								}else{
									$query = "SELECT * FROM phones WHERE display != 'N' AND phone_type = 'D' AND carrier = '$carrier_selected' ORDER BY rand()";
									$rs_phone = mysql_query($query, $linkID);
									$row = mysql_fetch_assoc($rs_phone);
									$gift_card_amount = $gift_card;
								}
								$price = ($row["msrp"]-($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]+$row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]+$gift_card_amount));
								if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
									// No price = "FREE"
									$div_total_label = 'Your Price*';
									$div_total = '<font color="#FF0000">FREE</font>';
								}elseif ($price < -.02){
									// You MAKE money
									$div_total_label = '<font color="#FF0000"><span id="pulse">In Your Pocket*</span></font>';
									$div_total = '<font color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
								}else{
									// If there is a price, show it with 2 decimal places
									$div_total_label = 'Your Price*';
									$div_total = '$'.sprintf('%.2f', $price);
								};
								?>
								<table width="240" border="0" cellspacing="2" cellpadding="0" align="center">
								<tr>
									<td colspan="2" valign="top" class="smallBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><strong><? echo $row["label"]; ?></strong></td>
								</tr>
								<tr>
									<!-- Phone Image -->
									<td align="center" valign="top"><img src="images/phones/<? echo $row["thumbnail"]; ?>" alt="Click for <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> Details" title="Click for <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> Details" width="70" height="130" border="0"></td>
									<td valign="top">
										<!-- Right Column -->
										<table width="160" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
										<tr>
											<!-- Sprint Logo -->
											<td align="center"><img src="images/SprintLogo100.jpg" alt="" width="100" height="41" border="0"><br></td>
										</tr>
										<tr>
											<!-- Pricing -->
											<td>
												<table width="160" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
												<tr>
													<td><img src="images/spacer.gif" alt="" width="1" height="65" border="0"></td>
													<td valign="top">
														<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
														<table width="160" border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
														<tr>
															<td align="right">$<? echo number_format($row["msrp"], 2); ?></td>
															<td>&nbsp;Regular Price</td>
														</tr>
<!--														<tr>
															<td align="right">-$<? echo sprintf("%.2f", ($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"])); ?></td>
															<td>&nbsp;instant savings</td>
														</tr>
-->								
														<?
														// Instant rebate(s)
														if ($row["instant".$pricing_level."-1"] != 0 || $row["instant".$pricing_level."-2"] != 0){
															echo'
														<tr>
															<td align="right">-$';echo sprintf("%.2f", ($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]));echo'</td>
															<td>&nbsp;Instant Savings'.iif($row["instant".$pricing_level."-1"] != 0 && $row["instant".$pricing_level."-2"] != 0, "s", "").'</td>
														</tr>
															';
														}
														?>
														<?
														// Mail-in rebate(s)
														if ($row["mail_in".$pricing_level."-1"] != 0 || $row["mail_in".$pricing_level."-2"] != 0){
															echo'
														<tr>
															<td align="right">-$';echo sprintf("%.2f", ($row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]));echo'</td>
															<td>&nbsp;Mail-in Rebate'.iif($row["mail_in".$pricing_level."-1"] != 0 && $row["mail_in".$pricing_level."-2"] != 0, "s", "").'</td>
														</tr>
															';
														}
														?>
														<?
														// Gift Card
														if ($gift_card_amount > 0){
															echo'
														<tr>
															<td align="right">-$';echo sprintf("%.2f", ($gift_card_amount));echo'</td>
															<td>&nbsp;Amex Gift Card</td>
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
														</table>
													</td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<!-- Order button -->
											<td align="center">
												<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
												<a style="cursor:pointer;" onClick="
													document.PushPhone.carrier.value='<? echo $row["carrier"]; ?>';
													document.PushPhone.affiliation.value='<? echo $label; ?>';
													document.PushPhone.mrc_discount.value='<? echo $sprint_discount; ?>';
													document.PushPhone.product_id.value='<? echo $row["product_id"]; ?>';
													document.PushPhone.phone_type.value='<? echo $row["phone_type"]; ?>';
													document.PushPhone.product_type.value='<? echo $row["product_type"]; ?>';
													document.PushPhone.product_manuf.value='<? echo $row["manufacturer"]; ?>';
													document.PushPhone.product_model.value='<? echo $row["model"]; ?>';
													document.PushPhone.product_msrp.value='<? echo $row["msrp"]; ?>';
													document.PushPhone.product_ir1.value='<? echo $row["instant".$pricing_level."-1"]; ?>';
													document.PushPhone.product_ir2.value='<? echo $row["instant".$pricing_level."-2"]; ?>';
													document.PushPhone.product_mir1.value='<? echo $row["mail_in".$pricing_level."-1"]; ?>';
													document.PushPhone.product_mir2.value='<? echo $row["mail_in".$pricing_level."-2"]; ?>';
													document.PushPhone.product_price.value='<? echo $price; ?>';
													document.PushPhone.submit();
												"><img src="images/<? echo $AddToOrderButton; ?>" alt="Click to Add <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> to Your Order" title="Click to Add <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> to Your Order" width="82" height="24" border="0"></a><br>
												<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<!-- Features Table -->
										<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#DCEAFB" class="smallBlack">
										<tr bgcolor="#6E6E6E"><!--6E6E6E 989DA5-->
											<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
											<td><img src="images/spacer.gif" alt="" width="5" height="20" border="0"></td>
											<td colspan="2" class="bodyWhite"><strong>Product Features</strong></td>
											<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
										</tr>
										<tr>
											<td colspan="3"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
										</tr>
										<? if ($row["hookline"] != ""){ ?>
										<tr>
											<td><img src="images/spacer.gif" alt="" width="5" height="20" border="0"></td>
											<td colspan="2" class="bodyBlack"><strong><? echo $row["hookline"]; ?></strong><br><br></td>
										</tr>
										<? } ?>
										<tr>
											<td><img src="images/spacer.gif" alt="" width="5" height="20" border="0"></td>
											<td colspan="2" class="bodyBlack"><? echo stripslashes($row["description"]); ?><br><br></td>
										</tr>
										<tr>
											<td colspan="3" align="center"><img src="images/GrayDot.gif" alt="" width="230" height="1" border="0"><br><br></td>
										</tr>	
										<?
										// Look up all the features of this phone and build a table to display them
										$prod_id = $row["product_id"];
										$rs_features = mysql_query("SELECT * FROM phone_features WHERE product_id = '$prod_id' AND feature <> ''", $linkID);
										for ($counter2=1; $counter2 < mysql_num_rows($rs_features); $counter2++){ // Counter loop within a loop, hence counter2
											$row2 = mysql_fetch_assoc($rs_features);
										?>
										<tr>
											<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
											<td valign="top"><li></td>
											<?
											// If this is the 1st "feature", tell them the band/mode
											if ($counter2 == 1 && $row["band"] != ""){
											?>
											<td valign="top"><? echo $row["band"]; ?></td>
											<?
											}else{
											?>
											<td valign="top"><? echo $row2["feature"]; ?></td>
											<?
											};
											?>
										</tr>
										<?
										};
										?>
										<tr>
											<td colspan="3"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
										</tr>
										<tr>
											<td colspan="3" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
								</tr>
								</table>
								<?
//								mysql_data_seek($rs_phones, 0);
								?>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><img src="images/ProductProfileFooter.jpg" alt="" width="250" height="10" border="0"></td>
				</tr>
				</table>					
			</td>
		</tr>
		<tr>
			<td>
				<br>
				<a href="http://apple.cellbenefits.nr.net" target="_top"><img src="images/CellBenefitsPromo.jpg" alt="Apple Employee Discount Sprint Store" title="Apple Employee Discount Sprint Store" width="250" height="350" border="0"></a>
			</td>
		</tr>
		</table>					
	</td>				
	<!-- Spacer -->
	<td><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
	<!-- Right (Center) Column -->
	<td valign="top">
		<table width="440" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td>
				<!-- Main display of all phones -->
				<table width="440" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
				<tr>
					<td><img src="images/ProductsHeader.jpg" alt="" width="440" height="25" border="0"></td>
				</tr>
				<tr>
					<td valign="top" bgcolor="#FFFFFF" background="images/ProductsBG.jpg" style="background-position:top; background-repeat:repeat-y;">
						<table width="440" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
						<?
						// Get all the phones
						$query = "SELECT * FROM phones WHERE display != 'N' AND phone_type = 'D' AND carrier = '$carrier_selected' ORDER BY manufacturer, model";
						$rs_phones = mysql_query($query, $linkID);
						// Found some! (more than NONE)
						if ($rs_phones){
							$boxcounter = 0;
							for ($counter=1; $counter <= mysql_num_rows($rs_phones); $counter++){
								$boxcounter++;
								$row = mysql_fetch_assoc($rs_phones);
						?>
						<?
						//		$destination = "?sec=details&prod=";
								// Build a text string, with formatting, for the final sale price.
								$price = ($row["msrp"]-($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]+$row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]+$gift_card));
								if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
									// No price = "FREE"
									$total_label = 'Your Price';
									$total = '<img src="images/spacer.gif" alt="" width="10" height="1" border="0"><font color="#FF0000">FREE*</font>';
								}elseif ($price < -.02){
									// You MAKE money
									$total_label = '<font color="#FF0000"><span id="pulse">You Make</span></font>';
									$total = '<img src="images/spacer.gif" alt="" width="10" height="1" border="0"><font color="#FF0000">$'.sprintf('%.2f', abs($price)).'*</font>';
								}else{
									// If there is a price, show it with 2 decimal places
									$total_label = 'Your Price';
									$total = '<img src="images/spacer.gif" alt="" width="10" height="1" border="0">$'.sprintf('%.2f', $price).'*';
								};
						?>
							<td width="219" valign="top">
								<table border="0" cellspacing="2" cellpadding="0" align="center">
								<tr>
									<td height="35" colspan="2" valign="top" class="smallBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><strong><? echo $row["label"]; ?></strong></td>
								</tr>
								<tr>
									<!-- Phone Image -->
									<td align="center" valign="top"><a href="?sec=home&amp;anchor=<? echo $row["product_id"]; ?>" title="Click for <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> Details" class="smallBlue"><img src="images/phones/<? echo $row["thumbnail"]; ?>" alt="Click for <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> Details" title="Click for <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> Details" width="70" height="130" border="0"><br><strong>Details</strong></a></td>
									<td valign="top">
										<!-- Right Column -->
										<table width="130" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
										<tr>
											<!-- Bullet Points -->
											<td>
												<table width="130" border="0" cellspacing="0" cellpadding="0" bgcolor="<? echo $box_bg; ?>" class="smallBlack">
												<tr>
													<td colspan="4" bgcolor="#CCCCCC"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
												</tr>
												<tr>
													<td bgcolor="#CCCCCC"><img src="images/spacer.gif" alt="" width="1" height="70" border="0"></td>
													<td><img src="images/spacer.gif" alt="" width="5" height="70" border="0"></td>
													<td valign="top">
														<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
														<table width="130" border="0" cellspacing="0" cellpadding="0" bgcolor="<? echo $box_bg; ?>" class="smallBlack">
														<tr>
															<td valign="top"><li></td>
															<td><? echo $row["bullet1"]; ?></td>
															<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
														</tr>
														<? if ($row["bullet2"] != ""){ ?>
														<tr>
															<td valign="top"><li></td>
															<td><? echo $row["bullet2"]; ?></td>
															<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
														</tr>
														<? }  if ($row["bullet3"] != ""){ ?>
														<tr>
															<td valign="top"><li></td>
															<td><? echo $row["bullet3"]; ?></td>
															<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
														</tr>
														<? } ?>
														</table>
													</td>
													<td bgcolor="#CCCCCC"><img src="images/spacer.gif" alt="" width="1" height="70" border="0"></td>
												</tr>
												<tr>
													<td colspan="4" bgcolor="#CCCCCC"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<!-- Price -->
											<td>
												<br>
												<table border="0" cellspacing="0" cellpadding="0" align="center" class="smallBlack">
												<tr>
													<td align="center"><? echo $total_label; ?><br><span style="font-size:15px;"><strong><? echo $total ?></strong></span></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<!-- Order button -->
											<td align="center">
												<br>
												<a style="cursor:pointer;" onClick="
													document.PushPhone.carrier.value='<? echo $row["carrier"]; ?>';
													document.PushPhone.affiliation.value='<? echo $label; ?>';
													document.PushPhone.mrc_discount.value='<? echo $sprint_discount; ?>';
													document.PushPhone.product_id.value='<? echo $row["product_id"]; ?>';
													document.PushPhone.phone_type.value='<? echo $row["phone_type"]; ?>';
													document.PushPhone.product_type.value='<? echo $row["product_type"]; ?>';
													document.PushPhone.product_manuf.value='<? echo $row["manufacturer"]; ?>';
													document.PushPhone.product_model.value='<? echo $row["model"]; ?>';
													document.PushPhone.product_msrp.value='<? echo $row["msrp"]; ?>';
													document.PushPhone.product_ir1.value='<? echo $row["instant".$pricing_level."-1"]; ?>';
													document.PushPhone.product_ir2.value='<? echo $row["instant".$pricing_level."-2"]; ?>';
													document.PushPhone.product_mir1.value='<? echo $row["mail_in".$pricing_level."-1"]; ?>';
													document.PushPhone.product_mir2.value='<? echo $row["mail_in".$pricing_level."-2"]; ?>';
													document.PushPhone.product_price.value='<? echo $price; ?>';
													document.PushPhone.submit();
												"><img src="images/<? echo $AddToOrderButton; ?>" alt="Click to Add <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> to Your Order" title="Click to Add <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> to Your Order" width="82" height="24" border="0"></a>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
								</tr>
								</table>
							</td>
							<? if ($boxcounter < 2){ ?>
							<!-- Vertical separation line -->
							<td width="1" align="center"><img src="images/GrayDot.gif" alt="" width="1" height="180" border="0"></td>
							<? }else{ ?>
								<? if ($counter < mysql_num_rows($rs_phones)){ ?>
						</tr>
						<tr>
							<!-- Horizontal separation lines -->
							<td colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="219" align="center"><img src="images/GrayDot.gif" alt="" width="200" height="1" border="0"></td>
									<td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
									<td width="219" align="center"><img src="images/GrayDot.gif" alt="" width="200" height="1" border="0"></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<?
								$boxcounter = 0;
								}
							}
							?>
							<?
							};
							if ($boxcounter == 1){
							?>
							<!-- Odd number of phones, so show promo in place of the last one -->
							<td width="219" align="center"><img src="images/SprintTower.jpg" alt="" width="160" height="160" border="0"></td>
							<?
							}
							?>
						<?
						}
						?>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><img src="images/ProductsFooter.jpg" alt="" width="440" height="10" border="0"></td>
				</tr>
				</table>					
			</td>
		</tr>
		<?
		// Get all the accessories
		$query = "SELECT * FROM accessories WHERE display != 'N' AND (carrier = '' OR carrier = '$carrier_selected') ORDER BY product_type, manufacturer, model";
		$rs_accessories = mysql_query($query, $linkID);
		// Found some! (more than NONE)
		if (mysql_num_rows($rs_accessories) > 0 ){
		?>
		<tr>
			<td>
				<!-- Main display of all accessories -->
				<br>
				<table width="440" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
				<tr>
					<td><img src="images/AccessoriesHeader.jpg" alt="" width="440" height="25" border="0"></td>
				</tr>
				<tr>
					<td valign="top" bgcolor="#FFFFFF" background="images/ProductsBG.jpg" style="background-position:top; background-repeat:repeat-y;">
						<table width="440" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
						<?
						// Get all the accessories
//						$query = "SELECT * FROM accessories WHERE display != 'N' AND (carrier = '' OR carrier = '$carrier_selected') ORDER BY product_type, manufacturer, model";
//						$rs_accessories = mysql_query($query, $linkID);
//						// Found some! (more than NONE)
//						if ($rs_accessories){
							$boxcounter = 0;
							for ($counter=1; $counter <= mysql_num_rows($rs_accessories); $counter++){
								$boxcounter++;
								$row = mysql_fetch_assoc($rs_accessories);
								if ($row["apply_gift_card"] == "T"){
									$gift_card_amount = $gift_card;
								}else{
									$gift_card_amount = 0;
								}
						?>
						<?
						//		$destination = "?sec=details&prod=";
								// Build a text string, with formatting, for the final sale price.
								$price = ($row["msrp"]-($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]+$row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]+$gift_card_amount));
								if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
									// No price = "FREE"
									$total_label = 'Your Price';
									$total = '<img src="images/spacer.gif" alt="" width="10" height="1" border="0"><font color="#FF0000">FREE*</font>';
								}elseif ($price < -.02){
									// You MAKE money
									$total_label = '<font color="#FF0000"><span id="pulse">You Make</span></font>';
									$total = '<img src="images/spacer.gif" alt="" width="10" height="1" border="0"><font color="#FF0000">$'.sprintf('%.2f', abs($price)).'*</font>';
								}else{
									// If there is a price, show it with 2 decimal places
									$total_label = 'Your Price';
									$total = '<img src="images/spacer.gif" alt="" width="10" height="1" border="0">$'.sprintf('%.2f', $price).'*';
								};
						?>
							<td width="219" valign="top">
								<table border="0" cellspacing="2" cellpadding="0" align="center">
								<tr>
									<td height="35" colspan="2" valign="top" class="smallBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><strong><? echo $row["label"]; ?></strong></td>
								</tr>
								<tr>
									<!-- Phone Image -->
									<td align="center" valign="top"><a href="?sec=home&amp;anchor=<? echo $row["product_id"]; ?>" title="Click for <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> Details" class="smallBlue"><img src="images/phones/<? echo $row["thumbnail"]; ?>" alt="Click for <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> Details" title="Click for <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> Details" width="70" height="130" border="0"><br><strong>Details</strong></a></td>
									<td valign="top">
										<!-- Right Column -->
										<table width="130" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
										<tr>
											<!-- Bullet Points -->
											<td>
												<table width="130" border="0" cellspacing="0" cellpadding="0" bgcolor="<? echo $box_bg; ?>" class="smallBlack">
												<tr>
													<td colspan="4" bgcolor="#CCCCCC"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
												</tr>
												<tr>
													<td bgcolor="#CCCCCC"><img src="images/spacer.gif" alt="" width="1" height="70" border="0"></td>
													<td><img src="images/spacer.gif" alt="" width="5" height="70" border="0"></td>
													<td valign="top">
														<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
														<table width="130" border="0" cellspacing="0" cellpadding="0" bgcolor="<? echo $box_bg; ?>" class="smallBlack">
														<tr>
															<td valign="top"><li></td>
															<td><? echo $row["bullet1"]; ?></td>
															<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
														</tr>
														<? if ($row["bullet2"] != ""){ ?>
														<tr>
															<td valign="top"><li></td>
															<td><? echo $row["bullet2"]; ?></td>
															<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
														</tr>
														<? }  if ($row["bullet3"] != ""){ ?>
														<tr>
															<td valign="top"><li></td>
															<td><? echo $row["bullet3"]; ?></td>
															<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
														</tr>
														<? } ?>
														</table>
													</td>
													<td bgcolor="#CCCCCC"><img src="images/spacer.gif" alt="" width="1" height="70" border="0"></td>
												</tr>
												<tr>
													<td colspan="4" bgcolor="#CCCCCC"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<!-- Price -->
											<td>
												<br>
												<table border="0" cellspacing="0" cellpadding="0" align="center" class="smallBlack">
												<tr>
													<td align="center"><? echo $total_label; ?><br><span style="font-size:15px;"><strong><? echo $total ?></strong></span>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<!-- Order button -->
											<td align="center">
												<br>
												<a style="cursor:pointer;" onClick="
													document.PushPhone.carrier.value='<? echo $row["carrier"]; ?>';
													document.PushPhone.affiliation.value='<? echo $label; ?>';
													document.PushPhone.mrc_discount.value='<? echo $sprint_discount; ?>';
													document.PushPhone.product_id.value='<? echo $row["product_id"]; ?>';
													document.PushPhone.phone_type.value='<? echo $row["phone_type"]; ?>';
													document.PushPhone.product_type.value='<? echo $row["product_type"]; ?>';
													document.PushPhone.product_manuf.value='<? echo $row["manufacturer"]; ?>';
													document.PushPhone.product_model.value='<? echo $row["model"]; ?>';
													document.PushPhone.product_msrp.value='<? echo $row["msrp"]; ?>';
													document.PushPhone.product_ir1.value='<? echo $row["instant".$pricing_level."-1"]; ?>';
													document.PushPhone.product_ir2.value='<? echo $row["instant".$pricing_level."-2"]; ?>';
													document.PushPhone.product_mir1.value='<? echo $row["mail_in".$pricing_level."-1"]; ?>';
													document.PushPhone.product_mir2.value='<? echo $row["mail_in".$pricing_level."-2"]; ?>';
													document.PushPhone.product_price.value='<? echo $price; ?>';
													document.PushPhone.submit();
												"><img src="images/<? echo $AddToOrderButton; ?>" alt="Click to Add <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> to Your Order" title="Click to Add <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?> to Your Order" width="82" height="24" border="0"></a>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
								</tr>
								</table>
							</td>
							<? if ($boxcounter < 2){ ?>
							<!-- Vertical separation line -->
							<td width="1" align="center"><img src="images/GrayDot.gif" alt="" width="1" height="180" border="0"></td>
							<? }else{ ?>
								<? if ($counter < mysql_num_rows($rs_accessories)){ ?>
						</tr>
						<tr>
							<!-- Horizontal separation lines -->
							<td colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="219" align="center"><img src="images/GrayDot.gif" alt="" width="200" height="1" border="0"></td>
									<td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
									<td width="219" align="center"><img src="images/GrayDot.gif" alt="" width="200" height="1" border="0"></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<?
								$boxcounter = 0;
								}
							}
							?>
							<?
							};
							if ($boxcounter == 1){
							?>
							<!-- Odd number of phones, so show promo in place of the last one -->
							<td width="219" align="center"><img src="images/SprintTower.jpg" alt="" width="160" height="160" border="0"></td>
							<?
							}
							?>
						<?
//						}
						?>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><img src="images/ProductsFooter.jpg" alt="" width="440" height="10" border="0"></td>
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
</table>

<!-- Hidden form for feeding cart via POST.  Encase it in a div to hide it offscreen. -->
<div id="foo" style="position:absolute; top:-250; z-index:-1; visibility:hidden">
<form action="saveit.php" method="post" name="PushPhone" id="PushPhone">
	<input type="hidden" name="task" value="addphone">
	<input type="hidden" name="carrier" value="">
	<input type="hidden" name="affiliation" value="">
	<input type="hidden" name="mrc_discount" value="">
	<input type="hidden" name="product_id" value="">
	<input type="hidden" name="phone_type" value="">
	<input type="hidden" name="product_type" value="">
	<input type="hidden" name="product_manuf" value="">
	<input type="hidden" name="product_model" value="">
	<input type="hidden" name="product_msrp" value="">
	<input type="hidden" name="product_ir1" value="">
	<input type="hidden" name="product_ir2" value="">
	<input type="hidden" name="product_mir1" value="">
	<input type="hidden" name="product_mir2" value="">
	<input type="hidden" name="product_price" value="">
</form>
</div>

<!-- END Include home.php -->
