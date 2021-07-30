<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?
// Interrogate and reassign passed variables
$page = $_GET['page'];
if ((!$page) || $page == "home") $page = 0;
?>

<html>
<head>
	<title>Thoroughbred Racing Forecast Media Kit</title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="en-us">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Sports Television">
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

</head>

<body bgcolor="#AE5A08">

<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td valign="top">
    	<table width="650" border="0" cellpadding="0" cellspacing="0" class="bodyBlue">
		<tr>
			<!-- Top Border -->
			<td colspan="3"><img src="images/DarkDot.gif" alt="" width="650" height="5" border="0"></td>
		</tr>
		<tr>
			<!-- Header -->
			<td background="images/DarkDot.gif"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
			<td style="position:relative;"><img src="images/Header.jpg" width="640" height="100" border="0"></td>
			<td background="images/DarkDot.gif"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
		</tr>
		<tr>
			<!-- Header Bottom Border -->
			<td colspan="3" style="position:relative;"><img src="images/DarkDot.gif" alt="" width="650" height="1" border="0"></td>
		</tr>
		<tr>
			<!-- Left Border -->
			<td background="images/DarkDot.gif"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
			<!-- Main Body -->
			<td valign="top" class="cellFrost">
				<table border="0" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td align="center" class="bigRed" style="position:relative;">
						<!--<img src="images/spacer.gif" alt="" width="1" height="12" border="0"><br>-->
						<strong>.: Television Media Kit :.</strong>
						<table border="1" bordercolor="#000000" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<?
							if ($page == 0) {
								echo '
								<!-- Initial Splash Image -->
								<td style="position:relative;"><img src="images/ThoroughbredForecastSplash.jpg" alt="Thoroughbred Racing Forecast" width="600" height="770" border="0" galleryimg="no"></td>
								';
							}else{
								echo'
								<td style="position:relative;">
									<table width="600" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td rowspan="4" valign="bottom" bgcolor="#E2872E"><img src="images/LeftBar.jpg" alt="" width="60" height="770" border="0" galleryimg="no"></td>
										<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="3" height="88" border="0"></td>
										<td width="537" height="88" background="images/TopBar.jpg">
								';
										if ($page == 1) echo'<div align="right"><strong class="xbigWhite"><font size="+2">Format<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
										if ($page == 2) echo'<div align="right"><strong class="xbigWhite"><font size="+2">Rates and Packages<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
										if ($page == 3) echo'<div align="right"><strong class="xbigWhite"><font size="+2">Promotions and Marketing<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
										if ($page == 4) echo'<div align="right"><strong class="xbigWhite"><font size="+2">About TRF<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
										if ($page == 5) echo'<div align="right"><strong class="xbigWhite"><font size="+2">TSI Media Plan 2006<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
										if ($page == 6) echo'<div align="right"><strong class="xbigWhite"><font size="+2">Contract<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
								echo'
										</td>
									</tr>
									<tr>
										<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="3" height="638" border="0"></td>
								';
								if ($page == 1) {
									echo'
										<td valign="top" bgcolor="#FFFFFF">
											<table width="500" border="0" cellspacing="1" cellpadding="5" align="center" class="bodyBlack">
											<tr>
												<td align="center">
													<br><br><strong>TSI Network and TKO Multi-Media</strong><br>
													<em>Presents</em><br><br>
													<strong class="xbigBlack"><font size="+2">Thoroughbred Racing Forecast</font></strong>
												</td>
											</tr>
											<tr>
												<td><br>Thoroughbred Racing Forecast gives the viewers as much information
on key upcoming thoroughbred horse races in half hour as possible without diluting the quality of the show.<br><br><strong>This show is taped in 4 segments and here is the average format:</strong></td>
											</tr>
											<tr class="cellDkGray">
												<td valign="top">
													<strong class="bigBlack"><em>Segment 1:</em></strong>
													<ul>
														<li>Opening montage<br>
														<li>Open and introductions<br>
														<li>Updated information with Dennis Tobler and Jeff Bloom<br>
														<li>Bumper out with other information and previews<br>
													</ul>
												</td>
											</tr>
											<tr class="cellLtGray">
												<td valign="top">
													<strong class="bigBlack"><em>Segment 2:</em></strong>
													<ul>
														<li>Bumper into segment previewing weeks key races<br>
														<li>Dennis and Trip Mitchell discuss East Coast tracks<br>
														<li>Dennis and Jeff Bloom discuss Midwest tracks<br>
														<li>Bumper out: Weeks televised races<br>
													</ul>
												</td>
											</tr>
											<tr class="cellDkGray">
												<td valign="top">
													<strong class="bigBlack"><em>Segment 3:</em></strong>
													<ul>
														<li>Bumper into segment with updated information<br>
														<li>Dennis and guests discuss West coast tracks with emphasis on California racing<br>
													</ul>
												</td>
											</tr>
											<tr class="cellLtGray">
												<td valign="top">
													<strong class="bigBlack"><em>Segment 4:</em></strong>
													<ul>
														<li>Report from Thom Keith on location with topical interviews<br>
														<li>Highlighted racetrack or event of the week<br>
														<li>Tips and questions answered<br>
														<li>Preview of next week<br>
														<li>Close show-roll credits<br>
													</ul>
												</td>
											</tr>
											</table>
										</td>
									';
								}elseif ($page == 2) {
									echo'
										<td align="center" valign="top" bgcolor="#FFFFFF">
											<table width="500" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
											<tr>
												<td>
													<br><strong class="xbigBlack"><font size="+2"><br>Sponsorship Package</font></strong><br>
													(4 national sponsorships available)<br><br>
													The National Sponsorships are (:30) seconds each in length and will include opening and closing billboards for all four shows.<br><br>
													<strong>Cost: $25,000</strong><br><br>
													<hr width="500" size="1" noshade><br><br>
													<strong class="xbigBlack"><font size="+2">(:30) Second Commercial Spots</font></strong><br><br>
													Commercials are available in 8 spot packages, two spots per show.<br><br>
													Pre-Produced<br>
													<strong>Cost: $4,995*</strong><br><br>
													<em>*Commercial production is available for an additional fee</em><br><br>
													<hr width="500" size="1" noshade><br><br>
													<strong class="xbigBlack"><font size="+2">Bumpers</font></strong><br>
													(Two available)<br><br>
													Bumpers used between segments are used to fill space.<br>
													Most run between :10 and :20 seconds<br>
													Minimum 10 spots<br><br>
													<strong>Cost: $1,500</strong>
												</td>
											</tr>
											</table>
										</td>
									';
								}elseif ($page == 3) {
									echo'
										<td align="center" valign="top" bgcolor="#FFFFFF">
											<table width="500" border="0" cellspacing="0" cellpadding="0" class="bigBlack">
											<tr>
												<td>
													<br><br>Thoroughbred Racing Forecast (TRF) will be promoted and advertised via multi-mediums up to the 2006 Racing Season to achieve the highest visibility possible.<br><br>
													In the individual markets, personalized :10, :20, and :30 second promotional spots will be broadcast on each station to run throughout the season.<br><br>
													Print advertisements will be run in several of the Sports Handicapping Trade publications and Daily Racing Form throughout the duration of the forecast series. Also, local newspapers and magazines will carry advertising.<br><br>
													Audio advertisements will run on all of the popular radio shows, where Mr. Tobler will appear as a special guest. In addition, other guests will promote the show on various media outlets as well.
												</td>
											</tr>
											</table>
										</td>
									';
								}elseif ($page == 4) {
									echo'
										<td align="center" valign="top" bgcolor="#FFFFFF">
											<table width="500" border="0" cellspacing="0" cellpadding="0" class="bODYBlack">
											<tr>
												<td>
													<br><br>This program will feature the nation\'s top thoroughbred racing experts and an
in depth preview of all the upcoming Kentucky Derby, Preakness, Belmont and Breeders Cup races, providing the audience with the only comprehensive analysis available prior to the actual running of these races. The pilot show was so well received we expect a great number of television stations and cable sports channels to carry <strong><em>THOROUGHBRED RACING FORECAST</em></strong>. In addition, the show has drawn interest from as far away as England and Australia by SKY television network. Las Vegas Television Network has contracted for all four shows to air to a National audience. (see enclosed letter for details).<br><br>
													The format of <strong><em>THOROUGHBRED RACING FORECAST</em></strong> is the only one of its kind in the country. It is a preview of upcoming races including in depth coverage from leading analysts. Most shows are only a review of past events and lack the excitement necessary to attract and maintain maximum exposure to the products and services that are advertised.<br><br>
													Longtime Las Vegas TV personality and thoroughbred racehorse owner, Dennis Tobler will host the show along with well known and nationally respected handicappers and offer his views from that perspective. <strong><em>THOROUGHBRED RACING FORECAST</em></strong> will also feature a group of experts such as Jeff Bloom from West Point Racing Syndicate, Mike Curtis, former Southern California trainer and various Las Vegas handicapper and racing personalities.<br><br>
													All in all, <strong><em>THOROUGHBRED RACING FORECAST</em></strong> will promote the great sport of Thoroughbred racing generated from all aspects of the general public.<br><br>
													With the need greater than ever to bring "new blood" into the Thoroughbred business, <strong><em>THOROUGHBRED RACING FORECAST</em></strong> will prove to be the most diverse medium and cost effective way for products and services to be promoted. <strong><em>THOROUGHBRED RACING FORECAST</em></strong> will air to over 40 million viewers in the 2006 Season. Starting with the Kentucky Derby the first show will air May 1, 2006. It will air for five days on various stations nationwide. Just the best in Thoroughbred racing information in an entertaining and informative way, <strong><em>THOROUGHBRED RACING FORECAST</em></strong> is the type of show America loves!
												</td>
											</tr>
											</table>
										</td>
									';
								}elseif ($page == 5) {
									echo'
										<td align="center" valign="top" bgcolor="#FFFFFF">
											<table width="500" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
											<tr>
												<td>
													<br>TKO Media (est. 1965) has entered into a relationship with TSI Network to garner the best possible television saturation for the TSI 2006 schedule of shows.<br><br>
													As of February 1st, TKO has negotiated with a number of broadcasters and cablecasters as well as satellite program providers to create an ad hoc sports gamming network for TSI
programs. These include:
													<ul>
														<li><strong>DirecTV & Dish Net:</strong> These satellite program providers will deliver the TSI programs to their respective subscribers (more than 25 million US households) each week.
														<li><strong>LVTN:</strong> The newly formed Las Vegas Television Network is creating new and exciting TV programs with a Las Vegas spin. TSI shows fit their format like and glove and will be carried via their fledging network in 2006. LVTN operates from its flagship station, KVTE, Channel 35 in Las Vegas. It is obtaining affiliates through the rich nationwide pool of small independent TV stations (VHF, UHF, and LVPT) who will enthusiastically promote the new viewing fare.<br>
															<em>Please note the attached lists of stations and markets that should be carrying the TSI programs as part of the LVTN 2006 line-up.</em>
														<li><strong>LATV:</strong> The Los Angeles Television Network has just premiered in January of 2006 and is acquiring national affiliates quickly. It operates from its flagship station, Kjla-TV in Los Angeles and focuses on larger CATV systems and/or CableTV interconnects to reach millions of viewers. The TSI program formats are particularly attractive to the LATV target demographic.<br>
															<em>Please note attached lists of CATV systems that should be carrying TSI programming via LATV Network this year.</em>
														<li><strong>NEWS NETS:</strong> TKO has arranges for RNN in New York to carry TSI programs starting this year. The Regional News Network (RNN) operates from its flagship TV station WRNN in New York and reaches tens of millions of households via its cast CableTV interconnect.<br>
															<em>Please note attached list of CATV systems slated to carry TSI shows via the Regional News Network in 2006.</em>
														<li><strong>BROADCAST VIEWERSHIP:</strong> Added together, the TSI TV Show Line-Up for 2006 should reach more than 60 million US TV households each week.
														<li><strong>WORLD WIDE WEB:</strong> Of course, TSI achieves and streams all of its TV programming on its website. This means that virtually anyone, anywhere in the world with access to an on-line computer can view TSI programs at any time.
													</ul>
													<em>Complete lists of television stations are available upon request. For more additional information, contact Thom Keith of TKO MultiMedia at (702) 892-9290.</em>
												</td>
											</tr>
											</table>
										</td>
									';
								}elseif ($page == 6) {
									echo'
										<td align="center" valign="top" bgcolor="#FFFFFF">
											<table width="500" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
											<tr>
												<td>
													<br><br><strong class="bodyBlack">Agreement:</strong> this agreement (the "AGREEMENT") is made this _____ day of ______________, 2006 between TSI Network, a Nevada company, located at 7500 West Lake Mead Blvd., Las Vegas, Nevada 89128, (herein referred to as "TSI") and __________________________________ (herein referred to as "CLIENT").<br><br>
													<strong class="bodyBlack">Terms:</strong> the term of this AGREEMENT shall be for a period from__________________ 2006 until____________________________, 2006. This period shall include _________Television Shows.<br><br>
													<strong class="bodyBlack">Representations:</strong> TSI represents and warrants, consistent with the terms hereof, that it shall perform the following functions to wit:<br><br>
													Provide advertisers with pre-designated time in the form of sponsorship and commercials within the format of the nationally syndicated TV show "Thoroughbred Racing Forecast".<br><br>
													Sponsorship will consist of product or service exclusive an exclusive advertising ________________. Said production shall take place on the ____, _____ of ____________, 2006. TSI will supply all materials, individuals and equipment for said TV production. TSI also agrees to film or tape all necessary footage that will be used on future TV projects agreed upon by the CLIENT. TSI shall produce a :60 second commercial to meet the CLIENT\'s approval. Guest spot will be for ____________, with the show airing on the Las Vegas Television Network (see market list attached) starting on _______________, 2006 through_____________, 2006. The shows will air at 10 PM Eastern Time, 9PM Central Time, 8PM Mountain Time, and 7PM Pacific Time.<br><br>
													<strong class="bodyBlack">Fees:</strong> The following fees and payment terms have been established for this AGREEMENT:<br><br>
												</td>
											</tr>
											<tr>
												<td>
													<table border="0" cellspacing="0" cellpadding="0" align="left" class="smallBlack">
													<tr>
														<td valign="top">
															Sponsorships____________________ shows.<br>
															Weekly Guests___________________ shows.<br>
															Bumper Promo Spots______________ minutes/show.<br>
															Commercial Spots (:30) ___________ No. of Spots.
														</td>
														<td>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_________________<br>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_________________<br>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$_________________<br>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$________________<br><br>
															<strong>Total:</strong> $_________________
														</td>
													</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td>
													<strong class="bodyBlack">Payments:</strong> Payments will be structured as follows:<br><br>
													A minimum deposit of thirty-five (35%) percent is required. With payments of $__________________ to be paid on or before (date)____________________, 2006.<br><br>
													<strong class="bodyBlack">Indemnity:</strong> EACH of the parties shall indemnify and hold harmless the other from and against all costs and expenses of any nature whatsoever incurred by the other (including, without limitation, reasonable legal fees in the connection with any litigation or appellate proceeding) as a result of any violation of federal, state or other governmental 1 or regulation by either party: as well as any claim of personal injury, wrongful death or property damage proximately caused by the act or omission of either party or of its respective employees, agents or by the PRODUCT itself.<br><br>
													<strong class="bodyBlack">Entire Agreement:</strong> THIS agreement contains the entire understanding between the parties relating to the matters contained herein and supersedes any and all prior written or verbal understanding.<br><br>
													<strong class="bodyBlack">Construction:</strong> THIS agreement shall be construed under the laws of the State of Nevada.<br><br>
												</td>
											</tr>
											<tr>
												<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left" class="smallBlack">
													<tr>
														<td width="350" valign="top">
															The parties have signed this AGREEMENT on the date set forth below.<br><br>
															Date: _________________________________________________<br><br>
															Client: ________________________________________________<br><br>
															By: ___________________________________________________<br><br>
															Address: ______________________________________________<br><br>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________________________________&nbsp;<br><br>
															By: ___________________________________________________<br><br>
														</td>
														<td valign="bottom">
															<hr width="100%" size="5" color="#000000" noshade>
															<strong>TSI Network\'s<br>
															Thoroughbred Racing Forecast</strong><br><br>
															7500 W. Lake Mead Blvd.<br>
															Las Vegas, NV 89128<br><br>
														</td>
													</tr>
													</table>
												</td>
											</tr>
											</table>
										</td>
									';
								}
								echo'
									</tr>
									<tr>
										<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="3" height= "10" border="0"></td>
										<td align="center" bgcolor="#FFFFFF" class="smallBlack"><strong>Page '.$page.' of 6</strong></td>
									</tr>
									<tr>
										<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="3" height="30" border="0"></td>
										<td><img src="images/BottomBar.jpg" alt="" width="537" height="30" border="0"></td>
									</tr>
									</table>
								</td>
								';
							}
							?>
						</tr>
						</table>

						<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<td>
								<table width="100%">
								<tr>
									<td align="left"><a href="?page=home" onmouseover="window.status='Home Page'; return true;" onmouseout="window.status=''; return true;" class="bodyRed"><strong>Home Page</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<!-- Image Swap Links -->
									<td align="center" class="bodyRed" style="position:relative;"><a href="?page=<? echo ($page<2)?6:$page-1; ?>" onmouseover="window.status='Previous Page'; return true;" onmouseout="window.status=''; return true;" class="bodyRed"><strong>&#171;&nbsp;Previous Page</strong></a>&nbsp;|&nbsp;<a href="?page=<? echo ($page>5)?1:$page+1; ?>" onmouseover="window.status='Next Page'; return true;" onmouseout="window.status=''; return true;" class="bodyRed"><strong>Next Page&nbsp;&#187;</strong></a></td>
									<!-- Link to PDF -->
									<td  align="right" class="bodyRed" style="position:relative;"><a href="thoroughbredracingforecast.pdf" target="_blank" onmouseover="window.status='Download Printable Version'; return true;" onmouseout="window.status=''; return true;" class="bodyRed"><strong>Printable Version</strong></a></td>
								</tr>
								<tr>
									<!-- Seperator -->
									<td colspan="3" style="position:relative;"><img src="images/DarkDot.gif" alt="" width="100%" height="1" border="0"></td>
								</tr>
								<tr>
									<!-- Contact Info -->
									<td colspan="3" align="center" class="bodyRed" style="position:relative;"><strong class="tinyRed">For More Information Contact:<br></strong><strong>Nikki Murdock &mdash; 702.925.8783 or <a
href="mailto:info@thoroughbredracingforecast.com" class="bodyRed">info@thoroughbredracingforecast.com</a></strong></td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
			<!-- Right Border -->
			<td background="images/DarkDot.gif"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
		</tr>
		<tr>
			<!-- Bottom Border -->
			<td colspan="3"><img src="images/DarkDot.gif" alt="" width="650" height="5" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
</table>

</body>
</html>
