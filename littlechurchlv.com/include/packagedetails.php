			<!-- BEGIN include packages.php -->

			<?
			// Grab packages & bullet points
			if ($feature == "wedding"){$type = "Wedding"; $intro = $config2["wedding_intro"];}
			if ($feature == "renewal"){$type = "Renewal"; $intro = $config2["renewal_intro"];}
			if ($feature == "featured"){$type = "Featured"; $intro = $config2["featured_intro"];}
//			if ($feature == "wedding") $type = "Wedding";
//			if ($feature == "renewal") $type = "Renewal";
//			if ($feature == "featured") $type = "Featured";
			$query = "SELECT * FROM packages WHERE package_type = '".$type."' AND package_name = '".addslashes($task)."' AND (package_expires = '0000-00-00' OR package_expires >= NOW()) AND display = 'T';";
//echo $query;
			$rs_package = mysql_query($query, $linkID2) or die(mysql_error());
			$package = mysql_fetch_assoc($rs_package);
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
											<img src='TextIMG.php?text=<?=substr($config2["package_intro"],0,1);?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=substr($config2["package_intro"],0,1);?>" border="0">
										</td>
									</tr>
									</table>
									<?=substr($config2["package_intro"],1);?>
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

					<?
					if ($package["special"] != ""){
					?>
					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					<!-- Special -->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/225WhiteBGTop.gif"><img src="images/Ribbons225x20.png" alt="" width="225" height="20" border="0"></td>
					</tr>
					<tr>
						<td background="images/225WhiteBGMiddle.gif">
							<table width="200" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyDarkGray">
							<tr>
								<td>
									<?=$package["special"];?>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/225WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>
					<?
					}
					?>

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

				<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
				<td valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/665WhiteBGTop.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
					</tr>
					<tr>
						<td background="images/665WhiteBGMiddle.gif">
						<?
