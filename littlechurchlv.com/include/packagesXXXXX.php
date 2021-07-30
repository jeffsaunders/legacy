			<!-- BEGIN include packages.php -->

			<script>
				// --- Buttons
				
				// Begin Loading Images for Buttons
				if (document.images) {
				
				// MouseOver Images
					btn11aon = new Image();
					btn11aon.src = "images/Buttons/Details-On.png";
					btn11bon = new Image();
					btn11bon.src = "images/Buttons/Reserve-On.png";
					btn12aon = new Image();
					btn12aon.src = "images/Buttons/Details-On.png";
					btn12bon = new Image();
					btn12bon.src = "images/Buttons/Reserve-On.png";
					btn13aon = new Image();
					btn13aon.src = "images/Buttons/Details-On.png";
					btn13bon = new Image();
					btn13bon.src = "images/Buttons/Reserve-On.png";
					btn14aon = new Image();
					btn14aon.src = "images/Buttons/Details-On.png";
					btn14bon = new Image();
					btn14bon.src = "images/Buttons/Reserve-On.png";
					btn15aon = new Image();
					btn15aon.src = "images/Buttons/Details-On.png";
					btn15bon = new Image();
					btn15bon.src = "images/Buttons/Reserve-On.png";
				
				// MouseOut Images
					btn11aoff = new Image();
					btn11aoff.src = "images/Buttons/Details-Off.png";
					btn11boff = new Image();
					btn11boff.src = "images/Buttons/Reserve-Off.png";
					btn12aoff = new Image();
					btn12aoff.src = "images/Buttons/Details-Off.png";
					btn12boff = new Image();
					btn12boff.src = "images/Buttons/Reserve-Off.png";
					btn13aoff = new Image();
					btn13aoff.src = "images/Buttons/Details-Off.png";
					btn13boff = new Image();
					btn13boff.src = "images/Buttons/Reserve-Off.png";
					btn14aoff = new Image();
					btn14aoff.src = "images/Buttons/Details-Off.png";
					btn14boff = new Image();
					btn14boff.src = "images/Buttons/Reserve-Off.png";
					btn15aoff = new Image();
					btn15aoff.src = "images/Buttons/Details-Off.png";
					btn15boff = new Image();
					btn15boff.src = "images/Buttons/Reserve-Off.png";
				}
			</script>

			<?
			// Grab packages

			if ($feature == "weddings"){$type = "Wedding"; $title = "Wedding"; $intro = $config2["wedding_intro"]; $promos = $config2["wedding_promotions"];}
			if ($feature == "renewals"){$type = "Renewal"; $title = "Vow Renewal"; $intro = $config2["renewal_intro"]; $promos = $config2["renewal_promotions"];}
			if ($feature == "featured"){$type = "Featured"; $title = "Featured"; $intro = $config2["featured_intro"]; $promos = $config2["featured_promotions"];}
			$query = "SELECT * FROM packages WHERE package_type = '".$type."' AND (package_expires = '0000-00-00' OR package_expires >= NOW()) AND display = 'T' ORDER BY position ASC;";
//echo $query;
			$rs_packages = mysql_query($query, $linkID2) or die(mysql_error());
			?>

			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td colspan="3"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
			</tr>
			<tr>
				<!-- Left Column -->
				<td valign="top">
					<!-- Intro -->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/225WhiteBGTop.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					<tr>
						<td background="images/225WhiteBGMiddle.gif">
							<table width="200" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyDarkGray">
							<tr>
								<td>
									<!-- DropCap Image -->
									<table border="0" cellspacing="0" cellpadding="0" align="left">
									<tr>
										<td>
<!--											<img src='TextIMG.php?text=<?=substr($intro,0,1);?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E	8&transparent=yes&dropcap=yes&format=png' alt="<?=substr($intro,0,1);?>" border="0">-->
											<img src='/TextIMG.php?text=<?=substr($config2["package_intro"],0,1);?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=substr($config2["package_intro"],0,1);?>" border="0">
										</td>
									</tr>
									</table>
									<?=substr($intro,1);?>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/225WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>

					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

					<!-- Reserve Now Button -->
					<div align="center">
						<a href="https://secure.nr.net/littlechurchlv/index/reservations" title="Click to Start You Reservation Now!"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btnReserve" id="btnReserve" width="200" height="35" border="0" onMouseOver="this.src='images/Buttons/Reserve-On.png'" onMouseOut="this.src='images/Buttons/Reserve-Off.png'" onMouseLeave="this.src='images/Buttons/Reserve-Off.png'"></a>
					</div>

					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

					<!-- Promotions -->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/225WhiteBGTop.gif"><img src="images/Ribbons225x20.png" alt="" width="225" height="20" border="0"></td>
					</tr>
					<tr>
						<td background="images/225WhiteBGMiddle.gif">
							<table width="200" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyDarkGray">
							<tr>
								<td>
									<?=$promos;?>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/225WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>
					
