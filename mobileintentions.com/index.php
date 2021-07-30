<?
session_start(); 
header("Cache-control: private");  // IE 6 Fix.
?>
<!-- Start a session above -->
<!-- must be FIRST thing done, even before a comment -->

<!-- Assign passed variables -->
<?
// Interrogate and reassign passed variables
$sec = $_GET['sec'];
$prod_id = $_GET['prod'];
$terms = $_GET['terms'];
if (($_GET['zipcode']) && ($_SESSION['zipcode'] != $_GET['zipcode'])){
	$_SESSION['zipcode'] = $_GET['zipcode'];
}
?>

<!-- Declare zipcode -->
<? $zipcode = $_SESSION['zipcode']; ?> 
<script>var zipcode = "<? echo $zipcode; ?>";</script>

<!-- Grab The Database -->
<?
// Connect to the database
include "dbconnect.php";
?>

<!-- PHP Functions -->
<?
// Is passed value odd?
function is_odd($num){
	return (is_numeric($num)&($num&1));
}
 
// Is passed value even?
function is_even($num){
	return (is_numeric($num)&(!($num&1)));
}

// Determine browser type
function browser_type(){
	$browser = array ( //reversed array
		"OPERA",
		"MSIE",    // parent
		"NETSCAPE",
		"FIREFOX",
		"SAFARI",
		"KONQUEROR",
		"MOZILLA"  // parent
	);
	$info[browser] = "OTHER";
	foreach ($browser as $parent){
		if (($s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent)) !== FALSE){
			$f = $s + strlen($parent);
			$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 5);
			$version = preg_replace('/[^0-9,.]/','',$version);
			$info['browser'] = $parent;
			$info['version'] = $version;
			break; // first match wins
		}
	}
	return $info;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title>T-Mobile Free Phones | Free Motorola RAZR | T-Mobile Wireless Offer | T-Mobile Cellular Plans | T-Mobile BlackBerry PEBL</title>

	<!-- Meta Tags -->
	<meta name="description" content="Mobile Intentions for T-Mobile Free Phones including the Free Motorala RAZR adn the T-Mobile BlackBerry PEBL. T-Mobile Wireless Offer and Cellular Plans">
	<meta name="keywords" content="T-Mobile Free Phones,Free Motorola RAZR,T-Mobile Wireless Offer,T-Mobile Cellular Plans,T-Mobile BlackBerry PEBLcell phone,Cell Phones,Cellular Phones,Cellphone,cellphones,free cell phones,free cellular phones,free phones,cell phone plans,mobile phone,wireless phone,cellular phone service,service plan,cellular phone plans,wireless phone service,cell phone accessories, purchase cell phone,buy cell phone,research cell phones,">
	<meta name="robots" content="all, index, follow">
	<meta name="revisit-after" content="3 days">
	<meta name="category" content="Cellular Wireless Phones & Accessories">
	<meta name="subject" content="Cellular Wireless Phones & Accessories">
	<meta name="classification" content="Cellular Wireless Phones & Accessories">
	<meta name="rating" content="General">
	<meta name="author" content="Network Resources - www.nr.net">
	<meta http-equiv="code-language" content="PHP5">
	<meta http-equiv="content-language" content="en-us">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<meta name="distribution" content="United States, USA, United States of America">
	<meta name="coverage" content="United States, USA, United States of America">
	<meta name="VW96.objecttype" content="T-Mobile Mobile Wireless Cell Phones &amp; Cellular Phone Equipment.">
	<meta name="DC.title" content="Mobile Intentions - Your Source For Everything T-Mobile | Free Cell Phones | Motorola Pink RAZR | Blackberry | Sidekick | MDA">
	<meta name="DC.subject" content="Cellular Wireless Phones & Accessories">
	<meta name="DC.description" content="Mobile Intentions - Your Source For Everything T-Mobile | Free Cell Phones | Motorola Pink RAZR | Blackberry | Sidekick | MDA">
	<meta name="DC.Coverage.PlaceName" content="United States, USA, United States of America">

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Menu Description Text Swapping -->
	<style type="text/css">
		#divLinks   {position:absolute; left:150px; top:150px; visibility:hidden;}
		#divLinks a {color:#8b0000; font-family:verdana,arial,helvetica,sans-serif; font-size:12px; font-weight:700;}
		#divMessage {position:relative; left:0px; width:530px; top:0px; visibility:hidden;}
	</style>

	<!-- SSL Site Seal -->
	<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	
	
