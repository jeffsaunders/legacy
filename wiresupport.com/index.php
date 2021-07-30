<?
session_start();
$_SESSION['SID'] = session_id();
/*if ($_REQUEST['sid']){
	$_SESSION['SID'] = $_REQUEST['sid'];
	$SID = $_SESSION['SID'];
}else{
	// If request just completed
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
}*/
header("Cache-control: private");  // IE 6 Fix.
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
$site = $_SESSION['site'];
$site = "virgin";
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
// Test for Browser
$navigator_user_agent = (isset( $_SERVER['HTTP_USER_AGENT']))?strtolower($_SERVER['HTTP_USER_AGENT']):'';
?>

<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$task = $_REQUEST['task'];
//$anchor = $_REQUEST['anchor'];
//$message = $_REQUEST['message'];
//$cargo = $_REQUEST['cargo'];
?>
<?
// Connect to the database
include "dbconnect.php";
?>
<?
// Grab site setup information
$result = mysql_query("SELECT * FROM sites WHERE site = '$site'", $linkID);
$config = mysql_fetch_assoc($result);
$label = $config['label'];
$title = $config['title'];
$branding = $config['branding'];
$header_logo = $config['header_logo'];
$welcome_msg = $config['welcome_msg'];
$change_plan = $config['change_plan'];
$change_num = $config['change_num'];
$swap_device = $config['swap_device'];
$change_user = $config['change_user'];
$transfer = $config['transfer'];
$stop = $config['stop'];
$rma = $config['rma'];
$faq = $config['faq'];
$plans = $config['plans'];
?>
<?
// Branding Config
switch($branding){
	case "vision":
		$main_border = "#343434";
		$headerbg_left = "VisionBGHeaderLeft.gif";
		$headerbg_center = "VisionBGHeaderCenter.gif";
		$headerbg_right = "VisionBGHeaderRight.gif";
		$carrierlogo = "SprintHeaderBlack.gif";
		$buttonbarbg = "VisionButtonBarBG.gif";
		$buttonbarhover = "VisionButtonBG.gif";
		$menu_seperator = "WhiteDot.gif";
		$menu_class = "menuWhite";
		$bodybg = "spacer.gif";
		$bodybg_color = "#E6E6E6";
		$homelink_class = "menuRed";
		$homebullet = "VisionMenuBullet.gif";

		$tab = "Tab200BG.gif";
		$tab_class = "bigWhite";
		$bar_color = "#DD0C08";
		$border_color = "#DD0C08";
		break;
	case "sprint":
		$main_border = "#112940";
		$headerbg_left = "SprintBGHeaderLeft.jpg";
		$headerbg_center = "SprintBGHeaderCenter.jpg";
		$headerbg_right = "SprintBGHeaderRight.jpg";
		$carrierlogo = "SprintHeaderWhite.gif";
		$buttonbarbg = "SprintButtonBarBG.jpg";
		$buttonbarhover = "SprintButtonBG.gif";
		$menu_seperator = "GrayDot.gif";
		$menu_class = "menuBlack";
		$bodybg = "SprintBGContent.jpg";
		$bodybg_color = "#EFEFEF";
		$homelink_class = "menuBlack";
		$homebullet = "SprintMenuBullet.gif";

		$tab = "SprintTab200BG.gif";
		$tab_class = "bigBlack";
		$bar_color = "#FFE100";
		$border_color = "#FFE100";
		break;
	default:
		$main_border = "#343434";
		$headerbg_left = "VisionBGHeaderLeft.gif";
		$headerbg_center = "VisionBGHeaderCenter.gif";
		$headerbg_right = "VisionBGHeaderRight.gif";
		$carrierlogo = "SprintHeaderBlack.gif";
		$buttonbarbg = "VisionButtonBarBG.gif";
		$buttonbarhover = "VisionButtonBG.gif";
		$menu_seperator = "WhiteDot.gif";
		$menu_class = "menuWhite";
		$bodybg = "spacer.gif";
		$bodybg_color = "#E6E6E6";
		$homelink_class = "menuRed";
		$homebullet = "VisionMenuBullet.gif";

		$tab = "Tab200BG.gif";
		$tab_class = "bigWhite";
		$bar_color = "#DD0C08";
		$border_color = "#DD0C08";
//		$box_color = "#000000";
//		$box_bg = "#E6E6E6";
//		$form_bg = "#EFEFEF";
} // End Switch

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title><? echo $title; ?></title>

	<!-- Meta Tags -->
	<meta name="description" content="Vision Wireless Sprint-Nextel Customer Care Portal">
	<meta name="keywords" content="">
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
	<meta name="VW96.objecttype" content="Vision Wireless Sprint-Nextel Customer Care Portal.">
	<meta name="DC.title" content="Vision Wireless Sprint-Nextel Customer Care Portal">
	<meta name="DC.subject" content="Cellular Wireless Phones &amp; Accessories">
	<meta name="DC.description" content="Vision Wireless Sprint-Nextel Customer Care Portal">
	<meta name="DC.Coverage.PlaceName" content="United States, USA, United States of America">

	<!-- Favorite Icon -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> 

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Define Home Base -->
	<?
