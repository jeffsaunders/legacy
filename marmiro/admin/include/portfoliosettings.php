<!-- BEGIN Include portfoliosettings.php -->

		<?
		if ($page == "editresidentialimage"){
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
						alert("Please select whether this image should be shown on the 'Residential' page.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" enctype="multipart/form-data" name="editResidentialImage" id="editResidentialImage" onSubmit="return validateEdit(this);">
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
				<input type="file" name="newimage" id="newimage" onChange="document.forms.editResidentialImage.image.value = this.value.match(/[^\/\\]+$/);">
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
		<input type="hidden" name="task" id="task" value="editResidentialImage">
		</form>

		<?
		}elseif ($page == "listresidentialimages"){
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
						document.forms["residentialImages"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(image, id){
			doIt = confirm("CONFIRM - Delete "+image+"?");
			if (doIt){
				window.location='action.php?task=deleteResidentialImage&return=listresidentialimages&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Residential Images</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the images are displayed.</li>
			<li>Click the "edit" button to edit the image information.</li>
			<li>Click the "add" button to add a new image - once added, use the drag and drop tool to place its position in the display order.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="residentialImages" id="residentialImages">
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
					WHERE product_id = '101'
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
				<input type="button" value="Edit" onClick="window.location='?sec=portfolio&page=editresidentialimage&id=<?=$image["unique_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
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
		<input type="hidden" name="return" id="return" value="listresidentialimages">
		<input type="hidden" name="counter" id="counter" value="<?=$imageCnt;?>">
		<input type="hidden" name="task" id="task" value="positionResidentialImages">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Image" onClick="window.location='action.php?task=addResidentialImage'"></div>
		<br>

		<?
// COMMERCIAL
		}elseif ($page == "editcommercial"){
			$query = "SELECT *
						FROM locations
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_commercial = mysql_query($query, $linkID);
			$commercial = mysql_fetch_assoc($rs_commercial);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.facility_name){
					if (theForm.facility_name.value == ""){
						theForm.facility_name.style.background="#FF0000";
						alert("Please Enter The Commercial Property's Name");
						theForm.facility_name.style.background="#FFFFFF";
						theForm.facility_name.focus();
						return false;
					}
				}
				if (theForm.tab_label){
					if (theForm.tab_label.value == ""){
						theForm.tab_label.style.background="#FF0000";
						alert("Please Enter The Commercial Property's Location (Tab Name)");
						theForm.tab_label.style.background="#FFFFFF";
						theForm.tab_label.focus();
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
		<form action="action.php" method="post" name="editCommercial" id="editCommercial" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Commercial Property Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Property Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="facility_name" id="facility_name" size="50" maxlength="255" value="<?=$commercial["facility_name"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The name of the commercial property." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Property Location:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="tab_label" id="tab_label" size="50" maxlength="50" value="<?=$commercial["tab_label"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the property's location. If it is within an existing location tab, enter the tab's name here (i.e. 'Florida')." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Installation Size:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="size" id="size" size="50" maxlength="255" value="<?=$commercial["size"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="This is the size of the installation (i.e. '40,000 SQF')(may be left blank)" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Products Installed:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="products" id="products" size="50" maxlength="255" value="<?=$commercial["products"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="This is/are the product(s) installed at this property (may be left blank)" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Quarry?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($commercial["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($commercial["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this property or not show it (like deleting it, but leaving it so it can be brought back later)" border="0" style="cursor:help;">
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
		<input type="hidden" name="task" id="task" value="editCommercial">
		</form>


		<?
		}elseif ($page == "editcommercialimage"){
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
		<form action="action.php" method="post" enctype="multipart/form-data" name="editCommercialImage" id="editCommercialImage" onSubmit="return validateEdit(this);">
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
				<input type="file" name="newimage" id="newimage" onChange="document.forms.editCommercialImage.image.value = this.value.match(/[^\/\\]+$/);">
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
		<input type="hidden" name="task" id="task" value="editCommercialImage">
		</form>

		<?
		}elseif ($page == "listcommercialimages"){
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
						document.forms["commercialImages"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(image, uid, id){
			doIt = confirm("CONFIRM - Delete "+image+"?");
			if (doIt){
				window.location='action.php?task=deleteCommercialImage&return=listcommercialimages&id='+id+'&unique_id='+uid;
			}
		}
		</script>

		<?
			$query = "SELECT facility_name
						FROM locations
						WHERE facility_id = ".$_REQUEST['id']."
						ORDER BY position ASC;";
//echo $query."<br><br>";
			$rs_commercial = mysql_query($query, $linkID);
			$commercial = mysql_fetch_assoc($rs_commercial)
		?>
		<br>
		<div align="center" class="bigBlack"><strong><?=$commercial["facility_name"];?> Images</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the images are displayed.</li>
			<li>Click the "edit" button to edit the image information.</li>
			<li>Click the "add" button to add a new image - once added, use the drag and drop tool to place its position in the display order.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="commercialImages" id="commercialImages">
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
				<input type="button" value="Edit" onClick="window.location='?sec=portfolio&page=editcommercialimage&uid=<?=$image["unique_id"];?>&id=<?=$_REQUEST['id'];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
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
		<input type="hidden" name="return" id="return" value="listcommercialimages&id=<?=$_REQUEST['id'];?>">
		<input type="hidden" name="counter" id="counter" value="<?=$imageCnt;?>">
		<input type="hidden" name="task" id="task" value="positionCommercialImages">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Image" onClick="window.location='action.php?task=addCommercialImage&id=<?=$_REQUEST['id'];?>'"></div>
		<br>

		<?
		}else{ //$page == "listcommercial"
		?>

		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the slideshow images table for drag-n-drop
				$("#commercialTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["commercialForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(property, id){
			doIt = confirm("CONFIRM - Delete "+property+"?");
			if (doIt){
				window.location='action.php?task=deleteCommercial&return=listcommercial&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Commercial Portfolio</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the properties are displayed.</li>
			<li>Click the "edit" button to edit the property information.</li>
			<li>Click the "add" button to add a new property - once added, use the drag and drop tool to place its position in the display order.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="commercialForm" id="commercialForm">
 		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="commercialTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Property</th>
			<th>Location</th>
			<th>Size</th>
			<th>Products Used</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
			$query = "SELECT *
						FROM locations
						WHERE facility_type = 'Commercial'
						ORDER BY tab_position ASC;";
//echo $query."<br><br>";
			$rs_commercial = mysql_query($query, $linkID);
			$commercialCnt = 0;
			while ($commercial = mysql_fetch_assoc($rs_commercial)){
				$commercialCnt++;
		?>
		<tr id="<?=$commercialCnt;?>" bgcolor="<?=($commercialCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" align="center"><div id="posDiv<?=$commercialCnt;?>" name="posDiv<?=$commercialCnt;?>"><?=$commercialCnt;?></div></td>
 			<td width="140"><div style="width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$commercial["facility_name"];?></div></td>
			<td width="75"><div style="width:75px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$commercial["tab_label"];?></div></td>
			<td width="75"><div style="width:75px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$commercial["size"];?></div></td>
			<td width="100"><div style="width:100px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$commercial["products"];?></div></td>
			<td width="50" align="center"><?=iif($commercial["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=portfolio&page=editcommercial&id=<?=$commercial["unique_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$commercial["facility_name"];?>', '<?=$commercial["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="button" value="Images" onClick="window.location='?sec=portfolio&page=listcommercialimages&id=<?=$commercial["facility_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$commercialCnt;?>" id="uid<?=$commercialCnt;?>" value="<?=$commercial["unique_id"];?>">
				<input type="hidden" name="position<?=$commercialCnt;?>" id="position<?=$commercialCnt;?>" value="<?=$commercial["tab_position"];?>">
			</td>
			<td width="25" title="Grab, Drag, & Drop to Re-Arrange Display Positions" style="background-image:url('../images/arrowUpDown.png'); background-position:center center; background-repeat:no-repeat; cursor:url('/images/Hand.png'),n-resize;" onMouseDown="document.body.style.cursor='url(/images/Grab.png),n-resize'; this.style.cursor='url(/images/Grab.png),n-resize';" onMouseUp="this.style.cursor='url(/images/Hand.png),n-resize';" class="dragHandle"></td>
		</tr>
		<?
			}
		?>
 		<tr bgcolor="#000000" class="nodrag nodrop">
			<td height="1" colspan="8"></td>
		</tr>
		</table>
		<input type="hidden" name="return" id="return" value="listcommercial">
		<input type="hidden" name="counter" id="counter" value="<?=$commercialCnt;?>">
		<input type="hidden" name="task" id="task" value="positionCommercial">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Commercial Property" onClick="window.location='action.php?task=addCommercial'"></div>
		<br>

		<?
		}
		?>

<!-- END Include portfoliosettings.php -->


