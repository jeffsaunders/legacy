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

<body>

<div id="pageBackground" style="position:relative; top:0px; left:0px; width:100%; height:450px; background:transparent url('images/OrangeBG.jpg') no-repeat center top; background-size:100% 450px; background-color:#1F1F1F; z-index:0; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader( src='images/OrangeBG.jpg', sizingMethod='scale');"></div>

<div id="topBarBackground" style="position:absolute; top:0px; left:0px; width:100%; height:35px; background:transparent url('images/TopBarBG.png') repeat-x left top;  z-index:1;"></div>

<div id="topLogoBackground" style="position:absolute; top:25px; left:0px; width:50%; height:60px; background:transparent url('images/TopLogoBG.png') no-repeat right top;  z-index:1;"></div>

<div id="pageContainer" style="position:absolute; top:0px; left:50%; margin-left:-480px; width:960px; min-height:800px; z-index:1; Xborder:white thin solid;">
	<div id="topLogo" style="position:absolute; top:10px; left:0px; width:350px; height:50px; z-index:2;">
		<img src="images/TopLogo.png" alt="Prayer Belts" name="topLogo" id="topLogo" width="350" height="50" border="0" title="Prayer Belts!">
	</div>
	<div id="topCart" align="right" style="position:absolute; top:2px; right:10px; width:350px; height:25px; z-index:5;">
		<table cellspacing="0" cellpadding="0">
		<tr onMouseOver="cartIcon.src='images/CartIconOn.png'; document.getElementById('cartContents').style.color='#DF5256';" onMouseOut="cartIcon.src='images/CartIcon.png'; document.getElementById('cartContents').style.color='#FFFFFF';">
			<td><a href="./"><img src="images/CartIcon.png" alt="" name="cartIcon" id="cartIcon" width="20" height="20" border="0" title="Your Shopping Cart Is Empty"></a></td>
			<td style="padding-left:10px;"><a href="./"><img src="images/Header-CheckoutCart.png" alt="Checkout|Cart" width="80" height="20" border="0" title="Your Shopping Cart Is Empty"></a></td>
			<td id="cartContents" style="padding:0px 0px 3px 10px;" class="menuWhite">0 Items</td>
		</tr>
		</table>
	</div>
	<div id="topMenu" align="right" style="position:absolute; top:40px; right:10px; width:500px; height:25px; z-index:5;">
		<table cellspacing="0" cellpadding="0" class="menuWhite">
		<tr>
			<td style="padding:0px 10px 0px 0px;"><a href="./" class="menuWhite"><nobr><strong>Our Products</strong></nobr></a></td>
			<td>|</td>
			<td style="padding:0px 10px 0px 10px;"><a href="./" class="menuWhite"><nobr><strong>Our Vision</strong></nobr></a></td>
			<td>|</td>
			<td style="padding:0px 10px 0px 10px;"><a href="./" class="menuWhite"><nobr><strong>Our Blog</strong></nobr></a></td>
			<td>|</td>
			<td style="padding:0px 10px 0px 10px;"><a href="./" class="menuWhite"><nobr><strong>Fundraising</strong></nobr></a></td>
			<td>|</td>
			<td style="padding:0px 10px 0px 10px;"><a href="./" class="menuWhite"><nobr><strong>F.A.Q</strong></nobr></a></td>
			<td>|</td>
			<td style="padding:0px 0px 0px 10px;"><a href="./" class="menuWhite"><nobr><strong>Contact Us</strong></nobr></a></td>
		</tr>
		</table>
	</div>
	<div id="splashBelt" style="position:absolute; top:140px; left:10px; width:600px; height:400px; z-index:2;">
		<img src="images/SplashBelt.png" alt="" name="splashBelt" id="splashBelt" width="600" height="400" border="0">
	</div>
	<div id="topHeadline" style="position:absolute; top:100px; right:10px; width:450px; height:300px; text-align:right; z-index:2;">
		<img src="images/SplashHeadline.png" alt="" width="415" height="42" border="0">
		<div id="headlinePromo" style="position:absolute; top:55px; right:40px; width:300px; height:100px; z-index:4;">
			<span class="biggerWhite">The Fashionable New Way<br>to Express Faith<br>in a World Doing<br>Everything Possible<br>to Stop You</span>
		</div>
	</div>
	<div id="splashBadge" style="position:absolute; top:340px; right:-20px; width:150px; height:150px; z-index:5;">
		<img src="images/SplashBadge.png" alt="" name="splashBadge" id="splashBadge" width="150" height="150" border="0">
	</div>
	<div id="socialRibbons" style="position:absolute; top:435px; right:200px; width:150px; height:200px; z-index:5;">
		<div id="facebookRibbon" style="position:absolute; top:2px; left:0px; width:65px; height:180px; z-index:5;">
			<a href="http://facebook.com" target="_blank"><img src="images/RibbonFacebook.png" alt="" name="ribbonFacebook" id="ribbonFacebook" width="65" height="180" border="0" title="Like Us On Facebook!" onMouseOver="this.src='images/RibbonFacebookOn.png';" onMouseOut="this.src='images/RibbonFacebook.png';"></a>
		</div>
		<div id="twitterRibbon" style="position:absolute; top:2px; left:75px; width:65px; height:180px; z-index:5;">
			<a href="http://twitter.com" target="_blank"><img src="images/RibbonTwitter.png" alt="" name="ribbonTwitter" id="ribbonTwitter" width="65" height="180" border="0" title="Follow Us On Twitter!" onMouseOver="this.src='images/RibbonTwitterOn.png';" onMouseOut="this.src='images/RibbonTwitter.png';"></a>
		</div>
		<div id="google+Ribbon" style="position:absolute; top:2px; left:150px; width:65px; height:180px; z-index:5;">
			<a href="http://plus.google.com" target="_blank"><img src="images/RibbonGoogle+.png" alt="" name="ribbonGoogle+" id="ribbonGoogle+" width="65" height="180" border="0" title="Circle Us On Google+!" onMouseOver="this.src='images/RibbonGoogle+On.png';" onMouseOut="this.src='images/RibbonGoogle+.png';"></a>
		</div>
		<div id="followUs" style="position:absolute; top:140px; left:225px; width:80px; height:60px; z-index:5;">
			<img src="images/FollowUs.png" alt="Follow Us!" width="80" height="60" border="0">
		</div>
	</div>
	<div id="bottomContainer" style="position:absolute; top:450px; left:0px; width:960px; min-height:250px; Xbackground-color:#FFFFFF; z-index:1;">
		<div id="spreadingWord" style="position:absolute; top:100px; left:0px; width:600px; height:100px; text-align:center; z-index:4;">
			<span class="hugeWhite"><em><strong>&ldquo;Spread the Word One Belt at a Time&rdquo;</strong></em></span>
		</div>
		<div id="briefDescription" style="position:absolute; top:200px; left:0px; width:100%; height:100px; z-index:4;">
			<span class="biggerWhite">PRAYER BELTS embroider a foundation verse of Scripture or an affirming statement-of-faith onto a color fast web-style belt and turn a common fashion accessory into a personal banner for displaying your faith in places where such displays are prohibited.</span>
		</div>
		<div id="learnMore" style="position:absolute; top:300px; right:25px; width:140px; height:500px; z-index:4;">
			<a href="./"><img src="images/LearnMore.png" alt="Learn More" width="140" height="50" border="0" title="Click for More Information or to Order Now" onMouseOver="this.src='images/LearnMoreOn.png';" onMouseOut="this.src='images/LearnMore.png';"></a>
		</div>
	</div>

	<div id="SocialPostings" style="position:absolute; top:800px; left:50%; margin-left:-480px; width:960px; min-height:750px; z-index:2;">