<!-- Maybe on regular pages say something like "Looking for something a little 'different'?  Click here to view our Featured Packages" -->

					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

					<!-- Testimonials --
					<table width="225" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/225BurgundyBGTop.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					<tr>
						<td align="center" background="images/225BurgundyBGMiddle.gif">
							<!-- Testimonials Slideshow --
							<a href="/index/experience/testimonials" title="Some Kind Words from Happy Couples and their Families">
							<div id="testimonials" style="display:inline-block; background:transparent; z-index:500"></div>
							</a>
							<?=iif(stristr($navigator_user_agent, 'msie'), '<img src="images/spacer.gif" alt="" width="225" height="10" border="0"><br>', '');?>
						</td>
					</tr>
					<tr>
						<td background="images/225BurgundyBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>-->

					<!-- Contact Form -->
					<a name="contact" id="contact">
					<?include("include/contactform.php");?>

				</td>

				<!-- Spacer -->
				<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>

				<!-- Right Column -->
				<td valign="top">
					<!-- Packages -->
					<table width="665" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/665WhiteBGTop.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
					</tr>
					<tr>
						<td align="center" valign="top" background="images/665WhiteBGMiddle.gif">
							<table width="630" border="0" cellspacing="0" cellpadding="0" align="center" background="images/Ribbons.png" style="background-attachment:scroll; background-position:top right; background-repeat:no-repeat;">
							<tr>
								<td>
									<table width="625" border="0" cellspacing="0" cellpadding="0" align="center">
									<!-- Page Title -->
									<tr>
										<td colspan="3" class="bodyDarkGray">
											<img src='TextIMG.php?text=<?=$title;?> Packages&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=450&height=39&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=$title;?> Packages" border="0"><br><br>
										</td>
									</tr>
								<?
								for ($packageCounter=1; $packageCounter <= mysql_num_rows($rs_packages); $packageCounter++){
									$package = mysql_fetch_assoc($rs_packages);
								?>
									<tr>
										<!-- Thumbnail -->
										<td width="125" rowspan="3" align="left" valign="top">
											<img src="images/<?=$package["thumbnail"];?>" alt="" width="115" border="1">
										</td>
										<!-- Package Header -->
										<td width="500" height="50" colspan="2" background="images/TexturedBar.png" style="background-position:top right;">
											<img src='TextIMG.php?text=<?=str_replace("'", "&rsquo;", $package["package_name"]);?>&font=CACCHAMP.TTF&bold=extra&points=25&txtcolor=F8F6E8&shadow=000000&offset=2&width=420&height=45&left=15&top=34&angle=0&bgcolor=770025&transparent=yes&dropcap=no&format=png' alt="<?=$package["package_name"];?>" width="420" height="45" border="0">
											<img src='TextIMG.php?text=<?=str_pad('$'.number_format($package["price"], 0, '.', ','), 6, " ", STR_PAD_LEFT);?>&font=CACCHAMP.TTF&bold=super&points=20&txtcolor=F8F6E8&shadow=000000&offset=2&width=75&height=45&left=<?=iif($package["price"] > 999, "0", "17");?>&top=34&angle=0&bgcolor=770025&transparent=yes&dropcap=no&format=png' alt="<?=$package["package_name"];?> for $<?=number_format($package["price"], 2, '.', ',');?>" width="75" height="45" border="0">
										</td>
									</tr>
									<tr>
										<!-- Package Description -->
										<td height="123" valign="top" class="smBodyDarkGray">
											<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
											<ul>
												<li><?=$package["description"];?></li>
											</ul>
										</td>
										<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
									</tr>
									<tr>
										<!-- Action Buttons -->
										<td colspan="2" align="center">
											<!-- More Info -->
											<a href="index/packagedetails/<?=strtolower($type);?>/<?=htmlspecialchars  ($package["package_name"]);?>" onMouseOver="imgOn('btn<?=$packageCounter+10;?>a');" onMouseOut="imgOff('btn<?=$packageCounter+10;?>a')" onMouseLeave="imgOff('btn<?=$packageCounter+10;?>a')" title="<?=$package["package_name"];?> Package Details"><img src="images/Buttons/Details-Off.png" alt="Details" name="btn<?=$packageCounter+10;?>a" id="btn<?=$packageCounter+10;?>a" width="200" height="35" border="0"></a>
											<img src="images/spacer.gif" alt="" width="25" height="1" border="0">
											<!-- Reserve -->
											<a href="https://secure.nr.net/littlechurchlv/index/reservations" onMouseOver="imgOn('btn<?=$packageCounter+10;?>b');" onMouseOut="imgOff('btn<?=$packageCounter+10;?>b')" onMouseLeave="imgOff('btn<?=$packageCounter+10;?>b')" title="Reserve <?=$package["package_name"];?> Package"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btn<?=$packageCounter+10;?>b" id="btn<?=$packageCounter+10;?>b" width="200" height="35" border="0"></a>
										</td>
									</tr>
								<?
								// If there are more packages, dispaly seperator bar
								if ($packageCounter < mysql_num_rows($rs_packages)){
								?>
									<tr>
										<td height="50" colspan="2" align="center">
											<!-- Flourish -->
											<img src="images/SeperatorBar.png" alt="" width="575" height="15" border="0"><br>
											<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
										</td>
									</tr>
								<?
								// No more packages, display bar at bottom
								}else{
								?>
									<tr>
										<td height="28" colspan="2" align="center" valign="bottom">
											<!-- Flourish -->
											<img src="images/SeperatorBar.png" alt="" width="575" height="15" border="0">
										</td>
									</tr>
								<?
									}
								}
								?>
									</table>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/665WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
					</tr>
					</table>
					<?
					// Only do this if displaying featured packages
//					if ($feature == "featured"){
					if (false){  //removed per Lisa 9/24/10
					?>
					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					
					<!-- Elvis Promotion -->
					<table width="665" border="0" cellspacing="0" cellpadding="0" class="xbigIvory">
					<tr>
						<td background="images/665BurgundyBGTop.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
					</tr>
					<tr>
						<td align="center" valign="top" background="images/665BurgundyBGMiddle.gif">
							<strong class="superIvory">Looking for Even More "Elvis"??<br></strong>
							Visit Our Sister Website at<br>
							<a href="http://www.elviswedding-lasvegas.com/" target="_blank" class="superIvory">ElvisWedding-LasVegas.com</a>
						</td>
					</tr>
					<tr>
						<td background="images/665BurgundyBGBottom.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
					</tr>
					</table>
					<?
					}
					?>
				</td>
			</tr>
			</table>

			<!-- END include packages.php -->
