<!-- BEGIN Include phones.php -->

<?
//Set up tabs
if (!$carrier_selected){
	if($cargo == "sprint"){
		$tab1_label = "All Sprint Phones";
		$tab2_label = "All Nextel Phones";
		$tab3_label = "All Phones";
		$tab2_link = "?sec=phones&cargo=nextel";
		$tab3_link = "?sec=phones&cargo=all";
		$query = "SELECT * FROM phones WHERE display <> 'N' AND carrier = 'Sprint' ORDER BY manufacturer, model";
	}else if($cargo == "nextel"){
		$tab1_label = "All Nextel Phones";
		$tab2_label = "All Sprint Phones";
		$tab3_label = "All Phones";
		$tab2_link = "?sec=phones&cargo=sprint";
		$tab3_link = "?sec=phones&cargo=all";
		$query = "SELECT * FROM phones WHERE display <> 'N' AND carrier = 'Nextel' ORDER BY manufacturer, model";
	//}else if(!$cargo || $cargo == "all"){
	}else{
		$tab1_label = "All Phones";
		$tab2_label = "All Sprint Phones";
		$tab3_label = "All Nextel Phones";
		$tab2_link = "?sec=phones&cargo=sprint";
		$tab3_link = "?sec=phones&cargo=nextel";
		$query = "SELECT * FROM phones WHERE display <> 'N' AND (carrier = 'Sprint' OR carrier = 'Nextel') ORDER BY carrier DESC, manufacturer, model";
	}
}else{
	$tab1_label = "All ".$carrier_selected." Phones";
	$query = "SELECT * FROM phones WHERE display <> 'N' AND carrier = '$carrier_selected' ORDER BY manufacturer, model";
}

