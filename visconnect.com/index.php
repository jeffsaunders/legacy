<?
// SESSION
//session_save_path("/var/www/html/cellbenefits.com/tmp");
// Set the session timout to 24 hours - that should be plenty, even if they come back in the morning.
//ini_set("session.gc_maxlifetime", "86400"); 
session_start();
//echo ini_get("session.gc_maxlifetime"); 

if ($_REQUEST['sid']){
	$_SESSION['SID'] = $_REQUEST['sid'];
	$SID = $_SESSION['SID'];
}else{
	// If order just completed
	if ($_REQUEST['sec'] == "thankyou"){
		// Kill the old session!
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
		session_destroy();
//		$_SESSION['SID'] = session_id();
	}
	$_SESSION['SID'] = session_id();
	$SID = $_SESSION['SID'];
}
header("Cache-control: private");  // IE 6 Fix.
// Grab URL, split it up, and reverse it.
$host = array_reverse(explode(".",$_SERVER['HTTP_HOST']));
if (strtolower($host[3]) == "www"){
	$destination = "http://apple.visconnect.nr.net";
	header("Location: $destination");
	exit;
}elseif (strtolower($host[2]) == "secure"){
	if ($_REQUEST['site']){
		$_SESSION['site'] = $_REQUEST['site'];
	}
}else{
	$_SESSION['site'] = $host[3];
}

// Set site name
$site = $_SESSION['site'];
$site = "apple";
// Grab URI & split it up.
$uri = explode("/",$_SERVER['REQUEST_URI']);
// Set domain name
if (strtolower($host[3]) == "secure"){
	$domain = strtolower($uri[1]).".com";
}else{
//	$domain = strtolower($host[1]).".".strtolower($host[0]);
	$domain = strtolower($host[2]).".com";
}
// Coming out of a checkout.
//if ($_SERVER["HTTPS"] && $_REQUEST['sec'] != "checkout"){
if ($_SERVER["HTTPS"] && $_REQUEST['sec'] != "checkout" && $_REQUEST['sec'] != "summary"){
//	if (strtolower($uri[1]) == "sprintbroadbandstore"){
		$destination = "http://".$site.".visconnect.nr.net".$_SERVER['REQUEST_URI'];
//	}else if (strtolower($uri[1]) == "phonebenefits"){
//		$destination = "http://".$site.".phonebenefits.com/".$_SERVER['REQUEST_URI'];
//	}else if (strtolower($uri[1]) == "voicebenefits"){
//		$destination = "http://".$site.".voicebenefits.com/".$_SERVER['REQUEST_URI'];
//	}

	header("Location: $destination");
	exit;
}
?>
<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$anchor = $_REQUEST['anchor'];
$message = $_REQUEST['message'];
$cargo = $_REQUEST['cargo'];

// determine if this is the first visit for showing one-time promos
$first = "yes";
if ($_SESSION['first'] == "set" || $_REQUEST['first'] == "no"){
	$first = "no";
}
$_SESSION['first'] = "set";
?>
<?
// Connect to the database
include "dbconnect.php";
?>
<?
// Grab site setup information
//echo $site."<br>";
//echo $domain."<br>";
//echo $_SESSION['SID'];
$result = mysql_query("SELECT * FROM sites WHERE site = '$site' AND domain = '$domain'", $linkID);
$config = mysql_fetch_assoc($result);
	$label = $config['label'];
	$title = $config['title'];
	$branding = $config['branding'];
	$logo = $config['logo'];
	$header_logo = $config['header_logo'];
	$header_promo = $config['header_promo'];
	$header_promo_link = $config['header_promo_link'];
	$discount_promo = $config['discount_promo'];
	$pricing_level = $config['pricing_level'];
	$gift_card = $config['gift_card'];
	$discount_form = $config['discount_form'];
	$vision_rebate = $config['vision_rebate'];
	$rebate_label = $config['rebate_label'];
	$alt_home = $config['alt_home'];
	$sprint_site = $config['sprint'];
	$sprint_discount = $config['sprint_discount'];
	$sprint_activation = $config['sprint_activation'];
	$sprint_shipping = $config['sprint_shipping'];
	$sprint_shipping_per = $config['sprint_shipping_per'];
	$sprint_shipping_method = $config['sprint_shipping_method'];
