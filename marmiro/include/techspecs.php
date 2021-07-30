<!-- BEGIN Include techspecs.php -->

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
				<strong class="sectionLabel">Technical Specifications</strong>
				<div id="tabsContainer">
					<table>
					<tr>
			<?
			// Get all the tech categories
			$query = "SELECT DISTINCT category
						FROM tech_specs
						ORDER BY 'position' ASC;";
//echo $query."<br><br>";
			$rs_tabs = mysql_query($query, $linkID);
			// Start a counter for the tab number
			$tabCnt = 0;
			// Define which tab is in focus - default to the first one, value can be overridden below
			$showDiv = 1;
			// Loop through the tabs
			while ($tabLabel = mysql_fetch_assoc($rs_tabs)){
				// Increment counter
				$tabCnt++;
				// If this tab matches the one passed in the URL, make it the one in focus
				if (strtoupper(urldecode($tab)) == strtoupper($tabLabel["category"])){
					// Make it red
					$tabClass = "tabHover";
					// Flag it's accompanying DIV as being in focus
					$showDiv = $tabCnt;
					// Store label name for later use
					$packageLabel = $tabLabel["category"];
				// it's not the "one"
				}else{
					// Make it normal
					$tabClass = "tabContainer";
				}
			?>
						<td>
							<div id="tabContainer<?=$tabCnt;?>" class="<?=$tabClass;?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(<?=$tabCnt;?>);" onClick="location.href='?sec=<?=$sec;?>&tab=<?=strtolower($tabLabel["category"]);?>';">
								<?=$tabLabel["category"];?>
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
								FROM tech_specs
								WHERE upper(category) = '".strtoupper(urldecode($tab))."'
								AND display = 'T'
								ORDER BY 'position' ASC;";
//echo $query."<br><br>";
					$rs_specs = mysql_query($query, $linkID);
					$specs = mysql_fetch_assoc($rs_specs)
					?>
					<tr>
						<td>
							<table width="915" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="915" align="center" valign="top" class="techSpecsContainer">
									<br>
									<!-- Chart label -->
									<strong class="sectionLabel"><?=$specs["label"];?></strong>
									<table cellspacing="10" align="center">
									<tr>
										<td height="0" colspan="10"><!-- Spacing --></td>
									</tr>
									<tr>
										<!-- Column headers - only show those that have a value defined -->
										<td width="150" class="detailsColumnHeader">Sample</td>
										<?
										if ($specs["dry_psi"] != 0){
										?>
										<td width="100" class="detailsColumnHeader">Dry (avg. psi)</td>
										<?
										}
										if ($specs["wet_psi"] != 0){
										?>
										<td width="100" class="detailsColumnHeader">Wet (avg. psi)</td>
										<?
										}
										if ($specs["finish"] != ""){
										?>
										<td width="100" class="detailsColumnHeader">Finish</td>
										<?
										}
										if ($specs["size"] != ""){
										?>
										<td width="100" class="detailsColumnHeader">Size</td>
										<?
										}
										if ($specs["cf_dry"] != 0){
										?>
										<td width="100" class="detailsColumnHeader">CF Dry</td>
										<?
										}
										if ($specs["cf_wet"] != 0){
										?>
										<td width="100" class="detailsColumnHeader">CF Wet</td>
										<?
										}
										if ($specs["result"] != ""){
										?>
										<td width="150" class="detailsColumnHeader">Result</td>
										<?
										}
										if ($specs["notes"] != ""){
										?>
										<td width="200" class="detailsColumnHeader">Notes</td>
										<?
										}
										if ($specs["water_absorption_pct"] != 0){
										?>
										<td width="150" class="detailsColumnHeader">Water Absorption %</td>
										<?
										}
										if ($specs["bulk_density"] != 0){
										?>
										<td width="150" class="detailsColumnHeader">Bulk Density</td>
										<?
										}
										?>
									</tr>
									<?
									// Make sure you are at the top
									mysql_data_seek($rs_specs, 0);
									// Loop through specs and display them
									while ($specs = mysql_fetch_assoc($rs_specs)){
									?>
									<tr>
										<td valign="top" class="detailsColumn"><?=$specs["sample"];?></td>
											<?
											if ($specs["dry_psi"] != 0){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["dry_psi"];?></td>
											<?
											}
											if ($specs["wet_psi"] != 0){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["wet_psi"];?></td>
											<?
											}
											if ($specs["finish"] != ""){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["finish"];?></td>
											<?
											}
											if ($specs["size"] != ""){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["size"];?></td>
											<?
											}
											if ($specs["cf_dry"] != 0){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["cf_dry"];?></td>
											<?
											}
											if ($specs["cf_wet"] != 0){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["cf_wet"];?></td>
											<?
											}
											if ($specs["result"] != ""){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["result"];?></td>
											<?
											}
											if ($specs["notes"] != ""){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["notes"];?></td>
											<?
											}
											if ($specs["water_absorption_pct"] != 0){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["water_absorption_pct"];?></td>
											<?
											}
											if ($specs["bulk_density"] != 0){
											?>
										<td align="center" valign="top" class="detailsColumn"><?=$specs["bulk_density"];?></td>
											<?
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

<!-- END Include techspecs.php -->
