<!-- BEGIN INCLUDE manage.php -->

<!-- Interactivity Scripts -->
<script>
// Show DIV
function show(id) {
	document.getElementById(id).style.visibility = "visible";
	document.getElementById(id).style.display = "block";
}
// Hide DIV
function hide(id) {
	document.getElementById(id).style.visibility = "hidden";
	document.getElementById(id).style.display = "none";
}
// Enable all the editable fields if "edit" button is clicked
function editRequest(theForm){
	document.getElementById('theTitle').innerHTML="Edit Open Ticket";
	document.getElementById('theMessage').innerHTML="Please make the required changes to this ticket.";
	document.getElementById('theInstructions').innerHTML="All enabled fields are editable.  By design there is <strong>no error checking</strong> for this form so please take care to enter valid information.";
	var elements = document.getElementsByTagName("input");
	for (counter=0; counter < elements.length; counter++){
		if (theForm.elements[counter].name != "no_edit"){
			theForm.elements[counter].style.background = "#FFFFFF";
			theForm.elements[counter].style.color = "#000000";
			theForm.elements[counter].style.fontWeight = "normal";
			theForm.elements[counter].disabled = false;
			theForm.elements[counter].attributes["onfocus"].value = "";
//		}else{
//			theForm.elements[counter].disabled = true;
		}
	}
	hideDiv('action_buttons');
	showDiv('edit_buttons');
	theForm.elements[2].focus();
}
// Open add note form
function addNote(theForm, task){
	hideDiv('action_buttons');
	showDiv('add_note_form');
	theForm.task.value = task;
	document.getElementById('new_note').focus();
}
</script>

<?
if (!$task) $task = "list_open";
if ($task == "list_approvals"){
	$title = "Request Approval";
	$message = "The following is a list of the current requests needing approval:";
	$instructions = "";
}elseif ($task == "view_transfer"){
	$title = "Request Ticket Requiring Approval";
	$message = "The following is a request ticket that requires approval before submission:";
	$instructions = "Please select an action by clicking a button at the bottom of the page";
}elseif ($task == "view_change"){
	$title = "Request Ticket Requiring Approval";
	$message = "The following is a request ticket that requires approval before submission:";
	$instructions = "Please select an action by clicking a button at the bottom of the page";
}
?>

<? if ($status != ""){ // Database Updated - pop up message ?>
<script>
function show(id) {
	document.getElementById(id).style.visibility = "visible";
	document.getElementById(id).style.display = "block";
}
function hide(id) {
	document.getElementById(id).style.visibility = "hidden";
	document.getElementById(id).style.display = "none";
}
</script>

<script type="text/javascript">
// Determine current browser window dimensions
if (window.innerWidth){ //if browser supports window.innerWidth (mozilla)
	bwidth=window.innerWidth;
	bheight=window.innerHeight;
}else if (document.all){ //else if browser supports document.all (IE 4+)
	bwidth=document.body.clientWidth;
	bheight=document.body.clientHeight;
};
// Create DIV
div = "<div id='status' style='position:absolute; top:";
div += ((bheight/2)-12);
div += "; left:";
div += ((bwidth/2)-175);
div += "; width:350; height:140; z-index:2; padding:3px; background-color:#E0E0E0; border-color:#008000; border:thin solid; text-align:center; filter:alpha(opacity=90); display:block; visibility:visible'";
div += " onFocus=setTimeout(\"hide('status')\",5000);";
div += ">";
document.write(div);
// give it focus to trigger onFocus event
document.getElementById('status').focus();
// Write the rest in plain HTML
</script>
	<table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="center" class="bigBlack"><br><br><strong><? echo $status; ?></strong></td>
	</tr>
	<tr>
		<td align="center"><br><input type="button" name="ok" id="ok" value="OK" onClick="hide('status');" style="width:100px;"></td>
	</tr>
	</table>
</div>
<? } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="40" border="0"></td>
</tr>
<tr>
	<td width="100%" height="25" bgcolor="#EFEFEF" style="border-top: 2px solid #008000;" class="bigBlack">&nbsp;&nbsp;<strong id="theTitle"><? echo $title; ?></strong></td>
