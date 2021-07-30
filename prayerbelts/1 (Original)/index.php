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
</head>

<body background="images/Background.jpg">

<div id="headerBarBG" style="position:fixed; top:0px; left:0px; width:100%; height:60px; background-image:url(images/TopBarBG.jpg); z-index:1000;">
<!--	<div id="headerBar" style="position:relative; top:0px; left:0px; width:100%; height:60px; z-index:101;">-->
	<div id="headerBar" style="position:fixed; top:0px; left:50%; margin-left:-480px; width:960px; height:60px; z-index:1001;">
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td height="65"><img src="images/Header-FollowUs.png" alt="Follow Us On" title="Follow Us!" height="20" width="62"></td>
					<td style="padding-left:10px;"><a href="http://twitter.com" target="_blank"><img src="images/TwitterIcon.png" alt="" width="20" height="20" border="0" title="Follow Us On Twitter!" onMouseOver="this.src='images/TwitterIconOn.png';" onMouseOut="this.src='images/TwitterIcon.png';"></a></td>
					<td style="padding-left:10px;"><a href="http://facebook.com" target="_blank"><img src="images/FacebookIcon.png" alt="" width="20" height="20" border="0" title="Like Us On Facebook!" onMouseOver="this.src='images/FacebookIconOn.png';" onMouseOut="this.src='images/FacebookIcon.png';"></a></td>
					<td style="padding-left:10px;"><a href="http://plus.google.com" target="_blank"><img src="images/Google+Icon.png" alt="" width="20" height="20" border="0" title="+1 (or maybe it's 'Circle') Us On Google Plus!" onMouseOver="this.src='images/Google+IconOn.png';" onMouseOut="this.src='images/Google+Icon.png';"></a></td>
					<td style="padding-left:10px;"><a href="/blog"><img src="images/WordpressIcon.png" alt="" width="20" height="20" border="0" title="Visit Our Blog!" onMouseOver="this.src='images/WordpressIconOn.png';" onMouseOut="this.src='images/WordpressIcon.png';"></a></td>
<!--					<td style="padding-left:30px;"><img src="images/PhoneIcon.png" alt="" title="Call Us At 999.999.9999!" height="20" width="20"></td>
					<td style="padding-left:10px;"><img src="images/Header-CallUs.png" alt="Call Us At" title="Call Us At 999.999.9999!" height="20" width="115"></td>-->
					<td style="padding-left:30px;" onMouseOver="envelopeIcon.src='images/EnvelopeIconOn.png';" onMouseOut="envelopeIcon.src='images/EnvelopeIcon.png';"><img src="images/EnvelopeIcon.png" id="envelopeIcon" alt="" title="Join Our Mailing List" height="20" width="20"></td>
					<td style="padding-left:10px;" onMouseOver="envelopeIcon.src='images/EnvelopeIconOn.png';" onMouseOut="envelopeIcon.src='images/EnvelopeIcon.png';"><img src="images/Header-MailingList.png" alt="Join Our Mailing List" title="Join Our Mailing List!" height="20" width="100"></td>
				</tr>
				</table>
			</td>
			<td align="right">
				<table cellspacing="0" cellpadding="0">
				<tr onMouseOver="cartIcon.src='images/CartIconOn.png'; document.getElementById('cart').style.color='#DF5256';" onMouseOut="cartIcon.src='images/CartIcon.png'; document.getElementById('cart').style.color='#FFFFFF';">
					<td><img src="images/CartIcon.png" id="cartIcon" alt="" title="Your Shopping Cart Is Empty" height="20" width="20"></td>
					<td style="padding-left:10px;"><img src="images/Header-CheckoutCart.png" alt="Checkout|Cart" title="Your Shopping Cart Is Empty" height="20" width="80"></td>
					<td id="cart" style="padding:0px 0px 3px 10px;" class="menuWhite">0 Items</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</div>
</div>

<div id="roundedHeaderBG" style="position:absolute; top:60px; left:0px; width:100%; height:400px; background-image:url(images/RoundedHeaderBG.png); background-position:bottom; z-index:1;"></div>

