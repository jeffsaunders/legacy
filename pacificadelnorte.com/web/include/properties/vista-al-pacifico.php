<!-- BEGIN INCLUDE Oceanas -->

<!-- BEGIN Image Swapping -->
<script language="javascript">
if (document.images) {
// Property Images
//	img0 = new Image(); 
//	img0.src = "images/properties/oceanas-floorplan.jpg";
	<?
	for ($counter=1; $counter <= 6; $counter++){
		echo'
			img'.$counter.' = new Image(); 
			img'.$counter.'.src = "images/properties/vista-al-pacifico-('.$counter.').jpg"; 
		';
	}
	?>
}

// Swap Images
var imgNumber = 1;
function imgSwapFwd() {
	if (document.images) {
		imgNumber++;
		if (imgNumber == 7) {
			imgNumber = 1;
		}
		document.image.src = eval("img"+imgNumber+".src");
	}
}

function imgSwapBwd() {
	if (document.images) {
		imgNumber--;
		if (imgNumber == 0) {
			imgNumber = 6;
		}
		document.image.src = eval("img"+imgNumber+".src");
	}
}
</script>
<!-- END Image Swapping -->

<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td valign="top"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
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
						<table width="760" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td colspan="2" align="center" style="position:relative;"><img src="images/properties/vista-al-pacifico-(1).jpg" alt="" name="image" id="image" height="480" border="0"></td>
						</tr>
						<tr>
							<td colspan="2"><hr width="760" size="1" noshade></td>
						</tr>
						<tr>
							<td class="bodyBlue" style="position:relative;"><a href="javascript:void(0);" onmouseover="window.status='Vista al Pacifico'; return true;" onmouseout="window.status=''; return true;" onClick="imgSwapBwd(0);" class="bodyBlue"><strong>&#171;&nbsp;Previous Image</strong></a>&nbsp;|&nbsp;<a href="javascript:void(0);" onmouseover="window.status='Vista al Pacifico'; return true;" onmouseout="window.status=''; return true;" onClick="imgSwapFwd(0);" class="bodyBlue"><strong>Next Image&nbsp;&#187;</strong></a></td>