</tr>
</table>
<br>
<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td colspan="3" class="bodyBlack"><strong id="theMessage"><? echo $message; ?></strong><br><br></td>
</tr>
<? if ($instructions != ""){ ?>
<tr>
	<td colspan="3" align="center">
		<table border="0" cellspacing="0" cellpadding="0" align="center">
			<td width="500" class="bodyBlack"><em id="theInstructions"><? echo $instructions; ?></em><br><br></td>
		</table>
	</td>
</tr>
<? } ?>

<!-- LIST QUEUED APPROVALS -->
<? if ($task == "list_approvals"){ ?>
	<!-- Transfer/Port Tickets -->
	<?
	$query = "SELECT *, UNIX_TIMESTAMP(open_time) as open_time FROM transfers AS t, tickets AS k WHERE t.ticket_num = k.ticket_num AND k.approved = 'F' AND k.closed = 'F' ORDER BY open_time ASC";
//echo $query;
	$rs_approvals = mysql_query($query, $linkID);
	?>
<tr>
	<td class="smallBlack"><br><strong>Transfer/Port Tickets</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="4" class="smallBlack">
		<tr bgcolor="000000" class="bodyWhite">
			<th width="190">Ticket</th>
			<th width="150">For</th>
			<th width="210">Request</th>
			<th width="50">~</th>
		</tr>
	<?
	if (mysql_num_rows($rs_approvals) <= 0){
	?>
		<tr>
			<td colspan="4" bgcolor="#E0E0E0"><em>No Tickets Found</em></td>
		</tr>
	<?
	}else{
		for ($counter=1; $counter <= mysql_num_rows($rs_approvals); $counter++){
			$approval = mysql_fetch_assoc($rs_approvals);
			$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
			if ($approval["port_type"] == "port") $type = "Port Device";
			if ($approval["port_type"] == "migrate") $type = "Migrate Device";
			if ($approval["port_type"] == "transfer") $type = "Transfer Liability";
	?>
		<tr bgcolor="<? echo $bg; ?>">
			<td valign="top" style="border-right: 1px solid #FFFFFF;">
				Ticket #<strong><? echo $approval["ticket_num"]; ?></strong><br>
				Opened: <strong><? echo date('m/d/Y', $approval["open_time"]); ?> at <? echo date('g:ma', $approval["open_time"]); ?></strong><br>
				By: <strong><? echo $approval["opened_by"]; ?></strong>
			</td>
			<td valign="top" style="border-right: 1px solid #FFFFFF;">
				For: <strong><? echo $approval["first_name"]; ?>&nbsp;<? echo $approval["last_name"]; ?></strong><br>
				Employee ID: <strong><? echo $approval["employee_id"]; ?></strong><br>
				Cost Center: <strong><? echo $approval["cost_center"]; ?></strong>
			</td>
			<td valign="top" style="border-right: 1px solid #FFFFFF;">
				Request Type: <strong><? echo $type; ?></strong><br>
				Device: <strong><? echo $approval["device"]; ?></strong>
			</td>
			<td align="center" style="border-left: 1px solid #FFFFFF;">
				<a href="?sec=ticket&task=view_transfer&cargo=transfers|<? echo $approval["ticket_num"]; ?>" class="bodyBlack">View</a>
			</td>
		</tr>
	<?
		}
	}
	 ?>
		</table>
	</td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>

	<!-- Change/Stop Tickets -->
	<?
	$query = "SELECT *, UNIX_TIMESTAMP(open_time) as open_time FROM changes AS c, tickets AS k WHERE c.ticket_num = k.ticket_num AND k.approved = 'F' AND k.closed = 'F' ORDER BY open_time ASC";
	$rs_approvals = mysql_query($query, $linkID);
	?>
<tr>
	<td class="smallBlack"><br><strong>Change/Stop Tickets</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="4" class="smallBlack">
		<tr bgcolor="000000" class="bodyWhite">
			<th width="190">Ticket</th>
			<th width="150">For</th>
			<th width="210">Request</th>
			<th width="50">~</th>
		</tr>
	<?
	if (mysql_num_rows($rs_approvals) <= 0){
	?>
		<tr>
			<td colspan="4" bgcolor="#E0E0E0"><em>No Tickets Found</em></td>
		</tr>
	<?
	}else{
		for ($counter=1; $counter <= mysql_num_rows($rs_approvals); $counter++){
			$approval = mysql_fetch_assoc($rs_approvals);
			$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
			if ($approval["change_type"] == "plan") $type = "Plan Change";
			if ($approval["change_type"] == "number") $type = "Number Change";
			if ($approval["change_type"] == "stop") $type = "Stop Service";
	?>
		<tr bgcolor="<? echo $bg; ?>">
			<td valign="top" style="border-right: 1px solid #FFFFFF;">
				Ticket #<strong><? echo $approval["ticket_num"]; ?></strong><br>
				Opened: <strong><? echo date('m/d/Y', $approval["open_time"]); ?> at <? echo date('g:ma', $approval["open_time"]); ?></strong><br>
				By: <strong><? echo $approval["opened_by"]; ?></strong>
			</td>
			<td valign="top" style="border-right: 1px solid #FFFFFF;">
				For: <strong><? echo $approval["first_name"]; ?>&nbsp;<? echo $approval["last_name"]; ?></strong><br>
				Employee ID: <strong><? echo $approval["employee_id"]; ?></strong><br>
				Cost Center: <strong><? echo $approval["cost_center"]; ?></strong>
			</td>
			<td valign="top" style="border-right: 1px solid #FFFFFF;">
				Request Type: <strong><? echo $type; ?></strong><br>
				Device: <strong><? echo iif($approval["device"] != "", $approval["device"], "N/A"); ?></strong>
			</td>
			<td align="center" style="border-left: 1px solid #FFFFFF;">
				<a href="?sec=ticket&task=view_change&cargo=changes|<? echo $approval["ticket_num"]; ?>" class="bodyBlack">View</a>
			</td>
		</tr>
	<?
		}
	}
	 ?>
		</table>
	</td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<? } ?>