<div id="pageTopContainer" style="position:relative; top:50px; left:50%; margin-left:-480px; width:960px; min-height:800px; z-index:100;>
	<div id="page" style="position:absolute; top:0px; left:0px; width:100%;">
		<div id="menuBar" style="position:relative; top:40px; left:0px; width:100%; height:60px; z-index:101;">
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<table cellspacing="0" cellpadding="0">
					<tr>
						<td width="50" valign="bottom"><a href="/"><img src="images/MenuLogoSymbol.png" alt="PayerBelts.com" width="50" height="50" border="0" title="Prayer Belts Home Page"></a></td>
						<td valign="bottom" style="padding-left:10px;"><a href="/"><img src="images/MenuLogo.png" alt="" width="335" height="50" border="0" title="Prayer Belts Home Page"></a></td>
						<td align="right"></td>
					</tr>
					</table>
				</td>
				<td align="right">
					<table cellspacing="0" cellpadding="0" class="menuWhite">
					<tr>
						<td><img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>Our Products</nobr></a></td>
						<td style="padding-left:25px;"><img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>Our Vision</nobr></a></td>
						<td style="padding-left:25px;"><img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>Fundraising</nobr></a></td>
						<td style="padding-left:25px;"><img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>F.A.Q.</nobr></a></td>
						<td style="padding-left:25px;"><img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>Contact Us</nobr></a></td>
					</tr>
					</table>
<!--					<table cellspacing="0" cellpadding="0" class="menuWhite">
					<tr>
						<td><a href="/" class="menuWhite"><nobr>Our Products</nobr></a></td>
						<td style="padding-left:25px;"><a href="/" class="menuWhite"><nobr>Our Vision</nobr></a></td>
						<td style="padding-left:25px;"><a href="/" class="menuWhite"><nobr>Fundraising</nobr></a></td>
						<td style="padding-left:25px;"><a href="/" class="menuWhite"><nobr>Frequently Asked Questions</nobr></a></td>
						<td style="padding-left:25px;">&nbsp;<a href="/" class="menuWhite"><nobr>Contact Us</nobr></a></td>
					</tr>
					</table>-->
				</td>
			</tr>
			<tr>
				<td colspan="2"><img src="images/SeperatorLine.png" alt="" height="5" width="960"></td>
			</tr>
			</table>
		</div>
		<div id="headerMessage" style="position:relative; top:70px; left:50%; margin-left:-380px; width:760px; height:60px; text-align:center; z-index:101;">
			<span class="hugeWhite">Introducing Prayer Belts<br>
			<em><font color="#DF5256">"Spreading the Word, One Belt at a Time"</font></em></span><br><br>
<!--put this verbiage on the rotating pictures
			<span class="bigWhite"><font color="#DF5256">PRAYER BELTS</font> were created to combat the systematic removal of prayer from public life.</span><br><br>-->
		</div>
		<div id="homeGallery" style="position:relative; top:110px; left:0px; width:100%; height:500px; z-index:101;">
			<div id="homeGalleryBG" style="position:relative; top:60px; left:50%; margin-left:-475px; width:950px; height:370px; background-image:url(images/HomeGalleryBGImagesBG.png); z-index:102;">
				<table cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td align="center" style="padding-top:4px;">
						<img src="images/HomeGalleryBGImages.jpg" alt="" width="939" height="360">
					</td>
				</tr>
				</table>
			</div>
			<div id="homeGalleryFG" style="position:absolute; top:0px; left:50%; margin-left:-320px; width:640px; height:480px; background-image:url(images/HomeGalleryFGImageBG.png); z-index:103;">
				<table cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td align="center" style="padding-top:8px;">
						<img src="images/HomeGalleryFGImage.jpg" alt="" width="620" height="460">
					</td>
				</tr>
				</table>
				<div id="homeGalleryText" style="position:absolute; top:390px; left:50%; margin-left:-290px; width:580px; height:40px; z-index:104;">
					<span class="bigWhite"><font color="#DF5256">PRAYER BELTS</font> are the fashionable new way for people to express their faith in a world doing everything possible to stop them...</span>
				</div>
			</div>
			<div id="homeGalleryBG" style="position:relative; top:120px; left:50%; margin-left:-475px; width:950px; height:35px; background-image:url(images/HomeGalleryControlBG.png); z-index:102;">
				<table align="center">
				<tr>
					<td height="35"><img src="images/HomeGalleryControlButtonOn.png" alt="" width="14" height="14"></td>
					<td><img src="images/HomeGalleryControlButton.png" alt="" width="14" height="14"></td>
					<td><img src="images/HomeGalleryControlButton.png" alt="" width="14" height="14"></td>
					<td><img src="images/HomeGalleryControlButton.png" alt="" width="14" height="14"></td>
					<td><img src="images/HomeGalleryControlButton.png" alt="" width="14" height="14"></td>
				</tr>
				</table>
			</div>
		</div>
