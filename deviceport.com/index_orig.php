<?
if ($_REQUEST['dev'] == "T"){
		$destination = "http://premier.deviceport.com/index2.php".$_SERVER['REQUEST_URI'];
		header("Location: $destination");
}
?>

<?
session_start();
if ($_REQUEST['sid']){
	$_SESSION['SID'] = $_REQUEST['sid'];
	$SID = $_SESSION['SID'];
}else{
	// If order just completed
	if ($_REQUEST['sec'] == "thankyou"){
//		session_regenerate_id(true);
		// Kill the old session!
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
		session_destroy();
	}
//	session_start();
	$_SESSION['SID'] = session_id();
	$SID = $_SESSION['SID'];
}
header("Cache-control: private");  // IE 6 Fix.
// NO CACHE!
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//echo '<font color="#FFFFFF">'.$SID.'</font>';
// Grab URL, split it up, and reverse it.
$host = array_reverse(explode(".",$_SERVER['HTTP_HOST']));
//$domain = strtolower($host[1]);
if (!$host[2] || strtolower($host[2]) == "www"){
	$destination = "http://www.visioncell.com";
	header("Location: $destination");
	exit;
}elseif (strtolower($host[2]) == "secure"){
	if ($_REQUEST['site']){
		$_SESSION['site'] = $_REQUEST['site'];
	}
}else{
	$_SESSION['site'] = $host[2];
}
If ($_REQUEST['site'] != ""){
	$_SESSION['site'] = $_REQUEST['site'];
}
$site = $_SESSION['site'];
//echo $site;
if ($_REQUEST['Carrier'] != ""){
	$_SESSION['carrier'] = $_REQUEST['Carrier'];
}
// Coming out of secure checkout pages
if ($_SERVER["HTTPS"]){
	if ($_REQUEST['step'] != "account" && $_REQUEST['step'] != "confirm"){
		$destination = "http://".$site.".deviceport.com".$_SERVER['REQUEST_URI'];
//		$destination = "http://".$site.".cellbenefits.com".$_SERVER['REQUEST_URI'];
//echo $destination;
//echo $_SERVER['HTTP_POST_VARS'];
//print_r($_REQUEST);
//for ($counter=0; $counter <= count($_SERVER); $counter++){
//	echo "i -> ".$_SERVER[$counter]."<br>";
//}
//		header("Location: $destination");
		echo'<script>location.href="'.$destination.'";</script>'; // Using javascript eliminates "non-secure destination" warning in IE
		exit;
	}
}
if ($_REQUEST['step'] == "thankyou"){
	// KILL SESSION!
	//session_save_path("/home/actipal/sessions");
	// Set the session timout to 24 hours - that should be plenty, even if they come back in the morning.
	//ini_set("session.gc_maxlifetime", "86400"); 
	//session_start();
	//$site = $_SESSION['site'];
	$_SESSION = array(); 
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	session_regenerate_id(true);
	$_SESSION['SID'] = session_id();
	//$SID = $_SESSION['SID'];
}
?>

<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$step = $_REQUEST['step'];
$message = $_REQUEST['message'];
$cargo = $_REQUEST['cargo'];
?>
<?
// Connect to the database
include "dbconnect.php";
?>
<?
if ($cargo == "remove"){
	if ($_REQUEST['esn'] != ""){
		$query = "DELETE FROM devices WHERE session_id='".$SID."' AND esn = '".$_REQUEST['esn']."'";
	}elseif ($_REQUEST['iccid'] != ""){
		$query = "DELETE FROM devices WHERE session_id='".$SID."' AND iccid = '".$_REQUEST['iccid']."'";
	}
//echo $query;
	$rs_remove = mysql_query($query, $linkID);
	$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
	$rs_cart = mysql_query($query, $linkID);
	if (mysql_num_rows($rs_cart) == false){
//		$query = "DELETE FROM orders WHERE session_id='".$SID."'";
		$query = "UPDATE orders SET carrier = '' WHERE session_id='".$SID."'";
		$rs_delete = mysql_query($query, $linkID);
//		header("Location: http://".$site.".cellbenefits.com/datasite/");
//		header("Location: ./");
//		$sec = "";
		echo'<script>location.href="./";</script>'; // Using javascript eliminates "non-secure destination" warning in IE
	}
}
?>
<?
// Grab site setup information
$result = mysql_query("SELECT * FROM sites WHERE site = '$site'", $linkID);
$config = mysql_fetch_assoc($result);
$label = $config['label'];
$title = $config['title'];
//$logo = $config['logo'];
$header_logo = $config['header_logo'];
$header_promo = $config['header_promo'];
//$discount_promo = $config['discount_promo'];
$pricing_level = $config['pricing_level'];
//$discount_form = $config['discount_form'];
$support_email = $config['support_email'];
$sprint_site = $config['sprint'];
$sprint_discount = $config['sprint_discount'];
$sprint_plan_notes = $config['sprint_plan_notes'];
//$nextel_site = $config['nextel'];
//$nextel_discount = $config['nextel_discount'];
//$nextel_plan_notes = $config['nextel_plan_notes'];
$cingular_site = $config['cingular'];
$cingular_discount = $config['cingular_discount'];
$cingular_plan_notes = $config['cingular_plan_notes'];
$verizon_site = $config['verizon'];
$verizon_discount = $config['verizon_discount'];
$verizon_plan_notes = $config['verizon_plan_notes'];
$plans_exclude = explode(',',$config['plans_exclude']);
?>
<?
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
	// Grab existing cart carrier selected, if any exists.
	$carrier_selected = "";
	$query = "SELECT carrier FROM orders WHERE session_id='".$SID."'";
