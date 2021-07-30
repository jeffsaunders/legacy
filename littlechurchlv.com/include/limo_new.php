			<!-- BEGIN include limo.php -->

			<script>
				// --- Buttons
				
				// Begin Loading Images for Buttons
				if (document.images) {
				
				// MouseOver Images
					btn21on = new Image();
					btn21on.src = "images/Buttons/WebSpecials-On.png";
					btn22on = new Image();
					btn22on.src = "images/Buttons/TourPackages-On.png";
				
				// MouseOut Images
					btn21off = new Image();
					btn21off.src = "images/Buttons/WebSpecials-Off.png";
					btn22off = new Image();
					btn22off.src = "images/Buttons/TourPackages-Off.png";
				}
			</script>

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
											<img src='TextIMG.php?text=<?=substr($config2["limousine_intro"],0,1);?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=substr($config2["limousine_intro"],0,1);?>" border="0">
										</td>
									</tr>
									</table>
									<?=substr($config2["limousine_intro"],1);?>
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
						<a href="index/reservations" title="Click to Start You Reservation Now!"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btnReserve" id="btnReserve" width="200" height="35" border="0" onMouseOver="this.src='images/Buttons/Reserve-On.png'" onMouseOut="this.src='images/Buttons/Reserve-Off.png'" onMouseLeave="this.src='images/Buttons/Reserve-Off.png'"></a>
					</div>

					<!-- Spacer --
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

					<!-- Promotions --
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
										<td class="bodyDarkGray">
											<img src='TextIMG.php?text=<?=$config2["limousine_title"];?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=450&height=39&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=$config2["limousine_title"];?>" border="0"><br><br>
										</td>
									</tr>
<!--									<tr>
										<!-- Buttons --
										<td align="center">
											<br>
											<!-- Web Specials --
											<a href="javascript:void(0);" onMouseOver="imgOn('btn21');" onMouseOut="imgOff('btn21')" onMouseLeave="imgOff('btn21')" onClick="document.getElementById('limoframe').src='https://limopartnerconnect.com/?PartnerCode=5215';" title="View Web Specials"><img src="images/Buttons/WebSpecials-Off.png" alt="Web Specials" name="btn21" id="btn21" width="200" height="35" border="0"></a>
											<img src="images/spacer.gif" alt="" width="25" height="1" border="0">
											<!-- Tour Packages --
											<a href="javascript:void(0);" onMouseOut="imgOff('btn22')" onMouseLeave="imgOff('btn22')" onMouseLeave="imgOff('btn22')" onClick="document.getElementById('limoframe').src='https://limopartnerconnect.com/?PartnerCode=5215&RunType=Tour';" title="View Tour Packages"><img src="images/Buttons/TourPackages-Off.png" alt="Tour Packages" name="btn22" id="btn22" width="200" height="35" border="0"></a>
										</td>
									</tr>-->
									<tr>
										<td>
<!--											<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>-->
											<table border="0" cellspacing="0" cellpadding="0" align="center">
											<tr>
												<!-- Buttons -->
												<td align="center">
													<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
													<!-- Web Specials -->
													<a href="javascript:void(0);" onMouseOver="imgOn('btn21');" onMouseOut="imgOff('btn21')" onMouseLeave="imgOff('btn21')" onClick="document.getElementById('limoframe').src='https://limopartnerconnect.com/?PartnerCode=5215';" title="View Web Specials"><img src="images/Buttons/WebSpecials-Off.png" alt="Web Specials" name="btn21" id="btn21" width="200" height="35" border="0"></a>
<!--													<img src="images/spacer.gif" alt="" width="20" height="1" border="0">-->
													<!-- Tour Packages -->
													<a href="javascript:void(0);" onMouseOver="imgOn('btn22')" onMouseOut="imgOff('btn22')" onMouseLeave="imgOff('btn22')" onClick="document.getElementById('limoframe').src='https://limopartnerconnect.com/?PartnerCode=5215&RunType=Tour';" title="View Tour Packages"><img src="images/Buttons/TourPackages-Off.png" alt="Tour Packages" name="btn22" id="btn22" width="200" height="35" border="0"></a>
												</td>
												<td><img src="images/spacer.gif" alt="" width="65" height="1" border="0"></td>
												<td>
													<!-- SSL Site Seal -->
													<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>
													<script type="text/javascript">TrustLogo("images/SiteSealRound.png", "SC","none");</script><br>
												</td>					
											</tr>
											</table>
										</td>
									</tr>
<!--									<tr>
										<td>
											<table align="center">
											<tr>
												<td align="center"><a href="javascript:void(0);" title="View Web Specials" onClick="document.getElementById('limoframe').src='https://limopartnerconnect.com/?PartnerCode=5215';" class="bigDarkGray"><strong>Web Specials</strong></a></td>
												<td class="superBlack"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"><strong>&middot;</strong><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
												<td align="center"><a href="javascript:void(0);" title="View Tours" onClick="document.getElementById('limoframe').src='https://limopartnerconnect.com/?PartnerCode=5215&RunType=Tour';" class="bigDarkGray"><strong>Tour Packages</strong></td>
											</tr>
											</table>
										</td>
									</tr>-->
									<tr>
										<td align="center" class="bigDarkGray">
											<br>
											<iframe src="https://limopartnerconnect.com/?PartnerCode=5215<?//=iif($cargo=="tour", "&RunType=Tour", "");?>" name="limoframe" id="limoframe" width="600" height="500px" marginwidth="0px" marginheight="0px" scrolling="no" frameborder="1" allowtransparency="no" style="border:medium solid #770025; background-color:#F9F6E9;"></iframe>
										</td>
									</tr>
									<tr>
										<td height="28" colspan="2" align="center" valign="bottom">
											<!-- Flourish -->
											<img src="images/SeperatorBar.png" alt="" width="575" height="15" border="0">
										</td>
									</tr>
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
				</td>
			</tr>
			</table>

			<!-- END include limo.php -->
