			<!-- BEGIN Include sitemap.php -->

			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td colspan="3"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
			</tr>
			<tr>
				<!-- Left Column -->
				<td valign="top">
					<!-- Intro --
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/225WhiteBGTop.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					<tr>
						<td background="images/225WhiteBGMiddle.gif">
							<table width="200" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyDarkGray">
							<tr>
								<td>
									<!-- DropCap Image --
									<table border="0" cellspacing="0" cellpadding="0" align="left">
									<tr>
										<td>
											<img src='TextIMG.php?text=<?=substr($config2["sitemap_intro"],0,1);?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=substr($config2["sitemap_intro"],0,1);?>" border="0">
										</td>
									</tr>
									</table>
									<?=substr($config2["sitemap_intro"],1);?>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/225WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>-->
<!--
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
									<?//=$promos;?>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/225WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>
-->
					<!-- Spacer -->
<!--					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>-->

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
									<table width="625" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyDarkGray">
									<!-- Page Title -->
									<tr>
										<td colspan="3" class="bodyDarkGray">
											<img src='TextIMG.php?text=<?=$config2["sitemap_title"];?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=450&height=39&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=$config2["sitemap_title"];?>" border="0"><br><br>
										</td>
									</tr>
									<tr>
										<td>
											<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="bigDarkGray">
											<tr>
												<td width="50%" valign="top">
													<li><a href="index/home" title="The Little Church Home Page" class="bigDarkGray">Home Page</a><br>
													<br>
													<li>Expense<br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/experience/gallery/grounds" title="Tour Our Chapel Grounds" class="bigDarkGray">Chapel Grounds</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/experience/gallery/chapel" title="Tour Our Chapel Interior" class="bigDarkGray">Chapel Interior</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/experience/history" title="The Rich History of The Little Church of the West" class="bigDarkGray">Chapel History</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/experience/news" title="The Little Church of the West in the News" class="bigDarkGray">News/Press</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/experience/testimonials" title="Some Kind Words from Happy Couples and their Families" class="bigDarkGray">Testimonials</a><br>
													<br>
													<li>Packages<br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/packages/weddings" title="Wedding Ceremony Packages" class="bigDarkGray">Wedding Ceremonies</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/wedding/Let%27s%20Elope" title="Let's Elope Ceremony Details" class="bigDarkGray"><em>"Let's Elope"</em> Ceremony</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/wedding/Tie%20the%20Knot" title="Tie the Knot Ceremony Details" class="bigDarkGray"><em>"Tie the Knot"</em> Ceremony</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/wedding/Lucky%20in%20Love" title="Lucky in Love Ceremony Details" class="bigDarkGray"><em>"Lucky in Love"</em> Ceremony</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/wedding/Marry%20Me" title="Marry Me Ceremony Details" class="bigDarkGray"><em>"Marry Me"</em> Ceremony</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/wedding/Forever%20True" title="Forever True Ceremony Details" class="bigDarkGray"><em>"Forever True"</em> Ceremony</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/packages/renewals" title="Vow Renewal Ceremony Packages" class="bigDarkGray">Vow Renewal Ceremonies</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/renewal/Let%27s%20Elope%20Again" title="Let's Elope Again Ceremony Details" class="bigDarkGray"><em>"Let's Elope Again"</em> Ceremony</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/renewal/Tie%20the%20Knot%20Again" title="Tie the Knot Again Ceremony Details" class="bigDarkGray"><em>"Tie the Knot Again"</em> Ceremony</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/renewal/Still%20Lucky%20in%20Love" title="Still Lucky in Love Ceremony Details" class="bigDarkGray"><em>"Still Lucky in Love"</em> Ceremony</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/renewal/Marry%20Me%20Again" title="Marry Me Again Ceremony Details" class="bigDarkGray"><em>"Marry Me Again"</em> Ceremony</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/renewal/Still%20Forever%20True" title="Still Forever True Ceremony Details" class="bigDarkGray"><em>"Still Forever True"</em> Ceremony</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/packages/featured" title="Special Themed or Featured Ceremony Packages" class="bigDarkGray">Featured Ceremonies</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/featured/Garden%20Ceremony" title="Garden Ceremony Details" class="bigDarkGray"><em>"Garden"</em> Ceremony</a><br>
															<img src="images/spacer.gif" alt="" width="60" height="1" border="0"><a href="index/packagedetails/featured/&amp;quot;Now or Never&amp;quot;%20Ceremony" title="&quot;Now%20or%20Never&quot; Ceremony Details" class="bigDarkGray"><em>"Now or Never"</em> Ceremony</a><br>
												</td>
												<td><img src="images/spacer.gif" alt="" width="30" height="1" border="0"></td>
												<td width="50%" valign="top">
													<li>Services<br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/services/flowers" title="Floral Arrangement Photo Gallery" class="bigDarkGray">Flower Gallery</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/services/photography" title="Professional Photography Services" class="bigDarkGray">Photography Services</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="https://secure.nr.net/littlechurchlv/index/services/limousine" title="Limousine Service Packages & Tours" class="bigDarkGray">Limousine Services</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="index/services/additional" title="Additional Services For Your Convenience" class="bigDarkGray">Additional Services</a><br>
													<br>
													<li><a href="index/guests/webcam" title="Streaming Wedding Videos (Premium Service)" class="bigDarkGray">Chapel Webcam</a><br>
													<br>
													<li><a href="index/questions" title="Frequently Asked Questions & Answers" class="bigDarkGray">Frequently Asked Questions</a><br>
													<br>
													<li><a href="https://secure.nr.net/littlechurchlv/index/reservations" title="Our SECURE Reservation System" class="bigDarkGray">Make Reservations</a><br>
													<br>
													<li>Contact<br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="javascript:void(0)" onClick="show('directionsLayer')" title="Directions to our World Famous Location" class="bigDarkGray">Directions to the Chapel</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="javascript:popContact('contactForm')" title="Leave Us A Message and We'll Get Back To You" class="bigDarkGray">Contact Us</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="javascript:void(0)" onClick="show('feedbackLayer')" title="Tell Us What You Think - Testimonials Welcome!" class="bigDarkGray">Leave Us Feedback</a><br>
														<img src="images/spacer.gif" alt="" width="30" height="1" border="0"><a href="http://www.facebook.com/pages/Las-Vegas-NV/Little-Church-of-the-West/128461487175584"	target="_blank" title="Find Us on Facebook" class="bigDarkGray">Visit Our Facebook</a><br>
													<br>
													<li><a href="index/privacy" title="Our Site Privacy Policy" class="bigDarkGray">Privacy Policy</a><br>
													<br>
													<li><a href="index/terms" title="Our Site Terms of Use" class="bigDarkGray">Terms of Use</a><br>
													<br>
													<li><a href="index/sitemap" title="Site Map (This Page)" class="bigDarkGray">Site Map</a><br>
													<br>
													<li><a href="http://www.elviswedding-lasvegas.com/"	target="_blank" title="Our Sister Site ElvisWedding-LasVegas.com" class="bigDarkGray">Visit ElvisWedding-LasVegas.com</a><br>
													<br>
												</td>
											</tr>
											</table>
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

			<!-- END include sitemap.php -->