//	if ($sec == "checkout"){
//		echo'<base href="https://secure.nr.net/cellbenefits/">';
//	}else{
		echo'<base href="http://'.$site.'.wiresupport.nr.net/">';
//	}
	?>

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
<!--	<script language="JavaScript" src="custom.js"></script>	-->

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

<body bgcolor="#E3E3E3" leftmargin="0" topmargin="0" marginwidth="0" style="background:url(images/BGPage.jpg) top repeat-x; background-color:#E3E3E3;">

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="thetab" style="table-layout:fixed;">
<tr>
	<!-- Left Top BG Shadow -->
	<td height="435" style="background:url(images/BGLeftTop.jpg) top right no-repeat;"><img src="images/spacer.gif" alt="" width="1" height="435" border="0"></td>
	<td id="mainBody" valign="top" width="950" rowspan="3">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<!-- Body -->
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="5" cellpadding="0" bgcolor="<? echo $main_border; ?>">
				<tr>
					<td bgcolor="#FFFFFF">
						<div id="container" style="position:relative; width:940; align:center; display:block;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<!-- Header -->
						<tr>
							<td colspan="2">
								<table width="100%" bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="300" height="75" style="background:url(images/<? echo $headerbg_left; ?>) top left no-repeat;">
										<img src="images/<? echo $header_logo; ?>" alt="<? echo $label; ?>" width="300" height="75" border="0"></td>
									<td width="440" style="background:url(images/<? echo $headerbg_center; ?>) top center no-repeat;">
										<img src="images/spacer.gif" alt="" width="440" height="75" border="0"></td>
									<td width="200" style="background:url(images/<? echo $headerbg_right; ?>) top right no-repeat;">
										<img src="images/<? echo $carrierlogo; ?>" alt="" width="200" height="75" border="0"></td>
								</tr>
								</table>
							</td>
						</tr>
						<!-- Button Bar -->
						<tr>
							<td colspan="2" bgcolor="<? echo $main_border; ?>"><img src="images/spacer" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td colspan="2" bgcolor="#E6E6E6" background="images/<? echo $buttonbarbg; ?>">
