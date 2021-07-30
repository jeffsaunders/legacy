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
				<table width="850" border="0" cellspacing="0" align="center">
				<?
				if ($change_plan == "T"){
				?>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td width="20">
						<img src="images/spacer.gif" width="1" height="2" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td>
						<a href="?sec=account&task=changeplan"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Change Your Voice Plan, Data Plan, or Plan Features & Options.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Change Your Rate Plan</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="smallBlack">Change Your Voice Plan, Data Plan, or Plan Features & Options.  Process Will Take 1-2 Business Days to Complete.</td>
				</tr>
				<?
				}
				if ($change_num == "T"){
				?>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td width="20">
						<img src="images/spacer.gif" width="1" height="2" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td>
						<a href="?sec=account&task=changenumber"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Change Your Wireless Number to a Number with a Different Area Code.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Change Your Phone Number</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="smallBlack">Change Your Wireless Number to a Number with a Different Area Code.  Process Will Take 1-2 Business Days to Complete.</td>
				</tr>
				<?
				}
				if ($swap_device == "T"){
				?>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td width="20">
						<img src="images/spacer.gif" width="1" height="2" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td>
						<a href="?sec=account&task=swapdevice"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Move Your Existing Phone Number to a New Device.<br>Process Will Take <strong>XXX</strong> Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Swap Your Device</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="smallBlack">Move Your Existing Phone Number to a New Device.  Process Will Take <strong>XXX</strong> Business Days to Complete.</td>
				</tr>
				<?
				}
				if ($change_user == "T"){
				?>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td width="20">
						<img src="images/spacer.gif" width="1" height="2" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td>
						<a href="?sec=account&task=changeuser"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Allocate an Existing Corporate Line of Service to a New Corporate User.<br>Process Will Take <strong>XXX</strong> Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Corporate User Change</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="smallBlack">Allocate an Existing Corporate Line of Service to a New Corporate User.  Process Will Take <strong>XXX</strong> Business Days to Complete.</td>
				</tr>
				<?
				}
				if ($transfer == "T"){
				?>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td width="20">
						<img src="images/spacer.gif" width="1" height="2" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td>
						<a href="?sec=account&task=transfer"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Transfer an Existing Sprint-Nextel Number Over to <? echo $label; ?> Corporate Responsibility.<br>Upon Completion the Number Will Belong to <? echo $label; ?>. Takes 2-3 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Transfer Liability</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="smallBlack">Transfer an Existing Sprint-Nextel Number Over to <? echo $label; ?> Corporate Responsibility.  Upon Completion the Number Will Belong to <? echo $label; ?>. Process Will Take 2-3 Business Days to Complete.</td>
				</tr>
				<?
				}
				if ($stop == "T"){
				?>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td width="20">
						<img src="images/spacer.gif" width="1" height="2" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td>
						<a href="?sec=account&task=stop"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Cancel Your Wireless Number.<br>Takes 1-2 Business Days to Complete.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Stop Service</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="smallBlack">Cancel Your Wireless Number.  Process Will Take 1-2 Business Days to Complete.</td>
				</tr>
				<?
				}
				if ($rma == "T"){
				?>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td width="20">
						<img src="images/spacer.gif" width="1" height="2" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td>
						<a href="?sec=account&task=rma"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Request a Return Merchandise Authorization to Return a Device.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Request an RMA</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="smallBlack">Request a Return Merchandise Authorization to Return a Device.</td>
				</tr>
				<?
				}
				?>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td width="20">
						<img src="images/spacer.gif" width="1" height="2" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td>
						<a href="?sec=faq"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Answers to Frequently Asked Questions.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Common Questions</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="smallBlack">Answers to Frequently Asked Questions.</td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td width="20">
						<img src="images/spacer.gif" width="1" height="2" border="0"><br>
						<img src="images/<? echo $homebullet; ?>" alt="" width="9" height="9" border="0"></td>
					<td>
						<a href="?sec=contact"
							onMouseOver="document.getElementById('menuText').innerHTML = 'Contact Vision Wireless and Sprint-Nextel.'; show('menuHelp');"
							onMouseOut="hide('menuHelp');"
							style="text-decoration:underline;"
							class="<? echo $homelink_class; ?>">
							Contact Us</a></td>
				</tr>
				<tr>
					<td width="20">&nbsp;</td>
					<td class="smallBlack">How to Contact Vision Wireless and Sprint-Nextel.</td>
				</tr>
				</table>
				<br>
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

