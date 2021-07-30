<!-- BEGIN INCLUDE testimonials -->

<?
// Build query
if ($task == "all"){
	// Get ALL 
	$query = "SELECT * FROM testimonials WHERE 1 ORDER BY date DESC, unique_id DESC";
}else{
	// Get 13 months' worth
	$query = "SELECT * FROM testimonials WHERE DATE_SUB(CURDATE(),INTERVAL 12 MONTH) <= date ORDER BY date DESC, unique_id DESC";
}
// Execute it
$rs_testimonials = mysql_query($query, $linkID);
?>

<br>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td background="images/900IvoryBGTop.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
<tr>
	<td background="images/900IvoryBGMiddle.gif">



<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Main Body -->
	<td valign="top" class="bodyBlack">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td colspan="3">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="xbigBlack">
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
						<strong>Some Kind Words from Happy Couples and their Families</strong><br>
<!--						<strong>Some Kind Words from Happy Couples</strong><br>-->
						<em class="bodyBlack"><img src="images/spacer.gif" alt="" width="30" height="1" border="0">
						<a href="/index/contact/feedback" class="bodyBlack"><strong>Click Here to leave some of your own!</a></em></strong>
					</td>
				</tr>
				</table>
				<br>
			</td>
		</tr>
		<tr>
			<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
			<td>
				<!-- Image -->
				<table width="230" border="0" align="right" cellpadding="0" cellspacing="0">
				<tr>
					<!-- Cheers -->
					<td align="right"><img src="images/Cheers.jpg" alt="" width="200" height="300" border="1"><img src="images/spacer.gif" alt="" width="15" height="1" border="0"><br><br></td>
				</tr>
				<!-- Promo Links -->
				<tr>
					<td>
						<table width="220" border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<!-- Wedding Wire -->
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
						<tr>
							<!-- LV Bride Awards -->
							<td align="center">
								<br>
								<a href="http://www.lasvegasbride.com/wedding-awards" target="_new" title="Las Vegas Bride - Click Here to Vote For Us!">
								<img src="images/LVBrideAwards.jpg" alt="Las Vegas Bride - Click Here to Vote For Us!" width="218" height="75" border="0">
								</a>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
				<br>
				<?
				for ($counter=1; $counter <= mysql_num_rows($rs_testimonials); $counter++){
					$row = mysql_fetch_assoc($rs_testimonials);
					echo'
					<table class="bodyBlack">
					<tr>
						<td colspan="2"><strong><em>'.$row["text"].'</em></strong></td>
					</tr>
					<tr>
						<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
					';
					if ($row["from"] == ""){
						echo'
						<td width="100%" class="smallBlack"><br><strong>'.$row["name"].'</strong><br>'.date("F Y",strtotime($row["date"])).'</td>
						';
					}else{
						echo'
						<td width="100%" class="smallBlack"><br><strong>'.$row["name"].'<br>'.$row["from"].'</strong><br>'.date("F Y",strtotime($row["date"])).'</td>
						';
					}
					echo'
					</tr>
					';
					if ($row["reply"] != ""){
						echo'
						<tr>
							<td colspan="2"><br><font color="#FF0000">['.$row["reply"].']</font></td>
						</tr>
						';
					}
					echo'
					<tr>
						<td colspan="2"><br><hr align="left" width="98%" size="1" noshade style="border-top:1px dashed #000000; margin-bottom:10px;"></td>
					</tr>
					</table>
					';
				}
				if ($task != "all"){
					echo'
				<a href="/index/experience/testimonials/all" title="Click for all testimonials" class="bodyBlack"><strong>Click Here</strong> to See More Testimonials</a>
					';
				}else{
					echo'
				<a href="/index/experience/testimonials" title="Click for most recent year\'s testimonials" class="bodyBlack"><strong>Click Here</strong> to See The Most Recent Year\'s Testimonials</a>
					';
				}
				?>
			</td>
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
		</table>
	</td>
</tr>
</table>
	

	</td>
</tr>
<tr>
	<td background="images/900IvoryBGBottom.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
</table>

<!-- END INCLUDE testimonials -->