<!-- VIEW SELECTED PORT/TRANSFER TICKET -->
<? if ($task == "view_transfer"){
	$target = explode("|", $_REQUEST['cargo']);
//	$query = "SELECT *, UNIX_TIMESTAMP(open_time) as open_time, FROM ".$target[0]." AS x, tickets AS k WHERE x.ticket_num = k.ticket_num AND k.ticket_num = ".$target[1];
	$query = "SELECT *, k.ticket_num as ticket_num, UNIX_TIMESTAMP(open_time) as open_time, UNIX_TIMESTAMP(note_time) as note_time FROM ".$target[0]." AS x, tickets AS k LEFT JOIN ticket_notes on ticket_notes.ticket_num = k.ticket_num WHERE x.ticket_num = k.ticket_num AND k.ticket_num = ".$target[1];
//echo $query;
	$rs_approval = mysql_query($query, $linkID);
	$approval = mysql_fetch_assoc($rs_approval);
	if ($approval["port_type"] == "port") $type = "Port Device";
	if ($approval["port_type"] == "migrate") $type = "Migrate Device";
	if ($approval["port_type"] == "transfer") $type = "Transfer Liability";
	?>

<!-- Ticket Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Ticket Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<form action="dbaccess.php" method="post" name="edit_port" id="edit_port" onSubmit="return validate(this);">
<tr>
	<td align="right">Ticket Number:</td>
	<td>
		<input type="text" name="no_edit" id="ticket_num" value="<? echo $approval["ticket_num"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Request Type:</td>
	<td>
		<input type="text" name="no_edit" id="port_type" value="<? echo $type; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Opened By:</td>
	<td>
		<input type="text" name="opened_by" id="opened_by" value="<? echo $approval["opened_by"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Opened For:</td>
	<td>
		<input type="text" name="opened_for" id="opened_for" value="<? echo $approval["opened_for"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Opened On:</td>
	<td>
		<input type="text" name="no_edit" id="opened_on" value="<? echo date('m/d/Y', $approval["open_time"]); ?> at <? echo date('h:ma', $approval["open_time"]); ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>

<!-- Device Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Device Information</strong></td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Device:</td>
	<td>
		<input type="text" name="device" id="device" value="<? echo $approval["device"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Device IMEI Number:</td>
	<td>
		<input type="text" name="imei" id="imei" value="<? echo $approval["imei"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">SIM ICC ID Number:</td>
	<td>
		<input type="text" name="sim_icc" id="sim_icc" value="<? echo $approval["sim_icc"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>

<!-- User Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>User Information</strong></td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">User First Name:</td>
	<td>
		<input type="text" name="first_name" id="first_name" value="<? echo $approval["first_name"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">User Last Name:</td>
	<td>
		<input type="text" name="last_name" id="last_name" value="<? echo $approval["last_name"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Employee ID:</td>
	<td>
		<input type="text" name="employee_id" id="employee_id" value="<? echo $approval["employee_id"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Cost Center:</td>
	<td>
		<input type="text" name="cost_center" id="cost_center" value="<? echo $approval["cost_center"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">User Email:</td>
	<td>
		<input type="text" name="user_email" id="user_email" value="<? echo $approval["user_email"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>

<!-- Account Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Account Information</strong></td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Phone Number to <? echo ucfirst($approval["port_type"]); ?>:</td>
	<td>
		<input type="text" name="port_num" id="port_num" value="<? echo $approval["port_num"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
	<?
	// Show only on port form
	if ($approval["port_type"] == "port"){
	?>
<tr>
	<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>Account Type:</td>
	<td>
		<input type="radio" name="acct_type" id="acct_type" onchange="checkTaxID();" value="personal" style="color:#A0A0A0; background-color:#F8F8F8;" <? echo iif($approval["acct_type"] == "personal", "checked",""); ?> disabled>&nbsp;Personal<br>
		<input type="radio" name="acct_type" id="acct_type" onchange="checkTaxID();" value="corporate" style="color:#A0A0A0; background-color:#F8F8F8;" <? echo iif($approval["acct_type"] == "corporate", "checked",""); ?> disabled>&nbsp;Corporate
	</td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="3" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="3" border="0"></td>
</tr>
<tr>
	<td align="right">Company Tax ID:</td>
	<td>
		<input type="text" name="tax_id" id="tax_id" value="<? echo $approval["tax_id"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Carrier Transferring From:</td>
	<td>
		<input type="text" name="port_from" id="port_from" value="<? echo $approval["port_from"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
	<?
	// End show only on port form
	}
	// Show only on port or transfer form
	if ($approval["port_type"] == "port" || $approval["port_type"] == "transfer"){
	?>
<tr>
	<td align="right">Name as it appears on bill:</td>
	<td>
		<input type="text" name="bill_name" id="bill_name" value="<? echo $approval["bill_name"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Billing Address:</td>
	<td>
		<input type="text" name="bill_address1" id="bill_address1" value="<? echo $approval["bill_address1"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right"></td>
	<td>
		<input type="text" name="bill_address2" id="bill_address2" value="<? echo $approval["bill_address2"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Billing City:</td>
	<td>
		<input type="text" name="bill_city" id="bill_city" value="<? echo $approval["bill_city"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Billing State:</td>
	<td>
		<input type="text" name="bill_state" id="bill_state" value="<? echo $approval["bill_state"]; ?>" size="50" maxlength="5" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Billing Zip Code:</td>
	<td>
		<input type="text" name="bill_zipcode" id="bill_zipcode" value="<? echo $approval["bill_zipcode"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Account Number:</td>
	<td>
		<input type="text" name="from_acct_num" id="from_acct_num" value="<? echo $approval["from_acct_num"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Account Password:</td>
	<td>
		<input type="text" name="from_acct_pass" id="from_acct_pass" value="<? echo $approval["from_acct_pass"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
	<?
	// End show only on port or transfer form
	}
	?>

<!-- Requester Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Requester Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Requester Name:</td>
	<td>
		<input type="text" name="requester_name" id="requester_name" value="<? echo $approval["requester_name"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td>
		<input type="text" name="requester_phone" id="requester_phone" value="<? echo $approval["requester_phone"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Requester Email:</td>
	<td>
		<input type="text" name="requester_email" id="requester_email" value="<? echo $approval["requester_email"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Requester IP Address:</td>
	<td>
		<input type="text" name="no_edit" id="ipaddress" value="<? echo $approval["ipaddress"]; ?>" size="50" maxlength="15" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>

<!-- Attached Notes -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Attached Notes</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
	<?
	mysql_data_seek($rs_approval, 0);
	for ($counter=1; $counter <= mysql_num_rows($rs_approval); $counter++){
		$approval = mysql_fetch_assoc($rs_approval);
		if ($approval["note"] == ""){
	?>
<tr>
	<td colspan="3" align="center"><em>No Notes Attached.</em></td>
</tr>
	<?
		}else{
	?>
<tr>
	<td align="right" valign="top">Note By <? echo $approval["note_by"]; ?>:<br><span class="smallBlack">Entered <? echo date('m/d/Y', $approval["note_time"]); ?> at <? echo date('h:ma', $approval["note_time"]); ?></span></td>
	<td>
		<textarea cols="1" rows="3" name="no_edit" id="note<? echo $counter; ?>" style="width:300px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()"><? echo $approval["note"]; ?></textarea>
	</td>
</tr>
	<?
		}
	}
	?>

<tr>
	<td colspan="3">
		<div id="action_buttons" style="visibility:visible">
			<script>
				// Approve request
				function approveRequest(){
					var answer = confirm("Confirm Approval!");
					if (answer){
						window.location='dbaccess.php?task=approve_port&ticket_num=<? echo $approval["ticket_num"]; ?>';
					}
				}
				// Disapprove request
				function disapproveRequest(){
					var reason = prompt("Please enter the reason for disapproving the request:", "Invalid Request.");
					if (reason){
						window.location='dbaccess.php?task=disapprove_port&ticket_num=<? echo $approval["ticket_num"]; ?>&reason='+reason+'';
					}
				}
			</script>
			<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
			<tr>
				<td align="center">
					<br><br>
					<input type="button" name="no_edit" id="approve" value="Approve" onClick="approveRequest();" style="width:100px;">
					<input type="button" name="no_edit" id="edit" value="Edit Request" onClick="editRequest(edit_port);" style="width:100px;">
					<input type="button" name="no_edit" id="note" value="Add Note" onClick="addNote(edit_port, 'add_port_note');" style="width:100px;">
					<input type="button" name="no_edit" id="disapprove" value="Disapprove" onClick="disapproveRequest();" style="width:100px;">
				</td>
			</tr>
			</table>
		</div>
		<div id="edit_buttons" style="display:none; z-index:1;">
			<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
			<tr>
				<td align="center">
					<br><br>
					<input type="hidden" name="ticket_num" value="<? echo $approval["ticket_num"]; ?>">
					<input type="hidden" name="task" value="edit_port">
					<input type="submit" name="no_edit" id="submit" value="Submit" style="width:100px;">
					<input type="reset" name="no_edit" id="reset" value="Reset" style="width:100px;">
				</td>
			</tr>
			</table>
		</div>
		<div id="add_note_form" style="display:none; z-index:2;">
			<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
			<form action="dbaccess.php" method="post" name="add_note" id="add_note" onSubmit="return validate(this);">
			<tr>
				<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Add New Note</strong></td>
			</tr>
			<tr>
				<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
			</tr>
			<tr>
				<td align="center">
					<textarea cols="1" rows="5" name="new_note" id="new_note" style="width:600px;"></textarea>
				</td>
			</tr>
			<tr>
				<td align="center">
					<br><br>
					<input type="hidden" name="ticket_num" value="<? echo $approval["ticket_num"]; ?>">
<!--					<input type="hidden" name="task" value="add_port_note">-->
					<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
					<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
				</td>
			</tr>
			</form>
			</table>
		</div>
	</td>
</tr>

</form>
</table>
<? } ?>