//	$nextel_site = $config['nextel'];
//	$nextel_discount = $config['nextel_discount'];
//	$nextel_activation = $config['nextel_activation'];
//	$nextel_shipping = $config['nextel_shipping'];
//	$nextel_shipping_per = $config['nextel_shipping_per'];
//	$nextel_shipping_method = $config['nextel_shipping_method'];
//	$cingular_site = $config['cingular'];
//	$cingular_discount = $config['cingular_discount'];
//	$cingular_activation = $config['cingular_activation'];
//	$cingular_shipping = $config['cingular_shipping'];
//	$cingular_shipping_per = $config['cingular_shipping_per'];
//	$cingular_shipping_method = $config['cingular_shipping_method'];
//	$verizon_site = $config['verizon'];
//	$verizon_discount = $config['verizon_discount'];
//	$verizon_activation = $config['verizon_activation'];
//	$verizon_shipping = $config['verizon_shipping'];
//	$verizon_shipping_per = $config['verizon_shipping_per'];
//	$verizon_shipping_method = $config['verizon_shipping_method'];
	$support_number = $config['support_number'];
	$support_email = $config['support_email'];
	$support_bug = $config['support_bug'];
?>
<?
//if ((!$sec) && $alt_home == "T") header("Location: ?sec=promo");
?>
<?
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
	// Grab existing cart carrier selected, if any exists.
	$carrier_selected = "Sprint";
//	$query = "SELECT carrier FROM orders WHERE session_id='".$SID."'";
//	$rs_carrier = mysql_query($query, $linkID);
//	$row = mysql_fetch_assoc($rs_carrier);
//	if (mysql_num_rows($rs_carrier) > 0) $carrier_selected = $row['carrier'];
	$activation_fee = $sprint_activation;
// Cingular/AT&T sites
//}elseif ($cingular_site == "T" ){
//	$carrier_selected = "AT&T";
//	$activation_fee = $cingular_activation;
// Verizon sites
//}elseif ($verizon_site == "T" ){
//	$carrier_selected = "Verizon";
//	$activation_fee = $verizon_activation;
}
?>
<?
// PHP Functions
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
/*
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
*/
?>
<?
///////////////////////////////////////////////////////////////
// Sprint-Nextel sites - other sites below
//if ($sprint_site == "T" || $nextel_site == "T" ){
	$carrier_label = "Sprint";
	$tab = "SprintTab200BG.gif";
	$tab_class = "bigBlack";
	$bar_color = "#FFE100";
	$border_color = "#FFFFFF";
	$popup_border = "#2A4977";
	$box_color = "#58639B";
	$box_bg = "#EFEFEF";
	$form_bg = "#FFE100";
	$AddToOrderButton = "BuyNowButton.jpg";
	$SubmitOrderButton = "SubmitOrderButton.gif";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title><? echo $title; ?></title>

	<!-- Meta Tags -->
	<meta name="description" content="Vision Wireless Sprint Broadband Discount Program - Low-cost or Free Sprint Broadband Access Cards">
	<meta name="keywords" content="Sprint Free Phones,Free,Motorola RAZR,Sprint Wireless Offer,Sprint Cellular Plans,RIM BlackBerry,Motorola Q,cell phone,Cell Phones,Cellular Phones,Cellphone,cellphones,free cell phones,free cellular phones,free phones,cell phone plans,cell phone specials,mobile phone,wireless phone,cellular phone service,service plan,cellular phone plans,wireless phone service,cell phone accessories, purchase cell phone,buy cell phone,research cell phones">
	<meta name="robots" content="all, index, follow">
	<meta name="revisit-after" content="3 days">
	<meta name="category" content="Cellular Wireless Phones &amp; Accessories">
	<meta name="subject" content="Cellular Wireless Phones &amp; Accessories">
	<meta name="classification" content="Cellular Wireless Phones &amp; Accessories">
	<meta name="rating" content="General">
	<meta name="author" content="Network Resources - www.nr.net">
	<meta http-equiv="code-language" content="PHP5">
	<meta http-equiv="content-language" content="en-us">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="imagetoolbar" content="no">
	<meta name="distribution" content="United States, USA, United States of America">
	<meta name="coverage" content="United States, USA, United States of America">
	<meta name="VW96.objecttype" content="Sprint Mobile Wireless Cell Phones &amp; Cellular Phone Equipment.">
	<meta name="DC.title" content="Vision Wireless - Wireless Discount Program | Free Cell Phones | Motorola RAZR | Blackberry | Motorola Q">
	<meta name="DC.subject" content="Cellular Wireless Phones &amp; Accessories">
	<meta name="DC.description" content="Vision Wireless - Wireless Discount Program | Free Cell Phones | Motorola RAZR | Blackberry | Motorola Q">
	<meta name="DC.Coverage.PlaceName" content="United States, USA, United States of America">

	<!-- Favorite Icon -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> 

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Define Home Base -->
	<?
	if ($domain == "visconnect.com" || strtolower($uri[1]) == "visconnect"){
		if ($sec == "checkout" || $sec == "summary"){
			echo'<base href="https://secure.nr.net/visconnect/">';
		}else{
			echo'<base href="http://'.$site.'.visconnect.nr.net/">';
		}
	}
	?>

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	
	<script language="JavaScript" src="timedate.js"></script>	

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

