<!-- BEGIN INCLUDE roster.php -->

<table border="0" cellspacing="0" cellpadding="10" align="center" bgcolor="#FFFFFF">
<tr>
	<td class="bodyBlack">
		<!-- Logo -->
		<table width="100" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
			<td align="left" style="position:relative;" class="smallBlack"><img src="images/WiseGuysLogoSmall.jpg" alt="" width="100" border="0"></td>
		</tr>
		</table>
		<!-- Image -->
		<table width="170" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr>
			<td align="right" style="position:relative;" class="smallBlack"><img src="images/CarsonsCopperBath.jpg" alt="" width="160" height="213" border="1"><img src="images/spacer.gif" alt="" width="2" height="1" border="0"><br><div align="left"><strong>&nbsp;&nbsp;&nbsp;Carson's Copper in the pool<br>&nbsp;&nbsp;&nbsp;preparing for his return.</strong></div></td>
		</tr>
		</table>
		<!-- Text -->
		<strong class="biggerBlack"><em>Wise Guys Racing Stable &mdash; Current Roster</em></strong><br><br>
		Wise Guys Racing Stable's main goal is for our clients to have fun and experience the excitement of thoroughbred ownership in an affordable manner.<br><br>
		Wise Guys Racing consists of claiming groups along with purchasing of two-year-olds in training and yearlings.&nbsp;&nbsp;Wise Guys will be assembling packages, in the near future, for our clients interested in purchasing yearlings and two-year-olds from Kentucky, Florida and California.<br><br>
<!--		Our company is very confident in our trainer/bloodstock agents David & Grant Hofmans. David & Grant have a proven track record in both fields and are one of the main reasons we are able to offer our clients such a wide range of packages to choose from.  As a client with Wise Guys Racing Stable you will be treated with dignity and respect, you'll be part of a team and we want our owners to always have an open line of communication with us at all times.<br><br>-->
		Our company is very confident in our world-class trainer/bloodstock agents, whose proven track record in both fields is one of the main reasons we are able to offer our clients such a wide range of packages to choose from.&nbsp;&nbsp;As a client with Wise Guys Racing Stable you will be treated with dignity and respect, you'll be part of a team and we want our owners to always have an open line of communication with us at all times.<br><br>
		The thoroughbred racehorse should be revered, these animals are very talented athletes who run their hearts out to bring us a great deal of pleasure, we will <em><strong>not</strong></em> forget that.<br><br>
	<div align="center"><strong class="smallBlack">To become a partner and experience the "Sport of Kings" contact <a href="?sec=contact" class="smallBlack" style="text-decoration:underline">Dennis Tobler</a> for the latest ownership opportunities.</strong></div>
	</td>
</tr>
<?
$query = "SELECT *, UNIX_TIMESTAMP(race_date) as date FROM roster WHERE display = 'T' ORDER BY date_tba DESC, date ASC, horse_name ASC";
$rs_roster = mysql_query($query, $linkID);
?>
<tr align="center">
	<td>
		<table width="780" border="0" cellspacing="0" cellpadding="5" align="center" class="bodyBlack">
		<tr class="cellBlack">
			<td width="1" rowspan="99" class="cellBlack" style="padding:0px;"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td class="bodyWhite"><strong>Horse</strong></td>
			<td class="bodyWhite"><strong>Date</strong></td>
			<td class="bodyWhite"><strong>Track</strong></td>
			<td class="bodyWhite"><strong>Event</strong></td>
			<td class="bodyWhite"><strong>Result</strong></td>
			<td width="1" rowspan="99" class="cellBlack" style="padding:0px;"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
