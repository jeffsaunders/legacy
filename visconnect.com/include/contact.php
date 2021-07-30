<!-- BEGIN Include contact.php -->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td valign="top">
		<table width="710" border="0" cellspacing="0" cellpadding="0" align="left" bgcolor="#FFFFFF">
		<tr>
			<td><img src="images/ContactHeader.jpg" alt="" width="710" height="25" border="0"></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" background="images/InfoBG.jpg" style="background-position:top; background-repeat:repeat-y;">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
				<tr>
					<td>
						<li>For help with online orders call: <strong><? echo $support_number; ?></strong>
						or email: <a href="mailto:<? echo $support_email; ?>" title="Email Us" class="bodyBlue"><strong><? echo $support_email; ?></strong></a>.<br></li><br>
						
						<?
						// Sprint-Nextel sites
						if ($sprint_site == "T" || $nextel_site == "T" ){
						?>
							<?
							if ($sprint_discount > 0 || $nextel_discount > 0 ){
							?>
						<li>Already a Sprint customer?&nbsp;&nbsp;To request your <? echo round($sprint_discount); ?>% company sponsored discount for your Sprint account, <a href="<? echo$_SERVER['REQUEST_URI']; ?>#top" onclick="show('Discount')" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" title="Sprint's Corporate Discount Center" class="bodyBlue"><strong>Click Here</strong></a>.<br></li><br>
		
							<?
							}
							?>
						<li>For help with existing Sprint accounts, please call: <strong>888.211.4727.</strong><br></li><br>
		
						<li>Find a Sprint Store or Phone Repair Center <a href="javascript:SpawnChild('http://www.sprintstorelocator.com/sprintLocator/searchForm.jsp','child','800','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here to Find a Sprint Store!'; return true" onmouseout="window.status=''; return true" title="Sprint Store Locator" class="bodyBlue"><strong>Here</strong></a>.<br></li>
						<?
						}
						?>
					</td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
		</tr>
		<tr>
			<td><img src="images/InfoFooter.jpg" alt="" width="710" height="10" border="0"></td>
		</tr>
		</table>					
	</td>
</tr>
</table>

<!-- END Include contact.php -->