</head>

<?
//if ($branding == "apple"){
?>
<!--<body bgcolor="#FFFFFF" leftmargin="0" topmargin="15" marginwidth="0" <?// echo iif($message != "", "onLoad=\"alert('".$message."');\"", ""); ?>>-->
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="15" marginwidth="0" onLoad="<? if ($first == "yes" && $gift_card > 0) echo'popAd(\'GiftCardPromo\',60000);';?><? echo iif($message != "", "\"alert('".$message."');\"", ""); ?>">
<?// echo $SID; ?>
<?// echo $first."<br>"; ?>
<?// echo $gift_card."<br>"; ?>

<a name="top">
<table width="950" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td valign="top">
		<div id="container" style="position:relative; width:930; align:center; display:block;">
		<table width="930" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td background="images/HeaderBG.jpg" style="background-position:top; background-repeat:no-repeat;"><img src="images/spacer.gif" alt="" width="1" height="80" border="0"></td>
		</tr>
		<tr>
			<td>
				<script language="javascript">
				// Declare menu images to swap
				if (document.images) {
					// MouseOut Images
					img1off = new Image(); 
					img1off.src = "images/HomeButtonOff.jpg"; 
					img2off = new Image(); 
					img2off.src = "images/DevicesButtonOff.jpg";
					img3off = new Image();
					img3off.src = "images/PlansButtonOff.jpg";
					img4off = new Image(); 
					img4off.src = "images/CoverageButtonOff.jpg";   
					img5off = new Image(); 
					img5off.src = "images/RebatesButtonOff.jpg"; 
					img6off = new Image(); 
					img6off.src = "images/TermsButtonOff.jpg";
					img7off = new Image();
					img7off.src = "images/QuestionsButtonOff.jpg";
					img8off = new Image(); 
					img8off.src = "images/ContactButtonOff.jpg";   
					// MouseOver Images
					img1on = new Image(); 
					img1on.src = "images/HomeButtonOn.jpg"; 
					img2on = new Image(); 
					img2on.src = "images/DevicesButtonOn.jpg";
					img3on = new Image();
					img3on.src = "images/PlansButtonOn.jpg";
					img4on = new Image(); 
					img4on.src = "images/CoverageButtonOn.jpg";   
					img5on = new Image(); 
					img5on.src = "images/RebatesButtonOn.jpg"; 
					img6on = new Image(); 
					img6on.src = "images/TermsButtonOn.jpg";
					img7on = new Image();
					img7on.src = "images/QuestionsButtonOn.jpg";
					img8on = new Image(); 
					img8on.src = "images/ContactButtonOn.jpg";   
				}
			
				// Swap Image
				function imgOn(imgName) {
			        if (document.images) {
			            document[imgName].src = eval(imgName + "on.src");
			        }
				}
				function imgOff(imgName) {
			        if (document.images) {
			            document[imgName].src = eval(imgName + "off.src");
			        }
				}
				</script>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" background="images/ButtonBarBG.jpg" bgcolor="#FFFFFF" style="background-position:top; background-repeat:no-repeat;">
				<!-- Menu -->
				<tr>
					<td>
						<? if ($sec == "home"){ ?>
						<a> <!-- Wrapped in <a> tag for spacing in Firefox -->
						<img src="images/HomeButtonStatic.jpg" alt="Home Page" title="Home Page" width="90" height="40" border="0">
						</a>
						<? }else{ ?>
						<a href="?sec=home" onMouseOver="imgOn('img1')" onMouseOut="imgOff('img1')">
						<img src="images/HomeButtonOff.jpg" alt="Home Page" title="Home Page" width="90" height="40" border="0" name="img1" id="img1">
						</a>
						<? } ?>
					</td>
