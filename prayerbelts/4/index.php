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
?>
<!DOCTYPE HTML><!-- HTML5 -->

<html>
<head>
	<title>Prayer Belts Demo Site</title>

	<meta http-equiv="X-UA-Compatible" content="IE=9">

	<!-- Load Style Sheet -->
	<link href="css/prayerbelts.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="topBarBackground" style="position:fixed; top:0px; left:0px; width:100%; height:35px; background:transparent url('images/TopBarBG.png') repeat-x left top;  z-index:7;"></div>

<div id="topMenuBackground" style="position:fixed; top:25px; left:0px; width:100%; height:60px; background:transparent url('images/TopMenuBG.png') repeat left top;  z-index:4;"></div>

<div id="topLogoBackground" style="position:fixed; top:25px; left:0px; width:50%; height:60px; background:transparent url('images/TopLogoBG.png') no-repeat right top;  z-index:8;"></div>

<div id="topLogo" style="position:fixed; top:10px; left:50%; margin-left:-480px; width:350px; height:50px; z-index:10;">
	<table>
	<tr>
		<td style="padding:0px 10px 0px 10px;"><img src="images/TopLogoSymbol.png" alt="" name="topLogoSymbol" id="topLogoSymbol" width="50" height="50" border="0" title="Prayer Belts!"></td>
		<td><img src="images/TopLogo.png" alt="Prayer Belts" name="topLogo" id="topLogo" width="275" height="50" border="0" title="Prayer Belts!"></td>
	</tr>
	</table>
</div>
<div id="topFollowUs" style="position:fixed; top:5px; left:50%; margin-left:-95px; width:80px; height:60px; z-index:11;">
	<img src="images/FollowUs.png" id="followUs" alt="Follow Us" height="60" width="80">
</div>
<div id="topSocialIcons" style="position:fixed; top:-2px; left:50%; margin-left:0px; width:200px; height:25px; z-index:11;">
	<table cellspacing="5" cellpadding="0">
	<tr>
		<td onMouseOver="facebookMini.src='images/FacebookMiniOn.png';" onMouseOut="facebookMini.src='images/FacebookMini.png';">
			<a href="./"><img src="images/FacebookMini.png" alt="" name="facebookMini" id="facebookMini" width="20" height="20" border="0" title="Like Us On Facebook!"></a>
		</td>
		<td onMouseOver="twitterMini.src='images/TwitterMiniOn.png';" onMouseOut="twitterMini.src='images/TwitterMini.png';">
			<a href="./"><img src="images/TwitterMini.png" alt="" name="twitterMini" id="twitterMini" width="20" height="20" border="0" title="Follow Us On Twitter!"></a>
		</td>
		<td onMouseOver="googleMini.src='images/Google+MiniOn.png';" onMouseOut="googleMini.src='images/Google+Mini.png';">
			<a href="./"><img src="images/Google+Mini.png" alt="" name="googleMini" id="googleMini" width="20" height="20" border="0" title="Circle Us On Google+!"></a>
		</td>
		<td onMouseOver="wordpressMini.src='images/WordpressMiniOn.png';" onMouseOut="wordpressMini.src='images/WordpressMini.png';">
			<a href="./"><img src="images/WordpressMini.png" alt="" name="wordpressMini" id="wordpressMini" width="20" height="20" border="0" title="Read Our Blog!"></a>
		</td>
	</tr>
	</table>
</div>
<div id="topJoinList" align="right" style="position:fixed; top:2px; left:50%; margin-left:130px; width:150px; height:25px; z-index:11;">
	<table cellspacing="0" cellpadding="0">
	<tr onMouseOver="envelopeIcon.src='images/EnvelopeIconOn.png'; document.getElementById('joinMailingList').style.color='#FFFFFF';" onMouseOut="envelopeIcon.src='images/EnvelopeIcon.png'; document.getElementById('joinMailingList').style.color='#000000';">
		<td><a href="./"><img src="images/EnvelopeIcon.png" alt="" name="envelopeIcon" id="envelopeIcon" width="20" height="20" border="0" title="Join Our Mailing List"></a></td>
		<td style="padding:0px 0px 3px 10px;"><a href="./" id="joinMailingList" title="Join Our Mailing List" class="headerBlack">Join Our Mailling List</a></td>
	</tr>
	</table>