<!-- VIEW SELECTED CHANGE/STOP TICKET -->
<? if ($task == "view_change"){ ?>
	<?
	$target = explode("|", $_REQUEST['cargo']);
//	$query = "SELECT *, UNIX_TIMESTAMP(open_time) as open_time, FROM ".$target[0]." AS x, tickets AS k WHERE x.ticket_num = k.ticket_num AND k.ticket_num = ".$target[1];
	$query = "SELECT *, k.ticket_num AS ticket_num, x.note AS reason, UNIX_TIMESTAMP(open_time) AS open_time, UNIX_TIMESTAMP(note_time) AS note_time FROM ".$target[0]." AS x, tickets AS k LEFT JOIN ticket_notes ON ticket_notes.ticket_num = k.ticket_num WHERE x.ticket_num = k.ticket_num AND k.ticket_num = ".$target[1];
//echo $query;
	$rs_approval = mysql_query($query, $linkID);
	$approval = mysql_fetch_assoc($rs_approval);
	if ($approval["change_type"] == "plan") $type = "Plan Change";
	if ($approval["change_type"] == "number") $type = "Number Change";
	if ($approval["change_type"] == "stop") $type = "Stop Service";
	?>

<!-- Ticket Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Ticket Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="10" rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<form action="dbaccess.php" method="post" name="edit_change" id="edit_change" onSubmit="return validate(this);">
<tr>
	<td align="right">Ticket Number:</td>
	<td>
		<input type="text" name="no_edit" id="ticket_num" value="<? echo $approval["ticket_num"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Request Type:</td>
	<td>
		<input type="text" name="no_edit" id="port_type" value="<? echo $type; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Opened By:</td>
	<td>
		<input type="text" name="opened_by" id="opened_by" value="<? echo $approval["opened_by"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Opened For:</td>
	<td>
		<input type="text" name="opened_for" id="opened_for" value="<? echo $approval["opened_for"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Opened On:</td>
	<td>
		<input type="text" name="no_edit" id="opened_on" value="<? echo date('m/d/Y', $approval["open_time"]); ?> at <? echo date('h:ma', $approval["open_time"]); ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>

<!-- User Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>User Information</strong></td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">User First Name:</td>
	<td>
		<input type="text" name="first_name" id="first_name" value="<? echo $approval["first_name"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">User Last Name:</td>
	<td>
		<input type="text" name="last_name" id="last_name" value="<? echo $approval["last_name"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Employee ID:</td>
	<td>
		<input type="text" name="employee_id" id="employee_id" value="<? echo $approval["employee_id"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Cost Center:</td>
	<td>
		<input type="text" name="cost_center" id="cost_center" value="<? echo $approval["cost_center"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">User Email:</td>
	<td>
		<input type="text" name="user_email" id="user_email" value="<? echo $approval["user_email"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>

<!-- Device Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Device Information</strong></td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
	<?
	// Show only on change plan form
	if ($approval["change_type"] == "plan"){
	?>
<tr>
	<td align="right">Device:</td>
	<td>
		<input type="text" name="device" id="device" value="<? echo $approval["device"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
	<?
	}
	// Show only on change plan and chnage number form
	if ($approval["change_type"] == "plan" || $approval["change_type"] == "number"){
	?>
<tr>
	<td align="right">Device IMEI Number:</td>
	<td>
		<input type="text" name="imei" id="imei" value="<? echo $approval["imei"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
	<?
	}
	// Show only on change plan form
	if ($approval["change_type"] == "plan"){
	?>
<tr>
	<td align="right">SIM ICC ID Number:</td>
	<td>
		<input type="text" name="sim_icc" id="sim_icc" value="<? echo $approval["sim_icc"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
	<?
	}
	?>
<tr>
	<td align="right"><? echo iif($approval["change_type"] == "number", "Current ",""); ?>Wireless Number:</td>
	<td>
		<input type="text" name="port_num" id="port_num" value="<? echo $approval["current_num"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>

	<?
	// Show only on change plan form
	if ($approval["change_type"] == "plan"){
	?>
<!-- Plan Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Plan Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Calling Plan:</td>
	<td><input type="checkbox" name="change_voice_plan" id="change_voice_plan" value="<? echo $approval["change_voice_plan"]; ?>" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["change_voice_plan"] == "T", " checked", ""); ?>>&nbsp;Change calling plan.</td>
</tr>
<tr>
	<td align="right">New Calling Plan:</td>
	<td>
		<input type="text" name="new_voice_plan" id="new_voice_plan" value="<? echo $approval["new_voice_plan"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>World Traveler ($5.99):</td>
	<td>
		<input type="radio" name="world_traveler" id="world_traveler" value="add" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["world_traveler"] == "add", " checked", ""); ?>>&nbsp;Add&nbsp;
		<input type="radio" name="world_traveler" id="world_traveler" value="remove" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["world_traveler"] == "remove", " checked", ""); ?>>&nbsp;Remove&nbsp;
		<input type="radio" name="world_traveler" id="world_traveler" value="unchanged" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["world_traveler"] == "unchanged", " checked", ""); ?>>&nbsp;No Change
	</td>
