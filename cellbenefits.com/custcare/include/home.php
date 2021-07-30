<!-- BEGIN Include home.php -->

<table width="920" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Welcome</strong></td>
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
				<table width="850" border="0" cellspacing="10" align="center">
				<tr>
<?
// Count how many menu options are set
$qty = 0;
if ($change_plan == "T") $qty++;
if ($change_num == "T") $qty++;
if ($transfer == "T") $qty++;
if ($stop == "T") $qty++;
if ($rma == "T") $qty++;

// Build welcome message based on what's available
$services = "";
$counter = 0;
$width = 0;
if ($change_plan == "T"){
	$counter++;
	$services .= "changing your rate plan";
	if ($counter != $qty) $services .= ", ";
	if ($counter == ($qty - 1)) $services .= "and ";
}
if ($change_num == "T"){
	$counter++;
	$services .= "changing your wireless phone number";
	if ($counter != $qty) $services .= ", ";
	if ($counter == ($qty - 1)) $services .= "and ";
}
if ($transfer == "T"){
	$counter++;
	$services .= "transferring your existing number to ".$label;
	if ($counter != $qty) $services .= ", ";
	if ($counter == ($qty - 1)) $services .= "and ";
}
if ($stop == "T"){
	$counter++;
	$services .= "cancelling your service";
	if ($counter != $qty) $services .= ", ";
	if ($counter == ($qty - 1)) $services .= "and ";
}
if ($rma == "T"){
	$counter++;
	$services .= "requesting an RMA to return your phone";
	if ($counter != $qty) $services .= ", ";
	if ($counter == ($qty - 1)) $services .= "and ";
}
// split the columns up evenly
$width = (850 / $counter);
?>
					<td colspan="5" class="bodyBlack"><br><br><span style="float:left; color:#DD0C08; font-size:100px; line-height:70px; font-family:Times,serif,Georgia;">W</span>elcome to the Vision Wireless Sprint-Nextel Customer Care Portal.  Here you will be able to request changes to your Sprint-Nextel service, such as <? echo $services; ?>.
<?
// if a site specific welcome message is set
if ($welcome_msg != ""){
	echo '<br><br>'.$welcome_msg;
}
?>
<br><br>Please make your selection from the choices below or from the menus above.<br><br></td>
				</tr>
				<tr>
<?
if ($change_plan == "T"){
?>
					<td width="<? echo $width; ?>" align="center" valign="top" class="bodyBlack"><a href="?sec=account&task=changenumber" onMouseOver="document.getElementById('menuText').innerHTML = 'Change Your Voice Plan, Data Plan, or Plan Features & Options.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');" onMouseOut="hide('menuHelp');" class="xbigBlack"><img src="images/ChangePlan.gif" alt="" width="64" height="64" border="0"><br>Click Here</a><br>to change your<br>rate plan.</td>
<?
}
if ($change_num == "T"){
?>
					<td width="<? echo $width; ?>" align="center" valign="top" class="bodyBlack"><a href="?sec=account&task=changenumber" onMouseOver="document.getElementById('menuText').innerHTML = 'Change Your Wireless Number to a Number with a Different Area Code.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');" onMouseOut="hide('menuHelp');" class="xbigBlack"><img src="images/ChangeNumber.gif" alt="" width="64" height="64" border="0"><br>Click Here</a><br>to change your<br>phone number.</td>
<?
}
if ($transfer == "T"){
?>
					<td width="<? echo $width; ?>" align="center" valign="top" class="bodyBlack"><a href="?sec=account&task=transfer" onMouseOver="document.getElementById('menuText').innerHTML = 'Transfer an Existing Sprint-Nextel Number Over to <? echo $label; ?> Corporate Responsibility.<br>Upon Completion the Number Will Belong to <? echo $label; ?>. Takes 2-3 Business Days to Complete.'; show('menuHelp');" onMouseOut="hide('menuHelp');" class="xbigBlack"><img src="images/Transfer.gif" alt="" width="64" height="64" border="0"><br>Click Here</a><br>to transfer your existing<br>Sprint-Nextel number<br>over to <? echo $label; ?>.</td>
<?
}
if ($stop == "T"){
?>
					<td width="<? echo $width; ?>" align="center" valign="top" class="bodyBlack"><a href="?sec=account&task=stop" onMouseOver="document.getElementById('menuText').innerHTML = 'Cancel Your Wireless Number.<br>Takes 1-2 Business Days to Complete.'; show('menuHelp');" onMouseOut="hide('menuHelp');"	class="xbigBlack"><img src="images/Stop.gif" alt="" width="64" height="64" border="0"><br>Click Here</a><br>to cancel your<br>wireless service.</td>
<?
}
if ($rma == "T"){
?>
					<td width="<? echo $width; ?>" align="center" valign="top" class="bodyBlack"><a href="?sec=account&task=rma" onMouseOver="document.getElementById('menuText').innerHTML = 'Request a Return Merchandise Authorization to Return a Device.'; show('menuHelp');" onMouseOut="hide('menuHelp');" class="xbigBlack"><img src="images/RMA.gif" alt="" width="64" height="64" border="0"><br>Click Here</a><br>to request an RMA to<br>return your device.</td>
<?
}
?>
				</tr>
				</table>
				<table width="600" border="0" cellspacing="10" align="center">
				<tr>
					<td width="300" align="center" valign="top" class="bodyBlack"><a href="?sec=faq" onMouseOver="document.getElementById('menuText').innerHTML = 'Answers to Frequently Asked Questions.'; show('menuHelp');" onMouseOut="hide('menuHelp');" class="xbigBlack"><img src="images/FAQ.gif" alt="" width="64" height="64" border="0"><br>Click Here</a><br>to access the Frequently Asked Questions.</td>
					<td width="300" align="center" valign="top" class="bodyBlack"><a href="?sec=contact" onMouseOver="document.getElementById('menuText').innerHTML = 'Contact Vision Wireless.'; show('menuHelp');" onMouseOut="hide('menuHelp');" class="xbigBlack"><img src="images/Contact.gif" alt="" width="64" height="64" border="0"><br>Click Here</a><br>to contact Vision Wireless.<br><span class="smallBlack">(or click the live support link below-left for assistance)</span></td>
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