<!--					<td>
						<? if ($sec == "phones"){ ?>
						<a> <!-- Wrapped in <a> tag for spacing in Firefox --
						<img src="images/DevicesButtonStatic.jpg" alt="Devices" title="Devices" width="90" height="40" border="0">
						</a>
						<? }else{ ?>
						<a href="" onMouseOver="imgOn('img2')" onMouseOut="imgOff('img2')">
						<img src="images/DevicesButtonOff.jpg" alt="Devices" title="Devices" width="90" height="40" border="0" name="img2" id="img2">
						</a>
						<? } ?>
					</td>-->
					<td>
						<? if ($sec == "plans"){ ?>
						<a> <!-- Wrapped in <a> tag for spacing in Firefox -->
						<img src="images/PlansButtonStatic.jpg" alt="Plans" title="Plans" width="90" height="40" border="0">
						</a>
						<? }else{ ?>
						<a href="?sec=plans" onMouseOver="imgOn('img3')" onMouseOut="imgOff('img3')">
						<img src="images/PlansButtonOff.jpg" alt="Plans" title="Plans" width="90" height="40" border="0" name="img3" id="img3">
						</a>
						<? } ?>
					</td>
					<td>
						<? if ($sec == "coverage"){ ?>
						<a> <!-- Wrapped in <a> tag for spacing in Firefox -->
						<img src="images/CoverageButtonStatic.jpg" alt="Coverage Map" title="Coverage Map" width="90" height="40" border="0">
						</a>
						<? }else{ ?>
						<a href="?sec=coverage" onMouseOver="imgOn('img4')" onMouseOut="imgOff('img4')">
						<img src="images/CoverageButtonOff.jpg" alt="Coverage Map" title="Coverage Map" width="90" height="40" border="0" name="img4" id="img4">
						</a>
						<? } ?>
					</td>
<!-- make right-side filler 90px narrower if rebates button is put back-->
					<td>
						<? if ($sec == "rebates"){ ?>
						<a> <!-- Wrapped in <a> tag for spacing in Firefox -->
						<img src="images/RebatesButtonStatic.jpg" alt="Rebates" title="Rebates" width="90" height="40" border="0">
						</a>
						<? }else{ ?>
						<a href="?sec=rebates" onMouseOver="imgOn('img5')" onMouseOut="imgOff('img5')">
						<img src="images/RebatesButtonOff.jpg" alt="Rebates" title="Rebates" width="90" height="40" border="0" name="img5" id="img5">
						</a>
						<? } ?>
					</td>
