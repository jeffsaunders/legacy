<!-- BEGIN INCLUDE home.php -->

<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td>
		<table border="0" cellspacing="0" cellpadding="5" align="center">
		<tr>
<!--			<td width="512" height="200" valign="top" class="bodyBlack">-->
			<td width="760" height="200" valign="top" class="bodyBlack">
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
				<!-- Image -->
				<table width="130" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" style="position:relative;" class="smallBlack"><img src="images/Dennis120.jpg" alt="Dennis Tobler at Santa Anita" width="120" height="160" border="1"><br><strong>Your Host, Dennis Tobler</strong></td>
				</tr>
				</table>
				<!-- Text -->
				<strong class="biggerBlack"><em>Welcome to Thoroughbred Racing Forecast!</em></strong><br><br>
				<strong>Thoroughbred Racing Forecast</strong> is a series of four Nationally Syndicated television specials featuring previews of the BIGGEST RACES in America!<br><br>
				The season premier is the <strong>Kentucky Derby Special</strong>, airing the first weekend in May each year, followed shortly by the <strong>Preakness</strong> and <strong>Belmont Specials</strong>, and finally rounding out the season with the <strong>Breeders Cup Preview</strong> in the Fall.<br><br>
				These programs give the viewer an inside look at these big races, with exclusive interviews from the Track with the Trainers, Jockeys, and Owners...
				<div align="right"><a href="?sec=show" class="bodyBlack"><strong>More &raquo;</strong></a></div>
			</td>
<!--			<td valign="bottom"><img src="images/LtGrayDot.gif" alt="" width="2" height="210" border="0"></td>
			<td width="246" valign="top" class="bodyBlack">
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
				<!-- Image --
				<table width="100" border="0" align="right" cellpadding="0" cellspacing="0">
				<tr>
					<td align="right" style="position:relative;" class="smallBlack"><img src="images/M&SLogo100.jpg" alt="" width="105" border="0"></td>
				</tr>
				</table>
				<!-- Text --
				<strong class="biggerBlack"><em>M&S Racing</em></strong><br><br>M&S Racing Stable is the brainchild of Mitch & Susan Hammons of Aliso Viejo, California.<br><br>The Hammons are uniquely qualified for such a venture; not only are they avid horse racing fans and both excellent handicappers, they also have first-hand experience in every aspect of thoroughbred race horse ownership...<br>
				<div align="right"><a href="?sec=stable" class="bodyBlack"><strong>More &raquo;</strong></a></div>
			</td>-->
		</tr>
		<tr>
