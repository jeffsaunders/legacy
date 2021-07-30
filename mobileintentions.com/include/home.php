<!-- BEGIN Include home.php -->

<!-- <h#> tags found throughout are for SEO -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<!-- First row of promo boxes -->
<tr>
	<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<?
		// Build list of 3 featured products for the first row
		$result = mysql_query("SELECT * FROM phones WHERE display = 'F' ORDER BY rand() LIMIT 3", $linkID);

		// Found some! (more than NONE)
		if ($result){
			for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
				$row = mysql_fetch_assoc($result);
				$destination = "?sec=details&prod=";
				$prod_id = $row["product_id"];
				echo'
			<td><img src="images/spacer.gif" alt="" width="12" height="1" border="0"></td>
			<td width="300">
				<table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
				<!-- Tab Top -->
				<tr>
					<h1><td height="24" background="images/TabTop.gif" class="bodyWhite"><strong>&nbsp;&nbsp;'.$row["manufacturer"].'&nbsp;'.$row["model"].'</strong></td></h1>
				</tr>
				<tr>
					<td background="images/TabBG.gif">
						<table width="280" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td><img src="images/spacer.gif" alt="" width="1" height="210" border="0"></td>
							<!-- Phone Image -->
							<td width="100">
								<a href="?sec=details&prod='.$row['product_id'].'">
								<img src="images/phones/'.$row["image"].'" alt="'.$row["manufacturer"].'&nbsp;'.$row["model"].'" name="fbox'.$counter.'" id="fbox'.$counter.'" width="100" height="200" border="0"></a>
							</td>
							<td width="10"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
							<td valign="top">
								<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
								<!-- Phone title -->
								<tr>
									<h1><td align="center" valign="top" class="biggerBlack">
										<nobr><strong>'.$row["manufacturer"].'&nbsp;'.$row["model"].'</strong></nobr>
									</td></h1>
								</tr>
								<!-- Tagline -->
								<tr>
									<td align="center" valign="top" class="bigBlack">
										'.$row["tagline"].'<br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									</td>
								</tr>
								<!-- Black line -->
								<tr>
									<td width="100%" height="1" bgcolor="#000000">
										<img src="images/spacer.gif" alt="" width="180" height="1" border="0"><br>
									</td>
								</tr>
								<!-- Bullet point features -->
								<tr>
									<td valign="top" class="smallBlack">
									<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									<li><nobr>'.$row["bullet1"].'</nobr>
									<li><nobr>'.$row["bullet2"].'</nobr>
									<li><nobr>'.$row["bullet3"].'</nobr>
									<br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									</td>
								</tr>
								<!-- Black line -->
								<tr>
									<td width="100%" height="1" bgcolor="#000000">
										<img src="images/spacer.gif" alt="" width="180" height="1" border="0"><br>
									</td>
								</tr>
								<!-- Hookline -->
								<tr>
									<td align="center" valign="top" class="bodyBlack">
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<nobr><strong>'.$row["hookline"].'</strong></nobr><br>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
									</td>
								</tr>
				';
				// Build a text tring, with formatting, for the final sale price.
				$price = ($row["msrp"]-($row["instant1"]+$row["instant2"]+$row["mail_in"]));
				if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
					// No price = "FREE"
					$total_label = 'Your Price*';
					$total = '<font color="#FF0000">FREE</font>';
				}elseif ($price < -.02){
					// You MAKE money
					$total_label = '<font color="#FF0000"><span id="pulse">You Pocket*</span></font>';
					$total = '<font color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
				}else{
					// If there is a price, show it with 2 decimal places
					$total_label = 'Your Price*';
					$total = '<font color="#FF0000">$'.sprintf('%.2f', $price).'</font>';
				};
				echo '
								<tr>
									<td align="center" class="bigBlack">
										<strong>'.$total_label.'&nbsp;'.$total.'</strong><br>
										<strong class="smallBlack"><font color="#FF0000">+ FREE ACTIVATION!!</font></strong><br>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
<!--										<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>-->
									</td>
								</tr>
								<!-- "Tell Me More" Button -->
								<tr>
									<td align="center">
