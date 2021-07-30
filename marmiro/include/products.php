<!-- BEGIN Include products.php -->

			<script>
				// Swap the tab class on mouseover and mouseout events
				function flipTab(id){
					if(document.getElementById('infoContainer'+id).style.visibility != 'visible'){
						document.getElementById('tabContainer'+id).className = 'tabContainer';
					}else{
						document.getElementById('tabContainer'+id).className = 'tabHover';
					}
				}

				// Swap the "Details" button label and layer visibility accordingly
				function toggleDetails(id){
					if(document.getElementById('detailsContainer'+id).style.visibility != 'visible'){
						show('detailsContainer'+id);
						document.getElementById('detailsButtonLabel'+id).innerHTML = 'Hide Details';
					}else{
						hide('detailsContainer'+id);
						document.getElementById('detailsButtonLabel'+id).innerHTML = 'Product Details';
					}
				}
			</script>
			<?
			// Get the display label text for the product being displayed
			$query = "SELECT label
						FROM product_types
						WHERE product = '".$prod."';";
//echo $query."<br><br>";
			$rs_label = mysql_query($query, $linkID);
			$label = mysql_fetch_assoc($rs_label)
			?>
			<!-- Tabs -->
			<div id="productTabsContainer">
				<strong class="sectionLabel"><?=$label["label"];?></strong>
			<?
			// Get all the materials this product is available in
			$query = "SELECT material
						FROM materials
						WHERE ".$prod." = 'T'
						ORDER BY tab_position ASC;";