<!---->
					<td>
						<? if ($sec == "terms"){ ?>
						<a> <!-- Wrapped in <a> tag for spacing in Firefox -->
						<img src="images/TermsButtonStatic.jpg" alt="Terms & Conditions" title="Terms &amp; Conditions" width="90" height="40" border="0">
						</a>
						<? }else{ ?>
						<a href="?sec=terms" onMouseOver="imgOn('img6')" onMouseOut="imgOff('img6')">
						<img src="images/TermsButtonOff.jpg" alt="Terms &amp; Conditions" title="Terms &amp; Conditions" width="90" height="40" border="0" name="img6" id="img6">
						</a>
						<? } ?>
					</td>
					<td>
						<? if ($sec == "faq"){ ?>
						<a> <!-- Wrapped in <a> tag for spacing in Firefox -->
						<img src="images/QuestionsButtonStatic.jpg" alt="Frequently Asked Questions" title="Frequently Asked Questions" width="90" height="40" border="0">
						</a>
						<? }else{ ?>
						<a href="?sec=faq" onMouseOver="imgOn('img7')" onMouseOut="imgOff('img7')">
						<img src="images/QuestionsButtonOff.jpg" alt="Frequently Asked Questions" title="Frequently Asked Questions" width="90" height="40" border="0" name="img7" id="img7">
						</a>
						<? } ?>
					</td>
					<td>
						<? if ($sec == "contact"){ ?>
						<a> <!-- Wrapped in <a> tag for spacing in Firefox -->
						<img src="images/ContactButtonStatic.jpg" alt="Contact Us" title="Contact Us" width="90" height="40" border="0">
						</a>
						<? }else{ ?>
						<a href="?sec=contact" onMouseOver="imgOn('img8')" onMouseOut="imgOff('img8')">
						<img src="images/ContactButtonOff.jpg" alt="Contact Us" title="Contact Us" width="90" height="40" border="0" name="img8" id="img8"><!--<img src="images/ButtonBarLine.jpg" alt="" width="2" height="40" border="0">-->
						</a>
						<? } ?>
					</td>
					<td width="305" align="right" valign="top">
<!--						<img src="images/spacer.gif" alt="" width="305" height="1" border="0">-->

						<?// echo $support_bug; ?>


<!--						<a> <!-- Wrapped in <a> tag for spacing in Firefox --
						<img src="images/ButtonBarRight.jpg" alt="" width="210" height="40" border="0">
						</a>
						<div align="right" id="support" style="position:absolute; top:90; right:0; width: 113px; z-index:1; visibility:visible;">
						<?// echo $support_bug; ?>
						</div>-->
					</td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="720" height="400" valign="top">
						<?
						if ((!$sec) || $sec == "home") include("include/home.php");
//						if ($sec == "phones") include("include/phones.php");
						if ($sec == "plans") include("include/plans.php");
						if ($sec == "coverage") include("include/coverage.php");
						if ($sec == "rebates") include("include/rebates.php");
						if ($sec == "terms") include("include/terms.php");
						if ($sec == "faq") include("include/faq.php");
						if ($sec == "contact") include("include/contact.php");
//						if ($sec == "cart") include("include/cart.php");
						if ($sec == "checkout") include("include/checkout.php");
						if ($sec == "summary") include("include/summary.php");
						if ($sec == "thankyou") include("include/thankyou.php");
						if ($sec == "privacy") include("include/privacy.php");
//						if ($sec == "promo") include("include/promo.php");
						?>
						<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>
					</td>
					<td width="210" valign="top">
						<?
						include("include/cart.php");
						?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="2" cellpadding="0">
				<tr>
					<td colspan="3">
						<table width="100%" border="0" cellspacing="2" cellpadding="0">
						<tr>
							<td valign="top" class="smallBlack"><img src="images/spacer.gif" alt="" width="4" height="1" border="0"><strong>Already a Sprint customer?&nbsp;&nbsp;Request your <? echo round($sprint_discount); ?>% company discount for Sprint service - <a href="<? echo$_SERVER['REQUEST_URI']; ?>#top" onclick="show('Discount')" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" title="Sprint's Corporate Discount Center" class="smallBlue">Click Here</a><br><img src="images/spacer.gif" alt="" width="4" height="1" border="0"><strong>For help with online orders call <? echo $support_number; ?> or email: <a href="mailto:<? echo $support_email; ?>" title="Email Us" class="smallBlue"><? echo $support_email; ?></a></strong></td>
							<td align="right" valign="bottom" class="smallBlack"><strong>*Price After All <? echo iif($pricing_level == 5, "Discounts", "Rebates"); ?> and with New 1-Year Service Agreement</strong><img src="images/spacer.gif" alt="" width="4" height="1" border="0"></td>
