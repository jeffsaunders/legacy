<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Thoroughbred Racing Forecast M&S Roster Admin</title>

	<!-- Load Style Sheet -->
	<link href="../standard.css" rel="stylesheet" type="text/css">

	<script language="JavaScript" src="timedate.js" type="text/javascript"></script>
	<script>
	function validate(theForm){
	// Horse Name
		if (theForm.horse_name.value == ""){
			theForm.horse_name.style.background="#FF0000";
			alert("Please Enter A Horse Name");
			theForm.horse_name.style.background="#FFFFFF";
			theForm.horse_name.focus();
			return false;
		}
	// Horse Type
		if (theForm.horse_type.value == ""){
			theForm.horse_type.style.background="#FF0000";
			alert("Please Enter The Horse Type (i.e. '2 Year Old Colt')");
			theForm.horse_type.style.background="#FFFFFF";
			theForm.horse_type.focus();
			return false;
		}
	// Valid Race Date
		if (theForm.date_tba.checked == false){
			theForm.date_tba.value = "F";
			if (!isDate(theForm.race_date.value, "M/d/yy")){
				theForm.race_date.style.background="#FF0000";
				alert("The Race Date You Entered Is Not Valid\n\rPlease Use The Format: MM/DD/YY\n\r\n\rIf The Race Date Is Unknown Check 'TBA'\n\rAnd Leave The Race Date Blank.\n\r");
				theForm.race_date.style.background="#FFFFFF";
				theForm.race_date.focus();
				return false;
			}
		}else{
			theForm.race_date.value = 0;
			theForm.date_tba.value = "T";
		}
	// Track Name
		if (theForm.race_track.value == ""){
			theForm.race_track.style.background="#FF0000";
			alert("Please Enter A Track Name");
			theForm.race_track.style.background="#FFFFFF";
			theForm.race_track.focus();
			return false;
		}
	// Race Detail
		if (theForm.race_detail.value == ""){
			theForm.race_detail.style.background="#FF0000";
			alert("Please Enter The Race Details (Race Number, Race Name, etc.)");
			theForm.race_detail.style.background="#FFFFFF";
			theForm.race_detail.focus();
			return false;
		}
		return true;
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

<!-- LIST ROSTER -->
<?
if (!$sec || $sec == "list"){
	$query = "SELECT *, UNIX_TIMESTAMP(race_date) as date FROM roster ORDER BY date_tba DESC, date ASC, horse_name ASC";
	$rs_roster = mysql_query($query, $linkID);
?>
<table border="0" cellspacing="0" cellpadding="4" align="center" class="bodyBlack">
<tr>
	<td colspan="6" align="center" class="superBlack"><strong>Current Roster</strong></td>
</tr>
<tr bgcolor="#000000" class="bodyWhite">
	<th>Horse</th>
	<th>Date</th>
	<th>Track</th>
	<th>Event</th>
	<th>Display</th>
	<th>Action</th>
</tr>
	<?
	for ($counter=1; $counter <= mysql_num_rows($rs_roster); $counter++){
		$row = mysql_fetch_assoc($rs_roster);
		$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr bgcolor="<? echo $bg; ?>">
	<td style="border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["horse_name"].' ('.$row["horse_type"].')'; ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo iif($row["date"] == 0, "TBA", date("m/d/Y", $row["date"])); ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["race_track"]; ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["race_detail"]; ?></strong></td>
	<td align="center" style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>Yes</strong>", "No"); ?></td>
	<td align="center" style="border-left: 1px solid #FFFFFF;"><input type="button" name="edit" id="edit" value="Edit" style="width:50;" class="smallBlack" onClick="window.location='?sec=edit&id=<? echo $row["unique_id"]; ?>';"><input type="button" name="delete" id="delete" value="Delete" style="width:50;" class="smallBlack" onClick="window.location='?sec=delete&id=<? echo $row["unique_id"]; ?>&horse=<? echo addslashes($row["horse_name"]); ?>';"></td>
</tr>
	<?
	}
	$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr>
	<td colspan="5" bgcolor="#000000">&nbsp;</td>
	<td align="right" bgcolor="<? echo $bg; ?>">
		<input type="button" name="add" id="add" value="Add a New Entry" style="width:100;" class="smallBlack" onClick="window.location='?sec=add';">
	</td>
</tr>
</table>
<?
}
?>

<!-- ADD ENTRY -->
<?
if ($sec == "add"){
	$query = "SELECT *, UNIX_TIMESTAMP(race_date) as date FROM roster ORDER BY date_tba DESC, date ASC, horse_name ASC";
	$rs_roster = mysql_query($query, $linkID);
?>
<table border="0" cellspacing="0" cellpadding="4" align="center" class="bodyBlack">
<tr>
	<td colspan="6" align="center" class="superBlack"><strong>Current Roster</strong></td>
</tr>
<tr bgcolor="#000000" class="bodyWhite">
	<th>Horse</th>
	<th>Date</th>
	<th>Track</th>
	<th>Event</th>
	<th>Display</th>
</tr>
	<?
	for ($counter=1; $counter <= mysql_num_rows($rs_roster); $counter++){
		$row = mysql_fetch_assoc($rs_roster);
		$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr bgcolor="<? echo $bg; ?>">
	<td style="border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["horse_name"].' ('.$row["horse_type"].')'; ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo iif($row["date"] == 0, "TBA", date("m/d/Y", $row["date"])); ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["race_track"]; ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["race_detail"]; ?></strong></td>
	<td align="center" style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>Yes</strong>", "No"); ?></td>
</tr>
	<?
	}
	$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr>
	<td colspan="5" bgcolor="#000000">&nbsp;</td>
</tr>
</table>
<br><br>
<form action="saveit.php" method="post" name="add_entry" id="add_entry" onSubmit="return validate(this);">
<table border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td colspan="2" align="center" class="superBlack"><strong>Add New Roster Entry</strong></td>
</tr>
<tr>
	<td colspan="2"><hr width="100%" size="1" noshade></td>
</tr>
<tr>
<tr>
	<td align="right">Horse Name:</td>
	<td><input type="text" name="horse_name" id="horse_name" value="" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Horse Type:</td>
	<td><input type="text" name="horse_type" id="horse_type" value="" size="50" maxlength="100" style="width:200px;">&nbsp;<em class="smallBlack">(i.e "2 Year Old Colt")</em></td>
</tr>
<tr>
	<td align="right">Race Date:</td>
	<td>
		<input type="text" name="race_date" id="race_date" value="" size="50" maxlength="100" style="width:200px;">&nbsp;Check if TBA: <input type="checkbox" name="date_tba" id="date_tba" value="">
	</td>
</tr>
<tr>
	<td align="right">Track:</td>
	<td><input type="text" name="race_track" id="race_track" value="" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Race/Event Details:</td>
	<td><input type="text" name="race_detail" id="race_detail" value="" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Race Result:</td>
	<td><input type="text" name="race_result" id="race_result" value="" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td colspan="2" align="center">Display This Event On Website Roster?&nbsp;<input type="radio" name="display" id="display" value="T" checked>&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="display" id="display" value="F">&nbsp;No
	</td>
</tr>
<tr>
	<td colspan="2" align="center"><br><input type="submit" name="submit" id="submit" value=" Save "><!--&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" id="reset" value="Reset">--></td>
</tr>
</table>
<input type="hidden" name="task" value="addroster">
</form>
<? } ?>


<!-- EDIT ENTRY -->
<?
if ($sec == "edit"){
	$query = "SELECT *, UNIX_TIMESTAMP(race_date) as date FROM roster ORDER BY date_tba DESC, date ASC, horse_name ASC";
	$rs_roster = mysql_query($query, $linkID);
?>
<table border="0" cellspacing="0" cellpadding="4" align="center" class="bodyBlack">
<tr>
	<td colspan="6" align="center" class="superBlack"><strong>Current Roster</strong></td>
</tr>
<tr bgcolor="#000000" class="bodyWhite">
	<th>Horse</th>
	<th>Date</th>
	<th>Track</th>
	<th>Event</th>
	<th>Display</th>
</tr>
	<?
	for ($counter=1; $counter <= mysql_num_rows($rs_roster); $counter++){
		$row = mysql_fetch_assoc($rs_roster);
		$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr bgcolor="<? echo $bg; ?>">
	<td style="border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["horse_name"].' ('.$row["horse_type"].')'; ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo iif($row["date"] == 0, "TBA", date("m/d/Y", $row["date"])); ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["race_track"]; ?></strong></td>
	<td style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>", ""); ?><? echo $row["race_detail"]; ?></strong></td>
	<td align="center" style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF;"><? echo iif($row["display"] == "T", "<strong>Yes</strong>", "No"); ?></td>
</tr>
	<?
	}
	$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr>
	<td colspan="5" bgcolor="#000000">&nbsp;</td>
</tr>
</table>
<br><br>
<?
	$query = "SELECT *, UNIX_TIMESTAMP(race_date) as date FROM roster WHERE unique_id = '".$_REQUEST['id']."'";
	$rs_roster = mysql_query($query, $linkID);
	$row = mysql_fetch_assoc($rs_roster);
?>
<form action="saveit.php" method="post" name="edit_entry" id="edit_entry" onSubmit="return validate(this);">
<table border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td colspan="2" align="center" class="superBlack"><strong>Edit Roster Entry</strong></td>
</tr>
<tr>
	<td colspan="2"><hr width="100%" size="1" noshade></td>
</tr>
<tr>
<tr>
	<td align="right">Horse Name:</td>
	<td><input type="text" name="horse_name" id="horse_name" value="<? echo $row["horse_name"]; ?>" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Horse Type:</td>
	<td><input type="text" name="horse_type" id="horse_type" value="<? echo $row["horse_type"]; ?>" size="50" maxlength="100" style="width:200px;">&nbsp;<em class="smallBlack">(i.e "2 Year Old Colt")</em></td>
</tr>
<tr>
	<td align="right">Race Date:</td>
	<td>
		<input type="text" name="race_date" id="race_date" value="<? echo iif($row["date"] == 0, "", date('m/d/y',$row["date"])); ?>" size="50" maxlength="100" style="width:200px;">&nbsp;Check if TBA: <input type="checkbox" name="date_tba" id="date_tba" value=""<? echo iif($row["date_tba"] == 'T', " checked", ""); ?>>
	</td>
</tr>
<tr>
	<td align="right">Track:</td>
	<td><input type="text" name="race_track" id="race_track" value="<? echo $row["race_track"]; ?>" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Race/Event Details:</td>
	<td><input type="text" name="race_detail" id="race_detail" value="<? echo $row["race_detail"]; ?>" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td align="right">Race Result:</td>
	<td><input type="text" name="race_result" id="race_result" value="<? echo $row["race_result"]; ?>" size="50" maxlength="100" style="width:200px;"></td>
</tr>
<tr>
	<td colspan="2" align="center">Display This Event On Website Roster?&nbsp;<input type="radio" name="display" id="display" value="T"<? echo iif($row["display"] == 'T', " checked", ""); ?>>&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="display" id="display" value="F"<? echo iif($row["display"] == 'F', " checked", ""); ?>>&nbsp;No
	</td>
</tr>
<tr>
	<td colspan="2" align="center"><br><input type="submit" name="submit" id="submit" value=" Save ">&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" id="reset" value="Reset"></td>
</tr>
</table>
<input type="hidden" name="unique_id" id="unique_id" value="<? echo $_REQUEST['id']; ?>">
<input type="hidden" name="task" value="editroster">
</form>
<? } ?>


<!-- DELETE ENTRY -->
<?
if ($sec == "delete"){
?>
<form action="saveit.php" method="post" name="delete_entry" id="delete_entry">
<input type="hidden" name="unique_id" id="unique_id" value="">
<input type="hidden" name="task" value="deleteroster">
</form>
<script>
var go = confirm("Confirm Remove <? echo $_REQUEST['horse']; ?>");
if (go == true){
	document.delete_entry.unique_id.value = '<? echo $_REQUEST['id']; ?>';
	document.delete_entry.submit();
}
</script>
<? } ?>

<?
if ($_REQUEST['message']) echo "<script>alert('".$_REQUEST['message']."');</script>";
?>

</body>
</html>