</head>

<body bgcolor="#808080" leftmargin="0" topmargin="10" marginwidth="0" onload="changeTextInit();show_clock();">  <!--textPulse('pulse');-->

<!-- SEO -->
<h1 class="comment">Mobile Intentions is the leading authorized T-Mobile dealer site, offering only the very best in FREE and low cost discounted wireless cell phones and cellular telephone equipment.</h1>
<h1 class="comment">cell phone, Cell Phones, Cellular Phones, Cellphone, cellphones, free cell phones, free cellular phones, free phones, cell phone plans, mobile phone, wireless phone, cellular phone service, service plan, cellular phone plans, wireless phone service, cell phone accessories, purchase cell phone, buy cell phone, research cell phones, compare cell phone prices, compare cell phones, cell phone comparison, cell service comparison, best price, deal, deals, great deals, discount, discounts, specials, cheap, T Mobile, T-Mobile, t mobile, t-mobile, blackberry, Blackberry, BlackBerry, 7100t, 7105t, 7290, 8700, 8700g, t-mobile mda, t-mobile sda, sidekick, sidekick 2, sidekick 3, Motorola, motorola RAZR, pink razr, PEBL, V188, V360, Samsung, samsung t309, t809, x495, Nokia, nokia 6010, 6101, Sony, Ericsson, Sony Ericsson, sony ericsson GC89, Treo, PDA, Bluetooth, bluetooth, hands free, google, ebay, yahoo, american idol, 24, music, hot, las vegas</h1>

<table width="950" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#EAEAEA">
<!-- Header -->
<tr>
	<td height="100" background="images/HeaderBG.jpg"><img src="images/spacer.gif" alt="" width="1" height="60" border="0"><br><img src="images/spacer.gif" alt="" width="100" height="1" border="0"><script src="upticker.js"></script></td>
</tr>
<tr>
	<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="950" height="1" border="0"></td>
</tr>
<!-- Menu -->
<tr>
	<td bgcolor="#C0C0C0" class="menuBlack"><img src="images/spacer.gif" alt="" width="950" height="1" border="0"><br>
		<table width="950" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<!-- <h#> tags found throughout are for SEO -->					<!--<a onClick="show(\'zipprompt\',\''.$destination.'\');" style="cursor:pointer;">-->
			<div id="divLinks">
				<td width="81" align="center" onmouseover="changeText(1)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=home" class="menuBlack" title="Home Page">Home</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
