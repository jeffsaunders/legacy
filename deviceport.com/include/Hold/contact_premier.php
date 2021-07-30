<!-- BEGIN Include contact_premier.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align="center" bgcolor="<? echo $content_bgcolor; ?>">
	
	<!-- Step Label -->
		
		<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
		<table width="900" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="superbigBlack">Contact Information</td>
		</tr>
		</table>
		<table width="850" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td>
				<br><br>




<? if ($site == "premier"){ ?>





				<strong><u>Premier Wireless Solutions</u></strong><br><br>
				<ul>
					<li>1225 Pear Avenue, Suite 100<br>Mountain View, CA &nbsp;94043<br>Phone: <strong>650.230.2000</strong><br>Fax: <strong>650.230.2001</strong><br><a href="javascript:SpawnChild('http://www.pws.bz','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here To Visit PWS!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>www.pws.bz</strong></a><br></li><br>
					<br>
					<li>For help with online orders call: <strong><? echo $support_phone; ?></strong> or email: <a href="mailto:<? echo $support_email; ?>" class="bodyBlack"><? echo $support_email; ?></strong></a><br></li><br>
				</ul>
				

				
				
				
<?} if ($site == "aircell"){ ?>





				<strong><u>Aircell LLC</u></strong><br><br>
				<ul>
					<li>1172 Century Drive, Suite 280<br>Louisville, CO&nbsp; 80027<br>Phone: <strong>303.379.0200</strong><br>Fax: <strong>303.379.0201</strong><br><a href="javascript:SpawnChild('http://www.aircell.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here To Visit Aircell!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>www.aircell.com</strong></a><br></li><br>
					<br>
					<li>For help with online orders call: <strong><? echo $support_phone; ?></strong> or email: <a href="mailto:<? echo $support_email; ?>" class="bodyBlack"><? echo $support_email; ?></strong></a><br></li><br>
				</ul>
				

<?}?>				
				

<?
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
?>
				<br><strong><u>Sprint-Nextel</u></strong><br><br>
				<ul>
					<li>To request a company sponsored discount be applied to your individual Sprint account, go to: <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>www.sprint-discount.com</strong></a>.<br></li><br>
					<li>For help with existing Sprint accounts, please call: <strong>888.211.4727</strong><br></li><br>
					<li>Find a Sprint Store or Phone Repair Center <a href="http://www.sprintstorelocator.com/sprintLocator/searchForm.jsp" target="_blank"onmouseover=" window.status='Click Here to Find a Sprint Store!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>Here</strong></a></li>
				</ul>
<?
}
// AT&T sites
if ($cingular_site == "T"){
?>
				<br><strong><u>AT&amp;T Wireless</u></strong><br><br>
				<ul>
					<li>For help with existing AT&amp;T (Cingular) accounts, please call: <strong>800.331.0500</strong><br></li><br>
					<li>Find an AT&amp;T Store or Phone Repair Center <a href="http://www.wireless.att.com/find-a-store" target="_blank"onmouseover=" window.status='Click Here to Find an AT&T Store!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>Here</strong></a></li>
				</ul>
<?
}
// Verizon sites
if ($verizon_site == "T"){
?>
				<br><strong><u>Verizon Wireless</u></strong><br><br>
				<ul>
					<li>For help with existing Verizon Wireless accounts, please call: <strong>800.922.0204</strong><br></li><br>
					<li>Find a Verizon Wireless Store or Phone Repair Center <a href="http://www.verizonwireless.com/b2c/storelocator/index.jsp" target="_blank"onmouseover=" window.status='Click Here to Find a Verizon Wireless Store!'; return true" onmouseout="window.status=''; return true" class="bodyBlack"><strong>Here</strong></a></li>
				</ul>
<?
}
?>
			</td>
		</tr>
		</table>
		<br>
	</td>
</tr>
</table>

<!-- END Include contact_premier.php -->
