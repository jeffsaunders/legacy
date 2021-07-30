<!-- BEGIN Include productionsettings.php -->

		<?
		if ($page == "editfactoryimage"){
			$query = "SELECT *
						FROM gallery
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_image = mysql_query($query, $linkID);
			$image = mysql_fetch_assoc($rs_image);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.image){
					if (theForm.image.value == ""){
						theForm.image.style.background="#FF0000";
						alert("Please Enter The Image Filename");
						theForm.image.style.background="#FFFFFF";
						theForm.image.focus();
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
						alert("Please select whether this image should be shown on the 'Factories' page.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" enctype="multipart/form-data" name="editFactoryImage" id="editFactoryImage" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Image Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Image Filename:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="image" id="image" size="30" maxlength="50" value="<?=$image["image"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. Edit file name (i.e. Image1.jpg).  Click the 'Choose File' button to upload a new image file." border="0" style="cursor:help;">
				<input type="file" name="newimage" id="newimage" onChange="document.forms.editFactoryImage.image.value = this.value.match(/[^\/\\]+$/);">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Image Description:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="description" id="description" size="50" maxlength="100" value="<?=$image["description"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="This is the image description (may be left blank)" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Image?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($image["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($image["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this image or not show it (like deleting it, but leaving it so it can be brought back later)" border="0" style="cursor:help;">
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
		<input type="hidden" name="task" id="task" value="editFactoryImage">
		</form>

		<?
		}elseif ($page == "listfactoryimages"){
		?>

		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the slideshow images table for drag-n-drop
				$("#imagesTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["factoryImages"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(image, id){
			doIt = confirm("CONFIRM - Delete "+image+"?");
			if (doIt){
				window.location='action.php?task=deleteFactoryImage&return=listfactoryimages&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Factory Images</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the images are displayed.</li>
			<li>Click the "edit" button to edit the image information.</li>
			<li>Click the "add" button to add a new image - once added, use the drag and drop tool to place its position in the display order.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="factoryImages" id="factoryImages">
 		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="imagesTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Image</th>
			<th>File Name</th>
			<th>Description</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
			$query = "SELECT *
						FROM gallery
						WHERE product_id = '200'
						ORDER BY position ASC;";
//echo $query."<br><br>";
			$rs_images = mysql_query($query, $linkID);
			$imageCnt = 0;
			while ($image = mysql_fetch_assoc($rs_images)){
				$imageCnt++;
		?>
		<tr id="<?=$imageCnt;?>" bgcolor="<?=($imageCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" align="center"><div id="posDiv<?=$imageCnt;?>" name="posDiv<?=$imageCnt;?>"><?=$imageCnt;?></div></td>
 			<td width="60" align="center"><img src="../images/locations/<?=$image["image"];?>" alt="" width="50" border="0" onMouseOver="show('Image<?=$imageCnt;?>');" onMouseOut="hide('Image<?=$imageCnt;?>');" onMouseLeave="hide('Image<?=$imageCnt;?>');" style="width:50px; height:35px; overflow:hidden;"><div id="Image<?=$imageCnt;?>" style="position:absolute; left:200px; z-index:2; visibility:hidden;"><img src="../images/locations/<?=$image["image"];?>" alt="" width="250" border="1"></div></td>
			<td width="150"><div style="width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; text-align:right; padding:2px;"><?=$image["image"];?></div></td>
			<td width="190"><div style="width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$image["description"];?></div></td>
			<td width="50" align="center"><?=iif($image["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=production&page=editfactoryimage&id=<?=$image["unique_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$image["image"];?>', '<?=$image["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$imageCnt;?>" id="uid<?=$imageCnt;?>" value="<?=$image["unique_id"];?>">
				<input type="hidden" name="position<?=$imageCnt;?>" id="position<?=$imageCnt;?>" value="<?=$image["position"];?>">
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
		<input type="hidden" name="return" id="return" value="listfactoryimages">
		<input type="hidden" name="counter" id="counter" value="<?=$imageCnt;?>">
		<input type="hidden" name="task" id="task" value="positionFactoryImages">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Image" onClick="window.location='action.php?task=addFactoryImage'"></div>
		<br>

		<?
// QUARRIES
		}elseif ($page == "editquarry"){
			$query = "SELECT *
						FROM locations
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_quarry = mysql_query($query, $linkID);
			$quarry = mysql_fetch_assoc($rs_quarry);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.facility_name){
					if (theForm.facility_name.value == ""){
						theForm.facility_name.style.background="#FF0000";
						alert("Please Enter The Quarry Name");
						theForm.facility_name.style.background="#FFFFFF";
						theForm.facility_name.focus();
						return false;
					}
				}
				if (theForm.location){
					if (theForm.location.value == ""){
						theForm.location.style.background="#FF0000";
						alert("Please Enter The Quarry Location");
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
						alert("Please select whether this image should be shown on the 'Factories' page.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editQuarry" id="editQuarry" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Quarry Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Facility Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="facility_name" id="facility_name" size="50" maxlength="50" value="<?=$quarry["facility_name"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The name of the quarry facility." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Facility Location:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="location" id="location" size="50" maxlength="255" value="<?=$quarry["location"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the quarry's location." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Facility Description:</strong></td>
			<td bgcolor="#F0F0F0">
				<textarea cols="80" rows="3" name="description" id="description" class="bodyBlack" style="width:500px;"><?=$quarry["description"];?></textarea>
				<img src="../images/QuestionMark.gif" alt="?" title="This is the quarry's description (may be left blank)" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Quarry?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($quarry["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($quarry["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this quarry or not show it (like deleting it, but leaving it so it can be brought back later)" border="0" style="cursor:help;">
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
		<input type="hidden" name="task" id="task" value="editQuarry">
		</form>


		<?
		}elseif ($page == "editquarryimage"){
			$query = "SELECT *
						FROM gallery
						WHERE unique_id = ".$_REQUEST['uid'];
//echo $query."<br><br>";
			$rs_image = mysql_query($query, $linkID);
			$image = mysql_fetch_assoc($rs_image);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.image){
					if (theForm.image.value == ""){
						theForm.image.style.background="#FF0000";
						alert("Please Enter The Image Filename");
						theForm.image.style.background="#FFFFFF";
						theForm.image.focus();
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
						alert("Please select whether this image should be shown on the 'Factories' page.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" enctype="multipart/form-data" name="editQuarryImage" id="editQuarryImage" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Image Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Image Filename:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="image" id="image" size="30" maxlength="50" value="<?=$image["image"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. Edit file name (i.e. Image1.jpg).  Click the 'Choose File' button to upload a new image file." border="0" style="cursor:help;">
				<input type="file" name="newimage" id="newimage" onChange="document.forms.editQuarryImage.image.value = this.value.match(/[^\/\\]+$/);">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Image Description:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="description" id="description" size="50" maxlength="100" value="<?=$image["description"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="This is the image description (may be left blank)" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Image?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($image["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($image["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this image or not show it (like deleting it, but leaving it so it can be brought back later)" border="0" style="cursor:help;">
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
		<input type="hidden" name="unique_id" id="unique_id" value="<?=$_REQUEST['uid'];?>">
		<input type="hidden" name="id" id="id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="task" id="task" value="editQuarryImage">
		</form>

		<?
		}elseif ($page == "listquarryimages"){
		?>

		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the slideshow images table for drag-n-drop
				$("#imagesTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["quarryImages"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(image, uid, id){
			doIt = confirm("CONFIRM - Delete "+image+"?");
			if (doIt){
				window.location='action.php?task=deleteQuarryImage&return=listquarryimages&id='+id+'&unique_id='+uid;
			}
		}
		</script>

		<?
			$query = "SELECT facility_name
						FROM locations
						WHERE facility_id = ".$_REQUEST['id']."
						ORDER BY position ASC;";
//echo $query."<br><br>";
			$rs_quarry = mysql_query($query, $linkID);
			$quarry = mysql_fetch_assoc($rs_quarry)
		?>
		<br>
		<div align="center" class="bigBlack"><strong><?=$quarry["facility_name"];?> Images</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the images are displayed.</li>
			<li>Click the "edit" button to edit the image information.</li>
			<li>Click the "add" button to add a new image - once added, use the drag and drop tool to place its position in the display order.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="quarryImages" id="quarryImages">
 		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="imagesTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Image</th>
			<th>File Name</th>
			<th>Description</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
			$query = "SELECT *
						FROM gallery
						WHERE product_id = ".$_REQUEST['id']."
						ORDER BY position ASC;";
//echo $query."<br><br>";
			$rs_images = mysql_query($query, $linkID);
			$imageCnt = 0;
			while ($image = mysql_fetch_assoc($rs_images)){
				$imageCnt++;
		?>
		<tr id="<?=$imageCnt;?>" bgcolor="<?=($imageCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" align="center"><div id="posDiv<?=$imageCnt;?>" name="posDiv<?=$imageCnt;?>"><?=$imageCnt;?></div></td>
 			<td width="60" align="center"><img src="../images/locations/<?=$image["image"];?>" alt="" width="50" border="0" onMouseOver="show('Image<?=$imageCnt;?>');" onMouseOut="hide('Image<?=$imageCnt;?>');" onMouseLeave="hide('Image<?=$imageCnt;?>');" style="width:50px; height:35px; overflow:hidden;"><div id="Image<?=$imageCnt;?>" style="position:absolute; left:200px; z-index:2; visibility:hidden;"><img src="../images/locations/<?=$image["image"];?>" alt="" width="250" border="1"></div></td>
			<td width="150"><div style="width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; text-align:right; padding:2px;"><?=$image["image"];?></div></td>
			<td width="190"><div style="width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$image["description"];?></div></td>
			<td width="50" align="center"><?=iif($image["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=production&page=editquarryimage&uid=<?=$image["unique_id"];?>&id=<?=$_REQUEST['id'];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$image["image"];?>', '<?=$image["unique_id"];?>', '<?=$_REQUEST['id'];?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$imageCnt;?>" id="uid<?=$imageCnt;?>" value="<?=$image["unique_id"];?>">
				<input type="hidden" name="position<?=$imageCnt;?>" id="position<?=$imageCnt;?>" value="<?=$image["position"];?>">
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
		<input type="hidden" name="return" id="return" value="listquarryimages&id=<?=$_REQUEST['id'];?>">
		<input type="hidden" name="counter" id="counter" value="<?=$imageCnt;?>">
		<input type="hidden" name="task" id="task" value="positionQuarryImages">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Image" onClick="window.location='action.php?task=addQuarryImage&id=<?=$_REQUEST['id'];?>'"></div>
		<br>

		<?
		}else{ //$page == "listquarries"
		?>

		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the slideshow images table for drag-n-drop
				$("#quarriesTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["quarriesForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(quarry, id){
			doIt = confirm("CONFIRM - Delete "+quarry+"?");
			if (doIt){
				window.location='action.php?task=deleteQuarry&return=listquarries&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Quarries</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the quarries are displayed.</li>
			<li>Click the "edit" button to edit the quarry information.</li>
			<li>Click the "add" button to add a new quarry - once added, use the drag and drop tool to place its position in the display order.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="quarriesForm" id="quarriesForm">
 		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="quarriesTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Quarry</th>
			<th>Location</th>
			<th>Description</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
			$query = "SELECT *
						FROM locations
						WHERE facility_type = 'Quarries'
						ORDER BY tab_position ASC;";
//echo $query."<br><br>";
			$rs_quarries = mysql_query($query, $linkID);
			$quarryCnt = 0;
			while ($quarry = mysql_fetch_assoc($rs_quarries)){
				$quarryCnt++;
		?>
		<tr id="<?=$quarryCnt;?>" bgcolor="<?=($quarryCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" align="center"><div id="posDiv<?=$quarryCnt;?>" name="posDiv<?=$quarryCnt;?>"><?=$quarryCnt;?></div></td>
 			<td width="150"><div style="width:150px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$quarry["facility_name"];?></div></td>
			<td width="150"><div style="width:150px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$quarry["location"];?></div></td>
			<td width="100"><div style="width:100px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$quarry["description"];?></div></td>
			<td width="50" align="center"><?=iif($quarry["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=production&page=editquarry&id=<?=$quarry["unique_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$quarry["facility_name"];?>', '<?=$quarry["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="button" value="Images" onClick="window.location='?sec=production&page=listquarryimages&id=<?=$quarry["facility_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$quarryCnt;?>" id="uid<?=$quarryCnt;?>" value="<?=$quarry["unique_id"];?>">
				<input type="hidden" name="position<?=$quarryCnt;?>" id="position<?=$quarryCnt;?>" value="<?=$quarry["tab_position"];?>">
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
		<input type="hidden" name="return" id="return" value="listquarries">
		<input type="hidden" name="counter" id="counter" value="<?=$quarryCnt;?>">
		<input type="hidden" name="task" id="task" value="positionQuarries">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Quarry" onClick="window.location='action.php?task=addQuarry'"></div>
		<br>

		<?
		}
		?>

<!-- END Include productionsettings.php -->