<!--				<td width="81" align="center" onmouseover="changeText(2)" onmouseout="changeText(0)"><h2><a href="#" onClick="show('zipprompt2','http://www.mobileintentions.nr.net/?sec=phones','');" class="menuBlack" title="Show All Phones" style="cursor:pointer;">All Phones</a></td></h2>-->
				<td width="81" align="center" onmouseover="changeText(2)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=phones" class="menuBlack" title="Show All Phones">All Phones</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
				<td width="81" align="center" onmouseover="changeText(10)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=accessories" class="menuBlack" title="Phone Accessories">Accessories</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
				<td width="81" align="center" onmouseover="changeText(3)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=plans" class="menuBlack" title="T-Mobile Service Plans">Plans</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
				<td width="81" align="center" onmouseover="changeText(4)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=coverage" class="menuBlack" title="T-Mobile Coverage Map">Coverage</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
				<td width="81" align="center" onmouseover="changeText(5)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=rebates" class="menuBlack" title="Rebate Forms & Information">Rebates</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
				<td width="81" align="center" onmouseover="changeText(6)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=terms" class="menuBlack" title="Terms & Conditions">Terms</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
				<td width="81" align="center" onmouseover="changeText(7)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=faq" class="menuBlack" title="Frequently Asked Questions">Questions</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
				<td width="81" align="center" onmouseover="changeText(8)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=about" class="menuBlack" title="About MobileIntentions.com">About Us</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
				<td width="81" align="center" onmouseover="changeText(9)" onmouseout="changeText(0)"><h2><a href="http://www.mobileintentions.nr.net/?sec=status" class="menuBlack" title="Check Order Status">Status</a></td></h2>
				<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
				<td width="*" align="right" onMouseOver="changeText(11)" onMouseOut="changeText(0)"><img src="images/PhoneNumber.gif" alt="Call Us!" width="130" height="25" border="0"></td>
			</div>
		</tr>
		</table>
	</td>
</tr>
<!-- Staus Bar -->
<tr>
	<td bgcolor="#505050" class="smallWhite">
		<table width="950" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="10"><img src="images/spacer.gif" alt="" width="10" height="13" border="0"></td>
			<td width="530" id="divMessage"><!-- Menu Text --></td>
			<td width="400" align="right" class="smallWhite"><strong><? include("./liveclock.js"); ?></strong></td>
			<td width="10"><img src="images/spacer.gif" alt="" width="10" height="13" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Main Body -->
<tr>
	<td background="images/BodyBG.jpg" style="background-position: top; background-repeat: no-repeat; background-attachment: scroll;">
		<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
		<?
		if ((!$sec) || $sec == "home") include("include/home.php");
		if ($sec == "details") include("include/details.php");
		if ($sec == "phones") include("include/phones.php");
		if ($sec == "accessories") include("include/accessories.php");
		if ($sec == "plans") include("include/plans.php");
		if ($sec == "coverage") include("include/coverage.php");
		if ($sec == "rebates") include("include/rebates.php");
		if ($sec == "terms") include("include/terms.php");
		if ($sec == "faq") include("include/faq.php");
		if ($sec == "about") include("include/about.php");
		if ($sec == "status") include("include/status.php");
		if ($sec == "privacy") include("include/privacy.php");
		if ($sec == "porting") include("include/porting.php");
		if ($sec == "order") include("include/order.php");

//		if ($sec == "test") include("include/phones-work.php");
//		if ($sec == "order-work") include("include/order-work.php");
//		if ($sec == "details-work") include("include/details-work.php");
		?>
		<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
	</td>
</tr>
<tr>
	<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="950" height="1" border="0"></td>
</tr>
<!-- Footer -->
<tr>
	<h3><td height="15" align="center" valign="bottom" bgcolor="#C0C0C0" class="smallBlack"><strong>Copyright&copy; 2005-<? echo date("Y"); ?>, <a href="http://www.mobileintentions.com" title="You're Already Here!" class="smallBlack">MobileIntentions.com</a>.&nbsp;&nbsp;All Rights Reserved.</strong></td></h3>
