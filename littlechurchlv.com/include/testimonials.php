			<!-- BEGIN Include testimonials.php -->

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
											<img src='TextIMG.php?text=<?=substr($config2["testimonials_intro"],0,1);?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=substr($config2["testimonials_intro"],0,1);?>" border="0">
										</td>
									</tr>
									</table>
									<?=substr($config2["testimonials_intro"],1);?>
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

					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
<!--
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
					<!-- LV Bride Awards Promo -->
					<table width="220" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td align="center">
							<a href="http://www.lasvegasbride.com/wedding-awards" target="_new" title="Las Vegas Bride - Click Here to Vote For Us!">
							<img src="images/LVBrideAwards.jpg" alt="Las Vegas Bride - Click Here to Vote For Us!" width="218" height="75" border="0">
							</a>
						</td>
					</tr>
					</table>

					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

					<!-- Wedding Wire Promo -->
					<table width="220" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td style="background-color: #FFFFFF; color: #518691; border: 2px dotted #518691; width:215;">
							<a href="http://www.weddingwire.com/shared/Rate?vid=02198bf8687a7c84" target="_new" title="Click Here to Review Us at WeddingWire!" style="color:#518691; font-family:Arial,Helvetica; font-size:16px; font-weight:bold; text-decoration:none;">
							<div id="placeholder" style="padding:5px;">
								<img src="images/comment_edit.gif" alt="" width="16" height="16" border="0">Review<br>
								<div align="right">Little Church of the West<img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br>
								at WeddingWire</div>
							</div>
							</a>
						</td>
					</tr>
					</table>

					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>

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

				<!-- Horizontal Spacer -->
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
											<img src='TextIMG.php?text=<?=$config2["testimonials_title"];?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=450&height=39&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=$config2["testimonials_title"];?>" border="0"><br><br>
										</td>
									</tr>
									<tr>
										<td>
										<?
										// Build query - get all testimonials for selected year
										if (!$task) $task = date("Y");
										$year = $task;
										$query = "SELECT * FROM testimonials WHERE active = 'T' AND YEAR(date) = '".$year."' ORDER BY date DESC, unique_id DESC";
//echo $query;
										// Execute it
										$rs_testimonials = mysql_query($query, $linkID);
										if (mysql_num_rows($rs_testimonials) == 0){ // None found for selected year
										?>
											<br>
											<div align="center"><strong class="bigDarkGray">We're sorry, no testimonials were found for <?=$year;?>.</strong></div>
											<br>
											<hr align="left" width="98%" size="1" noshade style="border-top:1px dashed #000000; margin-bottom:10px;">
										<?
										}else{ // Articles found!
											for ($Counter=1; $Counter <= mysql_num_rows($rs_testimonials); $Counter++){
												$testimonial = mysql_fetch_assoc($rs_testimonials);
										?>
											<table width="100%">
											<tr>
												<td colspan="<?=iif($Counter == 1, "2", "3");?>" class="smBodyDarkGray"><strong><em>&ldquo;<?=$testimonial["text"];?>&rdquo;</em></strong></td>
											</tr>
											<tr>
												<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
												<td width="100%" class="smallDarkGray"><br><strong><?=$testimonial["name"];?><?=iif($testimonial["from"] != "", "<br>".$testimonial["from"], "");?></strong><br><?=date("F Y",strtotime($testimonial["date"]));?></td>
												<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
											</tr>
												<?
												if ($testimonial["reply"] != ""){
												?>
											<tr>
												<td colspan="3" class="smBodyDarkGray"><br><font color="#FF0000">[<?=$testimonial["reply"];?>]</font></td>
											</tr>
												<?
												}
												?>
											<tr>
												<td colspan="3"><br><hr align="left" width="98%" size="1" noshade style="border-top:1px dashed #000000; margin-bottom:10px;"></td>
											</tr>
											</table>
										<?
											}
										}
										//Get the year of the oldest article
										$query = "SELECT * FROM testimonials WHERE active = 'T' ORDER BY date ASC LIMIT 1";
//echo $query;
										// Execute it
										$rs_oldest = mysql_query($query, $linkID);
										$oldest_testimonial = mysql_fetch_assoc($rs_oldest);
										$oldest_year = date("Y", strtotime($oldest_testimonial["date"]));
											?>
											<table width="100%" class="bodyDarkGray">
											<tr>
												<td align="center" class="bigDarkGray"><strong>Testimonials Archive</strong></td>
											</tr>
											<tr>
												<td align="center" class="MenuBurgundy">
													<table border="0" align="center">
													<?
													for ($yearCnt=$oldest_year; $yearCnt <= date("Y"); $yearCnt+=10){
														$cnt = date("Y") - $yearCnt;
														$CounterLimit = iif($cnt > 9, 9, $cnt);
													?>		
													<tr>
													<?
														for ($Counter=0; $Counter <= $CounterLimit; $Counter++){
													?>		
														<td>
															<a href="index/experience/testimonials/<?=$yearCnt+$Counter;?>" class="bodyDarkGray">
																<?=iif(($yearCnt+$Counter)==$year, '<strong class="bodyBurgundy">'.strval($yearCnt+$Counter).'</strong>',$yearCnt+$Counter);?>
															</a>
														</td>
														<?
															if ($Counter < $CounterLimit){
														?>
														<td valign="top" class="bigBurgundy"><strong>&middot;</strong></td>
													<?
															}
														}
													?>
													</tr>
													<?
													}
													?>
													</table>
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

			<!-- END include testimonials.php -->

