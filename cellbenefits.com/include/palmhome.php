<!-- BEGIN Include home.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<!-- Featured Phones -->
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Featured Phones</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
<?
// Build list of 3 featured products for the first row
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
	if (!$carrier_selected){
		$rs_featured = mysql_query("SELECT * FROM phones WHERE display <> 'N' AND manufacturer = 'Palm' AND (carrier = 'Nextel' OR carrier = 'Sprint') ORDER BY rand() LIMIT 3", $linkID);
	}else{
		$rs_featured = mysql_query("SELECT * FROM phones WHERE display <> 'N' AND manufacturer = 'Palm' AND carrier = '$carrier_selected' ORDER BY rand() LIMIT 3", $linkID);
	}
// All others
}else{
	$rs_featured = mysql_query("SELECT * FROM phones WHERE display <> 'N' AND manufacturer = 'Palm' AND carrier = '$carrier_selected' ORDER BY rand() LIMIT 3", $linkID);
}

// Found some! (more than NONE)
if ($rs_featured){
	for ($counter=1; $counter <= mysql_num_rows($rs_featured); $counter++){
		$row = mysql_fetch_assoc($rs_featured);
//		$destination = "?sec=details&prod=";
		// Build a text string, with formatting, for the final sale price.
		$price = ($row["msrp"]-($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]+$row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]));
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
		$span = iif($row["at&t_3g"] == "T", 2, 3);
		echo'
			<td width="309" valign="top">
				<table border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td rowspan="2" valign="top"><a href="?sec=phones#'.$row["product_id"].'"><img src="images/phones/'.$row["thumbnail"].'" alt="Click for '.$row["manufacturer"].' '.$row["model"].' Features" title="Click for '.$row["manufacturer"].' '.$row["model"].' Features" width="70" height="130" border="0"></a></td>
					<td height="35" colspan="'.$span.'" valign="top" class="smallBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border=""><br><strong>'.$row["label"].'</strong></td>
		';
		if ($row["at&t_3g"] == "T"){
			echo'
					<td align="left">
						<img src="images/AT&T3gBug.gif" alt="" width="70" height="23" border="0">
					</td>
			';
		};
		echo'
				</tr>
				<tr>
					<td height="100" valign="top">
						<table width="140" border="0" cellspacing="1" cellpadding="0" class="smallBlack">
						<tr>
							<td align="right">$'.number_format($row["msrp"], 2).'</td>
							<td>&nbsp;regular price</td>
						</tr>
						<tr>
							<td align="right">-$';echo sprintf("%.2f", ($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]));echo'</td>
							<td>&nbsp;instant savings</td>
						</tr>
		';
		if ($row["mail_in".$pricing_level."-1"] != 0 || $row["mail_in".$pricing_level."-2"] != 0){
			echo'
						<tr>
							<td align="right">-$';echo sprintf("%.2f", ($row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]));echo'</td>
							<td>&nbsp;mail-in rebate'.iif($row["mail_in".$pricing_level."-1"] != 0 && $row["mail_in".$pricing_level."-2"] != 0, "s", "").'</td>
						</tr>
			';
		}
		echo'
						<tr>
							<td width="100%" colspan="2"><img src="images/BlackDot.gif" alt="" width="100%" height="1" border="0"></td>
						</tr>
						<tr>
							<td align="right" style="font-size:10px;"><strong>'.$total.'</strong></td>
							<td>&nbsp;'.$total_label.'</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<br>'.iif(($row["mail_in".$pricing_level."-1"] == 0 && $row["mail_in".$pricing_level."-2"] == 0), '<img src="images/spacer.gif" alt="" width="1" height="13" border="0"><br>', "").'
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
									document.PushPhone.phone_price.value=\''.$price.'\';
									document.PushPhone.submit();
								"><img src="images/'.$AddToOrderButton.'" alt="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" title="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" width="100" height="20" border="0"></a>
							</td>
						</tr>
						</table>
					</td>
					<td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td valign="top" class="smallBlack">
						<table width="89" border="0" cellspacing="0" cellpadding="0" bgcolor="'.$box_bg.'" class="smallBlack">
						<tr>
							<td valign="top"><li></td>
							<td>'.$row["bullet1"].'</td>
						</tr>
		';
		if ($row["bullet2"] != ""){
			echo'
						<tr>
							<td valign="top"><li></td>
							<td>'.$row["bullet2"].'</td>
						</tr>
			';
		}
		if ($row["bullet3"] != ""){
			echo'
						<tr>
							<td valign="top"><li></td>
							<td>'.$row["bullet3"].'</td>
						</tr>
			';
		}
		echo'
						<tr>
							<td colspan="2" align="center">
								<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
								<a href="?sec=phones#'.$row["product_id"].'" title="Click for '.$row["manufacturer"].' '.$row["model"].' Features" class="smallBlack"><strong>View Features</strong></a><br><br>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		';
		if ($counter < 3){
			echo'
			<td align="center"><img src="images/GrayDot.gif" alt="" width="1" height="120" border="0"></td>
			';
		}
	}
	if (($counter-1)%3!=0){ // Row not full
		if (fmod($counter, 3)==0){ //Only 2 products on this row
			echo'
			<td><img src="images/spacer.gif" alt="" width="310" height="1" border="0"></td>
			';
		};
		if (fmod($counter, 2)==0){ //Only 1 product on this row
			echo'
			<td><img src="images/spacer.gif" alt="" width="620" height="1" border="0"></td>
			';
		};
	};
}
?>
		</tr>
		</table>
	</td>