<!--	<div id="SocialContainer" style="position:absolute; top:0px; left:0px; width:100%;">-->
		<div id="FromBlog" style="position:relative; top:20px; left:0px; width:320px; z-index:3;">
			<img src="images/HitsFromOurBlog.png" alt="" width="275" height="75"><br>
			<table width="280">
			<tr>
				<td colspan="4" class="smallWhite"><font color="#DF5256"><em>October 4, 2011</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyWhite">
					Sed viverra rhoncus mauris, ac elementum mi interdum accumsan. In vel nunc neque, vulputate tincidunt tortor. Proin sed leo metus. Nam et rhoncus quam...
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/PostedIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite">Posted by <font color="#DF5256">Admin</font></td>
				<td width="20"><img src="images/CommentsIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite"><font color="#DF5256">11</font> Comments</td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="280">
			<tr>
				<td colspan="4" class="smallWhite"><font color="#DF5256"><em>October 8, 2011</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyWhite">
					Pellentesque iaculis, sem nec ullamcorper semper, ligula nulla suscipit odio,  tincidunt aliquet nunc arcu et est...
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/PostedIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite">Posted by <font color="#DF5256">Admin</font></td>
				<td width="20"><img src="images/CommentsIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite"><font color="#DF5256">38</font> Comments</td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="280">
			<tr>
				<td colspan="4" class="smallWhite"><font color="#DF5256"><em>October 11, 2011</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyWhite">
					Fusce venenatis ligula a enim aliquam vitae sagittis magna adipiscing. Pellentesque iaculis,sem nec ullamcorper semper, ligula nulla suscipit odio, tincidunt aliquet nunc arcu et est...
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/PostedIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite">Posted by <font color="#DF5256">Admin</font></td>
				<td width="20"><img src="images/CommentsIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite"><font color="#DF5256">547</font> Comments</td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
		</div>

		<div id="FromTwitter" style="position:absolute; top:20px; left:320px; width:45%; z-index:101;">
			<img src="images/LatestFromTwitter.png" alt="" width="275" height="75">
			<?
			//	$hash_tag = "#cowboys OR #rangers";
				$hash_tag = "#prayer OR #belts";
			    $url = 'http://search.twitter.com/search.atom?q='.urlencode($hash_tag) ;
			    $ch = curl_init($url);
			    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
			    $xml = curl_exec ($ch);
			    curl_close ($ch);

			    //If you want to see the response from Twitter, uncomment this next part out:
			    //echo "<p>Response:</p>";
			    //echo "<pre>".htmlspecialchars($xml)."</pre>";

			    $affected = 0;
				$counter = 0;
			    $twelement = new SimpleXMLElement($xml);
			    foreach ($twelement->entry as $entry) {
			        $text = trim($entry->title);
			        $author = trim($entry->author->name);
			        $time = strtotime($entry->published);
			        $id = $entry->id;
			?>
			<table width="280">
			<tr>
				<td colspan="4" class="smallWhite"><font color="#DF5256"><em>@<?=$author;?></em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyWhite">
					<?=$text;?>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/TweetIcon.png" alt="" width="20" height="20"></td>
				<td class="smallWhite"><em>Posted on <font color="#DF5256"><?=date('n.j.y @ g:i a',$time)?></font></em></td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<?
					$counter++;
					if ($counter == 3) break;
			    }
			?>
		</div>

		<div id="Testimonials" style="position:absolute; top:20px; left:640px; width:320px; z-index:3;">
			<img src="images/ClientTestimonials.png" alt="" width="275" height="75"><br>
			<table width="280">
			<tr>
				<td colspan="2" class="smallWhite"><font color="#DF5256"><em>Alex P. - Dallas, Texas</em></font></td>
			</tr>
			<tr>
				<td width="60" valign="top"><img src="images/TestimonialBullet.png" alt="" width="50" height="50"></td>
				<td width="240" valign="top" class="bodyWhite">
					Maecenas euismod aliquet justo, ac adipiscing sapien feugiat at. Morbi sollicitudin augue eu ipsum...
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td colspan="2"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="280">
			<tr>
				<td colspan="2" class="smallWhite"><font color="#DF5256"><em>Shannon M. - St. Louis, Missouri</em></font></td>
			</tr>
			<tr>
				<td width="60" valign="top"><img src="images/TestimonialBullet.png" alt="" width="50" height="50"></td>
				<td width="240" valign="top" class="bodyWhite">
					Fusce venenatis ligula a enim aliquam vitae sagittis magna adipiscing. Pellentesque iaculis,sem nec ullamcorper semper, ligula nulla suscipit odio, tincidunt aliquet nunc arcu et est...
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td colspan="2"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="280">
			<tr>
				<td colspan="2" class="smallWhite"><font color="#DF5256"><em>Darren K. - San Francisco, California</em></font></td>
			</tr>
			<tr>
				<td width="60" valign="top"><img src="images/TestimonialBullet.png" alt="" width="50" height="50"></td>
				<td width="240" valign="top" class="bodyWhite">
					Nulla ligula erat, ultricies non ullamcorper nec, molestie quis mauris. Duis volutpat ante ut arcu dignissim sit amet consequat tellus fringilla...
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td colspan="2"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
		</div>
	</div>
