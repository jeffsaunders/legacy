<!-- BEGIN Include aboutsettings.php -->

		<?
		// "editcompany" at bottom under "else" so it becomes the default if there is no $page match
	// EVENTS
		if ($page == "listevents"){
		?>
		<script>
		function deleteIt(event, id){
			doIt = confirm("CONFIRM - Delete "+event+"?");
			if (doIt){
				window.location='action.php?task=deleteEvent&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Events</strong><br><br></div>
		<ul>
			<li>Click the "edit" button to edit the event information.</li>
			<li>Click the "add" button to add a new event - once added, use the edit button to fill in the event details.</li>
			<li>Click the "delete" button to permanently delete the event.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="listEvents" id="listEvents">
		<table width="600" cellspacing="1" cellpadding="2" align="center" class="bodyBlack">
 		<tr bgcolor="#000000" class="bodyWhite">
			<th width="200" class="tinyRoundedTopLeft">Event</th>
			<th width="135">Location</th>
			<th width="150">Date(s)</th>
			<th width="50">Display</th>
			<th width="55" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
			$query = "SELECT *
						FROM events
						ORDER BY start_date ASC";
//echo $query."<br><br>";
			$rs_events = mysql_query($query, $linkID);
			$eventCnt = 0;
			while ($event = mysql_fetch_assoc($rs_events)){
				$eventCnt++;
				if ($event["display"] == "T"){
					$display = "Yes";
				}else{
					$display = "No";
				}
				if ($event["end_date"] < date("Y-m-d")){
					$display = "Ended";
				}
		?>
		<tr id="<?=$event["unique_id"];?>" bgcolor="<?=($eventCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td><div style="width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$event["event"];?></div></td>
 			<td><div style="width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$event["location1"];?> <?=$event["location2"];?></div></td>
			<td align="center"><?=date("n/j/y", strtotime($event["start_date"]));?><?=iif($event["end_date"] != 0, " - ".date("n/j/y", strtotime($event["end_date"])), "");?></div></td>
			<td align="center"><?=$display;?></td>
			<td align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=about&page=editevent&id=<?=$event["unique_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$event["event"];?>', '<?=$event["unique_id"];?>');" class="tinyBlack" class="tinyBlack" style="width:50px;">
			</td>
		</tr>
		<?
			}
		?>
 		<tr>
			<td height="5" colspan="5" bgcolor="#000000"></td>
		</tr>
		</table>
		</form>

		<br>
		<div align="center"><input type="button" value="Add Event" onClick="window.location='action.php?task=addEvent'"></div>
		<br>

		<?
		}elseif ($page == "editevent"){
			$query = "SELECT *
						FROM events
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_event = mysql_query($query, $linkID);
			$event = mysql_fetch_assoc($rs_event);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.event){
					if (theForm.event.value == ""){
						theForm.event.style.background="#FF0000";
						alert("Please Enter The Event Name");
						theForm.event.style.background="#FFFFFF";
						theForm.event.focus();
						return false;
					}
				}
				if (theForm.start_date){
					if (theForm.start_date.value == ""){
						theForm.start_date.style.background="#FF0000";
						alert("Please Enter The Event's Start Date");
						theForm.start_date.style.background="#FFFFFF";
						theForm.start_date.focus();
						return false;
					}
				}
				if (theForm.end_date){
					if (theForm.end_date.value == ""){
						theForm.end_date.style.background="#FF0000";
						alert("Please Enter The Event's Ending Date.  If It's A One-Day Event, Enter The Start Date Again");
						theForm.end_date.style.background="#FFFFFF";
						theForm.end_date.focus();
						return false;
					}
				}
				if (theForm.end_date){
					if (theForm.end_date.value < theForm.start_date.value){
						theForm.start_date.style.background="#FF0000";
						theForm.end_date.style.background="#FF0000";
						alert("The Event Cannot End Before It Begins");
						theForm.end_date.style.background="#FFFFFF";
						theForm.start_date.style.background="#FFFFFF";
						theForm.end_date.focus();
						return false;
					}
				}
				if (theForm.location1){
					if (theForm.location1.value == ""){
						theForm.location1.style.background="#FF0000";
						alert("Please Enter The Event's Location");
						theForm.location1.style.background="#FFFFFF";
						theForm.location1.focus();
						return false;
					}
				}
				if (theForm.display){
					var choiceSelected = false;
					for (i = 0;  i <= theForm.display.length;  i++){
						if (theForm.display[i].checked){
							choiceSelected = true;
						}
					}
					if (!choiceSelected){
						alert("Please select whether this event should be shown.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editEvent" id="editEvent" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Event Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Event Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="event" id="event" size="50" maxlength="255" value="<?=$event["event"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the name or title of the event." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Event Start Date:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="start_date" id="start_date" size="10" maxlength="10" value="<?=$event["start_date"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The start date of the event.  If it's a one-day event, enter it's date here." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Event End Date:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="end_date" id="end_date" size="10" maxlength="10" value="<?=$event["end_date"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The ending date of the event.  If it's a one-day event, enter the same date as the starting date." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Event Location:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="location1" id="location1" size="50" maxlength="100" value="<?=$event["location1"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the location of the event." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Add'l Location Info:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="location2" id="location2" size="50" maxlength="100" value="<?=$event["location2"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="This is for any additional location information you wish to display. May be blank." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Event Website Address:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="link" id="link" size="50" maxlength="100" value="<?=$event["link"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="This is the address for the event website.  Leave blank if the event has no website." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Event?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($event["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($event["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this event or not show it.  Once the event ends it will automatically no longer be displayed.  This setting allows you to manually remove it if the need arises." border="0" style="cursor:help;">
			</td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="1" colspan="2"></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<br>
				<input type="submit" name="submit" id="submit" value="Save Changes">
				<br><br>
			</td>
		</tr>
		</table>
		<input type="hidden" name="unique_id" id="unique_id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="task" id="task" value="editEvent">
		</form>

		<?
	// TRENDS
		}elseif ($page == "edittrends"){
		?>
<!-- Snippetmaster -->
		<?
	// REFERENCES
		}elseif ($page == "listreferences"){
		?>

		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the references table for drag-n-drop
				$("#referencesTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
//var debugStr = "Row dropped was "+row.id+". New order: ";
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-2; i++){
//debugStr += row[i].id+" ";
							document.getElementById("position"+rows[i].id).value = i+1;
							document.getElementById("id"+rows[i].id).value = rows[i].id;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i+1;
						}
						document.forms["referencesForm"].submit();
//alert(debugStr);
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(reference, id){
			doIt = confirm("CONFIRM - Delete "+reference+"?");
			if (doIt){
				window.location='action.php?task=deleteReference&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>References</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the references are displayed.</li>
			<li>Click the "edit" button to edit the reference information.</li>
			<li>Click the "add" button to add a new reference - once added, use the drag and drop tool to place its position in the display order.</li>
			<li>Click the "delete" button to permanently delete the reference.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="referencesForm" id="referencesForm">
 		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="referencesTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Reference</th>
			<th>Location</th>
			<th>Link</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
		$query = "SELECT *
					FROM `references`
					ORDER BY position ASC";
//echo $query."<br><br>";
		$rs_references = mysql_query($query, $linkID);
		$refCnt = 0;
		while ($reference = mysql_fetch_assoc($rs_references)){
			$refCnt++;
		?>
		<tr id="<?=$reference["unique_id"];?>" bgcolor="<?=($refCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" height="25" align="center"><div id="posDiv<?=$refCnt;?>" name="posDiv<?=$refCnt;?>"><?=$refCnt;?></div></td>
			<td width="170"><div style="width:170px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$reference["reference"];?></div></td>
			<td width="170"><div style="width:170px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$reference["location"];?></div></td>
			<td width="55" align="center"><?=iif($reference["link"] != "", "Yes", "No");?></td>
			<td width="55" align="center"><?=iif($reference["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=about&page=editreference&id=<?=$reference["unique_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$reference["reference"];?>', '<?=$reference["unique_id"];?>');" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="id<?=$refCnt;?>" id="id<?=$refCnt;?>" value="<?=$reference["unique_id"];?>">
				<input type="hidden" name="position<?=$refCnt;?>" id="position<?=$refCnt;?>" value="<?=$reference["position"];?>">
			</td>
			<td width="25" title="Grab, Drag, & Drop to Re-Arrange Display Positions" style="background-image:url('../images/arrowUpDown.png'); background-position:center center; background-repeat:no-repeat; cursor:url('/images/Hand.png'),n-resize;" onMouseDown="document.body.style.cursor='url(/images/Grab.png),n-resize'; this.style.cursor='url(/images/Grab.png),n-resize';" onMouseUp="this.style.cursor='url(/images/Hand.png),n-resize';" class="dragHandle"></td>
		</tr>
		<?
		}
		?>
 		<tr bgcolor="#000000" class="nodrag nodrop">
			<td height="1" colspan="7"></td>
		</tr>
		</table>
		<input type="hidden" name="counter" id="counter" value="<?=$refCnt;?>">
		<input type="hidden" name="task" id="task" value="referencesPositions">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Reference" onClick="window.location='action.php?task=addReference'"></div>
		<br>

		<?
		}elseif ($page == "editreference"){
			$query = "SELECT *
						FROM `references`
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_reference = mysql_query($query, $linkID);
			$reference = mysql_fetch_assoc($rs_reference);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.reference){
					if (theForm.reference.value == ""){
						theForm.reference.style.background="#FF0000";
						alert("Please Enter The Reference's Name");
						theForm.reference.style.background="#FFFFFF";
						theForm.reference.focus();
						return false;
					}
				}
				if (theForm.location){
					if (theForm.location.value == ""){
						theForm.location.style.background="#FF0000";
						alert("Please Enter The Reference's Location");
						theForm.location.style.background="#FFFFFF";
						theForm.location.focus();
						return false;
					}
				}
				if (theForm.display){
					var choiceSelected = false;
					for (i = 0;  i <= theForm.display.length;  i++){
						if (theForm.display[i].checked){
							choiceSelected = true;
						}
					}
					if (!choiceSelected){
						alert("Please select whether this reference should be shown on the website.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editReference" id="editReference" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Reference Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Reference Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="reference" id="reference" size="60" maxlength="100" value="<?=$reference["reference"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED.  This is the name of the reference, usually a company name." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Reference Location:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="location" id="location" size="60" maxlength="100" value="<?=$reference["location"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED.  This is the reference location." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Reference Website Address:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="link" id="link" size="60" maxlength="100" value="<?=$reference["link"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="This is the address for the reference's website.  Leave blank if the reference has no website." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Reference?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($reference["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($reference["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this reference or not show it (like deleting it, but leaving it so it can be brought back later)" border="0" style="cursor:help;">
			</td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="1" colspan="2"></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<br>
				<input type="submit" name="submit" id="submit" value="Save Changes">
				<br><br>
			</td>
		</tr>
		</table>
		<input type="hidden" name="unique_id" id="unique_id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="task" id="task" value="editReference">
		</form>
		<?
	// COMPANY
		}else{ // $page = "editcompany" or none of the above
		?>
		<!-- Snippetmaster -->
		<br><br><br><br>
		<div align="center">
			<strong class="bigBlack">
			That page's content is managed via Snippetmaster
			</strong>
			<br><br>
			<strong class="bodyBlack"><a href="snippetmaster.php" class="menuBlack">Click here to launch Snippetmaster</a></strong>
<!--			<strong class="bodyBlack"><a href="/admin/snippetmaster" class="menuBlack">Click here to launch Snippetmaster</a></strong>-->
<!--			<strong class="bodyBlack"><a href="javascript:document.forms['snippetmasterLogin'].submit();" class="menuBlack">Click here to launch Snippetmaster</a></strong>-->
		</div>
<!--		<form action="/admin/snippetmaster/index.php" method="post" name="snippetmasterLogin" id="snippetmasterLogin">
			<input type="hidden" name="username" id="username" value="marmiroc">
			<input type="hidden" name="password" id="password" value="Marmirohq#2">
			<input type="hidden" name="language" id="language" value="English">
			<input type="hidden" name="remember" id="remember" value="Y">
		</form>-->
		<?
		}
		?>

<!-- END Include aboutsettings.php -->
