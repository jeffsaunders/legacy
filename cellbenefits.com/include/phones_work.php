<!-- BEGIN Include phones.php -->

<?
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
	$tab2_link = "?sec=phones&cargo=nextel";
	$tab3_link = "?sec=phones&cargo=all";
	$query = "SELECT * FROM phones WHERE display <> 'N' AND carrier = 'Nextel' ORDER BY manufacturer, model";
//}else if(!$cargo || $cargo == "all"){
}else{
	$tab1_label = "All Phones";
	$tab2_label = "All Sprint Phones";
	$tab3_label = "All Nextel Phones";
	$tab2_link = "?sec=phones&cargo=sprint";
	$tab3_link = "?sec=phones&cargo=nextel";
	$query = "SELECT * FROM phones WHERE display <> 'N' ORDER BY carrier, manufacturer, model";
}

?>
<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
		<!-- Tabs -->
		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<!-- Yellow Tab (Tab1)-->
			<td width="199" align="center" background="images/YellowTab200BG.gif" class="bigBlack"><strong><? echo $tab1_label; ?></strong></td>
			<td><img src="images/spacer.gif" alt="" width="5" height="25" border="0"></td>
			<!-- Tab2-->
			<td width="199" align="center" background="images/GrayTab200BG.gif"><a href="<? echo $tab2_link; ?>" class="bigWhite"><strong><? echo $tab2_label; ?></strong></a></td>
			<td><img src="images/spacer.gif" alt="" width="5" height="25" border="0"></td>
			<!-- Tab3-->
			<td width="199" align="center" background="images/GrayTab200BG.gif"><a href="<? echo $tab3_link; ?>" class="bigWhite"><strong><? echo $tab3_label; ?></strong></a></td>
		</tr>
		</table>
	</td>
	<td><img src="images/spacer.gif" alt="" width="150" height="25" border="0"></td>
</tr>
	<td colspan="2" bgcolor="#FFE100"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<?
// Build list of all the requested phones
$rs_phones = mysql_query($query, $linkID);

// Found some! (more than NONE)
if ($rs_phones){
	for ($counter=1; $counter <= mysql_num_rows($rs_phones); $counter++){
		$row = mysql_fetch_assoc($rs_phones);
//		$destination = "?sec=details&prod=";
		// Build a text string, with formatting, for the final sale price.
		$price = ($row["msrp"]-($row["instant1"]+$row["instant2"]+$row["mail_in1"]+$row["mail_in2"]));
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
		echo'
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="350" valign="top">
				<table border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td rowspan="2"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
					<td rowspan="2" align="center" valign="top"><img src="images/'.iif($row["carrier"] == "Sprint", "SprintLogo.gif", "NextelLogo.gif").'" alt="" width="100" height="40" border="0"><br><a href="#"><img src="images/phones/'.$row["thumbnail"].'" alt="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" title="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" width="70" height="130" border="0"></a></td>
					<td colspan="3" class="smallBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><strong>'.$row["label"].'</strong></td>
				</tr>
				<tr>
					<td width="245" align="center" valign="top">
						<table width="175" border="0" cellspacing="1" cellpadding="0" class="bodyBlack">
						<br>
						<tr>
							<td align="right">$'.$row["msrp"].'</td>
							<td>&nbsp;regular price</td>
						</tr>
						<tr>
							<td align="right">-$';echo sprintf("%.2f", ($row["instant1"]+$row["instant2"]));echo'</td>
							<td>&nbsp;instant savings</td>
						</tr>
						<tr>
							<td align="right">-$';echo sprintf("%.2f", ($row["mail_in1"]+$row["mail_in2"]));echo'</td>
							<td>&nbsp;mail-in rebate'.iif(($row["mail_in1"] != 0 && $row["mail_in2"] != 0), "s", "").'</td>
						</tr>
						<tr>
							<td width="100%" colspan="2"><img src="images/BlackDot.gif" alt="" width="100%" height="1" border="0"></td>
						</tr>
						<tr>
							<td align="right"><strong>'.$total.'</strong></td>
							<td>&nbsp;'.$total_label.'</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
								<a href="#"><img src="images/AddToOrderButton.gif" alt="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" title="Click to Add '.$row["manufacturer"].' '.$row["model"].' to Your Order" width="100" height="20" border="0"></a>
							</td>
						</tr>
						</table>
					</td>
<!--					<td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td valign="top" class="smallBlack">
						<table width="89" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
						<tr>
							<td valign="top"><li></td>
							<td>'.$row["bullet1"].'</td>
						</tr>
						<tr>
							<td valign="top"><li></td>
							<td>'.$row["bullet2"].'</td>
						</tr>
		';
//		if ($row["bullet3"] != ""){
			echo'
						<tr>
							<td valign="top"><li></td>
							<td>'.$row["bullet3"].'</td>
						</tr>
			';
//		}
		echo'
						<tr>
							<td colspan="2" align="center">
								<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
								<a href="#" title="Click for '.$row["manufacturer"].' '.$row["model"].' Details" class="smallBlack"><strong>View Details</strong></a>
							</td>
						</tr>
						</table>
					</td>-->
				</tr>
				</table>
			</td>
			<td valign="top">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<!-- Features Table -->
				<table width="560" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#EFEFEF">
				<tr>
					<td width="100%" height="15" bgcolor="#FFE100" class="bodyBlack">
						<strong>&nbsp;Features</strong>
					</td>
				</tr>
				';
			// Look up all the features of this phone and build a table to display them
			$prod_id = $row["product_id"];
			$rs_features = mysql_query("SELECT * FROM features WHERE product_id = '$prod_id' LIMIT 19", $linkID); //Only room for 19
			for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){ // Counter loop within a loop, hence counter2
				$row2 = mysql_fetch_assoc($rs_features);
				// First column
				echo'
				<tr>
					<td valign="top">
						<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="smallBlack">
						<tr>
				';
				// If this is the 1st "feature", tell them the band/mode
				if ($counter2 == 1){
					echo'	<td width="50%" valign="top"><li>'.$row["band"].'</td>';
				}else{
					echo'	<td width="50%" valign="top"><li>'.$row2["feature"].'</td>';
					// next row
					$counter2++;
					$row2 = mysql_fetch_assoc($rs_features);
				};
				// Second column
				if ($row2["feature"]){
					echo'	<td width="50%" valign="top"><li>'.$row2["feature"].'</td>';
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
					<!-- Tell \'em about size & battery life -->
					<td width="100%" colspan="3" align="right" bgcolor="#FFE100">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
						<tr>
							<td><strong>&nbsp;Size:</strong> '.$row["size"].', '.$row["weight"].'</td>
							<td align="right"><strong>Talk Time:</strong> '.$row["talk_time"].'&nbsp;</td>
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
	<td width="100%" colspan="2" align="center" bgcolor="#FFFFFF"><img src="images/GrayDot.gif" alt="" width="910" height="1" border="0"></td>
</tr>
			';
		};
	};
}
?>

</table>

<!-- END Include phones.php -->	
