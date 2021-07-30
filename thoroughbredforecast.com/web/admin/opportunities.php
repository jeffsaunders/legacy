<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Thoroughbred Racing Forecast M&S Opportunities Admin</title>

	<!-- Load Style Sheet -->
	<link href="../standard.css" rel="stylesheet" type="text/css">

	<script language="JavaScript" src="timedate.js" type="text/javascript"></script>
	<script>
	function validate(theForm){
	// Priority
		var priority_regex = /^[0-9]+$/; // Number only
		if (priority_regex.test(theForm.priority.value) == false) { 
//		if (theForm.priority.value == ""){
			theForm.priority.style.background="#FF0000";
			alert("You Must Assign A Priority And It Must Be A Whole Number ONLY");
			theForm.priority.style.background="#FFFFFF";
			theForm.priority.focus();
			return false;
		}
	// Headline
		if (theForm.headline.value == ""){
			theForm.headline.style.background="#FF0000";
			alert("Please Enter A Headline");
			theForm.headline.style.background="#FFFFFF";
			theForm.headline.focus();
			return false;
		}
	// Body
		if (theForm.body.value == ""){
			theForm.body.style.background="#FF0000";
			alert("Please Enter The Message Body");
			theForm.body.style.background="#FFFFFF";
			theForm.body.focus();
			return false;
		}
	}
	</script>

</head>

<body>

<table border="0" align="center">
<tr>
	<td align="center" class="titleBlack">TRF Administration System</td>
</tr>
<tr>
	<td align="center"><a href="index.php" target="_self" class="superBlack">Return To The Ugly Menu</a></td>
</tr>
</table>
<br>

<!-- Grab the database -->
<? include("../dbconnect.php"); ?>

<?
// PHP Functions
// Is passed value odd?
function is_odd($num){
	return (is_numeric($num)&($num&1));
}

// Is passed value even?
function is_even($num){
	return (is_numeric($num)&(!($num&1)));
}

// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
}
?>

<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
//$show = $_REQUEST['show'];
//$cargo = $_REQUEST['cargo'];
?>

<!-- LIST OPPORTUNITIES -->

<?
if (!$sec || $sec == "list"){
	$query = "SELECT * FROM opportunities ORDER BY priority ASC";
	$rs_ops = mysql_query($query, $linkID);
?>
<table width="90%" border="0" cellspacing="0" cellpadding="4" align="center" class="bodyBlack">
<tr>
	<td colspan="6" align="center" class="superBlack"><strong>Current Opportunities</strong></td>
</tr>
<tr bgcolor="#000000" class="bodyWhite">
	<th>Priority</th>
	<th>Headline/Body</th>
	<th>Display</th>
	<th>Action</th>
</tr>
	<?
	for ($counter=1; $counter <= mysql_num_rows($rs_ops); $counter++){
		$row = mysql_fetch_assoc($rs_ops);
		$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr bgcolor="<? echo $bg; ?>">
	<td align="center" style="border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["priority"]; ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["headline"].'<br>'.$row["body"] ?></strong></td>
	<td align="center" style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>Yes</strong>", "No"); ?></td>
	<td align="center" style="border-left: 1px solid #FFFFFF;"><input type="button" name="edit" id="edit" value="Edit" style="width:50;" class="smallBlack" onClick="window.location='?sec=edit&id=<? echo $row["unique_id"]; ?>';"><input type="button" name="delete" id="delete" value="Delete" style="width:50;" class="smallBlack" onClick="window.location='?sec=delete&id=<? echo $row["unique_id"]; ?>&headline=<? echo addslashes($row["headline"]); ?>';"></td>
</tr>
	<?
	}
	$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr>
	<td colspan="3" bgcolor="#000000">&nbsp;</td>
	<td align="right" bgcolor="<? echo $bg; ?>">
		<input type="button" name="add" id="add" value="Add a New Entry" style="width:100;" class="smallBlack" onClick="window.location='?sec=add';">
	</td>
</tr>
</table>
<?
}
?>

