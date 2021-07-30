<?php
include_once('includes/config.inc.php');

$query="SELECT link.*,category.name as category_name FROM link LEFT JOIN category ON category.id=link.category_id WHERE active=1 ORDER BY category.name ASC, link.name ASC";
$result=mysql_query($query);
?>
<html>

<head>
<title>Dennis Tobler's Football Forecast Weekly</title>
<link href="css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>



<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdleft.php'); ?>
</td>




<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold">

<div align="center">
	<font color="#990000"><span style="font-size: 14pt">Banners - Associated Sites</span></font></div>
<div align="justify">
	&nbsp;</div>
<table border="0" width="100%" cellpadding="0" id="table1" cellspacing="1" bgcolor="#C0C0C0" height="96">
	<tr>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#000000" align="center" height="26">
		<font color="#FFFFFF" style="font-size: 14pt">Sponsored Advertising - 
		Banners</font></td>
	</tr>
	<tr>
		<td width="96%" style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#F7F7F7" align="left" valign="top">
		<p align="center"><br>
		<a href="https://www.footballforecast.com/signup.php">
		<img border="0" src="files/banner.jpg" width="468" height="60"></a><br>
		<br>
		<a href="archives.php">
		<img border="0" src="images/ads/ffwbanner.gif" width="468" height="60"></a></p>
		<p align="center">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,42,0" id="lvwsbanner" width="468" height="60">
<param name="_cx" value="12383">
<param name="_cy" value="1588">
<param name="FlashVars" value>
<param name="Movie" value="ani/cybermight_banner.swf">
<param name="Src" value="ani/cybermight_banner.swf">
<param name="WMode" value="Window">
<param name="Play" value="-1">
<param name="Loop" value="-1">
<param name="Quality" value="High">
<param name="SAlign" value>
<param name="Menu" value="0">
<param name="Base" value>
<param name="AllowScriptAccess" value="always">
<param name="Scale" value="ShowAll">
<param name="DeviceFont" value="0">
<param name="EmbedMovie" value="0">
<param name="BGColor" value="000000">
<param name="SWRemote" value>
<param name="MovieData" value>
<param name="SeamlessTabbing" value="1">
<embed name="lvwsbanner" src="ani/cybermight_banner.swf" menu="false" quality="best" bgcolor="#000000" swLiveConnect="true" width="468" height="60" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
</object>
		</p>
		<p align="center">
		<a target="_blank" href="http://www.spinpalace.com/index.asp?VT=57959136&a=21396&gp=false&clientid=spc&RC=529856757">
		<img border="0" src="images/ads/cabaretclub.jpg" width="468" height="60"></a></p>
		<p align="center">
		<a target="_blank" href="http://derbydreamsstable.com/">
		<img border="0" src="images/ads/derbylarge.jpg" width="468" height="60"></a><br>
&nbsp;</p></td>
		</tr>
	</table>


</td>


<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdright.php'); ?>
</td>



</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>