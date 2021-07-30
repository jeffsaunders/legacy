<!-- BEGIN Include plans.php -->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td valign="top">
		<table width="710" border="0" cellspacing="0" cellpadding="0" align="left" bgcolor="#FFFFFF">
		<tr>
			<td><img src="images/PlansHeader.jpg" alt="" width="710" height="25" border="0"></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" background="images/InfoBG.jpg" style="background-position:top; background-repeat:repeat-y;">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
				<tr>
					<td>
					<?	
					// Sprint site
//					if ($sprint_site == "T"){
//						//Grab plan names (groups)
//						$query = "SELECT group_id, group_name FROM plans WHERE carrier = 'sprint' AND display = 'T' GROUP BY group_name ORDER BY group_position";
//						$rs_plan_names = mysql_query($query, $linkID);
					?>
						<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td class="bodyBlack">
								<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
								Sprint offers service plan choices to bring you access to more of what you need so you can do more of what you want. And their <a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-30DayRiskFreeGuarantee.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" title="Sprint's 30-Day Guarantee Details" class="bodyBlue">30-Day Risk-Free Guarantee</a> lets you try their services risk free. You only need to select the plan that fits best.
							</td>
<!--							<td>
								<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
								<a href="javascript:newwin=window.open('http://www.sprint.com/planadvisor','','scrollbars=yes,width=500,height=450,center');newwin.focus();"><img src="images/SprintPlanAdvisor.gif" alt="" width="365" height="100" border="0"></a><img src="images/spacer.gif" alt="" width="15" height="1" border="0">
							</td>-->
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
						<table width="690" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
						<tr>
							<td>
							<?
//							for ($counter=1; $counter <= mysql_num_rows($rs_plan_names); $counter++){
//								$groups = mysql_fetch_assoc($rs_plan_names);
//								$group = $groups["group_name"];
//								$query = "SELECT * FROM plan_features WHERE group_id = '".$groups["group_id"]."'";
//								$rs_features = mysql_query($query, $linkID);
//								$query = "SELECT * FROM plans WHERE group_id = '".$groups["group_id"]."' AND display = 'T'";
//								$rs_plans = mysql_query($query, $linkID);

								$query = "SELECT * FROM plans WHERE group_name = 'Sprint Mobile Broadband Connection' AND display = 'T' ORDER BY cost";
								$rs_plans = mysql_query($query, $linkID);
								$plan = mysql_fetch_assoc($rs_plans);
								$query = "SELECT * FROM plan_features WHERE group_id = '".$plan["group_id"]."'";
								$rs_features = mysql_query($query, $linkID);
								mysql_data_seek($rs_plans,0);  // go back to the top
								echo'
								<br>
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
								';
								$discountable = true;
								if ($sprint_discount > 0){
									echo'
								<tr>
									<td colspan="7" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="690" colspan="5" bgcolor="'.$box_bg.'" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
									';
									for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
										$row = mysql_fetch_assoc($rs_features);
										echo $row["feature"];
									};
									echo'
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
									';
									if ($plan["plan_type"] == 'D'){
										echo'
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td width="10" height="20"><img src="images/spacer.gif" alt="" width="10" height="20" border="0"></td>
									<td width="305"><strong>Mobile Broadband Plans</strong></td>
									<td width="125" align="center"><strong>Monthly Usage</strong></td>
									<td width="125" align="center"><strong>Monthly Price</strong></td>
									<td width="125" align="center"><strong>Your Price</strong></td>
								</tr>
										';
									}
									for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
										$row = mysql_fetch_assoc($rs_plans);
										if ($plan["plan_type"] == 'D'){
											echo'
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td><img src="images/spacer.gif" alt="" width="10" height="20" border="0"></td>
									<td align="left">'.$row["plan_name"].'</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center"><strike>$'.money_format('%i', $row["cost"]).'</strike></td>
											';
											if ($row["discountable"] == 'F'){
												$discountable = false;
												echo'
									<td align="center"><img src="images/spacer.gif" alt="" width="7" height="1" border="0">$'.money_format('%i', $row["cost"]).'&dagger;</td>
												';
											}else{
												echo'
									<td align="center">$'.money_format('%i', ($row["cost"]-($row["cost"]*($sprint_discount*.01)))).'</td>
												';
											}
											echo'
								</tr>
								<tr>
									<td colspan="5" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
											';
										}
									}
								}else{
									echo'
								<tr>
									<td colspan="6" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="690" colspan="4" bgcolor="'.$box_bg.'" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
									';
									for ($counter2=1; $counter2 <= mysql_num_rows($rs_features); $counter2++){
										$row = mysql_fetch_assoc($rs_features);
										echo $row["feature"];
									};
									echo'
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
									';
									if ($plan["plan_type"] == 'D'){
										echo'
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td width="10" height="20"><img src="images/spacer.gif" alt="" width="10" height="20" border="0"></td>
									<td width="430"><strong>Mobile Broadband Plans</strong></td>
									<td width="125" align="center"><strong>Monthly Usage</strong></td>
									<td width="125" align="center"><strong>Monthly Price</strong></td>
								</tr>
										';
									}
									for ($counter2=1; $counter2 <= mysql_num_rows($rs_plans); $counter2++){
										$row = mysql_fetch_assoc($rs_plans);
										if ($plan["plan_type"] == 'D'){
											echo'
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td><img src="images/spacer.gif" alt="" width="10" height="20" border="0"></td>
									<td align="left">'.$row["plan_name"].'</td>
									<td align="center">'.$row["quantity"].'</td>
									<td align="center">$'.money_format('%i', $row["cost"]).'</td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
											';
										}
									}
								}
								echo'
								</table>
								';
								if ($discountable == false){
									$discountable = true;
									echo'
								<div align="right" class="tinyBlack">&dagger;This Plan Not Eligible for Discounts&nbsp;<br><img src="images/spacer.gif" alt="" width="1" height="7" border=""></div>
									';
								}else{
									echo'
								<br>
									';
								}