<!-- ADD OPPORTUNITY -->
<?
if ($sec == "add"){
	$query = "SELECT * FROM opportunities ORDER BY priority ASC";
	$rs_ops = mysql_query($query, $linkID);
?>
<table width="90%" border="0" cellspacing="0" cellpadding="4" align="center" class="bodyBlack">
<tr>
	<td colspan="6" align="center" class="superBlack"><strong>Current Opportunities</strong></td>
</tr>
<tr bgcolor="#000000" class="bodyWhite">
	<th>Priority</th>
	<th>Headline/Body</th>
	<th>Display</th>
</tr>
	<?
	for ($counter=1; $counter <= mysql_num_rows($rs_ops); $counter++){
		$row = mysql_fetch_assoc($rs_ops);
		$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr bgcolor="<? echo $bg; ?>">
	<td align="center" style="border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["priority"]; ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["headline"].'<br>'.$row["body"] ?></strong></td>
	<td align="center" style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>Yes</strong>", "No"); ?></td>
</tr>
	<?
	}
	$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr>
	<td colspan="3" bgcolor="#000000">&nbsp;</td>
</tr>
</table>
<br><br>
<form action="saveit.php" method="post" name="add_op" id="add_op" onSubmit="return validate(this);">
<table border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td colspan="2" align="center" class="superBlack"><strong>Add New Investment Opportunity</strong></td>
</tr>
<tr>
	<td colspan="2"><hr width="100%" size="1" noshade></td>
</tr>
<tr>
<tr>
	<td align="right">Priority:</td>
	<td><input type="text" name="priority" id="priority" value="" size="5" maxlength="5" style="width:50px;"></td><!-- make numbers only-->
</tr>
<tr>
	<td align="right">Headline:</td>
	<td><input type="text" name="headline" id="headline" value="" size="50" maxlength="255" style="width:300px;"><!--&nbsp;<em class="smallBlack">(i.e "2 Year Old Colt")</em>--></td>
</tr>
<tr>
	<td align="right" valign="top">Body:</td>
	<td><textarea cols="20" rows="3" name="body" id="body" style="width:300px;"></textarea></td>
</tr>
<tr>
	<td colspan="2" align="center">Display This Opportunity On Website?&nbsp;<input type="radio" name="display" id="display" value="T" checked>&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="display" id="display" value="F">&nbsp;No
	</td>
</tr>
<tr>
	<td colspan="2" align="center"><br><input type="submit" name="submit" id="submit" value=" Save "><!--&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" id="reset" value="Reset">--></td>
</tr>
</table>
<input type="hidden" name="task" value="addopportunity">
</form>
<? } ?>


<!-- EDIT OPPORTUNITY -->
<?
if ($sec == "edit"){
	$query = "SELECT * FROM opportunities ORDER BY priority ASC";
	$rs_ops = mysql_query($query, $linkID);
?>
<table width="90%" border="0" cellspacing="0" cellpadding="4" align="center" class="bodyBlack">
<tr>
	<td colspan="6" align="center" class="superBlack"><strong>Current Opportunities</strong></td>
</tr>
<tr bgcolor="#000000" class="bodyWhite">
	<th>Priority</th>
	<th>Headline/Body</th>
	<th>Display</th>
</tr>
	<?
	for ($counter=1; $counter <= mysql_num_rows($rs_ops); $counter++){
		$row = mysql_fetch_assoc($rs_ops);
		$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr bgcolor="<? echo $bg; ?>">
	<td align="center" style="border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["priority"]; ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["headline"].'<br>'.$row["body"] ?></strong></td>
	<td align="center" style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>Yes</strong>", "No"); ?></td>
</tr>
	<?
	}
	$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr>
	<td colspan="3" bgcolor="#000000">&nbsp;</td>
</tr>
</table>
<br><br>
<?
	$query = "SELECT * FROM opportunities WHERE unique_id = '".$_REQUEST['id']."'";
	$rs_op = mysql_query($query, $linkID);
	$row = mysql_fetch_assoc($rs_op);
?>
<form action="saveit.php" method="post" name="edit_op" id="edit_op" onSubmit="return validate(this);">
<table border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td colspan="2" align="center" class="superBlack"><strong>Edit Investment Opportunity</strong></td>
</tr>
<tr>
	<td colspan="2"><hr width="100%" size="1" noshade></td>
</tr>
<tr>
<tr>
	<td align="right">Priority:</td>
	<td><input type="text" name="priority" id="priority" value="<? echo $row["priority"]; ?>" size="5" maxlength="5" style="width:50px;"></td><!-- make numbers only-->
</tr>
<tr>
	<td align="right">Headline:</td>
	<td><input type="text" name="headline" id="headline" value="<? echo $row["headline"]; ?>" size="50" maxlength="255" style="width:300px;"><!--&nbsp;<em class="smallBlack">(i.e "2 Year Old Colt")</em>--></td>
</tr>
<tr>
	<td align="right" valign="top">Body:</td>
	<td><textarea cols="20" rows="3" name="body" id="body" style="width:300px;"><? echo $row["body"]; ?></textarea></td>
</tr>
<tr>
	<td colspan="2" align="center">Display This Opportunity On Website?&nbsp;<input type="radio" name="display" id="display" value="T"<? echo iif($row["display"] == 'T', " checked", ""); ?>>&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="display" id="display" value="F"<? echo iif($row["display"] == 'F', " checked", ""); ?>>&nbsp;No
	</td>
</tr>
<tr>
	<td colspan="2" align="center"><br><input type="submit" name="submit" id="submit" value=" Save ">&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" id="reset" value="Reset"></td>
</tr>
</table>
<input type="hidden" name="unique_id" id="unique_id" value="<? echo $_REQUEST['id']; ?>">
<input type="hidden" name="task" value="editopportunity">
</form>
<? } ?>

<!-- DELETE OPPORTUNITY -->
<?
if ($sec == "delete"){
?>
<form action="saveit.php" method="post" name="delete_op" id="delete_op">
<input type="hidden" name="unique_id" id="unique_id" value="">
<input type="hidden" name="task" value="deleteopportunity">
</form>
<script>
var go = confirm("Confirm Remove:\n\r<? echo $_REQUEST['headline']; ?>");
if (go == true){
	document.delete_op.unique_id.value = '<? echo $_REQUEST['id']; ?>';
	document.delete_op.submit();
}
</script>
<? } ?>


<?
if ($_REQUEST['message']) echo "<script>alert('".$_REQUEST['message']."');</script>";
?>

</body>
</html>
