<?
session_save_path("/var/www/html/deviceport.com/tmp");
// Set the session timout to 20 minutes
//ini_set("session.gc_maxlifetime", "1200"); 
session_start();
if ($_REQUEST['sid']){
	$_SESSION['SID'] = $_REQUEST['sid'];
	$SID = $_SESSION['SID'];
}else{
	// If order just completed - moved to 'thank you' step
//	if ($_REQUEST['sec'] == "thankyou"){
////		session_regenerate_id(true);
//		// Kill the old session!
//		$_SESSION = array();
//		if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
//		session_destroy();
//	}
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



	// start new session
	session_save_path("/var/www/html/deviceport.com/tmp");
	// Set the session timout to 20 minutes
//	ini_set("session.gc_maxlifetime", "1200"); 
	session_start();
//	$site = $_SESSION['site'];
	$_SESSION = array(); 
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	session_regenerate_id(true);
	$_SESSION['SID'] = session_id();
	// Assign new session ID
	$SID = $_SESSION['SID'];





//	// KILL SESSION!
//	//session_save_path("/home/actipal/sessions");
//	// Set the session timout to 24 hours - that should be plenty, even if they come back in the morning.
//	//ini_set("session.gc_maxlifetime", "86400"); 
//	//session_start();
//	//$site = $_SESSION['site'];
//	$_SESSION = array(); 
//	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
//	session_regenerate_id(true);
//	$_SESSION['SID'] = session_id();
//	//$SID = $_SESSION['SID'];
}
//echo $SID;
?>

<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$step = $_REQUEST['step'];
$task = $_REQUEST['task'];
$message = $_REQUEST['message'];
$cargo = $_REQUEST['cargo'];
?>
<?
// Connect to the database
include "dbconnect.php";
?>
<?
/*if ($cargo == "remove"){
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
*/?>
<?
// Grab site setup information
$result = mysql_query("SELECT * FROM sites WHERE site = '$site'", $linkID);
$config = mysql_fetch_assoc($result);
$branding = $config['branding'];
$label = $config['label'];
$title = $config['title'];
//$logo = $config['logo'];
$header_logo = $config['header_logo'];
$header_promo = $config['header_promo'];
//$discount_promo = $config['discount_promo'];
$pricing_level = $config['pricing_level'];
//$discount_form = $config['discount_form'];
$support_email = $config['support_email'];
$support_phone = $config['support_phone'];
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

// Grab branding setup information
$result = mysql_query("SELECT * FROM branding WHERE branding = '$branding'", $linkID);
$rs_branding = mysql_fetch_assoc($result);
$body_bgcolor = $rs_branding['body_bgcolor'];
$body_bgimage = $rs_branding['body_bgimage'];
$header_bgcolor = $rs_branding['header_bgcolor'];
$header_bgimage = $rs_branding['header_bgimage'];
$restart_button = $rs_branding['restart_button'];
$activate_tab = $rs_branding['activate_tab'];
$activate_on_tab = $rs_branding['activate_on_tab'];
$terms_tab = $rs_branding['terms_tab'];
$terms_on_tab = $rs_branding['terms_on_tab'];
$faq_tab = $rs_branding['faq_tab'];
$faq_on_tab = $rs_branding['faq_on_tab'];
$contact_tab = $rs_branding['contact_tab'];
$contact_on_tab = $rs_branding['contact_on_tab'];
$banner_bgcolor = $rs_branding['banner_bgcolor'];
$banner_bgimage = $rs_branding['banner_bgimage'];
$content_bgcolor = $rs_branding['content_bgcolor'];
$content_bgimage = $rs_branding['content_bgimage'];
$footer_bgcolor = $rs_branding['footer_bgcolor'];
$footer_bgimage = $rs_branding['footer_bgimage'];
$border_bgcolor = $rs_branding['border_bgcolor'];
$rowlabel_bgcolor = $rs_branding['rowlabel_bgcolor'];
$box_bgcolor = $rs_branding['box_bgcolor'];
$form_bgcolor = $rs_branding['form_bgcolor'];



?>

