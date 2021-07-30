<!-- BEGIN INCLUDE alsides-naranjo -->

<!-- BEGIN Image Swapping -->
<script language="javascript">
if (document.images) {
// Property Images
	<?
	for ($counter=1; $counter <= 18; $counter++){
		echo'
			img'.$counter.' = new Image(); 
			img'.$counter.'.src = "images/properties/finca-de-alsides-('.$counter.').jpg"; 
		';
	}
	?>
}

// Swap Images
var imgNumber = 1;
function imgSwapFwd() {
	if (document.images) {
		imgNumber++;
		if (imgNumber == 19) {
			imgNumber = 1;
		}
		document.image.src = eval("img"+imgNumber+".src");
	}
}

function imgSwapBwd() {
	if (document.images) {
		imgNumber--;
		if (imgNumber == 0) {
			imgNumber = 18;
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
							<td colspan="2" style="position:relative;"><img src="images/properties/finca-de-alsides-(1).jpg" alt="" name="image" id="image" width="640" height="480" border="1"></td>
						</tr>
						<tr>
							<td class="bodyBlue" style="position:relative;"><a href="javascript:void(0);" onClick="imgSwapBwd(0);" class="bodyBlue"><strong>&#171;&nbsp;Previous Image</strong></a>&nbsp;|&nbsp;<a href="javascript:void(0);" onClick="imgSwapFwd(0);" class="bodyBlue"><strong>Next Image&nbsp;&#187;</strong></a></td>
							<td  align="right" class="bodyBlue" style="position:relative;"><a href="?sec=alsides-naranjo-video" class="bodyBlue"><img src="images/projector.gif" alt="" width="20" height="11" border="0" style="position:relative;"><strong>Video Tour</strong></a></td>
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
							<td class="xbigBlue" style="position:relative;"><strong>Beautiful Island View</strong></td>
						</tr>
						<tr>
							<td class="bigBlue" style="position:relative;">Located on the edge of the luscious rainforest, this property is only 6 kilometers from the world famous Los Sue&ntilde;os Marriott Resort and Marina and has a gorgeous view of Bah&iacute;a de Herradura (Horseshoe Bay) and Isla Herradura (Horseshoe Island).<br><br></td>
						</tr>
						<tr>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="80" class="bigBlue" style="position:relative;"><strong>Lot Size:</strong></td>
									<td class="bigBlue" style="position:relative;"><strong>5&frac12; hectares (13.6 acres)</strong></td>
								</tr>
								<tr>
									<td class="bigBlue" style="position:relative;"><strong>Price:</strong></td>
									<td class="bigBlue" style="position:relative;"><strong>$500,000 USD</strong></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center"><img src="images/bluedot.gif" alt="" width="760" height="1" border="0"></td>
						</tr>
						<tr>
							<td align="center" class="bigBlue" style="position:relative;">
								<?include("./include/pagefooter.php");?>
							</td>
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

<!-- END INCLUDE alsides-naranjo -->