<!--		<div id="homeAffirmationHeadline" style="position:relative; top:150px; left:0px; width:100%; height:50px; text-align:center; z-index:101;">
			<span class="hugeBlack">Introducing Prayer Belts<br>
			<em><font color="#DF5256">"Spreading the Word, One Belt at a Time"</font></em></span><br><br>
		</div>-->
		<div id="homeAffirmation" style="position:relative; top:165px; left:50%; margin-left:-435px; width:870px; height:100px; z-index:101;">
			<span class="bigBlack"><font color="#DF5256">PRAYER BELTS</font> embroider a foundation verse of Scripture or an affirming statement-of-faith onto a color fast web-style belt and turn a common fashion accessory into a personal banner for displaying your faith in places where such displays are prohibited.</span>
			<br><br>
			<span class="bigBlack"><font color="#DF5256">PRAYER BELTS'</font> mission is to Spread the Word, Strengthen the Commitment among the Faithful, Attract the Attention of the Un-Churched, Re-engage the Curiosity of the De-Churched, and Create Excitement with a Fun, Fashionable New Way to Pray.</span>
			
		</div>
	</div>
</div>

<div id="ScrollingBar" style="position:relative; top:220px; left:0px; width:100%; height:175px; background-image:url(images/ScrollingBarBG.png); background-position:top; background-repeat:repeat-x; z-index:2;">
	<table width="950" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="center">
			<img src="images/ScrollingBarTemp.png" alt="" width="950" height="175">
		</td>
	</tr>
	</table>
</div>

<div id="SocialPostings" style="position:relative; top:220px; left:50%; margin-left:-480px; width:960px; min-height:750px; z-index:2;">
	<div id="SocialContainer" style="position:absolute; top:0px; left:0px; width:100%;">
		<div id="FromBlog" style="position:relative; top:20px; left:0px; width:50%; z-index:101;">
			<img src="images/HitsFromOurBlog.png" alt="" width="300" height="75"><br>
			<table width="440">
			<tr>
				<td colspan="4" class="smallBlack"><font color="#DF5256"><em>October 4, 2011</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyBlack">
					Sed viverra rhoncus mauris, ac elementum mi interdum accumsan. In vel nunc neque, vulputate tincidunt tortor. Proin sed leo metus. Nam et rhoncus quam...
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="bodyBlack">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/PostedIcon.png" alt="" width="20" height="20"></td>
				<td width="200" class="smallBlack">Posted by <font color="#DF5256">Admin</font></td>
				<td width="20"><img src="images/CommentsIcon.png" alt="" width="20" height="20"></td>
				<td width="200" class="smallBlack"><font color="#DF5256">11</font> Comments</td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="440">
			<tr>
				<td colspan="4" class="smallBlack"><font color="#DF5256"><em>October 8, 2011</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyBlack">
					Pellentesque iaculis, sem nec ullamcorper semper, ligula nulla suscipit odio,  tincidunt aliquet nunc arcu et est...
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="bodyBlack">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/PostedIcon.png" alt="" width="20" height="20"></td>
				<td width="200" class="smallBlack">Posted by <font color="#DF5256">Admin</font></td>
				<td width="20"><img src="images/CommentsIcon.png" alt="" width="20" height="20"></td>
				<td width="200" class="smallBlack"><font color="#DF5256">38</font> Comments</td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="440">
			<tr>
				<td colspan="4" class="smallBlack"><font color="#DF5256"><em>October 11, 2011</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyBlack">
					Fusce venenatis ligula a enim aliquam vitae sagittis magna adipiscing. Pellentesque iaculis,sem nec ullamcorper semper, ligula nulla suscipit odio, tincidunt aliquet nunc arcu et est...
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="bodyBlack">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/PostedIcon.png" alt="" width="20" height="20"></td>
				<td width="200" class="smallBlack">Posted by <font color="#DF5256">Admin</font></td>
				<td width="20"><img src="images/CommentsIcon.png" alt="" width="20" height="20"></td>
				<td width="200" class="smallBlack"><font color="#DF5256">547</font> Comments</td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
		</div>

		<div id="FromTwitter" style="position:absolute; top:20px; left:50%; width:45%; z-index:101;">
			<img src="images/LatestFromTwitter.png" alt="" width="300" height="75">






