<!-- BEGIN INCLUDE news.php -->

<!-- Validation Script -->
<script>
function validate(theForm){
	// Title
	if (theForm.title){
		if (theForm.title.value == ""){
			theForm.title.style.background="#FF0000";
			alert("Please Enter An Article Title/Headline");
			theForm.title.style.background="#FFFFFF";
			theForm.title.focus();
			return false;
		}
	}
	// Note Date
	if (theForm.note_date){
		if (theForm.note_date.value != ""){
			var note_date_regex = /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/;  // xx/xx/xxxx
			if (note_date_regex.test(theForm.note_date.value) == false) { 
				theForm.note_date.style.background="#FF0000";
				alert('Please Enter a Valid Date as NN/NN/NNNN');
				theForm.note_date.style.background="#FFFFFF";
				theForm.note_date.focus();
				return false;
			}
		}
	}
	// Note
	if (theForm.note){
		if (theForm.note.value == ""){
			theForm.note.style.background="#FF0000";
			alert("Please Enter The Article Content");
			theForm.note.style.background="#FFFFFF";
			theForm.note.focus();
			return false;
		}
	}
	// Note Date
	if (theForm.start_date){
		if (theForm.start_date.value == ""){
			theForm.start_date.style.background="#FF0000";
			alert("Please Enter a Starting Date");
			theForm.start_date.style.background="#FFFFFF";
			theForm.start_date.focus();
			return false;
		}
		var start_date_regex = /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/;  // xx/xx/xxxx
		if (start_date_regex.test(theForm.start_date.value) == false) { 
			theForm.start_date.style.background="#FF0000";
			alert('Please Enter a Valid Date as NN/NN/NNNN');
			theForm.start_date.style.background="#FFFFFF";
			theForm.start_date.focus();
			return false;
		}
	}
	// End Date
	if (theForm.end_date){
		if (theForm.end_date.value != ""){
			var end_date_regex = /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/;  // xx/xx/xxxx
			if (end_date_regex.test(theForm.end_date.value) == false) { 
				theForm.end_date.style.background="#FF0000";
				alert('Please Enter a Valid Date as NN/NN/NNNN');
				theForm.end_date.style.background="#FFFFFF";
				theForm.end_date.focus();
				return false;
			}
		}
	}
	// Audience
	if (theForm.show_user && theForm.show_asst && theForm.show_admin){
		if (!theForm.show_user.checked && !theForm.show_asst.checked && !theForm.show_admin.checked){
			document.getElementById("audience").bgColor = "#FF0000";
			alert("Please Select At Least One");
			document.getElementById("audience").bgColor = "#FFFFFF";
			theForm.show_user.focus();
			return false;
		}
	}
	return true;
}
</script>

