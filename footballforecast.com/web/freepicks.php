<?php
session_start();
include_once('includes/config.inc.php');

$query="SELECT * FROM pick WHERE status='free' AND competition='College' ORDER BY `date` DESC";
$result=mysql_query($query);
if($result && mysql_num_rows($result)) {
	$ncaa=mysql_fetch_array($result);
	$ncaa['title']=str_replace('vs','<br />vs<br />',$ncaa['title']);
}

$query="SELECT * FROM pick WHERE status='free' AND competition='NFL' ORDER BY `date` DESC";
$result=mysql_query($query);
if($result && mysql_num_rows($result)) {
	$nfl=mysql_fetch_array($result);
	$nfl['title']=str_replace('vs','<br />vs<br />',$nfl['title']);
}
?>
<html>

<head>
<title>www.footballforecast.com Dennis Tobler's Football Forecast Weekly. Free NFL Picks. Top Point Spread Selection.</title>
<meta name="keywords" content="SPORTS PICKS, free NFL football picks, handicapping, football broadcast, free picks, Sports Gambling, free college football picks, free sports picks, sports betting info, football shows, NFL picks, football forecast weekly, handicapper info, Football">
<meta name="description" content="Dennis Tobler's Football Forecast Weekly, free weekly football picks, NFL Football">
<link href="css/style.css" type="text/css" rel="stylesheet">
<style>
<!--
	td { font-family: Verdana, Arial, Helvetica, sans-serif }
	.bodyline	{ background-color: #FFFFFF; border: 1px #98AAB1 solid; }

	.forumline	{ background-color: #FFFFFF; border: 2px #006699 solid; }

	td.row1	{ background-color: #EFEFEF; }
	p { font-family: Verdana, Arial, Helvetica, sans-serif }
	.postbody { font-size : 12px; line-height: 18px}
-->
</style>
</head>

<body>
<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>



<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdleft.php'); ?>
</td>




<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold; color:#000000">

<div align="center">
	<font color="#990000"><span style="font-size: 14pt">Dennis Tobler's <i>&nbsp;FREE</i>&nbsp; Plays</span></font></div>
<div align="center">
	<font color="#990000">Join one of our WINNING football programs and WIN BIG 
	this season!!</font></div>
<div align="center">
	&nbsp;</div>
<div align="justify">
	You are invited to join in the WINNING! Check out our free plays every week 
	and hit the jackpot this football season. Sign up for one of our winning 
	programs listed at the bottom of this page and your selections will be 
	e-mailed to you the morning of the day of the games or a phone service is 
	also available. Just call our service line and get the selections directly 
	from our staff. Personalized service for serious players is available, 
	featuring consultants with over 21 years of sports gaming experience. <br>
	<br>
	&quot;I have beaten the numbers for over 26 years and I can make you a WINNER 
	this football season&quot;<br>
	<span style="font-size: 6pt">&nbsp;</span></div>
<div align="center">
	<font style="font-size: 15pt"><a href="hc1.php">
	<font color="#0000FF" face="Verdana">CLICK HERE TO <u><i>BUY PLAYS</i></u> 
	FROM DENNIS TOBLER!!</font></a></font></div>
<div align="center">
	&nbsp;</div>
<div align="center">
	<font color="#990000">Dennis Tobler's <u>FREE PLAYS</u> of the Week</font></div>
<div align="center">
	&nbsp;</div>
<div align="center">
	<table border="0" width="100%" cellspacing="1" cellpadding="0" bgcolor="#C0C0C0" id="table1">
		<tr>
			<td colspan="2" bgcolor="#000000">
			<p align="center"><a name="freepick1"></a><font face="Arial" color="#FFFFFF">
			<span class="postbody"><span style="font-size: 14pt">NCAA - Strategy Play of 
			the Week</span></span></font></td>
		</tr>
		<tr>
			<td width="150" style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFFFF" align="center" height="70">
			<span class="postbody">
			<font color="#990000">
			<?php echo $ncaa['title']; ?>
			</font></span></td>
			<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFFFF" align="left" valign="top" height="70">
			<?php echo $ncaa['description'];?>
			</td>
		</tr>
		</table>
	<br>
	<table border="0" width="100%" cellspacing="1" cellpadding="0" bgcolor="#C0C0C0" id="table2">
		<tr>
			<td colspan="2" bgcolor="#000000">
			<p align="center"><span class="postbody">
			<a name="freepick2"></a><font face="Arial" style="font-size: 14pt" color="#FFFFFF">NFL Strategy Play 
			of the Week</font></span></td>
		</tr>
		<tr>
			<td width="150" style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFFFF" align="center" height="70">
			<span class="postbody">
			<font color="#990000">
			<?php echo $nfl['title']; ?>
			</span></td>
			<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFFFF" align="left" valign="top" height="70">
			<?php echo $nfl['description']; ?>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<p><font style="font-size: 15pt"><a href="hc1.php"><font color="#0000FF">
	CLICK HERE TO <u><i>BUY PLAYS</i></u> FROM DENNIS TOBLER!!</font></a></font></div>
</td>




<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1" alt="baseball, free picks, odds, news, lines, scores, handicapping, Free NFL football picks, free college football picks, sports betting info, SPORTS PICKS, Sports Gambling and Sportsbook Information,sports book info, Free Sports Picks, NFL picks, Football, Basketball, Baseball, Gambling, sports betting, handicapping, sports book"><br>
<embed src="sounds/nfl.asf" width="145" height="45" type="video/x-ms-asf" AUTOSTART="true"><br><br>
<? include('tdright.php'); ?>
</td>





</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>
