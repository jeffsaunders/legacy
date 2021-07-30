<?
session_start();
$_SESSION['SID'] = session_id();
$SID = $_SESSION['SID'];
header("Cache-control: private");  // IE 6 Fix.
//echo $SID;

//$first = false;
//if ($_POST['auth']){
//	$_SESSION['auth'] = $_POST['auth'];
//	$first = true;
//}
//if (!$_SESSION['auth'] &&
//	$_REQUEST['sec'] != "order" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "GOOGLEBOT" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "GOOGLEBOT-IMAGE" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "MSNBOT" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "SLURP" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "TEOMA" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "GIGABOT" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "SCRUBBY" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "ROBOZILLA" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "NUTCH" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "IA_ARCHSERVER" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "BAIDUSPIDER" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "YAHOO-MMCRAWLER" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "PSBOT" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "CRAWL" &&
//	strtoupper($_SERVER['HTTP_USER_AGENT']) != "ASTERIAS"){
//	header("Location: http://www.mobileintentions.com/gateway");
//	exit;
//}
?>
<!-- Start a session above -->
<!-- Must be FIRST thing done, even before a comment -->
<!-- Then check to see if the user authenticated -->
<!-- or is going to the order screen (different URL so session var would always be false) -->
<!-- or the user is a search engine bot -->
<!-- If not, send them to the login page -->

<!-- Assign passed variables -->
<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$anchor = $_REQUEST['anchor'];
//$terms = $_REQUEST['terms'];
$cargo = $_REQUEST['cargo'];
////if (($_GET['zipcode']) && ($_SESSION['zipcode'] != $_GET['zipcode'])){
////	$_SESSION['zipcode'] = $_GET['zipcode'];
////}
?>

<!-- Declare zipcode -->
<? //$zipcode = $_SESSION['zipcode']; ?> 

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

	<!-- Menu Description Text Swapping -->
<!--	<style type="text/css">
		#divLinks   {position:absolute; left:150px; top:150px; visibility:hidden;}
		#divLinks a {color:#8b0000; font-family:verdana,arial,helvetica,sans-serif; font-size:12px; font-weight:700;}
		#divMessage {position:relative; left:0px; width:530px; top:0px; visibility:hidden;}
	</style>-->

	<!-- SSL Site Seal -->
	<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

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
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="200" rowspan="2"><img src="images/SprintHeaderLogo.jpg" alt="" width="200" height="100" border="0"></td>
					<td><img src="images/spacer.gif" alt="" width="475" height="75" border="0"></td>
					<td width="250" align="center"><a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/McKessonHeaderLogo.jpg" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" width="237" height="75" border="0"></a></td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" alt="" width="475" height="25" border="0"></td>

					<td align="center"><a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/SprintDiscountButton2.gif" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" width="237" height="25" border="0"></a></td>
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
					<td width="200" align="right">
						<?
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
							<td><img src="images/ShoppingCart.gif" alt="" width="19" height="16" border="0">&nbsp;</td>
							<td class="smallBlack"><a href="?sec=cart" class="smallBlack" style=" text-decoration:none;">"View Cart (<? echo iif($qty > 0, "<strong>", ""); echo $qty; ?></strong>) | Checkout&nbsp;</a></td>
						</tr>
						</table>
					</td>
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

$host = array_reverse(explode(".",$_SERVER['HTTP_HOST']));
if (strtolower($host[2]) != "test"){
	include("include/home_.php");
}else{
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
//				if ($sec == "status") include("include/status.php");
//				if ($sec == "privacy") include("include/privacy.php");
//				if ($sec == "porting") include("include/porting.php");
//				if ($sec == "order") include("include/order.php");
		
//				if ($sec == "test") include("include/phones-work.php");
				if ($sec == "phones-work") include("include/phones_work.php");
//				if ($sec == "details-work") include("include/details_work.php");

}

				?>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
<!--				<img src="images/spacer.gif" alt="" width="940" height="300" border="0">-->
			</td>
		</tr>
		</table>
		</div>
	</td>
</tr>
<!-- Footer -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="5" height="50" border="0"></td>
<!--			<td><img src="images/VisionFooterLogo.jpg" alt="" width="160" height="42" border="0"></td>-->
			<td valign="bottom" class="smallWhite">
				<strong>
				For help with existing Sprint accounts, please call 888.788.4727.<br>
				For help with online orders call 877.351.1658 or email <a href="mailto:personalcell@cellbenefits.com" class="smallWhite">personalcell@cellbenefits.com</a>.<br>
				To request a company sponsored discount be applied to your individual Sprint account, go to <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="smallWhite">www.sprint-discount.com</a>.
				</strong>
			</td>
			<td align="right" valign="bottom" class="smallGray"><strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Business Wireless Solutions" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong></td>
			<td><img src="images/spacer.gif" alt="" width="5" height="50" border="0"></td>
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
