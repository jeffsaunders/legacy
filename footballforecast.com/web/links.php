<?php
include_once('includes/config.inc.php');

$query="SELECT link.*,category.name as category_name FROM link LEFT JOIN category ON category.id=link.category_id WHERE active=1 ORDER BY category.name ASC, link.name ASC";
$result=mysql_query($query);
?>
<html>

<head>
<title>www.footballforecast.com Football Handicappers - NFL - Football Picks</title>
<meta name="keywords" content="football broadcast, NFL picks, sports betting info, free college football picks, free picks, Football, SPORTS PICKS, handicapping, football shows, Free NFL football picks, handicapper info, football forecast weekly, Free Sports Picks, Sports Gambling">
<meta name="description" content="Football handicappers, NFL, football picks, Dennis Tobler's Football Forecast Weekly">
<link href="css/style.css" type="text/css" rel="stylesheet">
</head>

<body>

<!-- Football Handicappers, NFL, Football Picks -->
<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>



<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1" alt="Football handicappers, football picks, NFL"><br>
<? include('tdleft.php'); ?>
</td>




<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold">

<div align="center">
	<font color="#990000"><span style="font-size: 14pt">Links<br>
	<img border="0" src="images/linkslarge.jpg" width="178" height="97" alt="Football Handicappers, NFL, Football Picks"></span></font><div>
		<hr color="#C0C0C0" size="5"><p align="justify"><font face="Verdana"><font color="#FFFFFF">
		<span style="font-weight: 700; background-color: #000000">Link Exchange 
		Details:</span></font><span style="font-weight: 400"><br>
		Please use our quick </span>
		<a href="https://www.footballforecast.com/linkex_inquiry.php">link 
		exchange form</a><span style="font-weight: 400"> to post your link with 
		us. Your link will be approved and added to our links pages once we find 
		a reciprocal link back to our site from your site.</span></font></div>
	<div>
		<p align="justify"><font face="Verdana"><font color="#FFFFFF"><b>
		<span style="background-color: #000000">Here is how our must appear:</span></b></font><font color="#B90000"><b><br>
		TITLE:<span style="font-weight: 400"> </span></b></font>
		<span style="font-weight: 400">Dennis Tobler's Football Forecast Weekly</span><br>
		<b><font color="#B90000">DESCRIPTION:<span style="font-weight: 400">
		</span></font></b><span style="font-weight: 400">Streaming video direct 
		from Las Vegas. Football Forecast Weekly TV program offers the fans 
		winning free plays as well as a complete comprehensive look at each week 
		at the top collegiate &amp; NFL games.</span><br>
		<font color="#B90000"><b>URL: </b></font>
		<a href="http://www.footballforecast.com/">
		http://www.footballforecast.com</a><font size="2"><br>
		</font><font color="#666666" style="font-size: 9pt">
		<span style="font-weight: 400">(Please note that this must be a direct 
		url link - no scripting redirects or other tricks to obtain inbound 
		links)<br>
&nbsp;</span></font></font></div><hr color="#C0C0C0" size="5">
		
</div>
<div align="justify">
	&nbsp;</div>
<table border="0" width="100%" cellpadding="3" id="table2" cellspacing="1" bgcolor="#C0C0C0" height="103">
	<tr>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#000000" align="center" colspan="2">
		<font color="#FFFFFF"><span style="font-size: 14pt">Exchanged Links and 
		Affiliations</span></font></td>
		</tr>


	<tr>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center">
		<p align="left">
		<font color="#990000">Cybermight<span style="font-size: 5pt"> LLC</span><br>
		Programming - Web Development - SEO</font></td>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center">
		<a target="_blank" href="http://www.cybermight.com">Click 
		Here to Visit</a></td>
		</tr>
	<tr>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center" colspan="2" height="58">
		<p align="justify"><font face="Verdana">
		<span style="font-size: 8pt; font-weight: 400">Our services are 
		Programming, Web Development, Search Engine Optimization, Network and 
		Web site planning, design, professional deployment, powerful web 
		marketing, efficient maintenance and follow-up success guidance. From 
		local to global developments, we offer all you need for your successful 
		business presence, utilizing 19 years of Network and Internet experience 
		for you. </span></font></td>
		</tr>


	<tr>
		<td colspan="2" height="10" >
		</td>
		</tr>
	<tr>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center">
		<p align="left">
		<font color="#990000">What's On, The Las Vegas Guide<img border="0" src="images/transparent.gif" width="1" height="1" alt="football picks, football handicappers, NFL"><br>
		The Summerlin 
		Magazine, The Henderson Magazine</font></td>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center">
		<a target="_blank" href="http://www.ilovevegas.com">Click 
		Here to Visit</a></td>
		</tr>
	<tr>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center" colspan="2" height="58">
		<p align="justify"><font face="Verdana">
		<span style="font-size: 8pt; font-weight: 400">What's On, The Las Vegas 
		Guide is dedicated to providing visitors with a comprehensive, colorful 
		magazine about Las Vegas and surrounding areas in an interesting and 
		informative format. We produce work of such high quality that it 
		challenges the standards of the industry and we provide our customers 
		with a level of service that exceeds their expectations.</span></font><img border="0" src="images/transparent.gif" width="1" height="1" alt="football picks, football handicappers, NFL"></td>
		</tr>
	<tr>
		<td colspan="2" height="10" >
		</td>
		</tr>
<?php
if($result&&mysql_num_rows($result)>0) {
	while ($data=mysql_fetch_array($result)) {
        if(stristr($data['url'],'http')) {
        }
        else {
            $data['url']='http://'.$data['url'];
        }
?>		
	<tr>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center">
		<p align="left">
		<font color="#990000"><?php echo $data['name']?></font></td>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center">
		<a target="_blank" href="<?php echo $data['url']?>">Click 
		Here to Visit</a></td>
		</tr>
	<tr>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center" colspan="2" height="58">
		<p align="justify"><font face="Verdana">
		<span style="font-size: 8pt; font-weight: 400"><?php echo$data['description']; ?></span></font></td>
		</tr>
	<tr>
		<td width="96%" colspan="2" height="10" >
		</td>
		</tr>
<?php
	}
}
?>	
</table>


</td>


<td align="center" valign="top" width="180"><img border="0" src="images/spacer_content.gif" width="180" height="1"><img border="0" src="images/transparent.gif" width="1" height="1" alt="football picks, football handicappers, NFL">
<? include('tdright.php'); ?>
</td>



</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>