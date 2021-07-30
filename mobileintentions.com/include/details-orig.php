<!-- BEGIN Include details.php -->

<?
// Grab phone details
$result = mysql_query("SELECT * FROM phones WHERE product_id = '$prod_id'", $linkID);

// Found it!
if ($result){
	$row = mysql_fetch_assoc($result);
	echo'
<table width="925" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Label Tab -->
	<h1><td height="24" background="images/TabTop.gif" class="bodyWhite">
		<strong>&nbsp;&nbsp;'.$row["manufacturer"].'&nbsp;'.$row["model"].'</strong>
	</td></h1>
</tr>
	';
?>
<tr>
	<!-- Display location based on zipcode entered -->
	<td height="15" colspan="3" bgcolor="#E20074" class="smallWhite">
		<?
		// Grab city and state from zipcode database
		mysql_select_db("zipcode", $linkID);
		$result2 = mysql_query("SELECT pref_city_state_name, state FROM zipcodes WHERE zip_code = '$zipcode' LIMIT 1", $linkID); //Only need 1
		// Not found
		if (mysql_num_rows($result2) < 1){
			echo'<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Online Prices for UNKNOWN LOCATION &nbsp;'.$zipcode.'</strong>';
		// Gotcha!
		}else{
			$row2 = mysql_fetch_assoc($result2);
			echo'<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Online Prices for '.$row2["pref_city_state_name"].', '.$row2["state"].' &nbsp;'.$zipcode.'</strong>';
		};
		// Switch back
		mysql_select_db("mobileintentions", $linkID);
		?>
		<!-- Change zipcode link -->
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<a href="#" onClick="zipcode=null;show('zipprompt1','?sec=details&prod=','<? echo $row["product_id"]; ?>&zipcode=<? echo $zipcode; ?>');" class="smallWhite" title="Change Zipcode" style="cursor:pointer;">Change Zipcode</a>)
	</td>
</tr>

<?
	echo'