<!--							<td align="right" valign="top" class="smallBlack"><strong>Already a Sprint customer?&nbsp;&nbsp;To request your <? echo round($sprint_discount); ?>% company sponsored discount for your Sprint account, <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" title="Sprint's Corporate Discount Center" class="smallBlue"><strong>Click Here</strong></a><img src="images/spacer.gif" alt="" width="4" height="1" border="0"></td>-->
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="3" bgcolor="#CCCCCC"><img src="images/spacer.gif" alt="" width="930" height="1" border="0"></td>
				</tr>
				<tr>
					<td width="150" valign="bottom" class="smallGray"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><a href="?sec=privacy" title="Privacy Policy" class="smallBlue"><strong>Privacy Policy</strong></a> | <a href="<? echo$_SERVER['REQUEST_URI']; ?>#top" onclick="show('Discount')" class="smallBlue"><strong>Discount</strong></a></td>
					<?
					if ($config['show_copyright'] == "T"){
					?>
					<td width="630" align="center" valign="bottom" title="Vision Wireless" class="smallGray"><strong>Copyright&copy; 2007-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Vision Wireless" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong></td>
					<?
					}else{
					?>
					<td width="630" class="smallGray">&nbsp;</td>	
<!--					<td width="630" align="center" valign="bottom" class="smallBlack"><strong>*Price After All <? echo iif($pricing_level == 5, "Discounts", "Rebates"); ?> and with New 2-Year Service Agreement</strong><img src="images/spacer.gif" alt="" width="4" height="1" border="0"></td>-->
					<?
					}
					?>
					<td width="150" align="right" valign="bottom" class="smallGray"><strong><? echo $label; ?></strong><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		</div>
	</td>
</tr>
</table>

<?
//}
?>


<!-- Layers/Pop Up ads -->

<!-- BEGIN Gift Card Promo -->
<div align="center" id="Discount" style="position:absolute; top:95; z-index:10; width:710; align:center; visibility:hidden; display:none;">

<? include("include/discount.php"); ?>

</div>

<!-- BEGIN Gift Card Promo -->
<div align="center" id="GiftCardPromo" style="position:absolute; top:-1000; z-index:10; width:600; align:center; display:block;">
<table width="700" border="0" cellspacing="5" cellpadding="0" align="center" bgcolor="#FFFFFF" style="border:3px solid <? echo $popup_border; ?>;">
<tr>
	<td>
		<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="700" height="400" colspan="2" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="10" background="images/GiftCardPromoSprint50.jpg" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">
				<tr>
					<td><img src="images/<? echo $site; ?>GiftCardPromo.jpg" alt="" width="540" height="40" border="0"></td>
					<td align="right">
						<a href="javascript:void(0)" onclick="hideAd('GiftCardPromo')" class="smallGray"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"><br>Close<br></a>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top">
						<img src="images/spacer.gif" alt="" width="600" height="140" border="0">
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" class="tinyGray">
<strong>American Express Gift Card Rebate Offer<br>
TERMS & CONDITIONS<br>
<br>
Purchase any device ("phone") from this website with a newly activated 2 year service plan with <? echo $carrier_label; ?> to qualify to receive a $50 American Express Gift Card ("Gift Card") by mail, while supplies last.<br>
<br>
To qualify for this Gift Card, you must be an active customer in good standing with <? echo $carrier_label; ?> for 30 days from the date your phone is activated.  You will not be eligible for this rebate if you de-activate your wireless service or return your phone.  All qualifying Gift Cards will be mailed automatically after your 30 day qualification period.  No rebate form(s) required.<br>
<br>
Open to residents of the 50 United States and the District of Columbia.  Limit of one (1) Gift Card per device purchased, per household (except in Rhode Island, where there is a limit of two (2) per household).  Offer void outside the U.S. and where prohibited.  If you have not received your Gift Card after 8 weeks from the date of your purchase, you may call (877)650-6556.<br>
<br>
Gift Cards are issued in U.S. dollars only.  Gift Cards must be redeemed as according to accompanying instructions.  Gift Card is not redeemable for cash and may not be used for cash withdrawal at any cash-dispensing locations or at any automated gasoline pumps.  Gift Card may be used to pay wireless bills.  Gift Card is non-transferable and non-refundable.  Each time you use the Gift Card the amount of the transaction will be deducted from the amount of your available balance.  Except where prohibited by law, all cards are subject to a monthly account maintenance fee of $3 (USD) from date of creation which is waived for the first six months; thereafter monthly maintenance fees are waived for an additional three months when the card is loaded or used in any given month.  No fees will be assessed once the card balance reaches zero.<br>
<br>
Vision Wireless makes no representation, warranty or guarantee whatsoever in relation to the third party products or services and neither assumes any liability whatsoever in relation to the third party products and services even if either has been advised of the possibility of such damages or can anticipate such damages.  Neither Vision Wireless nor their respective subsidiaries, parent companies, officers, directors, employees, members, managers, agents, or other affiliates, ("Affiliate"), are responsible for lost or stolen Prepaid American Express cards.  All brands, product names, company names, trademarks and service marks are the properties of their respective owners.  American Express is not a Sponsor of or affiliated with this offer in any way. Offer void where prohibited.
</strong>					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<script type="text/javascript">
// Center Gift Card Promo
if (document.layers) document.layers.GiftCardPromo.left = ((window.innerWidth / 2) - (700 / 2));  //Mozilla
else if (document.all) document.all.GiftCardPromo.style.left = ((document.body.offsetWidth / 2) - (700 / 2));  //IE
else if (document.getElementById) document.getElementById("GiftCardPromo").style.left = ((window.innerWidth / 2) - (700 / 2));

