<!-- BEGIN INCLUDE Oceanas -->

<!-- BEGIN Image Swapping -->
<script language="javascript">
if (document.images) {
// Property Images
	img0 = new Image(); 
	img0.src = "images/properties/oceanas-floorplan.jpg";
	<?
	for ($counter=1; $counter <= 11; $counter++){
		echo'
			img'.$counter.' = new Image(); 
			img'.$counter.'.src = "images/properties/oceanas-('.$counter.').jpg"; 
		';
	}
	?>
}

// Swap Images
var imgNumber = 1;
function imgSwapFwd() {
	if (document.images) {
		imgNumber++;
		if (imgNumber == 12) {
			imgNumber = 1;
		}
		document.image.src = eval("img"+imgNumber+".src");
	}
}

function imgSwapBwd() {
	if (document.images) {
		imgNumber--;
		if (imgNumber == 0) {
			imgNumber = 11;
		}
		document.image.src = eval("img"+imgNumber+".src");
	}
}
</script>
<!-- END Image Swapping -->

<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td valign="top"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

		<!-- BEGIN Image Gallery -->
    	<table width="780" border="0" cellpadding="0" cellspacing="0" class="bodyBlue">
		<tr>
			<!-- Top Border -->
			<td colspan="5"><img src="images/bluedot.gif" alt="" width="780" height="1" border="0"></td>
		</tr>
		<tr>
			<!-- Left Border -->
			<td background="images/bluedot.gif"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td valign="top" class="cellFrost">
				<table border="0" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td style="position:relative;"><br>
						<table border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td colspan="2" style="position:relative;"><img src="images/properties/oceanas-(1).jpg" alt="" name="image" id="image" width="640" height="480" border="1"></td>
						</tr>
						<tr>
							<td class="bodyBlue" style="position:relative;"><a href="javascript:void(0);" onClick="imgSwapBwd(0);" class="bodyBlue"><strong>&#171;&nbsp;Previous Image</strong></a>&nbsp;|&nbsp;<a href="javascript:void(0);" onClick="imgSwapFwd(0);" class="bodyBlue"><strong>Next Image&nbsp;&#187;</strong></a></td>
							<td  align="right" class="bodyBlue" style="position:relative;"><a href="javascript:void(0);" onClick="document.image.src = eval('img0.src');" class="bodyBlue"><strong>Floor Plan</strong></a></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<table width="100%" border="0" cellspacing="5" cellpadding="0">
						<tr>
							<td align="center"><img src="images/bluedot.gif" alt="" width="760" height="1" border="0"></td>
						</tr>
						<tr>
							<td class="bigBlue" style="position:relative;"><strong>It's Your Time To Live In Paradise...</strong></td>
						</tr>
						<tr>
							<td class="bigBlue" style="position:relative;">
								<strong><em>Oceanas</em>, by Pacifica del Norte, S.A., is a community of four bedroom, three (full) bath homes located adjacent to the world famous Los Sue&ntilde;os Marriott Resort and Marina in Playa Herradura (Horseshoe Beach), Costa Rica.<br><br>
							
							Each home features an open floorplan with ceramic tile flooring and modern conveniences including central air conditioning and multiple pre-wired telephone and Internet outlets. Kitchens feature marble or granite counter tops with stainless steel range, refrigerator, microwave oven, dishwasher, and garbage disposal. The Master Bedroom offers a luxury bath and walk-in closets with a balcony overlooking the landscaped, private swimming pool area.<br><br>
							
							<em>Oceanas</em> offers a perfect blend of rustic charm and modern convenience with spectacular panoramic views of the lush tropical rainforest, Los Sue&ntilde;os Marina, and the unspoiled waters of Bahia Herradura. At <em>Oceanas</em> you are only minutes away from sportsfishing, rainforest canopy tours, and world-class golf...each home comes with a <u>full-year membership</u> to the Ted Robinson designed Marriott Resort Championship Golf Course.</strong>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="80" class="bigBlue" style="position:relative;"><strong>Size:</strong></td>
									<td class="bigBlue" style="position:relative;"><strong>326 square meters (3,500 square feet)</strong></td>
								</tr>
								<tr>
									<td class="bigBlue" style="position:relative;"><strong>Price:</strong></td>
									<td class="bigBlue" style="position:relative;"><strong>$400,000 USD</strong></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center"><img src="images/bluedot.gif" alt="" width="760" height="1" border="0"></td>
						</tr>
						<tr>
							<td class="bigBlue" style="position:relative;"><strong>For more information Call:888.286.7975 or (011)506.375.4069, Email:<a href="mailto:info@pacificadelnorte.com?subject=Oceanas" class="bigBlue">info@pacificadelnorte.com</a></strong></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
			<td background="images/bluedot.gif"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
		<tr>
			<!-- Bottom Border -->
			<td colspan="5"><img src="images/bluedot.gif" alt="" width="780" height="1" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br></td>
		</tr>
		</table>
		<!-- END Image Gallery -->

	</td>
</tr>
</table>

<!-- END INCLUDE Oceanas -->