<tr>
	<td background="images/TabBigBG.gif">
		<!-- Left Column -->
		<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="120" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<!-- Phone Image -->
					<td colspan="2" align="center">
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
						<img src="images/phones/'.$row["image"].'" alt="'.$row["manufacturer"].'&nbsp;'.$row["model"].'" width="100" height="200" border="0"><br>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					</td>
				</tr>
				<!-- Phone Specifications -->
				<tr bgcolor="#F8F8F8">
					<td width="100%" height="15" colspan="2" bgcolor="#FFFFFF" background="images/TabTopSmall.gif" style="background-position: left; background-repeat: no-repeat; background-attachment: scroll;" class="bodyWhite">
						<strong>&nbsp;Specifications</strong>
					</td>
				</tr>
				<!-- Size -->
				<tr bgcolor="#F8F8F8">
					<td rowspan="7"><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
					<h1><td class="smallBlack">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Size</strong><br>'.$row["size"].'<br>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					</td></h1>
				</tr>
				<!-- Weight -->
				<tr bgcolor="#F8F8F8">
					<h1><td class="smallBlack">
						<strong>Weight</strong><br>'.$row["weight"].'<br>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					</td></h1>
				</tr>
				<!-- Battery -->
				<tr bgcolor="#F8F8F8">
					<h1><td class="smallBlack">
						<strong>Included Battery</strong><br>'.$row["battery"].'<br>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					</td></h1>
				</tr>
				<!-- Talk Time -->
				<tr bgcolor="#F8F8F8">
					<h1><td class="smallBlack">
						<strong>Talk Time</strong><br>'.$row["talk_time"].'<br>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					</td></h1>
				</tr>
				<!-- Standby Time -->
				<tr bgcolor="#F8F8F8">
					<h1><td class="smallBlack">
						<strong>Standby Time</strong><br>'.$row["standby_time"].'<br>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					</td></h1>
				</tr>
				<!-- Bands -->
				<tr bgcolor="#F8F8F8">
					<h1><td class="smallBlack">
						<strong>Band(s)</strong><br>'.$row["band"].'<br>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					</td></h1>
				</tr>
				<!-- Accessories -->
				<tr bgcolor="#F8F8F8">
					<h1><td class="smallBlack">
						<strong>Included Accessories</strong><br>'.$row["accessories"].'<br>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					</td></h1>
				</tr>
				<!-- Bottom Line -->
				<tr bgcolor="#E20074">
					<td width="100%" colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
				</tr>
				<tr>
					<td>
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					</td>
				</tr>
				</table>
			</td>
			<!-- Spacer -->
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<!-- Right Column -->
			<td width="770" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<!-- Main Label -->
							<h1><td width="260" valign="top" class="xbigBlack">
								<br>
								<strong>'.$row["manufacturer"].'&nbsp;'.$row["model"].'</strong>
							</td></h1>
							<td width="250" rowspan="2" align="center">
								<table border="0" cellspacing="0" cellpadding="0">
	';
	// Build a text string, with formatting, for the final sale price.
	$price = ($row["msrp"]-($row["instant1"]+$row["instant2"]+$row["mail_in"]));
	if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
		// No price = "FREE"
		$total_label = 'Your Price*';
		$final_label = 'Final Price*';
		$total = '<font size="+2" color="#FF0000">FREE*</font>';
	}elseif ($price < -.02){
		// You MAKE money
		$total_label = '<font color="#FF0000">You <u>MAKE</u>*</font>';
		$final_label = '<font color="#FF0000">You <u>MAKE</u>*</font>';
		$total = '<font size="+2" color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
	}else{
		// If there is a price, show it with 2 decimal places
		$total_label = 'Your Price*';
		$final_label = 'Final Price*';
		$total = '<font size="+2" color="#FF0000">$'.sprintf('%.2f', $price).'*</font>';
	};
	echo'
								<!-- Display final price, front & center -->
								<tr>
									<td class="smallBlack"><font color="#008000"><strong>$'.$row["msrp"].' Value</strong></font></td>
									<h1><td rowspan="2" valign="bottom" class="xbigBlack"><strong>&nbsp;'.$total.'</strong></td></h1>
								</tr>
								<tr>
									<td class="bodyBlack"><font color="#008000"><strong>'.$total_label.'</strong></font></td>
								</tr>
								<!-- Order Button -->
								<tr>
									<td colspan="2" align="center">
										<!-- GO SECURE! -->
										<a href="https://secure.nr.net/mobileintentions/?sec=order&prod='.$row["product_id"].'&zipcode='.$zipcode.'"><img src="images/OrderNow.gif" alt="Order your '.$row["manufacturer"].'&nbsp;'.$row["model"].' Now!" width="125" height="25" border="0"></a>
									</td>
								</tr>
								</table>
							</td>
							<!-- Display price breakdown table -->
							<td width="250" rowspan="2" align="right" valign="top">
								<img src="images/spacer.gif" alt="" width="1" height="8" border="0"><br>
								<table width="150" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
								<tr>
									<td><strong>Suggested Retail</strong></td>
									<td align="right"><font color="#008000">$'.$row["msrp"].'</font></td>
								</tr>
	';
	// Determine if there is a mail-in rebate for this phone.
	// If there is, add both instant rebates together and display the amount as a single instant rebate.
	// Otherwise, display each intant rebate on its own line, so there are always 2 rebates showing.
	if ($row["mail_in"] != 0){ //There's a mail-in rebate
		echo'
								<tr>
									<td><strong>Instant Rebate</strong></td>
									<td align="right">
										<font color="#008000">
										-$'.sprintf('%.2f', ($row["instant1"]+$row["instant2"])).' <!-- 2 Decimal Places -->
										</font>
									</td>
								</tr>
								<tr>
									<td><strong>Mail-in Rebate</strong></td>
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
									<td><font size="2"><strong>'.$final_label.'</strong></font></td>
									<td align="right">
										<font size="2" color="#FF0000"><strong>
										<!-- 2 decimal places -->
										$'.sprintf('%.2f', abs($row["msrp"]-($row["instant1"]+$row["instant2"]+$row["mail_in"]))).'
										</strong></font>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<!-- Product tagline (under main label) -->
							<td valign="top" class="bigBlack">
								'.$row["tagline"].'<br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<!-- Black line -->
					<td width="100%" height="1" bgcolor="#000000">
						<img src="images/spacer.gif" alt="" width="100%" height="1" border="0"><br>
					</td>
				</tr>
				<tr>
					<!-- Product description -->
					<h1><td valign="top" class="bigBlack">
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
						'.$row["description"].'<br>
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					</td></h1>
				</tr>
				<!-- Features Table -->
				<tr>
					<td width="100%" height="15" bgcolor="#FFFFFF" background="images/TabTopSmall.gif" style="background-position: left; background-repeat: no-repeat; background-attachment: scroll;" class="bodyWhite">
						<strong>&nbsp;Features</strong>
					</td>
				</tr>
		';
		// Look up all the features of this phone and build a table to display them
		$result = mysql_query("SELECT * FROM features WHERE product_id = '$prod_id'", $linkID);
		for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
			// Alternate row background colors - odd/even counter number
			$bg = (is_even($counter)? "#E0E0E0": "#F8F8F8");
			$row = mysql_fetch_assoc($result);
			echo'
				<tr>
					<h1><td valign="top" bgcolor="'.$bg.'">
						<table width="100%" border="0" cellspacing="5" cellpadding="0" align="center" class="smallBlack">
						<tr>
							<td width="200"><strong>'.$row["feature"].'</strong></td>
							<td valign="top">'.$row["description"].'</td>
						</tr>
						</table>
					</td></h1>
				</tr>
			';
		};
		echo'
				<tr>
					<!-- Features table footer tab -->
					<h1><td width="100%" height="12" align="right" bgcolor="#FFFFFF" background="images/TabBottomSmallWide.gif" class="smallWhite" style="background-position: right; background-repeat: no-repeat; background-attachment: scroll;">
						<em><strong>&nbsp;*Additional service fees may apply.&nbsp;&nbsp;Phone price with new activation after available promotions &amp; rebates.&nbsp;&nbsp;</strong></em>
					</td></h1>
				</tr>
				<tr>
					<td>
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					</td>
				</tr>
				</table>
			</td>
		</tr>		
		</table>
	</td>
</tr>
<!-- Spacer -->
<tr>
	<td bgcolor="#E20074"><img src="images/spacer.gif" alt="" width="100%" height="2" border="0"></td>
</tr>
</table>
	';
};
?>

