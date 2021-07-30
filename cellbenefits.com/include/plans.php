<!-- BEGIN Include plans.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Service Plans</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</tr>
	<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
	<?	
	// Sprint-Nextel sites
	if ($sprint_site == "T" || $nextel_site == "T" ){
		//Grab plan names (groups)
		$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'sprint-nextel' AND display = 'T' GROUP BY group_name ORDER BY group_position";
		$rs_plan_names = mysql_query($query, $linkID);
	?>
		<table width="930" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="900" class="bigBlack">
				<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
				<ul>
					Sprint offers service plan choices to bring you access to more of what you need so you can do more of what you want. And their <a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-30DayRiskFreeGuarantee.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" class="bigBlack" style="text-decoration:underline;">30-Day Risk-Free Guarantee</a> lets you try their services risk free. You only need to select the plan that fits you and your family best.
				</ul>
			</td>
			<td>
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
				<a href="javascript:newwin=window.open('https://manage.sprintpcs.com/rpa/zip.html?navID=0','','scrollbars=yes,width=500,height=400,center');newwin.focus();"><img src="images/SprintPlanAdvisor.gif" alt="" width="365" height="100" border="0"></a><img src="images/spacer.gif" alt="" width="15" height="1" border="0">
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr>
			<td width="930" height="15">
				<div align="center" class="xbigBlack"><br><strong>&mdash; Individual Plans &mdash;</strong></div><br>
			<?
			$family_plans = false;
			$data_labelled = false;
			$family_labelled = false;
			for ($counter=1; $counter <= mysql_num_rows($rs_plan_names); $counter++){
				$groups = mysql_fetch_assoc($rs_plan_names);
				$group = $groups["group_name"];
				$query = "SELECT * FROM plan_features WHERE group_id = '".$groups["group_id"]."'";
				$rs_features = mysql_query($query, $linkID);
				$query = "SELECT * FROM plans WHERE group_id = '".$groups["group_id"]."' AND display = 'T' ORDER BY cost";
				$rs_plans = mysql_query($query, $linkID);
				$plan = mysql_fetch_assoc($rs_plans);
				mysql_data_seek($rs_plans,0);  // go back to the top
				if ($plan["plan_type"] == "D" && $data_labelled == false){
					echo'
				<div align="center" class="xbigBlack"><br><strong>&mdash; Broadband Data Plans &mdash;</strong></div><br>
					';
					$data_labelled = true;
				}
				if ($plan["family_plan"] == "T" && $family_labelled == false){
					echo'
				<div align="center" class="xbigBlack"><br><strong>&mdash; Family Share Plans &mdash;</strong></div><br>
					';
					$family_labelled = true;
				}
				echo'
				<table width="900" border="" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
				<tr bgcolor="#58639B">
					<td width="900" colspan="6" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plans</strong></td>
				</tr>
				<tr bgcolor="#FFFFEF">
					<td width="900" colspan="6" class="bodyBlack">
						<br>
				';
				if (mysql_num_rows($rs_features) > 1){
					echo'
						<ul>
					';
					for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
						$row = mysql_fetch_assoc($rs_features);
						echo' <li>'.$row["feature"].'</li>';
					}
					echo'
						<ul><br>
					';
				}else{
					$row = mysql_fetch_assoc($rs_features);
					echo $row["feature"];
				};
				echo'
					</td>
				</tr>
				';
				if ($sprint_discount == 0 && $nextel_discount == 0){
					echo'
				<tr bgcolor="#58639B" class="bodyWhite">
					<td width="100" align="center">Included Minutes</td>
					<td width="350" align="center">Additional Minutes</td>
					<td width="250" align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
					<td width="200" align="center">Cost per Month</td>
				</tr>
					';
					for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
						$row = mysql_fetch_assoc($rs_plans);
						if ($row["nights_unlimited"] == "T") $nights = "Unlimited";
						if ($row["nights_unlimited"] == "F") $nights = "Limited";
						if ($row["nights_unlimited"] == "NA") $nights = "N/A";
						echo'
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
						<td align="center">'.$nights.'</td>
						<td align="center">$'.money_format('%i', $row["cost"]).'</td>
					</tr>
						';
					}
					echo'
					</table>
					<br>
					';
				}else{
					$discountable = true;
					if ($sprint_discount == $nextel_discount){
						echo'
				<tr bgcolor="#58639B" class="bodyWhite">
					<td width="100" align="center">Included Minutes</td>
					<td width="300" align="center">Additional Minutes</td>
					<td width="200" align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
					<td width="150" align="center">Cost per Month</td>
					<td width="150" align="center">Your Cost per Month<br><span class="smallWhite">(With your '.round($sprint_discount).'% discount)</span></td>
				</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["nights_unlimited"] == "T") $nights = "Unlimited";
							if ($row["nights_unlimited"] == "F") $nights = "Limited";
							if ($row["nights_unlimited"] == "NA") $nights = "N/A";
							if ($row["discountable"] == 'F'){
								$discountable = false;
								echo'
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
						<td align="center">'.$nights.'</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
					</tr>
								';
							}else{
								echo'
					<tr bgcolor="#FFFFFF" class="bodyBlack">
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
						<td align="center">'.$nights.'</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($sprint_discount*.01)))).'</td>
					</tr>
								';
							}
						}
					}else{ // Sprint and Nextel discounts are different
						echo'
				<tr bgcolor="#58639B" class="bodyWhite">
					<td width="100" align="center">Included Minutes</td>
					<td width="250" align="center">Additional Minutes</td>
					<td width="175" align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
					<td width="125" align="center">Cost per Month</td>
					<td width="250" colspan="2" align="center">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyWhite">
						<tr>
							<td colspan="2" align="center">Your Cost per Month</td>
						</tr>
						<tr>
							<td width="125" align="center"><span class="smallWhite">(Sprint '.round($sprint_discount).'% Discount)</span></td>
							<td width="125" align="center"><span class="smallWhite">(Nextel '.round($nextel_discount).'% Discount)</span></td>
						</tr>
						</table>
					</td>
				</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["nights_unlimited"] == "T") $nights = "Unlimited";
							if ($row["nights_unlimited"] == "F") $nights = "Limited";
							if ($row["nights_unlimited"] == "NA") $nights = "N/A";
							if ($row["discountable"] == 'F'){
								$discountable = false;
								echo'
				<tr bgcolor="#FFFFFF" class="bodyBlack">
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
					<td align="center">'.$nights.'</td>
					<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
					<td width="125" align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
					<td width="125" align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
				</tr>
								';
							}else{
								echo'
				<tr bgcolor="#FFFFFF" class="bodyBlack">
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
					<td align="center">'.$nights.'</td>
					<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
					<td width="125" align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($sprint_discount*.01)))).'</td>
					<td width="125" align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($nextel_discount*.01)))).'</td>
				</tr>
								';
							}
						};
					};
					echo'
				</table>
					';
					if ($discountable == false){
						$discountable = true;
						echo'
				<div align="right" class="smallBlack">&sup1;This Plan Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
						';
					}else{
						echo'
				<br>
						';
					}
					echo'
				<br>
					';
				}
			}
			?>
			</td>
		</tr>
		</table>
	<?
	// AT&T sites
	}elseif ($cingular_site == "T"){
		//Grab plan names (groups)
		$query = "SELECT group_id, group_name, family_plan FROM plans WHERE carrier = 'AT&T' AND display = 'T' GROUP BY group_name ORDER BY group_position";
		$rs_plan_names = mysql_query($query, $linkID);
	?>
		<table width="930" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="900" class="bigBlack">
				<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
				<ul>
					Whether you're a footloose single, a traveling businesswoman or a family of five, AT&T has rate plans that suit your situation.
				</ul>
				<?
				if ($cingular_site == "T" && $cingular_discount > 0){
				?>
				<ul>For information regarding your <? echo round($cingular_discount); ?>% AT&T service discount <a href="?sec=discount" class="bigBlack"><u>Click Here.</u></ul></p>
				<?
				}
				?>


			</td>
<!--			<td>
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
				<a href="javascript:newwin=window.open('http://www.sprint.com/planadvisor','','scrollbars=yes,width=500,height=450,center');newwin.focus();"><img src="images/SprintPlanAdvisor.gif" alt="" width="365" height="100" border="0"></a><img src="images/spacer.gif" alt="" width="15" height="1" border="0">
			</td>-->
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr>
			<td width="930" height="15">
			<?
			for ($counter=1; $counter <= mysql_num_rows($rs_plan_names); $counter++){
				$groups = mysql_fetch_assoc($rs_plan_names);
				$group = $groups["group_name"];
				$query = "SELECT * FROM plan_features WHERE group_id = '".$groups["group_id"]."'";
				$rs_features = mysql_query($query, $linkID);
				$query = "SELECT * FROM plans WHERE group_id = '".$groups["group_id"]."' AND display = 'T' ORDER BY 'plan_id'";
				$rs_plans = mysql_query($query, $linkID);
				$plan = mysql_fetch_assoc($rs_plans);
				mysql_data_seek($rs_plans,0);  // go back to the top
				echo'
				<table width="900" border="" cellspacing="0" cellpadding="0" align="center" class="border'.$carrier_label.'">
				<tr bgcolor="'.$box_color.'">
					<td width="900" colspan="10" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plans</strong></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td colspan="10" class="bodyBlack" style="padding: 10px;">
				';
				for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
					$row = mysql_fetch_assoc($rs_features);
					echo $row["feature"];
				};
				echo'
					</td>
				</tr>
				';
				if ($plan["plan_type"] == "V"){ // Voice plans
					if (substr($plan["group_name"],0,11) == "AT&T Nation") $minute_type = "Rollover";
					if (substr($plan["group_name"],0,10) == "AT&T Unity") $minute_type = "Unity";
					if ($cingular_discount > 0){
						$discountable = true;
						echo'
				<tr bgcolor="'.$box_color.'" class="bodyWhite">
					<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="180" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="104" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="150" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="150" height="0" border="0"></td>
				</tr>
				<tr bgcolor="'.$box_color.'" class="bodyWhite">
					<td align="center">Included Minutes</td>
					<td align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
					<td align="center">Mobile to Mobile Minutes</td>
					<td align="center">'.$minute_type.' Minutes</td>
					<td align="center">Additional Minutes</td>
					<td align="center">Cost per Month</td>
					<td align="center">Your Cost per Month<br><span class="smallWhite">(<a href="?sec=discount" class="smallWhite" title="Click for Discount Information">With your '.round($cingular_discount).'% discount</a>)</span></td>
				</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							if ($row["discountable"] == 'F'){
								$discountable = false;
								echo'
				<tr bgcolor="'.$box_bg.'" class="bodyBlack">
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">'.$nights_qty.'</td>
					<td align="center">Unlimited</td>
					<td align="center">Unlimited</td>
					<td align="center">$'.money_format('%i', $row["add_min_cost"]).'/Min.</td>
					<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
					<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
				</tr>
								';
							}else{
								echo'
				<tr bgcolor="'.$box_bg.'" class="bodyBlack">
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">'.$nights_qty.'</td>
					<td align="center">Unlimited</td>
					<td align="center">Unlimited</td>
					<td align="center">$'.money_format('%i', $row["add_min_cost"]).'/Min.</td>
					<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
								';
								if ($groups["family_plan"] == 'T'){
									echo'
					<td align="center">$'.money_format('%i', ($row["cost"]-(($row["cost"]-9.99)*($cingular_discount*.01)))).'</td>
									';
								}else{
									echo'
					<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($cingular_discount*.01)))).'</td>
									';
								}
								echo '
				</tr>
								';
							}
						};
					}else{ // No MRC discount
						echo'
				<tr bgcolor="'.$box_color.'" class="bodyWhite">
					<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="190" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="146" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="150" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="150" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="150" height="0" border="0"></td>
				</tr>
				<tr bgcolor="'.$box_color.'" class="bodyWhite">
					<td align="center">Included Minutes</td>
					<td align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
					<td align="center">Mobile to Mobile Minutes</td>
					<td align="center">'.$minute_type.' Minutes</td>
					<td align="center">Additional Minutes</td>
					<td align="center">Cost per Month</td>
				</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							echo'
				<tr bgcolor="'.$box_bg.'" class="bodyBlack">
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">'.$nights_qty.'</td>
					<td align="center">Unlimited</td>
					<td align="center">Unlimited</td>
					<td align="center">$'.money_format('%i', $row["add_min_cost"]).'/Min.</td>
					<td align="center">$'.money_format('%i', $row["cost"]).'</td>
				</tr>
							';
						};
					};
				}else{ // Data & BlackBerry plans
					if ($cingular_discount > 0){
						$discountable = true;
						echo'
				<tr bgcolor="'.$box_color.'" class="bodyWhite">
					<td><img src="images/spacer.gif" alt="" width="284" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="90" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="150" height="0" border="0"></td>
				</tr>
				<tr bgcolor="'.$box_color.'" class="bodyWhite">
					<td align="center">Plan Name</td>
					<td align="center">Included<br>Data</td>
					<td align="center">Additional<br>Data</td>
					<td align="center">Canadian<br>Data</td>
					<td align="center">International<br>Data</td>
					<td align="center">Cost<br>per Month</td>
					<td align="center">Your Cost per Month<br><span class="smallWhite">(<a href="?sec=discount" class="smallWhite" title="Click for Discount Information">With your '.round($cingular_discount).'% discount</a>)</span></td>
				</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["special_price"] == 'T'){
								$plan_name = $row["plan_name"].' <font size="-2" color="#FF0000"><strong><em>Special Offer!</em></strong></font>';
							}else{
								$plan_name = $row["plan_name"];
							}
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							if ($row["add_data_cost"] == 0){
								$add_data_cost = "N/A";
							}else{
								$add_data_cost = '$'.money_format('%.4i', $row["add_data_cost"]).'/KB';
							}
							if ($row["discountable"] == 'F'){
								$discountable = false;
								echo'
				<tr bgcolor="'.$box_bg.'" class="bodyBlack">
					<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">'.$add_data_cost.'</td>
					<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
					<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
					<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
					<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
				</tr>
								';
							}else{
								echo'
				<tr bgcolor="'.$box_bg.'" class="bodyBlack">
					<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">'.$add_data_cost.'</td>
					<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
					<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
					<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
					<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($cingular_discount*.01)))).'</td>
				</tr>
								';
							}
						};
					}else{ // No MRC discount
						echo'
				<tr bgcolor="'.$box_color.'" class="bodyWhite">
					<td><img src="images/spacer.gif" alt="" width="386" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="100" height="0" border="0"></td>
				</tr>
				<tr bgcolor="'.$box_color.'" class="bodyWhite">
					<td align="center">Plan Name</td>
					<td align="center">Included<br>Data</td>
					<td align="center">Additional<br>Data</td>
					<td align="center">Canadian<br>Data</td>
					<td align="center">International<br>Data</td>
					<td align="center">Cost<br>per Month</td>
				</tr>
						';
						for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
							$row = mysql_fetch_assoc($rs_plans);
							if ($row["special_price"] == 'T'){
								$plan_name = $row["plan_name"].' <font size="-2" color="#FF0000"><strong><em>Special Offer!</em></strong></font>';
							}else{
								$plan_name = $row["plan_name"];
							}
							if (is_null($row["nights_qty"])){
								$nights_qty = "Unlimited";
							}else{
								$nights_qty = $row["nights_qty"].' Minutes';
							}
							if ($row["add_data_cost"] == 0){
								$add_data_cost = "N/A";
							}else{
								$add_data_cost = '$'.money_format('%.4i', $row["add_data_cost"]).'/KB';
							}
							echo'
				<tr bgcolor="'.$box_bg.'" class="bodyBlack">
					<td align="left" style="padding-left: 5px">'.$plan_name.'</td>
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">'.$add_data_cost.'</td>
					<td align="center">$'.money_format('%.4i', $row["add_cdn_cost"]).'/KB</td>
					<td align="center">$'.money_format('%.4i', $row["add_intl_cost"]).'/KB</td>
					<td align="center">$'.money_format('%i', $row["cost"]).'</td>
				</tr>
							';
						};
					};
				};
				echo'
				</table>
				';
				$disclaimer = '<div align="right" class="smallBlack">';
				if ($discountable == false){
					$discountable = true;
					$disclaimer .= '&sup1;This Plan Not Eligible for Discounts&nbsp;&nbsp;&nbsp;';
				}
				if ($groups["family_plan"] == 'T'){
					$disclaimer .= '&sup2;Discount Applies to First Line Only&nbsp;&nbsp;&nbsp;';
				}
				$disclaimer .= '&nbsp;&nbsp;<br><br></div>';
				echo $disclaimer;
			}
			?>
			</td>
		</tr>
		</table>
	<?	
	// Verizon sites
	}elseif ($verizon_site == "T"){
		//Grab plan names (groups)
		$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'verizon' AND display = 'T' GROUP BY group_name ORDER BY group_position";
		$rs_plan_names = mysql_query($query, $linkID);
	?>
		<table width="930" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="900" class="bigBlack">
				<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
				<ul>
					<table width="850" class="bodyBlack">
					<tr>
						<td colspan="2" class="xbigBlack"><strong>All Nationwide Plans Include:</strong></td>
					</tr>
					<tr>
						<td width="50%" valign="top">
							<strong class="bigBlack">National "IN" Calling Minutes</strong><br>
							Call any Verizon Wireless customers anytime without using your plan minutes
						</td>
						<td valign="top">
							<strong class="bigBlack">Night & Weekend Minutes</strong><br>
							Weekdays between 9:01 pm and 5:59 am.<br>
							Weekends from 12:00 am Saturday to 11:59 pm Sunday.
						</td>
					</tr>
					<tr>
						<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
					</tr>
					<tr>
						<td valign="top">
							<strong class="bigBlack">No Domestic Roaming or Long Distance Charges</strong><br>
							Make or receive calls within the United States & Puerto Rico
						</td>
						<td valign="top">
							<strong class="bigBlack">Mobile Web</strong><br>
							Get automatic access to the mobile Internet at your fingertips with Mobile Web 2.0 at reasonable pay-as-you-go rates.
						</td>
					</tr>
					</table>
				</ul>
			</td>
<!--			<td>
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
				<a href="javascript:newwin=window.open('http://www.sprint.com/planadvisor','','scrollbars=yes,width=500,height=450,center');newwin.focus();"><img src="images/SprintPlanAdvisor.gif" alt="" width="365" height="100" border="0"></a><img src="images/spacer.gif" alt="" width="15" height="1" border="0">
			</td>-->
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="930" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr>
			<td width="930" height="15">
			<?
			for ($counter=1; $counter <= mysql_num_rows($rs_plan_names); $counter++){
				$groups = mysql_fetch_assoc($rs_plan_names);
				$group = $groups["group_name"];
				$query = "SELECT * FROM plan_features WHERE group_id = '".$groups["group_id"]."'";
				$rs_features = mysql_query($query, $linkID);
				$query = "SELECT * FROM plans WHERE group_id = '".$groups["group_id"]."' AND display = 'T'";
				$rs_plans = mysql_query($query, $linkID);
				$plan = mysql_fetch_assoc($rs_plans);
				mysql_data_seek($rs_plans,0);  // go back to the top
				echo'
				<table width="900" border="" cellspacing="0" cellpadding="0" align="center" class="borderBlack">
				<tr bgcolor="#000000">
					<td width="900" colspan="6" class="bodyWhite"><strong>&nbsp;'.$plan["group_name"].' Plans</strong></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td width="900" colspan="6" class="bodyBlack" style="padding: 10px;">
						<br>
				';
				for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
					$row = mysql_fetch_assoc($rs_features);
					echo $row["feature"];
				};
				echo'
					</td>
				</tr>
				';
				$discountable = true;
//				if ($sprint_discount == $nextel_discount){
					echo'
				<tr bgcolor="#000000" class="bodyWhite">
					<td width="100" align="center">Included Minutes</td>
					<td width="300" align="center">Additional Minutes</td>
					<td width="200" align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
					<td width="150" align="center">Cost per Month</td>
					<td width="150" align="center">Your Cost per Month<br><span class="smallWhite">(With your '.round($sprint_discount).'% discount)</span></td>
				</tr>
					';
					for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
						$row = mysql_fetch_assoc($rs_plans);
						if ($row["discountable"] == 'F'){
							$discountable = false;
							echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
						<td align="center">Unlimited</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
					</tr>
							';
						}else{
							echo'
					<tr bgcolor="'.$box_bg.'"" class="bodyBlack">
						<td align="center">'.$row["quantity"].'</td>
						<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
						<td align="center">Unlimited</td>
						<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
						<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($sprint_discount*.01)))).'</td>
					</tr>
							';
						}
					}