<!--										<a onClick="show(\'zipprompt1\',\''.$destination.'\',\''.$prod_id.'\');" style="cursor:pointer;">-->
										<a href="?sec=details&prod='.$row['product_id'].'">
										<img src="images/TellMeMore.gif" alt="Tell me more about the '.$row["manufacturer"].'&nbsp;'.$row["model"].'" width="125" height="25" border="0"></a><br>
									</td>
								</tr>
								</table>
							</td>
						</tr>						
						</table>
					</td>
				</tr>
				<!-- Bottom Line -->
				<tr>
					<td bgcolor="#E20074"><img src="images/spacer.gif" alt="" width="100%" height="2" border="0"></td>
				</tr>
				</table>
			</td>
				';
			};
			if (($counter-1)%3!=0){ // Row not full
				if (fmod($counter, 3)==0){ //Only 2 products on this row
					echo'
			<td><img src="images/spacer.gif" alt="" width="312" height="1" border="0"></td>
					';
				};
				if (fmod($counter, 2)==0){ //Only 1 product on this row
					echo'
			<td><img src="images/spacer.gif" alt="" width="624" height="1" border="0"></td>
					';
				};
			};
		};
		?>
			<td><img src="images/spacer.gif" alt="" width="12" height="1" border="0"></td>
		</tr>		
		</table>	
	</td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
</tr>
<!-- Second & third rows of promo boxes -->
<tr>
	<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<?
		// Build list of 6 non-featured products for the second & third rows
		// For only 1 row (6 boxes total) change limit to "3" at the end of query
		$result = mysql_query("SELECT * FROM phones WHERE display = 'P' ORDER BY rand() LIMIT 6", $linkID);
//		$result = mysql_query("SELECT * FROM phones WHERE display = 'P' ORDER BY rand() LIMIT 3", $linkID);
		// Found some! (more than NONE)
		if ($result){
			for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
				$row = mysql_fetch_assoc($result);
				$destination = "?sec=details&prod=";
				$prod_id = $row["product_id"];
				echo'
			<td><img src="images/spacer.gif" alt="" width="12" height="1" border="0"></td>
			<td width="300">
				<table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
				<!-- Tab Top -->
				<tr>
					<h1><td height="24" background="images/TabTop.gif" class="bodyWhite"><strong>&nbsp;&nbsp;'.$row["manufacturer"].'&nbsp;'.$row["model"].'</strong></td></h1>
				</tr>
				<tr>
					<td background="images/TabBG.gif">
						<table width="280" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td><img src="images/spacer.gif" alt="" width="1" height="210" border="0"></td>
							<!-- Phone Image -->
							<td width="100">
								<a href="?sec=details&prod='.$row['product_id'].'">
								<img src="images/phones/'.$row["image"].'" alt="'.$row["manufacturer"].'&nbsp;'.$row["model"].'" name="pbox'.$counter.'" id="pbox'.$counter.'" width="100" height="200" border="0"></a>
							</td>
							<td width="10"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
							<td valign="top">
								<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
								<!-- Phone title -->
								<tr>
									<h1><td align="center" valign="top" class="biggerBlack">
										<nobr><strong>'.$row["manufacturer"].'&nbsp;'.$row["model"].'</strong></nobr>
									</td></h1>
								</tr>
								<!-- Tagline -->
								<tr>
									<td align="center" valign="top" class="bigBlack">
										'.$row["tagline"].'<br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									</td>
								</tr>
								<!-- Black line -->
								<tr>
									<td width="100%" height="1" bgcolor="#000000">
										<img src="images/spacer.gif" alt="" width="180" height="1" border="0"><br>
									</td>
								</tr>
								<!-- Bullet point features -->
								<tr>
									<td valign="top" class="smallBlack">
									<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									<li><nobr>'.$row["bullet1"].'</nobr>
									<li><nobr>'.$row["bullet2"].'</nobr>
									<li><nobr>'.$row["bullet3"].'</nobr>
									<br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
									</td>
								</tr>
								<!-- Black line -->
								<tr>
									<td width="100%" height="1" bgcolor="#000000">
										<img src="images/spacer.gif" alt="" width="180" height="1" border="0"><br>
									</td>
								</tr>
								<!-- Hookline -->
								<tr>
									<td align="center" valign="top" class="bodyBlack">
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<nobr><strong>'.$row["hookline"].'</strong></nobr><br>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
									</td>
								</tr>
				';
				// Build a text tring, with formatting, for the final sale price.
				$price = ($row["msrp"]-($row["instant1"]+$row["instant2"]+$row["mail_in"]));
				if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
					// No price = "FREE"
					$total_label = 'Your Price*';
					$total = '<font color="#FF0000">FREE</font>';
				}elseif ($price < -.02){
					// You MAKE money
					$total_label = '<font color="#FF0000"><span id="pulse">You Pocket*</span></font>';
					$total = '<font color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
				}else{
					// If there is a price, show it with 2 decimal places
					$total_label = 'Your Price*';
					$total = '<font color="#FF0000">$'.sprintf('%.2f', $price).'</font>';
				};
				echo '
								<tr>
									<td align="center" class="bigBlack">
										<strong>'.$total_label.'&nbsp;'.$total.'</strong><br>
										<strong class="smallBlack"><font color="#FF0000">+ FREE ACTIVATION!!</font></strong><br>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
									</td>
								</tr>
								<!-- "Tell Me More" Button -->
								<tr>
									<td align="center">
