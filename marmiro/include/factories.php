<!-- BEGIN Include factories.php -->

			<div id="productTabsContainer">
				<strong class="sectionLabel">Factories</strong>
			</div>
			<div id="productInfoContainer">
				<br>
				<div id="staticInfoContainer" class="staticInfoContainer">
					<table width="940" cellspacing="10" align="center">
					<tr>
						<td valign="top">
							<?
							$query = "SELECT *
										FROM gallery
										WHERE product_id = '200'
										AND display = 'T'
										ORDER BY position ASC;";
//echo $query."<br><br>";
							$rs_gallery = mysql_query($query, $linkID);
							?>
							<table width="920" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="920" align="center" valign="top" class="galleryContainer">
									<br>
									<strong class="sectionLabel">Image Gallery of Our Factories</strong>
									<table cellspacing="10" align="center">
									<tr>
									<?
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
											<a href="images/locations/<?=$galleryImage["image"];?>" class="lightview" rel="set[mygallery-factories][image]" title="<?=iif($galleryImage["description"] != "", $galleryImage["description"]." :: :: ", ":: ::");?>"><img src="ResizeImage.php?image=images/locations/<?=$galleryImage["image"];?>&amp;width=150&amp;height=1000&amp;format=jpg" alt="" title="Click to View Enlarged" width="150" border="0"></a>
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
						</td>
					</tr>
					</table>
				</div>
			</div>

<!-- END Include factories.php -->