<?
//function getTweets($hash_tag) {
//	$hash_tag = "#cowboys OR #rangers";
	$hash_tag = "#prayer OR #belts";
    $url = 'http://search.twitter.com/search.atom?q='.urlencode($hash_tag) ;
//    echo "<p>Connecting to <strong>$url</strong> ...</p>";
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
//        echo "<p>Tweet from ".$author.": <strong>".$text."</strong>  <em>Posted ".date('n/j/y g:i a',$time)."</em></p>";
?>

			<table width="100%">
			<tr>
				<td colspan="4" class="smallBlack"><font color="#DF5256"><em>@<?=$author;?></em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyBlack">
					<?=$text;?>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/TweetIcon.png" alt="" width="20" height="20"></td>
				<td class="smallBlack"><em>Posted on <font color="#DF5256"><?=date('n.j.y @ g:i a',$time)?></font></em></td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>

<?
		$counter++;
		if ($counter == 3) break;
    }

//    return true ;
//}

//getTweets('#Rangers');
?>





















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
			</table>-->
		</div>
	</div>
</div>

<div id="DashedBar" style="position:relative; top:0px; left:0px; width:100%; height:10px; background-image:url(images/SeperatorLine-Dashed.png); background-position:top; background-repeat:repeat-x; z-index:2;"></div>

<div id="Testimonials" style="position:relative; top:20px; left:50%; margin-left:-480px; width:960px; min-height:300px; z-index:2;">
	<img src="images/ClientTestimonials.png" alt="" width="350" height="75"><br>
	<table width="960" cellspacing="10">
	<tr>
		<td colspan="2" class="smallBlack"><font color="#DF5256"><em>Alex P. - Dallas, Texas</em></font></td>
		<td width="20" rowspan="2" align="right" style="background-image:url(images/TestimonialsLine.png); background-position:top; background-repeat:repeat-y;">&nbsp;</td>
		<td colspan="2" class="smallBlack"><font color="#DF5256"><em>Shannon M. - St. Louis, Missouri</em></font></td>
		<td width="20" rowspan="2" align="right" style="background-image:url(images/TestimonialsLine.png); background-position:top; background-repeat:repeat-y;">&nbsp;</td>
		<td colspan="3" class="smallBlack"><font color="#DF5256"><em>Darren K. - San Francisco, California</em></font></td>
	</tr>
	<tr>
		<td width="60" valign="top"><img src="images/TestimonialBullet.png" alt="" width="50" height="50"></td>
		<td width="240" valign="top" class="bodyBlack">
			Maecenas euismod aliquet justo, ac adipiscing sapien feugiat at. Morbi sollicitudin augue eu ipsum...
		</td>
		<td width="60" valign="top"><img src="images/TestimonialBullet.png" alt="" width="50" height="50"></td>
		<td width="240" valign="top" class="bodyBlack">
			Fusce venenatis ligula a enim aliquam vitae sagittis magna adipiscing. Pellentesque iaculis,sem nec ullamcorper semper, ligula nulla suscipit odio, tincidunt aliquet nunc arcu et est...
		</td>
		<td width="60" valign="top"><img src="images/TestimonialBullet.png" alt="" width="50" height="50"></td>
		<td width="240" valign="top" class="bodyBlack">
			Nulla ligula erat, ultricies non ullamcorper nec, molestie quis mauris. Duis volutpat ante ut arcu dignissim sit amet consequat tellus fringilla...
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right" class="bodyBlack">
			<em>More >></em>
		</td>
		<td colspan="3" align="right" class="bodyBlack">
			<em>More >></em>
		</td>
		<td colspan="3" align="right" class="bodyBlack">
			<em>More >></em>
		</td>
	</tr>
	</table>
