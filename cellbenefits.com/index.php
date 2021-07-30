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
//print_r($host);
//if (!$host[3] || strtolower($host[3]) == "www"){
if (strtolower($host[3]) == "www"){
//	$destination = "http://www.visioncell.com";
	$destination = "http://www.cellbenefits.com/admin/";
	header("Location: $destination");
	exit;
}elseif (strtolower($host[2]) == "secure"){
	if ($_REQUEST['site']){
		$_SESSION['site'] = $_REQUEST['site'];
	}

// Special for Palm - temp! Password is "PaLM RulEZ"
/*}elseif (strtolower($host[3]) == "palm"){
	if ($_SESSION['pass'] != true && $_REQUEST['pass'] != "T"){
		echo'
<script language="JavaScript">
	<!--hide
	var pass;
	var counter = 1;
	while (counter <= 3){
		pass = prompt("Please enter your password to view this site!"," ");
		if (pass == unescape("%50%61%4C%4D%20%52%75%6C%45%5A")) break
		if (counter == 3){
			window.location="http://www.palm.com";
		}
		counter++;
	}
	//-->
</script>
		';
		$_SESSION['pass'] = true;
	}
	$_SESSION['site'] = $host[3];
*/
}else{
	$_SESSION['site'] = $host[3];
}
// Set site name
$site = $_SESSION['site'];
// Grab URI & split it up.
$uri = explode("/",$_SERVER['REQUEST_URI']);
// Set domain name
if (strtolower($host[2]) == "secure"){
	$domain = strtolower($uri[1]).".com";
}else{
//	$domain = strtolower($host[1]).".".strtolower($host[0]);
	$domain = strtolower($host[2]).".com";
}
$domain_bits = explode(".",$domain);

/*
// Coming out of a checkout.
if ($_SERVER["HTTPS"] && $_REQUEST['sec'] != "checkout"){
	if (strtolower($uri[1]) == "cellbenefits"){
		$destination = "http://".$site.".cellbenefits.nr.net/".$_SERVER['REQUEST_URI'];
	}else if (strtolower($uri[1]) == "phonebenefits"){
		$destination = "http://".$site.".phonebenefits.nr.net/".$_SERVER['REQUEST_URI'];
	}else if (strtolower($uri[1]) == "voicebenefits"){
		$destination = "http://".$site.".voicebenefits.nr.net/".$_SERVER['REQUEST_URI'];
	}else if (strtolower($uri[1]) == "sprintemployeesite"){
		$destination = "http://".$site.".sprintemployeesite.nr.net/".$_SERVER['REQUEST_URI'];
	}else if (strtolower($uri[1]) == "attemployeesite"){
		$destination = "http://".$site.".attemployeesite.nr.net/".$_SERVER['REQUEST_URI'];
	}else if (strtolower($uri[1]) == "verizonemployeesite"){
		$destination = "http://".$site.".verizonemployeesite.nr.net/".$_SERVER['REQUEST_URI'];
	}else if (strtolower($uri[1]) == "sprintprogram"){
		$destination = "http://".$site.".sprintprogram.nr.net/".$_SERVER['REQUEST_URI'];
	}else if (strtolower($uri[1]) == "attprogram"){
		$destination = "http://".$site.".attprogram.com/".$_SERVER['REQUEST_URI'];
	}else if (strtolower($uri[1]) == "verizonprogram"){
		$destination = "http://".$site.".verizonprogram.com/".$_SERVER['REQUEST_URI'];
	}
	header("Location: $destination");
	exit;
}
*/
?>
<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$anchor = $_REQUEST['anchor'];
$message = $_REQUEST['message'];
$cargo = $_REQUEST['cargo'];
?>
<?
// Connect to the database
include "dbconnect.php";
?>
<?
// Grab site setup information
$result = mysql_query("SELECT * FROM sites WHERE site = '$site' AND domain = '$domain'", $linkID);
$config = mysql_fetch_assoc($result);
$label = $config['label'];
$title = $config['title'];
$branding = $config['branding'];
$featured_phones = $config['featured_phones'];
$logo = $config['logo'];
$header_logo = $config['header_logo'];
$header_logo_link = $config['header_logo_link'];
$header_promo = $config['header_promo'];
$header_promo_link = $config['header_promo_link'];
$discount_promo = $config['discount_promo'];
$pricing_level = $config['pricing_level'];
$gift_card = $config['gift_card'];
$discount_form = $config['discount_form'];
$vision_rebate = $config['vision_rebate'];
$rebate_label = $config['rebate_label'];
$alt_home = $config['alt_home'];
$ask_employer = $config['ask_employer'];
$sprint_site = $config['sprint'];
$sprint_discount = $config['sprint_discount'];
$sprint_activation = $config['sprint_activation'];
$nextel_site = $config['nextel'];
$nextel_discount = $config['nextel_discount'];
$nextel_activation = $config['nextel_activation'];
$cingular_site = $config['cingular'];
$cingular_discount = $config['cingular_discount'];
$cingular_activation = $config['cingular_activation'];
$verizon_site = $config['verizon'];
$verizon_discount = $config['verizon_discount'];
$verizon_activation = $config['verizon_activation'];
$support_number = $config['support_number'];
$support_email = $config['support_email'];
$support_bug = $config['support_bug'];
$copyright_notice = $config['copyright_notice'];
?>
<?
//echo $sec;
if ((!$sec) && $alt_home == "T"){
//	$_SESSION['first'] = "";
	header("Location: ?sec=promo");
	exit;
}
// determine if this is the first visit for showing one-time promos
$first = "yes";
if ($_SESSION['first'] == "set" || $_REQUEST['first'] == "no" || $sec == "promo"){
	$first = "no";
}
//echo $_SESSION['first'];
if ($sec != "promo"){
	$_SESSION['first'] = "set";
}
//echo $_SESSION['first'];
?>
<?
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
	// Grab existing cart carrier selected, if any exists.
	$carrier_selected = "";
	$query = "SELECT carrier FROM orders WHERE session_id='".$SID."'";
	$rs_carrier = mysql_query($query, $linkID);
	$row = mysql_fetch_assoc($rs_carrier);
	if (mysql_num_rows($rs_carrier) > 0) $carrier_selected = $row['carrier'];
	$activation_fee = $sprint_activation;
