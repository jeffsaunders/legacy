<!-- BEGIN Include reference.php -->

			<div id="productTabsContainer">
				<strong class="sectionLabel">References</strong>
			</div>
			<div id="productInfoContainer">
				<br>
				<div id="staticInfoContainer" class="staticInfoContainer">
					<table width="940" cellspacing="10" align="center">
					<tr>
						<!-- For consistancy this page REALLY needs a picture here but I'm giving in and just giving them pretty much exactly what their old site had. -->
						<!-- I'm still struggling with why we are even "re-doing" a site that they don't want changed, but frankly at this point I no longer care. -->
<!--						<td width="400" valign="top"><img src="images/References.jpg" alt="Marmiro Stones by Turan Bekisoglu" width="400" height="611" border="0"></td>-->
						<!-- Of course, without the picture there is no need for the table within a cell, but I'm just going to leave it.... -->
						<td valign="top" class="staticContainer">
							<table width="100%">
							<?
							// Get references
							$query = "SELECT *
										FROM `references`
										WHERE display <> 'F'
										ORDER BY position ASC";
//echo $query."<br><br>";
							$rs_references = mysql_query($query, $linkID);
							// Display 'em
							while ($reference = mysql_fetch_assoc($rs_references)){
							?>
							<tr>
								<td>
									<li>
									<?
									if ($reference["link"] != ""){
										echo "<a href='http://".$reference["link"]."' target='_blank' class='bodyText'>";
									}
									echo $reference["reference"]." &mdash; ".$reference["location"];
									if ($reference["link"] != ""){
										echo "</a>";
									}
									?>
									</li>
								</td>
							</tr>
							<?
							}
							?>
							</table>
						</td>
					</tr>
					</table>
				</div>
			</div>

<!-- END Include references.php -->