</div>


<div id="footerBackground" style="position:absolute; top:1400px; left:0px; width:100%; min-height:200px; background-color:#FFFFFF; z-index:0;">



<!--<div id="Footer" style="position:relative; top:20px; left:0px; width:100%; min-height:200px; background-color:#FFFFFF; z-index:2;">-->
	<div id="FooterContainer" style="position:absolute; top:0px; left:50%; margin-left:-460px; width:940px;">
		<div id="FooterLinks" style="position:relative; top:18px; left:0px; width:25%; z-index:101;">
			<img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0">&nbsp;&nbsp;<a href="./" class="menuBlack"><nobr>Our Products</nobr></a><br><br>
			<img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0">&nbsp;&nbsp;<a href="./" class="menuBlack"><nobr>Our Vision</nobr></a><br><br>
			<img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0">&nbsp;&nbsp;<a href="./" class="menuBlack"><nobr>Fundraising</nobr></a><br><br>
			<img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0">&nbsp;&nbsp;<a href="./" class="menuBlack"><nobr>Frequently Asked Questions</nobr></a><br><br>
			<img src="images/SymbolBullet.png" alt="" width="17" height="17" border="0">&nbsp;&nbsp;<a href="./" class="menuBlack"><nobr>Contact Us</nobr></a>
		</div>
		<div id="FooterSocial" style="position:absolute; top:15px; left:25%; width:25%; z-index:101;">
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
		<div id="FooterSocial" style="position:absolute; top:20px; left:50%; width:50%; text-align:center; z-index:101;">
			<span class="bodyBlack">Available space for anything else we want to place in the footer.</span>
		</div>
		
	</div>
