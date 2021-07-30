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

// Get configuration settings
$xml = simplexml_load_file('xml/config.xml');
$json = json_encode($xml);
$config = json_decode($json, TRUE);
//print_r($config);
?>
<!DOCTYPE HTML><!-- HTML5 -->
<!-- While this site is HTML5 compliant, tables are used throughout for simplicity of code and ease of documentation for future developers --> 

<html>
<head>
	<title><?=$config['site']['title'];?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=9">
	<meta name="language" content="EN">
	<meta name="copyright" content="Copyright PRAYER BELTS, Inc. &copy; 2010-<?=date('Y');?>">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="2 days">
	<meta name="author" content="Jeff Saunders, RMS Global (j.saunders@rmsglobal.net)">
	<meta name="Keywords" content="<?=$config['site']['keywords'];?>">
	<meta name="Description" content="<?=$config['site']['description'];?>"> 

	<!-- Load Style Sheet -->
	<link href="css/prayerbelts.css" rel="stylesheet" type="text/css">

	<!-- FavIcon -->
	<link rel="shortcut icon" href="images/favicon.gif" type="image/x-icon" />

	<!--[if IE]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

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
		    setInterval( "slideSwitch()", <?=$config['slideshow']['interval'];?> );
		});
	</script>
</head>

<body>

<?
session_start();
// calculate number of items in the cart
$items = 0;
while ($_SESSION['Item'.$items]){
	$cartQty += $_SESSION['Quantity'.$items];
	$items++;
}
if ($sec == "thankyou" && !isset($_REQUEST['for'])) $cartQty = 0;  // Checkout just completed but cart not emptied yet
?>

<div id="topBar" class="roundedCorners">
	<div id="topBarContent">
		<div id="topBarJoin" title="Click to Join Our Mailing List"><a href="?sec=join">Join Our Mailing List</a></div>
		<div id="topBarCart" title="Click to View Your Shopping Cart"><a href="?sec=cart"><?=(isset($cartQty) ? $cartQty : 0);?> Item<?=($cartQty != 1 ? "s" : "");?></a></div>
		<div id="topBarCheckout"><a href="?sec=checkout"><img src="images/checkout.gif" alt="Checkout" title="Click to Check Out" border="0"></a></div>
	</div>
</div>
<div id="header">
	<div id="headerLogo"><a href="/"><img src="images/logo.gif" alt="Prayer Belts - Spreading The Word One Belt at a Time" title="Prayer Belts - Spreading The Word One Belt at a Time" border="0"></a></div>
	<div id="headerSocial">
		<div id="headerFacebook"><a href="<?=$config['facebook'];?>" title="Like Us On Facebook!" target="_blank"><img src="images/facebook.gif" alt="" border="0"></a></div>
		<div id="headerTwitter"><a href="<?=$config['twitter'];?>" title="Follow Us On Twitter!" target="_blank"><img src="images/twitter.gif" alt="" border="0"></a></div>
		<div id="headerEmail"><a href="<?=$config['tellafriend'];?>" title="Tell Your Friends About Us!"><img src="images/friend.gif" alt="" border="0"></a></div>
	</div>
</div>
<div id="navBar">
	<table width="900" cellspacing="0" cellpadding="0">
	<tr>
		<td width="8"><img src="images/nav_l.gif" alt="" border="0"></td>
		<td width="2" class="navBar"></td>
		<td width="147" class="navBar"><a href="?sec=home" title="Our Home Page">Home</a></td>
		<td width="147" class="navBar"><a href="?sec=about" title="Learn More About Us">About Us</a></td>
		<td width="147" class="navBar"><a href="?sec=products" title="Purchase Our Products">Our Products</a></td>
		<td width="147" class="navBar"><a href="?sec=mission" title="Learn What We Believe">Our Mission</a></td>
		<td width="147" class="navBar"><a href="?sec=faq" title="Frequently Asked Questions">F.A.Q</a></td>
		<td width="147" class="navBar"><a href="?sec=contact" title="Drop Us a Note">Contact Us</a></td>
		<td width="8"><img src="images/nav_r.gif" alt="" border="0"></td>
	</tr>
	</table>