//echo $query;
	$rs_carrier = mysql_query($query, $linkID);
	$row = mysql_fetch_assoc($rs_carrier);
	if (mysql_num_rows($rs_carrier) > 0) $carrier_selected = $row['carrier'];
// Cingular/AT&T sites
}elseif ($cingular_site == "T" ){
	$carrier_selected = "AT&T";
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
?>
<?
$tab = "Tab200BG.gif";
$tab_class = "bigWhite";
$bar_color = "#DD0C08";
$border_color = "#DD0C08";
$box_color = "#000000";
$box_bg = "#D0D0D0";
//$form_bg = "#DD0C08";
$form_bg = "#EFEFEF";
//echo $_SESSION['carrier'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title><? echo $title; ?></title>

	<!-- Meta Tags -->
	<meta name="description" content="Vision Wireless Cellular Data Account Activation Program - Activate service plans on Sprint-Nextel, AT&T (Cingular), and Verizon for embedded cellular data devices">
<!--	<meta name="keywords" content="Sprint Free Phones,Free,Motorola RAZR,Sprint Wireless Offer,Sprint Cellular Plans,RIM BlackBerry,Motorola Q,cell phone,Cell Phones,Cellular Phones,Cellphone,cellphones,free cell phones,free cellular phones,free phones,cell phone plans,cell phone specials,mobile phone,wireless phone,cellular phone service,service plan,cellular phone plans,wireless phone service,cell phone accessories, purchase cell phone,buy cell phone,research cell phones">-->
	<meta name="robots" content="all, index, follow">
	<meta name="revisit-after" content="3 days">
	<meta name="category" content="Cellular Wireless Data Devices">
	<meta name="subject" content="Cellular Wireless Data Devices">
	<meta name="classification" content="Cellular Wireless Data Devices">
	<meta name="rating" content="General">
	<meta name="author" content="Network Resources - www.nr.net">
	<meta http-equiv="code-language" content="PHP5">
	<meta http-equiv="content-language" content="en-us">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="imagetoolbar" content="no">
	<meta name="distribution" content="United States, USA, United States of America">
	<meta name="coverage" content="United States, USA, United States of America">
	<meta name="VW96.objecttype" content="Cellular Wireless Data Devices">
	<meta name="DC.title" content="Vision Wireless Cellular Data Account Activation Program">
	<meta name="DC.subject" content="Cellular Wireless Data Devices">
	<meta name="DC.description" content="Vision Wireless Cellular Data Account Activation Program">
	<meta name="DC.Coverage.PlaceName" content="United States, USA, United States of America">

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Define Home Base -->
	<?
	if ($sec == "activate"){
		if ($step == "account" || $step == "confirm"){
			echo'<base href="https://secure.nr.net/deviceport/">';
		}else{
			echo'<base href="http://'.$site.'.deviceport.com/">';
		}
	}else{
		echo'<base href="http://'.$site.'.deviceport.com/">';
	}
	?>

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	

</head>

<!--<body background="images/GrayGradientBG.jpg" bgcolor="#EFEFEF" leftmargin="0" topmargin="10" marginwidth="0" style="background-position: top left; background-repeat: repeat-x; background-attachment: scroll;">-->

<!--<body background="images/BlueGradientBG.jpg" bgcolor="#E7EEF8" leftmargin="0" topmargin="10" marginwidth="0" style="background-position: top left; background-repeat: repeat-x; background-attachment: scroll;">-->

<!--<body bgcolor="#E89EE2">-->

<body background="images/BG.jpg" bgcolor="#FFFFFF" leftmargin="0" topmargin="10" marginwidth="0" style="background-position: top left; background-repeat: repeat-x; background-attachment: scroll;">

<table width="950" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#8D8D8D">
<tr>
	<td>
		<div id="container" style="position:relative; width:950; align:center; display:block;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<!-- Header -->
		<tr>
<?
if ($site == "premier"){
?>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
				<tr>
<!--					<td width="174" valign="top">
						<img src="images/PoweredByPWS.gif" alt="Vision Wireless" height="60" border="0">
					</td>-->
					<td>
						<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,42,0" id="premier" width="940" height="254">
							<param name="movie" value="images/swf/activations.swf">
							<param name="wmode" value="opaque">
							<param name="bgcolor" value="#FFFFFF">
							<param name="quality" value="high">
							<param name="allowscriptaccess" value="samedomain">
							<embed type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" width="940" height="254" name="premier" src="images/swf/activations.swf" bgcolor="#FFFFFF" quality="high" swLiveConnect="true" allowScriptAccess="samedomain"></embed>
						</object>
					</td>
				</tr>
				</table>
			</td>
<?
}else{
?>
			<td height="100">
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
				<tr>
					<td><img src="images/<? echo $header_logo; ?>" alt="<? echo $label; ?> Logo" width="700" height="100" border="1"></td>
					<td align="right" valign="bottom">
						<img src="images/PoweredByPWS.gif" alt="Vision Wireless" height="60" border="0">
					</td>
				</tr>
				</table>
			</td>
<?
}
?>
		</tr>
		<tr>
			<td bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="940" height="1" border="0"></td>
		</tr>
		<!-- Button Bar -->
		<tr>
			<td bgcolor="#E6E6E6" background="images/ButtonBarBG.jpg">
				<table border="0" cellspacing="0" cellpadding="0">
				<!-- Buttons -->
				<tr>
					<td><img src="images/spacer.gif" alt="" width="20" height="30" border="0"></td>
					<td valign="bottom"><img alt="" width="1" <? echo iif(!$sec || $sec=='activate', 'src="images/GrayDot.gif" height="30"', 'src="images/WhiteDot.gif" height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif(!$sec || $sec=='activate', 'bgcolor="#E6E6E6" class="menuBlack">', 'class="menuWhite"><a href="?sec=activate" class="menuWhite">'); ?><strong>Activate</strong></a></td>
					<td valign="bottom"><img alt="" width="1" <? echo iif(!$sec || $sec=='activate' || $sec=='rebates', 'src="images/GrayDot.gif" height="30"', 'src="images/WhiteDot.gif" height="22"'); ?> border="0"></td>
<!--
					<td width="90" align="center" <? echo iif($sec=='phones', 'bgcolor="#E6E6E6" class="menuBlack">', 'class="menuWhite"><a href="?sec=phones" class="menuWhite">'); ?><strong>Phones</strong></a></td>
					<td valign="bottom"><img alt="" width="1" <? echo iif($sec=='phones' || $sec=='plans', 'src="images/GrayDot.gif" height="30"', 'src="images/WhiteDot.gif" height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='plans', 'bgcolor="#E6E6E6" class="menuBlack">', 'class="menuWhite"><a href="?sec=plans" class="menuWhite">'); ?><strong>Plans</strong></a></td>
					<td valign="bottom"><img alt="" width="1" <? echo iif($sec=='plans' || $sec=='coverage', 'src="images/GrayDot.gif" height="30"', 'src="images/WhiteDot.gif" height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='coverage', 'bgcolor="#E6E6E6" class="menuBlack">', 'class="menuWhite"><a href="?sec=coverage" class="menuWhite">'); ?><strong>Coverage</strong></a></td>
					<td valign="bottom"><img alt="" width="1" <? echo iif($sec=='coverage' || $sec=='rebates', 'src="images/GrayDot.gif" height="30"', 'src="images/WhiteDot.gif" height="22"'); ?> border="0"></td>
-->
					<td width="90" align="center" <? echo iif($sec=='rebates', 'bgcolor="#E6E6E6" class="menuBlack">', 'class="menuWhite"><a href="?sec=rebates" class="menuWhite">'); ?><strong>Rebates</strong></a></td>
					<td valign="bottom"><img alt="" width="1" <? echo iif($sec=='rebates' || $sec=='terms', 'src="images/GrayDot.gif" height="30"', 'src="images/WhiteDot.gif" height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='terms', 'bgcolor="#E6E6E6" class="menuBlack">', 'class="menuWhite"><a href="?sec=terms" class="menuWhite">'); ?><strong>Terms</strong></a></td>
					<td valign="bottom"><img alt="" width="1" <? echo iif($sec=='terms' || $sec=='faq', 'src="images/GrayDot.gif" height="30"', 'src="images/WhiteDot.gif" height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='faq', 'bgcolor="#E6E6E6" class="menuBlack">', 'class="menuWhite"><a href="?sec=faq" class="menuWhite">'); ?><strong>Questions</strong></a></td>
					<td valign="bottom"><img alt="" width="1" <? echo iif($sec=='faq' || $sec=='contact', 'src="images/GrayDot.gif" height="30"', 'src="images/WhiteDot.gif" height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='contact', 'bgcolor="#E6E6E6" class="menuBlack">', 'class="menuWhite"><a href="?sec=contact" class="menuWhite">'); ?><strong>Contact Us</strong></a></td>
					<td valign="bottom"><img alt="" width="1" <? echo iif($sec=='contact', 'src="images/GrayDot.gif" height="30"', 'src="images/WhiteDot.gif" height="22"'); ?> border="0"></td>
				</tr>
				<!-- Underlines -->
				<tr>
					<td><img src="images/GrayDot.gif" alt="" width="20" height="1" border="0"></td>
					<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif(!$sec || $sec=='activate', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
<!--
					<td <? echo iif($sec=='phones', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='plans', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='coverage', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
-->
					<td <? echo iif($sec=='rebates', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='terms', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='faq', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='contact', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
<!--					<td><img src="images/GrayDot.gif" alt="" width="201" height="1" border="0"></td>-->
					<td><img src="images/GrayDot.gif" alt="" width="474" height="1" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#E6E6E6">
				<!-- Warn that JavaScript is required if it's disabled-->
				<noscript class="bigBlack">
					<strong><br>
					This site requires that JavaScript support is enabled in your browser in order to function properly!<br>
					If you are reading this, JavaScript is NOT enabled.<br><br>
					<a href="http://www.mistered.us/tips/javascript/browsers.shtml" target="_blank" class="bigBlack" style="text-decoration:underline;">
					Click Here</a> if you need help enabling it.
					</strong>
				</noscript>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
				<?
				if ((!$sec) || $sec == "activate" && ((!$step) || $step == "select")) include("include/activate.php");
				if ($sec == "activate" && $step == "account") include("include/account.php");
				if ($sec == "activate" && $step == "confirm") include("include/confirm.php");
				if ($sec == "activate" && $step == "thankyou") include("include/thankyou.php");
//				if ($sec == "phones") include("include/phones.php");
//				if ($sec == "plans") include("include/plans.php");
//				if ($sec == "coverage") include("include/coverage.php");
				if ($sec == "rebates") include("include/rebates.php");
				if ($sec == "terms") include("include/terms.php");
				if ($sec == "faq") include("include/faq.php");
				if ($sec == "contact") include("include/contact.php");
				if ($sec == "account") include("include/account.php");
//				if ($sec == "checkout") include("include/checkout-sprint.php");
//				if ($sec == "thankyou") include("include/thankyou.php");
				if ($sec == "privacy") include("include/privacy.php");
if ($sec == "activate2") include("include/activate2.php");
				?>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
		</tr>
		<tr>
			<td bgcolor="#8D8D8D"><img src="images/spacer.gif" alt="" width="940" height="5" border="0"></td>
		</tr>
		</table>
<!--		</div>
	</td>
</tr>
<!-- Footer --
<tr bgcolor="#8D8D8D">
	<td>-->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="4"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
		</tr>
		<tr>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="85" border="0"></td>
			<td width="150" rowspan="2" valign="top">
				<!-- BEGIN ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
				<div id="ps_visionwireless_chat_button" style="width:140px;height:60px;display:inline"><spacer type="block" width="140" height="60"></spacer></div><div id="ps_visionwireless_chat_invitation" style="z-index:100;position:absolute;left:0px;top:0px;"></div><script id="ps_visionwireless_scr" language="JavaScript"></script><script language="JavaScript">if(document.getElementById)document.getElementById("ps_visionwireless_scr").src="https://secure.providesupport.com/image/js/visionwireless/safe-standard.js?ps_t="+new Date().getTime()</script><noscript><a href="http://www.providesupport.com?messenger=visionwireless" target="_blank">Live Support Chat</a></noscript>
				<!-- END ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
			</td>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td width="780" valign="top" class="bodyBlack">
<!--				<strong>
				<li>For help with existing Sprint accounts, please call 888.211.4727.</li>
				<li>To request a company sponsored discount be applied to your individual Sprint account, go to <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="smallWhite">www.sprint-discount.com</a>.</li>-->
				<li><strong>For help with online orders call 877.351.1658 or email <a href="mailto:<? echo $support_email; ?>" class="bodyBlack" style="text-decoration:underline;"><? echo $support_email; ?></a>.</strong>
				<br><br>
<!--				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tinyWhite">
				<tr>
					<td valign="top">*</td>
					<td>
				<?
				if ($pricing_level == 1){
				?>
						<em><strong>Phone price with new 2-year activation, after all available promotions & rebates, for activating a new non-substitute line of service with SPRINT-NEXTEL, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days.  Additional service fees may apply.</strong></em>
				<?
				}elseif ($pricing_level == 2){
				?>
						<em><strong>Additional service fees may apply.  Phone price with new 2-year activation, after all available promotions & rebates. Device pricing includes an Equipment Rebate of $50 that has been provided to you by Vision Wireless, an authorized agent, for activating a new non-substitute line of service with SPRINT-NEXTEL, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days. SPRINT-NEXTEL upgrades do not qualify for the $50.00 rebate.</strong></em>
				<?
				}
				?>


<?
if ($label == "Foster Farms"){ // SPECIAL
?>
<br><br><em><strong>Sprint-Nextel will issue a $36 dollar credit within the first 3 months of service to cover the activation fee charged by Sprint.  Offer valid for June, July and August 2007 on orders for a new line of service placed through this website.</strong></em>
<?
}
?>

					</td>
				</tr>
				</table>
				</strong>
-->
			</td>
		</tr>
		</table>
		</div>
	</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="150" valign="bottom"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><a href="?sec=privacy" class="smallWhite"><strong>Privacy Policy</strong></a></td>
			<td align="center" valign="bottom" class="smallGray"><strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Vision Wireless" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong></td>
			<td width="150" align="right" valign="bottom" class="smallGray"><strong><? echo $label; ?></strong><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
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

<?
if ($locked){
//	if ($_REQUEST['Carrier'] == "at&t"){
	if ($order['carrier'] == "at&t"){
		$logo = "AT&TLogo.gif";
	}else{
		$logo = ucwords($order['carrier'])."Logo.gif";
	}
	echo'
	<script>
		document["ChosenLogo"].src = "images/'.$logo.'";
		show("AcctTypeSection")
		show("AcctType");
		if (document.PlanForm.Carrier.value == "sprint" || document.PlanForm.Carrier.value == "verizon") {
			hide("ICCID");
			show("ESN");
			PlanForm.ESN.focus();
		}else{
			hide("ESN");
			show("ICCID");
			PlanForm.ICCID.focus();
		}
		show("Whoops");
	</script>';
//}else{
//	echo'
//	<script>
//		hide("Whoops");
//	</script>';
}

if ($message != ""){
	echo'<script>alert("'.$message.'");</script>';
}
?>

<form action="./" method="get" name="RemoveForm" id="RemoveForm">
	<input type="hidden" name="sec" id="sec" value="">
	<input type="hidden" name="step" id="step" value="">
	<input type="hidden" name="cargo" id="cargo" value="">
	<input type="hidden" name="Carrier" id="Carrier" value="">
	<input type="hidden" name="esn" id="esn" value="">
	<input type="hidden" name="iccid" id="iccid" value="">
	<input type="hidden" name="sid" id="sid" value="">
</form>
