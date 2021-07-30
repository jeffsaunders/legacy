<?
// Set the location for saving session cookies
//session_save_path("/var/www/html/deviceport.com/tmp");
session_save_path("/var/www/nr.net/tmp");
// Set the session timout to 20 minutes
//ini_set("session.gc_maxlifetime", "1200"); 
session_start();
// If SID was passed, assign it
if ($_REQUEST['sid']){
	$_SESSION['SID'] = $_REQUEST['sid'];
	$SID = $_SESSION['SID'];
// ...otherwise grab it from the cookie
}else{
	$_SESSION['SID'] = session_id();
	$SID = $_SESSION['SID'];
}

// Connect to the database
include "dbconnect.php";

// If they only asked for a plan change, grab the device records for the email before destrying the cookie
if ($_REQUEST['step'] == "sendchange"){
	$query = "SELECT * FROM devices WHERE session_id='".$SID."'";
	$rs_change_devices = mysql_query($query, $linkID);
}
// if they are finished, destroy the session so they can start again
if ($_REQUEST['step'] == "thankyou" || $_REQUEST['step'] == "sendchange"){
	// start new session
//	session_save_path("/var/www/html/deviceport.com/tmp");
	session_save_path("/var/www/nr.net/tmp");
	// Set the session timout to 20 minutes
//	ini_set("session.gc_maxlifetime", "1200"); 
	session_start();
	$_SESSION = array(); 
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	session_regenerate_id(true);
	$_SESSION['SID'] = session_id();
	$_SESSION['passed'] = "true"; // this is only applicable if the site has a password - bypasses asking again
	// Assign new session ID
	$SID = $_SESSION['SID'];
}

// IE 6 Fix
header("Cache-control: private");
// NO CACHE!
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Grab URL, split it up, and reverse it.
$host = array_reverse(explode(".",$_SERVER['HTTP_HOST']));
//$domain = strtolower($host[1]);
// If there is no host name or the host is "www", send them to Vision's site.
//if (!$host[2] || strtolower($host[2]) == "www"){
if (strtolower($host[3]) == "www"){
//	$destination = "http://www.visioncell.com";
	$destination = "http://aircell.deviceport.nr.net";
	header("Location: $destination");
	exit;
// If they have gone secure, set the site name to the passed parameter instead of the host name
}elseif (strtolower($host[2]) == "secure"){
	if ($_REQUEST['site']){
		$_SESSION['site'] = $_REQUEST['site'];
	}
// ...otherwise, set the site name to the host name
}else{
//	$_SESSION['site'] = $host[2];
	$_SESSION['site'] = $host[3];
}
// Catch-all to set the site to the passed parameter's value - override all above code if a value is passed
If ($_REQUEST['site'] != ""){
	$_SESSION['site'] = $_REQUEST['site'];
}
// assign it to a simple variable for easy work
$site = $_SESSION['site'];
//echo $site;

// If the carrier's name was passed, use it
if ($_REQUEST['Carrier'] != ""){
	$_SESSION['carrier'] = $_REQUEST['Carrier'];
}

// Coming out of secure checkout pages
if ($_SERVER["HTTPS"]){
	if ($_REQUEST['step'] != "account" && $_REQUEST['step'] != "confirm"){
		// Rebuild the original URL
//		$destination = "http://".$site.".deviceport.com".$_SERVER['REQUEST_URI'];
		$destination = "http://".$site.".deviceport.nr.net".$_SERVER['REQUEST_URI'];
//		header("Location: $destination");
		echo'<script>location.href="'.$destination.'";</script>'; // Using javascript eliminates "non-secure destination" warning in IE
		exit;
	}
}

// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$step = $_REQUEST['step'];
$task = $_REQUEST['task'];
$message = $_REQUEST['message'];
$cargo = $_REQUEST['cargo'];

