<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Pacifica del Norte  - Realty & Property Development, Costa Rica</title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="en-us">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Realty & Property Development">
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#223367" leftmargin="0" topmargin="10" marginwidth="0" marginheight="0" onLoad="show_clock();startscroll();">

<table border="0" cellspacing="0" cellpadding="0" align="center">

<!-- BEGIN Header Section -->

<tr>
	<!-- Header -->
	<td colspan="2" background="images/headerbg.jpg"><img src="images/spacer.gif" alt="" width="800" height="150" border="0"></td>
</tr>
<tr>
	<!-- Blue Line -->	
	<td colspan="2" bgcolor="#223367"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
</tr>
<!--<tr bgcolor="#1C6DD9">-->
<tr bgcolor="#477ACF">

	<!-- Scroller & Clock Bar Cell -->
	<td><img src="images/spacer.gif" alt="" width="1" height="30" border="0"></td>
	<td>

		<!-- BEGIN Scroller & Running Clocks Section -->

		<table width="800" border="0" cellspacing="0" cellpadding="0" align="right">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td align="left" valign="top" class="bodyWhite"><font size="+1"><? include("./scroller.js"); ?></font></td>
			<td width="90" class="smallWhite"><strong>Your Local Time:&nbsp;&nbsp;<br>Costa Rica Time:&nbsp;&nbsp;</strong></td>
			<td width="250" align="right" class="smallWhite"><strong><? include("./liveclock.js"); ?></td>
		</tr>
		</table>

		<!-- END Scroller & Running Clocks Section -->

	</td>
</tr>
<tr>
	<!-- Blue Line -->
	<td colspan="2" bgcolor="#223367"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
</tr>

<!-- END Header Section -->

<!-- BEGIN Menu Section -->

<tr bgcolor="#3E5AAF">
	<td colspan="2"><? include("./include/menu.php"); ?></td>
</tr>

<!-- END Menu Section -->

<tr>
	<!-- Blue Line -->
	<td colspan="2" bgcolor="#223367"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
</tr>

<!-- BEGIN Body Section -->

<tr>
	<td width="800" colspan="2" align="center" valign="top" bgcolor="#FFFFFF" background="images/watermark.jpg" style="background-position: bottom; background-repeat: no-repeat; background-attachment: scroll;">

		<!-- Main Body Include -->
		<?
		// Branch Content Based On Passed "SEC" Value
		if ((!$sec) || $sec == "home") include("include/home.php");
		if ($sec == "homes") include("./include/homes.php");
//		if ($sec == "land") include("./include/land.php");
		if ($sec == "contact") include("./include/contact.php");

		// Property Image Galleries
		if ($sec == "playa-hermosa-3-hectareas") include("./include/properties/playa-hermosa-3-hectareas.php");

		?>
	</td>
</tr>
<tr>
	<!-- Blue Line -->	
	<td colspan="2" bgcolor="#223367"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
</tr>

<!-- END Body Section -->

<!-- BEGIN Footer Section -->

<tr bgcolor="#477ACF">
	<td><img src="images/spacer.gif" alt="" width="1" height="25" border="0">
	<td align="center" class="bodyWhite">
		<?
		include("include/footer.php");
		?>
	</td>
</tr>

<!-- END Footer Section -->

</table>

</body>
</html>
