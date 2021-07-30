<!-- BEGIN INCLUDE playa-hermosa-3-hectareas -->

<!-- BEGIN Image Swapping -->
<script language="javascript">
if (document.images) {
// Property Images
	<?
	for ($counter=1; $counter <= 22; $counter++){
		echo'
			img'.$counter.' = new Image(); 
			img'.$counter.'.src = "images/properties/playa-hermosa-3-hectareas-('.$counter.').jpg"; 
		';
	}
	?>
}

// Swap Images
var imgNumber = 1;
function imgSwapFwd() {
	if (document.images) {
		imgNumber++;
		if (imgNumber == 23) {
			imgNumber = 1;
		}
		var x = 'images/properties/playa-hermosa-3-hectareas-('+imgNumber+').jpg';
		document.image.src = eval("img"+imgNumber+".src");
	}
}

function imgSwapBwd() {
	if (document.images) {
		imgNumber--;
		if (imgNumber == 0) {
			imgNumber = 22;
		}
		var x = 'images/properties/playa-hermosa-3-hectareas-('+imgNumber+').jpg';
		document.image.src = eval("img"+imgNumber+".src");
	}
}
</script>
<!-- END Animated Mouseover -->

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
							<td colspan="2" style="position:relative;"><img src="images/properties/playa-hermosa-3-hectareas-(1).jpg" alt="" name="image" id="image" border="1"></td>
						</tr>
						<tr>
							<td class="bodyBlue" style="position:relative;"><a href="javascript:void(0);" onClick="imgSwapBwd(0);" class="bodyBlue"><strong>&#171;&nbsp;Previous Image</strong></a>&nbsp;|&nbsp;<a href="javascript:void(0);" onClick="imgSwapFwd(0);" class="bodyBlue"><strong>Next Image&nbsp;&#187;</strong></a></td>
							<td  align="right" class="bodyBlue" style="position:relative;"><img src="images/projector.gif" alt="" border="0" style="position:relative;"><strong>Video Tour</strong></td>
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
							<td class="bigBlue" style="position:relative;"><strong>Stunning Panoramic Ocean View</strong></td>
						</tr>
						<tr>
							<td class="bigBlue" style="position:relative;"><strong>Located on a hilltop near the luscious rain forest, only 6 kilometers from beautiful Playa Hermosa and it's gorgeous beaches.</strong></td>
						</tr>
						<tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="80" class="bigBlue" style="position:relative;"><strong>Lot Size:</strong></td>
									<td class="bigBlue" style="position:relative;"><strong>3 hectares (7.41 acres)</strong></td>
								</tr>
								<tr>
									<td class="bigBlue" style="position:relative;"><strong>Price:</strong></td>
									<td class="bigBlue" style="position:relative;"><strong>$580,000</strong></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center"><img src="images/bluedot.gif" alt="" width="760" height="1" border="0"></td>
						</tr>
						<tr>
							<td class="bigBlue" style="position:relative;"><strong>For more information Call:888.286.7975 or (011)506.375.4069, Email:<a href="mailto:info@pacificadelnorte.com?subject=Playa%20Hermosa%203%20Hectareas%20Property" class="bigBlue">info@pacificadelnorte.com</a></strong></td>
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
		<!-- END Contact -->

	</td>
</tr>
</table>

<!-- END INCLUDE Homes For Sale -->