// Grab site setup information
$result = mysql_query("SELECT * FROM sites WHERE site = '$site'", $linkID);
$config = mysql_fetch_assoc($result);
$branding = $config['branding'];
$password_protect = $config["password_protect"];
$change_plan = $config["change_plan"];
$excel_upload = $config["excel_upload"];
$label = $config['label'];
$title = $config['title'];
$familiar_name = $config['familiar_name'];
$activator_name = $config['activator_name'];
$introduction = $config['introduction'];
$contact_name = $config['contact_name'];
$contact_address = $config['contact_address'];
$contact_phone = $config['contact_phone'];
$contact_fax = $config['contact_fax'];
$contact_tollfree = $config['contact_toll-free'];
$contact_email = $config['contact_email'];
$contact_url = $config['contact_url'];
$support_email = $config['support_email'];
$support_phone = $config['support_phone'];
$sprint_site = $config['sprint'];
$sprint_discount = $config['sprint_discount'];
$sprint_plan_notes = $config['sprint_plan_notes'];
$sprint_voice_plans = $config['sprint_voice_plans'];
//$nextel_site = $config['nextel'];
//$nextel_discount = $config['nextel_discount'];
//$nextel_plan_notes = $config['nextel_plan_notes'];
//$nextel_voice_plans = $config['nextel_voice_plans'];
$cingular_site = $config['cingular'];
$cingular_discount = $config['cingular_discount'];
$cingular_plan_notes = $config['cingular_plan_notes'];
$cingular_voice_plans = $config['cingular_voice_plans'];
$verizon_site = $config['verizon'];
$verizon_discount = $config['verizon_discount'];
$verizon_plan_notes = $config['verizon_plan_notes'];
$verizon_voice_plans = $config['verizon_voice_plans'];
$plans_exclude = explode(',',$config['plans_exclude']);
$show_reps = $config['show_reps'];
$show_login = $config['show_login'];

// Grab branding setup information
$result = mysql_query("SELECT * FROM branding WHERE branding = '$branding'", $linkID);
$rs_branding = mysql_fetch_assoc($result);
$body_bgcolor = $rs_branding['body_bgcolor'];
$body_bgimage = $rs_branding['body_bgimage'];
$header_bgcolor = $rs_branding['header_bgcolor'];
if ($config['header_bgimage'] != ""){ //header override?
	$header_bgimage = $config['header_bgimage'];
}else{
	$header_bgimage = $rs_branding['header_bgimage'];
}
if ($config['welcome_headline'] != ""){ //Welcome headline message override?
	$welcome_headline = $config['welcome_headline'];
}else{
	$welcome_headline = "Welcome to the ".$config['familiar_name']." Activation Portal";
}
$restart_button = $rs_branding['restart_button'];
$restart_on_button = $rs_branding['restart_on_button'];
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
$border_color = $rs_branding['border_color'];
?>

<?
// Legacy - delete if no adverse affect
//$tab = "Tab200BG.gif";
//$tab_class = "bigWhite";
//$bar_color = "#DD0C08";
//$box_color = "#000000";
//$box_bg = "#D0D0D0";
?>

<?
// Assign carrier name to session variable
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
// Verizon sites
}elseif ($verizon_site == "T" ){
	$carrier_selected = "Verizon";
}
$_SESSION['carrier'] = $carrier_selected;
?>

<?
// Check to see if we already have this account session started
$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
$rs_order = mysql_query($query, $linkID);
$order = mysql_fetch_assoc($rs_order);
// If found lock in the carrier
if ($order["carrier"] != ""){
	$locked = true;
}else{
	$locked = false;
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
			// Secure
//			echo'<base href="https://secure.nr.net/deviceport/">';
			echo'<base href="http://'.$site.'.deviceport.nr.net/">';
		}else{
//			echo'<base href="http://'.$site.'.deviceport.com/">';
			echo'<base href="http://'.$site.'.deviceport.nr.net/">';
		}
	}else{
//		echo'<base href="http://'.$site.'.deviceport.com/">';
		echo'<base href="http://'.$site.'.deviceport.nr.net/">';
	}
	?>

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	
	<script language="JavaScript" src="timedate.js"></script>	

</head>

<body background="<? echo $body_bgimage; ?>" bgcolor="<? echo $body_bgcolor; ?>" leftmargin="0" topmargin="10" marginwidth="0" style="background-position: top left; background-repeat: repeat-x; background-attachment: scroll;">
<!-- onLoad="setFocusFirstField();" This function was causing long pages to be scrolled down by default if the first field was below the "fold"-->

<script language="javascript">
// Set focus to the first field of the first form - no name required
function setFocusFirstField(){
	try{
		var bFound = false;
		for (f=0; f < document.forms.length; f++){
			for(i=0; i < document.forms[f].length; i++){
				if (document.forms[f][i].type != "hidden"){
					if (document.forms[f][i].type != "button"){
					// Add more types to exclude here
						if (document.forms[f][i].disabled != true){
							document.forms[f][i].focus();
							var bFound = true;
						}
					}
				}
				if (bFound == true){
					break;
				}
			}
			if (bFound == true){
				break;
			}
		}
	}
	catch(e){
	// do nothing
	}
}

