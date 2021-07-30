<?
// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>CellBenefits.com WebSite Statistics Menu</title>

	<style>
		.smallBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; color:#000000; text-decoration:none;}
		A.smallBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; color:#000000; text-decoration:underline;}
		A.smallBlack:hover {color:Red; text-decoration:underline;}
		A.smallBlack:active {color:Red;}
		A.smallBlack:visited {color:#000000;}
		A.smallBlack:visited:hover {color:Red; text-decoration:underline;}

		.smallWhite {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; color:#FFFFFF; text-decoration:none;}
		A.smallWhite {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; color:#FFFFFF; text-decoration:underline;}
		A.smallWhite:hover {color:Red; text-decoration:underline;}
		A.smallWhite:active {color:Red;}
		A.smallWhite:visited {color:#FFFFFF;}
		A.smallWhite:visited:hover {color:Red; text-decoration:underline;}

		.smallBlue {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; color:#0780C0; text-decoration:none;}
		A.smallBlue {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; color:#0780C0; text-decoration:underline;}
		A.smallBlue:hover {color:Red; text-decoration:underline;}
		A.smallBlue:active {color:Red;}
		A.smallBlue:visited {color:#0780C0;}
		A.smallBlue:visited:hover {color:Red; text-decoration:underline;}

		.bodyBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none;}
		A.bodyBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:underline;}
		A.bodyBlack:hover {color:Red; text-decoration:underline;}
		A.bodyBlack:active {color:Red;}
		A.bodyBlack:visited {color:#000000;}
		A.bodyBlack:visited:hover {color:Red; text-decoration:underline;}

		.bodyWhite {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px;	color:#FFFFFF; text-decoration:none;}
		A.bodyWhite {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px; color:#FFFFFF; text-decoration:underline;}
		A.bodyWhite:hover {color:Red; text-decoration:underline;}
		A.bodyWhite:active {color:Red;}
		A.bodyWhite:visited {color:#FFFFFF;}
		A.bodyWhite:visited:hover {color:Red; text-decoration:underline;}

		.bigBlack {font-family:sans-serif; font-size:14px;	color:#000000; text-decoration:none;}
		A.bigBlack {font-family:sans-serif; font-size:14px; color:#000000; text-decoration:none;}
		A.bigBlack:hover {color:Red; text-decoration:underline;}
		A.bigBlack:active {color:Red;}
		A.bigBlack:visited {color:#000000;}
		A.bigBlack:visited:hover {color:Red; text-decoration:underline;}

		.xbigBlack {font-family:sans-serif; font-size:18px;	color:#000000; text-decoration:none;}
		A.xbigBlack {font-family:sans-serif; font-size:18px; color:#000000; text-decoration:none;}
		A.xbigBlack:hover {color:Red; text-decoration:underline;}
		A.xbigBlack:active {color:Red;}
		A.xbigBlack:visited {color:#000000;}
		A.xbigBlack:visited:hover {color:Red; text-decoration:underline;}
	</style>

	<script language="JavaScript" type="text/javascript">
	function ChangeFrames(url1,url2){
		parent.header.location=url1;
		parent.body.location=url2;
	}
	</script>

</head>

<body>

<?
// Connect to the database
include "../httpdocs/dbconnect.php";
?>
<!--<img src="../images/spacer.gif" alt="" width="1" height="13" border="0"><br>-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
	<td align="center" bgcolor="#CCCCDD" class="xbigBlack"><strong>Select Site</strong></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td colspan="3" bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
	<td style="padding:5px;" bgcolor="#808080"><a href="javascript:ChangeFrames('header.php?site=&domain=&partner=All IL Sites','awstats.pl?config=cellbenefits.com')" title="Domain Wide Usage Report" class="smallWhite"><strong>All Sites (Cumulative)</a></strong></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td colspan="3" bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" height="2" border="0"></td>
</tr>
<?
// Grab site setup information
$result = mysql_query("SELECT * FROM sites WHERE show_stats = 'T' AND active = 'T' ORDER BY partner, site, branding", $linkID);
$partner = "";
for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
	$config = mysql_fetch_assoc($result);
	if ($config['partner'] != $partner){
		echo'
<tr>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
	<td align="center" bgcolor="#CCCCDD" style="padding:5px;" class="bigBlack"><strong>'.$config['partner'].' Sites</strong></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
		';
		$partner = $config['partner'];
	};
?>
<tr>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
<!--	<td><a href="javascript:ChangeFrames('header.php?site=<? echo $config['site']; ?>&domain=<? echo $config['domain']; ?>&partner=<? echo $config['partner']." ".strtoupper($config['branding'])." IL"; ?>','awstats.pl?config=<? echo $config['site'].".".$config['domain']; ?>')" title="<? echo $config['label']." ".strtoupper($config['branding']); ?> IL Usage Report"><img src="../images/<? echo $config['logo']; ?>" alt="<? echo $config['label']." ".strtoupper($config['branding']); ?> IL Usage Report" width="200" height="75" border="0"></a></td>-->
<!--	<td><a href="awstats.pl?config=<? echo $config['site']; ?>.cellbenefits.com" target="body"><img src="../images/<? echo $config['logo']; ?>" alt="<? echo $config['label']; ?> Usage Report" width="200" height="75" border="0"></a></td>-->
	<td style="padding:5px;" bgcolor="<? echo iif($config['branding'] == "sprint", "#FFE100", "#F37D00"); ?>" background="<? echo iif($config['branding'] == "att", "../images/AT&TAdminBG.gif", ""); ?>"><a href="javascript:ChangeFrames('header.php?site=<? echo $config['site']; ?>&domain=<? echo $config['domain']; ?>&partner=<? echo $config['partner']." ".strtoupper($config['branding'])." IL Site"; ?>','awstats.pl?config=<? echo $config['site'].".".$config['domain']; ?>')" title="<? echo $config['label']." ".strtoupper($config['branding']); ?> IL Usage Report" class="<? echo iif($config['branding'] == "sprint", "smallBlack", "smallWhite"); ?>"><strong><? echo $config['site'].".".$config['domain']; ?></strong></a></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td colspan="3" bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" height="2" border="0"></td>
</tr>
<?
};
?>
<tr>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
	<td align="center" bgcolor="#CCCCDD" style="padding:5px;" class="bigBlack"><strong>Visconnect Affinity Sites</strong></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
	<td style="padding:5px;" bgcolor="#FFE100"><a href="javascript:ChangeFrames('header.php?site=apple&domain=visconnect.com&partner=Vision SPRINT IL Affinity Site','awstats.pl?config=apple.visconnect.com')" title="Apple Inc. SPRINT IL Affinity Usage Report" class="smallBlack">apple.visconnect.com</a></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td colspan="3" bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" height="10" border="0"></td>
</tr>
</table>

</body>
</html>