</div>-->

<div id="bottomBarBackground" style="position:absolute; top:1600px; left:0px; width:100%; min-height:25px; background-color:#1F1F1F; text-align:center; padding:8px 0px 0px 0px; z-index:0;">
	<strong class="bodyWhite">Copyright&copy; 2010-<?=date("Y");?>, Intramedia, Inc.</a>&#174;.&nbsp;&nbsp;All Rights Reserved.</strong>
</div>















<!--
			<table width="100%">
			<tr>
				<td colspan="4" class="smallBlack"><font color="#DF5256"><em>@johnsmith</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyBlack">
					Maecenas euismod aliquet justo, ac adipiscing sapien feugiat at. Morbi sollicitudin augue eu ipsum.
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/TweetIcon.png" alt="" width="20" height="20"></td>
				<td class="smallBlack"><em>Posted on <font color="#DF5256">10.01.2011 @ 9:46 am</font></em></td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="100%">
			<tr>
				<td colspan="4" class="smallBlack"><font color="#DF5256"><em>@vinniebarbarino</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyBlack">
					Nulla ligula erat, ultricies non ullamcorper nec, molestie quis mauris. Duis volutpat ante ut arcu dignissim sit amet consequat tellus fringilla.
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/TweetIcon.png" alt="" width="20" height="20"></td>
				<td class="smallBlack"><em>Posted on <font color="#DF5256">10.02.2011 @ 4:21 pm</font></em></td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="100%">
			<tr>
				<td colspan="4" class="smallBlack"><font color="#DF5256"><em>@howardtheduck</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyBlack">
					Suspendisse eu egestas arcu. Praesent ultrices sollicitudin arcu, vitae sagittis enim lobortis at. 
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/TweetIcon.png" alt="" width="20" height="20"></td>
				<td class="smallBlack"><em>Posted on <font color="#DF5256">10.06.2011 @ 12:37 pm</font></em></td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
		</div>
	</div>

	
	-->
	
	
	
	
	
	
	
	

<!---->
<!--	<div id="page" style="position:absolute; top:0px; left:0px; width:100%; min-height:100%; background:transparent url('images/OrangeBG.jpg') no-repeat center top; z-index:2;">
		<div id="topBar" style="position:absolute; top:0px; left:0px; width:100%; height:25px; background-color:#1f1f1f; z-index:4;">
			<div id="topLogo" style="position:absolute; top:0px; left:20px; width:350px; height:70px; background:transparent url('images/LogoTop.png') no-repeat left top; z-index:5;"></div>-->
<!--		</div>-->
<!--		<div id="stage" style="position:absolute; top:0px; left:0px; width:100%; height:100%; background:transparent url('images/StageBG.png') no-repeat center top; z-index:3;">
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
			</div>-->
<!--		</div>
	</div>-->
</div>

</body>
</html>
