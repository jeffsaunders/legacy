<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?
// Interrogate and reassign passed variables
$site = $_REQUEST['site'];
if ($site != ""){
	$site .= ".".$_REQUEST['domain'];
}else{
	$site = "All IL Sites Combined";
}
?>

<html>
<head>
	<title>CellBenefits.com WebSite Statistics Header</title>

	<style>
		.bodyBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none;}
		A.bodyBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:underline;}
		A.bodyBlack:hover {color:Red; text-decoration:underline;}
		A.bodyBlack:active {color:Red;}
		A.bodyBlack:visited {color:#000000;}
		A.bodyBlack:visited:hover {color:Red; text-decoration:underline;}

		.xbigBlack {font-family:sans-serif; font-size:18px;	color:#000000; text-decoration:none;}
		A.xbigBlack {font-family:sans-serif; font-size:18px; color:#000000; text-decoration:none;}
		A.xbigBlack:hover {color:Red; text-decoration:underline;}
		A.xbigBlack:active {color:Red;}
		A.xbigBlack:visited {color:#000000;}
		A.xbigBlack:visited:hover {color:Red; text-decoration:underline;}
	</style>

</head>

<body>

<table width="100%" border="0" cellspacing="10" cellpadding="0">
<tr>
	<td width="245"><img src="../images/VisionLogo.gif" alt="Vision Wireless" width="245" height="63" border="0"></td>
	<td width="10"><img src="../images/spacer.gif" alt="" width="10" height="1" border="0"></td>
	<td width="550"><strong><font face="sans-serif" size="4">Website Usage Report for<br><a href="http://<? echo $site; ?>" target="_blank" class="xbigBlack" title="Click to visit <? echo $site; ?>"><? echo $site; ?></a><br></font><font face="sans-serif" size="2">(<? echo $_REQUEST['partner']; ?>)</font></strong></td>
	<td align="right" valign="bottom">&nbsp;&nbsp;&raquo; <a href="/admin" target="_top" class="bodyBlack" title="Return To Main Menu"><strong>Return to Menu</strong></a> &laquo;</td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="#C0C0C0"><img src="../images/spacer.gif" alt="" width="1" height="2" border="0"></td>
</tr>
</table>

</body>
</html>