</tr>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<!-- Spacer -->
</tr>
	<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
</tr>
<!-- Promoted Phones --
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="930" border="0" cellspacing="0" cellpadding="0">
		<tr>
<?
// Build list of 6 promoted products for the second & third rows
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
	if (!$carrier_selected){
		$rs_promoed = mysql_query("SELECT * FROM phones WHERE display = 'P' AND (carrier = 'Nextel' OR carrier = 'Sprint') ORDER BY rand() LIMIT 6", $linkID);
	}else{
		$rs_promoed = mysql_query("SELECT * FROM phones WHERE display = 'P' AND carrier = '$carrier_selected' ORDER BY rand() LIMIT 6", $linkID);
	}
// All others
}else{
	$rs_promoed = mysql_query("SELECT * FROM phones WHERE display = 'P' AND carrier = '$carrier_selected' ORDER BY rand() LIMIT 6", $linkID);
}

// Build list of 6 promoted products for the second & third rows
//if (!$carrier_selected){
//	$rs_promoed = mysql_query("SELECT * FROM phones WHERE display = 'P' ORDER BY rand() LIMIT 6", $linkID);
//}else{
//	$rs_promoed = mysql_query("SELECT * FROM phones WHERE display = 'P' AND carrier = '$carrier_selected' ORDER BY rand() LIMIT 6", $linkID);
//}