</tr>
<tr>
	<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>World Connect ($3.99):</td>
	<td>
		<input type="radio" name="world_connect" id="world_connect" value="add" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["world_connect"] == "add", " checked", ""); ?>>&nbsp;Add&nbsp;
		<input type="radio" name="world_connect" id="world_connect" value="remove" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["world_connect"] == "remove", " checked", ""); ?>>&nbsp;Remove&nbsp;
		<input type="radio" name="world_connect" id="world_connect" value="unchanged" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["world_connect"] == "unchanged", " checked", ""); ?>>&nbsp;No Change
	</td>
</tr>
<tr>
	<td align="right">Data Plan:</td>
	<td><input type="checkbox" name="change_data_plan" id="change_data_plan" value="<? echo $approval["change_data_plan"]; ?>" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["change_data_plan"] == "T", " checked", ""); ?>>&nbsp;Change data plan.</td>
</tr>
<tr>
	<td align="right">New Data Plan:</td>
	<td>
		<input type="text" name="new_data_plan" id="new_data_plan" value="<? echo $approval["new_data_plan"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
<tr>
<tr>
	<td colspan="3" align="center" class="smallBlack"><u> For BlackBerry Devices Only </u></td>
</tr>
<tr>
	<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>BlackBerry Data ($39.99):</td>
	<td>
		<input type="radio" name="blackberry_data" id="blackberry_data" value="add" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["blackberry_data"] == "add", " checked", ""); ?>>&nbsp;Add&nbsp;
		<input type="radio" name="blackberry_data" id="blackberry_data" value="remove" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["blackberry_data"] == "remove", " checked", ""); ?>>&nbsp;Remove&nbsp;
		<input type="radio" name="blackberry_data" id="blackberry_data" value="unchanged" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["blackberry_data"] == "unchanged", " checked", ""); ?>>&nbsp;No Change
	</td>
