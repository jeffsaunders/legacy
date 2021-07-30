<!-- BEGIN Include miscsettings.php -->

		<?
	// FAQ
		if ($page == "selectfaq"){
		?>
		<br>
		<div align="center" class="bigBlack"><strong>Frequently Asked Questions</strong><br><br></div>
		<script>
			// Go to the form for the chosen category
			function getLine(theField){
				if (document.getElementById(theField.id).value == ""){
					document.getElementById(theField.id).style.background="#FF0000";
					alert("Please Select A Line");
					document.getElementById(theField.id).style.background="#FFFFFF";
					document.getElementById(theField.id).focus();
					return false;
				}else{
					window.location = "?sec=misc&page=listfaq&cargo=" + document.getElementById(theField.id).value;
				}
			}
		</script>
		<div align="center">
		<select name="line" id="line" onChange="getLine(this);">
			<option value="">Select A Line To Edit</option>
		<?
			$query = "SELECT DISTINCT line
						FROM faq
						ORDER BY 'line' ASC;";
//echo $query."<br><br>";
			$rs_lines = mysql_query($query, $linkID);
			while ($line = mysql_fetch_assoc($rs_lines)){
		?>
			<option value="<?=strtolower(str_replace(" ", "", $line["line"]));?>"><?=$line["line"];?></option>
		<?
			}
		?>
		</select>
		</div>

		<?
		}elseif ($page == "listfaq"){
//echo $_REQUEST['cargo'];
			switch($_REQUEST['cargo']){
				case "interiorline":
					$label = "Interior Line";
					$line = "Interior Line";
					$selection = "interiorline";
					break;

				case "exteriorline":
					$label = "Exterior Line";
					$line = "Exterior Line";
					$selection = "exteriorline";
					break;
			}
		?>
		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the specs table for drag-n-drop
				$("#faqTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["faqForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(faq, id, ret){
			doIt = confirm("CONFIRM - Delete "+faq+"?");
			if (doIt){
				window.location='action.php?task=deleteFAQ&return='+ret+'&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Frequently Asked Questions (<?=$label;?>)</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the FAQs are displayed.</li>
			<li>Click the "edit" button to edit the FAQ.</li>
			<li>Click the "add" button to add a new FAQ - once added, use the drag & drop tool to place its position in the display order.</li>
			<li>Click the "delete" button to permanently delete the FAQ.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="faqForm" id="faqForm">
		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="faqTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Question</th>
			<th>Answer</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
			$query = "SELECT *
						FROM `faq`
						WHERE line = '".$line."'
						ORDER BY position ASC";
//echo $query."<br><br>";
			$rs_faq = mysql_query($query, $linkID);
			$faqCnt = 0;
			while ($faq = mysql_fetch_assoc($rs_faq)){
				$faqCnt++;
		?>
		<tr id="<?=$faqCnt;?>" bgcolor="<?=($faqCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" height="25" align="center"><div id="posDiv<?=$faqCnt;?>" name="posDiv<?=$faqCnt;?>"><?=$faqCnt;?></div></td>
			<td width="200"><div style="width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$faq["question"];?></div></td>
			<td width="195"><div style="width:195px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$faq["answer"];?></div></td>
			<td width="55" align="center"><?=iif($faq["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=misc&page=editfaq&id=<?=$faq["unique_id"];?>'" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$faq["question"];?>', '<?=$faq["unique_id"]?>', '<?=$selection;?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$faqCnt;?>" id="uid<?=$faqCnt;?>" value="<?=$faq["unique_id"];?>">
				<input type="hidden" name="position<?=$faqCnt;?>" id="position<?=$faqCnt;?>" value="<?=$faq["position"];?>">
			</td>
			<td width="25" title="Grab, Drag, & Drop to Re-Arrange Display Positions" style="background-image:url('../images/arrowUpDown.png'); background-position:center center; background-repeat:no-repeat; cursor:url('/images/Hand.png'),n-resize;" onMouseDown="document.body.style.cursor='url(/images/Grab.png),n-resize'; this.style.cursor='url(/images/Grab.png),n-resize';" onMouseUp="this.style.cursor='url(/images/Hand.png),n-resize';" class="dragHandle"></td>
		</tr>
		<?
			}
		?>
 		<tr bgcolor="#000000" class="nodrag nodrop">
			<td height="1" colspan="6"></td>
		</tr>
		</table>
		<input type="hidden" name="return" id="return" value="listfaq&cargo=<?=$selection;?>">
		<input type="hidden" name="counter" id="counter" value="<?=$faqCnt;?>">
		<input type="hidden" name="task" id="task" value="positionFAQ">
		</form>

		<br>
		<div align="center"><input type="button" value="Add FAQ" onClick="window.location='action.php?task=addFAQ&line=<?=$line;?>&return=<?=$selection;?>'"></div>
		<br>

		<?
		}elseif ($page == "editfaq"){
			$query = "SELECT *
						FROM `faq`
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_faq = mysql_query($query, $linkID);
			$faq = mysql_fetch_assoc($rs_faq);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.question){
					if (theForm.question.value == ""){
						theForm.question.style.background="#FF0000";
						alert("Please Enter The Question");
						theForm.question.style.background="#FFFFFF";
						theForm.question.focus();
						return false;
					}
				}
				if (theForm.answer){
					if (theForm.answer.value == ""){
						theForm.answer.style.background="#FF0000";
						alert("Please Enter The Answer");
						theForm.answer.style.background="#FFFFFF";
						theForm.answer.focus();
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
						alert("Please select whether this FAQ should be shown on the website.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editFAQ" id="editFAQ" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Frequently Asked Question</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Question:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="question" id="question" size="75" maxlength="100" value="<?=$faq["question"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED.  This is the question that is frequently asked." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Answer:</strong></td>
			<td bgcolor="#F0F0F0">
				<!--<input type="text" name="answer" id="answer" size="60" maxlength="100" value="<?=$faq["answer"];?>">-->
				<textarea cols="80" rows="10" name="answer" id="answer" class="bodyBlack" style="width:500px;"><?=$faq["answer"];?></textarea>
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED.  This is the answer to the question." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This FAQ?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($faq["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($faq["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this FAQ or not show it (like deleting it, but leaving it so it can be brought back later)" border="0" style="cursor:help;">
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
		<input type="hidden" name="line" id="line" value="<?=$faq["line"];?>">
		<input type="hidden" name="unique_id" id="unique_id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="return" id="return" value="<?=strtolower(str_replace(" ", "", $faq["line"]));?>">
		<input type="hidden" name="task" id="task" value="editFAQ">
		</form>
		<?
	// CONTACT/LOCATION
		}elseif ($page == "contact"){
		?>
		<!-- Snippetmaster -->
		<br><br><br><br>
		<div align="center">
			<strong class="bigBlack">
			That page's content is managed via Snippetmaster
			</strong>
			<br><br>
			<strong class="bodyBlack"><a href="snippetmaster.php" class="menuBlack">Click here to launch Snippetmaster</a></strong>
		</div>
		<?
	// PRIVACY POLICY
		}else{ // $page = "privacy" or none of the above
		?>
		<!-- Snippetmaster -->
		<br><br><br><br>
		<div align="center">
			<strong class="bigBlack">
			That page's content is managed via Snippetmaster
			</strong>
			<br><br>
			<strong class="bodyBlack"><a href="snippetmaster.php" class="menuBlack">Click here to launch Snippetmaster</a></strong>
		</div>
		<?
		}
		?>

<!-- END Include miscsettings.php -->