<!--										<a onClick="show(\'zipprompt1\',\''.$destination.'\',\''.$prod_id.'\');" style="cursor:pointer;">-->
										<a href="?sec=details&prod='.$row['product_id'].'">
										<img src="images/TellMeMore.gif" alt="Tell me more about the '.$row["manufacturer"].'&nbsp;'.$row["model"].'" width="125" height="25" border="0"></a><br>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<!-- Bottom Line -->
				<tr>
					<td bgcolor="#E20074"><img src="images/spacer.gif" alt="" width="100%" height="2" border="0"></td>
				</tr>
				</table>
			</td>
				';
				if (($counter==3) && ($counter < mysql_num_rows($result))){ // First row is full and there are more, make second row
					echo'
			<td><img src="images/spacer.gif" alt="" width="12" height="1" border="0"></td>
		</tr>		
		</table>	
	</td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
</tr>
<!-- Third row of promo boxes -->
<tr>
	<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
					';
				};
			};
			if (($counter-1)%3!=0){ // Row not full
				if ((fmod($counter, 3)==0) || (fmod($counter, 6)==0)){ //Only 2 products on this row
					echo'
			<td><img src="images/spacer.gif" alt="" width="312" height="1" border="0"></td>
					';
				}else{ //Only 1 product on this row
					echo'
			<td><img src="images/spacer.gif" alt="" width="624" height="1" border="0"></td>
					';
				};
			};
		};
		?>
			<td><img src="images/spacer.gif" alt="" width="12" height="1" border="0"></td>
		</tr>		
		</table>	
	</td>
</tr>
</table>
<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
<table width="925" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Label Tab -->
	<td colspan="3" background="images/TabTop.gif" class="bodyWhite">
		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td height="24" class="bodyWhite"><strong>&nbsp;&nbsp;More Phones</strong></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<!-- Left border -->
	<td width="2" bgcolor="#E20074">
		<img src="images/spacer.gif" alt="" width="2" height="2" border="0">
	</td>
	<!-- Content -->
	<td width="100%" bgcolor="#FFFFFF">
		<table border="0" cellspacing="0" cellpadding="0" background="images/CWOBG.jpg" bgcolor="#FFFFFF" style="background-position: right; background-repeat: no-repeat; background-attachment: scroll;">
		<tr>
			<td width="250" height="175" align="center">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<a href="http://www.crazywirelessoffers.com"><img src="images/CWOLogo240x150.gif" alt="" width="240" height="150" border="0"></a><br>
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
			</td>
			<td width="535" class="bodyBlack">
				<strong>
				<img src="images/spacer.gif" alt="" width="75" height="1" border="0">&raquo; Not interested in any of these phones?<br>
				<img src="images/spacer.gif" alt="" width="100" height="1" border="0">&raquo; Want to see what other carriers have to offer?<br>
				<img src="images/spacer.gif" alt="" width="125" height="1" border="0">&raquo; Want to see more FREE phones?<br><br></strong>
				<div align="center">
				<a href="http://www.crazywirelessoffers.com" class="bodyBlack">Click Here to visit our business partner<br>
				<font size="+2"><strong>Crazy Wireless Offers</strong></font></a><br><br>
				<strong><em>Home of CraZy RoB's InSaNe Cellphone Offers</em><br>
				</div>
				<img src="images/spacer.gif" alt="" width="300" height="1" border="0">... Most <font color="#FF0000">FREE!</font></strong>
			</td>
			<td width="140" align="right" valign="top">
				<img src="images/spacer.gif" alt="" width="1" height="45" border="0"><br>
				<img src="images/CarrierLogosAni4.gif" alt="" name="carriers" id="carriers" width="100" height="40" border="0">
				<img src="images/spacer.gif" alt="" width="20" height="1" border="0">
			</td>
		</tr>
		</table>
	</td>
	<!-- Right border -->
	<td width="2" bgcolor="#E20074">
		<img src="images/spacer.gif" alt="" width="2" height="2" border="0">
	</td>
</tr>
<tr>
	<!-- footer -->
	<td width="100%" height="15" colspan="3" bgcolor="#E20074" class="smallWhite">
<!--		<strong>&nbsp;*Additional service fees may apply.&nbsp;&nbsp;Phone price with new activation after available promotions &amp; rebates.</strong>-->
	</td>
</tr>
</table>

<!-- END Include home.php -->