</tr>
<tr>
	<td background="images/FooterBG.jpg">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="200" height="15" valign="top" class="smallBlack">
				&nbsp;&nbsp;<strong><a href="http://www.mobileintentions.com/?sec=privacy" class="smallBlack">Privacy Policy</a> | <a href="mailto:webmaster@mobileintentions.com" class="smallBlack">Webmaster</a></strong>
			</td>
			<h3><td height="15" align="center" valign="top" class="smallBlack">
				<strong>Developed, Maintained, &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallBlack">Network Resources</a>, Las Vegas-Dallas-Milwaukee</strong>
			</td></h3>
			<td width="200" height="15">&nbsp;</td>
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- ZipPrompt Layer <DIV> -->
<script type="text/javascript">
// Determine current browser window dimensions
if (window.innerWidth){ //if browser supports window.innerWidth (mozilla)
	bwidth=window.innerWidth;
	bheight=window.innerHeight;
}else if (document.all){ //else if browser supports document.all (IE 4+)
	bwidth=document.body.clientWidth;
	bheight=document.body.clientHeight;
};
// create DIV and hide it
document.write("<div id=zipprompt1 style='position:absolute; top:"+((bheight/2)-12)+"; left:"+((bwidth/2)-125)+"; width:250; height:100; z-index:2; padding:3px; background-color:#E20074; border-color:#E20074; border:thin solid; text-align:center; filter:alpha(opacity=95); visibility:hidden'>");
</script>
<!-- zipcode form -->
<form action="javascript:zipsave(form1.zipcode.value,'http://www.mobileintentions.com/?sec=details&prod='+prod_id+'&zipcode='+form1.zipcode.value+'');" name="form1" id="form1">
	<strong class="bigWhite" style="position:relative;">Please enter your zipcode<br>to verify offer availability.</strong><br>
	<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
	<input type="text" name="zipcode" size="5" maxlength="5" onkeypress="return onlyNumbers(event)" style="position:relative;background-color:#FFFFBB;" >&nbsp;<input type="button" name="" value="Go" onClick="form.submit('this');" style="position:relative;"><br>
	<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
	<strong class="smallWhite" style="position:relative;">(U.S. Only - Must be five digits)</strong>
	<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
</form>
</div>

<!-- ZipPrompt2 Layer <DIV> -->
<script type="text/javascript">
// Determine current browser window dimensions
if (window.innerWidth){ //if browser supports window.innerWidth (mozilla)
	bwidth=window.innerWidth;
	bheight=window.innerHeight;
}else if (document.all){ //else if browser supports document.all (IE 4+)
	bwidth=document.body.clientWidth;
	bheight=document.body.clientHeight;
};
// create DIV and hide it
document.write("<div id=zipprompt2 style='position:absolute; top:"+((bheight/2)-12)+"; left:"+((bwidth/2)-125)+"; width:250; height:100; z-index:2; padding:3px; background-color:#E20074; border-color:#E20074; border:thin solid; text-align:center; filter:alpha(opacity=95); visibility:hidden'>");
</script>
<!-- zipcode form -->
<form action="javascript:zipsave(form2.zipcode.value,'http://www.mobileintentions.com/?sec=phones&zipcode='+form2.zipcode.value+'');" name="form2" id="form2">
	<strong class="bigWhite" style="position:relative;">Please enter your zipcode<br>to verify offer availability.</strong><br>
	<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
	<input type="text" name="zipcode" size="5" maxlength="5" onkeypress="return onlyNumbers(event)" style="position:relative;background-color:#FFFFBB;">&nbsp;<input type="button" name="" value="Go" onClick="form.submit('this');" style="position:relative;"><br>
	<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
	<strong class="smallWhite" style="position:relative;">(U.S. Only - Must be five digits)</strong>
	<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
</form>
</div>

