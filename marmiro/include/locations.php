<!-- BEGIN Include locations.php -->

			<script>
				// Swap the tab class on mouseover and mouseout events
				// Since the logic in this function varies on occasion, just load it from each include instead of globally
				function flipTab(id){
					if(document.getElementById('infoContainer'+id) == null){
						document.getElementById('tabContainer'+id).className = 'tabContainer';
					}else{
						document.getElementById('tabContainer'+id).className = 'tabHover';
					}
				}
			</script>

			<!-- Tabs -->
			<div id="productTabsContainer">
				<strong class="sectionLabel"><?=ucwords(strtolower($prod));?></strong>
				<div id="tabsContainer">
					<table>
					<tr>
			<?
			// Grab all of the location info
			$query = "SELECT DISTINCT tab_label
						FROM locations
						WHERE facility_type = '".$prod."'
						ORDER BY tab_position ASC;";
//echo $query."<br><br>";
			$rs_tabs = mysql_query($query, $linkID);
			// Start a counter for the tab number
			$tabCnt = 0;
			// Define which tab is in focus - default to the first one, value can be overridden below
			$showDiv = 1;
			while ($tabLabel = mysql_fetch_assoc($rs_tabs)){
				// Increment counter
				$tabCnt++;
				// If this tab matches the one passed in the URL, make it the one in focus
				if (strtoupper(urldecode($tab)) == strtoupper($tabLabel["tab_label"])){
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
							<div id="tabContainer<?=$tabCnt;?>" class="<?=$tabClass;?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(<?=$tabCnt;?>);" onClick="location.href='?sec=<?=$sec;?>&prod=<?=$prod;?>&tab=<?=strtolower($tabLabel["tab_label"]);?>';">
								<?=$tabLabel["tab_label"];?>
							</div>
						</td>
			<?
			}
//echo "<script>alert('".$showDiv."');</script>";
			?>
					</tr>
					</table>
				</div>
			</div>
			<!-- DIVs for each tab -->
			<div id="productInfoContainer">
				<div id="infoContainer<?=$showDiv;?>" class="infoContainer" style="display:block; visibility:visible;">
				<?
				$query = "SELECT *
							FROM locations
							WHERE facility_type = '".$prod."'
							AND UCASE(tab_label) = '".strtoupper(urldecode($tab))."'
							AND display = 'T'
							ORDER BY 'position' ASC;";
//echo $query."<br><br>";
				$rs_locations = mysql_query($query, $linkID);
				$locationCnt = 0;
				while ($div = mysql_fetch_assoc($rs_locations)){
					$locationCnt++;
				?>
					<table width="900" cellspacing="10" align="center">
					<tr>
						<td>
							<br>
							<!-- Upper section -->
							<strong class="sectionLabel"><?=$div["facility_name"];?></strong>
							<ul>
							<?
							// If there is a location defined, show it
							if ($div["location"] != ""){
								echo "Location: ".$div["location"]."<br>";
							}
							// If there is a size defined, show it
							if ($div["size"] != ""){
								echo "Size: ".$div["size"]."<br>";
							}
							// If there is are products defined, show them
							if ($div["products"] != ""){
								echo "Products Used: ".$div["products"]."<br>";
							}
							// If there is a description defined, show it
							if ($div["description"] != ""){
								echo "".$div["description"]."<br>";
							}
							?>
							</ul>
						</td>
					</tr>
					</table>
					<table width="920" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="920" align="center" valign="top" class="galleryContainer">
							<!-- Image gallery -->
							<br>
							Image Gallery of <?=$div["facility_name"];?>
							<table cellspacing="10" align="center">
							<tr>
							<?
							$query = "SELECT *
										FROM gallery
										WHERE product_id = '".$div["facility_id"]."'
										AND display = 'T'
										ORDER BY position ASC;";
//echo $query."<br><br>";
							$rs_gallery = mysql_query($query, $linkID);
							// Start a counter for the image number
							$imageCnt = 0;
							while ($galleryImage = mysql_fetch_assoc($rs_gallery)){
								// Show 5 per row
								if (($imageCnt%5) == 0) echo "</tr><tr>";
								// Increment counter
								$imageCnt++;
							?>
							<td width="150" valign="top">
								<div class="locationGalleryThumbnail">
									<!-- Clicking thumbnail will spawn lightview to show full-size image -->
									<a href="images/locations/<?=$galleryImage["image"];?>" class="lightview" rel="set[mygallery-<?=$div["facility_name"];?>][image]" title="<?=iif($galleryImage["description"] != "", $galleryImage["description"]." :: :: ", ":: ::");?>"><img src="ResizeImage.php?image=images/locations/<?=$galleryImage["image"];?>&amp;width=150&amp;height=1000&amp;format=jpg" alt="" title="Click to View Enlarged" width="150" border="0"><!--<img src="images/locations/<?=$galleryImage["image"];?>" alt="" title="Click to View Enlarged" width="150" border="0">--></a>
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
					<tr>
						<td><br></td>
					</tr>
					<?
					// If there are more locations, draw a seperation line
					if ($locationCnt < mysql_num_rows($rs_locations)){
					?>
					<tr>
						<td height="5" class="productSeperator"></td>
					</tr>
					<?
					}
					?>
					</table>
				<?
				}
				?>
				</div>
			</div>

<!-- END Include locations.php -->
