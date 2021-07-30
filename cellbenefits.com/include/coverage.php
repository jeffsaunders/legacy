<!-- BEGIN Include coverage.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Coverage</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
<?
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
?>
		<iframe src="http://coverage.sprintpcs.com/IMPACT.jsp?nobrand&covType=sprint" name="body" id="body" width="930" height="750" marginwidth="0" marginheight="0" align="top" frameborder="0" allowtransparency="true" scrolling="yes"></iframe>
<?
// AT&T sites
}elseif ($cingular_site == "T"){
?>
		<br>
		<iframe src="http://www.wireless.att.com/coverageviewer/" name="body" id="body" width="890" height="765" marginwidth="0" marginheight="0" align="top" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
		<br><br>
<?
// Verizon sites
}elseif ($verizon_site == "T"){
?>
		<br>
		<iframe src="http://vzwmap.verizonwireless.com/dotcom/coveragelocator/Default.aspx?requesttype=NEWREQUEST" name="body" id="body" width="750" height="800" marginwidth="0" marginheight="0" align="top" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
		<br><br>
<?
}
?>
	</td>
</tr>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<!-- END Include coverage.php -->