?>
<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
		<!-- Tabs -->
		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<!-- Foreground Tab (Tab1) -->
			<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong><? echo $tab1_label; ?></strong></td>
			<td><img src="images/spacer.gif" alt="" width="5" height="25" border="0"></td>
			<?
			if (!$carrier_selected){
				echo'
			<!-- Tab2 (if Sprint-Nextel and neither chosen yet -->
			<td width="199" align="center" background="images/GrayTab200BG.gif"><a href="'.$tab2_link.'" class="bigWhite"><strong>'.$tab2_label.'</strong></a></td>
			<td><img src="images/spacer.gif" alt="" width="5" height="25" border="0"></td>
			<!-- Tab3 (if Sprint-Nextel and neither chosen yet -->
			<td width="199" align="center" background="images/GrayTab200BG.gif"><a href="'.$tab3_link.'" class="bigWhite"><strong>'.$tab3_label.'</strong></a></td>
				';
			}
			?>
		</tr>
		</table>
	</td>
	<td><img src="images/spacer.gif" alt="" width="150" height="25" border="0"></td>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<?
// Build list of all the requested phones
$rs_phones = mysql_query($query, $linkID);

// Found some! (more than NONE)
if ($rs_phones){
	for ($counter=1; $counter <= mysql_num_rows($rs_phones); $counter++){
		$row = mysql_fetch_assoc($rs_phones);
		// Build a text string, with formatting, for the final sale price.
		$price = ($row["msrp"]-($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]+$row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]));
		// Yahoo AT&T Gift Cards
// 		if ($cingular_site == "T" && $site == "yahoo"){
		if ($gift_card > 0){
			$price -= $gift_card;
		}
		if (($price < .01) && ($price >= -.02)){ //Sometimes the total is slightly less than -.01
			// No price = "FREE"
			$total_label = 'your price*';
			$total = '<font color="#FF0000">FREE</font>';
		}elseif ($price < -.02){
			// You MAKE money
			$total_label = '<font color="#FF0000"><span id="pulse">in your pocket*</span></font>';
			$total = '<font color="#FF0000">$'.sprintf('%.2f', abs($price)).'</font>';
		}else{
			// If there is a price, show it with 2 decimal places
			$total_label = 'your price*';
			$total = '$'.sprintf('%.2f', $price);
		};
		// Decide if we need to leave room for the AT&T 3G animated bug
		$span = iif($row["at&t_3g"] == "T", 2, 3);
		echo'
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid '.$border_color.'; border-right: 1px solid '.$border_color.';">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="350" valign="top">
				<table border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td rowspan="2"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
					<td rowspan="2" align="center" valign="top">
						<!-- Display Phone Image -->
						<a name="'.$row["product_id"].'">
						<img src="images/'.$row["carrier"].'Logo.gif" alt="" width="100" height="40" border="0"><br>
						<a style="cursor:pointer;" onClick="
							document.PushPhone.carrier.value=\''.$row["carrier"].'\';
							document.PushPhone.affiliation.value=\''.$label.'\';
							document.PushPhone.phone_id.value=\''.$row["product_id"].'\';
							document.PushPhone.phone_manuf.value=\''.$row["manufacturer"].'\';
							document.PushPhone.phone_model.value=\''.$row["model"].'\';
							document.PushPhone.phone_type.value=\''.$row["phone_type"].'\';
							document.PushPhone.phone_msrp.value=\''.$row["msrp"].'\';
							document.PushPhone.phone_ir1.value=\''.$row["instant".$pricing_level."-1"].'\';
							document.PushPhone.phone_ir2.value=\''.$row["instant".$pricing_level."-2"].'\';
							document.PushPhone.phone_mir1.value=\''.$row["mail_in".$pricing_level."-1"].'\';
							document.PushPhone.phone_mir2.value=\''.$row["mail_in".$pricing_level."-2"].'\';
							document.PushPhone.phone_giftcard.value=\''.$gift_card.'\';
							document.PushPhone.phone_price.value=\''.$price.'\';
							document.PushPhone.submit();">
							<img src="images/phones/'.$row["thumbnail"].'" alt="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" title="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" width="70" height="130" border="0">
						</a>
					</td>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
						<tr>
							<!-- Phone label (model, manuf, etc.) -->
							<td>
								<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
								<strong>'.$row["label"].'</strong>
							</td>
		';
		// If it's an AT&T 3G phone display the little animated bug -->
		if ($row["at&t_3g"] == "T"){
			echo'
							<td width="70" align="right">
								<img src="images/AT&T3gBug.gif" alt="" width="70" height="23" border="0">
							</td>
			';
		};
		echo'
						</tr>
						<!-- Show hookline, if there is one -->
						<tr>
							<td colspan="2">
								'.iif(($row["hookline"] != ""), "<div align='center' class='bodyBlack'><font 	color='#FF0000'><strong><em>".$row["hookline"]."</em></strong></font></div>", "<br>").'
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<!-- Show price info -->
				<tr>
					<td width="245" align="center" valign="top">
						<table width="175" border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
						<tr>
							<td align="right">$'.number_format($row["msrp"], 2).'</td>
							<td>&nbsp;regular price</td>
						</tr>
		';
		if ($row["instant".$pricing_level."-1"] != 0 || $row["instant".$pricing_level."-2"] != 0){
			echo'
						<tr>
							<td align="right">-$';echo sprintf("%.2f", ($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]));echo'</td>
							<td>&nbsp;instant savings</td>
						</tr>
		';
		}
		// If there are any mail-in rebates....
		if ($row["mail_in".$pricing_level."-1"] != 0 || $row["mail_in".$pricing_level."-2"] != 0){
			echo'
						<tr>
							<td align="right">-$';echo sprintf("%.2f", ($row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]));echo'</td>
							<td>&nbsp;mail-in rebate'.iif(($row["mail_in".$pricing_level."-1"] != 0 && $row["mail_in".$pricing_level."-2"] != 0), "s", "").'</td>
						</tr>
			';
		}
//		if ($cingular_site == "T" && $site == "yahoo"){
 		if ($gift_card > 0){
			echo'
						<tr>
							<td align="right">-$';echo sprintf("%.2f", $gift_card);echo'</td>
							<td>&nbsp;Amex gift card</td>
						</tr>
			';
		}
		echo'
						<!-- Black line -->
						<tr>
							<td width="100%" colspan="2"><img src="images/BlackDot.gif" alt="" width="100%" height="1" border="0"></td>
						</tr>
						<!-- Total -->
						<tr>
							<td align="right"><strong>'.$total.'</strong></td>
							<td>&nbsp;'.$total_label.'</td>
						</tr>
						<!-- Add to order button -->
						<tr>
							<td colspan="2" align="center">
								<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
								<!-- If no mail-in rebate(s) then add a blank line so the buttons line up -->
								'.iif(($row["mail_in".$pricing_level."-1"] == 0 && $row["mail_in".$pricing_level."-2"] == 0), "<br>", "").'
								<a style="cursor:pointer;" onClick="
									document.PushPhone.carrier.value=\''.$row["carrier"].'\';
									document.PushPhone.affiliation.value=\''.$label.'\';
									document.PushPhone.phone_id.value=\''.$row["product_id"].'\';
									document.PushPhone.phone_manuf.value=\''.$row["manufacturer"].'\';
									document.PushPhone.phone_model.value=\''.$row["model"].'\';
									document.PushPhone.phone_type.value=\''.$row["phone_type"].'\';
									document.PushPhone.phone_msrp.value=\''.$row["msrp"].'\';
									document.PushPhone.phone_ir1.value=\''.$row["instant".$pricing_level."-1"].'\';
									document.PushPhone.phone_ir2.value=\''.$row["instant".$pricing_level."-2"].'\';
									document.PushPhone.phone_mir1.value=\''.$row["mail_in".$pricing_level."-1"].'\';
									document.PushPhone.phone_mir2.value=\''.$row["mail_in".$pricing_level."-2"].'\';
									document.PushPhone.phone_giftcard.value=\''.$gift_card.'\';
									document.PushPhone.phone_price.value=\''.$price.'\';
									document.PushPhone.submit();">
								<img src="images/'.$AddToOrderButton.'" alt="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" title="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" width="100" height="20" border="0"></a>
							</td>
						</tr>
						</table>
						
		';
		// If there is a gallery (360 view, etc.) display the button
		if ($row["gallery"] != ""){
			if ($sprint_site == "T" || $nextel_site == "T" ){
				echo'
						<div align="left"><a href="javascript:newwin=window.open(\''.$row["gallery"].'\',\'\',\'scrollbars=yes,width='.$row["gallery_width"].',height='.$row["gallery_height"].',center\');newwin.focus();" class="tinyBlack"><img src="images/ZoomButton.gif" alt="Interactive Demo" title="Interactive Demo" width="18" height="19" border="0"> Demo</a></div>
				';
			}elseif ($cingular_site == "T" ){
				echo'
						<div align="left"><a href="javascript:newwin=window.open(\''.$row["gallery"].'\',\'\',\'scrollbars=yes,width='.$row["gallery_width"].',height='.$row["gallery_height"].',center\');newwin.focus();" class="tinyBlack"><img src="images/ZoomButton.gif" alt="Interactive Demo" title="Interactive Demo" width="18" height="19" border="0"> Demo</a></div>
				';
			}
		}
		echo'
					</td>
				</tr>
				</table>
			</td>
			<td valign="top">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<!-- Features Table -->
				<table width="560" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="'.$box_bg.'">
				<tr>
					<td rowspan="22" bgcolor="'.$box_color.'"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td width="100%" height="15" bgcolor="'.$box_color.'" class="bodyWhite">
						<strong>&nbsp;Features</strong>
					</td>
					<td rowspan="22" bgcolor="'.$box_color.'"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
				</tr>
				';
			// Look up all the features of this phone and build a table to display them
			$prod_id = $row["product_id"];
			$rs_features = mysql_query("SELECT * FROM phone_features WHERE product_id = '$prod_id' AND feature <> '' LIMIT 19", $linkID); //Only room for 19
			for ($counter2=1; $counter2 < mysql_num_rows($rs_features); $counter2++){ // Counter loop within a loop, hence counter2
				$row2 = mysql_fetch_assoc($rs_features);
				// First column
				echo'
				<tr>
					<td valign="top">
						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="smallBlack">
						<tr>
							<td><img src="images/spacer.gif" alt="" width="2" height="1" border="0"></td>
				';
				// If this is the 1st "feature", tell them the band/mode
				if ($counter2 == 1 && $row["band"] != ""){
					echo'	<td width="50%" valign="top"><li>'.stripslashes($row["band"]).'</td>';
				}else{
					echo'	<td width="50%" valign="top"><li>'.stripslashes($row2["feature"]).'</td>';
					// next row (in result set)
					$counter2++;
					$row2 = mysql_fetch_assoc($rs_features);
				};
				// Second column
				if ($row2["feature"]){
					echo'	<td><img src="images/spacer.gif" alt="" width="2" height="1" border="0"></td>';
					echo'	<td width="50%" valign="top"><li>'.stripslashes($row2["feature"]).'</td>';
				};
				echo'
						</tr>
						</table>
					</td>
				</tr>
				';
			};
			// Features footer
			echo'
				<tr>
					<!-- Tell \'em about size & battery life -->
					<td width="100%" colspan="3" align="right" bgcolor="'.$box_color.'">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallWhite">
						<tr>
							<td><strong>&nbsp;&nbsp;Size:</strong> '.stripslashes($row["size"]).', '.$row["weight"].'</td>
							<td align="right"><strong>Talk Time:</strong> '.$row["talk_time"].'&nbsp;&nbsp;</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
		</tr>
		</table>
	</td>
</tr>
		';
		// Draw a gray line if if it's not the last phone
		if ($counter < mysql_num_rows($rs_phones)){
			echo'
<tr>
	<td width="100%" colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid '.$border_color.'; border-right: 1px solid '.$border_color.';">
		<img src="images/GrayDot.gif" alt="" width="910" height="1" border="0">
	</td>
</tr>
			';
		};
	};
}
?>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>

</table>

<div id="foo" style="position:absolute; top:-250; z-index:-1; visibility:hidden">
<?
// Load hidden forms for feeding cart.  Encase it in a div to hide it offscreen.
include "include/forms.php";
?>
</div>

<!-- END Include phones.php -->	
