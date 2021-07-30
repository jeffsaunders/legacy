<?
if ($_REQUEST['sid']){
	$_SESSION['SID'] = $_REQUEST['sid'];
	$SID = $_SESSION['SID'];
}else{
	session_start();
	if ($_REQUEST['sec'] == "thankyou"){
		session_regenerate_id(true);
	}
	$_SESSION['SID'] = session_id();
	$SID = $_SESSION['SID'];
}
header("Cache-control: private");  // IE 6 Fix.
//echo $SID;
if ($_SERVER["HTTPS"] && $_REQUEST['sec'] != "checkout"){
	$destination = "http://mckesson.cellbenefits.com/".$_SERVER['REQUEST_URI'];
//	echo $destination;
	header("Location: $destination");
	exit;
}
?>
<!-- Start a session above -->
<!-- Must be FIRST thing done, even before a comment -->
<!-- Then check to see if the user is going for a secure connection adn is not already checking out -->
<!-- If so, redirect 'em -->

<!-- Assign passed variables -->
<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$anchor = $_REQUEST['anchor'];
$message = $_REQUEST['message'];
$cargo = $_REQUEST['cargo'];
?>

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

// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
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

	<title>Vision Wireless - McKesson Employee Wireless Discount Program | Sprint Wireless Offer | Sprint Cellular Plans | Sprint BlackBerry | Free Motorola RAZR | Motorola Q</title>

	<!-- Meta Tags -->
	<meta name="description" content="Vision Wireless McKesson Employees Wireless Discount Program - Low-cost or Free Sprint Phones including the Motorola RAZR, Motorola Q, and RIM BlackBerry. Sprint Wireless Offers and Cellular Plans">
	<meta name="keywords" content="Sprint Free Phones,Free,Motorola RAZR,Sprint Wireless Offer,Sprint Cellular Plans,RIM BlackBerry,Motorola Q,cell phone,Cell Phones,Cellular Phones,Cellphone,cellphones,free cell phones,free cellular phones,free phones,cell phone plans,cell phone specials,mobile phone,wireless phone,cellular phone service,service plan,cellular phone plans,wireless phone service,cell phone accessories, purchase cell phone,buy cell phone,research cell phones">
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
	<meta http-equiv="imagetoolbar" content="no">
	<meta name="distribution" content="United States, USA, United States of America">
	<meta name="coverage" content="United States, USA, United States of America">
	<meta name="VW96.objecttype" content="Sprint Mobile Wireless Cell Phones &amp; Cellular Phone Equipment.">
	<meta name="DC.title" content="Vision Wireless - McKesson Employee Wireless Discount Program | Free Cell Phones | Motorola RAZR | Blackberry | Motorola Q">
	<meta name="DC.subject" content="Cellular Wireless Phones & Accessories">
	<meta name="DC.description" content="Vision Wireless - McKesson Employee Wireless Discount Program | Free Cell Phones | Motorola RAZR | Blackberry | Motorola Q">
	<meta name="DC.Coverage.PlaceName" content="United States, USA, United States of America">

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Define Home Base -->
	<?
	if ($sec == "checkout"){
		echo'	<base href="https://secure.nr.net/cellbenefits/">';
	}else{
		echo'	<base href="http://mckesson.cellbenefits.com/">';
	}
	?>

	<!-- SSL Site Seal -->
<!--	<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>-->

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	

</head>

<!--<body bgcolor="#808080" leftmargin="0" topmargin="10" marginwidth="0" onLoad="changeTextInit();show_clock();<? if ($first) echo'popAd();'; ?>" onUnload="adios();">-->
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="10" marginwidth="0">

<table width="950" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#8D8D8D">
<tr>
	<td>
		<div id="container" style="position:relative; width:950; align:center; display:block;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<!-- Header -->
		<tr>
			<td bgcolor="#FFE100">
