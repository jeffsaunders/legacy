<?
$sec = $_GET['sec'];
if ($https && $sec != "privacy") header("Location: http://www.nr.net/archive/rtoerings/?sec=".$sec."&https=0"); //Go to main site.
?>
<!--NEED TO INTERROGATE THE ACTUAL PROTOCOL (HTTP VS HTTPS) AND BRANCH ACCORDINGLY ABOVE!!!!!!!
Above commented here due to header redirect requirments for being sent before ANY output, including comments.
If sec requires SSL, then redirect to secure site and set "https" variable to test if URL was redirected, to eliminate infinite loop

if (!$https && $sec == "privacy") header("Location: 
https://secure.nr.net/nr.net/httpdocs/archive/rtoerings/?sec=".$sec."&https=1")$


-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>R Toe Rings - Comfort. Quality. Beauty.</title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="en-us">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Jewlery">
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#223367" leftmargin="0" topmargin="0" marginwidth="0" background="images/background.jpg" style="background-position: bottom; background-repeat: no-repeat; background-attachment: scroll;" onLoad="show_clock();" onResize="window.location.reload(true);window.location=window.location;" onMaximize="window.location.reload(true);window.location=window.location;"><!-- resize code covers all browsers -->

<!-- Determine browser width and resize page accordingly -->
<script language="JavaScript1.2">
var wid = 0;
if (window.innerWidth){
	wid = window.innerWidth;
//	hit = window.innerHeight;
}else{
//if (document.all){
	wid = document.body.clientWidth;
//	hit = document.body.clientHeight;
}
// create the table based on width of browser
if (wid > 1020) {
    document.write('<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#2A77D6" class="cellFrostBlue">');
}else{
    document.write('<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#2A77D6" class="cellFrostBlue">');
}
</script>

<tr>
	<td width="225" rowspan="2"><img src="images/logo225x150.gif" alt="" width="225" height="150" border="0" style="position:relative;"></td>
	<td colspan="2">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
		<tr>
			<td>
				<table width="50%" cellspacing="0" align="left">
				<tr>
					<td><img src="images/comfort.gif" alt="" width="150" height="40" border="0" style="position:relative;"></td>
				</tr>
				<tr>
					<td align="center"><img src="images/quality.gif" alt="" width="150" height="40" border="0" style="position:relative;"></td>
				</tr>
				<tr>
					<td align="right"><img src="images/beauty.gif" alt="" width="150" height="40" border="0" style="position:relative;"></td>
				</tr>
				</table>
			</td>
			<td width="250" align="right"><!--<img src="images/beachtoes.jpg" alt="" width="250" height="125" border="0" style="position:relative;">--><img src="images/spacer.gif" alt="" width="250" height="125" border="0"></td>
		</tr>
		</table>
	</td>
<tr>
	<td colspan="2">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
		<tr>
			<td width="25" bgcolor="#2564AD"><img src="images/statuscorner.gif" alt="" width="25" height="25" border="0"></td>
			<td valign="bottom" bgcolor="#2564AD" class="bodyWhite">
				<!-- BEGIN Site Location Label -->
				<strong><em>
				<?
				// Sections
				if ((!$sec) || $sec == "home") echo '<strong style="position:relative;">Home &raquo; </strong>'; 
				if ($sec == "about") echo '<strong style="position:relative;">About R Toe Rings &raquo; </strong>';
				if ($sec == "kiosk") echo '<strong style="position:relative;">Locations &raquo; Las Vegas &raquo; </strong>';
//				if ($sec == "toerings" || $sec == "thumbrings" || $sec == "anklets") echo '<strong style="position:relative;">Store &raquo; Jewelry &raquo; </strong>';
				if ($sec == "toerings") echo '<strong style="position:relative;">Online Store &raquo; Toe Rings &raquo; </strong>';
				if ($sec == "thumbrings") echo '<strong style="position:relative;">Online Store &raquo; Thumb Rings &raquo; </strong>';
				if ($sec == "anklets") echo '<strong style="position:relative;">Online Store &raquo; Anklets &raquo; </strong>';
				if ($sec == "mens") echo '<strong style="position:relative;">Online Store &raquo; Men\'s Styles &raquo; </strong>';
				if ($sec == "specials") echo '<strong style="position:relative;">Online Store &raquo; Specials &raquo; </strong>';
				if ($sec == "ordering") echo '<strong style="position:relative;">Ordering Information &raquo; </strong>';
				if ($sec == "warranty") echo '<strong style="position:relative;">Warranty &raquo; </strong>';
				if ($sec == "sizing") echo '<strong style="position:relative;">Sizing Help &raquo; </strong>';
				if ($sec == "care") echo '<strong style="position:relative;">Foot &amp; Jewelry Care &raquo; </strong>';
				if ($sec == "faq") echo '<strong style="position:relative;">Frequently Asked Questions &raquo; </strong>';
				if ($sec == "biz") echo '<strong style="position:relative;">Business Opportunities &raquo; </strong>';
				if ($sec == "terms") echo '<strong style="position:relative;">Website Terms Of Use &raquo; </strong>';
				if ($sec == "privacy") echo '<strong style="position:relative;">Privacy Policy &raquo; </strong>';
				if ($sec == "contact") echo '<strong style="position:relative;">Contact Us &raquo; </strong>';
				?>
				</em></strong>
				<!-- END Site Location Label -->
			</td>
			<td align="right" valign="bottom" bgcolor="#2564AD" class="bodyWhite"><strong style="position:relative;"><? include("./liveclock.js"); ?>&nbsp;&nbsp;&nbsp;</strong></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" bgcolor="#2564AD"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
</table>

<script language="JavaScript1.2">
// create the table based on width of browser
if (wid > 1020) {
    document.write('<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center">');
}else{
    document.write('<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">');
}
</script>

<!-- BEGIN Main Menu & Left Column -->
<tr>
	<!-- First menu element (Home) here for proper alignment -->
	<td width="150" valign="bottom" bgcolor="#2564AD" class="cellFrostDkBlue"><img src="images/spacer.gif" alt="" width="5" height="5" border="0"><a href="?sec=home" title="Home Page" class="bodyWhite" style="position:relative;"><strong>Home</strong></a></td>
	<td width="5" rowspan="2" valign="top" class="cellFrostDkBlueTrans"><img src="images/menucorner.gif" alt="" width="5" height="5" border="0"></td>
	<td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
</tr>
<tr>
	<td valign="top">
		<!-- Rest of Main Menu -->
		<table width="150" border="0" cellspacing="0" cellpadding="0" bgcolor="#2564AD" class="cellFrostDkBlue">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="5" height="5" border="0"></td>
			<td style="line-height:100%;">
<!--				<a href="?sec=home" class="bodyWhite" style="position:relative;"><strong>Home</strong></a><br>-->
				<img src="images/linedot.gif" alt="" width="140" height="1" border="0"><br>
				<a href="?sec=about" title="Christopher's Vision" class="bodyWhite" style="position:relative;"><strong>About R Toe Rings</strong></a><br>
				<a href="?sec=kiosk" title="Visit Our Las Vegas Store!!" class="bodyWhite" style="position:relative;"><strong>Las Vegas Store</strong></a><br>
				<img src="images/linedot.gif" alt="" width="140" height="1" border="0"><br>
				<a href="?sec=toerings" title="Visit Our Online Store" class="bodyWhite" style="position:relative;"><strong>Toe Rings</strong></a><br>
				<a href="?sec=thumbrings" title="Visit Our Online Store" class="bodyWhite" style="position:relative;"><strong>Thumb Rings</strong></a><br>
				<a href="?sec=anklets" title="Visit Our Online Store" class="bodyWhite" style="position:relative;"><strong>Anklets</strong></a><br>
				<a href="?sec=mens" title="Visit Our Online Store" class="bodyWhite" style="position:relative;"><strong>Men's Styles</strong></a><br>
				<a href="?sec=specials" title="See Our Current Specials" class="bodyWhite" style="position:relative;"><strong>Online Specials</strong></a><br>
				<a href="?sec=ordering" title="Ordering Information" class="bodyWhite" style="position:relative;"><strong>Ordering</strong></a><br>
				<a href="?sec=warranty" title="Our Warranty Policy" class="bodyWhite" style="position:relative;"><strong>Warranty</strong></a><br>
				<img src="images/linedot.gif" alt="" width="140" height="1" border="0"><br>
				<a href="?sec=sizing" title="Learn How To Measure Your Toe Size" class="bodyWhite" style="position:relative;"><strong>Sizing Help</strong></a><br>
				<a href="?sec=care" title="Taking Care of Business" class="bodyWhite" style="position:relative;"><strong>Foot &amp; Jewelry Care</strong></a><br>
				<a href="?sec=faq" title="Frequently Asked Questions" class="bodyWhite" style="position:relative;"><strong>F.A.Q.</strong></a><br>
				<a href="?sec=biz" title="Explore Our Business Opportunities" class="bodyWhite" style="position:relative;"><strong>Opportunities</strong></a><br>
				<a href="?sec=terms" title="Our Website Terms Of Use" class="bodyWhite" style="position:relative;"><strong>Terms Of Use</strong></a><br>
				<a href="https://secure.nr.net/nr.net/httpdocs/archive/rtoerings/?sec=privacy&https=1" title="Our Website Privacy Policy" class="bodyWhite" style="position:relative;"><strong>Privacy Policy</strong></a><br>
				<img src="images/linedot.gif" alt="" width="140" height="1" border="0"><br>
				<a href="?sec=contact" title="Email Us" class="bodyWhite" style="position:relative;"><strong>Contact Us</strong></a><br>
				<a href="javascript:external.AddFavorite('http://www.rtoerings.com','R Toe Rings - Comfort. Quality. Beauty.');"  title="Press CTRL-D if using Netscape/Firefox" class="bodyWhite" style="position:relative;"><strong>Bookmark This Site</strong></a><br>
			</td>
		</tr>
		</table>
		<table width="150" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="145" bgcolor="#2564AD" class="cellFrostDkBlue"><img src="images/spacer.gif" alt="" width="145" height="5" border="0"></td>
			<td class="cellFrostDkBlueTrans"><img src="images/menucorner.gif" alt="" width="5" height="5" border="0"></td>
		</tr>
		</table>
<!--		<img src="images/viewcart.gif" alt="" border="0"><br>-->
<!--		<?// include("./include/left.php"); ?>-->
	</td>
	<!-- END Main Menu & Left Column -->
	<!-- BEGIN Main Content -->
	<td>
		<?
		// Branch Content Based On Passed "SEC" Value
		if ((!$sec) || $sec == "home") include("include/home.php");
		if ($sec == "about") include("include/about.php");
		if ($sec == "kiosk") include("include/kiosk.php");
		if ($sec == "toerings") include("include/toerings.php");
		if ($sec == "thumbrings") include("include/thumbrings.php");
		if ($sec == "anklets") include("include/anklets.php");
		if ($sec == "mens") include("include/mens.php");
		if ($sec == "specials") include("include/specials.php");
		if ($sec == "ordering") include("include/ordering.php");
		if ($sec == "warranty") include("include/warranty.php");
		if ($sec == "sizing") include("include/sizing.php");
		if ($sec == "care") include("include/care.php");
		if ($sec == "faq") include("include/faq.php");
		if ($sec == "biz") include("include/biz.php");
		if ($sec == "terms") include("include/terms.php");
		if ($sec == "privacy") include("include/privacy.php");
//		if ($sec == "privacy") include("https://secure.nr.net/rtoerings/include/privacy.php");
//		if ($sec == "privacy") include("https://secure.nr.net");
		if ($sec == "contact") include("include/contact.php");
		// Append Footer
		include("include/footer.php");
		?>
		<br>
	</td>
	<!-- END Main Content -->
</tr>
</table>

</body>
</html>
