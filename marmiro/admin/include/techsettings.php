<!-- BEGIN Include techsettings.php -->

		<?
		// "aboutstones" at bottom under "else" so it becomes the default if there is no $page match
	// INSTALLATION GUIDELINES
		if ($page == "guidelines"){
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
	// PACKAGING INFORMATION
		}elseif ($page == "selectpackaging"){
		?>
		<br>
		<div align="center" class="bigBlack"><strong>Packaging Specifications</strong><br><br></div>
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
					window.location = "?sec=technical&page=listpkg&cargo=" + document.getElementById(theField.id).value;
				}
			}
		</script>
		<div align="center">
		<select name="category" id="category" onChange="getCategory(this);">
			<option value="">Select A Category To Edit</option>
		<?
			$query = "SELECT `material`, `group`, `order`
						FROM `packaging`
						GROUP BY `material`, `group`
						ORDER BY `material` ASC, `order` ASC";
//			$query = "SELECT DISTINCT material
//						FROM packaging
//						ORDER BY 'order' ASC;";
//echo $query."<br><br>";
//echo "<script>alert('".$query.");</script>";

			$rs_categories = mysql_query($query, $linkID);
			while ($category = mysql_fetch_assoc($rs_categories)){
		?>
			<option value="<?=strtolower(str_replace("&", "", str_replace('.', '', str_replace(" ", "", $category["material"].$category["group"]))));?>"><?=$category["material"];?> (<?=form_quotes($category["group"]);?>)</option>
		<?
			}
		?>
		</select>
		</div>
		<?
		}elseif ($page == "listpkg"){
//echo $_REQUEST['cargo'];
			switch($_REQUEST['cargo']){
				case "copingthincoping":
					$label = "Coping (Thin)";
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Coping'
								AND `group` = 'Thin Coping'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Coping";
					$group = "Thin Coping";
					break;

				case "copingthickcoping":
					$label = "Coping (Thick)";
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Coping'
								AND `group` = 'Thick Coping'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Coping";
					$group = "Thick Coping";
					break;

				case "copingremodelcoping":
					$label = "Coping (Remodel)";
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Coping'
								AND `group` = 'Remodel Coping'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Coping";
					$group = "Remodel Coping";
					break;

				case "thickpavers1in":
					$label = form_quotes("Thick Pavers (1\")");
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Thick Pavers'
								AND `group` = '1in.'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Thick Pavers";
					$group = "1in.";
					break;

				case "thickpavers13/16in":
					$label = form_quotes("Thick Pavers (1 3/16\")");
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Thick Pavers'
								AND `group` = '1 3/16in.'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Thick Pavers";
					$group = "1 3/16in.";
					break;

				case "thickpavers11/2in":
					$label = form_quotes("Thick Pavers (1 1/2\")");
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Thick Pavers'
								AND `group` = '1 1/2in.'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Thick Pavers";
					$group = "1 1/2in.";
					break;

				case "thickpavers21/4in":
					$label = form_quotes("Thick Pavers (2 1/4\")");
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Thick Pavers'
								AND `group` = '2 1/4in.'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Thick Pavers";
					$group = "2 1/4in.";
					break;

				case "thinpavers5/8in":
					$label = form_quotes("Thin Pavers (5/8\")");
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Thin Pavers'
								AND `group` = '5/8in.'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Thin Pavers";
					$group = "5/8in.";
					break;

				case "tilespolishedhoned":
					$label = "Tiles (Polished & Honed)";
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Tiles'
								AND `group` = 'Polished & Honed'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Tiles";
					$group = "Polished & Honed";
					break;

				case "tilesbrushed":
					$label = "Tiles (Brushed)";
					$query = "SELECT *
								FROM `packaging`
								WHERE material = 'Tiles'
								AND `group` = 'Brushed'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Tiles";
					$group = "Brushed";
					break;

				case "veneervarious":
					$label = "Veneer";
					$query = "SELECT *
								FROM `packaging`
								WHERE `material` = 'Veneer'
								AND `group` = 'Various'
								ORDER BY `order` ASC, `position` ASC";
					$material = "Veneer";
					$group = "Various";
					break;
			}
		?>
		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the specs table for drag-n-drop
				$("#specsTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["specsForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(sample, id){
			doIt = confirm("CONFIRM - Delete "+sample+"?");
			if (doIt){
				window.location='action.php?task=deletePkgSpec&return=<?=urlencode("listpkg&cargo=".$_REQUEST['cargo']);?>&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong><?=$label;?> Packaging Specifications</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the specifications are displayed.</li>
			<li>Click the "edit" button to edit the specifications row.</li>
			<li>Click the "add" button to add a new specifications row - once added, use the drag & drop tool to place its position in the display order.</li>
			<li>Click the "delete" button to permanently delete the specifications row.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="specsForm" id="specsForm">
		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="specsTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<?
			if ($material == "Tiles" || $material == "Coping"){
			?>
			<th>Type</th>
			<th>Size</th>
			<th>Th'ness</th>
			<th>SQF/<br>Crate</th>
			<th>Qty/<br>Crate</th>
			<th>LBS/<br>Crate</th>
			<th>Crate<br>Type</th>
			<?
			}elseif ($material == "Thick Pavers" || $material == "Thin Pavers"){
			?>
			<th>Size</th>
			<th>Thickness</th>
			<th>SQF/<br>Crate</th>
			<th>Qty/<br>Crate</th>
			<th>LBS/<br>Crate</th>
			<th>Crate<br>Type</th>
			<?
			}elseif ($material == "Veneer"){
			?>
			<th>Type</th>
			<th>Thickness</th>
			<th>SQF/<br>Crate</th>
			<th>Qty/<br>Crate</th>
			<th>Qty/<br>Bundle</th>
			<th>LBS/<br>Crate</th>
			<?
			}
			?>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
		// Query defined above
//echo $query."<br><br>";
		$rs_specs = mysql_query($query, $linkID);
		$specsCnt = 0;
		while ($specs = mysql_fetch_assoc($rs_specs)){
			$specsCnt++;
		?>
		<tr id="<?=$specsCnt;?>" bgcolor="<?=($specsCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" height="25" align="center"><div id="posDiv<?=$specsCnt;?>" name="posDiv<?=$specsCnt;?>"><?=$specsCnt;?></div></td>
			<?
			if ($material == "Tiles" || $material == "Coping"){
			?>
			<td width="110"><div style="width:110px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$specs["group"];?></div></td>
			<td width="50"><div style="width:50px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["size"];?></div></td>
			<td width="50"><div style="width:50px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["thickness"];?></div></td>
			<td width="40"><div style="width:40px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["sqf_crate"];?></div></td>
			<td width="40"><div style="width:40px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["qty_crate"];?></div></td>
			<td width="40"><div style="width:40px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["lbs_crate"];?></div></td>
			<td width="40"><div style="width:40px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["crate_type"];?></div></td>
			<?
			}elseif ($material == "Thick Pavers" || $material == "Thin Pavers"){
			?>
			<td width="65"><div style="width:65px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["size"];?></div></td>
			<td width="65"><div style="width:65px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["thickness"];?></div></td>
			<td width="60"><div style="width:60px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["sqf_crate"];?></div></td>
			<td width="60"><div style="width:60px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["qty_crate"];?></div></td>
			<td width="60"><div style="width:60px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["lbs_crate"];?></div></td>
			<td width="60"><div style="width:60px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["crate_type"];?></div></td>
			<?
			}elseif ($material == "Veneer"){
			?>
			<td width="95"><div style="width:95px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$specs["type"];?></div></td>
			<td width="55"><div style="width:55px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["thickness"];?></div></td>
			<td width="55"><div style="width:55px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["sqf_crate"];?></div></td>
			<td width="55"><div style="width:55px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$specs["qty_crate"];?></div></td>
			<td width="55"><div style="width:55px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$specs["qty_bundle"];?></div></td>
			<td width="55"><div style="width:55px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["lbs_crate"];?></div></td>
			<?
			}
			?>
			<td width="55" align="center"><?=iif($specs["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=technical&page=editpkg&id=<?=$specs["unique_id"];?>&cargo=<?=$material;?>'" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$specs["material"];?> (<?=$specs["group"];?>)', '<?=$specs["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$specsCnt;?>" id="uid<?=$specsCnt;?>" value="<?=$specs["unique_id"];?>">
				<input type="hidden" name="position<?=$specsCnt;?>" id="position<?=$specsCnt;?>" value="<?=$specs["position"];?>">
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
		<input type="hidden" name="return" id="return" value="<?=urlencode("listpkg&cargo=".$_REQUEST['cargo']);?>">
		<input type="hidden" name="cargo" id="cargo" value="<?=$_REQUEST['cargo'];?>">
		<input type="hidden" name="counter" id="counter" value="<?=$specsCnt;?>">
		<input type="hidden" name="task" id="task" value="positionPkgSpecs">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Packaging Specification" onClick="window.location='action.php?task=addPkgSpec&material=<?=urlencode($material);?>&group=<?=urlencode($group);?>&return=<?=urlencode("listpkg&cargo=".$_REQUEST['cargo']);?>'"></div>
		<br>

		<?
		}elseif ($page == "editpkg"){
			$query = "SELECT *
						FROM `packaging`
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_specs = mysql_query($query, $linkID);
			$specs = mysql_fetch_assoc($rs_specs);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.type){
					if (theForm.type.value == ""){
						theForm.type.style.background="#FF0000";
						alert("Please Select The Product Type");
						theForm.type.style.background="#FFFFFF";
						theForm.type.focus();
						return false;
					}
				}
				if (theForm.size){
					if (theForm.size.value == ""){
						theForm.size.style.background="#FF0000";
						alert("Please Enter The Product Size (LxW)");
						theForm.size.style.background="#FFFFFF";
						theForm.size.focus();
						return false;
					}
				}
				if (theForm.thickness){
					if (theForm.thickness.value == ""){
						theForm.thickness.style.background="#FF0000";
						alert("Please Enter The Product Thickness");
						theForm.thickness.style.background="#FFFFFF";
						theForm.thickness.focus();
						return false;
					}
				}
				if (theForm.sqf_crate){
					if (theForm.sqf_crate.value == ""){
						theForm.sqf_crate.style.background="#FF0000";
						alert("Please Enter The Number Of Square Feet Of Product Per Crate");
						theForm.sqf_crate.style.background="#FFFFFF";
						theForm.sqf_crate.focus();
						return false;
					}
				}
				if (theForm.qty_crate){
					if (theForm.qty_crate.value == ""){
						theForm.qty_crate.style.background="#FF0000";
						alert("Please Enter The Number Of Items Of Product Per Crate");
						theForm.qty_crate.style.background="#FFFFFF";
						theForm.qty_crate.focus();
						return false;
					}
				}
				if (theForm.qty_bundle){
					if (theForm.qty_bundle.value == ""){
						theForm.qty_bundle.style.background="#FF0000";
						alert("Please Enter The Number Of Items Of Product Per Bundle");
						theForm.qty_bundle.style.background="#FFFFFF";
						theForm.qty_bundle.focus();
						return false;
					}
				}
				if (theForm.lbs_crate){
					if (theForm.lbs_crate.value == ""){
						theForm.lbs_crate.style.background="#FF0000";
						alert("Please Enter The Weight Of Product Per Crate");
						theForm.lbs_crate.style.background="#FFFFFF";
						theForm.lbs_crate.focus();
						return false;
					}
				}
				if (theForm.crate_type){
					if (theForm.crate_type.value == ""){
						theForm.crate_type.style.background="#FF0000";
						alert("Please Enter The Type Of Crate Used For The Product Being Packaged");
						theForm.crate_type.style.background="#FFFFFF";
						theForm.crate_type.focus();
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
						alert("Please select whether this sprecifications row should be shown.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editPkg" id="editPkg" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit <?=$_REQUEST['cargo'];?> Packaging Specifications Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Type:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="material" id="material" size="50" maxlength="50" value="<?=form_quotes($specs["material"]);?> (<?=form_quotes($specs["group"]);?>)" disabled>
				<img src="../images/QuestionMark.gif" alt="?" title="This is the specific product type for these specifications." border="0" style="cursor:help;">
			</td>
		</tr>
		<?
		if ($_REQUEST['cargo'] == "Veneer"){
		?>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Type:</strong></td>
			<td bgcolor="#F0F0F0">
				<select name="type" id="type">
					<option value="" disabled>Select</option>
					<option value="Split Face Flat"<?=iif($specs["type"] == "Split Face Flat", " selected", "");?>>Split Face Flat</option>
					<option value="Matching Corner"<?=iif($specs["type"] == "Matching Corner", " selected", "");?>>Matching Corner</option>
					<option value="Ledgestone"<?=iif($specs["type"] == "Ledgestone", " selected", "");?>>Ledgestone</option>
				</select>
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the type of veneer product being packaged." border="0" style="cursor:help;">
			</td>
		</tr>
		<?
		}
		if ($_REQUEST['cargo'] != "Veneer"){
		?>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Product Size:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="size" id="size" size="20" maxlength="50" value="<?=form_quotes($specs["size"]);?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the size (LxW)of the product being packaged." border="0" style="cursor:help;">
			</td>
		</tr>
		<?
		}
		?>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Thickness:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="thickness" id="thickness" size="20" maxlength="50" value="<?=form_quotes($specs["thickness"]);?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the thickness of the product being packaged." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>SQF/Crate:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="sqf_crate" id="sqf_crate" size="20" maxlength="50" value="<?=form_quotes($specs["sqf_crate"]);?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the number of square feet of product per crate being packaged." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Qty/Crate:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="qty_crate" id="qty_crate" size="20" maxlength="50" value="<?=form_quotes($specs["qty_crate"]);?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the quantity of items of product per crate being packaged." border="0" style="cursor:help;">
			</td>
		</tr>
		<?
		if ($_REQUEST['cargo'] == "Veneer"){
		?>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Qty/Bundle:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="qty_bundle" id="qty_bundle" size="20" maxlength="50" value="<?=form_quotes($specs["qty_bundle"]);?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the quantity of items of product per bundle being packaged." border="0" style="cursor:help;">
			</td>
		</tr>
		<?
		}
		?>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Lbs/Crate:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="lbs_crate" id="lbs_crate" size="20" maxlength="50" value="<?=form_quotes($specs["lbs_crate"]);?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the weight of a crate of product being packaged." border="0" style="cursor:help;">
			</td>
		</tr>
		<?
		if ($_REQUEST['cargo'] != "Veneer"){
		?>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Crate Type:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="crate_type" id="crate_type" size="20" maxlength="50" value="<?=form_quotes($specs["crate_type"]);?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the type of crate used for the product being packaged." border="0" style="cursor:help;">
			</td>
		</tr>
		<?
		}
		?>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Spec Row?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($specs["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($specs["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this specifications row or not show it.  This setting allows you to manually remove it from the site without actually deleting it." border="0" style="cursor:help;">
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
		<input type="hidden" name="return" id="return" value="<?=urlencode("listpkg&cargo=".strtolower(str_replace("&", "", str_replace('.', '', str_replace(" ", "", $specs["material"].$specs["group"])))));?>">
		<input type="hidden" name="unique_id" id="unique_id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="task" id="task" value="editPkgSpec">
		</form>

		<?
	// TECHNICAL SPECIFICATIONS
		}elseif ($page == "selecttechspecs"){
		?>
		<br>
		<div align="center" class="bigBlack"><strong>Technical Specifications</strong><br><br></div>
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
					window.location = "?sec=technical&page=list" + document.getElementById(theField.id).value;
				}
			}
		</script>
		<div align="center">
		<select name="category" id="category" onChange="getCategory(this);">
			<option value="">Select A Category To Edit</option>
		<?
//			$query = "SELECT DISTINCT category
//						FROM tech_specs
//						WHERE display = 'T'
//						GROUP BY category
//						ORDER BY category ASC";
			$query = "SELECT DISTINCT category
						FROM tech_specs
						ORDER BY 'position' ASC;";
//echo $query."<br><br>";
			$rs_categories = mysql_query($query, $linkID);
			while ($category = mysql_fetch_assoc($rs_categories)){
		?>
			<option value="<?=strtolower(str_replace(" ", "", $category["category"]));?>"><?=$category["category"];?></option>
		<?
			}
		?>
		</select>
		</div>

		<?
		}elseif ($page == "listcompressivestrength"){
		?>
		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the specs table for drag-n-drop
				$("#specsTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["specsForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(sample, id){
			doIt = confirm("CONFIRM - Delete "+sample+"?");
			if (doIt){
				window.location='action.php?task=deleteTechSpec&return=listcompressivestrength&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Compressive Strength Specifications</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the specifications are displayed.</li>
			<li>Click the "edit" button to edit the specifications row.</li>
			<li>Click the "add" button to add a new specifications row - once added, use the drag & drop tool to place its position in the display order.</li>
			<li>Click the "delete" button to permanently delete the specifications row.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="specsForm" id="specsForm">
		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="specsTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Sample</th>
			<th>Dry (avg. psi)</th>
			<th>Wet (avg. psi)</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
		$query = "SELECT *
					FROM `tech_specs`
					WHERE category = 'Compressive Strength'
					ORDER BY position ASC";
//echo $query."<br><br>";
		$rs_specs = mysql_query($query, $linkID);
		$specsCnt = 0;
		while ($specs = mysql_fetch_assoc($rs_specs)){
			$specsCnt++;
		?>
		<tr id="<?=$specsCnt;?>" bgcolor="<?=($specsCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" height="25" align="center"><div id="posDiv<?=$specsCnt;?>" name="posDiv<?=$specsCnt;?>"><?=$specsCnt;?></div></td>
			<td width="155"><div style="width:155px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$specs["sample"];?></div></td>
			<td width="120"><div style="width:120px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["dry_psi"];?></div></td>
			<td width="120"><div style="width:120px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["wet_psi"];?></div></td>
			<td width="55" align="center"><?=iif($specs["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=technical&page=editcompressivestrength&id=<?=$specs["unique_id"];?>'" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$specs["sample"];?>', '<?=$specs["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$specsCnt;?>" id="uid<?=$specsCnt;?>" value="<?=$specs["unique_id"];?>">
				<input type="hidden" name="position<?=$specsCnt;?>" id="position<?=$specsCnt;?>" value="<?=$specs["position"];?>">
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
		<input type="hidden" name="return" id="return" value="listcompressivestrength">
		<input type="hidden" name="counter" id="counter" value="<?=$specsCnt;?>">
		<input type="hidden" name="task" id="task" value="positionTechSpecs">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Specifications Row" onClick="window.location='action.php?task=addTechSpec&category=Compressive Strength&return=listcompressivestrength'"></div>
		<br>

		<?
		}elseif ($page == "editcompressivestrength"){
			$query = "SELECT *
						FROM tech_specs
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_specs = mysql_query($query, $linkID);
			$specs = mysql_fetch_assoc($rs_specs);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.sample){
					if (theForm.sample.value == ""){
						theForm.sample.style.background="#FF0000";
						alert("Please Enter The Sample Name");
						theForm.sample.style.background="#FFFFFF";
						theForm.sample.focus();
						return false;
					}
				}
				if (theForm.dry_psi){
					if (theForm.dry_psi.value == ""){
						theForm.dry_psi.style.background="#FF0000";
						alert("Please Enter The Dry PSI Results");
						theForm.dry_psi.style.background="#FFFFFF";
						theForm.dry_psi.focus();
						return false;
					}
				}
				if (theForm.wet_psi){
					if (theForm.wet_psi.value == ""){
						theForm.wet_psi.style.background="#FF0000";
						alert("Please Enter The Wet PSI Results");
						theForm.wet_psi.style.background="#FFFFFF";
						theForm.wet_psi.focus();
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
						alert("Please select whether this sprecifications row should be shown.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editCompressiveStrength" id="editCompressiveStrength" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Compressive Strength Specifications Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Sample Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="sample" id="sample" size="50" maxlength="50" value="<?=$specs["sample"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the name of the sample tested." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Dry (avg. psi):</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="dry_psi" id="dry_psi" size="10" maxlength="10" value="<?=$specs["dry_psi"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The results value for the 'Dry' test." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Wet (avg. psi):</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="wet_psi" id="wet_psi" size="10" maxlength="10" value="<?=$specs["wet_psi"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The results value for the 'Wet' test." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Spec Row?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($specs["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($specs["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this specifications row or not show it.  This setting allows you to manually remove it from the site without actually deleting it." border="0" style="cursor:help;">
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
		<input type="hidden" name="category" id="category" value="Compressive Strength">
		<input type="hidden" name="label" id="label" value="Compressive Strength - ASTM-C 170">
		<input type="hidden" name="return" id="return" value="listcompressivestrength">
		<input type="hidden" name="unique_id" id="unique_id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="task" id="task" value="editSpecs">
		</form>

		<?
		}elseif ($page == "listco-efficientoffriction"){
		?>
		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the specs table for drag-n-drop
				$("#specsTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["specsForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(sample, id){
			doIt = confirm("CONFIRM - Delete "+sample+"?");
			if (doIt){
				window.location='action.php?task=deleteTechSpec&return=listco-efficientoffriction&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Co-Efficient of Friction Specifications</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the specifications are displayed.</li>
			<li>Click the "edit" button to edit the specifications row.</li>
			<li>Click the "add" button to add a new specifications row - once added, use the drag & drop tool to place its position in the display order.</li>
			<li>Click the "delete" button to permanently delete the specifications row.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="specsForm" id="specsForm">
		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="specsTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Sample</th>
			<th>Finish</th>
			<th>Size</th>
			<th>CF Dry</th>
			<th>CF Wet</th>
			<th>Result</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
		$query = "SELECT *
					FROM `tech_specs`
					WHERE category = 'Co-Efficient of Friction'
					ORDER BY position ASC";
//echo $query."<br><br>";
		$rs_specs = mysql_query($query, $linkID);
		$specsCnt = 0;
		while ($specs = mysql_fetch_assoc($rs_specs)){
			$specsCnt++;
		?>
		<tr id="<?=$specsCnt;?>" bgcolor="<?=($specsCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" height="25" align="center"><div id="posDiv<?=$specsCnt;?>" name="posDiv<?=$specsCnt;?>"><?=$specsCnt;?></div></td>
			<td width="120"><div style="width:120px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$specs["sample"];?></div></td>
			<td width="60"><div style="width:60px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["finish"];?></div></td>
			<td width="50"><div style="width:50px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["size"];?></div></td>
			<td width="50"><div style="width:50px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["cf_dry"];?></div></td>
			<td width="50"><div style="width:50px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["cf_wet"];?></div></td>
			<td width="50"><div style="width:50px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["result"];?></div></td>
			<td width="55" align="center"><?=iif($specs["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=technical&page=editco-efficientoffriction&id=<?=$specs["unique_id"];?>'" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$specs["sample"];?>', '<?=$specs["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$specsCnt;?>" id="uid<?=$specsCnt;?>" value="<?=$specs["unique_id"];?>">
				<input type="hidden" name="position<?=$specsCnt;?>" id="position<?=$specsCnt;?>" value="<?=$specs["position"];?>">
			</td>
			<td width="25" title="Grab, Drag, & Drop to Re-Arrange Display Positions" style="background-image:url('../images/arrowUpDown.png'); background-position:center center; background-repeat:no-repeat; cursor:url('/images/Hand.png'),n-resize;" onMouseDown="document.body.style.cursor='url(/images/Grab.png),n-resize'; this.style.cursor='url(/images/Grab.png),n-resize';" onMouseUp="this.style.cursor='url(/images/Hand.png),n-resize';" class="dragHandle"></td>
		</tr>
		<?
		}
		?>
 		<tr bgcolor="#000000" class="nodrag nodrop">
			<td height="1" colspan="10"></td>
		</tr>
		</table>
		<input type="hidden" name="return" id="return" value="listco-efficientoffriction">
		<input type="hidden" name="counter" id="counter" value="<?=$specsCnt;?>">
		<input type="hidden" name="task" id="task" value="positionTechSpecs">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Specifications Row" onClick="window.location='action.php?task=addTechSpec&category=Co-Efficient of Friction&return=listco-efficientoffriction'"></div>
		<br>

		<?
		}elseif ($page == "editco-efficientoffriction"){
			$query = "SELECT *
						FROM tech_specs
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_specs = mysql_query($query, $linkID);
			$specs = mysql_fetch_assoc($rs_specs);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.sample){
					if (theForm.sample.value == ""){
						theForm.sample.style.background="#FF0000";
						alert("Please Enter The Sample Name");
						theForm.sample.style.background="#FFFFFF";
						theForm.sample.focus();
						return false;
					}
				}
				if (theForm.finish){
					if (theForm.finish.value == ""){
						theForm.finish.style.background="#FF0000";
						alert("Please Enter The Sample's Finish Type");
						theForm.finish.style.background="#FFFFFF";
						theForm.finish.focus();
						return false;
					}
				}
				if (theForm.size){
					if (theForm.size.value == ""){
						theForm.size.style.background="#FF0000";
						alert("Please Enter The Sample's Size");
						theForm.size.style.background="#FFFFFF";
						theForm.size.focus();
						return false;
					}
				}
				if (theForm.cf_dry){
					if (theForm.cf_dry.value == ""){
						theForm.cf_dry.style.background="#FF0000";
						alert("Please Enter The CF Dry Results");
						theForm.cf_dry.style.background="#FFFFFF";
						theForm.cf_dry.focus();
						return false;
					}
				}
				if (theForm.cf_wet){
					if (theForm.cf_wet.value == ""){
						theForm.cf_wet.style.background="#FF0000";
						alert("Please Enter The CF Wet Results");
						theForm.cf_wet.style.background="#FFFFFF";
						theForm.cf_wet.focus();
						return false;
					}
				}
				if (theForm.result){
					if (theForm.result.value == ""){
						theForm.result.style.background="#FF0000";
						alert("Please Enter The Final Results Value For The Tests");
						theForm.result.style.background="#FFFFFF";
						theForm.result.focus();
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
						alert("Please select whether this sprecifications row should be shown.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editCo-EfficientOfFriction" id="editCo-EfficientOfFriction" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Co-Efficient of Friction Specifications Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Sample Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="sample" id="sample" size="50" maxlength="50" value="<?=$specs["sample"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the name of the sample tested." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Finish:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="finish" id="finish" size="20" maxlength="20" value="<?=$specs["finish"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the type of finish on the sample tested." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Size:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="size" id="size" size="20" maxlength="20" value="<?=form_quotes($specs["size"]);?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the size of the sample tested." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>CF Dry:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="cf_dry" id="cf_dry" size="10" maxlength="10" value="<?=$specs["cf_dry"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The results value for the 'CF Dry' test." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>CF Wet:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="cf_wet" id="cf_wet" size="10" maxlength="10" value="<?=$specs["cf_wet"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The results value for the 'CF Wet' test." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Result:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="result" id="result" size="20" maxlength="20" value="<?=$specs["result"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The final results value for the tests." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Spec Row?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($specs["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($specs["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this specifications row or not show it.  This setting allows you to manually remove it from the site without actually deleting it." border="0" style="cursor:help;">
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
		<input type="hidden" name="category" id="category" value="Co-Efficient of Friction">
		<input type="hidden" name="label" id="label" value="Compressive Strength - ASTM-C 170">
		<input type="hidden" name="return" id="return" value="listco-efficientoffriction">
		<input type="hidden" name="unique_id" id="unique_id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="task" id="task" value="editSpecs">
		</form>

		<?
		}elseif ($page == "listfreezeandthaw"){
		?>
		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the specs table for drag-n-drop
				$("#specsTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["specsForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(sample, id){
			doIt = confirm("CONFIRM - Delete "+sample+"?");
			if (doIt){
				window.location='action.php?task=deleteTechSpec&return=listfreezeandthaw&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Freeze and Thaw Specifications</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the specifications are displayed.</li>
			<li>Click the "edit" button to edit the specifications row.</li>
			<li>Click the "add" button to add a new specifications row - once added, use the drag & drop tool to place its position in the display order.</li>
			<li>Click the "delete" button to permanently delete the specifications row.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="specsForm" id="specsForm">
		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="specsTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Sample</th>
			<th>Result</th>
			<th>Notes</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
		$query = "SELECT *
					FROM `tech_specs`
					WHERE category = 'Freeze and Thaw'
					ORDER BY position ASC";
//echo $query."<br><br>";
		$rs_specs = mysql_query($query, $linkID);
		$specsCnt = 0;
		while ($specs = mysql_fetch_assoc($rs_specs)){
			$specsCnt++;
		?>
		<tr id="<?=$specsCnt;?>" bgcolor="<?=($specsCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" height="25" align="center"><div id="posDiv<?=$specsCnt;?>" name="posDiv<?=$specsCnt;?>"><?=$specsCnt;?></div></td>
			<td width="120"><div style="width:120px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$specs["sample"];?></div></td>
			<td width="60"><div style="width:60px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["result"];?></div></td>
			<td width="210"><div style="width:210px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$specs["notes"];?></div></td>
			<td width="55" align="center"><?=iif($specs["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=technical&page=editfreezeandthaw&id=<?=$specs["unique_id"];?>'" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$specs["sample"];?>', '<?=$specs["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$specsCnt;?>" id="uid<?=$specsCnt;?>" value="<?=$specs["unique_id"];?>">
				<input type="hidden" name="position<?=$specsCnt;?>" id="position<?=$specsCnt;?>" value="<?=$specs["position"];?>">
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
		<input type="hidden" name="return" id="return" value="listfreezeandthaw">
		<input type="hidden" name="counter" id="counter" value="<?=$specsCnt;?>">
		<input type="hidden" name="task" id="task" value="positionTechSpecs">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Specifications Row" onClick="window.location='action.php?task=addTechSpec&category=Freeze and Thaw&return=listfreezeandthaw'"></div>
		<br>

		<?
		}elseif ($page == "editfreezeandthaw"){
			$query = "SELECT *
						FROM tech_specs
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_specs = mysql_query($query, $linkID);
			$specs = mysql_fetch_assoc($rs_specs);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.sample){
					if (theForm.sample.value == ""){
						theForm.sample.style.background="#FF0000";
						alert("Please Enter The Sample Name");
						theForm.sample.style.background="#FFFFFF";
						theForm.sample.focus();
						return false;
					}
				}
				if (theForm.result){
					if (theForm.result.value == ""){
						theForm.result.style.background="#FF0000";
						alert("Please Enter The Final Results Value For The Tests");
						theForm.result.style.background="#FFFFFF";
						theForm.result.focus();
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
						alert("Please select whether this sprecifications row should be shown.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editFreezeAndThaw" id="editFreezeAndThaw" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Freeze and Thaw Specifications Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Sample Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="sample" id="sample" size="50" maxlength="50" value="<?=$specs["sample"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the name of the sample tested." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Result:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="result" id="result" size="20" maxlength="20" value="<?=$specs["result"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The final results value for the tests." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Notes:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="notes" id="notes" size="50" maxlength="255" value="<?=$specs["notes"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="Notes associated with this specific test and it's results." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Spec Row?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($specs["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($specs["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this specifications row or not show it.  This setting allows you to manually remove it from the site without actually deleting it." border="0" style="cursor:help;">
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
		<input type="hidden" name="category" id="category" value="Freeze and Thaw">
		<input type="hidden" name="label" id="label" value="Freeze and Thaw - ASTM-C 6666">
		<input type="hidden" name="return" id="return" value="listfreezeandthaw">
		<input type="hidden" name="unique_id" id="unique_id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="task" id="task" value="editSpecs">
		</form>

		<?
		}elseif ($page == "listwaterabsorptionanddensity"){
		?>
		<script>
			// Drag-n-drop functionality (jQuery)
 			$(document).ready(function(){
			    // Initialize the specs table for drag-n-drop
				$("#specsTable").tableDnD({
					onDrop: function(table, row){
						var rows = table.tBodies[0].rows;
						// start at row[1] to skip header (row[0]), and set counter to 2 fewer rows to not count header and footer
						for (var i=1; i<rows.length-1; i++){
							document.getElementById("position"+rows[i].id).value = i;
							document.getElementById("posDiv"+rows[i].id).innerHTML = i;
						}
						document.forms["specsForm"].submit();
					},
			        dragHandle: "dragHandle"
				});
			});
		</script>

		<script>
		function deleteIt(sample, id){
			doIt = confirm("CONFIRM - Delete "+sample+"?");
			if (doIt){
				window.location='action.php?task=deleteTechSpec&return=listwaterabsorptionanddensity&unique_id='+id;
			}
		}
		</script>

		<br>
		<div align="center" class="bigBlack"><strong>Water Absorption and Density Specifications</strong><br><br></div>
		<ul>
			<li>Drag and drop each row to rearrange the order the specifications are displayed.</li>
			<li>Click the "edit" button to edit the specifications row.</li>
			<li>Click the "add" button to add a new specifications row - once added, use the drag & drop tool to place its position in the display order.</li>
			<li>Click the "delete" button to permanently delete the specifications row.</li>
		</ul>
		<br><br>
		<form action="action.php" method="post" name="specsForm" id="specsForm">
		<table width="600" border="0" cellspacing="1" cellpadding="2" align="center" id="specsTable">
 		<tr bgcolor="#000000" class="bodyWhite nodrag nodrop">
			<th class="tinyRoundedTopLeft">Position</th>
			<th>Sample</th>
			<th>Water Absorption %</th>
			<th>Bulk Density</th>
			<th>Display</th>
			<th colspan="2" class="tinyRoundedTopRight">Action</th>
		</tr>
		<?
		$query = "SELECT *
					FROM `tech_specs`
					WHERE category = 'Water Absorption and Density'
					ORDER BY position ASC";
//echo $query."<br><br>";
		$rs_specs = mysql_query($query, $linkID);
		$specsCnt = 0;
		while ($specs = mysql_fetch_assoc($rs_specs)){
			$specsCnt++;
		?>
		<tr id="<?=$specsCnt;?>" bgcolor="<?=($specsCnt%2)?'#E0E0E0':'#F0F0F0';?>">
			<td width="60" height="25" align="center"><div id="posDiv<?=$specsCnt;?>" name="posDiv<?=$specsCnt;?>"><?=$specsCnt;?></div></td>
			<td width="155"><div style="width:155px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; padding:2px;"><?=$specs["sample"];?></div></td>
			<td width="120"><div style="width:120px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["water_absorption_pct"];?></div></td>
			<td width="120"><div style="width:120px; white-space:nowrap; overflow:hidden; text-align:center; text-overflow:ellipsis;"><?=$specs["bulk_density"];?></div></td>
			<td width="55" align="center"><?=iif($specs["display"] == "T", "Yes", "No");?></td>
			<td width="55" align="center">
				<input type="button" value="Edit" onClick="window.location='?sec=technical&page=editwaterabsorptionanddensity&id=<?=$specs["unique_id"];?>'" class="tinyBlack" style="width:50px;">
				<input type="button" value="Delete" onClick="deleteIt('<?=$specs["sample"];?>', '<?=$specs["unique_id"];?>');" class="tinyBlack" style="width:50px;">
				<input type="hidden" name="uid<?=$specsCnt;?>" id="uid<?=$specsCnt;?>" value="<?=$specs["unique_id"];?>">
				<input type="hidden" name="position<?=$specsCnt;?>" id="position<?=$specsCnt;?>" value="<?=$specs["position"];?>">
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
		<input type="hidden" name="return" id="return" value="listwaterabsorptionanddensity">
		<input type="hidden" name="counter" id="counter" value="<?=$specsCnt;?>">
		<input type="hidden" name="task" id="task" value="positionTechSpecs">
		</form>

		<br>
		<div align="center"><input type="button" value="Add Specifications Row" onClick="window.location='action.php?task=addTechSpec&category=Water Absorption and Density&return=listwaterabsorptionanddensity'"></div>
		<br>

		<?
		}elseif ($page == "editwaterabsorptionanddensity"){
			$query = "SELECT *
						FROM tech_specs
						WHERE unique_id = ".$_REQUEST['id'];
//echo $query."<br><br>";
			$rs_specs = mysql_query($query, $linkID);
			$specs = mysql_fetch_assoc($rs_specs);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.sample){
					if (theForm.sample.value == ""){
						theForm.sample.style.background="#FF0000";
						alert("Please Enter The Sample Name");
						theForm.sample.style.background="#FFFFFF";
						theForm.sample.focus();
						return false;
					}
				}
				if (theForm.water_absorption_pct){
					if (theForm.water_absorption_pct.value == ""){
						theForm.water_absorption_pct.style.background="#FF0000";
						alert("Please Enter The Water Absorption Results");
						theForm.water_absorption_pct.style.background="#FFFFFF";
						theForm.water_absorption_pct.focus();
						return false;
					}
				}
				if (theForm.bulk_density){
					if (theForm.bulk_density.value == ""){
						theForm.bulk_density.style.background="#FF0000";
						alert("Please Enter The Bulk Density Results");
						theForm.bulk_density.style.background="#FFFFFF";
						theForm.bulk_density.focus();
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
						alert("Please select whether this sprecifications row should be shown.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editWaterAbsorptionAndDensity" id="editWaterAbsorptionAndAensity" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Water Absorption and Density Specifications Information</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Sample Name:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="sample" id="sample" size="50" maxlength="50" value="<?=$specs["sample"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the name of the sample tested." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Water Absorption Percentage:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="water_absorption_pct" id="water_absorption_pct" size="10" maxlength="10" value="<?=$specs["water_absorption_pct"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The results value for the 'Water Absorption' test." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Bulk Density:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="bulk_density" id="bulk_density" size="10" maxlength="10" value="<?=$specs["bulk_density"];?>">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. The results value for the 'Bulk Density' test." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Display This Spec Row?</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="display" name="display" value="T"<?=iif($specs["display"] == "T", " checked", "");?>><strong>Yes</strong>&nbsp;&nbsp;
				<input type="radio" id="display" name="display" value="F"<?=iif($specs["display"] == "F", " checked", "");?>><strong>No</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether to show this specifications row or not show it.  This setting allows you to manually remove it from the site without actually deleting it." border="0" style="cursor:help;">
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
		<input type="hidden" name="category" id="category" value="Water Absorption and Density">
		<input type="hidden" name="label" id="label" value="Water Absorption and Density ASTM - C 97">
		<input type="hidden" name="return" id="return" value="listwaterabsorptionanddensity">
		<input type="hidden" name="unique_id" id="unique_id" value="<?=$_REQUEST['id'];?>">
		<input type="hidden" name="task" id="task" value="editSpecs">
		</form>

		<?
	// ABOUT NATURAL STONES
		}else{ // $page = "aboutstones" or none of the above
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

<!-- END Include techsettings.php -->
