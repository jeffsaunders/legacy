<!-- BEGIN Include homesettings.php -->

		<?
		if ($cargo == "editSlideshowImage"){
			$query = "SELECT *
						FROM slideshow
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
						alert("Please select whether this image should be shown in the slideshow.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" enctype="multipart/form-data" name="editSlideshowImage" id="editSlideshowImage" onSubmit="return validateEdit(this);">
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
				<input type="file" name="newimage" id="newimage" onChange="document.forms.editSlideshowImage.image.value = this.value.match(/[^\/\\]+$/);">
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
		<input type="hidden" name="task" id="task" value="editSlideshowImage">
		</form>

		<?
		}else{
		?>

		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the slideshow images table for drag-n-drop
				$("#imagesTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
//var debugStr = "Row dropped was "+row.id+". New order: ";
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-2; i++){
//debugStr += rows[i].id+" ";
							document.getElementById("position"+rows[i].id).value = i+1;
							document.getElementById("id"+rows[i].id).value = rows[i].id;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i+1;
						}
						document.forms["slideshowImages"].submit();
//alert(debugStr);
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(sample, id){
			doIt = confirm("CONFIRM - Delete "+sample+"?");
			if (doIt){
				window.location='action.php?task=deleteSlideshowImage&unique_id='+id;
			}
		}
		</script>
		<br>
		<div align="center" class="bigBlack"><strong>Home Page Slideshow Images</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the home page slideshow images are displayed.</li>
			<li>Click the "edit" button to edit the image information.</li>
			<li>Click the "add" button to add a new image - once added, use the drag and drop tool to place its position in the display order.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="slideshowImages" id="slideshowImages">
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
					FROM slideshow
					ORDER BY position ASC;";
//echo $query."<br><br>";
		$rs_slideshow = mysql_query($query, $linkID);
		$imageCnt = 0;
		while ($slide = mysql_fetch_assoc($rs_slideshow)){
			$imageCnt++;
		?>
		<tr id="<?=$slide["unique_id"];?>" bgcolor="<?=($imageCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" align="center"><div id="posDiv<?=$imageCnt;?>" name="posDiv<?=$imageCnt;?>"><?=$imageCnt;?></div></td>
 			<td width="60" align="center"><img src="../images/slideshow/<?=$slide["image"];?>" alt="" width="50" border="0" onMouseOver="show('Image<?=$imageCnt;?>');" onMouseOut="hide('Image<?=$imageCnt;?>');" onMouseLeave="hide('Image<?=$imageCnt;?>');"><div id="Image<?=$imageCnt;?>" style="position:absolute; left:200px; z-index:2; visibility:hidden;"><img src="../images/slideshow/<?=$slide["image"];?>" alt="" width="250" border="1"></div></td>
			<td width="150"><div style="width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; text-align:right; padding:2px;"><?=$slide["image"];?></div></td>
			<td width="190"><div style="width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$slide["description"];?></div></td>
			<td width="50" align="center"><?=iif($slide["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=home&page=slideshow&cargo=editSlideshowImage&id=<?=$slide["unique_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$slide["image"];?>', '<?=$slide["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="id<?=$imageCnt;?>" id="id<?=$imageCnt;?>" value="<?=$slide["unique_id"];?>">
				<input type="hidden" name="position<?=$imageCnt;?>" id="position<?=$imageCnt;?>" value="<?=$slide["position"];?>">
			</td>
			<td width="25" title="Grab, Drag, & Drop to Re-Arrange Display Positions" style="background-image:url('/images/arrowUpDown.png'); background-position:center center; background-repeat:no-repeat; cursor:url('/images/Hand.png'),url(/images/Hand.png),n-resize;" onMouseDown="document.body.style.cursor='url(/images/Grab.png),n-resize'; this.style.cursor='url(/images/Grab.png),n-resize';" onMouseUp="this.style.cursor='url(/images/Hand.png),n-resize';" class="dragHandle"></td>
		</tr>
		<?
		}
		?>
 		<tr bgcolor="#000000" class="nodrag nodrop">
			<td height="1" colspan="7"></td>
		</tr>
		</table>
		<input type="hidden" name="counter" id="counter" value="<?=$imageCnt;?>">
		<input type="hidden" name="task" id="task" value="slideshowImagesPosition">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Image" onClick="window.location='action.php?task=addSlideshowImage'"></div>
		<br>

		<?
		}
		?>

<!-- END Include homesettings.php -->