// Only accept digits (numbers)
function onlyNumbers(e,o){
//alert(o.value);
	var keynum
	var keychar
	var ltrcheck
	var crcheck
	if(window.event){ // IE
		keynum = e.keyCode
	}else if(e.which){ // Netscape/Firefox/Opera
		keynum = e.which
	}
//alert(keynum);
	if (keynum == 08 || !keynum) return true; // Backspace or navigation (arrow) key
	keychar = String.fromCharCode(keynum)
	ltrcheck = /\D/ //Regular expression for NON-digit (letter)
	crcheck = /\cM/ //Regular expression ctrl-M (enter)
	if (crcheck.test(keychar)) o.blur();
	return !ltrcheck.test(keychar) //Return true if not a letter
//	return (!ltrcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter OR enter
}

// Begin Loading Images for Menu Buttons
if (document.images) {
	// MouseOut Images
	restartoff = new Image(); 
	restartoff.src = "<? echo $restart_button; ?>"; 
	tab1off = new Image(); 
	tab1off.src = "<? echo $activate_tab; ?>"; 
	tab2off = new Image(); 
	tab2off.src = "<? echo $terms_tab; ?>";
	tab3off = new Image();
	tab3off.src = "<? echo $faq_tab; ?>";
	tab4off = new Image(); 
	tab4off.src = "<? echo $contact_tab; ?>";   
	// MouseOver Images
	restarton = new Image(); 
	restarton.src = "<? echo $restart_on_button; ?>"; 
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
					<!-- make this width 405 for all 4 tabs -->
<!--					<td width="540"><a href="http://<? echo $site; ?>.deviceport.com/"><img src="images/spacer.gif" alt="" width="540" height="100" border="0"></a></td>-->
					<td width="540"><a href="http://<? echo $site; ?>.deviceport.nr.net/"><img src="images/spacer.gif" alt="" width="540" height="100" border="0"></a></td>
					<td valign="bottom">
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="8" align="right" valign="top">
							<?
//		405					if ($locked == true && $sec == "activate" && $step != "thankyou"){
							if ((!$sec || $sec == "activate") && $step != "thankyou" && $step != "sendchange"){
							?>
								<script>
								// Toss everything into the bit bucket and start all over
								function restartIt(){
									startOver = confirm('                Start Order All Over?\n\n\rClick "OK" to start this order over from the beginning\n\ror click "Cancel" to continue with this order as-is.');
									if (!startOver){
										return false;
									}
									<?
									if (!$step || $step == "select"){
									?>
									document.PlanForm.sid.value = "<? echo $SID; ?>";
									document.PlanForm.sec.value = "activate";
									document.PlanForm.task.value = "restart";
									document.PlanForm.action = 'saveit.php';
									document.PlanForm.submit();
									<?
									}elseif ($step == "account"){
									?>
									document.AcctInfo.sid.value = "<? echo $SID; ?>";
									document.AcctInfo.sec.value = "activate";
									document.AcctInfo.task.value = "restart";
									document.AcctInfo.action = 'saveit.php';
									document.AcctInfo.submit();
									<?
									}elseif ($step == "confirm"){
									?>
									document.ConfirmOrder.sid.value = "<? echo $SID; ?>";
									document.ConfirmOrder.sec.value = "activate";
									document.ConfirmOrder.task.value = "restart";
									document.ConfirmOrder.action = 'saveit.php';
									document.ConfirmOrder.submit();
									<?
									}
									?>
								}
								</script>
								<!-- Restart Button -->
								<a onClick="restartIt();" onMouseOver="tabOn('restart')" onMouseOut="tabOff('restart')" style="cursor:pointer;"><img src="<? echo $restart_button; ?>" alt="" name="restart" id="restart" width="100" height="65" border="0"></a>
							<?
							}else{
							?>
								<img src="images/spacer.gif" alt="" width="100" height="65" border="0">
							<?
							}
							?>
							</td>
						</tr>
						<!-- Tabs -->
						<tr>
							<td>
								<a href="?sec=activate" onMouseOver="tabOn('tab1')" onMouseOut="tabOff('tab1')">
								<img src="<? echo $activate_tab; ?>" alt="Activate Device(s)" name="tab1" id="tab1" width="130" height="35" border="0"></a></td>
							<td><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
							<td>
								<a href="?sec=terms" onMouseOver="tabOn('tab2')" onMouseOut="tabOff('tab2')">
								<img src="<? echo $terms_tab; ?>" alt="Terms & Conditions" name="tab2" id="tab2" width="130" height="35" border="0"></a></td>
							<td><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>
<!--							<td>
								<a href="?sec=faq" onMouseOver="tabOn('tab3')" onMouseOut="tabOff('tab3')">
								<img src="<? echo $faq_tab; ?>" alt="Frequently Asked Questions" name="tab3" id="tab3" width="130" height="35" border="0"></a></td>
							<td><img src="images/spacer.gif" alt="" width="3" height="1" border="0"></td>-->
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
			<td bgcolor="<? echo $border_color; ?>"><img src="images/spacer.gif" alt="" width="950" height="1" border="0"></td>
		</tr>
		<!-- Banner -->
		<tr>
			<td bgcolor="<? echo $banner_bgcolor; ?>" background="<? echo $banner_bgimage; ?>">
<!-- Original Support Button
				<table width="950" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="798"><img src="images/spacer.gif" alt="" width="789" height="80" border="0"></td>
					<!-- Support Button --
					<td width="150" align="center" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="17" border="0"><br>
						<!-- BEGIN ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages --
						<div id="ps_visionwireless_chat_button" style="width:150px;height:50px;display:inline"><spacer type="block" width="150" height="50"></spacer></div><div id="ps_visionwireless_chat_invitation" style="z-index:100;position:absolute;left:0px;top:0px;"></div><script id="ps_visionwireless_scr" language="JavaScript"></script><script language="JavaScript">if(document.getElementById)document.getElementById("ps_visionwireless_scr").src="https://secure.providesupport.com/image/js/visionwireless/safe-standard.js?ps_t="+new Date().getTime()</script><noscript><a href="http://www.providesupport.com?messenger=visionwireless" target="_blank">Live Support Chat</a></noscript>
						<!-- END ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages --
					</td>
					<td width="2"><img src="images/spacer.gif" alt="" width="2" height="1" border="0"></td>
				</tr>
				</table>-->
<!-- New Support Button -->
				<table width="950" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="789"><img src="images/spacer.gif" alt="" width="789" height="80" border="0"></td>
					<!-- Support Button -->
					<td width="159" align="center" valign="bottom">
						<script type="text/javascript" src="http://216.131.117.233:9996/JavaScript.ashx?fileMask=Optional/ChatScripting"></script>
						<script src="http://216.131.117.233:9996/ChatScript.ashx?config=1&id=ControlID" type="text/javascript"></script>
						<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
					</td>
					<td width="2"><img src="images/spacer.gif" alt="" width="2" height="1" border="0"></td>
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
				if ((!$sec) || $sec == "activate" && ((!$step) || $step == "select")) include("include/activate.php");
				// This is redundent, I know, but it leaves flexibility
				if ($sec == "activate" && $step == "account") include("include/activate.php");
				if ($sec == "activate" && $step == "confirm") include("include/activate.php");
				if ($sec == "activate" && $step == "thankyou") include("include/activate.php");
				if ($sec == "activate" && $step == "sendchange") include("include/activate.php");
if ($sec == "activate2") include("include/activate_work.php");
//if ($sec == "activate2" && $step == "select") include("include/activate_work.php");
//if ($sec == "activate2" && $step == "account") include("include/activate_work.php");
//if ($sec == "activate2" && $step == "confirm") include("include/activate_work.php");
//if ($sec == "activate2" && $step == "thankyou") include("include/activate_work.php");
				if ($sec == "terms") include("include/terms.php");
				if ($sec == "faq") include("include/faq.php");
				if ($sec == "contact") include("include/contact.php");
				if ($sec == "privacy") include("include/privacy.php");
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

<?
if ($_SESSION['site'] == "johndeere" && !$sec){  // Don't show text links if landing page for John Deere site.
	echo "&nbsp;";
}else{
?>

						<table border="0" cellspacing="0" cellpadding="0" class="bodyWhite">
						<tr>
							<td><a href="/" class="bodyWhite">Activate</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="?sec=terms" class="bodyWhite">Terms</a></td>
							<td>&nbsp;|&nbsp;</td>
<!--							<td><a href="?sec=faq" class="bodyWhite">Questions</a></td>
							<td>&nbsp;|&nbsp;</td>-->
							<td><a href="?sec=contact" class="bodyWhite">Contact</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="?sec=privacy" class="bodyWhite">Privacy</a></td>
						</tr>
						</table>

<?
}
?>

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