<!--			<td align="right"><img src="images/LtGrayDot.gif" alt="" width="497" height="2" border="0"></td>
			<td></td>
			<td align="left"><img src="images/LtGrayDot.gif" alt="" width="233" height="2" border="0"></td>-->
			<td colspan="3" align="center"><img src="images/LtGrayDot.gif" alt="" width="100%" height="2" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td align="right">
		<table border="0" cellspacing="0" cellpadding="8">
		<tr>
			<td width="250" align="right" valign="top">
			<?
			$query = "SELECT *, UNIX_TIMESTAMP(race_date) as date FROM freepicks ORDER BY timestamp desc LIMIT 1";
			$rs_freepick = mysql_query($query, $linkID);
			$pick = mysql_fetch_assoc($rs_freepick);
			?>
				<table width="234" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
				<tr>
					<td rowspan="3" class="cellBlack"><img src="images/spacer.gif" alt="" width="1" height="308" border="0"></td>
					<td align="center" valign="top" class="cellBlack">
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
						<strong class="superWhite">Free Pick!</strong><br>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
					</td>
					<td rowspan="3" class="cellBlack"><img src="images/spacer.gif" alt="" width="1" height="308" border="0"></td>
				</tr>
				<tr>
					<td align="center" valign="top" class="cellLtGray">
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
						&nbsp;Free Selection From:<br>
						<strong class="bodyBlack">
						<? echo $pick["track_name"]; ?><br>
						<? echo date('l, F jS', $pick["date"]); ?><br>
						<? if ($pick["race_name"] != "") echo $pick["race_name"]."<br>"; ?>
						<? if ($pick["race_name"] == "" && $pick["race_num"] != "") echo "Race #".$pick["race_num"]."<br>"; ?>
						<br>
						<table border="0" cellspacing="0" cellpadding="0" align="center" class="bigBlack">
						<tr>
							<td>
								<strong><font color="#FF0000"><?if ($pick["place_name"] != "") echo "1. "?><? echo $pick["win_name"]; ?><? if ($pick["win_num"] != "") echo ' (#'.$pick["win_num"].')'; ?><?if ($pick["place_name"] == "") echo "<br><br>"?></font></strong>
							</td>
						</tr>
						<?
						if ($pick["place_name"] != ""){
						?>
						<tr>
							<td>
								<strong><font color="#FF0000">2. <? echo $pick["place_name"]; ?><? if ($pick["place_num"] != "") echo ' (#'.$pick["place_num"].')'; ?></font></strong>
							</td>
						</tr>
						<?
						}
						if ($pick["show_name"] != ""){
						?>
						<tr>
							<td>
								<strong><font color="#FF0000">3. <? echo $pick["show_name"]; ?><? if ($pick["show_num"] != "") echo ' (#'.$pick["show_num"].')'; ?></font></strong>
							</td>
						</tr>
						<?
						}
						?>
						</table>
						<table border="0" cellspacing="0" cellpadding="0" align="center" class="bigBlack">
						<?
						if ($pick["race_note"] != ""){
						?>
						<tr>
							<td align="center" class="bodyBlack">
								<strong><font color="#FF0000"><? echo $pick["race_note"]; ?></font></strong>
							</td>
						</tr>
						<?
						}
						?>
						</table>
						<br>
						</strong>
						<?echo $pick["note"]; ?><br><br>
						<em class="smallBlack">This free selection is sponsored by<br>
						<strong class="smallBlack"></em><? echo iif($pick["sponsor_link"] != "", "<a href='".$pick["sponsor_link"]."' class='smallBlack'>", "")?><? echo $pick["sponsor"]; ?></a><em class="smallBlack"></strong><br>
						and provided by Top Las Vegas Handicappers each racing day for the races in California or major stakes races around the US.<br></em>
					</td>
				</tr>
				<tr>
					<td class="cellBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
				</tr>
				</table>
			</td>
			<td rowspan="2" valign="top"><img src="images/LtGrayDot.gif" alt="" width="2" height="400" border="0"></td>
			<td width="300" valign="top" class="bodyBlack">
				<table width="302" border="0" cellspacing="0" cellpadding="0" align="center" class="smallBlack">
				<tr>
					<td rowspan="5" class="cellBlack"><img src="images/spacer.gif" alt="" width="1" height="307" border="0"></td>
					<td class="cellBlack"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"><br></td>
					<td rowspan="5" class="cellBlack"><img src="images/spacer.gif" alt="" width="1" height="307" border="0"></td>
				</tr>
				<tr>
					<td width="300" height="225" valign="top"><img src="images/100_0170.jpg" alt="" name="image" id="image" width="300" height="225" border="0"></td>
				</tr>
				<tr>
					<td class="cellBlack"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"><br></td>
				</tr>
				<tr>
					<td height="80" valign="top" class="cellXLtGray" style="padding:2px;"><strong name="caption" id="caption">Dennis Tobler in saddling ring at Santa Anita.</strong></td>
				</tr>
				<tr>
					<td class="cellBlack"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br></td>
				</tr>
				</table>
			</td>
			<td rowspan="2" width="190" valign="top">
				<table border="0" cellspacing="0" cellpadding="0">
				<tr>
<!--					<td align="center"><a onMouseOver="image.src='images/100_1252.jpg';caption.innerHTML='M&S Racing Stable co-founders Dennis Tobler and Mitch Hammons toasting Carson\'s Copper Allowance WIN at Del Mar 7/27/07.';"><img src="images/100_1252.jpg" alt="" width="80" height="60" border="1"></a></td>-->
					<td align="center"><a onMouseOver="image.src='images/scan0001.jpg';caption.innerHTML='The Tobler Family re-acquires Carson\'s Copper on May 7, 2009.';"><img src="images/scan0001.jpg" alt="" width="80" height="60" border="1"></a></td>
					<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
<!--					<td align="center"><a onMouseOver="image.src='images/100_1243.jpg';caption.innerHTML='Owners of Carson\'s Copper celebrate with Champagne and Roses in Del Mar\'s Winners Circle.&nbsp;&nbsp;<em>&quot;As good as it gets!&quot;</em>';"><img src="images/100_1243.jpg" alt="" width="80" height="60" border="1"></a></td>-->
					<td align="center"><a onMouseOver="image.src='images/scan0002.jpg';caption.innerHTML='Dennis Tobler at Fairplex Park in L.A. for Copper\'s race in the <em>Beau Brummel Stakes</em> in 2007.';"><img src="images/scan0002.jpg" alt="" width="80" height="60" border="1"></a></td>
				</tr>
				<tr>
					<td colspan="3"><img src="images/spacer.gif" alt="" width="1" height="20" border="0"></td>
				</tr>
				<tr>
<!--					<td align="center"><a onMouseOver="image.src='images/pix4.jpg';caption.innerHTML='Dennis Tobler and others at Hollywood Park saddling ring.';"><img src="images/pix4.jpg" alt="" width="80" height="60" border="1"></a></td>-->
					<td align="center"><a onMouseOver="image.src='images/100_0170.jpg';caption.innerHTML='Dennis Tobler in saddling ring at Santa Anita.';"><img src="images/100_0170.jpg" alt="" width="80" height="60" border="1"></a></td>
					<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
					<td align="center"><a onMouseOver="image.src='images/pix5.jpg';caption.innerHTML='Dennis Tobler greets the world\'s top jockey, Patrick Valenzuela, before a race at Hollywood Park.';"><img src="images/pix5.jpg" alt="" width="80" height="60" border="1"></a></td>
				</tr>
				<tr>
					<td colspan="3"><img src="images/spacer.gif" alt="" width="1" height="20" border="0"></td>
				</tr>
				<tr>