<!--<img src="images/spacer.gif" alt="" width="1" height="27" border="0">-->
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<!-- Buttons -->
								<tr>
									<td><img src="images/spacer.gif" alt="" width="20" height="30" border="0"></td>
									<td valign="bottom"><img src="images/<? echo $menu_seperator; ?>" alt="" width="1" height="30" border="0"></td>
									<td width="180" align="center"
										onMouseOver="this.style.backgroundImage='url(images/<? echo $buttonbarhover; ?>)';
											document.getElementById('menuText').innerHTML = 'Home Page Showing Available Services.';
											show('menuHelp');"
										onMouseOut="this.style.backgroundImage='url(images/spacer.gif)';
											hide('menuHelp');"
										style="cursor:pointer;"
										class="<? echo $menu_class; ?>"
										onClick="location.href='?sec=home';">
										Home
									</td>
									<td valign="bottom"><img src="images/<? echo $menu_seperator; ?>" alt="" width="1" height="30" border="0"></td>
									<td width="180" align="left"
										onMouseOver="this.style.backgroundImage='url(images/<? echo $buttonbarhover; ?>)';
											show('accountMenu');
											document.getElementById('menuText').innerHTML = 'Request Changes to Your Sprint-Nextel Account.';
											show('menuHelp');"
										onMouseOut="this.style.backgroundImage='url(images/spacer.gif)';
											hide('accountMenu');
											hide('menuHelp');"
										style="cursor:pointer;"
										class="<? echo $menu_class; ?>">
										<div align="center">Account Management</a><br></div>
										<div id="accountMenu" style="position:absolute; top:<? echo iif(stristr($navigator_user_agent, "msie"),"105","105"); ?>; visibility:hidden; display:none; z-index:1;">
										<table width="179" border="0" cellspacing="3" cellpadding="0" bgcolor="#000000" class="menuWhite" style=" filter:alpha(opacity=80); -moz-opacity:.80; opacity:.80;">
<?
if ($change_plan == "T"){
?>
										<tr>
											<td>
												<a href="?sec=account&task=changeplan"
													onMouseMove="document.getElementById('menuText').innerHTML = 'Change Your Voice Plan, Data Plan, or Plan Features & Options.<br>Process Will Take 1-2 Business Days to Complete.';"
													class="menuGray">
													<span style="position:relative;"><li>Change Plan/Features</li></span>
												</a>
											</td>
										</tr>
<?
}
if ($change_num == "T"){
?>
										<tr>
											<td>
												<a href="?sec=account&task=changenumber"
													onMouseMove="document.getElementById('menuText').innerHTML = 'Change Your Wireless Number to a Number with a Different Area Code.<br>Process Will Take 1-2 Business Days to Complete.';"
													class="menuGray">
												<span style="position:relative;"><li>Change Phone Number</li></span></a>
											</td>
										</tr>
<?
}
if ($swap_device == "T"){
?>
										<tr>
											<td>
												<a href="?sec=account&task=swapdevice"
													onMouseMove="document.getElementById('menuText').innerHTML = 'Move Your Existing Phone Number to a New Device.';"
													class="menuGray">
													<span style="position:relative;"><li>Swap Device</li></span>
												</a>
											</td>
										</tr>
<?
}
if ($change_user == "T"){
?>
										<tr>
											<td>
												<a href="?sec=account&task=changeuser"
													onMouseMove="document.getElementById('menuText').innerHTML = 'Allocate an Existing Corporate Line of Service to a New Corporate User.';"
													class="menuGray">
													<span style="position:relative;"><li>Corporate User Change</li></span>
												</a>
											</td>
										</tr>
<?
}
if ($transfer == "T"){
?>
										<tr>
											<td>
												<a href="?sec=account&task=transfer"
													onMouseMove="document.getElementById('menuText').innerHTML = 'Transfer an Existing Sprint-Nextel Number Over to <? echo $label; ?> Corporate Responsibility.<br>Upon Completion the Number Will Belong to <? echo $label; ?>. Takes 2-3 Business Days to Complete.';"
													class="menuGray">
												<span style="position:relative;"><li>Transfer Liability</li></span></a>
											</td>
										</tr>
<?
}
if ($stop == "T"){
?>
										<tr>
											<td>
												<a href="?sec=account&task=stop"
													onMouseMove="document.getElementById('menuText').innerHTML = 'Cancel Your Wireless Number.<br>Takes 1-2 Business Days to Complete.';"
													class="menuGray">
												<span style="position:relative;"><li>Stop Service</li></span></a>
											</td>
										</tr>
<?
}
if ($rma == "T"){
?>
										<tr>
											<td>
												<a href="?sec=account&task=rma"
													onMouseMove="document.getElementById('menuText').innerHTML = 'Request a Return Merchandise Authorization to Return a Device.';"
													class="menuGray">
												<span style="position:relative;"><li>Request an RMA</li></span></a>
											</td>
										</tr>
<?
}
?>
										<tr>
											<td><img src="images/spacer.gif" width="1" height="1" border="0"></td>
										</tr>
										</table>
										</div>
									</td>
									<td valign="bottom"><img src="images/<? echo $menu_seperator; ?>" alt="" width="1" height="30" border="0"></td>
									<td width="180" align="center"
										onMouseOver="this.style.backgroundImage='url(images/<? echo $buttonbarhover; ?>)';
											document.getElementById('menuText').innerHTML = 'Answers to Frequently Asked Questions.';
											show('menuHelp');"
										onMouseOut="this.style.backgroundImage='url(images/spacer.gif)';
											hide('menuHelp');"
										style="cursor:pointer;"
										class="<? echo $menu_class; ?>"
										onClick="location.href='?sec=faq';">
										Common Questions
									</td>
									<td valign="bottom"><img src="images/<? echo $menu_seperator; ?>" alt="" width="1" height="30" border="0"></td>
									<td width="180" align="center"
										onMouseOver="this.style.backgroundImage='url(images/<? echo $buttonbarhover; ?>)';
											document.getElementById('menuText').innerHTML = 'Contact Vision Wireless and Sprint-Nextel.';
											show('menuHelp');"
										onMouseOut="this.style.backgroundImage='url(images/spacer.gif)';
											hide('menuHelp');"
										style="cursor:pointer;"
										class="<? echo $menu_class; ?>"
										onClick="location.href='?sec=contact';">
										Contact Us
									</td>
									<td valign="bottom"><img src="images/<? echo $menu_seperator; ?>" alt="" width="1" height="30" border="0"></td>
									<td><img src="images/spacer.gif" alt="" width="200" height="1" border="0"></td>
								</tr>
								<!-- Underlines -->
