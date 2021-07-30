<?
session_start(); 
header("Cache-control: private");  // IE 6 Fix.
//echo $_SESSION['user_level'];
//$first = false;
//if ($_POST['auth']){
//	$_SESSION['auth'] = $_POST['auth'];
//	$first = true;
//}
//if (!$_SESSION['auth']){
//	$host = $_SERVER['HTTP_HOST'];
//	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
//	header("Location: http://$host$uri/?sec=login");
//	exit;
//}
?>
<?
/*
session_start();
if ($_REQUEST['sid']){
	$_SESSION['SID'] = $_REQUEST['sid'];
	$SID = $_SESSION['SID'];
}else{
	if ($_REQUEST['sec'] == "thankyou"){
		session_regenerate_id(true);
	}
	$_SESSION['SID'] = session_id();
	$SID = $_SESSION['SID'];
}
header("Cache-control: private");  // IE 6 Fix.
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
// Coming out of a checkout.
if ($_SERVER["HTTPS"] && $_REQUEST['sec'] != "checkout"){
	$destination = "http://".$site.".cellbenefits.com/".$_SERVER['REQUEST_URI'];
	header("Location: $destination");
	exit;
}
*/
?>

<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$message = $_REQUEST['message'];
$status = $_REQUEST['status'];
$task = $_REQUEST['task'];
$cargo = $_REQUEST['cargo'];
?>

<?
// Connect to the database
include "dbconnect.php";
?>

<?
/*// Grab site setup information
$result = mysql_query("SELECT * FROM sites WHERE site = '$site'", $linkID);
$config = mysql_fetch_assoc($result);
$label = $config['label'];
$title = $config['title'];
$logo = $config['logo'];
$header_logo = $config['header_logo'];
$header_promo = $config['header_promo'];
$discount_promo = $config['discount_promo'];
$pricing_level = $config['pricing_level'];
$discount_form = $config['discount_form'];
$sprint_site = $config['sprint'];
$sprint_discount = $config['sprint_discount'];
$nextel_site = $config['nextel'];
$nextel_discount = $config['nextel_discount'];
$cingular_site = $config['cingular'];
$cingular_discount = $config['cingular_discount'];
*/
?>

<?
/*
// Grab existing cart carrier selected, if any exists.
$carrier_selected = "";
$query = "SELECT carrier FROM orders WHERE session_id='".$SID."'";
$rs_carrier = mysql_query($query, $linkID);
$row = mysql_fetch_assoc($rs_carrier);
if (mysql_num_rows($rs_carrier) > 0) $carrier_selected = $row['carrier'];
*/
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title>Google Communications Wireless Telecom Admin System</title>

	<!-- Meta Tags -->
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="robots" content="all, index, follow">
	<meta name="revisit-after" content="3 days">
	<meta name="category" content="">
	<meta name="subject" content="">
	<meta name="classification" content="">
	<meta name="rating" content="General">
	<meta name="author" content="Network Resources (www.nr.net) for Vision Cellular (www.visioncell.com)">
	<meta http-equiv="code-language" content="PHP5">
	<meta http-equiv="content-language" content="en-us">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="imagetoolbar" content="no">
	<meta name="distribution" content="United States, USA, United States of America">
	<meta name="coverage" content="United States, USA, United States of America">
	<meta name="VW96.objecttype" content="">
	<meta name="DC.title" content="">
	<meta name="DC.subject" content="">
	<meta name="DC.description" content="">
	<meta name="DC.Coverage.PlaceName" content="United States, USA, United States of America">

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">
<!--<link href="google.css" rel="stylesheet" type="text/css">-->

	<!-- Define Home Base -->
	<?
/*
	if ($sec == "checkout"){
		echo'<base href="https://secure.nr.net/cellbenefits/">';
	}else{
		echo'<base href="http://'.$site.'.cellbenefits.com/">';
	}
*/	?>
	<base href="http://www.cellbenefits.com/google/">

	<!-- Cookie Functions -->
	<script>
	function createCookie(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	}
	
	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
	
	function eraseCookie(name) {
		createCookie(name,"",-1);
	}
	</script>

</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EFEFEF">
<!-- Header -->
<tr> <!--103737-->
	<td background="images/HeaderBG.jpg" bgcolor="#345E5D" style="background-position: left; background-repeat: no-repeat; background-attachment: scroll;">
		<table width="950" border="0" cellspacing="0" cellpadding="0" align="left">
		<tr>
			<td width="250" height="75" rowspan="2" align="right" valign="bottom"><!--<img src="images/VisionLogo.jpg" alt="Vision Wireless" width="245" height="65" border="0">--></td>
			<td width="700" height="70%" align="center" valign="bottom" class="xbigBlack"><font color="#FFFFCC"><strong>Wireless Telecom Administration</strong></font></td>
		</tr>
		<tr>
			<td height="30%" align="right" valign="bottom" class="smallBlack"><font color="#FFFFCC"><? echo iif(($_SESSION['user'] && $sec != 'login'), "<strong>Welcome ".$_SESSION['user']."</strong>", "<br>"); ?></font></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td width="100%" height="2" colspan="4" bgcolor="#020307"><img src="images/spacer.gif" alt="" height="2" border="0"><br></td>
</tr>
</table>

<!--
<table width="950" border="0" cellspacing="0" cellpadding="0" bgcolor="#FCF4FB">
<!-- Header --
<tr>
	<td width="100%" height="2" colspan="4" bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" height="2" border="0"><br></td>
</tr>
<tr> <!--FCF4FB EFF8F6--
	<td width="2" bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="2" height="75" border="0"></td>
	<td width="250" height="75" align="right" valign="bottom"><img src="images/VisionLogo.gif" alt="Vision Wireless" width="240" height="61" border="0"></td>
	<td width="696" align="center" class="xbigBlack"><strong>Wireless Telecom Admin</strong></td>
	<td width="2" bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="2" height="75" border="0"></td>
</tr>
<tr>
	<td width="100%" height="2" colspan="4" bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" height="2" border="0"><br></td>
</tr>
</table>
-->

<?
if (!$_SESSION['user_level'] || $sec == "login"){
	include("include/login.php");
	exit;
}
?>

<table width="950" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tr>
	<!-- Menu -->
	<td width="250" align="center" valign="top">
		<br>
		<?
		include("include/menu.php");
		?>
	</td>
	<!-- Body -->
	<td width="700" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td>
				<?
				// Branch Content Based On Passed "SEC" Value
				switch($sec){
					case "test": include("include/tickets.php");break;
					case "": include("include/home.php");break;
					case "home": include("include/home.php");break;
					case "notes": include("include/home.php");break;
					case "port": include("include/port.php");break;
					case "change": include("include/change.php");break;
					case "service": include("include/service.php");break;
					case "news": include("include/news.php");break;
					case "manage": include("include/manage.php");break;
					default: include("include/home.php");break;
				} // End Switch
				?>
			</td>
		</tr>
		<tr>
			<td width="675" align="center" valign="bottom" class="smallGray">
				<br><br>
				<strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Vision Wireless" target="_blank" class="smallGray">Vision Cellular, Inc.</a>.&nbsp;&nbsp;All Rights Reserved.</strong>
		</tr>
		</table>
	</td>
</tr>
</table>

</body>
</html>
