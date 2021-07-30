<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<!--
Title - Stewart Motor Sports 
Development Copyright 2004, Network Resources - Las Vegas, Nevada USA (www.nr.net)
Digital Art Copyright 2004, Network Resources and Stewart Motor Sports Respectively
All Content Copyright 2004, Network Resources and Stewart Motor Sports Respectively
Authored by Jeff S. Saunders, Network Resources 09/15/04
Modified by Jeff S. Saunders, Network Resources 10/13/04
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">

<?
// Interrogate and reassign passed variables
$sec = $_GET['sec'];
//$page = $_GET['page'];
//$cat = $_GET['cat'];
//$scn = $_GET['scn'];
//$sub = $_GET['sub'];
?>

<html>
<head>
	<title>Stewart Motorsports - Las Vegas, Nevada</title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="en-us">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Motorcycles">
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- Page Transition Effect -->
<!--	<meta http-equiv="Page-Enter" content="blendTrans(Duration=1.0)">
	<meta http-equiv="Page-Exit" content="blendTrans(Duration=1.0)">
	<meta http-equiv="Site-Enter" content="blendTrans(Duration=1.0)">
	<meta http-equiv="Site-Exit" content="blendTrans(Duration=1.0)">
-->
	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

</head>

<body bgcolor="#E2E2E2">

<?
// Sections
if ((!$sec) || $sec == "home") {$header = "Welcome"; $body = "include/home.php";}
if ($sec == "pocketbikes")  {$header = "Pocketbikes"; $body = "include/blank.php";}
if ($sec == "gopeds")  {$header = "Go-Peds"; $body = "include/blank.php";}
if ($sec == "parts")  {$header = "Quality Parts"; $body = "include/blank.php";}
if ($sec == "accessories")  {$header = "Accessories"; $body = "include/blank.php";}
if ($sec == "safety")  {$header = "Rider Safety"; $body = "include/blank.php";}
if ($sec == "faq")  {$header = "Frequently Asked Questions"; $body = "include/blank.php";}
if ($sec == "privacy")  {$header = "Privacy Policy"; $body = "include/blank.php";}
if ($sec == "about")  {$header = "About Stewart Motorsports"; $body = "include/blank.php";}
if ($sec == "location")  {$header = "Store Location"; $body = "include/blank.php";}
?>

<table border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">

<!-- Header -->
<tr>
	<td colspan="2" background="images/header.gif" bgcolor="#E2E2E2">
		<table width="695" border="0" cellspacing="3" cellpadding="0">
		<tr>
			<td width="7" rowspan="2" valign="top"><img src="images/spacer.gif" width="1" height="84" alt="" border="0"></td>
			<td valign="top"><img src="images/smlogo.gif" width="200" height="44" alt="" border="0"></td>
		</tr>
		<tr>
			<td align="right" valign="bottom"><font face="Georgia,'Times New Roman',Times,serif" size="6" color="#FFFFFF"><? echo $header; ?></font></td>
		</tr>
		</table>
	</td>
</tr>

<!-- Menu -->
<tr>
	<td width="167" valign="top" background="images/menu.gif" style="background-position: top; background-repeat: no-repeat;"><br>
		<table width="120" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/spacer.gif" width="2" height="410" alt="" border="0"></td>
			<td valign="top">
				<table width="100%" border="1" cellspacing="0" cellpadding="2" bordercolor="#C0C0C0" class="cellFrost">
				<tr>
					<td><a href="?sec=home" title="Home Page" class="titleBlue"><strong>Home</strong></a></td>
				</tr>
				<tr>
					<td><a href="?sec=pocketbikes" title="Pocketbikes" class="titleBlue"><strong>Pocketbikes</strong></a></td>
				</tr>
				<tr>
					<td><a href="?sec=gopeds" title="Go-Peds" class="titleBlue"><strong>Go-Peds</strong></a></td>
				</tr>
				<tr>
					<td><a href="?sec=parts" title="Quality Parts" class="titleBlue"><strong>Parts</strong></a></td>
				</tr>
				<tr>
					<td><a href="?sec=accessories" title="Accessories &amp; Apparel" class="titleBlue"><strong>Accessories</strong></a></td>
				</tr>
				<tr>
					<td><a href="?sec=safety" title="Rider Safety" class="titleBlue"><strong>Safety</strong></a></td>
				</tr>
				<tr>
					<td><a href="?sec=faq" title="Frequently Asked Questions" class="titleBlue"><strong>F.A.Q.</strong></a></td>
				</tr>
				<tr>
					<td><a href="?sec=privacy" title="Privacy Policy" class="titleBlue"><strong>Privacy Policy</strong></a></td>
				</tr>
				<tr>
					<td><a href="?sec=about" title="About Stewart Motorsports" class="titleBlue"><strong>About Us</strong></a></td>
				</tr>
				<tr>
					<td><a href="?sec=location" title="Store Location" class="titleBlue"><strong>Location</strong></a></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>

	<!-- Body -->
<!--	<td width="533" height="525" align="center" valign="top" background="images/delia_wm.jpg" style="background-position: top; background-repeat: no-repeat;">&nbsp;-->
	<td width="533" align="center" valign="top" bgcolor="#FFFFFF" background="images/watermark.jpg" style="background-position:top; background-repeat:no-repeat; background-attachment:scroll;"><? include($body); ?></td>
</tr>

<!-- Footer -->
<tr>
	<td colspan="2" bgcolor="#E2E2E2"><img src="images/footer.gif" alt="" width="700" height="55" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#E2E2E2" class="smallBlue"><strong>Copyright&copy; 2004, <a href="http://www.stewartmotorsports.com" class="smallBlue">Stewart Motorsports</a>.&nbsp;&nbsp;All Rights Reserved.<br>Designed &amp; Maintained by <a href="http://www.nr.net" title="Nevada's Premier Network Services Provider" target="_blank" class="smallBlue">Network Resources</a>, Las Vegas, Nevada.</strong></td>
</tr>
</table>

</body>
</html>