<!--					<td align="center"><a onMouseOver="image.src='images/pix6.jpg';caption.innerHTML='Dennis Tobler at the Native Diver Monument at Hollywood Park.';"><img src="images/pix6.jpg" alt="" width="80" height="60" border="1"></a></td>-->
					<td align="center"><a onMouseOver="image.src='images/100_1231.jpg';caption.innerHTML='Trainer Peter Miller preparing Carson\'s Copper for his BIG Del Mar victory.';"><img src="images/100_1231.jpg" alt="" width="80" height="60" border="1"></a></td>
					<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
<!--					<td align="center"><a onMouseOver="image.src='images/100_0174.jpg';caption.innerHTML='Indy Weekend on the Derby trail at Santa Anita in 2006.';"><img src="images/100_0174.jpg" alt="" width="80" height="60" border="1"></a></td>-->
<!--					<td align="center"><a onMouseOver="image.src='images/100_1226.jpg';caption.innerHTML='Jockey Cory Nakatani with owners Mitch Hammons and Dennis Tobler.';"><img src="images/100_1226.jpg" alt="" width="80" height="60" border="1"></a></td>-->
					<td align="center"><a onMouseOver="image.src='images/scan0003.jpg';caption.innerHTML='Dennis Tobler with his daughter, Mindi, and Mike Machowsky (in his rookie training year of 1989) with filly <em>Laluna Kite</em>.';"><img src="images/scan0003.jpg" alt="" width="80" height="60" border="1"></a></td>
				</tr>
				<tr>
					<td colspan="3"><img src="images/spacer.gif" alt="" width="1" height="20" border="0"></td>
				</tr>
				<tr>
					<td align="center"><a onMouseOver="image.src='images/100_0195.jpg';caption.innerHTML='Dennis Tobler wishes jockey Tyler Baze a <em>safe trip</em> with other owners looking on.';"><img src="images/100_0195.jpg" alt="" width="80" height="60" border="1"></a></td>
					<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
<!--					<td align="center"><a onMouseOver="image.src='images/100_0197.jpg';caption.innerHTML='Trainer Craig Dollase <em>legs up</em> jockey to Indy Weekend before race at Santa Anita.';"><img src="images/100_0197.jpg" alt="" width="80" height="60" border="1"></a></td>-->
					<td align="center"><a onMouseOver="image.src='images/pix2.jpg';caption.innerHTML='Fellow former Nebraskans Dennis Tobler and Hall-of-Fame Trainer Jack Van Berg, at Santa Anita, sharing stories about the <em>good ol\' days</em> at Ak-Sar-Ben & Fonner Park in Nebraska.';"><img src="images/pix2.jpg" alt="" width="80" height="60" border="1"></a></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="70" align="right" valign="bottom">
<!--				<a href="?sec=stable"><img src="images/banners/M&SStable234.jpg" alt="M&S Racing Stable" width="234" height="60" border="0"></a><br><div align="center" class="smallBlack"><font color="#A0A0A0">&nbsp;&nbsp;&nbsp;&nbsp;- Advertisement -</font></div>-->
				<a href="?sec=stable"><img src="images/banners/WiseGuys234.jpg" alt="Wise Guys Racing Stable" width="234" height="60" border="0"></a><br><div align="center" class="smallBlack"><font color="#A0A0A0">&nbsp;&nbsp;&nbsp;&nbsp;- Advertisement -</font></div>
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
			</td>
			<td height="70" colspan="2" align="center" valign="bottom">
			<?
//			if (is_odd(time())){
				echo '
				<a href="http://www.footballforecast.com" target="_blank"><img src="images/banners/FootballForecast468.jpg" alt="" width="468" height="60" border="1" style="border: 1px solid Black;"></a><br><div align="center" class="smallBlack"><font color="#A0A0A0">- Advertisement -</font></div>
				';
//			}else{
//				echo '
//				<a href="http://www.pacificadelnorte.com" target="_blank"><img src="images/banners/PacificaDelNorte468.gif" alt="" width="468" height="60" border="1" style="border: 1px solid Black;"></a><br><div align="center" class="smallBlack"><font color="#A0A0A0">- Advertisement -</font></div>
//				';
//			}
			?>
<!--				<a href="mailto:info@thoroughbredforecast.com?subject=Carson's Copper Investment&body=Please send me information about investment in Carson's Copper."><img src="images/banners/JockeysBanner468.gif" alt="" width="468" height="60" border="1" style="border: 1px solid Black;"></a><br><div align="center" class="smallBlack"><font color="#A0A0A0">- Advertisement -</font></div>-->
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>


<!-- END INCLUDE home.php -->
