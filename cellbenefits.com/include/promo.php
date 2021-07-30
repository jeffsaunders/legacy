<!-- BEGIN Include promo.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<!-- Promo Tab -->
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Special Offer</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
<?
if ($sprint_site == "T" || $nextel_site == "T" ){
?>
		<br>
		<table width="900" border="0" cellspacing="0" cellpadding="0" background="images/SprintAirlinePromoBG.jpg" style="background-position:top left; background-repeat:no-repeat;">
		<tr>
			<td width="40"><img src="images/spacer.gif" alt="" width="40" height="1174" border="0"></td>
			<td width="275" valign="top" class="bigPromoWhite">
				<img src="images/spacer.gif" alt="" width="1" height="620" border="0"><br>
				<em>Plus, because you work for <?=$label;?> you get a <strong><font color="#FEE000"><?=round($sprint_discount);?>%</font></strong> discount on eligible Sprint Nextel services.</em><br>
				<em class="bodyPromoWhite">Offer requires two-year subscriber agreement.<br>Discount not available on SimplyEverything Plans or Unlimited BlackBerry promotional offer.<br></em>
			</td>
			<td><img src="images/spacer.gif" alt="" width="1" height="1174" border="0"></td>
		</tr>
		</table>
		<br>
	<?
	if (1==2){
	?>
		<br>
		<table width="900" border="0" cellspacing="0" cellpadding="0" background="images/SprintPromoBG.jpg" style="background-position:top left; background-repeat:no-repeat;">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="1" height="984" border="0"></td>
			<td valign="top">
				<table width="100%" border="0" align="center">
				<tr>
					<td rowspan="99"><img src="images/spacer.gif" alt="" width="30" height="1" border="0"></td>
					<td align="right">
						<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
						<img src="images/SprintAheadLogoForPromo.gif" alt="" width="200" height="60" border="0">
						<img src="images/spacer.gif" alt="" width="35" height="1" border="0">
					</td>
				</tr>
				<tr>
					<td class="xbigWhite">
						<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
						<em style="font-size:60px;">
						The sky is no<br>
						longer the limit.
						</em>
					</td>
				</tr>
				<tr>
					<td class="xbigWhite">
						<em style="font-size:25px;">
						Get a <font color="#F5D52C">FREE</font> Airline Companion ticket<br>
						with activation of new line of service.
						</em>
					</td>
				</tr>
				<tr>
					<td class="xbigWhite">
						<br><br>
						<em style="font-size:20px;">
						<span style="font-size:25px;"><strong><? echo $label; ?></strong> employees &ndash;</span><br>
						receive your <? echo round($sprint_discount); ?>% Sprint discount<br>
						and your <font color="#F5D52C">FREE</font> Airline Companion<br>
						ticket today!
						</em>
					</td>
				</tr>
				<tr>
					<td class="xbigWhite">
						<br>
						<em>
						<font color="#F5D52C">Existing customers:</font> to receive your <? echo round($sprint_discount); ?>% discount<br>
						<a href="javascript:SpawnChild('<? echo $discount_form; ?>','child','790','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="xbigWhite" style="text-decoration:underline;"><strong>click here</strong></a> or visit www.sprint-discount.com.
						</em>
					</td>
				</tr>
				<tr>
					<td class="xbigWhite">
						<br>
						<em>
						For <font color="#F5D52C">featured phones</font> <a href="?sec=home" class="xbigWhite" style="text-decoration:underline;"><strong>click here</strong></a>.
						</em>
					</td>
				</tr>
				</table>
			</td>
			<td><img src="images/spacer.gif" alt="" width="1" height="984" border="0"></td>
		</tr>
		<tr>
<!--			<td colspan="3" class="smallBlack" style="padding: 10px; text-justify: auto;">
				Your voucher will be mailed to you along with all the offer details within the 6-8 weeks after activation.  If you do not receive your voucher or have questions, call the Lifestyle Vacation Incentives Customer Care Center at  1-800-815-4421.-->
			<td colspan="3" align="center">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<img src="images/SprintPromoDisclaimer.jpg" alt="" width="886" border="0">
			</td>
		</tr>
		</table>
		<br>
	<?
	}
	?>
<?
}else if ($cingular_site = "T"){
?>

<?
}else if ($verizon_site = "T"){
?>

<?
}
?>
	</td>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>

</table>

<div id="foo" style="position:absolute; top:-250; z-index:-1; visibility:hidden">
<?
// Load hidden forms for feeding cart.  Encase it in a div to hide it offscreen.
include "include/forms.php";
?>
</div>

<!-- END Include home.php -->
