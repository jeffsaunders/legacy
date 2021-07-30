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
	<font color="#990000"><span style="font-size: 14pt">Links<br>
	<img border="0" src="images/linkslarge.jpg" width="178" height="97"></span></font></div>
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
		<font color="#990000">What's On, The Las Vegas Guide<br>
		The Summerlin 
		Magazine, The Henderson Magazine</font></td>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center">
		<a target="_blank" href="http://www.ilovevegas.com">Click 
		Here to Visit</a></td>
		</tr>
	<tr>
		<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFEF4" align="center" colspan="2" height="58">
		<p align="justify"><font face="Verdana">
		<span style="font-size: 8pt; font-weight: 400">What’s On, The Las Vegas 
		Guide is dedicated to providing visitors with a comprehensive, colorful 
		magazine about Las Vegas and surrounding areas in an interesting and 
		informative format. We produce work of such high quality that it 
		challenges the standards of the industry and we provide our customers 
		with a level of service that exceeds their expectations.</span></font></td>
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


<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdright.php'); ?>
</td>



</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>