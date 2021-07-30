			<!-- BEGIN Include history.php -->
			
			<!-- Animation Scripts -->
			<script type="text/javascript" src="/jquery.min.js"></script>
			<script type="text/javascript" src="/fadeslideshow.js">
				/***********************************************
				* Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
				* This notice MUST stay intact for legal use
				* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
				***********************************************/
			</script>

			<!-- Rotating Images -->
			<script type="text/javascript">
				// Documented in custom.js
				var mygallery=new fadeSlideShow({
					wrapperid: "fadeshow2",
					dimensions: [225, 400],
					imagearray: [
						<?
						// Blow apart the list of imges to display, then step through them
						$aImages = explode(",",$config2["home_slideshow_images"]);
						// Array is zero relative, count is one relative, so step back 2 to grab all but the last one
						for ($imageCounter=0; $imageCounter <= count($aImages)-2; $imageCounter++){
						?>
						["/images/slideshow/<?=$aImages[$imageCounter];?>"],
						<?
						}
						?>
						["/images/slideshow/<?=$aImages[$imageCounter];?>"]
					],
					displaymode: {type:'auto', pause:10000, cycles:0, wraparound:false, randomize:false},
					persist: false,
					fadeduration: 1000,
					descreveal: "ondemand",
					togglerid: ""
				})
			</script>

			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td colspan="3">
					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<!-- Left Column -->
					<table width="225" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<!-- Image Slideshow - Images defined in custom.js -->
							<div style="position:relative; top:0; left:0; z-index:1;">
								<div id="fadeshow2" style="display:inline-block; background:transparent; z-index:500"></div>
								<!-- Top Border -->
								<div style="position:absolute; top:0; left:0; z-index:501;">
									<img src="images/225BGTopTrans.png" alt="" width="225" height="20" border="0">
								<div>
								<!-- Middle Border -->
								<div style="position:absolute; top:20; right:0; z-index:501;">
									<img src="images/225BGMiddleTrans.png" alt="" width="225" height="360" border="0">
								<div>
								<!-- Bottom Border -->
								<div style="position:absolute; top:360; right:0; z-index:501;">
									<img src="images/225BGBottomTrans.png" alt="" width="225" height="20" border="0">
								<div>
							</div>
						</td>
					</tr>
<!--					<tr>
						<td>
							<!-- Spacer --
							<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
						</td>
					</tr>
					<tr>
						<td>-->
							<!-- Promotions -->