//echo $query."<br><br>";
			$rs_tabs = mysql_query($query, $linkID);
			if (mysql_num_rows($rs_tabs) < 1){
			?>
				<br><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Coming Soon.
				<br><br>
			</div>
			<?
			}else{
			?>
				<div id="tabsContainer">
					<table>
					<tr>
			<?
			// Start a counter for the tab number
			$tabCnt = 0;
			// Define which tab is in focus - default to the first one, value can be overridden below
			$showDiv = 1;
			// Loop through the tabs
			while ($tabLabel = mysql_fetch_assoc($rs_tabs)){
				// Increment counter
				$tabCnt++;
				// If this tab matches the one passed in the URL, make it the one in focus
				if (strtoupper($tab) == strtoupper($tabLabel["material"])){
					// Make it red
					$tabClass = "tabHover";
					// Flag it's accompanying DIV as being in focus
					$showDiv = $tabCnt;
				// it's not the "one"
				}else{
					// Make it normal
					$tabClass = "tabContainer";
				}
			?>
						<td>
							<div id="tabContainer<?=$tabCnt;?>" class="<?=$tabClass;?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(<?=$tabCnt;?>);" onClick="location.href='?sec=<?=$sec;?>&prod=<?=$prod;?>&tab=<?=strtolower($tabLabel["material"]);?>';">
								<?=$tabLabel["material"];?>
							</div>
						</td>
			<?
			}
			?>
					</tr>
					</table>
				</div>
			</div>
			<!-- DIVs for each tab -->
			<div id="productInfoContainer">
				<?
				mysql_data_seek($rs_tabs, 0);
				$divCnt = 0;
				while ($div = mysql_fetch_assoc($rs_tabs)){
					$divCnt++;
				?>
				<div id="infoContainer<?=$divCnt;?>" class="infoContainer"<?=iif($divCnt == $showDiv, ' style="display:block; visibility:visible;"', ' style="display:none; visibility:hidden;"');?>>
					<table width="900" cellspacing="10" align="center">
					<?
					$query = "SELECT *
								FROM products
								WHERE product_type = '".$prod."'
								AND material = '".$div["material"]."'
								AND display = 'T'
								ORDER BY position ASC;";
//echo $query."<br><br>";
					$rs_products = mysql_query($query, $linkID);
					// Start a counter for the product number in this category
					$productCnt = 0;
					while ($product = mysql_fetch_assoc($rs_products)){
						// Increment counter
						$productCnt++;
					?>
					<tr>
						<td height="5" colspan="2"><!-- Spacing --></td>
					</tr>
					<tr>
						<!-- Picture - clicking it will show/hide product details -->
						<td width="140" rowspan="3" valign="top">
							<a href="javascript:void(0);" onClick="toggleDetails('<?=$divCnt;?>-<?=$productCnt;?>');"><img src="ResizeImage.php?image=images/products/<?=$product["image1"];?>&amp;width=140&amp;height=1000&amp;format=jpg" alt="<?=$product["model"];?>" width="140" border="0" class="imageBorder"></a>
						</td>
						<td width="760" valign="top" class="infoLabel"><?=$product["model"];?></td>
					</tr>
					<tr>
						<td class="bodyText"><?=$product["description"];?></td>
					</tr>
					<tr>
						<!-- Show/Hide details button -->
						<td valign="bottom">
							<div id="detailsButton<?=$divCnt;?>-<?=$productCnt;?>"><a href="javascript:void(0);" class="detailsButton" onClick="toggleDetails('<?=$divCnt;?>-<?=$productCnt;?>');"><div id="detailsButtonLabel<?=$divCnt;?>-<?=$productCnt;?>">Product Details</div></a></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<!-- Details - hidden by default -->
							<div id="detailsContainer<?=$divCnt;?>-<?=$productCnt;?>" class="detailsContainer" style="display:none; visibility:hidden;">
								<table width="875" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="325" valign="top">
										<table width="325" border="0" cellspacing="0" cellpadding="0">
										<?
										// Show up to 8 thumbnails
										for ($thumbCounter=1; $thumbCounter <= 8; $thumbCounter++){
										?>
										<tr>
											<td width="140" align="center" valign="top">
											<?
											if ($product["image".$thumbCounter] != ""){
											?>
												<!-- Clicking the thumbnail swaps it into the larger image -->
												<a onClick="document.getElementById('image<?=$divCnt;?>-<?=$productCnt;?>').src='ResizeImage.php?image=images/products/<?=$product["image".$thumbCounter];?>&amp;width=540&amp;height=1000&amp;format=jpg'; document.getElementById('caption<?=$divCnt;?>-<?=$productCnt;?>').innerHTML='<?=htmlentities($product["label".$thumbCounter]);?>';" class="detailsThumbnail"><img src="ResizeImage.php?image=images/products/<?=$product["image".$thumbCounter];?>&amp;width=140&amp;height=1000&amp;format=jpg" alt="<?=$product["model"];?> Thumbnail <?=$thumbCounter;?>" title="Click to View Enlarged" width="140" border="0" class="imageBorder"></a><br><?=$product["label".$thumbCounter];?>
											<?
											}
											?>
											</td>
											<td width="20"></td>
											<td width="140" align="center" valign="top">
											<?
											$thumbCounter++;
											if ($product["image".$thumbCounter] != ""){
											?>
												<a onClick="document.getElementById('image<?=$divCnt;?>-<?=$productCnt;?>').src='ResizeImage.php?image=images/products/<?=$product["image".$thumbCounter];?>&amp;width=540&amp;height=1000&amp;format=jpg'; document.getElementById('caption<?=$divCnt;?>-<?=$productCnt;?>').innerHTML='<?=htmlentities($product["label".$thumbCounter]);?>';" class="detailsThumbnail"><img src="ResizeImage.php?image=images/products/<?=$product["image".$thumbCounter];?>&amp;width=140&amp;height=1000&amp;format=jpg" alt="<?=$product["model"];?> Thumbnail <?=$thumbCounter;?>" title="Click to View Enlarged" width="140" border="0" class="imageBorder"></a><br><?=$product["label".$thumbCounter];?>
											<?
											}
											?>
											</td>
											<td width="25"></td>
										</tr>
										<tr>
											<td height="10" colspan="2"></td>
										</tr>
										<?
										}
										?>
										</table>
									</td>
									<td width="550" align="center" valign="top">
										<!-- Larg image - shows first thumbnail by default -->
										<img name="image<?=$divCnt;?>-<?=$productCnt;?>" id="image<?=$divCnt;?>-<?=$productCnt;?>" src="ResizeImage.php?image=images/products/<?=$product["image1"];?>&amp;width=540&amp;height=1000&amp;format=jpg" alt="<?=$product["model"];?>" width="540" border="0" class="imageBorder"><br><span id="caption<?=$divCnt;?>-<?=$productCnt;?>"><?=$product["label1"];?></span>
									</td>
								</tr>
								</table>
								<br>
								<?
								// Get the gallery images
								$query = "SELECT *
											FROM gallery
											WHERE product_id = '".$product["product_id"]."'
											AND display = 'T'
											ORDER BY position ASC;";
//echo $query."<br><br>";
								$rs_gallery = mysql_query($query, $linkID);
								// Build gallery box if there are any to show
								if (mysql_num_rows($rs_gallery) > 0){
								?>
								<table width="875" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="875" align="center" valign="top" class="galleryContainer">
										<br>
										Image Gallery of <?=$product["model"];?> <?=ucfirst($product["product_type"]);?> Installations
										<table cellspacing="10" align="center">
										<tr>
										<?
										$imageCnt = 0;
										while ($galleryImage = mysql_fetch_assoc($rs_gallery)){
											// Show 5 per row
											if (($imageCnt%5) == 0) echo "</tr><tr>";
											$imageCnt++;
										?>
											<td width="150" valign="top">
												<div class="galleryThumbnail">
												<!-- Clicking thumbnail will spawn lightview to show full-size image -->
												<a href="images/gallery/<?=$galleryImage["image"];?>" class="lightview" rel="set[mygallery<?=$divCnt;?>-<?=$productCnt;?>][image]" title="<?=iif($galleryImage["description"] != "", $galleryImage["description"]." :: :: ", ":: ::");?>"><img src="ResizeImage.php?image=images/gallery/<?=$galleryImage["image"];?>&amp;width=150&amp;height=1000&amp;format=jpg" alt="" title="Click to View Enlarged" width="150" border="0"></a>
												</div>
											</td>
										<?
										}
										?>
										</tr>
										</table>
										<br>
									</td>
								</tr>
								</table>
								<br>
								<?
								}
								// If "show-details" is set to yes, show them
								if ($product["show_details"] != 'F'){
								?>
								<table width="875" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="875" valign="top" class="galleryContainer">
										<br>
										<?
										// Details label
										if ($product["product_type"] == "Patterns"){
										?>
										<div align="center">Pattern Details and Availability:</div>
										<?
										}elseif ($product["bundle"] == "T"){
										?>
										<div align="center">Bundle/Kit Contains the Following:</div>
										<?
										}else{
										?>
										<div align="center">Available in the Following:</div>
										<?
										}
										?>
										<table cellspacing="10" align="center">
										<tr>
											<td height="0" colspan="5"><!-- Spacing --></td>
										</tr>
										<?
										// Coping details are "different" than all the other products
										if ($product["product_type"] == "coping"){
											$query = "SELECT *
														FROM coping
														WHERE product_id = '".$product["product_id"]."'
														AND display = 'T'
														ORDER BY position ASC;";
//echo $query."<br><br>";
											$rs_coping = mysql_query($query, $linkID);
											// Loop through the details
											while ($coping = mysql_fetch_assoc($rs_coping)){
										?>
										<tr>
											<!-- Column Headers -->
											<td width="150" class="detailsColumnHeader">Type</td>
											<td width="150" class="detailsColumnHeader">Size</td>
											<td width="150" class="detailsColumnHeader">Thickness</td>
										</tr>
										<tr>
											<td valign="top" class="detailsColumn"><?=$coping['type'];?></td>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "sizes" list and stuff them into an array
												$aSizes = explode(",",$coping["sizes"]);
												// Loop through the array and display them
												for ($sizesCounter=0; $sizesCounter < sizeof($aSizes); $sizesCounter++){
													echo "<li>".$aSizes[$sizesCounter]."<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
														<?=$coping['thickness'];?>
													</td>
												</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="0" colspan="5"><!-- Spacing --></td>
										</tr>
										<?
											}
										// All other products besides Coping
										}else{
										?>
										<tr>
											<?
											// Column headers - only show those that have a value defined
											if ($product["breakdown"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Pattern Breakdown</td>
											<?
											}
											if ($product["finishes"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Finish</td>
											<?
											}
											if ($product["edges"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Edge</td>
											<?
											}
											if ($product["thicknesses"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Thickness</td>
											<?
											}
											if ($product["types"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Type</td>
											<?
											}
											if ($product["sizes"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Size</td>
											<?
											}
											if ($product["quantities"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Quantity</td>
											<?
											}
											if ($product["percentages"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Percentage</td>
											<?
											}
											if ($product["colors"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Color/Style</td>
											<?
											}
											if ($product["packaging"] != ""){
											?>
											<td width="150" class="detailsColumnHeader">Packaging</td>
											<?
											}
											?>
										</tr>
										<tr>
											<?
											// Details values - again, only show those that have a value
											if ($product["breakdown"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "breakdown" list (if there is one) and stuff them into an array
												$aBreakdown = explode(",",$product["breakdown"]);
												// Loop through the array and display them
												for ($breakdownCounter=0; $breakdownCounter < sizeof($aBreakdown); $breakdownCounter++){
													echo "<li>".$aBreakdown[$breakdownCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											if ($product["finishes"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "finishes" list (if there is one) and stuff them into an array
												$aFinishes = explode(",",$product["finishes"]);
												// Loop through the array and display them
												for ($finishesCounter=0; $finishesCounter < sizeof($aFinishes); $finishesCounter++){
													echo "<li>".$aFinishes[$finishesCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											if ($product["edges"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "edges" list (if there is one) and stuff them into an array
												$aEdges = explode(",",$product["edges"]);
												// Loop through the array and display them
												for ($edgesCounter=0; $edgesCounter < sizeof($aEdges); $edgesCounter++){
													echo "<li>".$aEdges[$edgesCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											if ($product["thicknesses"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "thicknesses" list (if there is one) and stuff them into an array
												$aThicknesses = explode(",",$product["thicknesses"]);
												// Loop through the array and display them
												for ($thicknessesCounter=0; $thicknessesCounter < sizeof($aThicknesses); $thicknessesCounter++){
													echo "<li>".$aThicknesses[$thicknessesCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											if ($product["types"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "types" list (if there is one) and stuff them into an array
												$aTypes = explode(",",$product["types"]);
												// Loop through the array and display them
												for ($typesCounter=0; $typesCounter < sizeof($aTypes); $typesCounter++){
													echo "<li>".$aTypes[$typesCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											if ($product["sizes"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "sizes" list (if there is one) and stuff them into an array
												$aSizes = explode(",",$product["sizes"]);
												// Loop through the array and display them
												for ($sizesCounter=0; $sizesCounter < sizeof($aSizes); $sizesCounter++){
													echo "<li>".$aSizes[$sizesCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											if ($product["quantities"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "quantities" list (if there is one) and stuff them into an array
												$aQuantities = explode(",",$product["quantities"]);
												// Loop through the array and display them
												for ($quantitiesCounter=0; $quantitiesCounter < sizeof($aQuantities); $quantitiesCounter++){
													echo "<li>".$aQuantities[$quantitiesCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											if ($product["percentages"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "percentages" list (if there is one) and stuff them into an array
												$aPercentages = explode(",",$product["percentages"]);
												// Loop through the array and display them
												for ($percentagesCounter=0; $percentagesCounter < sizeof($aPercentages); $percentagesCounter++){
													echo "<li>".$aPercentages[$percentagesCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											if ($product["colors"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "colors" list (if there is one) and stuff them into an array
												$aColors = explode(",",$product["colors"]);
												// Loop through the array and display them
												for ($colorsCounter=0; $colorsCounter < sizeof($aColors); $colorsCounter++){
													echo "<li>".$aColors[$colorsCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											if ($product["packaging"] != ""){
											?>
											<td valign="top" class="detailsColumn">
												<table align="center">
												<tr>
													<td>
											<?
												// Blow apart the "packaging" list (if there is one) and stuff them into an array
												$aPackaging = explode(",",$product["packaging"]);
												// Loop through the array and display them
												for ($packagingCounter=0; $packagingCounter < sizeof($aPackaging); $packagingCounter++){
													echo "<li>".$aPackaging[$packagingCounter]."&nbsp;&nbsp;<br>";
												}
											?>
													</td>
												</tr>
												</table>
											</td>
											<?
											}
											?>
										</tr>
										<tr>
											<td height="0" colspan="5"><!-- Spacing --></td>
										</tr>
										<?
										}
										?>
										</table>
										<?
										// If there is a note, display it
										if ($product["note"] != ''){
										?>
										<table>
										<tr>
											<td width="13"></td>
											<td><?=$product["note"];?></td>
										</tr>
										</table>
										<br>
										<?
										}
										?>
									</td>
								</tr>
								</table>
								<?
								}
								// If "show_details" is set to false but there IS a note, show the note anyway...just the note
								if ($product["show_details"] == 'F' && $product["note"] != ''){
								?>
								<table width="875" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="875" valign="top" class="galleryContainer">
										<br>
										<table>
										<tr>
											<td width="13"></td>
											<td><?=$product["note"];?></td>
										</tr>
										</table>
										<br>
									</td>
								</tr>
								</table>
								<?
								}
								?>
							</div>
						</td>
					</tr>
					<?
						// If there are more products, draw a seperation line
						if ($productCnt < mysql_num_rows($rs_products)){
					?>
					<tr>
						<td height="5" colspan="2" class="productSeperator"></td>
					</tr>
					<?
						}
					}
					// No products were found for this category
					if ($productCnt == 0){
					?>
					<tr>
						<td colspan="2">No products are currently available for the <?=$div["material"];?> <?=$label["label"];?> category.&nbsp;&nbsp;Coming Soon.</td>
					</tr>
					<?
					}
					?>
					</table>
				</div>
				<?
				}
				?>
			</div>
			<?
			}
			?>

<!-- END Include products.php -->
