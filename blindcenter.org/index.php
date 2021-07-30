<?
// Break out of HTTPS from Baskets Cart
if ($_SERVER["HTTPS"] && $_REQUEST["sec"] != "baskets"){
	header("Location: http://www.blindcenter.org/?".$QUERY_STRING);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<!--
Title - Blind Center of Nevada 
Development Copyright 2004-2005, Network Resources - Las Vegas, Nevada USA (www.nr.net)
Digital Art Copyright 2004-2005, Network Resources and Blind Center of Nevada Respectively
All Content Copyright 2004-2005, Network Resources and Blind Center of Nevada Respectively
Authored by Jeff S. Saunders, Network Resources 11/15/04
Modified by Jeff S. Saunders, Network Resources 02/03/09
-->

<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$page = $_REQUEST['page'];
$cargo = $_REQUEST['cargo'];

// Connect to the database
include "dbconnect.php";
// Get Configuration Settings
$query = "SELECT * FROM config WHERE 1";
$rs_config = mysql_query( $query, $linkID);
$config = mysql_fetch_assoc($rs_config);
?>

<html>
<head>
	<title>Blind Center of Nevada</title>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="en-us">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Services For The Blind">
	<meta name="Description" content="Blind Center of Nevada, Las Vegas.">
	<meta name="Keywords" content="Blind Center of Nevada, nevada, Nevada, NEVADA, las vegas, Las Vegas, LAS VEGAS, vegas, Vegas, VEGAS, blind, blind center, Blind Center, BLIND CENTER, blindcenter, BLINDCENTER, vision, impaired, isight, ISight, ISIGHT, keller, Keller, braille, aids, volunteer, Independent Living Skills Training, Computer Training, Low Vision Aids Demonstrations and Sales, Braille Instructions, Referrals, Arts and Crafts, Ceramics, Socials, Day Trips, Exercise Classes, Jacuzzi and Sauna, Bowling, Games and Recreation, Vocational Rehabilitation and Placement, Product Assembly, Kit Assembly, Packaging, Shrink Wrap, Bubble Wrap, Skin Wrap, Blister Pack, Repackaging, Heat Sealing, Mail Preparation, Collating, Folding, Sorting, Braille Translation, Chair Caning ">
	<meta name="robots" content="all"> <!-- all, none, index, noindex, follow or nofollow-->

	<!-- Define Home Base -->
	<?
	if ($_SERVER["HTTPS"]){
	?>
	<base href="https://secure.nr.net/blindcenter/">
	<?
	}else{
	?>
        <!--<base href="http://www.blindcenter.org/">-->
 	<base href="http://www.nr.net/archive/blindcenter/httpdocs/">
	<?
	}
	?>

	<!-- Page Transition Effect -->
<!--
	<meta http-equiv="Page-Enter" content="blendTrans(Duration=0.5)">
	<meta http-equiv="Page-Exit" content="blendTrans(Duration=0.5)">
	<meta http-equiv="Site-Enter" content="blendTrans(Duration=0.5)">
	<meta http-equiv="Site-Exit" content="blendTrans(Duration=0.5)">
-->

	<!-- Load Style Sheets - Order *IS* Important! -->
	<link href="standard.css" rel="stylesheet" type="text/css">
	<link href="largetype.css" rel="stylesheet" type="text/css">
	<link href="xlargetype.css" rel="stylesheet" type="text/css">

	<!-- Blinking Text -->
	<script>
	// Before you use this script you may want to have your head examined
	function doBlink() {
		// Blink, Blink, Blink...
		var blink = document.all.tags("BLINK")
		for (var i=0; i < blink.length; i++)
			blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : "" 
	}

	function startBlink() {
		// Only if it's IE
		if (document.all)
			setInterval("doBlink()",500)
	}
	//window.onload = startBlink;  //Start in body tag instead
	</script>
	
	<!-- Show/Hide layers -->
	<script>
	// Swap layer visibility
	function show(id) {
		document.getElementById(id).style.visibility = "visible";
		document.getElementById(id).style.display = "block";
	}
	function hide(id) {
		document.getElementById(id).style.visibility = "hidden";
		document.getElementById(id).style.display = "none";
	}
	</script>

	<!-- Set a cookie -->
	<script language="JavaScript1.1">
	function setCookie(name, value, months) {
		var expire = new Date();
		expire.setMonth(expire.getMonth()+months)
		document.cookie = name + "=" + escape(value)
		+ ((expire == null) ? "" : ("; expires=" + expire.toGMTString()))
	}
	</script>

	<!-- Read a cookie -->
	<script language="JavaScript1.1">
	function getCookie(Name) {
		var search = Name + "="
		if (document.cookie.length > 0) { // if there are any cookies
			offset = document.cookie.indexOf(search) 
			if (offset != -1) { // if cookie exists 
				offset += search.length 
				// set index of beginning of value
				end = document.cookie.indexOf(";", offset) 
				// set index of end of cookie value
				if (end == -1) 
					end = document.cookie.length
					return unescape(document.cookie.substring(offset, end))
			} 
		}
	}
	</script>

	<!-- Read cookie to get preferred font size & last quote displayed-->
	<script language="JavaScript1.1">
	if (getCookie("stylesheet") != null) {
		var css = getCookie("stylesheet");
	}else{
		setCookie('stylesheet', 0, 1);
		var css = 0;
	}
	if ((getCookie("quote") != null) && (getCookie("quote") != "undefined")) {
		var q = getCookie("quote");
	}else{
		setCookie('quote', 0, 1);
		var q = 0;
	}
	</script>
	
	<!-- Swap Style Sheets -->
	<script language="JavaScript">
	function swapCSS(cssNum){
		if (document.styleSheets){
			var cssQty = document.styleSheets.length;
			for (var cnt = 0; cnt < cssQty; cnt++){
				if (cnt != cssNum){
					document.styleSheets[cnt].disabled=true;
				}else{
					document.styleSheets[cnt].disabled=false;
					setCookie('stylesheet', cnt, 1);
				}
			}
		}
	}
	// Set initial stylesheet
	swapCSS(css);
	</script>

	<!-- Fading Quotes -->
	<script>
	// (C) 2000 www.CodeLifter.com
	// http://www.codelifter.com
	// Free for all users, but leave in this header
	// NS4-6,IE4-6
	// Fade effect only in IE; degrades gracefully

	// =======================================
	// set the following variables
	// =======================================

	// Set slideShowSpeed (milliseconds)
	var slideShowSpeed = 15000

	// Duration of crossfade (seconds)
	var crossFadeDuration = 3

	// Specify the image files
	var Pic = new Array()
	Pic[0] = 'images/quotes/keller1.gif'
	Pic[1] = 'images/quotes/frost1.gif'
	Pic[2] = 'images/quotes/keller4.gif'
	Pic[3] = 'images/quotes/roosevelt1.gif'
	Pic[4] = 'images/quotes/keller2.gif'
	Pic[5] = 'images/quotes/teresa1.gif'
	Pic[6] = 'images/quotes/coolidge1.gif'
	Pic[7] = 'images/quotes/keller3.gif'
	Pic[8] = 'images/quotes/ross1.gif'

	// =======================================
	// do not edit anything below this line
	// =======================================

	var j = q
	var p = Pic.length

	var preLoad = new Array()
	for (i = 0; i < p; i++){
 		preLoad[i] = new Image()
		preLoad[i].src = Pic[i]
	}

	function runSlideShow(){
	setCookie('quote', j, 1);
	if (document.all){
		document.images.SlideShow.style.filter="blendTrans(duration=2)"
		document.images.SlideShow.style.filter="blendTrans(duration=crossFadeDuration)"
		document.images.SlideShow.filters.blendTrans.Apply()      
	}
	document.images.SlideShow.src = preLoad[j].src
	if (document.all){
		document.images.SlideShow.filters.blendTrans.Play()
	}
	j++
	if (j > (p-1)) j=0
		t = setTimeout('runSlideShow()', slideShowSpeed)
	}
	</script>

</head>

<body bgcolor="#B466AD" leftmargin="0" topmargin="10" marginwidth="0" marginheight="0" onload="show_clock();runSlideShow();startBlink();">

<div class="bodyTop"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></div>

<div class="bodyMiddle">

<table width="804" border="0" cellspacing="0" cellpadding="2" align="center" bgcolor="#892A81">
<tr>
	<td>
		<table width="800" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		
		<!-- BEGIN Header Section -->
		<tr>
			<!-- Header -->
			<td height="130" colspan="2">
				<table width="800" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" background="images/headerbg.jpg">
				<tr>
					<!-- Quotes -->
					<td height="120" valign="bottom" id="VU"><img src="images/spacer.gif" alt="" name="SlideShow" id="SlideShow" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br></td>
					<!-- Logo -->
					<!-- Determine browser and call special filter code to work around PNG-24 bug in IE5+ & Opera -->
					<?
					$msie='/msie\s(5\.[5-9]|[6-9]\.[0-9]*).*(win)/i'; 
					if( !isset($_SERVER['HTTP_USER_AGENT']) || !preg_match($msie,$_SERVER['HTTP_USER_AGENT']) || preg_match('/opera/i',$_SERVER['HTTP_USER_AGENT'])) {
						$logo = '<img src="images/headerlogo3.png" alt="" width="180" height="130" border="0">';
					}else{
						$logo = '<img src="images/spacer.png" style="width:180; height:130; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'images/headerlogo3.png\', sizingMethod=scale);" alt="" border="0">';
					}
					?>
					<td width="200" rowspan="2" align="center" valign="top"><a href="."><? echo $logo; ?></a></td>
				</tr>
				<tr>
					<td align="left" valign="top" class="smallBlack"><img src="images/spacer.gif" alt="" width="8" height="1" border="0"><strong><? include("./liveclock.js"); ?></strong><br><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- Purple Line -->	
			<td bgcolor="#892A81" colspan="2"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
		</tr>
		<tr>
			<!-- Image Bar -->
			<td height="60" bgcolor="#892A81" colspan="2"><img src="images/headerimagebar.jpg" alt=""border="0"></td>
		</tr>
		<tr>
			<!-- Purple Line -->	
			<td bgcolor="#892A81" colspan="2"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
		</tr>
		<tr>
			<!-- Status Bar -->	
			<td bgcolor="#CEB2D0" colspan="2" background="images/statusbarbg.jpg" class="bodyBlack">
				<table width="800" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><img src="images/spacer.gif" alt="" width="1" height="30" border="0"></td>
					<td width="524" align="left" valign="top" class="scrollBlack">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong><img src="images/spacer.gif" alt="" width="6" height="10" border="0">&raquo;&nbsp;</strong>
		
						<!-- Display Typwriter Scroller -->
						<script language="Javascript1.2"> 
						var tags_before = '<strong><em>';
						var tags_after  = '&#95;</em></strong>';
						var speed = 50;  //delay between "key strokes"
						var speed2 = 5000; //delay between messages
		
						function initArray() {
							this.length = initArray.arguments.length;
							for (var i = 0; i < this.length; i++) {
								this[i] = initArray.arguments[i];
							}
						}
						var myopentag = new initArray(
							'<a href=\'http://www.blindcenter.org/?sec=recycling\' class=\'scrollBlack\'><font color=\'#FF0000\'>',
							'<a href=\'http://www.blindcenter.org/?sec=recycling\' class=\'scrollBlack\'>',
							'<a href=\'http://www.blindcenter.org/?sec=recycling\' class=\'scrollBlack\'>',
							'<a href=\'http://www.blindcenter.org/?sec=recycling\' class=\'scrollBlack\'>'
//							'<a href=\'http://www.blindcenter.org/pdf/Blind Center news release F.pdf\' target=\'_blank\' class=\'scrollBlack\'><font color=\'#FF0000\'><blink>',
//							'<a href=\'http://www.blindcenter.org/pdf/Blind Center news release F.pdf\' target=\'_blank\' class=\'scrollBlack\'>',
//							'<a href=\'http://www.blindcenter.org/pdf/Blind Center news release F.pdf\' target=\'_blank\' class=\'scrollBlack\'>'
						)
						var mymessage = new initArray(
							'NOW AVAILABLE!',
							'Computer & Electronics Recycling Services.',
							'You drop off or we pick up.',
							'CLICK HERE for more information.'
//							'E-Waste Recycling Collection Event.',
//							'November 18, 8:00am - Noon.',
//							'CLICK HERE for more information.'
						)
						var myclosetag = new initArray(
							'</font>',
							'',
							'',
							''
//							'</blink></font>',
//							'',
//							''
						)
						var mymessage2 = mymessage;
						var x = 0;
						var y = 0;
		
						if(navigator.appName == "Netscape") {
							document.write('<layer id="ticker"></layer><br>');
						}
		
						if (navigator.appVersion.indexOf("MSIE") != -1){
							document.write('<span id="ticker"></span><br>');
						}
		
						function upticker(){ 
							if (y > mymessage2.length - 1) {
								y = 0;
								setTimeout("upticker()",speed);
							}else{
								if (x > mymessage2[y].length) {
									mymessage = mymessage2[y]; 
									opentag = myopentag[y];
									closetag = myclosetag[y];
									x = 0; y++;
									setTimeout("upticker()",speed2);
								}else{
									mymessage = mymessage2[y].substring(0,x++);
									opentag = myopentag[y];
									closetag = myclosetag[y];
									setTimeout("upticker()",speed);
								}
								if(navigator.appName == "Netscape") {
									ticker.innerHTML = tags_before+opentag+mymessage+tags_after+closetag;
									document.ticker.visibility='show';
									ticker.document.write(tags_before+opentag+mymessage+tags_after+closetag);
								}
								if (navigator.appVersion.indexOf("MSIE") != -1){
									ticker.innerHTML = tags_before+opentag+mymessage+tags_after+closetag;
								}
							}
						} 
		
						setTimeout("upticker()",speed);
						</script>
					</td>
					<td width="275" align="right" valign="top" class="menuBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Text Size:&nbsp;&nbsp;<a href="JavaScript:swapCSS(0)" class="menuBlack"><strong>Normal</strong></a>&nbsp;|&nbsp;<a href="JavaScript:swapCSS(1)" class="menuBlack"><strong>Large</strong></a>&nbsp;|&nbsp;<a href="JavaScript:swapCSS(2)" class="menuBlack"><strong>Extra Large</strong></a><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<!-- END Header Section-->
		
		<!-- BEGIN Lower Section -->
		<tr>
			<td rowspan="2" valign="top" bgcolor="#FFFFFF">
		
				<!-- BEGIN Main Menu -->
				<table width="145" border="0" cellspacing="0" cellpadding="0" bgcolor="#CEB2D0" background="images/menubg.jpg">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<tr>
					<td class="menuBlack">
						<? if ((!$sec) || $sec == "home") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=home" class="menuBlack" ><strong>Home</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "about") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=about" class="menuBlack"><strong>About Us</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "mission") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=mission" class="menuBlack"><strong>Our Mission</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "products") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=products" class="menuBlack"><strong>Products We Sell</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "services") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=services" class="menuBlack"><strong>Services We Offer</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "recycling") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=recycling" class="menuBlack"><strong>Computer Recycling</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "programs") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=programs" class="menuBlack"><strong>Programs</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
