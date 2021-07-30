<!-- BEGIN Include phones.php -->

<table width="925" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Label Tab -->
	<td colspan="3" background="images/TabTop.gif" class="bodyWhite">
		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="24" class="bodyWhite"><strong>&nbsp;&nbsp;Phones</strong></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<!-- Display location based on zipcode entered -->
	<td height="15" colspan="3" bgcolor="#E20074" class="smallWhite">
		<script>var zipcode = getCookie("zipcode");</script>
		<?
		// Grab city and state from zipcode database
		mysql_select_db("zipcode", $linkID);
		$result = mysql_query("SELECT pref_city_state_name, state FROM zipcodes WHERE zip_code = '$zipcode' LIMIT 1", $linkID); //Only need 1
		// Not found
		if (mysql_num_rows($result) < 1){
			echo'<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Online Prices for UNKNOWN LOCATION &nbsp;'.$zipcode.'</strong>';
		// Gotcha!
		}else{
			$row = mysql_fetch_assoc($result);
			echo'<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Online Prices for '.$row["pref_city_state_name"].', '.$row["state"].' &nbsp;'.$zipcode.'</strong>';
		};
		// Switch back
		mysql_select_db("mobileintentions", $linkID);
		?>
		<!-- Change zipcode link -->
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<a href="#" onClick="zipcode=null;show('zipprompt2','http://www.mobileintentions.com/?sec=phones&zipcode='+zipcode+'','');" class="smallWhite" title="Change Zipcode" style="cursor:pointer;">Change Zipcode</a>)
	</td>
</tr>
<tr>
	<!-- Left border -->
	<td width="2" bgcolor="#E20074">
		<img src="images/spacer.gif" alt="" width="2" height="2" border="0">
	</td>
	<!-- Content -->
	<td align="center" bgcolor="#FFFFFF">
		<?
		// Build list of all products
		$result = mysql_query("SELECT * FROM phones WHERE display != 'N' ORDER BY manufacturer, model", $linkID);

		// Found some! (more than NONE)
		if ($result){
			for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
				$row = mysql_fetch_assoc($result);
				echo'
		<table width="921" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="100" valign="top">
				<!-- Phone Image -->
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<img src="images/phones/'.$row["thumbnail"].'" alt="'.$row["description"].'" width="100" height="120" border="0"><br>
				<img src="images/spacer.gif" alt="" width="1" height="25" border="0"><br>
			</td>
			<!-- Main Label -->
			<td width="206" valign="top" class="bodyBlack">
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<h1><td class="xbigBlack">
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
						<strong>'.$row["manufacturer"].' '.$row["model"].'</strong>
					</td></h1>
				</tr>
				<tr>
					<td valign="top">
					<!-- Display price breakdown table -->
						<img src="images/spacer.gif" alt="" width="1" height="8" border="0"><br>
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
					$total_label = '<font color="#FF0000">You <u>MAKE</u>*</font>';
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
				<!-- Order Button -->
				<tr>
					<td>
				';
				if ($row["instant2"] == 0){ //No second instant rebate so add a spacer in its place
					echo'	
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					';
				};
				echo'
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
						<!-- GO SECURE! -->
						&nbsp;&nbsp;<a href="https://secure.nr.net/mobileintentions/?sec=order&prod='.$row["product_id"].'&zipcode='.$zipcode.'"><img src="images/OrderNow.gif" alt="Order your '.$row["manufacturer"].'&nbsp;'.$row["model"].' Now!" width="125" height="25" border="0"></a>
					</td>
				</tr>
				</table>
			</td>
			<td width="615" valign="top"
			>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<!-- Features Table -->
				<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#F8F8F8">
				<tr>
					<td width="100%" height="15" bgcolor="#FFFFFF" background="images/TabTopSmall.gif" style="background-position: left; background-repeat: no-repeat; background-attachment: scroll;" class="bodyWhite">
						<strong>&nbsp;Features</strong>
					</td>
				</tr>
				';
			// Look up all the features of this phone and build a table to display them
			$prod_id = $row["product_id"];
			$result2 = mysql_query("SELECT * FROM features WHERE product_id = '$prod_id' LIMIT 15", $linkID); //Only room for 15
			for ($counter2=1; $counter2 <= mysql_num_rows($result2); $counter2++){ // Counter loop within a loop, hence counter2
				$row2 = mysql_fetch_assoc($result2);
				// First column
				echo'
				<tr>
					<td valign="top">
						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="smallBlack">
						<tr>
							<td width="50%" valign="top"><li><strong title="'.$row2["description"].'">'.$row2["feature"].'</strong></td>
				';
				// Second column
				$row2 = mysql_fetch_assoc($result2);
				$counter2++;
				// If this is the 16th "feature", just say "More"
				if ($counter2 == 16){
					echo'	<td width="50%" valign="top"><li><strong title="Too many features to list!"><font color="#FF0000">More...</font></strong></font></td>';
				}else{
					if ($row2["feature"]){
						echo'	<td width="50%" valign="top"><li><strong title="'.$row2["description"].'">'.$row2["feature"].'</strong></td>';
					};
				};
				echo'
						</tr>
						</table>
					</td>
				</tr>
				';
			};
			// Bottom tab
			echo'
				<tr>
					<!-- Tell \'em about battery life -->
					<td width="100%" colspan="3" align="right" bgcolor="#FFFFFF" background="images/TabBottomSmall.gif" class="smallWhite" style="background-position: right; background-repeat: no-repeat; background-attachment: scroll;">
<!--						Talk Time: <strong>'.$row["talk_time"].'</strong><em>, <strong>Standby Time:</strong></em> <strong>'.$row["standby_time"].'</strong>&nbsp;&nbsp;-->
						<strong>'.$row["talk_time"].' Talk Time, '.$row["standby_time"].' Standby Time</strong>&nbsp;&nbsp;
						
					</td>
				</tr>
				</table>
			</td>
		</tr>
			';
		// If there are more phones, draw a line
		if ($counter < mysql_num_rows($result)){
			echo'
		<tr>
			<td width="100%" colspan="3" bgcolor="#E20074">
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
			</td>
		</tr>
			';
		};
			echo'
		</table>
				';
			};
		};
		?>
	</td>
	<!-- Right border -->
	<td width="2" bgcolor="#E20074">
		<img src="images/spacer.gif" alt="" width="2" height="2" border="0">
	</td>
</tr>
<tr>
	<!-- footer -->
	<td width="100%" height="15" colspan="3" bgcolor="#E20074" class="smallWhite">
		<strong>&nbsp;*Additional service fees may apply.&nbsp;&nbsp;Phone price with new activation after available promotions &amp; rebates.</strong>
	</td>
</tr>
</table>

<!-- END Include phones.php -->	