//						$package = mysql_fetch_assoc($rs_package);
						?>
							<table width="620" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td width="620" height="50" background="images/TexturedBar.png" style="background-position:top right;">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="545">
											<img src='TextIMG.php?text=<?=str_replace("'", "&rsquo;", $package["package_name"]);?>&font=CACCHAMP.TTF&bold=yes&points=30&txtcolor=F8F6E8&shadow=000000&offset=2&width=500&height=50&left=15&top=37&angle=0&bgcolor=770025&transparent=yes&format=png' alt="Forever True" width="500" height="50" border="0">
										</td>
										<td width="75" height="50" align="center"><img src="images/Rings50.png" alt="" width="40" height="40" border="0"></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="smBodyDarkGray">

								<?
								if ($package["song_list"] != ""){
									$query = "SELECT * FROM songs WHERE display = 'T'";
//echo $query;
									$rs_songs = mysql_query($query, $linkID2) or die(mysql_error());
//									$aSongs = explode($package["song_list"], ",");

//unset($users); // Just to be sure
//while($users[] = mysql_fetch_row);
//array_pop($users); // Drop the last entry which is FALSE

//									for ($songCounter=0; $songCounter <= count($aSongs); $songCounter++){
//										$song = mysql_fetch_assoc($rs_songs);
									for ($songCounter=0; $songCounter <= mysql_num_rows($rs_songs); $songCounter++){
    $users[$songCounter]=mysql_fetch_row($rs_songs);
}
//print_r($users);

								?>
<!--							<div id="MusicListContainer" style="position:relative; align:left; z-index:0; display:block;"> 
								<div id="MusicListDiv" style="position:absolute; top:25; left:75; width:600px; z-index:2; background-color:#770025; border:thin solid #700C0C; visibility:hidden; display:none;">-->
							<div id="MusicListContainer" style="position:relative; align:left; z-index:0; display:block;"> 
								<div id="MusicListDiv" style="position:absolute; top:25; left:10; width:600px; z-index:2; visibility:hidden; display:none;">
									<table width="600" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
									<tr>
										<td background="images/600BurgundyBGTop.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;"><img src="images/spacer.gif" alt="" width="600" height="20" border="0"></td>
									</tr>
									<tr>
										<td bgcolor="#770025" background="images/600BurgundyBGMiddle.png" valign="top">
											<table width="590" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="25"><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
<!--												<td align="left" valign="bottom" class="xbigWhite"><trong>Featured Song List</strong></td>-->
												<td align="left" valign="bottom" class="xbigWhite">
									<img src='TextIMG.php?text=Featured Song List&font=CACCHAMP.TTF&bold=yes&points=28&txtcolor=FFFFFF&shadow=000000&offset=2&width=300&height=40&left=0&top=25&angle=0&bgcolor=770025&transparent=yes&dropcap=yes&format=png' alt="Featured Song List" border="0">
												<td align="right">
													<a onclick="hide('MusicListDiv');" onMouseOver="this.style.cursor='pointer';" class="smallIvory">
													<img src="images/CloseButton.gif" alt="" width="25" height="24" border="0"><br>Close<br>
													</a>
												</td>
												<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
											</tr>
											</table>
										</td>
									</tr>
<!--									</table>
									<table width="100%" border="0" cellpadding="0" align="center" class="bodyWhite">-->
									<tr>
										<td bgcolor="#770025" background="images/600BurgundyBGMiddle.png" valign="top" class="bodyWhite">
											<div align="center"><hr width="560" size="1" color="#FFFFFF" noshade></div>
											<ul>
												<li><em>Cannon in D</em> by Pachelbel<br>
												<li><em>Prelude in C Major</em> by Bach<br>
												<li><em>Ave Maria</em> by Schubert or Gounod<br>
												<li><em>Love Me Tender</em> by Elvis Presely<br>
												<li><em>I Left My Heart in San Francisco</em> by Tony Bennett<br>
												<li><em>Viva Las Vegas</em> by Elvis Presely<br>
												<li><em>Moonlight Serenade</em> by Glenn Miller<br>
												<li><em>Aire in G String</em> by Johann Sebastian Bach<br>
												<li><em>Can You Feel The Love Tonight</em> by Elton John & Tim Rice<br>
													<img src="images/spacer.gif" alt="" width="20" height="1" border="0"><span class="smallWhite">&mdash;<img src="images/spacer.gif" alt="" width="5" height="1" border="0">From the Motion Picture <em>The Lion King</em></span><br>
												<li><em>Beauty and the Beast</em> by Angela Lansbury<br>
													<img src="images/spacer.gif" alt="" width="20" height="1" border="0"><span class="smallWhite">&mdash;<img src="images/spacer.gif" alt="" width="5" height="1" border="0">From the Motion Picture <em>Beauty and the Beast</em></span><br>
												<li><em>Someday My Prince Will Come</em> by Adriana Caselotti<br>
													<img src="images/spacer.gif" alt="" width="20" height="1" border="0"><span class="smallWhite">&mdash;<img src="images/spacer.gif" alt="" width="5" height="1" border="0">From the Motion Picture <em>Snow White</em></span><br>
												<li><em>Smoke Gets In Your Eyes</em> by The Platters<br>
												<li><em>Pie Jesu</em> by Tommaso da Celano - Requiem Mass<br>
												<li><em>Music of the Night</em> by Andrew Lloyd-Webber<br>
													<img src="images/spacer.gif" alt="" width="20" height="1" border="0"><span class="smallWhite">&mdash;<img src="images/spacer.gif" alt="" width="5" height="1" border="0">From the Stage Show and Motion Picture <em>Phantom of the Opera</em></span><br>
												<li><em>Think of Me</em> by Andrew Lloyd-Webber<br>
													<img src="images/spacer.gif" alt="" width="20" height="1" border="0"><span class="smallWhite">&mdash;<img src="images/spacer.gif" alt="" width="5" height="1" border="0">From the Stage Show and Motion Picture <em>Phantom of the Opera</em></span><br>
												<li><em>All I Ask of You</em> by Andrew Lloyd-Webber<br>
													<img src="images/spacer.gif" alt="" width="20" height="1" border="0"><span class="smallWhite">&mdash;<img src="images/spacer.gif" alt="" width="5" height="1" border="0">From the Stage Show and Motion Picture <em>Phantom of the Opera</em></span><br>
												<li><em>The Rose</em> by Bette Midler<br>
													<img src="images/spacer.gif" alt="" width="20" height="1" border="0"><span class="smallWhite">&mdash;<img src="images/spacer.gif" alt="" width="5" height="1" border="0">From the Motion Picture <em>The Rose</em></span><br>
												<li><em>Wonderful Tonight</em> by Eric Clapton<br>
												<li><em>Take My Breath Away</em> by Berlin<br>
													<img src="images/spacer.gif" alt="" width="20" height="1" border="0"><span class="smallWhite">&mdash;<img src="images/spacer.gif" alt="" width="5" height="1" border="0">From the Motion Picture <em>Top Gun</em></span><br>
												<li><strong><em>Or request that "Special" song - it's your choice!</em></strong>
											</ul>
<!--											<div align="center"><hr width="560" size="1" color="#FFFFFF" noshade></div>
											<div align="right"><a onclick="hide('MusicListDiv');" onMouseOver="this.style.cursor='pointer';"><strong>Close</strong></a><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></div>-->
										</td>
									</tr>
									<tr>
										<td background="images/600BurgundyBGBottom.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;"><img src="images/spacer.gif" alt="" width="600" height="20" border="0"></td>
									</tr>
									</table>
								</div>
							</div>


<!--
<div align="center" id="WebcamChoice" style="position:absolute; top:300; z-index:10; width:525; align:center; display:none; visibility:hidden;">
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td background="images/600BurgundyBGTop.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">&nbsp;</td>
</tr>
<tr>
	<td bgcolor="#770025" background="images/600BurgundyBGMiddle.png" valign="top">
		<table width="550" border="0" cellspacing="5" cellpadding="0" align="center">
		<tr>
			<td valign="top" class="xbigWhite"><strong>The Little Church of the West Chapel Webcam</strong></td>
			<td align="right">
				<a href="javascript:void(0)" onclick="hide('WebcamChoice')" class="smallWhite"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"><br>Close<br></a>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" class="bigWhite">
				We recently changed our video streaming format.  Weddings that took place after May 10 use the new format.  Please select the appropriate choice below:<br><br>
			</td>
		</tr>
		<tr>
			<td colspan="2" valign="top" class="bigWhite">
				<ul>
					<li><a href="index/guests/webcam0" class="bigWhite"><strong>Click Here if the wedding took place before May 10.</strong></a></li>
					<li><a href="index/guests/webcam" class="bigWhite"><strong>Click Here if the wedding took place on or after May 10.</strong></a></li>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td background="images/600BurgundyBGBottom.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">&nbsp;</td>
</tr>
</table>
-->




									<?
									}
									?>
									<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
									<table width="210" border="0" cellspacing="0" cellpadding="0" align="right">
									<tr>
										<td align="right">
											<img src="images/<?=$package["image"];?>" alt="" width="200" border="1"><br>