<!--						<?// if ($sec == "jobs") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=blank" class="menuBlack"><strong>Job Opportunities</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>-->
						<? if ($sec == "assistance") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=assistance" class="menuBlack"><strong>Assistance</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "volunteer") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=volunteer" class="menuBlack"><strong>Volunteering</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "partners" || $sec == "reflections") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=partners" class="menuBlack"><strong>Corporate Partners</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "news") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=news" class="menuBlack"><strong>In The News</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "gallery") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=gallery" class="menuBlack"><strong>Photo Gallery</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "chatterbox") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=chatterbox" class="menuBlack"><strong>Monthly Newsletter</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "blog") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="http://blindcenterofnevada.blogspot.com" target="_blank" class="menuBlack"><strong>Daily Blog</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
<!--						<?// if ($sec == "registration") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=blank" class="menuBlack"><strong>Registration Form</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>-->
						<? if ($sec == "resources") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=resources" class="menuBlack"><strong>Resources</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
<!--						<?// if ($sec == "privacy") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=blank" class="menuBlack"><strong>Privacy Statement</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>-->
						<? if ($sec == "contact") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=contact" class="menuBlack"><strong>Contact Us</strong></a><br><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<? if ($sec == "baskets") {echo '<img src="images/whitebullet.gif" alt="" width="7" height="9" border="0">';}else{echo '<img src="images/spacer.gif" alt="" width="7" height="10" border="0">';}?><a href="?sec=baskets" class="menuSpecial"><strong>Holiday Baskets</strong></a><img src="images/redbow-m.gif" alt="" width="19" height="13" border="0"><br>
						<div align="center">
							<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but21.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
							<img src="images/spacer.gif" alt="" width="2" height="1" border="0">
							<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
		">
						</div>
					</td>
				</tr>
				</form>
				<tr>
					<td colspan="1" bgcolor="#CEB2D0"><img src="images/menubottom.jpg" width="145" height="16" alt="" border="0"></td>
				</tr>
				<!-- END Main Menu -->
		
				<!-- BEGIN Body Under Left Column/Menu -->
				<tr>
					<td align="center" bgcolor="#FFFFFF">
					</td>
				</tr>
				<tr>
					<td align="center" bgcolor="#FFFFFF">
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
						<!-- Contact Box -->
						<table width="120" border="1" cellspacing="0" cellpadding="5" align="center" bordercolor="#C0C0C0">
						<tr>
							<td bgcolor="#FDF3FE" class="smallBlack">
								<div align="center"><img src="images/logo100.gif" width="100" height="78" alt="" border="0"><br>
								<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
								<img src="images/blackdot.gif" alt="" width="105" height="1" border="0"></div>
								<strong>1001 N. Bruce Street<br>Las Vegas, NV  89101<br><br>702.642.6000 Phone<br>702.649.6739 Fax<br><br><a href="mailto:info@blindcenter.org" class="smallBlack">info@blindcenter.org</a></strong>
							</td>
						</tr>
						</table>
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					</td>
				</tr>
				<?
				// Reflections of Light Box
				if ($sec == "partners"){
				?>
				<tr>
					<td align="center" bgcolor="#FFFFFF">
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
						<table width="120" border="1" cellspacing="0" cellpadding="5" align="center" bordercolor="#000000">
						<tr>
							<td bgcolor="#D0D0D0" class="smallBlack">
								<div align="center"><img src="images/reflections100.gif" width="100" height="83" alt="" border="0"><br>
								<img src="images/spacer.gif" alt="" width="1" height="4" border="0"><br>
								<img src="images/blackdot.gif" alt="" width="105" height="1" border="0"></div>
								<strong>Corporate<br><div align="center">Partnership</div><div align="right">Program</div></strong>
								<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
								<div align="center"><img src="images/trianglebullet.gif" width="8" height="9" border="0"> <a href="?sec=reflections" class="bigBlack"><strong>Join Today</em></strong></a></div>
							</td>
						</tr>
						</table>
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					</td>
				</tr>
				<?
				}