</tr>
<tr>
	<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>BlackBerry International ($69.99):</td>
	<td>
		<input type="radio" name="blackberry_intl" id="blackberry_intl" value="add" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["blackberry_intl"] == "add", " checked", ""); ?>>&nbsp;Add&nbsp;
		<input type="radio" name="blackberry_intl" id="blackberry_intl" value="remove" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["blackberry_intl"] == "remove", " checked", ""); ?>>&nbsp;Remove&nbsp;
		<input type="radio" name="blackberry_intl" id="blackberry_intl" value="unchanged" style="color:#A0A0A0; background-color:#F8F8F8;" disabled<? echo iif($approval["blackberry_intl"] == "unchanged", " checked", ""); ?>>&nbsp;No Change
	</td>
</tr>
	<?
	}
	// Show only on change number form
	if ($approval["change_type"] == "number"){
	?>

<!-- New Number Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>New Phone Number Information</strong></td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">New SIM Card ICC ID:</td>
	<td>
		<input type="text" name="new_sim_icc" id="new_sim_icc" value="<? echo $approval["new_sim_icc"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">New Area Code:</td>
	<td>
		<input type="text" name="new_areacode" id="new_areacode" value="<? echo $approval["new_areacode"]; ?>" size="50" maxlength="25" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">New Address:</td>
	<td>
		<input type="text" name="new_address1" id="new_address1" value="<? echo $approval["new_address1"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right"></td>
	<td>
		<input type="text" name="new_address2" id="new_address2" value="<? echo $approval["new_address2"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Billing City:</td>
	<td>
		<input type="text" name="new_city" id="new_city" value="<? echo $approval["new_city"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Billing State:</td>
	<td>
		<input type="text" name="new_state" id="new_state" value="<? echo $approval["new_state"]; ?>" size="50" maxlength="5" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Billing Zip Code:</td>
	<td>
		<input type="text" name="new_zipcode" id="new_zipcode" value="<? echo $approval["new_zipcode"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
	<?
	}
	// Show only on stop service form
	if ($approval["change_type"] == "stop"){
	?>
<!-- Issue Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Reason</strong></td>
</tr>
<tr>
	<td width="275"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="315"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right" valign="top">Reason For Stopping Service:</td>
	<td>
		<textarea cols="1" rows="3" name="reason" id="reason" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()"><? echo $approval["reason"]; ?></textarea>
	</td>
</tr>
<? } ?>

