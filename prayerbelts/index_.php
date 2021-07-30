<?
//Detect if using IE8 or below, or Firefox
$isie = false;
$isff = false;
if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)){
	if (!strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9') !== false){
	    $isie = true;
	}
}
if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)){
    $isff = true;
}

// Get passed values
$sec = $_REQUEST['sec'];
?>
<!DOCTYPE HTML><!-- HTML5 -->

<html>
<head>
	<title>Prayer Belts Demo Site</title>

	<meta http-equiv="X-UA-Compatible" content="IE=9">

	<!-- Load Style Sheet -->
	<link href="css/prayerbelts.css" rel="stylesheet" type="text/css">

	<!-- Slideshow Scripts -->
	<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
	<script type="text/javascript">
		/*** 
		    Simple jQuery Slideshow Script
		    Released by Jon Raasch (jonraasch.com) under FreeBSD license: free to use or modify, not responsible for anything, etc.  Please link out to me if you like it :)
		***/
		function slideSwitch() {
		    var $active = $('#slideshow IMG.active');
		
		    if ( $active.length == 0 ) $active = $('#slideshow IMG:last');
		
		    // use this to pull the images in the order they appear in the markup
		    var $next =  $active.next().length ? $active.next() : $('#slideshow IMG:first');
		
		    // uncomment the 3 lines below to pull the images in random order
		    // var $sibs  = $active.siblings();
		    // var rndNum = Math.floor(Math.random() * $sibs.length );
		    // var $next  = $( $sibs[ rndNum ] );
		
		    $active.addClass('last-active');
		
		    $next.css({opacity: 0.0})
		        .addClass('active')
		        .animate({opacity: 1.0}, 1000, function() {
		            $active.removeClass('active last-active');
		        });
		}
		
		$(function() {
		    setInterval( "slideSwitch()", 5000 );
		});
	</script>
</head>

<body>

<div id="topBar">
	<div id="topBarContent">
		<div id="topBarJoin"><a href="#">Join Our Mailing List</a></div>
		<div id="topBarCart"><a href="#">0 Items</a></div>
		<div id="topBarCheckout"><a href="#" ><img src="images/checkout.gif"></a></div>
	</div>
</div>
<div id="header">
	<div id="headerLogo"><a href="/"><img src="images/logo.gif"></a></div>
	<div id="headerSocial">
		<div id="headerFacebook"><a href="#"><img src="images/facebook.gif"></a></div>
		<div id="headerTwitter"><a href="#"><img src="images/twitter.gif"></a></div>
		<div id="headerEmail"><a href="#"><img src="images/friend.gif"></a></div>
	</div>
</div>
<div id="navBar">
	<table width="900" cellspacing="0" cellpadding="0">
	<tr>
		<td width="8"><img src="images/nav_l.gif"></td>
		<td width="2" class="navBar"></td>
		<td width="147" class="navBar"><a href="?sec=home">Home</a></td>
		<td width="147" class="navBar"><a href="?sec=about">About Us</a></td>
		<td width="147" class="navBar"><a href="#">Our Products</a></td>
		<td width="147" class="navBar"><a href="?sec=mission">Our Mission</a></td>
		<td width="147" class="navBar"><a href="?sec=faq">F.A.Q</a></td>
		<td width="147" class="navBar"><a href="?sec=contact">Contact Us</a></td>
		<td width="8"><img src="images/nav_r.gif"></td>
	</tr>
	</table>
</div>
<div id="banner">
	<div id="slideContainer">
		<div id="slideshow">
			<img src="images/image1.jpg" class="active">
			<img src="images/image2.jpg">
			<img src="images/image3.jpg">
		</div>
	</div>
	<img src="images/add1.gif" border="0" usemap="#Map1">
	<map name="Map1" id="Map1">
		<area shape="rect" coords="64,215,197,259" href="?sec=about">
	</map>
	<img src="images/add2.gif" border="0" usemap="#Map2">
	<map name="Map2" id="Map2">
		<area shape="rect" coords="63,215,194,258" href="#">
	</map>
</div>

<!-- Dynamic Content -->
<div id="contentContainer" style="position:relative;">
	<?
	// Branch content based on "sec" value and include the appropriate content
	switch($sec){
		case "": include("includes/home.php"); break;
		case "home": include("includes/home.php"); break;
		case "about": include("includes/about.php"); break;
		case "mission": include("includes/mission.php"); break;
		case "faq": include("includes/faq.php"); break;
		case "contact": include("includes/contact.php"); break;
		case "thankyou": include("includes/thankyou.php"); break;
		case "terms": include("includes/terms.php"); break;
		case "privacy": include("includes/privacy.php"); break;
		default: include("includes/home.php"); break;
	} // End Switch
	?>
</div>

<div id="footer">
	<table cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="center" class="footerCell"><a href="?sec=home">Home</a></td>
		<td align="center" class="footerCell"><a href="?sec=about">About Us</a></td>
		<td align="center" class="footerCell"><a href="#">Our Products</a></td>
		<td align="center" class="footerCell"><a href="?sec=mission">Our Mission</a></td>
		<td align="center" class="footerCell"><a href="?sec=faq">F.A.Q</a></td>
		<td align="center" class="footerCell"><a href="?sec=contact">Contact Us</a></td>
		<td align="center" class="footerCell"><a href="?sec=terms">Terms &amp; Conditions</a></td>
		<td align="center" class="footerCell noBG"><a href="?sec=privacy">Privacy Policy</a></td>
	</tr>
	<tr>
		<td colspan="8" align="center" class="footerCopyright">Copyright&copy; 2010-<?=date("Y");?>, PrayerBelts, Inc.</a><!--&#174;.-->&nbsp;&nbsp;All Rights Reserved.</td>
	</tr>
	</table>
</div>

</body>
</html>
