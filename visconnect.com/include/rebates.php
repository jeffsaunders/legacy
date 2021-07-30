<!-- BEGIN Include rebates.php -->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td valign="top">
		<table width="710" border="0" cellspacing="0" cellpadding="0" align="left" bgcolor="#FFFFFF">
		<tr>
			<td><img src="images/RebatesHeader.jpg" alt="" width="710" height="25" border="0"></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" background="images/InfoBG.jpg" style="background-position:top; background-repeat:repeat-y;">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
				<tr>
					<td>
						<?
						// Sprint-Nextel sites
						if ($sprint_site == "T" || $nextel_site == "T" ){
						?>
<!--											<li>For Sprint-Nextel rebate terms &amp; conditions Click Here: <a href="javascript:newwin=window.open('http://www.nextel.com/en/promotions/mailInRebate.shtml?id16=rebate_terms','','scrollbars=yes,width=650,height=450,center');newwin.focus();" title="Sprint's Rebate Terms & Conditions" class="bodyBlue">Sprint-Nextel Rebate Terms</a><br></li>-->
							<?
							if ($sprint_site == "T"){
							?>
<!--											<br><li>For Sprint the rebate form Click Here: <a href="images/pdf/SprintNextelCurrentRebate.pdf" target="_blank" title="Sprint Rebate Form in Adobe Acrobat Format" class="bodyBlue">Sprint Rebate Form</a><br></li>-->
							<?
							}
							?>
							<?
							if ($nextel_site == "T"){
							?>
<!--											<br><li>For Nextel the rebate form Click Here: <a href="images/pdf/SprintNextelCurrentRebate.pdf" target="_blank" title="Nextel Rebate Form in Adobe Acrobat Format" class="bodyBlue">Nextel Rebate Form</a><br></li>-->
							<?
							}
							?>
<!--											<br><li>To check on the status of your rebate Click Here: <a href="http://www.sprintrebates.com" target="_blank" title="Sprint's Rebate Center" class="bodyBlue">Sprint-Nextel Rebate Status</a><br></li>-->
							<?
							if ($pricing_level == 2 || $pricing_level == 6){
							?>
											<br><li>For the <? echo $rebate_label; ?> $50 Mail-In rebate form Click Here: <a href="http://www.<? echo $domain; ?>/images/pdf/<? echo $vision_rebate; ?>" target="_blank" title="Vision Wireless Rebate Form in Adobe Acrobat Format" class="bodyBlue"><? echo $rebate_label; ?> Rebate Form</a></li>
							<?
							}
							?>
							<?
							if ($pricing_level == 3){
							?>
											<li>For the <? echo $rebate_label; ?> $100 Mail-In rebate form Click Here: <a href="http://www.<? echo $domain; ?>/images/pdf/<? echo $vision_rebate; ?>" target="_blank" title="Vision Wireless Rebate Form in Adobe Acrobat Format" class="bodyBlue"><? echo $rebate_label; ?> Rebate Form</a></li>
							<?
							}
							?>
							<?
							if ($pricing_level == 4){
							?>
<!--											<li>For the <? echo $rebate_label; ?> $60 Mail-In rebate form Click Here: <a href="http://www.<? echo $domain; ?>/images/pdf/<? echo $vision_rebate; ?>" target="_blank" title="Convergence Rebate Form in Adobe Acrobat Format" class="bodyBlue"><? echo $rebate_label; ?> Rebate Form</a></li>-->
							<?
							}
							?>
							<?
							if ($pricing_level == 5){
							?>
											Your price already reflects all mail-in rebate amounts discounted instantly.  No Mail-in Rebate Forms are Required!
											<? if($gift_card > 0) echo '<br><br>Your American Express Gift Card will be mailed automatically 30 days after your device is activated - no forms to fill out!'; ?>
							<?
							}
							?>
						<?
						}
						?>
					</td>
					<td align="right" valign="top"><a href="http://www.adobe.com/products/acrobat/readstep2.html" target="_blank"><img src="images/AcrobatButton.gif" alt="Download the Latest Adobe Reader" title="Download the Latest Adobe Reader" width="90" height="22" border="0"></a></td>
				</tr>
				<tr>
					<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="15" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><img src="images/InfoFooter.jpg" alt="" width="710" height="10" border="0"></td>
		</tr>
		</table>					
	</td>
</tr>
</table>

<!-- END Include rebates.php -->