//				if ($_SERVER["HTTPS"]){  //Moved this to the header of each encrypted baskets page
				if (false){
				?>
				<tr>
					<td align="center" bgcolor="#FFFFFF">
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
						<table width="120" border="1" cellspacing="0" cellpadding="5" align="center" bordercolor="#C0C0C0">
						<tr>
							<td align="center">
								<!-- SSL Site Seal -->
								<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>
								<font face="sans-serif" size="2" color="#000000"><strong>SSL Secure & Authentic Site</strong><br></font>
								<script type="text/javascript">TrustLogo("/images/siteseal.gif", "SC","none");</script>
							</td>
						</tr>
						</table>
						<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
					</td>
				</tr>
				<?
				}
				?>
				<!-- END Body Under Left Column/Menu -->
				</table>
			</td>
		
			<!-- BEGIN Main Body -->
			<td width="655" align="center" valign="top" bgcolor="#FFFFFF" background="images/logowm.jpg" style="background-position: top; background-repeat: no-repeat; background-attachment: scroll;">
				<?
				if ((!$sec) || $sec == "home") include("include/home.php");
				if ($sec == "about") include("include/about.php");
				if ($sec == "mission") include("include/mission.php");
				if ($sec == "products") include("include/products.php");
				if ($sec == "services") include("include/services.php");
				if ($sec == "recycling") include("include/recycling.php");
				if ($sec == "programs") include("include/programs.php");
