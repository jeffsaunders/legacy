<!-- BEGIN Include rebates.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Rebates</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<br>
		<table width="850" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td>
				<strong>Rebate Center</strong><br><br>
				<ul>
<?
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
	if ($site == "apple"){
?>
					<li>Apple Employees receive special discounted pricing - <strong>NO Rebates Required!</strong></li><br><br>
<?	
	}else{
?>
					<li>For Sprint-Nextel rebate terms &amp; conditions Click Here: <a href="javascript:newwin=window.open('http://www.nextel.com/en/promotions/mailInRebate.shtml?id9=vanity:rebates','','scrollbars=yes,width=800,height=450,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Sprint-Nextel Rebate Terms</a><br></li><br>
					<li>For the current Sprint-Nextel rebate form Click Here: <a href="images/pdf/SprintNextelCurrentRebate.pdf" target="_blank" class="bodyBlack" style="text-decoration:underline;">Current Sprint-Nextel Rebate Form</a><br></li><br>
					<li>For the most recently expired Sprint-Nextel rebate form Click Here: <a href="images/pdf/SprintNextelPreviousRebate.pdf" target="_blank" class="bodyBlack" style="text-decoration:underline;">Previous Sprint-Nextel Rebate Form</a><br></li><br>
					<li>To check on the status of your rebate Click Here: <a href="http://www.sprintrebates.com" target="_blank" class="bodyBlack" style="text-decoration:underline;">Sprint-Nextel Rebate Status</a><br></li><br>
		<?
		if ($pricing_level == 2){
		?>
					<li>For the <? echo $rebate_label; ?> $50 Mail-In rebate form Click Here: <a href="http://www.<? echo $domain; ?>/images/pdf/<? echo $vision_rebate; ?>" target="_blank" class="bodyBlack" style="text-decoration:underline;"><? echo $rebate_label; ?> Rebate Form</a></li><br>
		<?
		}
		?>
		<?
		if ($pricing_level == 3){
		?>
					<li>For the <? echo $rebate_label; ?> $100 Mail-In rebate form Click Here: <a href="http://www.<? echo $domain; ?>/images/pdf/<? echo $vision_rebate; ?>" target="_blank" class="bodyBlack" style="text-decoration:underline;"><? echo $rebate_label; ?> Rebate Form</a></li><br>
		<?
		}
		?>
		<?
		if ($pricing_level == 4){
		?>
					<li>For the <? echo $rebate_label; ?> $60 Mail-In rebate form Click Here: <a href="http://www.<? echo $domain; ?>/images/pdf/<? echo $vision_rebate; ?>" target="_blank" class="bodyBlack" style="text-decoration:underline;"><? echo $rebate_label; ?> Rebate Form</a></li><br>
		<?
		}
	}
		?>
<?
// AT&T sites
}elseif ($cingular_site == "T"){
?>
<!--					<li>For AT&T Wireless rebate terms &amp; conditions Click Here: <a href="javascript:newwin=window.open('','','scrollbars=yes,width=800,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">AT&T Wireless Rebate Terms</a><br></li><br>-->
<!--					<li>For the current AT&T Wireless rebate form Click Here: <a href="images/pdf/ATTCurrentRebate.pdf" target="_blank" class="bodyBlack" style="text-decoration:underline;">Current AT&T Wireless Rebate Form</a><br></li><br>-->
<!--					<li>For the most recently expired AT&T Wireless rebate form Click Here: <a href="images/pdf/ATTPreviousRebate.pdf" target="_blank" class="bodyBlack" style="text-decoration:underline;">Previous AT&T Wireless Rebate Form</a><br></li><br>-->
					<li>For AT&T Wireless rebate information for phones purchased after 7/31/08, Click Here: <a href="http://www.wireless.att.com/cell-phone-service/sharedSegments/MIR-disclosure.jsp?MIRurl=/global/MEDIA_CustomProductCatalog/MIR_NAT_Device_092008_EN.pdf" target="_blank" class="bodyBlack" style="text-decoration:underline;">AT&T Wireless Rebate Information</a><br></li><br>
<!--					<li>For the AT&T Wireless rebate form for phones purchased between 6/16/08 and 7/31/08, Click Here: <a href="images/pdf/ATTCurrentRebate.pdf" target="_blank" class="bodyBlack" style="text-decoration:underline;">AT&T Wireless Rebate Form</a><br></li><br>-->
					<li>The check the status of your AT&T Wireless rebate(s) Click Here: <a href="javascript:newwin=window.open('https://www.web-rebates.com/ATT/Default.asp','','scrollbars=yes,width=700,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">AT&amp;T Wireless Rebate Status</a><br></li><br>
<!--					<li>There are currently no rebates available.<br></li><br>-->
	<?
	if ($pricing_level == 2){
	?>
					<li>For the Vision Wireless $50 Mail-In rebate form Click Here: <a href="http://www.<? echo $domain; ?>/images/pdf/<? echo $vision_rebate; ?>" target="_blank" class="bodyBlack" style="text-decoration:underline;">Vision Wireless Rebate Form</a><br></li><br>
		<?
//					<li>There are currently no rebates available.</li><br><br>
	}
	?>
<?
// Verizon sites
}elseif ($verizon_site == "T"){
?>
<!--					<li>The check the status of your Verizon rebate(s) Click Here: <a href="javascript:newwin=window.open('URL','','scrollbars=yes,width=700,height=600,center');newwin.focus();" class="bodyBlack" style="text-decoration:underline;">Verizon Rebate Status</a><br></li><br>-->
	<?
	if ($pricing_level == 2){
	?>
					<li>For the <? echo $rebate_label; ?> $50 Mail-In rebate form Click Here: <a href="http://www.<? echo $domain; ?>/images/pdf/<? echo $vision_rebate; ?>" target="_blank" class="bodyBlack" style="text-decoration:underline;"><? echo $rebate_label; ?> Rebate Form</a></li><br><br>
	<?
	}else{
	?>
					<li>There are currently no rebates available.</li><br><br>
	<?
	}
	?>
<?
}
?>
				</ul>
			</td>
		</tr>
		</table>
	</td>
</tr>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<!-- END Include rebates.php -->