<!--				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="200" rowspan="2"><img src="images/SprintHeaderLogo.jpg" alt="" width="200" height="100" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="475" height="75" border="0"></td>
					<td width="250" align="center"><a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/McKessonHeaderLogo.jpg" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" width="237" height="75" border="0"></a></td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" alt="" width="475" height="25" border="0"></td>

					<td align="center"><a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/SprintDiscountButton2.gif" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" width="237" height="25" border="0"></a></td>
				</tr>
				</table>-->
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="200"><a href="javascript:SpawnChild('http://www.sprintstorelocator.com/sprintLocator/searchForm.jsp','child','800','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/SprintHeaderLogo.jpg" alt="" width="200" height="100" border="0"></a></td>
					<td align="center"><img src="images/McKessonHeaderLogo.jpg" alt="McKesson Logo" width="237" height="75" border="0"><br><img src="images/HeaderPromo1.gif" alt="Extra $50 Off!!" width="500" height="25" border="0"></td>
					<td width="200" align="right"><a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/SprintExisting.gif" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" width="164" height="100" border="0"></a></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="940" height="1" border="0"></td>
		</tr>
		<!-- Button Bar -->
		<tr>
			<td bgcolor="#EDEDED" background="images/ButtonBarBG.jpg">
				<table border="0" cellspacing="0" cellpadding="0">
				<!-- Buttons -->
				<tr>
					<td><img src="images/spacer.gif" alt="" width="20" height="30" border="0"></td>
					<td valign="bottom"><img src="images/GrayDot.gif" alt="" width="1" <? echo iif(!$sec || $sec=='home', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif(!$sec || $sec=='home', 'bgcolor="#C3C2C0" class="menuBlack">', 'class="menuGray"><a href="?sec=home" class="menuGray">'); ?><strong>Home</strong></a></td>
					<td valign="bottom"><img src="images/GrayDot.gif" alt="" width="1" <? echo iif(!$sec || $sec=='home' || $sec=='phones', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='phones', 'bgcolor="#C3C2C0" class="menuBlack">', 'class="menuGray"><a href="?sec=phones" class="menuGray">'); ?><strong>Phones</strong></a></td>
					<td valign="bottom"><img src="images/GrayDot.gif" alt="" width="1" <? echo iif($sec=='phones' || $sec=='plans', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='plans', 'bgcolor="#C3C2C0" class="menuBlack">', 'class="menuGray"><a href="?sec=plans" class="menuGray">'); ?><strong>Plans</strong></a></td>
					<td valign="bottom"><img src="images/GrayDot.gif" alt="" width="1" <? echo iif($sec=='plans' || $sec=='coverage', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='coverage', 'bgcolor="#C3C2C0" class="menuBlack">', 'class="menuGray"><a href="?sec=coverage" class="menuGray">'); ?><strong>Coverage</strong></a></td>
					<td valign="bottom"><img src="images/GrayDot.gif" alt="" width="1" <? echo iif($sec=='coverage' || $sec=='rebates', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='rebates', 'bgcolor="#C3C2C0" class="menuBlack">', 'class="menuGray"><a href="?sec=rebates" class="menuGray">'); ?><strong>Rebates</strong></a></td>
					<td valign="bottom"><img src="images/GrayDot.gif" alt="" width="1" <? echo iif($sec=='rebates' || $sec=='terms', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='terms', 'bgcolor="#C3C2C0" class="menuBlack">', 'class="menuGray"><a href="?sec=terms" class="menuGray">'); ?><strong>Terms</strong></a></td>
					<td valign="bottom"><img src="images/GrayDot.gif" alt="" width="1" <? echo iif($sec=='terms' || $sec=='faq', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='faq', 'bgcolor="#C3C2C0" class="menuBlack">', 'class="menuGray"><a href="?sec=faq" class="menuGray">'); ?><strong>Questions</strong></a></td>
					<td valign="bottom"><img src="images/GrayDot.gif" alt="" width="1" <? echo iif($sec=='faq' || $sec=='contact', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='contact', 'bgcolor="#C3C2C0" class="menuBlack">', 'class="menuGray"><a href="?sec=contact" class="menuGray">'); ?><strong>Contact Us</strong></a></td>
					<td valign="bottom"><img src="images/GrayDot.gif" alt="" width="1" <? echo iif($sec=='contact', 'height="30"', 'height="22"'); ?> border="0"></td>
<!-- Moved to to a DIV after page content is processed so cart chahnges are ALWAYS reflected
					<td width="200" align="right">
						<?
						//Grab existing cart content phone count, if any exists
						$carrier_selected = "";
						$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
						$rs_cart = mysql_query($query, $linkID);
						$row = mysql_fetch_assoc($rs_cart);
						$qty = 0;
						for ($counter=1; $counter <= 5; $counter++){
							if ($row['phone'.$counter.'_id'] != "") $qty++;
						};
						if (mysql_num_rows($rs_cart) > 0) $carrier_selected = $row['carrier'];
						?>
						<table border="0" cellspacing="0" cellpadding="0" align="right">
						<tr>
							<td><a href="?sec=cart"><img src="images/ShoppingCart.gif" alt="" width="19" height="16" border="0"></a></td>
							<td class="smallBlack"><a href="?sec=cart" class="smallBlack" style=" text-decoration:none;">&nbsp;View Cart </a>(<? echo iif($qty > 0, "<strong>", ""); echo $qty; ?></strong>) | Checkout&nbsp;</td>
						</tr>
						</table>
					</td>-->
				</tr>
				<!-- Underlines -->
				<tr>
					<td><img src="images/GrayDot.gif" alt="" width="20" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif(!$sec || $sec=='home', 'bgcolor="#C3C2C0"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='phones', 'bgcolor="#C3C2C0"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='plans', 'bgcolor="#C3C2C0"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='coverage', 'bgcolor="#C3C2C0"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='rebates', 'bgcolor="#C3C2C0"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='terms', 'bgcolor="#C3C2C0"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='faq', 'bgcolor="#C3C2C0"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='contact', 'bgcolor="#C3C2C0"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="1" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="201" height="1" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#EFEFEF" background="images/GrayGradientBG.jpg" style="background-position: top left; background-repeat: no-repeat; background-attachment: scroll;">
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<?
				if ((!$sec) || $sec == "home") include("include/home.php");
//				if ($sec == "details") include("include/details.php");
				if ($sec == "phones") include("include/phones.php");
//				if ($sec == "accessories") include("include/accessories.php");
				if ($sec == "plans") include("include/plans.php");
				if ($sec == "coverage") include("include/coverage.php");
				if ($sec == "rebates") include("include/rebates.php");
				if ($sec == "terms") include("include/terms.php");
				if ($sec == "faq") include("include/faq.php");
				if ($sec == "contact") include("include/contact.php");
				if ($sec == "cart") include("include/cart.php");
				if ($sec == "checkout") include("include/checkout.php");
				if ($sec == "thankyou") include("include/thankyou.php");
//				if ($sec == "status") include("include/status.php");
				if ($sec == "privacy") include("include/privacy.php");
//				if ($sec == "porting") include("include/porting.php");
//				if ($sec == "order") include("include/order.php");
		
//				if ($sec == "test") include("include/phones-work.php");
//				if ($sec == "phones-work") include("include/phones_work.php");
//				if ($sec == "details-work") include("include/details_work.php");
				?>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

				<div id="cart" style="position:absolute; top:108; left:0; z-index:1; visibility:visible;">
				<?
				//Show current cart content count and link to chart in button bar
				//Done here so as to calculate content AFTER any manipulation by the includes above
				//Grab existing cart content phone count, if any exists
				$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
				$rs_cart = mysql_query($query, $linkID);
				$row = mysql_fetch_assoc($rs_cart);
				$qty = 0;
				for ($counter=1; $counter <= 5; $counter++){
					if ($row['phone'.$counter.'_id'] != "") $qty++;
				};
				?>
				<table border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
					<td><a href="?sec=cart"><img src="images/ShoppingCart.gif" alt="" width="19" height="16" border="0"></a></td>
					<td class="smallBlack"><a href="?sec=cart" class="smallBlack" style=" text-decoration:none;">&nbsp;View Cart </a>(<? echo iif($qty > 0, "<strong>", ""); echo $qty; ?></strong>) | <? echo iif($qty > 0, '<a href="https://secure.nr.net/cellbenefits/?sec=checkout&sid='.$SID.'" class="smallBlack" style=" text-decoration:none;">', ''); ?>Checkout</a>&nbsp;&nbsp;</td>
				</tr>
				</table>
				</div>
			</td>
		</tr>
		</table>
		</div>
	</td>
</tr>
<!-- Footer -->
<tr bgcolor="#8D8D8D">
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="8" height="80" border="0"></td>
<!--			<td><img src="images/VisionFooterLogo.jpg" alt="" width="160" height="42" border="0"></td>-->
			<td width="150" rowspan="2" valign="top">
				<!-- BEGIN ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
				<div id="ps_visionwireless_chat_button" style="width:140px;height:60px;display:inline"><spacer type="block" width="140" height="60"></spacer></div><div id="ps_visionwireless_chat_invitation" style="z-index:100;position:absolute;left:0px;top:0px;"></div><script id="ps_visionwireless_scr" language="JavaScript"></script><script language="JavaScript">if(document.getElementById)document.getElementById("ps_visionwireless_scr").src="https://secure.providesupport.com/image/js/visionwireless/safe-standard.js?ps_t="+new Date().getTime()</script><noscript><a href="http://www.providesupport.com?messenger=visionwireless" target="_blank">Live Support Chat</a></noscript>
				<!-- END ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages --><br><img src="images/spacer.gif" alt="" width="1" height="20" border="0"><strong></strong><a href="?sec=privacy" class="smallWhite"><strong>Privacy Policy</strong></a>
			</td>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td valign="top" class="smallWhite">
				<strong>
				<li>For help with existing Sprint accounts, please call 888.211.4727.</li><br>
				<li>To request a company sponsored discount be applied to your individual Sprint account, go to <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="smallWhite">www.sprint-discount.com</a>.</li><br>
				<li>For help with online orders call 877.351.1658 or email <a href="mailto:personalcell@cellbenefits.com" class="smallWhite">personalcell@cellbenefits.com</a>.</li><br><br>
				*Additional service fees may apply.  Phone price with new 2-year activation, after all available promotions & rebates. Device pricing includes an Equipment Rebate of $50 that has been provided to you by Vision Wireless, an authorized agent, for activating a new non-substitute line of service with SPRINT-NEXTEL, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days. SPRINT-NEXTEL upgrades to not qualify for the $50.00 rebate.<br>
				</strong>
			</td>
		</tr>
		<tr>
			<td align="right" valign="bottom" class="smallGray"><strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Business Wireless Solutions" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong></td>
			<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- Copyrights --
<div align="center" class="smallGray">
<strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Business Wireless Solutions" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong><br>
<strong>Developed, Maintained, &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallGray">Network Resources</a>, Las Vegas-Dallas-Milwaukee</strong>
</div>-->

</body>
</html>