<!--								<tr>
									<td><img src="images/GrayDot.gif" alt="" width="20" height="1" border="0"></td>
									<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
									<td <? echo iif(!$sec || $sec=='activate', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
									<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
									<td <? echo iif($sec=='terms', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
									<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
									<td <? echo iif($sec=='faq', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
									<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
									<td <? echo iif($sec=='contact', 'bgcolor="#E6E6E6"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
									<td><img src="images/WhiteDot.gif" alt="" width="1" height="1" border="0"></td>
									<td><img src="images/GrayDot.gif" alt="" width="200" height="1" border="0"></td>
								</tr>-->
								</table>
							</td>
						</tr>
						<tr>
							<td style="background:url(images/<? echo $bodybg; ?>) top left repeat-x; background-color:<? echo $bodybg_color; ?>;"><img src="images/spacer.gif" alt="" width="0" height="450" border="0"></td>
							<td align="center" valign="top" style="background:url(images/<? echo $bodybg; ?>) top left repeat-x; background-color:<? echo $bodybg_color; ?>;">
								<!-- Warn that JavaScript is required if it's disabled-->
								<noscript class="bigBlack">
									<strong><br>
									This site requires that JavaScript support is enabled in your browser in order to function properly!<br>
									If you are reading this, JavaScript is NOT enabled.<br><br>
									<a href="http://www.mistered.us/tips/javascript/browsers.shtml" target="_blank" class="bigBlack" style="text-decoration:underline;">
									Click Here</a> if you need help enabling it.
									</strong>
								</noscript>
								<!-- Text help for menu items.  Pops on mouseover. -->
								<div align="right" id="menuHelp" style="position:absolute; top:<? echo iif(stristr($navigator_user_agent, "msie"),"111","111"); ?>; right:10; width: 550px; z-index:2; visibility:hidden;">
									<table width="550" border="0" cellspacing="0" cellpadding="0" align="right">
									<tr>
										<td align="right"><strong id="menuText" class="smallBlack"></strong></td>
									</tr>
									</table>
								</div>
								<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
								<?
								// Branch Content Based On Passed "SEC" Value
								switch($sec){
									case "": include("include/home.php");break;
									case "home": include("include/home.php");break;
case "home2": include("include/home2.php");break;
									case "account":
										switch($task){
											case "changeplan": include("include/changeplan.php");break;
											case "changenumber": include("include/changenumber.php");break;
											case "swapdevice": include("include/swapdevice.php");break;
											case "changeuser": include("include/changeuser.php");break;
											case "transfer": include("include/transfer.php");break;
											case "stop": include("include/stop.php");break;
											case "rma": include("include/rma.php");break;
											default: include("include/account.php");break;
										}
										break;
									case "thankyou": include("include/thankyou.php");break;
									case "faq": include("include/faq.php");break;
									case "contact": include("include/contact.php");break;
									case "privacy": include("include/privacy.php");break;
									default: include("include/home.php");break;
								} // End Switch
								?>
								<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
							</td>
						</tr>
						</table>
						</div>
					</td>
				</tr>
<!--				</table>
			</td>
		</tr>
		<!-- Footer --
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#343434">-->
				<tr>
<!--					<td width="110" style="background:url(images/BGFooterLeft.gif) top left no-repeat;"><img src="images/spacer.gif" alt="" width="110" height="80" border="0"></td>-->
					<td bgcolor="#FFFFFF">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(images/BGFooter.gif) top left no-repeat;">
						<tr>
							<!-- Spacer -->
							<td width="10" rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="85" border="0"></td>
							<!-- Help Bug -->
							<td width="150" rowspan="2">
								<!-- BEGIN ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
								<div id="ps_visionwireless_chat_button" style="width:140px;height:60px;display:inline;"></div><div id="ps_visionwireless_chat_invitation" style="z-index:100;position:absolute;left:0px;top:0px;"></div><script id="ps_visionwireless_scr" language="JavaScript"></script><script language="JavaScript">if(document.getElementById)document.getElementById("ps_visionwireless_scr").src="https://secure.providesupport.com/image/js/visionwireless/safe-standard.js?ps_t="+new Date().getTime()</script><noscript><a href="http://www.providesupport.com?messenger=visionwireless" target="_blank">Live Support Chat</a></noscript>
								<!-- END ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
							</td>
							<!-- Footer Text -->
							<td height="57" colspan="2" align="center" valign="top">
								<table width="95%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td valign="top" class="bodyBlack"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br><li>For help with Account Management call 877.650.3455 or email <a href="mailto:sprint.support@wiresupport.com" class="bodyBlack" style="text-decoration:underline;">sprint.support@wiresupport.com</a>.</li></td>
								</tr>
								</table>
							</td>
							<!-- Right Side -->
							<td width="85" rowspan="2">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<!-- Filler/Spacer -->
								<tr>
									<td height="65" valign="top" class="bodyBlack"></td>
								</tr>
								<tr>
									<td height="10" align="right" valign="bottom" class="smallGray">
										<a href="?sec=privacy"
											onMouseOver="document.getElementById('menuText').innerHTML = 'Web Site Privacy Policy.'; show('menuHelp');"
											onMouseOut="hide('menuHelp');"
										class="smallGray"><strong>Privacy Policy</strong></a>
										<img src="images/spacer.gif" alt="" width="5" height="1" border="0">
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<!-- Copyright -->
							<td width="630" height="10" align="center" valign="top">
								<strong class="smallGray">Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Vision Wireless" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong>
							</td>
							<!-- Filler/Spacer -->
							<td width="75">&nbsp;</td>
						</tr>
<!--						<tr>
							<td align="center" valign="bottom" class="bodyGray">
								<strong>
								<a href="?sec=account&task=changeplan"
									onMouseOver="document.getElementById('menuText').innerHTML = 'Change Your Voice Plan, Data Plan, or Plan Features & Options.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');"
									onMouseOut="hide('menuHelp');"
								class="smallGray">Change Plan</a> | 
								<a href="?sec=account&task=changenumber"
									onMouseOver="document.getElementById('menuText').innerHTML = 'Change Your Wireless Number to a Number with a Different Area Code.<br>Process Will Take 1-2 Business Days to Complete.'; show('menuHelp');"
									onMouseOut="hide('menuHelp');"
								class="smallGray">Change Number</a> | 
								<a href="?sec=account&task=transfer"
									onMouseOver="document.getElementById('menuText').innerHTML = 'Transfer an Existing Sprint-Nextel Number Over to XXXXX Corporate Responsibility.<br>Upon Completion the Number Will Belong to XXXXX. Takes 2-3 Business Days to Complete.'; show('menuHelp');"
									onMouseOut="hide('menuHelp');"
								class="smallGray">Transfer Liability</a> | 
								<a href="?sec=account&task=stop"
									onMouseOver="document.getElementById('menuText').innerHTML = 'Cancel Your Wireless Number.<br>Takes 1-2 Business Days to Complete.'; show('menuHelp');"
									onMouseOut="hide('menuHelp');"
								class="smallGray">Stop Service</a> | 
								<a href="?sec=account&task=rma"
									onMouseOver="document.getElementById('menuText').innerHTML = 'Request a Return Merchandise Authorization to Return a Device.'; show('menuHelp');"
									onMouseOut="hide('menuHelp');"
								class="smallGray">Request RMA</a>
								</strong><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
							</td>
							<td width="150" rowspan="2" valign="bottom"><img src="images/SprintPresidents.gif" alt="" width="150" height="55" border="0"></td>
						</tr>
						<tr>
							<td align="center" valign="top" class="bodyGray">
								<strong>
								<a href="?sec=home"
									onMouseOver="document.getElementById('menuText').innerHTML = 'Home Page Welcome Message.'; show('menuHelp');"
									onMouseOut="hide('menuHelp');"
								class="smallGray">Welcome</a> | 
								<a href="?sec=faq"
									onMouseOver="document.getElementById('menuText').innerHTML = 'Answers to Frequently Asked Questions.'; show('menuHelp');"
									onMouseOut="hide('menuHelp');"
								class="smallGray">FAQ</a> | 
								<a href="?sec=contact"
									onMouseOver="document.getElementById('menuText').innerHTML = 'Contact Vision Wireless.'; show('menuHelp');"
									onMouseOut="hide('menuHelp');"
								class="smallGray">Contact</a> | 
								<a href="?sec=privacy"
									onMouseOver="document.getElementById('menuText').innerHTML = 'Web Site Privacy Policy.'; show('menuHelp');"
									onMouseOut="hide('menuHelp');"
								class="smallGray">Privacy Policy</a>
								</strong><br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
							</td>
						</tr>-->
						</table>
					</td>
<!--					<td width="110" style="background:url(images/BGFooterRight.gif) top right no-repeat;"><img src="images/spacer.gif" alt="" width="110" height="80" border="0"></td>-->
				</tr>
				</table>
			</td>
		</tr>
		<!-- Bottom Center BG Shadow -->
		<tr>
			<td height="20" align="center" style="background: url(images/BGBottom.jpg) top left repeat-x; background-color: #E3E3E3;" class="smallBlack">&nbsp;</td>
		</tr>
		</table>
	</td>
	<!-- Right Top BG Shadow -->
	<td height="435" style="background:url(images/BGRightTop.jpg) top left no-repeat;"><img src="images/spacer.gif" alt="" width="1" height="435" border="0"></td>
</tr>
<!-- Middle BG Shadows -->
<tr id="middle">
	<td style="background:url(images/BGLeftMiddle.jpg) top right repeat-y;"><img id="middleSpacer" src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
	<td style="background:url(images/BGRightMiddle.jpg) top left repeat-y;">&nbsp;</td>

</tr>
<!-- Bottom BG Shadows -->
<tr>
	<td height="190" style="background:url(images/BGLeftBottom.jpg) bottom right no-repeat;"><img src="images/spacer.gif" alt="" width="1" height="190" border="0"></td>
	<td height="190" style="background:url(images/BGRightBottom.jpg) bottom left no-repeat;"><img src="images/spacer.gif" alt="" width="1" height="190" border="0"></td>
</tr>
</table>

<script>
	// Expand the middle row's height so the shadow background stretches to fit.
	// Needs to be done client-side, after page is fully rendered to obtain accurate seed (offsetHeight).
	document.getElementById('middleSpacer').height = (document.getElementById('mainBody').offsetHeight - 625);
</script>

</body>
</html>
