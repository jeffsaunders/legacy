<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?
//$message = $_REQUEST['message'];
?>

<html>
<head>
	<title>Thoroughbred Racing Forecast Free Pick Admin</title>

	<!-- Load Style Sheet -->
	<link href="../standard.css" rel="stylesheet" type="text/css">

	<script language="JavaScript" src="timedate.js" type="text/javascript"></script>
	<script>
	function validate(theForm){
	// Valid Race Date
		if (!isDate(theForm.race_date.value, "M/d/yy")){
			theForm.race_date.style.background="#FF0000";
			alert("The Race Date You Entered Is Invalid");
			theForm.race_date.style.background="#FFFFFF";
			theForm.race_date.focus();
			return false;
		}
	// Track Name
		if (theForm.track_name.value == ""){
			theForm.track_name.style.background="#FF0000";
			alert("Please Enter A Track Name");
			theForm.track_name.style.background="#FFFFFF";
			theForm.track_name.focus();
			return false;
		}
	// Race Number
		if (theForm.race_num.value == ""){
			if (theForm.race_name.value == ""){
				theForm.race_num.style.background="#FF0000";
				alert("You Must Enter A Race Number If There Is No Race Name");
				theForm.race_num.style.background="#FFFFFF";
				theForm.race_num.focus();
				return false;
			}
		}
	// Horse #1 Name
		if (theForm.win_name.value == ""){
			theForm.win_name.style.background="#FF0000";
			alert("Please Enter A Horse Name");
			theForm.win_name.style.background="#FFFFFF";
			theForm.win_name.focus();
			return false;
		}
	// Sponsor
		if (theForm.sponsor.value == ""){
			theForm.sponsor.style.background="#FF0000";
			alert("Please Enter A Sponsor Name");
			theForm.sponsor.style.background="#FFFFFF";
			theForm.sponsor.focus();
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
$query = "SELECT *, UNIX_TIMESTAMP(race_date) as date FROM freepicks ORDER BY timestamp desc LIMIT 1";
$rs_freepick = mysql_query($query, $linkID) or die(mysql_error());
$pick = mysql_fetch_assoc($rs_freepick);
?>

<form action="saveit.php" method="post" name="freepick" id="freepick" onSubmit="return validate(this);">
<table align="center" class="bodyBlack">
<tr>
	<td colspan="2" align="center" class="superBlack"><strong>Free Pick(s)</strong></td>
</tr>
<tr>
	<td colspan="2"><hr width="100%" size="1" noshade></td>
</tr>
<tr>
	<td>Race Date:</td>
	<td><input type="text" name="race_date" id="race_date" value="<? echo date('m/d/y',$pick["date"]); ?>" size="8" maxlength="8">&nbsp;<em class="smallBlack">(Required)</em></td>
</tr>
<tr>
	<td>Track Name:</td>
	<td><input type="text" name="track_name" id="track_name" value="<? echo $pick["track_name"]; ?>" size="20" maxlength="100">&nbsp;<em class="smallBlack">(Required)</em></td>
</tr>
<tr>
	<td>Race Number:</td>
	<td><input type="text" name="race_num" id="race_num" value="<? echo $pick["race_num"]; ?>" size="2" maxlength="10">&nbsp;<em class="smallBlack">(May Be Blank if Race Name Entered)</em></td>
</tr>
<tr>
	<td>Race Name:</td>
	<td><input type="text" name="race_name" id="race_name" value="<? echo $pick["race_name"]; ?>" size="20" maxlength="50">&nbsp;<em class="smallBlack">(May Be Blank)</em></td>
</tr>
<tr>
	<td colspan="2"><br></td>
</tr>
<tr>
	<td>Horse #1 Name:</td>
	<td><input type="text" name="win_name" id="win_name" value="<? echo $pick["win_name"]; ?>" size="20" maxlength="100">&nbsp;<em class="smallBlack">(Required)</em></td>
</tr>
<tr>
	<td>Horse #1 Number:</td>
	<td><input type="text" name="win_num" id="win_num" value="<? echo $pick["win_num"]; ?>" size="2" maxlength="10">&nbsp;<em class="smallBlack">(Optional)</em></td>
</tr>
<tr>
	<td>Horse #2 Name:</td>
	<td><input type="text" name="place_name" id="place_name" value="<? echo $pick["place_name"]; ?>" size="20" maxlength="100">&nbsp;<em class="smallBlack">(May Be Blank)</em></td>
</tr>
<tr>
	<td>Horse #2 Number:</td>
	<td><input type="text" name="place_num" id="place_num" value="<? echo $pick["place_num"]; ?>" size="2" maxlength="10">&nbsp;<em class="smallBlack">(Optional)</em></td>
</tr>
<tr>
	<td>Horse #3 Name:</td>
	<td><input type="text" name="show_name" id="show_name" value="<? echo $pick["show_name"]; ?>" size="20" maxlength="100">&nbsp;<em class="smallBlack">(May Be Blank)</em></td>
</tr>
<tr>
	<td>Horse #3 Number:</td>
	<td><input type="text" name="show_num" id="show_num" value="<? echo $pick["show_num"]; ?>" size="2" maxlength="10">&nbsp;<em class="smallBlack">(Optional)</em></td>
</tr>
<tr>
	<td>Race Note/Result:</td>
	<td><input type="text" name="race_note" id="race_note" value='<? echo $pick["race_note"]; ?>' size="20" maxlength="250">&nbsp;<em class="smallBlack">(May Be Blank)</em></td>
</tr>
<tr>
	<td colspan="2"><br></td>
</tr>
<tr>
	<td valign="top">Note:<br><em class="smallBlack">(May Be Blank)</em></td>
	<td><textarea cols="35" rows="3" maxlength="255" name="note" id="note" class="bodyBlack"><? echo $pick["note"]; ?></textarea></td>
</tr>
<tr>
	<td>Sponsor Name:</td>
	<td><input type="text" name="sponsor" id="sponsor" value="<? echo $pick["sponsor"]; ?>" size="20" maxlength="100">&nbsp;<em class="smallBlack">(Required)</em></td>
</tr>
<tr>
	<td>Sponsor Link:</td>
	<td><input type="text" name="sponsor_link" id="sponsor_link" value="<? echo $pick["sponsor_link"]; ?>" size="20" maxlength="100">&nbsp;<em class="smallBlack">(If Available)</em></td>
</tr>
<tr>
	<td colspan="2" align="center"><br><input type="submit" name="submit" id="submit" value=" Save "><!--&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" id="reset" value="Reset">--></td>
</tr>
</table>
<input type="hidden" name="timestamp" id="timestamp" value="<? echo $pick["timestamp"]; ?>">
<input type="hidden" name="task" value="savepick">
</form>

<?
if ($_REQUEST['message']) echo "<script>alert('".$_REQUEST['message']."');</script>";
?>

</body>
</html>