<?
$tab = "Tab200BG.gif";
$tab_class = "bigWhite";
$bar_color = "#DD0C08";
$border_color = "#DD0C08";
$box_color = "#000000";
$box_bg = "#D0D0D0";
//$form_bg = "#DD0C08";
//$form_bg = "#EFEFEF";
//$form_bg = "#F8F8F8";
//echo $_SESSION['carrier'];
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
}elseif ($verizon_site == "T" ){
	$carrier_selected = "Verizon";
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

	<!-- Favorite Icon -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> 

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
	<script language="JavaScript" src="timedate.js"></script>	

</head>

<body background="<? echo $body_bgimage; ?>" bgcolor="<? echo $body_bgcolor; ?>" leftmargin="0" topmargin="10" marginwidth="0" style="background-position: top left; background-repeat: repeat-x; background-attachment: scroll;">

<?
if ($branding == "premier"){
?>

<script language="javascript">
// Begin Loading Images for Menu Buttons
if (document.images) {
	// MouseOut Images
	tab1off = new Image(); 
	tab1off.src = "<? echo $activate_tab; ?>"; 
	tab2off = new Image(); 
	tab2off.src = "<? echo $terms_tab; ?>";
	tab3off = new Image();
	tab3off.src = "<? echo $faq_tab; ?>";
	tab4off = new Image(); 
	tab4off.src = "<? echo $contact_tab; ?>";   
	// MouseOver Images
	tab1on = new Image(); 
	tab1on.src = "<? echo $activate_on_tab; ?>"; 
	tab2on = new Image(); 
	tab2on.src = "<? echo $terms_on_tab; ?>";
	tab3on = new Image();
	tab3on.src = "<? echo $faq_on_tab; ?>";
	tab4on = new Image(); 
	tab4on.src = "<? echo $contact_on_tab; ?>";   
}

// Begin Swap Button
function tabOn(tabName) {
	if (document.images) {
		document[tabName].src = eval(tabName + "on.src");
	}
}

function tabOff(tabName) {
	if (document.images) {
		document[tabName].src = eval(tabName + "off.src");
	}
}

</script>

<table width="950" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td>
		<div id="container" style="position:relative; width:950; align:center; display:block;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<!-- Header -->
		<tr>
			<td bgcolor="<? echo $header_bgcolor; ?>" background="<? echo $header_bgimage; ?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="405"><a href="http://<? echo $site; ?>.deviceport.com/"><img src="images/spacer.gif" alt="" width="405" height="100" border="0"></a></td>
					<td valign="bottom">
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="8" align="right" valign="top">
							<?
							if ($_REQUEST['locked'] == "T" && $_REQUEST['task'] != "restart"){
							?>
								<script>
								// Toss everything into the bit bucket and start all over
								function restart(){
									startOver = confirm('                Start Order All Over?\n\n\rClick "OK" to start this order over from the beginning\n\ror click "Cancel" to continue with this order as-is.');
									if (!startOver){
										return false;
									}
									document.PlanForm.sec.value = "activate";
									document.PlanForm.task.value = "restart";
									document.PlanForm.submit();
								}
								</script>
								<a onClick="restart();" style="cursor:pointer;"><img src="<? echo $restart_button; ?>" alt="" width="100" height="65" border="0"></a>
							<?
							}else{
							?>
								<img src="images/spacer.gif" alt="" width="100" height="65" border="0">
							<?
							}
							?>
							</td>
						</tr>
						<tr>
							<td>
								<a href="?sec=activate" onMouseOver="tabOn('tab1')" onMouseOut="tabOff('tab1')">
								<img src="<? echo $activate_tab; ?>" alt="Activate Device(s)" name="tab1" id="tab1" width="130" height="35" border="0"></a></td>
							<td><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
							<td>
								<a href="?sec=terms" onMouseOver="tabOn('tab2')" onMouseOut="tabOff('tab2')">
								<img src="<? echo $terms_tab; ?>" alt="Terms & Conditions" name="tab2" id="tab2" width="130" height="35" border="0"></a></td>
							<td><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
							<td>
								<a href="?sec=faq" onMouseOver="tabOn('tab3')" onMouseOut="tabOff('tab3')">
								<img src="<? echo $faq_tab; ?>" alt="Frequently Asked Questions" name="tab3" id="tab3" width="130" height="35" border="0"></a></td>
							<td><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
							<td>
								<a href="?sec=contact" onMouseOver="tabOn('tab4')" onMouseOut="tabOff('tab4')">
								<img src="<? echo $contact_tab; ?>" alt="Contact Information" name="tab4" id="tab4" width="130" height="35" border="0"></a></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF"><img src="images/spacer.gif" alt="" width="950" height="1" border="0"></td>
		</tr>
		<!-- Banner -->
		<tr>
			<td bgcolor="<? echo $banner_bgcolor; ?>" background="<? echo $banner_bgimage; ?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="800"><img src="images/spacer.gif" alt="" width="800" height="80" border="0"></td>
					<td align="center" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
						<!-- BEGIN ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
						<div id="ps_visionwireless_chat_button" style="width:140px;height:60px;display:inline"><spacer type="block" width="140" height="60"></spacer></div><div id="ps_visionwireless_chat_invitation" style="z-index:100;position:absolute;left:0px;top:0px;"></div><script id="ps_visionwireless_scr" language="JavaScript"></script><script language="JavaScript">if(document.getElementById)document.getElementById("ps_visionwireless_scr").src="https://secure.providesupport.com/image/js/visionwireless/safe-standard.js?ps_t="+new Date().getTime()</script><noscript><a href="http://www.providesupport.com?messenger=visionwireless" target="_blank">Live Support Chat</a></noscript>
						<!-- END ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<!-- Content -->
		<tr>
			<td align="center" bgcolor="<? echo $content_bgcolor; ?>" background="<? echo $content_bgimage; ?>" style="background-position: top left; background-repeat: no-repeat; background-attachment: scroll;">
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
				if ($branding == "vision"){
					if ((!$sec) || $sec == "activate" && ((!$step) || $step == "select")) include("include/activate.php");
					if ($sec == "activate" && $step == "account") include("include/account.php");
					if ($sec == "activate" && $step == "confirm") include("include/confirm.php");
					if ($sec == "activate" && $step == "thankyou") include("include/thankyou.php");
					if ($sec == "terms") include("include/terms.php");
					if ($sec == "faq") include("include/faq.php");
					if ($sec == "contact") include("include/contact.php");
					if ($sec == "account") include("include/account.php");
					if ($sec == "privacy") include("include/privacy.php");
if ($sec == "activate2") include("include/activate2.php");
				}elseif ($branding == "premier"){
					if ((!$sec) || $sec == "activate" && ((!$step) || $step == "select")) include("include/activate_premier.php");
//					if ($sec == "activate" && $step == "account") include("include/account_premier.php");
					if ($sec == "activate" && $step == "account") include("include/activate_premier.php");
//					if ($sec == "activate" && $step == "confirm") include("include/confirm_premier.php");
					if ($sec == "activate" && $step == "confirm") include("include/activate_premier.php");
//					if ($sec == "activate" && $step == "thankyou") include("include/thankyou_premier.php");
					if ($sec == "activate" && $step == "thankyou") include("include/activate_premier.php");
					if ($sec == "terms") include("include/terms_premier.php");
					if ($sec == "faq") include("include/faq_premier.php");
					if ($sec == "contact") include("include/contact_premier.php");
					if ($sec == "account") include("include/account_premier.php");
					if ($sec == "privacy") include("include/privacy_premier.php");
				}
				?>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
			</td>
		</tr>
		<!-- Footer -->
		<tr>
			<td bgcolor="<? echo $footer_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="950" height="1" border="0"></td>
		</tr>
		<tr>
			<td bgcolor="<? echo $footer_bgcolor; ?>" background="<? echo $footer_bgimage; ?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td rowspan="2"><img src="images/spacer.gif" alt="" width="1" height="75" border="0"></td>
					<td colspan="4">
						<table border="0" cellspacing="0" cellpadding="0" align="center" class="xbigWhite">
						<tr>
							<td>For help with online orders call <? echo $support_phone; ?> or email <a href="mailto:<? echo $support_email; ?>" class="xbigWhite" style="text-decoration:underline;"><? echo $support_email; ?></a>.</td>
							<td><img src="images/spacer.gif" alt="" width="1" height="25" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" alt="" width="50" height="1" border="0"></td>
					<td width="475" valign="top" class="bodyWhite">
						<table border="0" cellspacing="0" cellpadding="0" class="bodyWhite">
						<tr>
							<td><a href="?sec=activate" class="bodyWhite">Activate</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="?sec=terms" class="bodyWhite">Terms</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="?sec=faq" class="bodyWhite">Questions</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="?sec=contact" class="bodyWhite">Contact</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="?sec=privacy" class="bodyWhite">Privacy</a></td>
						</tr>
						</table>
					</td>
					<td width="475" align="right" valign="top" class="bodyWhite">
						Copyright&copy; 2007-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Vision Wireless" target="_blank" class="bodyWhite">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong>
					</td>
					<td><img src="images/spacer.gif" alt="" width="50" height="1" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>



<?
}else{
?>

<?
}
?>