<!--							<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
						</td>
					</tr>-->
					<tr>
						<td>
							<!-- Spacer -->
							<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
						</td>
					</tr>
					<tr>
						<td>
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
					</tr>	
					</table>
				</td>
				<!-- Spacer -->
				<td><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
				<td valign="top">
					<!-- Right Column -->
					<table width="665" border="0" cellspacing="0" cellpadding="0" align="right">
					<tr>
						<td>
							<!-- History -->
							<table width="665" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td background="images/665WhiteBGTop.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
							</tr>
							<tr>
								<td align="center" background="images/665WhiteBGMiddle.gif">
							<table width="630" border="0" cellspacing="0" cellpadding="0" align="center" background="images/Ribbons.png" style="background-attachment:scroll; background-position:top right; background-repeat:no-repeat;">
							<tr>
								<td>
									<table width="630" border="0" cellspacing="0" cellpadding="0" align="center">
									<!-- Page Title -->
									<tr>
										<td class="bodyDarkGray">
											<img src='TextIMG.php?text=Chapel History&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=450&height=39&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=$config2["gallery_".$location."_title"];?>" border="0"><br><br>
										</td>
									</tr>
									<tr>
										<td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyDarkGray">
											<tr>
												<td>
													<!-- Image -->
													<table width="235" border="0" align="right" cellpadding="0" cellspacing="0">
													<tr>
														<!-- Chapel Front Sepia -->
														<td align="right"><img src="images/ChapelDaySepia.jpg" alt="" width="200" height="299" border="1"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"><br><br></td>
													</tr>
													</table>
													<!-- Text -->
													<strong class="bigBlack">An Historic Treasure</strong><br><br>
													<!-- DropCap Image -->
													<table border="0" cellspacing="0" cellpadding="0" align="left">
													<tr>
														<td>
															<img src='TextIMG.php?text=S&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=3F3F3F&shadow=C0C0C0&offset=0&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="S" border="0">
														</td>
													</tr>
													</table>
													ince 1942 it has been one memorable day after another at the legendary <strong>Little Church of the West</strong> and what better backdrop for your eventful day than the luxurious glamour of Las Vegas, <em>"The Entertainment Capital of the World"</em>. 

													<p><strong>The Little Church of the West</strong> has played a major role in the evolution of the city's image and has been the scene of more celebrity marriages than any other wedding chapel in the world.  Betty Grable, Judy Garland, Mickey Rooney, Dudley Moore, Cindy Crawford & Richard Gere, Angelina Jolie & Billy Bob Thornton, and even Elvis Presley (well, sort of...he and Ann Margaret recited their vows in the movie <em>"Viva Las Vegas"</em>, filmed here at <strong>the Little Church of the West</strong>) have all walked down our aisle to exchange vows.</p>

													<!-- Image -->
													<table width="150" border="0" align="left" cellpadding="0" cellspacing="0">
													<tr>
														<!-- Chapel 1951 -->
														<td align="right"><img src="images/Chapel1951.jpg" alt="" width="135" height="182" border="1"><img src="images/spacer.gif" alt="" width="15" height="1" border="0"></td>
													</tr>
													</table>
													<p>Originally built as part of the <em>Last Frontier Hotel</em> located on an isolated stretch of highway that would one day become the famous Las Vegas <em>"Strip"</em>, <strong>the Little Church of the West</strong> upholds the heritage of Las Vegas with its unique architecture.  It's a freestanding replica of an old west mining town church.  With an exterior of cedar and an interior of California redwood, the chapel looks much the same today as when it was first built.  It speaks of the early days of Las Vegas when its business district consisted of only the first three blocks of Fremont Street.  As the town grew with the population boom caused by the construction of near by Hoover Dam, Fremont Street began to pulsate with wall-to-wall casinos.  As first class resorts began to dot the desert skyline and big name entertainment lit up the beckoning marquis, the stage was set for <strong>the Little Church of the West</strong> to take its place in the annals of Las Vegas history.</p>

													<p>Attesting to its historical significance, <strong>the Little Church</strong> is listed on the National Registry of Historical Places, the only such place on the <em>"Strip"</em> with this honor.  One of the requirements for inclusion is that the structure retains its original integrity.  <em>"It hasn't changed,"</em> says current owner Greg Smith.  <em>"I mean, there's been some painting and recarpeting but the pews in there are believed to be the ones built with the chapel in 1942."</em>  The four Victorian lamps that light the chapel are believed to be from 19th-century railroad cars but have since been converted from gas to electric.  In 2007, <strong>the Little Church of the West</strong> celebrated its 65th anniversary and remains the oldest existing structure on the Las Vegas <em>"Strip"</em>.</p>

													<table width="193" border="0" align="right" cellpadding="0" cellspacing="0">
													<tr>
														<!-- Chapel in 50's? -->
														<td align="right"><img src="images/ChapelB&W.jpg" alt="" width="158" height="200" border="1"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"><br><br></td>
													</tr>
													</table>
													<p>How did this quaint little wedding chapel stand the test of time and all the facelifts of the Las Vegas Strip?  Simply put, it moved &mdash; 3 times to be exact.  The chapel first moved from its original location on the north side of the Last Frontier Hotel to the south side in 1954.  In 1978, it was moved onto the grounds of the Hacienda Hotel to accommodate the building of the Fashion Show Mall and in 1996, the chapel was moved to its current location on the corner of Russell Road and Las Vegas Blvd to accommodate the building of the Mandalay Bay Hotel & Casino.  Smith says the chapel has been popular because of its historical significance and its unique appearance.  <em>"There's a lot of mystique about the chapel"</em>.</p> 

													<p>The wedding chapel business flourished because of easy marriage laws.  Unlike other places, Nevada did not require a waiting period and there were no requirements for blood tests.  Today, those particular reasons for traveling to Nevada to get married have become less significant as laws in other states have changed, but Smith says those reasons remain significant for people from such countries as Germany which has strict laws governing marriage, adding that last year people from 22 countries were married here.</p>

													<p>For Americans, however, getting married in Las Vegas remains hassle-free, inexpensive, and something to remember.</p>
													
													<div align="center"><a href="javascript:void(0)" onClick="getSample.task.value = 'stock/HistoryOfTheLittleChurch.flv'; document.getElementById('getSample').submit();" class="bodyDarkGray"><strong>Click Here to View Our Chapel History Video</strong></a></div>

												</td>
												<td>
													<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
													<form action="/index/guests/webcam" method="post" name="getSample" id="getSample">
														<input type="hidden" name="task" id="task" value="">
													</form>
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
				</td>
			</tr>
			</table>

			<!-- END Include home.php -->	