//				if ($sec == "jobs") include("include/jobs.php");
				if ($sec == "assistance") include("include/assistance.php");
				if ($sec == "volunteer") include("include/volunteer.php");
				if ($sec == "partners") include("include/partners.php");
				if ($sec == "gallery") include("include/gallery.php");
				if ($sec == "news") include("include/news.php");
				if ($sec == "chatterbox") include("include/chatterbox.php");
//				if ($sec == "registration") include("include/registration.php");
				if ($sec == "resources") include("include/resources.php");
//				if ($sec == "privacy") include("include/privacy.php");
				if ($sec == "contact") include("include/contact.php");
				if ($sec == "reflections") include("include/reflections.php");
				if ($sec == "baskets") include("include/baskets.php");
				if ($sec == "details") include("include/details.php");
				if ($sec == "blank") include("include/blank.php");
				?>
			</td>
			<!-- END Main Body -->
		
		</tr>
		<!-- Body Footer (Braille) -->
		<tr>
			<td align="center" valign="bottom">
				<img src="images/blackdot.gif" alt="" width="640" height="1" border="0"><br><img src="images/braillefoot.gif" alt="" width="350" height="40" border="0">
			</td>
		</tr>
		<!-- END Lower Section -->
		
		<!-- BEGIN Footer Section -->
		<tr>
			<!-- Purple Line -->	
			<td colspan="2" bgcolor="#892A81"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
		</tr>
		<tr>
			<!-- Footer -->	
			<td colspan="2" align="center" bgcolor="#CEB2D0" class="smallBlack">
				<img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br>
				<strong>Copyright&copy; 2001-<? echo date("Y"); ?>, <a href="http://www.blindcenter.org" title="You're Already Here!" class="smallBlack">Blind Center of Nevada</a>.&nbsp;&nbsp;All Rights Reserved.<br>
				Development, Maintenance, &amp; Hosting Donated by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallBlack">Network Resources</a>, Las Vegas-Dallas-Milwaukee<br>
				<img src="images/spacer.gif" width="1" height="5" alt="" border="0"><br></strong>	
			</td>
		</tr>
		<!-- END Footer Section -->
		
		</table>
	</td>
</tr>
</table>

<!-- FOR TESTING, REMOVE ME -->
<!--<a href="?sec=products" class="menuBlack"><img src="images/spacer.gif" width="50" height="50" alt="" border="0"></a>-->

</div>

<div class="bodyBottom"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></div>

</body>
</html>
