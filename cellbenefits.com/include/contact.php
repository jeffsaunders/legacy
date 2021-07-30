<!-- BEGIN Include contact.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Contact Information</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
<!--	<td colspan="2" bgcolor="#FFFFFF"><img src="images/spacer.gif" alt="" width="930" height="400" border="0"></td>-->
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<br>
		<table width="850" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td>
				<ul>
				<li>For help with online orders call: <strong><? echo $support_number; ?></strong>
				or email: <a href="mailto:<? echo $support_email; ?>" class="bodyBlack"><strong><? echo $support_email; ?></strong></a><br></li><br>
				
<?
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
?>
	<?
	if ($sprint_discount > 0 || $nextel_discount > 0 ){
	?>
<!--				<li>To request a company sponsored discount be applied to your individual Sprint account, go to: <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>www.sprint-discount.com</strong></a>.<br></li><br>-->
					<li>To request a company sponsored discount be applied to your individual Sprint or Nextel account, please call <strong>800.788.4727</strong>.<br></li><br>

	<?
	}
	?>
				<li>For help with existing Sprint accounts, please call: <strong>888.211.4727</strong><br></li><br>

				<li>Find a Sprint Store or Phone Repair Center <a href="javascript:SpawnChild('http://www.sprintstorelocator.com/sprintLocator/searchForm.jsp','child','800','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here to Find a Sprint Store!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>Here</strong></a></li>
				</ul>
<?
// AT&T sites
}elseif ($cingular_site == "T"){
?>

<!--						<li>To request a company sponsored discount be applied to your individual Sprint account, go to: <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>www.sprint-discount.com</strong></a>.<br></li><br>-->

				<li>For help with existing AT&amp;T (Cingular) accounts, please call: <strong>800.888.7600</strong><br></li><br>

				<li>Find an AT&amp;T Store or Phone Repair Center <a href="javascript:SpawnChild('http://www.wireless.att.com/find-a-store','child','1024','700','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here to Find an AT&T Store!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>Here</strong></a></li>
				</ul>
<?
// Verizon sites
}elseif ($verizon_site == "T"){
?>

<!--						<li>To request a company sponsored discount be applied to your individual Sprint account, go to: <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>www.sprint-discount.com</strong></a>.<br></li><br>-->

				<li>For help with existing Verizon Wireless accounts, please call: <strong>800.922.0204</strong><br></li><br>

				<li>Find a Verizon Wireless Store or Phone Repair Center <a href="javascript:SpawnChild('http://www.verizonwireless.com/b2c/storelocator','child','1024','700','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here to Find an AT&T Store!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>Here</strong></a></li>
				</ul>
<?
}
?>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<!-- END Include contact.php -->