</div>
<div id="topCart" align="right" style="position:fixed; top:2px; left:50%; margin-left:130px; width:350px; height:25px; z-index:10;">
	<table cellspacing="0" cellpadding="0">
	<tr onMouseOver="cartIcon.src='images/CartIconOn.png'; document.getElementById('cartContents').style.color='#FFFFFF';" onMouseOut="cartIcon.src='images/CartIcon.png'; document.getElementById('cartContents').style.color='#000000';">
		<td><a href="./"><img src="images/CartIcon.png" alt="" name="cartIcon" id="cartIcon" width="20" height="20" border="0" title="Your Shopping Cart"></a></td>
		<td style="padding:0px 0px 3px 10px;"><a href="./" id="cartContents" title="Your Shopping Cart" class="headerBlack">Checkout | Cart :&nbsp;&nbsp;<strong>0 Items</strong></a></td>
	</tr>
	</table>
</div>
<div id="topMenu" align="right" style="position:fixed; top:50px; left:50%; margin-left:-30px; width:500px; height:25px; z-index:5;">
	<table cellspacing="0" cellpadding="0" class="menuBlack">
	<tr>
		<td style="padding:0px 10px 0px 0px;"><a href="./" class="menuBlack"><nobr><strong>Our Products</strong></nobr></a></td>
		<td>|</td>
		<td style="padding:0px 10px 0px 10px;"><a href="./" class="menuBlack"><nobr><strong>Our Vision</strong></nobr></a></td>
		<td>|</td>
		<td style="padding:0px 10px 0px 10px;"><a href="./" class="menuBlack"><nobr><strong>Our Blog</strong></nobr></a></td>
		<td>|</td>
		<td style="padding:0px 10px 0px 10px;"><a href="./" class="menuBlack"><nobr><strong>Fundraising</strong></nobr></a></td>
		<td>|</td>
		<td style="padding:0px 10px 0px 10px;"><a href="./" class="menuBlack"><nobr><strong>F.A.Q</strong></nobr></a></td>
		<td>|</td>
		<td style="padding:0px 0px 0px 10px;"><a href="./" class="menuBlack"><nobr><strong>Contact Us</strong></nobr></a></td>
	</tr>
	</table>
</div>

<!-- Dynamic Content -->
<div id="contentContainer" style="position:relative;">
	<?
	// Branch content based on "sec" value and include the appropriate content
	switch($sec){
		case "": include("includes/home.php"); break;
		case "home": include("includes/home.php"); break;
//		case "aboutus": include("include/aboutus.php"); break;
//		case "events": include("include/events.php"); break;
//		case "trends": include("include/trends.php"); break;
//		case "references": include("include/references.php"); break;
//		case "products": include("include/products.php"); break;
//		case "aboutstone": include("include/aboutstone.php"); break;
//		case "guidelines": include("include/guidelines.php"); break;
//		case "packaging": include("include/packaging.php"); break;
//		case "techspecs": include("include/techspecs.php"); break;
//		case "locations": include("include/locations.php"); break;
//		case "factories": include("include/factories.php"); break;
//		case "residential": include("include/residential.php"); break;
//		case "faq": include("include/faq.php"); break;
//		case "contact": include("include/contact.php"); break;
//		case "privacy": include("include/privacy.php"); break;
		default: include("includes/home.php"); break;
	} // End Switch
	?>
</div>

