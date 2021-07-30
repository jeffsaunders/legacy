<!-- BEGIN INCLUDE manage.php -->
<?
if (!$task) $task = "list_open";
if ($task == "list_approvals"){
	$title = "Request Approval";
	$message = "The following is a list of the current requests needing approval:";
	$instructions = "";
//}elseif ($task == "edit_user"){
//	$title = "Site Users";
//	$message = "Please make any changes below and click submit:";
//	$instructions = "Any changes made via this form will be immediate. Deletions are permanent.";
//}elseif ($task == "add_user"){
//	$title = "Site Users";
//	$message = "Please enter the following information to add a new site user:";
//	$instructions = "";
//}elseif ($task == "list_devices"){
//	$title = "Authorized Devices";
//	$message = "The following is a list of the devices currently entered:";
//	$instructions = "Items marked as \"Available\" populate the list of available devices on the site forms.";
//}elseif ($task == "add_device"){
//	$title = "Authorized Devices";
//	$message = "Please enter the following information to add a new device:";
//	$instructions = "";
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
	<td width="100%" height="25" bgcolor="#EFEFEF" style="border-top: 2px solid #008000;" class="bigBlack">&nbsp;&nbsp;<strong><? echo $title; ?></strong></td>
</tr>
</table>
<br>
<table width="600" border="0" cellspacing="1" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td class="bodyBlack"><strong><? echo $message; ?></strong><br><br></td>
</tr>
<? if ($instructions != ""){ ?>
<tr>
	<td align="center">
		<table border="0" cellspacing="0" cellpadding="0" align="center">
			<td width="500" class="bodyBlack"><em><? echo $instructions; ?></em><br><br></td>
		</table>
	</td>
</tr>
<? } ?>

<!-- LIST QUEUED APPROVALS -->
<? if ($task == "list_approvals"){ ?>
<?
$query = "SELECT * FROM transfers t, tickets k WHERE t.approved = 'F' ORDER BY open_time DESC";
$rs_approvals = mysql_query($query, $linkID);
?>
<tr>
	<td class="smallBlack"><br><strong>Transfer/Port Tickets</strong></td>
</tr>
<!--<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="4" class="bodyBlack">
		<tr bgcolor="000000" class="bodyWhite">
			<th width="90">User Name</th>
			<th width="90">User ID</th>
			<th width="90">First Name</th>
			<th width="90">Last Name</th>
			<th width="160">Phone Number</th>
			<th width="20">&nbsp;&nbsp;~</th>
		</tr>
	<?
	$hit = 0;
	for ($counter=1; $counter <= mysql_num_rows($rs_users); $counter++){
		$user = mysql_fetch_assoc($rs_users);
		if ($user["user_level"] == "Admin"){
			$hit++;
			$bg = iif(is_even($hit),"#F8F8F8","#E0E0E0");
	?>
		<tr bgcolor="<? echo $bg; ?>">
			<td style="border-right: 1px solid #FFFFFF;"><? echo $user["username"]; ?></td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo $user["user_id"]; ?></td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo $user["first_name"]; ?></td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo $user["last_name"]; ?></td>
			<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo $user["phone_num"]; ?></td>
			<td align="center" style="border-left: 1px solid #FFFFFF;"><a href="?sec=manage&task=edit_user&cargo=<? echo $user["username"]; ?>" class="bodyBlack">Edit</a></td>
		</tr>
	<?
		 }
	}
	 ?>
		</table>
	</td>
</tr>-->
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>




<? } ?>
