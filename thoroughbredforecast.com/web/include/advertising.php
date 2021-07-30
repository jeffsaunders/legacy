<!-- BEGIN INCLUDE advertising.php -->

<table border="0" cellspacing="0" cellpadding="10" align="center" class="bodyBlack">
<tr>
	<td width="530" valign="top">
		<!-- Image -->
<!--		<table width="110" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr>
			<td align="right" style="position:relative;"><img src="images/DishLogo100.gif" alt="Dish Network" width="100" height="78" border="0"></td>
		</tr>
		</table>-->
		<!-- Text -->
		<strong class="biggerBlack"><em>Advertising on Thoroughbred Racing Forecast!</em></strong><br><br>

		<em>Thoroughbred Racing Forecast</em> offers two ways to advertise, depending on your target audience and preference.<br><br>

		<!-- TV -->
		<strong class="biggerBlack">Television Advertising:</strong><br>
		Marketing & Advertising experts estimate the cost of advertising on most television shows to be about 12 Dollars for every 1,000 people reached. At <em>Thoroughbred Racing Forecast</em> the cost is closer to <strong>30 CENTS per 1000 viewers</strong> &mdash; that's almost <strong>40 TIMES below the industry standard.</strong> Imagine reaching your narrowly focused demographic for <strong>only 0.00003&cent; per set of eyes!!</strong><br><br>

		It's all part of our winning philosophy!<br><br>

		Each half hour long TV program consists of four (4) segments and three (3) commercial breaks (2 minutes each). The fourth segment of the show will feature a special Website Segment, that will highlight a variety of sports related websites. The first three (3) segments will feature interviews with trainers, jockeys, owners, and other related businesses plus Dennis Tobler's commentary, all focused on a positive view of thoroughbred horse racing.<br><br>

		<strong>SEGMENT SPONSORSHIPS&nbsp;&nbsp;&mdash;&nbsp;&nbsp;$4,999 per show.</strong><br>
		There are three (3) Segment Sponsorships available for each show. A Sponsorship Package includes:
		<ul>
			<li>Opening graphics page billboard with audio (approximately 20 seconds).</li>
			<li>One (1) sixty second (:60) commercial directly following the Segment.</li>
			<li>The Segment Sponsor's business is the featured subject of the entire Segment. This consists of interviews and actual footage of the Sponsor's business.</li>
		</ul> 

		<strong>COMMERCIAL SPOTS&nbsp;&nbsp;&mdash;&nbsp;&nbsp;$1,499 per show.</strong><br>
		There are six (6) additional sixty (:60) second commercial spots available per show.  These spots may be on any subject (Casinos, Information services, etc.) - they are not limited to horse racing related enterprises.<br><br>

		<strong>WEBSITE SEGMENT PROMOTION&nbsp;&nbsp;&mdash;&nbsp;&nbsp;$2,499 per show.</strong><br>
		Promotional spots for the Website Segment consist of a graphics page, which features the actual Home Page of client's website and any promotional graphics containing site information, special offers, and toll-free telephone numbers with a one (1) minute audio voice-over. This segment is limited to seven (7) promotions per show.<br><br>

		<em class="smallBlack">*PRICES ARE FOR SINGLE SHOWS. DISCOUNTS ARE AVAILABLE WHEN PURCHASING AN ENTIRE SEASON.</em><br><br>
		
		<!-- Website -->
		<strong class="biggerBlack">Website Advertising:</strong><br>
		In addition to television advertising being available within all webcasts of the shows, we offer website banner ads in the following sizes at the following rates:<br><br>
		
		<table width="100%" border="1" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<th align="center">Banner Size</th>
			<th align="center">1 Month</th>
			<th align="center">3 Months</th>
			<th align="center">6 Months</th>
			<th align="center">12 Months</th>
		</tr>
		<tr>
			<td align="center">468 x 60</td>
			<td align="center">$360.00</td>
			<td align="center">$975.00</td>
			<td align="center">$1,890.00</td>
			<td align="center">$3,240.00</td>
		</tr>
		<tr>
			<td align="center">234 x 60</td>
			<td align="center">$200.00</td>
			<td align="center">$540.00</td>
			<td align="center">$1,050.00</td>
			<td align="center">$1,790.00</td>
		</tr>
		</table><br>

		<div align="center"><strong>Web site advertising is FREE with all television air time purchases!</strong></div>
		
	</td>
	<td width="2" valign="bottom" bgcolor="#C0C0C0" style="padding:0px;"></td>
	<td width="230" valign="top" class="smallBlack">
		<div align="center">
		<img src="images/AmericaOneLogo.jpg" alt="America One Network" width="139" height="78" border="0"><br>
		<strong class="biggerBlack"><em>Television Affiliates</em></strong><br><br>
		REACHING OVER 75 MILLION VIEWERS<br>IN OVER 125 CITIES!<br>
		</div>
		<div style="width:230px; height:750px; overflow-x:hidden; overflow-y:scroll;">
		<?
//		$query = "SELECT * FROM affiliates WHERE display = 'T' ORDER BY network, affiliate asc";
//		$rs_affiliates = mysql_query($query, $linkID);
//		$network = "";
//		for ($counter=1; $counter <= mysql_num_rows($rs_affiliates); $counter++){
//			$affiliate = mysql_fetch_assoc($rs_affiliates);
//			if ($affiliate["network"] != $network) {
//				echo'</ul><strong class="bodyBlack"><u>'.$affiliate["network"].'</u></strong><br><ul>';
//				$network = $affiliate["network"];
//			}
//			echo'<li>'.$affiliate["affiliate"].'<br>';
//		}
		$query = "SELECT * FROM affiliates WHERE display = 'T' ORDER BY state, city, affiliate asc";
		$rs_affiliates = mysql_query($query, $linkID);
		$state = "";
		for ($counter=1; $counter <= mysql_num_rows($rs_affiliates); $counter++){
			$affiliate = mysql_fetch_assoc($rs_affiliates);
			if ($affiliate["state"] != $state) {
				echo'<br><strong class="bodyBlack"><u>'.$affiliate["state"].'</u></strong><br>';
				$state = $affiliate["state"];
			}
			echo'<li style="font-size:9pt;">'.$affiliate["affiliate"].', '.$affiliate["city"].'<br>';
		}
		?>
		<br>
		</div>
	</td>
</tr>
</table>

<!-- END INCLUDE advertising.php -->
