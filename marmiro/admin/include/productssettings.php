<!-- BEGIN Include productssettings.php -->

		<?
		// "selectcategory" at bottom under "else" so it becomes the default if there is no $page match
	// COMMENT HERE
		if ($page == "something"){
		?>

		<?
	// PRODUCT MATERIAL
		}elseif ($page == "selectmaterial"){
		?>
		<br>
		<div align="center" class="bigBlack"><strong>Products</strong><br><br></div>
		<script>
			// Go to the form for the chosen category
			function getMaterial(theField){
				if (document.getElementById(theField.id).value == ""){
					document.getElementById(theField.id).style.background="#FF0000";
					alert("Please Select A Material");
					document.getElementById(theField.id).style.background="#FFFFFF";
					document.getElementById(theField.id).focus();
					return false;
				}else{
					window.location = "?sec=products&page=listproducts&cargo=" + document.getElementById('category').value + "|" + document.getElementById(theField.id).value;
				}
			}
		</script>
		<div align="center">
		<input type="text" name="label" id="label" value="<?=ucfirst($cargo);?>" disabled style="width:190px;"><br><br>
		<input type="hidden" name="category" id="category" value="<?=$cargo;?>">
		<select name="material" id="material" onChange="getMaterial(this);" style="width:200px;">
			<option value="">Select A Material To Edit</option>
		<?
			$query = "SELECT `material`,`tab_position`
						FROM `materials`
						WHERE `".$cargo."` = 'T'
						ORDER BY `tab_position` ASC";
//echo $query."<br><br>";
//echo "<script>alert('".$query.");</script>";
			$rs_materials = mysql_query($query, $linkID);
			while ($material = mysql_fetch_assoc($rs_materials)){
		?>
			<option value="<?=$material["material"];?>"<?=iif($material["material"] == $cargo, " selected", "");?>><?=$material["material"];?></option>
		<?
			}
		?>
		</select>
		</div>

		<?
		}elseif ($page == "editproductimage"){
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
						alert("Please select whether this image should be shown in the Product Gallery.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" enctype="multipart/form-data" name="editProductImage" id="editProductImage" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Gallery Image Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Image Filename:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="image" id="image" size="30" maxlength="50" value="<?=$image["image"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. Edit file name (i.e. Image1.jpg).  Click the 'Choose File' button to upload a new image file." border="0" style="cursor:help;">
				<input type="file" name="newimage" id="newimage" onChange="document.forms.editProductImage.image.value = this.value.match(/[^\/\\]+$/);">
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
		<input type="hidden" name="task" id="task" value="editProductImage">
		</form>

		<?
		}elseif ($page == "listproductimages"){
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
						document.forms["productImages"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(image, uid, id){
			doIt = confirm("CONFIRM - Delete "+image+"?");
			if (doIt){
				window.location='action.php?task=deleteProductImage&return=listproductimages&id='+id+'&unique_id='+uid;
			}
		}
		</script>

		<?
			$query = "SELECT model
						FROM `products`
						WHERE product_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_product = mysql_query($query, $linkID);
			$prod = mysql_fetch_assoc($rs_product)
		?>
		<br>
		<div align="center" class="bigBlack"><strong><?=$prod["model"];?> Gallery Images</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the images are displayed.</li>
			<li>Click the "edit" button to edit the image information.</li>
			<li>Click the "add" button to add a new image - once added, use the drag and drop tool to place its position in the display order.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="productImages" id="productImages">
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
 			<td width="60" align="center"><img src="../images/gallery/<?=$image["image"];?>" alt="" width="50" border="0" onMouseOver="show('Image<?=$imageCnt;?>');" onMouseOut="hide('Image<?=$imageCnt;?>');" onMouseLeave="hide('Image<?=$imageCnt;?>');" style="width:50px; height:35px; overflow:hidden;"><div id="Image<?=$imageCnt;?>" style="position:absolute; left:200px; z-index:2; visibility:hidden;"><img src="../images/gallery/<?=$image["image"];?>" alt="" width="250" border="1"></div></td>
			<td width="150"><div style="width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; text-align:right; padding:2px;"><?=$image["image"];?></div></td>
			<td width="190"><div style="width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$image["description"];?></div></td>
			<td width="50" align="center"><?=iif($image["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=products&page=editproductimage&uid=<?=$image["unique_id"];?>&id=<?=$_REQUEST['id'];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
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
		<input type="hidden" name="return" id="return" value="listproductimages&id=<?=$_REQUEST['id'];?>">
		<input type="hidden" name="counter" id="counter" value="<?=$imageCnt;?>">
		<input type="hidden" name="task" id="task" value="positionProductImages">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Image" onClick="window.location='action.php?task=addProductImage&id=<?=$_REQUEST['id'];?>'"></div>
		<br>

		<?
		}elseif ($page == "listproducts"){
//echo $_REQUEST['cargo'];
			$cargo = explode("|", $_REQUEST['cargo']);
			$label = $cargo[1]." ".ucfirst($cargo[0]);
//print_r($cargo);
			$query = "SELECT *
						FROM `products`
						WHERE product_type = '".$cargo[0]."'
						AND material = '".$cargo[1]."'
						ORDER BY `position` ASC";
		?>
		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the prods table for drag-n-drop
				$("#prodsTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["prodsForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(sample, id){
			doIt = confirm("CONFIRM - Delete "+sample+"?");
			if (doIt){
				window.location='action.php?task=deleteProduct&return=listproducts&cargo=<?=$_REQUEST['cargo'];?>&product_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong><?=$label;?> Products</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the products are displayed.</li>
			<li>Click the "edit" button to edit the product.</li>
			<li>Click the "add" button to add a new product - once added, use the drag & drop tool to place its position in the display order.</li>
			<li>Click the "delete" button to permanently delete the product.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="prodsForm" id="prodsForm">
		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="prodsTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Image</th>
			<th>Product Name</th>
			<th>Description</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
		// Query defined above
//echo $query."<br><br>";
		$rs_prods = mysql_query($query, $linkID);
		$prodCnt = 0;
		while ($prod = mysql_fetch_assoc($rs_prods)){
			$prodCnt++;
		?>
		<tr id="<?=$prodCnt;?>" bgcolor="<?=($prodCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" align="center"><div id="posDiv<?=$prodCnt;?>" name="posDiv<?=$prodCnt;?>"><?=$prodCnt;?></div></td>
 			<td width="60" align="center"><img src="../images/products/<?=$prod["image1"];?>" alt="" width="50" border="0" onMouseOver="show('Image<?=$prodCnt;?>');" onMouseOut="hide('Image<?=$prodCnt;?>');" onMouseLeave="hide('Image<?=$prodCnt;?>');" style="width:50px; height:35px; overflow:hidden;"><div id="Image<?=$prodCnt;?>" style="position:absolute; left:200px; z-index:2; visibility:hidden;"><img src="../images/products/<?=$prod["image1"];?>" alt="" width="250" border="1"></div></td>
			<td width="150"><div style="width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$prod["model"];?></div></td>
			<td width="190"><div style="width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$prod["description"];?></div></td>
			<td width="50" align="center"><?=iif($prod["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=products&page=editproduct&id=<?=$prod["product_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$prod["model"];?>', '<?=$prod["product_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="button" value="Images" onClick="window.location='?sec=products&page=listproductimages&id=<?=$prod["product_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$prodCnt;?>" id="uid<?=$prodCnt;?>" value="<?=$prod["product_id"];?>">
				<input type="hidden" name="position<?=$prodCnt;?>" id="position<?=$prodCnt;?>" value="<?=$prod["position"];?>">
			</td>
			<td width="25" title="Grab, Drag, & Drop to Re-Arrange Display Positions" style="background-image:url('../images/arrowUpDown.png'); background-position:center center; background-repeat:no-repeat; cursor:url('/images/Hand.png'),n-resize;" onMouseDown="document.body.style.cursor='url(/images/Grab.png),n-resize'; this.style.cursor='url(/images/Grab.png),n-resize';" onMouseUp="this.style.cursor='url(/images/Hand.png),n-resize';" class="dragHandle"></td>
		</tr>
		<?
		}
		?>
 		<tr bgcolor="#000000" class="nodrag nodrop">
			<td height="1" colspan="20"></td>
		</tr>
		</table>
		<input type="hidden" name="return" id="return" value="listproducts&cargo=<?=$_REQUEST['cargo'];?>">
		<input type="hidden" name="cargo" id="cargo" value="<?=$_REQUEST['cargo'];?>">
		<input type="hidden" name="counter" id="counter" value="<?=$prodCnt;?>">
		<input type="hidden" name="task" id="task" value="positionProducts">
		</form>

		<br>
		<div align="center"><input type="button" value="Add <?=$label;?> Product" onClick="window.location='action.php?task=addProduct&product_type=<?=urlencode($cargo[0]);?>&material=<?=urlencode($cargo[1]);?>&return=<?=urlencode("&page=listproducts&cargo=".$_REQUEST['cargo']);?>'"></div>
		<br>
		
		<?
		}elseif ($page == "editproduct"){
			$query = "SELECT *
						FROM products
						WHERE product_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_product = mysql_query($query, $linkID);
			$product = mysql_fetch_assoc($rs_product);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.model){
					if (theForm.model.value == ""){
						theForm.model.style.background="#FF0000";
						alert("Please Enter The Product Name");
						theForm.model.style.background="#FFFFFF";
						theForm.model.focus();
						return false;
					}
				}
				if (theForm.image1){
					if (theForm.image1.value == ""){
						theForm.image1.style.background="#FF0000";
						alert("The Product Must Include At Least One Image");
						theForm.image1.style.background="#FFFFFF";
						theForm.image1.focus();
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
						alert("Please select whether this product should be shown on the 'Products' page.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editProduct" id="editProduct" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Product Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="model" id="model" size="50" maxlength="50" value="<?=$product["model"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The name of the product." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Product Description:</strong></td>
			<td bgcolor="#F0F0F0">
				<textarea cols="80" rows="3" name="description" id="description" class="bodyBlack" style="width:500px;"><?=$product["description"];?></textarea>
				<img src="../images/QuestionMark.gif" alt="?" title="This is the product's description (may be left blank)" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong><u onMouseOver="show('Image1');" onMouseOut="hide('Image1');" onMouseLeave="hide('Image1');" style="cursor:pointer;">Image1</u> Filename:</strong><div id="Image1" style="position:absolute; left:150px; z-index:2; visibility:hidden;"><img src="../images/products/<?=$product["image1"];?>" alt="" width="250" border="1"></div></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="image1" id="image1" size="30" maxlength="50" value="<?=$product["image1"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. Edit file name (i.e. Image1.jpg).  Click the 'Choose File' button to upload a new image file." border="0" style="cursor:help;">
				<input type="file" name="newimage1" id="newimage1" onChange="document.forms.editProduct.image1.value = this.value.match(/[^\/\\]+$/);">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Image1 Label:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="label1" id="label1" size="50" maxlength="255" value="<?=$product["label1"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="This is the label (caption) for Image #1. May be blank." border="0" style="cursor:help;">
			</td>
		</tr>
		<?
		for ($counter=2; $counter <= 6; $counter++){
		?>
		<tr>
			<?
			if ($product["image".$counter] != ''){
			?>
			<td bgcolor="#E0E0E0"><strong><u onMouseOver="show('Image<?=$counter;?>');" onMouseOut="hide('Image<?=$counter;?>');" onMouseLeave="hide('Image<?=$counter;?>');" style="cursor:pointer;">Image<?=$counter;?></u> Filename:</strong><div id="Image<?=$counter;?>" style="position:absolute; left:150px; z-index:2; visibility:hidden;"><img src="../images/products/<?=$product["image".$counter];?>" alt="" width="250" border="1"></div></td>
			<?
			}else{
			?>
			<td bgcolor="#E0E0E0"><strong>Image<?=$counter;?> Filename:</strong></td>
			<?
			}
			?>
			<td bgcolor="#F0F0F0">
				<input type="text" name="image<?=$counter;?>" id="image<?=$counter;?>" size="30" maxlength="50" value="<?=$product["image".$counter];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="May be left blank. Edit file name (i.e. Image<?=$counter;?>.jpg).  Click the 'Choose File' button to upload a new image file." border="0" style="cursor:help;">
				<input type="file" name="newimage[]" id="newimage<?=$counter;?>" onChange="document.forms.editProduct.image<?=$counter;?>.value = this.value.match(/[^\/\\]+$/);">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Image<?=$counter;?> Label:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="label<?=$counter;?>" id="label<?=$counter;?>" size="50" maxlength="255" value="<?=html_entity_decode($product["label".$counter]);?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="This is the label (caption) for Image #<?=$counter;?>. Leave blank if no Image #<?=$counter;?> is defined." border="0" style="cursor:help;">
			</td>
		</tr>
		<?
		}
		?>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Is This A Bundle?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="bundle" name="bundle" value="T"<?=iif($product["bundle"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="bundle" name="bundle" value="F"<?=iif($product["bundle"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether this product is a bundle." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Show Details For This Product?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="show_details" name="show_details" value="T"<?=iif($product["show_details"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="show_details" name="show_details" value="F"<?=iif($product["show_details"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this product's details on the web page." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Breakdown:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="breakdown" id="breakdown" size="50" maxlength="50" value="<?=form_quotes($product["breakdown"]);?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="Not Required. List each element of the product's breakdown in the order you want them displayed, separated by a comma (no space after comma).  i.e 'Element 1,Element 2,Element 3,...'" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Finishes:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="finishes" id="finishes" size="50" maxlength="50" value="<?=form_quotes($product["finishes"]);?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="Not Required. List each of the product's finishes in the order you want them displayed, separated by a comma (no space after comma).  i.e 'Polished,Honed,Brushed,...'" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Edges:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="edges" id="edges" size="50" maxlength="50" value="<?=form_quotes($product["edges"]);?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="Not Required. List each of the product's edge styles in the order you want them displayed, separated by a comma (no space after comma).  i.e 'Beveled,Straight,Chiseled,...'" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Thicknesses:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="thicknesses" id="thicknesses" size="50" maxlength="50" value="<?=form_quotes($product["thicknesses"]);?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="Not Required. List each of the product's thicknesses in the order you want them displayed, separated by a comma (no space after comma).  i.e '5/8&rdquo;,1&rdquo;,1 3/16&rdquo;,...'" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Types:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="types" id="types" size="50" maxlength="50" value="<?=form_quotes($product["types"]);?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="Not Required. List each of the product's types in the order you want them displayed, separated by a comma (no space after comma).  i.e 'Sandstone,Quartz,Onyx,...'" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Sizes:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="sizes" id="sizes" size="50" maxlength="50" value="<?=form_quotes($product["sizes"]);?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="Not Required. List each of the product's sizes in the order you want them displayed, separated by a comma (no space after comma).  i.e '8&rdquo;x8&rdquo;,6&rdquo;x12&rdquo;,Cut To Size,...'" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Colors:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="colors" id="colors" size="50" value="<?=form_quotes($product["colors"]);?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="Not Required. List each of the product's colors in the order you want them displayed, separated by a comma (no space after comma).  i.e 'Crema Eda &reg; 202,Crema Eda &reg; 203,Deep Blue,...'" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Packaging:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="packaging" id="packaging" size="50" maxlength="50" value="<?=form_quotes($product["packaging"]);?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="Not Required. List each of the product's packaging elements in the order you want them displayed, separated by a comma (no space after comma).  i.e 'Veneer: 2sqft bundle,Corners: 6pcs (2 lf),...'" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Product Notes:</strong></td>
			<td bgcolor="#F0F0F0">
				<textarea cols="80" rows="3" name="note" id="note" class="bodyBlack" style="width:500px;"><?=$product["note"];?></textarea>
				<img src="../images/QuestionMark.gif" alt="?" title="This is where you can enter free-form comments about the product such as 'Also available Cut to Size' that will appear at the bottom of the product details section. (may be left blank)" border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Product?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($product["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($product["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this product or not show it (like deleting it, but leaving it so it can be brought back later)" border="0" style="cursor:help;">
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
		<input type="hidden" name="return" id="return" value="&page=editproduct&id=<?=$_REQUEST['id'];?>">
		<input type="hidden" name="product_id" id="product_id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="task" id="task" value="editProduct">
		</form>

		<?
		}elseif ($page == "listproductcategories"){
//echo $_REQUEST['cargo'];
			$cargo = explode("|", $_REQUEST['cargo']);
			$label = $cargo[1]." ".ucfirst($cargo[0]);
//print_r($cargo);
			$query = "SELECT *
						FROM `product_types`
						GROUP BY `product`, `label`
						ORDER BY `position` ASC";
		?>
		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the prodcats table for drag-n-drop
				$("#prodcatsTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["prodcatsForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(sample, id){
			doIt = confirm("CONFIRM - Delete "+sample+"?\nWARNING - THIS CANNOT BE UNDONE.");
			if (doIt){
				window.location='action.php?task=deleteProductCategory&return=listproductcategories&cargo=<?=$_REQUEST['cargo'];?>&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Product Categories</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the product categoriess are displayed.</li>
			<li>Click the "edit" button to edit the product category.</li>
			<li>Click the "add" button to add a new product category - once added, use the drag & drop tool to place its position in the display order.</li>
			<li>Click the "delete" button to permanently delete the product category - <strong><font color="#FF0000">USE EXTREME CAUTION!</font></strong></li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="prodcatsForm" id="prodcatsForm">
		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="prodcatsTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Category Name</th>
			<th>Category Label</th>
			<th>Description</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
		// Query defined above
//echo $query."<br><br>";
		$rs_prodcats = mysql_query($query, $linkID);
		$prodcatCnt = 0;
		while ($prodcat = mysql_fetch_assoc($rs_prodcats)){
			$prodcatCnt++;
		?>
		<tr id="<?=$prodcatCnt;?>" bgcolor="<?=($prodcatCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" align="center"><div id="posDiv<?=$prodcatCnt;?>" name="posDiv<?=$prodcatCnt;?>"><?=$prodcatCnt;?></div></td>
 			<td width="130"><div style="width:120px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$prodcat["product"];?></div></td>
			<td width="130"><div style="width:120px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$prodcat["label"];?></div></td>
			<td width="200"><div style="width:190px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?=$prodcat["description"];?></div></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=products&page=editproductcategories&id=<?=$prodcat["unique_id"];?>'" class="tinyBlack" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$prodcat["lable"];?>', '<?=$prodcat["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$prodcatCnt;?>" id="uid<?=$prodcatCnt;?>" value="<?=$prodcat["unique_id"];?>">
				<input type="hidden" name="position<?=$prodcatCnt;?>" id="position<?=$prodcatCnt;?>" value="<?=$prodcat["position"];?>">
			</td>
			<td width="25" title="Grab, Drag, & Drop to Re-Arrange Display Positions" style="background-image:url('../images/arrowUpDown.png'); background-position:center center; background-repeat:no-repeat; cursor:url('/images/Hand.png'),n-resize;" onMouseDown="document.body.style.cursor='url(/images/Grab.png),n-resize'; this.style.cursor='url(/images/Grab.png),n-resize';" onMouseUp="this.style.cursor='url(/images/Hand.png),n-resize';" class="dragHandle"></td>
		</tr>
		<?
		}
		?>
 		<tr bgcolor="#000000" class="nodrag nodrop">
			<td height="1" colspan="20"></td>
		</tr>
		</table>
		<input type="hidden" name="return" id="return" value="listproductcategories&cargo=<?=$_REQUEST['cargo'];?>">
		<input type="hidden" name="cargo" id="cargo" value="<?=$_REQUEST['cargo'];?>">
		<input type="hidden" name="counter" id="counter" value="<?=$prodcatCnt;?>">
		<input type="hidden" name="task" id="task" value="positionProductCategories">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Product Category" onClick="window.location='action.php?task=addProductCategory'"></div>
		<br>

		<?
		}elseif ($page == "editproductcategories"){
			$query = "SELECT *
						FROM product_types
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_category = mysql_query($query, $linkID);
			$category = mysql_fetch_assoc($rs_category);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.product){
					if (theForm.product.value == ""){
						theForm.product.style.background="#FF0000";
						alert("Please Enter The Product Category Name");
						theForm.product.style.background="#FFFFFF";
						theForm.product.focus();
						return false;
					}
				}
				if (theForm.label){
					if (theForm.label.value == ""){
						theForm.label.style.background="#FF0000";
						alert("Please Enter The Product Category Label");
						theForm.label.style.background="#FFFFFF";
						theForm.label.focus();
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" enctype="multipart/form-data" name="editProductCategory" id="editProductCategory" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Product Category</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Category Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="product" id="product" size="50" maxlength="100" value="<?=$category["product"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the actual product category name." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Category Label:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="label" id="label" size="50" maxlength="100" value="<?=$category["label"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the how this category will be displayed on the screen." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Category Description:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="description" id="description" size="50" maxlength="100" value="<?=$category["description"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="This is the category description (may be left blank)" border="0" style="cursor:help;">
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
		<input type="hidden" name="task" id="task" value="editProductCategory">
		</form>

		<?
	// PRODUCT CATEGORY
		}else{ // $page = "selectcategory" or none of the above
		?>
		<br>
		<div align="center" class="bigBlack"><strong>Products</strong><br><br></div>
		<script>
			// Go to the form for the chosen category
			function getCategory(theField){
				if (document.getElementById(theField.id).value == ""){
					document.getElementById(theField.id).style.background="#FF0000";
					alert("Please Select A Category");
					document.getElementById(theField.id).style.background="#FFFFFF";
					document.getElementById(theField.id).focus();
					return false;
				}else{
					window.location = "?sec=products&page=selectmaterial&cargo=" + document.getElementById(theField.id).value;
				}
			}
		</script>
		<div align="center">
		<select name="category" id="category" onChange="getCategory(this);" style="width:200px;">
			<option value="">Select A Category To Edit</option>
		<?
			$query = "SELECT `product`, `label`, `position`
						FROM `product_types`
						GROUP BY `product`, `label`
						ORDER BY `position` ASC";
//			$query = "SELECT DISTINCT material
//						FROM packaging
//						ORDER BY 'order' ASC;";
//echo $query."<br><br>";
//echo "<script>alert('".$query.");</script>";
			$rs_categories = mysql_query($query, $linkID);
			while ($category = mysql_fetch_assoc($rs_categories)){
		?>
			<option value="<?=$category["product"];?>"<?=iif($category["product"] == $cargo, " selected", "");?>><?=$category["label"];?></option>
		<?
			}
		?>
		</select>
		</div>
		<br>
		<div align="center"><input type="button" value="Edit Product Categories" onClick="window.location='?sec=products&page=listproductcategories'"></div>
		<br>
		<?
		}
		?>

<!-- END Include productssettings.php -->