<!-- Requester Information -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Requester Information</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td align="right">Requester Name:</td>
	<td>
		<input type="text" name="requester_name" id="requester_name" value="<? echo $approval["requester_name"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Requester Phone Number:</td>
	<td>
		<input type="text" name="requester_phone" id="requester_phone" value="<? echo $approval["requester_phone"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Requester Email:</td>
	<td>
		<input type="text" name="requester_email" id="requester_email" value="<? echo $approval["requester_email"]; ?>" size="50" maxlength="50" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>
<tr>
	<td align="right">Requester IP Address:</td>
	<td>
		<input type="text" name="no_edit" id="ipaddress" value="<? echo $approval["ipaddress"]; ?>" size="50" maxlength="15" style="width:200px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()">
	</td>
</tr>

<!-- Attached Notes -->
<tr>
	<td colspan="3" class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Attached Notes</strong></td>
</tr>
<tr>
	<td width="250"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	<td width="340"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
	<?
	mysql_data_seek($rs_approval, 0);
	for ($counter=1; $counter <= mysql_num_rows($rs_approval); $counter++){
		$approval = mysql_fetch_assoc($rs_approval);
		if ($approval["note"] == ""){
	?>
<tr>
	<td colspan="3" align="center"><em>No Notes Attached.</em></td>
</tr>
	<?
		}else{
	?>
<tr>
	<td align="right" valign="top">Note By <? echo $approval["note_by"]; ?>:<br><span class="smallBlack">Entered <? echo date('m/d/Y', $approval["note_time"]); ?> at <? echo date('h:ma', $approval["note_time"]); ?></span></td>
	<td>
		<textarea cols="1" rows="3" name="no_edit" id="note<? echo $counter; ?>" style="width:300px; font-weight:bold; color:#A0A0A0; background-color:#F8F8F8;" onfocus="this.blur()"><? echo $approval["note"]; ?></textarea>
	</td>
</tr>
	<?
		}
	}
	?>

