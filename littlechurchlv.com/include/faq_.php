<!-- BEGIN INCLUDE faq -->

<?
// connect to the database
include("dbconnect.php");
// Build query
$query = "SELECT * FROM faq	WHERE show_on_site = 'T' ORDER BY position";
// Execute it
$rs_faq = mysql_query($query, $linkID);
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
			<td colspan="3" class="xbigBlack">
				<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
				<strong>Frequently Asked Questions</strong><br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
		</tr>
		<tr>
			<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
			<td>
				<!-- Image -->
				<table width="255" border="0" align="right" cellpadding="0" cellspacing="0">
				<tr>
					<!-- Top Hat -->
					<td align="right"><img src="images/TopHat.jpg" alt="" width="225" height="300" border="1"><img src="images/spacer.gif" alt="" width="15" height="1" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br></td>
				</tr>
				</table>
				<?
				for ($counter=1; $counter <= mysql_num_rows($rs_faq); $counter++){
					$row = mysql_fetch_assoc($rs_faq);
					echo'
					<p><strong>'.$row["question"].'</strong><br>
					'.$row["answer"].'</p>
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

<!-- END INCLUDE faq -->
