<?php
include_once('includes/config.inc.php');

$query="SELECT link.*,category.name as category_name FROM link LEFT JOIN category ON category.id=link.category_id WHERE active=1 ORDER BY category.name ASC, link.name ASC";
$result=mysql_query($query);
?>
<html>

<head>
<title>www.footballforecast.com Free College Football Picks - Free NFL NCAA Picks - Free Weekly Football Video - Football analysis</title>
<meta name="keywords" content="Free NFL NCAA Picks, free college football picks, forecast weekly, free picks, handicapper info, SPORTS PICKS, Sports Gambling, free NFL football picks broadcast, sports betting info shows, Free Sports Picks, handicapping">
<meta name="description" content="Free College Football Picks, Free Weekly Football Video, Free NFL NCAA picks, Football Analysis">
<link href="css/style.css" type="text/css" rel="stylesheet">
</head>

<body>

<!-- Free College Football Picks, Free NFL NCAA Picks, Free Weekly Football Video, Football Analysis -->

<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>



<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1" alt="Free College Football Picks, Free NFL NCAA Picks, Free Weekly Football Video, Football Analysis"><br>
<? include('tdleft.php'); ?>
</td>




<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold">

<div align="center">
	<font color="#FFFFEE"><span style="font-size: 0.1pt; font-weight: 400">free 
	college football picks, free NFL NCAA Picks, Free Weekly Football Video</span></font><font color="#990000"><span style="font-size: 14pt"><br>
	Banners - Associated Sites</span></font></div>
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
		<a href="https://secure.nr.net/footballforecast/signup.php">
		<img border="0" src="files/banner.jpg" width="468" height="60" alt="free college football picks, free NFL NCAA picks"></a><br>
		<br>
<!--
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
		<br><br>
-->
		<a target="_blank" href="http://sportsplayersclub.com">
		<img border="0" src="images/banners/bannerspc4.gif" width="468" height="60" alt="free college football picks, football analysis, free NFL NCAA picks, free football video"></a><br><br><a href="archives.php">
		<img border="0" src="images/ads/ffwbanner.gif" width="468" height="60" alt="free weekly football video, free college football picks, football analysis, free NFL NCAA picks"></a></p>
		<p align="center">
		<a target="_blank" href="http://www.spinpalace.com/index.asp?VT=57959136&a=21396&gp=false&clientid=spc&RC=529856757">
		<img border="0" src="images/ads/cabaretclub.jpg" width="468" height="60"></a></p>
		<p align="center">
		<a target="_blank" href="http://derbydreamsstable.com/">
		<img border="0" src="images/ads/derbylarge.jpg" width="468" height="60" alt="free college football picks, free NFL NCAA picks, football analysis, free weekly football video"></a></p>
		<p align="center">
		<br>
		<br>
		<font color="#F7F7F5"><span style="font-size: 0.1pt; font-weight: 400">
		free college football picks, football analysis, free NFL NCAA picks</span></font><br>
&nbsp;</p></td>
		</tr>
	</table>


</td>


<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1" alt="free college football picks, free NFL NCAA picks, free football analysis"><br>
<? include('tdright.php'); ?>
</td>



</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>