// Center Discount Information
if (document.layers) document.layers.Discount.left = ((window.innerWidth / 2) - (700 / 2));  //Mozilla
else if (document.all) document.all.Discount.style.left = ((document.body.offsetWidth / 2) - (700 / 2));  //IE
else if (document.getElementById) document.getElementById("Discount").style.left = ((window.innerWidth / 2) - (700 / 2));
</script>

<script>
// BEGIN FUNCTIONS TO POP & HIDE PROMO LAYER(S) ---
function hideAd(divId){
	if (document.layers) document.layers[divId].visibility = 'hide';
	else if (document.all) document.all[divId].style.visibility = 'hidden';
	else if (document.getElementById) document.getElementById(divId).style.visibility = 'hidden';
//	if (document.all) setTimeout("document.all.carriers.src = document['carriers'].src;",1); // IE animated gif fix
//	if (document.all) setTimeout("document.all.fivebars.src = document['fivebars'].src;",1); // IE animated gif fix
//	if (document.all) setTimeout("document.all.yourbenefits.src = document['yourbenefits'].src;",1); // IE animated gif fix
}

function showAd(divId){
	if (document.layers) document.layers[divId].visibility = 'show';
	else if (document.all) document.all[divId].style.visibility = 'visible';
	else if (document.getElementById) document.getElementById(divId).style.visibility = 'visible';
}

function adDown(divId, top){
	setTimeout("showAd('"+divId+"');",0);
	if(typeof topPos == 'undefined') topPos=top;
	if(topPos <= 75){
		topPos+=25;
		if (document.layers) document.layers[divId].top = topPos;
		else if (document.all) document.all[divId].style.top = topPos;
		else if (document.getElementById) document.getElementById(divId).style.top = topPos;	
		setTimeout("adDown('"+divId+"');",5);
	}else{
		topPos=top;
	}
//	if (document.all) setTimeout("document.all.carriers.src = document.all.carriers.src;",1); // IE animated gif fix
//	if (document.all) setTimeout("document.all.fivebars.src = document['fivebars'].src;",1); // IE animated gif fix
//	if (document.all) setTimeout("document.all.yourbenefits.src = document['yourbenefits'].src;",1); // IE animated gif fix
}

function popAd(adName, delay){
	adDown(adName, -450);
//	setTimeout("adDown('"+adName+"', -450);",1);
	setTimeout("hideAd('"+adName+"');",delay);
}

// END FUNCTIONS TO POP & HIDE PROMO LAYER(S) ---
</script>

</body>
</html>