<?
if (!$task) $task = "list";
if ($task == "list"){
	$title = "Site News &amp; Notes";
	$message = "The following is a list of the current site news &amp; notes:";
	$instructions = "";
}elseif ($task == "edit_welcome"){
	$title = "Site News &amp; Notes";
	$message = "Please make any changes below and click submit:";
	$instructions = "Any changes made via this form will be immediate.";
}elseif ($task == "edit_note"){
	$title = "Site News &amp; Notes";
	$message = "Please make any changes below and click submit:";
	$instructions = "Any changes made via this form will be active as of the \"Start Date\" entered.<br>Deletions are immediate and permanent.";
}elseif ($task == "add_note"){
	$title = "Site News &amp; Notes";
	$message = "Please enter the following information to add a site note:";
	$instructions = "Please be certain to select ALL the site user levels (Audience) you wish to have view this item.";
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

<?
$query = "SELECT * FROM site_notes	WHERE type = 'welcome'";
$rs_welcome = mysql_query($query, $linkID);
$welcome = mysql_fetch_assoc($rs_welcome);

$query = "SELECT *, UNIX_TIMESTAMP(note_date) as date FROM site_notes
			WHERE display = 'T' AND
			type != 'welcome' AND
			start_date <= CURDATE() AND
			(end_date >= CURDATE() OR end_date IS NULL)
			ORDER BY note_date DESC";
$rs_notes = mysql_query($query, $linkID);
?>

<!-- LIST NEWS & NOTES -->
<? if ($task == "list"){ ?>
<tr>
	<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Welcome Message</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="0" bgcolor="#E0E0E0" class="bodyBlack">
		<tr>
			<td><strong><? echo $welcome["title"]; ?></strong></td>
		</tr>
		<tr>
			<td><? echo substr($welcome["note"], 0, 200)." ..."; ?></td>
		</tr>
		<tr>
			<td align="right"><a href="?sec=news&task=edit_welcome" class="bigBlack">Edit</a>&nbsp;</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
<tr>
	<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>News &amp; Notes</strong></td>
</tr>
	<?
	for ($counter=1; $counter <= mysql_num_rows($rs_notes); $counter++){
		$note = mysql_fetch_assoc($rs_notes);
		$bg = iif(is_even($counter),"#F8F8F8","#E0E0E0");
	?>
<tr bgcolor="<? echo $bg; ?>">
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
		<tr>
			<td>
				<strong><? echo $note["title"]; ?></strong><br>
				<? echo substr($note["note"], 0, 200)." ..."; ?><br>
				<div align="right"><a href="?sec=news&task=edit_note&cargo=<? echo $note["unique_id"]; ?>" class="bigBlack">Edit</a>&nbsp;</div>
			</td>
		</tr>
		</table>
	</td>
</tr>
	<? } ?>
<tr>
	<td align="center">
		<br>
		<input type="button" name="add" id="add" value="Add a New Note" style="width:190px;" onClick="window.location='?sec=news&task=add_note';">
	</td>
</tr>
</table>
<? } ?>

<!-- EDIT WELCOME MESSAGE -->
<? if ($task == "edit_welcome"){ ?>
<form action="dbaccess.php" method="post" name="edit_welcome" id="edit_welcome" onSubmit="return validate(this);">
<tr>
	<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Edit Welcome Message</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
		<tr>
			<td width="100" align="right">Title:</td>
			<td rowspan="99"><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
			<td width="480"><input type="text" name="title" id="title" value="<? echo addslashes($welcome["title"]); ?>" size="50" maxlength="100" style="width:450px;"></td>
		</tr>
		<tr>
			<td align="right" valign="top">Message:<br><em class="smallBlack">(HTML Allowed)</em></td>
			<td><textarea cols="40" rows="10" name="note" id="note" style="width:450px;" class="bodyBlack"><? echo addslashes($welcome["note"]); ?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Submit" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
</table>
<input type="hidden" name="task" value="edit_welcome">
</form>
<? } ?>

<!-- ADD NOTE -->
<? if ($task == "add_note"){ ?>
<form action="dbaccess.php" method="post" name="add_note" id="add_note" onSubmit="return validate(this);">
<tr>
	<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Add News/Note Item</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
		<tr>
			<td width="100" align="right">Title:</td>
			<td rowspan="99"><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
			<td width="480"><input type="text" name="title" id="title" value="" size="50" maxlength="100" style="width:450px;"></td>
		</tr>
		<tr>
			<td align="right">Date:</td>
			<td><input type="text" name="note_date" id="note_date" value="<? echo date("m/d/Y"); ?>" size="50" maxlength="10" style="width:200px;"><span class="smallBlack">&nbsp;*Leave Blank for None - Will Display at Bottom</span></td>
		</tr>
		<tr>
			<td align="right" valign="top">Message:<br><em class="smallBlack">(HTML Allowed)</em></td>
			<td><textarea cols="40" rows="10" name="note" id="note" style="width:450px;" class="bodyBlack"></textarea></td>
		</tr>
		<tr>
			<td align="right">Start Date:</td>
			<td><input type="text" name="start_date" id="start_date" value="<? echo date("m/d/Y"); ?>" size="50" maxlength="10" style="width:200px;"><span class="smallBlack">&nbsp;*First Date to Display Note</span></td>
		</tr>
		<tr>
			<td align="right">End Date:</td>
			<td><input type="text" name="end_date" id="end_date" value="" size="50" maxlength="10" style="width:200px;"><span class="smallBlack">&nbsp;*Last Date to Display Note - Leave Blank for None</span></td>
		</tr>
		<tr>
			<td align="right">Audience:</td>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
				<tr id="audience">
					<td><input type="checkbox" name="show_user" value="T">Site Users</td>
					<td>&nbsp;&nbsp;</td>
					<td><input type="checkbox" name="show_asst" value="T">Site Assistants</td>
					<td>&nbsp;&nbsp;</td>
					<td><input type="checkbox" name="show_admin" value="T">Site Administrators</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Add" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
</table>
<input type="hidden" name="task" value="add_note">
</form>
<? } ?>

<!-- EDIT NOTE -->
<? if ($task == "edit_note"){ ?>
<?
$query = "SELECT *,
			UNIX_TIMESTAMP(note_date) as note_date,
			UNIX_TIMESTAMP(start_date) as start_date,
			UNIX_TIMESTAMP(end_date) as end_date
			FROM site_notes
			WHERE unique_id = '".$cargo."'";
$rs_notes = mysql_query($query, $linkID);
$note = mysql_fetch_assoc($rs_notes);
?>
<form action="dbaccess.php" method="post" name="edit_note" id="edit_note" onSubmit="return validate(this);">
<tr>
	<td class="smallBlack" style="border-bottom: 1px solid #000000;"><br><strong>Edit News/Note Item</strong></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="0" class="bodyBlack">
		<tr>
			<td width="100" align="right">Title:</td>
			<td rowspan="99"><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
			<td width="480"><input type="text" name="title" id="title" value="<? echo str_replace("\"", "&quot;", $note["title"]); ?>" size="50" maxlength="100" style="width:450px;"></td>
		</tr>
		<tr>
			<td align="right">Date:</td>
			<td><input type="text" name="note_date" id="note_date" value="<? echo iif($note["note_date"] == '', '', date("m/d/Y", $note["note_date"])); ?>" size="50" maxlength="10" style="width:200px;"><span class="smallBlack">&nbsp;*Leave Blank for None - Will Display at Bottom</span></td>
		</tr>
		<tr>
			<td align="right" valign="top">Message:<br><em class="smallBlack">(HTML Allowed)</em></td>
			<td><textarea cols="40" rows="10" name="note" id="note" style="width:450px;" class="bodyBlack"><? echo addslashes($note["note"]); ?></textarea></td>
		</tr>
		<tr>
			<td align="right">Start Date:</td>
			<td><input type="text" name="start_date" id="start_date" value="<? echo date("m/d/Y", $note["start_date"]); ?>" size="50" maxlength="10" style="width:200px;"><span class="smallBlack">&nbsp;*First Date to Display Note</span></td>
		</tr>
		<tr>
			<td align="right">End Date:</td>
			<td><input type="text" name="end_date" id="end_date" value="<? echo iif($note["end_date"] == '', '', date("m/d/Y", $note["end_date"])); ?>" size="50" maxlength="10" style="width:200px;"><span class="smallBlack">&nbsp;*Last Date to Display Note - Leave Blank for None</span></td>
		</tr>
		<tr>
			<td align="right">Audience:</td>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
				<tr id="audience">
					<td><input type="checkbox" name="show_user" value="T" <? echo iif($note["show_user"] == "T", "checked", ""); ?>>Site Users</td>
					<td>&nbsp;&nbsp;</td>
					<td><input type="checkbox" name="show_asst" value="T" <? echo iif($note["show_asst"] == "T", "checked", ""); ?>>Site Assistants</td>
					<td>&nbsp;&nbsp;</td>
					<td><input type="checkbox" name="show_admin" value="T" <? echo iif($note["show_admin"] == "T", "checked", ""); ?>>Site Administrators</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<input type="submit" name="submit" id="submit" value="Update" style="width:100px;">
	<input type="reset" name="reset" id="reset" value="Reset" style="width:100px;">
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<br>
	<script>
	function deleteIt(){
		var answer = confirm("Confirm Delete!");
		if (answer){
			window.location='dbaccess.php?task=del_note&unique_id=<? echo $note["unique_id"]; ?>';
		}
	}
	</script>
	<input type="button" name="delete" id="delete" value="Delete This Note" style="width:190px;" onClick="deleteIt();">
	</td>
</tr>
</table>
<input type="hidden" name="task" value="edit_note">
<input type="hidden" name="unique_id" value="<? echo $note["unique_id"]; ?>">
</form>
<? } ?>

<!-- END INCLUDE news.php -->