<div id="footerBackground" style="position:relative; bottom:0px; left:0px; width:100%; min-height:200px; float:left; background-color:#FFFFFF;">
	<div id="FooterContainer" style="position:relative; top:0px; left:50%; margin-left:-460px; width:940px; z-index:11;">
		<div id="FooterLinks" style="position:relative; top:15px; left:0px; width:25%; z-index:12;">
			<table>
			<tr>
				<td><img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0"></td>
				<td><a href="./" class="menuBlack"><nobr>Our Products</nobr></a></td>
			</tr>
			<tr>
				<td><img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0"></td>
				<td><a href="./" class="menuBlack"><nobr>Our Vision</nobr></a></td>
			</tr>
			<tr>
				<td><img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0"></td>
				<td><a href="./" class="menuBlack"><nobr>Fundraising</nobr></a></td>
			</tr>
			<tr>
				<td><img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0"></td>
				<td><a href="./" class="menuBlack"><nobr>Frequently Asked Questions</nobr></a></td>
			</tr>
			<tr>
				<td><img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0"></td>
				<td><a href="./" class="menuBlack"><nobr>Contact Us</nobr></a></td>
			</tr>
			<tr>
				<td><img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0"></td>
				<td><a href="./" class="menuBlack"><nobr>Terms of Use</nobr></a></td>
			</tr>
			<tr>
				<td><img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0"></td>
				<td><a href="./" class="menuBlack"><nobr>Privacy Policy</nobr></a></td>
			</tr>
			</table>
  		</div>
		<div id="FooterSocial" style="position:absolute; top:15px; left:25%; width:25%; z-index:12;">
			<table cellspacing="0" cellpadding="0">
			<tr onMouseOver="TwitterFooterIcon.src='images/TwitterFooterIconOn.png'; document.getElementById('TwitterFooterText').style.color='#DF5256';" onMouseOut="TwitterFooterIcon.src='images/TwitterFooterIcon.png'; document.getElementById('TwitterFooterText').style.color='#000000';">
				<td>
					<a href="/" class="menuWhite"><img src="images/TwitterFooterIcon.png" alt="" id="TwitterFooterIcon" width="40" height="40" border="0"></a>
				</td>
				<td>&nbsp;&nbsp;<a href="./" id="TwitterFooterText" class="menuBlack"><nobr>Follow Us On Twitter</nobr></a></td>
			</tr>
			<tr onMouseOver="FacebookFooterIcon.src='images/FacebookFooterIconOn.png'; document.getElementById('FacebookFooterText').style.color='#DF5256';" onMouseOut="FacebookFooterIcon.src='images/FacebookFooterIcon.png'; document.getElementById('FacebookFooterText').style.color='#000000';">
				<td>
					<a href="/" class="menuWhite"><img src="images/FacebookFooterIcon.png" alt="" id="FacebookFooterIcon" width="40" height="40" border="0"></a>
				</td>
				<td>&nbsp;&nbsp;<a href="./" id="FacebookFooterText" class="menuBlack"><nobr>Like Us On Facebook</nobr></a></td>
			</tr>
			<tr onMouseOver="GoogleFooterIcon.src='images/Google+FooterIconOn.png'; document.getElementById('GoogleFooterText').style.color='#DF5256';" onMouseOut="GoogleFooterIcon.src='images/Google+FooterIcon.png'; document.getElementById('GoogleFooterText').style.color='#000000';">
				<td>
					<a href="/" class="menuWhite"><img src="images/Google+FooterIcon.png" alt="" id="GoogleFooterIcon" width="40" height="40" border="0"></a>
				</td>
				<td>&nbsp;&nbsp;<a href="./" id="GoogleFooterText" class="menuBlack"><nobr>Circle Us On Google+</nobr></a></td>
			</tr>
			<tr onMouseOver="WordpressFooterIcon.src='images/WordpressFooterIconOn.png'; document.getElementById('WordpressFooterText').style.color='#DF5256';" onMouseOut="WordpressFooterIcon.src='images/WordpressFooterIcon.png'; document.getElementById('WordpressFooterText').style.color='#000000';">
				<td>
					<a href="/" class="menuWhite"><img src="images/WordpressFooterIcon.png" alt="" id="WordpressFooterIcon" width="40" height="40" border="0"></a>
				</td>
				<td>&nbsp;&nbsp;<a href="./" id="WordpressFooterText" class="menuBlack"><nobr>Read Our Blog</nobr></a></td>
			</tr>
			</table>
		</div>
		<div id="FooterSocial" style="position:absolute; top:20px; left:50%; width:50%; text-align:center; z-index:12;">
			<span class="bodyBlack">Available space for anything else we want to place in the footer.</span>
		</div>
	</div>
</div>

<div id="bottomBarBackground" style="position:relative; top:10px; left:0px; width:100%; height:25px; text-align:center;">
	<strong class="bodyWhite">Copyright&copy; 2010-<?=date("Y");?>, Intramedia, Inc.</a><!--&#174;.-->&nbsp;&nbsp;All Rights Reserved.</strong><br><br>
</div>

</body>
</html>