<!--							<td  align="right" class="bodyBlue" style="position:relative;"><a href="?sec=vista-al-pacifico-video" class="bodyBlue"><img src="images/projector.gif" alt="" width="20" height="11" border="0" style="position:relative;"><strong>Video Tour</strong></a></td>-->
<!--							<td  align="right" class="bodyBlue" style="position:relative;"><a href="javascript:void(0);" onClick="document.image.src = eval('img0.src');" class="bodyBlue"><strong>Floor Plan</strong></a></td>-->
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
<!--						<tr>
							<td class="superbigBlue" style="position:relative;"><strong>It's Your Time To Live In Paradise...</strong></td>
						</tr>-->
						<tr>
							<td class="bodyBlue" valign="top" style="position:relative;"><br>
								<!-- Logo -->
								<table width="250" border="0" cellspacing="0" cellpadding="2" align="left">
								<tr>
									<td style="position:relative;"><img src="images/VistaalPacificoLogo.gif" alt="" width="250" height="200" border="0"></td>
								</tr>
								</table>
								<!-- Text -->
								<strong class="superbigBlue">It's Your Time To Live In Paradise...</strong><br><br>
								
								<a href="?sec=vista-al-pacifico" class="bodyBlue"><strong>Vista al Pacifico</strong></a>, by <em>Pacifica del Norte, S.A.</em>, is an exclusive community of dual master suite, two and a half bath condominiums located adjacent to the world famous Playa Herradura (Horseshoe Beach) in Costa Rica.<br><br>

								Only a three minute walk from the beach, <a href="?sec=vista-al-pacifico" class="bodyBlue"><strong>Vista al Pacifico</strong></a> is designed to be a beautifully modern condominium complex. The gated community features secure parking, plentiful green areas, and a relaxing swimming pool and barbeque ranch area. This innovative residential complex provides services that do not exist in other Costa Rican area developments. Vista al Pacifico's on-site management includes, in addition to 24/7 security and a maintenance crew, having a <em>mucama</em> service; a maid to clean your condo once or twice weekly, similar to a hotel.<br><br>

								At <a href="?sec=vista-al-pacifico" class="bodyBlue"><strong>Vista al Pacifico</strong></a>, you are minutes away from gorgeous tropical scenery, picturesque beaches, sport fishing, rainforest canopy tours, and world-class golf; and located along the Central Pacific coast, 2,500 feet (762 meters) from Los Sue&ntilde;os Resort & Marina &mdash; <em>by far the most popular place on Costa Rica's Pacific coast to invest, live or vacation</em> &mdash; and only two hours, by car, from the bustling capital city of San Jose and its international airport.<br><br>

								A smart investment, Pacific coast beach condo property in Costa Rica can easily exceed a 20-25% annual equity increase. Additionally, a <a href="?sec=vista-al-pacifico" class="bodyBlue"><strong>Vista al Pacifico</strong></a> condominium can work <strong>FOR</strong> you when you are not in Costa Rica visiting. Vista al Pacifico offers on-site rental management to handle seasonal and non-seasonal rental of your condominium, generating cash flow and extra income for you! Vista al Pacifico units can be easily rented for approximately $700 USD per week during the "high season" and up to $550 USD per week in "low" (rainy) season &mdash; the occupancy rate is consistently around 90% in the high season and 75% in low season.<br><br>

								The first of only nine total units are scheduled for delivery by early 2011. Presale prices for <a href="?sec=vista-al-pacifico" class="bodyBlue"><strong>Vista al Pacifico</strong></a> are valid only until July 31, 2010, so <strong>HURRY!</strong><br><br>
							</td>
						</tr>
						<tr>
							<td>
								<table border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlue">
								<tr>
									<td width="100" style="position:relative;"><strong>Building:</strong></td>
									<td style="position:relative;"><strong>Tower I (Building A)</strong></td>
									<td width="25" rowspan="9" style="position:relative;">&nbsp;</td>
									<td style="position:relative;"><strong>Tower II (Building B)</strong></td>
								</tr>
								<tr>
									<td style="position:relative;"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
								</tr>
								<tr>
									<td style="position:relative;"><strong>Size:</strong></td>
									<td style="position:relative;"><strong>1,557 square feet (144.65 square meters)</strong></td>
									<td style="position:relative;"><strong>1,629 square feet (151.33 square meters)</strong></td>
								</tr>
								<tr>
									<td style="position:relative;"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
								</tr>
								<tr>
									<td style="position:relative;"><strong>Price (USD):</strong></td>
									<td style="position:relative;"><strong>$334,900 &mdash; First Floor</strong></td>
									<td style="position:relative;"><strong>$349,900 &mdash; First Floor</strong></td>
								</tr>
								<tr>
									<td style="position:relative;">&nbsp;</td>
									<td style="position:relative;"><strong>$349,900 &mdash; Second Floor</strong></td>
									<td style="position:relative;"><strong>$369,900 &mdash; Second Floor</strong></td>
								</tr>
								<tr>
									<td style="position:relative;">&nbsp;</td>
									<td style="position:relative;"><strong>$364,900 &mdash; Third Floor</strong></td>
									<td style="position:relative;"><strong>$374,900 &mdash; Third Floor</strong></td>
								</tr>
								<tr>
									<td style="position:relative;">&nbsp;</td>
									<td style="position:relative;"><strong>$384,900 &mdash; Fourth (Top) Floor</strong></td>
									<td style="position:relative;"><strong>$394,900 &mdash; Fourth Floor</strong></td>
								</tr>
								<tr>
									<td colspan="2" style="position:relative;">&nbsp;</td>
									<td style="position:relative;"><strong>$414,900 &mdash; Penthouse</strong></td>
								</tr>
								</table>
								<br>
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
	</td>
</tr>
</table>

<!-- END INCLUDE Oceanas -->