</div>

<div id="Footer" style="position:relative; top:0px; left:0px; width:100%; min-height:200px; background-image:url(images/FooterBG.png); background-position:top; background-repeat:repeat-x; z-index:2;">
	<div id="FooterContainer" style="position:absolute; top:0px; left:50%; margin-left:-480px; width:960px;">
		<div id="FooterLinks" style="position:relative; top:20px; left:0px; width:25%; z-index:101;">
			<img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>Our Products</nobr></a><br><br>
			<img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>Our Vision</nobr></a><br><br>
			<img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>Fundraising</nobr></a><br><br>
			<img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>Frequently Asked Questions</nobr></a><br><br>
			<img src="images/SymbolBullet.png" alt="" width="10" height="10" border="0">&nbsp;<a href="/" class="menuWhite"><nobr>Contact Us</nobr></a>
		</div>
		<div id="FooterSocial" style="position:absolute; top:20px; left:25%; width:25%; z-index:101;">
			<table>
			<tr onMouseOver="TwitterFooterIcon.src='images/TwitterFooterIconOn.png'; document.getElementById('TwitterFooterText').style.color='#DF5256';" onMouseOut="TwitterFooterIcon.src='images/TwitterFooterIcon.png'; document.getElementById('TwitterFooterText').style.color='#FFFFFF';">
				<td>
					<a href="/" class="menuWhite"><img src="images/TwitterFooterIcon.png" alt="" id="TwitterFooterIcon" width="40" height="40" border="0"></a>
				</td>
				<td>&nbsp;&nbsp;<a href="/" id="TwitterFooterText" class="menuWhite"><nobr>Follow Us On Twitter</nobr></a></td>
			</tr>
			<tr onMouseOver="FacebookFooterIcon.src='images/FacebookFooterIconOn.png'; document.getElementById('FacebookFooterText').style.color='#DF5256';" onMouseOut="FacebookFooterIcon.src='images/FacebookFooterIcon.png'; document.getElementById('FacebookFooterText').style.color='#FFFFFF';">
				<td>
					<a href="/" class="menuWhite"><img src="images/FacebookFooterIcon.png" alt="" id="FacebookFooterIcon" width="40" height="40" border="0"></a>
				</td>
				<td>&nbsp;&nbsp;<a href="/" id="FacebookFooterText" class="menuWhite"><nobr>Like Us On Facebook</nobr></a></td>
			</tr>
			<tr onMouseOver="GoogleFooterIcon.src='images/Google+FooterIconOn.png'; document.getElementById('GoogleFooterText').style.color='#DF5256';" onMouseOut="GoogleFooterIcon.src='images/Google+FooterIcon.png'; document.getElementById('GoogleFooterText').style.color='#FFFFFF';">
				<td>
					<a href="/" class="menuWhite"><img src="images/Google+FooterIcon.png" alt="" id="GoogleFooterIcon" width="40" height="40" border="0"></a>
				</td>
				<td>&nbsp;&nbsp;<a href="/" id="GoogleFooterText" class="menuWhite"><nobr>+1 (Plus/Circle?) Us On Google+</nobr></a></td>
			</tr>
			</table>
		</div>
		<div id="FooterSocial" style="position:absolute; top:20px; left:50%; width:50%; text-align:center; z-index:101;">
			<span class="bodyWhite">Available space for anything else we want to place in the footer.</span>
		</div>
		
	</div>
</div>



</body>
</html>