<!--											<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>-->
										</td>
									</tr>
<!--									<tr>
										<td>
											<table align="center">
											<tr>
												<td><img src="images/Acrobat20x20.jpg" alt="" width="20" height="20" border="0"></td>
												<td><a href="images/LittleChurchBrochure2010.pdf" title="Download Our Brochure" target="_blank" class="bodyDarkGray">Download Brochure</a></td>
											</tr>
											</table>
										</td>
									</tr>-->
									</table>
									<br>
									<!-- DropCap Image -->
									<table border="0" cellspacing="0" cellpadding="0" align="left">
									<tr>
										<td>
											<img src='TextIMG.php?text=<?=substr($package["description"],0,1);?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=substr($config2["package_intro"],0,1);?>" border="0">
										</td>
									</tr>
									</table>
									<span class="bodyDarkGray"><?=substr($package["description"],1);?><br><br>
									Amenities include:</span>
									<ul>
									<?
									$query = "SELECT * FROM package_bullets WHERE package_number = '".$package["package_number"]."' AND display = 'T' ORDER BY position";
//echo $query;
									$rs_bullets = mysql_query($query, $linkID2) or die(mysql_error());
									for ($bulletCounter=1; $bulletCounter <= mysql_num_rows($rs_bullets); $bulletCounter++){
										$bullet = mysql_fetch_assoc($rs_bullets);
										//Test position value for having a remainder - if it does, indent it
										//(if it's floor exactly equals it's value, then it's whole, if not then it to be indented)
										if (floor($bullet["position"]) == $bullet["position"]){ 
									?>
										<li><?=$bullet["text"];?></li>
									<?
										}else{ //Not whole number, indent
									?>
										<ul>
											<li><?=$bullet["text"];?></li>
										</ul>
									<?
										}
									}
									?>
									<br>
									<?
									if ($bulletCounter > 5){
									?>
									<table width="210" border="0" cellspacing="0" cellpadding="0" align="right">
									<tr>
										<td align="right">
											<a href="index/reservations" title="Reserve <?=$package["package_name"];?> Package"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btn<?=$packageCounter+10;?>b" id="btn<?=$packageCounter+10;?>b" width="200" height="35" border="0" onMouseOver="this.src='images/Buttons/Reserve-On.png'" onMouseOut="this.src='images/Buttons/Reserve-Off.png'" onMouseLeave="this.src='images/Buttons/Reserve-Off.png'"></a>
<!--											<a href="index/reservations" onMouseOver="imgOn('btn<?=$packageCounter+10;?>b');" onMouseOut="imgOff('btn<?=$packageCounter+10;?>b')" onMouseLeave="imgOff('btn<?=$packageCounter+10;?>b')" title="Reserve <?=$package["package_name"];?> Package"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btn<?=$packageCounter+10;?>b" id="btn<?=$packageCounter+10;?>b" width="200" height="35" border="0"></a>-->
<!--											<a href="https://secure.nr.net/littlechurchlv/index/reservations" onMouseOver="imgOn('btn<?=$packageCounter+10;?>b');" onMouseOut="imgOff('btn<?=$packageCounter+10;?>b')" onMouseLeave="imgOff('btn<?=$packageCounter+10;?>b')" title="Reserve <?=$package["package_name"];?> Package"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btn<?=$packageCounter+10;?>b" id="btn<?=$packageCounter+10;?>b" width="200" height="35" border="0"></a>-->
										</td>
									</tr>
									</table>
<!--									<strong class="bigDarkGray">$<?=number_format($package["price"], 2, '.', ',');?> + Minister's Fee</strong>&nbsp;<strong><em class="smallDarkGray">(A $<?=number_format($package["minister_fee"], 0, '.', ',');?> cash fee is required)</em></strong><br><br>-->
									<strong class="bigDarkGray">$<?=number_format($package["price"], 2, '.', ',');?> + Minister's Fee</strong><br><strong><em class="smallDarkGray">*A $<?=number_format($package["minister_fee"], 0, '.', ',');?> cash fee ($<?=number_format($package["minister_fee"]+$config2["french_minister_surcharge"], 0, '.', ',');?> for French Speaking Minister) is required</em></strong><br><br>
									<em class="smallDarkGray"><?=$package["disclaimer"];?></em>
									<?
									}else{
									?>
<!--									<strong class="bigDarkGray">$<?=number_format($package["price"], 2, '.', ',');?> + Minister's Fee</strong>&nbsp;<strong><em class="smallDarkGray">(A $<?=number_format($package["minister_fee"], 0, '.', ',');?> cash fee is required)</em></strong><br><br>-->
									<strong class="bigDarkGray">$<?=number_format($package["price"], 2, '.', ',');?> + Minister's Fee</strong><br><strong><em class="smallDarkGray">*A $<?=number_format($package["minister_fee"], 0, '.', ',');?> cash fee ($<?=number_format($package["minister_fee"]+$config2["french_minister_surcharge"], 0, '.', ',');?> for French Speaking Minister) is required</em></strong><br><br>
									<table width="235" border="0" cellspacing="0" cellpadding="0" align="left">
									<tr>
										<td align="right">
											<a href="index/reservations" title="Reserve <?=$package["package_name"];?> Package"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btn<?=$packageCounter+10;?>b" id="btn<?=$packageCounter+10;?>b" width="200" height="35" border="0" onMouseOver="this.src='images/Buttons/Reserve-On.png'" onMouseOut="this.src='images/Buttons/Reserve-Off.png'" onMouseLeave="this.src='images/Buttons/Reserve-Off.png'"></a>
<!--											<a href="index/reservations" onMouseOver="imgOn('btn<?=$packageCounter+10;?>b');" onMouseOut="imgOff('btn<?=$packageCounter+10;?>b')" onMouseLeave="imgOff('btn<?=$packageCounter+10;?>b')" title="Reserve <?=$package["package_name"];?> Package"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btn<?=$packageCounter+10;?>b" id="btn<?=$packageCounter+10;?>b" width="200" height="35" border="0"></a>-->
<!--											<a href="https://secure.nr.net/littlechurchlv/index/reservations" onMouseOver="imgOn('btn<?=$packageCounter+10;?>b');" onMouseOut="imgOff('btn<?=$packageCounter+10;?>b')" onMouseLeave="imgOff('btn<?=$packageCounter+10;?>b')" title="Reserve <?=$package["package_name"];?> Package"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btn<?=$packageCounter+10;?>b" id="btn<?=$packageCounter+10;?>b" width="200" height="35" border="0"></a>-->
										</td>
									</tr>
									</table>
									<br><br><br>
									<em class="smallDarkGray"><?=$package["disclaimer"];?></em>
									<?
									}
									?>
									<?
									if ($package["note"] != ""){
									?>
									<br><br>
									<em class="smallDarkGray"><?=$package["note"];?></em>
									<?
									}
									?>
									</ul>






					
<!-- Maybe put recommended upgrades/options here -->

									<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
									<div align="center"><img src="images/SeperatorBar.png" alt="" width="575" height="15" border="0"></div>							
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

