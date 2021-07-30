<!-- BEGIN Include packaging.php -->

			<script>
				// Swap the tab class on mouseover and mouseout events
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
				<strong class="sectionLabel">Packaging Information</strong>
				<div id="tabsContainer">
					<table>
					<tr>
			<?
			// Get all the type of products with packaging info
			$query = "SELECT DISTINCT material
						FROM packaging
						ORDER BY 'order' ASC;";
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
				if (strtoupper(urldecode($tab)) == strtoupper($tabLabel["material"])){
					// Make it red
					$tabClass = "tabHover";
					// Flag it's accompanying DIV as being in focus
					$showDiv = $tabCnt;
					// Store label name for later use
					$packageLabel = $tabLabel["material"];
				// it's not the "one"
				}else{
					// Make it normal
					$tabClass = "tabContainer";
				}
			?>
						<td>
							<div id="tabContainer<?=$tabCnt;?>" class="<?=$tabClass;?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(<?=$tabCnt;?>);" onClick="location.href='?sec=<?=$sec;?>&tab=<?=strtolower($tabLabel["material"]);?>';">
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
				$divCnt = 1;
				?>
				<div id="infoContainer<?=$showDiv;?>" class="infoContainer" style="display:block; visibility:visible;">
					<table width="940" cellspacing="10" align="center">
					<?
					$query = "SELECT *
								FROM packaging
								WHERE upper(material) = '".strtoupper(urldecode($tab))."'
								AND display = 'T'
								ORDER BY `order` ASC, `position` ASC;";
//echo $query."<br><br>";
					$rs_packaging = mysql_query($query, $linkID);
					$package = mysql_fetch_assoc($rs_packaging)
					?>
					<tr>
						<td>
							<table width="915" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="915" align="center" valign="top" class="packagingContainer">
									<br>
									<!-- Chart label -->
									<strong class="sectionLabel"><?=$packageLabel;?> come<?=iif($packageLabel == "Coping" || $packageLabel == "Veneer", "s", "");?> packaged as follows:</strong>
									<table cellspacing="10" align="center">
									<tr>
										<td height="0" colspan="10"><!-- Spacing --></td>
									</tr>
									<tr>
										<?
										// Column headers - only show those that have a value defined
										if ($package["type"] != ""){
										?>
										<td width="150" class="detailsColumnHeader">Type</td>
										<?
										}
										if ($package["size"] != ""){
										?>
										<td width="100" class="detailsColumnHeader">Sizes</td>
										<?
										}
										if ($package["thickness"] != ""){
										?>
										<td width="100" class="detailsColumnHeader">Thickness</td>
										<?
										}
										if ($package["sqf_crate"] != ""){
										?>
										<td width="100" class="detailsColumnHeader">Quantity/Crate</td>
										<?
										}
										if ($package["lf_crate"] != ""){
										?>
										<td width="100" class="detailsColumnHeader">LF/Crate</td>
										<?
										}
										if ($package["qty_crate"] != ""){
										?>
										<td width="200" class="detailsColumnHeader">Quantity/Crate</td>
										<?
										}
										if ($package["qty_bundle"] != ""){
										?>
										<!--<td width="100" class="detailsColumnHeader">Pieces/Bundle</td>-->
										<?
										}
										if ($package["lbs_crate"] != ""){
										?>
										<td width="100" class="detailsColumnHeader">LBS/Crate</td>
										<?
										}
										if ($package["crate_type"] != ""){
										?>
										<td width="100" class="detailsColumnHeader">Crate Type</td>
										<?
										}
										?>
									</tr>
									<?
									mysql_data_seek($rs_packaging, 0);
									$packageCnt = 0;
									// Loop through all the results and display them
									while ($package = mysql_fetch_assoc($rs_packaging)){
										// If there is a "type" defined
										if ($package["type"] != ""){
											if ($packageCnt == 0){
												$packageType = $package["type"];
											}
											if ($packageCnt == 0 || ($package["type"] != $packageType)){
												$packageType = $package["type"];
												if ($packageCnt != 0){
									?>
									<tr>
										<td height="1" colspan="10" class="packageSeperator"></td>
									</tr>
									<tr>
										<td valign="top" class="detailsColumn"><?=$package["type"];?></td>
										<?
												}else{
										?>
									<tr>
										<td valign="top" class="detailsColumn"><?=$package["type"];?></td>
										<?
												}
											}else{
										?>
									<tr>
										<td valign="top" class="detailsColumn"></td>
										<?
											}
										}else{
										?>
									<tr>
										<?
										}
										if ($package["size"] != ""){
										?>
										<td align="center" valign="top" class="detailsColumn"><?=$package["size"];?></td>
										<?
										}
										if ($package["thickness"] != ""){
										?>
										<td align="center" valign="top" class="detailsColumn"><?=$package["thickness"];?></td>
										<?
										}
										if ($package["sqf_crate"] != ""){
										?>
										<td align="center" valign="top" class="detailsColumn"><?=$package["sqf_crate"];?></td>
										<?
										}
										if ($package["lf_crate"] != ""){
										?>
										<td align="center" valign="top" class="detailsColumn"><?=$package["lf_crate"];?></td>
										<?
										}
										if ($package["qty_crate"] != ""){
										?>
										<td align="center" valign="top" class="detailsColumn"><?=$package["qty_crate"];?></td>
										<?
										}
										if ($package["qty_bundle"] != ""){
										?>
										<!--<td align="center" valign="top" class="detailsColumn"><?=$package["qty_bundle"];?></td>-->
										<?
										}
										if ($package["lbs_crate"] != ""){
										?>
										<td align="center" valign="top" class="detailsColumn"><?=$package["lbs_crate"];?></td>
										<?
										}
										if ($package["crate_type"] != ""){
										?>
										<td align="center" valign="top" class="detailsColumn"><?=$package["crate_type"];?></td>
										<?
										$packageCnt++;
										}
										?>
									</tr>
									<?
									}
									?>
									<tr>
										<td height="0" colspan="10"><!-- Spacing --></td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</div>
			</div>

<!-- END Include packaging.php -->