//							}
							?>
								<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
							<?
								if ($sprint_discount > 0){
							?>
								<tr>
									<td colspan="6" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="690" colspan="4" bgcolor="<? echo $box_bg; ?>" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
												Do even more with these optional services.<br><br>
<!--												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>-->
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td width="10" height="20"><img src="images/spacer.gif" alt="" width="10" height="20" border="0"></td>
									<td width="430"><strong>Protection Services</strong></td>
									<td width="125" align="center"><strong>Monthly Price</strong></td>
									<td width="125" align="center"><strong>Your Price</strong></td>
								</tr>
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td><img src="images/spacer.gif" alt="" width="10" height="20" border="0"></td>
									<td align="left">Total Equipment Protection&nbsp;<a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-EquipServRepairProgram.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" title="Total Equipment Protection Service Details" class="smallBlue"><strong>[Details]</strong></a></td>
									<td align="center"><strike>$<? echo money_format('%i', 7); ?></strike></td>
<!--									<td align="center">$<? echo money_format('%i', (7-(7*($sprint_discount*.01)))); ?></td>-->
									<td align="center">$<? echo money_format('%i', 7); ?>&dagger;</td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
							<?
							}else{
							?>
								<tr>
									<td colspan="5" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
									<td width="690" colspan="3" bgcolor="<? echo $box_bg; ?>" class="bodyBlack">
										<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
										<tr>
											<td>
												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
												Do even more with these optional services.<br><br>
<!--												<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>-->
											</td>
										</tr>
										</table>
									</td>
									<td rowspan="99" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
								<tr bgcolor="#6E6E6E" class="bodyWhite">
									<td width="10" height="20"><img src="images/spacer.gif" alt="" width="10" height="20" border="0"></td>
									<td width="555"><strong>Protection Services</strong></td>
									<td width="125" align="center"><strong>Monthly Price</strong></td>
								</tr>
								<tr bgcolor="#DCEAFB" class="bodyBlack">
									<td><img src="images/spacer.gif" alt="" width="10" height="20" border="0"></td>
									<td align="left">Total Equipment Protection&nbsp;<a href="javascript:newwin=window.open('http://www.sprintpcs.com/common/popups/pop-EquipServRepairProgram.html','','scrollbars=yes,width=500,height=450,center');newwin.focus();" title="Total Equipment Protection Service Details" class="smallBlue"><strong>[Details]</strong></a></td>
									<td align="center">$<? echo money_format('%i', 7); ?></td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#6E6E6E"><img src="images/spacer.gif" alt="" width="1" height="1" border=""></td>
								</tr>
							<?
								}
							?>
								</table>
								<?
									if ($sprint_discount > 0){
								?>
								<div align="right" class="tinyBlack">&dagger;This Option Not Eligible for Discounts&nbsp;</div>
								<?
//								}else{
								?>
<!--								<br>-->
								<?
								}
								?>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
		</tr>
		<tr>
			<td><img src="images/InfoFooter.jpg" alt="" width="710" height="10" border="0"></td>
		</tr>
		</table>					
	</td>
</tr>
</table>

<!-- END Include plans.php -->