<?
for ($counter=1; $counter <= mysql_num_rows($rs_roster); $counter++){
	$roster = mysql_fetch_assoc($rs_roster);
	$bg_class = iif(is_even($counter),"cellLtGray","cellXLtGray"); //Make background alternating shades of gray
	echo'
		<tr class="'.$bg_class.'">
			<td>'.$roster["horse_name"].' ('.$roster["horse_type"].')</td>
			<td>'.iif($roster["date"] == 0, "TBA", date("m/d/Y", $roster["date"])).'</td>
			<td>'.$roster["race_track"].'</td>
			<td>'.$roster["race_detail"].'</td>
			<td>'.$roster["race_result"].'</td>
		</tr>
	';
}
?>
		<tr class="cellBlack">
			<td colspan="5"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="300" valign="top" class="bodyBlack">
				<table width="302" border="0" cellspacing="0" cellpadding="0" align="center" class="smallBlack">
				<tr class="cellBlack">
					<td height="25" colspan="3" align="center" class="biggerWhite"><strong><em>The Winner's Circle&nbsp;&nbsp;&nbsp;&nbsp;</em></strong><br></td>
				</tr>
				<tr>
					<td rowspan="5" class="cellBlack"><img src="images/spacer.gif" alt="" width="1" height="290" border="0"></td>
					<td class="cellBlack"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"><br></td>
					<td rowspan="5" class="cellBlack"><img src="images/spacer.gif" alt="" width="1" height="290" border="0"></td>
				</tr>
				<tr>
					<td width="300" height="225" valign="top"><a href="images/CarsonsCopperWinnersCircle.jpg" target="_blank"><img src="images/CarsonsCopperWinnersCircleSmall.jpg" alt="Click To Enlarge" title="Click To Enlarge" name="image" id="image" width="300" height="225" border="0" galleryimg="no"></a></td>
				</tr>
				<tr>
					<td class="cellBlack"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"><br></td>
				</tr>
				<tr>
					<td height="65" valign="top" class="cellXLtGray" style="padding:2px;">
						<strong name="caption" id="caption">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="smallBlack">
						<tr>
							<td valign="top">
								Horse: <strong>Carson's Copper</strong><br>
<!--								Owner: <strong>M&S Racing Stable, LLC</strong><br>-->
								Owner: <strong>Wise Guys Racing Stable</strong><br>
								Trainer: <strong>Peter Miller</strong><br>
								Ridden By: <strong>Corey Nakatani</strong>
							</td>
							<td align="right">
								Track: <strong>Del Mar</strong><br>
								Date: <strong>July 27, 2007</strong><br>
								Purse: <strong>$32,000</strong><br>
								Paid: <strong>$15.20&nbsp;&nbsp;$7.20&nbsp;&nbsp;$3.40</strong>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="right">Distance/Time: <strong>6 Furlongs in 1:13:31</strong></td>
						</tr>
						</table>
						</strong>
					</td>
				</tr>
				<tr>
					<td class="cellBlack"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"><br></td>
				</tr>
				</table>
			</td>
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td valign="bottom"><img src="images/LtGrayDot.gif" alt="" width="2" height="325" border="0"></td>
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td width="476" valign="top" class="bodyBlack">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr class="cellBlack">
					<td height="25" align="center"><strong class="biggerWhite"><em>Investment Opportunities</em></strong><br></td>
				</tr>
				<tr class="cellXLtGray">
					<td height="293" valign="top" style="padding:5px; border: 1px solid #000000;" class="bodyBlack">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
						<?
						$query = "SELECT * FROM opportunities WHERE display = 'T' ORDER BY priority ASC";
						$rs_ops = mysql_query($query, $linkID);
						for ($counter=1; $counter <= mysql_num_rows($rs_ops); $counter++){
							$op = mysql_fetch_assoc($rs_ops);
							echo'
						<tr>
							<td><strong>'.$op["headline"].'</strong></td>
						</tr>
						<tr>
							<td>'.$op["body"].'<br><br></td>
						</tr>
							';
						}
						?>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" class="tinyBlack">
						No information on this site should be considered a recommendation or solicitation to invest in a particular security or type of security.
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- END INCLUDE roster.php -->