<!-- NamePrompt Layer <DIV> -->
<script type="text/javascript">
// Determine current browser window dimensions
if (window.innerWidth){ //if browser supports window.innerWidth (mozilla)
	bwidth=window.innerWidth;
	bheight=window.innerHeight;
}else if (document.all){ //else if browser supports document.all (IE 4+)
	bwidth=document.body.clientWidth;
	bheight=document.body.clientHeight;
};
// create DIV and hide it
document.write("<div id=nameprompt style='position:absolute; top:"+((bheight/2)-12)+"; left:"+((bwidth/2)-175)+"; width:350; height:140; z-index:2; padding:3px; background-color:#E20074; border-color:#E20074; border:thin solid; text-align:center; filter:alpha(opacity=95); visibility:hidden'>");
</script>
<!-- name & email form -->
<form action="https://secure.nr.net/mobileintentions/" name="form3" id="form3">
	<input type="hidden" name="sec" value="order">
	<input type="hidden" name="prod" value="">
	<table border="0" cellspacing="0" cellpadding="3" align="center">
	<tr>
		<td colspan="4" align="center" class="bigWhite" style="position:relative;"><strong>Please enter your Name &amp; Email Address</strong><br><hr width="100%" size="1" color="#FFFFFF" noshade></td>
	</tr>
	<tr>
		<td align="right" class="bigWhite" style="position:relative;"><strong>&nbsp;Name:</strong></td>
		<td><input type="text" name="name" value="" size="9" maxlength="50" style="background-color:#FFFFBB;"></td>
		<td align="right" class="bigWhite" style="position:relative;"><strong>Email:</strong></td>
		<td><input type="text" name="email" value="" size="9" maxlength="50" style="background-color:#FFFFBB;"></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><input type="button" name="" value="Proceed To Secure Order System" onClick="return orderform(form3,'nameprompt');" style="position:relative;"></td>
	</tr>
	<tr>
		<td colspan="4" align="center" valign="top" class="smallWhite"><hr width="100%" size="1" color="#FFFFFF" noshade>Mobile Intentions will never share your email address with anyone.</strong></td>
<!--		<td colspan="4" align="center" valign="top" class="smallWhite"><hr width="100%" size="1" color="#FFFFFF" noshade>*Mobile Intentions does not rent, sell, or share personal information, including names and email addresses, with any other people, groups, or non-affiliated companies or organizations.</strong></td>-->
	</tr>
</form> <!-- Odd placement to accomodate IE formatting weirdness -->
	</table>
</div>

<?
// Can only have one site seal per page - opted for the padlock in the tab instead
//if (isset($_SERVER['HTTPS'])){
//	echo'<div align="right"><script type="text/javascript">TrustLogo("/images/CornerSeal.gif", "SC","none");</script></div>';
//};
?>

<p>
<div align="center" class="smallcherry">[ <a href="http://www.mobileintentions.nr.net/?sec=phones" title=""><font color="#F3F3F3">T-Mobile Free Phones</font></a> ] [ <a href="http://www.mobileintentions.nr.net/?sec=phones" title=""><font color="#F3F3F3">Free Motorola RAZR</font></a> ] [ <a href="http://www.mobileintentions.nr.net/?sec=plans" title=""><font color="#F3F3F3">T-Mobile Wireless Offer</font></a> ] [ <a href="http://www.mobileintentions.nr.net/?sec=plans"title="" ><font color="#F3F3F3">T-Mobile Cellular Plans</font></a> ] [ <a href="" title="http://www.mobileintentions.nr.net/?sec=phones"><font color="#F3F3F3">T-Mobile BlackBerry PEBL</font></a> ] 

<p>
<!-- begin / ABSOLUTELY DO NOT EDIT ANYTHING BETWEEN THESE BREAKS --
 
<a href="http://www.cherryoneweb.com" title="Search Engine Optimization"><font color="#F3F3F3">Search Engine Optimization</font></a>
Copyright &copy 2006 <a href="http://www.cherryoneweb.com">
<!-- Changed image src value to look locally for the image to accomodate pages accessed via HTTPS (literal HTTP ref. caused mixed secure and non-secure data -->
<!--<img src="http://cherryoneweb.com/cherryoneweb_com_image/cherryoneweb_com.gif" alt="Search Engine Optimization by Cherryoneweb.com" width="19" height="19" border="0"></a>-->
<!--<img src="images/cherryoneweb_com.gif" alt="Search Engine Optimization by Cherryoneweb.com" width="19" height="19" border="0"></a>
Website Optimized by: Cherryoneweb.com
 
<!-- end / ABSOLUTELY DO NOT EDIT ANYTHING BETWEEN THESE BREAKS --></div>

</p>
</body>
</html>