<tr>
	<td colspan="3">
		<div id="action_buttons" style="visibility:visible">
			<script>
				// Approve request
				function approveRequest(){
					var answer = confirm("Confirm Approval!");
					if (answer){
						window.location='dbaccess.php?task=approve_change&ticket_num=<? echo $approval["ticket_num"]; ?>';
					}
				}
				// Disapprove request
				function disapproveRequest(){
					var reason = prompt("Please enter the reason for disapproving the request:", "Invalid Request.");
					if (reason){
						window.location='dbaccess.php?task=disapprove_change&ticket_num=<? echo $approval["ticket_num"]; ?>&reason='+reason+'';
					}
				}
			</script>
			<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
			<tr>
				<td align="center">
					<br><br>
					<input type="button" name="no_edit" id="approve" value="Approve" onClick="approveRequest();" style="width:100px;">
					<input type="button" name="no_edit" id="edit" value="Edit Request" onClick="editRequest(edit_change);" style="width:100px;">
					<input type="button" name="no_edit" id="note" value="Add Note" onClick="addNote(edit_change, 'add_change_note');" style="width:100px;">
					<input type="button" name="no_edit" id="disapprove" value="Disapprove" onClick="disapproveRequest();" style="width:100px;">
				</td>
			</tr>
			</table>
		</div>
		<div id="edit_buttons" style="display:none; z-index:1;">
			<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
			<tr>
				<td align="center">
					<br><br>
					<input type="hidden" name="ticket_num" value="<? echo $approval["ticket_num"]; ?>">
					<input type="hidden" name="task" value="edit_change">
					<input type="submit" name="no_edit" id="submit" value="Submit" style="width:100px;">
					<input type="reset" name="no_edit" id="reset" value="Reset" style="width:100px;">
				</td>
			</tr>
			</table>
		</div>
		<div id="add_note_form" style="display:none; z-index:2;">
			<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
			<form action="dbaccess.php" method="post" name="add_note" id="add_note" onSubmit="return validate(this);">
			<tr>
				<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><br><strong>Add New Note</strong></td>
			</tr>
			<tr>
				<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
			</tr>
			<tr>
				<td align="center">
					<textarea cols="1" rows="5" name="new_note" id="new_note" style="width:600px;"></textarea>
				</td>
			</tr>
			<tr>
				<td align="center">
					<br><br>
					<input type="hidden" name="ticket_num" value="<? echo $approval["ticket_num"]; ?>">
<!--					<input type="hidden" name="task" value="add_change_note">-->
					<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
					<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
				</td>
			</tr>
			</form>
			</table>
		</div>
	</td>
</tr>

</form>
</table>
<? } ?>
