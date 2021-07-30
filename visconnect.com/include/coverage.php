<!-- BEGIN Include coverage.php -->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td valign="top">
		<table width="710" border="0" cellspacing="0" cellpadding="0" align="left" bgcolor="#FFFFFF">
		<tr>
			<td><img src="images/CoverageHeader.jpg" alt="" width="710" height="25" border="0"></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" background="images/InfoBG.jpg" style="background-position:top; background-repeat:repeat-y;">
				<img src="images/spacer.gif" alt="" width="1" height="10" border=""><br>
				<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
				<tr>
					<td align="center">
					<?
					// Sprint-Nextel sites
					if ($sprint_site == "T" || $nextel_site == "T" ){
					?>
					<strong><a href="http://coverage.sprintpcs.com/IMPACT.jsp?nobrand&covType=sprint" target="_blank" title="Show Coverage Tool at Full Screen" class="smallBlue">Full Screen</a></strong>
					<iframe src="http://coverage.sprintpcs.com/IMPACT.jsp?nobrand&covType=sprint" name="body" id="body" width="690" height="870" marginwidth="0" marginheight="0" align="top" frameborder="0" allowtransparency="true" scrolling="yes"></iframe>
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

<!-- END Include coverage.php -->
