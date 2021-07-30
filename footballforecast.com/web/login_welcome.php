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
	&nbsp;</div>
<div align="center">
	&nbsp;</div>
<div align="center">
	<font color="#990000"><span style="font-size: 14pt">Welcome back!</span></font></div>
<div align="center">
	&nbsp;</div>
<div align="center">
	&nbsp;</div>
<div align="center">
	&nbsp;</div>
<div align="center">
	&nbsp;</div>
<div align="center">
	<span style="font-size: 14pt">Please use the top menu to navigate,</span></div>
<div align="center">
	<span style="font-size: 14pt">and to access all available member pages.</span></div>
<div align="center">
	&nbsp;</div>
<div align="center">
	&nbsp;</div>
<div align="center">
	&nbsp;</div>
<div align="center">
	&nbsp;</div>
<div align="center">
	<font color="#990000">For any questions please
	</font><a href="https://secure.nr.net/footballforecast/faq.php">check out our FAQ 
	page</a><font color="#990000">.</font></div>&nbsp;</td>


<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdright.php'); ?>
</td>



</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>