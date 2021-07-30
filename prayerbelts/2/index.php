<!DOCTYPE HTML><!-- HTML5 -->

<html>
<head>
	<title>Prayer Belts Demo Site</title>

	<!-- Load Style Sheets -->
	<link href="css/common.css" rel="stylesheet" type="text/css">
	<![if (!IE)|(IE 9)]>
		<link href="css/standard.css" rel="stylesheet" type="text/css">
	<![endif]>
	<!-- Change this to ie.css -->
	<!--[if lt IE 9]>
		<link href="css/standard.css" rel="stylesheet" type="text/css">
<!--		<div style="position:absolute; top:0; left:0; background-color:#FF0000; font-family:Myvetica,sans-serif; font-size:10px; color:#FFFFFF; z-index:9999999;">
			<strong>*Notice - You are using Internet Explorer below version 9, so things may not look as good as they should, YET.</strong>
		</div>-->
	<![endif]-->
<!--    <link rel="stylesheet" href="css/jquery.superbox.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="js/jquery.equalheights.js"></script>
    <script type="text/javascript" src="js/smoothscroll.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
    <script src="js/jquery.anythingslider.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.tweet.js"></script>
    <script src="js/global.js" type="text/javascript"></script>-->
</head>

<body bgcolor="#000000">

<div id="pageContainer" style="position:relative; top:0px; left:50%; margin-left:-480px; width:960px; min-height:800px; background-color:#f67f07; z-index:1;">
	<div id="page" style="position:absolute; top:0px; left:0px; width:100%; min-height:100%; background:transparent url('images/OrangeBG.jpg') no-repeat center top; z-index:2;">
		<div id="topBar" style="position:absolute; top:0px; left:0px; width:100%; height:25px; background-color:#1f1f1f; z-index:4;">
			<div id="topLogo" style="position:absolute; top:0px; left:20px; width:350px; height:70px; background:transparent url('images/LogoTop.png') no-repeat left top; z-index:5;"></div>
			<div id="topCart" align="right" style="position:absolute; top:2px; right:10px; width:350px; height:25px; z-index:5;">
				<table cellspacing="0" cellpadding="0">
<!--				<tr onMouseOver="cartIcon.src='images/CartIconOn.png'; document.getElementById('cart').style.color='#DF5256';" onMouseOut="cartIcon.src='images/CartIcon.png'; document.getElementById('cart').style.color='#FFFFFF';">-->
				<tr>
					<td><img src="images/CartIcon.png" id="cartIcon" alt="" title="Your Shopping Cart Is Empty" height="20" width="20"></td>
					<td style="padding-left:10px;"><img src="images/Header-CheckoutCart.png" alt="Checkout|Cart" title="Your Shopping Cart Is Empty" height="20" width="80"></td>
					<td id="cart" style="padding:0px 0px 3px 10px;" class="menuWhite">0 Items</td>
				</tr>
				</table>
			</div>
			<div id="topMenu" align="right" style="position:absolute; top:35px; right:10px; width:500px; height:25px; z-index:5;">
				<table cellspacing="0" cellpadding="0" class="menuWhite">
				<tr>
					<td style="padding:0px 10px 0px 0px;"><a href="/" class="menuWhite"><nobr><strong>Our Products</strong></nobr></a></td>
					<td>|</td>
					<td style="padding:0px 10px 0px 10px;"><a href="/" class="menuWhite"><nobr><strong>Our Vision</strong></nobr></a></td>
					<td>|</td>
					<td style="padding:0px 10px 0px 10px;"><a href="/" class="menuWhite"><nobr><strong>Fundraising</strong></nobr></a></td>
					<td>|</td>
					<td style="padding:0px 10px 0px 10px;"><a href="/" class="menuWhite"><nobr><strong>F.A.Q</strong></nobr></a></td>
					<td>|</td>
					<td style="padding:0px 0px 0px 10px;"><a href="/" class="menuWhite"><nobr><strong>Contact Us</strong></nobr></a></td>
				</tr>
				</table>
			</div>
		</div>
		<div id="stage" style="position:absolute; top:0px; left:0px; width:100%; height:100%; background:transparent url('images/StageBG.png') no-repeat center top; z-index:3;">
			<div id="headline" style="position:absolute; top:115px; left:40px; width:350px; height:150px; z-index:4;">
				<img src="images/PowerfulHeadline.png" alt="" width="350" height="35" border="0">
				<div id="headlinePromo" style="position:absolute; top:45px; left:50px; width:300px; height:100px; z-index:4;">
					<span class="titleWhite">Promo Message. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
					<br><br>
					Call to Action.</span>
				</div>
				<div id="productPlaceholder" style="position:absolute; top:55px; left:560px; width:350px; height:200px; z-index:4;">
					<br><br><br>
					<span class="bigWhite">[ Product Image(s) Here ]</span>
					<div id="productBadge" style="position:absolute; top:25px; right:0px; width:150px; height:150px; z-index:5;">
						<img src="images/Badge.png" alt="" width="150" height="150" border="0">
					</div>
					<div id="stageButtons" style="position:absolute; bottom:20px; left:0px; width:175px; height:20px; z-index:5;">
						<img src="images/StageButtons.png" alt="" width="175" height="20" border="0">
					</div>
				</div>
			</div>
			<div id="socialMedia" style="position:absolute; top:314px; left:10px; width:300px; height:200px; z-index:4;">
				<img src="images/SocialRibbons.png" alt="" width="220" height="180" border="0">
				<div id="stageButtons" style="position:absolute; bottom:-10px; right:10px; width:80px; height:60px; z-index:5;">
					<img src="images/FollowUs.png" alt="" width="80" height="60" border="0">
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>