/*				}else{ // Sprint and Nextel discounts are different
					echo'
				<tr bgcolor="#58639B" class="bodyWhite">
					<td width="100" align="center">Included Minutes</td>
					<td width="250" align="center">Additional Minutes</td>
					<td width="175" align="center">Night &amp; Weekend Minutes<br><span class="smallWhite">(Starting at '.$plan["nights_start"].')</span></td>
					<td width="125" align="center">Cost per Month</td>
					<td width="250" colspan="2" align="center">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyWhite">
						<tr>
							<td colspan="2" align="center">Your Cost per Month</td>
						</tr>
						<tr>
							<td width="125" align="center"><span class="smallWhite">(Sprint '.round($sprint_discount).'% Discount)</span></td>
							<td width="125" align="center"><span class="smallWhite">(Nextel '.round($nextel_discount).'% Discount)</span></td>
						</tr>
						</table>
					</td>
				</tr>
					';
					for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
						$row = mysql_fetch_assoc($rs_plans);
						if ($row["discountable"] == 'F'){
							$discountable = false;
							echo'
				<tr bgcolor="#FFFFFF" class="bodyBlack">
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
					<td align="center">Unlimited</td>
					<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
					<td width="125" align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
					<td width="125" align="center">&nbsp;&nbsp;&nbsp;$'.money_format('%i', $row["cost"]).'&sup1;&nbsp;</td>
				</tr>
							';
						}else{
							echo'
				<tr bgcolor="#FFFFFF" class="bodyBlack">
					<td align="center">'.$row["quantity"].'</td>
					<td align="center">Additional Anytime Minutes $'.money_format('%i', $row["add_min_cost"]).'</td>
					<td align="center">Unlimited</td>
					<td align="center">$<strike>'.money_format('%i', $row["cost"]).'</strike></td>
					<td width="125" align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($sprint_discount*.01)))).'</td>
					<td width="125" align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($nextel_discount*.01)))).'</td>
				</tr>
							';
						}
					};
				};
*/				echo'
				</table>
				';
				if ($discountable == false){
					$discountable = true;
					echo'
				<div align="right" class="smallBlack">&sup1;This Plan Not Eligible for Discounts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
					';
				}else{
					echo'
				<br>
					';
				}
				echo'
				<br>
				';
			}
			?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center" bgcolor="#FFFFFF">
				<table width="850" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td valign="top" class="bodyBlack">
						<ul>
							<li>Online purchase requires a two-year subscriber agreement.</li><br><br>
							<li>Rates exclude taxes & fees (including USF charge that varies quarterly, cost recovery fees, &amp; state/local fees that vary by area.</li><br><br>
							<li>Tolls, taxes, surcharges and other fees, such as E911 and gross receipt charges, vary by market and as of September 1, 2007, add between 4&#37; and 34&#37; to your monthly bill and are in addition to your monthly access fees and airtime charges.</li><br><br>
							<li>Monthly Federal Universal Service Charge on interstate &amp; international telecom charges (varies quarterly based on FCC rate) is 11&#37; per line.</li><br><br>
							<li>The Verizon Wireless monthly Regulatory Charge will increase from 4&cent; to 7&cent; per line effective 11/15/07.</li><br><br>
							<li>Monthly Administrative Charge (subject to change) is 70&cent; per line.</li><br><br>
							<li>The Federal Universal Service, Regulatory and Administrative Charges are Verizon Wireless charges, not taxes. For more details on these charges, call 1&ndash;888&ndash;684&ndash;1888.</li><br><br>
							<li>Stated prices and options are for online purchase only and are subject to change.</li><br><br>
							<li>Mail-in rebates are only applicable if plan requirements are met.</li>
						</ul>
						<br>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	<?
	}
	?>
	</td>
</tr>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<!-- END Include plans.php -->