// Cingular/AT&T sites
}elseif ($cingular_site == "T" ){
	$carrier_selected = "AT&T";
	$activation_fee = $cingular_activation;
// Verizon sites
}elseif ($verizon_site == "T" ){
	$carrier_selected = "Verizon";
	$activation_fee = $verizon_activation;
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
if ($sprint_site == "T" || $nextel_site == "T" ){
	$carrier_label = "Sprint-Nextel";
	$tab = "SprintTab200BG.gif";
	$tab_class = "bigBlack";
	$bar_color = "#FFE100";
	$border_color = "#FFFFFF";
//	$popup_border = "#8D8D8D";
	$popup_border = "#58639B";
	$box_color = "#58639B";
	$box_bg = "#EFEFEF";
	$form_bg = "#FFE100";
	$AddToOrderButton = "AddToOrderButton.gif";
	$SubmitOrderButton = "SubmitOrderButton.gif";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title><? echo $title; ?></title>

	<!-- Meta Tags -->
	<meta name="description" content="Vision Wireless Wireless Discount Program - Low-cost or Free Sprint Phones including the Motorola RAZR, Motorola Q, and RIM BlackBerry. Sprint Wireless Offers and Cellular Plans">
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
//echo $carrier_selected."<br>";
	if ($domain == "cellbenefits.com" || strtolower($uri[1]) == "cellbenefits"){ //Sprint-Nextel
		if ($sec == "checkoutX"){
			echo'<base href="https://secure.nr.net/cellbenefits/">';
		}else{
			echo'<base href="http://'.$site.'.cellbenefits.nr.net/">';
		}
	}elseif ($domain == "sprintemployeesite.com" || strtolower($uri[1]) == "sprintemployeesite"){ // WBS Sprint-Nextel
		if ($sec == "checkoutX"){
			echo'<base href="https://secure.nr.net/sprintemployeesite/">';
		}else{
			echo'<base href="http://'.$site.'.sprintemployeesite.com/">';
		}
	}elseif ($domain == "sprintprogram.com" || strtolower($uri[1]) == "sprintprogram"){ // Axiom Sprint-Nextel
		if ($sec == "checkoutX"){
			echo'<base href="https://secure.nr.net/sprintprogram/">';
		}else{
			echo'<base href="http://'.$site.'.sprintprogram.com/">';
		}
//	}elseif ($domain == "voicebenefits.com" || strtolower($uri[1]) == "voicebenefits"){ // Verizon
//		if ($sec == "checkoutX"){
//			echo'<base href="https://secure.nr.net/voicebenefits/">';
//		}else{
//			echo'<base href="http://'.$site.'.voicebenefits.com/">';
//		}
	}
	?>

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	

</head>

<!--<body bgcolor="#FFFFFF" leftmargin="0" topmargin="10" marginwidth="0">-->
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="10" marginwidth="0" onLoad="<? if ($first == "yes" && $gift_card > 0) echo'popAd(\'GiftCardPromo\',60000);'; ?>">
<?// echo $SID; ?>
<table width="950" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#8D8D8D">
<tr>
	<td>
		<div id="container" style="position:relative; width:950; align:center; display:block;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<!-- Header -->
		<tr>
			<?
			if ($branding == "sprint-nextel"){
			?>
			<td bgcolor="#FFE100">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="200"><a href="javascript:SpawnChild('http://www.sprintstorelocator.com/sprintLocator/searchForm.jsp','child','800','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here to Find a Sprint Store!'; return true" onmouseout="window.status=''; return true"><img src="images/SprintHeaderLogo.jpg" alt="Click Here to Find a Sprint Store!" title="Click Here to Find a Sprint Store!" width="200" height="100" border="0"></a></td>
					<td align="center">
						<img src="images/<? echo $header_logo; ?>" alt="<? echo $label; ?> Logo" width="500" height="75" border="0"><br>
						<?// echo iif($header_promo != '', '<img src="images/'.$header_promo.'" alt="" width="500" height="25" border="0">', '&nbsp;'); ?>
						<? echo iif($header_promo_link != '', '<a href="'.$header_promo_link.'">', ''); ?>
						<? echo iif($header_promo != '', '<img src="images/'.$header_promo.'" alt="" width="500" height="25" border="0"></a>', '&nbsp;'); ?></td>
					<td width="200" align="center">
						<? if ($discount_form != ""){ ?>
						<a href="<? echo $discount_form; ?>" onmouseover=" window.status='Click Here For More Information'; return true" onmouseout="window.status=''; return true"><img src="images/<? echo $discount_promo; ?>" alt="Click Here For More Information" title="Click Here For More Information" height="100" border="0"></a>
<!--						<a href="javascript:SpawnChild('<? echo $discount_form; ?>','child','790','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/<? echo $discount_promo; ?>" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" height="100" border="0"></a>-->
						<? }else{ ?>
						<img src="images/<? echo $discount_promo; ?>" alt="" title="" height="100" border="0">
						<? } ?>
					</td>
				</tr>
				</table>
			</td>
			<?
			}elseif ($branding == "sprint"){
			?>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/<? echo iif($site == "convergence", "ConvergenceSprintHeader.jpg", "SprintHeaderBG.jpg"); ?>" bgcolor="#000000">
				<tr>
					<td width="200" align="center"><a href="javascript:SpawnChild('http://www.sprintstorelocator.com/sprintLocator/searchForm.jsp','child','800','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here to Find a Sprint Store!'; return true" onmouseout="window.status=''; return true" title="Click Here to Find a Sprint Store!"><img src="images/SprintHeaderWhite.gif"  alt="Click Here to Find a Sprint Store!" title="Click Here to Find a Sprint Store!" width="175" height="50" border="0"></a><br><img src="images/spacer.gif" alt="" width="1" height="15" border="0"></td>
					<td align="center">
						<? echo iif($header_logo_link != '', '<a href="'.$header_logo_link.'">', ''); ?>
						<img src="images/<? echo $header_logo; ?>" alt="<? echo iif($header_logo_link != '', 'Click for Discount Information', $label.' Logo'); ?>" width="500" height="75" border="0"></a>
						<?// echo iif($header_promo != '', '<img src="images/'.$header_promo.'" alt="" width="500" height="25" border="0">', '&nbsp;'); ?>
						<? echo iif($header_promo_link != '', '<a href="'.$header_promo_link.'">', ''); ?>
						<? echo iif($header_promo != '', '<br><img src="images/'.$header_promo.'" alt="" width="500" height="25" border="0"></a>', ''); ?></td>
					<td width="200" align="center">
						<? if ($discount_form != ""){ ?>
						<a href="<? echo $discount_form; ?>" onmouseover=" window.status='Click Here For More Information'; return true" onmouseout="window.status=''; return true"><img src="images/<? echo $discount_promo; ?>" alt="Click Here For More Information" title="Click Here For More Information" height="100" border="0"></a>
<!--						<a href="javascript:SpawnChild('<? echo $discount_form; ?>','child','790','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/<? echo $discount_promo; ?>" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" height="100" border="0"></a>-->
						<? }else{ ?>
						<img src="images/<? echo $discount_promo; ?>" alt="" title="" height="100" border="0">
						<? } ?>
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
			<td bgcolor="#EDEDED" background="images/SprintButtonBarBG.jpg">
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
//echo $site;
				if ($site == "palm"){
					if ($carrier_selected == ""){$carrier_selected = "Sprint";}
					if ((!$sec) || $sec == "home") include("include/palmhome.php");
					if ($sec == "phones") include("include/palmphones.php");
				}else{
					if ((!$sec) || $sec == "home") include("include/home.php");
					if ($sec == "phones") include("include/phones.php");
				}
				if ($sec == "plans") include("include/plans.php");
				if ($sec == "coverage") include("include/coverage.php");
				if ($sec == "rebates") include("include/rebates.php");
				if ($sec == "terms") include("include/terms.php");
				if ($sec == "faq") include("include/faq.php");
				if ($sec == "contact") include("include/contact.php");
				if ($sec == "cart") include("include/cart.php");
				if ($sec == "checkout") include("include/checkout-sprint.php");
				if ($sec == "thankyou") include("include/thankyou.php");
				if ($sec == "discount") include("include/discount.php");
				if ($sec == "privacy") include("include/privacy.php");
				if ($sec == "promo") include("include/promo.php");
				?>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

				<div align="right" id="cart" style="position:absolute; top:112; left:750; width: 200px; z-index:1; visibility:visible;">
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
				<table width="160" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
					<td><a href="?sec=cart"><img src="images/ShoppingCart.gif" alt="" width="19" height="16" border="0"></a></td>
<!--					<td class="smallBlack"><a href="?sec=cart" class="smallBlack" style="text-decoration:none;">&nbsp;View Cart </a>(<? echo iif($qty > 0, "<strong>", ""); echo $qty; ?></strong>) | <? echo iif($qty > 0, '<a href="https://secure.nr.net/'.strtolower($domain_bits[0]).'/?sec=checkout&sid='.$SID.'&site='.$_SESSION['site'].'&first=no" class="smallBlack" style=" text-decoration:none;">', ''); ?>Checkout</a>&nbsp;&nbsp;</td>-->
					<td class="smallBlack"><a href="?sec=cart" class="smallBlack" style="text-decoration:none;">&nbsp;View Cart </a>(<? echo iif($qty > 0, "<strong>", ""); echo $qty; ?></strong>) | <? echo iif($qty > 0, '<a href="/?sec=checkout&sid='.$SID.'&site='.$_SESSION['site'].'&first=no" class="smallBlack" style=" text-decoration:none;">', ''); ?>Checkout</a>&nbsp;&nbsp;</td>
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
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="80" border="0"></td>
			<td width="150" rowspan="2" valign="top">
				<? echo $support_bug; ?>
			</td>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td valign="top" class="smallWhite">
				<strong>
				<li>For help with existing Sprint or Nextel account, please call 888.211.4727 or dial *2 from your Sprint or Nextel phone.</li>
<!--				<li>To request a company sponsored discount be applied to your individual Sprint account, go to <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="smallWhite">www.sprint-discount.com</a>.</li>-->
				<?
				if($sprint_discount > 0){
				?>
				<li>To request a company sponsored discount be applied to your individual Sprint or Nextel account, please call 800.788.4727.</li>
				<?
				}
				?>
				<li>For help with online orders call <? echo $support_number; ?> or email <a href="mailto:<? echo $support_email; ?>" class="smallWhite"><? echo $support_email; ?></a>.
				<br><br>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tinyWhite">
				<tr>
					<td valign="top">*</td>
					<td>
				<?
				if ($site == apple){
				?>
						<strong>Phone price with new 1-year activation, after all available promotions, for activating a new non-substitute line of service with SPRINT-NEXTEL, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days.  Additional service fees may apply.</strong>
				<?
				}else{
				?>
					<?
					if ($pricing_level == 1){
					?>
						<strong>Phone price with new 2-year activation, after all available promotions & rebates, for activating a new non-substitute line of service with SPRINT-NEXTEL, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days.  Additional service fees may apply.</strong>
					<?
					}elseif ($pricing_level == 2){
					?>
						<strong>Additional service fees may apply.  Phone price with new 2-year activation, after all available promotions & rebates. Device pricing includes an Equipment Rebate of $50 that has been provided to you by Vision Wireless, an authorized agent, for activating a new non-substitute line of service with SPRINT-NEXTEL, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days. SPRINT-NEXTEL upgrades do not qualify for the $50.00 rebate.</strong>
					<?
					}elseif ($pricing_level == 3){
					?>
						<strong>Additional service fees may apply.  Phone price with new 2-year activation, after all available promotions & rebates. Device pricing includes an Equipment Rebate of $100 that has been provided to you by Vision Wireless, an authorized agent, for activating a new non-substitute line of service with SPRINT-NEXTEL, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days. SPRINT-NEXTEL upgrades do not qualify for the $100.00 rebate.</strong>
					<?
					}elseif ($pricing_level == 4){
					?>
						<strong>Additional service fees may apply.  Phone price with new 2-year activation, after all available promotions & rebates. Device pricing includes an Equipment Rebate of $60 that has been provided to you by Convergence, an authorized agent, for activating a new non-substitute line of service with SPRINT-NEXTEL, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days. SPRINT-NEXTEL upgrades do not qualify for the $60.00 rebate.</strong>
					<?
					}elseif ($pricing_level == 5){
					?>
						<strong>Phone price with new 2-year activation, after all available promotions, for activating a new non-substitute line of service with SPRINT-NEXTEL, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days.  Additional service fees may apply.</strong>
					<?
					}
					?>
				<?
				}
				?>


<?
if ($label == "Foster Farms"){ // SPECIAL
?>
<!--<br><br><em><strong>Sprint-Nextel will issue a $36 dollar credit within the first 3 months of service to cover the activation fee charged by Sprint.  Offer valid for June, July and August 2007 on orders for a new line of service placed through this website.</strong></em>-->
<?
}
?>


					</td>
				</tr>
				</table>
				</strong>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="200" valign="bottom" class="smallWhite"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><a href="?sec=privacy" class="smallWhite"><strong>Privacy Policy</strong></a><? echo iif($sprint_discount > 0, ' | <a href="?sec=discount" class="smallWhite"><strong>Discount</strong></a>',''); ?></td>
			<?
			if ($config['show_copyright'] == "T"){
				$year = date("Y");
			?>
			<td align="center" valign="bottom" class="smallGray"><? echo $copyright_notice; ?></td>
			<?
			}else{
			?>
			<td>&nbsp;</td>
			<?
			}
			?>
			<td width="200" align="right" valign="bottom" class="smallGray"><strong><? echo $label; ?></strong><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- Layers/Pop Up ads -->

<!-- BEGIN Gift Card Promo -->
<div align="center" id="GiftCardPromo" style="position:absolute; top:-1000; z-index:10; width:600; align:center; display:block;">
<table width="700" border="0" cellspacing="5" cellpadding="0" align="center" bgcolor="#FFFFFF" style="border:3px solid <? echo $popup_border; ?>;">
<tr>
	<td>
		<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="700" height="400" colspan="2" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="10" background="images/GiftCardPromoSprint100.jpg" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">
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
if (document.layers) document.layers.GiftCardPromo.left = ((window.innerWidth / 2) - (700 / 2));  //Mozilla
else if (document.all) document.all.GiftCardPromo.style.left = ((document.body.offsetWidth / 2) - (700 / 2));  //IE
else if (document.getElementById) document.getElementById("GiftCardPromo").style.left = ((window.innerWidth / 2) - (700 / 2));
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

<!-- Copyrights --
<div align="center" class="smallGray">
<strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Business Wireless Solutions" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong><br>
<strong>Developed, Maintained, &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallGray">Network Resources</a>, Las Vegas-Dallas-Milwaukee</strong>
</div>-->

</body>
</html>

<?
///////////////////////////////////////////////////////////////
// Cingular/AT&T sites
}elseif ($cingular_site == "T" ){
	$carrier_label = "AT&T";
	$tab = "AT&TTab200BG.gif";
	$tab_class = "bigWhite";
	$bar_color = "#0780C0";
	$border_color = "#0780C0";
	$popup_border = "#F37D00";
	$box_color = "#0780C0";
	$box_bg = "#EBEFFA";
//	$form_bg = "#5DA625"; //Blue
//	$form_bg = "#EBEFFA"; //Light Blue
	$form_bg = "#F37D00"; //Orange
	$AddToOrderButton = "AddToOrderButtonAT&T.gif";
	$SubmitOrderButton = "SubmitOrderButtonAT&T.gif";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title><? echo $title; ?></title>

	<!-- Meta Tags -->
	<meta name="description" content="Vision Wireless Wireless Discount Program - Low-cost or Free AT&T (Cingular) Phones including the Motorola RAZR, Samsung Blackjack, and Apple iPhone. AT&T Wireless Offers and Cellular Plans">
	<meta name="keywords" content="AT&T Free Phones,Cingular Free Phones,Free,Motorola RAZR,AT&T Wireless Offer,Cingular Cellular Plans,RIM BlackBerry,Apple iPhone,cell phone,Cell Phones,Cellular Phones,Cellphone,cellphones,free cell phones,free cellular phones,free phones,cell phone plans,cell phone specials,mobile phone,wireless phone,cellular phone service,service plan,cellular phone plans,wireless phone service,cell phone accessories, purchase cell phone,buy cell phone,research cell phones">
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
	<meta name="VW96.objecttype" content="AT&T Mobile Wireless Cell Phones &amp; Cellular Phone Equipment.">
	<meta name="DC.title" content="Vision Wireless - Wireless Discount Program | Free Cell Phones | Motorola RAZR | Blackberry | Apple iPhone">
	<meta name="DC.subject" content="Cellular Wireless Phones &amp; Accessories">
	<meta name="DC.description" content="Vision Wireless - Wireless Discount Program | Free Cell Phones | Motorola RAZR | Blackberry | Apple iPhone">
	<meta name="DC.Coverage.PlaceName" content="United States, USA, United States of America">

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Define Home Base -->
	<?
	if ($domain == "phonebenefits.com" || strtolower($uri[1]) == "phonebenefits"){ //AT&T
		if ($sec == "checkoutX"){
			echo'<base href="https://secure.nr.net/phonebenefits/">';
		}else{
			echo'<base href="http://'.$site.'.phonebenefits.nr.net/">';
		}
	}elseif ($domain == "attemployeesite.com" || strtolower($uri[1]) == "attemployeesite"){ // WBS AT&T
		if ($sec == "checkoutX"){
			echo'<base href="https://secure.nr.net/attemployeesite/">';
		}else{
			echo'<base href="http://'.$site.'.attemployeesite.com/">';
		}
	}elseif ($domain == "attprogram.com" || strtolower($uri[1]) == "attprogram"){
		if ($sec == "checkoutX"){
			echo'<base href="https://secure.nr.net/attprogram/">';
		}else{
			echo'<base href="http://'.$site.'.attprogram.com/">';
		}
//	}elseif ($domain == "voicebenefits.com" || strtolower($uri[1]) == "voicebenefits"){
//		if ($sec == "checkoutX"){
//			echo'<base href="https://secure.nr.net/voicebenefits/">';
//		}else{
//			echo'<base href="http://'.$site.'.voicebenefits.com/">';
//		}
	}
	?>

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	

</head>

<!--<body bgcolor="#EDEDED" leftmargin="0" topmargin="10" marginwidth="0" onLoad="<? if ($first == "yes" && $site == "yahoo") echo'popAd(\'GiftCardPromo\',60000);'; ?>">-->
<body bgcolor="#EDEDED" leftmargin="0" topmargin="10" marginwidth="0" onLoad="<? if ($first == "yes" && $gift_card > 0) echo'popAd(\'GiftCardPromo\',60000);'; ?>">

<table width="950" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#9D9D9D">
<tr>
	<td>
		<div id="container" style="position:relative; width:950; align:center; display:block;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<!-- Header -->
		<tr>
			<td bgcolor="#FFFFFF">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="200"><a href="javascript:SpawnChild('http://www.wireless.att.com/find-a-store','child','800','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here to Find an AT&T Store!'; return true" onmouseout="window.status=''; return true"><img src="images/AT&THeaderLogo.jpg" alt="" width="200" height="100" border="0"></a></td>
					<td align="center">
						<? echo iif($header_logo_link != '', '<a href="'.$header_logo_link.'">', ''); ?>
						<img src="images/<? echo $header_logo; ?>" alt="<? echo iif($header_logo_link != '', 'Click for Discount Information', $label.' Logo'); ?>" width="500" height="75" border="0"></a>
						<? if ($cingular_discount > 0){ ?>
						<br><a href="javascript:SpawnChild('https://www.wireless.att.com/business/enrollment','child','1000','625','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/GetATTDiscountStaticNew.gif" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" width="500" height="25" border="0"></a></td>
						<? }else{ ?>
						<img src="images/spacer.gif" alt="" title="" height="25" border="0"></td>
						<? } ?>
					<td width="200" align="center">
						<? echo iif($header_promo_link != '', '<a href="'.$header_promo_link.'">', ''); ?>
						<? echo iif($header_promo != '', '<img src="images/'.$header_promo.'" alt="" width="200" height="100" border="0"></a>', '&nbsp;'); ?></td>
				</tr>
				</table>
<!--
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="200"><a href="javascript:SpawnChild('http://www.wireless.att.com/find-a-store','child','800','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here to Find an AT&T Store!'; return true" onmouseout="window.status=''; return true"><img src="images/AT&THeaderLogo.jpg" alt="" width="200" height="100" border="0"></a></td>
					<td align="center">
						<img src="images/<? echo $header_logo; ?>" alt="<? echo $label; ?> Logo" width="500" height="75" border="0"><br>
						<? echo iif($header_promo != '', '<img src="images/'.$header_promo.'" alt="" width="500" height="25" border="0">', '&nbsp;'); ?></td>
					<td width="200" align="center"><!--<a href="javascript:SpawnChild('<? echo $discount_form; ?>','child','790','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/<? echo $discount_promo; ?>" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" height="100" border="0"></a>--></td>
<!--				</tr>
				</table>-->


			</td>
		</tr>
<!--		<tr>
			<td bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="940" height="1" border="0"></td>
		</tr>-->
		<!-- Button Bar -->
		<tr>
			<td bgcolor="#EDEDED" background="images/AT&TButtonBarBG.jpg">
				<table border="0" cellspacing="0" cellpadding="0">
				<!-- Buttons -->
				<tr>
					<td><img src="images/spacer.gif" alt="" width="20" height="30" border="0"></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif(!$sec || $sec=='home', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif(!$sec || $sec=='home', 'background="images/AT&TButtonBarOnBG.jpg" class="menuOrange">', 'class="menuWhite"><a href="?sec=home" class="menuWhite">'); ?><strong>Home</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif(!$sec || $sec=='home' || $sec=='phones', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='phones', 'background="images/AT&TButtonBarOnBG.jpg" class="menuOrange">', 'class="menuWhite"><a href="?sec=phones" class="menuWhite">'); ?><strong>Phones</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='phones' || $sec=='plans', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='plans', 'background="images/AT&TButtonBarOnBG.jpg" class="menuOrange">', 'class="menuWhite"><a href="?sec=plans" class="menuWhite">'); ?><strong>Plans</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='plans' || $sec=='coverage', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='coverage', 'background="images/AT&TButtonBarOnBG.jpg" class="menuOrange">', 'class="menuWhite"><a href="?sec=coverage" class="menuWhite">'); ?><strong>Coverage</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='coverage' || $sec=='rebates', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='rebates', 'background="images/AT&TButtonBarOnBG.jpg" class="menuOrange">', 'class="menuWhite"><a href="?sec=rebates" class="menuWhite">'); ?><strong>Rebates</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='rebates' || $sec=='terms', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='terms', 'background="images/AT&TButtonBarOnBG.jpg" class="menuOrange">', 'class="menuWhite"><a href="?sec=terms" class="menuWhite">'); ?><strong>Terms</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='terms' || $sec=='faq', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='faq', 'background="images/AT&TButtonBarOnBG.jpg" class="menuOrange">', 'class="menuWhite"><a href="?sec=faq" class="menuWhite">'); ?><strong>Questions</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='faq' || $sec=='contact', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='contact', 'background="images/AT&TButtonBarOnBG.jpg" class="menuOrange">', 'class="menuWhite"><a href="?sec=contact" class="menuWhite">'); ?><strong>Contact Us</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='contact', 'height="30"', 'height="22"'); ?> border="0"></td>
				</tr>
				<!-- Underlines -->
				<tr>
					<td><img src="images/GrayDot.gif" alt="" width="20" height="1" border="0"></td>
					<td <? echo iif(!$sec || $sec=='home', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif(!$sec || $sec=='home', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif(!$sec || $sec=='home' || $sec=='phones', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='phones', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='phones' || $sec=='plans', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='plans', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='plans' || $sec=='coverage', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='coverage', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='coverage' || $sec=='rebates', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='rebates', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='rebates' || $sec=='terms', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='terms', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='terms' || $sec=='faq', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='faq', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='faq' || $sec=='contact', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='contact', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='contact', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="201" height="1" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
<!--			<td align="center" bgcolor="#EFEFEF" background="images/GrayGradientBG.jpg" style="background-position: top left; background-repeat: no-repeat; background-attachment: scroll;">-->
			<td align="center" bgcolor="#FFFFFF">
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
				if ($site == "palm"){
					if ((!$sec) || $sec == "home") include("include/palmhome.php");
					if ($sec == "phones") include("include/palmphones.php");
				}else{
					if ((!$sec) || $sec == "home") include("include/home.php");
					if ($sec == "phones") include("include/phones.php");
				}
				if ($sec == "plans") include("include/plans.php");
				if ($sec == "coverage") include("include/coverage.php");
				if ($sec == "rebates") include("include/rebates.php");
				if ($sec == "terms") include("include/terms.php");
				if ($sec == "faq") include("include/faq.php");
				if ($sec == "contact") include("include/contact.php");
				if ($sec == "cart") include("include/cart.php");
				if ($sec == "checkout") include("include/checkout-at&t.php");
				if ($sec == "thankyou") include("include/thankyou.php");
				if ($sec == "discount") include("include/discount.php");
				if ($sec == "privacy") include("include/privacy.php");
				?>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

				<div align="right" id="cart" style="position:absolute; top:108; left:750; width: 200px; z-index:1; visibility:visible;">
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
				<table width="160" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
					<td><a href="?sec=cart"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></a></td>
<!--					<td class="smallWhite"><a href="?sec=cart" class="smallWhite" style="text-decoration:none;">&nbsp;View Cart </a>(<? echo iif($qty > 0, "<strong>", ""); echo $qty; ?></strong>) | <? echo iif($qty > 0, '<a href="https://secure.nr.net/'.strtolower($domain_bits[0]).'/?sec=checkout&sid='.$SID.'&site='.$_SESSION['site'].'&first=no" class="smallWhite" style=" text-decoration:none;">', ''); ?>Checkout</a>&nbsp;&nbsp;</td>-->
					<td class="smallWhite"><a href="?sec=cart" class="smallWhite" style="text-decoration:none;">&nbsp;View Cart </a>(<? echo iif($qty > 0, "<strong>", ""); echo $qty; ?></strong>) | <? echo iif($qty > 0, '<a href="/?sec=checkout&sid='.$SID.'&site='.$_SESSION['site'].'&first=no" class="smallWhite" style=" text-decoration:none;">', ''); ?>Checkout</a>&nbsp;&nbsp;</td>
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
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="60" border="0"></td>
			<td width="150" rowspan="2" valign="top">
				<!-- BEGIN ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
				<div id="ps_visionwireless_chat_button" style="width:140px;height:60px;display:inline"><spacer type="block" width="140" height="60"></spacer></div><div id="ps_visionwireless_chat_invitation" style="z-index:100;position:absolute;left:0px;top:0px;"></div><script id="ps_visionwireless_scr" language="JavaScript"></script><script language="JavaScript">if(document.getElementById)document.getElementById("ps_visionwireless_scr").src="https://secure.providesupport.com/image/js/visionwireless/safe-standard.js?ps_t="+new Date().getTime()</script><noscript><a href="http://www.providesupport.com?messenger=visionwireless" target="_blank">Live Support Chat</a></noscript>
				<!-- END ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
			</td>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td valign="top" class="smallWhite">
				<strong>
<!--				<li>For help with existing Sprint accounts, please call 888.211.4727.</li>
				<li>To request a company sponsored discount be applied to your individual Sprint account, go to <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="smallWhite">www.sprint-discount.com</a>.</li>-->
				<li>For help with online orders call <? echo $support_number; ?> or email <a href="mailto:<? echo $support_email; ?>" class="smallWhite"><? echo $support_email; ?></a>.
				<br><br>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tinyWhite">
				<tr>
					<td valign="top">*</td>
					<td>
				<?
				if ($pricing_level == 1 || $pricing_level == 3){
				?>
						<strong>Phone price with new 2-year activation, after all available promotions & rebates, for activating a new non-substitute line of service with AT&amp;T, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days.  Additional service fees may apply.</strong>
				<?
				}elseif ($pricing_level == 2){
				?>
						<strong>Additional service fees may apply.  Phone price with new 2-year activation, after all available promotions & rebates. Device pricing includes an Equipment Rebate of $50 that has been provided to you by Vision Wireless, an authorized agent, for activating a new non-substitute line of service with AT&amp;T, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days. AT&amp;T upgrades do not qualify for the $50.00 rebate.</strong>
				<?
				}
				?>
					</td>
				</tr>
<!--				<tr>
					<td><br></td>
				</tr>
				<tr>
					<td valign="top">&dagger;</td>
					<td>
						<em><strong>AT&T mail-in rebate requires activation on a $39.99 or higher unlimited data rate plan or a $19.99 or higher messaging plan plus an AT&T Voice Plan of $39.99 or higher.
</strong></em>
					</td>
				</tr>-->
				</table>
				</strong>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="150" valign="bottom" class="smallWhite"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><a href="?sec=privacy" class="smallWhite"><strong>Privacy Policy</strong></a><? echo iif($cingular_discount > 0, ' | <a href="?sec=discount" class="smallWhite"><strong>Discount</strong></a>',''); ?></td>
			<?
			if ($config['show_copyright'] == "T"){
			?>
			<td align="center" valign="bottom" class="smallGray"><strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Vision Wireless" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong></td>
			<?
			}else{
			?>
			<td>&nbsp;</td>
			<?
			}
			?>
			<td width="150" align="right" valign="bottom" class="smallGray"><strong><? echo $label; ?></strong><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- Layers/Pop Up ads -->

<!-- BEGIN Gift Card Promo -->
<div align="center" id="GiftCardPromo" style="position:absolute; top:-1000; z-index:10; width:600; align:center; display:block;">
<table width="700" border="0" cellspacing="5" cellpadding="0" align="center" bgcolor="#FFFFFF" style="border:3px solid <? echo $popup_border; ?>;">
<tr>
	<td>
		<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="700" height="400" colspan="2" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="10" background="images/GiftCardPromoATT50.jpg" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">
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
					<td valign="top" class="tinyGray">
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
if (document.layers) document.layers.GiftCardPromo.left = ((window.innerWidth / 2) - (700 / 2));  //Mozilla
else if (document.all) document.all.GiftCardPromo.style.left = ((document.body.offsetWidth / 2) - (700 / 2));  //IE
else if (document.getElementById) document.getElementById("GiftCardPromo").style.left = ((window.innerWidth / 2) - (700 / 2));
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


<!-- Copyrights --
<div align="center" class="smallGray">
<strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Business Wireless Solutions" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong><br>
<strong>Developed, Maintained, &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallGray">Network Resources</a>, Las Vegas-Dallas-Milwaukee</strong>
</div>-->

</body>
</html>

<?
///////////////////////////////////////////////////////////////
// Verizon sites
}elseif ($verizon_site == "T" ){
	$carrier_label = "Verizon";
	$tab = "VerizonTab200BG.gif";
	$tab_class = "bigWhite";
	$bar_color = "#000000";
	$border_color = "#000000";
	$box_color = "#000000";
	$box_bg = "#EFEFEF";
	$form_bg = "#B90000";
	$AddToOrderButton = "AddToOrderButtonVerizon.gif";
	$SubmitOrderButton = "SubmitOrderButtonVerizon.gif";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title><? echo $title; ?></title>

	<!-- Meta Tags -->
	<meta name="description" content="Vision Wireless Wireless Discount Program - Low-cost or Free Verizon Phones including the Motorola RAZR, LG Chocolate, and Motorola Q. Verizon Wireless Offers and Cellular Plans">
	<meta name="keywords" content="Verizon Free Phones,Free,Motorola RAZR,Verizon Wireless Offer,Verizon Cellular Plans,RIM BlackBerry,VCcast,Palm Treo,cell phone,Cell Phones,Cellular Phones,Cellphone,cellphones,free cell phones,free cellular phones,free phones,cell phone plans,cell phone specials,mobile phone,wireless phone,cellular phone service,service plan,cellular phone plans,wireless phone service,cell phone accessories, purchase cell phone,buy cell phone,research cell phones">
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
	<meta name="VW96.objecttype" content="Verizon Wireless Cell Phones &amp; Cellular Phone Equipment.">
	<meta name="DC.title" content="Vision Wireless - Wireless Discount Program | Free Cell Phones | Motorola RAZR | Blackberry | Apple iPhone">
	<meta name="DC.subject" content="Cellular Wireless Phones &amp; Accessories">
	<meta name="DC.description" content="Vision Wireless - Wireless Discount Program | Free Cell Phones | Motorola RAZR | Blackberry | Apple iPhone">
	<meta name="DC.Coverage.PlaceName" content="United States, USA, United States of America">

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Define Home Base -->
	<?
	if ($domain == "voicebenefits.com" || strtolower($uri[1]) == "voicebenefits"){ // Verizon
		if ($sec == "checkoutX"){
			echo'<base href="https://secure.nr.net/voicebenefits/">';
		}else{
			echo'<base href="http://'.$site.'.voicebenefits.nr.net/">';
		}
	}elseif ($domain == "verizonemployeesite.com" || strtolower($uri[1]) == "verizonemployeesite"){ // WBS Verizon
		if ($sec == "checkoutX"){
			echo'<base href="https://secure.nr.net/verizonemployeesite/">';
		}else{
			echo'<base href="http://'.$site.'.verizonemployeesite.com/">';
		}
	}elseif ($domain == "verizonprogram.com" || strtolower($uri[1]) == "verizonprogram"){ // Axiom Verizon
		if ($sec == "checkoutX"){
			echo'<base href="https://secure.nr.net/verizonprogram/">';
		}else{
			echo'<base href="http://'.$site.'.verizonprogram.com/">';
		}
//	}elseif ($domain == "voicebenefits.com" || strtolower($uri[1]) == "voicebenefits"){
//		if ($sec == "checkoutX"){
//			echo'<base href="https://secure.nr.net/voicebenefits/">';
//		}else{
//			echo'<base href="http://'.$site.'.voicebenefits.com/">';
//		}
	}
	?>

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	

</head>

<body bgcolor="#EDEDED" leftmargin="0" topmargin="10" marginwidth="0">

<table width="950" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#9D9D9D">
<tr>
	<td>
		<div id="container" style="position:relative; width:950; align:center; display:block;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<!-- Header -->
		<tr>
			<td bgcolor="#FFFFFF">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="200"><a href="javascript:SpawnChild('http://www.verizonwireless.com/b2c/storelocator','child','800','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here to Find a Verizon Wireless Store!'; return true" onmouseout="window.status=''; return true"><img src="images/VerizonHeaderLogo.jpg" alt="" width="200" height="100" border="0"></a></td>
					<td align="center"><img src="images/<? echo $header_logo; ?>" alt="<? echo $label; ?> Logo" width="500" height="75" border="0"></td>
					<td width="200" align="center"><? echo iif($header_promo != '', '<img src="images/'.$header_promo.'" alt="" width="200" height="100" border="0">', '&nbsp;'); ?></td>
				</tr>
				</table>

<!--
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="200"><a href="javascript:SpawnChild('http://www.wireless.att.com/find-a-store','child','800','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here to Find an AT&T Store!'; return true" onmouseout="window.status=''; return true"><img src="images/AT&THeaderLogo.jpg" alt="" width="200" height="100" border="0"></a></td>
					<td align="center">
						<img src="images/<? echo $header_logo; ?>" alt="<? echo $label; ?> Logo" width="500" height="75" border="0"><br>
						<? echo iif($header_promo != '', '<img src="images/'.$header_promo.'" alt="" width="500" height="25" border="0">', '&nbsp;'); ?></td>
					<td width="200" align="center"><!--<a href="javascript:SpawnChild('<? echo $discount_form; ?>','child','790','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/<? echo $discount_promo; ?>" alt="Click Here For Your Discount!" title="Click Here For Your Discount!" height="100" border="0"></a>--></td>
<!--				</tr>
				</table>-->


			</td>
		</tr>
<!--		<tr>
			<td bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="940" height="1" border="0"></td>
		</tr>-->
		<!-- Button Bar -->
		<tr>
			<td bgcolor="#EDEDED" background="images/VerizonButtonBarBG.jpg">
				<table border="0" cellspacing="0" cellpadding="0">
				<!-- Buttons -->
				<tr>
					<td><img src="images/spacer.gif" alt="" width="20" height="30" border="0"></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif(!$sec || $sec=='home', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif(!$sec || $sec=='home', 'background="images/VerizonButtonBarOnBG.jpg" class="menuWhite">', 'class="menuWhite"><a href="?sec=home" class="menuWhite">'); ?><strong>Home</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif(!$sec || $sec=='home' || $sec=='phones', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='phones', 'background="images/VerizonButtonBarOnBG.jpg" class="menuWhite">', 'class="menuWhite"><a href="?sec=phones" class="menuWhite">'); ?><strong>Phones</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='phones' || $sec=='plans', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='plans', 'background="images/VerizonButtonBarOnBG.jpg" class="menuWhite">', 'class="menuWhite"><a href="?sec=plans" class="menuWhite">'); ?><strong>Plans</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='plans' || $sec=='coverage', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='coverage', 'background="images/VerizonButtonBarOnBG.jpg" class="menuWhite">', 'class="menuWhite"><a href="?sec=coverage" class="menuWhite">'); ?><strong>Coverage</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='coverage' || $sec=='rebates', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='rebates', 'background="images/VerizonButtonBarOnBG.jpg" class="menuWhite">', 'class="menuWhite"><a href="?sec=rebates" class="menuWhite">'); ?><strong>Rebates</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='rebates' || $sec=='terms', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='terms', 'background="images/VerizonButtonBarOnBG.jpg" class="menuWhite">', 'class="menuWhite"><a href="?sec=terms" class="menuWhite">'); ?><strong>Terms</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='terms' || $sec=='faq', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='faq', 'background="images/VerizonButtonBarOnBG.jpg" class="menuWhite">', 'class="menuWhite"><a href="?sec=faq" class="menuWhite">'); ?><strong>Questions</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='faq' || $sec=='contact', 'height="30"', 'height="22"'); ?> border="0"></td>
					<td width="90" align="center" <? echo iif($sec=='contact', 'background="images/VerizonButtonBarOnBG.jpg" class="menuWhite">', 'class="menuWhite"><a href="?sec=contact" class="menuWhite">'); ?><strong>Contact Us</strong></a></td>
					<td valign="bottom"><img src="images/WhiteDot.gif" alt="" width="1" <? echo iif($sec=='contact', 'height="30"', 'height="22"'); ?> border="0"></td>
				</tr>
				<!-- Underlines -->
				<tr>
					<td><img src="images/GrayDot.gif" alt="" width="20" height="1" border="0"></td>
					<td <? echo iif(!$sec || $sec=='home', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif(!$sec || $sec=='home', 'bgcolor="#BEBEBE"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif(!$sec || $sec=='home' || $sec=='phones', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='phones', 'bgcolor="#BEBEBE"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='phones' || $sec=='plans', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='plans', 'bgcolor="#BEBEBE"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='plans' || $sec=='coverage', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='coverage', 'bgcolor="#BEBEBE"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='coverage' || $sec=='rebates', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='rebates', 'bgcolor="#BEBEBE"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='rebates' || $sec=='terms', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='terms', 'bgcolor="#BEBEBE"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='terms' || $sec=='faq', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='faq', 'bgcolor="#BEBEBE"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='faq' || $sec=='contact', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td <? echo iif($sec=='contact', 'bgcolor="#BEBEBE"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="90" height="1" border="0"></td>
					<td <? echo iif($sec=='contact', 'bgcolor="#FFFFFF"', 'bgcolor="#BEBEBE"'); ?>><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
					<td><img src="images/GrayDot.gif" alt="" width="201" height="1" border="0"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
<!--			<td align="center" bgcolor="#EFEFEF" background="images/GrayGradientBG.jpg" style="background-position: top left; background-repeat: no-repeat; background-attachment: scroll;">-->
			<td align="center" bgcolor="#FFFFFF">
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
				if ($site == "palm"){
					if ((!$sec) || $sec == "home") include("include/palmhome.php");
					if ($sec == "phones") include("include/palmphones.php");
				}else{
					if ((!$sec) || $sec == "home") include("include/home.php");
					if ($sec == "phones") include("include/phones.php");
				}
				if ($sec == "plans") include("include/plans.php");
				if ($sec == "coverage") include("include/coverage.php");
				if ($sec == "rebates") include("include/rebates.php");
				if ($sec == "terms") include("include/terms.php");
				if ($sec == "faq") include("include/faq.php");
				if ($sec == "contact") include("include/contact.php");
				if ($sec == "cart") include("include/cart.php");
				if ($sec == "checkout") include("include/checkout-verizon.php");
				if ($sec == "thankyou") include("include/thankyou.php");
				if ($sec == "discount") include("include/discount.php");
				if ($sec == "privacy") include("include/privacy.php");
				?>
				<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

				<div align="right" id="cart" style="position:absolute; top:108; left:750; width: 200px; z-index:1; visibility:visible;">
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
				<table width="160" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
					<td><a href="?sec=cart"><img src="images/ShoppingCartWhite.gif" alt="" width="19" height="16" border="0"></a></td>
<!--					<td class="smallWhite"><a href="?sec=cart" class="smallWhite" style="text-decoration:none;">&nbsp;View Cart </a>(<? echo iif($qty > 0, "<strong>", ""); echo $qty; ?></strong>) | <? echo iif($qty > 0, '<a href="https://secure.nr.net/'.strtolower($domain_bits[0]).'/?sec=checkout&sid='.$SID.'&site='.$_SESSION['site'].'" class="smallWhite" style=" text-decoration:none;">', ''); ?>Checkout</a>&nbsp;&nbsp;</td>-->
					<td class="smallWhite"><a href="?sec=cart" class="smallWhite" style="text-decoration:none;">&nbsp;View Cart </a>(<? echo iif($qty > 0, "<strong>", ""); echo $qty; ?></strong>) | <? echo iif($qty > 0, '<a href="/?sec=checkout&sid='.$SID.'&site='.$_SESSION['site'].'" class="smallWhite" style=" text-decoration:none;">', ''); ?>Checkout</a>&nbsp;&nbsp;</td>
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
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="80" border="0"></td>
			<td width="150" rowspan="2" valign="top">
				<!-- BEGIN ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
				<div id="ps_visionwireless_chat_button" style="width:140px;height:60px;display:inline"><spacer type="block" width="140" height="60"></spacer></div><div id="ps_visionwireless_chat_invitation" style="z-index:100;position:absolute;left:0px;top:0px;"></div><script id="ps_visionwireless_scr" language="JavaScript"></script><script language="JavaScript">if(document.getElementById)document.getElementById("ps_visionwireless_scr").src="https://secure.providesupport.com/image/js/visionwireless/safe-standard.js?ps_t="+new Date().getTime()</script><noscript><a href="http://www.providesupport.com?messenger=visionwireless" target="_blank">Live Support Chat</a></noscript>
				<!-- END ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
			</td>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td valign="top" class="smallWhite">
				<strong>
<!--				<li>For help with existing Sprint accounts, please call 888.211.4727.</li>
				<li>To request a company sponsored discount be applied to your individual Sprint account, go to <a href="javascript:SpawnChild('http://www.sprint-discount.com','child','790','600','yes','','','','','1','1','1','1','1');" child.focus();" onmouseover=" window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true" class="smallWhite">www.sprint-discount.com</a>.</li>-->
				<li>For help with online orders call <? echo $support_number; ?> or email <a href="mailto:<? echo $support_email; ?>" class="smallWhite"><? echo $support_email; ?></a>.
				<br><br>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tinyWhite">
				<tr>
					<td valign="top">*</td>
					<td>
				<?
				if ($pricing_level == 1){
				?>
						<strong>Phone price with new 2-year activation, after all available promotions & rebates, for activating a new non-substitute line of service with Verizon Wireless, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days.  Additional service fees may apply.</strong>
				<?
				}elseif ($pricing_level == 2){
				?>
						<strong>Additional service fees may apply.  Phone price with new 2-year activation, after all available promotions & rebates. Device pricing includes an Equipment Rebate of $50 that has been provided to you by Vision Wireless, an authorized agent, for activating a new non-substitute line of service with Verizon Wireless, and maintaining this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days. Verizon Wireless upgrades do not qualify for the $50.00 rebate.</strong>
				<?
				}
				?>
					</td>
				</tr>
				</table>
				</strong>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="150" valign="bottom"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><a href="?sec=privacy" class="smallWhite"><strong>Privacy Policy</strong></a></td>
			<?
			if ($config['show_copyright'] == "T"){
			?>
			<td align="center" valign="bottom" class="smallGray"><strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Vision Wireless" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong></td>
			<?
			}else{
			?>
			<td>&nbsp;</td>
			<?
			}
			?>
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
}
?>
