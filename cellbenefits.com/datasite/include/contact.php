<!-- BEGIN Include contact.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Contact Information</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="850" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td>
				<br>
				<ul>
				<li>For help with online orders call: <strong>877.351.1658</strong>
				or email: <a href="mailto:support@deviceport.com" class="bodyBlack">support@deviceport.com</strong></a><br></li><br>
<?
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
?>
				<br><strong><u>Sprint-Nextel</u></strong><br><br>

				<li>To request a company sponsored discount be applied to your individual Sprint account, go to: <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>www.sprint-discount.com</strong></a>.<br></li><br>

				<li>For help with existing Sprint accounts, please call: <strong>888.211.4727</strong><br></li><br>

				<li>Find a Sprint Store or Phone Repair Center <a href="http://www.sprintstorelocator.com/sprintLocator/searchForm.jsp" target="_blank"onmouseover=" window.status='Click Here to Find a Sprint Store!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>Here</strong></a></li>
<?
}
// AT&T sites
if ($cingular_site == "T"){
?>
				<br><br><br><strong><u>AT&amp;T</u></strong><br><br>
				
				<li>For help with existing AT&amp;T (Cingular) accounts, please call: <strong>800.888.7600</strong><br></li><br>

				<li>Find an AT&amp;T Store or Phone Repair Center <a href="http://www.wireless.att.com/find-a-store" target="_blank"onmouseover=" window.status='Click Here to Find an AT&T Store!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>Here</strong></a></li>
<?
}
// Verizon sites
if ($verizon_site == "T"){
?>
				<br><br><br><strong><u>Verizon Wireless</u></strong><br><br>

				<li>For help with existing Verizon Wireless accounts, please call: <strong>800.922.0204</strong><br></li><br>

				<li>Find a Verizon Wireless Store or Phone Repair Center <a href="http://www.verizonwireless.com/b2c/storelocator/index.jsp" target="_blank"onmouseover=" window.status='Click Here to Find a Verizon Wireless Store!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>Here</strong></a></li>
<?
}
?>
				</ul>
			</td>
		</tr>
		</table>
		<br>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<!-- END Include contact.php -->
