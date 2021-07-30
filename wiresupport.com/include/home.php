<!-- BEGIN Include home.php -->

<table width="920" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Available Services</strong></td>
	<td><img src="images/spacer.gif" alt="" width="721" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="920" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="0" height="400" border="0"></td>
			<td align="center" valign="top">
				<br>
				<table width="850" border="0" cellspacing="0" align="center">
				<?
				$choice = 0;
				?>
				<?
				if ($change_plan == "T"){
					$choice++;
				?>
					<?
					if (is_odd($choice)){
						echo'
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
						';
					}else{
						echo'
					<td><img src="images/spacer.gif" width="20" height="1" border="0"></td>
						';
					}
					?>
					<td width="20" valign="top">
						<img src="images/spacer.gif" width="1" height="3" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td width="395" valign="top">
						<a href="?sec=account&task=changeplan"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Change Your Voice Plan, Data Plan, or Plan Features & Options.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Change Your Rate Plan</a><br>
						<span class="smallBlack">Change Your Voice Plan, Data Plan, or Plan Features & Options.<br>Process Will Take 1-2 Business Days to Complete.<br><br></span></td>
					<?
					if (is_even($choice)){
						echo'
				</tr>
						';
					}
					?>
				<?
				}
				if ($transfer == "T"){
					$choice++;
				?>
					<?
					if (is_odd($choice)){
						echo'
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
						';
					}else{
						echo'
					<td><img src="images/spacer.gif" width="20" height="1" border="0"></td>
						';
					}
					?>
					<td width="20" valign="top">
						<img src="images/spacer.gif" width="1" height="3" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td width="395" valign="top">
						<a href="?sec=account&task=transfer"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Transfer an Existing Sprint-Nextel Number Over to <? echo $label; ?> Corporate Responsibility.<br>Upon Completion the Number Will Belong to <? echo $label; ?>. Takes 2-3 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Transfer Liability</a><br>
						<span class="smallBlack">Transfer an Existing Sprint-Nextel Number Over to <? echo $label; ?> Corporate Responsibility.  Upon Completion the Number Will Belong to <? echo $label; ?>.<br>Process Will Take 2-3 Business Days to Complete.</span></td>
					<?
					if (is_even($choice)){
						echo'
				</tr>
						';
					}
					?>
				<?
				}
				if ($change_num == "T"){
					$choice++;
				?>
					<?
					if (is_odd($choice)){
						echo'
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
						';
					}else{
						echo'
					<td><img src="images/spacer.gif" width="20" height="1" border="0"></td>
						';
					}
					?>
					<td width="20" valign="top">
						<img src="images/spacer.gif" width="1" height="3" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td width="395" valign="top">
						<a href="?sec=account&task=changenumber"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Change Your Wireless Number to a Number with a Different Area Code.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Change Your Phone Number</a><br>
						<span class="smallBlack">Change Your Wireless Number to a Number with a Different Area Code.<br>Process Will Take 1-2 Business Days to Complete.<br><br></span></td>
					<?
					if (is_even($choice)){
						echo'
				</tr>
						';
					}
					?>
				<?
				}
				if ($stop == "T"){
					$choice++;
				?>
					<?
					if (is_odd($choice)){
						echo'
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
						';
					}else{
						echo'
					<td><img src="images/spacer.gif" width="20" height="1" border="0"></td>
						';
					}
					?>
					<td width="20" valign="top">
						<img src="images/spacer.gif" width="1" height="3" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td width="395" valign="top">
						<a href="?sec=account&task=stop"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Cancel Your Wireless Number.<br>Takes 1-2 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Stop Service</a><br>
						<span class="smallBlack">Cancel Your Wireless Number.<br>Process Will Take 1-2 Business Days to Complete.<br><br></span></td>
					<?
					if (is_even($choice)){
						echo'
				</tr>
						';
					}
					?>
				<?
				}
				if ($swap_device == "T"){
					$choice++;
				?>
					<?
					if (is_odd($choice)){
						echo'
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
						';
					}else{
						echo'
					<td><img src="images/spacer.gif" width="20" height="1" border="0"></td>
						';
					}
					?>
					<td width="20" valign="top">
						<img src="images/spacer.gif" width="1" height="3" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td width="395" valign="top">
						<a href="?sec=account&task=swapdevice"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Move Your Existing Phone Number to a New Device.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Swap Your Device</a><br>
						<span class="smallBlack">Move Your Existing Phone Number to a New Device.<br>Process Will Take 1-2 Business Days to Complete.<br><br></span></td>
					<?
					if (is_even($choice)){
						echo'
				</tr>
						';
					}
					?>
				<?
				}
				if ($rma == "T"){
					$choice++;
				?>
					<?
					if (is_odd($choice)){
						echo'
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
						';
					}else{
						echo'
					<td><img src="images/spacer.gif" width="20" height="1" border="0"></td>
						';
					}
					?>
					<td width="20" valign="top">
						<img src="images/spacer.gif" width="1" height="3" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td width="395" valign="top">
						<a href="?sec=account&task=rma"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Request a Return Merchandise Authorization to Return a Device.<br>Process Will Take 3-5 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Request an RMA</a><br>
						<span class="smallBlack">Request a Return Merchandise Authorization to Return a Device.<br>Process Will Take 3-5 Business Days to Complete.<br><br></span></td>
					<?
					if (is_even($choice)){
						echo'
				</tr>
						';
					}
					?>
				<?
				}
				if ($change_user == "T"){
					$choice++;
				?>
					<?
					if (is_odd($choice)){
						echo'
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
						';
					}else{
						echo'
					<td><img src="images/spacer.gif" width="20" height="1" border="0"></td>
						';
					}
					?>
					<td width="20" valign="top">
						<img src="images/spacer.gif" width="1" height="3" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td width="395" valign="top">
						<a href="?sec=account&task=changeuser"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Allocate an Existing Corporate Line of Service to a New Corporate User.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Corporate User Change</a><br>
						<span class="smallBlack">Allocate an Existing Corporate Line of Service to a New Corporate User.<br>Process Will Take 1-2 Business Days to Complete.<br><br></span></td>
					<?
					if (is_even($choice)){
						echo'
				</tr>
						';
					}
					?>
				<?
				}
				?>
				</tr>
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
					<td width="20" valign="top">
						<img src="images/spacer.gif" width="1" height="3" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td width="395" valign="top">
						<a href="?sec=faq"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Answers to Frequently Asked Questions.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Common Questions</a><br>
						<span class="smallBlack">Answers to Frequently Asked Questions.<br><br><br></span></td>
					<td><img src="images/spacer.gif" width="20" height="1" border="0"></td>
					<td width="20" valign="top">
						<img src="images/spacer.gif" width="1" height="3" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td width="395" valign="top">
						<a href="?sec=contact"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Contact Vision Wireless and Sprint-Nextel.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Contact Us</a><br>
						<span class="smallBlack">How to Contact Vision Wireless and Sprint-Nextel.<br><br><br></span></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="920" height="5" border="0"></td>
</tr>
</table>

<!-- END Include home.php -->

