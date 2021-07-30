<!-- BEGIN Include coverage.php -->

<table width="780" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Label Tab -->
	<td height="24" colspan="3" background="images/TabTop.gif" class="bodyWhite">
		<strong>&nbsp;&nbsp;T-Mobile Coverage</strong>
	</td>
</tr>
<script>
// If the browser is IE, give them a link to spawn a seperate window for T-Mobile's coverage map
// An IE bug prevents it from properly working inside an iframe
var agt=navigator.userAgent.toLowerCase();
if (agt.indexOf("msie") != -1){
	document.writeln('	<tr>');
	document.writeln('		<td colspan="3" align="center" bgcolor="#E20074" class="bodyWhite">*Note - If you are experiencing difficulty proceeding beyond this page, particularily if you are using Microsoft Internet Explorer, <strong><a href="#" onClick="SpawnChild(\'http://compass.t-mobile.com\',\'child\',\'925\',\'575\',\'yes\',\'\',\'\',\'\',\'\',\'1\',\'1\',\'1\',\'1\',\'1\'); return false;" target="_blank" class="bodyWhite">Click HERE</a>.</strong></td>');
	document.writeln('	</tr>');
	//	alert("ie");
};
</script>
<tr>
	<!-- Left border -->
	<td width="2" bgcolor="#E20074">
		<img src="images/spacer.gif" alt="" width="2" height="2" border="0">
	</td>
	<!-- Content -->
	<td align="center" bgcolor="#FFFFFF">
		<iframe src="http://compass.t-mobile.com" name="this" id="this" width="921" height="610" marginwidth="0" marginheight="0" align="top" frameborder="0" allowtransparency="false"></iframe>
	</td>
	<!-- Right border -->
	<td width="2" bgcolor="#E20074">
		<img src="images/spacer.gif" alt="" width="2" height="2" border="0">
	</td>
</tr>
<tr>
	<!-- iframe footer -->
	<td width="100%" height="15" colspan="3" bgcolor="#E20074" class="smallWhite">
		<img src="images/spacer.gif" alt="" width="1" height="15" border="0">
	</td>
</tr>
</table>

<!-- END Include coverage.php -->	