// Found some! (more than NONE)
if ($rs_promoed){
	for ($counter=1; $counter <= mysql_num_rows($rs_promoed); $counter++){
		$row = mysql_fetch_assoc($rs_promoed);
//		$destination = "?sec=details&prod=";
		// Build a text string, with formatting, for the final sale price.
		$price = ($row["msrp"]-($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]+$row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]));
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
		$span = iif($row["at&t_3g"] == "T", 2, 3);
		echo'
			<td width="309" valign="top">
				<table border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td rowspan="2" valign="top"><a href="?sec=phones#'.$row["product_id"].'"><img src="images/phones/'.$row["thumbnail"].'" alt="Click for '.$row["manufacturer"].' '.$row["model"].' Features" title="Click for '.$row["manufacturer"].' '.$row["model"].' Features" width="70" height="130" border="0"></a></td>
					<td height="35" colspan="'.$span.'" valign="top" class="smallBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border=""><br><strong>'.$row["label"].'</strong></td>
		';
		if ($row["at&t_3g"] == "T"){
			echo'
					<td align="left">
						<img src="images/AT&T3gBug.gif" alt="" width="70" height="23" border="0">
					</td>
			';
		};
		echo'
				</tr>
				<tr>
					<td height="100" valign="top">
						<table width="140" border="0" cellspacing="1" cellpadding="0" class="smallBlack">
						<tr>
							<td align="right">$'.number_format($row["msrp"], 2).'</td>
							<td>&nbsp;regular price</td>
						</tr>
						<tr>
							<td align="right">-$';echo sprintf("%.2f", ($row["instant".$pricing_level."-1"]+$row["instant".$pricing_level."-2"]));echo'</td>
							<td>&nbsp;instant savings</td>
						</tr>
		';
		if ($row["mail_in".$pricing_level."-1"] != 0 || $row["mail_in".$pricing_level."-2"] != 0){
			echo'
						<tr>
							<td align="right">-$';echo sprintf("%.2f", ($row["mail_in".$pricing_level."-1"]+$row["mail_in".$pricing_level."-2"]));echo'</td>
							<td>&nbsp;mail-in rebate'.iif($row["mail_in".$pricing_level."-1"] != 0 && $row["mail_in".$pricing_level."-2"] != 0, "s", "").'</td>
						</tr>
			';
		}
		echo'
						<tr>
							<td width="100%" colspan="2"><img src="images/BlackDot.gif" alt="" width="100%" height="1" border="0"></td>
						</tr>
						<tr>
							<td align="right" style="font-size:10px;"><strong>'.$total.'</strong></td>
							<td>&nbsp;'.$total_label.'</td>
						</tr>
						<tr>
							<td colspan="2" align="center" valign="bottom">
								<br>'.iif(($row["mail_in".$pricing_level."-1"] == 0 && $row["mail_in".$pricing_level."-2"] == 0), '<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>', "").'
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
									document.PushPhone.phone_price.value=\''.$price.'\';
									document.PushPhone.submit();
								"><img src="images/'.$AddToOrderButton.'" alt="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" title="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" width="100" height="20" border="0"></a>
							</td>
						</tr>
						</table>
					</td>
					<td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td valign="top" class="smallBlack">
						<table width="89" border="0" cellspacing="0" cellpadding="0" bgcolor="'.$box_bg.'" class="smallBlack">
						<tr>
							<td valign="top"><li></td>
							<td>'.$row["bullet1"].'</td>
						</tr>
		';
		if ($row["bullet2"] != ""){
			echo'
						<tr>
							<td valign="top"><li></td>
							<td>'.$row["bullet2"].'</td>
						</tr>
			';
		}
		if ($row["bullet3"] != ""){
			echo'
						<tr>
							<td valign="top"><li></td>
							<td>'.$row["bullet3"].'</td>
						</tr>
			';
		}
		echo'
						<tr>
							<td colspan="2" align="center">
								<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
								<a href="?sec=phones#'.$row["product_id"].'" title="Click for '.$row["manufacturer"].' '.$row["model"].' Features" class="smallBlack"><strong>View Features</strong></a><br><br>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
				';
				if (($counter==3) && ($counter < mysql_num_rows($rs_promoed))){ // First row is full and there are more, make second row
					echo'
		</tr>		
		</table>	
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid '.$border_color.'; border-right: 1px solid '.$border_color.';">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="310" align="center"><img src="images/GrayDot.gif" alt="" width="275" height="1" border="0"></td>
			<td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td width="310" align="center"><img src="images/GrayDot.gif" alt="" width="275" height="1" border="0"></td>
			<td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td width="310" align="center"><img src="images/GrayDot.gif" alt="" width="275" height="1" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Third row of promo boxes --
<tr>
	<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid '.$border_color.'; border-right: 1px solid '.$border_color.';">
		<table width="930" border="0" cellspacing="0" cellpadding="0">
		<tr>
					';
				};
		if (($counter)%3!=0){
			echo'
			<td align="center"><img src="images/GrayDot.gif" alt="" width="1" height="120" border="0"></td>
			';
		}
	}
//	if (($counter-1)%3!=0){ // Row not full
//		if (fmod($counter, 3)==0){ //Only 2 products on this row
//			echo'
//			<td><img src="images/spacer.gif" alt="" width="310" height="1" border="0"></td>
//			';
//		};
//		if (fmod($counter, 2)==0){ //Only 1 product on this row
//			echo'
//			<td><img src="images/spacer.gif" alt="" width="620" height="1" border="0"></td>
//			';
//		};
//	}
}
?>
		</tr>
		</table>
	</td>
</tr>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
-->

</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
	<? if ($sprint_site == "T" || $nextel_site == "T" ){ ?>
	<td width="930" height="350" colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;"><img src="images/palm_home_bb_centro.jpg" alt="" width="922" height="339" border="0" usemap="#CentroAd" ismap></td>
	<map name="CentroAd" id="CentroAd">
		<area alt="Palm Centro" coords="55,270 160,290" href="?sec=phones#154"> 
	</map>
	<? }elseif ($cingular_site == "T"){ ?>
	<td width="930" height="350" colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;"><img src="images/palm_home_bb_750.jpg" alt="" width="922" height="341" border="0" usemap="#750Ad" ismap></td>
	<map name="750Ad" id="750Ad">
		<area alt="Palm 750" coords="35,290 130,310" href="?sec=phones#100"> 
	</map>
	<? }elseif ($verizon_site == "T"){ ?>
	<td width="930" height="350" colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;"><img src="images/palm_home_bb_700wx.jpg" alt="" width="922" height="340" border="0" usemap="#700wxAd" ismap></td>
	<map name="700wxAd" id="700wxAd">
		<area alt="Palm 700wx" coords="45,265 145,285" href="?sec=phones#168"> 
	</map>
	<? } ?>
</tr>
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

<!-- END Include home.php -->
