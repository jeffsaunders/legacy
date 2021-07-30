			<!-- BEGIN include packages.php -->

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
											<img src='TextIMG.php?text=<?=substr($config2["photography_intro"],0,1);?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=substr($config2["photography_intro"],0,1);?>" border="0">
										</td>
									</tr>
									</table>
									<?=substr($config2["photography_intro"],1);?>
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
										<td colspan="3" class="bodyDarkGray">
											<img src='TextIMG.php?text=<?=$config2["photography_title"];?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=450&height=39&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=$config2["photography_title"];?>" border="0"><br><br>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="bigDarkGray">
											<ul>
											<?
											$query = "SELECT * FROM photography WHERE display = 'T' ORDER BY position ASC;";
//echo $query;
											$rs_photography = mysql_query($query, $linkID2) or die(mysql_error());
											for ($packageCounter=1; $packageCounter <= mysql_num_rows($rs_photography); $packageCounter++){
												$package = mysql_fetch_assoc($rs_photography);
											?>
												<li><strong><?=$package["package_name"];?> - $<?=number_format($package["price"], 2, '.', ',');?></strong></li>
												<?
												$query = "SELECT * FROM photography_bullets WHERE package_number = '".$package["package_number"]."' AND display = 'T' ORDER BY position";
//echo $query;
												$rs_bullets = mysql_query($query, $linkID2) or die(mysql_error());
												for ($bulletCounter=1; $bulletCounter <= mysql_num_rows($rs_bullets); $bulletCounter++){
													$bullet = mysql_fetch_assoc($rs_bullets);
													//Test position value for having a remainder - if it does, indent it
													//(if it's floor exactly equals it's value, then it's whole, if not then it to be indented)
													if (floor($bullet["position"]) == $bullet["position"]){ 
												?>
												<ul>
													<li><?=$bullet["text"];?></li>
												</ul>
												<?
													}else{ //Not whole number, indent
												?>
												<ul><ul>
													<li><?=$bullet["text"];?></li>
												</ul></ul>
												<?
													}
												}
												?>
											<?
												if ($packageCounter < mysql_num_rows($rs_photography)){
											?>
												<br>
											<?
												}
											}
											?>
<!--											</ul>-->
										</td>
									</tr>
									<tr>
										<td colspan="3" class="bodyDarkGray">
											<br>
												<strong><em>* Photographs are taken with digital cameras by professional photographers.<br>
												<img src="images/spacer.gif" alt="" width="8" height="1" border="0">Several photos are taken within the photo packages (quantity varies).<!--<br>
												<img src="images/spacer.gif" alt="" width="8" height="1" border="0"><a href="/index/contact/message/photos" class="bodyBlack">Click here</a> if you have further questions.-->
												</em></strong>
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

			<!-- END include packages.php -->
