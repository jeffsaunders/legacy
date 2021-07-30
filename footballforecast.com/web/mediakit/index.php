<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?
// Interrogate and reassign passed variables
$page = $_GET['page'];
if ((!$page) || $page == "home") $page = 0;
?>

<html>
<head>
	<title>Football Forecast Weekly Media Kit</title>
	
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

<body bgcolor="#203E4A">

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
					<td align="center" class="bigBlue" style="position:relative;">
						<!--<img src="images/spacer.gif" alt="" width="1" height="12" border="0"><br>-->
						<strong>.: Television Media Kit :.</strong>
						<table border="1" bordercolor="#000000" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<?
							if ($page == 0) {
								echo '
								<!-- Initial Splash Image -->
								<td style="position:relative;"><img src="images/FootballForecastSplash.jpg" alt="Football Forecast Weekly" width="600" height="770" border="0" galleryimg="no"></td>
								';
							}else{
								echo'
								<td style="position:relative;">
									<table width="600" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td rowspan="4" valign="bottom" bgcolor="#45768A"><img src="images/LeftBar.jpg" alt="" width="60" height="770" border="0" galleryimg="no"></td>
										<td bgcolor="#000000"><img src="images/spacer.gif" alt="" width="3" height="88" border="0"></td>
										<td width="537" height="88" background="images/TopBar.jpg">
								';
										if ($page == 1) echo'<div align="right"><strong class="xbigWhite"><font size="+2">Format<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
										if ($page == 2) echo'<div align="right"><strong class="xbigWhite"><font size="+2">Rates and Packages<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
										if ($page == 3) echo'<div align="right"><strong class="xbigWhite"><font size="+2">About Football Forecast Weekly<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
										if ($page == 4) echo'<div align="right"><strong class="xbigWhite"><font size="+2">TSI Media Plan 2006<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
										if ($page == 5) echo'<div align="right"><strong class="xbigWhite"><font size="+2">Contract<img src="images/spacer.gif" alt="" width="15" height="1" border="0"></font></strong></div><br><img src="images/spacer.gif" alt="" width="1" height="18" border="0"><br>';
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
												<td colspan="2" align="center">
													<br><br><strong>TSI Network and TKO Multi-Media</strong><br>
													<em>Presents</em><br><br>
													<strong class="xbigBlack"><font size="+2">Football Forecast Weekly</font></strong>
												</td>
											</tr>
											<tr>
												<td><br><strong>Format: Half hour (28.5 minutes)</strong></td>
												<td>&nbsp;</td>
											</tr>
											<tr class="cellBlack">
												<td align="center" class="xbigWhite"><strong>Segments</strong></td>
												<td align="center" class="xbigWhite"><strong>Length</strong></td>
											</tr>
											<tr class="cellDkGray">
												<td valign="top">
													<strong class="bigBlack"><em>Segment 1:</em></strong>
													<ul>
														<li>Open graphics, title, theme, announce<br>
														<li>Dennis, open tease and intro to segment 1<br>
														<li>1st Commercial Break<br>
													</ul>
												</td>
												<td valign="top">
													<img src="images/spacer.gif" alt="" width="1" height="35" border="0"><br>
													60 Seconds<br>
													5 Minutes<br>
													90 Seconds<br>
												</td>
											</tr>
											<tr class="cellLtGray">
												<td valign="top">
													<strong class="bigBlack"><em>Segment 2:</em></strong>
													<ul>
														<li>College football review and preview<br>
															Guest sports and/or gaming celebrity<br>
														<li>2nd Commercial Break<br>
													</ul>
												</td>
												<td valign="top">
													<img src="images/spacer.gif" alt="" width="1" height="35" border="0"><br>
													6 Minutes<br><br>
													60 Seconds<br>
												</td>
											</tr>
											<tr class="cellDkGray">
												<td valign="top">
													<strong class="bigBlack"><em>Segment 3:</em></strong>
													<ul>
														<li>Professional football review and preview<br>
															Guest sports and/or gaming celebrity<br>
														<li>3rd Commercial Break<br>
													</ul>
												</td>
												<td valign="top">
													<img src="images/spacer.gif" alt="" width="1" height="35" border="0"><br>
													6 Minutes<br><br>
													60 Seconds<br>
												</td>
											</tr>
											<tr class="cellLtGray">
												<td valign="top">
													<strong class="bigBlack"><em>Segment 4:</em></strong>
													<ul>
														<li>Wrap up and tease for next show<br>
														<li>Closing Credits<br>
													</ul>
												</td>
												<td valign="top">
													<img src="images/spacer.gif" alt="" width="1" height="35" border="0"><br>
													6 Minutes<br>
													30 Seconds<br>
												</td>
											</tr>
											<tr class="cellBlack">
												<td>&nbsp;</td>
												<td class="bodyWhite"><strong>Total: 28.5 Minutes</strong></td>
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
													<strong class="xbigBlack"><font size="+2"><br>Sponsorship Package</font></strong><br>
													(4 national sponsorships available)<br><br>
													<ul>
														<li>Twenty (: 20) second opening and closing audio billboards
														<li>Two thirty (: 30) second commercial spots
														<li>Mention and bumper in all segments of the show
														<li>Streaming Video of Football Forecast Weekly TV program will<br>
															also be available on the website at www.FootballForecast.com
														<li>Guest spot appearances available<br>
													</ul>
													<strong>Cost: $35,000</strong><br><br>
													<hr width="500" size="1" noshade><br><br>
													<strong class="xbigBlack"><font size="+2">Commercial Spots</font></strong><br><br>
													<strong>$2,295</strong><br>
													<strong>One (: 30) second commercial spot</strong><br>
													<ul>
														<li>A total of 8 thirty (:30) second commercial spots are available<br>
													</ul>
													<strong>$3,995</strong><br>
													<strong>Two (: 30) second commercial spots</strong><br>
													<ul>
														<em><li>Football Forecast Weekly is offering a special package for advertisers wishing to increase frequency which proves to be more effective.</em><br>
													</ul>
													<strong>$9,500</strong><br>
													<strong>Guest Expert or Handicapping Segments</strong><br>
													<ul>
														<li>Qualified experts in the field of Thoroughbred racing, breeding, and gaming etc. may appear to analyze the races.<br>
														<li>Guest names, company name, and telephone number will appear in the screen during commentary.<br>
														<li>One thirty second (: 30) commercial spot will also be made available.
													</ul>
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
													<br><br>Las Vegas-based <strong><em>Football Forecast Weekly</em></strong> is a fast-paced 30 minute television program that offers sports fans a complete and comprehensive look at the top collegiate and professional football games by one of the most respected and top handicapping analysts in America &mdash; Mr. Dennis Tobler.<br><br>
													Dennis is the founder of TSI Network, considered the top handicapping firm in the nation. Dennis and his father began their award winning theories over 35 years ago and have since developed detailed formulas
for success that has captured the attention of millions of viewers in dozens of television markets across the Country. Viewers are responsive to the information gained from <strong><em>Football Forecast Weekly</em></strong>, consistently beating the odds.<br><br>
													<strong><em>Football Forecast Weekly\'s</em></strong> programming provides sports fans with information they want about the teams they watch which includes insight into what\'s happening on and off the field that makes teams win or lose.<br><br>
													<strong><em>Football Forecast Weekly</em></strong> first appeared in California in 1988 before moving to Las Vegas in 1991. Not only is it the first show of its kind to import Las Vegas style predictions, but lead the way by being named "Best Sports Prediction Television Show" by the Orange County Register in 1993. Mr. Tobler\'s wide network of inside sources both in Las Vegas and "offshore" ensures the viewers receive truly insightful information from a betting perspective.<br><br>
													Dennis and expert guests deal a straight hand in the pros and cons of the game, suggested picks and leaves the final choice to the viewer. <strong><em>Football Forecast Weekly</em></strong> is informative and entertaining with special guests giving sports fans across America the kind of show they love to watch!
												</td>
											</tr>
											</table>
										</td>
									';
								}elseif ($page == 4) {
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
								}elseif ($page == 5) {
									echo'
										<td align="center" valign="top" bgcolor="#FFFFFF">
											<table width="500" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
											<tr>
												<td>
													<br><br><strong class="bodyBlack">Agreement:</strong> this agreement (the "AGREEMENT") is made this _____ day of ______________, 2006 between TSI Network, a Nevada company, located at 7500 West Lake Mead Blvd., Las Vegas, Nevada 89128, (herein referred to as "TSI") and __________________________________ (herein referred to as "CLIENT").<br><br>
													<strong class="bodyBlack">Terms:</strong> the term of this AGREEMENT shall be for a period from__________________ 2006 until____________________________, 2006. This period shall include _________Television Shows.<br><br>
													<strong class="bodyBlack">Representations:</strong> TSI represents and warrants, consistent with the terms hereof, that it shall perform the following functions to wit:<br><br>
													Provide advertisers with pre-designated time in the form of sponsorship and commercials within the format of the nationally syndicated TV show "Football Forecast Weekly".<br><br>
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
													<table border="0" cellspacing="0" cellpadding="0" align="left" class="smallBlack">
													<tr>
														<td valign="top">
															The parties have signed this AGREEMENT on the date set forth below.<br><br>
															Date: ______________________________________________________<br><br>
															Client: _____________________________________________________<br><br>
															By: ________________________________________________________<br><br>
															Address: ___________________________________________________<br><br>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;___________________________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
															By: ________________________________________________________<br><br>
														</td>
														<td valign="bottom">
															<hr width="100%" size="5" color="#000000" noshade>
															<strong>TSI Network\'s<br>
															Football Forecast Weekly<br>
															Television Show</strong><br><br>
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
										<td align="center" bgcolor="#FFFFFF" class="smallBlack"><strong>Page '.$page.' of 5</strong></td>
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
									<td align="left"><a href="?page=home" onmouseover="window.status='Home Page'; return true;" onmouseout="window.status=''; return true;" class="bodyBlue"><strong>Home Page</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<!-- Image Swap Links -->
									<td align="center" class="bodyBlue" style="position:relative;"><a href="?page=<? echo ($page<2)?5:$page-1; ?>" onmouseover="window.status='Previous Page'; return true;" onmouseout="window.status=''; return true;" class="bodyBlue"><strong>&#171;&nbsp;Previous Page</strong></a>&nbsp;|&nbsp;<a href="?page=<? echo ($page>4)?1:$page+1; ?>" onmouseover="window.status='Next Page'; return true;" onmouseout="window.status=''; return true;" class="bodyBlue"><strong>Next Page&nbsp;&#187;</strong></a></td>
									<!-- Link to PDF -->
									<td  align="right" class="bodyBlue" style="position:relative;"><a href="footballforecast.pdf" target="_blank" onmouseover="window.status='Download Printable Version'; return true;" onmouseout="window.status=''; return true;" class="bodyBlue"><strong>Printable Version</strong></a></td>
								</tr>
								<tr>
									<!-- Seperator -->
									<td colspan="3" style="position:relative;"><img src="images/DarkDot.gif" alt="" width="100%" height="1" border="0"></td>
								</tr>
								<tr>
									<!-- Contact Info -->
									<td colspan="3" align="center" class="bodyBlue" style="position:relative;"><strong class="tinyBlue">For More Information Contact:<br></strong><strong>Nikki Murdock &mdash; 702.925.8783 or <a
href="mailto:info@footballforecast.com" class="bodyBlue">info@footballforecast.com</a></strong></td>
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