</div>
<?
// Display the banner and about bar on a page-by-page basis based on the setting in the config.xml
switch($sec){
	case "": $banner = $config['banner']['home']; $aboutBar = $config['aboutBar']['home']; break;
	case "home": $banner = $config['banner']['home']; $aboutBar = $config['aboutBar']['home']; break;
	case "about": $banner = $config['banner']['about']; $aboutBar = $config['aboutBar']['about']; break;
	case "products": $banner = $config['banner']['products']; $aboutBar = $config['aboutBar']['products']; break;
	case "cart": $banner = $config['banner']['cart']; $aboutBar = $config['aboutBar']['cart']; break;
	case "checkout": $banner = $config['banner']['checkout']; $aboutBar = $config['aboutBar']['checkout']; break;
	case "declined": $banner = $config['banner']['declined']; $aboutBar = $config['aboutBar']['declined']; break;
	case "mission": $banner = $config['banner']['mission']; $aboutBar = $config['aboutBar']['mission']; break;
	case "faq": $banner = $config['banner']['faq']; $aboutBar = $config['aboutBar']['faq']; break;
	case "contact": $banner = $config['banner']['contact']; $aboutBar = $config['aboutBar']['contact']; break;
	case "testimonials": $banner = $config['banner']['testimonials']; $aboutBar = $config['aboutBar']['testimonials']; break;
	case "thankyou": $banner = $config['banner']['thankyou']; $aboutBar = $config['aboutBar']['thankyou']; break;
	case "join": $banner = $config['banner']['join']; $aboutBar = $config['aboutBar']['join']; break;
	case "terms": $banner = $config['banner']['terms']; $aboutBar = $config['aboutBar']['terms']; break;
	case "returns": $banner = $config['banner']['returns']; $aboutBar = $config['aboutBar']['returns']; break;
	case "privacy": $banner = $config['banner']['privacy']; $aboutBar = $config['aboutBar']['privacy']; break;
	default: $banner = $config['banner']['home']; $aboutBar = $config['aboutBar']['home']; break;
} // End Switch
?>
<div id="banner" style="<?=((!$banner || $banner == "visible") ? "visibility:visible" : "visibility:hidden; display:none");?>;">
	<div id="slideContainer">
		<div id="slideshow">
		<?
		for ($cnt=0; $cnt < sizeof($config['slideshow']['image']); $cnt++){
			// If the image is "active" then display it
			if($config['slideshow']['image'][$cnt]['active'] == "Y"){
		?>
			<img src="<?=$config['slideshow']['image'][$cnt]['src'];?>" title="<?=$config['slideshow']['image'][$cnt]['title'];?>" border="0"<?=($config['slideshow']['image'][$cnt]['default'] == "Y" ? ' class="active"' : '');?>>
		<?
			}
		}
		?>
		</div>
	</div>
	<img src="images/ad1.gif" title="Learn More About Our Products" border="0" usemap="#Map1">
	<map name="Map1" id="Map1">
		<area shape="rect" coords="64,215,197,259" href="?sec=about" title="Learn More About Our Products">
	</map>
	<img src="images/ad2.gif" alt="Special Introductory Price!" border="0" usemap="#Map2">
	<map name="Map2" id="Map2">
		<area shape="rect" coords="63,215,194,258" href="?sec=products" title="Special Introductory Price!">
	</map>
</div>
<div id="aboutBar" style="<?=((!$aboutBar || $aboutBar == "visible") ? "visibility:visible" : "visibility:hidden; display:none");?>;">
	<img src="images/secondbar.gif">
</div>

<!-- Dynamic Content -->
<div id="contentContainer" style="position:relative;">
	<?
	// Branch content based on "sec" value and include the appropriate content
	switch($sec){
		case "": include("includes/home.php"); break;
		case "home": include("includes/home.php"); break;
		case "about": include("includes/about.php"); break;
		case "products": include("includes/products.php"); break;
		case "cart": include("includes/cart.php"); break;
		case "checkout": include("includes/checkout.php"); break;
		case "declined": include("includes/declined.php"); break;
		case "mission": include("includes/mission.php"); break;
		case "faq": include("includes/faq.php"); break;
		case "contact": include("includes/contact.php"); break;
		case "testimonials": include("includes/testimonials.php"); break;
		case "thankyou": include("includes/thankyou.php"); break;
		case "join": include("includes/join.php"); break;
		case "terms": include("includes/terms.php"); break;
		case "returns": include("includes/returns.php"); break;
		case "privacy": include("includes/privacy.php"); break;
		default: include("includes/home.php"); break;
	} // End Switch
	?>
</div>

<div id="footer" class="roundedCorners">
	<div id="footerContent">
		<table cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td align="center" class="footerCell"><a href="?sec=home" title="Our Home Page">Home</a></td>
			<td align="center" class="footerCell"><a href="?sec=about" title="Learn More About Us">About Us</a></td>
			<td align="center" class="footerCell"><a href="?sec=products" title="Purchase Our Products">Our Products</a></td>
			<td align="center" class="footerCell"><a href="?sec=mission" title="Learn What We Believe">Our Mission</a></td>
			<td align="center" class="footerCell"><a href="?sec=faq" title="Frequently Asked Questions">F.A.Q</a></td>
			<td align="center" class="footerCell"><a href="?sec=contact" title="Drop Us a Note">Contact Us</a></td>
			<td align="center" class="footerCell"><a href="?sec=terms" title="Website Terms Of Use">Terms Of Use</a></td>
			<td align="center" class="footerCell"><a href="?sec=returns" title="Shipping & Returns Policy">Shipping &amp; Returns</a></td>
			<td align="center" class="footerCell noBG"><a href="?sec=privacy" title="Website Privacy Policy">Privacy Policy</a></td>
		</tr>
		<tr>
			<td colspan="9" align="center" class="footerCopyright">Copyright&copy; 2010-<?=date("Y");?>, PrayerBelts, Inc.</a><!--&#174;.-->&nbsp;&nbsp;All Rights Reserved.</td>
		</tr>
		</table>
	</div>
</div>

<!-- Google Analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27168949-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</body>
</html>
